<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("xray") ?>"> <i class="fa fa-list"></i>  Xray list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('xray/create','class="form-inner"') ?>
            <?php echo form_hidden('id',$xray->id); ?>        
                  
               <div class="col-md-6 col-sm-12"> 

               <div class="form-group row">
                     <label for="opd_no" class="col-xs-3 col-form-label">Opd No</label>
                     <div class="col-xs-9">
                        <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?php echo $xray->opd_no ?>">    
                     </div>
                  </div>

               <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">Date </label>
                     <div class="col-xs-9">
                        <input name="create_date" autocomplete="off" type="text" class="form-control datepicker" id="create_date" placeholder="" value="<?php echo $xray->create_date ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="reg_no" class="col-xs-3 col-form-label">Registred Number <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="reg_no" autocomplete="off" type="text" class="form-control" id="reg_no" placeholder="" value="<?php echo $xray->reg_no ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="opd_no" class="col-xs-3 col-form-label">OPD Number <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="" value="<?php echo $xray->opd_no ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="ipd_no" class="col-xs-3 col-form-label">IPD Number <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="ipd_no" autocomplete="off" type="text" class="form-control" id="ipd_no" placeholder="" value="<?php echo $xray->ipd_no ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="name" class="col-xs-3 col-form-label">Name <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="name" autocomplete="off" type="text" class="form-control" id="name" placeholder="Patient Name" value="<?php echo $xray->name ?>">    
                     </div>
                  </div>                  
                </div>
                <div class="col-md-6">
                <div class="form-group row">
                     <label for="age" class="col-xs-3 col-form-label">Age<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="Age" value="<?php echo $xray->age ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <?php echo form_dropdown('department_id',$department_list,$xray->department_id,'class="form-control" id="department_id"') ?>
                        <span class="doctor_error"></span>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="xray_chesast" class="col-xs-3 col-form-label">Xray Chesast<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="xray_chesast" autocomplete="off" type="text" class="form-control" id="xray_chesast" placeholder="" value="<?php echo $xray->xray_chesast ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="xray_kub" class="col-xs-3 col-form-label">Xray Kub<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="xray_kub" autocomplete="off" type="text" class="form-control" id="xray_kub" placeholder="" value="<?php echo $xray->xray_kub ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="other" class="col-xs-3 col-form-label">Other</label>
                     <div class="col-xs-9">
                        <input name="other" autocomplete="off" type="text" class="form-control" id="other" placeholder="" value="<?php echo $xray->other ?>">    
                     </div>
                  </div>
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

<script>
$(document).ready(function() {
   
   $('#opd_no').keyup(function(){

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
                 
                 

                   $('#name').val(data.patient.firstname);
              $('#age').val(data.patient.date_of_birth);
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

})

   </script>