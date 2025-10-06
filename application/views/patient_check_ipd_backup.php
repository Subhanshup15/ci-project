<div class="row">
 <!--   <?php// echo error_reporing(0);?>-->
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
        
         <div class="panel-body panel-form">
            <?php echo form_open_multipart('patients/treatment_check_up','class="form-inner"') ?>
            <?php echo form_hidden('id',$patient->id); ?>
            <?php echo form_hidden('patient_id',$patient->id); ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
                  
               <div class="col-md-6 col-sm-12">

                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname; echo " ".$patient->lastname; ?>" readonly>
						  <input name="text" type="hidden" class="form-control" id="patient_id" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->id; ?>" >
						  <input name="dignosis" type="hidden" class="form-control" id="dignosis" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->dignosis; ?>" >
						  <input name="section" type="hidden" class="form-control" id="section" placeholder="<?php echo display('section') ?>" value="<?php echo $patient->ipd_opd; ?>" >
                     </div>
                  </div>
				 <!-- <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">प्रमुख वेदना:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="compliance"  class="form-control" id="compliance" placeholder=""  ><?php echo $patient->compliance;?></textarea>
                     </div>
                  </div>-->
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">C/O<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="c_o" type="text" class="form-control" id="c_o" placeholder="" value="<?php echo $patient->c_o;?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">H/o<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="h_o" type="text" class="form-control" id="h_o" placeholder="" value="<?php echo $patient->h_o;?>" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">नाडी </label>
                     <div class="col-xs-9"> 
                        <?php
                           $nadi = array(
                           
                               ''   => display('select_option'),
                           
                               'मंडूकगति' => 'मंडूकगति',
                           
                               'सर्पगती ' => 'सर्पगती ',
                           
                               'हंसगति ' => 'हंसगति ',
                               
                               'अविशेष' => 'अविशेष',
                            
                               'Other ' => 'Other'
                           
                           );
                           
                           //echo form_dropdown('nadi', $nadi, '', 'class="form-control" id="nadi" '); 
                           
                           ?>
                            <select name="nadi" id="nadi" class="form-control">
											<option value="">Select option</option>
					   	    <?php 
										 foreach($nadi as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" <?php if($patient->nadi==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                     </div>
                     
                     
                  </div>
                  
				   <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">Pulse </label>
                     <div class="col-xs-9"> 
                        <?php
                           $pulse = array(
                           
                               ''   => display('select_option'),
                           
                               '78' => '78',
                           
                               '88' => '88',
                           
                               '90' => '90',
                               
                               '68' => '68',
							    
							   '72' => '72',
                           
                               '82' => '82',
                           
                               '62' => '62',
                               
                               '68' => '68',
							   
							   '86' => '86',
                           
                               '94' => '94',
                               
                               '74' => '74',
                            
                               'Other ' => 'Other'
                           
                           );
                           
                           //echo form_dropdown('pulse', $pulse,'', 'class="form-control" id="pulse" '); 
                           
                           ?>
                           <select name="pulse" id="pulse" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($pulse as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->pulse==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">नेत्र  </label>
                     <div class="col-xs-9"> 
                        <?php
                           $udarn = array(
                           
                               ''   => display('select_option'),
                           
                               'आविल ' => 'आविल ',
                           
                               'अच्छ ' => 'अच्छ ',
                           
                               'ईषत पीत' => 'ईषत पीत',
                               
							   'Other ' => 'Other'
                           
                           );
                           
                           //echo form_dropdown('udarn', $udarn,'', 'class="form-control" id="udarn" '); 
                           ?>
                           <select name="netra" id="netra" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($udarn as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->udar==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				   <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">क्षुधा    </label>
                     <div class="col-xs-9"> 
                        <?php
                           $shudha = array(
                           
                               ''   => display('select_option'),
                           
                               'तीक्षाग्नी  ' => 'तीक्षाग्नी  ',
                           
                               'मंदाग्नी  ' => 'मंदाग्नी  ',
                           
                               'समाग्नी ' => 'समाग्नी ',
                               
							   'विषमाग्नी' => 'विषमाग्नी',
                                
							   'Other ' => 'Other'
                           );
                           
                         //  echo form_dropdown('shudha', $shudha, '', 'class="form-control" id="shudha" '); 
                           
                           ?>
                            <select name="shudha" id="shudha" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($shudha as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->shudha==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  
				  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">मल     </label>
                     <div class="col-xs-9"> 
                        <?php
                           $mal = array(
                           
                               ''   => display('select_option'),
                           
                               'साम  ' => 'साम  ',
                           
                               'निराम   ' => 'निराम   ',
                           
                               'कठीण  ' => 'कठीण  ',
                               
							   'दुर्गंधीयुक्त ' => 'दुर्गंधीयुक्त ',
                                
							   'अविशेष ' => 'अविशेष'               ,
							   
							   'Other ' => 'Other'
                           );
                           
                           //echo form_dropdown('mal', $mal,'', 'class="form-control" id="mal" '); 
                           
                           ?>
                           <select name="mal" id="mal" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($mal as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->mal==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  
				   <!--<div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">स्पर्श :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="parsh" type="text" class="form-control" id="parsh" placeholder="" value="<?php echo $patient->parsh;?>" >
                     </div>
                  </div>-->
				  <!--<div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">श्वसन :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="shwsan" type="text" class="form-control" id="shwsan" placeholder="" value="<?php echo $patient->shwsan;?>" >
                     </div>
                  </div>-->
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">तापमान :<i class="text-danger"></i></label>
                     <div class="col-xs-7">
                        <input name="tapman" type="text" class="form-control" id="tapman" placeholder="" value="<?php echo $patient->tapman;?>" >
                     </div>
                       <div class="col-xs-2">
                          <button type="button" class="btn btn-info btn-xl" data-toggle="modal" data-target="#myModal">Add+</button>
                      </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="treatment" class="col-xs-3 col-form-label">Round / Date<i class="text-danger"></i></label>
                      <div class="col-xs-7">
                           <select name="round" id="round" class="form-control">
											<option value="">Select Round</option>
					   	    <?php   $ADV_DAY1=date('d-m-Y',strtotime($patient->create_date));
										 for($i=0;$i<=25;$i++){
										   $holiday_date=date('d-m-Y', strtotime("+$i days", strtotime($ADV_DAY1)));
										 ?>
										
										
										
											<option value="<?php echo $i; ?>"><?php echo $holiday_date; ?></option>
											<?php }?>
										 </select>
                      </div>
                   
                  </div>
                
                  <div class="form-group row">
                     <!--<label for="treatment" class="col-xs-2 col-form-label">Round<i class="text-danger"></i></label>
                      <div class="col-xs-2">
                           <select name="round" id="round" class="form-control">
											<option value="">Select Round</option>
					   	    <?php   $ADV_DAY1=date('d-m-Y',strtotime($patient->create_date));
										 for($i=0;$i<=25;$i++){
										   $holiday_date=date('d-m-Y', strtotime("+$i days", strtotime($ADV_DAY1)));
										 ?>
										
										
										
											<option value="<?php echo $i; ?>"><?php echo $holiday_date; ?></option>
											<?php }?>
										 </select>
                      </div>-->
                    <label for="treatment" class="col-xs-3 col-form-label">RX1<i class="text-danger"></i></label>
                     
                     <div class="col-xs-9">
                        <select name="RX1" id="RX1" class="form-control">
											<option value="">Select RX1</option>
					   	    <?php 
										 foreach($treatment_list_rx1 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>"><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                      
                    
                  </div>
                  

                  
                  <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">RX3<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="RX3" id="RX3" class="form-control">
											<option value="">Select RX3</option>
					   	    <?php 
										 foreach($treatment_list_rx3 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>
                  
                   <div class="form-group row">
                     <label for="Quantity" class="col-xs-3 col-form-label">RX5<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="RX5" id="RX5" class="form-control">
											<option value="">Select RX5</option>
					   	    <?php 
										 foreach($treatment_list_rx5 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>
                  
                  
				  <!-- <div class="form-group row">
                     <label for="udar" class="col-xs-3 col-form-label">उदर<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="udar" type="text" class="form-control" id="udar" placeholder="" value="<?php echo $patient->udar;?>" >
                     </div>
                  </div>-->
				   <!--<div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">स्त्रोतस परीक्षण:<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="strot_parishwan" class="form-control" id="strot_parishwan" rows="3" placeholder="" ><?php echo $patient->strot_parishwan;?></textarea>
                     </div>
                  </div>-->
				  <!-- <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">चिकित्सा :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="chikisa" class="form-control" id="chikisa" rows="3" placeholder="" ><?php echo $patient->chikisa;?></textarea>
                     </div>
                  </div>-->
				  
				 <!--<div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">निद्रा      </label>
                     <div class="col-xs-9"> 
                        <?php
                           $nidra = array(
                           
                               ''   => display('select_option'),
                           
                               'अविशेष   ' => 'अविशेष   ',
                           
                               'प्रभुत    ' => 'प्रभुत    ',
                           
                               'अल्प  ' => 'अल्प  ',
                               
							   'Other ' => 'Other'
                           );
                           
                           //echo form_dropdown('nidra', $nidra, '', 'class="form-control" id="nidra" '); 
                           
                           ?>
                           
                           <select name="nidra" id="nidra" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($nidra as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->nidra==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>-->
                 </div>
			   
			   
               <div class="col-md-6 col-sm-12">
			   
			     
			      <div class="form-group row">
                     <label for="ipd_no" class="col-xs-3 col-form-label">No.<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php $ye_no=$patient->yearly_reg_no; if($ye_no){ echo $ye_no;}else { echo $patient->old_reg_no; } ?>" readonly>
                     </div>
                  </div>
				  <!-- <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">वर्तमान व्याधीवृत्त :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="vyadhi"  class="form-control" id="vyadhi"  placeholder="" ><?php echo $patient->vyadhi;?></textarea>
                     </div>
                  </div>-->
				   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Family History <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="f_h" type="text" class="form-control" id="f_h" placeholder="" value="<?php echo $patient->f_h;?>" >
                     </div>
                  </div>
                   <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">B.P. </label>
                     <div class="col-xs-9"> 
                        <?php
                           $bp = array(
                           
                               ''   => display('select_option'),
                           
                               '120/80' => '120/80',
                           
                               '130/80' => '130/80',
                           
                               '124/86' => '124/86',
                               
							   '138/88' => '138/88',
							   
							   
							   '149/90' => '149/90',
                           
                               '110/70' => '110/70',
                           
                               '150/84' => '150/84',
                               
							   '148/72' => '148/72',
							   
							   '128/60' => '128/6',
                               
							   '140/90' => '140/90',
							   'Other ' => 'Other'
                           );
                           
                          // echo form_dropdown('bp', $bp,'', 'class="form-control" id="bp" '); 
                           
                           ?>
                           
                           <select name="bp" id="bp" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($bp as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->bp==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
                 
				 
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">RS :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="RS" type="text" class="form-control" id="RS" placeholder="" value="" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">CVS :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="cvs" type="text" class="form-control" id="cvs" placeholder="" value="<?php echo '';;?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">RA :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="ra" type="text" class="form-control" id="ra" placeholder="" value="<?php echo '';?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">जिव्हा : </label>
                     <div class="col-xs-9"> 
                        <?php
                           $givwa = array(
                           
                               ''   => display('select_option'),
                           
                               'साम ' => 'साम ',
                           
							   'निराम ' => 'निराम',
							   
							   'Other ' => 'Other'
                           );
                           
                          // echo form_dropdown('givwa', $givwa, '', 'class="form-control" id="givwa" '); 
                           
                           ?>
                           
                           <select name="givwa" id="givwa" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($givwa as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->givwa==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				   <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">मूत्र  :</label>
                     <div class="col-xs-9"> 
                        <?php
                           $mutra = array(
                           
                               ''   => display('select_option'),
                           
                               'पीत   ' => 'पीत ',
                           
							   'आविल    ' => 'आविल' , 
							   'दुर्गंधीयुक्त  ' => 'दुर्गंधीयुक्त ',
							  
							  'अविशेष ' => 'अविशेष',
							  
							  'Other ' => 'Other'
                           );
                           
                          //echo form_dropdown('mutra', $mutra, '', 'class="form-control" id="mutra" '); 
                           
                           ?>
                            <select name="mutra" id="mutra" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($mutra as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->mutra==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  <!--<div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">उर </label>
                     <div class="col-xs-9"> 
                        <?php
                           $ur = array(
                           
                               ''   => display('select_option'),
                           
                               'अविशेष' => 'अविशेष',
                           
							   'Other ' => 'Other'
                           );
                           
                          // echo form_dropdown('ur', $ur, '', 'class="form-control" id="ur" '); 
                           
                           ?>
                           
                           <select name="ur" id="ur" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($ur as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->ur==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>-->
                  <!-- <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">निष्कर्ष </label>
                     <div class="col-xs-9"> 
                        <?php
                           $nishkrsh = array(
                           
                               ''   => display('select_option'),
                           
                               'संपर्ण बरा झाला' => 'संपर्ण बरा झाला',
                           
							   'सुधारणा झाली ' => 'सुधारणा झाली',
							   
							   'मृत्यू पावलाी ' => 'मृत्यू पावला'
                           );
                           
                          // echo form_dropdown('ur', $ur, '', 'class="form-control" id="ur" '); 
                           
                           ?>
                           
                           <select name="nishkrsh" id="nishkrsh" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($nishkrsh as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->nishkrsh==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">चिकित्सा सूत्र :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="chiki_sutra"  class="form-control" id="chiki_sutra" rows="3" placeholder="" ><?php echo $patient->chiki_sutra;?></textarea>
                     </div>
                  </div>
				   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">तपासणी :<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <textarea name="checkup"  class="form-control" id="checkup" rows="3" placeholder="" ><?php echo $patient->checkup;?></textarea>
                     </div>
                  </div>
				  -->
				   <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">आहार   </label>
                     <div class="col-xs-9"> 
                        <?php
                           $ahar = array(
                           
                               ''   => display('select_option'),
                           
                               'प्रभुत  ' => 'प्रभुत  ',
                           
							   'अल्प  ' => 'अल्प ',
							   
							   'मध्यम ' => 'मध्यम',
							   
							  'Other ' => 'Other'
                           );
                           
                          // echo form_dropdown('ahar', $ahar, '', 'class="form-control" id="ahar" '); 
                           
                           ?>
                           
                           <select name="ahar" id="ahar" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($ahar as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($patient->ahar==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
                  
                   <div class="form-group row">
                     <label for="treatment" class="col-xs-3 col-form-label">RX2<i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="RX2" id="RX2" class="form-control">
											<option value="">Select RX2</option>
					   	    <?php 
										 foreach($treatment_list_rx2 as $x => $x_val ){ ?>
										
										 
										
											<option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                        
                     </div>
                    
                  </div>
                  
                   <div class="form-group row">
                     <label for="treatment" class="col-xs-3 col-form-label">RX4<i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                        <select name="RX4" id="RX4" class="form-control">
											<option value="">Select RX4</option>
					   	    <?php 
										 foreach($treatment_list_rx4 as $x => $x_val ){ ?>
										
										 
										
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
                        <a href="javascript:window.history.go(-1);" type="reset" class="btn btn-info">Back</a>
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                       <!-- <button class="ui positive button"><?php echo display('save') ?></button>-->
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