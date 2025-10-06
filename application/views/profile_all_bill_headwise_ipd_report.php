
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_monthly_headwise_bill_report_ipd'); ?>">
                          
    <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
    
    
    <div class="form-group">
    
    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
    
    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
    
    </div>  
    
    <div class="form-group">
    
    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
    
    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
    <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
    </div>  
    
    
    <!--<div class="form-group">-->
        <!--<select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
        </select>-->
        <!--<input type="text" name="section" class="form-control" id="section" value="opd" readonly>-->
    <!--</div>-->
    
    
    
    <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
    
    
    
    </form>
    </div>
    
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 
    
            <div class="panel-body">
                <?php 
                    $this->load->model('patient_model');
                    $this->load->model('document_model');
                ?>
                <div class="row" style="">
                    <?//php print_r(count($patients_opd));?>
                    <?//php print_r(count($patients_ipd));?>
                    <?//php print_r($date_diff);?>
                    <div class="col-sm-12" align="center">
                        <strong><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                        <strong>Headwise Daily / Monthly IPD Bill Report</strong>
                        <br><br>
                        <?php if($patients_opd || $patients_ipd){?>
                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                        <?php }?>
                    </div>
                    <div class="col-sm-12" align="center" style="padding-left: 50px;padding-right: 50px;">  
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th style="width:250px;">Date</th>
                                    <th>Consultant Charges</th>
                                    <th>In Charge Doctors Charges</th>
                                    <th>Resident Doctors Charges</th>
                                    <th>Nursing Charges</th>
                                    <th>Room (Bed Charges)</th>
                                    <th>Patho Charges</th>
                                    <th>Panchakarma Charges</th>
                                    <th>Emergency Charges</th>
                                    <th>Operative Charges</th>
                                    <th>Assistant Surgeon Charges</th>
                                    <th>Anesthetic Surgeon Charges</th>
                                    <th>Medicine Charges</th>
                                    <th>I.V./B.T. Charges</th>
                                    <th>O.T. (Minor/Major) Charges</th>
                                    <th>O<sub>2</sub> Charges</th>
                                    <th>Blood Transfustion Charges</th>
                                    <th>I.C.U. Charges</th>
                                    <th>Procedure Charges</th>
                                    <th>Dressing Charges</th>
                                    <th>Other Charges</th>
                                    <th>Documentation Charges</th>
                                    <th>BMW Charges</th>
                                    <th>Total Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($patients_ipd){?>
                                    <?php 
                                        $grandTotalOPD = array();
                                        $grandTotalIPD = array();
                                        $grandTotal = array();
                                        $Consultant_Charges= 0; $In_Charge_Doctors_Charges= 0; $Resident_Doctors_Charges= 0; 
                                        $Nursing_Charges= 0; $Bed_Charges= 0; $Patho_Charges= 0; $Panchakarma_Charges= 0; 
                                        $Emergency_Charges= 0; $Operative_Charges= 0; $Assistant_Surgeon_Charges= 0; 
                                        $Anesthetic_Surgeon_Charges= 0; $Medicine_Charges= 0; $IV_BT_Charges= 0; $OT_Charges = 0;
                                        $O2_Charges= 0; $Blood_Transfustion_Charges= 0; $ICU_Charges= 0; 
                                        $Procedure_Charges= 0; $Dressing_Charges= 0; $Other_Charges= 0; 
                                        $Documentation_Charges= 0; $BMW_Charges = 0;
                                    ?>
                                    <?php for($sr_no=0; $sr_no<$date_diff; $sr_no++){?>
                                        <tr>
                                            <td><?php echo $sr_no+1; ?></td>
                                            <td><?php echo $check_date = date("d-m-Y", strtotime($datefrom . ' + ' . $sr_no . 'day'));?></td>
                                                <?php 
                                                    $opd_tt=0;
                                                    $ipd_tt=0;
                                                    for($j=0; $j<count($patients_ipd); $j++){
                                                            
                                                            $che=trim($patients_ipd[$j]->dignosis);
                                                            $section_tret='ipd';
                                                            $len=strlen($che);
                                                            $dd= substr($che,$len - 1);
                                                            
                                                            $str = $patients_ipd[$j]->dignosis;
                                                            $arry=explode("-",$str);
                                                            $t_c=count($arry);
                                                            if($t_c=='2'){
                                                                $dd1=substr($che, 0, -1);
                                                                $new_str = trim($arry[0]);
                                                                $p_dignosis = '%'.$new_str.'%';
                                                                $p_dignosis_name=$patients_ipd[$j]->dignosis;
                                                            }else{
                                                                $p_dignosis = '%'.$che.'%';
                                                                $p_dignosis_name=$patients_ipd[$j]->dignosis;
                                                            }
                                                    
                                                            $date1=date('Y-m-d',strtotime($patients_ipd[$j]->create_date));
                                                            $date2=date('Y-m-d',strtotime($patients_ipd[$j]->discharge_date));
                                                            $datetime1 = date_create($date1); 
                                                            $datetime2 = date_create($date2); 
                                                            
                                                            // calculates the difference between DateTime objects 
                                                            $interval = date_diff($datetime1, $datetime2); 
                                                            
                                                            // printing result in days format 
                                                            $day= $interval->format('%a');
                                                            if(date("d-m-Y", strtotime($patients_ipd[$j]->discharge_date)) == $check_date){
                                                                
                                                                $medicine_cost =$this->db->where('create_date <= ', date("Y-m-d", strtotime($check_date)))
                                                                    ->order_by('create_date','desc')->get('bill_master')->row();
                                                        
                                                                $section_tret='ipd';
                                                                $tretarray=$this->db->select("*")
                                                                    ->from('treatments1')
                                                                    ->where('dignosis LIKE',$p_dignosis)
                                                                    ->where('proxy_id',$patients_ipd[$j]->proxy_id)
                                                                    ->where('department_id',$patients_ipd[$j]->department_id)
                                                                    ->where('ipd_opd',$section_tret)
                                                                    ->get()
                                                                    ->result();
                                                                
                                                                $nursingCharge = 0;
                                                                $ipdBedCharge = 0;
                                                                $patho_Charge = 0;
                                                                $pathoCharge = 0;
                                                                $panchkarma_Charge = 0;
                                                                $panchkarmaCharge = 0;
                                                                $ipdMedicineCharge = 0;
                                                                $ot_charge = 0;
                                                                $operativeCharge = 0;
                                                                $anestheticCharge = 0;
                                                                $assistantSurgeonCharge = 0;
                                                                $iv_charge = 0;
                                                                $dressingCharge = 0;
                                                                $documentationCharge = 0;
                                                                $bmwCharge = 0;
                                                                
                                                                $nursingCharge = $medicine_cost->nursing_charge*$day;
                                                                $ipdBedCharge = $medicine_cost->ipd_bed_charge*$day;
                                                                $ipdMedicineCharge = $medicine_cost->ipd_medicine_charge * $day;
                                                                
                                                                ////////////////////////////////////////Patho Charge//////////////////////////////////////////
                                                                if($tretarray){
                                                                    foreach($tretarray as $tretment){
                                                                        // echo 'HE => ';print_r($tretment->HEMATOLOGICAL);
                                                                        // echo 'SE => ';print_r($tretment->SEROLOGYCAL);
                                                                        // echo 'BI => ';print_r($tretment->BIOCHEMICAL);
                                                                        // echo 'MI => ';print_r($tretment->MICROBIOLOGICAL);
                                                                        // echo 'X => ';print_r($tretment->X_RAY);
                                                                        // echo 'EC => ';print_r($tretment->ECG);
                                                                        // echo 'US => ';print_r($tretment->USG);
                                                                        $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                                                        $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                                                        $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                                                        $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                                                        $X_RAY= $tretment->X_RAY;
                                                                        $ECG= $tretment->ECG;
                                                                        $USG= $tretment->USG;
                                                                        
                                                                        if(($HEMATOLOGICAL!='') || ($SEROLOGYCAL !='') || ($BIOCHEMICAL!='') || ($MICROBIOLOGICAL!='') || ($X_RAY!='') || ($ECG!='') || ($USG!='')) { 
                                                                            if($HEMATOLOGICAL!=''){
                                                                                if(stripos($HEMATOLOGICAL, 'CBC') !== false){$patho_Charge = $patho_Charge + $medicine_cost->cbc;}
                                                                                if(stripos($HEMATOLOGICAL, 'ESR') !== false){$patho_Charge = $patho_Charge + $medicine_cost->prothrombin_time_esr;}
                                                                                if(stripos($HEMATOLOGICAL, 'M.P.') !== false){$patho_Charge = $patho_Charge + $medicine_cost->mp_card;}
                                                                                if(stripos($HEMATOLOGICAL, 'LFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->lft_test;}
                                                                                if(stripos($HEMATOLOGICAL, 'BSL-F-PP') !== false){$patho_Charge = $patho_Charge + $medicine_cost->bsl_f_pp;}
                                                                                if(stripos($HEMATOLOGICAL, 'BSL-R') !== false){$patho_Charge = $patho_Charge + $medicine_cost->bsl_r;}
                                                                                if(stripos($HEMATOLOGICAL, 'BTCT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->bt_ct_test;}
                                                                                if(stripos($HEMATOLOGICAL, 'BLOOD GROUP') !== false){$patho_Charge = $patho_Charge + $medicine_cost->blood_group;}
                                                                                //echo 'HE'.$patho_Charge.'<br>';
                                                                            }
                                                                            if($SEROLOGYCAL!=''){
                                                                                if(stripos($SEROLOGYCAL, 'R.A. Test') !== false){$patho_Charge = $patho_Charge + $medicine_cost->ra_test;}
                                                                                if(stripos($SEROLOGYCAL, 'LIPID PROFILE') !== false){$patho_Charge = $patho_Charge + $medicine_cost->lipid_profile;}
                                                                                if(stripos($SEROLOGYCAL, 'LFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->lft_test;}
                                                                                if(stripos($SEROLOGYCAL, 'Sr. Prolactin') !== false){$patho_Charge = $patho_Charge + $medicine_cost->prolactin;}
                                                                                if(stripos($SEROLOGYCAL, 'HIV') !== false){$patho_Charge = $patho_Charge + $medicine_cost->hiv_test;}
                                                                                if(stripos($SEROLOGYCAL, 'HBsAg') !== false){$patho_Charge = $patho_Charge + $medicine_cost->hbsag_test;}
                                                                                if(stripos($SEROLOGYCAL, 'VDRL') !== false){$patho_Charge = $patho_Charge + $medicine_cost->vdrl_test;}
                                                                                if(stripos($SEROLOGYCAL, 'RFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->rft_test;}
                                                                                //echo 'SE'.$patho_Charge.'<br>';
                                                                            }
                                                                            if($BIOCHEMICAL!=''){
                                                                                if(stripos($BIOCHEMICAL, 'Sr.Uric Acid') !== false){$patho_Charge = $patho_Charge + $medicine_cost->sr_uric_acid;}
                                                                                if(stripos($BIOCHEMICAL, 'BSL-F-PP') !== false){$patho_Charge = $patho_Charge + $medicine_cost->bsl_f_pp;}
                                                                                if(stripos($BIOCHEMICAL, 'Sr. CREATININE') !== false){$patho_Charge = $patho_Charge + $medicine_cost->sr_creatinine;}
                                                                                if(stripos($BIOCHEMICAL, 'LFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->lft_test;}
                                                                                if(stripos($BIOCHEMICAL, 'RFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->rft_test;}
                                                                                //echo 'BI'.$patho_Charge.'<br>';
                                                                            }
                                                                            if($MICROBIOLOGICAL!=''){
                                                                                $exMICROBIOLOGICAL = explode(',',trim($MICROBIOLOGICAL));
                                                                                if($exMICROBIOLOGICAL[0]!='' || $exMICROBIOLOGICAL[0]!=null){
                                                                                    $patho_Charge = $patho_Charge + (count($exMICROBIOLOGICAL)*$medicine_cost->urine_routine);
                                                                                    //echo 'MI'.$patho_Charge.'<br>';
                                                                                }
                                                                            }
                                                                            if($X_RAY!=''){
                                                                                $patho_Charge = $patho_Charge + $medicine_cost->x_ray_test;
                                                                                //echo 'X'.$patho_Charge.'<br>';
                                                                            }
                                                                            if($ECG!=''){
                                                                                $patho_Charge = $patho_Charge + $medicine_cost->ecg_test;
                                                                                //echo 'EC'.$patho_Charge.'<br>';
                                                                            }
                                                                            if($USG!=''){
                                                                                $patho_Charge = $patho_Charge + $medicine_cost->usg_test;
                                                                                //echo 'US'.$patho_Charge.'<br>';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                if($patho_Charge !=0 ) { $pathoCharge = $patho_Charge;} else { $pathoCharge=0;}
                                                                
                                                                ////////////////////////////////////////Panchkarma Charge//////////////////////////////////////////
                                                                if($tretarray){
                                                                    foreach($tretarray as $tretment){
                                                                        
                                                                        // echo $tretment->SNEHAN."<br>";
                                                                        // echo $tretment->SWEDAN."<br>";
                                                                        // echo $tretment->VAMAN."<br>";
                                                                        // echo $tretment->VIRECHAN."<br>";
                                                                        // echo $tretment->BASTI."<br>";
                                                                        // echo $tretment->NASYA."<br>";
                                                                        // echo $tretment->RAKTAMOKSHAN."<br>";
                                                                        // echo $tretment->SHIRODHARA_SHIROBASTI."<br>";
                                                                        // echo $tretment->OTHER."<br>";
                                                                        
                                                                        $SNEHAN= $tretment->SNEHAN;
                                                                        $SWEDAN= $tretment->SWEDAN;
                                                                        $VAMAN= $tretment->VAMAN;
                                                                        $VIRECHAN= $tretment->VIRECHAN;
                                                                        $BASTI= $tretment->BASTI;
                                                                        $NASYA= $tretment->NASYA;
                                                                        $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
                                                                        $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
                                                                        $SHIROBASTI= $tretment->SHIROBASTI;
                                                                        $OTHER= $tretment->OTHER;
                                                                        
                                                                        if(($SNEHAN!='') || ($SWEDAN !='') || ($VAMAN!='') || ($VIRECHAN!='') || ($BASTI!='') || ($NASYA!='') || ($RAKTAMOKSHAN!='') || ($SHIRODHARA_SHIROBASTI!='') || ($SHIROBASTI!='') || ($OTHER!='')) {
                                                                            if($SNEHAN != '' && $SWEDAN != ''){
                                                                                if(stripos($SNEHAN, 'STHANIK SNEHAN') !== false && stripos($SWEDAN, 'STHANIK SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sthanik_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARVANG SNEHAN') !== false && stripos($SWEDAN, 'SARVANGA SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARVANGA SNEHAN') !== false && stripos($SWEDAN, 'SARVANGA SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARVANGA SNEHAN') !== false && stripos($SWEDAN, 'SARVANGA PETI SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARWANG SNEHAN') !== false && stripos($SWEDAN, 'SARWANG SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }else{
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sthanik_snehan_swedan * $day);
                                                                                }
                                                                            }
                                                                            elseif($SNEHAN != ''){
                                                                                if(stripos($SNEHAN, 'STHANIK SNEHAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sthanik_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARVANG SNEHAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARVANGA SNEHAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SNEHAN, 'SARWANG SNEHAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }else{
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sthanik_snehan_swedan * $day);
                                                                                }
                                                                            }
                                                                            elseif($SWEDAN != ''){
                                                                                if(stripos($SWEDAN, 'STHANIK SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sthanik_snehan_swedan * $day);
                                                                                }elseif(stripos($SWEDAN, 'SARVANG SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SWEDAN, 'SARVANGA SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }elseif(stripos($SWEDAN, 'SARWANG SWEDAN') !== false){
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sarwang_snehan_swedan * $day);
                                                                                }else{
                                                                                    $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->sthanik_snehan_swedan * $day);
                                                                                }
                                                                            }
                                                                            if($SNEHAN != '' && $SWEDAN != '' && $VIRECHAN != ''){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->virachan_wi_snehan_swedan * $day);
                                                                            }elseif($SNEHAN == '' && $SWEDAN == '' && $VIRECHAN != ''){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->virachan_wo_snehan_swedan * $day);
                                                                            }
                                                                            
                                                                            if($SHIRODHARA_SHIROBASTI != ''){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->shirodhara * $day);
                                                                            }
                                                                           
                                                                            if(stripos($OTHER, 'KATI BASTI') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->manya_prushtha_kati_basti * $day);
                                                                            }elseif(stripos($OTHER, 'JANU BASTI') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->janubasti * $day);
                                                                            }elseif(stripos($OTHER, 'HRUDBASTI') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->hrudaydhara_hrudaybasti * $day);
                                                                            }elseif(stripos($OTHER, 'NETRATARPAN') !== false || stripos($OTHER, 'NETRA TARPAN') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->netratarpan * $day);
                                                                            }elseif(stripos($OTHER, 'YONI DHAVAN') !== false || stripos($OTHER, 'YONIDHAVAN') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->yonidhvan * $day);
                                                                            }elseif(stripos($OTHER, 'UDVARTAN') !== false || stripos($OTHER, 'UDWARTAN') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->udavartan * $day);
                                                                            }
                                                                            
                                                                            if(stripos($RAKTAMOKSHAN, 'SIRAVEDH(1D)') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->raktamokshan_siraved * $day);
                                                                            }elseif(stripos($RAKTAMOKSHAN, 'JALAUKAVACHARAN') !== false || stripos($RAKTAMOKSHAN, 'RAKTMOKSHAN-JALOKA AT SCALP 1 TIME') !== false || stripos($RAKTAMOKSHAN, 'Jalukavacharan(1D)') !== false){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->raktamokshan_jalokavachan * $day);
                                                                            }
                                                                            
                                                                            if($VAMAN != ''){
                                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->vaman;
                                                                            }
                                                                            
                                                                            if($SHIROBASTI != ''){
                                                                                $panchkarma_Charge = $panchkarma_Charge + ($medicine_cost->shirobasti * $day);
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                if($panchkarma_Charge !=0 ) { $panchkarmaCharge = $panchkarma_Charge;} else { $panchkarmaCharge=0;}
                                                                
                                                                //////////////////////////////////////// Minor OT Charge//////////////////////////////////////////
                                                                if(stripos($patients_ipd[$j]->dignosis, 'VIDRADHI') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'MEDOJ GRANTHI') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                                elseif((stripos($patients_ipd[$j]->dignosis, 'ABSCESS') !== false) && (trim($patients_ipd[$j]->dignosis) != 'PERIANAL ABSCESS - SLI')){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'PTERYGIUM') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'CHALAZION') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                                
                                                                //////////////////////////////////////// Minor OT Charge//////////////////////////////////////////
                                                                if(stripos($patients_ipd[$j]->dignosis, 'ARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'PARIKARTIKA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'BHAGANDAR') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'PERIANAL ABSCESS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'PILONIDLE SINUS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'PHYMOSIS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'RAKTARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'SENTINAL TAG') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'BHAGANDAR') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'MUTRAVRUDDHI') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'HYDROCELE') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'VATAJ ARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'NIRUDDHA PRAKASHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'PILONIDLE SINUS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'INTERNAL HAEMORRHOIDS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'ACUTE FISSURE IN ANO') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'TYMPANIC MEMBRANE PERFORATION') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                elseif(stripos($patients_ipd[$j]->dignosis, 'GILAYU SHOPH') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                                
                                                                if($ot_charge !=0 ) { 
                                                                    $operativeCharge = $medicine_cost->operative_charge_1;
                                                                    $assistantSurgeonCharge = $medicine_cost->assistant_surgeon_charge;
                                                                    $anestheticCharge = $medicine_cost->anesthetic_charge;
                                                                    $otCharge = $ot_charge;
                                                                } else { 
                                                                    $operativeCharge = 0;
                                                                    $assistantSurgeonCharge = 0;
                                                                    $anestheticCharge = 0;
                                                                    $otCharge = 0;
                                                                }
                                                                
                                                                //////////////////////////////////////// I.V Charge//////////////////////////////////////////
                                                                if($tretarray){
                                                                    //print_r($tretarray);
                                                                    $totalIVCount = 0;
                                                                    foreach($tretarray as $tretment){
                                                                        // echo $RX1= $tretment->RX1.'<br>';
                                                                        // echo $RX2= $tretment->RX2.'<br>';
                                                                        // echo $RX3= $tretment->RX3.'<br>';
                                                                        // echo $tretment->DISTRIBUTION_IPD.'<br>';
                                                                        
                                                                        if(stripos($tretment->RX1, 'Inj.OFLOXACIN(200mg) IV') !== false){ 
                                                                            $iv_charge = $iv_charge + ((2 * $tretment->DISTRIBUTION_IPD)*$medicine_cost->iv_charge_wi_medicine);
                                                                            $totalIVCount = $totalIVCount + (2 * $tretment->DISTRIBUTION_IPD);
                                                                        }
                                                                        if(stripos($tretment->RX1, 'IVF DNS') !== false){
                                                                            $iv_charge = $iv_charge + ((2 * $tretment->DISTRIBUTION_IPD)*$medicine_cost->iv_charge_wi_medicine);
                                                                            $totalIVCount = $totalIVCount + (2 * $tretment->DISTRIBUTION_IPD);
                                                                        }
                                                                        if(stripos($tretment->RX2, 'Inj.GENTAMYCIN(80mg) IV') !== false){
                                                                            $iv_charge = $iv_charge + ((2 * $tretment->DISTRIBUTION_IPD)*$medicine_cost->iv_charge_wi_medicine);
                                                                            $totalIVCount = $totalIVCount + (2 * $tretment->DISTRIBUTION_IPD);
                                                                        }
                                                                        if(stripos($tretment->RX2, 'Inj.Tinidazole(500mg) IV') !== false){
                                                                            $iv_charge = $iv_charge + ((2 * $tretment->DISTRIBUTION_IPD)*$medicine_cost->iv_charge_wi_medicine);
                                                                            $totalIVCount = $totalIVCount + (2 * $tretment->DISTRIBUTION_IPD);
                                                                        }
                                                                        if(stripos($tretment->RX3, 'Inj.MOX(500mg) IV') !== false){
                                                                            $iv_charge = $iv_charge + ((2 * $tretment->DISTRIBUTION_IPD)*$medicine_cost->iv_charge_wi_medicine);
                                                                            $totalIVCount = $totalIVCount + (2 * $tretment->DISTRIBUTION_IPD);
                                                                        }
                                                                        if(stripos($tretment->RX3, 'Inj.PAN(40mg) IV') !== false){
                                                                            $iv_charge = $iv_charge + ((2 * $tretment->DISTRIBUTION_IPD)*$medicine_cost->iv_charge_wi_medicine);
                                                                            $totalIVCount = $totalIVCount + (2 * $tretment->DISTRIBUTION_IPD);
                                                                        }
                                                                    }
                                                                }
                                                                if($iv_charge !=0 ) { $ivCharge = $iv_charge;} else { $ivCharge = 0;}
                                                                
                                                                //////////////////////////////////////// Dressing Charge//////////////////////////////////////////
                                                                if($tretarray){
                                                                    if($tretarray[0]->vkarma != '' || $tretarray[0]->vkarma != NULL){ $dressingCharge = $medicine_cost->dressing_charge * $day; }else { $dressingCharge=0; }
                                                                }
                                                                
                                                                //////////////////////////////////////// Documentation Charge//////////////////////////////////////////
                                                                $documentationCharge = $medicine_cost->documentation_charge;
                                                                
                                                                //////////////////////////////////////// BMW Charge//////////////////////////////////////////
                                                                $bmwCharge = $medicine_cost->bmw_charge;
                                                                
                                                                $ipd_tt = $nursingCharge + $ipdBedCharge + $pathoCharge + $panchkarmaCharge + $ipdMedicineCharge + $otCharge + $operativeCharge + $assistantSurgeonCharge + $anestheticCharge + $ivCharge + $dressingCharge + $documentationCharge + $bmwCharge + $ipd_tt;
                                                                $Consultant_Charges = $Consultant_Charges + 0;
                                                                $In_Charge_Doctors_Charges = $In_Charge_Doctors_Charges + 0;
                                                                $Resident_Doctors_Charges = $Resident_Doctors_Charges + 0;
                                                                $Nursing_Charges = $Nursing_Charges + $nursingCharge ;
                                                                $Bed_Charges = $Bed_Charges + $ipdBedCharge ;
                                                                $Patho_Charges = $Patho_Charges + $pathoCharge ;
                                                                $Panchakarma_Charges = $Panchakarma_Charges + $panchkarmaCharge ;
                                                                $Emergency_Charges = $Emergency_Charges + 0;
                                                                $Operative_Charges = $Operative_Charges + $operativeCharge ;
                                                                $Assistant_Surgeon_Charges = $Assistant_Surgeon_Charges + $assistantSurgeonCharge ;
                                                                $Anesthetic_Surgeon_Charges = $Anesthetic_Surgeon_Charges + $anestheticCharge ;
                                                                $Medicine_Charges = $Medicine_Charges + $ipdMedicineCharge ;
                                                                $IV_BT_Charges = $IV_BT_Charges + $ivCharge ;
                                                                $OT_Charges = $OT_Charges + $otCharge ;
                                                                $O2_Charges = $O2_Charges + 0;
                                                                $Blood_Transfustion_Charges = $Blood_Transfustion_Charges + 0 ;
                                                                $ICU_Charges = $ICU_Charges + 0;
                                                                $Procedure_Charges = $Procedure_Charges + 0;
                                                                $Dressing_Charges = $Dressing_Charges + $dressingCharge ;
                                                                $Other_Charges = $Other_Charges + 0;
                                                                $Documentation_Charges = $Documentation_Charges + $documentationCharge ;
                                                                $BMW_Charges = $BMW_Charges + $bmwCharge ;
                                                                //print_r($ipd_tt);
                                                            }
                                                        }
                                                    //$grandTotalOPD[$sr_no] = $tt;
                                                ?>
                                            <th><?php echo $Consultant_Charges; $grandTotalOPD_Consultant_Charges[$sr_no] = $Consultant_Charges; $Consultant_Charges = 0; ?></th>
                                            <th><?php echo $In_Charge_Doctors_Charges; $grandTotalOPD_In_Charge_Doctors_Charges[$sr_no] = $In_Charge_Doctors_Charges; $In_Charge_Doctors_Charges = 0; ?></th>
                                            <th><?php echo $Resident_Doctors_Charges; $grandTotalOPD_Resident_Doctors_Charges[$sr_no] = $Resident_Doctors_Charges; $Resident_Doctors_Charges = 0; ?></th>
                                            <th><?php echo $Nursing_Charges; $grandTotalOPD_Nursing_Charges[$sr_no] = $Nursing_Charges; $Nursing_Charges = 0; ?></th>
                                            <th><?php echo $Bed_Charges; $grandTotalOPD_Bed_Charges[$sr_no] = $Bed_Charges; $Bed_Charges = 0; ?></th>
                                            <th><?php echo $Patho_Charges; $grandTotalOPD_Patho_Charges[$sr_no] = $Patho_Charges; $Patho_Charges = 0; ?></th>
                                            <th><?php echo $Panchakarma_Charges; $grandTotalOPD_Panchakarma_Charges[$sr_no] = $Panchakarma_Charges; $Panchakarma_Charges = 0; ?></th>
                                            <th><?php echo $Emergency_Charges; $grandTotalOPD_Emergency_Charges[$sr_no] = $Emergency_Charges; $Emergency_Charges = 0; ?></th>
                                            <th><?php echo $Operative_Charges; $grandTotalOPD_Operative_Charges[$sr_no] = $Operative_Charges; $Operative_Charges = 0; ?></th>
                                            <th><?php echo $Assistant_Surgeon_Charges; $grandTotalOPD_Assistant_Surgeon_Charges[$sr_no] = $Assistant_Surgeon_Charges; $Assistant_Surgeon_Charges = 0; ?></th>
                                            <th><?php echo $Anesthetic_Surgeon_Charges; $grandTotalOPD_Anesthetic_Surgeon_Charges[$sr_no] = $Anesthetic_Surgeon_Charges; $Anesthetic_Surgeon_Charges = 0; ?></th>
                                            <th><?php echo $Medicine_Charges; $grandTotalOPD_Medicine_Charges[$sr_no] = $Medicine_Charges; $Medicine_Charges = 0; ?></th>
                                            <th><?php echo $IV_BT_Charges; $grandTotalOPD_IV_BT_Charges[$sr_no] = $IV_BT_Charges; $IV_BT_Charges = 0; ?></th>
                                            <th><?php echo $OT_Charges; $grandTotalOPD_OT_Charges[$sr_no] = $OT_Charges; $OT_Charges = 0; ?></th>
                                            <th><?php echo $O2_Charges; $grandTotalOPD_O2_Charges[$sr_no] = $O2_Charges; $O2_Charges = 0; ?></th>
                                            <th><?php echo $Blood_Transfustion_Charges; $grandTotalOPD_Blood_Transfustion_Charges[$sr_no] = $Blood_Transfustion_Charges; $Blood_Transfustion_Charges = 0; ?></th>
                                            <th><?php echo $ICU_Charges; $grandTotalOPD_ICU_Charges[$sr_no] = $ICU_Charges; $ICU_Charges = 0; ?></th>
                                            <th><?php echo $Procedure_Charges; $grandTotalOPD_Procedure_Charges[$sr_no] = $Procedure_Charges; $Procedure_Charges = 0; ?></th>
                                            <th><?php echo $Dressing_Charges; $grandTotalOPD_Dressing_Charges[$sr_no] = $Dressing_Charges; $Dressing_Charges = 0; ?></th>
                                            <th><?php echo $Other_Charges; $grandTotalOPD_Other_Charges[$sr_no] = $Other_Charges; $Other_Charges = 0; ?></th>
                                            <th><?php echo $Documentation_Charges; $grandTotalOPD_Documentation_Charges[$sr_no] = $Documentation_Charges; $Documentation_Charges = 0; ?></th>
                                            <th><?php echo $BMW_Charges; $grandTotalOPD_BMW_Charges[$sr_no] = $BMW_Charges; $BMW_Charges = 0; ?></th>
                                            <th><?php echo $grandTotal[$sr_no] = $ipd_tt; $ipd_tt=0;?></th>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th colspan=2>Grand Total</th>
                                        <th><?= array_sum($grandTotalOPD_Consultant_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_In_Charge_Doctors_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Resident_Doctors_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Nursing_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Bed_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Patho_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Panchakarma_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Emergency_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Operative_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Assistant_Surgeon_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Anesthetic_Surgeon_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Medicine_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_IV_BT_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_OT_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_O2_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Blood_Transfustion_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_ICU_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Procedure_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Dressing_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Other_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_Documentation_Charges) ?> </th>
                                        <th><?= array_sum($grandTotalOPD_BMW_Charges) ?> </th>
                                        <th><?= array_sum($grandTotal)?></th>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>

</div>
<script>
    
    $(document).ready(function() {
        $("#billLable").html("Total Bill Amount On <?php echo date('d-m-Y',strtotime($datefrom));?> = <strong> RS. <?php echo array_sum($grandTotal);?> </strong>");
    });
</script>
