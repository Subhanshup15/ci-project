<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="rbcn-group"> 
               <a class="rbcn rbcn-primary" href="<?php echo base_url("laboratory") ?>"> <i class="fa fa-list"></i> Laboratory list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('laboratory/urineexamination','class="form-inner"') ?>
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
                            <label for="albumin" class="col-xs-5 col-form-label">Albumin</label>
                            <div class="col-xs-7">
                                <input name="albumin" autocomplete="off" type="text" class="form-control" id="albumin" placeholder="albumin" value="<?php echo $lab->albumin ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sugar" class="col-xs-5 col-form-label">Sugar</label>
                            <div class="col-xs-7">
                                <input name="sugar" autocomplete="off" type="text" class="form-control" id="sugar" placeholder="sugar" value="<?php echo $lab->sugar ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bilesalt" class="col-xs-5 col-form-label">Bile salt</label>
                            <div class="col-xs-7">
                                <input name="bilesalt" autocomplete="off" type="text" class="form-control" id="bilesalt" placeholder="bilesalt" value="<?php echo $lab->bilesalt ?>">    
                            </div>
                        </div>  



                        <div class="form-group row">
                            <label for="bilepigment" class="col-xs-5 col-form-label">Bile pigment</label>
                            <div class="col-xs-7">
                                <input name="bilepigment" autocomplete="off" type="text" class="form-control" id="bilepigment" placeholder="bilepigment" value="<?php echo $lab->bilepigment ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ketonebodies" class="col-xs-5 col-form-label">Reaction</label>
                            <div class="col-xs-7">
                                <input name="ketonebodies" autocomplete="off" type="text" class="form-control" id="ketonebodies" placeholder="ketonebodies" value="<?php echo $lab->ketonebodies ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pregtest" class="col-xs-5 col-form-label">Preg Test</label>
                            <div class="col-xs-7">
                                <input name="pregtest" autocomplete="off" type="text" class="form-control" id="pregtest" placeholder="pregtest" value="<?php echo $lab->pregtest ?>">    
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="puscell" class="col-xs-5 col-form-label">puscell</label>
                            <div class="col-xs-7">
                                <input name="puscell" autocomplete="off" type="text" class="form-control" id="puscell" placeholder="puscell" value="<?php echo $lab->puscell ?>">    
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="rbc" class="col-xs-5 col-form-label">Rbc's</label>
                            <div class="col-xs-7">
                                <input name="rbc" autocomplete="off" type="text" class="form-control" id="rbc" placeholder="bilesalt" value="<?php echo $lab->rbc ?>">    
                            </div>
                        </div>  


                        <div class="form-group row">
                            <label for="epithelialcells" class="col-xs-5 col-form-label">Epithelial cells</label>
                            <div class="col-xs-7">
                                <input name="epithelialcells" autocomplete="off" type="text" class="form-control" id="epithelialcells" placeholder="epithelialcells" value="<?php echo $lab->epithelialcells ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="crystals" class="col-xs-5 col-form-label">Crystals</label>
                            <div class="col-xs-7">
                                <input name="crystals" autocomplete="off" type="text" class="form-control" id="crystals" placeholder="crystals" value="<?php echo $lab->crystals ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="casts" class="col-xs-5 col-form-label">Bacteria</label>
                            <div class="col-xs-7">
                                <input name="casts" autocomplete="off" type="text" class="form-control" id="casts" placeholder="casts" value="<?php echo $lab->casts ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other" class="col-xs-5 col-form-label">Other</label>
                            <div class="col-xs-7">
                                <input name="other" autocomplete="off" type="text" class="form-control" id="other" placeholder="other" value="<?php echo $lab->other ?>">    
                            </div>
                        </div>
        
                    </div>

                    <div class="col-md-6">                    
                        

                    
                        <div class="form-group row">
                            <label for="volume" class="col-xs-5 col-form-label">Volume</label>
                            <div class="col-xs-7">
                                <input name="volume" autocomplete="off" type="text" class="form-control" id="volume" placeholder="volume" value="<?php echo $lab->volume ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="colour" class="col-xs-5 col-form-label">Colour</label>
                            <div class="col-xs-7">
                                <input name="colour" autocomplete="off" type="text" class="form-control" id="colour" placeholder="colour" value="<?php echo $lab->colour ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="specificgravity" class="col-xs-5 col-form-label">Specific gravity</label>
                            <div class="col-xs-7">
                                <input name="specificgravity" autocomplete="off" type="text" class="form-control" id="specificgravity" placeholder="specificgravity" value="<?php echo $lab->specificgravity ?>">    
                            </div>
                        </div>  



                        <div class="form-group row">
                            <label for="appearance" class="col-xs-5 col-form-label">Appearance</label>
                            <div class="col-xs-7">
                                <input name="appearance" autocomplete="off" type="text" class="form-control" id="appearance" placeholder="appearance" value="<?php echo $lab->appearance ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deposit" class="col-xs-5 col-form-label">Deposit</label>
                            <div class="col-xs-7">
                                <input name="deposit" autocomplete="off" type="text" class="form-control" id="deposit" placeholder="deposit" value="<?php echo $lab->deposit ?>">    
                            </div>
                        </div>
                       
                       <!--
                        <div class="form-group row">
                            <label for="occultblood" class="col-xs-5 col-form-label">Occult blood</label>
                            <div class="col-xs-7">
                                <input name="occultblood" autocomplete="off" type="text" class="form-control" id="occultblood" placeholder="occultblood" value="<?php echo $lab->occultblood ?>">    
                            </div>
                        </div>
                        -->

                        

                        <div class="form-group row">
                            <label for="granules" class="col-xs-5 col-form-label">Granules</label>
                            <div class="col-xs-7">
                                <input name="granules" autocomplete="off" type="text" class="form-control" id="granules" placeholder="granules" value="<?php echo $lab->granules ?>">    
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="amorohous" class="col-xs-5 col-form-label">Amorohous</label>
                            <div class="col-xs-7">
                                <input name="amorohous" autocomplete="off" type="text" class="form-control" id="amorohous" placeholder="amorohous" value="<?php echo $lab->amorohous ?>">    
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