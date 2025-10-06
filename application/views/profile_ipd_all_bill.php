
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_all_ipd_bills'); ?>">
                          
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
        <!--<select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
        </select>-->
        <input type="text" name="section" class="form-control" id="section" value="ipd" readonly>
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
                <div class="row">
                    <center>
                        <lable id="billLable"></lable>
                    </center>
                </div>
            </div> 
    
            <div class="panel-body">
                <?php 
                    $this->load->model('patient_model');
                    $this->load->model('document_model');
                ?>
                <div class="row" style="">
                    <?php $grandTotal = array();?>
                    <?php for($i=0; $i<count($patients);$i++){?>
                    <?php
                        //echo $patients[$i]->patient_id;
                        $profile = $this->patient_model->read_by_id_ipd($patients[$i]->id);
  //print_r($this->db->last_query());
                        $documents = $this->document_model->read_by_patient($patients[$i]->id);
                    ?>
                    <div class="col-sm-6" align="center" style="page-break-after: always"> 
                        <div class="row" style="border: groove;">
                            <div class="row">
                                <div class="col-sm-12" align="center">
                                    <strong><?php echo $this->session->userdata('title') ?></strong>
                                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                                    <strong>Bill Receipt(IPD)</strong>
                                    <br><br>
                                </div>
                                <div class="col-md-12 col-lg-12 " style="padding-left: 10px;" > 
                                    <?php 
                                        if($profile->yearly_reg_no){
                                            $opd_data =$this->db->select("*")
                                            ->from('patient')
                                            ->where('yearly_reg_no', $profile->yearly_reg_no) 
                                            //->or_where('old_reg_no', $profile->old_reg_no) 
                                            ->get()
                                            ->row();
                                            $wieght= $opd_data->wieght;
                                            $occupation = $opd_data->occupation;
                                            $address =$opd_data->address;
                                            $nadi=$opd_data->nadi;
                                            $givwa=$opd_data->givwa;
                                            $bp=$opd_data->bp;
                                            $mal=$opd_data->mal;
                                            $mutra=$opd_data->mutra;
                                            $ur=$opd_data->ur;
                                            $udar=$opd_data->udar;
                                        
                                        }else if($profile->old_reg_no){
                                        
                                            $opd_data =$this->db->select("*")
                                            ->from('patient')
                                            ->where('old_reg_no', $profile->old_reg_no) 
                                            // ->or_where('old_reg_no', $profile->yearly_reg_no) 
                                            ->get()
                                            ->row();
                                            $wieght= $opd_data->wieght;
                                            $occupation = $opd_data->occupation;
                                            $address =$opd_data->address;
                                            $nadi=$opd_data->nadi;
                                            $givwa=$opd_data->givwa;
                                            $bp=$opd_data->bp;
                                            $mal=$opd_data->mal;
                                            $mutra=$opd_data->mutra;
                                            $ur=$opd_data->ur;
                                            $udar=$opd_data->udar;
                                            $h_o=$opd_data->h_o;
                                            $f_h=$opd_data->f_h;
                                        }
                                    ?>
                                    <table class="table">
                                        <tr>
                                            <?php 
                                            $acyear = '%'.$this->session->userdata('acyear').'%';
                                            $receipt_no=$this->db->select("*")
                                                ->from('patient_ipd')
                                                ->where('id <=',$profile->id)
                                                ->where('create_date like',$acyear)
                                                ->get()
                                                ->num_rows();
                                            
                                            
                                            // patient ipd yearly no
                                            $ipd_no_date=date('Y-m-d',strtotime($profile->create_date));
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
                                            
                                            
                                            $ipd_recepti_num++;
                                            $challan_no1 = str_pad($ipd_recepti_num, 5, '0', STR_PAD_LEFT);
                                            ?>
                                            <td>Bill Date:</td>
                                            <td><?php echo (!empty($profile->create_date)?date('d-m-Y',strtotime($profile->discharge_date)):null) ?></td>
                                            <td>Receipt No:</td>
                                            <td><b><?php echo $challan_no1; ?></b></td>
                                        </tr>
                                        <tr> 
                                            <td>IPD No:</td>
                                            <td><?php echo $tot_serial_ipd_change; ?></td>
                                            <td>DOA :</td>
                                            <td><?php echo (!empty($profile->create_date)?date('Y-m-d',strtotime($profile->create_date)):null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>OPD No.:</td>
                                            <td>
                                                <?php if($profile->yearly_reg_no != null){
                                                echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null);
                                                echo "(New)";
                                                } else {
                                                echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                                echo "(Old)";
                                                } ?>
                                            </td>
                                            <td>DOD :</td>
                                            <td><?php echo (!empty($profile->create_date)?$profile->discharge_date:null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Name :</td>
                                            <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                            <td>Gender :</td>
                                            <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Age :</td>
                                            <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?></td>
                                            <td>Address :</td>
                                            <td><?php echo $address; ?></td>
                                        </tr>
                                        <!--<tr>
                                            <td>Occupation :</td>
                                            <td><?//php echo $occupation;?></td>  
                                            <td>Dignosisi :</td>
                                            <td><?//php echo $profile->dignosis;?></td>
                                        </tr>
                                        <tr>
                                            <td>Department :</td>
                                            <td><?//php if($profile->department_id != null) {
                                            //echo (!empty($profile->name)?$profile->name:null);
                                            //} ?>
                                            </td> 
                                            
                                            <?//php $a=array(40,42,44,48,50,52,76,80,72);
                                            //$key = array_rand($a); 
                                            //?>
                                            <td>Weight  :</td>
                                            <td><?//php echo  $wieght;?></td>  
                                        </tr>-->
                                    </table>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-12" align="center" style="padding-left: 50px;padding-right: 50px;">  
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <th>Sr. No.</th>
                                            <th>Particular</th>
                                            <th>Days / No.</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            </tr>
                                        </thead>

                                        <?php 
                                            ///////////////////// $section_tret='ipd';
                                            ///////////////////// $len=strlen($profile->dignosis);
                                            ///////////////////// $dd= substr($profile->dignosis,$len - 1);
                                            ///////////////////// if($dd=='I'){
                                            /////////////////////     $p_dignosis = '%'.$profile->dignosis.'%';
                                            /////////////////////     $p_dignosis_name=$profile->dignosis;
                                            ///////////////////// }else{
                                                
                                            /////////////////////     $p_dignosis = '%'.$profile->dignosis.'I%';
                                            /////////////////////     $p_dignosis_name=$profile->dignosis.'I';
                                            ///////////////////// }
                                            
                                            ///////////////////// $ss=date('Y-m-d',strtotime($dateto));
                                
                                            ///////////////////// $table='treatments1';
                                            
                                            ///////////////////// if($profile->manual_status==0){
                                            ///////////////////// $tretment=$this->db->select("*")
                                            /////////////////////     ->from($table)
                                            /////////////////////     ->where('dignosis LIKE',$p_dignosis)
                                            /////////////////////     ->where('ipd_opd ',$section_tret)
                                            /////////////////////     ->get()
                                            /////////////////////     ->row();
                                            ///////////////////// }else{
                                            /////////////////////     $tretment=$this->db->select("*")
                                            /////////////////////     ->from('manual_treatments')
                                            /////////////////////     ->where('patient_id_auto',$patient->id)
                                            /////////////////////     ->where('dignosis LIKE',$p_dignosis)
                                            /////////////////////     ->where('ipd_opd ',$section_tret)
                                            /////////////////////     ->get()
                                            /////////////////////     ->row();
                                            ///////////////////// }
                                            
                                            ///////////////////// $RX1= $tretment->RX1;
                                            ///////////////////// $RX2= $tretment->RX2;
                                            ///////////////////// $RX3= $tretment->RX3;
                                            ///////////////////// $KARMA= $tretment->KARMA;
                                            ///////////////////// $PK1= $tretment->PK1;
                                            ///////////////////// $PK2= $tretment->PK2;
                                            ///////////////////// $SWA1= $tretment->SWA1;
                                            ///////////////////// $SWA2= $tretment->SWA2;
                                            
                                            ///////////////////// $s_s= $tretment->skarma;
                                            ///////////////////// $s_v= $tretment->vkarma;
                                            
                                            ///////////////////// $SNEHAN= $tretment->SNEHAN;
                                            
                                            ///////////////////// $SWEDAN= $tretment->SWEDAN;
                                            ///////////////////// $VAMAN= $tretment->VAMAN;
                                            
                                            ///////////////////// $VIRECHAN= $tretment->VIRECHAN;
                                            ///////////////////// $BASTI= $tretment->BASTI;
                                            ///////////////////// $NASYA= $tretment->NASYA;
                                            
                                            ///////////////////// $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
                                            ///////////////////// $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
                                            ///////////////////// $OTHER= $tretment->OTHER;
                                            
                                            ///////////////////// $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                            ///////////////////// $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                            ///////////////////// $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                            ///////////////////// $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                            
                                            ///////////////////// $skarma=$tretment->skarma;
                                            ///////////////////// $vkarma=$tretment->vkarma;
                                            
                                            ///////////////////// $X_RAY= $tretment->X_RAY;
                                            ///////////////////// $ECG= $tretment->ECG;
                                            
                                            ///////////////////// $word = "PH";
                                            ///////////////////// $mystring = $RX3;
                                            
                                            ///////////////////// if(strpos($mystring, $word) !== false){
                                            /////////////////////     $phy=$medicine_cost->Physiotherapy;
                                            ///////////////////// }
                                            ///////////////////// else{
                                            /////////////////////     $phy=0;
                                            ///////////////////// }
                                            
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
                                            
                                            $date1=date('Y-m-d',strtotime($profile->create_date));
                                            $date2=date('Y-m-d',strtotime($profile->discharge_date));
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
                                            //// $medicine_cost =$this->db->where('create_date >= ', date("Y-m-d", strtotime($datefrom)))
                                            ////                 ->where('create_date <= ', date("Y-m-d", strtotime($datefrom)))
                                            ////                 ->get('bill_master')->row();
                                            ////print_r($medicine_cost);
                                            
                                            $medicine_cost =$this->db->where('create_date <= ', date("Y-m-d", strtotime($datefrom)))
                                                        ->order_by('create_date','desc')->get('bill_master')->row();
                                            //print_r($medicine_cost);
                                            
                                            $section_tret='ipd';
                                            $tretarray=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$profile->proxy_id)
                                                ->where('department_id',$profile->department_id)
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
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Consultant Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>In Charge Doctors Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Resident Doctors Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Nursing Charges</td>
                                                <td><?php echo $day.' Days';?></td>
                                                <td><?php echo "Rs. ".$medicine_cost->nursing_charge; ?></td>
                                                <td><?php echo "Rs. ".$nursingCharge = $medicine_cost->nursing_charge*$day;?></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Room (Bed Charges)</td>
                                                <td><?php echo $day.' Days';?></td>
                                                <td><?php echo "Rs. ".$medicine_cost->ipd_bed_charge; ?></td>
                                                <td><?php echo "Rs. ".$ipdBedCharge = $medicine_cost->ipd_bed_charge*$day;?></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Patho Charges</td>
                                                <td>
                                                    <?php 
                                                        //print_r($tretarray);
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
                                                        //if($patho_Charge !=0 ) { echo "Rs.".$pa=$patho_Charge;} else { $pa=0; echo "-";}
                                                        echo "-";
                                                    ?>
                                                </td>
                                                <td><?php if($patho_Charge !=0 ) { echo "Rs. ".$patho_Charge;} else { echo "-";} ?></td>
                                                <td><?php if($patho_Charge !=0 ) { echo "Rs. ".$pathoCharge = $patho_Charge;} else { $pathoCharge=0; echo "-";} ?></td>
                                            </tr>
                                            <?php 
                                                //print_r($tretarray);
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
                                            ?>
                                            <tr>
                                                <td>7</td>
                                                <td>Panchakarma Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php if($panchkarma_Charge !=0 ) { echo "Rs. ".$panchkarma_Charge;} else { echo "-";} ?></td>
                                                <td><?if($panchkarma_Charge !=0 ) { echo "Rs. ".$panchkarmaCharge = $panchkarma_Charge;} else { $panchkarmaCharge=0; echo "-";} ?></td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Emergency Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            
                                            <?php 
                                                if(stripos($profile->dignosis, 'VIDRADHI') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'MEDOJ GRANTHI') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                elseif((stripos($profile->dignosis, 'ABSCESS') !== false) && (trim($profile->dignosis) != 'PERIANAL ABSCESS - SLI')){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'PTERYGIUM') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'CHALAZION') !== false){ $ot_charge = $medicine_cost->minor_ot_charge; }
                                                
                                                if(stripos($profile->dignosis, 'ARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'PARIKARTIKA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'BHAGANDAR') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'PERIANAL ABSCESS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'PILONIDLE SINUS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'PHYMOSIS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'RAKTARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'SENTINAL TAG') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'BHAGANDAR') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'MUTRAVRUDDHI') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'HYDROCELE') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'VATAJ ARSHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'NIRUDDHA PRAKASHA') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'PILONIDLE SINUS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'INTERNAL HAEMORRHOIDS') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'ACUTE FISSURE IN ANO') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'TYMPANIC MEMBRANE PERFORATION') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                                elseif(stripos($profile->dignosis, 'GILAYU SHOPH') !== false){ $ot_charge = $medicine_cost->major_ot_charge; }
                                            ?>
                                            <tr>
                                                <td>9</td>
                                                <td>Operative Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$medicine_cost->operative_charge_1;} else { echo "-";} ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$operativeCharge = $medicine_cost->operative_charge_1;} else { $operativeCharge = 0; echo "-";} ?></td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Assistant Surgeon Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$medicine_cost->assistant_surgeon_charge;} else { echo "-";} ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$assistantSurgeonCharge = $medicine_cost->assistant_surgeon_charge;} else { $assistantSurgeonCharge = 0; echo "-";} ?></td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Anesthetic Surgeon Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$medicine_cost->anesthetic_charge;} else { echo "-";} ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$anestheticCharge = $medicine_cost->anesthetic_charge;} else { $anestheticCharge = 0; echo "-";} ?></td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Medicine Charges</td>
                                                <td><?php echo $day.' Days';?></td>
                                                <td><?php echo "Rs. ".$medicine_cost->ipd_medicine_charge;?></td>
                                                <td><?php echo "Rs. ".$ipdMedicineCharge = $medicine_cost->ipd_medicine_charge * $day;?></td>
                                            </tr>
                                            <?php 
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
                                            ?>
                                            <tr>
                                                <td>13</td>
                                                <td>I.V./B.T. Charges</td>
                                                <td><?php if($iv_charge !=0 ) { echo "Total I.V <b>".$totalIVCount."</b>"; } else { echo "-";} ?></td>
                                                <td><?php if($iv_charge !=0 ) { echo "Rs. ".$medicine_cost->iv_charge_wi_medicine; } else { echo "-";}?></td>
                                                <td><?php if($iv_charge !=0 ) { echo "Rs. ".$ivCharge = $iv_charge;} else { $ivCharge = 0; echo "-";} ?></td>
                                            </tr>
                                            <tr>
                                                <td>14</td>
                                                <td>O.T. (Minor/Major) Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$ot_charge;} else { echo "-";} ?></td>
                                                <td><?php if($ot_charge !=0 ) { echo "Rs. ".$otCharge = $ot_charge;} else { $otCharge=0; echo "-";} ?></td>
                                            </tr>
                                            <tr>
                                                <td>15</td>
                                                <td>O<sub>2</sub> Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>16</td>
                                                <td>Blood Transfustion Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>17</td>
                                                <td>I.C.U. Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td>Procedure Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php 
                                                if($tretarray){
                                                    if($tretarray[0]->vkarma != '' || $tretarray[0]->vkarma != NULL){ 
                                                        $dressingCharge = $medicine_cost->dressing_charge * $day;
                                                    }else { $dressingCharge=0; }
                                                }
                                            ?>
                                            <tr>
                                                <td>19</td>
                                                <td>Dressing Charges</td>
                                                <td></td>
                                                <td><?php if($dressingCharge != 0){ echo "Rs. ".$dressingCharge; }else{ echo "-"; }?></td>
                                                <td><?php if($dressingCharge != 0){ echo "Rs. ".$dressingCharge; }else{ echo "-"; }?></td>
                                            </tr>
                                            <tr>
                                                <td>20</td>
                                                <td>Other Charges</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>21</td>
                                                <td>Documentation Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "Rs. ".$medicine_cost->documentation_charge?></td>
                                                <td><?php echo "Rs. ".$documentationCharge = $medicine_cost->documentation_charge; ?></td>
                                            </tr>
                                            <tr>
                                                <td>22</td>
                                                <td>BMW Charges</td>
                                                <td><?php echo "-"; ?></td>
                                                <td><?php echo "Rs. ".$medicine_cost->bmw_charge;  ?></td>
                                                <td><?php echo "Rs. ".$bmwCharge = $medicine_cost->bmw_charge;  ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><b>Grand Total</b></td>
                                                <td><b><?php echo "RS. "; echo $grandTotal[$i] = $receivedRS = $nursingCharge + $ipdBedCharge + $pathoCharge + $panchkarmaCharge + $ipdMedicineCharge + $otCharge + $operativeCharge + $ivCharge + $dressingCharge + $documentationCharge + $bmwCharge;?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
  
                                    <table class="table">
                                        <tr>
                                            <td style="border: 1px solid #ffffff;">Received Rs:</td>
                                            <td style="border: 1px solid #ffffff;">Total Amount:<b><?php echo " RS. ".$receivedRS." /-";?></b></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ffffff;">Sign:</td>
                                            <td style="border: 1px solid #ffffff;">Paid In Advance:</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ffffff;"></td>
                                            <td style="border: 1px solid #ffffff;">Remaining Amount:</td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ffffff;"></td>
                                            <td style="border: 1px solid #ffffff;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid #ffffff;">Patient’s / Relative’s Name:</td>
                                            <td style="border: 1px solid #ffffff;">Accountant’s Sign:</td>
                                        </tr>
                                    </table>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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

