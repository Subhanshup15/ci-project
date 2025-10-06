 <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
        
         <div class="panel-body panel-form">
            <!--<?php echo form_open_multipart('patients/treatment_save','class="form-inner"') ?>-->
            <?php echo form_open_multipart('patients/storeManualTreatment','class="form-inner"') ?>
            <?php echo form_hidden('id',$patient->id); ?>
            <?php echo form_hidden('patient_id',$patient->id); ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
              <?php echo form_hidden('panch_adv_flag',22); ?>
            
            <div class="form-group col-sm-12">
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="ipd_no" class="col-xs-3 col-form-label">IPD No.<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php echo $patient->ipd_no; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="ipd_no" class="col-xs-3 col-form-label">OPD No.<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="opd_no" class="form-control" type="text" placeholder="" id="opd_no"  value="<?php echo $patient->old_reg_no; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname; echo " ".$patient->lastname; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date_of_birth') ?> <i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="date_of_birth" class="form-control" type="text" placeholder="" id="date_of_birth"  value="<?php echo $patient->date_of_birth ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="date_of_birth" class="col-xs-3 col-form-label">Gender<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="gender" class="form-control" type="text" placeholder="" id="gender"  value="<?php echo $patient->sex ?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="date_of_birth" class="col-xs-3 col-form-label">Contact No.<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="contact" class="form-control" type="text" placeholder="" id="contact"  value="<?php echo $patient->mobile ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">Admit Date<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="create_date" class="form-control" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?php echo $patient->create_date ?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">Discharge Date<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="discharge_date" class="form-control" type="text" placeholder="<?php echo display('discharge_date') ?>" id="discharge_date"  value="<?php echo $patient->discharge_date ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                     <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                       <div class="col-xs-9">
                         <?php 
                            
                            
                                                        $year = '%' . $this->session->userdata['acyear'] . '%';
                            $Cyear = $this->session->userdata['acyear'];

                            // Determine the department table based on the academic year
                            if ($Cyear == '2025') {
                                $departmentTable = 'department_new';
                            } else {
                                $departmentTable = 'department';
                            }
                            
                           $department_list = $this->db->get($departmentTable)->result();

                            ?>
                            <input name="department_id" class="form-control" type="hidden" placeholder="" id="department_id"  value="<?php echo $patient->department_id; ?>" readonly>
                            <input name="department_id1" class="form-control" type="text" placeholder="" id="department_id1"  value="<?php echo $result->name; ?>" readonly>
                     </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="dignosis" class="col-xs-3 col-form-label"><?php echo display('dignosis') ?> <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="dignosis" class="form-control" type="text" placeholder="" id="dignosis"  value="<?php   $segment=$this->uri->segment(4); if($segment == 'ipd'){ 
                                $section_tret='ipd';
                                $len=strlen($patient->dignosis);
                                $dd= substr($patient->dignosis,$len - 1);
                                if($dd=='I'){
                                $p_dignosis = '%'.$patient->dignosis.'%';
                                $p_dignosis_name=$patient->dignosis;
                                }else{
                                
                                $p_dignosis = '%'.$patient->dignosis;
                                $p_dignosis_name=$patient->dignosis;
                                }
                                
                                }
                                else{
                                $section_tret='opd';
                                $len=strlen($patient->dignosis);
                                $dd= substr($patient->dignosis,$len - 1);
                                if($dd=='I'){
                                // echo $dd;
                                $dd1=substr($patient->dignosis, 0, -1);
                                $p_dignosis = '%'.$dd1.'%';
                                $p_dignosis_name=$dd1;
                                }else{
                                //echo $dd;
                                $p_dignosis = '%'.$patient->dignosis.'%';
                                $p_dignosis_name=$patient->dignosis;
                                }
                                } echo $p_dignosis_name; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-5">
                        <label for="treatment" class="col-xs-4 col-form-label">IPD Round Date<i class="text-danger"></i></label>
                        <div class="col-xs-8">
                            <input name="roundDate" class="datepicker form-control" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y') ?>" type="text" placeholder="IPD Round Date" id="roundDate" required>
                            <!--<input name="roundDate" class="form-control" type="date" placeholder="" id="roundDate">-->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="treatment" class="col-xs-4 col-form-label">IPD Round<i class="text-danger"></i></label>
                        <div class="col-xs-8">
                            <select name="round" id="round" class="form-control" required>
								<option value="">Select Round</option>
                                <option value="1">Round 1 Morning</option>
                                <option value="2">Round 2 Evening</option>
					    	 </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="treatment" class="col-xs-4 col-form-label">IPD Days<i class="text-danger"></i></label>
                        <div class="col-xs-8">
                            <!--<select name="round" id="round" class="form-control">
								<option value="">Select Round</option>
                                <option value="1">Round 1 Morning</option>
                                <option value="2">Round 2 Afternoon</option>
                                <option value="3">Round 3 Evening</option>
					    	 </select>-->
					    	 <input name="ipd_days" class="form-control" type="text" placeholder="IPD Days" id="ipd_days" required>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>RX1<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX1" id="RX1" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx1" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx1" id="morning_dose_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx1" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx1" id="afternoon_dose_rx1" class="select2 form-control">
                                <option value="">Select</option>
    					     	<option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx1" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx1" id="evening_dose_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx1" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx1" id="dose_take_with_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="जेवणपूर्वी">जेवणपूर्वी</option>
    					   	    <option value="जेवणानंतर">जेवणानंतर</option>
    					   	    <option value="उपाशीपोटी">उपाशीपोटी</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx1" id="dose_anupan_rx1" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>RX2<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX2" id="RX2" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx2" class="col-form-label">Morning<br> Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx2" id="morning_dose_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx2" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx2" id="afternoon_dose_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx2" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx2" id="evening_dose_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx2" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx2" id="dose_take_with_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी">जेवणपूर्वी</option>
                                <option value="जेवणानंतर">जेवणानंतर</option>
                                <option value="उपाशीपोटी">उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx2" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx2" id="dose_anupan_rx2" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX3<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX3" id="RX3" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx3 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx3" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx3" id="morning_dose_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx3" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx3" id="afternoon_dose_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx3" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx3" id="evening_dose_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx3" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx3" id="dose_take_with_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी">जेवणपूर्वी</option>
                                <option value="जेवणानंतर">जेवणानंतर</option>
                                <option value="उपाशीपोटी">उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx3" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx3" id="dose_anupan_rx3" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>RX4<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX4" id="RX4" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx4 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx4" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx4" id="morning_dose_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx4" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx4" id="afternoon_dose_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx4" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx4" id="evening_dose_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx4" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx4" id="dose_take_with_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी">जेवणपूर्वी</option>
                                <option value="जेवणानंतर">जेवणानंतर</option>
                                <option value="उपाशीपोटी">उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx4" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx4" id="dose_anupan_rx4" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>RX5<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX5" id="RX5" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx5 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx5" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx5" id="morning_dose_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx5" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx5" id="afternoon_dose_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx5" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx5" id="evening_dose_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx5" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx5" id="dose_take_with_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी">जेवणपूर्वी</option>
                                <option value="जेवणानंतर">जेवणानंतर</option>
                                <option value="उपाशीपोटी">उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx5" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx5" id="dose_anupan_rx5" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                            <?php
                                $date = $this->input->post('roundDate');
                                $round = $this->input->post('round');
                               // $id = $this->input->post('patient_id');
                                $result1 = $this->db->select('*')
                                ->from('manual_treatments')
                                ->where('patient_id_auto',$patient->id)
                                //->where('ipd_round_date',$date)
                                //->where('rounds',$round)
                                ->get()
                                ->row();
                                //print_r($this->db->last_query())
                            ?>         
                
                
                 <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine <br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other" id="RX_other"  placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx10" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="morning_dose_rx_other" id="morning_dose_rx_other" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx10" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="afternoon_dose_rx_other" id="afternoon_dose_rx_other" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx10" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other" id="evening_dose_rx_other" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx10" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other" id="dose_take_with_rx_other" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx10" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other" id="dose_anupan_rx_other" class="form-control"  placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine <br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other1" id="RX_other1" placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx_other1" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="morning_dose_rx_other1" id="morning_dose_rx_other1" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx_other1" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="afternoon_dose_rx_other1" id="afternoon_dose_rx_other1" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx_other1" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other1" id="evening_dose_rx_other1" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx_other1" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other1" id="dose_take_with_rx_other1" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx_other1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other1" id="dose_anupan_rx_other1" class="form-control"  placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                
                
                
               <!-- <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine <br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other3" id="RX_other3" placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx_other2" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="morning_dose_rx_other3" id="morning_dose_rx_other3" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx_other2" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="afternoon_dose_rx_other3" id="afternoon_dose_rx_other3" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx_other2" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other3" id="evening_dose_rx_other3" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx_other2" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other3" id="dose_take_with_rx_other3" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx_other1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other3" id="dose_anupan_rx_other3" class="form-control"  placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine <br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other4" id="RX_other4" placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx_other2" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="morning_dose_rx_other4" id="morning_dose_rx_other4" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx_other2" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="afternoon_dose_rx_other4" id="afternoon_dose_rx_other4" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx_other2" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other4" id="evening_dose_rx_other4" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx_other2" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other4" id="dose_take_with_rx_other4" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx_other1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other4" id="dose_anupan_rx_other4" class="form-control"  placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine <br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other5" id="RX_other5" placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx_other2" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="morning_dose_rx_other5" id="morning_dose_rx_other5" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx_other2" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="afternoon_dose_rx_other5" id="afternoon_dose_rx_other5" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx_other2" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other5" id="evening_dose_rx_other5" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_take_with_rx_other2" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other5" id="dose_take_with_rx_other5" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx_other1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other5" id="dose_anupan_rx_other5" class="form-control"  placeholder="Anupan"/>
                        </div>
                    </div>
                </div>-->
                
                
         
                
