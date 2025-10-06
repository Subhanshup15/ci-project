<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/pharma_patient_count_list'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  

<!--<div class="form-group">-->

<!--    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>-->

<!--    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">-->
  
<!--</div>  -->


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
    </select>
   <!-- <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>-->
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

                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
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
 
 
                    
                   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Pharma Patient List(<?php echo $section; ?>)</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($start_date))  ?></h4>
                    
                   
                  
                        
                         
                         
                          
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" >
                    <thead >
                        <tr>
                            <th>Sr. No</th>
                            <th>OPD No.</th>
                            <th>Name</th>
                            <th>Dignosis</th>
                            <th>Tab1</th>
                            <th>Tab2</th>
                            <th>Tab3</th>
                            <th>Tab4</th>
                            <th>Tab5</th>
                            <th>Action</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                       // print_r($pharma);
                        foreach($pharma_patient as $patient){ ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $patient->yearly_reg_no; ?></td>
                            <td><?php echo $patient->name; ?></td>
                            <td><?php echo $patient->dignosis; ?></td>
                            <td>
                                <?php
                                
                              $name1 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patient->tab_name1)->get()->row();
                                if($name1)
                                {
                                    echo $name1->tab_name;
                                }else
                                {
                                    echo $patient->tab_name1; 
                                }?>
                            </td>
                            <td><?php
                            
                            $name2 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patient->tab_name2)->get()->row();
                                if($name2)
                                {
                                    echo $name2->tab_name;
                                }else
                                {
                                    echo $patient->tab_name2; 
                                }
                            
                            //echo $patient->tab_name2; ?></td>
                            <td><?php
                             $name3 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patient->tab_name3)->get()->row();
                                if($name3)
                                {
                                    echo $name3->tab_name;
                                }else
                                {
                                    echo $patient->tab_name3; 
                                }
                            
                           // echo $patient->tab_name3; ?></td>
                            <td><?php
                            
                            $name4 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patient->tab_name4)->get()->row();
                                if($name4)
                                {
                                    echo $name4->tab_name;
                                }else
                                {
                                    echo $patient->tab_name4; 
                                }
                            
                            echo $patient->tab_name4; ?></td>
                            <td><?php
                            
                            
                            $name5 = $this->db->select('*')->from('pharma_original_stock')->where('id',$patient->tab_name5)->get()->row();
                                if($name5)
                                {
                                    echo $name5->tab_name;
                                }else
                                {
                                    echo $patient->tab_name5; 
                                }
                                
                                echo $patient->tab_name5; ?></td>
                            <td>
                                <a href="<?php echo base_url("patients/view_bill/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php } $i++; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>



