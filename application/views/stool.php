<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("liststool") ?>"> <i class="fa fa-list"></i> Laboratory list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('laboratory/stool','class="form-inner"') ?>
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
                            <label for="color" class="col-xs-5 col-form-label">Color</label>
                            <div class="col-xs-7">
                                <input name="color" autocomplete="off" type="text" class="form-control" id="color" placeholder="color" value="<?php echo $lab->color ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="consistency" class="col-xs-5 col-form-label">Consistency</label>
                            <div class="col-xs-7">
                                <input name="consistency" autocomplete="off" type="text" class="form-control" id="consistency" placeholder="consistency" value="<?php echo $lab->consistency ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mucous" class="col-xs-5 col-form-label">Mucous</label>
                            <div class="col-xs-7">
                                <input name="mucous" autocomplete="off" type="text" class="form-control" id="mucous" placeholder="mucous" value="<?php echo $lab->mucous ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="pus_cell" class="col-xs-5 col-form-label">Pus cell</label>
                            <div class="col-xs-7">
                                <input name="pus_cell" autocomplete="off" type="text" class="form-control" id="pus_cell" placeholder="pus_cell" value="<?php echo $lab->pus_cell ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rsc" class="col-xs-5 col-form-label">RBC's</label>
                            <div class="col-xs-7">
                                <input name="rsc" autocomplete="off" type="text" class="form-control" id="rsc" placeholder="rsc" value="<?php echo $lab->rsc ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="epitheliacells" class="col-xs-5 col-form-label">Epithelial cells</label>
                            <div class="col-xs-7">
                                <input name="epitheliacells" autocomplete="off" type="text" class="form-control" id="epitheliacells" placeholder="epitheliacells" value="<?php echo $lab->epitheliacells ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="epitheliacells" class="col-xs-5 col-form-label">Other</label>
                            <div class="col-xs-7">
                                <input name="epitheliacells" autocomplete="off" type="text" class="form-control" id="epitheliacells" placeholder="other" value="<?php echo $lab->epitheliacells ?>">    
                            </div>
                        </div>
        
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