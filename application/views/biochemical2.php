<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="total_cholestroln-group"> 
               <a class="total_cholestroln total_cholestroln-primary" href="<?php echo base_url("laboratory/listbiochemical") ?>"> <i class="fa fa-list"></i> Laboratory list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('laboratory/biochemical','class="form-inner"') ?>
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
                        <!-- <div class="form-group row">
                            <label for="samyalse" class="col-xs-5 col-form-label">samyalse</label>
                            <div class="col-xs-7">
                                <input name="samyalse" autocomplete="off" type="text" class="form-control" id="samyalse" placeholder="samyalse" value="<?php echo $lab->samyalse ?>">    
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="bsugarf" class="col-xs-5 col-form-label">B.Sugar F</label>
                            <div class="col-xs-7">
                                <input name="bsugarf" autocomplete="off" type="text" class="form-control" id="bsugarf" placeholder="bsugarf" value="<?php echo $lab->bsugarf ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="blood_sugar_pp" class="col-xs-5 col-form-label">Blood Sugar P.P./R</label>
                            <div class="col-xs-7">
                                <input name="blood_sugar_pp" autocomplete="off" type="text" class="form-control" id="blood_sugar_pp" placeholder="blood_sugar_pp" value="<?php echo $lab->blood_sugar_pp ?>">    
                            </div>
                        </div>  



                        <div class="form-group row">
                            <label for="blood_urea" class="col-xs-5 col-form-label">Blood Urea</label>
                            <div class="col-xs-7">
                                <input name="blood_urea" autocomplete="off" type="text" class="form-control" id="blood_urea" placeholder="blood_urea" value="<?php echo $lab->blood_urea ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_creatinine" class="col-xs-5 col-form-label">S. Creatinine</label>
                            <div class="col-xs-7">
                                <input name="s_creatinine" autocomplete="off" type="text" class="form-control" id="s_creatinine" placeholder="s_creatinine" value="<?php echo $lab->s_creatinine ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_uricacid" class="col-xs-5 col-form-label">S. Uric Acid</label>
                            <div class="col-xs-7">
                                <input name="s_uricacid" autocomplete="off" type="text" class="form-control" id="s_uricacid" placeholder="s_uricacid" value="<?php echo $lab->s_uricacid ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_na" class="col-xs-5 col-form-label">S.Na+</label>
                            <div class="col-xs-7">
                                <input name="s_na" autocomplete="off" type="text" class="form-control" id="s_na" placeholder="s_na" value="<?php echo $lab->s_na ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_k" class="col-xs-5 col-form-label">S.K.+</label>
                            <div class="col-xs-7">
                                <input name="s_k" autocomplete="off" type="text" class="form-control" id="s_k" placeholder="s_k" value="<?php echo $lab->s_k ?>">    
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="total_cholestrol" class="col-xs-5 col-form-label">Total Cholestrol</label>
                            <div class="col-xs-7">
                                <input name="total_cholestrol" autocomplete="off" type="text" class="form-control" id="total_cholestrol" placeholder="blood_sugar_pp" value="<?php echo $lab->total_cholestrol ?>">    
                            </div>
                        </div>  


                        <div class="form-group row">
                            <label for="s_tg" class="col-xs-5 col-form-label">S.Tg</label>
                            <div class="col-xs-7">
                                <input name="s_tg" autocomplete="off" type="text" class="form-control" id="s_tg" placeholder="s_tg" value="<?php echo $lab->s_tg ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="h_dl" class="col-xs-5 col-form-label">H.D.L.</label>
                            <div class="col-xs-7">
                                <input name="h_dl" autocomplete="off" type="text" class="form-control" id="h_dl" placeholder="h_dl" value="<?php echo $lab->h_dl ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ldl" class="col-xs-5 col-form-label">L.D.L.</label>
                            <div class="col-xs-7">
                                <input name="ldl" autocomplete="off" type="text" class="form-control" id="ldl" placeholder="ldl" value="<?php echo $lab->ldl ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vldl" class="col-xs-5 col-form-label">V.L.D.L.</label>
                            <div class="col-xs-7">
                                <input name="vldl" autocomplete="off" type="text" class="form-control" id="vldl" placeholder="vldl" value="<?php echo $lab->vldl ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_billirubin" class="col-xs-5 col-form-label">S.Billirubin T</label>
                            <div class="col-xs-7">
                                <input name="s_billirubin" autocomplete="off" type="text" class="form-control" id="s_billirubin" placeholder="s_billirubin" value="<?php echo $lab->s_billirubin ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="samyalse" class="col-xs-5 col-form-label">S.Billirubin D</label>
                            <div class="col-xs-7">
                                <input name="samyalse" autocomplete="off" type="text" class="form-control" id="samyalse" placeholder="s_billirubin" value="<?php echo $lab->samyalse ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sgot" class="col-xs-5 col-form-label">S.G.O.T.</label>
                            <div class="col-xs-7">
                                <input name="sgot" autocomplete="off" type="text" class="form-control" id="sgot" placeholder="" value="<?php echo $lab->sgot ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sgot" class="col-xs-5 col-form-label">S.G.P.T</label>
                            <div class="col-xs-7">
                                <input name="sgot" autocomplete="off" type="text" class="form-control" id="sgot" placeholder="" value="<?php echo $lab->sgot ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_protin" class="col-xs-5 col-form-label">Total Protin</label>
                            <div class="col-xs-7">
                                <input name="total_protin" autocomplete="off" type="text" class="form-control" id="total_protin" placeholder="total_protin" value="<?php echo $lab->total_protin ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="aib" class="col-xs-5 col-form-label">Aib</label>
                            <div class="col-xs-7">
                                <input name="aib" autocomplete="off" type="text" class="form-control" id="aib" placeholder="aib" value="<?php echo $lab->aib ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="globulin" class="col-xs-5 col-form-label">Globulian</label>
                            <div class="col-xs-7">
                                <input name="globulin" autocomplete="off" type="text" class="form-control" id="globulin" placeholder="globulin" value="<?php echo $lab->globulin ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alk_phosphatse" class="col-xs-5 col-form-label">AIk. Phoshatase</label>
                            <div class="col-xs-7">
                                <input name="alk_phosphatse" autocomplete="off" type="text" class="form-control" id="alk_phosphatse" placeholder="alk_phosphatse" value="<?php echo $lab->alk_phosphatse ?>">    
                            </div>
                        </div> 

                        
                        <div class="form-group row">
                            <label for="s_calcium" class="col-xs-5 col-form-label">S. Calcium</label>
                            <div class="col-xs-7">
                                <input name="s_calcium" autocomplete="off" type="text" class="form-control" id="s_calcium" placeholder="s_calcium" value="<?php echo $lab->s_calcium ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_calcium" class="col-xs-5 col-form-label">S.Amyalse</label>
                            <div class="col-xs-7">
                                <input name="s_calcium" autocomplete="off" type="text" class="form-control" id="s_calcium" placeholder="s_calcium" value="<?php echo $lab->s_calcium ?>">    
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