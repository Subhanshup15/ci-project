
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_all_bills'); ?>">
                          
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
        <input type="text" name="section" class="form-control" id="section" value="opd" readonly>
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
                        $profile = $this->patient_model->read_by_id($patients[$i]->id);
                        $documents = $this->document_model->read_by_patient($patients[$i]->id);
                    ?>
                    <div class="col-sm-6" align="center" style="page-break-after: always"> 
                        <div class="row" style="border: groove;">
                            <div class="row">
                                <div class="col-sm-12" align="center">
                                    <strong><?php echo $this->session->userdata('title') ?></strong>
                                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                                    <strong>Bill Receipt(OPD)</strong>
                                    <br><br>
                                </div>
                                <div class="col-md-12 col-lg-12 " style="padding-left: 15px;" > 
                                    <table class="table">
                                        <tr>
                                            <td>O.P.D. No.:</td>
                                            <td>
                                            <?php if($profile->yearly_reg_no != null){
                                                echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null); 
                                                echo "(New)";
                                            } else {
                                                echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                                 echo "(Old)";
                                            } ?>
                                            </td>
                                            <?php 
                                             $acyear = '%'.$this->session->userdata('acyear').'%';
                                             $receipt_no=$this->db->select("*")
            			                         ->from('patient')
            			                         ->where('id <=',$profile->id)
            			                         ->where('create_date like',$acyear)
            			                         ->get()
            			                         ->num_rows();
                                            $challan_no1 = str_pad($receipt_no, 5, '0', STR_PAD_LEFT);
                                            ?>
                                            <td>Receipt No</td>
                                            <td><?//php echo "OPD- ".$challan_no1;?><?php echo $challan_no1;?></td>
                                        </tr>
                                        <tr>
                                            <td>Name :</td>
                                            <td colspan='3'><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address :</td>
                                            <td><?php echo (!empty($profile->address)?$profile->address:null) ?></td>
                                        </tr>
                                        <tr>
                                            <?php 
                                                $dep_name= $this->db->select("*")
                                                      ->from('department')
                    			                      ->where('dprt_id', $profile->department_id) 
                                                      ->get()
                                                      ->row();
                                            ?>
                                            <td>Date :</td>
                                            <td><?php echo (!empty($profile->create_date)?date("d/m/Y", strtotime($profile->create_date)):null) ?></td>
                                            <td>Gender :</td>
                                            <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                                        </tr>
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
                                		<th>Amount</th>
                                      </tr>
                                    </thead>
                        
                         <?php 
                                                           $section_tret='opd';
                                                           
                                                             $len=strlen($profile->dignosis);
                                                             $dd= substr($profile->dignosis,$len - 1);
                                                              if($dd=='I'){
                                                                   // echo $dd;
                                                                    $dd1=substr($profile->dignosis, 0, -1);
                                                               $p_dignosis = '%'.$dd1.'%';
                                                                 $p_dignosis_name=$dd1;
                                                          }else{
                                                               //echo $dd;
                                                               $p_dignosis = '%'.$profile->dignosis.'%';
                                                                $p_dignosis_name=$profile->dignosis;
                                                          }
                                                           $ss=date('Y-m-d',strtotime($dateto));
                                                       
                                                            
                                                             $table='treatments1';
                                                     if($profile->manual_status==0){
                                                         $tretment=$this->db->select("*")
                    
                    			                         ->from($table)
                    
                    			                         ->where('dignosis LIKE',$p_dignosis)
                    			                         ->where('ipd_opd ',$section_tret)
                                                         ->get()
                                                         ->row();
                                                      }else{
                                                          $tretment=$this->db->select("*")
                    
                    			                         ->from('manual_treatments')
                                                         ->where('patient_id_auto',$patient->id)
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
                    			                      $USG= $tretment->USG;
                        
                                                   $word = "PH";
                                                   $mystring = $RX3;
                                                   
                                                   
                                        // $medicine_cost =$this->db->where('create_date >= ', date("Y-m-d", strtotime($profile->create_date)))
                                        //                 ->where('create_date <= ', date("Y-m-d", strtotime($profile->create_date)))
                                        //                 ->get('bill_master')->row();
                                        
                                        $medicine_cost =$this->db->where('create_date <= ', date("Y-m-d", strtotime($profile->create_date)))
                                                        ->order_by('create_date','desc')->get('bill_master')->row();
                                        //print_r($medicine_cost);
                                         
                                        if(strpos($mystring, $word) !== false){
                                            $phy=$medicine_cost->Physiotherapy;
                                        }
                                        else{
                                            $phy=0;
                                        }
                        ?>
                        <tbody>
                          <tr>
                             <td>1</td>
                             <td>OPD Charges</td>
                             <td><?php echo "Rs.".$ch=$medicine_cost->opd_charge;  ?></td>
                          </tr>
                          <tr>
                              <td>2</td>
                              <td>Medicine Charges</td>
                    		  <td><?php echo "Rs.".$m=$medicine_cost->opd_medicine_charge; ?></td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Panchkarma Charges</td>
                            <td>
                                <?php 
                                    $panchkarma_Charge = 0;
                                    if(($SNEHAN!='') || ($SWEDAN !='') || ($VAMAN!='') || ($VIRECHAN!='') || ($BASTI!='') || ($NASYA!='') || ($RAKTAMOKSHAN!='') || ($SHIRODHARA_SHIROBASTI!='') || ($SHIROBASTI!='') || ($OTHER!='')) {
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
                                    if($panchkarma_Charge !=0 ) { echo "Rs.".$p=$panchkarma_Charge;} else { $p=0; echo "-";}
                                ?>
                            </td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Shastrakarma Charges</td>
                		    <td><?php echo "-"; ?></td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>Patho Charges</td>
                            <td>
                                <?php 
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
                                    if($patho_Charge !=0 ) { echo "Rs.".$pa=$patho_Charge;} else { $pa=0; echo "-";}
                                ?>
                            </td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>Dressing Charges</td>
                		    <td><?php echo "-"; ?></td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>Other Charges</td>
                		    <td><?php echo "-"; ?></td>
                          </tr>
                         <!-- <tr>
                            <td>Panchkarma</td>
                            <td><?//php echo $SNEHAN.", ".$SWEDAN.", ".$VAMAN.",".$VIRECHAN.", ".$BASTI.", ".$NASYA.",".$RAKTAMOKSHAN.",".$SHIRODHARA_SHIROBASTI.", ".$OTHER?></td>
                             <td><?//php if(($SNEHAN!='') || ($SWEDAN !='') || ($VAMAN!='') || ($VIRECHAN!='') || ($BASTI!='') || ($NASYA!='') || ($RAKTAMOKSHAN!='') || ($SHIRODHARA_SHIROBASTI!='') || ($OTHER!='')) { echo "Rs.".$p1=$medicine_cost->opd_panch;} else {echo "-";}?></td>
                    		 <td><?//php if(($SNEHAN!='') || ($SWEDAN !='') || ($VAMAN!='') || ($VIRECHAN!='') || ($BASTI!='') || ($NASYA!='') || ($RAKTAMOKSHAN!='') || ($SHIRODHARA_SHIROBASTI!='') || ($OTHER!='')) { echo "Rs.".$p=$medicine_cost->opd_panch;} else {echo "-";}?></td>
                          </tr>-->
                          
                           <!--<tr>
                             <td>Patho</td>
                            <td><?//php echo $HEMATOLOGICAL.", ".$SEROLOGYCAL.", ".$BIOCHEMICAL.",".$MICROBIOLOGICAL;?></td>
                             <td><?//php if(($HEMATOLOGICAL!='') || ($SEROLOGYCAL !='') || ($BIOCHEMICAL!='') || ($MICROBIOLOGICAL!='')) { echo "Rs.".$pa1=$medicine_cost->ipd_path;} else { $pa1="0"; echo "-";}?></td>
                    		 <td><?//php if(($HEMATOLOGICAL!='') || ($SEROLOGYCAL !='') || ($BIOCHEMICAL!='') || ($MICROBIOLOGICAL!='')) { echo "Rs.".$pa=$medicine_cost->ipd_path;} else { $pa="0"; echo "-";}?></td>
                          </tr>
                          <tr>
                            <td>Investigation I</td>
                            <td><?//php echo $X_RAY;?></td>
                            <td><?//php if($X_RAY!='') { echo "RS.".$i1=$medicine_cost->opd_investigation1;}?></td>
                    		<td></td>
                          </tr>
                    	   <tr>
                            <td>Investigation II</td>
                            <td><?//php echo $ECG;?></td>
                            <td><?//php if($ECG!='') { echo "RS.".$i2=$medicine_cost->opd_investigation2;}?></td>
                    		<td></td>
                          </tr>
                          <?//php if($phy){?>
                          <tr>
                            <td>Physiotherapy</td>
                            <td></td>
                            <td><?//php if($phy!='') { echo "RS.".$phy1=$phy;}?></td>
                    		<td><?//php if($phy!='') { echo "RS.".$phy1=$phy;}?></td>
                          </tr>
                          <?//php }?>-->
                          
                          <tr>
                            <td colspan="2"><b>Grand Total</b></td>
                            
                    		<!--<td><?//php $tt = $ch + $m + $p+ $pa +$i1  + $i2 + $phy; echo "RS. ".$tt; $grandTotal[$i] = $tt;?></td>-->
                    		<td><?php $tt = $ch + $m + $p + $pa; echo "RS. ".$tt; $grandTotal[$i] = $tt;?></td>
                          </tr>
                          <tr>
                            <td colspan="3"><b>In Words <?php echo convertAmount($tt).' Only';?></b></td>
                          </tr>
                        </tbody>
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

<?php

function convertAmount(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}


?>


<script>
    
    $(document).ready(function() {
        $("#billLable").html("Total Bill Amount On <?php echo date('d-m-Y',strtotime($datefrom));?> = <strong> RS. <?php echo array_sum($grandTotal);?> </strong>");
    });
</script>
