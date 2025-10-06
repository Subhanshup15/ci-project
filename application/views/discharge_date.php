<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('patient/dischargedate','class="form-inner"') ?>
            
            </div>
            
              
               <div class="col-md-6 col-sm-12">
                  <div class="form-group row">
                     <label for="discharge_date" class="col-xs-3 col-form-label"><?php echo display('discharge_date') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="discharge_date"  type="text" class="form-control datepicker dateChange" id="discharge_date" placeholder="<?php echo display('discharge_date') ?>" value="<?php echo $patient->discharge_date ?>" >
                        <div class="help-block"></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group row">
                  
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
       $('#status').on('change', function() {
        var ipdopd = document.getElementById("ipd_opd").value; 
        
         if ( this.value == 'old' && ipdopd == 'ipd')
         {
           $("#old").show();
         }else if(this.value == 'new' && ipdopd == 'ipd')
         {
           $("#old").show();
         }else if(this.value == 'old' && ipdopd == 'opd'){
             $("#old").show();
         }else{
             $("#old").hide();
         }
       });
   });

   //Show old registration number on ipd registration
   $(document).ready(function(){
        

   });

   
   //Hide show IPD OPD
   $(document).ready(function(){
       $("#ipd").hide();
       $("#ipd2").hide();
       $('#ipd_opd').on('change', function() {
         if ( this.value == 'ipd')
         {
           $("#ipd").show();
           $("#ipd2").show();
           $("#old").show();
         }
         else
         {
           $("#ipd").hide();
           $("#ipd2").hide();
         }
       });
   });
</script>