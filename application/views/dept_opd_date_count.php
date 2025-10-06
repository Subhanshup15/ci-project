
<div class="row">

    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/deptopdcountbydatefilter')?>">
                                      
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
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100%; width:100%;border: 0.5px solid #0003;" />
	          	 </div> 
            <div class="col-sm-8" align="center">  
                   <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    
                    <h5>OPD Total Patient Count By Date</h5>  
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>                    

            </div>
             <div class="col-sm-2"></div>
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($department as $patient) { $i++; ?>
                                    <th colspan="2"><?php echo $patient->name ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        <tr>
                            <?php $i = 0; foreach ($department as $patient) { $i++; ?>
                                <th>New</th>
                                <th>Old</th>                            
                            <?php } ?>
                        </tr>
                       
                    </thead>
                 <tbody>
    <?php if (!empty($ipdcountdater)) { ?>
        <?php $sl = 12141; ?>
        <?php foreach ($date as $date) { ?>
            <tr>
                <td><?php echo date("d/m/Y", strtotime($date->create_date)) ?></td>
                <?php foreach ($department as $patient) { ?>
                    <?php
                    $found = false;
                    foreach ($ipdcountdater as $ipdData) {
                        if ($date->create_date == $ipdData->Date && $patient->name == $ipdData->name) {
                            $found = true;
                            ?>
                            <td><?php echo $ipdData->Patientnewcount; ?></td>
                            <td><?php echo $ipdData->Patientoldcount; ?></td>
                        <?php }
                    }
                    if (!$found) { ?>
                        <td>0</td>
                        <td>0</td>
                    <?php } ?>
                <?php } ?>
                <td><strong><?php echo $date->Total; ?></strong></td>
            </tr>
        <?php } ?> <!-- New Row create date wise -->
    <?php } else { ?>
        <tr>
            <td colspan="<?php echo 2 * count($department) + 2; ?>"><strong>No data available</strong></td>
        </tr>
    <?php } ?>
</tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($departmenttotal as $depart) { ?>

                            <td colspan="2" style="text-align:center">
                               <strong><?php echo $depart->Total; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        
                        
                    </tr>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $(".datepicker").datepicker();
});
<script>