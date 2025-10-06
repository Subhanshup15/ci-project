<?php error_reporting(0);?>
<div class="row"><!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-body panel-form">
                <?php echo form_open_multipart('patients/create','class="form-inner"') ?>
                <?php echo form_hidden('id',$patient->id); ?>
                
                <!-- acadamic Year hidden -->
                <input type="hidden" id='acyear' value="<?php echo $this->session->userdata('acyear');?>" /> 
                
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group row">
                            <label for="ipd_opd" class="col-xs-3 col-form-label"><?php echo display('ipd_opd') ?></label>
                            <div class="col-xs-9">
                                <?php
                                    $ipd_opd = array(
                                        // ''   => display('select_option'),
                                        'opd' => 'OPD',
                                        'ipd' => 'IPD',
                                    );
                                    echo form_dropdown('ipd_opd', $ipd_opd, $patient->ipd_opd, 'class="form-control select2" id="ipd_opd" ');
                                    
                                    /*if($patient->id != null):
                                        echo form_dropdown('ipd_opd', $ipd_opd, $patient->ipd_opd, 'class="form-control select2" id="ipd_opd" disabled="disabled"');
                                    else:
                                        echo form_dropdown('ipd_opd', $ipd_opd, $patient->ipd_opd, 'class="form-control select2" id="ipd_opd" ');
                                    endif;*/
                                ?>
                            </div>
                        </div>
                        <?php if($patient->id == null): ?>
                            <div class="form-group row status1">
                            <label for="status1" class="col-xs-3 col-form-label"><?php echo display('status') ?></label>
                            <div class="col-xs-9"> 
                            <?php
                                $status = array(
                                    ''   => display('select_option'),
                                    'new' => 'New',
                                    'old' => 'Old',
                                );
                                echo form_dropdown('status1', $status, $patient->status, 'class="form-control select2" id="status1" '); 
                            ?>
                            </div>
                        </div>
                        <?php endif;?>
                       
                  
                        <div class="form-group row" id="old">
                            <label for="old_reg_no" class="col-xs-3 col-form-label"><?php echo display('old_reg_no') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="old_reg_no" autocomplete="off" type="text" class="form-control" id="old_reg_no" placeholder="Old Reg. No or Patient Name" value="<?//php echo $patient->yearly_reg_no ?>">    
                            </div>
                        </div>
                      
                      <div class="form-group row" id="old_name">
                            <label for="old_reg_no" class="col-xs-3 col-form-label"><?php echo display('patient_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="patient_name" autocomplete="off" type="text" class="form-control" id="patient_name" placeholder="Patient Name" value="<?//php echo $patient->yearly_reg_no ?>">    
                            </div>
                        </div>
                      
                        <div class="form-group row" id="ipdno">
                            <label for="ipd_no" class="col-xs-3 col-form-label">IPD No <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="ipd_no" autocomplete="off" type="text" class="form-control" id="ipd_no" placeholder="Ipd Number" value="<?php echo $patient->ipd_no ?>">    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <?php 
                            $year = '%'.$this->session->userdata['acyear'].'%';
                            $result = $this->db->select("*")
                                    ->from('patient')
                                    //->where('yearly_reg_no is NOT NULL', NULL, FALSE)
                                    ->where('yearly_reg_no !=','')
                                    ->where('create_date like', $year) 
                                    ->order_by("id", "desc")
                                    ->limit(1)
                                    ->get()
                                    ->row();
                            //echo $this->db->last_query();
                            // echo $result->yearly_reg_no;
                            //  echo $serial_no;
                            //  echo $patient->yearly_reg_no;
                            $result1 = $this->db->select("*")
                                    ->from('patient_ipd')
                                    //->where('yearly_reg_no is NOT NULL', NULL, FALSE)
                                    ->where('yearly_reg_no !=','')
                                    ->where('create_date like', $year) 
                                    ->order_by("id", "desc")
                                    ->limit(1)
                                    ->get()
                                    ->row();
                            // echo  $result1->yearly_reg_no;
                        ?>
                        <div class="form-group row" id="yearly_no1">
                            <label for="yearly_no" class="col-xs-3 col-form-label"><?= ($patient->ipd_opd == 'ipd')? 'Ipd Reg No.' : 'Opd Reg No.' ?></label>
                            <div class="col-xs-9">
                                <input name="yearly_reg_no" autocomplete="off" type="text" class="form-control" id="yearly_reg_no" placeholder="<?php echo display('yearly_reg_no_or_Patient_Name') ?>" value="<?php if($serial_no =='1') { echo $result->yearly_reg_no + 1; } else if($patient->yearly_reg_no){ echo $patient->yearly_reg_no;} else {echo "";}?>" readonly>    
                            </div>
                        </div>
                        <input type="hidden" name="ipd_year_reg_no"  id="ipd_year_reg_no" value="<?php echo $result->yearly_reg_no + 1;?>">
                        <input type="hidden" name="opd_year_reg_no" id="opd_year_reg_no" value="<?php echo $result->yearly_reg_no + 1;?>">
                        
                        
                        <div class="form-group row">
                            <label for="firstname" class="col-xs-3 col-form-label"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date_of_birth') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="date_of_birth" class="form-control" type="text" placeholder="<?php echo display('date_of_birth') ?>" id="date_of_birth"  value="<?php echo $patient->date_of_birth ?>" required>
                            </div>
                        </div>
                        
                        
                     
                        
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label"><?php echo display('occupation') ?></label>
                            <div class="col-xs-9"> 
                                <?php
                                    $occupation = array(
                                        'Farmer' => 'Farmer',
                                        'Office' => 'Office',
                                        'Business' => 'Business',
                                        'Student' => 'Student',
                                        'Driver' => 'Driver',
                                        'Housewife' => 'Housewife',
                                        'Labor' => 'Labor',
                                        'Teacher' => 'Teacher',
                                        'Job ' => 'Job',
                                        'Jobless ' => 'Jobless',
                                        'Other ' => 'Other'
                                    );
                                    //echo form_dropdown('occupation', $occupation, $data->occupation, 'class="form-control" id="occupation" ');
                                ?>
                                <select name="occupation" id="occupation"  class="form-control select2">
                                    <option value="">Select option</option>
                                    <?php foreach($occupation as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val; ?>" <?php if($patient->occupation==$x_val){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="occupation" class="col-xs-3 col-form-label">Weight:</label>
                            <div class="col-xs-9">
                                <input name="weight" type="text" class="form-control" id="weight" placeholder="weight" value="<?php echo $patient->wieght ?>" >                                       
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-xs-3 col-form-label">Mobile Number:</label>
                            <div class="col-xs-9">
                                <input name="mobile" type="text" class="form-control" id="mobile" placeholder="Mobile Number" value="<?php echo $patient->wieght ?>" >                                       
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <?php if($patient->id != null):?>
                            <!--Old Bed Number-->
                            <div class="form-group row" id="old_reg1">
                                <label for="old_reg_no1" class="col-xs-3 col-form-label">Alloted Bed No.</label>
                                <div class="col-xs-9">
                                    <input name="update_bed_no" autocomplete="off" type="text" class="form-control" id="old_bed_no1" placeholder="<?php echo display('Bed No') ?>" value="<?php echo $patient->bedNo; ?>" readonly>
                                </div>
                            </div>
                            <!--<input name="update_bed_no" autocomplete="off" type="hidden" class="form-control" id="old_bed_no1" placeholder="<?//php echo display('Bed No') ?>" value="<?//php echo $patient->bedNo; ?>">-->
                            <div class="form-group row" id="old_reg1">
                                <label for="old_reg_no1" class="col-xs-3 col-form-label">Old Reg No.</label>
                                <div class="col-xs-9">
                                    <input name="update_old_reg_no" autocomplete="off" type="text" class="form-control" id="old_reg_no1" placeholder="<?php echo display('old_reg_no') ?>" value="<?php echo $patient->old_reg_no; ?>" <?php if($patient->ipd_opd == 'ipd'){echo 'disabled="disabled"';}?>>    
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="form-group row">
                            <label for="create_date" class="col-xs-3 col-form-label"><?php echo display('create_date') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<input name="create_date" class="datepicker form-control" data-date-format="dd-mm-yyyy" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?//php echo ($patient->create_date != null )?  $patient->create_date : date_format($today,"d-m-Y"); ?>" required>-->
                                <?php $date=date_create($patient->create_date);?>
                                <input name="create_date" class="datepicker form-control"  data-date-format="dd-mm-yyyy" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?php echo ($patient->create_date != null )?  date_format($date,"d-m-Y") : date("d-m-Y"); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!-- <?//php echo form_dropdown('department_id',$department_list,$data->department_id,'class="form-control" id="department_id"') ?>-->
                                <select name="department_id" id="department_id"  class="form-control select2" required>
                                    <?php foreach($department_list as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->department_id==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                                <span class="doctor_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3"><?php echo display('sex') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <div class="form-check">
                                    <label class="radio-inline">
                                        <input type="radio" name="sex"  id="sex" value="M" <?php if($patient->sex=='M'){ echo "checked";}?> required>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" id="sex" value="F" <?php if($patient->sex=='F'){ echo "checked";}?> required>Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dignosis" class="col-xs-3 col-form-label"><?php echo display('Dignosis') ?></label>
                            <div class="col-xs-9">
                                <!--<input name="dignosis" autocomplete="off" type="text" class="form-control" id="dignosis" placeholder="Dignosis" value="<?//php echo $patient->dignosis ?>">   -->
                            <!-- <?//php echo form_dropdown('id_digno_sub',$dignosis_list,$data->id_digno_sub,'class="form-control" id="id_digno_sub"') ?> -->
                
                                <select name="dignosis" id="dignosis"  class="form-control select2">
                                </select>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="Quantity" class="col-xs-3 col-form-label">Address<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?//php echo form_dropdown('treatment_id',$treatment_list_rx2,$data->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <!--<select name="address" id="address"  class="form-control select2" required>
                                    <option value="">Select Address</option>
                                    <?//php print_r($address_list)?>
                                    <?//php foreach($address_list as $x => $x_val ){ ?>
                                        <option value="<?//php echo $x_val; ?>" <?//php if($patient->address==$x_val){ echo "selected";} ?> ><?//php echo $x_val; ?></option>
                                    <?//php }?>
                                </select>-->
                                <input name="address" class="form-control" type="text" placeholder="<?php echo display('address') ?>" id="address"  value="<?php echo $patient->address; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label"><?php echo display('blood_group') ?></label>
                            <div class="col-xs-9"> 
                                <?php
                                    $bloodList = array(
                                    ''   => display('select_option'),
                                    'A+' => 'A+',
                                    'A-' => 'A-',
                                    'B+' => 'B+',
                                    'B-' => 'B-',
                                    'O+' => 'O+',
                                    'O-' => 'O-',
                                    'AB+' => 'AB+',
                                    'AB-' => 'AB-'
                                    );
                                    //echo form_dropdown('blood_group', $bloodList, $data->blood_group, 'class="form-control" id="blood_group" '); 
                                ?>
                                <select name="blood_group" id="blood_group" class="form-control select2">
                                    <?php foreach($bloodList as $x => $x_val ){ ?>
                                        <option value="<?php echo $x_val; ?>" <?php if($patient->blood_group==$x_val){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <!-- Changes For Add Follow up Date -->
                        <div class="form-group row">
                            <label for="fol_up_date" class="col-xs-3 col-form-label"><?php echo "Follow Up Date"; ?></label>
                            <div class="col-xs-9">
                                <!--<input name="create_date" class="datepicker form-control" data-date-format="dd-mm-yyyy" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?//php echo ($patient->create_date != null )?  $patient->create_date : date_format($today,"d-m-Y"); ?>" required>-->
                                <?php $date=date_create($patient->fol_up_date);?>
                                <input name="fol_up_date" class="datepicker form-control" data-date-format="dd-mm-yyyy" type="text" placeholder="<?php echo "Follow Up Date"; ?>" id="fol_up_date"  value="<?php echo ($patient->fol_up_date != null )?  date_format($date,"d-m-Y") : NULL; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="ipd2">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group row">
                            <label for="anesthesia" class="col-xs-3 col-form-label"><?php echo display('anesthesia') ?></label>
                            <div class="col-xs-9">
                                <input name="anesthesia" type="text" class="form-control" id="anesthesia" placeholder="<?php echo display('anesthesia') ?>" value="<?php echo $patient->anesthesia ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doctor_id" class="col-xs-3 col-form-label"><?php echo display('doctor_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?//php echo form_dropdown('doctor_id','','','class="form-control col-xs-9" id="doctor_id" style="width: 411.997px;"') ?>-->
                                <select name="doctor_id" id="doctor_id" class="form-control select2 col-xs-9"></select>
                                <div id="availabel_days"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group row">
                            <label for="result" class="col-xs-3 col-form-label"><?php echo display('result') ?></label>
                            <div class="col-xs-9">
                                <input name="result" type="text" class="form-control" id="result" placeholder="<?php echo display('result') ?>" value="<?php echo $patient->result ?>" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row" style="margin-bottom: 30px; width: 100%;">
                        <div id="bedDataLabel"></div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer row" style="padding-left: 30px;" id="bedData">
                            
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="padding-left: 155px;">
                    <div class="col-sm-offset-3 col-sm-12" align="center">
                        <label class="col-sm-1"><?//php echo display('status') ?></label>
                        <div class="col-xs-3">
                            <!--<div class="form-check">-->
                            <!--    <label class="radio-inline">-->
                                  <!--<input type="radio" name="status" value="1" <?//php echo  set_radio('status', '1', TRUE); ?> >--><?//php echo display('active') ?>
                            <!--    </label>-->
                            <!--    <label class="radio-inline">-->
                                    <!--<input type="radio" name="status" value="0"  <?//php echo  set_radio('status', '0'); ?> >--><?//php echo display('inactive') ?>
                            <!--    </label>-->
                            <!--</div>-->
                            <input type="hidden" name="status" value="1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-offset-5 col-sm-6">
                        <div class="ui buttons">
                            <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                            <div class="or"></div>
                            <button class="ui positive button"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?> 
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        
                <div class="row">
                        <!--  table area -->
                    <div class="col-sm-12">
                    
                        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php if($flag==1){ echo base_url('patients/getpatientbydepartment_gob_date'); } else if($department_by=='dpt') { echo base_url('patients/getpatientbydepartment_date'); } else { echo base_url('patients/createPagePatientsData'); }?>">
                                                              
                         
                                <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
                        
                        
                        <div class="form-group">
                            
                            <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                        
                            <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
                        
                        </div>  
                        
                        <div class="form-group">
                        
                            <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                        
                            <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                           <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
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
                    
                                <div class="panel-body" style="font-size: 11px;">
                                    <div class="col-sm-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
	          	 </div> 
	          	 <div class="col-sm-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                     
                     
                     
                                        <?php   
                                              if($department_id){
                                                $dept_name=$this->db->select("*")
                    
                    			                ->from('department')
                    
                    			                ->where('dprt_id',$department_id)
                                                ->get()
                    
                    			                ->row();
                    			               
                    			               $name= $dept_name->name;
                                               } else{
                                                   
                                                   $name ='';
                                               }
                                               
                                               if($dept_id){
                                                $dept_name=$this->db->select("*")
                    
                    			                ->from('department')
                    
                    			                ->where('dprt_id',$dept_id)
                                                ->get()
                    
                    			                ->row();
                    			               
                    			                 $dept_name= $dept_name->name;
                                               } else{
                                                   
                                                   $dept_name ='';
                                               }
                                               
                                                   $ipd = ($patients[0]->ipd_opd);
                                                    
                                                    if($ipd =='ipd'){ ?>
                                        <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} elseif($gob=='gob'){ echo "GOB"; } else { echo "Central";} ?> Register of In Patient Department <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; } elseif($dept_name){ echo"(".$dept_name.")" ;}?></h3>
                                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                                        <?php }else{ ?>
                                            <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else { echo "Central"; }?> Register of Out Patient Department <?php  if($name) { echo "(".$name.")";}?></h3>
                                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                                         <?php  }  ?>
                                    
                                              <?php  if($summery_report == 0) { if($ipd == 'ipd') {?>
                                              <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                                              <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                                             <?php }
                                             if(!empty($department_id)){
                                             $doctor_name1= $this->db->select("*")
                                                        ->from('user')
                    			                       ->where('department_id', $department_id) 
                                                        ->get()
                                                        ->row();
                                             if(!empty($doctor_name1->firstname)){ ?>
                                             <lable style="float: right;">Doctor Name: <?php echo"<span style='font-weight: 600;'>".$doctor_name1->firstname."</span>"; ?></lable>
                                             <?php } } } ?>
                                             
                                             
                                    </div>
                                  <div class="col-sm-2"></div>
                                    <div class="row col-sm-12" style="padding-bottom: 10px;font-size: 14px;">
                                          <?php if($this->session->userdata('status')==0){?>
                                        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/checked_data'); ?>">
                                      <!--  <form  method="POST" action="<?php echo base_url('patients/checked_data'); ?>" >-->
                                        <div class="col-md-2" style="padding-top: 5px;">    
                                        <input type="radio" name="check" value="0" <?php if((empty($check_data)) || ($check_data[0]->check_date==0)) { echo "checked";}?>>Unchecked 
                                        <input type="radio" name="check" value="1"  <?php if((!empty($check_data)) && ($check_data[0]->check_date == 1)) { echo "checked";}?>>checked
                                          </div>
                                         <div class="col-md-2">
                                        <input type="date" name="start_date1" class="form-control" id="start_date1" style="width:155px; margin-left: -21px;">
                                        <input type="hidden" name="section" value="<?php if(($this->uri->segment(2) =='opd') || ($this->uri->segment(2)=='ipd')){ echo $this->uri->segment(2);} else { echo $_GET['section'];} ?>">
                                        </div>
                                        <div class="col-md-2">
                                        <input type="submit" name="submit" class="btn btn-default active" value="Save" style="margin-left: -41px;">
                                        </div>
                                        </form>
                                         <?php } ?>
                                        <!--<div style="float: right;" >
                                        <button onclick="excel_all_customer('<?php echo date('Y-m-d',strtotime($datefrom));?>','<?php echo date('Y-m-d',strtotime($dateto));?>','<?php echo $ipd;?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button>
                                        </div>-->
                                    </div>
                                </div>
                                
                                
                                <div style="margin: 0px;font-size: 11px;">
                                
                                
                                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?> style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px;" rowspan="2"><?php if($ipd == 'opd'){ echo "Yearly No"; } else { echo "S.No";} ?></th>
                                                <?php if($ipd == 'opd'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Daily No."; ?></th><?php } ?>   
                                                <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                                         
                                               
                                                <th style="width: 20px; text-align: center;" colspan="2" >
                                                    <?php echo "COPD" ?>
                                                </th> 
                                                
                                               
                                                <th rowspan="2"><?php echo "Patient Name" ?></th>   
                                                   <th style="width: 30px;" rowspan="2"><?php echo "Full Address"; ?></th>
                                                <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo "Age" ?></th> 
                                                <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo display('sex') ?></th> 
                                                <?php  if($ipd == 'opd'){ ?>  <th rowspan="2"><?php echo "Diagnosis"; ?></th> <?php } ?> 
                                             
                                               <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                                                <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd') { echo "Bed No";} else { echo "Remark";}?></th><?php } ?> 
                                                <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOA</th> <?php }?>
                                                 <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOD</th> <?php }?>
                                                 <?php  if($ipd == 'ipd'){ ?> <th style="width: 30px;" ><?php echo "Provisional Diagnosis" ?></th><?php }?>
                                                <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" ><?php echo "Final Diagnosis" ?></th> <?php } ?>
                                             
                                                <?php if(($department_by !='dpt') && ($ipd == 'ipd')) {?><th style="width: 30px;" rowspan="2"><?php echo "Name of Treating Dr.";?></th> <?php } ?>
                                              
                                                <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" ><?php echo "Sign. Of Incharge Sister" ?></th> <?php } ?>
                                               <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX1"?></th> <?php }?>  
                                               <?php if($department_by  =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX2"?></th> <?php }?>  
                                               <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX3"?></th> <?php }?>
                                               
                                               <?php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX4"?></th> <?php }?>  
                                               <?php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX5"?></th> <?php }?>
                                               
                                               <?php if(($department_by =='dpt') && ($gob !='gob')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php if($name=='Shalyatantra') { echo "SHASTRAKARMA";} elseif($name =='Shalakyatantra'){ echo "SHASTRAKARMA"; } else { echo "AASAN-I";}?></th> <?php }?>
                                               <?php if(($department_by =='dpt') && ($gob =='gob')) {?> <?php }?>
                                                
                                               <?php if(($department_by =='dpt') && ($gob !='gob')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php if($name=='Shalyatantra') { echo "VRANOPAKRAM";} elseif($name =='Shalakyatantra'){ echo "VRANOPAKRAM"; } else { echo "AASAN-II";}?></th> <?php }?>
                                              <?php if(($department_by =='dpt') && ($gob =='gob')) {?> <?php }?>
                                            
                                               <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SNEHAN"; ?></th> <?php }?>  
                                                <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SWEDAN"; ?></th> <?php }?>  
                                               <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "VAMAN"; ?></th> <?php }?>
                                              
                                               <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "VIRECHAN"; ?></th> <?php }?>
                                               <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "BASTI"; ?></th> <?php }?>  
                                               <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "NASYA"; ?></th> <?php }?>
                                               
                                                <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "RAKTAMOKSHAN"; ?></th> <?php }?>
                                               <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SHIRODHARA"; ?></th> <?php }?>  
                                               <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "OTHER"; ?></th> <?php }?>
                                    
                                               
                                                <?php   
                                                    
                                                 $ipd = ($patients[0]->ipd_opd);
                                                   if($ipd == 'ipd'){ ?>                                 
                                                            <!-- <th><?php echo "Ipd No"?></th> -->
                                                            <!-- <th style="width: 30px;"><?php echo "D. Date"?></th> -->
                                                  <?php  }  ?>
                                                     
                                                      
                                                <th class="no-print" rowspan="2"><?php echo display('action') ?></th> 
                                                                      
                                             </tr>
                                            <tr>                
                                               
                                                <th style="width: 30px;" >
                                                
                                                    <?php echo "New No" ?>
                                                </th> 
                                                <th style="width: 30px;"><?php echo "Old No" ?></th>
                                               
                                                                        
                                            </tr>
                                        </thead>
                                        <?php //print_r($patients);exit; ?>
                                        <tbody>
                                            <?php if (!empty($patients)) { ?>
                                                <?php $sl = 12141;
                                                $datefrom1=date('Y-m-d',strtotime($datefrom));
                                                $year1 = date('Y',strtotime($datefrom));
                                                $year2='%'.$year1.'%';
                                               
                                            $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); 
                                    	
                                    		$this->db->select('*');
                                            $this->db->where('ipd_opd', 'opd');
                                            $this->db->where('yearly_reg_no !=','');
                                            $this->db->where('create_date <=', $ddd);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query = $this->db->get('patient');
                                            $num = $query->num_rows();
                                          
                                    	    $this->db->select('*');
                                            $this->db->where('ipd_opd', 'opd');
                                            $this->db->where('old_reg_no !=','');
                                            $this->db->where('create_date <=', $ddd);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query = $this->db->get('patient');
                                            $num1 = $query->num_rows();
                                            
                                            $tot_serial1=$num + $num1;
                                            
                                             $this->db->select('*');
                                            $this->db->where('ipd_opd', 'ipd');
                                           // $this->db->where('old_reg_no !=','');
                                            $this->db->where('create_date <=', $ddd);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query = $this->db->get('patient_ipd');
                                            $num_ipd = $query->num_rows();
                                            
                                            $tot_serial_ipd=$num_ipd;
                                           
                                            // for department serial no
                                            
                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', 'opd');
                                            $this->db->where('yearly_reg_no !=','');
                                            $this->db->where('department_id =',$department_id);
                                            $this->db->where('create_date <=', $ddd);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query_d = $this->db->get('patient');
                                            $num_d = $query_d->num_rows();
                                           
                                    	    $this->db->select('*');
                                            $this->db->where('ipd_opd', 'opd');
                                            $this->db->where('old_reg_no !=','');
                                            $this->db->where('department_id =',$department_id);
                                            $this->db->where('create_date <=', $ddd);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query_dd = $this->db->get('patient');
                                            $num1_d = $query_dd->num_rows();
                                            
                                            
                                             $tot_serial1_d=$num_d + $num1_d;
                                             if($tot_serial1_d==0){
                                                 $tot_serial1_d=1;
                                             }
                                             else{
                                                 $tot_serial1_d =$tot_serial1_d + 1;
                                             }
                                            //
                                            
                                            
                                            ;
                                            $array_no=count($patients);
                                            $tot_serial=$tot_serial1 + $array_no + 1;
                                            
                                            $this->db->select('*');
                                           // $this->db->where('ipd_opd', 'opd');
                                            $this->db->where('discharge_date like','%0000-00-00%');
                                            $this->db->where('create_date <=', date('Y-m-d')." 23:59:00");
                                           // $this->db->where('create_date LIKE', $year2);
                                            $query = $this->db->get('patient_ipd');
                                            $num_ipd1 = $query->num_rows();
                                            //$num_ipd11=$num_ipd1 + 1;
                                            $attay_count= count($patients);
                                            //$num_ipd=  $num_ipd1 - $attay_count +1 ;
                                           
                                        if($department_by_section=='ipd'){
                                           //  $num_ipd=  $num_ipd1;
                                             $num_ipd=  1;
                                        }else{
                                            $num_ipd=  $num_ipd1 - $attay_count + 1 ;
                                        }
                                               
                                              
                                    ?>
                                                <?php $i = 0; 
                                                 $aa_mn=0;$aa_mo=0;$aa_fn=0;$aa_fo=0; $aa_tt=0; 
                                                 $ky_mn=0;$ky_mo=0;$ky_fn=0;$ky_fo=0; $ky_tt=0; $ky_ttn=0; $ky_ttan=0; $ky_ttdn=0; 
                                                 $pn_mn=0;$pn_mo=0;$pn_fn=0;$pn_fo=0; $pn_tt=0; $pn_ttn=0; $pn_ttan=0; $pn_ttdn=0;
                                                 $ba_mn=0;$ba_mo=0;$ba_fn=0;$ba_fo=0; $ba_tt=0; $ba_ttn=0;  $ba_ttan=0;  $ba_ttdn=0;
                                                 $sly_mn=0;$sly_mo=0;$sly_fn=0;$sly_fo=0; $sly_tt=0; $sly_ttn=0; $sly_ttan=0; $sly_ttdn=0;
                                                 $sky_mn=0;$sky_mo=0;$sky_fn=0;$sky_fo=0; $sky_tt=0; $sky_ttn=0; $sky_ttan=0; $sky_ttdn=0;
                                                 $st_mn=0;$st_mo=0;$st_fn=0;$st_fo=0; $st_tt=0; $st_ttn=0; $st_ttan=0; $st_ttdn=0;
                                                 $sw_mn=0;$sw_mo=0;$sw_fn=0;$sw_fo=0; $sw_tt=0;
                                                 
                                                  
                                                 foreach ($patients as $patient) { $i++;
                                                
                                                  $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                                                  $aa=date('Y-m-d', strtotime( $patient->create_date));
                                                 $dd12=date('Y-m-d', strtotime($_GET['end_date']));
                                                  if($_GET['end_date']){
                                                    $dd1=date('Y-m-d', strtotime($_GET['end_date']));
                                                  }else{
                                                     $dd1=date('Y-m-d');
                                                  }
                                                 
                                                //atya
                                                     if(($patient->sex=='M') && ($patient->department_id =='35') && ($patient->yearly_reg_no)){
                                                         $patient->discharge_date; 
                                                         if($dd != $dd1){
                                                          $aa_mn++; 
                                                       } else{}
                                                       
                                                      }
                                                     if(($patient->sex=='M') && ($patient->department_id =='35') && ($patient->old_reg_no)){
                                                        $aa_mo++; 
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='35') && ($patient->yearly_reg_no)){
                                                         if($dd != $dd1){
                                                        $aa_fn++; 
                                                         } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='35') && ($patient->old_reg_no)){
                                                            if($dd != $dd1){
                                                        $aa_fo++; 
                                                            } else{}
                                                         
                                                     }
                                                     
                                                     if($patient->department_id =='35'){
                                                           if($dd != $dd1){
                                                        $aa_tt++; 
                                                           } else{}
                                                         
                                                     }
                                                     //kay
                                                      if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->yearly_reg_no)){
                                                            if($dd != $dd1){
                                                        $ky_mn++; 
                                                      } else{}
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->old_reg_no)){
                                                           if($dd != $dd1){
                                                            $ky_mo++;   
                                                           } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->yearly_reg_no)){
                                                     if($dd != $dd1){ 
                                                        $ky_fn++; 
                                                     } else{}
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->old_reg_no)){
                                                        
                                                        if($dd != $dd1){ 
                                                        $ky_fo++;
                                                        } else{}
                                                         
                                                     }
                                                     
                                                     if($patient->department_id =='34'){
                                                         
                                                        if($dd != $dd1){      
                                                        $ky_tt++; 
                                                        if($aa != $dd1){
                                                           $ky_ttn++; 
                                                        }
                                                        } 
                                                        else if($dd == $dd1){
                                                            
                                                            $ky_ttdn++;
                                                        }
                                                        else if($aa == $dd1){
                                                            
                                                           // $ky_ttan++;
                                                        }
                                                        else{}
                                                        if($dd1==$aa){
                                                      
                                                          $ky_ttan++;
                                                        }
                                                     }
                                                     
                                                     //pan
                                                      if(($patient->sex=='M') && ($patient->department_id =='33') && ($patient->yearly_reg_no)){
                                                         if($dd != $dd1){      
                                                        $pn_mn++; 
                                                      } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='33') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){      
                                                        $pn_mo++;  
                                                         } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='33') && ($patient->yearly_reg_no)){
                                                          if($dd != $dd1){  
                                                        $pn_fn++;   
                                                          } else{} 
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='33') && ($patient->old_reg_no)){
                                                           if($dd != $dd1){  
                                                        $pn_fo++; 
                                                     } else{}
                                                         
                                                     }
                                                     
                                                     if($patient->department_id =='33'){
                                                           if($dd != $dd1){  
                                                        $pn_tt++; 
                                                         
                                                         if($aa != $dd1){
                                                           $pn_ttn++; 
                                                        }
                                                        } 
                                                        else if($dd == $dd1){
                                                            
                                                            $pn_ttdn++;
                                                        }
                                                        else if($aa == $dd1){
                                                            
                                                          //  $pn_ttan++;
                                                        }
                                                           else{}
                                                           if($dd1==$aa){
                                                      
                                                          $pn_ttan++;
                                                        }
                                                           
                                                         
                                                     }
                                                     
                                                      //bal
                                                      if(($patient->sex=='M') && ($patient->department_id =='32') && ($patient->yearly_reg_no)){
                                                           if($dd != $dd1){ 
                                                        $ba_mn++; 
                                                      } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='32') && ($patient->old_reg_no)){
                                                            if($dd != $dd1){ 
                                                        $ba_mo++; 
                                                            } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='32') && ($patient->yearly_reg_no)){
                                                           if($dd != $dd1){ 
                                                        $ba_fn++;   
                                                     } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='32') && ($patient->old_reg_no)){
                                                           if($dd != $dd1){ 
                                                        $ba_fo++;
                                                           } else{}
                                                         
                                                     }
                                                     
                                                     if($patient->department_id =='32'){
                                                         if($dd != $dd1){ 
                                                        $ba_tt++; 
                                                     if($aa != $dd1){
                                                           $ba_ttn++; 
                                                        }
                                                        } 
                                                        else if($dd == $dd1){
                                                            
                                                            $ba_ttdn++;
                                                        }
                                                        else if($aa == $dd1){
                                                            
                                                          //  $ba_ttan++;
                                                        } 
                                                     else{}
                                                     
                                                      if($dd1==$aa){
                                                      
                                                         $ba_ttan++;
                                                        }
                                                           
                                                         
                                                     }
                                                     
                                                       //sly
                                                      if(($patient->sex=='M') && ($patient->department_id =='31') && ($patient->yearly_reg_no)){
                                                          if($dd != $dd1){ 
                                                        $sly_mn++; 
                                                          } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='31') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sly_mo++; 
                                                     } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='31') && ($patient->yearly_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sly_fn++; 
                                                         } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='31') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sly_fo++;
                                                         } else{}
                                                         
                                                     }
                                                     
                                                     if($patient->department_id =='31'){
                                                        if($dd != $dd1){ 
                                                        $sly_tt++;
                                                        if($aa != $dd1){
                                                           $sly_ttn++; 
                                                        }
                                                        } 
                                                        else if($dd == $dd1){
                                                            
                                                            $sly_ttdn++;
                                                        }
                                                        else if($aa == $dd1){
                                                            
                                                         //   $sly_ttan++;
                                                        } 
                                                        else{}
                                                        
                                                          if($dd1==$aa){
                                                      
                                                         $sly_ttan++;
                                                        }
                                                         
                                                     }
                                                
                                                  //sky
                                                      if(($patient->sex=='M') && ($patient->department_id =='30') && ($patient->yearly_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sky_mn++; 
                                                         } else{}
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='30') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sky_mo++;
                                                         } else{}
                                                         
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='30') && ($patient->yearly_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sky_fn++;   
                                                         } else{}
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='30') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $sky_fo++; 
                                                         } else{}
                                                     }
                                                     
                                                     if($patient->department_id =='30'){
                                                        if($dd != $dd1){ 
                                                        $sky_tt++; 
                                                         if($aa != $dd1){
                                                           $sky_ttn++; 
                                                        }
                                                        } 
                                                        else if($dd == $dd1){
                                                            
                                                            $sky_ttdn++;
                                                        }
                                                        else if($aa == $dd1){
                                                            
                                                           // $sky_ttan++;
                                                        } 
                                                        else{}
                                                          if($dd1==$aa){
                                                      
                                                         $sky_ttan++;
                                                        }
                                                     }
                                                
                                                
                                                  //st
                                                      if(($patient->sex=='M') && ($patient->department_id =='29') && ($patient->yearly_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $st_mn++; 
                                                         } else{}
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='29') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $st_mo++;   
                                                         } else{}
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='29') && ($patient->yearly_reg_no)){
                                                        if($dd != $dd1){ 
                                                        $st_fn++;   
                                                        } else{}
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='29') && ($patient->old_reg_no)){
                                                         if($dd != $dd1){ 
                                                        $st_fo++;  
                                                         } else{}
                                                     }
                                                     
                                                     if($patient->department_id =='29'){
                                                        if($dd != $dd1){ 
                                                        $st_tt++; 
                                                         if($aa != $dd1){
                                                           $st_ttn++; 
                                                        }
                                                        } 
                                                        else if($dd == $dd1){
                                                            
                                                            $st_ttdn++;
                                                        }
                                                        else if($aa == $dd1){
                                                            
                                                           // $st_ttan++;
                                                        }
                                                         else{}
                                                         
                                                          if($dd1==$aa){
                                                      
                                                         $st_ttan++;
                                                        }
                                                     }
                                                     
                                                       //sw
                                                      if(($patient->sex=='M') && ($patient->department_id =='28') && ($patient->yearly_reg_no)){
                                                        if($dd != $dd1){ 
                                                        $sw_mn++; 
                                                        } else{}
                                                     }
                                                     if(($patient->sex=='M') && ($patient->department_id =='28') && ($patient->old_reg_no)){
                                                        if($dd != $dd1){ 
                                                        $sw_mo++;   
                                                        } else{}
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='28') && ($patient->yearly_reg_no)){
                                                        if($dd != $dd1){ 
                                                        $sw_fn++;   
                                                        } else{}
                                                     }
                                                     if(($patient->sex=='F') && ($patient->department_id =='28') && ($patient->old_reg_no)){
                                                        if($dd != $dd1){ 
                                                        $sw_fo++;  
                                                        } else{}
                                                     }
                                                     
                                                     if($patient->department_id =='28'){
                                                         if($dd != $dd1){ 
                                                        $sw_tt++; 
                                                         } else{}
                                                     } 
                                                
                                                
                                                      $date_c=date('Y-m-d',strtotime($patient->create_date));
                                                      $date_d=date('Y-m-d',strtotime($patient->discharge_date));
                                                      $date_f= date('Y-m-d', strtotime($dateto));
                                                      $tot_serial--;
                                                      $tot_serial1++; 
                                                      $tot_serial_ipd++;
                                                      
                                                      $date_f1=date('Y-m-d',strtotime($dateto));
                                                      $date_f2='%'.$date_f1.'%';
                                                       $opd_ipd_p=$this->db->select("*")
                                    
                                                         ->from('patient_ipd')
                                    
                                                          ->where('yearly_reg_no',$patient->yearly_reg_no)
                                                          ->where('old_reg_no ',$patient->old_reg_no)
                                                         ->where('create_date LIKE',$date_f2)
                                                         ->get()
                                                         ->row();
                                                         //print_r($opd_ipd_p);
                                                         $New_OPD=$opd_ipd_p->yearly_reg_no;
                                                         $old_OPD= $opd_ipd_p->old_reg_no;
                                                     
                                                       if($ipd == 'ipd'){ 
                                                             $che=trim($patient->dignosis);
                                                            $section_tret='ipd';
                                                             $len=strlen($che);
                                                             $dd= substr($che,$len - 1);
                                                             
                                                             $str = $patient->dignosis;
                                                             $arry=explode("-",$str);
                                                             $t_c=count($arry);
                                                             
                                                            if($t_c=='2'){
                                                               $dd1=substr($che, 0, -1);
                                                                $p_dignosis = '%'.$arry[0].'%';
                                                                 trim($p_dignosis);
                                                                 $p_dignosis_name=$patient->dignosis;
                                                          }else{
                                                              
                                                              $p_dignosis = '%'.$che.'%';
                                                                $p_dignosis_name=$patient->dignosis;
                                                                
                                                          }
                                                           
                                                        }
                                                        else{
                                                             $section_tret='opd';
                                                              $che=trim($patient->dignosis);
                                                            $section_tret='opd';
                                                             $len=strlen($che);
                                                             $dd= substr($che,$len - 1);
                                                             
                                                             $str = $patient->dignosis;
                                                             $arry=explode("-",$str);
                                                             $t_c=count($arry);
                                                              if($t_c=='2'){
                                                                    $dd1=substr($che, 0, -1);
                                                                    
                                                                $p_dignosis = '%'.$arry[0].'%';
                                                                             trim($p_dignosis);
                                                                 $p_dignosis_name=$patient->dignosis;
                                                          }else{
                                                               //echo $dd;
                                                               
                                                               $p_dignosis = '%'.$che.'%';
                                                                $p_dignosis_name=$patient->dignosis;
                                                                
                                                                
                                                          }
                                                        }
                                                        
                                                        
                                                        
                                                         /*$ss=date('Y-m-d',strtotime($dateto));
                                                        if($ss <= '202-01-28'){
                                                            $table='treatments';
                                                        }else{
                                                            
                                                             $table='treatments1';
                                                        }
                                                        */
                                                        
                                                     if($patient->manual_status==0){
                                                          if($patient->proxy_id){
                                                          
                                                         
                                                         $tretment=$this->db->select("*")
                                    
                                                         ->from('treatments1')
                                                         ->where('dignosis LIKE',$p_dignosis)
                                                         ->where('proxy_id',$patient->proxy_id)
                                                         ->where('department_id',$patient->department_id)
                                                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();
                                                          }
                                                          else{
                                                              
                                                           $tretment=$this->db->select("*")
                                    
                                                         ->from('treatments1')
                                                         ->where('dignosis LIKE',$p_dignosis)
                                                          ->where('department_id',$patient->department_id)
                                                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();  
                                                         
                                                          if(empty($tretment)){
                                                          $tretment=$this->db->select("*")
                                                           ->from('treatments1')
                                                          ->where('department_id',$patient->department_id)
                                                          ->where('ipd_opd',$patient->department_id)
                                                         ->get()
                                                         ->row();   
                                                             
                                                           }
                                                          }
                                                      }else{
                                                          $tretment=$this->db->select("*")
                                                          ->from('manual_treatments')
                                                         ->where('patient_id_auto',$patient->id)
                                                         ->where('dignosis LIKE',$p_dignosis)
                                                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();
                                                       }
                                                        
                                                      
                                                      $RX1= $tretment->RX1;
                                                      $RX2= $tretment->RX2;
                                                      $RX3= $tretment->RX3;
                                                      $RX4= $tretment->RX4;
                                                      $RX5= $tretment->RX5;
                                                      
                                                      $Only_1st_Dose= $tretment->Only_1st_Dose;
                                                      
                                                      $KARMA= $tretment->KARMA;
                                                      $PK1= $tretment->PK1;
                                                      $PK2= $tretment->PK2;
                                                      $SWA1= $tretment->SWA1;
                                                      $SWA2= $tretment->SWA2;
                                                       
                                                      $s_s= $tretment->skarma;
                                                      $s_v= $tretment->vkarma;
                                                      
                                                    
                                                      
                                                      
                                                       $SNEHAN= $tretment->SNEHAN;
                                                     
                                                      
                                                      $SWEDAN= $tretment->SWEDAN;
                                                      $VAMAN= $tretment->VAMAN;
                                                      
                                                      $VIRECHAN= $tretment->VIRECHAN;
                                                      $BASTI= $tretment->BASTI;
                                                      $NASYA= $tretment->NASYA;
                                                      
                                                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
                                                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
                                                      $OTHER= $tretment->OTHER;
                                                      
                                                     
                                                      
                                                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                                      
                                                      $X_RAY= $tretment->X_RAY;
                                                      $ECG= $tretment->ECG;
                                                      
                                                      
                                                     $datefrom_n=date('Y-m-d',strtotime($datefrom));  
                                                      
                                                     $admit_date=date('Y-m-d',strtotime($patient->create_date));
                                                     if($patient->discharge_date=='0000-00-00'){
                                                         //$discharge_date=date('Y-m-d', strtotime($admit_date. ' + 5 days'));
                                                         
                                                         $today_date=date('Y-m-d', strtotime($datefrom_n));
                                                     } else{
                                                     //$discharge_date=date('Y-m-d',strtotime($patient->discharge_date));
                                                      $today_date=date('Y-m-d', strtotime($datefrom_n));
                                                     }  
                                                     
                                                        $date1=date_create($admit_date);
                                                        $date2=date_create($today_date);
                                                        $diff=date_diff($date1,$date2);
                                                        $n= $diff->format("%a");
                                                        
                                                     $DISTRIBUTION_IPD=$tretment->DISTRIBUTION_IPD; 
                                                     $ipd_days=$tretment->ipd_days; 
                                                     $last_days=$ipd_days - $DISTRIBUTION_IPD;
                                                     $DISTRIBUTION_IPD=$DISTRIBUTION_IPD - 1; 
                                                     if(($DISTRIBUTION_IPD < $n) && ($ipd == 'ipd')){
                                                         
                                                         
                                                         if($patient->manual_status==0){
                                                          if($patient->proxy_id){
                                                          
                                                         
                                                         $tretment=$this->db->select("*")
                                    
                                                         ->from('treatments1')
                                                         ->where('dignosis LIKE',$p_dignosis)
                                                         ->where('proxy_id',$patient->proxy_id)
                                                         ->where('department_id',$patient->department_id)
                                                         ->order_by("id", "desc")
                                                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();
                                                          }
                                                          else{
                                                              
                                                           $tretment=$this->db->select("*")
                                    
                                                         ->from('treatments1')
                                                         ->where('dignosis LIKE',$p_dignosis)
                                                          ->where('department_id',$patient->department_id)
                                                          ->order_by("id", "desc")
                                                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();  
                                                         
                                                          if(empty($tretment)){
                                                          $tretment=$this->db->select("*")
                                                           ->from('treatments1')
                                                          ->where('department_id',$patient->department_id)
                                                          ->where('ipd_opd',$patient->department_id)
                                                         ->get()
                                                         ->row();   
                                                             
                                                           }
                                                          }
                                                      }else{
                                                          $tretment=$this->db->select("*")
                                                          ->from('manual_treatments')
                                                         ->where('patient_id_auto',$patient->id)
                                                         ->where('dignosis LIKE',$p_dignosis)
                                                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();
                                                       }
                                                         
                                                      $RX1= $tretment->RX1;
                                                      $RX2= $tretment->RX2;
                                                      $RX3= $tretment->RX3;
                                                      $RX4= $tretment->RX4;
                                                      $RX5= $tretment->RX5;
                                                         
                                                         
                                                     }
                                                      
                                                      
                                                      // patient ipd yearly no
                                                      $ipd_no_date=date('Y-m-d',strtotime($patient->create_date));
                                                      $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                                      $year122=date('Y',strtotime($patient->create_date));
                                                      $year2='%'.$year122.'%';
                                    
                                                      $this->db->select('*');
                                                      $this->db->where('ipd_opd', 'ipd');
                                                      $this->db->where('id <', $patient->id);
                                                     // $this->db->where('create_date <=', $d_ipd_no);
                                                      $this->db->where('create_date LIKE', $year2);
                                                      $query = $this->db->get('patient_ipd');
                                                      $num_ipd_change = $query->num_rows();
                                    		          $tot_serial_ipd_change=$num_ipd_change;
                                    		          $tot_serial_ipd_change++;
                                                  ?>
                                                  
                                                    <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else if(($New_OPD ==$patient->yearly_reg_no) && ($old_OPD == $patient->old_reg_no) && ($ipd == 'opd')){ echo "color: #ff000d;font-weight: bold;"; } else { echo ""; } ?>">
                                                        <?php if($getpatientbydepartment_date =='D'){ ?>
                                                        <td style="padding:2px;"><?php echo $tot_serial1_d++; ?></td>
                                                        <?php } else {?>
                                                        <td style="padding:2px;"><?php if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; }} ?></td>
                                                        <?php if($ipd == 'opd'){ ?> <td style="padding:2px;"><?php echo $i; ?></td><?php } ?>   
                                                           
                                                        <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;} ?></td> <?php } ?>  
                                                         <!-- //patient_id yearly sr no -->                                                                       
                                                        <!-- <td><?php echo $patient->daily_reg_no; ?></td> -->
                                                        <!-- <td><?php echo $patient->monthly_reg_no; ?></td>  -->
                                                        <?php 
                                                        $date=date('Y',strtotime($patient->create_date));
                                                        $dot_year=substr($date,2);
                                                         $explode=explode('.',$patient->old_reg_no);
                                                       //print_r($import);
                                                        $explode[1];
                                                         ?>
                                                       <!-- <td  style="padding:2px;"><?php if($patient->yearly_reg_no) { echo $patient->yearly_reg_no.".".$dot_year;} ?></td>
                                                        <td  style="padding:2px;"><?php if($patient->old_reg_no) { echo $patient->old_reg_no; if($explode[1]==''){echo ".".$dot_year;}}?>
                                                                                     -->
                                                                                     
                                                       <td>
                                                    <?php
                                                    $year = $this->session->userdata['acyear'];
                                    
                                                   $y=date('Y',strtotime($patient->create_date));
                                                   if($y=='1970'){
                                                       $y=$year;
                                                       $yy=substr($y,2,2);
                                                   }else{
                                                   $yy=substr($y,2,2);
                                                   }
                                                     if($patient->yearly_reg_no != null){
                                                        echo 	$yearly_reg_no= $patient->yearly_reg_no.".".$yy;
                                                       // echo ".".$yy."(New)";
                                                    } else {
                                                       
                                                    } ?>
                                                    </td>
                                                    
                                                    <td>
                                                    <?php
                                                    
                                                   $y=date('Y',strtotime($patient->create_date));
                                                   if($y=='1970'){
                                                       $y=$year;
                                                       $yy=substr($y,2,2);
                                                   }else{
                                                   $yy=substr($y,2,2);
                                                   }
                                                     if($patient->yearly_reg_no != null){
                                                       
                                                    } else {
                                                       echo	$old_reg_no= $patient->old_reg_no.".".$yy;
                                                        //echo  ".".$yy."(Old)";
                                                    } ?>
                                                    </td>
                                                        <!--<td><?php echo $patient->ipd_no?></td>-->
                                                        
                                                        <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>    
                                                        <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                                       
                                                        <td  style="padding:2px;"><?php 
                                                        echo $patient->date_of_birth;   
                                                        ?></td> 
                                                        <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                                     <?php  if($ipd == 'opd'){ ?>  <td><?php  echo $p_dignosis_name;?></td> <?php }?>
                                                       <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                                        <?php if($department_by !='dpt') {?> <td  style="padding:2px;"><?php if($ipd == 'ipd') { echo $patient->bedNo;} else{ echo "";}?></td> <?php } ?>
                                                        <?php  if($ipd == 'ipd'){ ?>  <td><?php  echo date('Y-m-d',strtotime($patient->create_date));?></td> <?php }?>
                                                          <?php  if($ipd == 'ipd'){ ?>  <td><?php   if($patient->discharge_date=='0000-00-00'){ echo '';} else { echo date('Y-m-d',strtotime($patient->discharge_date));}?></td> <?php }?>
                                                        <?php  if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  echo $p_dignosis_name; ?></td> <?php } ?>
                                                       <?php if($ipd == 'ipd'){ ?>  <td  style="padding:2px;"><?php  if($tretment->POVISIONALdignosis) { echo $tretment->POVISIONALdignosis; } else { echo $p_dignosis_name;} ?></td> <?php } ?> 
                                                       
                                                          <?php 
                                                           // $join_date=date('Y-m-d',strtotime($patient->join_date));
                                                           // $Reliving_date=date('Y-m-d',strtotime($patient->Reliving_date));
                                                            $datefrom1=date('Y-m-d',strtotime($datefrom));
                                                            
                                                           $doctor_name= $this->db->select("*")
                                                          ->from('user')
                                                           //->where('join_date <=', $datefrom1) 
                                                          ->where('department_id', $patient->department_id) 
                                                           ->order_by("user_id", "desc")
                                                         ->limit(1)
                                                          ->get()
                                                          ->row();
                                                           $doctor_name->firstname;
                                                          
                                                          if(empty($doctor_name)){
                                                              $doctor_name= $this->db->select("*")
                                                          ->from('user')
                                                          
                                                          ->where('department_id', $patient->department_id) 
                                                          ->get()
                                                          ->row();
                                                          }
                                                         ?>
                                                          <?php if(($department_by !='dpt') && ($ipd == 'ipd')){?>
                                                        <td  style="padding:2px;"><?php  echo $doctor_name->firstname;?></td><?php } ?>
                                                        
                                                         
                                                         <?php if($ipd == 'ipd'){ ?>  <td  style="padding:2px;"><?php  echo ''; ?></td> <?php } ?> 
                                                         
                                                         <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php  if(($Only_1st_Dose) && ($n==0)) { echo $Only_1st_Dose." "; } echo $RX1; ?></td> <?php } ?>  
                                                          <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX2; ?></td>  <?php }?> 
                                                           <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX3; ?></td>  <?php }?>
                                                           
                                                            <?php  if(($ipd == 'ipd') && ($department_by =='dpt')){?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX4; ?></td>  <?php }?> 
                                                             <?php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX5; ?></td>  <?php }?> 
                                                             
                                                             <?php  if(($department_by =='dpt') && ($gob !='gob')) {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php  if($name=='Shalyatantra') { $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){echo $s_s; }} elseif($name=='Shalakyatantra'){ $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){echo $s_s; } } else { echo $SWA1;}?></td>  <?php }?>
                                                             <?php if(($department_by =='dpt') && ($gob =='gob')) { }?>
                                                              <?php if(($department_by =='dpt') && ($gob !='gob')) {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php if($name=='Shalyatantra') { echo $s_v;} elseif($name=='Shalakyatantra'){ echo $s_v; } else { echo $SWA2;} ?></td>  <?php }?> 
                                                              <?php if(($department_by =='dpt') && ($gob =='gob')) { }?>
                                                          <!--  <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $KARMA; ?></td> <?php } ?>-->  
                                                         <!-- <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK1; ?></td>  <?php }?> 
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK2; ?></td>  <?php }?> -->
                                                            <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SNEHAN; ?></td>  <?php }?> 
                                                            <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SWEDAN; ?></td>  <?php }?> 
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $VAMAN;  ?></td>  <?php }?>
                                                           
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $VIRECHAN; ?></td>  <?php }?> 
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $BASTI;  ?></td>  <?php }?>
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $NASYA; ?></td>  <?php }?> 
                                                           
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $RAKTAMOKSHAN; ?></td>  <?php }?> 
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SHIRODHARA_SHIROBASTI;  ?></td>  <?php }?>
                                                           <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $OTHER; ?></td>  <?php }?> 
                                                            
                                                        <?php                       
                                                            if($patient->ipd_opd == 'ipd'){ ?>                                   
                                                                    <!-- <td><?php echo $patient->ipd_no?></td> -->
                                                                    <!-- <td><?php 
                                    
                                                                    //echo 'dd',$patient->discharge_date; 
                                                                    
                                                                    if($patient->discharge_date != ''){
                                                                    // echo date("d/m/Y", strtotime($patient->discharge_date)); 
                                                                    }
                                                                    
                                                                    ?></td>                                                                                             -->
                                                            <?php }   ?>
                                                            
                                                            
                                                        <td class="center no-print"  style="padding:2px;">
                                                            <?php 
                                                                if($patient->ipd_opd == 'ipd'){ ?>
                                                                    <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                                     <a href="<?php echo base_url("patients/edit_ipd/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                                                <?php }else { ?>
                                                                    
                                                                    <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                                                     <a href="<?php echo base_url("patients/edit_ipd/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                                                <?php } ?>
                                                           
                                                           <!-- <a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> -->
                                                        </td>                                     
                                                    </tr>
                                                    <?php $sl++; ?>
                                                <?php } ?> 
                                            <?php } ?> 
                                        </tbody>
                                    </table>  <!-- /.table-responsive -->
                                    <!-- Table Summery -->
                                </div>
                            </div>
                            
                            
                        </div>
                </div>


