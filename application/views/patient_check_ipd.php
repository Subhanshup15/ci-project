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

                <div class='form-group col-sm-12'>
                    <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="ipd_no" class="col-xs-3 col-form-label">IPD No.<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php echo $patient->ipd_no; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="ipd_no" class="col-xs-3 col-form-label">OPD No.<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="opd_no" class="form-control" type="text" placeholder="" id="opd_no"  value="<?php echo $patient->yearly_reg_no; ?>" readonly>
                        </div>
                    </div>
                </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="<?php echo $patient->firstname; echo " ".$patient->lastname; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date_of_birth') ?> <i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="date_of_birth" class="form-control" type="text" placeholder="" id="date_of_birth"  value="<?php echo $patient->date_of_birth ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="date_of_birth" class="col-xs-3 col-form-label">Gender<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="gender" class="form-control" type="text" placeholder="" id="gender"  value="<?php echo $patient->sex ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="date_of_birth" class="col-xs-3 col-form-label">Contact No.<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="contact" class="form-control" type="text" placeholder="" id="contact"  value="<?php echo $patient->mobile ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="create_date" class="col-xs-3 col-form-label">Admit Date<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="create_date" class="form-control" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="<?php echo $patient->create_date ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="create_date" class="col-xs-3 col-form-label">Discharge Date<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="discharge_date" class="form-control" type="text" placeholder="<?php echo display('discharge_date') ?>" id="discharge_date"  value="<?php echo $patient->discharge_date ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                         <label for="department_id" class="col-xs-3 col-form-label"><?php echo display('department_name') ?> <i class="text-danger">*</i></label>
                           <div class="col-xs-9">
                            <?php $result = $this->db->select("*")
                                  ->from('department')
                                  ->where('status',1)
                                  ->where('dprt_id',$patient->department_id)
                                  ->get()
                                  ->row(); ?>
                            <input name="department_id" class="form-control" type="hidden" placeholder="" id="department_id"  value="<?php echo $patient->department_id; ?>" readonly>
                            <input name="department_id1" class="form-control" type="text" placeholder="" id="department_id1"  value="<?php echo $result->name; ?>" readonly>
                         </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="dignosis" class="col-xs-3 col-form-label"><?php echo display('dignosis') ?> <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <?php if($patient->department_id== 30)
                    { ?>
                           <select name="dignosis" class="form-control" id="dignosis">
                                <option value="<?php  if($patient->dignosis){echo $patient->dignosis;}else {echo '';} ?>"><?php  if($patient->dignosis){echo $patient->dignosis;}else {echo '';} ?></option>
                                
                                
                                
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
                            
                         <input name="dignosis" class="form-control" type="text" placeholder="" id="dignosis" value="<?php  if($patient->dignosis){echo $patient->dignosis;}else {echo '';} ?>">

                     <?php } ?>
                            </div>
                        </div>
                    </div>
                  
                  <div class="form-group row">
                       <?php if($patient->department_id == 30)
                    { ?>
                    <div class="col-sm-6">
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
                    <?php } else{ ?>
                    <div class="col-sm-6">
                      <?php if($patient->department_id== 32){ ?>
                       <label class="col-sm-3">Weight <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                       <input name="weight" class="form-control" type="text" placeholder="Weight" id="weight" value="<?php  if($patient->wieght){echo $patient->wieght;}else {echo '';} ?>">
                      </div>
                              <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="col-sm-6">
                            <label class="col-sm-3">Final Dignosis <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <div class="form-check">
                                    <?php if($patient->department_id== 30)
                    { ?>
                                   <select name="final_dignosis" class="form-control" id="final_dignosis">
                                			<option value="">select</option>
                                            <option value="RE Cataract">RE Cataract</option>
                                            <option value="LE Cataract">LE Cataract</option>
                                            <option value="RE Pterygium">RE Pterygium</option>
                                            <option value="LE Pterygium">LE Pterygium</option>
                                            <option value="shushkakshipaka (dry eye syndrome)">shushkakshipaka (dry eye syndrome)</option>
                                            <option value="Episcleritis">Episcleritis</option>
                                            <option value="bacterial conjunctivitis">bacterial conjunctivitis.</option>
                                            <option value="stye">stye</option>
                                            <option value="chalazion">chalazion</option>
                                            <option value="LE Acute Dacryocystitis">LE Acute Dacryocystitis</option>
                                            <option value="LE Posterior polar cataract">LE Posterior polar cataract </option>
                                            <option value="RE Posterior polar cataract">RE Posterior polar cataract </option>
                                            <option value="Anterior Uveitis">Anterior Uveitis</option>
                                            <option value="Subconjunctival haemorrhage ">Subconjunctival haemorrhage </option>
                                            <option value="Dacryosystitis">Dacryosystitis</option>
                                            <option value="Iritis">Iritis</option>
                                            <option value="Allergic conjunctivitis">Allergic conjunctivitis</option>
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
                            </select>
                                  <?php } else { ?>
                                        <input type="text" name="final_dignosis" class="form-control"  id="final_dignosis" value="" placeholder="Final Dignosis">
                               <?php } ?>
                              </div>
                            </div>
                         </div>
                        </div>
                  
               
                    
                    <div class="form-group row"> 
                        <div class="col-sm-3">
                            <label for="treatment" class="col-xs-4 col-form-label">IPD Round Date<i class="text-danger"></i></label>
                            <div class="col-xs-8">
                                <input name="roundDate" class="datepicker form-control" data-date-format="dd-mm-yyyy" type="text" placeholder="IPD Round Date" id="roundDate" required>
                                <!--<input name="roundDate" class="form-control" type="date" placeholder="" id="roundDate">-->
                            </div>
                        </div>
                      <div class="col-sm-3">
                            <label for="treatment" class="col-xs-4 col-form-label">IPD Round Time<i class="text-danger"></i></label>
                            <div class="col-xs-8">
                                <input name="round_time" class="form-control"  type="time" placeholder="IPD Round Time" id="round_time" required>
                                <!--<input name="roundDate" class="form-control" type="date" placeholder="" id="roundDate">-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="treatment" class="col-xs-4 col-form-label">IPD Round<i class="text-danger"></i></label>
                            <div class="col-xs-8">
                                <select name="round" id="round" class="form-control" required>
    								<option value="">Select Round</option>
                                    <option value="1">Round 1 Morning</option>
                                    <option value="2">Round 2 Evening</option>
    					    	 </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="treatment" class="col-xs-4 col-form-label">IPD Day<i class="text-danger"></i></label>
                            <div class="col-xs-8">
    					    	 <input name="ipd_days" class="form-control" type="text" placeholder="IPD Days" id="ipd_days" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">C/O<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <?php if($patient->department_id== 30)
                    { ?>
                           <select name="c_o" class="form-control" id="c_o">
                           <option value="<?php echo ($patient)?$patient->c_o:''; ?>"><?php echo ($patient)?$patient->c_o:'Select'; ?></option>

                         
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
                        
                                <input name="c_o" type="text" class="form-control" id="c_o" placeholder="" value="<?php echo $patient->c_o;?>" >
                              
                              <?php } ?>
                            </div>
                        </div>
                      <?php if($patient->department_id == 30)
                        { ?>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">PAST HISTORY
                            </label>
                            <div class="col-xs-9"> 
                            

                                <select name="PAST_HISTORY" class="form-control" id="PAST_HISTORY">
                                  <option value=''>Select</option>
                                <option value="N/H/O- DM/HTN/BA Or any major illness ">N/H/O- DM/HTN/BA Or any major illness </option>
                                <option value="K/C/O- HTN">K/C/O- HTN</option>
                                <option value="K/C/O- DM">K/C/O- DM</option>
                                <option value="K/C/O- HTN & DM">K/C/O- HTN & DM</option>
                            </select>


                                <!--<input type="text" class="form-control" name="PAST_HISTORY" id="PAST_HISTORY" placeholder="PAST_HISTORY" value="<?php echo ($result1)?$result1->PAST_HISTORY:NULL; ?>">-->
                            </div>
                             </div>
                        </div>
                      <?php } ?>
                      <?php if($patient->department_id != 30)
                        { ?>
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">H/o<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="h_o" type="text" class="form-control" id="h_o" placeholder="" value="<?php echo $patient->h_o;?>" >
                            </div>
                        </div>
                    </div>
                 
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">KCO<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="kco" type="text" class="form-control" id="kco" placeholder="" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">E/o<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="e_o" type="text" class="form-control" id="e_o" placeholder="">
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">Family History <i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="f_h" type="text" class="form-control" id="f_h" placeholder="" value="<?php echo $patient->f_h;?>" >
                            </div>
                        </div>
                      <?php if($patient->department_id !='30') 
{ ?>
                        <div class="col-sm-6">
                            <label for="create_date" class="col-xs-3 col-form-label">Procedural Concent<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <select name="pconcent" id="pconcent" class="form-control">
                                    <!--<option value="">Select SHIRODHARA_SHIROBASTI</option>-->
                                    <?php foreach($treatment_list_pconcent as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                      <?php } ?>
                    </div>
                  <div class="form-group row"> 
                        <div class="col-sm-6">
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
                               <!-- <select name="bp" id="bp" class="form-control">
                                    <!--<option value="">Select option</option>
                                    <?php foreach($bp as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->bp==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>-->
                                <input type="text" name="bp" id="bp" placeholder="BP" class="form-control">
                            </div>
                        </div>
                       <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">तापमान :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="tapman" type="text" class="form-control" id="tapman" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        
                      
                      
                      
                       <div class="col-sm-6">
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
                                <!--<select name="pulse" id="pulse" class="form-control">
                                    <!--<option value="">Select option</option>
                                    <?php foreach($pulse as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->pulse==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>-->
                                 <input type="text" name="pulse" id="pulse" placeholder="Pulse" class="form-control">
                            </div>
                        </div>
                      <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">CNS :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                               <?php if($patient->department_id == '30') { ?>
                              <select name="cvs" class="form-control" id="cvs">
                                <option value=''>Select</option>
                                <option value='Conscious and Oriented'>Conscious and Oriented</option>
                                <option value='Non- Conscious and Oriented'>Non- Conscious and Oriented</option>
                              </select>
                              <?php } else 
								{ ?>
                                <input name="cns" type="text" class="form-control" id="cns" placeholder="" value="<?php echo '';?>" >
                              <?php } ?>
                              
                                <!--<input name="cns" type="text" class="form-control" id="cns" placeholder="CNS" value="<?php echo '';?>" >
                            --></div>
                        </div>
                        
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">RS :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="RS" type="text" class="form-control" id="RS" placeholder="" value="" >
                            </div>
                        </div>
                      
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">CVS :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                              <?php if($patient->department_id == '30') { ?>
                              <select name="cvs" class="form-control" id="cvs">
                                <option value=''></option>
                                <option value='S1S2 Normal'>S1S2 Normal</option>
                              </select>
                              <?php } else 
								{ ?>
                                <input name="cvs" type="text" class="form-control" id="cvs" placeholder="" value="<?php echo '';?>" >
                              <?php } ?>
                            </div>
                        </div>
                        
                    </div>
                  <?php if($patient->department_id != 30)
                        { ?>
                    <div class="form-group row"> 
                      
                      <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">PR :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="pr" type="text" class="form-control" id="pr" placeholder="" value="<?php echo '';?>" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">PA :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="pa" type="text" class="form-control" id="pa" placeholder="" value="<?php echo '';?>" >
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-top:10px;">
                            <label for="firstname" class="col-xs-3 col-form-label">pv :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="pv" type="text" class="form-control" id="pv" placeholder="" value="<?php echo '';?>" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      
                      
                       <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">RA :<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="ra" type="text" class="form-control" id="ra" placeholder="" value="<?php echo '';?>" >
                            </div>
                        </div>
                      
                      
                    
                         <div class="col-sm-6">
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
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($nadi as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->nadi==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                       
                    </div>
                  <?php } ?>
                    
                  <?php if($patient->department_id != 30)
                        { ?>
                  
                    <div class="form-group row">
                      
                      
                      <div class="col-sm-6">
                            <label for="firstname" class="col-xs-3 col-form-label">SPO2<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <input name="SPO2" type="text" class="form-control" id="SPO2" placeholder="">
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
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
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($udarn as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->udar==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
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
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($givwa as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->givwa==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($shudha as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->shudha==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
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
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($ahar as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->ahar==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">मल     </label>
                            <div class="col-xs-9"> 
                                <?php
                                    $mal = array(
                                        ''   => display('select_option'),
                                        'साम  ' => 'साम  ',
                                        'निराम   ' => 'निराम   ',
                                        'कठीण  ' => 'कठीण  ',
                                        'दुर्गंधीयुक्त ' => 'दुर्गंधीयुक्त ',
                                        'अविशेष ' => 'अविशेष' ,
                                        'Other ' => 'Other'
                                    );
                                    //echo form_dropdown('mal', $mal,'', 'class="form-control" id="mal" '); 
                                ?>
                                <select name="mal" id="mal" class="form-control">
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($mal as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->mal==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
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
                                    <!--<option value="">Select option</option>-->
                                    <?php foreach($mutra as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" <?php if($patient->mutra==$x){ echo "selected";} ?>  ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                      <?php } ?>
                       <?php if($patient->department_id != 30)
                        { ?>
                        <div class="col-sm-6">
                            <label for="treatment" class="col-xs-3 col-form-label">Only 1st Dose<i class="text-danger"></i></label>
                            <div class="col-xs-9">
                                <select name="Only_1st_Dose" id="Only_1st_Dose" class="form-control">
                                    <!--<option value="">Select RX1</option>-->
                                    <?php foreach($treatment_list_Only_1st_Dose as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>"><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                  
                  <?php if($patient->department_id == 29) {?>
                  
                  <div class="form-group row"> 
                    <div class="col-sm-6">
                      <label for="blood_group" class="col-xs-3 col-form-label">LMP</label>
                     <div class="col-xs-9"> 
                       <input name="LMP" type="text" class="form-control datepicker" id="LMP" placeholder="LMP" value="">
                     </div>
                    </div> 
                    <div class="col-sm-6">
                        <label for="blood_group" class="col-xs-3 col-form-label">NO. OF DAYS</label>
                     <div class="col-xs-9"> 
                       <input name="NO_OF_DAYS" type="text" class="form-control" id="NO_OF_DAYS" placeholder="NO. OF DAYS" value="">
                     </div>
                    </div> 
                  </div> 
                  
                  
                   <div class="form-group row"> 
                    <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">PATTERN</label>
                     <div class="col-xs-9"> 
                       <select name="PATTERN" class="form-control" id="PATTERN">
                         <option value="regular">regular</option>
                          <option value="irregular">irregular</option>
                       </select>
                     </div>
                    </div> 
                    <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">FLOW</label>
                     <div class="col-xs-9"> 
                       
                       <select name="FLOW" class="form-control" id="FLOW">
                         <option value="scanty">scanty</option>
                          <option value="moderate">moderate</option>
                         <option value="heavy">heavy</option>
                       </select>
                     </div>
                    </div> 
                  </div> 
                  
                  
                   <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="blood_group" class="col-xs-3 col-form-label">Obstetric History</label>
                     <div class="col-xs-9"> 
                       <textarea name="Obstetric_History" type="text" class="form-control" id="Obstetric_History" placeholder="Obstetric History" value=""></textarea>
                     </div>
                    </div> 
                    <div class="col-sm-6">
                      <label for="blood_group" class="col-xs-3 col-form-label">Marital Status</label>
                     <div class="col-xs-9"> 
                       <select name="Marita_Status" class="form-control" id="Marita_Status">
                         <option value="Married">Married</option>
                          <option value="Unmarried">Unmarried</option>
                       </select>
                     </div>
                    </div> 
                  </div> 
                  
                  
                   <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="blood_group" class="col-xs-3 col-form-label">Marital Years</label>
                     <div class="col-xs-9"> 
                       <input name="Marital_years" type="text" class="form-control" id="Marital_years" placeholder="Marital Years" value="">
                     </div>
                    </div> 
                    <div class="col-sm-6">
                    </div> 
                  </div> 
                  

                  <?php } ?>
                    
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="Quantity" class="col-xs-3 col-form-label">Pre. Operative Medication 1st<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                
                               <textarea id="pr_Op_Medication" name="Pr_Op_Medication" rows="10" cols="41"></textarea>
                                
                                <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <!--<select name="Pr_Op_Medication" id="Pr_Op_Medication" class="form-control">-->
                                    <!--<option value="">Select RX3</option>-->
                                <!--    <?php foreach($treatment_list_Pr_Op_Medication as $x => $x_val ){ ?>-->
                                <!--        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>-->
                                <!--    <?php }?>-->
                                <!--</select>-->
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="treatment" class="col-xs-3 col-form-label">Pre. Operative Medication 2nd<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                
                                 <textarea id="pr_Op_Medication2nd" name="Pr_Op_Medication2nd" rows="10" cols="41"></textarea>
                                
                                <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <!--<select name="Pr_Op_Medication2nd" id="Pr_Op_Medication2nd" class="form-control">-->
                                    <!--<option value="">Select RX4</option>-->
                                <!--    <?php foreach($treatment_list_Pr_Op_Medication2nd as $x => $x_val ){ ?>-->
                                <!--        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>-->
                                <!--    <?php }?>-->
                                <!--</select>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="Quantity" class="col-xs-3 col-form-label">Post Operative Medication<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                
                                <textarea id="post_Operative" name="Post_Operative" rows="10" cols="41"></textarea>
                                
                                <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <!--<select name="Post_Operative" id="Post_Operative" class="form-control">-->
                                    <!--<option value="">Select RX3</option>-->
                                <!--    <?php foreach($treatment_list_Post_Operative as $x => $x_val ){ ?>-->
                                <!--        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>-->
                                <!--    <?php }?>-->
                                <!--</select>-->
                            </div>
                        </div>
                     
                        <div class="col-sm-6">
                            <label for="Quantity" class="col-xs-3 col-form-label">ICU Order<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <textarea id="icu_Order" name="ICU_Order" rows="10" cols="41"></textarea>
                                <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <!--<select name="ICU_Order" id="ICU_Order" class="form-control">-->
                                    <!--<option value="">Select RX3</option>-->
                                <!--    <?php foreach($treatment_list_ICU_Order as $x => $x_val ){ ?>-->
                                <!--        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>-->
                                <!--    <?php }?>-->
                                <!--</select>-->
                            </div>
                        </div>
                    </div>
                     <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="Quantity" class="col-xs-3 col-form-label">Input<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <select name="Input" id="Input" class="form-control">
                                    <!--<option value="">Select RX3</option>-->
                                    <?php foreach($treatment_list_Input as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="treatment" class="col-xs-3 col-form-label">Output<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <select name="Output" id="Output" class="form-control">
                                    <!--<option value="">Select RX4</option>-->
                                    <?php foreach($treatment_list_Output as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row"> 
                        <div class="col-sm-6">
                            <label for="Quantity" class="col-xs-3 col-form-label">Sp. Investi. Pandamic<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?php echo form_dropdown('treatment_id',$treatment_list_rx2,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <select name="Sp_Investigations_pandamic" id="Sp_Investigations_pandamic" class="form-control">
                                    <!--<option value="">Select RX3</option>-->
                                    <?php foreach($treatment_list_Sp_Investigations_pandamic as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="treatment" class="col-xs-3 col-form-label">Only 2nd Day Morning Covid<i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                                <select name="Only_2nd_Day_Morning_covid" id="Only_2nd_Day_Morning_covid" class="form-control">
                                    <!--<option value="">Select RX4</option>-->
                                    <?php foreach($treatment_list_Only_2nd_Day_Morning_covid as $x => $x_val ){ ?>
                                        <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                  <?php } ?>
                    <hr>
                <h3>Other Details :-</h3>
                <hr>
                <?php if($patient->department_id == 30)
                        { ?>
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">शस्त्रकर्म इतिहास<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="surgical_history" id="surgical_history" placeholder="शस्त्रकर्म  इतिहास" class="form-control">
                        </div>
                    </div>
                  <?php } ?>
                
                <?php if($patient->department_id != 30)
                        { ?>
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">पूर्व इतिहास / शस्त्रकर्म इतिहास<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="surgical_history" id="surgical_history" placeholder="पूर्व इतिहास / शस्त्रकर्म  इतिहास" class="form-control">
                        </div>
                    </div>
                  <?php } ?>
                  <?php if($patient->department_id != 30)
                        { ?>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label">निद्रा<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="nidra1" id="nidra1" placeholder="निद्रा" class="form-control">
                        </div>
                    </div>
                </div>
                 
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">व्यसन<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="vyasan" id="vyasan" placeholder="व्यसन" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label">(Urine ) संबंधित लक्षण<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="urine" id="urine" placeholder="(Urine ) संबंधित लक्षण" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
            <?php if($patient->department_id == 29)
                        { ?>
                  <div class="col-sm-6">
                                            <label for="Quantity" class="col-xs-3 col-form-label">पुरीष प्रवृत्ती<i class="text-danger">*</i></label>

                  <div class="col-xs-9"> 
                        <?php
                           $nidra = array(
                           
                               ''   => display('select_option'),
                           
                               'अविशेष   ' => 'अविशेष   ',
                           
                               'प्रभुत    ' => 'प्रभुत    ',
                           
                               'अल्प  ' => 'अल्प  ',
                             
                             'Samyak' => 'Samyak',
                               
							   'Other ' => 'Other'
                           );
                           
                           //echo form_dropdown('nidra', $nidra, '', 'class="form-control" id="nidra" '); 
                           
                           ?>
                           
                           <select name="purish_pravrutti" id="purish_pravrutti" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($nidra as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>"><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                  </div>
                  <?php } else {?>
                  
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">पुरीष प्रवृत्ती<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="purish_pravrutti" id="purish_pravrutti" placeholder="पुरीष प्रवृत्ती" class="form-control">
                        </div>
                    </div>
                  
                  <?php } ?>
                    
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label">(Stool) संबंधित लक्षण	<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="stool" id="stool" placeholder="(Stool ) संबंधित लक्षण" class="form-control">
                        </div>
                    </div>
                    
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">अपानवायू<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="apanvayu" id="apanvayu" placeholder="अपानवायू" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label">कोष्ठ	<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="koshth" id="koshth" placeholder="कोष्ठ" class="form-control">
                        </div>
                    </div>
                </div>
               <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">प्रकृती<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="prakruti" id="prakruti" placeholder="प्रकृती" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label">शरीरप्रमाण	<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="shariripraman" id="shariripraman" placeholder="शरीरप्रमाण" class="form-control">
                        </div>
                    </div>
                </div>
                 <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">आहारशक्ती<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="aharshakti" id="aharshakti" placeholder="आहारशक्ती" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label"> व्यायाम शक्ती	<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="vyayam_shakti" id="vyayam_shakti" placeholder=" व्यायाम शक्ती" class="form-control">
                        </div>
                    </div>
                </div>
                  <?php } ?>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">संप्राप्ती घटक<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="samprapti_ghatak" id="samprapti_ghatak" placeholder="संप्राप्ती घटक" class="form-control">
                        </div>
                    </div>
                  <?php if($patient->department_id != 30)
                        { ?>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label"> विशेष स्त्रोतस परीक्षा	<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="vishesh_shtrots_pariksha" id="vishesh_shtrots_pariksha" placeholder=" विशेष स्त्रोतस परीक्षा" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">नैदानिक परीक्षा<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="naidanik_pariksha" id="naidanik_pariksha" placeholder="नैदानिक परीक्षा" class="form-control">
                        </div>
                    </div>
                  <?php } ?>
                    <div class="col-sm-6">
                        <label for="treatment" class="col-xs-3 col-form-label">व्यवछेदक निदाना	<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="vyavched_nidan" id="vyavched_nidan" placeholder="व्यवछेदक निदाना" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">व्याधी  विनीश्चय<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                          <?php if($patient->department_id == 30){ ?>
                          <select name="vyadhi_vinishray" class="form-control" id="vyadhi_vinishray">
                                			<option value="">select</option>
                                            <option value="RE Cataract">RE Cataract</option>
                                            <option value="LE Cataract">LE Cataract</option>
                                            <option value="RE Pterygium">RE Pterygium</option>
                                            <option value="LE Pterygium">LE Pterygium</option>
                                            <option value="shushkakshipaka (dry eye syndrome)">shushkakshipaka (dry eye syndrome)</option>
                                            <option value="Episcleritis">Episcleritis</option>
                                            <option value="bacterial conjunctivitis">bacterial conjunctivitis.</option>
                                            <option value="stye">stye</option>
                                            <option value="chalazion">chalazion</option>
                                            <option value="LE Acute Dacryocystitis">LE Acute Dacryocystitis</option>
                                            <option value="LE Posterior polar cataract">LE Posterior polar cataract </option>
                                            <option value="RE Posterior polar cataract">RE Posterior polar cataract </option>
                                            <option value="Anterior Uveitis">Anterior Uveitis</option>
                                            <option value="Subconjunctival haemorrhage ">Subconjunctival haemorrhage </option>
                                            <option value="Dacryosystitis">Dacryosystitis</option>
                                            <option value="Iritis">Iritis</option>
                                            <option value="Allergic conjunctivitis">Allergic conjunctivitis</option>
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
                            </select>
                          <?php } else {?>
                            <input type="text" name="vyadhi_vinishray" id="vyadhi_vinishray" placeholder="व्याधी विनीश्चय" class="form-control">
                      <?php } ?>
                      </div>
                    </div>
                </div>
                
                <?php if($patient->department_id != 30)
                        { ?>
                <div class="form-group row"> 
                 <?php if($patient->department_id == 29)
                        { ?>
  
                  <div class="col-sm-6">
                    
                        <label for="Quantity" class="col-xs-3 col-form-label">अष्टविध परीक्षा मूत्र
                          <i class="text-danger">*</i></label>
                     <div class="col-xs-9"> 
                        <?php
                           $mutra = array(
                           
                               ''   => display('select_option'),
                           
                               'पीत   ' => 'पीत ',
                           
							   'आविल    ' => 'आविल' , 
							   'दुर्गंधीयुक्त  ' => 'दुर्गंधीयुक्त ',
							  
							  
                             'Samyak'=>'Samyak',
							  
							  'Other ' => 'Other'
                           );
                           
                          //echo form_dropdown('mutra', $mutra, '', 'class="form-control" id="mutra" '); 
                           
                           ?>
                            <select name="ashthvidh_psriksha_mutra" id="ashthvidh_psriksha_mutra" class="form-control">
								  <option value="">Select option</option>
					   	    <?php foreach($mutra as $x => $x_val ){ ?>
								  <option value="<?php echo $x; ?>"><?php echo $x_val; ?></option>
						    <?php }?>
						   </select>
                     </div>
                    
                    
                  </div>
                  <?php } else {?>
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">अष्टविध परीक्षा मूत्र
                        <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input type="text" name="ashthvidh_psriksha_mutra" id="ashthvidh_psriksha_mutra" placeholder="अष्टविध परीक्षा मूत्र
                            "
                            class="form-control">
                        </div>
                    </div>
                  <?php } ?>
                </div>
                  <?php } ?>
                  
                   <?php if($patient->department_id == 30)
                        { ?>
                  <div class="form-group row">
                     <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नेत्र (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            
                            <select name="BAHYA_NETRA_RE" class="form-control" id="BAHYA_NETRA_RE">
                              <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Periorbital Oedema">Periorbital Oedema</option>
                                <option value="Periorbital Heamatoma">Periorbital Heamatoma</option>
                            </select>
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BAHYA_NETRA_RE:''; ?>" name="BAHYA_NETRA_RE" id="BAHYA_NETRA_RE" placeholder="BAHYA_NETRA_RE">-->
                            </div>
                        </div>
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नेत्र (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                            
                            <select name="BAHYA_NETRA_LE" class="form-control" id="BAHYA_NETRA_LE">
                              <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Periorbital Oedema">Periorbital Oedema</option>
                                <option value="Periorbital Heamatoma">Periorbital Heamatoma</option>
                            </select>
                                <!--<input type="text" class="form-control" value="<?php echo ($result1)?$result1->BAHYA_NETRA_RE:''; ?>" name="BAHYA_NETRA_RE" id="BAHYA_NETRA_RE" placeholder="BAHYA_NETRA_RE">-->
                            </div>
                        </div>
                      </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">वर्त्म मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            
                             <select name="VARTMA_MANDAL_RE" class="form-control" id="VARTMA_MANDAL_RE">
                               <option value="">Select</option>
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
                          
                          
                           <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">वर्त्म मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            
                             <select name="VARTMA_MANDAL_LE" class="form-control" id="VARTMA_MANDAL_LE">
                               <option value="">Select</option>
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
                           </div>
                        
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">शुक्ल मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            


                                <select name="SHUKL_MANDAL_RE" class="form-control" id="SHUKL_MANDAL_RE">
                                  <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)<option>
                                <option value="Redness">Redness</option>
                                <option value="Subconjunctival haemorrhage">Subconjunctival haemorrhage</option>
                                <option value="Fleshy growth seen near inner canthus">Fleshy growth seen near inner canthus</option>
                            </select>
                            

                                <!--<input type="text" value="<?php echo ($patient)?$patient->SHUKL_MANDAL_RE:''; ?>" class="form-control" name="SHUKL_MANDAL_RE" id="SHUKL_MANDAL_RE" placeholder="SHUKL_MANDAL_RE">-->
                            </div>
                        </div> 
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">शुक्ल मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                            


                                <select name="SHUKL_MANDAL_LE" class="form-control" id="SHUKL_MANDAL_LE">
                                  <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)<option>
                                  
                                <option value="Redness">Redness</option>
                                <option value="Subconjunctival haemorrhage">Subconjunctival haemorrhage</option>
                                <option value="Fleshy growth seen near inner canthus">Fleshy growth seen near inner canthus</option>
                            </select>
                            

                                <!--<input type="text" value="<?php echo ($patient)?$patient->SHUKL_MANDAL_RE:''; ?>" class="form-control" name="SHUKL_MANDAL_RE" id="SHUKL_MANDAL_RE" placeholder="SHUKL_MANDAL_RE">-->
                            </div>
                        </div> 
                  </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">कृष्ण मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            <select name="KRUSHNA_MANDAL_RE" class="form-control" id="KRUSHNA_MANDAL_RE">
                              <option value="">Select</option>
                                <option value="प्राकृत(clear)">प्राकृत(clear)</option>
                                <option value="Cornal Opacity">Cornal Opacity</option>
                                <option value="Cornea Hazy">Cornea Hazy</option>
                                <option value="Corneal Oedema with corneal ulcer">Corneal Oedema with Corneal ulcer</option>
                                <option value="Corneal ulcer">Corneal ulcer</option>
                                <option value="Mutton Fat KP">Mutton Fat KP</option>
                                <option value="Foreign Body seen on cornea">Foreign Body seen on cornea</option>
                                
                            </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->KRUSHNA_MANDAL_RE:''; ?>" class="form-control" name="KRUSHNA_MANDAL_RE" id="KRUSHNA_MANDAL_RE" placeholder="KRUSHNA_MANDAL_RE">-->
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">कृष्ण मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            <select name="KRUSHNA_MANDAL_LE" class="form-control" id="KRUSHNA_MANDAL_LE">
                              <option value="">Select</option>
                                <option value="प्राकृत(clear)">प्राकृत(clear)</option>
                                <option value="Cornal Opacity">Cornal Opacity</option>
                                <option value="Cornea Hazy">Cornea Hazy</option>
                                <option value="Corneal Oedema with corneal ulcer">Corneal Oedema with Corneal ulcer</option>
                                <option value="Corneal ulcer">Corneal ulcer</option>
                                <option value="Mutton Fat KP">Mutton Fat KP</option>
                                <option value="Foreign Body seen on cornea">Foreign Body seen on cornea</option>
                                
                            </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->KRUSHNA_MANDAL_RE:''; ?>" class="form-control" name="KRUSHNA_MANDAL_RE" id="KRUSHNA_MANDAL_RE" placeholder="KRUSHNA_MANDAL_RE">-->
                            </div>
                        </div>
                  </div>
                        
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">तारका मंडळ  (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                         

                                <select name="TARKA_MANDAL_RE" class="form-control" id="TARKA_MANDAL_RE">
                                  <option value="">Select</option>
                                <option value="प्राकृत( Color pattern normal)">प्राकृत( Color pattern normal)</option>
                                <option value="Muddy Iris">Muddy Iris</option>
                                <option value="Iris Bombe">Iris Bombe</option>
                                <option value="Muddy iris with Koeppe's Nodules">Muddy iris with Koeppe's Nodules</option>
                                <option value="Muddy iris with Busacca'a Nodules">Muddy iris with Busacca'a Nodules</option>
                                <option value="Anterior Synechiae">Anterior Synechiae</option>
                                <option value="Posterior Synechiae">Posterior Synechiae</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->TARKA_MANDAL_RE:''; ?>" class="form-control" name="TARKA_MANDAL_RE" id="TARKA_MANDAL_RE" placeholder="TARKA_MANDAL_RE">-->
                            </div>
                        </div> 
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">तारका मंडळ  (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                         

                                <select name="TARKA_MANDAL_LE" class="form-control" id="TARKA_MANDAL_LE">
                                  <option value="">Select</option>
                                <option value="प्राकृत( Color pattern normal)">प्राकृत( Color pattern normal)</option>
                                <option value="Muddy Iris">Muddy Iris</option>
                                <option value="Iris Bombe">Iris Bombe</option>
                                <option value="Muddy iris with Koeppe's Nodules">Muddy iris with Koeppe's Nodules</option>
                                <option value="Muddy iris with Busacca'a Nodules">Muddy iris with Busacca'a Nodules</option>
                                <option value="Anterior Synechiae">Anterior Synechiae</option>
                                <option value="Posterior Synechiae">Posterior Synechiae</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->TARKA_MANDAL_RE:''; ?>" class="form-control" name="TARKA_MANDAL_RE" id="TARKA_MANDAL_RE" placeholder="TARKA_MANDAL_RE">-->
                            </div>
                        </div> 
                  </div>
                        
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">दृष्टी मंडळ (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            <select name="DRUSHTI_MANDAL_RE" class="form-control" id="DRUSHTI_MANDAL_RE">
                              <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Irregular Pupil Shape">Irregular Pupil Shape</option>
                                <option value="Narrow pupil">Narrow pupil</option>
                                
                            </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->DRUSHTI_MANDAL_RE:''; ?>" class="form-control" name="DRUSHTI_MANDAL_RE" id="DRUSHTI_MANDAL_RE" placeholder="DRUSHTI_MANDAL_RE">-->
                            </div>
                        </div>
                          
                           <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">दृष्टी मंडळ (LE)
                            </label>
                            <div class="col-xs-9"> 
                            

                            <select name="DRUSHTI_MANDAL_LE" class="form-control" id="DRUSHTI_MANDAL_LE">
                              <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Irregular Pupil Shape">Irregular Pupil Shape</option>
                                <option value="Narrow pupil">Narrow pupil</option>
                                
                            </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->DRUSHTI_MANDAL_RE:''; ?>" class="form-control" name="DRUSHTI_MANDAL_RE" id="DRUSHTI_MANDAL_RE" placeholder="DRUSHTI_MANDAL_RE">-->
                            </div>
                        </div>
                  </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">पूर्व वेश्म (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                             <select name="PURV_VESHMA_RE" class="form-control" id="PURV_VESHMA_RE">
                               <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Well Formed">Well Formed</option>
                                <option value="Shallow AC">Shallow AC</option>
                                <option value="Deep AC">Deep AC</option>
                                <option value="Hypopyon">Hypopyon</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->PURV_VESHMA_RE:''; ?>" class="form-control" name="PURV_VESHMA_RE" id="PURV_VESHMA_RE" placeholder="PURV_VESHMA_RE">-->
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">पूर्व वेश्म (LE)
                            </label>
                            <div class="col-xs-9"> 
                            

                             <select name="PURV_VESHMA_LE" class="form-control" id="PURV_VESHMA_LE">
                               <option value="">Select</option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                               
                                <option value="Well Formed">Well Formed</option>
                                <option value="Shallow AC">Shallow AC</option>
                                <option value="Deep AC">Deep AC</option>
                                <option value="Hypopyon">Hypopyon</option>
                                
                            </select>
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->PURV_VESHMA_RE:''; ?>" class="form-control" name="PURV_VESHMA_RE" id="PURV_VESHMA_RE" placeholder="PURV_VESHMA_RE">-->
                            </div>
                        </div>
                  </div>
                        
                        
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">अभिंग 	(RE)
                            </label>
                            <div class="col-xs-9"> 

                             <select name="ABHING_RE" class="form-control" id="ABHING_RE">
                               <option value="">Select</option>
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
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->ABHING_RE:''; ?>" class="form-control" name="ABHING_RE" id="ABHING_RE" placeholder="ABHING_RE">-->
                            </div>
                        </div>
                          
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">अभिंग 	(LE)
                            </label>
                            <div class="col-xs-9"> 

                             <select name="ABHING_LE" class="form-control" id="ABHING_LE">
                               <option value="">Select</option>
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
                            
                            
                                <!--<input type="text" value="<?php echo ($patient)?$patient->ABHING_RE:''; ?>" class="form-control" name="ABHING_RE" id="ABHING_RE" placeholder="ABHING_RE">-->
                            </div>
                        </div>
                  </div>
                        
                        <div class="form-group row">
                              <div class="col-sm-6">
                                <label for="blood_group" class="col-xs-3 col-form-label">सभिंग 	(LE)
                                </label>
                                <div class="col-xs-9"> 
                                  <select name="SABHING_LE" class="form-control" id="SABHING_LE">
                               <option value="">Select</option>
                                    <option value="V/A- 6/6">V/A- 6/6</option>
                                    <option value="V/A- 6/9">V/A- 6/9</option>
                                    <option value="V/A- 6/12">V/A- 6/12</option>
                                    <option value="V/A- 6/18">V/A- 6/18</option>
                                    <option value="V/A- 6/24">V/A- 6/24</option>
                                    <option value="V/A- 6/36">V/A- 6/36</option>
                                    <option value="V/A- 6/60">V/A- 6/60</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <label for="blood_group" class="col-xs-3 col-form-label">सभिंग 	(RE)
                                </label>
                                <div class="col-xs-9"> 
                                  <select name="SABHING_RE" class="form-control" id="SABHING_RE">
                                  <option value="">Select</option>
                                    <option value="V/A- 6/6">V/A- 6/6</option>
                                    <option value="V/A- 6/9">V/A- 6/9</option>
                                    <option value="V/A- 6/12">V/A- 6/12</option>
                                    <option value="V/A- 6/18">V/A- 6/18</option>
                                    <option value="V/A- 6/24">V/A- 6/24</option>
                                    <option value="V/A- 6/36">V/A- 6/36</option>
                                    <option value="V/A- 6/60">V/A- 6/60</option>
                                  </select>
                                </div>
                              </div>
                     </div>
                   <div class="form-group row">
                     <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">PUPIL RE
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="PUPIL_RE" class="form-control" id="PUPIL_RE">
                      
                                <option value="<?php echo ''; ?>"><?php echo 'Select'; ?></option>
                                <option value="Round">Round</option>
                                <option value="Regular">Regular</option>
                                <option value="Reacting to light">Reacting to light</option>
                                <option value="RAPD">RAPD</option>
                                <option value="NSRL">NSRL</option>
                                <option value="Pinpoint Pupil">Pinpoint Pupil</option>
                            </select>
							</div>
                     		</div>
                     <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">PUPIL LE
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="PUPIL_LE" class="form-control" id="PUPIL_LE">
                        
                                <option value="<?php echo ''; ?>"><?php echo 'Select'; ?></option>
                                <option value="Round">Round</option>
                                <option value="Regular">Regular</option>
                                <option value="Reacting to light">Reacting to light</option>
                                <option value="RAPD">RAPD</option>
                                <option value="NSRL">NSRL</option>
                                <option value="Pinpoint Pupil">Pinpoint Pupil</option>
                            </select>
							</div>
                     		</div>
                        </div>
                  <div class="form-group row">
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">LENS RE
                            </label>
                            <div class="col-xs-9"> 
                            

                                <select name="LENS_RE" class="form-control" id="LENS_RE">
                               
                                <option value=""><?php echo 'Select'; ?></option>
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
								</div>
                            </div>
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">LENS LE
                            </label>
                            <div class="col-xs-9"> 
                            

                                <select name="LENS_LE" class="form-control" id="LENS_LE">
                                  
                                   <option value=""><?php echo 'Select'; ?></option>
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
								</div>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">OD RE
                            </label>
                            <div class="col-xs-9"> 
                           

                                <select name="OD_RE" class="form-control" id="OD_RE">
                                   <option value=""><?php echo 'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Hyperaemic">Hyperaemic</option>
                                <option value="paler disc">paler disc</option>
                                <option value="chalky white">chalky white</option>
                                <option value="haemorrhages seen on disc">haemorrhages seen on disc</option>
                                <option value="Neovascularization on disc">Neovascularization on disc</option>
                                <option value="papilloedema">papilloedema</option>
                                <option value="papillitis">papillitis</option>
                                
                            </select>
                            </div>
                            </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">OD LE
                            </label>
                            <div class="col-xs-9"> 
                                <select name="OD_LE" class="form-control" id="OD_LE">
                                   <option value=""><?php echo 'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Hyperaemic">Hyperaemic</option>
                                <option value="paler disc">paler disc</option>
                                <option value="chalky white">chalky white</option>
                                <option value="haemorrhages seen on disc">haemorrhages seen on disc</option>
                                <option value="Neovascularization on disc">Neovascularization on disc</option>
                                <option value="papilloedema">papilloedema</option>
                                <option value="papillitis">papillitis</option>
                            </select>
                            </div>
                            </div>
                        </div>
                  
                  
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">CDR RE
                            </label>
                            <div class="col-xs-9"> 

                          
                            
                              <select name="CDR_RE" class="form-control" id="CDR_RE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value=" 0.3:1"> 0.3:1</option>
                                <option value=" 0.5.1"> 0.5:1</option>
                                <option value=" 0.7:1"> 0.7:1</option>
                                <option value=" 0.4:1"> 0.4:1</option>
                                <option value=" 0.8:1"> 0.8:1</option>
                             </select>
                                <!--<input type="text" value="<?php echo ($result1)?$result1->CDR_RE:''; ?>" class="form-control" name="CDR_RE" id="CDR_RE" placeholder="CDR_RE">-->
                            
                            </div>
                        </div>
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">CDR LE
                            </label>
                            <div class="col-xs-9"> 

                          
                            
                              <select name="CDR_LE" class="form-control" id="CDR_LE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value=" 0.3:1"> 0.3:1</option>
                                <option value=" 0.5.1"> 0.5:1</option>
                                <option value=" 0.7:1"> 0.7:1</option>
                                <option value=" 0.4:1"> 0.4:1</option>
                                <option value=" 0.8:1"> 0.8:1</option>
                             </select>
                                <!--<input type="text" value="<?php echo ($result1)?$result1->CDR_RE:''; ?>" class="form-control" name="CDR_RE" id="CDR_RE" placeholder="CDR_RE">-->
                            
                            </div>
                        </div>
                   </div>
                  
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">MACULA RE
                            </label>
                            <div class="col-xs-9"> 
                            
                            

                                <select name="MACULA_RE" class="form-control" id="MACULA_RE">
<option value=""><?php echo 'Select'; ?></option>
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
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">MACULA LE
                            </label>
                            <div class="col-xs-9"> 
                            
                            

                                <select name="MACULA_LE" class="form-control" id="MACULA_LE">
<option value=""><?php echo 'Select'; ?></option>
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
                   </div>
                  
                  
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">BLOOD VESSELS RE
                            </label>
                            <div class="col-xs-9"> 
                            
                       
                            
                                <select name="BLOOD_VESSELS_RE" class="form-control" id="BLOOD_VESSELS_RE">
<option value=""><?php echo 'Select'; ?></option>
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
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">BLOOD VESSELS LE
                            </label>
                            <div class="col-xs-9"> 
                            
                       
                            
                                <select name="BLOOD_VESSELS_LE" class="form-control" id="BLOOD_VESSELS_LE">
<option value=""><?php echo 'Select'; ?></option>
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
                  </div>
                  
                  
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">PERIPHERAL RETINA RE
                            </label>
                            <div class="col-xs-9"> 
                            
                            

                                <select name="PERIPHERAL_RETINA_RE" class="form-control" id="PERIPHERAL_RETINA_RE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Tesselated fundus">Tesselated fundus</option>
                                <option value="Haemmorhages with hard exudate">Haemmorhages with hard exudate</option>
                                <option value="hard exudate">hard exudate</option>
                                <option value="horse shoe retinal detachment">horse shoe retinal detachment</option>
                              
                             </select>
                            


                                <!--<input type="text" value="<?php echo ($result1)?$result1->PERIPHERAL_RETINA_RE:''; ?>" class="form-control" name="PERIPHERAL_RETINA_RE" id="PERIPHERAL_RETINA_RE" placeholder="PERIPHERAL_RETINA_RE">-->
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">PERIPHERAL RETINA LE
                            </label>
                            <div class="col-xs-9"> 
                            
                            

                                <select name="PERIPHERAL_RETINA_LE" class="form-control" id="PERIPHERAL_RETINA_LE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="WNL">WNL</option>
                                <option value="Tesselated fundus">Tesselated fundus</option>
                                <option value="Haemmorhages with hard exudate">Haemmorhages with hard exudate</option>
                                <option value="hard exudate">hard exudate</option>
                                <option value="horse shoe retinal detachment">horse shoe retinal detachment</option>
                              
                             </select>
                            


                                <!--<input type="text" value="<?php echo ($result1)?$result1->PERIPHERAL_RETINA_RE:''; ?>" class="form-control" name="PERIPHERAL_RETINA_RE" id="PERIPHERAL_RETINA_RE" placeholder="PERIPHERAL_RETINA_RE">-->
                            </div>
                        </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य कर्ण (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                           
                            
                             <select name="BAHYA_KARN_RE" class="form-control" id="BAHYA_KARN_RE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Congestion">Congestion</option>
                              
                             </select>
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->BAHYA_KARN_RE:''; ?>" class="form-control" name="BAHYA_KARN_RE" id="BAHYA_KARN_RE" placeholder="BAHYA_KARN_RE">-->
                            </div>
                        </div>
                     <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य कर्ण (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                           
                            
                             <select name="BAHYA_KARN_LE" class="form-control" id="BAHYA_KARN_LE">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत(WNL)">प्राकृत(WNL)</option>
                                <option value="Congestion">Congestion</option>
                              
                             </select>
                            

                                <!--<input type="text" value="<?php echo ($result1)?$result1->BAHYA_KARN_RE:''; ?>" class="form-control" name="BAHYA_KARN_RE" id="BAHYA_KARN_RE" placeholder="BAHYA_KARN_RE">-->
                            </div>
                        </div>
                    </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">कर्ण कुहर (RE)
                            </label>
                            <div class="col-xs-9"> 
                           

                             <select name="KARN_KUHAR_RE" class="form-control" id="KARN_KUHAR_RE">
								<option value=""><?php echo 'Select'; ?></option>
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
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">कर्ण कुहर (LE)
                            </label>
                            <div class="col-xs-9"> 
                           

                             <select name="KARN_KUHAR_LE" class="form-control" id="KARN_KUHAR_LE">
<option value=""><?php echo 'Select'; ?></option>
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
                          </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">मध्य कर्ण (RE)
                            </label>
                            <div class="col-xs-9"> 
                            

                             <select name="MADHYA_KARNA_RE" class="form-control" id="MADHYA_KARNA_RE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत(Intact)">प्राकृत(Intact)</option>
                                <option value="TM Perforated">TM Perforated</option>
                                <option value="TM Congestion">TM Congestion</option>
                                <option value="TM Degeneration">TM Degeneration</option>
                              
                             </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->MADHYA_KARNA_RE:''; ?>" class="form-control" name="MADHYA_KARNA_RE" id="MADHYA_KARNA_RE" placeholder="MADHYA_KARNA_RE">-->
                            </div>
                        </div>
                           <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">मध्य कर्ण (LE)
                            </label>
                            <div class="col-xs-9"> 
                            

                             <select name="MADHYA_KARNA_LE" class="form-control" id="MADHYA_KARNA_LE">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत(Intact)">प्राकृत(Intact)</option>
                                <option value="TM Perforated">TM Perforated</option>
                                <option value="TM Congestion">TM Congestion</option>
                                <option value="TM Degeneration">TM Degeneration</option>
                              
                             </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->MADHYA_KARNA_RE:''; ?>" class="form-control" name="MADHYA_KARNA_RE" id="MADHYA_KARNA_RE" placeholder="MADHYA_KARNA_RE">-->
                            </div>
                        </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नासिका (RE)
                            </label>
                            <div class="col-xs-9">

                             
                                <select name="BAHYA_NASIKA_RE" class="form-control" id="BAHYA_NASIKA_RE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="Deformed">Deformed</option>
                                <option value="Boil seen">Boil seen</option>
                              
                             </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->BAHYA_NASIKA_RE:''; ?>" class="form-control" name="BAHYA_NASIKA_RE" id="BAHYA_NASIKA_RE" placeholder="BAHYA_NASIKA_RE">-->
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">बाह्य नासिका (LE)
                            </label>
                            <div class="col-xs-9">

                             
                                <select name="BAHYA_NASIKA_LE" class="form-control" id="BAHYA_NASIKA_LE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="Deformed">Deformed</option>
                                <option value="Boil seen">Boil seen</option>
                              
                             </select>
                            
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->BAHYA_NASIKA_RE:''; ?>" class="form-control" name="BAHYA_NASIKA_RE" id="BAHYA_NASIKA_RE" placeholder="BAHYA_NASIKA_RE">-->
                            </div>
                        </div>
                          </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">नासागुहा (RE)
                            </label>
                            <div class="col-xs-9"> 
                

                             <select name="NASAGUHA_RE" class="form-control" id="NASAGUHA_RE">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Hypertrophy of inferior turbininate">Hypertrophy of inferior turbininate</option>
                                <option value="Deviation seen">Deviation seen</option>
                                <option value="polyp seen">polyp seen</option>
                              
                             </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->NASAGUHA_RE:''; ?>" class="form-control" name="NASAGUHA_RE" id="NASAGUHA_RE" placeholder="NASAGUHA_RE">-->
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">नासागुहा (LE)
                            </label>
                            <div class="col-xs-9"> 
                

                             <select name="NASAGUHA_LE" class="form-control" id="NASAGUHA_LE">
<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Hypertrophy of inferior turbininate">Hypertrophy of inferior turbininate</option>
                                <option value="Deviation seen">Deviation seen</option>
                                <option value="polyp seen">polyp seen</option>
                              
                             </select>
                            
                            
                            
                                <!--<input type="text" value="<?php echo ($result1)?$result1->NASAGUHA_RE:''; ?>" class="form-control" name="NASAGUHA_RE" id="NASAGUHA_RE" placeholder="NASAGUHA_RE">-->
                            </div>
                        </div>
                          </div>
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">शैलश्रीक कला  (RE)
                            </label>
                            <div class="col-xs-9"> 
                            
                      
                                <select name="SHAILSHRIK_KALA_RE" class="form-control" id="SHAILSHRIK_KALA_RE">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Mucous membrane congestion">Mucous membrane congestion</option>
                                <option value="Boil seen">Boil seen</option>
                             </select>
                            </div>
                        </div>
                           <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">शैलश्रीक कला  (LE)
                            </label>
                            <div class="col-xs-9"> 
                            
                      
                                <select name="SHAILSHRIK_KALA_LE" class="form-control" id="SHAILSHRIK_KALA_LE">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Mucous membrane congestion">Mucous membrane congestion</option>
                                <option value="Boil seen">Boil seen</option>
                             </select>
                            </div>
                        </div>
                          </div>
                  
                  
                        <div class="form-group row">
                           <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">ओष्ठ 
                            </label>
                            <div class="col-xs-9"> 
                                <select name="OSHTH" class="form-control" id="OSHTH">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="cleft lip">cleft lip</option>
                                <option value="cheilitis">cheilitis</option>
                              <option value="Mucocele">Mucocele</option>
                             </select>
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">जिव्हा 
                            </label>
                            <div class="col-xs-9">
                            
            
                                <select name="JIVHA" class="form-control" id="JIVHA">
								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="Multiple ulcers">Multiple ulcer</option>
                             </select>
                            </div>
                          </div>
                  </div>
                  
                  
                   		<div class="form-group row">
                            <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">गिलायू 
                            </label>
                            <div class="col-xs-9">
                                <select name="GILAYU" class="form-control" id="GILAYU">
                                  <option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="congestion with inflammed tonsilis">congestion with inflammed tonsilis</option>
                             </select>
                            </div>
                              </div>
                          
                          <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">कंठ 
                            </label>
                            <div class="col-xs-9"> 
                                <select name="KANTH" class="form-control" id="KANTH">
                                <option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                                <option value="Difficulty in swallowing">Difficulty in swallowing</option>
                             </select>
                            </div>
                              </div>
                        </div>
                  
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">कपालस्ठी 
                            </label>
                            <div class="col-xs-9"> 
                              <select name="KAPALASTHI" class="form-control" id="KAPALASTHI">
 								<option value=""><?php echo 'Select'; ?></option>
                                <option value="प्राकृत">प्राकृत</option>
                             </select>
                            </div>
                       </div>
                    <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">शस्त्रक्रम  
                            </label>
                            <div class="col-xs-9"> 
                            <select name="SHASRAKARM" class="form-control" id="SHASRAKARM">
								<option value=""><?php echo 'Select'; ?></option>
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
                        </div>
                  
                   <div class="form-group row">
                       <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">दंत 
                            </label>
                            <div class="col-xs-9">
                                
                                 <select name="DANT" class="form-control" id="DANT">
									<option value=""><?php echo 'Select'; ?></option>
                                   <option value="प्राकृत">प्राकृत</option>
                             </select>
                            </div>
                         </div>
                           <div class="col-sm-6">
                             <label for="blood_group" class="col-xs-3 col-form-label">तालु  
                            </label>
                            <div class="col-xs-9"> 
                        
                                 <select name="TALU" class="form-control" id="TALU">
<option value=""><?php echo 'Select'; ?></option>
                                   <option value="प्राकृत">प्राकृत</option>
                                <option value="Multiple Ulcers">Multiple Ulcers</option>
                             </select>
                            </div>
                             </div>
                        </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">गल शुंडीका  
                            </label>
                            <div class="col-xs-9"> 
                            
                            <select name="GAL_SHUNDIKA" class="form-control" id="GAL_SHUNDIKA">
								<option value=""><?php echo 'Select'; ?></option> 
                              	<option value="प्राकृत">प्राकृत</option>
                                <option value="congestion">congestion</option>
                             </select>
                            </div>
                      </div>
                      <div class="col-sm-6">
                        <label for="blood_group" class="col-xs-3 col-form-label">आकृती 
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="AKRUTI" class="form-control" id="AKRUTI">
								<option value=""><?php echo 'Select'; ?></option>
                               	<option value="प्राकृत">प्राकृत</option>
                             </select>
                            </div>
                        </div>
                        </div>
                   <div class="form-group row">
                     <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">अन्य 
                            </label>
                            <div class="col-xs-9"> 
                            
                             <select name="OTHER_CKECKUP" class="form-control" id="OTHER_CKECKUP">
								<option value=""><?php echo 'Select'; ?></option>
                               	<option value="अविशेष">अविशेष</option>
                             </select>
                            </div>
                        </div>
                      <div class="col-sm-6">
                            <label for="blood_group" class="col-xs-3 col-form-label">K1
                            </label>
                            <div class="col-xs-9"> 
                            
                             <!--<select name="OTHER_CKECKUP" class="form-control" id="OTHER_CKECKUP">
								<option value=""><?php echo 'Select'; ?></option>
                               	<option value="अविशेष">अविशेष</option>
                             </select>-->
                              <input type="text" name="k_one" id="k_one" class="form-control" placeholder="k1" value="">
                            </div>
                        </div>
                     </div>
                   <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">K2
                            </label>
                            <div class="col-xs-9"> 
                            
                             <!--<select name="OTHER_CKECKUP" class="form-control" id="OTHER_CKECKUP">
								<option value=""><?php echo 'Select'; ?></option>
                               	<option value="अविशेष">अविशेष</option>
                             </select>-->
                              <input type="text" name="k_two" id="k_two" class="form-control" placeholder="k2" value="">
                            </div>
                        </div>
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">Axil Length
                            </label>
                            <div class="col-xs-9"> 
                            
                             <!--<select name="OTHER_CKECKUP" class="form-control" id="OTHER_CKECKUP">
								<option value=""><?php echo 'Select'; ?></option>
                               	<option value="अविशेष">अविशेष</option>
                             </select>-->
                              <input type="text" name="axil_length" id="axil_length" class="form-control" placeholder="Axil Length" value="">
                            </div>
                        </div>
                     </div>
                  <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">PCIOL
                            </label>
                            <div class="col-xs-9">
                             
                              <input type="text" name="pciol" id="pciol" class="form-control" placeholder="PCIOL" value="">
                            </div>
                        </div>
                     </div>
                  
                  <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">Sac Syringing(RE)
                            </label>
                            <div class="col-xs-9">
                               <select name="sac_syringing_re" class="form-control" id="sac_syringing_re">
                                <option value=""><?php echo 'Select'; ?></option>
                                <option value="Patent">Patent</option>
                                <option value="Total Block">Total Block</option>
                                <option value="Partial Block">Partial Block</option>
                            </select>
                             <!-- <input type="text" name="sac_syringing_re" id="sac_syringing_re" class="form-control" placeholder="Sac Syringing RE" value="">
                           --> </div>
                        </div>
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">Sac Syringing(LE)
                            </label>
                            <div class="col-xs-9"> 
                               <select name="sac_syringing_le" class="form-control" id="sac_syringing_le">
                                <option value=""><?php echo 'Select'; ?></option>
                                <option value="Patent">Patent</option>
                                <option value="Total Block">Total Block</option>
                                <option value="Partial Block">Partial Block</option>
                            </select>
                             <!-- <input type="text" name="sac_syringing_le" id="sac_syringing_le" class="form-control" placeholder="Sac Syringing LE" value="">
                            --></div>
                        </div>
                     </div>
                  
                  
                  <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">IOP(RE)
                            </label>
                            <div class="col-xs-9"> 
                              <select name="iop_re_ipd" class="form-control" id="iop_re_ipd">
                                <option value="">Select</option>
                                <option value="10.2mmhg">10.2mmhg</option>
                                <option value="11.02mmhg">11.2mmhg</option>
                                <option value="14.06mmhg">14.6mmhg</option>
                                <option value="17.3mmhg">17.3mmhg</option>
                                <option value="20.6mmhg">20.6mmhg</option>
                                <option value="24.4mmhg">24.4mmhg</option>
                                <option value="26.6mmhg">26.6mmhg</option>
                                <option value="29mmhg">29mmhg</option>
                                <option value="34.5mmhg">34.5mmhg</option>
                            </select>
                           
                            </div>
                        </div>
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">IOP(LE)
                            </label>
                            <div class="col-xs-9"> 
                              <select name="iop_le_ipd" class="form-control" id="iop_le_ipd">
                                <option value="">Select</option>
                                <option value="10.2mmhg">10.2mmhg</option>
                                <option value="11.02mmhg">11.2mmhg</option>
                                <option value="14.06mmhg">14.6mmhg</option>
                                <option value="17.3mmhg">17.3mmhg</option>
                                <option value="20.6mmhg">20.6mmhg</option>
                                <option value="24.4mmhg">24.4mmhg</option>
                                <option value="26.6mmhg">26.6mmhg</option>
                                <option value="29mmhg">29mmhg</option>
                                <option value="34.5mmhg">34.5mmhg</option>
                            </select>
                            </div>
                        </div>
                     </div>
                  
                  <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">स्थानिक
                         
                            </label>
                            <div class="col-xs-9"> 
                              <input type="text" name="stanik" id="stanik" class="form-control" placeholder="स्थानिक" value="">
                            </div>
                        </div>
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">सार्वदैविक
                            </label>
                            <div class="col-xs-9"> 
                              <input type="text" name="sarvdaivik" id="sarvdaivik" class="form-control" placeholder="सार्वदैविक" value="">
                            </div>
                        </div>
                     </div>
                  
                  
                   <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">पूर्वकर्म (Pre-Operative)
                         
                            </label>
                            <div class="col-xs-9"> 
                              
                              <select name="purvkarm" class="form-control" id="purvkarm">
                                <option value="">Select</option>
                                <option 
                                        value="Trimming of lashes of RE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .
Tab. Diamox 250 mg given">
                                  Trimming of lashes of RE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .
Tab. Diamox 250 mg given
</option>
                                <option value="Trimming of lashes of LE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .
Tab. Diamox 250 mg given">Trimming of lashes of LE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .
Tab. Diamox 250 mg given</option>
                                <option value="Trimming of lashes of RE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .
">
                                  Trimming of lashes of RE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .
</option>
                                <option value="    Trimming of lashes of LE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .">    Trimming of lashes of LE .
Xylocaine sensitivity done .                                     
Inj TT 0.5cc given .</option>
                                
                                <option value="Xylocaine sensitivity done,                                     
Inj TT 0.5cc given
">Xylocaine sensitivity done,                                     
Inj TT 0.5cc given"
</option>
                            </select>
                              
                              
                             <!-- <input type="text" name="purvkarm" id="purvkarm" class="form-control" placeholder="पूर्वकर्म (Pre-Operative)" value="">-->
                            </div>
                        </div>
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">पश्चातकर्म (Post-Operative)
                            </label>
                            <div class="col-xs-9"> 
                              
                              
                               <select name="paschat_karm" class="form-control" id="paschat_karm">
                                <option value="">Select</option>
                                 
                                <option value="RE Lid - Normal
Conjunctiva- SCH
Cornea – Clear
AC - well formed
Iris - CPN normal
PCIOL - In situ
Wound – Healthy
V/A -6/18(P)
">
                                  RE Lid- Normal
Conjunctiva- SCH
Cornea – Clear
AC - well formed
Iris - CPN normal
PCIOL - In situ
Wound – Healthy
V/A -6/18(P)


								</option>
                                <option value="LE Lid- Normal
Conjunctiva- SCH
Cornea – Clear
AC - well formed
Iris - CPN normal
PCIOL - In situ
Wound – Healthy
V/A -6/18(P)
">LE Lid- Normal
Conjunctiva- SCH
Cornea – Clear
AC - well formed
Iris - CPN normal
PCIOL - In situ
Wound – Healthy
V/A -6/18(P)
</option>
                                 <option value="Examination- Lid- Normal,Wound-Healthy.
">Examination- Lid- Normal,Wound-Healthy.
</option>            
                            </select>
                             <!-- <input type="text" name="paschat_karm" id="paschat_karm" class="form-control" placeholder="पश्चातकर्म (Post-Operative) -" value="">
                          -->  </div>
                        </div>
                     </div>
                  
                  
                   <div class="form-group row">
                     <div class="col-sm-6">
                       <label for="blood_group" class="col-xs-3 col-form-label">प्रधानकर्म(Oprative-Notes)
                            </label>
                            <div class="col-xs-9"> 
                              <!--<input type="text" name="pradhankarm" id="pradhankarm" class="form-control" placeholder=" प्रधानकर्म" value="">-->
                            <select name="pradhankarm" id="pradhankarm" class="form-control">
                              <option value="">Select</option>
                              <option value="Rt eye painting done with betadine. 
                                             Rt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                             ANAWIN 3cc with inj Hylase. Rt eye speculum applied. Rt eye
                                             peritomy done with corneal scissor.Rt eye incision taken with 
                                             cressent.Rt eye scelerocorneal tunnel formed with cressent.
                                             Rt eye sideport entry done.anterior capsule stained visco inserted,
                                             CCC done with Cystitome.Anterior chamber entry done with 
                                             keratome.Hydrodissection done with hydrodissection canuula.
                                             Visco inserted and nucleus prolapsed in AC.Nucleus delivery 
                                             done with wire vectis.Cortex aspiration done with J cannula.
                                             Visco inserted in bag.IOL implanted in bag.Visco wash given.
                                             stromal hydration done.Inj Genta with Dexa given.Speculum removed.
                                             Eye pad given.
">Rt eye painting done with betadine. 
                                             Rt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                             ANAWIN 3cc with inj Hylase. Rt eye speculum applied. Rt eye
                                             peritomy done with corneal scissor.Rt eye incision taken with 
                                             cressent.Rt eye scelerocorneal tunnel formed with cressent.
                                             Rt eye sideport entry done.anterior capsule stained visco inserted,
                                             CCC done with Cystitome.Anterior chamber entry done with 
                                             keratome.Hydrodissection done with hydrodissection canuula.
                                             Visco inserted and nucleus prolapsed in AC.Nucleus delivery 
                                             done with wire vectis.Cortex aspiration done with J cannula.
                                             Visco inserted in bag.IOL implanted in bag.Visco wash given.
                                             stromal hydration done.Inj Genta with Dexa given.Speculum removed.
                                             Eye pad given.</option>
                              <option value="Lt eye painting done with betadine. 
                                             Lt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                             ANAWIN 3cc with inj Hylase. Lt eye speculum applied. Lt eye
                                             peritomy done with corneal scissor.Lt eye incision taken with 
                                             cressent.Lt eye scelerocorneal tunnel formed with cressent.
                                             Lt eye sideport entry done.anterior capsule stained visco inserted,
                                             CCC done with Cystitome.Anterior chamber entry done with 
                                             keratome.Hydrodissection done with hydrodissection canuula.
                                             Visco inserted and nucleus prolapsed in AC.Nucleus delivery 
                                             done with wire vectis.Cortex aspiration done with J cannula.
                                             Visco inserted in bag.IOL implanted in bag.Visco wash given.
                                             stromal hydration done.Inj Genta with Dexa given.Speculum removed.
                                             Eye pad given.">
                              				Lt eye painting done with betadine. 
                                             Lt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                             ANAWIN 3cc with inj Hylase. Lt eye speculum applied. Lt eye
                                             peritomy done with corneal scissor.Lt eye incision taken with 
                                             cressent.Lt eye scelerocorneal tunnel formed with cressent.
                                             Lt eye sideport entry done.anterior capsule stained visco inserted,
                                             CCC done with Cystitome.Anterior chamber entry done with 
                                             keratome.Hydrodissection done with hydrodissection canuula.
                                             Visco inserted and nucleus prolapsed in AC.Nucleus delivery 
                                             done with wire vectis.Cortex aspiration done with J cannula.
                                             Visco inserted in bag.IOL implanted in bag.Visco wash given.
                                             stromal hydration done.Inj Genta with Dexa given.Speculum removed.
                                             Eye pad given.
                              </option>
                              <option value="Rt eye painting done with betadine.
                                Rt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                ANAWIN 3cc with inj Hylase. 
                                Rt eye speculum applied.
                                Head of NP is lifted and dissected off the cornea.
                                Main mass of NP is then seprated from sclera and conjunctiva with the help of corneal scissor.
                                Pterygium tissue is then excised takinf care not to damage medial rectus muscle.
                                Haemostasis is achieved.Conjuctival autograft is taken from same eye and transplant 
                                to cover the defect and suture taken.antibiotic ointment insert.Eye pad given.">Rt eye painting done with betadine.
                                Rt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                ANAWIN 3cc with inj Hylase. 
                                Rt eye speculum applied.
                                Head of NP is lifted and dissected off the cornea.
                                Main mass of NP is then seprated from sclera and conjunctiva with the help of corneal scissor.
                                Pterygium tissue is then excised takinf care not to damage medial rectus muscle.
                                Haemostasis is achieved.Conjuctival autograft is taken from same eye and transplant 
                                to cover the defect and suture taken.antibiotic ointment insert.Eye pad given.
</option>
                              <option value="Lt eye painting done with betadine.
                                Lt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                ANAWIN 3cc with inj Hylase. 
                                Lt eye speculum applied.
                                Head of NP is lifted and dissected off the cornea.
                                Main mass of NP is then seprated from sclera and conjunctiva with the help of corneal scissor.
                                Pterygium tissue is then excised takinf care not to damage medial rectus muscle.
                                Haemostasis is achieved.Conjuctival autograft is taken from same eye and transplant 
                                to cover the defect and suture taken.antibiotic ointment insert.Eye pad given.">Lt eye painting done with betadine.
                                Lt eye peribulbar anaesthesia given with xylocain 2% 5cc and inj.
                                ANAWIN 3cc with inj Hylase. 
                                Lt eye speculum applied.
                                Head of NP is lifted and dissected off the cornea.
                                Main mass of NP is then seprated from sclera and conjunctiva with the help of corneal scissor.
                                Pterygium tissue is then excised takinf care not to damage medial rectus muscle.
                                Haemostasis is achieved.Conjuctival autograft is taken from same eye and transplant 
                                to cover the defect and suture taken.antibiotic ointment insert.Eye pad given.</option>
                              
                              
                              <option value="The sac area is infiltrated with 2% xylocaine with adrenaline for local anesthesia. Medial canthal area painting done with  betadine.A curved 6mm incision is given 3mm to be nasal side of inner canthus.The incision should be 2mm above medial palpebral ligament.After splitting the orbicularis oculi muscle,Muller's sac retractor is applied preserving angilar vein. Blunt dissection is performed till the sac is visible. Sac is then seprated up to junction of naso lacrimal duct and excised there.Lacrimal fossa is cleaned and cauterized and the wound is sutured preferably with continues sub- cuticular sutures.
">The sac area is infiltrated with 2% xylocaine with adrenaline for local anesthesia. Medial canthal area painting done with  betadine.A curved 6mm incision is given 3mm to be nasal side of inner canthus.The incision should be 2mm above medial palpebral ligament.After splitting the orbicularis oculi muscle,Muller's sac retractor is applied preserving angilar vein. Blunt dissection is performed till the sac is visible. Sac is then seprated up to junction of naso lacrimal duct and excised there.Lacrimal fossa is cleaned and cauterized and the wound is sutured preferably with continues sub- cuticular sutures.
</option>
                              </select>
                       </div>
                        </div>
                <?php } ?>
                
                </div>
                
                
                
                
                
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

    $(document).ready(function(){
        $('#round').on('change', function(){
            var pid = $('input[name="patient_id"]').val();
            var roundDate = $('#roundDate').val();
            var round = $('#round').val();
            var section = $('input[name="ipd_opd"]').val();
            console.log(pid +"===="+ roundDate +"===="+ round +"===="+ section);
            $.ajax({
                url  : '<?= base_url('patients/check_patient_manual_treatment/') ?>',
                type : 'post',
                dataType : 'JSON',
                data : {
                    '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                    'patient_id' : pid,
                    'roundDate' : roundDate,
                    'round' : round,
                    'section': section
                },
                success : function(data) 
                {
                    console.log(data.LENS_RE);
                    if (data) {
                       /// console.log(data);
                        $('#ipd_days').val(data.ipd_days);
                        $('#c_o').val(data.sym_name);
                        $('#h_o').val(data.h_o);
                        $('#f_h').val(data.f_o);
                        $('#bp').val(data.bp).select2().trigger('change');
                        $('#RS').val(data.rs);
                        $('#cvs').val(data.cvs);
                        $('#nadi').val(data.nadi).select2().trigger('change');
                        $('#ra').val(data.ra);
                        $('#pulse').val(data.pulse).select2().trigger('change');
                        $('#tapman').val(data.tapman);
                        $('#netra').val(data.netra).select2().trigger('change');
                        $('#givwa').val(data.givwa).select2().trigger('change');
                        $('#shudha').val(data.shudha).select2().trigger('change');
                        $('#ahar').val(data.ahar).select2().trigger('change');
                        $('#mal').val(data.mal).select2().trigger('change');
                        $('#mutra').val(data.mutra).select2().trigger('change');
                      	$('#LENS_RE').val(data.LENS_RE).select2().trigger('change');
                        // $('#RX1').val(data.RX1).select2().trigger('change');
                        // $('#RX2').val(data.RX2).select2().trigger('change');
                        // $('#RX3').val(data.RX3).select2().trigger('change');
                        // $('#RX4').val(data.RX4).select2().trigger('change');
                        // $('#RX5').val(data.RX5).select2().trigger('change');
                        
                        $('#kco').val(data.kco);
                        $('#e_o').val(data.e_o);
                        $('#pconcent').val(data.pconcent).select2().trigger('change');
                        $('#SPO2').val(data.SPO2);
                        $('#pa').val(data.pa);
                        $('#pr').val(data.pr);
                        $('#pv').val(data.pv);
                        $('#Only_1st_Dose').val(data.Only_1st_Dose).select2().trigger('change');
                        $('#Pr_Op_Medication').val(data.Pr_Op_Medication).select2().trigger('change');
                        $('#Pr_Op_Medication2nd').val(data.Pr_Op_Medication2nd).select2().trigger('change');
                        $('#Post_Operative').val(data.Post_Operative).select2().trigger('change');
                        $('#ICU_Order').val(data.ICU_Order).select2().trigger('change');
                        // $('#DRX1').val(data.DRX1).select2().trigger('change');
                        // $('#DRX2').val(data.DRX2).select2().trigger('change');
                        // $('#DRX3').val(data.DRX3).select2().trigger('change');
                        $('#Input').val(data.Input).select2().trigger('change');
                        $('#Output').val(data.Output).select2().trigger('change');
                        $('#Sp_Investigations_pandamic').val(data.Sp_Investigations_pandamic).select2().trigger('change');
                        $('#Only_2nd_Day_Morning_covid').val(data.Only_2nd_Day_Morning_covid).select2().trigger('change');
                    }
                    else{
                        $('#ipd_days').val('');
                        $('#c_o').val('');
                        $('#h_o').val('');
                        $('#f_h').val('');
                        $('#bp').val('').select2().trigger('change');
                        $('#RS').val('');
                        $('#cvs').val('');
                        $('#nadi').val('').select2().trigger('change');
                        $('#ra').val('');
                        $('#pulse').val('').select2().trigger('change');
                        $('#tapman').val('');
                        $('#netra').val('').select2().trigger('change');
                        $('#givwa').val('').select2().trigger('change');
                        $('#shudha').val('').select2().trigger('change');
                        $('#ahar').val('').select2().trigger('change');
                        $('#mal').val('').select2().trigger('change');
                        $('#mutra').val('').select2().trigger('change');
                      	$('#LENS_RE').val('').select2().trigger('change');
                        // $('#RX1').val('').select2().trigger('change');
                        // $('#RX2').val('').select2().trigger('change');
                        // $('#RX3').val('').select2().trigger('change');
                        // $('#RX4').val('').select2().trigger('change');
                        // $('#RX5').val('').select2().trigger('change');
                        
                        $('#kco').val('');
                        $('#e_o').val('');
                        $('#pconcent').val('').select2().trigger('change');
                        $('#SPO2').val('');
                        $('#pa').val('');
                        $('#pr').val('');
                        $('#pv').val('');
                        $('#Only_1st_Dose').val('').select2().trigger('change');
                        $('#Pr_Op_Medication').val('').select2().trigger('change');
                        $('#Pr_Op_Medication2nd').val('').select2().trigger('change');
                        $('#Post_Operative').val('').select2().trigger('change');
                        $('#ICU_Order').val('').select2().trigger('change');
                        // $('#DRX1').val('').select2().trigger('change');
                        // $('#DRX2').val('').select2().trigger('change');
                        // $('#DRX3').val('').select2().trigger('change');
                        $('#Input').val('').select2().trigger('change');
                        $('#Output').val('').select2().trigger('change');
                        $('#Sp_Investigations_pandamic').val('').select2().trigger('change');
                        $('#Only_2nd_Day_Morning_covid').val('').select2().trigger('change');
                    }
                }, 
                error : function()
                {
                    alert('failed');
                }
            });
        });
    });


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