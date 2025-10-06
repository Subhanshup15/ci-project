<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
        
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('patients/treatment_save','class="form-inner"') ?>
            <?php echo form_hidden('id',$patient->id); ?>
            <?php echo form_hidden('patient_id',$patient->id); ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
              <?php echo form_hidden('panch_adv_flag',22); ?>
                  
               <div class="col-md-6 col-sm-12">

                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname; echo " ".$patient->lastname; ?>" readonly>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date_of_birth') ?> <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="date_of_birth" class="form-control" type="text" placeholder="" id="date_of_birth"  value="<?php echo $patient->date_of_birth ?>" readonly>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="date_of_birth" class="col-xs-3 col-form-label">Gender<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="gender" class="form-control" type="text" placeholder="" id="gender"  value="<?php echo $patient->sex ?>" readonly>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="date_of_birth" class="col-xs-3 col-form-label">Contact No.<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="contact" class="form-control" type="text" placeholder="" id="contact"  value="<?php echo $patient->mobile ?>" readonly>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                       <div class="col-xs-7">
                        <?php $result = $this->db->select("*")
                              ->from('department')
                              ->where('status',1)
                              ->where('dprt_id',$patient->department_id)
                              ->get()
                              ->row(); ?>
                        <input name="department_id" class="form-control" type="text" placeholder="" id="department_id"  value="<?php echo $result->name; ?>" readonly>
                     </div>
                      <div class="col-xs-2">
                          <button type="button" class="btn btn-info btn-xl" data-toggle="modal" data-target="#myModal">Add+</button>
                      </div>
                  </div>
                  
                  
                   <?php //print_r($dignosis_list);?>
                 <!-- <div class="form-group row">
                     <label for="treatment" class="col-xs-2 col-form-label">Round<i class="text-danger"></i></label>
                      <div class="col-xs-2">
                           <select name="round" id="round" class="form-control">
											<option value="">Select Round</option>
					   	    <?php  
										 for($i=1;$i<=25;$i++){ ?>
										
										 
										
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php }?>
										 </select>
                      </div>
                     <label for="treatment" class="col-xs-1 col-form-label">RX1<i class="text-danger"></i></label>
                     
                     <div class="col-xs-7">
                        <select name="RX1" id="RX1" class="form-control">
											<option value="">Select RX1</option>
					   	    <?php 
										 foreach($treatment_list_rx1 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>"><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                      
                    
                  </div>-->
                  

                  
                 <!-- <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">RX3<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <select name="RX3" id="RX3" class="form-control">
											<option value="">Select RX3</option>
					   	    <?php 
										 foreach($treatment_list_rx3 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>-->
                <!--  
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">RX5<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <select name="RX5" id="RX5" class="form-control">
											<option value="">Select RX5</option>
					   	    <?php 
										 foreach($treatment_list_rx5 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>-->
				  <div class="form-group row">
                     <label for="instruction" class="col-xs-3 col-form-label">SWEDAN</label>
                     <div class="col-xs-9">
                        <select name="SWEDAN" id="SWEDAN" class="form-control">
											<option value="">Select SWEDAN</option>
					   	    <?php 
										 foreach($treatment_list_pk1 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">VIRECHAN<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="VIRECHAN" id="VIRECHAN" class="form-control">
											<option value="">Select VIRECHAN</option>
					   	    <?php 
										 foreach($treatment_list_swa1 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">NASYA<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="NASYA" id="NASYA" class="form-control">
											<option value="">Select NASYA</option>
					   	    <?php 
										 foreach($treatment_list_patho as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">SHIRODHARA_SHIROBASTI<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="SHIRODHARA_SHIROBASTI" id="SHIRODHARA_SHIROBASTI" class="form-control">
											<option value="">Select SHIRODHARA_SHIROBASTI</option>
					   	    <?php 
										 foreach($treatment_list_patho3 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                 <!--  <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">SWA1<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <select name="SWA1" id="SWA1" class="form-control">
											<option value="">Select SWA1</option>
					   	    <?php 
										 foreach($treatment_list_swa11 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>-->
                   <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">HEMATOLOGICAL<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="HEMATOLOGICAL" id="HEMATOLOGICAL" class="form-control">
											<option value="">Select HEMATOLOGICAL</option>
					   	    <?php 
										 foreach($treatment_list_HEMATOLOGICAL as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">BIOCHEMICAL<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="BIOCHEMICAL" id="BIOCHEMICAL" class="form-control">
											<option value="">Select BIOCHEMICAL</option>
					   	    <?php 
										 foreach($treatment_list_BIOCHEMICAL as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">ECG<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="ECG" id="ECG" class="form-control">
											<option value="">Select ECG</option>
					   	    <?php 
										 foreach($treatment_list_ecg as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">USG<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="USG" id="USG" class="form-control">
											<option value="">Select USG</option>
					   	    <?php 
										 foreach($treatment_list_usg as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                  
               </div>
			   
			   
               <div class="col-md-6 col-sm-12">
			      <div class="form-group row">
                     <label for="ipd_no" class="col-xs-3 col-form-label">IPD No.<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php echo $patient->ipd_no; ?>" readonly>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="ipd_no" class="col-xs-3 col-form-label">OPD No.<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="opd_no" class="form-control" type="text" placeholder="" id="opd_no"  value="<?php echo $patient->old_reg_no; ?>" readonly>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">Admit Date<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="create_date" class="form-control" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?php echo $patient->create_date ?>" readonly>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="create_date" class="col-xs-3 col-form-label">Discharge Date<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="discharge_date" class="form-control" type="text" placeholder="<?php echo display('discharge_date') ?>" id="discharge_date"  value="<?php echo $patient->discharge_date ?>" readonly>
                     </div>
                  </div>
                  <?php //print_r($dignosis_list);?>
                  <div class="form-group row">
                     <label for="dignosis" class="col-xs-3 col-form-label"><?php echo display('dignosis') ?> <i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        
                        <input name="dignosis" class="form-control" type="text" placeholder="" id="dignosis"  value="<?php   $segment=$this->uri->segment(4); if($segment == 'ipd'){ 
                                        $section_tret='ipd';
                                        $len=strlen($patient->dignosis);
                                        $dd= substr($patient->dignosis,$len - 1);
                                      if($dd=='I'){
                                           $p_dignosis = '%'.$patient->dignosis.'%';
                                           $p_dignosis_name=$patient->dignosis;
                                      }else{
                                          
                                           $p_dignosis = '%'.$patient->dignosis.'I%';
                                           $p_dignosis_name=$patient->dignosis.'I';
                                      }
                                       
                                    }
                                    else{
                                         $section_tret='opd';
                                         $len=strlen($patient->dignosis);
                                         $dd= substr($patient->dignosis,$len - 1);
                                          if($dd=='I'){
                                               // echo $dd;
                                                $dd1=substr($patient->dignosis, 0, -1);
                                           $p_dignosis = '%'.$dd1.'%';
                                             $p_dignosis_name=$dd1;
                                      }else{
                                           //echo $dd;
                                            $p_dignosis = '%'.$patient->dignosis.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                      }
                                    } echo $p_dignosis_name; ?>" readonly>
                   </div>
                   </div>
                   <?php //print_r($dignosis_list);?>
                  <!--<div class="form-group row">
                     <label for="treatment" class="col-xs-3 col-form-label">RX2<i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        <select name="RX2" id="RX2" class="form-control">
											<option value="">Select RX2</option>
					   	    <?php 
										 foreach($treatment_list_rx2 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>-->
                  
                   <!--<div class="form-group row">
                     <label for="treatment" class="col-xs-3 col-form-label">RX4<i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        <select name="RX4" id="RX4" class="form-control">
											<option value="">Select RX4</option>
					   	    <?php 
										 foreach($treatment_list_rx4 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>-->
                  
                 <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">SNEHAN<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="SNEHAN" id="SNEHAN" class="form-control">
											<option value="">Select SNEHAN</option>
					   	    <?php 
										 foreach($treatment_list_karma as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">VAMAN<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="VAMAN" id="VAMAN" class="form-control">
											<option value="">Select VAMAN</option>
					   	    <?php 
										 foreach($treatment_list_pk2 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">BASTI<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="BASTI" id="BASTI" class="form-control">
											<option value="">Select BASTI</option>
					   	    <?php 
										 foreach($treatment_list_swa2 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="instruction" class="col-xs-3 col-form-label">RAKTAMOKSHAN</label>
                      <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="RAKTAMOKSHAN" id="RAKTAMOKSHAN" class="form-control">
											<option value="">Select RAKTAMOKSHAN</option>
					   	    <?php 
										 foreach($treatment_list_patho2 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">OTHER<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="OTHER" id="OTHER" class="form-control">
											<option value="">Select OTHER</option>
					   	    <?php 
										 foreach($treatment_list_OTHER as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                 <!-- <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">SWA2<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <select name="SWA2" id="SWA2" class="form-control">
											<option value="">Select SWA2</option>
					   	    <?php 
										 foreach($treatment_list_swa12 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>-->
                  <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">SEROLOGYCAL<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="SEROLOGYCAL" id="SEROLOGYCAL" class="form-control">
											<option value="">Select SEROLOGYCAL</option>
					   	    <?php 
										 foreach($treatment_list_SEROLOGYCAL as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">MICROBIOLOGICAL<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="MICROBIOLOGICAL" id="MICROBIOLOGICAL" class="form-control">
											<option value="">Select MICROBIOLOGICAL</option>
					   	    <?php 
										 foreach($treatment_list_MICROBIOLOGICAL as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
                 <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">X-RAY<i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="x_ray" id="x_ray" class="form-control">
											<option value="">Select X-RAY</option>
					   	    <?php 
										 foreach($treatment_list_x_ray as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                  </div>
               </div>
            </div>
               
            </div>
            <div class="form-group row">
               
               <div class="form-group row">
                  <div class="col-sm-offset-3 col-sm-6">
                     <div class="ui buttons">
                          <a href="javascript:window.history.go(-1);" class="btn btn-info">Back</a>
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


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New</h4>
        </div>
        <div class="modal-body">
              <?php echo form_open_multipart('patients/medicine_save','class="form-inner"') ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
              <?php echo form_hidden('patient_id',$this->uri->segment(3)); ?>
              <?php echo form_hidden('dignosis',$patient->dignosis); ?>
                <div class="form-group row">
                 <label for="Quantity" class="col-md-offset-2 col-md-3 col-form-label">Medicine<i class="text-danger">*</i></label>
                  <div class="col-md-6">
                  <!-- <select name="medicine_type" id="" class="form-control">
				   <option value="">Select type</option>
				   </select>-->
				   <input list="brow" name="medicine_type" class="form-control" required>
                   <datalist id="brow">
                   <option value="RX1">
                   <option value="RX2">
                   <option value="RX3">
                    <option value="SNEHAN">
                    <option value="SWEDAN">
                    <option value="VAMAN">
                    <option value="VIRECHAN">
                    <option value="BASTI">
                    <option value="NASYA">
                    <option value="RAKTAMOKSHAN"> 
                    <option value="SHIRODHARA_SHIROBASTI">
                    <option value="OTHER">
                    <option value="SWA1">
                    <option value="SWA2">
                    <option value="HEMATOLOGICAL">
                    <option value="SEROLOGYCAL">
                    <option value="BIOCHEMICAL">
                    <option value="MICROBIOLOGICAL">                     
                    <option value="X_RAY"> 
                    <option value="ECG">  
                  </datalist>
				  </div>
				  </div>
				   <div class="form-group row">
				   <label for="dignosis" class="col-md-offset-2 col-md-3 col-form-label">Name<i class="text-danger">*</i></label>
                    <div class="col-md-6">
                        <input name="medicine_name" class="form-control" type="text" placeholder="Enter name" id="medicine_name"   value="" required>
                    </div>
				   </div>
				   <div class="form-group row">
                  <div class="col-md-offset-4 col-sm-2">
                     <div class="ui buttons">
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                        <button class="ui positive button"><?php echo display('save') ?></button>
                     </div>
                  </div>
               </div>
               <?php echo form_close() ?> 
              </div> 
          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
             var array1 =[];
         function treatment($value){
             array1.push(" "+$value);
            // alert(array1)
             document.getElementById("multiple_treatment").value = array1;
             //document.getElementById("multiple_treatment")style.display = "none";
         }

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
                     //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                     //$('#yearly_no').val(data.patient.yearly_no);
                     
                     

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
           
            var x = document.getElementById("department_id").value;
   
            //alert(x);
   
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
   
   
   function dignosis(){
		alert("dsdsd");
		
	}
   
   
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
       $("#ipdno").hide();
       $("#ipd").hide();
       $("#ipd2").hide();
       $('#status').on('change', function() {
        var ipdopd = document.getElementById("ipd_opd").value; 
        
         if ( this.value == 'old' && ipdopd == 'ipd')
         {
           $("#old").show();
           $("#yearly_no1").hide();
           $("#ipd").show()
           $("#ipd2").show();
         }else if(this.value == 'new' && ipdopd == 'ipd')
         {
            $("#old").hide();
            $("#yearly_no1").show();
            $("#ipd").show();
            $("#ipd2").show();
         }else if(this.value == 'old' && ipdopd == 'opd'){
             $("#old").show();
             $("#yearly_no1").hide();
             $("#ipdno").hide();
             $("#ipd").hide();
             $("#ipd2").hide();
         }else{
             $("#old").hide();
             $("#yearly_no1").show();
             $("#ipdno").hide();
             $("#ipd").hide();
             $("#ipd2").hide();
         }
       });
   });

   //Show old registration number on ipd registration
   // $(document).ready(function(){
        

   // });

   
   // //Hide show IPD OPD
   // $(document).ready(function(){
   //     $("#ipd").hide();
   //     $("#ipd2").hide();
   //     $("#ipdno").hide();
   //     $('#ipd_opd').on('change', function() {
   //       if ( this.value == 'ipd')
   //       {
   //         $("#ipd").show();
   //         $("#ipd2").show();
   //         $("#old").show();
   //         $("#ipdno").show();
   //         $("#yearly_no1").hide();
   //       }
   //       else
   //       {
   //         $("#ipd").hide();
   //         $("#ipd2").hide();
   //         $("#ipdno").hide();
   //       }
   //     });
   // });
</script>