<!-- OTP Submission -->
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog" >
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add patient discharge date</h4>
                                </div>
								<?php ?>
                                <div class="modal-body">
                                    <div class="row">

                                        <form id="otp_confirm_form" name="otp_confirm_form" method="POST">
                                            <div class="col-xs-12">
                                                <label>Enter patient reg no</label>
                                                <input type="text" id="yearly_reg_no" name="yearly_reg_no" class="form-control"  autocomplete="off" />
												<div id="error_otp"></div>
                                            </div>

                                            <div class="col-xs-12">
                                                <label>Discharge Date</label>
                                                <input type="text" id="discharge_date" name="discharge_date" class="form-control datepicker"  autocomplete="off" />
												<div id="error_otp"></div>
                                            </div>



                                            <div class="col-xs-12" style="margin-top: 20px">
                                                <button type="button" name="dischargedate" class="btn btn-primary" value="dischargedate" id="dischargedate">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

            
    </div>
</div>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
<script type="text/javascript">

    function bedSelection(){
        var checkipdopd = document.getElementById("ipd_opd").value;
        //$('#bedData').empty();
        //console.log(checkipdopd);
        if(checkipdopd == 'ipd'){
            //$('#bedData').empty();
            var deptId = $('#department_id').val();
            var sex = $("input[name='sex']:checked").val();
            //console.log(deptId + " == " + sex);
            $.ajax({
               url  : '<?= base_url('bed_manager/bed/getBedDataByDeptGen') ?>',
               type : 'post',
               dataType : 'JSON',
               data : {
                   '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                   department_id : deptId,
                   sex : sex
               },
               success : function(res) 
               {
                   //console.log(res);
                   $('#bedData').empty();
                   //if()
                    //$("#bedDataLabel").append('<label>Select Bed Number</label>');
                    var htmlDiv='<label><?php echo display('bedNo') ?></label>';
                    $('#bedDataLabel').html(htmlDiv);
                    for(var i = 0; i < res.length; i++){
                        if(res[i].status == 1){
                            var style = 'style="text-align:center; width: 20%; background-color: #ff0000ba; color : #ffffff"';
                            var style1 = 'disabled = true';
                        }
                        else{
                            var style = 'style="text-align:center; width: 20%;"';
                            var style1 = '';
                        }
                        let deptName = res[i].name;
                        var short_name;
                        if(deptName == 'Shalyatantra'){
                            short_name = 'SLY';
                        } else if(deptName == 'Shalakyatantra'){
                            short_name= 'SKY';
                        } else if(deptName == 'Camp'){
                            short_name= 'CAMP';
                        }else {
                            short_name= deptName.substr(0,3);
                        }
                        let str;
                        if(deptName == 'Camp'){
                            
                            str =  short_name;
                        }
                        else{
                            str =  short_name + " " + res[i].gender;
                        }
                        
                        var htmlData = '<div class="col-md-3 form-control" id="bedDataLabel"' + style + '>';
                            htmlData += '<label class="radio-inline">';
                            htmlData += '<input type="radio" name="bedNo"  id="bedNo" value ="' + res[i].id + '"'  + style1 + '>';
                            htmlData += '<span style="margin-left: 10px;font-weight: 800;">'+ res[i].id + '</span>'+ ' (' + str.toUpperCase() + ')';
                            htmlData += '</label>';
                            htmlData += '</div>';
                        $('#bedData').append(htmlData);
                    }
               }, 
               error : function()
               {
                   //alert('failed');
               }
           });
        }
    }
    
    function validateSexOnDepartment(){
        //32 Validate Age Feild on Balroga Department
        //29 Set Female sex on Striroga
        var deptId = $('#department_id').val();
        if(deptId == '29'){
            $("input[name=sex][value='F']").prop('checked', true);
            $("input[name=sex][value='M']").prop('disabled', true);
        }
        else{
            $("input[name=sex]").prop({
                'disabled': false,
            });
        }
    }
    function validateAgeOnDepartment(){
        var deptId = $('#department_id').val();
        var age = $('#date_of_birth').val();
        if(deptId == '32'){
            if(age > 15 || age < 0){
                alert('Age should be less then 15 for Balroga');
                $('#date_of_birth').val('');
                $('#department_id').val(null);
                $('#department_id').select2().trigger('change');
            }
        }
    }
    
    $(document).ready(function() {
        
       /* $.ajax({
            url  : '<?= base_url('patients/getDistinctTreatment/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                //old_reg_no : pid.val(),
                department_id : $('#department_id').val(),
                id : $( "input[name='id']" ).val(),
                opd_no : $("#old_reg_no" ).val(),
                update_old_reg_no : $('#update_old_reg_no').val(),
                ipd_opd : $('#ipd_opd').val(),
            },
            success : function(data)
            {
                //console.log(data);
                // alert(data.patient1);
                $('#dignosis').empty();
                var selectedDiagno = '';
                if (data) {
                    var diagnosisArr = data.diagnosisArr;
                    var petientDignosis = data.patientDiagnosis;
                    for(var i=0; i<diagnosisArr.length; i++){
                        //console.log(diagnosisArr[i].dignosis);
                        //console.log(petientDignosis['dignosis']);
                        
                        if(diagnosisArr[i].dignosis==petientDignosis['dignosis']){
                            $('#dignosis').append(
                                '<option value="' + diagnosisArr[i].dignosis + '" selected>' + diagnosisArr[i].dignosis + '</option>'
                            );
                        }else{
                            $('#dignosis').append(
                                '<option value="' + diagnosisArr[i].dignosis + '">' + diagnosisArr[i].dignosis + '</option>'
                            );
                        }
                    }
                }
                    
            }, 
            error : function()
            {
                //alert('failed');
            }
        });*/
        
        
        $('#doctor_id').val(<?php echo $patient->doctor_id;?>);
        $('#doctor_id').select2().trigger('change');
        
        // on first focus (bubbles up to document), open the menu
        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
          $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        });
        
        // steal focus during close - only capture once and stop propogation
        $('select.select2').on('select2:closing', function (e) {
          $(e.target).data("select2").$selection.one('focus focusin', function (e) {
            e.stopPropagation();
          });
        });
        
        // if($('#old_reg_no1').val() != ''){
        //     $('#yearly_reg_no').val('').prop("readonly", true);
        // }
        // else if($('#old_reg_no1').val() == ''){
        //     $('#yearly_reg_no').val('').prop("readonly", false);
        // }
        $('#old_reg_no1').on('keyup', function(){
            if($('#old_reg_no1').val() != ''){
                $('#yearly_reg_no').val('').prop("readonly", true);
            }
            else if($('#old_reg_no1').val() == ''){
                $('#yearly_reg_no').val('').prop("readonly", false);
            }
        })
        
        $('#date_of_birth').on('keyup change', function(){
            validateAgeOnDepartment();
        });
        $('#department_id').change(function(){
            bedSelection();
            validateSexOnDepartment();
            validateAgeOnDepartment();
            
        });
        $("input[name='sex']").change(function(){
            bedSelection();
        });
        
        
        //check patient id start
        $('#old_reg_no').keyup(function(){
            //$('#bedData').empty();
            //var pid = $(this);
            var pid = $('#old_reg_no').val();
            var acyear = $("#acyear").val();
        ////console.log(pid + " " + acyear);
            $.ajax({
                url  : '<?= base_url('patients/check_patient/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    //old_reg_no : pid.val(),
                    old_reg_no : pid,
                    acyear : acyear
                },
                success : function(data)
                {
                    //console.log(data.patient);
                    // alert(data.patient1);
                    if (data.status == true) {
                        
                        $('#last_date').val(data.patient.create_date);
                        //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                        //$('#yearly_no').val(data.patient.yearly_no);
                        $('#patient_name').val(data.patient.firstname);
                        $('#firstname').val(data.patient.firstname);
                        //$('#blood_group').val(data.patient.blood_group);
                        $('#blood_group').val(data.patient.blood_group);
                        $('#blood_group').select2().trigger('change');
                        $('#date_of_birth').val(data.patient.date_of_birth);
                        $('#degis_id').val(data.patient.degis_id);
                        //$('#sex').val(data.patient.sex);
                        // if(data.patient.sex == 'M'){
                        //     var gender = 'Male';
                        // }
                        // else{
                        //     var gender = 'Female';
                        // }
                        $("input[name=sex][value='" + data.patient.sex + "']").prop('checked', true);
                        //$('#department_id').val(data.patient.department_id).attr("selected", "true");
                        $('#department_id').val(data.patient.department_id);
                        $('#department_id').select2().trigger('change');
                        //$('#dignosis').val(data.patient.dignosis);
                        $('#dignosis').val(data.patient.dignosis);
                        //$('#dignosis').select2().trigger('change');
                        //$('#occupation').val(data.patient.occupation);
                        $('#occupation').val(data.patient.occupation);
                        $('#occupation').select2().trigger('change');
                        //$('#address').val(data.patient.address);
                        $('#address').val(data.patient.address);
                        $('#address').select2().trigger('change');
                        $('#weight').val(data.patient.wieght);
                        //$('#create_date').val(data.patient.create_date);
                        if($('#ipd_opd').val() == 'ipd'){
                            var d = new Date();
                        }
                        else if($('#ipd_opd').val() == 'opd' && $('#status1').val() == 'old'){
                            var d = new Date();
                        }
                        else{
                            var d = new Date(data.patient.create_date);
                        }
                        var day = d.getDate();
                        var month = d.getMonth()+1;
                        var year = d.getFullYear();
                        var date = day + '-' + month + '-' + year;
                        $('#create_date').val(date);
                        
                        if(data.patient.create_date != null || data.patient.create_date!=''){
                            var d1 = new Date(data.patient.create_date);
                            var day1 = d1.getDate();
                            var month1 = d1.getMonth()+1;
                            var year1 = d1.getFullYear();
                            var date1 = day1 + '-' + month1 + '-' + year1;
                        }
                        else{
                            var date1 = '';
                        }
                        $('#fol_up_date').val(date1);
                        
                        //$("input[name=bedNo][value=" + value + "]").attr('checked', 'checked');
                    } else if (data.status == false) {
                        pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                    } else {
                        pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                    }
                }, 
                error : function()
                {
                    //alert('failed');
                }
            });
        });
        //check patient id end
        
        //NEW  PATIENT DATA START
        $('#patient_name').keyup(function(){
            //$('#bedData').empty();
            //var pid = $(this);
            var patient_name = $('#patient_name').val();
            var acyear = $("#acyear").val();
           // console.log(pid + " " + acyear);
            $.ajax({
                url  : '<?= base_url('patients/check_patient_new/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    //old_reg_no : pid.val(),
                    patient_name : patient_name,
                    acyear : acyear
                },
                success : function(data)
                {
                    
                    
                    // alert(data.patient1);
                    if (data.status == true) {
                        
                        console.log(data.patient.yearly_no);
                        
                        $('#last_date').val(data.patient.create_date);
                        $('#old_reg_no').val(data.patient.yearly_no);
                        //$('#yearly_no').val(data.patient.yearly_no);
                        $('#firstname').val(data.patient.firstname);
                        //$('#blood_group').val(data.patient.blood_group);
                        $('#blood_group').val(data.patient.blood_group);
                        $('#blood_group').select2().trigger('change');
                        $('#date_of_birth').val(data.patient.date_of_birth);
                        $('#degis_id').val(data.patient.degis_id);
                        //$('#sex').val(data.patient.sex);
                        // if(data.patient.sex == 'M'){
                        //     var gender = 'Male';
                        // }
                        // else{
                        //     var gender = 'Female';
                        // }
                        $("input[name=sex][value='" + data.patient.sex + "']").prop('checked', true);
                        //$('#department_id').val(data.patient.department_id).attr("selected", "true");
                        $('#department_id').val(data.patient.department_id);
                        $('#department_id').select2().trigger('change');
                        //$('#dignosis').val(data.patient.dignosis);
                        $('#dignosis').val(data.patient.dignosis);
                        //$('#dignosis').select2().trigger('change');
                        //$('#occupation').val(data.patient.occupation);
                        $('#occupation').val(data.patient.occupation);
                        $('#occupation').select2().trigger('change');
                        //$('#address').val(data.patient.address);
                        $('#address').val(data.patient.address);
                        $('#address').select2().trigger('change');
                        $('#weight').val(data.patient.wieght);
                        //$('#create_date').val(data.patient.create_date);
                        if($('#ipd_opd').val() == 'ipd'){
                            var d = new Date();
                        }
                        else if($('#ipd_opd').val() == 'opd' && $('#status1').val() == 'old'){
                            var d = new Date();
                        }
                        else{
                            var d = new Date(data.patient.create_date);
                        }
                        var day = d.getDate();
                        var month = d.getMonth()+1;
                        var year = d.getFullYear();
                        var date = day + '-' + month + '-' + year;
                        $('#create_date').val(date);
                        
                        if(data.patient.create_date != null || data.patient.create_date!=''){
                            var d1 = new Date(data.patient.create_date);
                            var day1 = d1.getDate();
                            var month1 = d1.getMonth()+1;
                            var year1 = d1.getFullYear();
                            var date1 = day1 + '-' + month1 + '-' + year1;
                        }
                        else{
                            var date1 = '';
                        }
                        $('#fol_up_date').val(date1);
                        
                        
                    //     var newarray = data.patient
                    //   console.log(newarray.length);
                    //     console.log(newarray);
                        
                    
                // var a=1;
                // for(var i=0;i<newarray.length;i++)
                // {
                //   var html = "<p>"+ a +"</p>";
                //     $('#sr').append(html);
                //   a++;
                // }
                
                // for(var j=0;j<newarray.length;j++)
                // {
                //   var html = "<input type='text' name='patient_name' style='margin-top: 3px;' id='patient_name' readonly='readonly' value="+ newarray[j].test_name +">";
                //     $('#name').append(html);
                // }
                
                
                // for(var k=0;k<newarray.length;k++)
                // {
                //   var html = "<input type='text' style='margin-top: 3px;' class='someclass' placeholder='Result'  name='opdnumber' id='opdnumber' required='required' value="+ newarray[j].ind_opd +">/>";
                //     $('#opdnumber').append(html);
                // }
                
                
                // for(var l=0;l<newarray.length;l++)
                // {
                //   var html = "<input type='text' style='margin-top: 3px;' name='date' id='date' readonly='readonly' value="+ newarray[l].create_date +">";
                //     $('#unit').append(html);
                // }
                
                
                
                        // $('#dignosis').append(
                        //         '<td value="' + diagnosisArr[i].dignosis + '">' + diagnosisArr[i].dignosis + '</td>'
                        //     );
                        
                       
                    } else  {
                        pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                    } 
                }, 
                error : function()
                {
                    //alert('failed');
                }
            });
        });
        //NEW  PATIENT DATA END
        
        
        
        //check patient id
        $('#old_reg_no1').keyup(function(){
            //$('#bedData').empty();
            //var pid = $(this);
            var pid = $('#old_reg_no1').val();
            var acyear = $("#acyear").val();
            console.log(pid + " " + acyear);
            $.ajax({
                url  : '<?= base_url('patients/check_patient/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    //old_reg_no : pid.val(),
                    old_reg_no : pid,
                    acyear : acyear
                },
                success : function(data)
                {
                    console.log(data.patient);
                    // alert(data.patient1);
                    if (data.status == true) {

                        //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                        //$('#yearly_no').val(data.patient.yearly_no);
                        $('#firstname').val(data.patient.firstname);
                        //$('#blood_group').val(data.patient.blood_group);
                        $('#blood_group').val(data.patient.blood_group);
                        $('#blood_group').select2().trigger('change');
                        $('#date_of_birth').val(data.patient.date_of_birth);
                        $('#degis_id').val(data.patient.degis_id);
                        //$('#sex').val(data.patient.sex);
                        // if(data.patient.sex == 'M'){
                        //     var gender = 'Male';
                        // }
                        // else{
                        //     var gender = 'Female';
                        // }
                        $("input[name=sex][value='" + data.patient.sex + "']").prop('checked', true);
                        //$('#department_id').val(data.patient.department_id).attr("selected", "true");
                        $('#department_id').val(data.patient.department_id);
                        $('#department_id').select2().trigger('change');
                        //$('#dignosis').val(data.patient.dignosis);
                        $('#dignosis').val(data.patient.dignosis);
                        //$('#dignosis').select2().trigger('change');
                        //$('#occupation').val(data.patient.occupation);
                        $('#occupation').val(data.patient.occupation);
                        $('#occupation').select2().trigger('change');
                        //$('#address').val(data.patient.address);
                        $('#address').val(data.patient.address);
                        $('#address').select2().trigger('change');
                        $('#weight').val(data.patient.wieght);
                        
                        var d = new Date(data.patient.create_date);
                        var day = d.getDate();
                        var month = d.getMonth()+1;
                        var year = d.getFullYear();
                        var date = day + '-' + month + '-' + year;
                        
                        $('#create_date').val(date);
                    } else if (data.status == false) {
                        pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                    } else {
                        pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
                    }
                }, 
                error : function()
                {
                    //alert('failed');
                }
            });
        });
        
        function ShowHideDiv() {
            var chkYes = document.getElementById("sex");
            alert(chkYes);
        };
        
        //department_id   
        if($("#department_id").val()){
            
            bedSelection();
            validateSexOnDepartment();
            validateAgeOnDepartment();
            
            var output = $('.doctor_error'); 
            var doctor_list = $('#doctor_id');
            var bed_list = $('#bedNo');
            var availabel_day = $('#availabel_day');
            $.ajax({
                url  : '<?= base_url('appointment/doctor_by_department/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    department_id : $("#department_id").val()
                },
                success : function(data) 
                {
                    if (data.status == true) {
                        doctor_list.html(data.message);
                        bed_list.html(data.message1);
                        availabel_day.html(data.availabel_days);
                        output.html('');
                    } else if (data.status == false) {
                        doctor_list.html('');
                        bed_list.html('');
                        output.html(data.message).addClass('text-danger').removeClass('text-success');
                    } else {
                        doctor_list.html('');
                        bed_list.html('');
                        output.html(data.message).addClass('text-danger').removeClass('text-success');
                    }
                }, 
                error : function()
                {
                    alert('failed');
                }
            });
        }
        else{
            $("#department_id").change(function(){
                var output = $('.doctor_error'); 
                var doctor_list = $('#doctor_id');
                var bed_list = $('#bedNo');
                var availabel_day = $('#availabel_day');
                $.ajax({
                    url  : '<?= base_url('appointment/doctor_by_department/') ?>',
                    type : 'post',
                    dataType : 'JSON',
                    data : {
                        '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                        department_id : $(this).val()
                    },
                    success : function(data) 
                    {
                        if (data.status == true) {
                            doctor_list.html(data.message);
                            bed_list.html(data.message1);
                            availabel_day.html(data.availabel_days);
                            output.html('');
                        } else if (data.status == false) {
                            doctor_list.html('');
                            bed_list.html('');
                            output.html(data.message).addClass('text-danger').removeClass('text-success');
                        } else {
                            doctor_list.html('');
                            bed_list.html('');
                            output.html(data.message).addClass('text-danger').removeClass('text-success');
                        }
                    }, 
                    error : function()
                    {
                        alert('failed');
                    }
                });
            });
        }
        
        //doctor_id   
        $("#doctor_id").change(function(){
            var doctor_id = $('#doctor_id'); 
            var output = $('#availabel_days'); 
            $.ajax({
                url  : '<?= base_url('appointment/schedule_day_by_doctor/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    doctor_id : $(this).val()
                },
                success : function(data) 
                {
                    if (data.status == true) {
                        output.html(data.message).addClass('text-success').removeClass('text-danger');
                    } else if (data.status == false) {
                        output.html(data.message).addClass('text-danger').removeClass('text-success');
                    } else {
                        output.html(data.message).addClass('text-danger').removeClass('text-success');
                    }
                }, 
                error : function()
                {
                    alert('failed');
                }
            });
        });
        
        
        
        
        
        
       
        //date   
        $("#date").change(function(){
            var date        = $('#date'); 
            var serial_preview   = $('#serial_preview'); 
            var doctor_id   = $('#doctor_id');
            var schedule_id = $("#schedule_id"); 
            var patient_id  = $("#patient_id"); 
            
            $.ajax({
                url  : '<?= base_url('appointment/serial_by_date/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    doctor_id  : doctor_id.val(),
                    patient_id : patient_id.val(), 
                    date : $(this).val()
                },
                success : function(data) 
                { 
                    if (data.status == true) {
                        //set schedule id
                        schedule_id.val(data.schedule_id); 
                        serial_preview.html(data.message);
                    } else if (data.status == false) {
                        schedule_id.val('');
                        serial_preview.html(data.message).addClass('text-danger').removeClass('text-success');
                    } else {
                        schedule_id.val('');
                        serial_preview.html(data.message).addClass('text-danger').removeClass('text-success');
                    }
                }, 
                error : function()
                {
                    alert('failed');
                }
            });
        });
 
        //serial_no    
        $("body").on('click','.serial_no',function(){
            var serial_no = $(this).attr('data-item');
            $("#serial_no").val(serial_no);
            $('.serial_no').removeClass('btn-danger').addClass('btn-success').not(".disabled");
            $(this).removeClass('btn-success').addClass('btn-danger').not(".disabled");
        });
   
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            minDate: 0  
          // beforeShowDay: DisableDays 
        });
     
    });
   
   /*$(document).ready(function(){
       $("#old").hide();
       $("#ipdno").hide();
       $("#ipd").hide();
       $("#ipd2").hide();
       
       $('#ipd_opd').on('change', function() {
           var ipdopd1 = document.getElementById("ipd_opd").value;
           var ipd_year_reg_no = document.getElementById("opd_year_reg_no").value;
            var opd_year_reg_no = document.getElementById("opd_year_reg_no").value;
            if ( this.value == 'ipd'){
                $("#yearly_reg_no").val(ipd_year_reg_no);
            } else if( this.value == 'opd'){
               
                $("#yearly_reg_no").val(ipd_year_reg_no);
            
            }
       }); 
       $('#status').on('change', function() {
        var ipdopd = document.getElementById("ipd_opd").value; 
        
         if ( this.value == 'old' && ipdopd == 'ipd')
         {
           $("#old").show();
           $("#yearly_no1").hide();
           $("#ipd").show()
           $("#ipd2").show();
         }else if(this.value == 'new' && ipdopd == 'ipd')
         {
            $("#old").hide();
            $("#yearly_no1").show();
            $("#ipd").show();
            $("#ipd2").show();
         }else if(this.value == 'old' && ipdopd == 'opd'){
             $("#old").show();
             $("#yearly_no1").hide();
             $("#ipdno").hide();
             $("#ipd").hide();
             $("#ipd2").hide();
         }else{
             $("#old").hide();
             $("#yearly_no1").show();
             $("#ipdno").hide();
             $("#ipd").hide();
             $("#ipd2").hide();
         }
       });
   });*/
   
    //Hide show new old
    $(document).ready(function(){
        $("#old").hide();
        $("#ipdno").hide();
        $("#ipd").hide();
        $("#ipd2").hide();
        $(".beds_tbl").hide();
        
        console.log($("input[name=id]").val());
        
        if($("input[name=id]").val() != ''){
            if ( $('#ipd_opd').val() == 'ipd'){
                //$("#yearly_reg_no").val(ipd_year_reg_no);
                $('.status1').hide();
                $('#status1').val('');
                $("#old").hide();
                $("#yearly_no1").show();
                $("#ipd").show();
                $("#ipd2").show();
                $(".beds_tbl").show();
            } else if( $('#ipd_opd').val() == 'opd'){
                //$("#yearly_reg_no").val(ipd_year_reg_no);
                $('.status1').show();
                $('#status1').val('');
                $("#old").hide();
                $(".beds_tbl").hide();
            }
        }
        else{
            $('#ipd_opd').on('change', function() {
                //console.log($('#ipd_opd').val());
                
                var ipdopd1 = document.getElementById("ipd_opd").value;
                var ipd_year_reg_no = document.getElementById("opd_year_reg_no").value;
                var opd_year_reg_no = document.getElementById("opd_year_reg_no").value;
                if ( $('#ipd_opd').val() == 'ipd'){
                    $("#yearly_reg_no").val(ipd_year_reg_no);
                    $('.status1').hide();
                    $('#status1').val('');
                    $("#old").show();
                    $("#yearly_no1").hide();
                    $("#ipd").show();
                    $("#ipd2").show();
                    $(".beds_tbl").show();
                } else if( $('#ipd_opd').val() == 'opd'){
                    $("#yearly_reg_no").val(ipd_year_reg_no);
                    $('.status1').show();
                    $('#status1').val('');
                    $("#old").hide();
                    $(".beds_tbl").hide();
                }
            }); 
        }
        
        $('#status1').on('change', function() {
            var ipdopd = document.getElementById("ipd_opd").value; 
            if(this.value == 'old' && ipdopd == 'opd'){
                $("#old").show();
                $("#yearly_no1").hide();
                $("#ipdno").hide();
                $("#ipd").hide();
                $("#ipd2").hide();
                $("#patient_data_old").show();
                $("#old_name").show();
                $("#last_vist_date").show();
            }else{
                $("#old").hide();
                $("#yearly_no1").show();
                $("#ipdno").hide();
                $("#ipd").hide();
                $("#ipd2").hide();
                $("#patient_data_old").hide();
                $("#old_name").hide();
                $("#last_vist_date").hide();
            }
        });
    });

   
    $(document).ready(function(){
        if($('#ipd_opd').val() == 'opd'){
            $('#status1').val('new');
            $('#status1').select2().trigger('change');
        }
        else{
            $('#status1').val('');
            $('#status1').select2().trigger('change');
        }
    });
    
    $(document).ready(function(){
        var department_id = $('#department_id').val();
        var pid = $("input[name='id']" ).val();
        var opd_no = $("#old_reg_no" ).val();
        var update_old_reg_no = $('#update_old_reg_no').val();
        var ipd_opd =  $('#ipd_opd').val();
        $.ajax({
            url  : '<?= base_url('patients/getDistinctTreatment/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                //old_reg_no : pid.val(),
                department_id : department_id,
                id : pid,
                opd_no : opd_no,
                update_old_reg_no : update_old_reg_no,
                ipd_opd : ipd_opd,
            },
            success : function(data)
            {
                //console.log(data);
                // alert(data.patient1);
                $('#dignosis').empty();
                var selectedDiagno = '';
                if (data) {
                    var diagnosisArr = data.diagnosisArr;
                    var petientDignosis = data.patientDiagnosis;
                    for(var i=0; i<diagnosisArr.length; i++){
                        //console.log(diagnosisArr[i].dignosis);
                        //console.log(petientDignosis['dignosis']);
                        
                        if(diagnosisArr[i].dignosis==petientDignosis['dignosis']){
                            $('#dignosis').append(
                                '<option value="' + diagnosisArr[i].dignosis + '" selected>' + diagnosisArr[i].dignosis + '</option>'
                            );
                        }else{
                            $('#dignosis').append(
                                '<option value="' + diagnosisArr[i].dignosis + '">' + diagnosisArr[i].dignosis + '</option>'
                            );
                        }
                    }
                } 
            }, 
            error : function()
            {
                //alert('failed');
            }
        });
        
    });
    
    $('#department_id').on('change', function(){

        var department_id = $('#department_id').val();
        var pid = $("input[name='id']" ).val();
        var opd_no = $("#old_reg_no" ).val();
        var update_old_reg_no = $('#update_old_reg_no').val();
        var ipd_opd =  $('#ipd_opd').val();
        $.ajax({
            url  : '<?= base_url('patients/getDistinctTreatment/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                //old_reg_no : pid.val(),
                department_id : department_id,
                id : pid,
                opd_no : opd_no,
                update_old_reg_no : update_old_reg_no,
                ipd_opd : ipd_opd,
            },
            success : function(data)
            {
                //console.log(data);
                // alert(data.patient1);
                $('#dignosis').empty();
                var selectedDiagno = '';
                if (data) {
                    var diagnosisArr = data.diagnosisArr;
                    var petientDignosis = data.patientDiagnosis;
                    for(var i=0; i<diagnosisArr.length; i++){
                        //console.log(diagnosisArr[i].dignosis);
                        //console.log(petientDignosis['dignosis']);
                        
                        if(diagnosisArr[i].dignosis==petientDignosis['dignosis']){
                            $('#dignosis').append(
                                '<option value="' + diagnosisArr[i].dignosis + '" selected>' + diagnosisArr[i].dignosis + '</option>'
                            );
                        }else{
                            $('#dignosis').append(
                                '<option value="' + diagnosisArr[i].dignosis + '">' + diagnosisArr[i].dignosis + '</option>'
                            );
                        }
                    }
                } 
            }, 
            error : function()
            {
                //alert('failed');
            }
        });
    });
    
    
    
    
    
     $('#dignosis').on('change', function(){

        
       
        var ipd_opd =  $('#ipd_opd').val();
        var department_id = $('#department_id').val();
         var dignosis =  $('#dignosis').val();
        
        // alert(ipd_opd)
        // alert(department_id)
        // alert(dignosis)
        $.ajax({
            url  : '<?= base_url('patients/get_proxy_id/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                department_id : department_id,
                dignosis : dignosis,
                ipd_opd : ipd_opd,
            },
            success : function(data)
            {
                if (data.status == true) 
                {
                    console.log(data);
                    $('#proxy_id').val(data.patient_proxy_id.proxy_id);
                }
                else
                {
                    console.log('False')
                }
                
            }, 
            error : function()
            {
                //alert('failed');
            }
        });
    });
  

   
   // //Hide show IPD OPD
   // $(document).ready(function(){
   //     $("#ipd2").hide();
   //     $("#ipdno").hide();
   //     $('#ipd_opd').on('change', function() {
   //       if ( this.value == 'ipd')
   //       {
   //         $("#ipd").show();
   //         $("#ipd2").show();
   //         $("#old").show();
   //         $("#ipdno").show();
   //         $("#yearly_no1").hide();
   //       }
   //       else
   //       {
   //         $("#ipd").hide();
   //         $("#ipd2").hide();
   //         $("#ipdno").hide();
   //       }
   //     });
   // });
</script>