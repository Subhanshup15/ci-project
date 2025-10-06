
<div class="row">

    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/deptipdcountbydatefilter')?>">
                                      
            <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
                              
                              
                <div class="form-group">
                              
                    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
                              
                </div>  
                              
                <div class="form-group">
                              
                    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                              
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
                        <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
	          	    </div> 
                    
                    <div class="col-sm-8" align="center">  
                        <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                        <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    
                        <h5>IPD Total Patient Count By Date</h5>  
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>                    

                    </div>
                    
                    <div class="col-sm-2"></div>
              
               
                
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    
                    <thead>
                        <tr>             
                            <!--<th rowspan='2'><?php echo "S. No" ?></th>-->
                            <th rowspan='2'><?php echo "Date" ?></th>             
                            <?php foreach($department as $dept){?>
                            <th colspan='2'><?php echo $dept->name; ?></th>                            
                            <?php } ?>
                            <th rowspan='2'><?php echo "Total Count" ?></th>                     
                        </tr>
                        <tr>
                            <?php foreach($department as $dept){?>
                            <th><?php echo "New" ?></th>                       
                            <th><?php echo "Old" ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    
                   
                    <tbody>
                    
                        <?php
                        
                            $date1 = date_create($datefrom);
                            $date2 = date_create($dateto);
                            $diff = date_diff($date1, $date2);
                            $days = $diff->format('%a') ;
                            //echo $days;
                            $ipdPatientCount = array();
                            $total = 0;
                            for($i=0; $i<=$days; $i++){
                                
                                $checkDate = date('Y-m-d', strtotime("+$i days", strtotime($datefrom)));
                                //print_r($checkDate);
                        ?>
                            <tr>
                                <td><?php echo date('d-m-Y',strtotime($checkDate));?></td>
                        <?php      
                                foreach($department as $key => $dept){
                                    $newCount = $this->db->where(['yearly_reg_no !='=>'','department_id'=>$dept->dprt_id, 'create_date like '=>'%'.$checkDate.'%', 'ipd_opd'=>'ipd'])
                                        ->get('patient_ipd')
                                        ->num_rows();
                                    $oldCount = $this->db->where(['old_reg_no !='=>'','department_id'=>$dept->dprt_id, 'create_date like '=>'%'.$checkDate.'%', 'ipd_opd'=>'ipd'])
                                        ->get('patient_ipd')
                                        ->num_rows();
                                    
                                    $total = $total + $newCount + $oldCount;
                        ?> 
                                    <td><?php echo $newCount;?></td>
                                    <td><?php echo $oldCount;?></td>
                        <?php
                                }
                        ?>
                                <td><?php echo $total; $total=0;?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <th>Grand Total</th>
                            <?php   
                                $grandtotal = 0;
                                foreach($department as $key => $dept){
                                    $newTotalCount = $this->db->where(['yearly_reg_no !='=>'','department_id'=>$dept->dprt_id, 'create_date >= '=>$datefrom, 'create_date <= '=>$dateto, 'ipd_opd'=>'ipd'])
                                        ->get('patient_ipd')
                                        ->num_rows();
                                    $oldTotalCount = $this->db->where(['old_reg_no !='=>'','department_id'=>$dept->dprt_id, 'create_date >= '=>$datefrom, 'create_date <= '=>$dateto, 'ipd_opd'=>'ipd'])
                                        ->get('patient_ipd')
                                        ->num_rows();
                                    
                                    $grandtotal = $grandtotal + $newTotalCount + $oldTotalCount;
                            ?>
                                    <th><?php echo $newTotalCount;?></th>
                                    <th><?php echo $oldTotalCount;?></th>
                            <?php
                                }
                            ?>
                            <th><?php echo $grandtotal; ?></th>
                        </tr>
                    
                    </tbody>
                    
                </table>  <!-- /.table-responsive -->
                
                
            </div>
        </div>
    </div>
</div>



