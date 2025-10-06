
<?php echo error_reporting(0);?>
<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div>									
            <?php echo form_open_multipart('patients/import');?>                      
            <label>Excel File for OPD:</label>                        
            <input type="file" name="userfile" />				                   
            <input type="submit" value="upload" name="upload" />
            </form>	
         </div>
            <div>									
            <?php echo form_open_multipart('patients/import_ipd');?>                      
            <label>Excel File for IPD:</label>                        
            <input type="file" name="userfile" />				                   
            <input type="submit" value="upload" name="upload" />
            </form>	
         </div>
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("patients") ?>"> <i class="fa fa-list"></i>  <?php echo display('patient_list') ?> </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('patients/create','class="form-inner"') ?>
            <?php echo form_hidden('id',$patient->id); ?>
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
                           echo form_dropdown('ipd_opd', $ipd_opd, $patient->ipd_opd, 'class="form-control" id="ipd_opd" ');
                           ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="status" class="col-xs-3 col-form-label"><?php echo display('status') ?></label>
                     <div class="col-xs-9"> 
                        <?php
                           $status = array(
                               ''   => display('select_option'),
                               'new' => 'New',
                               'old' => 'Old',
                           );
                           echo form_dropdown('status', $status, $patient->status, 'class="form-control" id="status" '); 
                           ?>
                     </div>
                  </div>
                  <div class="form-group row" id="old">
                     <label for="old_reg_no" class="col-xs-3 col-form-label"><?php echo display('old_reg_no') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="old_reg_no" autocomplete="off" type="text" class="form-control" id="old_reg_no" placeholder="Old Reg. No or Patient Name" value="<?php echo $patient->old_reg_no ?>">    
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
                  
               <div class="col-md-6 col-sm-12">
                    <?php 
                     $year = '%'.$this->session->userdata['acyear'].'%';
                     $result = $this->db->select("*")
                    ->from('patient')
                    ->where('yearly_reg_no is NOT NULL', NULL, FALSE)
                    ->where('create_date like', $year) 
                  
			        ->order_by("id", "desc")
			        ->limit(1)
			        ->get()
			        ->row();
			      // echo $result->yearly_reg_no;
			        
			      // echo $serial_no;
                     $result1 = $this->db->select("*")
                    ->from('patient_ipd')
                    ->where('yearly_reg_no is NOT NULL', NULL, FALSE)
                    ->where('create_date like', $year) 
                  
			        ->order_by("id", "desc")
			        ->limit(1)
			        ->get()
			        ->row();
			      // echo  $result1->yearly_reg_no;
                    ?>
               
                  <div class="form-group row" id="yearly_no1">
                     <label for="yearly_no" class="col-xs-3 col-form-label">Opd Reg No.</label>
                     <div class="col-xs-9">
                        <input name="yearly_reg_no" autocomplete="off" type="text" class="form-control" id="yearly_reg_no" placeholder="<?php echo display('yearly_reg_no_or_Patient_Name') ?>" value="<?php if($serial_no =='1') { echo $result->yearly_reg_no + 1; } else if($patient->yearly_reg_no){ echo $patient->yearly_reg_no;} else {
                         echo "";}?>">    
                     </div>
                  </div>         
                  <input type="hidden" name="ipd_year_reg_no"  id="ipd_year_reg_no" value="<?php echo $result->yearly_reg_no + 1;?>">
                   <input type="hidden" name="opd_year_reg_no" id="opd_year_reg_no" value="<?php echo $result->yearly_reg_no + 1;?>">
                  <!-- <div class="form-group row">
                     <label for="yearly_reg_no" class="col-xs-3 col-form-label">Yearly Reg. No. <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="yearly_reg_no" autocomplete="off" type="text" class="form-control" id="yearly_reg_no" placeholder="<?php echo display('yearly_reg_no') ?>" value="<?php echo $patient->yearly_reg_no ?>">    
                     </div>
                  </div>    -->

               <!-- <div class="form-group row">
                     <label for="monthly_reg_no" class="col-xs-3 col-form-label">Monthly Reg. No <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="monthly_reg_no" autocomplete="off" type="text" class="form-control" id="monthly_reg_no" placeholder="<?php echo display('monthly_reg_no') ?>" value="<?php echo $patient->monthly_reg_no ?>">    
                     </div>
                  </div>  -->

                  <!-- <div class="form-group row">
                     <label for="daily_reg_no" class="col-xs-3 col-form-label">Daily Reg. No <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="daily_reg_no" autocomplete="off" type="text" class="form-control" id="daily_reg_no" placeholder="<?php echo display('daily_reg_no') ?>" value="<?php echo $patient->daily_reg_no ?>">    
                     </div>
                  </div>    -->

                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname ?>" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date_of_birth') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="date_of_birth" class="form-control" type="text" placeholder="<?php echo display('date_of_birth') ?>" id="date_of_birth"  value="<?php echo $patient->date_of_birth ?>">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="dignosis" class="col-xs-3 col-form-label"><?php echo display('dignosis') ?></label>
                     <div class="col-xs-9">
                     <input name="dignosis" autocomplete="off" type="text" class="form-control" id="dignosis" placeholder="Dignosis" value="<?php echo $patient->dignosis ?>">    
                     <!-- <?php //echo form_dropdown('id_digno_sub',$dignosis_list,$patient->id_digno_sub,'class="form-control" id="id_digno_sub"') ?> -->
                     </div>
                  </div>

                  <!-- <div class="form-group row">
                     <label for="income" class="col-xs-3 col-form-label"><?php echo display('income') ?></label>
                     <div class="col-xs-9">
                     <input name="income" type="text" class="form-control" id="income" placeholder="<?php echo display('income') ?>" value="<?php echo $patient->income ?>" >                                       
                     </div>                                    
                     </div> -->
                  <!--<div class="form-group row">
                     <label for="occupation" class="col-xs-3 col-form-label"><?php echo display('occupation') ?></label>
                     <div class="col-xs-9">
                        <input name="occupation" type="text" class="form-control" id="occupation" placeholder="<?php echo display('occupation') ?>" value="<?php echo $patient->occupation ?>" >                                       
                     </div>
                  </div>-->
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
                           
                               'Jobless ' => 'Jobless',
                               
                               'Other ' => 'Other'
                           
                           );
                           
                           //echo form_dropdown('occupation', $occupation, $patient->occupation, 'class="form-control" id="occupation" '); 
                           
                           ?>
                            <select name="occupation" id="occupation" style="padding: 7px; border: 1px solid #e4e5e7; width: 344.625px;"">
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
               </div>
               <div class="col-md-6 col-sm-12">
                  <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label"><?php echo display('create_date') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="create_date" class="datepicker form-control" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?php echo $patient->create_date ?>">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                         
                       <!-- <?php echo form_dropdown('department_id',$department_list,$patient->department_id,'class="form-control" id="department_id"') ?>-->
                       <select name="department_id" id="department_id" style="padding: 7px; border: 1px solid #e4e5e7; width: 344.625px;">
								 
					   	    <?php foreach($department_list as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->department_id==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                        
                        <span class="doctor_error"></span>
                     </div>
                  </div>
                  <!-- <div class="form-group row">
                     <label for="mobile" class="col-xs-3 col-form-label"><?php echo display('mobile') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                         <input name="mobile" class="form-control" type="text" placeholder="<?php echo display('mobile') ?>" id="mobile"  value="<?php echo $patient->mobile ?>">
                     </div>
                     </div> -->
                  <div class="form-group row">
                     <label class="col-sm-3"><?php echo display('sex') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <div class="form-check">
                           <label class="radio-inline">
                           <input type="radio" name="sex"  id="sex" value="<?php echo display('male') ?>" <?php if($patient->sex=='M'){ echo "checked";}?> ><?php echo display('male') ?>
                         
                           </label>
                           <label class="radio-inline">
                           <input type="radio" name="sex" id="sex" value="<?php echo display('female') ?>" <?php if($patient->sex=='F'){ echo "checked";}?> ><?php echo display('female') ?>
                           </label>
                           <label class="radio-inline">
                           <input type="radio" name="sex" id="sex" value="Boy" <?php echo  set_radio('sex', 'Boy'); ?> >Boy
                           </label>
                           <label class="radio-inline">
                           <input type="radio" name="sex" id="sex" value="Girl" <?php echo  set_radio('sex', 'Girl'); ?> >Girl
                           </label>
                           <label class="radio-inline">
                           <input type="radio" name="sex" id="sex" value="Other" <?php echo  set_radio('sex', 'Other'); ?> ><?php echo display('other') ?>
                           </label>
                        </div>
                     </div>
                  </div>
                  <!--<div class="form-group row">
                     <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <textarea name="address" class="form-control" id="address"  placeholder="<?php echo display('address') ?>" maxlength="140" rows="4"><?php echo $patient->address ?></textarea>
                     </div>
                  </div>-->
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">Address<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="address" id="address" style="padding: 7px; border: 1px solid #e4e5e7; width: 344.625px;">
											<option value="">Select Address</option>
					   	    <?php 
									 foreach($address_list as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x_val; ?>" <?php if($patient->address==$x_val){ echo "selected";} ?> ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
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
                           
                           //echo form_dropdown('blood_group', $bloodList, $patient->blood_group, 'class="form-control" id="blood_group" '); 
                           
                           ?>
                            <select name="blood_group" id="blood_group" style="padding: 7px; border: 1px solid #e4e5e7; width: 344.625px;">
								 
					   	    <?php foreach($bloodList as $x => $x_val ){ ?>
								  <option value="<?php echo $x_val; ?>" <?php if($patient->blood_group==$x_val){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row" id="ipd2">
               <div class="col-md-6 col-sm-12">
                  <!-- <div class="form-group row">
                     <label for="wardType" class="col-xs-3 col-form-label"><?php echo display('wardType') ?></label>
                     <div class="col-xs-9">
                     <input name="wardType" type="text" class="form-control" id="wardType" placeholder="<?php echo display('wardType') ?>" value="<?php echo $patient->wardType ?>" >                                       
                     </div>                                    
                     </div>  -->
                  <div class="form-group row">
                     <label for="anesthesia" class="col-xs-3 col-form-label"><?php echo display('anesthesia') ?></label>
                     <div class="col-xs-9">
                        <input name="anesthesia" type="text" class="form-control" id="anesthesia" placeholder="<?php echo display('anesthesia') ?>" value="<?php echo $patient->anesthesia ?>" >                                       
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="assign_date" class="col-xs-3 col-form-label"><?php echo display('assign_date') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="assign_date"  type="text" class="form-control datepicker dateChange" id="assign_date" placeholder="<?php echo display('assign_date') ?>" value="<?php echo $patient->assign_date ?>" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="doctor_id" class="col-xs-3 col-form-label"><?php echo display('doctor_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <?php echo form_dropdown('doctor_id','','','class="form-control" id="doctor_id"') ?>
                        <div id="availabel_days"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-sm-12">
                  <div class="form-group row">
                     <label for="bedNo" class="col-xs-3 col-form-label"><?php echo display('bedNo') ?></label>
                     <!--<div class="col-xs-9">
                        <input name="bedNo" type="text" class="form-control" id="bedNo" placeholder="<?php echo display('bedNo') ?>" value="<?php echo $patient->bedNo ?>" >                                       
                     </div>-->
                      <div class="col-xs-9">
                        <?php echo form_dropdown('bedNo','','','class="form-control" id="bedNo"') ?>
                        <div id="availabel_days"></div>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="result" class="col-xs-3 col-form-label"><?php echo display('result') ?></label>
                     <div class="col-xs-9">
                        <input name="result" type="text" class="form-control" id="result" placeholder="<?php echo display('result') ?>" value="<?php echo $patient->result ?>" >                                       
                     </div>
                  </div>
                  <!-- <div class="form-group row">
                     <label for="religion" class="col-xs-3 col-form-label"><?php echo display('religion') ?></label>
                     <div class="col-xs-9">
                     <input name="religion" type="text" class="form-control" id="religion" placeholder="<?php echo display('religion') ?>" value="<?php echo $patient->religion ?>" >                                       
                     </div>                                    
                     </div> -->
                  <div class="form-group row">
                     <label for="discharge_date" class="col-xs-3 col-form-label"><?php echo display('discharge_date') ?></label>
                     <div class="col-xs-9">
                        <input name="discharge_date"  type="text" class="form-control datepicker dateChange" id="discharge_date" placeholder="<?php echo display('discharge_date') ?>" value="<?php echo $patient->discharge_date ?>" >
                        <div class="help-block"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group row" style="padding-left: 155px;">
               <label class="col-sm-1"><?php echo display('status') ?></label>
               <div class="col-xs-3">
                  <div class="form-check">
                     <label class="radio-inline">
                     <input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?> ><?php echo display('active') ?>
                     </label>
                     <label class="radio-inline">
                     <input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?> ><?php echo display('inactive') ?>
                     </label>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-offset-3 col-sm-6">
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
   </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
   
   
   
       //check patient id
   
       $('#old_reg_no').keyup(function(){
   
           var pid = $(this);
           
           $.ajax({
   
               url  : '<?= base_url('patients/check_patient/') ?>',
   
               type : 'post',
   
               dataType : 'JSON',
   
               data : {
   
                   '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
   
                   old_reg_no : pid.val()
   
               },
   
               success : function(data) 
               {
                  // alert(data.patient1);
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
   					//$('#weight').val(data.patient.weight);
   					
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
   
                   //alert('failed');
   
               }
   
           });
   
       });
   
    function ShowHideDiv() {
         var chkYes = document.getElementById("sex");
          alert(chkYes);
       };
   
       //department_id   
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