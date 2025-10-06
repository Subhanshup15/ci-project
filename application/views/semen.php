<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="pus_cellsn-group"> 
               <a class="pus_cellsn pus_cellsn-primary" href="<?php echo base_url("listsemen") ?>"> <i class="fa fa-list"></i> Laboratory list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('laboratory/semen','class="form-inner"') ?>
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
                            <label for="volume" class="col-xs-5 col-form-label">volume</label>
                            <div class="col-xs-7">
                                <input name="volume" autocomplete="off" type="text" class="form-control" id="volume" placeholder="volume" value="<?php echo $lab->volume ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="colour" class="col-xs-5 col-form-label">colour</label>
                            <div class="col-xs-7">
                                <input name="colour" autocomplete="off" type="text" class="form-control" id="colour" placeholder="colour" value="<?php echo $lab->colour ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reaction" class="col-xs-5 col-form-label">reaction</label>
                            <div class="col-xs-7">
                                <input name="reaction" autocomplete="off" type="text" class="form-control" id="reaction" placeholder="reaction" value="<?php echo $lab->reaction ?>">    
                            </div>
                        </div>  



                        <div class="form-group row">
                            <label for="liqification" class="col-xs-5 col-form-label">liqification</label>
                            <div class="col-xs-7">
                                <input name="liqification" autocomplete="off" type="text" class="form-control" id="liqification" placeholder="liqification" value="<?php echo $lab->liqification ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_sperm_count" class="col-xs-5 col-form-label">total_sperm_count</label>
                            <div class="col-xs-7">
                                <input name="total_sperm_count" autocomplete="off" type="text" class="form-control" id="total_sperm_count" placeholder="total_sperm_count" value="<?php echo $lab->total_sperm_count ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active_sperm" class="col-xs-5 col-form-label">active_sperm</label>
                            <div class="col-xs-7">
                                <input name="active_sperm" autocomplete="off" type="text" class="form-control" id="active_sperm" placeholder="active_sperm" value="<?php echo $lab->active_sperm ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sluggidh_sperms" class="col-xs-5 col-form-label">sluggidh_sperms</label>
                            <div class="col-xs-7">
                                <input name="sluggidh_sperms" autocomplete="off" type="text" class="form-control" id="sluggidh_sperms" placeholder="sluggidh_sperms" value="<?php echo $lab->sluggidh_sperms ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dead_sperms" class="col-xs-5 col-form-label">dead_sperms</label>
                            <div class="col-xs-7">
                                <input name="dead_sperms" autocomplete="off" type="text" class="form-control" id="dead_sperms" placeholder="dead_sperms" value="<?php echo $lab->dead_sperms ?>">    
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="pus_cells" class="col-xs-5 col-form-label">pus_cells</label>
                            <div class="col-xs-7">
                                <input name="pus_cells" autocomplete="off" type="text" class="form-control" id="pus_cells" placeholder="reaction" value="<?php echo $lab->pus_cells ?>">    
                            </div>
                        </div>  


                        <div class="form-group row">
                            <label for="rbcs" class="col-xs-5 col-form-label">rbcs</label>
                            <div class="col-xs-7">
                                <input name="rbcs" autocomplete="off" type="text" class="form-control" id="rbcs" placeholder="rbcs" value="<?php echo $lab->rbcs ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="morphology" class="col-xs-5 col-form-label">morphology</label>
                            <div class="col-xs-7">
                                <input name="morphology" autocomplete="off" type="text" class="form-control" id="morphology" placeholder="morphology" value="<?php echo $lab->morphology ?>">    
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