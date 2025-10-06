
<div class="row">

    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/dept_gender_ipd_occupancy_summery_report')?>">
            <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
            <div class="form-group">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>  
            <div class="form-group">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
            </div>  
            <div class="form-group">
                <!--<select class="form-control" name="section" id="section">-->
                <!--    <option value="opd">opd</option>-->
                <!--    <option value="ipd">ipd</option>-->
                <!--</select>-->
                <input type="text" name="section" class="form-control" id="section" placeholder="<?php echo display('section') ?>" value='ipd' readonly>
            </div>
            <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
        </form>
    </div>
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 
            <div class="panel-body">
                 <div class="col-sm-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100%; width:100%;border: 0.5px solid #0003;" />
	          	 </div> 
                <div class="col-sm-8" align="center">  
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php echo $this->session->userdata('title') ?></h3>
                    <h4><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    <hr style="border: 1px solid black; background-color:black;">
                    <h5>DEPARTMENTWISE MALE / FEMALE IPD OCCUPANCY SUMMARY REPORT</h5>  
                </div>
                 <div class="col-sm-2"></div>
                <div class="col-sm-12" align="center" style="margin-top:20px;">
                    <div class="col-sm-6" align="left">
                            <div style='display: inline-block;' align='left'><strong>( Main Hospital )</strong></div>
                    </div>
                    <div class="col-sm-6" align="right">
                            <div style='display: inline-block;' align='right'><strong>From: <?php if($datefrom){ echo date('d-M-Y', strtotime($datefrom)); }else{ echo '00-00-0000'; } ?> To: <?php if($dateto){ echo date('d-M-Y', strtotime($dateto)); }else{ echo '00-00-0000'; } ?></strong></div>
                    </div>
                </div>
                
                <!--<pre>-->
                <!--    <?//php print_r($dateArray);?>-->
                <!--</pre>-->
                
                
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" style='text-align: center;'><?php echo "Date" ?></th>                            
                            <?php $i = 0; foreach ($department as $dept) { $i++; ?>
                                
                                <th <?php if($dept->dprt_id != 29){ echo "colspan='2'"; } ?> style='text-align: center;'><?php echo $dept->name ?></th>
                            <?php } ?>                            
                            <th rowspan="2" style='text-align: center;'><?php echo "Total" ?></th>                   
                        </tr>
                        <tr>
                            <?php $i = 0; foreach ($department as $dept) { $i++; ?>
                                <?php if($dept->dprt_id != 29){?>
                                <th style='text-align: center;'>Male</th>
                                <?php } ?>
                                <th style='text-align: center;'>Female</th>                            
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($tableName){ ?>
                            <?php for($i=0;$i<count($dateArray);$i++){?>
                                <tr>
                                    <td style='text-align: left;'><?php echo date('d-M-Y', strtotime($i." days", strtotime($datefrom))); ?></td>
                                    <?php $temp1=0; $temp2=0; ?>
                                    <?php for($j=0;$j<count($dateArray[$i]);$j++){?>
                                            <?php if($dateArray[$i][$j]['department_id'] != '29'){?>
                                                <td style='text-align: right;'><?php echo $res1 = $dateArray[$i][$j]['maleCount']; $temp1 = $temp1 + $res1;?></td>
                                            <?php }else{ ?>
                                                <?php $res1 = 0; $temp1 = $temp1 + $res1;  ?>
                                            <?php } ?>
                                            <td style='text-align: right;'><?php echo $res2 = $dateArray[$i][$j]['femaleCount']; $temp2 = $temp2 + $res2; ?></td>
                                    <?php } ?>
                                    <th style='text-align: right;'><?php echo $temp1 + $temp2; ?></th>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th style='text-align: center;'>Totals : </th>
                                <?php $temp3=0; $temp4=0; $deptTotalCountArray = array(); $deptMFCountArray = array();?>
                                <?php foreach ($department as $dept) { ?>
                                    
                                    <?php
                                        $maleCount = 0; $femaleCount = 0; 
                                        for($i=0;$i<count($dateArray);$i++){
                                            for($j=0;$j<count($dateArray[$i]);$j++){
                                                if($dept->dprt_id == $dateArray[$i][$j]['department_id']){
                                                    if($dept->dprt_id != 29){
                                                        $maleCount = $maleCount + $dateArray[$i][$j]['maleCount'];
                                                    }else{
                                                        $maleCount = $maleCount + 0;
                                                    }
                                                    $femaleCount = $femaleCount + $dateArray[$i][$j]['femaleCount'];
                                                }
                                            }
                                        }
                                    ?>
                                    <?php if($dept->dprt_id != 29){ ?>
                                        <th style='text-align: right;'><?php echo $maleCount; $temp3 = $temp3 + $maleCount; ?></th>
                                    <?php }else{ ?>
                                        <?php $maleCount=0; $temp3 = $temp3 + $maleCount; ?>
                                    <?php } ?>
                                    <th style='text-align: right;'><?php echo $femaleCount; $temp4 = $temp4 + $femaleCount; ?></th>
                                    <?php
                                        $deptMFCountArray = array('department_id'=>$dept->dprt_id, 'maleTotalCount'=>$maleCount, 'femaleTotalCount'=>$femaleCount);
                                        array_push($deptTotalCountArray, $deptMFCountArray);
                                    ?>
                                <?php } ?>
                                <th style='text-align: right;'><?//php echo $temp3 + $temp4; ?></th>
                            </tr>
                            <tr>
                                <th style='text-align: center;'>Grand Totals : </th>
                                <?php $temp5=0;?>
                                <?php foreach ($department as $dept) { ?>
                                    <?php
                                        $maleTotalCount = 0; $femaleTotalCount = 0; 
                                        for($i=0; $i<count($deptTotalCountArray);$i++){
                                            if($dept->dprt_id == $deptTotalCountArray[$i]['department_id']){
                                                if($dept->dprt_id != 29){
                                                    $maleTotalCount = $maleTotalCount + $deptTotalCountArray[$i]['maleTotalCount'];
                                                }else{
                                                    $maleTotalCount = $maleTotalCount + 0;
                                                }
                                                $femaleTotalCount = $femaleTotalCount + $deptTotalCountArray[$i]['femaleTotalCount'];
                                            }
                                        }
                                    ?>
                                        <th <?php if($dept->dprt_id != 29){ echo 'colspan="2"'; } ?> style='text-align: center;'><?php echo $maleTotalCount + $femaleTotalCount; ?></th>
                                    <?php
                                        $temp5 = $temp5 + $maleTotalCount + $femaleTotalCount;
                                    ?>
                                <?php } ?>
                                <th style='text-align: center;'><?php echo $temp5; ?></th>
                            </tr>
                            <tr>
                                <th style='text-align: center;'>Dept. Bed Occupancy <br> (In Percentage) : </th>
                                <?php 
                                    foreach ($department as $dept) {
                                        $maleTotalCount = 0; $femaleTotalCount = 0; $totalMFCount = 0; 
                                        for($i=0; $i<count($deptTotalCountArray);$i++){
                                            if($dept->dprt_id == $deptTotalCountArray[$i]['department_id']){
                                                if($dept->dprt_id != 29){
                                                    $maleTotalCount = $maleTotalCount + $deptTotalCountArray[$i]['maleTotalCount'];
                                                }else{
                                                    $maleTotalCount = $maleTotalCount + 0;
                                                }
                                                $femaleTotalCount = $femaleTotalCount + $deptTotalCountArray[$i]['femaleTotalCount'];
                                            }
                                        }
                                        $totalMFCount = $maleTotalCount + $femaleTotalCount;
                                        
                                        $deptTotalBedCount = $this->db->where('department_id', $dept->dprt_id)->get('beds')->num_rows();
                                        $date1=date_create($datefrom);
                                        $date2=date_create($dateto);
                                        $diff=date_diff($date1,$date2);
                                        $days = $diff->format("%a")+1;
                                        $deptTotalBedOccupancy=number_format(($totalMFCount * 100)/($deptTotalBedCount * $days),2);
                                ?>
                                        <th <?php if($dept->dprt_id != 29){ echo 'colspan="2"'; } ?> style='text-align: center;'><?php echo $deptTotalBedOccupancy.'%'; ?></th>
                                <?php
                                    }
                                ?>
                                <th style='text-align: center;'></th>
                            </tr>
                            <tr>
                                <?php
                                    $totalBedCount = $this->db->get('beds')->num_rows();
                                    $date1=date_create($datefrom);
                                    $date2=date_create($dateto);
                                    $diff=date_diff($date1,$date2);
                                    $days = $diff->format("%a")+1;
                                    $totalBedOccupancy=number_format(($temp5 * 100)/($totalBedCount * $days),2);
                                ?>
                                <th colspan="13" style='text-align: center;'>Average Bed Occupancy (In Percentage) : <?php echo $totalBedOccupancy.'%';?></th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>