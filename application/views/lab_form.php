<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("laboratory") ?>"> <i class="fa fa-list"></i>  laboratory list </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('laboratory/create','class="form-inner"') ?>
            <?php echo form_hidden('id',$lab->id);?>        
                  
               <div class="col-md-6 col-sm-12">               
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
                        <input name="date" autocomplete="off" type="text" class="form-control" id="date" placeholder="Date" value="<?php echo $lab->date ?>">    
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
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="hbs" class="col-xs-5 col-form-label">hbs</label>
                            <div class="col-xs-7">
                                <input name="hbs" autocomplete="off" type="text" class="form-control" id="hbs" placeholder="hbs" value="<?php echo $lab->hbs ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tlc" class="col-xs-5 col-form-label">tlc</label>
                            <div class="col-xs-7">
                                <input name="tlc" autocomplete="off" type="text" class="form-control" id="tlc" placeholder="tlc" value="<?php echo $lab->tlc ?>">    
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="monocytes" class="col-xs-5 col-form-label">monocytes</label>
                            <div class="col-xs-7">
                                <input name="monocytes" autocomplete="off" type="text" class="form-control" id="monocytes" placeholder="monocytes" value="<?php echo $lab->monocytes ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eosinophils" class="col-xs-5 col-form-label">eosinophils</label>
                            <div class="col-xs-7">
                                <input name="eosinophils" autocomplete="off" type="text" class="form-control" id="eosinophils" placeholder="eosinophils" value="<?php echo $lab->eosinophils ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="esr" class="col-xs-5 col-form-label">esr</label>
                            <div class="col-xs-7">
                                <input name="esr" autocomplete="off" type="text" class="form-control" id="esr" placeholder="esr" value="<?php echo $lab->esr ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="platelet_count" class="col-xs-5 col-form-label">platelet_count</label>
                            <div class="col-xs-7">
                                <input name="platelet_count" autocomplete="off" type="text" class="form-control" id="platelet_count" placeholder="platelet_count" value="<?php echo $lab->platelet_count ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mp" class="col-xs-5 col-form-label">mp</label>
                            <div class="col-xs-7">
                                <input name="mp" autocomplete="off" type="text" class="form-control" id="mp" placeholder="mp" value="<?php echo $lab->mp ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_k" class="col-xs-5 col-form-label">s_k</label>
                            <div class="col-xs-7">
                                <input name="s_k" autocomplete="off" type="text" class="form-control" id="s_k" placeholder="s_k" value="<?php echo $lab->s_k ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_cholestrol" class="col-xs-5 col-form-label">total_cholestrol</label>
                            <div class="col-xs-7">
                                <input name="total_cholestrol" autocomplete="off" type="text" class="form-control" id="total_cholestrol" placeholder="total_cholestrol" value="<?php echo $lab->total_cholestrol ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_tg" class="col-xs-5 col-form-label">s_tg</label>
                            <div class="col-xs-7">
                                <input name="s_tg" autocomplete="off" type="text" class="form-control" id="s_tg" placeholder="s_tg" value="<?php echo $lab->s_tg ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="h_dl" class="col-xs-5 col-form-label">h_dl</label>
                            <div class="col-xs-7">
                                <input name="h_dl" autocomplete="off" type="text" class="form-control" id="h_dl" placeholder="h_dl" value="<?php echo $lab->h_dl ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ldl" class="col-xs-5 col-form-label">ldl</label>
                            <div class="col-xs-7">
                                <input name="ldl" autocomplete="off" type="text" class="form-control" id="ldl" placeholder="ldl" value="<?php echo $lab->ldl ?>">    
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vldl" class="col-xs-5 col-form-label">vldl</label>
                            <div class="col-xs-7">
                                <input name="vldl" autocomplete="off" type="text" class="form-control" id="vldl" placeholder="vldl" value="<?php echo $lab->vldl ?>">    
                            </div>
                        </div>


                    </div>

                    <div class="col-md-4">                    
                        <div class="form-group row">
                            <label for="dlc_neutor" class="col-xs-5 col-form-label">dlc_neutor</label>
                            <div class="col-xs-7">
                                <input name="dlc_neutor" autocomplete="off" type="text" class="form-control" id="dlc_neutor" placeholder="dlc_neutor" value="<?php echo $lab->dlc_neutor ?>">    
                            </div>
                        </div>  


                        <div class="form-group row">
                            <label for="bt" class="col-xs-5 col-form-label">bt</label>
                            <div class="col-xs-7">
                                <input name="bt" autocomplete="off" type="text" class="form-control" id="bt" placeholder="dlc_neutor" value="<?php echo $lab->bt ?>">    
                            </div>
                        </div>  


                        <div class="form-group row">
                            <label for="ct" class="col-xs-5 col-form-label">ct</label>
                            <div class="col-xs-7">
                                <input name="ct" autocomplete="off" type="text" class="form-control" id="ct" placeholder="ct" value="<?php echo $lab->ct ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-5 col-form-label">blood_group</label>
                            <div class="col-xs-7">
                                <input name="blood_group" autocomplete="off" type="text" class="form-control" id="blood_group" placeholder="blood_group" value="<?php echo $lab->blood_group ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="hbs" class="col-xs-5 col-form-label">hbs</label>
                            <div class="col-xs-7">

                              <input name="hbs" autocomplete="off" type="text" class="form-control" id="hbs" placeholder="hb" value="<?php echo $lab->hbs ?>">    

                            </div>
                        </div>  
                        <!--
                        <div class="form-group row">
                            <label for="hiv" class="col-xs-5 col-form-label">hiv</label>
                            <div class="col-xs-7">
                                <input name="hiv" autocomplete="off" type="text" class="form-control" id="hiv" placeholder="hiv" value="<?php echo $lab->hiv ?>">    
                            </div>
                        </div>  
                        -->
                        <div class="form-group row">
                            <label for="vdrl" class="col-xs-5 col-form-label">vdrl</label>
                            <div class="col-xs-7">
                                <input name="vdrl" autocomplete="off" type="text" class="form-control" id="vdrl" placeholder="vdrl" value="<?php echo $lab->vdrl ?>">    
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="widal_test" class="col-xs-5 col-form-label">widal_test</label>
                            <div class="col-xs-7">
                                <input name="widal_test" autocomplete="off" type="text" class="form-control" id="widal_test" placeholder="widal_test" value="<?php echo $lab->widal_test ?>">    
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="sparatyphi" class="col-xs-5 col-form-label">sparatyphi</label>
                            <div class="col-xs-7">
                                <input name="sparatyphi" autocomplete="off" type="text" class="form-control" id="sparatyphi" placeholder="sparatyphi" value="<?php echo $lab->sparatyphi ?>">    
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="rafactor" class="col-xs-5 col-form-label">rafactor</label>
                            <div class="col-xs-7">
                                <input name="rafactor" autocomplete="off" type="text" class="form-control" id="rafactor" placeholder="rafactor" value="<?php echo $lab->rafactor ?>">    
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="mxtest" class="col-xs-5 col-form-label">mxtest</label>
                            <div class="col-xs-7">
                                <input name="mxtest" autocomplete="off" type="text" class="form-control" id="mxtest" placeholder="mxtest" value="<?php echo $lab->mxtest ?>">    
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="sputum" class="col-xs-5 col-form-label">sputum</label>
                            <div class="col-xs-7">
                                <input name="sputum" autocomplete="off" type="text" class="form-control" id="sputum" placeholder="sputum" value="<?php echo $lab->sputum ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="s_billirubin" class="col-xs-5 col-form-label">s_billirubin</label>
                            <div class="col-xs-7">
                                <input name="s_billirubin" autocomplete="off" type="text" class="form-control" id="s_billirubin" placeholder="s_billirubin" value="<?php echo $lab->s_billirubin ?>">    
                            </div>
                        </div>  



                    </div>
              
                    <div class="col-md-4">
                    
                        <div class="form-group row">
                            <label for="dlc_lymphocytes" class="col-xs-5 col-form-label">dlc_lymphocytes</label>
                            <div class="col-xs-7">
                                <input name="dlc_lymphocytes" autocomplete="off" type="text" class="form-control" id="dlc_lymphocytes" placeholder="dlc_lymphocytes" value="<?php echo $lab->dlc_lymphocytes ?>">    
                            </div>
                        </div>    


                        <div class="form-group row">
                            <label for="samyalse" class="col-xs-5 col-form-label">samyalse</label>
                            <div class="col-xs-7">
                                <input name="samyalse" autocomplete="off" type="text" class="form-control" id="samyalse" placeholder="samyalse" value="<?php echo $lab->samyalse ?>">    
                            </div>
                        </div>    

                        <div class="form-group row">
                            <label for="bsugarf" class="col-xs-5 col-form-label">bsugarf</label>
                            <div class="col-xs-7">
                                <input name="bsugarf" autocomplete="off" type="text" class="form-control" id="bsugarf" placeholder="bsugarf" value="<?php echo $lab->bsugarf ?>">    
                            </div>
                        </div>    

                        <div class="form-group row">
                            <label for="blood_sugar_pp" class="col-xs-5 col-form-label">blood_sugar_pp</label>
                            <div class="col-xs-7">
                                <input name="blood_sugar_pp" autocomplete="off" type="text" class="form-control" id="blood_sugar_pp" placeholder="blood_sugar_pp" value="<?php echo $lab->blood_sugar_pp ?>">    
                            </div>
                        </div>    

                        <div class="form-group row">
                            <label for="blood_urea" class="col-xs-5 col-form-label">blood_urea</label>
                            <div class="col-xs-7">
                                <input name="blood_urea" autocomplete="off" type="text" class="form-control" id="blood_urea" placeholder="blood_urea" value="<?php echo $lab->blood_urea ?>">    
                            </div>
                        </div>    

                        <div class="form-group row">
                            <label for="s_creatinine" class="col-xs-5 col-form-label">s_creatinine</label>
                            <div class="col-xs-7">
                                <input name="s_creatinine" autocomplete="off" type="text" class="form-control" id="s_creatinine" placeholder="s_creatinine" value="<?php echo $lab->s_creatinine ?>">    
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="s_uricacid" class="col-xs-5 col-form-label">s_uricacid</label>
                            <div class="col-xs-7">
                                <input name="s_uricacid" autocomplete="off" type="text" class="form-control" id="s_uricacid" placeholder="s_uricacid" value="<?php echo $lab->s_uricacid ?>">    
                            </div>
                        </div> 


                        <div class="form-group row">
                            <label for="s_na" class="col-xs-5 col-form-label">s_na</label>
                            <div class="col-xs-7">
                                <input name="s_na" autocomplete="off" type="text" class="form-control" id="s_na" placeholder="s_na" value="<?php echo $lab->s_na ?>">    
                            </div>
                        </div>  


                        <div class="form-group row">
                            <label for="sgot" class="col-xs-5 col-form-label">sgot</label>
                            <div class="col-xs-7">
                                <input name="sgot" autocomplete="off" type="text" class="form-control" id="sgot" placeholder="sgot" value="<?php echo $lab->sgot ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="total_protin" class="col-xs-5 col-form-label">total_protin</label>
                            <div class="col-xs-7">
                                <input name="total_protin" autocomplete="off" type="text" class="form-control" id="total_protin" placeholder="total_protin" value="<?php echo $lab->total_protin ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="aib" class="col-xs-5 col-form-label">aib</label>
                            <div class="col-xs-7">
                                <input name="aib" autocomplete="off" type="text" class="form-control" id="aib" placeholder="aib" value="<?php echo $lab->aib ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="globulin" class="col-xs-5 col-form-label">globulin</label>
                            <div class="col-xs-7">
                                <input name="globulin" autocomplete="off" type="text" class="form-control" id="globulin" placeholder="globulin" value="<?php echo $lab->globulin ?>">    
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="alk_phosphatse" class="col-xs-5 col-form-label">alk_phosphatse</label>
                            <div class="col-xs-7">
                                <input name="alk_phosphatse" autocomplete="off" type="text" class="form-control" id="alk_phosphatse" placeholder="alk_phosphatse" value="<?php echo $lab->alk_phosphatse ?>">    
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="s_calcium" class="col-xs-5 col-form-label">s_calcium</label>
                            <div class="col-xs-7">
                                <input name="s_calcium" autocomplete="off" type="text" class="form-control" id="s_calcium" placeholder="s_calcium" value="<?php echo $lab->s_calcium ?>">    
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

