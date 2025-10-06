<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("biochemical") ?>"> <i class="fa fa-list"></i>  Biochemical list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('biochemical/create','class="form-inner"') ?>
            <?php echo form_hidden('id',$biochemical->id); ?>        
                  
               <div class="col-md-6 col-sm-12">   

                  
                  <div class="form-group row">
                     <label for="opd_no" class="col-xs-3 col-form-label">Opd No</label>
                     <div class="col-xs-9">
                        <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?php echo $biochemical->opd_no ?>">    
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="name" class="col-xs-3 col-form-label">Name</label>
                     <div class="col-xs-9">
                        <input name="name" autocomplete="off" type="text" class="form-control" id="name" placeholder="Name" value="<?php echo $biochemical->name ?>">    
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="age" class="col-xs-3 col-form-label">Age</label>
                     <div class="col-xs-9">
                        <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="Age" value="<?php echo $biochemical->age ?>">    
                     </div>
                  </div>                 
                </div>
                <div class="col-md-6">
                    
                  <div class="form-group row">
                     <label for="sex" class="col-xs-3 col-form-label">Sex</label>
                     <div class="col-xs-9">
                        <input name="sex" autocomplete="off" type="text" class="form-control" id="sex" placeholder="Sex" value="<?php echo $biochemical->sex ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="doctor" class="col-xs-3 col-form-label">Doctor</label>
                     <div class="col-xs-9">
                        <input name="doctor" autocomplete="off" type="text" class="form-control" id="doctor" placeholder="Doctor" value="<?php echo $biochemical->doctor ?>">    
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="date" class="col-xs-3 col-form-label">Date</label>
                     <div class="col-xs-9">
                        <input name="date" autocomplete="off" type="text" class="form-control datepicker" id="date" placeholder="Date" value="<?php echo $biochemical->date ?>">    
                     </div>
                  </div> 
                </div>
                
            </div>
                <div class="row panel-body panel-form">
                    <div class="col-md-6">
                        <div class="form-group row">
                        <label for="bs_random" class="col-xs-3 col-form-label">Blood Sugar Random</label>
                        <div class="col-xs-9">
                            <input name="bs_random" autocomplete="off" type="text" class="form-control" id="bs_random" placeholder="Date" value="<?php echo $biochemical->bs_random ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="bs_fasting" class="col-xs-3 col-form-label">Blood Sugar Fasting</label>
                        <div class="col-xs-9">
                            <input name="bs_fasting" autocomplete="off" type="text" class="form-control" id="bs_fasting" placeholder="bs_fasting" value="<?php echo $biochemical->bs_fasting ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="bs_bb" class="col-xs-3 col-form-label">Blood Sugar Post Prandial</label>
                        <div class="col-xs-9">
                            <input name="bs_bb" autocomplete="off" type="text" class="form-control" id="bs_bb" placeholder="bs_bb" value="<?php echo $biochemical->bs_fasting ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="blood_urea" class="col-xs-3 col-form-label">Blood Urea</label>
                        <div class="col-xs-9">
                            <input name="blood_urea" autocomplete="off" type="text" class="form-control" id="blood_urea" placeholder="blood_urea" value="<?php echo $biochemical->blood_urea ?>">    
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="srcretinity" class="col-xs-3 col-form-label">Sr. Creatinine</label>
                        <div class="col-xs-9">
                            <input name="srcretinity" autocomplete="off" type="text" class="form-control" id="srcretinity" placeholder="srcretinity" value="<?php echo $biochemical->srcretinity ?>">    
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="srbillirubin" class="col-xs-3 col-form-label">Sr. Billirubin</label>
                        <div class="col-xs-9">
                            <input name="srbillirubin" autocomplete="off" type="text" class="form-control" id="srbillirubin" placeholder="srbillirubin" value="<?php echo $biochemical->srbillirubin ?>">    
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="sgot" class="col-xs-3 col-form-label">S.G.O.T</label>
                        <div class="col-xs-9">
                            <input name="sgot" autocomplete="off" type="text" class="form-control" id="sgot" placeholder="sgot" value="<?php echo $biochemical->sgot ?>">    
                        </div>
                        </div>

                        <div class="form-group row">
                        <label for="sgot2" class="col-xs-3 col-form-label">S.G.O.T</label>
                        <div class="col-xs-9">
                            <input name="sgot2" autocomplete="off" type="text" class="form-control" id="sgot2" placeholder="sgot" value="<?php echo $biochemical->sgot2 ?>">    
                        </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group row">
                        <label for="sralkalinephosphare" class="col-xs-3 col-form-label">Sr. Alkaline Phosphate</label>
                        <div class="col-xs-9">
                            <input name="sralkalinephosphare" autocomplete="off" type="text" class="form-control" id="sralkalinephosphare" placeholder="sralkalinephosphare" value="<?php echo $biochemical->sralkalinephosphare ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="srcholesterol" class="col-xs-3 col-form-label">Sr. Cholesterol</label>
                        <div class="col-xs-9">
                            <input name="srcholesterol" autocomplete="off" type="text" class="form-control" id="srcholesterol" placeholder="srcholesterol" value="<?php echo $biochemical->srcholesterol ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="srtriglyserides" class="col-xs-3 col-form-label">Sr. Triglyserides</label>
                        <div class="col-xs-9">
                            <input name="srtriglyserides" autocomplete="off" type="text" class="form-control" id="srtriglyserides" placeholder="srtriglyserides" value="<?php echo $biochemical->srtriglyserides ?>">    
                        </div>
                        </div> 

                        <div class="form-group row">
                        <label for="sruricscidlevel" class="col-xs-3 col-form-label">Sr. Uric acid level</label>
                        <div class="col-xs-9">
                            <input name="sruricscidlevel" autocomplete="off" type="text" class="form-control" id="sruricscidlevel" placeholder="sruricscidlevel" value="<?php echo $biochemical->sruricscidlevel ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="srprotienlevel" class="col-xs-3 col-form-label">Sr. Protien total</label>
                        <div class="col-xs-9">
                            <input name="srprotienlevel" autocomplete="off" type="text" class="form-control" id="srprotienlevel" placeholder="srprotienlevel" value="<?php echo $biochemical->srprotienlevel ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="sralbuminlevel" class="col-xs-3 col-form-label">Sr. Albumin level</label>
                        <div class="col-xs-9">
                            <input name="sralbuminlevel" autocomplete="off" type="text" class="form-control" id="sralbuminlevel" placeholder="sralbuminlevel" value="<?php echo $biochemical->sralbuminlevel ?>">    
                        </div>
                        </div>


                        <div class="form-group row">
                        <label for="ckmb" class="col-xs-3 col-form-label">Ck. M.B.</label>
                        <div class="col-xs-9">
                            <input name="ckmb" autocomplete="off" type="text" class="form-control" id="ckmb" placeholder="ckmb" value="<?php echo $biochemical->ckmb ?>">    
                        </div>
                        </div>

                        <div class="form-group row">
                        <label for="srche" class="col-xs-3 col-form-label">Sr.C.H.E.</label>
                        <div class="col-xs-9">
                            <input name="srche" autocomplete="off" type="text" class="form-control" id="srche" placeholder="srche" value="<?php echo $biochemical->srche ?>">    
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