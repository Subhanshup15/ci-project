<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">


    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/deptipdcountdate')?>">
                                      
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
                    
 
                    <h5>IPD Total Patient Count By Department</h5>  
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>                    

            </div>
             <div class="col-sm-2"></div>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>             
                            <th><?php echo "S. No" ?></th>
                            <th><?php echo "Department Name" ?></th>                            
                            <th><?php echo "Total" ?></th>                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcount)) { ?>
                            <?php $sl = 12141;?>
                            <?php $i = 0; foreach ($ipdcount as $patient) { $i++; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                                                   
                                    <td><?php echo $i; ?> </td>
                                    <td><?php echo $patient->name;?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $patient->Total; ?></td>                                                                      
                                </tr>
                                <?php $sl++; ?>
                                
                            <?php } ?> 
                               
                        <?php } ?> 
                               
                    </tbody>
                                <tr>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php echo $totalipdcount[0]->Total;  ?></strong></td>
                                </tr>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>


<!-- //Add Sum footer bootm table -->
