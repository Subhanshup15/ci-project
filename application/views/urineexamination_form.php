<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("urineexamination") ?>"> <i class="fa fa-list"></i>  Urineexamination list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('urineexamination/create','class="form-inner"') ?>
            <?php echo form_hidden('id',$urineexamination->id); ?>        
                  
               <div class="col-md-6 col-sm-12">               
                  
                  <div class="form-group row">
                     <label for="opd_no" class="col-xs-3 col-form-label">Opd No</label>
                     <div class="col-xs-9">
                        <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?php echo $urineexamination->opd_no ?>">    
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="name" class="col-xs-3 col-form-label">Name</label>
                     <div class="col-xs-9">
                        <input name="name" autocomplete="off" type="text" class="form-control" id="name" placeholder="Name" value="<?php echo $urineexamination->name ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="age" class="col-xs-3 col-form-label">Age</label>
                     <div class="col-xs-9">
                        <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="Age" value="<?php echo $urineexamination->age ?>">    
                     </div>
                  </div>                 
                </div>
                <div class="col-md-6">
                    
                  <div class="form-group row">
                     <label for="sex" class="col-xs-3 col-form-label">Sex</label>
                     <div class="col-xs-9">
                        <input name="sex" autocomplete="off" type="text" class="form-control" id="sex" placeholder="Sex" value="<?php echo $urineexamination->sex ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="doctor" class="col-xs-3 col-form-label">Doctor</label>
                     <div class="col-xs-9">
                        <input name="doctor" autocomplete="off" type="text" class="form-control" id="doctor" placeholder="Doctor" value="<?php echo $urineexamination->doctor ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="date" class="col-xs-3 col-form-label">Date</label>
                     <div class="col-xs-9">
                        <input name="date" autocomplete="off" type="text" class="form-control datepicker" id="date" placeholder="Date" value="<?php echo $urineexamination->date ?>">    
                     </div>
                  </div> 
                </div>
                
            </div>
                <div class="row panel-body panel-form">
                    <div class="col-md-6">
                        <div class="form-group row">
                        <label for="colour" class="col-xs-3 col-form-label">Colour</label>
                        <div class="col-xs-9">
                            <input name="colour" autocomplete="off" type="text" class="form-control" id="colour" placeholder="Date" value="<?php echo $urineexamination->colour ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="appearance" class="col-xs-3 col-form-label">Appearance</label>
                        <div class="col-xs-9">
                            <input name="appearance" autocomplete="off" type="text" class="form-control" id="appearance" placeholder="Appearance" value="<?php echo $urineexamination->appearance ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="deposit" class="col-xs-3 col-form-label">Deposit</label>
                        <div class="col-xs-9">
                            <input name="deposit" autocomplete="off" type="text" class="form-control" id="deposit" placeholder="Deposit" value="<?php echo $urineexamination->appearance ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="reaction" class="col-xs-3 col-form-label">Reaction</label>
                        <div class="col-xs-9">
                            <input name="reaction" autocomplete="off" type="text" class="form-control" id="reaction" placeholder="Reaction" value="<?php echo $urineexamination->reaction ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="specificgravity" class="col-xs-3 col-form-label">Specificgravity</label>
                        <div class="col-xs-9">
                            <input name="specificgravity" autocomplete="off" type="text" class="form-control" id="specificgravity" placeholder="Specificgravity" value="<?php echo $urineexamination->specificgravity ?>">    
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="sugar" class="col-xs-3 col-form-label">Sugar</label>
                        <div class="col-xs-9">
                            <input name="sugar" autocomplete="off" type="text" class="form-control" id="sugar" placeholder="Sugar" value="<?php echo $urineexamination->sugar ?>">    
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="ketone" class="col-xs-3 col-form-label">Ketone</label>
                        <div class="col-xs-9">
                            <input name="ketone" autocomplete="off" type="text" class="form-control" id="ketone" placeholder="ketone" value="<?php echo $urineexamination->ketone ?>">    
                        </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group row">
                        <label for="bilesalts" class="col-xs-3 col-form-label">Bilesalts</label>
                        <div class="col-xs-9">
                            <input name="bilesalts" autocomplete="off" type="text" class="form-control" id="bilesalts" placeholder="bilesalts" value="<?php echo $urineexamination->bilesalts ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="bilepigmetics" class="col-xs-3 col-form-label">Bilepigmetics</label>
                        <div class="col-xs-9">
                            <input name="bilepigmetics" autocomplete="off" type="text" class="form-control" id="bilepigmetics" placeholder="Bilepigmetics" value="<?php echo $urineexamination->bilepigmetics ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="puscells" class="col-xs-3 col-form-label">Puscells</label>
                        <div class="col-xs-9">
                            <input name="puscells" autocomplete="off" type="text" class="form-control" id="puscells" placeholder="Puscells" value="<?php echo $urineexamination->puscells ?>">    
                        </div>
                        </div> 

                        <div class="form-group row">
                        <label for="epithelial" class="col-xs-3 col-form-label">Epithelial</label>
                        <div class="col-xs-9">
                            <input name="epithelial" autocomplete="off" type="text" class="form-control" id="epithelial" placeholder="Epithelial" value="<?php echo $urineexamination->epithelial ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="casts" class="col-xs-3 col-form-label">Casts</label>
                        <div class="col-xs-9">
                            <input name="casts" autocomplete="off" type="text" class="form-control" id="casts" placeholder="Casts" value="<?php echo $urineexamination->casts ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="crystals" class="col-xs-3 col-form-label">Crystals</label>
                        <div class="col-xs-9">
                            <input name="crystals" autocomplete="off" type="text" class="form-control" id="crystals" placeholder="Crystals" value="<?php echo $urineexamination->crystals ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="bacteria" class="col-xs-3 col-form-label">Bacteria</label>
                        <div class="col-xs-9">
                            <input name="bacteria" autocomplete="off" type="text" class="form-control" id="bacteria" placeholder="bacteria" value="<?php echo $urineexamination->bacteria ?>">    
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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