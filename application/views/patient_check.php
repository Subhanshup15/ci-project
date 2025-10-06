<div class="row">
 <!--   <?php// echo error_reporing(0);?>-->
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-body panel-form">
            <!--<?php echo form_open_multipart('patients/treatment_check_up','class="form-inner"') ?>-->
            <?php echo form_open_multipart('patients/storeManualTreatment','class="form-inner"') ?>
            <?php echo form_hidden('id',$patient->id); ?>
            <?php echo form_hidden('patient_id',$patient->id); ?>
              <?php echo form_hidden('ipd_opd',$patient->ipd_opd); ?>
               <div class="col-md-6 col-sm-12">
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname; echo " ".$patient->lastname; ?>" readonly>
						  <input name="id" type="hidden" class="form-control" id="patient_id" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->id; ?>" >
						  <input name="dignosis" type="hidden" class="form-control" id="dignosis" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->dignosis; ?>" >
						  <input name="section" type="hidden" class="form-control" id="section" placeholder="<?php echo display('section') ?>" value="<?php echo $patient->ipd_opd; ?>" >
                     </div>
                  </div>
                  <?php
                    $res = $this->db->select("*")
                          ->from('manual_treatments')
                          ->where('patient_id_auto',$patient->id)
                          //->where('department_id',$patient->department_id)
                          ->where('ipd_opd',$patient->ipd_opd)
                          ->get()
                          ->row();
                        //  print_r($this->db->last_query());
                    if($res)
                    {
                        $result1 = $res;
                    }
                    else{
                        $result1='';
                    }
                ?>
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">C/O<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                          <?php if($patient->department_id== 30)
                    { ?>
                           <select name="c_o" class="form-control" id="c_o">
                           <option value="<?php echo ($result1)?$result1->sym_name:''; ?>"><?php echo ($result1)?$result1->sym_name:'Select'; ?></option>

                         
                                <option value="No any fresh complaints">No any fresh complaints</option>
                                <option value="DOV SINCE 1 YEAR">DOV SINCE 1 YEAR</option>
                                <option value="DOV SINCE 2 YEAR">DOV SINCE 2 YEAR</option>
                                <option value="Foreign body sensation in right eye, redness, blurred vision since 2months">Foreign body sensation in right eye, redness, blurred vision since 2months</option>
                                <option value="Foreign body sensation in left eye, redness, blurred vision since 1months">Foreign body sensation in left eye, redness, blurred vision since 1months</option>
                                <option value="Foreign body sensation, Redness of eye in both eyes  since 1months">Foreign body sensation, Redness of eye in both eyes  since 1months</option>
                                <option value="pain, redness , blurred vision in right eye ,extreme sensitivity to light">pain, redness , blurred vision in right eye ,extreme sensitivity to light</option> 
                                <option value="sticky discharge from both eye since 5 days, redness">sticky discharge from both eye since 5 days, redness</option> 
                                <option value="red lump on eyelid in right eye since 5 days, tearing , swelling of eyelids">red lump on eyelid in right eye since 5 days, tearing , swelling of eyelids</option>
                                <option value="red lump on eyelid in Left eye since 5 days, tearing , swelling of eyelids">red lump on eyelid in Left eye since 5 days, tearing , swelling of eyelids</option>
                                <option value="painless bump in upper eyelid of right eye since 1month">painless bump in upper eyelid of right eye since 1month</option>
                                <option value="painless bump in upper eyelid of Left eye since 1month">painless bump in upper eyelid of Left eye since 1month</option>
                                <option value="pain in left eye since 4-5 days, redness in left eye">pain in left eye since 4-5 days, redness in left eye</option>
                                <option value="diminish of vision (OD) since 1 month">diminish of vision (OD) since 1 month</option>
                                <option value="diminish of vision (OS) since 2 months">diminish of vision (OS) since 2 months</option> 
                                <option value="redness, pain, watering in both eye since 8 days">redness, pain, watering in both eye since 8 days</option>
                                <option value="redness in right eye since 2 days, scratchy feeling since 5 days">redness in right eye since 2 days, scratchy feeling since 5 days</option>
                                <option value="redness in left eye since 5 days, scratchy feeling since 5 days">redness in left eye since 5 days, scratchy feeling since 5 days</option>
                                <option value="pain in right eye  since 4-5 days, redness in right  eye">pain in right eye  since 4-5 days, redness in right  eye</option>
                                <option value="redness, itching, burning sensation in both eyes since 5 day">redness, itching, burning sensation in both eyes since 5 days</option>
                                <option value="Redness, painful eye, photophobia,swelling over lids since 10 days">Redness, painful eye, photophobia,swelling over lids since 10 days</option>
                                <option value="Redness of eye, burning sensation in eye, itchy eyelids, watering from both eye since 5days">Redness of eye, burning sensation in eye, itchy eyelids, watering from both eye since 5days</option>
                                <option value="sharp pain in right eye, burning sensation, foreign body sensation, blurred vision since 2 days">sharp pain in right eye, burning sensation, foreign body sensation, blurred vision since 2 days</option>
                                <option value="sharp pain in left eye, burning sensation, foreign body sensation, blurred vision since 2 days">sharp pain in left eye, burning sensation, foreign body sensation, blurred vision since 2 days</option>
                                <option value="redness, photophobia,pain,lacrimation,DOV,vascularization,corneal abrasion">redness, photophobia,pain,lacrimation,DOV,vascularization,corneal abrasion</option>
                                <option value="redness, photophobia,pain,lacrimation,DOV,vascularization,corneal abrasion">redness, photophobia,pain,lacrimation,DOV,vascularization,corneal abrasion</option>
                                <option value="cutaneous lesion in periorbital region,severe pain,corneal abrasion,DOV,Lacrimation">cutaneous lesion in periorbital region,severe pain,corneal abrasion,DOV,Lacrimation</option>
                                <option value="cutaneous lesion in periorbital region,severe pain,corneal abrasion,DOV,Lacrimation">cutaneous lesion in periorbital region,severe pain,corneal abrasion,DOV,Lacrimation</option>
                                <option value="diminish of vision(distance)">diminish of vision(distance)</option>
                                <option value="diminish of vision(near)">diminish of vision(near)</option>
                                <option value="pain in right ear since 5 days">pain in right ear since 5 days</option> 
                                <option value="Ringing in the ear (right ear)">Ringing in the ear (right ear)</option>
                                <option value="Ringing in the ear (left ear)">Ringing in the ear (left ear)</option>
                                <option value="loss of hearing (right ear)">loss of hearing (right ear)</option>
                                <option value="loss of hearing (left ear)">loss of hearing (left ear)</option>
                                <option value="pain In right ear as well as itching, loss of hearing (right ear)">pain In right ear as well as itching, loss of hearing (right ear)</option>
                                <option value="pain In left ear as well as itching, loss of hearing (left ear)">pain In left ear as well as itching, loss of hearing (left ear)</option>
                                <option value="pus discharge from right ear, pain in ear, fullness in ear">pus discharge from right ear, pain in ear, fullness in ear</option>
                                <option value="pus discharge from left ear, pain in ear, fullness in ear">pus discharge from left ear, pain in ear, fullness in ear</option>
                                <option value="severe pain in right ear, itching, irritation">severe pain in right ear, itching, irritation</option>
                                <option value="severe pain in left ear, itching, irritation">severe pain in left ear, itching, irritation</option>
                                <option value="severe itching in right ear, pain, redness, feeling of fullness in ear">severe itching in right ear, pain, redness, feeling of fullness in ear</option>
                                <option value="severe itching in left ear, pain, redness, feeling of fullness in ear">severe itching in left ear, pain, redness, feeling of fullness in ear</option>
                                <option value="congestion,sneezing,runny nose,headache,sinus pain,fatigue,malaise,mucous discharge from nose">congestion,sneezing,runny nose,headache,sinus pain,fatigue,malaise,mucous discharge from nose</option>
                                <option value="bledding from nose">bledding from nose</option>
                                <option value="obstruction of noistrils,congested noistril,loss of smell,mouth breathing">obstruction of noistrils,congested noistril,loss of smell,mouth breathing</option>
                                <option value="painfull swelling of nose,boils in nostril,nose bleeds,fever">painfull swelling of nose,boils in nostril,nose bleeds,fever</option>
                                <option value="runny nose,nasal congestion,sneezing,mouth breathing,loss of smell,headache">runny nose,nasal congestion,sneezing,mouth breathing,loss of smell,headache</option>
                                <option value="pain at forehead,back of eyes,sinuses,nasal congestion,sleeping difficulty,mouth breathing,fever,malaise,runny nose">pain at forehead,back of eyes,sinuses,nasal congestion,sleeping difficulty,mouth breathing,fever,malaise,runny nose</option>
                                <option value="throat pain, fever, trouble swllowing">throat pain, fever, trouble swllowing</option> 
                                <option value="sore throat, pain during swallowing, pain while speaking">sore throat, pain during swallowing, pain while speaking</option> 
                                <option value="fever, coughing, pain while swallowing, decreased appetite, feeling something in throat">fever, coughing, pain while swallowing, decreased appetite, feeling something in throat</option>
                                <option value="pain and burning feeling in mouth">pain and burning feeling in mouth</option>
                                <option value="toothache, spontameous pain, tooth sensitivity, sharp pain while eating cold">toothache, spontameous pain, tooth sensitivity, sharp pain while eating cold</option>
                                <option value="constant tooth pain, fever and headache">constant tooth pain, fever and headache</option>
                                <option value="sensitivity to cold temperature, toothache">sensitivity to cold temperature, toothache</option>
                                <option value="teeth feel fuzzy, bleeding gums, bad breath, red swollen gums">teeth feel fuzzy, bleeding gums, bad breath, red swollen gums</option>
                                <option value="Blurring of vision">Blurring of vision</option>
                                <option value="Blurring of vision and Headache">Blurring of vision and Headache</option>
                                <option value="Headache">Headache</option>
                                <option value="Headache and Watering">Headache and Watering</option>
                                <option value="Redness (RE)">Redness (RE)</option>
                                <option value="Redness (LE)">Redness (LE)</option>
                                <option value="Both Eye Redness">Both Eye Redness</option>
                                <option value="DOV (Distant and Near)">DOV (Distant and Near)</option>
                                <option value="DOV (Distant)">DOV (Distant)</option>
                                <option value="DOV (Near)">DOV (Near)</option>
                                <option value="DOV (Distant) and Headache">DOV (Distant) and Headache</option>
                                

                              </select>
                              
                              
                            <?php } else {?>
                        
                        
                    <input name="c_o" type="text" class="form-control" id="c_o" placeholder="" value="<?php echo ($result1)?$result1->sym_name:'';?>" >
                       <?php } ?>
                     </div>
                  </div>


                 <?php if($patient->department_id == 32)
                    { ?>
                   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Weight<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="weight" type="text" class="form-control" id="weight" placeholder="Weight" value="<?php echo ($result1)?$result1->weight:'';?>" >
                        <input name="department_id" type="hidden" class="form-control" id="department_id" placeholder="Department_id" value="" >
                     </div>
                  </div>
                 <?php } ?>
                  <?php if($patient->department_id != 30)
                    { ?>
				  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">H/o<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="h_o" type="text" class="form-control" id="h_o" placeholder="" value="<?php echo ($result1)?$result1->h_o:'';?>" >
                     </div>
                  </div>
                  <?php } ?>
                  
                  <?php if($patient->department_id !='30'){ ?>
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Local Examination<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        <input name="local_examination" type="text" class="form-control" id="local_examination" placeholder="Local Examination" value="<?php echo ($result1)?$result1->local_examination:'';?>" >
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
                           
                           <?php if($patient->department_id == 30)
                    { ?>
                           <select name="bp" class="form-control" id="bp">
                                <option value="<?php echo ($result1)?$result1->bp:''; ?>"><?php echo ($result1)?$result1->bp:'Select'; ?></option>
                                <option value="120/80 mm of hg">120/80 mm of hg</option>
                                <option value="110/70mmhg">110/70mmhg</option>
                                <option value="130/80mmhg">130/80mmhg</option>
                                <option value="140/80mmhg">140/80mmhg</option>
                            </select>
                            <?php } else {?>
                            <input name="bp" type="text" class="form-control" id="bp" placeholder="BP" value="<?php echo ($result1)?$result1->bp:''; ?>" >
                            <?php } ?>
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
                            <!--<select name="pulse" id="pulse" class="form-control">-->
                            <!--    <option value="">Select option</option>-->
                            <!--<?php foreach($pulse as $x => $x_val ){ ?>-->
                            <!--    <option value="<?php echo $x; ?>" <?php if($result1->pulse==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>-->
                            <!--<?php }?>-->
                            <!--</select>-->
                            <input name="pulse" type="text" class="form-control" id="pulse" placeholder="" value="<?php echo ($result1)?$result1->pulse:''; ?>" >
                            
                     </div>
                  </div>


                  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">Temp</label>
                      <div class="col-xs-9">
                            <input name="temp" type="text" class="form-control" id="temp" placeholder="Temp" value="<?php echo ($result1)?$result1->temp:''; ?>" >
                        </div>
                     </div>
				 
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">CVS <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="cvs" type="text" class="form-control" id="cvs" placeholder="CVS" value="<?php echo ($result1)?$result1->cvs:'';?>" >
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">CNS <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="cns" type="text" class="form-control" id="cns" placeholder="CNS" value="<?php echo ($result1)?$result1->cns:'';?>" >
                     </div>
                  </div>


                  <?php if($patient->department_id != 30)
                    { ?>
                  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">P/A</label>
                     <div class="col-xs-9"> 
                       <input name="pa" type="text" class="form-control" id="pa" placeholder="PA" value="<?php echo($result1)?$result1->pa:'' ?>">
                     </div>
                  </div>
                 
                 
                
                  <?php } ?>
                 
                  <?php if($patient->department_id =='29'){ ?>
                 <div class="form-group row">
                   <div class="col-xs-12">
                     <h3>Menstral History</h3>
                   </div>
                 </div>
                  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">LMP</label>
                     <div class="col-xs-9"> 
                       <input name="LMP" type="text" class="form-control datepicker" id="LMP" placeholder="LMP" value="">
                     </div>
                  </div>
                 
                 <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">NO. OF DAYS</label>
                     <div class="col-xs-9"> 
                       <input name="NO_OF_DAYS" type="text" class="form-control" id="NO_OF_DAYS" placeholder="NO. OF DAYS" value="">
                     </div>
                  </div>
                 
                 
                  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">PATTERN</label>
                     <div class="col-xs-9"> 
                       <select name="PATTERN" class="form-control" id="PATTERN">
                         <option value="regular">regular</option>
                          <option value="irregular">irregular</option>
                       </select>
                     </div>
                  </div>
                 
                 
                 <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">FLOW</label>
                     <div class="col-xs-9"> 
                       
                       <select name="FLOW" class="form-control" id="FLOW">
                         <option value="scanty">scanty</option>
                          <option value="moderate">moderate</option>
                         <option value="heavy">heavy</option>
                       </select>
                     </div>
                  </div>
                 
                 
                 <div class="form-group row">
                   <div class="col-xs-12">
                     <h3>Obstetric History</h3>
                   </div>
                 </div>
                 <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">Obstetric History</label>
                     <div class="col-xs-9"> 
                       <textarea name="Obstetric_History" type="text" class="form-control" id="Obstetric_History" placeholder="Obstetric History" value=""></textarea>
                     </div>
                  </div>
                 
                 <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">Marital Status</label>
                     <div class="col-xs-9"> 
                       <select name="Marita_Status" class="form-control" id="Marita_Status">
                         <option value="Married">Married</option>
                          <option value="Unmarried">Unmarried</option>
                       </select>
                     </div>
                  </div>
                 
                 <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">Marital Years</label>
                     <div class="col-xs-9"> 
                       <input name="Marital_years" type="text" class="form-control" id="Marital_years" placeholder="Marital Years" value="">
                     </div>
                  </div>
                 
                 
                  
                 <?php } ?>
                 
				   
				  
                     
                    <?php } ?>  
                     
                        <?php if($patient->department_id == 30)
                        { ?>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">PAST HISTORY
                            </label>
                            <div class="col-xs-9"> 
                            

                                <select name="PAST_HISTORY" class="form-control" id="PAST_HISTORY">
                                <option value="<?php echo ($result1)?$result1->PAST_HISTORY:''; ?>"><?php echo ($result1)?$result1->PAST_HISTORY:'Select'; ?></option>
                                <option value="N/H/O- DM/HTN/BA Or any major illness ">N/H/O- DM/HTN/BA Or any major illness </option>
                                <option value="K/C/O- HTN">K/C/O- HTN</option>
                                <option value="K/C/O- DM">K/C/O- DM</option>
                                <option value="K/C/O- HTN & DM">K/C/O- HTN & DM</option>
                            </select>


                                <!--<input type="text" class="form-control" name="PAST_HISTORY" id="PAST_HISTORY" placeholder="PAST_HISTORY" value="<?php echo ($result1)?$result1->PAST_HISTORY:NULL; ?>">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नेत्र (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            
                            <select name="BAHYA_NETRA_RE" class="form-control" id="BAHYA_NETRA_RE">
                                <option value="<?php echo ($result1)?$result1->BAHYA_NETRA_RE:''; ?>"><?php echo ($result1)?$result1->BAHYA_NETRA_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Periorbital Oedema">Periorbital Oedema</option>
                                <option value="Periorbital Heamatoma">Periorbital Heamatoma</option>
                            </select>
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BAHYA_NETRA_RE:''; ?>" name="BAHYA_NETRA_RE" id="BAHYA_NETRA_RE" placeholder="BAHYA_NETRA_RE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">वर्त्म मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            
                             <select name="VARTMA_MANDAL_RE" class="form-control" id="VARTMA_MANDAL_RE">
                                <option value="<?php echo ($result1)?$result1->VARTMA_MANDAL_RE:''; ?>"><?php echo ($result1)?$result1->VARTMA_MANDAL_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)<option>
                                <option value="Oedema">Oedema</option>
                                <option value="Follicle seen">Follicle seen</option>
                                <option value="Papillae seen">Papillae seen</option>
                                <option value="Pus point seen on lid margin">Pus point seen on lid margin</option>
                                <option value="White scales seen on eyelid margin">White scales seen on eyelid margin</option>
                            </select>
                                <!--<input type="text" value="<?php echo ($result1)?$result1->VARTMA_MANDAL_RE:''; ?>"  class="form-control" name="VARTMA_MANDAL_RE" id="VARTMA_MANDAL_RE" placeholder="VARTMA_MANDAL_RE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">शुक्ल मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            


                                <select name="SHUKL_MANDAL_RE" class="form-control" id="SHUKL_MANDAL_RE">
                                <option value="<?php echo ($result1)?$result1->SHUKL_MANDAL_RE:''; ?>"><?php echo ($result1)?$result1->SHUKL_MANDAL_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)<option>
                                <option value="Redness">Redness</option>
                                <option value="Subconjunctival haemorrhage">Subconjunctival haemorrhage</option>
                                <option value="Fleshy growth seen near inner canthus">Fleshy growth seen near inner canthus</option>
                            </select>
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->SHUKL_MANDAL_RE:''; ?>" class="form-control" name="SHUKL_MANDAL_RE" id="SHUKL_MANDAL_RE" placeholder="SHUKL_MANDAL_RE">-->
                            </div>
                        </div> 
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">कृष्ण मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            <select name="KRUSHNA_MANDAL_RE" class="form-control" id="KRUSHNA_MANDAL_RE">
                                <option value="<?php echo ($result1)?$result1->KRUSHNA_MANDAL_RE:''; ?>"><?php echo ($result1)?$result1->KRUSHNA_MANDAL_RE:'Select'; ?></option>
                                <option value="प्राकृत(clear)">प्राकृत(clear)</option>
                                <option value="Cornal Opacity">Cornal Opacity</option>
                                <option value="Cornea Hazy">Cornea Hazy</option>
                                <option value="Corneal Oedema with corneal ulcer">Corneal Oedema with Corneal ulcer</option>
                                <option value="Corneal ulcer">Corneal ulcer</option>
                                <option value="Mutton Fat KP">Mutton Fat KP</option>
                                <option value="Foreign Body seen on cornea">Foreign Body seen on cornea</option>
                                
                            </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->KRUSHNA_MANDAL_RE:''; ?>" class="form-control" name="KRUSHNA_MANDAL_RE" id="KRUSHNA_MANDAL_RE" placeholder="KRUSHNA_MANDAL_RE">-->
                            </div>
                        </div> 
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">तारका मंडळ  (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                         

                                <select name="TARKA_MANDAL_RE" class="form-control" id="TARKA_MANDAL_RE">
                                <option value="<?php echo ($result1)?$result1->TARKA_MANDAL_RE:''; ?>"><?php echo ($result1)?$result1->TARKA_MANDAL_RE:'Select'; ?></option>
                                <option value="प्राकृत( Color pattern normal)">प्राकृत( Color pattern normal)</option>
                                <option value="Muddy Iris">Muddy Iris</option>
                                <option value="Iris Bombe">Iris Bombe</option>
                                <option value="Muddy iris with Koeppe's Nodules">Muddy iris with Koeppe's Nodules</option>
                                <option value="Muddy iris with Busacca'a Nodules">Muddy iris with Busacca'a Nodules</option>
                                <option value="Anterior Synechiae">Anterior Synechiae</option>
                                <option value="Posterior Synechiae">Posterior Synechiae</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->TARKA_MANDAL_RE:''; ?>" class="form-control" name="TARKA_MANDAL_RE" id="TARKA_MANDAL_RE" placeholder="TARKA_MANDAL_RE">-->
                            </div>
                        </div> 
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">दृष्टी मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            <select name="DRUSHTI_MANDAL_RE" class="form-control" id="DRUSHTI_MANDAL_RE">
                                <option value="<?php echo ($result1)?$result1->DRUSHTI_MANDAL_RE:''; ?>"><?php echo ($result1)?$result1->DRUSHTI_MANDAL_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Irregular Pupil Shape">Irregular Pupil Shape</option>
                                <option value="Narrow pupil">Narrow pupil</option>
                                
                            </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->DRUSHTI_MANDAL_RE:''; ?>" class="form-control" name="DRUSHTI_MANDAL_RE" id="DRUSHTI_MANDAL_RE" placeholder="DRUSHTI_MANDAL_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">पूर्व वेश्म (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                             <select name="PURV_VESHMA_RE" class="form-control" id="PURV_VESHMA_RE">
                                <option value="<?php echo ($result1)?$result1->PURV_VESHMA_RE:''; ?>"><?php echo ($result1)?$result1->PURV_VESHMA_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Well Formed">Well Formed</option>
                                <option value="Shallow AC">Shallow AC</option>
                                <option value="Deep AC">Deep AC</option>
                                <option value="Hypopyon">Hypopyon</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->PURV_VESHMA_RE:''; ?>" class="form-control" name="PURV_VESHMA_RE" id="PURV_VESHMA_RE" placeholder="PURV_VESHMA_RE">-->
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">अभिंग 	(RE)
                            </label>
                            <div class="col-xs-9"> 

                             <select name="ABHING_RE" class="form-control" id="ABHING_RE">
                                <option value="<?php echo ($result1)?$result1->ABHING_RE:''; ?>"><?php echo ($result1)?$result1->ABHING_RE:'Select'; ?></option>
                                <option value="V/A- 6/6">V/A- 6/6</option>
                                <option value="V/A- 6/9">V/A- 6/9</option>
                                <option value="V/A- 6/12">V/A- 6/12</option>
                                <option value="V/A- 6/18">V/A- 6/18</option>
                                <option value="V/A- 6/24">V/A- 6/24</option>
                                <option value="V/A- 6/36">V/A- 6/36</option>
                                <option value="V/A- 6/60">V/A- 6/60</option>
                                <option value="CF 3 Feet">CF 3 Feet</option>
                                <option value="CF 2 Feet">CF 2 Feet</option>
                                <option value="CF 1 Feet">CF 1 Feet</option>
                                <option value="HM +ve">HM +ve</option>
                                <option value="PL+PR +ve">PL+PR +ve</option>
                                <option value="PL+PR -ve">PL+PR -ve</option>
                                <option value="CF Closed To Face">CF Closed To Face</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->ABHING_RE:''; ?>" class="form-control" name="ABHING_RE" id="ABHING_RE" placeholder="ABHING_RE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">सभिंग 	(RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            
                            <select name="SABHING_RE" class="form-control" id="SABHING_RE">
                                <option value="<?php echo ($result1)?$result1->SABHING_RE:''; ?>"><?php echo ($result1)?$result1->SABHING_RE:'Select'; ?></option>
                                <option value="V/A- 6/6">V/A- 6/6</option>
                                <option value="V/A- 6/9">V/A- 6/9</option>
                                <option value="V/A- 6/12">V/A- 6/12</option>
                                <option value="V/A- 6/18">V/A- 6/18</option>
                                <option value="V/A- 6/24">V/A- 6/24</option>
                                <option value="V/A- 6/36">V/A- 6/36</option>
                                <option value="V/A- 6/60">V/A- 6/60</option>
                                
                            </select>
                                <!--<input type="text" value="<?php echo ($result1)?$result1->SABHING_RE:''; ?>" class="form-control" name="SABHING_RE" id="SABHING_RE" placeholder="SABHING_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">IOP RE
                            </label>
                            <div class="col-xs-9"> 
                            
                           
                            
                            <select name="IOP_RE" class="form-control" id="IOP_RE">
                                <option value="<?php echo ($result1)?$result1->IOP_RE:''; ?>"><?php echo ($result1)?$result1->IOP_RE:'Select'; ?></option>
                                <option value="10.2mmhg">10.2mmhg</option>
                                <option value="1102mmhg">11.2mmhg</option>
                                <option value="1406mmhg">14.6mmhg</option>
                                <option value="17.3mmhg">17.3mmhg</option>
                                <option value="20.6mmhg">20.6mmhg</option>
                                <option value="24.4mmhg">24.4mmhg</option>
                                <option value="26.6mmhg">26.6mmhg</option>
                                <option value="29mmhg">29mmhg</option>
                                <option value="34.5mmhg">34.5mmhg</option>
                            </select>
                            
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->IOP_RE:''; ?>" class="form-control" name="IOP_RE" id="IOP_RE" placeholder="IOP_RE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">PUPIL RE
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="PUPIL_RE" class="form-control" id="PUPIL_RE">
                                <option value="<?php echo ($result1)?$result1->PUPIL_RE:''; ?>"><?php echo ($result1)?$result1->PUPIL_RE:'Select'; ?></option>
                                <option value="Round">Round</option>
                                <option value="Regular">Regular</option>
                                <option value="Reacting to light">Reacting to light</option>
                                <option value="RAPD">RAPD</option>
                                <option value="NSRL">NSRL</option>
                                <option value="Pinpoint Pupil">Pinpoint Pupil</option>
                            </select>
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->PUPIL_RE:''; ?>" class="form-control" name="PUPIL_RE" id="PUPIL_RE" placeholder="PUPIL_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">LENS RE
                            </label>
                            <div class="col-xs-9"> 
                            

                                <select name="LENS_RE" class="form-control" id="LENS_RE">
                                <option value="<?php echo ($result1)?$result1->LENS_RE:''; ?>"><?php echo ($result1)?$result1->LENS_RE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="ELC">ELC</option>
                                <option value="ISC">ISC</option>
                                <option value="NS Gr1">NS Gr1</option>
                                <option value="NS Gr2">NS Gr2</option>
                                <option value="NS Gr3">NS Gr3</option>
                                <option value="NS Gr4">NS Gr4</option>
                                <option value="PsPh">PsPh</option>
                                
                                <option value="NS Gr1+Cort Gr1">NS Gr1+Cort Gr1</option>
                                <option value="NS Gr2+Cort Gr2">NS Gr2+Cort Gr2</option>
                                <option value="NS Gr3+Cort Gr3">NS Gr3+Cort Gr3</option>
                                <option value="NS Gr4+Cort Gr4">NS Gr4+Cort Gr4</option>
                            </select>

                                <!--<input type="text" value="<?php echo ($result1)?$result1->LENS_RE:''; ?>" class="form-control" name="LENS_RE" id="LENS_RE" placeholder="LENS_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">OD RE
                            </label>
                            <div class="col-xs-9"> 
                           

                                <select name="OD_RE" class="form-control" id="OD_RE">
                                <option value="<?php echo ($result1)?$result1->OD_RE:''; ?>"><?php echo ($result1)?$result1->OD_RE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Hyperaemic">Hyperaemic</option>
                                <option value="paler disc">paler disc</option>
                                <option value="chalky white">chalky white</option>
                                <option value="haemorrhages seen on disc">haemorrhages seen on disc</option>
                                <option value="Neovascularization on disc">Neovascularization on disc</option>
                                <option value="papilloedema">papilloedema</option>
                                <option value="papillitis">papillitis</option>
                                
                            </select>
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->OD_RE:''; ?>" class="form-control" name="OD_RE" id="OD_RE" placeholder="OD_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">CDR RE
                            </label>
                            <div class="col-xs-9"> 

                          
                            
                              <select name="CDR_RE" class="form-control" id="CDR_RE">
                                <option value="<?php echo ($result1)?$result1->CDR_RE:''; ?>"><?php echo ($result1)?$result1->CDR_RE:'Select'; ?></option>
                                <option value=" 0.3:1"> 0.3:1</option>
                                <option value=" 0.5.1"> 0.5:1</option>
                                <option value=" 0.7:1"> 0.7:1</option>
                                <option value=" 0.4:1"> 0.4:1</option>
                                <option value=" 0.8:1"> 0.8:1</option>
                             </select>
                                <!--<input type="text" value="<?php echo ($result1)?$result1->CDR_RE:''; ?>" class="form-control" name="CDR_RE" id="CDR_RE" placeholder="CDR_RE">-->
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">MACULA RE
                            </label>
                            <div class="col-xs-9"> 
                            
                            

                                <select name="MACULA_RE" class="form-control" id="MACULA_RE">
                                <option value="<?php echo ($result1)?$result1->MACULA_RE:''; ?>"><?php echo ($result1)?$result1->MACULA_RE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Macular Hole">Macular Hole</option>
                                <option value="Macular Haemorrhage">Macular Haemorrhage</option>
                                <option value="Hard Exuadate">Hard Exuadate</option>
                                <option value="Cheery red spot">Cheery red spot</option>
                                <option value="Macular hole with hard exudate">Macular hole with hard exudate</option>
                             </select>

                                <!--<input type="text" value="<?php echo ($result1)?$result1->MACULA_RE:''; ?>" class="form-control" name="MACULA_RE" id="MACULA_RE" placeholder="MACULA_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">BLOOD VESSELS RE
                            </label>
                            <div class="col-xs-9"> 
                            
                       
                            
                                <select name="BLOOD_VESSELS_RE" class="form-control" id="BLOOD_VESSELS_RE">
                                <option value="<?php echo ($result1)?$result1->BLOOD_VESSELS_RE:''; ?>"><?php echo ($result1)?$result1->BLOOD_VESSELS_RE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Narrowing of arterioles">Narrowing of arterioles</option>
                                <option value="Gunn sign">Gunn sign</option>
                                <option value="Gunn & salu's sign with copper wiring">Gunn & salu's sign with copper wiring</option>
                                <option value="salu's sign">salu's sign</option>
                                <option value="Bonnet sign">Bonnet sign</option>
                             </select>
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->BLOOD_VESSELS_RE:''; ?>" class="form-control" name="BLOOD_VESSELS_RE" id="BLOOD_VESSELS_RE" placeholder="BLOOD_VESSELS_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">PERIPHERAL RETINA RE
                            </label>
                            <div class="col-xs-9"> 
                            
                            

                                <select name="PERIPHERAL_RETINA_RE" class="form-control" id="PERIPHERAL_RETINA_RE">
                                <option value="<?php echo ($result1)?$result1->PERIPHERAL_RETINA_RE:''; ?>"><?php echo ($result1)?$result1->PERIPHERAL_RETINA_RE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Tesselated fundus">Tesselated fundus</option>
                                <option value="Haemmorhages with hard exudate">Haemmorhages with hard exudate</option>
                                <option value="hard exudate">hard exudate</option>
                                <option value="horse shoe retinal detachment">horse shoe retinal detachment</option>
                              
                             </select>
                            


                                <!--<input type="text" value="<?php echo ($result1)?$result1->PERIPHERAL_RETINA_RE:''; ?>" class="form-control" name="PERIPHERAL_RETINA_RE" id="PERIPHERAL_RETINA_RE" placeholder="PERIPHERAL_RETINA_RE">-->
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य कर्ण (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                           
                            
                             <select name="BAHYA_KARN_RE" class="form-control" id="BAHYA_KARN_RE">
                                <option value="<?php echo ($result1)?$result1->BAHYA_KARN_RE:''; ?>"><?php echo ($result1)?$result1->BAHYA_KARN_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Congestion">Congestion</option>
                              
                             </select>
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->BAHYA_KARN_RE:''; ?>" class="form-control" name="BAHYA_KARN_RE" id="BAHYA_KARN_RE" placeholder="BAHYA_KARN_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">कर्ण कुहर (RE)
                            </label>
                            <div class="col-xs-9"> 
                           

                             <select name="KARN_KUHAR_RE" class="form-control" id="KARN_KUHAR_RE">
                                <option value="<?php echo ($result1)?$result1->KARN_KUHAR_RE:''; ?>"><?php echo ($result1)?$result1->KARN_KUHAR_RE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Oedema ">Oedema</option>
                                <option value="Hard Wax ">Hard Wax</option>
                                <option value="Soft Wax ">Soft Wax</option>
                                <option value="Pus Discharge">Pus Discharge</option>
                                <option value="FB with congestion">FB with congestion</option>
                                <option value="Fungus seen">Fungus seen</option>
                              
                             </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->KARN_KUHAR_RE:''; ?>" class="form-control" name="KARN_KUHAR_RE" id="KARN_KUHAR_RE" placeholder="KARN_KUHAR_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">मध्य कर्ण (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                             <select name="MADHYA_KARNA_RE" class="form-control" id="MADHYA_KARNA_RE">
                                <option value="<?php echo ($result1)?$result1->MADHYA_KARNA_RE:''; ?>"><?php echo ($result1)?$result1->MADHYA_KARNA_RE:'Select'; ?></option>
                                <option value="प्राकृत(Intact)">प्राकृत(Intact)</option>
                                <option value="TM Perforated">TM Perforated</option>
                                <option value="TM Congestion">TM Congestion</option>
                                <option value="TM Degeneration">TM Degeneration</option>
                              
                             </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->MADHYA_KARNA_RE:''; ?>" class="form-control" name="MADHYA_KARNA_RE" id="MADHYA_KARNA_RE" placeholder="MADHYA_KARNA_RE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नासिका (RE)
                            </label>
                            <div class="col-xs-9">

                             
                                <select name="BAHYA_NASIKA_RE" class="form-control" id="BAHYA_NASIKA_RE">
                                <option value="<?php echo ($result1)?$result1->BAHYA_NASIKA_RE:''; ?>"><?php echo ($result1)?$result1->BAHYA_NASIKA_RE:'Select'; ?></option>    
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="Deformed">Deformed</option>
                                <option value="Boil seen">Boil seen</option>
                              
                             </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->BAHYA_NASIKA_RE:''; ?>" class="form-control" name="BAHYA_NASIKA_RE" id="BAHYA_NASIKA_RE" placeholder="BAHYA_NASIKA_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">नासागुहा (RE)
                            </label>
                            <div class="col-xs-9"> 
                

                             <select name="NASAGUHA_RE" class="form-control" id="NASAGUHA_RE">
                                <option value="<?php echo ($result1)?$result1->NASAGUHA_RE:''; ?>"><?php echo ($result1)?$result1->NASAGUHA_RE:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Hypertrophy of inferior turbininate">Hypertrophy of inferior turbininate</option>
                                <option value="Deviation seen">Deviation seen</option>
                                <option value="polyp seen">polyp seen</option>
                              
                             </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->NASAGUHA_RE:''; ?>" class="form-control" name="NASAGUHA_RE" id="NASAGUHA_RE" placeholder="NASAGUHA_RE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">शैलश्रीक कला  (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                      
                                <select name="SHAILSHRIK_KALA_RE" class="form-control" id="SHAILSHRIK_KALA_RE">
                                <option value="<?php echo ($result1)?$result1->SHAILSHRIK_KALA_RE:''; ?>"><?php echo ($result1)?$result1->SHAILSHRIK_KALA_RE:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Mucous membrane congestion">Mucous membrane congestion</option>
                                <option value="Boil seen">Boil seen</option>
                              
                             </select>
                            




                                <!--<input type="text" value="<?php echo ($result1)?$result1->SHAILSHRIK_KALA_RE:''; ?>" class="form-control" name="SHAILSHRIK_KALA_RE" id="SHAILSHRIK_KALA_RE" placeholder="SHAILSHRIK_KALA_RE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">ओष्ठ 
                            </label>
                            <div class="col-xs-9"> 

                                <select name="OSHTH" class="form-control" id="OSHTH">
                                <option value="<?php echo ($result1)?$result1->OSHTH:''; ?>"><?php echo ($result1)?$result1->OSHTH:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="cleft lip">cleft lip</option>
                                <option value="cheilitis">cheilitis</option>
                              <option value="Mucocele">Mucocele</option>
                             </select>
                            


                                <!--<input type="text" value="<?php echo ($result1)?$result1->OSHTH:''; ?>" class="form-control" name="OSHTH" id="OSHTH" placeholder="OSHTH">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">जिव्हा 
                            </label>
                            <div class="col-xs-9">
                            
            
                                <select name="JIVHA" class="form-control" id="JIVHA">
                                <option value="<?php echo ($result1)?$result1->JIVHA:''; ?>"><?php echo ($result1)?$result1->JIVHA:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Multiple ulcers">Multiple ulcer</option>
                             </select>


                                <!--<input type="text" value="<?php echo ($result1)?$result1->JIVHA:''; ?>" class="form-control" name="JIVHA" id="JIVHA" placeholder="JIVHA">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">गिलायू 
                            </label>
                            <div class="col-xs-9">
                            

                                <select name="GILAYU" class="form-control" id="GILAYU">
                                <option value="<?php echo ($result1)?$result1->GILAYU:''; ?>"><?php echo ($result1)?$result1->GILAYU:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="congestion with inflammed tonsilis">congestion with inflammed tonsilis</option>
                             </select>


 
                                <!--<input type="text" value="<?php echo ($result1)?$result1->GILAYU:''; ?>" class="form-control" name="GILAYU" id="GILAYU" placeholder="GILAYU">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">कंठ 
                            </label>
                            <div class="col-xs-9"> 
                            
                            
                         

                                <select name="KANTH" class="form-control" id="KANTH">
                                <option value="<?php echo ($result1)?$result1->KANTH:''; ?>"><?php echo ($result1)?$result1->KANTH:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="Difficulty in swallowing">Difficulty in swallowing</option>
                             </select>



                                <!--<input type="text" value="<?php echo ($result1)?$result1->KANTH:''; ?>" class="form-control" name="KANTH" id="KANTH" placeholder="KANTH">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">कपालस्ठी 
                            </label>
                            <div class="col-xs-9"> 
                    
                            
                              <select name="KAPALASTHI" class="form-control" id="KAPALASTHI">
                                <option value="<?php echo ($result1)?$result1->KAPALASTHI:''; ?>"><?php echo ($result1)?$result1->KAPALASTHI:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                             </select>

                                <!--<input type="text" value="<?php echo ($result1)?$result1->KAPALASTHI:''; ?>" class="form-control" name="KAPALASTHI" id="KAPALASTHI" placeholder="KAPALASTHI">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">शस्त्रक्रम  
                            </label>
                            <div class="col-xs-9"> 
                            <select name="SHASRAKARM" class="form-control" id="SHASRAKARM">
                                <option value="<?php echo ($result1)?$result1->SHASRAKARM:''; ?>"><?php echo ($result1)?$result1->SHASRAKARM:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                
                                <option value="Advice- Right eye SICS with PCIOL under LA">Advice- Right eye SICS with PCIOL under LA</option>
                                <option value="Advice- Left  eye SICS with PCIOL under LA">Advice- Left  eye SICS with PCIOL under LA</option>
                                <option value="Advice- right eye pterygium excision with conjunctival autograft under LA">Advice- right eye pterygium excision with conjunctival autograft under LA</option>
                                <option value="Advice- LEFT  eye pterygium excision with conjunctival autograft under LA">Advice- LEFT  eye pterygium excision with conjunctival autograft under LA</option>
                                <option value="f/ up after 20 days">f/ up after 20 days</option>
                                <option value="f/up after 7 days ">f/up after 7 days </option>


                             </select>
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->SHASRAKARM:''; ?>" class="form-control" name="SHASRAKARM" id="SHASRAKARM" placeholder="SHASRAKARM">-->
                            </div>
                        </div>
                        
                         <?php if($patient->ipd_opd == 'ipd'){ ?>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">OPERATIVE NOTES
                            </label>
                            <div class="col-xs-9"> 
                                <input type="text" class="form-control" value="<?php echo ($result1)?$result1->OPERATIVE_NOTES:''; ?>" name="OPERATIVE_NOTES" id="OPERATIVE_NOTES" placeholder="OPERATIVE_NOTES">
                            </div>
                        </div>
                        
                        <?php }} ?>
                     
                  </div>
                 
			   
			   
               <div class="col-md-6 col-sm-12">
			      <div class="form-group row">
                     <label for="ipd_no" class="col-xs-3 col-form-label">No.<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                        <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php $ye_no=$patient->yearly_reg_no; if($ye_no){ echo $ye_no;}else { echo $patient->old_reg_no; } ?>" readonly>
                     </div>
                  </div>
                 <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Dignosis<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                        
                          <?php if($patient->department_id== 30)
                    { ?>
                           <select name="dignosis" class="form-control" id="dignosis">
                                <option value="<?php echo ($result1)?$result1->dignosis:''; ?>"><?php echo ($result1)?$result1->dignosis:'Select'; ?></option>
                                
                                
                                
                                            <option value="RE Cataract">RE Cataract</option>
                                            <option value="LE Cataract">LE Cataract</option>
                                            <option value="RE Pterygium">RE Pterygium</option>
                                            <option value="LE Pterygium">LE Pterygium</option>
                                            <option value="shushkakshipaka (dry eye syndrome)">shushkakshipaka (dry eye syndrome)</option>
                                            <option value="Episcleritis">Episcleritis</option>
                                            <option value="bacterial conjunctivitis">bacterial conjunctivitis.</option>
                                            <option value="stye">stye</option>
                                            <!--<option value="stye">stye</option>-->
                                            <option value="chalazion">chalazion</option>
                                            <!--<option value="chalazion">chalazion</option>-->
                                            <option value="LE Acute Dacryocystitis">LE Acute Dacryocystitis</option>
                                            <option value="LE Posterior polar cataract">LE Posterior polar cataract </option>
                                            <option value="RE Posterior polar cataract">RE Posterior polar cataract </option>
                                            <option value="Anterior Uveitis">Anterior Uveitis</option>
                                            <!--<option value="subconjunctival haemorrhage (OD)">subconjunctival haemorrhage (OD)</option>-->
                                            <!--<option value="subconjunctival haemorrhage (Os)">subconjunctival haemorrhage (Os)</option>-->
                                            <option value="Subconjunctival haemorrhage ">Subconjunctival haemorrhage </option>
                                            <option value="Dacryosystitis">Dacryosystitis</option>
                                            <option value="Iritis">Iritis</option>
                                            <option value="Allergic conjunctivitis">Allergic conjunctivitis</option>
                                            <!--<option value="Iritis">Iritis</option>-->
                                            <option value="Blepharitis">Blepharitis</option>
                                            <option value="Foreign Body in Eye">Foreign Body in Eye</option>
                                            <option value="Bacterial corneal ulcer">Bacterial corneal ulcer</option>
                                            <option value="Viral corneal ulcer">Viral corneal ulcer</option>
                                            <option value="Dakshin Karnashool ">Dakshin Karnashool </option>
                                            
                                            
                                            <option value="Vam Karnashool">Vam Karnashool</option>
                                            <option value="Dakshin Karnanaad">Dakshin Karnanaad</option>
                                            <option value="Vam Karnanaad">Vam Karnanaad</option>
                                            <option value="Dakshin karna badhirya ">Dakshin karna badhirya </option>
                                            <option value=" Vam karna badhirya "> Vam karna badhirya </option>
                                            <option value="karna guthak">karna guthak</option>
                                            
                                            <option value="ASOM">ASOM</option>
                                            <option value="furuncle in right ear">furuncle in right ear</option>
                                            <option value="furuncle in left ear">furuncle in left ear</option>
                                            
                                            <option value="otomycosis">otomycosis</option>
                                            <option value="allergic rhinitis">allergic rhinitis</option>
                                            <option value="epistaxis">epistaxis</option>
                                            <option value="Deviated nasal septum">Deviated nasal septum</option>
                                            <option value="furunculosis of nose">furunculosis of nose</option>
                                            <option value="nasal polyp">nasal polyp</option>
                                            <option value="sinusitis">sinusitis</option>
                                            
                                            <option value="Deviated nasal septum">Deviated nasal septum</option>
                                            <option value="furunculosis of nose">furunculosis of nose</option>
                                            <option value="nasal polyp">nasal polyp</option>
                                            <option value="sinusitis">sinusitis</option>
                                            
                                            
                                            
                                            
                                            <option value="Tonsilitis">Tonsilitis</option>
                                            <option value="Pharyngitis">Pharyngitis</option>
                                            <option value="uvulitis">uvulitis</option>
                                            <option value="Mukhapak">Mukhapak</option>
                                            
                                            
                                            <option value="krumi data">krumi data</option>
                                            <option value="dantashool">dantashool</option>
                                            <option value="dantaharsha">dantaharsha</option>
                                            <option value="dantasharkara">dantasharkara</option>
                                            
                                            
                                            <option value="surgical cases">surgical cases</option>
                                            <option value="dakshin netra kaphaj linganash">dakshin netra kaphaj linganash/option>
                                            <option value="vam netra kaphaj linganash">vam netra kaphaj linganash</option>
                                            <option value="dakshin netra Arma(RE Perygium)-nasal progressive pterygium">dakshin netra Arma(RE Perygium)-nasal progressive pterygium</option>
                                            <option value="Vam netra Arma(LE Perygium)-nasal stationary pteryium">Vam netra Arma(LE Perygium)-nasal stationary pteryium</option>
                                            <option value="chronic DCT">chronic DCT</option>
                                            <option value="surgical cases(ENT)">surgical cases(ENT)</option>
                                            <option value="Tonsilitis">Tonsilitis</option>
                                            <option value="Post OP Cataract RE">Post OP Cataract RE</option>
                                            <option value="Post OP Cataract LE">Post OP Cataract LE</option>
                                            <option value="Presbyopia">Presbyopia</option>
                                            <option value="Periorbital Haematoma">Periorbital Haematoma</option>
                                            <option value="Shirshool">Shirshool</option>
                                            <option value="Refractive error">Refractive error</option>
                                            <option value="Karnsrav ">Karnsrav </option>
                                            <option value="FB in nose">FB in nose</option>
                                            <option value="CSOM">CSOM</option>
                                            <option value="Pratishyay">Pratishyay</option>
                                            <option value="Dry eye syndrome">Dry eye syndrome</option>
                                            <option value="Regular eye  checkup">Regular eye  checkup</option>
                                            <option value="LE Pterygium with Post OP cataract">LE Pterygium with Post OP cataract</option>
                                            <option value="B/L HMSC">B/L HMSC</option>
                             				<option value="RE Pterygium with Cataract">RE Pterygium with Cataract</option>
                             				<option value="LE Pterygium with Cataract">LE Pterygium with Cataract</option>
                             <option value="Khalitya">Khalitya</option>
                                            
                                            <!--<option value="Refractive Error">Refractive Error</option>-->
                                            <!--<option value="Post-OP Cataract">Post-OP Cataract</option>-->
                                            <!--<option value="CSOM">CSOM</option>-->
                                            <!--<option value="Presbyopia">Presbyopia</option>-->
                                            <!--<option value="Periorbital Haematoma">Periorbital Haematoma</option>-->
                                            <!--<option value="Pratishyay">Pratishyay</option>-->
                                            <!--<option value="Shirshool">Shirshool</option>-->
                                            <!--<option value="Karnsrav">Karnsrav</option>-->
                                            <!--<option value="FB in nose">FB in nose</option>-->

                            </select>
                            <?php } else {?>
                            
                        <input name="dignosis" type="text" class="form-control" id="dignosis" placeholder="" value="<?php echo ($result1)?$result1->dignosis:$patient->dignosis; ?>" >
                     <?php } ?>
                     </div>
                  </div>
                  
                   
                  <?php if($patient->department_id == 30)
                    { ?>
                  <div class="form-group row" id="dept_type">
                            <label class="col-sm-3">Department Type <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <div class="form-check">
                                    <label class="radio-inline">
                                        <input type="radio" name="dept_type"  id="dept_type" value="N">Netra
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="dept_type" id="dept_type" value="M">Karn,Nasa,Mukh,Dant
                                    </label>
                                </div>
                            </div>
                        </div>
                  <?php } ?>
				   <div class="form-group row">
                     <label for="firstname" class="col-xs-3 col-form-label">Family History <i class="text-danger"></i></label>
                     <div class="col-xs-9">
                         
                         <!--<select name="f_h" class="form-control" id="f_h">
                         
                         <option value="<?php echo ($result1)?$result1->f_o:''; ?>"><?php echo ($result1)?$result1->f_o:''; ?></option>
                                   <option value="अविशेष">अविशेष</option>

                            </select>-->
                        <input name="f_h" type="text" class="form-control" id="f_h" placeholder="" value="<?php echo ($result1)?$result1->f_o:''; ?>" >
                     </div>
                  </div>

                  <?php if($patient->department_id != 30)
                    { ?>
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->netra==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->shudha==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->mal==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  
				  <div class="form-group row">
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->nidra==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                     </div>
                   

                  <div class="form-group row">
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
                           
                           <!--<select name="RS" id="RS" class="form-control">
								  <option value="">Select option</option>
					   	   <!-- <?//php foreach($ur as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->rs==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?//php }?>
						    
						   </select>-->
						   
						    <input name="RS" type="text" class="form-control" id="RS" placeholder="उर" value="<?php echo ($result1)?$result1->rs:'';?>" >
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">जिव्हा  </label>
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->givwa==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->ahar==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
				  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">मूत्र    </label>
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
								  <option value="<?php echo $x; ?>" <?php if($result1 && $result1->mutra==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
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
										
										 
										
											<option value="<?php echo $x; ?>" <?php if($result1 && $result1->nadi==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
											<?php }?>
										 </select>
                     </div>
                     
                     
                  </div>
                   <div class="form-group row">
                     <label for="udar" class="col-xs-3 col-form-label">उदर<i class="text-danger"></i></label>
                     <div class="col-xs-9">
                           <input name="patient_id" type="hidden" class="form-control" id="patient_id" placeholder="" value="<?php echo $patient_id; ?>" >
                        <input name="udar" type="text" class="form-control" id="udar" placeholder="" value="<?php echo ($result1)?$result1->ra:'';?>" >
                     </div>
                  </div>
                  
                  <?php } ?>
                  
                  
                  
                  <div class="form-group row">
                     <label for="blood_group" class="col-xs-3 col-form-label">Investigation</label>
                     <div class="col-xs-9"> 
                     
                     
                          <?php if($patient->department_id == 30)
                    { ?>
                                <select name="old_investigation" class="form-control" id="old_investigation">
                                <option value="<?php echo ($result1)?$result1->old_investigation:''; ?>"><?php echo ($result1)?$result1->old_investigation:'Select'; ?></option>
                                <option value="CBC,BSL-R,Urine-R,HIV,HBsAg,ECG)">CBC,BSL-R,Urine-R,HIV,HBsAg,ECG</option>
                                <option value="CBC,BT,CT">CBC,BT,CT</option>
                                <option value="RA FACTOR">RA FACTOR</option>
                                <option value="Schirmer tear test">Schirmer tear test</option>
                                
                            </select>
                     <?php } else {?>
                       <input name="old_investigation" type="text" class="form-control" id="old_investigation" placeholder="Investigation" value="">
                       <?php } ?>
<!--                       <input name="old_investigation" type="text" class="form-control" id="old_investigation" placeholder="Investigation" value="<?php echo ($result1)?$result1->old_investigation:''; ?>" >-->
                     </div>
                  </div>
                 
                    <?php if($patient->department_id == 30)
                    { ?>
                        <div class="form-group row">
                            
                            <label for="blood_group" class="col-xs-3 col-form-label">GONIOSCOPY
                            </label>
                            
                            
                             <div class="col-xs-9"> 
                            <select name="GONISCOPY" class="form-control" id="GONISCOPY">
                                <option value="<?php echo ($result1)?$result1->old_investigation:''; ?>"><?php echo ($result1)?$result1->GONISCOPY:'Select'; ?></option>
                                <option value="NAD">NAD</option>
                                <option value="Grade 0">Grade 0</option>
                                <option value="Grade 1">Grade 1</option>
                                <option value="Grade 2">Grade 2</option>
                                <option value="Grade 3">Grade 3</option>
                                <option value="Grade 4">Grade 4</option>
                                
                            </select>
                            
                            
                           
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->GONISCOPY:''; ?>" name="GONISCOPY" id="GONISCOPY" placeholder="GONIOSCOPY">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नेत्र (LE)
                            </label>
                            <div class="col-xs-9"> 
                            <select name="BAHYA_NETRA_LE" class="form-control" id="BAHYA_NETRA_LE">
                                <option value="<?php echo ($result1)?$result1->BAHYA_NETRA_LE:''; ?>"><?php echo ($result1)?$result1->BAHYA_NETRA_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Periorbital Oedema">Periorbital Oedema</option>
                                <option value="Periorbital Heamatoma">Periorbital Heamatoma</option>
                            </select>
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BAHYA_NETRA_LE:''; ?>" name="BAHYA_NETRA_LE" id="BAHYA_NETRA_LE" placeholder="BAHYA_NETRA_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">वर्त्म मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                        
                            
                            <select name="VARTMA_MANDAL_LE" class="form-control" id="VARTMA_MANDAL_LE">
                                <option value="<?php echo ($result1)?$result1->VARTMA_MANDAL_LE:''; ?>"><?php echo ($result1)?$result1->VARTMA_MANDAL_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)<option>
                                <option value="Oedema">Oedema</option>
                                <option value="Follicle seen">Follicle seen</option>
                                <option value="Papillae seen">Papillae seen</option>
                                <option value="Pus point seen on lid margin">Pus point seen on lid margin</option>
                                <option value="White scales seen on eyelid margin">White scales seen on eyelid margin</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->VARTMA_MANDAL_LE:''; ?>" name="VARTMA_MANDAL_LE" id="VARTMA_MANDAL_LE" placeholder="VARTMA_MANDAL_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">शुक्ल मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="SHUKL_MANDAL_LE" class="form-control" id="SHUKL_MANDAL_LE">
                                <option value="<?php echo ($result1)?$result1->SHUKL_MANDAL_LE:''; ?>"><?php echo ($result1)?$result1->SHUKL_MANDAL_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)<option>
                                <option value="Redness">Redness</option>
                                <option value="Subconjunctival haemorrhage">Subconjunctival haemorrhage</option>
                                <option value="Fleshy growth seen near inner canthus">Fleshy growth seen near inner canthus</option>
                            </select>

                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->SHUKL_MANDAL_LE:''; ?>" name="SHUKL_MANDAL_LE" id="SHUKL_MANDAL_LE" placeholder="SHUKL_MANDAL_LE">-->
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">कृष्ण मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="KRUSHNA_MANDAL_LE" class="form-control" id="KRUSHNA_MANDAL_LE">
                                <option value="<?php echo ($result1)?$result1->KRUSHNA_MANDAL_LE:''; ?>"><?php echo ($result1)?$result1->KRUSHNA_MANDAL_LE:'Select'; ?></option>
                                <option value="प्राकृत(clear)">प्राकृत(clear)</option>
                                <option value="Cornal Opacity">Cornal Opacity</option>
                                <option value="Cornea Hazy">Cornea Hazy</option>
                                <option value="Corneal Oedema with corneal ulcer">Corneal Oedema with Corneal ulcer</option>
                                <option value="Corneal ulcer">Corneal ulcer</option>
                                <option value="Mutton Fat KP">Mutton Fat KP</option>
                                <option value="Foreign Body seen on cornea">Foreign Body seen on cornea</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->KRUSHNA_MANDAL_LE:''; ?>" name="KRUSHNA_MANDAL_LE" id="KRUSHNA_MANDAL_LE" placeholder="KRUSHNA_MANDAL_LE">-->
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">तारका मंडळ  (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="TARKA_MANDAL_LE" class="form-control" id="TARKA_MANDAL_LE">
                                <option value="<?php echo ($result1)?$result1->TARKA_MANDAL_LE:''; ?>"><?php echo ($result1)?$result1->TARKA_MANDAL_LE:'Select'; ?></option>
                                <option value="प्राकृत( Color pattern normal)">प्राकृत( Color pattern normal)</option>
                                <option value="Muddy Iris">Muddy Iris</option>
                                <option value="Iris Bombe">Iris Bombe</option>
                                <option value="Muddy iris with Koeppe's Nodules">Muddy iris with Koeppe's Nodules</option>
                                <option value="Muddy iris with Busacca'a Nodules">Muddy iris with Busacca'a Nodules</option>
                                <option value="Anterior Synechiae">Anterior Synechiae</option>
                                <option value="Posterior Synechiae">Posterior Synechiae</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->TARKA_MANDAL_LE:''; ?>" name="TARKA_MANDAL_LE" id="TARKA_MANDAL_LE" placeholder="TARKA_MANDAL_LE">-->
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">दृष्टी मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="DRUSHTI_MANDAL_LE" class="form-control" id="DRUSHTI_MANDAL_LE">
                                <option value="<?php echo ($result1)?$result1->DRUSHTI_MANDAL_LE:''; ?>"><?php echo ($result1)?$result1->DRUSHTI_MANDAL_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Irregular Pupil Shape">Irregular Pupil Shape</option>
                                <option value="Narrow pupil">Narrow pupil</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->DRUSHTI_MANDAL_LE:''; ?>" name="DRUSHTI_MANDAL_LE" id="DRUSHTI_MANDAL_LE" placeholder="DRUSHTI_MANDAL_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">पूर्व वेश्म (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="PURV_VESHMA_LE" class="form-control" id="PURV_VESHMA_LE">
                                <option value="<?php echo ($result1)?$result1->PURV_VESHMA_LE:''; ?>"><?php echo ($result1)?$result1->PURV_VESHMA_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Well Formed">Well Formed</option>
                                <option value="Shallow AC">Shallow AC</option>
                                <option value="Deep AC">Deep AC</option>
                                <option value="Hypopyon">Hypopyon</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->PURV_VESHMA_LE:''; ?>" name="PURV_VESHMA_LE" id="PURV_VESHMA_LE" placeholder="PURV_VESHMA_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">अभिंग 	(LE)
                            </label>
                            <div class="col-xs-9">
                            
                            <select name="ABHING_LE" class="form-control" id="ABHING_LE">
                                <option value="<?php echo ($result1)?$result1->ABHING_LE:''; ?>"><?php echo ($result1)?$result1->ABHING_LE:'Select'; ?></option>
                                <option value="V/A- 6/6">V/A- 6/6</option>
                                <option value="V/A- 6/9">V/A- 6/9</option>
                                <option value="V/A- 6/12">V/A- 6/12</option>
                                <option value="V/A- 6/18">V/A- 6/18</option>
                                <option value="V/A- 6/24">V/A- 6/24</option>
                                <option value="V/A- 6/36">V/A- 6/36</option>
                                <option value="V/A- 6/60">V/A- 6/60</option>
                                <option value="CF 3 Feet">CF 3 Feet</option>
                                <option value="CF 2 Feet">CF 2 Feet</option>
                                <option value="CF 1 Feet">CF 1 Feet</option>
                                <option value="HM +ve">HM +ve</option>
                                <option value="PL+PR +ve">PL+PR +ve</option>
                                <option value="PL+PR -ve">PL+PR -ve</option>
                                <option value="CF Closed To Face">CF Closed To Face</option>
                            </select>

                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->ABHING_LE:''; ?>" name="ABHING_LE" id="ABHING_LE" placeholder="ABHING_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">सभिंग 	(LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="SABHING_LE" class="form-control" id="SABHING_LE">
                                <option value="<?php echo ($result1)?$result1->SABHING_LE:''; ?>"><?php echo ($result1)?$result1->SABHING_LE:'Select'; ?></option>
                                <option value="V/A- 6/6">V/A- 6/6</option>
                                <option value="V/A- 6/9">V/A- 6/9</option>
                                <option value="V/A- 6/12">V/A- 6/12</option>
                                <option value="V/A- 6/18">V/A- 6/18</option>
                                <option value="V/A- 6/24">V/A- 6/24</option>
                                <option value="V/A- 6/36">V/A- 6/36</option>
                                <option value="V/A- 6/60">V/A- 6/60</option>
                                
                            </select>

                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->SABHING_LE:''; ?>" name="SABHING_LE" id="SABHING_LE" placeholder="SABHING_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">IOP LE
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="IOP_LE" class="form-control" id="IOP_LE">
                                <option value="<?php echo ($result1)?$result1->IOP_LE:''; ?>"><?php echo ($result1)?$result1->IOP_LE:'Select'; ?></option>
                                <option value="10.2mmhg">10.2mmhg</option>
                                <option value="1102mmhg">11.2mmhg</option>
                                <option value="1406mmhg">14.6mmhg</option>
                                <option value="17.3mmhg">17.3mmhg</option>
                                <option value="20.6mmhg">20.6mmhg</option>
                                <option value="24.4mmhg">24.4mmhg</option>
                                <option value="26.6mmhg">26.6mmhg</option>
                                <option value="29mmhg">29mmhg</option>
                                <option value="34.5mmhg">34.5mmhg</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->IOP_LE:''; ?>" name="IOP_LE" id="IOP_LE" placeholder="IOP_LE">-->
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">PUPIL LE
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="PUPIL_LE" class="form-control" id="PUPIL_LE">
                                <option value="<?php echo ($result1)?$result1->PUPIL_LE:''; ?>"><?php echo ($result1)?$result1->PUPIL_LE:'Select'; ?></option>
                                <option value="Round">Round</option>
                                <option value="Regular">Regular</option>
                                <option value="Reacting to light">Reacting to light</option>
                                <option value="RAPD">RAPD</option>
                                <option value="NSRL">NSRL</option>
                                <option value="Pinpoint Pupil">Pinpoint Pupil</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->PUPIL_LE:''; ?>" name="PUPIL_LE" id="PUPIL_LE" placeholder="PUPIL_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">LENS LE
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="LENS_LE" class="form-control" id="LENS_LE">
                                <option value="<?php echo ($result1)?$result1->LENS_LE:''; ?>"><?php echo ($result1)?$result1->LENS_LE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="ELC">ELC</option>
                                <option value="ISC">ISC</option>
                                <option value="NS Gr1">NS Gr1</option>
                                <option value="NS Gr2">NS Gr2</option>
                                <option value="NS Gr3">NS Gr3</option>
                                <option value="NS Gr4">NS Gr4</option>
                                <option value="PsPh">PsPh</option>
                                <option value="NS Gr1+Cort Gr1">NS Gr1+Cort Gr1</option>
                                <option value="NS Gr2+Cort Gr2">NS Gr2+Cort Gr2</option>
                                <option value="NS Gr3+Cort Gr3">NS Gr3+Cort Gr3</option>
                                <option value="NS Gr4+Cort Gr4">NS Gr4+Cort Gr4</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->LENS_LE:''; ?>" name="LENS_LE" id="LENS_LE" placeholder="LENS_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">OD LE
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="OD_LE" class="form-control" id="OD_LE">
                                <option value="<?php echo ($result1)?$result1->OD_LE:''; ?>"><?php echo ($result1)?$result1->OD_LE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Hyperaemic">Hyperaemic</option>
                                <option value="paler disc">paler disc</option>
                                <option value="chalky white">chalky white</option>
                                <option value="haemorrhages seen on disc">haemorrhages seen on disc</option>
                                <option value="Neovascularization on disc">Neovascularization on disc</option>
                                <option value="papilloedema">papilloedema</option>
                                <option value="papillitis">papillitis</option>
                            </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->OD_LE:''; ?>" name="OD_LE" id="OD_LE" placeholder="OD_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">CDR LE
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="CDR_LE" class="form-control" id="CDR_LE">
                                <option value="<?php echo ($result1)?$result1->CDR_LE:''; ?>"><?php echo ($result1)?$result1->CDR_LE:'Select'; ?></option>
                                <option value=" 0.3:1"> 0.3:1</option>
                                <option value=" 0.5.1"> 0.5:1</option>
                                <option value=" 0.7:1"> 0.7:1</option>
                                <option value=" 0.4:1"> 0.4:1</option>
                                <option value=" 0.8:1"> 0.8:1</option>
                             </select>

                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->CDR_LE:''; ?>" name="CDR_LE" id="CDR_LE" placeholder="CDR_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">MACULA LE
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="MACULA_LE" class="form-control" id="MACULA_LE">
                                <option value="<?php echo ($result1)?$result1->MACULA_LE:''; ?>"><?php echo ($result1)?$result1->MACULA_LE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Macular Hole">Macular Hole</option>
                                <option value="Macular Haemorrhage">Macular Haemorrhage</option>
                                <option value="Hard Exuadate">Hard Exuadate</option>
                                <option value="Cheery red spot">Cheery red spot</option>
                                <option value="Macular hole with hard exudate">Macular hole with hard exudate</option>
                             </select>

                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->MACULA_LE:''; ?>" name="MACULA_LE" id="MACULA_LE" placeholder="MACULA_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">BLOOD VESSELS LE
                            </label>
                            <div class="col-xs-9">
                        
                                <select name="BLOOD_VESSELS_LE" class="form-control" id="BLOOD_VESSELS_LE">
                                <option value="<?php echo ($result1)?$result1->BLOOD_VESSELS_LE:''; ?>"><?php echo ($result1)?$result1->BLOOD_VESSELS_LE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Narrowing of arterioles">Narrowing of arterioles</option>
                                <option value="Gunn sign">Gunn sign</option>
                                <option value="Gunn & salu's sign with copper wiring">Gunn & salu's sign with copper wiring</option>
                                <option value="salu's sign">salu's sign</option>
                                <option value="Bonnet sign">Bonnet sign</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BLOOD_VESSELS_LE:''; ?>" name="BLOOD_VESSELS_LE" id="BLOOD_VESSELS_LE" placeholder="BLOOD_VESSELS_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">PERIPHERAL RETINA LE
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="PERIPHERAL_RETINA_LE" class="form-control" id="PERIPHERAL_RETINA_LE">
                                <option value="<?php echo ($result1)?$result1->PERIPHERAL_RETINA_LE:''; ?>"><?php echo ($result1)?$result1->PERIPHERAL_RETINA_LE:'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Tesselated fundus">Tesselated fundus</option>
                                <option value="Haemmorhages with hard exudate">Haemmorhages with hard exudate</option>
                                <option value="hard exudate">hard exudate</option>
                                <option value="horse shoe retinal detachment">horse shoe retinal detachment</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->PERIPHERAL_RETINA_LE:''; ?>" name="PERIPHERAL_RETINA_LE" id="PERIPHERAL_RETINA_LE" placeholder="PERIPHERAL_RETINA_LE">-->
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य कर्ण (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="BAHYA_KARN_LE" class="form-control" id="BAHYA_KARN_LE">
                                <option value="<?php echo ($result1)?$result1->BAHYA_KARN_LE:''; ?>"><?php echo ($result1)?$result1->BAHYA_KARN_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Congestion">Congestion</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BAHYA_KARN_LE:''; ?>" name="BAHYA_KARN_LE" id="BAHYA_KARN_LE" placeholder="BAHYA_KARN_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">कर्ण कुहर (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="KARN_KUHAR_LE" class="form-control" id="KARN_KUHAR_LE">
                                <option value="<?php echo ($result1)?$result1->KARN_KUHAR_LE:''; ?>"><?php echo ($result1)?$result1->KARN_KUHAR_LE:'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Oedema ">Oedema</option>
                                <option value="Hard Wax ">Hard Wax</option>
                                <option value="Soft Wax ">Soft Wax</option>
                                <option value="Pus Discharge">Pus Discharge</option>
                                <option value="FB with congestion">FB with congestion</option>
                                <option value="Fungus seen">Fungus seen</option>
                              
                             </select>
                            
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->KARN_KUHAR_LE:''; ?>" name="KARN_KUHAR_LE" id="KARN_KUHAR_LE" placeholder="KARN_KUHAR_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">मध्य कर्ण (LE)
                            </label>
                            <div class="col-xs-9">
                            
                            <select name="MADHYA_KARNA_LE" class="form-control" id="MADHYA_KARNA_LE">
                                <option value="<?php echo ($result1)?$result1->MADHYA_KARNA_LE:''; ?>"><?php echo ($result1)?$result1->MADHYA_KARNA_LE:'Select'; ?></option>
                                <option value="प्राकृत(Intact)">प्राकृत(Intact)</option>
                                <option value="TM Perforated">TM Perforated</option>
                                <option value="TM Congestion">TM Congestion</option>
                                <option value="TM Degeneration">TM Degeneration</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->MADHYA_KARNA_LE:''; ?>" name="MADHYA_KARNA_LE" id="MADHYA_KARNA_LE" placeholder="MADHYA_KARNA_LE">-->
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नासिका (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="BAHYA_NASIKA_LE" class="form-control" id="BAHYA_NASIKA_LE">
                                <option value="<?php echo ($result1)?$result1->BAHYA_NASIKA_LE:''; ?>"><?php echo ($result1)?$result1->BAHYA_NASIKA_LE:'Select'; ?></option>    
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="Deformed">Deformed</option>
                                <option value="Boil seen">Boil seen</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BAHYA_NASIKA_LE:''; ?>" name="BAHYA_NASIKA_LE" id="BAHYA_NASIKA_LE" placeholder="BAHYA_NASIKA_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">नासागुहा (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="NASAGUHA_LE" class="form-control" id="NASAGUHA_LE">
                                <option value="<?php echo ($result1)?$result1->NASAGUHA_LE:''; ?>"><?php echo ($result1)?$result1->NASAGUHA_LE:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Hypertrophy of inferior turbininate">Hypertrophy of inferior turbininate</option>
                                <option value="Deviation seen">Deviation seen</option>
                                <option value="polyp seen">polyp seen</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->NASAGUHA_LE:''; ?>" name="NASAGUHA_LE" id="NASAGUHA_LE" placeholder="NASAGUHA_LE">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">शैलश्रीक कला  (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            
                            <select name="SHAILSHRIK_KALA_LE" class="form-control" id="SHAILSHRIK_KALA_LE">
                                <option value="<?php echo ($result1)?$result1->SHAILSHRIK_KALA_LE:''; ?>"><?php echo ($result1)?$result1->SHAILSHRIK_KALA_LE:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Mucous membrane congestion">Mucous membrane congestion</option>
                                <option value="Boil seen">Boil seen</option>
                             </select>

                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->SHAILSHRIK_KALA_LE:''; ?>" name="SHAILSHRIK_KALA_LE" id="SHAILSHRIK_KALA_LE" placeholder="SHAILSHRIK_KALA_LE">-->
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">दंत 
                            </label>
                            <div class="col-xs-9">
                                
                                 <select name="DANT" class="form-control" id="DANT">
                                <option value="<?php echo ($result1)?$result1->DANT:''; ?>"><?php echo ($result1)?$result1->DANT:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                             </select>
                                
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->DANT:''; ?>" name="DANT" id="DANT" placeholder="DANT">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">तालु  
                            </label>
                            <div class="col-xs-9"> 
                        
                                 <select name="TALU" class="form-control" id="TALU">
                                <option value="<?php echo ($result1)?$result1->TALU:''; ?>"><?php echo ($result1)?$result1->TALU:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Multiple Ulcers">Multiple Ulcers</option>
                             </select>
                                
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->TALU:''; ?>" name="TALU" id="TALU" placeholder="TALU">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">गल शुंडीका  
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="GAL_SHUNDIKA" class="form-control" id="GAL_SHUNDIKA">
                                <option value="<?php echo ($result1)?$result1->GAL_SHUNDIKA:''; ?>"><?php echo ($result1)?$result1->GAL_SHUNDIKA:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                             </select>

                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->GAL_SHUNDIKA:''; ?>" name="GAL_SHUNDIKA" id="GAL_SHUNDIKA" placeholder="GAL_SHUNDIKA">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">आकृती 
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="AKRUTI" class="form-control" id="AKRUTI">
                                <option value="<?php echo ($result1)?$result1->AKRUTI:''; ?>"><?php echo ($result1)?$result1->AKRUTI:'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                             </select>
                                
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->AKRUTI:''; ?>" name="AKRUTI" id="AKRUTI" placeholder="AKRUTI">-->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">अन्य 
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="OTHER_CKECKUP" class="form-control" id="OTHER_CKECKUP">
                                <option value="<?php echo ($result1)?$result1->OTHER_CKECKUP:''; ?>"><?php echo ($result1)?$result1->OTHER_CKECKUP:'Select'; ?></option>
                                <option value="अविशेष">अविशेष</option>
                             </select>
                            
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->OTHER_CKECKUP:''; ?>" name="OTHER_CKECKUP" id="OTHER_CKECKUP" placeholder="OTHER_CKECKUP">-->
                            </div>
                        </div>
                        
                        <?php if($patient->ipd_opd == 'ipd'){ ?>
                        <div class="form-group row">
                            <label for="blood_group" class="col-xs-3 col-form-label">POST OPERATIVE NOTES
                            </label>
                            <div class="col-xs-9"> 
                                <input type="text" class="form-control" name="POST_OPERATIVE_NOTES" id="POST_OPERATIVE_NOTES" placeholder="POST_OPERATIVE_NOTES">
                            </div>
                        </div>
                        
                        
                        <?php } } ?>
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