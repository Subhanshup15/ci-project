<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_all_patient_investi'); ?>">
                                      
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
    <select class="form-control" name="section" id="section">
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

                             

          
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                   <?php if($section == 'ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">All Investigation Patient IPD</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
               <?php } else { ?>   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">All Investigation Patient OPD</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     

                   <?php } ?>   
                         
                         
                </div>
                <div class="col-xs-2"></div>
                </div>
                </div>
                <table width="100%" class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">Sr.No.</th>
                      <th colspan="2">COPD No.</th>
                      <th rowspan="2">Name</th>
                      <th rowspan="2">Dignosis</th>
                      <th rowspan="2">Department</th>
                      <th rowspan="2" >Investigation</th>
                      <th rowspan="2">Action</th>
                    </tr>
                    <tr>
                      <th>New</th>
                      <th>Old</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                   // print_r($patients);

                   if (!empty($patients)) {
                    $i= 1;
                    foreach($patients as $patient){ ?>
                    
                    <?php 
                     if($section == 'opd') 
                     {
                     	$table_name = 'patient';   
                     }else
                     {
                       $table_name = 'patient_ipd';
                     }
                     $patient_data = $this->db->select('*')->from($table_name)->where('id',$patient->patient_auto_id)->get()->row(); 
                                                //   print_r($this->db->last_query());
                    ?>
                    
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo ($patient_data->yearly_reg_no)?$patient_data->yearly_reg_no:'' ?></td>
                      <td><?php echo ($patient_data->old_reg_no)?$patient_data->old_reg_no:'' ?></td>
                      <td><?php 

                                 
                      echo $patient_data->firstname; ?></td>
                      <td><?php echo $patient_data->dignosis; ?></td>
                      <td><?php
                      
                      $dept_name = $this->db->select('*')->from('department')->where('dprt_id',$patient_data->department_id)->get()->row();
                      
                      echo $dept_name->name; ?></td>
                      <td>
                        <?php
                         if($patient->hematology){ echo $patient->hematology.','; }
                         if($patient->serology){ echo $patient->serology.','; }
                         if($patient->biochemistry){ echo $patient->biochemistry.','; }
                         if($patient->microbiology){ echo $patient->microbiology.','; }
                        ?>
                      </td>
                      <td class="center no-print">
                        <a href="<?php echo base_url("patients/get_all_patient_investi_profile/$patient->patient_auto_id/$section") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                      </td>   
                    </tr>
                    <?php $i++; }  ?>
                    <?php } ?>
                  </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>