<div class="form-group" style="padding-right:none;padding-left:none;">
    <div class="form-group col-sm-12">
        <div class="row">
            <label for="treatment" class="col-form-label">Other Medicine & Equipment<i class="text-danger"></i></label>
        </div>
        <div class="row">
            <textarea name="other_equipment" id="other_equipment" style="height: 150px;width: 100%;">
                
            </textarea>
            
        </div>
    </div>
</div>

                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">SNEHAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="SNEHAN" id="SNEHAN" class="form-control" placeholder="SNEHAN">
                          <?php } else { ?>
                          <select name="SNEHAN" id="SNEHAN" class="form-control">
                                <!--<option value="">Select SNEHAN</option>-->
                                <?php foreach($treatment_list_karma as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">SWEDAN</label>
                        <div class="col-xs-9">
                           <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="SWEDAN" id="SWEDAN" class="form-control" placeholder="SWEDAN">
                          <?php } else { ?>
                            <select name="SWEDAN" id="SWEDAN" class="form-control">
                                <!--<option value="">Select SWEDAN</option>-->
                                <?php foreach($treatment_list_pk1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                           <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">VAMAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="VAMAN" id="VAMAN" class="form-control" placeholder="VAMAN">
                          <?php } else { ?>
                          <select name="VAMAN" id="VAMAN" class="form-control">
                                <!--<option value="">Select VAMAN</option>-->
                                <?php foreach($treatment_list_pk2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">VIRECHAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="VIRECHAN" id="VIRECHAN" class="form-control" placeholder="VIRECHAN">
                          <?php } else { ?>
                          
                          <select name="VIRECHAN" id="VIRECHAN" class="form-control">
                                <!--<option value="">Select VIRECHAN</option>-->
                                <?php foreach($treatment_list_swa1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">NASYA<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="NASYA" id="NASYA" class="form-control" placeholder="NASYA">
                          <?php } else { ?>
                          <select name="NASYA" id="NASYA" class="form-control">
                                <!--<option value="">Select NASYA</option>-->
                                <?php foreach($treatment_list_patho as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                           <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">BASTI<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="BASTI" id="BASTI" class="form-control" placeholder="BASTI">
                          <?php } else { ?>
                          <select name="BASTI" id="BASTI" class="form-control">
                                <!--<option value="">Select BASTI</option>-->
                                <?php foreach($treatment_list_swa2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">RAKTAMOKSHAN</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="RAKTAMOKSHAN" id="RAKTAMOKSHAN" class="form-control" placeholder="RAKTAMOKSHAN">
                          <?php } else { ?> 
                          <select name="RAKTAMOKSHAN" id="RAKTAMOKSHAN" class="form-control">
                                <!--<option value="">Select RAKTAMOKSHAN</option>-->
                                <?php foreach($treatment_list_patho2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">SROTAS<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="SROTAS" id="SROTAS" class="form-control" placeholder="SROTAS">
                          <?php } else { ?> 
                          <select name="SROTAS" id="SROTAS" class="form-control">
                                <!--<option value="">Select SHIRODHARA_SHIROBASTI</option>-->
                                <?php foreach($treatment_list_srotas as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                            <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">DOSHA<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="DOSHA" id="DOSHA" class="form-control" placeholder="DOSHA">
                          <?php } else { ?>
                          <select name="DOSHA" id="DOSHA" class="form-control">
                                <!--<option value="">Select SHIRODHARA_SHIROBASTI</option>-->
                                <?php foreach($treatment_list_dosha as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">DUSHYA</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                          <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="DUSHYA" id="DUSHYA" class="form-control" placeholder="DUSHYA">
                          <?php } else { ?>  
                          <select name="DUSHYA" id="DUSHYA" class="form-control">
                                <!--<option value="">Select RAKTAMOKSHAN</option>-->
                                <?php foreach($treatment_list_dushya as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">SHIRODHARA<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="SHIRODHARA_SHIROBASTI" id="SHIRODHARA_SHIROBASTI" class="form-control" placeholder="SHIRODHARA_SHIROBASTI">
                          <?php } else { ?>  
                          <select name="SHIRODHARA_SHIROBASTI" id="SHIRODHARA_SHIROBASTI" class="form-control">
                                <!--<option value="">Select SHIRODHARA_SHIROBASTI</option>-->
                                <?php foreach($treatment_list_patho3 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">SHIROBASTI</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="SHIROBASTI" id="SHIROBASTI" class="form-control" placeholder="SHIROBASTI">
                          <?php } else { ?>  
                          <select name="SHIROBASTI" id="SHIROBASTI" class="form-control">
                                <!--<option value="">Select RAKTAMOKSHAN</option>-->
                                <?php foreach($treatment_list_shirobasti as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                           <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">SAHASRAKARMA</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                             <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="skarma" id="skarma" class="form-control" placeholder="skarma">
                          <?php } else { ?>  
                          <select name="skarma" id="skarma" class="form-control">
                                <!--<option value="">Select RAKTAMOKSHAN</option>-->
                                <?php foreach($treatment_list_skarma as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                            <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">VRANAKARMA<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                             <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="vkarma" id="vkarma" class="form-control" placeholder="vkarma">
                          <?php } else { ?>  
                          <select name="vkarma" id="vkarma" class="form-control">
                                <!--<option value="">Select SHIRODHARA_SHIROBASTI</option>-->
                                <?php foreach($treatment_list_vkarma as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                             <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">SWA1</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="swa1" id="swa1" class="form-control" placeholder="swa1">
                          <?php } else { ?>  
                          <select name="swa1" id="swa1" class="form-control">
                                <!--<option value="">Select RAKTAMOKSHAN</option>-->
                                <?php foreach($treatment_list_swa11 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                           <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">SWA2<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                           <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="swa2" id="swa2" class="form-control" placeholder="swa2">
                          <?php } else { ?>  
                          <select name="swa2" id="swa2" class="form-control">
                                <!--<option value="">Select SHIRODHARA_SHIROBASTI</option>-->
                                <?php foreach($treatment_list_swa12 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                             <?php }?>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">OTHER<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                          <?php if($patient->department_id == '33'){ ?>
                          <input type="text" name="OTHER" id="OTHER" class="form-control" placeholder="OTHER">
                          <?php } else { ?>  
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="OTHER" id="OTHER" class="form-control">
                                <!--<option value="">Select OTHER</option>-->
                                <?php foreach($treatment_list_OTHER as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                              <?php }?>
                            </select>
                          <?php }?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">HEMATOLOGICAL<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="hematological[]" id="HEMATOLOGICAL" class="form-control" multiple>
                                <!--<option value="">Select HEMATOLOGICAL</option>-->
                                <?php foreach($treatment_list_HEMATOLOGICAL as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <label id="HEMATOLOGICAL_label"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">SEROLOGYCAL<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="serologycal[]" id="SEROLOGYCAL" class="form-control" multiple>
                                <!--<option value="">Select SEROLOGYCAL</option>-->
                                <?php foreach($treatment_list_SEROLOGYCAL as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <label id="SEROLOGYCAL_label"></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">MICROBIOLOGICAL<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="biochemical[]" id="MICROBIOLOGICAL" class="form-control" multiple>
                                <!--<option value="">Select MICROBIOLOGICAL</option>-->
                                <?php foreach($treatment_list_MICROBIOLOGICAL as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <label id="MICROBIOLOGICAL_label"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">BIOCHEMICAL<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="microbiological[]" id="BIOCHEMICAL" class="form-control" multiple>
                                <!--<option value="">Select BIOCHEMICAL</option>-->
                                <?php foreach($treatment_list_BIOCHEMICAL as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <label id="BIOCHEMICAL_label"></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">X-RAY<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="xray[]" id="X_RAY" class="form-control" multiple>
                                <!--<option value="">Select X-RAY</option>-->
                                <?php foreach($treatment_list_x_ray as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <label id="X_RAY_label"></label>
                        </div>   
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">ECG<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="ECG" id="ECG" class="form-control">
                                <!--<option value="">Select ECG</option>-->
                                <?php foreach($treatment_list_ecg as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">USG<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="usg[]" id="USG" class="form-control select2" multiple>
                                <!--<option value="">Select USG</option>-->
                                <?php foreach($treatment_list_usg as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                            <label id="USG_label"></label>
                        </div>
                    </div>
                    
                </div>
                
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">YONIDHAVAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="YONIDHAVAN" id="YONIDHAVAN" class="form-control">
                                <!--<option value="">Select SNEHAN</option>-->
                                <?php foreach($treatment_list_YONIDHAVAN as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ></option><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">YONIPICHU</label>
                        <div class="col-xs-9">
                            <select name="YONIPICHU" id="YONIPICHU" class="form-control">
                                <!--<option value="">Select VAMAN</option>-->
                                <?php foreach($treatment_list_YONIPICHU as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">UTTARBASTI<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="UTTARBASTI" id="UTTARBASTI" class="form-control">
                                <!--<option value="">Select SNEHAN</option>-->
                                <?php foreach($treatment_list_UTTARBASTI as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ></option><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">PHYSIOTHERAPY<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <input type="textbox" name="PHYSIOTHERAPY" id="PHYSIOTHERAPY" placeholder="PHYSIOTHERAPY" class="form-control">
                        </div>
                    </div>
                </div>
                
                
     <hr>
     <h2>Discharge Card</h2>
     <hr>           
                
                
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>DRX1<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="DRX1" id="DRX1" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_drx1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_drx1" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_drx1" id="morning_dose_drx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_drx1" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_drx1" id="afternoon_dose_drx1" class="select2 form-control">
                                <option value="">Select</option>
    					     	<option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_drx1" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_drx1" id="evening_dose_drx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_drx1" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_drx1" id="dose_day_drx1" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_drx1" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_drx1" id="dose_take_with_drx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="जेवणपूर्वी">जेवणपूर्वी</option>
    					   	    <option value="जेवणानंतर">जेवणानंतर</option>
    					   	    <option value="उपाशीपोटी">उपाशीपोटी</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_drx1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_drx1" id="dose_anupan_drx1" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>DRX2<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="DRX2" id="DRX2" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_drx2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_drx2" class="col-form-label">Morning<br> Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_drx2" id="morning_dose_drx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_drx2" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_drx2" id="afternoon_dose_drx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_drx2" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_drx2" id="evening_dose_drx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_drx2" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_drx2" id="dose_day_drx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_drx2" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_drx2" id="dose_take_with_drx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी">जेवणपूर्वी</option>
                                <option value="जेवणानंतर">जेवणानंतर</option>
                                <option value="उपाशीपोटी">उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_drx2" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_drx2" id="dose_anupan_drx2" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>DRX3<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="DRX3" id="DRX3" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_drx3 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_drx3" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_drx3" id="morning_dose_drx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_DRX3" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_drx3" id="afternoon_dose_drx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_drx3" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_drx3" id="evening_dose_drx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="1g">1g</option>
                                <option value="2g">2g</option>
                                <option value="3g">3g</option>
                                <option value="4g">4g</option>
                                <option value="5g">5g</option>
                                <option value="125mg">125mg</option>
                                <option value="150mg">150mg</option>
                                <option value="200mg">200mg</option>
                                <option value="250mg">250mg</option>
                                <option value="500mg">500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_drx3" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_drx3" id="dose_day_drx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_drx3" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_drx3" id="dose_take_with_drx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी">जेवणपूर्वी</option>
                                <option value="जेवणानंतर">जेवणानंतर</option>
                                <option value="उपाशीपोटी">उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_drx3" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_drx3" id="dose_anupan_drx3" class="form-control" placeholder="Anupan"/>
                        </div>
                    </div>
                  
                  <div class="form-group" style="padding-right:none;padding-left:none;">
    <div class="form-group col-sm-12">
        <div class="row">
            <label for="treatment" class="col-form-label">Other Medicine & Equipment<i class="text-danger"></i></label>
        </div>
        <div class="row">
            <textarea name="other_equipment_drx" id="other_equipment_drx" style="height: 150px;width: 100%;">
                
            </textarea>
            
        </div>
    </div>
</div>
                </div>
            </div>

<!--- ////////////////////////////////////////////////////////////////////////////////-->
            <div class="form-group row">
               
               <div class="form-group row">
                  <div class="col-sm-offset-3 col-sm-6">
                     <div class="ui buttons">
                          <a href="javascript:window.history.go(-1);" class="btn btn-info">Back</a>
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                        <button class="ui positive button"><?php echo display('save') ?></button>
                     </div>
                  </div>
               </div>
            </div>
            <?php echo form_close() ?> 
         </div>
      </div>
   </div>
</div>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New</h4>
        </div>
        <div class="modal-body">
              <?php echo form_open_multipart('patients/medicine_save','class="form-inner"') ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
              <?php echo form_hidden('patient_id',$this->uri->segment(3)); ?>
              <?php echo form_hidden('dignosis',$patient->dignosis); ?>
                <div class="form-group row">
                 <label for="Quantity" class="col-md-offset-2 col-md-3 col-form-label">Medicine<i class="text-danger">*</i></label>
                  <div class="col-md-6">
                  <!-- <select name="medicine_type" id="" class="form-control">
				   <option value="">Select type</option>
				   </select>-->
				   <input list="brow" name="medicine_type" class="form-control" required>
                   <datalist id="brow">
                   <option value="RX1">
                   <option value="RX2">
                   <option value="RX3">
                    <option value="SNEHAN">
                    <option value="SWEDAN">
                    <option value="VAMAN">
                    <option value="VIRECHAN">
                    <option value="BASTI">
                    <option value="NASYA">
                    <option value="RAKTAMOKSHAN"> 
                    <option value="SHIRODHARA_SHIROBASTI">
                    <option value="OTHER">
                    <option value="SWA1">
                    <option value="SWA2">
                    <option value="HEMATOLOGICAL">
                    <option value="SEROLOGYCAL">
                    <option value="BIOCHEMICAL">
                    <option value="MICROBIOLOGICAL">                     
                    <option value="X_RAY"> 
                    <option value="ECG">  
                  </datalist>
				  </div>
				  </div>
				   <div class="form-group row">
				   <label for="dignosis" class="col-md-offset-2 col-md-3 col-form-label">Name<i class="text-danger">*</i></label>
                    <div class="col-md-6">
                        <input name="medicine_name" class="form-control" type="text" placeholder="Enter name" id="medicine_name"   value="" required>
                    </div>
				   </div>
				   <div class="form-group row">
                  <div class="col-md-offset-4 col-sm-2">
                     <div class="ui buttons">
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                        <button class="ui positive button"><?php echo display('save') ?></button>
                     </div>
                  </div>
               </div>
               <?php echo form_close() ?> 
              </div> 
          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
             var array1 =[];
         function treatment($value){
             array1.push(" "+$value);
            // alert(array1)
             document.getElementById("multiple_treatment").value = array1;
             //document.getElementById("multiple_treatment")style.display = "none";
         }
         
    $(document).ready(function(){
        $('#ipd_days').val('');
        $('#SNEHAN').val('').select2().trigger('change');
        $('#SWEDAN').val('').select2().trigger('change');
        $('#VAMAN').val('').select2().trigger('change');
        $('#VIRECHAN').val('').select2().trigger('change');
        $('#NASYA').val('').select2().trigger('change');
        $('#BASTI').val('').select2().trigger('change');
        $('#RAKTAMOKSHAN').val('').select2().trigger('change');
        $('#SHIRODHARA_SHIROBASTI').val('').select2().trigger('change');
        $('#OTHER').val('').select2().trigger('change');
        
        // $('#HEMATOLOGICAL').val('').select2().trigger('change');
        // $('#SEROLOGYCAL').val('').select2().trigger('change');
        // $('#MICROBIOLOGICAL').val('').select2().trigger('change');
        // $('#BIOCHEMICAL').val('').select2().trigger('change');
        // $('#x_ray').val('').select2().trigger('change');
        // $('#ECG').val('').select2().trigger('change');
        // $('#USG').val('').select2().trigger('change');
        
        $('#HEMATOLOGICAL_label').text('');
        $('#SEROLOGYCAL_label').text('');
        $('#MICROBIOLOGICAL_label').text('');
        $('#BIOCHEMICAL_label').text('');
        $('#X_RAY_label').text('');
        $('#ECG').val('').select2().trigger('change');
        $('#USG_label').text('');
        
        $('#swa1').val('').select2().trigger('change');
        $('#swa2').val('').select2().trigger('change');
        
        // $('#SROTAS').val('').select2().trigger('change');
        // $('#DOSHA').val('').select2().trigger('change');
        // $('#DUSHYA').val('').select2().trigger('change');
        // $('#SHIROBASTI').val('').select2().trigger('change');
        // $('#skarma').val('').select2().trigger('change');
        // $('#vkarma').val('').select2().trigger('change');
        
        $('#RX1').val('').select2().trigger('change');
        $('#morning_dose_rx1').val('').select2().trigger('change');
        $('#afternoon_dose_rx1').val('').select2().trigger('change');
        $('#evening_dose_rx1').val('').select2().trigger('change');
        $('#dose_take_with_rx1').val('').select2().trigger('change');
        ////$('#dose_anupan_rx1').val('').select2().trigger('change');
        $('#dose_anupan_rx1').val('');
        
        
        
        
        
         /*$('#RX_other').val('');
         $('#morning_dose_rx_other').val('');
         $('#afternoon_dose_rx_other').val('');
         $('#evening_dose_rx_other').val('');
         $('#dose_day_rx_other').val('');
         $('#dose_take_with_rx_other').val('');
         $('#dose_anupan_rx_other').val('');*/
        
        $('#RX_other').text('');
        $('#morning_dose_rx_other').text('');
        $('#afternoon_dose_rx_other').text('');
        $('#evening_dose_rx_other').text('');
        $('#dose_day_rx_other').text('');
        $('#dose_take_with_rx_other').text('');
        $('#dose_anupan_rx_other').text('');
        
        
        $('#RX2').val('').select2().trigger('change');
        $('#morning_dose_rx2').val('').select2().trigger('change');
        $('#afternoon_dose_rx2').val('').select2().trigger('change');
        $('#evening_dose_rx2').val('').select2().trigger('change');
        $('#dose_take_with_rx2').val('').select2().trigger('change');
        ////$('#dose_anupan_rx2').val('').select2().trigger('change');
        $('#dose_anupan_rx2').val('');
        
        $('#RX3').val('').select2().trigger('change');
        $('#morning_dose_rx3').val('').select2().trigger('change');
        $('#afternoon_dose_rx3').val('').select2().trigger('change');
        $('#evening_dose_rx3').val('').select2().trigger('change');
        $('#dose_take_with_rx3').val('').select2().trigger('change');
        ////$('#dose_anupan_rx3').val('').select2().trigger('change');
        $('#dose_anupan_rx3').val('');
        
        $('#RX4').val('').select2().trigger('change');
        $('#morning_dose_rx4').val('').select2().trigger('change');
        $('#afternoon_dose_rx4').val('').select2().trigger('change');
        $('#evening_dose_rx4').val('').select2().trigger('change');
        $('#dose_take_with_rx4').val('').select2().trigger('change');
        ////$('#dose_anupan_rx4').val('').select2().trigger('change');
        $('#dose_anupan_rx4').val('');
        
        $('#RX5').val('').select2().trigger('change');
        $('#morning_dose_rx5').val('').select2().trigger('change');
        $('#afternoon_dose_rx5').val('').select2().trigger('change');
        $('#evening_dose_rx5').val('').select2().trigger('change');
        $('#dose_take_with_rx5').val('').select2().trigger('change');
        ////$('#dose_anupan_rx5').val('').select2().trigger('change');
        $('#dose_anupan_rx5').val('');
        
        
        
       /* $('#RX_other').val('').select2().trigger('change');
        $('#morning_dose_rx_other').val('').select2().trigger('change');
        $('#afternoon_dose_rx_other').val('').select2().trigger('change');
        $('#evening_dose_rx_other').val('').select2().trigger('change');
        $('#dose_day_rx_other').val('').select2().trigger('change');
        $('#dose_take_with_rx_other').val('').select2().trigger('change');
        $('#dose_anupan_rx_other').val('');*/
        
        
        
        $('#DRX1').val('').select2().trigger('change');
        $('#morning_dose_drx1').val('').select2().trigger('change');
        $('#afternoon_dose_drx1').val('').select2().trigger('change');
        $('#evening_dose_drx1').val('').select2().trigger('change');
        $('#dose_take_with_drx1').val('').select2().trigger('change');
        $('#dose_day_drx1').val('').select2().trigger('change');
        ////$('#dose_anupan_drx1').val('').select2().trigger('change');
        $('#dose_anupan_drx1').val('');
        
        $('#DRX2').val('').select2().trigger('change');
        $('#morning_dose_drx2').val('').select2().trigger('change');
        $('#afternoon_dose_drx2').val('').select2().trigger('change');
        $('#evening_dose_drx2').val('').select2().trigger('change');
        $('#dose_take_with_drx2').val('').select2().trigger('change');
        $('#dose_day_drx2').val('').select2().trigger('change');
        ////$('#dose_anupan_drx2').val('').select2().trigger('change');
        $('#dose_anupan_drx2').val('');
        
        $('#DRX3').val('').select2().trigger('change');
        $('#morning_dose_drx3').val('').select2().trigger('change');
        $('#afternoon_dose_drx3').val('').select2().trigger('change');
        $('#evening_dose_drx3').val('').select2().trigger('change');
        $('#dose_take_with_drx3').val('').select2().trigger('change');
        $('#dose_day_drx3').val('').select2().trigger('change');
        ////$('#dose_anupan_drx3').val('').select2().trigger('change');
        $('#dose_anupan_drx3').val('');
        
        $('#round').on('change', function(){
            var pid = $('input[name="patient_id"]').val();
            var roundDate = $('#roundDate').val();
            var round = $('#round').val();
            var section = $('input[name="ipd_opd"]').val();
            console.log(pid +"===="+ roundDate +"===="+ round +"===="+ section);
            $.ajax({
                url  : '<?= base_url('patients/check_patient_manual_treatment/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    'patient_id' : pid,
                    'roundDate' : roundDate,
                    'round' : round,
                    'section': section
                },
                success : function(data) 
                {
                    console.log(data);
                    if (data) 
                    {
                        console.log(data);
                        $('#ipd_days').val(data.ipd_days);
                        $('#SNEHAN').val(data.SNEHAN).select2().trigger('change');
                        $('#SWEDAN').val(data.SWEDAN).select2().trigger('change');
                        $('#VAMAN').val(data.VAMAN).select2().trigger('change');
                        $('#VIRECHAN').val(data.VIRECHAN).select2().trigger('change');
                        $('#NASYA').val(data.NASYA).select2().trigger('change');
                        $('#BASTI').val(data.BASTI).select2().trigger('change');
                        $('#RAKTAMOKSHAN').val(data.RAKTAMOKSHAN).select2().trigger('change');
                        $('#SHIRODHARA_SHIROBASTI').val(data.SHIRODHARA_SHIROBASTI).select2().trigger('change');
                        $('#OTHER').val(data.OTHER).select2().trigger('change');
                      
                      
                      
                       	$('#SNEHAN').val(data.SNEHAN);
                        $('#SWEDAN').val(data.SWEDAN);
                        $('#VAMAN').val(data.VAMAN);
                        $('#VIRECHAN').val(data.VIRECHAN);
                        $('#NASYA').val(data.NASYA);
                        $('#BASTI').val(data.BASTI);
                        $('#RAKTAMOKSHAN').val(data.RAKTAMOKSHAN);
                        $('#SHIRODHARA_SHIROBASTI');
                        $('#OTHER').val(data.OTHER);
                        
                        // $('#HEMATOLOGICAL').val(data.HEMATOLOGICAL).select2().trigger('change');
                        // $('#SEROLOGYCAL').val(data.SEROLOGYCAL).select2().trigger('change');
                        // $('#MICROBIOLOGICAL').val(data.BIOCHEMICAL).select2().trigger('change');
                        // $('#BIOCHEMICAL').val(data.MICROBIOLOGICAL).select2().trigger('change');
                        // $('#x_ray').val(data.X_RAY).select2().trigger('change');
                        // $('#ECG').val(data.ECG).select2().trigger('change');
                        // $('#USG').val(data.USG).select2().trigger('change');
                        
                        $('#HEMATOLOGICAL_label').text(data.HEMATOLOGICAL);
                        $('#SEROLOGYCAL_label').text(data.SEROLOGYCAL);
                        $('#MICROBIOLOGICAL_label').text(data.BIOCHEMICAL);
                        $('#BIOCHEMICAL_label').text(data.MICROBIOLOGICAL);
                        $('#X_RAY_label').text(data.X_RAY);
                        $('#ECG').val(data.ECG).select2().trigger('change');
                        $('#USG_label').text(data.USG);
                        
                        $('#swa1').val(data.SWA1).select2().trigger('change');
                        $('#swa2').val(data.SWA2).select2().trigger('change');
                        
                        // $('#SROTAS').val(data.SROTAS).select2().trigger('change');
                        // $('#DOSHA').val(data.DOSHA).select2().trigger('change');
                        // $('#DUSHYA').val(data.DUSHYA).select2().trigger('change');
                        // $('#SHIROBASTI').val(data.SHIROBASTI).select2().trigger('change');
                        // $('#skarma').val(data.skarma).select2().trigger('change');
                        // $('#vkarma').val(data.vkarma).select2().trigger('change');
                        
                        $('#RX1').val(data.RX1_medicine_name).select2().trigger('change');
                        $('#morning_dose_rx1').val(data.RX1_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_rx1').val(data.RX1_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_rx1').val(data.RX1_evening_dose).select2().trigger('change');
                        $('#dose_take_with_rx1').val(data.RX1_dose_take).select2().trigger('change');
                        //////$('#dose_anupan_rx1').val(data.RX1_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_rx1').val(data.RX1_dose_anupan);
                        
                        
                        /*$('#RX_other').val(data.RX1_medicine_name).select2().trigger('change');
                        $('#morning_dose_rx_other').val(data.RX1_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_rx_other').val(data.RX1_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_rx_other').val(data.RX1_evening_dose).select2().trigger('change');
                        $('#dose_day_rx_other').val(data.RX1_dose_take).select2().trigger('change');
                        $('#dose_take_with_rx_other').val(data.RX1_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_rx_other').val(data.RX1_dose_anupan);*/
                        
                        /*$('#RX_other').text('');
                        $('#morning_dose_rx_other').text('');
                        $('#afternoon_dose_rx_other').text('');
                        $('#evening_dose_rx_other').text('');
                        $('#dose_take_with_rx_other').text('');
                        $('#dose_anupan_rx_other').text('');*/
                        //$('#dose_anupan_rx_other').text('');
                        
                        $('#RX_other').val(data.RX_other);
                        $('#morning_dose_rx_other').val(data.morning_dose_rx_other);
                        $('#afternoon_dose_rx_other').val(data.afternoon_dose_rx_other);
                        $('#evening_dose_rx_other').val(data.evening_dose_rx_other);
                        //$('#dose_day_rx_other').val('');
                        $('#dose_take_with_rx_other').val(data.dose_take_with_rx_other);
                        $('#dose_anupan_rx_other').val(data.dose_anupan_rx_other);
                        
                        
                         $('#RX_other1').val(data.RX_other1);
                        $('#morning_dose_rx_other1').val(data.morning_dose_rx_other1);
                        $('#afternoon_dose_rx_other1').val(data.afternoon_dose_rx_other1);
                        $('#evening_dose_rx_other1').val(data.evening_dose_rx_other1);
                        //$('#dose_day_rx_other').val('');
                        $('#dose_take_with_rx_other1').val(data.dose_take_with_rx_other1);
                        $('#dose_anupan_rx_other1').val(data.dose_anupan_rx_other1);
                        
                        $('#other_equipment').val(data.other_equipment);
                        
                        
                        $('#RX2').val(data.RX2_medicine_name).select2().trigger('change');
                        $('#morning_dose_rx2').val(data.RX2_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_rx2').val(data.RX2_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_rx2').val(data.RX2_evening_dose).select2().trigger('change');
                        $('#dose_take_with_rx2').val(data.RX2_dose_take).select2().trigger('change');
                        //////$('#dose_anupan_rx2').val(data.RX2_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_rx2').val(data.RX2_dose_anupan);
                        
                        $('#RX3').val(data.RX3_medicine_name).select2().trigger('change');
                        $('#morning_dose_rx3').val(data.RX3_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_rx3').val(data.RX3_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_rx3').val(data.RX3_evening_dose).select2().trigger('change');
                        $('#dose_take_with_rx3').val(data.RX3_dose_take).select2().trigger('change');
                        //////$('#dose_anupan_rx3').val(data.RX3_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_rx3').val(data.RX3_dose_anupan);
                        
                        $('#RX4').val(data.RX4_medicine_name).select2().trigger('change');
                        $('#morning_dose_rx4').val(data.RX4_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_rx4').val(data.RX4_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_rx4').val(data.RX4_evening_dose).select2().trigger('change');
                        $('#dose_take_with_rx4').val(data.RX4_dose_take).select2().trigger('change');
                        $('#dose_anupan_rx4').val(data.RX4_dose_anupan).select2().trigger('change');
                        
                        $('#RX5').val(data.RX5_medicine_name).select2().trigger('change');
                        $('#morning_dose_rx5').val(data.RX5_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_rx5').val(data.RX5_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_rx5').val(data.RX5_evening_dose).select2().trigger('change');
                        $('#dose_take_with_rx5').val(data.RX5_dose_take).select2().trigger('change');
                        //////$('#dose_anupan_rx5').val(data.RX5_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_rx5').val(data.RX5_dose_anupan);
                        
                        $('#DRX1').val(data.DRX1_medicine_name).select2().trigger('change');
                        $('#morning_dose_drx1').val(data.DRX1_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_drx1').val(data.DRX1_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_drx1').val(data.DRX1_evening_dose).select2().trigger('change');
                        $('#dose_take_with_drx1').val(data.DRX1_dose_take).select2().trigger('change');
                        $('#dose_day_drx1').val(data.DRX1_dose_day).select2().trigger('change');
                        //////$('#dose_anupan_drx1').val(data.DRX1_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_drx1').val(data.DRX1_dose_anupan);
                        
                        $('#DRX2').val(data.DRX2_medicine_name).select2().trigger('change');
                        $('#morning_dose_drx2').val(data.DRX2_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_drx2').val(data.DRX2_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_drx2').val(data.DRX2_evening_dose).select2().trigger('change');
                        $('#dose_take_with_drx2').val(data.DRX2_dose_take).select2().trigger('change');
                        $('#dose_day_drx2').val(data.DRX2_dose_day).select2().trigger('change');
                        //////$('#dose_anupan_drx2').val(data.DRX2_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_drx2').val(data.DRX2_dose_anupan);
                        
                        $('#DRX3').val(data.DRX3_medicine_name).select2().trigger('change');
                        $('#morning_dose_drx3').val(data.DRX3_morning_dose).select2().trigger('change');
                        $('#afternoon_dose_drx3').val(data.DRX3_afternoon_dose).select2().trigger('change');
                        $('#evening_dose_drx3').val(data.DRX3_evening_dose).select2().trigger('change');
                        $('#dose_take_with_drx3').val(data.DRX3_dose_take).select2().trigger('change');
                        $('#dose_day_drx3').val(data.DRX3_dose_day).select2().trigger('change');
                        //////$('#dose_anupan_drx3').val(data.DRX3_dose_anupan).select2().trigger('change');
                        $('#dose_anupan_drx3').val(data.DRX3_dose_anupan);
                    }
                    else{
                        $('#ipd_days').val('');
                        $('#SNEHAN').val('').select2().trigger('change');
                        $('#SWEDAN').val('').select2().trigger('change');
                        $('#VAMAN').val('').select2().trigger('change');
                        $('#VIRECHAN').val('').select2().trigger('change');
                        $('#NASYA').val('').select2().trigger('change');
                        $('#BASTI').val('').select2().trigger('change');
                        $('#RAKTAMOKSHAN').val('').select2().trigger('change');
                        $('#SHIRODHARA_SHIROBASTI').val('').select2().trigger('change');
                        $('#OTHER').val('').select2().trigger('change');
                      
                       $('#SNEHAN').val('');
                        $('#SWEDAN').val('');
                        $('#VAMAN').val('');
                        $('#VIRECHAN').val('');
                        $('#NASYA').val('');
                        $('#BASTI').val('');
                        $('#RAKTAMOKSHAN').val('');
                        $('#SHIRODHARA_SHIROBASTI');
                        $('#OTHER').val('');
                        
                        // $('#HEMATOLOGICAL').val('').select2().trigger('change');
                        // $('#SEROLOGYCAL').val('').select2().trigger('change');
                        // $('#MICROBIOLOGICAL').val('').select2().trigger('change');
                        // $('#BIOCHEMICAL').val('').select2().trigger('change');
                        // $('#x_ray').val('').select2().trigger('change');
                        // $('#ECG').val('').select2().trigger('change');
                        // $('#USG').val('').select2().trigger('change');
                        
                        $('#HEMATOLOGICAL_label').text('');
                        $('#SEROLOGYCAL_label').text('');
                        $('#MICROBIOLOGICAL_label').text('');
                        $('#BIOCHEMICAL_label').text('');
                        $('#X_RAY_label').text('');
                        $('#ECG').val('').select2().trigger('change');
                        $('#USG_label').text('');
                        
                        $('#swa1').val('').select2().trigger('change');
                        $('#swa2').val('').select2().trigger('change');
                        
                        // $('#SROTAS').val('').select2().trigger('change');
                        // $('#DOSHA').val('').select2().trigger('change');
                        // $('#DUSHYA').val('').select2().trigger('change');
                        // $('#SHIROBASTI').val('').select2().trigger('change');
                        // $('#skarma').val('').select2().trigger('change');
                        // $('#vkarma').val('').select2().trigger('change');
                        
                        $('#RX1').val('').select2().trigger('change');
                        $('#morning_dose_rx1').val('').select2().trigger('change');
                        $('#afternoon_dose_rx1').val('').select2().trigger('change');
                        $('#evening_dose_rx1').val('').select2().trigger('change');
                        $('#dose_take_with_rx1').val('').select2().trigger('change');
                        //////$('#dose_anupan_rx1').val('').select2().trigger('change');
                        $('#dose_anupan_rx1').val('');
                        
                        
                        /*$('#RX_other').val('').select2().trigger('change');
                        $('#morning_dose_rx_other').val('').select2().trigger('change');
                        $('#afternoon_dose_rx_other').val('').select2().trigger('change');
                        $('#evening_dose_rx_other').val('').select2().trigger('change');
                        $('#dose_day_rx_other').val('').select2().trigger('change');
                        $('#dose_take_with_rx_other').val('').select2().trigger('change');
                        $('#dose_anupan_rx_other').val('');*/
                        
                        
                       /* $('#RX_other').text('');
                        $('#morning_dose_rx_other').text('');
                        $('#afternoon_dose_rx_other').text('');
                        $('#evening_dose_rx_other').text('');
                        $('#dose_take_with_rx_other').text('');
                        $('#dose_anupan_rx_other').text('');*/
                        
                        
                        $('#RX_other').val('');
                        $('#morning_dose_rx_other').val('');
                        $('#afternoon_dose_rx_other').val('');
                        $('#evening_dose_rx_other').val('');
                      //  $('#dose_day_rx_other').val('');
                        $('#dose_take_with_rx_other').val('');
                        $('#dose_anupan_rx_other').val('');
                        
                        
                        $('#RX_other1').val('');
                        $('#morning_dose_rx_other1').val('');
                        $('#afternoon_dose_rx_other1').val('');
                        $('#evening_dose_rx_other1').val('');
                      //  $('#dose_day_rx_other').val('');
                        $('#dose_take_with_rx_other1').val('');
                        $('#dose_anupan_rx_other1').val('');
                        
                        
                        
                         $('#other_equipment').val('');
                        
                        $('#RX2').val('').select2().trigger('change');
                        $('#morning_dose_rx2').val('').select2().trigger('change');
                        $('#afternoon_dose_rx2').val('').select2().trigger('change');
                        $('#evening_dose_rx2').val('').select2().trigger('change');
                        $('#dose_take_with_rx2').val('').select2().trigger('change');
                        //////$('#dose_anupan_rx2').val('').select2().trigger('change');
                        $('#dose_anupan_rx2').val('');
                        
                        $('#RX3').val('').select2().trigger('change');
                        $('#morning_dose_rx3').val('').select2().trigger('change');
                        $('#afternoon_dose_rx3').val('').select2().trigger('change');
                        $('#evening_dose_rx3').val('').select2().trigger('change');
                        $('#dose_take_with_rx3').val('').select2().trigger('change');
                        //////$('#dose_anupan_rx3').val('').select2().trigger('change');
                        $('#dose_anupan_rx3').val('');
                        
                        $('#RX4').val('').select2().trigger('change');
                        $('#morning_dose_rx4').val('').select2().trigger('change');
                        $('#afternoon_dose_rx4').val('').select2().trigger('change');
                        $('#evening_dose_rx4').val('').select2().trigger('change');
                        $('#dose_take_with_rx4').val('').select2().trigger('change');
                        //////$('#dose_anupan_rx4').val('').select2().trigger('change');
                        $('#dose_anupan_rx4').val('');
                        
                        $('#RX5').val('').select2().trigger('change');
                        $('#morning_dose_rx5').val('').select2().trigger('change');
                        $('#afternoon_dose_rx5').val('').select2().trigger('change');
                        $('#evening_dose_rx5').val('').select2().trigger('change');
                        $('#dose_take_with_rx5').val('').select2().trigger('change');
                        //////$('#dose_anupan_rx5').val('').select2().trigger('change');
                        $('#dose_anupan_rx5').val('');
                        
                        $('#DRX1').val('').select2().trigger('change');
                        $('#morning_dose_drx1').val('').select2().trigger('change');
                        $('#afternoon_dose_drx1').val('').select2().trigger('change');
                        $('#evening_dose_drx1').val('').select2().trigger('change');
                        $('#dose_take_with_drx1').val('').select2().trigger('change');
                        $('#dose_day_drx1').val('').select2().trigger('change');
                        //////$('#dose_anupan_drx1').val('').select2().trigger('change');
                        $('#dose_anupan_drx1').val('');
                        
                        $('#DRX2').val('').select2().trigger('change');
                        $('#morning_dose_drx2').val('').select2().trigger('change');
                        $('#afternoon_dose_drx2').val('').select2().trigger('change');
                        $('#evening_dose_drx2').val('').select2().trigger('change');
                        $('#dose_take_with_drx2').val('').select2().trigger('change');
                        $('#dose_day_drx2').val('').select2().trigger('change');
                        //////$('#dose_anupan_drx2').val('').select2().trigger('change');
                        $('#dose_anupan_drx2').val('');
                        
                        $('#DRX3').val('').select2().trigger('change');
                        $('#morning_dose_drx3').val('').select2().trigger('change');
                        $('#afternoon_dose_drx3').val('').select2().trigger('change');
                        $('#evening_dose_drx3').val('').select2().trigger('change');
                        $('#dose_take_with_drx3').val('').select2().trigger('change');
                        $('#dose_day_drx3').val('').select2().trigger('change');
                        //////$('#dose_anupan_drx3').val('').select2().trigger('change');
                        $('#dose_anupan_drx3').val('');
                    }
                }, 
                error : function()
                {
                    alert('failed');
                }
            });
        });
    });

    
   $(document).ready(function() {
   
   
   
       //check patient id
   
       $('#old_reg_no').keyup(function(){
   
           var pid = $(this);
           
           $.ajax({
   
               url  : '<?= base_url('patient/check_patient/') ?>',
   
               type : 'post',
   
               dataType : 'JSON',
   
               data : {
   
                   '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
   
                   old_reg_no : pid.val()
   
               },
   
               success : function(data) 
   
               {
   
                   if (data.status == true) {
                     //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                     //$('#yearly_no').val(data.patient.yearly_no);
                     
                     

                       $('#firstname').val(data.patient.firstname);
   					$('#blood_group').val(data.patient.blood_group);
   					$('#date_of_birth').val(data.patient.date_of_birth);
   					$('#degis_id').val(data.patient.degis_id);
   					$('#department_id').val(data.patient.department_id);
   					$('#dignosis').val(data.patient.dignosis);
   					$('#occupation').val(data.patient.occupation);
   					$('#address').val(data.patient.address);
                       $('#sex').val(data.patient.sex);
                       $('#create_date').val(data.patient.create_date);
   
                   } else if (data.status == false) {
   
                       pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
   
                   } else {
   
                       pid.next().text(data.message).addClass('text-danger').removeClass('text-success');
   
                   }
   
               }, 
   
               error : function()
   
               {
   
                   alert('failed');
   
               }
   
           });
   
       });
   
    
   
       //department_id   
       $("#department_id").change(function(){
   
           var output = $('.doctor_error'); 
   
           var doctor_list = $('#doctor_id');
   
           var availabel_day = $('#availabel_day');
           
            var x = document.getElementById("department_id").value;
   
            //alert(x);
   
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
   
                       availabel_day.html(data.availabel_days);
   
                       output.html('');
   
                   } else if (data.status == false) {
   
                       doctor_list.html('');
   
                       output.html(data.message).addClass('text-danger').removeClass('text-success');
   
                   } else {
   
                       doctor_list.html('');
   
                       output.html(data.message).addClass('text-danger').removeClass('text-success');
   
                   }
   
               }, 
   
               error : function()
   
               {
   
                   alert('failed');
   
               }
   
           });
   
       }); 
   
   
   
   
   
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
   
   
   function dignosis(){
		alert("dsdsd");
		
	}
   
   
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
   
   
   
       $( ".datepicker-avaiable-days" ).datepicker({
   
           dateFormat: "yy-mm-dd",
   
           changeMonth: true,
   
           changeYear: true,
   
           showButtonPanel: false,
   
           minDate: 0,  
   
           // beforeShowDay: DisableDays 
   
        });
   });
   
   //Hide show new old
   $(document).ready(function(){
       $("#old").hide();
       $("#ipdno").hide();
       $("#ipd").hide();
       $("#ipd2").hide();
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
   });

   //Show old registration number on ipd registration
   // $(document).ready(function(){
        

   // });

   
   // //Hide show IPD OPD
   // $(document).ready(function(){
   //     $("#ipd").hide();
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
<!--<script>
        CKEDITOR.replace( 'other_equipment' );
</script>-->