<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('stock/stock_report_churn'); ?>">
            <div class="form-group">
                <select class="form-control" name="reportType" id="reportType">
                    <option value="m">Monthly Stock Report</option>
                </select>
            </div>
            <div class="form-group" id="startDate">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>  
            <div class="form-group" id="endDate">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
            </div>
            <div class="form-group">
                <select class="form-control" name="section" id="section">
                    <option value="">Select Section</option>
                    <option value="opd">opd</option>
                    <option value="ipd">ipd</option>
                </select>
            </div>
            <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
        </form>
    </div>
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print row">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>           
            </div>
            <div class="panel-body">
                 <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 </div> </div> 
                    <?php if($reportType=='d'):?>
                    <?php elseif($reportType=='m'):?>
                        <?php print_r($churnaDailyStockRegister);?>
                        <?php 
                            // $date1=date_create(date("Y-m-d", strtotime($datefrom)));
                            // $date2=date_create(date("Y-m-d", strtotime($dateto)));
                            // $diff=date_diff($date1,$date2);
                            // $monthDays = $diff->d+1;


                              $date1=date("Y-m-d", strtotime($datefrom));
                                $date2=date("Y-m-d", strtotime($dateto));
                                $date3=date_create($date1);
                                $date4=date_create($date2);
                                $diff=date_diff($date3,$date4);
                                $moth = $diff->format("%a");
                                $monthDays = $moth+1;
                           ?>
                        <div>
                            <div class="col-sm-12" align="center">
                                <?php if($section):?>
                                    <h3><strong><?php echo "Monthly ".ucfirst($section)." Stock Register"; ?></strong></h3>
                                <?php else: ?>
                                    <h3><strong><?php echo "Monthly Stock Register"; ?></strong></h3>
                                <?php endif; ?>
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Churna Register"; ?></strong></h2>
                            </div>
                            <table width="100%" id="patientdata" class="table table-responsive table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan='2'>Sr. No</th>
                                        <th rowspan='2'>Medicine Name</th>
                                        <th rowspan='2' style="width: 30px; text-align: center;">Opening Stock Balance</th>
                                        <th rowspan='2' style="width: 30px; text-align: center;">IPD / OPD</th>
                                        <th colspan='<?php echo $monthDays; ?>' style="width: 30px; text-align: center;">Despensed Stock</th>
                                        <th rowspan='2' style="width: 30px; text-align: center;">Current Stock</th>
                                        <th rowspan='2' colspan='2' style="width: 30px; text-align: center;">Total Despensed Stock</th>
                                        <th rowspan='2' style="width: 30px; text-align: center;">Closing Stock Balance</th>
                                    </tr>
                                    <tr>
                                        <?php for($i=1; $i<=$monthDays; $i++):?>
                                            <th><?php echo $i;?></th>
                                        <?php endfor;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=0;$i<count($churnaStockRegister);$i++):?>
                                        <tr>
                                            <?php $month = date("m", strtotime($datefrom));?>
                                            <?php $year = $this->session->userdata['acyear'];?>
                                            
                                            <!--<?//php print_r($churnaStockRegister);?>-->
                                            
                                            <?php 
                                                $stockDefaultOpeningBalData = $this->db->where(['status'=>'1', 'id'=>$churnaStockRegister[$i]->id])
                                                            ->get('pharma1')
                                                            ->row();
                                                $stockMonthOpeningBalData = $this->db->where(['ipd_opd' => 'opd', 'create_date' => date('Y-m-d', strtotime($datefrom)), 'type'=>'1', 'medicine_id'=>$churnaStockRegister[$i]->id])
                                                                ->get('daily_stock')
                                                                ->row();
                                                //print_r($this->db->last_query());
                                                            
                                                for($j=1; $j<=$monthDays; $j++):
                                                    $checkDate2 = date("Y-m-d", strtotime($j.'-'.$month.'-'.$year));
                                                    
                                                        $stockOPDData = $this->db->where(['ipd_opd' => 'opd', 'create_date' => $checkDate2, 'type'=>'1', 'medicine_id'=>$churnaStockRegister[$i]->id])
                                                                ->get('daily_stock')
                                                                ->row();
                                                    
                                                        $stockIPDData = $this->db->where(['ipd_opd' => 'ipd', 'create_date' => $checkDate2, 'type'=>'1', 'medicine_id'=>$churnaStockRegister[$i]->id])
                                                            ->get('daily_ipd_stock')
                                                            ->row();
                                                            
                                                        $totalOPDDespensedBalTemp=$totalOPDDespensedBalTemp + $stockOPDData->daily_despensing_bal;
                                                        $totalIPDDespensedBalTemp=$totalIPDDespensedBalTemp + $stockIPDData->daily_despensing_bal;
                                                    
                                                    //$openingBal = $openingBal + $stockOPDData->daily_added_bal + $stockIPDData->daily_added_bal;
                                                    $importedStock = $importedStock + $stockOPDData->daily_added_bal + $stockIPDData->daily_added_bal;
                                                endfor;
                                                //$openingBal = $openingBal + $stockDefaultOpeningBalData->opening_bal;
                                                //$openingBal = $openingBal + $stockMonthOpeningBalData->daily_opening_bal;
                                          if($stockMonthOpeningBalData->daily_opening_bal)
                                          {
                                                $openingBal = $stockMonthOpeningBalData->daily_opening_bal;
                                          }
                                          else
                                          {
                                                $openingBal = $stockDefaultOpeningBalData->opening_bal;
                                          }
                                          if($stockMonthOpeningBalData->daily_opening_bal)
                                          {
                                             $currentStock = $importedStock + $stockMonthOpeningBalData->daily_opening_bal;
                                          }
                                          else
                                          {
                                             $currentStock = $stockDefaultOpeningBalData->opening_bal;
                                          }
                                          
                                               // $currentStock = $importedStock + $stockMonthOpeningBalData->daily_opening_bal;
                                          
                                                $totalIPDOPDDespensedBalTemp = $totalOPDDespensedBalTemp + $totalIPDDespensedBalTemp;
                                          
                                                //$closingBal = $openingBal - $totalIPDOPDDespensedBalTemp;
                                                $closingBal = $currentStock - $totalIPDOPDDespensedBalTemp;
                                            ?>
                                            
                                            
                                            
                                            <td rowspan='2' style='vertical-align: middle;'><?php echo $i+1;?></td>
                                            <td rowspan='2' style='vertical-align: middle;'><?php echo $churnaStockRegister[$i]->name;?></td>
                                            <td rowspan='2' style='vertical-align: middle;'><?php echo $openingBal;?></td>
                                            <td><?php echo 'OPD'; ?></td>
                                            <?php for($j=1; $j<=$monthDays; $j++): ?>
                                                <?php
                                                    $checkDate2 = date("Y-m-d", strtotime($j.'-'.$month.'-'.$year));
                                                    $stockOPDData = $this->db->where(['ipd_opd' => 'opd', 'create_date' => $checkDate2, 'type'=>'1', 'medicine_id'=>$churnaStockRegister[$i]->id])
                                                            ->get('daily_stock')
                                                            ->row();
                                                ?>
                                                <th><?php if($stockOPDData->daily_despensing_bal != 0){ ?><strong style='color:red;'><?php echo $stockOPDData->daily_despensing_bal;?></strong><?php if($stockOPDData->daily_added_bal != 0){ echo '<br> + <br>'.$stockOPDData->daily_added_bal;}?><?php }else{ echo '0'; }?></th>
                                                <?php $totalOPDDespensedBal=$totalOPDDespensedBal + $stockOPDData->daily_despensing_bal;?>
                                            <?php endfor;?>
                                            <td rowspan='2' style='vertical-align: middle;'><?php echo $openingBal+$importedStock; ?></td>
                                            <td><?php echo $totalOPDDespensedBal; ?></td>
                                            <td rowspan='2' style='vertical-align: middle;'><?php echo $totalIPDOPDDespensedBalTemp; ?></td>
                                            <td rowspan='2' style='vertical-align: middle;'><?php echo $closingBal;?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo 'IPD';?></td>
                                            <?php for($j=1; $j<=$monthDays; $j++): ?>
                                                <?php
                                                    $checkDate2 = date("Y-m-d", strtotime($j.'-'.$month.'-'.$year));
                                                    $stockIPDData = $this->db->where(['ipd_opd' => 'ipd', 'create_date' => $checkDate2, 'type'=>'1', 'medicine_id'=>$churnaStockRegister[$i]->id])
                                                            ->get('daily_ipd_stock')
                                                            ->row();
                                                ?>
                                                <th><?php if($stockIPDData->daily_despensing_bal != 0){ ?><strong style='color:red;'><?php echo $stockIPDData->daily_despensing_bal;?></strong><?php if($stockIPDData->daily_added_bal != 0){ echo '<br> + <br>'.$stockIPDData->daily_added_bal;}?><?php }else{ echo '0'; }?></th>
                                                <?php $totalIPDDespensedBal=$totalIPDDespensedBal + $stockIPDData->daily_despensing_bal;?>
                                            <?php endfor;?>
                                            <td><?php echo $totalIPDDespensedBal; ?></td>
                                            
                                                                            
                                            <?php $closingBal=0; $openingBal=0; $importedStock=0; $currentStock=0; $totalOPDDespensedBal=0; $totalIPDDespensedBal=0; $totalOPDDespensedBalTemp=0; $totalIPDDespensedBalTemp=0;?>
                                        </tr>
                                    <?php endfor;?>
                                </tbody>
                            </table>
                        </div>

                       
                    <?php elseif($reportType=='y'):?>
                    <?php endif;?>
                </div>
                <div class="col-xs-2" ></div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#reportType').on('change', function(){
        var type = $('#reportType').val();
        if(type=='d'){
            $('#startDate').show();
            $('#endDate').hide();
        }
        else if(type=='m'){
            $('#startDate').show();
            $('#endDate').show();
            $('#section').next(".select2-container").hide();
        }
        else if(type=='y'){
            $('#startDate').hide();
            $('#endDate').hide();
            $('#section').next(".select2-container").hide();
        }
    });
</script>
