<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("laboratory/listseological") ?>"> <i class="fa fa-list"></i> Laboratory list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('laboratory/seological','class="form-inner"') ?>
            <?php echo form_hidden('id',$lab->id); ?>        
                  
               <div class="col-md-6 col-sm-12"> 

               <div class="form-group row">
                     <label for="opd_no" class="col-xs-3 col-form-label">Opd No</label>
                     <div class="col-xs-9">
                        <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?php echo $lab->opd_no ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="name" class="col-xs-3 col-form-label">Name <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="name" autocomplete="off" type="text" class="form-control" id="name" placeholder="Name" value="<?php echo $lab->name ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="age" class="col-xs-3 col-form-label">Age <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="Age" value="<?php echo $lab->age ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="sex" class="col-xs-3 col-form-label">Sex <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="sex" autocomplete="off" type="text" class="form-control" id="sex" placeholder="Sex" value="<?php echo $lab->sex ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="date" class="col-xs-3 col-form-label">Date <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="date" autocomplete="off" type="text" class="form-control datepicker" id="date" placeholder="Date" value="<?php echo $lab->date ?>">    
                     </div>
                  </div>                  
                </div>
                <div class="col-md-6">
                <div class="form-group row">
                     <label for="unitno" class="col-xs-3 col-form-label">Unit no <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="unitno" autocomplete="off" type="text" class="form-control" id="unitno" placeholder="Unit no" value="<?php echo $lab->unitno ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="ward" class="col-xs-3 col-form-label">Ward No <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="ward" autocomplete="off" type="text" class="form-control" id="ward" placeholder="Ward" value="<?php echo $lab->ward ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="bedno" class="col-xs-3 col-form-label">Bed No <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="bedno" autocomplete="off" type="text" class="form-control" id="bedno" placeholder="Bed" value="<?php echo $lab->bedno ?>">    
                     </div>
                  </div>
                </div>
            </div>
                <div class="row panel-body panel-form">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="hbs" class="col-xs-5 col-form-label">Hbs Ag</label>
                            <div class="col-xs-7">
                                <input name="hbs" autocomplete="off" type="text" class="form-control" id="hbs" placeholder="hbs" value="<?php echo $lab->hbs ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hiv" class="col-xs-5 col-form-label">HIV I &amp;II</label>
                            <div class="col-xs-7">
                                <input name="hiv" autocomplete="off" type="text" class="form-control" id="hiv" placeholder="hiv" value="<?php echo $lab->hiv ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vdrl" class="col-xs-5 col-form-label">VDRL</label>
                            <div class="col-xs-7">
                                <input name="vdrl" autocomplete="off" type="text" class="form-control" id="vdrl" placeholder="vdrl" value="<?php echo $lab->vdrl ?>">    
                            </div>
                        </div>  



                        <div class="form-group row">
                            <label for="widal_test" class="col-xs-5 col-form-label">Widal Test S. Typhi</label>
                            <div class="col-xs-7">
                                <input name="widal_test" autocomplete="off" type="text" class="form-control" id="widal_test" placeholder="widal_test" value="<?php echo $lab->widal_test ?>">    
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <label for="sparatyphi" class="col-xs-5 col-form-label">S. Paratyhi</label>
                            <div class="col-xs-7">
                                <input name="sparatyphi" autocomplete="off" type="text" class="form-control" id="sparatyphi" placeholder="sparatyphi" value="<?php echo $lab->sparatyphi ?>">    
                            </div>
                        </div>
                        -->
                        <div class="form-group row">
                            <label for="rafactor" class="col-xs-5 col-form-label">R. A. Factor</label>
                            <div class="col-xs-7">
                                <input name="rafactor" autocomplete="off" type="text" class="form-control" id="rafactor" placeholder="rafactor" value="<?php echo $lab->rafactor ?>">    
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <label for="mxtest" class="col-xs-5 col-form-label">Mx Test</label>
                            <div class="col-xs-7">
                                <input name="mxtest" autocomplete="off" type="text" class="form-control" id="mxtest" placeholder="mxtest" value="<?php echo $lab->mxtest ?>">    
                            </div>
                        </div>
                         
                        <div class="form-group row">
                            <label for="sputum" class="col-xs-5 col-form-label">Sputum For AFB</label>
                            <div class="col-xs-7">
                                <input name="sputum" autocomplete="off" type="text" class="form-control" id="sputum" placeholder="sputum" value="<?php echo $lab->sputum ?>">    
                            </div>
                        </div>
                        -->
                    </div>

                    <div class="col-md-4">                    
                        

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

           url  : '<?= base_url('patients/check_patient/') ?>',

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