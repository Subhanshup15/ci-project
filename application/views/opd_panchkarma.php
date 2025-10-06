 <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
        
         <div class="panel-body panel-form">
           
            
            <div class="form-group col-sm-12">
                <div class="form-group row"> 
                    <!--<div class="col-sm-6">-->
                    <!--    <label for="ipd_no" class="col-xs-3 col-form-label">IPD No.<i class="text-danger"></i></label>-->
                    <!--    <div class="col-xs-9">-->
                    <!--        <input name="ipd_no" class="form-control" type="text" placeholder="" id="ipd_no"  value="<?php echo $patient->ipd_no; ?>" readonly>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-sm-6">
                        <label for="ipd_no" class="col-xs-3 col-form-label">OPD No.<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="opd_no" class="form-control" type="text" placeholder="" id="opd_no"  value="" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="date_of_birth" class="col-xs-3 col-form-label"><?php echo display('date') ?> <i class="text-danger"></i></label>
                        <div class="col-xs-9">
                        <input name="date" class="datepicker form-control " type="text" placeholder="" id="date_of_birth"  value="" readonly>
                        </div>
                        
                            
                    </div>
                    
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="firstname" class="col-xs-3 col-form-label">Name<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?php echo display('first_name') ?>" value="" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="date_of_birth" class="col-xs-3 col-form-label">Dignosis<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="dignosis" class="form-control" type="text" placeholder="" id="dignosis"  value="" readonly>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="date_of_birth" class="col-xs-3 col-form-label">Gender<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="gender" class="form-control" type="text" placeholder="" id="gender"  value="" readonly>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <label for="department_name" class="col-xs-3 col-form-label">Department Name<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="department_name" class="form-control" type="text" placeholder="" id="department_name"  value="" readonly>
                        </div>
                    </div>
                    
                </div>
                <!--
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">Admit Date<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="create_date" class="form-control" type="text" placeholder="<?php echo display('create_date') ?>" id="create_date"  value="" readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">Discharge Date<i class="text-danger"></i></label>
                        <div class="col-xs-9">
                            <input name="discharge_date" class="form-control" type="text" placeholder="<?php echo display('discharge_date') ?>" id="discharge_date"  value="" readonly>
                        </div>
                    </div>
                </div>
                -->
                
               
                
            <!--            <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>RX1<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX1" id="RX1" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX1_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx1" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx1" id="morning_dose_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1" <?php if($result1!='' && "1"==$result1->RX1_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX1_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX1_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX1_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX1_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX1_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX1_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX1_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX1_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX1_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX1_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX1_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX1_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX1_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX1_morning_dose){echo "Selected";}?>>500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx1" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx1" id="afternoon_dose_rx1" class="select2 form-control">
                                <option value="">Select</option>
    					     	<option value="1" <?php if($result1!='' && "1"==$result1->RX1_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX1_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX1_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX1_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX1_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX1_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX1_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX1_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX1_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX1_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX1_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX1_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX1_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX1_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX1_afternoon_dose){echo "Selected";}?>>500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx1" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx1" id="evening_dose_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1" <?php if($result1!='' && "1"==$result1->RX1_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX1_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX1_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX1_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX1_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX1_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX1_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX1_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX1_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX1_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX1_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX1_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX1_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX1_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX1_evening_dose){echo "Selected";}?>>500mg</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx1" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx1" id="dose_day_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="1" <?php if($result1!='' && '1'==$result1->RX1_dose_day){echo "Selected";}?>>1</option>
    					   	    <option value="2" <?php if($result1!='' && '2'==$result1->RX1_dose_day){echo "Selected";}?>>2</option>
    					   	    <option value="3" <?php if($result1!='' && '3'==$result1->RX1_dose_day){echo "Selected";}?>>3</option>
    					   	    <option value="4" <?php if($result1!='' && '4'==$result1->RX1_dose_day){echo "Selected";}?>>4</option>
    					   	    <option value="5" <?php if($result1!='' && '5'==$result1->RX1_dose_day){echo "Selected";}?>>5</option>
    					   	    <option value="6" <?php if($result1!='' && '6'==$result1->RX1_dose_day){echo "Selected";}?>>6</option>
    					   	    <option value="7" <?php if($result1!='' && '7'==$result1->RX1_dose_day){echo "Selected";}?>>7</option>
    					   	    <option value="8" <?php if($result1!='' && '8'==$result1->RX1_dose_day){echo "Selected";}?>>8</option>
    					   	    <option value="9" <?php if($result1!='' && '9'==$result1->RX1_dose_day){echo "Selected";}?>>9</option>
    					   	    <option value="10" <?php if($result1!='' && '10'==$result1->RX1_dose_day){echo "Selected";}?>>10</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx1" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx1" id="dose_take_with_rx1" class="select2 form-control">
    					     	<option value="">Select</option>
    					   	    <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX1_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
    					   	    <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX1_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
    					   	    <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX1_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
    						</select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i><br></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx1" id="dose_anupan_rx1" class="form-control" value="" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine For<br>RX2<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX2" id="RX2" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX2_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx2" class="col-form-label">Morning<br> Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx2" id="morning_dose_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX2_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX2_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX2_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX2_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX2_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX2_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX2_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX2_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX2_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX2_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX2_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX2_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX2_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX2_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX2_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx2" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx2" id="afternoon_dose_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX2_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX2_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX2_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX2_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX2_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX2_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX2_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX2_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX2_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX2_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX2_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX2_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX2_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX2_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX2_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx2" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx2" id="evening_dose_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX2_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX2_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX2_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX2_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX2_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX2_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX2_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX2_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX2_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX2_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX2_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX2_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX2_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX2_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX2_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx2" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx2" id="dose_day_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX2_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX2_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX2_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX2_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX2_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX2_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX2_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX2_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX2_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX2_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx2" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx2" id="dose_take_with_rx2" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX2_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX2_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX2_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx2" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx2" id="dose_anupan_rx2" class="form-control" value="" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX3<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX3" id="RX3" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx3 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX3_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx3" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx3" id="morning_dose_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX3_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX3_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX3_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX3_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX3_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX3_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX3_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX3_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX3_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX3_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX3_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX3_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX3_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX3_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX3_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx3" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx3" id="afternoon_dose_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX3_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX3_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX3_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX3_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX3_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX3_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX3_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX3_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX3_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX3_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX3_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX3_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX3_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX3_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX3_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx3" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx3" id="evening_dose_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX3_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX3_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX3_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX3_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX3_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX3_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX3_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX3_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX3_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX3_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX3_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX3_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX3_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX3_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX3_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx3" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx3" id="dose_day_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX3_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX3_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX3_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX3_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX3_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX3_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX3_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX3_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX3_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX3_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx3" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx3" id="dose_take_with_rx3" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX3_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX3_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX3_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx3" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx3" id="dose_anupan_rx3" class="form-control" value="" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX4<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX4" id="RX4" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx4 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX4_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx4" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx4" id="morning_dose_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX4_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX4_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX4_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX4_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX4_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX4_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX4_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX4_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX4_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX4_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX4_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX4_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX4_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX4_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX4_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx4" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx4" id="afternoon_dose_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX4_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX4_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX4_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX4_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX4_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX4_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX4_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX4_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX4_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX4_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX4_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX4_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX4_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX4_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX4_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx4" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx4" id="evening_dose_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX4_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX4_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX4_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX4_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX4_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX4_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX4_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX4_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX4_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX4_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX4_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX4_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX4_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX4_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX4_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx4" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx4" id="dose_day_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX4_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX4_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX4_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX4_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX4_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX4_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX4_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX4_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX4_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX4_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx4" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx4" id="dose_take_with_rx4" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX4_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX4_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX4_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx4" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx4" id="dose_anupan_rx4" class="form-control" value="" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX5<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX5" id="RX5" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx5 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX5_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx5" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx5" id="morning_dose_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX5_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX5_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX5_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX5_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX5_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX5_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX5_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX5_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX5_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX5_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX5_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX5_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX5_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX5_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX5_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx5" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx5" id="afternoon_dose_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX5_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX5_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX5_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX5_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX5_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX5_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX5_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX5_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX5_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX5_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX5_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX5_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX5_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX5_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX5_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx5" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx5" id="evening_dose_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX5_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX5_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX5_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX5_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX5_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX5_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX5_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX5_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX5_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX5_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX5_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX5_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX5_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX5_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX5_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx5" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx5" id="dose_day_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX5_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX5_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX5_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX5_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX5_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX5_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX5_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX5_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX5_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX5_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx5" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx5" id="dose_take_with_rx5" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX5_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX5_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX5_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx5" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx5" id="dose_anupan_rx5" class="form-control" value="<?php if($result1!='' && $result1->RX5_dose_anupan){echo $result1->RX5_dose_anupan;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                -->
                
                
                
                
    <!----------------------     Manual treatment add 5 more input field    ---------------------------------------------------
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX6<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX6" id="RX6" class="select2 form-control">
                                <option value="">Select</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx6" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx6" id="morning_dose_rx6" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX6_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX6_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX6_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX6_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX6_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX6_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX6_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX6_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX6_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX6_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX6_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX6_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX6_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX6_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX6_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx6" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx6" id="afternoon_dose_rx6" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX6_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX6_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX6_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX6_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX6_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX6_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX6_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX6_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX6_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX6_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX6_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX6_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX6_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX6_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX6_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx6" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx6" id="evening_dose_rx6" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX6_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX6_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX6_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX6_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX6_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX6_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX6_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX6_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX6_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX6_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX6_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX6_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX6_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX6_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX6_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx6" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx6" id="dose_day_rx6" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX6_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX6_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX6_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX6_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX6_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX6_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX6_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX6_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX6_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX6_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx6" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx6" id="dose_take_with_rx6" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX6_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX6_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX6_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx6" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx6" id="dose_anupan_rx6" class="form-control" value="<?php if($result1!='' && $result1->RX6_dose_anupan){echo $result1->RX6_dose_anupan;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX7<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX7" id="RX7" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx7 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX7_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx7" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx7" id="morning_dose_rx6" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX7_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX7_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX7_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX7_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX7_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX7_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX7_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX7_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX7_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX7_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX7_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX7_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX7_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX7_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX7_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx7" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx7" id="afternoon_dose_rx7" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX7_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX7_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX7_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX7_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX7_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX7_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX7_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX7_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX7_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX7_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX7_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX7_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX7_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX7_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX7_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx7" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx7" id="evening_dose_rx7" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX7_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX7_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX7_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX7_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX7_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX7_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX7_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX7_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX7_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX7_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX7_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX7_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX7_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX7_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX7_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx7" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx7" id="dose_day_rx7" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX7_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX7_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX7_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX7_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX7_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX7_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX7_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX7_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX7_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX7_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx7" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx7" id="dose_take_with_rx7" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX7_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX7_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX7_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx7" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx7" id="dose_anupan_rx7" class="form-control" value="<?php if($result1!='' && $result1->RX7_dose_anupan){echo $result1->RX7_dose_anupan;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX8<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX8" id="RX8" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx8 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX8_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx8" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx8" id="morning_dose_rx8" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX8_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX8_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX8_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX8_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX8_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX8_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX8_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX8_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX8_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX8_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX8_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX8_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX8_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX8_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX8_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx8" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx8" id="afternoon_dose_rx8" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX8_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX8_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX8_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX8_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX8_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX8_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX8_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX8_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX8_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX8_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX8_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX8_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX8_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX8_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX8_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx8" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx8" id="evening_dose_rx8" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX8_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX8_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX8_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX8_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX8_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX8_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX8_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX8_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX8_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX8_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX8_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX8_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX8_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX8_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX8_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx8" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx8" id="dose_day_rx8" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX8_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX8_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX8_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX8_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX8_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX8_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX8_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX8_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX8_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX8_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx8" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx8" id="dose_take_with_rx8" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX8_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX8_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX8_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx8" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx8" id="dose_anupan_rx8" class="form-control" value="<?php if($result1!='' && $result1->RX8_dose_anupan){echo $result1->RX8_dose_anupan;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX9<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX9" id="RX9" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx9 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX9_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx9" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx9" id="morning_dose_rx9" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX9_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX9_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX9_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX9_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX9_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX9_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX9_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX9_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX9_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX9_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX9_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX9_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX9_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX9_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX9_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx9" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx9" id="afternoon_dose_rx9" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX9_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX9_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX9_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX9_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX9_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX9_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX9_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX9_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX9_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX9_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX9_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX9_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX9_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX9_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX9_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx9" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx9" id="evening_dose_rx9" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX9_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX9_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX9_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX9_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX9_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX9_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX9_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX9_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX9_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX9_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX9_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX9_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX9_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX9_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX9_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx9" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx9" id="dose_day_rx9" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX9_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX9_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX9_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX9_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX9_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX9_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX9_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX9_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX9_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX9_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx9" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx9" id="dose_take_with_rx9" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX9_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX9_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX9_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx9" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx9" id="dose_anupan_rx9" class="form-control" value="<?php if($result1!='' && $result1->RX9_dose_anupan){echo $result1->RX9_dose_anupan;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Medicine Fro<br>RX10<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <select name="RX10" id="RX10" class="select2 form-control">
                                <option value="">Select</option>
                                <?php foreach($treatment_list_rx10 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x_val->name; ?>" <?php if($result1!='' && $x_val->name==$result1->RX10_medicine_name){echo "Selected";}?>><?php echo $x_val->name; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx10" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="morning_dose_rx10" id="morning_dose_rx10" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX10_morning_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX10_morning_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX10_morning_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX10_morning_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX10_morning_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX10_morning_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX10_morning_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX10_morning_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX10_morning_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX10_morning_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX10_morning_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX10_morning_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX10_morning_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX10_morning_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX10_morning_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx10" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="afternoon_dose_rx10" id="afternoon_dose_rx10" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX10_afternoon_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX10_afternoon_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX10_afternoon_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX10_afternoon_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX10_afternoon_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX10_afternoon_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX10_afternoon_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX10_afternoon_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX10_afternoon_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX10_afternoon_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX10_afternoon_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX10_afternoon_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX10_afternoon_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX10_afternoon_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX10_afternoon_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx10" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="evening_dose_rx10" id="evening_dose_rx10" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && "1"==$result1->RX10_evening_dose){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && "2"==$result1->RX10_evening_dose){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && "3"==$result1->RX10_evening_dose){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && "4"==$result1->RX10_evening_dose){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && "5"==$result1->RX10_evening_dose){echo "Selected";}?>>5</option>
                                <option value="1g" <?php if($result1!='' && "1g"==$result1->RX10_evening_dose){echo "Selected";}?>>1g</option>
                                <option value="2g" <?php if($result1!='' && "2g"==$result1->RX10_evening_dose){echo "Selected";}?>>2g</option>
                                <option value="3g" <?php if($result1!='' && "3g"==$result1->RX10_evening_dose){echo "Selected";}?>>3g</option>
                                <option value="4g" <?php if($result1!='' && "4g"==$result1->RX10_evening_dose){echo "Selected";}?>>4g</option>
                                <option value="5g" <?php if($result1!='' && "5g"==$result1->RX10_evening_dose){echo "Selected";}?>>5g</option>
                                <option value="125mg" <?php if($result1!='' && "125mg"==$result1->RX10_evening_dose){echo "Selected";}?>>125mg</option>
                                <option value="150mg" <?php if($result1!='' && "150mg"==$result1->RX10_evening_dose){echo "Selected";}?>>150mg</option>
                                <option value="200mg" <?php if($result1!='' && "200mg"==$result1->RX10_evening_dose){echo "Selected";}?>>200mg</option>
                                <option value="250mg" <?php if($result1!='' && "250mg"==$result1->RX10_evening_dose){echo "Selected";}?>>250mg</option>
                                <option value="500mg" <?php if($result1!='' && "500mg"==$result1->RX10_evening_dose){echo "Selected";}?>>500mg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx10" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_day_rx10" id="dose_day_rx10" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="1" <?php if($result1!='' && '1'==$result1->RX10_dose_day){echo "Selected";}?>>1</option>
                                <option value="2" <?php if($result1!='' && '2'==$result1->RX10_dose_day){echo "Selected";}?>>2</option>
                                <option value="3" <?php if($result1!='' && '3'==$result1->RX10_dose_day){echo "Selected";}?>>3</option>
                                <option value="4" <?php if($result1!='' && '4'==$result1->RX10_dose_day){echo "Selected";}?>>4</option>
                                <option value="5" <?php if($result1!='' && '5'==$result1->RX10_dose_day){echo "Selected";}?>>5</option>
                                <option value="6" <?php if($result1!='' && '6'==$result1->RX10_dose_day){echo "Selected";}?>>6</option>
                                <option value="7" <?php if($result1!='' && '7'==$result1->RX10_dose_day){echo "Selected";}?>>7</option>
                                <option value="8" <?php if($result1!='' && '8'==$result1->RX10_dose_day){echo "Selected";}?>>8</option>
                                <option value="9" <?php if($result1!='' && '9'==$result1->RX10_dose_day){echo "Selected";}?>>9</option>
                                <option value="10" <?php if($result1!='' && '10'==$result1->RX10_dose_day){echo "Selected";}?>>10</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx10" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <select name="dose_take_with_rx10" id="dose_take_with_rx10" class="select2 form-control">
                                <option value="">Select</option>
                                <option value="जेवणपूर्वी" <?php if($result1!='' && $result1->RX10_dose_take == 'जेवणपूर्वी'){echo "Selected";}?>>जेवणपूर्वी</option>
                                <option value="जेवणानंतर" <?php if($result1!='' && $result1->RX10_dose_take == 'जेवणानंतर'){echo "Selected";}?>>जेवणानंतर</option>
                                <option value="उपाशीपोटी" <?php if($result1!='' && $result1->RX10_dose_take == 'उपाशीपोटी'){echo "Selected";}?>>उपाशीपोटी</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx10" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" name="dose_anupan_rx10" id="dose_anupan_rx10" class="form-control" value="<?php if($result1!='' && $result1->RX10_dose_anupan){echo $result1->RX10_dose_anupan;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>-->
                
                <!--
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine<br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other" value="<?//php echo ($result1->RX_other)?$result1->RX_other:'' ?>" id="RX_other" placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx6" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                             <input type="text" class="form-control" name="morning_dose_rx_other" value="<?//php echo ($result1->morning_dose_rx_other)?$result1->morning_dose_rx_other:'' ?>" id="morning_dose_rx_other" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx6" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" value="<?//php echo ($result1->afternoon_dose_rx_other)?$result1->afternoon_dose_rx_other:'' ?>" name="afternoon_dose_rx_other" id="afternoon_dose_rx_other" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx6" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other" value="<?//php echo ($result1->evening_dose_rx_other)?$result1->evening_dose_rx_other:'' ?>" id="evening_dose_rx_other" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx6" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_day_rx_other" value="<?//php echo ($result1->dose_day_rx_other)?$result1->dose_day_rx_other:'' ?>" id="dose_day_rx_other" placeholder="Dose Days" >
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx6" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other" value="<?//php echo ($result1->dose_take_with_rx_other)?$result1->dose_take_with_rx_other:'' ?>" id="dose_take_with_rx_other" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx6" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other" value="<?//php echo ($result1->dose_anupan_rx_other)?$result1->dose_anupan_rx_other:'' ?>" id="dose_anupan_rx_other" class="form-control" value="<?php if($result1!='' && $result1->dose_anupan_rx_other){echo $result1->dose_anupan_rx_other;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group" style="padding-right:none;padding-left:none;">
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="treatment" class="col-form-label">Other Medicine <br>RX<i class="text-danger"></i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="RX_other1" id="RX_other1" value="<?//php echo ($result1->RX_other1)?$result1->RX_other1:'' ?>" placeholder="Other Medicine" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="morning_dose_rx_other1" class="col-form-label">Morning<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                             <input type="text" class="form-control" name="morning_dose_rx_other1" id="morning_dose_rx_other1" placeholder="Morning Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="afternoon_dose_rx_other1" class="col-form-label">Afternoon<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="afternoon_dose_rx_other1" id="afternoon_dose_rx_other1" placeholder="Afternoon Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="evening_dose_rx_other1" class="col-form-label">Evening<br>Dose<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="evening_dose_rx_other1" id="evening_dose_rx_other1" placeholder="Evening Dose" >
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_day_rx_other1" class="col-form-label">Dose<br>Days<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_day_rx_other1" id="dose_day_rx_other1" placeholder="Dose Days" >
                        </div>
                    </div>
                    <div class="form-group col-sm-1">
                        <div class="row">
                            <label for="dose_take_with_rx_other1" class="col-form-label">Dose<br>Take<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_take_with_rx_other1" id="dose_take_with_rx_other1" placeholder="Dose Take" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <div class="row">
                            <label for="dose_anupan_rx_other1" class="col-form-label">Medicine<br>Anupan<i class="text-danger">*</i></label>
                        </div>
                        <div class="row">
                            <input type="text" class="form-control" name="dose_anupan_rx_other1" id="dose_anupan_rx_other1" class="form-control" value="<?php if($result1!='' && $result1->dose_anupan_rx_other1){echo $result1->dose_anupan_rx_other1;}?>" placeholder="Anupan"/>
                        </div>
                    </div>
                </div>
                
               -->
                
<!--                
<div class="form-group" style="padding-right:none;padding-left:none;">
    <div class="form-group col-sm-12">
        <div class="row">
            <label for="treatment" class="col-form-label">Other Medicie & Equipment<i class="text-danger"></i></label>
        </div>
        <div class="row">
            <textarea name="other_equipment" id="other_equipment">
                <?php if($result1!='' && $result1->other_equipment){echo $result1->other_equipment;}?>
            </textarea>
        </div>
    </div>
</div>

-->


    <!----------------------     Manual treatment add 5 more input field    ----------------------------------------------------->    
                
                
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">SNEHAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="SNEHAN" id="SNEHAN" class="form-control">
                                <option value="">Select SNEHAN</option>
                                <?php foreach($treatment_list_karma as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->SNEHAN){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">SWEDAN</label>
                        <div class="col-xs-9">
                            <select name="SWEDAN" id="SWEDAN" class="form-control">
                                <option value="">Select SWEDAN</option>
                                <?php foreach($treatment_list_pk1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->SWEDAN){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">VAMAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="VAMAN" id="VAMAN" class="form-control">
                                <option value="">Select VAMAN</option>
                                <?php foreach($treatment_list_pk2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">VIRECHAN<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="VIRECHAN" id="VIRECHAN" class="form-control">
                                <option value="">Select VIRECHAN</option>
                                <?php foreach($treatment_list_swa1 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->VIRECHAN){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                
                
                
                    
                    
                
                
                
                
                <div class="form-group row"> 
                  
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">BASTI<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="BASTI" id="BASTI" class="form-control">
                                <option value="">Select BASTI</option>
                                <?php foreach($treatment_list_swa2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->BASTI){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                     <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">NASYA</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="RAKTAMOKSHAN" id="RAKTAMOKSHAN" class="form-control">
                                <option value="">Select RAKTAMOKSHAN</option>
                                <?php foreach($treatment_list_patho2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->RAKTAMOKSHAN){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                    <label for="instruction" class="col-xs-3 col-form-label">SHIROBASTI</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="SHIROBASTI" id="SHIROBASTI" class="form-control">
                                <option value="">Select RAKTAMOKSHAN</option>
                                <?php foreach($treatment_list_shirobasti as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->SHIROBASTI){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        </div>
                        
                    <div class="col-sm-6">
                        <label for="instruction" class="col-xs-3 col-form-label">RAKTAMOKSHAN</label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="RAKTAMOKSHAN" id="RAKTAMOKSHAN" class="form-control">
                                <option value="">Select RAKTAMOKSHAN</option>
                                <?php foreach($treatment_list_patho2 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->RAKTAMOKSHAN){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
              
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="create_date" class="col-xs-3 col-form-label">SHIRODHARA<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="SHIRODHARA_SHIROBASTI" id="SHIRODHARA_SHIROBASTI" class="form-control">
                                <option value="">Select SHIRODHARA_SHIROBASTI</option>
                                <?php foreach($treatment_list_patho3 as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" <?php if($result1!='' && $x==$result1->SHIRODHARA_SHIROBASTI){echo "Selected";}?>><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">OTHER<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                            <select name="OTHER" id="OTHER" class="form-control">
                                <option value="">Select OTHER</option>
                                <?php foreach($treatment_list_OTHER as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!--
                    
                    -->
                </div>
                
                
                
                
                <!--
                <div class="form-group row"> 
                    <div class="col-sm-6">
                        <label for="Quantity" class="col-xs-3 col-form-label">UTTARBASTI<i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                        <!--<?php echo form_dropdown('treatment_id',$digno_sub_list,$patient->id_digno_sub,'class="form-control" id="treatment_id" onclick="myfunction(this.value)"') ?>-->
                           <!-- <select name="UTTARBASTI" id="UTTARBASTI" class="form-control">
                                <option value="">Select SNEHAN</option>
                                <?php foreach($treatment_list_UTTARBASTI as $x => $x_val ){ ?>
                                    <option value="<?php echo $x; ?>" ></option><?php echo $x_val; ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        
                    </div>
                </div>
                -->
                
                
                
                
            </div>

<!--- ////////////////////////////////////////////////////////////////////////////////-->
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
         
    // $(document).ready(function(){
    //     $('#SNEHAN').val('').select2().trigger('change');
    //     $('#SWEDAN').val('').select2().trigger('change');
    //     $('#VAMAN').val('').select2().trigger('change');
    //     $('#VIRECHAN').val('').select2().trigger('change');
    //     $('#NASYA').val('').select2().trigger('change');
    //     $('#BASTI').val('').select2().trigger('change');
    //     $('#RAKTAMOKSHAN').val('').select2().trigger('change');
    //     $('#SHIRODHARA_SHIROBASTI').val('').select2().trigger('change');
    //     $('#OTHER').val('').select2().trigger('change');
    //     $('#HEMATOLOGICAL').val('').select2().trigger('change');
    //     $('#SEROLOGYCAL').val('').select2().trigger('change');
    //     $('#MICROBIOLOGICAL').val('').select2().trigger('change');
    //     $('#BIOCHEMICAL').val('').select2().trigger('change');
    //     $('#x_ray').val('').select2().trigger('change');
    //     $('#ECG').val('').select2().trigger('change');
    //     $('#USG').val('').select2().trigger('change');
    //     $('#swa1').val('').select2().trigger('change');
    //     $('#swa2').val('').select2().trigger('change');
        
    //     $('#SROTAS').val('').select2().trigger('change');
    //     $('#DOSHA').val('').select2().trigger('change');
    //     $('#DUSHYA').val('').select2().trigger('change');
    //     $('#SHIROBASTI').val('').select2().trigger('change');
    //     $('#skarma').val('').select2().trigger('change');
    //     $('#vkarma').val('').select2().trigger('change');
        
    //     $(document).ready(function() {
    //         var pid = $('input[name="patient_id"]').val();
    //         //var roundDate = $('#roundDate').val();
    //         //var round = $('#round').val();
    //         var section = $('input[name="ipd_opd"]').val();
    //         //console.log(pid +"===="+ roundDate +"===="+ round +"===="+ section);
    //         $.ajax({
    //             url  : '<?= base_url('patients/check_patient_manual_treatment/') ?>',
    //             type : 'post',
    //             dataType : 'JSON',
    //             data : {
    //                 '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
    //                 'patient_id' : pid,
    //                 //'roundDate' : roundDate,
    //                 //'round' : round,
    //                 'section': section
    //             },
    //             success : function(data) 
    //             {
    //                 console.log(data);
    //                 if (data) {
    //                     console.log(data);
    //                     //$('#ipd_days').val(data.ipd_days);
    //                     $('#SNEHAN').val(data.SNEHAN).select2().trigger('change');
    //                     $('#SWEDAN').val(data.SWEDAN).select2().trigger('change');
    //                     $('#VAMAN').val(data.VAMAN).select2().trigger('change');
    //                     $('#VIRECHAN').val(data.VIRECHAN).select2().trigger('change');
    //                     $('#NASYA').val(data.NASYA).select2().trigger('change');
    //                     $('#BASTI').val(data.BASTI).select2().trigger('change');
    //                     $('#RAKTAMOKSHAN').val(data.RAKTAMOKSHAN).select2().trigger('change');
    //                     $('#SHIRODHARA_SHIROBASTI').val(data.SHIRODHARA_SHIROBASTI).select2().trigger('change');
    //                     $('#OTHER').val(data.OTHER).select2().trigger('change');
    //                     $('#HEMATOLOGICAL').val(data.HEMATOLOGICAL).select2().trigger('change');
    //                     $('#SEROLOGYCAL').val(data.SEROLOGYCAL).select2().trigger('change');
    //                     $('#MICROBIOLOGICAL').val(data.BIOCHEMICAL).select2().trigger('change');
    //                     $('#BIOCHEMICAL').val(data.MICROBIOLOGICAL).select2().trigger('change');
    //                     $('#x_ray').val(data.X_RAY).select2().trigger('change');
    //                     $('#ECG').val(data.ECG).select2().trigger('change');
    //                     $('#USG').val(data.USG).select2().trigger('change');
    //                     $('#swa1').val(data.SWA1).select2().trigger('change');
    //                     $('#swa2').val(data.SWA2).select2().trigger('change');
                        
    //                     $('#SROTAS').val(data.SROTAS).select2().trigger('change');
    //                     $('#DOSHA').val(data.DOSHA).select2().trigger('change');
    //                     $('#DUSHYA').val(data.DUSHYA).select2().trigger('change');
    //                     $('#SHIROBASTI').val(data.SHIROBASTI).select2().trigger('change');
    //                     $('#skarma').val(data.skarma).select2().trigger('change');
    //                     $('#vkarma').val(data.vkarma).select2().trigger('change');
    //                 }
    //                 else{
    //                     //$('#ipd_days').val('');
    //                     $('#SNEHAN').val('').select2().trigger('change');
    //                     $('#SWEDAN').val('').select2().trigger('change');
    //                     $('#VAMAN').val('').select2().trigger('change');
    //                     $('#VIRECHAN').val('').select2().trigger('change');
    //                     $('#NASYA').val('').select2().trigger('change');
    //                     $('#BASTI').val('').select2().trigger('change');
    //                     $('#RAKTAMOKSHAN').val('').select2().trigger('change');
    //                     $('#SHIRODHARA_SHIROBASTI').val('').select2().trigger('change');
    //                     $('#OTHER').val('').select2().trigger('change');
    //                     $('#HEMATOLOGICAL').val('').select2().trigger('change');
    //                     $('#SEROLOGYCAL').val('').select2().trigger('change');
    //                     $('#MICROBIOLOGICAL').val('').select2().trigger('change');
    //                     $('#BIOCHEMICAL').val('').select2().trigger('change');
    //                     $('#x_ray').val('').select2().trigger('change');
    //                     $('#ECG').val('').select2().trigger('change');
    //                     $('#USG').val('').select2().trigger('change');
    //                     $('#swa1').val('').select2().trigger('change');
    //                     $('#swa2').val('').select2().trigger('change');
                        
    //                     $('#SROTAS').val('').select2().trigger('change');
    //                     $('#DOSHA').val('').select2().trigger('change');
    //                     $('#DUSHYA').val('').select2().trigger('change');
    //                     $('#SHIROBASTI').val('').select2().trigger('change');
    //                     $('#skarma').val('').select2().trigger('change');
    //                     $('#vkarma').val('').select2().trigger('change');
    //                 }
    //             }, 
    //             error : function()
    //             {
    //                 alert('failed');
    //             }
    //         });
    //     });
    // });

    
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
   
    $("#dignosis").change(function(){
        $.ajax({
            url  : '<?= base_url('patients/updateDiagnosis/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                id  : $('input[name="patient_id"]').val(),
                dignosis : $("#dignosis").val(),
            },
            success : function(data) 
            { 
                console.log(data);
            }, 
            error : function()
            {
                alert('failed');
            }
        });
    });
  $("#department_id").on("change",function(){
       $.ajax({
            url  : '<?= base_url('patients/updateDiagnosis/') ?>',
            type : 'post',
            dataType : 'JSON',
            data : {
                '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',
                id  : $('input[name="patient_id"]').val(),
                department_id : $("#department_id").val(),
            },
            success : function(data) 
            { 
                console.log(data);
            }, 
            error : function()
            {
                alert('failed');
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
<script>
        CKEDITOR.replace( 'other_equipment' );
</script>