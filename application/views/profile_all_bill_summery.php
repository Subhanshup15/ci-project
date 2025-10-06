
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_bill_summery_report'); ?>">
                          
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
    
    
    <div class="form-group">
        <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
        </select>
        <!--<input type="text" name="section" class="form-control" id="section" value="opd" readonly>-->
    </div>
    
    
    
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
                        <strong>
                            <?php 
                                if($section=='opd'){ echo 'OPD Bill Summery Report';}
                                elseif($section=='ipd'){ echo 'IPD Bill Summery Report';}
                            ?>
                        </strong>
                        <br><br>
                        <?php if($patients){?>
                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                        <?php }?>
                    </div>
                    <div class="col-sm-12" align="center" style="padding-left: 50px;padding-right: 50px;">  
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan=2>Sr. No</th>
                                    <th rowspan=2>Recipt No</th>
                                    <th colspan=2>COPD NO</th>
                                    <?php if($section=='ipd'){?><th rowspan=2>CIPD No</th><?php } ?>
                                    <th rowspan=2>Patient Name</th>
                                    <th rowspan=2>Bill Amount</th>
                                </tr>
                                <tr>
                                    <th>New</th>
                                    <th>Old</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?//php print_r($patients);?>
                                <?php $this->load->model('patient_model');?>
                                <?php if($section=='opd'){?>
                                    <?php if($patients){?>
                                        <?php for($i=0;$i<count($patients);$i++){?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                
                                                <?php 
                                                    $acyear = '%'.$this->session->userdata('acyear').'%';
                                                    $receipt_no=$this->db->select("*")
                                                        ->from('patient')
                                                        ->where('id <=',$patients[$i]->id)
                                                        ->where('create_date like',$acyear)
                                                        ->get()
                                                        ->num_rows();
                                                    $challan_no1 = str_pad($receipt_no, 5, '0', STR_PAD_LEFT);
                                                ?>
                                                <td><?php echo $challan_no1;?></td>
                                                <td><?php echo $patients[$i]->yearly_reg_no;?></td>
                                                <td><?php echo $patients[$i]->old_reg_no;?></td>
                                                <td><?php echo $patients[$i]->firstname;?></td>
                                                <?php
                                                    // $medicine_cost =$this->db->select("*")
                                                    //     ->from('medicine_cost')
                                                    //     ->get()
                                                    //     ->row();
                                                    
                                                    $section_tret='opd';
                                                    $len=strlen($patients[$i]->dignosis);
                                                    $dd= substr($patients[$i]->dignosis,$len - 1);
                                                    if($dd=='I'){
                                                        // echo $dd;
                                                        $dd1=substr($patients[$i]->dignosis, 0, -1);
                                                        $p_dignosis = '%'.$dd1.'%';
                                                        $p_dignosis_name=$dd1;
                                                    }else{
                                                        //echo $dd;
                                                        $p_dignosis = '%'.$patients[$i]->dignosis.'%';
                                                        $p_dignosis_name=$patients[$i]->dignosis;
                                                    }
                                                    $ss=date('Y-m-d',strtotime($dateto));
                                                    $table='treatments1';
                                                    if($patients[$i]->manual_status==0){
                                                        $tretment=$this->db->select("*")
                                                            ->from($table)
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }else{
                                                        $tretment=$this->db->select("*")
                                                            ->from('manual_treatments')
                                                            ->where('patient_id_auto',$patients[$i]->id)
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }
                                                    
                                                    $RX1= $tretment->RX1;
                                                    $RX2= $tretment->RX2;
                                                    $RX3= $tretment->RX3;
                                                    $KARMA= $tretment->KARMA;
                                                    $PK1= $tretment->PK1;
                                                    $PK2= $tretment->PK2;
                                                    $SWA1= $tretment->SWA1;
                                                    $SWA2= $tretment->SWA2;
                                                    $s_s= $tretment->skarma;
                                                    $s_v= $tretment->vkarma;
                                                    //echo $SNEHAN= $tretment->SNEHAN;
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
                                                    $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                                    $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                                    $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                                    $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                                    $X_RAY= $tretment->X_RAY;
                                                    $ECG= $tretment->ECG;
                                                    
                                                    $medicine_cost =$this->db->where('create_date <= ', date("Y-m-d", strtotime($patients[$i]->create_date)))
                                                        ->order_by('create_date','desc')->get('bill_master')->row();
                                                        
                                                    $ch=$medicine_cost->opd_charge;
                                                    $m=$medicine_cost->opd_medicine_charge;
                                                    
                                                    ////////////////////////////////////Panchkarma Charge////////////////////////////////////
                                                    $panchkarma_Charge = 0;
                                                    if(($SNEHAN!='') || ($SWEDAN !='') || ($VAMAN!='') || ($VIRECHAN!='') || ($BASTI!='') || ($NASYA!='') || ($RAKTAMOKSHAN!='') || ($SHIRODHARA_SHIROBASTI!='') || ($OTHER!='')) {
                                                        if($SNEHAN != '' && $SWEDAN != ''){
                                                            if(stripos($SNEHAN, 'STHANIK SNEHAN') !== false && stripos($SWEDAN, 'STHANIK SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sthanik_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARVANG SNEHAN') !== false && stripos($SWEDAN, 'SARVANGA SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARVANGA SNEHAN') !== false && stripos($SWEDAN, 'SARVANGA SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARVANGA SNEHAN') !== false && stripos($SWEDAN, 'SARVANGA PETI SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARWANG SNEHAN') !== false && stripos($SWEDAN, 'SARWANG SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }else{
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sthanik_snehan_swedan;
                                                            }
                                                        }
                                                        elseif($SNEHAN != ''){
                                                            if(stripos($SNEHAN, 'STHANIK SNEHAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sthanik_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARVANG SNEHAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARVANGA SNEHAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SNEHAN, 'SARWANG SNEHAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }else{
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sthanik_snehan_swedan;
                                                            }
                                                        }
                                                        elseif($SWEDAN != ''){
                                                            if(stripos($SWEDAN, 'STHANIK SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sthanik_snehan_swedan;
                                                            }elseif(stripos($SWEDAN, 'SARVANG SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SWEDAN, 'SARVANGA SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }elseif(stripos($SWEDAN, 'SARWANG SWEDAN') !== false){
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sarwang_snehan_swedan;
                                                            }else{
                                                                $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->sthanik_snehan_swedan;
                                                            }
                                                        }
                                                        if($SNEHAN != '' && $SWEDAN != '' && $VIRECHAN != ''){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->virachan_wi_snehan_swedan;
                                                        }elseif($SNEHAN == '' && $SWEDAN == '' && $VIRECHAN != ''){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->virachan_wo_snehan_swedan;
                                                        }
                                                        
                                                        if($SHIRODHARA_SHIROBASTI != ''){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->shirodhara;
                                                        }
                                                       
                                                        if(stripos($OTHER, 'KATI BASTI') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->manya_prushtha_kati_basti;
                                                        }elseif(stripos($OTHER, 'JANU BASTI') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->janubasti;
                                                        }elseif(stripos($OTHER, 'HRUDBASTI') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->hrudaydhara_hrudaybasti;
                                                        }elseif(stripos($OTHER, 'NETRATARPAN') !== false || stripos($OTHER, 'NETRA TARPAN') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->netratarpan;
                                                        }elseif(stripos($OTHER, 'YONI DHAVAN') !== false || stripos($OTHER, 'YONIDHAVAN') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->yonidhvan;
                                                        }elseif(stripos($OTHER, 'UDVARTAN') !== false || stripos($OTHER, 'UDWARTAN') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->udavartan;
                                                        }
                                                        
                                                        if(stripos($RAKTAMOKSHAN, 'SIRAVEDH(1D)') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->raktamokshan_siraved;
                                                        }elseif(stripos($RAKTAMOKSHAN, 'JALAUKAVACHARAN') !== false || stripos($RAKTAMOKSHAN, 'RAKTMOKSHAN-JALOKA AT SCALP 1 TIME') !== false || stripos($RAKTAMOKSHAN, 'Jalukavacharan(1D)') !== false){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->raktamokshan_jalokavachan;
                                                        }
                                                        
                                                        if($VAMAN != ''){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->vaman;
                                                        }
                                                        
                                                        if($SHIROBASTI != ''){
                                                            $panchkarma_Charge = $panchkarma_Charge + $medicine_cost->shirobasti;
                                                        }
                                                    }
                                                    if($panchkarma_Charge !=0 ) { $p=$panchkarma_Charge;} else { $p=0;}
                                                    
                                                    ////////////////////////////////////Patho Charge////////////////////////////////////
                                                    $patho_Charge = 0;
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
                                                        }
                                                        if($BIOCHEMICAL!=''){
                                                            if(stripos($BIOCHEMICAL, 'Sr.Uric Acid') !== false){$patho_Charge = $patho_Charge + $medicine_cost->sr_uric_acid;}
                                                            if(stripos($BIOCHEMICAL, 'BSL-F-PP') !== false){$patho_Charge = $patho_Charge + $medicine_cost->bsl_f_pp;}
                                                            if(stripos($BIOCHEMICAL, 'Sr. CREATININE') !== false){$patho_Charge = $patho_Charge + $medicine_cost->sr_creatinine;}
                                                            if(stripos($BIOCHEMICAL, 'LFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->lft_test;}
                                                            if(stripos($BIOCHEMICAL, 'RFT') !== false){$patho_Charge = $patho_Charge + $medicine_cost->rft_test;}
                                                        }
                                                        if($MICROBIOLOGICAL!=''){
                                                            $exMICROBIOLOGICAL = explode(',',trim($MICROBIOLOGICAL));
                                                            if($exMICROBIOLOGICAL[0]!='' || $exMICROBIOLOGICAL[0]!=null){
                                                                $patho_Charge = $patho_Charge + (count($exMICROBIOLOGICAL)*$medicine_cost->urine_routine);
                                                            }
                                                        }
                                                        if($X_RAY!=''){
                                                            $patho_Charge = $patho_Charge + $medicine_cost->x_ray_test;
                                                        }
                                                        if($ECG!=''){
                                                            $patho_Charge = $patho_Charge + $medicine_cost->ecg_test;
                                                        }
                                                        if($USG!=''){
                                                            $patho_Charge = $patho_Charge + $medicine_cost->usg_test;
                                                        }
                                                    }
                                                    if($patho_Charge !=0 ) { $pa=$patho_Charge;} else { $pa=0;}
                                                    
                                                    $tt = $ch + $m + $p + $pa; 
                                                    $grandTotal[$i] = $tt;
                                                ?>
                                                <td><?php echo 'Rs.'.$tt;?></td>
                                            </tr>
                                        <?php } ?>
                                            <tr>
                                                <th colspan=5>Total Ammount</th>
                                                <th><?php echo 'Rs.'.array_sum($grandTotal);?></th>
                                            </tr>
                                    <?php } ?>
                                <?php } ?>
                                <?php if($section=='ipd'){?>
                                    <?php if($patients){?>
                                        
                                        <?php for($i=0;$i<count($patients);$i++){?>
                                            <tr>
                                                <td><?php echo $i+1;?></td>
                                                
                                                <?php 
                                                    $ipd_recepti_num++;
                                                    //$ipd_no = $ipd_recepti_num;
                                                    $challan_no1 = str_pad($ipd_recepti_num, 5, '0', STR_PAD_LEFT);
                                                ?>
                                                <td><?php echo $challan_no1;?></td>
                                                <td><?php echo $patients[$i]->yearly_reg_no;?></td>
                                                <td><?php echo $patients[$i]->old_reg_no;?></td>
                                                <?php 
                                                    $profile = $this->patient_model->read_by_id_ipd($patients[$i]->id);
                                                    $year1 = date('Y',strtotime($profile->create_date));
                                                    $year2='%'.$year1.'%';
                                                    
                                                    $this->db->select('*');
                                                    $this->db->where('ipd_opd', 'ipd');
                                                    $this->db->where('id <', $profile->id);
                                                    // $this->db->where('create_date <=', $d_ipd_no);
                                                    $this->db->where('create_date LIKE', $year2);
                                                    $query = $this->db->get('patient_ipd');
                                                    $num_ipd_change = $query->num_rows();
                                                    $tot_serial_ipd_change=$num_ipd_change;
                                                    $tot_serial_ipd_change++;
                                                ?>
                                                <td><?php echo $tot_serial_ipd_change;?></td>
                                                <td><?php echo $patients[$i]->firstname;?></td>
                                                <?php
                                                    
                                                    $che=trim($profile->dignosis);
                                                    $section_tret='ipd';
                                                    $len=strlen($che);
                                                    $dd= substr($che,$len - 1);
                                                    
                                                    $str = $profile->dignosis;
                                                    $arry=explode("-",$str);
                                                    $t_c=count($arry);
                                                    if($t_c=='2'){
                                                        $dd1=substr($che, 0, -1);
                                                        $new_str = trim($arry[0]);
                                                        $p_dignosis = '%'.$new_str.'%';
                                                        $p_dignosis_name=$profile->dignosis;
                                                    }else{
                                                        $p_dignosis = '%'.$che.'%';
                                                        $p_dignosis_name=$profile->dignosis;
                                                    }
                                            
                                                    
                                                    $date1=date('Y-m-d',strtotime($patients[$i]->create_date));
                                                    $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
                                                    $datetime1 = date_create($date1); 
                                                    $datetime2 = date_create($date2); 
                                                    
                                                    // calculates the difference between DateTime objects 
                                                    $interval = date_diff($datetime1, $datetime2); 
                                                    
                                                    // printing result in days format 
                                                    $day= $interval->format('%a'); 
                                                    
                                                    // $medicine_cost =$this->db->select("*")
                                                    //     ->from('medicine_cost')
                                                    //     ->get()
                                                    //     ->row();
                                                    $medicine_cost =$this->db->where('create_date <= ', date("Y-m-d", strtotime($datefrom)))
                                                        ->order_by('create_date','desc')->get('bill_master')->row();
                                                    
                                                    $section_tret='ipd';
                                                    $tretarray=$this->db->select("*")
                                                        ->from('treatments1')
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('proxy_id',$patients[$i]->proxy_id)
                                                        ->where('department_id',$patients[$i]->department_id)
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
                                                    if(stripos($patients[$i]->dignosis, 'VIDRADHI') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'MEDOJ GRANTHI') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                    elseif((stripos($patients[$i]->dignosis, 'ABSCESS') !== false) && (trim($patients[$i]->dignosis) != 'PERIANAL ABSCESS - SLI')){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'PTERYGIUM') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'CHALAZION') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                    
                                                    //////////////////////////////////////// Minor OT Charge//////////////////////////////////////////
                                                    if(stripos($patients[$i]->dignosis, 'ARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'PARIKARTIKA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'BHAGANDAR') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'PERIANAL ABSCESS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'PILONIDLE SINUS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'PHYMOSIS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'RAKTARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'SENTINAL TAG') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'BHAGANDAR') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'MUTRAVRUDDHI') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'HYDROCELE') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'VATAJ ARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'NIRUDDHA PRAKASHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'PILONIDLE SINUS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'INTERNAL HAEMORRHOIDS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'ACUTE FISSURE IN ANO') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'TYMPANIC MEMBRANE PERFORATION') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    elseif(stripos($patients[$i]->dignosis, 'GILAYU SHOPH') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                    
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

                                                    //$tt = $ch + $tret;
                                                    $tt = $nursingCharge + $ipdBedCharge + $pathoCharge + $panchkarmaCharge + $ipdMedicineCharge + $otCharge + $operativeCharge + $assistantSurgeonCharge + $anestheticCharge + $ivCharge + $dressingCharge + $documentationCharge + $bmwCharge;
                                                    $grandTotal[$i] = $tt;
                                                ?>
                                                <td><?php echo 'Rs.'.$tt;?></td>
                                            </tr>
                                        <?php } ?>
                                            <tr>
                                                <th colspan=6>Total Ammount</th>
                                                <th><?php echo 'Rs.'.array_sum($grandTotal);?></th>
                                            </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>

</div>