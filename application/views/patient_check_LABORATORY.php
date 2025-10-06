<div class="row">
 <!--   <?php// echo error_reporing(0);?>-->
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
        
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('patients/treatment_check_up_lib','class="form-inner"') ?>
            <?php echo form_hidden('id',$patient->id); ?>
            <?php echo form_hidden('patient_id',$patient->id); ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
                  
               <div class="col-md-6 col-sm-12">

                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname; echo " ".$patient->lastname; ?>" readonly>
						  <input name="text" type="hidden" class="form-control" id="patient_id" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->id; ?>" >
						  <input name="dignosis" type="hidden" class="form-control" id="dignosis" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->dignosis; ?>" >
						  <input name="section" type="hidden" class="form-control" id="section" placeholder="<?php echo display('section') ?>" value="<?php echo $patient->ipd_opd; ?>" >
                     </div>
                  </div>
				 <!-- <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">प्रमुख वेदना:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="compliance"  class="form-control" id="compliance" placeholder=""  ><?php echo $patient->compliance;?></textarea>
                     </div>
                  </div>-->
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Hb<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="Hb" type="text" class="form-control" id="Hb" placeholder="" value="<?php echo $patient->Hb;?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">TLC<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="TLC" type="text" class="form-control" id="h_o" placeholder="" value="<?php echo $patient->TLC;?>" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">DLC Neutro<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="DLC_Neutro" type="text" class="form-control" id="DLC_Neutro" placeholder="" value="<?php echo $patient->DLC_Neutro;?>" >
                     </div>
                  </div>
                  
                  
                   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Lymphocytes<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="Lymphocytes" type="text" class="form-control" id="Lymphocytes" placeholder="" value="<?php echo $patient->Lymphocytes;?>" >
                     </div>
                     
                     </div>
                     <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Monocytes<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                     <input name="Monocytes" type="text" class="form-control" id="Monocytes" placeholder="" value="<?php echo $patient->Monocytes;?>" >
                     </div>
                  
				   </div>
				   
				   
                   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">ESR (Westergren)	<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="ESR" type="text" class="form-control" id="ESR" placeholder="" value="<?php echo $patient->ESR;?>" >
                     </div>
                     
                     </div>
                     
                      <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Platelet_Count	<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="Platelet_Count" type="text" class="form-control" id="Platelet_Count" placeholder="" value="<?php echo $patient->Platelet_Count;?>" >
                     </div>
                     
                     </div>
				  
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">VLD.L :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="VLDL" type="text" class="form-control" id="VLDL" placeholder="" value="<?php echo $patient->VLDL;?>" >
                     </div>
                  </div>
                  
                  
                   
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Billirubin T:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="BillirubinI" type="text" class="form-control" id="BillirubinI" placeholder="" value="<?php echo $patient->BillirubinI;?>" >
                     </div>
                  </div>
                  
                  
                   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Billirubin T:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="BillirubinI" type="text" class="form-control" id="BillirubinI" placeholder="" value="<?php echo $patient->BillirubinI;?>" >
                     </div>
                  </div>
                  
                  
                   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Billirubin I	:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="BillirubinT" type="text" class="form-control" id="BillirubinT" placeholder="" value="<?php echo $patient->BillirubinT;?>" >
                     </div>
                  </div>
                  
                  
                   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Billirubin D	:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="BillirubinI" type="text" class="form-control" id="BillirubinI" placeholder="" value="<?php echo $patient->BillirubinI;?>" >
                     </div>
                  </div>
				 
                 </div>
			   
			   
               <div class="col-md-6 col-sm-12">
			   
			     
			      <div class="form-group row">
                     <label for="ipd_no" class="col-xs-3 col-form-label">No.<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php $ye_no=$patient->yearly_reg_no; if($ye_no){ echo $ye_no;}else { echo $patient->old_reg_no; } ?>" readonly>
                     </div>
                  </div>
			
				   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">B.Sugar <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="B_Sugar" type="text" class="form-control" id="B_Sugar" placeholder="" value="<?php echo $patient->B_Sugar;?>" >
                     </div>
                  </div>
                  
                 <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Blood Sugar <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="Blood_Sugar" type="text" class="form-control" id="Blood_Sugar" placeholder="" value="<?php echo $patient->Blood_Sugar;?>" >
                     </div>
                  </div>
                  
				 
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Blood Urea :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="Blood_Urea" type="text" class="form-control" id="Blood_Urea" placeholder="" value="<?php echo $patient->Blood_Urea;?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Creatinine	 :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="S_Creatinine	" type="text" class="form-control" id="S_Creatinine	" placeholder="" value="<?php echo $patient->S_Uric_Acid;?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S_Uric Acid :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="S_Uric_Acid" type="text" class="form-control" id="S_Uric_Acid" placeholder="" value="<?php echo $patient->S_Uric_Acid;?>" >
                     </div>
                  </div>
				  
				    <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Na :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="SNat" type="text" class="form-control" id="SNat" placeholder="" value="<?php echo $patient->SNat;?>" >
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.K.+ :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="SK" type="text" class="form-control" id="SK" placeholder="" value="<?php echo $patient->SK;?>" >
                     </div>
                  </div>
                  
                  
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.CL. :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="Scl" type="text" class="form-control" id="Scl" placeholder="" value="<?php echo $patient->Scl;?>" >
                     </div>
                  </div>
                  
                  
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Total Cholestrol	 :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="Total_Cholestrol" type="text" class="form-control" id="Total_Cholestrol" placeholder="" value="<?php echo $patient->Total_Cholestrol;?>" >
                     </div>
                  </div>
                  
                  
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">S.Tg :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="STg" type="text" class="form-control" id="STg" placeholder="" value="<?php echo $patient->STg;?>" >
                     </div>
                  </div>
                  
                  
                   
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">H.DL :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="HDL" type="text" class="form-control" id="HDL" placeholder="" value="<?php echo $patient->HDL;?>" >
                     </div>
                  </div>
                  
                  
                   
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">L.D.L :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="LDL" type="text" class="form-control" id="LDL" placeholder="" value="<?php echo $patient->LDL;?>" >
                     </div>
                  </div>
                  
                  
                 
                  
                  
                  
				  
				  
                 
				  
				  
                  
                   
				 
                 
                  
               
               </div>
            </div>
               
            </div>
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
               <?php echo form_close() ?> 
            </div>
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
                        <a href="javascript:window.history.go(-1);" type="reset" class="btn btn-info">Back</a>
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                       <!-- <button class="ui positive button"><?php echo display('save') ?></button>-->
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