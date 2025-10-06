<div class="row">
    <?php echo error_reporting(0);?>
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
              
            </div> 
            <div class="panel-body" style="">
                <div class="row" >
                    <?php
                    $i=0;
                    foreach($patients as $profile){
                        $number= $profile->id;
                        if($i!=0){
                            $style ='style="page-break-before: always;"';
                        }
                        else{
                            $style ='';
                        }
                    ?>
                    
                        <div class="col-sm-6" align="center" <?php echo $style;?>>
                            <div class="col-sm-2" align="center">          </div>
                                
                                <div class="col-sm-8" align="center" >  
                                 <strong><?php echo $this->session->userdata('title') ?></strong>
                                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                                <h1>IPD Case Paper</h1>
                               
                                <br>
                            </div>
                             <div class="col-sm-2" align="center">
                             
                             </div>
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
                            }
                            else if($profile->old_reg_no){
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
                            // patient ipd yearly no
                            $ipd_no_date=date('Y-m-d',strtotime($profile->create_date));
                            $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                            $year122=date('Y',strtotime($profile->create_date));
                            $year2='%'.$year122.'%';
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
                            <div class="col-md-12 col-lg-12 "> 
                                <table style="border-left: 1px solid #333; border-right: 1px solid #333;border-bottom: 1px solid #333;" class="table">
                                
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="table">
                                                
                                                    <tbody>
                                                        <tr>
                                                            <td>NAME :</td>
                                                            <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AGE :</td>
                                                            <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>M/F :</td>
                                                            <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address :</td>
                                                            <td><?php echo $address; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>CONTACT:</td>
                                                            <td><?php echo (!empty($profile->mobile)?$profile->mobile:null) ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>Occupation:</td>
                                                            <td><?php echo (!empty($profile->occupation)?$profile->occupation:$occupation) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Weight:</td>
                                                            <td><?php echo $wieght;?></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td>Doctor:</td>
                                                            <td>
                                                                <?php $depart =$this->db->select("*")
                                                                    ->from('user')
                                                                    ->where('department_id', $profile->department_id) 
                                                                    ->get()
                                                                    ->row();
                                                               // echo $depart->firstname; ?>
                                                            </td>
                                                        </tr>
                                                      
                                                        <tr>
                                                            <td>Dignosis:</td>
                                                            <td><?php echo $profile->dignosis; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>IPD NO.</td>
                                                            <td><?php echo $tot_serial_ipd_change; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>OPD NO.</td>
                                                            <td><?php    
                                                                $ddd= date('Y',strtotime($profile->create_date));
                                                                $yy=substr($ddd,2,2);
                                                                
                                                                
                                                                if($profile->yearly_reg_no != null){
                                                                echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null);
                                                                echo ".".$yy."(New)";
                                                                } else {
                                                                echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                                                echo  ".".$yy."(Old)";
                                                                }  ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Department </td>
                                                            <td><?php $depart =$this->db->select("*")
                                                                
                                                                ->from('department_new')
                                                                ->where('dprt_id', $profile->department_id) 
                                                                ->get()
                                                                ->row();
                                                                echo (!empty($depart->name)?$depart->name:null) ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>BED </td>
                                                            <td><?php $bed_no =$this->db->select("*")
                                                            
                                                            ->from('beds')
                                                            ->where('id', $profile->bedNo) 
                                                            ->get()
                                                            ->row();
                                                            echo (!empty($bed_no->id)?$bed_no->id."   (  ". $bed_no->name.")":null) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>DOA</td>
                                                            <td><?php echo (!empty($profile->create_date)?date('d-m-Y',strtotime($profile->create_date)):null) ?></td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td>DOD</td>
                                                            <td><?php echo (!empty($profile->discharge_date)?$profile->discharge_date:null) ?></td>
                                                        </tr>
                                                       
                                                        <tr rolspan="2">
                                                            <td>M.L.C / NON M.L.C.</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>M.L.C No</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr rowspan="5">
                                                            <td>निष्कर्ष : </td>
                                                            <td ><?php echo $profile->nishkrsh; ?></td>
                                                        </tr>
                                                           
                                                    </tbody >
                                                </table>
                                            </td >
                                        </tr>


                                        <?php
                   $pr =array(12,3,6,9);
                   $pr1=array_rand($pr);
	               $pr[$pr1];
	               
                    $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   if($profile->old_reg_no){
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->old_reg_no)
			                         //->where('create_date like',$current_Y1)
			                         ->where('create_date <= ',date('Y-m-d',strtotime($profile->create_date)))
			                         ->where('ipd_opd ','opd')
			                         ->order_by('id','DESC')
                                     ->get()
                                     ->row();
                                     print_r($this->db->last_query());
                   } else {
                        $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->yearly_reg_no)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                                   //  print_r($this->db->last_query());
                   }
                 $f_date= $adv_date->create_date;
                 $new = $adv_date->yearly_reg_no;
                 ?>
                            
                            
                            
                            
                            
                            
                            
                            <?php       
                                        $che=trim($adv_date->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $adv_date->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }
                                      
                                      $ss=date('Y-m-d',strtotime($adv_date->create_date));
                                  
                                      
                                    if($adv_date->manual_status==0){
                                        if($adv_date->proxy_id){
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$adv_date->proxy_id)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                             //   print_r($this->db->last_query());
                                        }
                                        else
                                        {
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                            if(empty($tretment)){
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$adv_date->department_id)
                                                    ->where('ipd_opd',$adv_date->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
                                    if($adv_date->manual_status=='1' || $adv_date->created_by =='1' || $adv_date->created_by =='2')
                                    {
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                      
                                      $tretment_manual=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
			                      
			                      $RX1_new= $tretment->RX1;
			                      $RX2_new= $tretment->RX2;
			                      $RX3_new= $tretment->RX3;
			                      $RX4_new= $tretment->RX4;
			                      $RX5_new= $tretment->RX5;
			                      
			                      $RX_other_new= $tretment->RX_other;
			                      $RX_other1_new= $tretment->RX_other1;
			                      $other_equipment= $tretment->other_equipment;
			                      
			                      $SNEHAN_new= $tretment->SNEHAN;
			                      $SWEDAN_new= $tretment->SWEDAN;
			                      $VAMAN_new= $tretment->VAMAN;
			                      
			                      $VIRECHAN_new= $tretment->VIRECHAN;
			                      $BASTI_new= $tretment->BASTI;
			                      $NASYA_new= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN_new= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI_new= $tretment->SHIRODHARA_SHIROBASTI;
			                      $SHIROBASTI_new= $tretment->SHIROBASTI;
			                      $OTHER_new= $tretment->OTHER;
			                      
			                      $UTTARBASTI_new= $tretment->UTTARBASTI;
			                      $YONIDHAVAN_new= $tretment->YONIDHAVAN;
			                      $YONIPICHU_new= $tretment->YONIPICHU;
			                      
			                      $SWA1_new= $tretment->SWA1;
			                      $SWA2_new= $tretment->SWA2;
			                      
			                      $HEMATOLOGICAL_new= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCA_newL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL_new= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL_new= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY_new= $tretment->X_RAY;
			                      $ECG_new= $tretment->ECG;
			                      $USG_new= $tretment->USG;
			                      
			                      $symptoms_new= $tretment->sym_name;
			                      $sym1_new= $tretment->sym1;
			                      $sym2_new= $tretment->sym2;
			                      $sym3_new= $tretment->sym3;
			                      $PHYSIOTHERAPY_new= $tretment->PHYSIOTHERAPY;
			                      $c_o=$degis_id;
                                  $cvs ='S1S2 N';
                          $year = $this->session->userdata['acyear'];
                          $ipd_patient = $this->db->select('*')->from('patient_ipd')->where('yearly_reg_no',$profile->yearly_reg_no)->where('year(create_date)',$year)->get()->row();
                          
                          if($ipd_patient->manual_status==0){
                                        if($ipd_patient->proxy_id){
                                            $tretment_ipd=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$ipd_patient->proxy_id)
                                                ->where('department_id',$ipd_patient->department_id)
                                                ->where('ipd_opd ','ipd')
                                                ->get()
                                                ->row();
                                             //   print_r($this->db->last_query());
                                        }
                                        else
                                        {
                                            $tretment_ipd=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$ipd_patient->department_id)
                                                ->where('ipd_opd ','ipd')
                                                ->get()
                                                ->row();  
                                            if(empty($tretment)){
                                                $tretment_ipd=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$ipd_patient->department_id)
                                                    ->where('ipd_opd',$ipd_patient->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment_ipd=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$ipd_patient->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ','ipd')
                                            ->get()
                                            ->row();
                                    }
                                    
                                    if($ipd_patient->manual_status=='1' || $ipd_patient->created_by =='1' || $ipd_patient->created_by =='2')
                                    {
                                        $tretment_ipd=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$ipd_patient->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ','ipd')
                                            ->get()
                                            ->row();
                                      
                                      $tretment_manual=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ','ipd')
                                            ->get()
                                            ->row();
                                    }
                            ?>

                                       <!-- <tr>
                                            <td  colspan="2">प्रमुख वेदना: </td>
                                          
                                            <td><?php echo $profile->compliance?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">वर्तमान व्याधीवृत्त : </td>
                                            <td><?php echo $profile->vyadhi?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td colspan="2"><!--कुल वृत्त :H/O:   <?//php echo $h_o;?> </td>
                                          <!--  <td></td>
                                        </tr>-->
                                      
                                       <!-- <tr>
                                            <td colspan="2"><!--कुल वृत्त  Family history:    <?//php echo $f_h;?>   </td>
                                       <!--     <td></td>
                                        </tr> -->
                                      
                                        <tr>
                                            <td colspan="2">
                                                <table class="table">
                                                    <tbody>
                                                         <!-- <tr>
                                                            <td>नाडी:      <?php echo $nadii; ?> </td>
                                                            <td>जिव्हा:   <?php echo $givwa;?></td>
                                                            <td>रक्तदाब:    <?php echo $bp;?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>मल :   <?php echo $mal;?></td>
                                                            <td>शब्द :   <?php echo $profile-shabhd;?> </td>
                                                          <td>वजन : <?php echo $profile->wieght;?></td>-->
                                                      <!--  </tr>
                                                        <tr>
                                                            <td>मुत्र: <?php echo $mutra;?>   </td>
                                                            <td>स्पर्श:  <?php echo $profile->parsh;?> </td>
                                                            <td>आकृती :   <?php echo $profile->akruti;?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>श्वसन:  <?php echo $profile->shwsan;?> </td>
                                                            <td>दृक:    <?php echo $profile->dk;?> </td>
                                                            <td>तापमान :   <?php echo $profile->tapman;?></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table> -->

                                                <table class="table" >
                                <tbody>
                                    <tr>
                                        <td colspan="2">रुग्ण नाम :  <span style="font-weight: bold;">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                    
                                    </tr>
                                    
                                    <tr>
                                        <td>1.	वेदना विशेष व काल (Chief Complains with duration )</td>
                                        <td>:<span style="font-weight: bold;"> <?php if($result4->sym_name){ echo  $result4->sym_name;}else { echo $symptoms; }  ?></span></td>
                                    </tr>
                                   
                                    <tr>
                                        <td> 2.इतिहास (History)</td>
                                        <td>:<span style="font-weight: bold;"> <?php   if($result4->h_o) { echo $result4->h_o;} else { echo $opd_data->f_h;}  ?></span></td></td>
                                    </tr>
                                    <tr>
                                        <td>  ii)पूर्व इतिहास / शस्त्रकर्म इतिहास </td>
                                        <td>:<?php if($result4->surgical_history){ echo $result4->surgical_history;} else{ echo $opd_data->h_o; }  ?></td>
                                    </tr>
                                    <tr>
                                        <td>( History of Pastillness / Surgical History)  </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td> iii)कौटुंबिक इतिहास</td>
                                        <td>:  <span style="font-weight: bold;"> <?php echo  $f_h=$opd_data->f_h;  ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Family History</td>
                                        <td> </td>
                                    </tr>
                          <?php if($profile->department_id !='30'){ ?>
                                    <tr>
                                        <td> iv)रज प्रवृत्ती इतिहास</td>
                                        <td>: <span style="font-weight: bold;">      <?php  $t = $profile->date_of_birth; if($profile->sex=='F') {  if (($t <= "48")   && ($t >="15")) { echo $profile->raj; } }  else { echo "-";}?></span></td>
                                    </tr>
                                    <tr>
                                        <td> व्यक्तिगत इतिहास </td>
                                        <td>:  व्यवसाय -    <span style="font-weight: bold;"><?php echo $occupation; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>  </td>
                                        <td>: सामाजिक आर्थिक स्थिती  -<span style="font-weight: bold;"> <?php  echo $profile->samajik; ?>     </span> </td>
                                    </tr>
                                    <tr>
                                        <td>  </td>
                                        <td>: आहार    -<span style="font-weight: bold;">     <?php if($result4->ahar){ echo $result4->ahar;}else{ echo $profile->aharfood; } ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td>  </td>
                                        <td>:  आहार घटक मात्रा   -<span style="font-weight: bold;">  <?php  echo $profile->aharghatak; ?>    </span></td>
                                    </tr>
                                    <tr>
                                        <td style="float: right;"> निद्रा  </td>
                                        <td>: <span style="font-weight: bold;">  <?php if($result4->nidra1) { echo $result4->nidra1;} else { echo $profile->nidtra; } ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td style="float: right;">  व्यसन </td>
                                      
                                        <td>: <span style="font-weight: bold;">
                                          
                                          <?php
                                          if($profile->department_id =='32' || $profile->department_id =='29' || $profile->sex == 'F')
                                          { echo '-'; }else{
                                          if($result4->vyasan){echo $result4->vyasan;}else { echo $profile->vyasan; }
                                          }
                                          ?>
                                          
                                          </span> </td>
                                    </tr>
                                    <tr>
                                        <td style="float: right;">   मुत्र प्रवृत्ती</td>
                                        <?php
                                            $str =  $profile->mutrapra;
                                            $a=explode("-",$str);
                                        ?> 
                                       <!-- <td>: <span style="font-weight: bold;"> <?php  echo $a[0]; ?>  </span>   <span style="font-weight: bold;"> <?php  echo    $mutra; ?>   </span></td>-->
                                        <?php if($profile->department_id !='31'){ ?>
                                      <td>:  संख्या-<span style="font-weight: bold;"> <?php  echo $a[0]; ?>  </span>   वर्ण -<span style="font-weight: bold;"> <?php  echo     $a[1]; ?>   </span></td>
                                   <?php } else {?>
                                      <td><?php echo $str; ?></td>
                                      <?php } ?>
                          </tr>
                                    <tr>
                                        <td style="float: right;"> (Urine ) संबंधित लक्षण </td>
                                        <td>: <span style="font-weight: bold;">  <?php if($result4->urine){ echo $result4->urine;} elseif($profile->urine=='NILL') { echo 'NIL';}  else { echo $profile->urine;} ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td style="float: right;">  पुरीष प्रवृत्ती </td>
                                        <?php
                                            $str =  $profile->purushpra;
                                            $a1=explode("-",$str);
                                        
                                        ?> 
                                        <td>:  <span style="font-weight: bold;"> <?php if($result4->purish_pravrutti) {echo $result4->purish_pravrutti;}else{ echo $profile->purushpra; } ?>   </span>    </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="float: right;"> (Stool)   संबंधित लक्षण  </td>
                                        <td>:<span style="font-weight: bold;">   <?php if($result4->stool){  echo $result4->stool;} ?> </span></td>
                                    </tr>
                          			<?php if($profile->department_id !='29'){ ?>
                                    <tr>
                                        <td style="float: right;">      अपानवायू</td>
                                        <td>: <span style="font-weight: bold;">    <?php if($result4->apanvayu){ echo $result4->apanvayu; }else{  echo $profile->apanwayu;} ?></span> </td>
                                    </tr>
                          <?php } ?>
                                    <tr>
                                        <td style="float: right;"> कोष्ठ</td>
                                        <td>: -<span style="font-weight: bold;">   <?php if($result4->koshth){ echo $result4->koshth; }else{ echo $profile->koshth;} ?></span>  </td>
                                    </tr>
                          
                          <?php } ?>
                                    <tr>
                                        <td> 3.	सामान्य आतुर परीक्षा </td>
                                        <td>प्रकृती: -<span style="font-weight: bold;">   
                                        <?php if($result4->prakruti){ echo $result4->prakruti; }else{  echo $profile->samanyaatur;} ?> </span>  </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  तापमान -<span style="font-weight: bold;">   <?php  if($result4->tapman) {echo 'Temp :'.$result4->tapman.'ºF<br>';} else{ echo $profile->tap.' °F';} ?>
                                        </span><br>: रक्तदाब -
                                          <span style="font-weight: bold;">
                                            <?php if($profile->department_id == '32'){ ?>
                                            <?php if($result4->bp) {   echo $result4->bp.' mm of Hg'; } else { echo '-'; } ?> 
                                          <?php } else { ?>
                                            <?php if($result4->bp) {   echo $result4->bp; }  else { echo $bp; }?> mm of Hg
                                            <?php } ?>
                                          </span>
                                          
                                      </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  नाडी   - 
                                        <span style="font-weight: bold;"> 
                                        <?php  if( $result4->nadi){echo $result4->nadi;} else { echo $pulse; } ?></span>
                                        &nbsp;&nbsp;&nbsp; &nbsp;
                                        वजन  :   <span style="font-weight: bold;"><?php echo $wieght; ?> Kg.</span></td>
                                    </tr>
                            <?php if($profile->department_id !='30'){ ?>
                                    <tr>
                                        <td> </td>
                                        <td>:  शरीरप्रमाण  -<span style="font-weight: bold;">
                                             <?php if($result4->shariripraman){ echo $result4->shariripraman; } else {  echo $profile->sharir;} ?>  </span></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  आहारशक्ती    -<span style="font-weight: bold;">
                                               <?php if($result4->aharshakti) { echo $result4->aharshakti;} else { echo $profile->aharshakti; } ?> </span> </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  व्यायाम शक्ती  -<span style="font-weight: bold;">
                                             <?php if($result4->vyayam_shakti){  echo $result4->vyayam_shakti;} else { echo $profile->vyamshakti; } ?>   </span></td>
                                    </tr>
                          <?php } ?>
                                    <tr>
                                        <td style="padding-left: 23px;">अष्टविध परीक्षा </td>
                                        <td>:   नाडी - <span style="font-weight: bold;">
                                             <?php  if($result4->nadi){echo $result4->nadi;}else {echo $nadi;}?></span> &nbsp;&nbsp;&nbsp; &nbsp;   </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  मुत्र - 
                                        <span style="font-weight: bold;"> <?php if($result4->ashthvidh_psriksha_mutra){ echo $result4->ashthvidh_psriksha_mutra;}else{ echo $mutra;}?></span> &nbsp;&nbsp;&nbsp; &nbsp;  </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:   मल  - <span style="font-weight: bold;"> <?php if($result4->mal){ echo  $result4->mal;} else{ echo $mal;}?></span>&nbsp;&nbsp;&nbsp; &nbsp;  </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <?php if($profile->manual_status == '1'){ ?>
                                        <td>:  जिद्द्वा  - <span style="font-weight: bold;"> <?php echo $result4->givwa;?></span>&nbsp;&nbsp;&nbsp; &nbsp;   </td>
                                        <?php } else{ ?>
                                        <td>:  जिद्द्वा  - <span style="font-weight: bold;"> <?php echo $givwa;?></span>&nbsp;&nbsp;&nbsp; &nbsp;   </td>
                                        <?php } ?>
                                      
                                    </tr>
                             <?php if($profile->department_id =='30'){ ?>
                          				<tr>
                                        <td> </td>
                                        <td>:  नेत्र (V/A)  - <span style="font-weight: bold;"></span>&nbsp;&nbsp;&nbsp; &nbsp;   </td>
                                    </tr>
                          <?php } ?>
                                    <tr>
                                        <td> 4.	संप्राप्ती घटक</td>
                                        <td>: <span style="font-weight: bold;">  
                                        <?php if($result4->samprapti_ghatak) { echo $result4->samprapti_ghatak; }else{  echo $tretment->SROTAS.' '.$tretment->DOSHA.' '.$tretment->DUSHYA;} ?></span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 23px;"> वर्तमान वेदना इतिहास</td>
                                        <td>:  <span style="font-weight: bold;"> <?php if($result4->sym_name){ echo  $result4->sym_name; } else{ echo $tretment->sym_name; } ?></span> </td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>:    </td>
                                    </tr>
                                    <tr>
                                        <td>   </td>
                                        <td>:   </td>
                                    </tr>
                                    <tr>
                                        <td>५. विशेष स्त्रोतस परीक्षा</td>
                                        <td>:<span style="font-weight: bold;"> 
                                        <?php if($result4->vishesh_shtrots_pariksha){ echo $result4->vishesh_shtrots_pariksha; }else{ echo $tretment->SROTAS;} ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>  ६. नैदानिक परीक्षा </td>
                                        <td>: 
                                            
                                             <?php if($profile->manual_status =='1') { ?>
                                            <b></b><?php echo  $result4->naidanik_pariksha; ?>
                                            <?php } else {?>
                                                <?php  if($HEMATOLOGICAL)
                                             { echo $HEMATOLOGICAL.",";}
                                              if($SEROLOGYCAL)
                                              { echo $SEROLOGYCAL.",";} 
                                              if($BIOCHEMICAL) 
                                              { echo $BIOCHEMICAL.",";} 
                                              if($MICROBIOLOGICAL)
                                               { echo $MICROBIOLOGICAL.",";}
                                                if($X_RAY)
                                                 { echo $X_RAY.",";}
                                                  if($ECG)
                                                   { echo $ECG.",";}
                                                    if($USG)
                                                    { echo $USG;}?>
                                            
                                            <?php if($Sp_Investigations_pandamic)
                                            {  echo "<br>=>".$ex_spe_invet[0];echo "<br>"; echo ""; 
                                            if($ex_spe_invet[1])
                                             { echo "=>".$ex_spe_invet[1].'<br>'; } 
                                             }?>
                                                <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> ७. व्यवछेदक निदान </td>
                                        <td>:<span style="font-weight: bold;"><?php if($result4->vyavched_nidan) {echo  $result4->vyavched_nidan;} else{ echo $tretment->POVISIONALdignosis; }  ?></span></td>
                                    </tr>
                                    <tr>
                                        <td> 8. व्याधी विनीश्चय    </td>
                                        <td>: <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:$result4->vyadhi_vinishray) ?></span></td>
                                    </tr>
                                    
                                    <tr>
                                        <td> दिनांक  : <span style="font-weight: bold;">
                                            <?php  
                                            if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                            {
                                                echo date("d-m-Y",strtotime($date_f5));
                                            }
                                            else
                                            {
                                               echo date('d-m-Y',strtotime($profile->create_date)); 
                                            }
                                            ?> </span></td>
                                        <td style="padding-left: 215px;">हस्ताक्षर : </td>
                                    </tr>
                                </tbody>
                            </table>
                                                 <table class="table">
                             <thead>
                                <th style="border-left: 1px solid #333; border-right: 1px solid #333; width:90px;">दिनांक </th>
                                <th style="border-right: 1px solid #333;"> लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
                            </thead>
                            
                            
                            
                            
                              <?php
                   $pr =array(12,3,6,9);
                   $pr1=array_rand($pr);
	               $pr[$pr1];
	               
                    $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   if($profile->old_reg_no){
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->old_reg_no)
			                         //->where('create_date like',$current_Y1)
			                         ->where('create_date <= ',date('Y-m-d',strtotime($profile->create_date)))
			                         ->where('ipd_opd ','opd')
			                         ->order_by('id','DESC')
                                     ->get()
                                     ->row();
                                     print_r($this->db->last_query());
                   } else {
                        $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->yearly_reg_no)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                                   //  print_r($this->db->last_query());
                   }
                 $f_date= $adv_date->create_date;
                 $new = $adv_date->yearly_reg_no;
                 ?>
                            
                            
                            
                            
                            
                            
                            
                            <?php       
                                        $che=trim($adv_date->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $adv_date->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }
                                      
                                      $ss=date('Y-m-d',strtotime($adv_date->create_date));
                                  
                                      
                                    if($adv_date->manual_status==0){
                                        if($adv_date->proxy_id){
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$adv_date->proxy_id)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                             //   print_r($this->db->last_query());
                                        }
                                        else
                                        {
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                            if(empty($tretment)){
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$adv_date->department_id)
                                                    ->where('ipd_opd',$adv_date->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
                                    if($adv_date->manual_status=='1' || $adv_date->created_by =='1' || $adv_date->created_by =='2')
                                    {
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                      
                                      $tretment_manual=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
			                      
			                      $RX1_new= $tretment->RX1;
			                      $RX2_new= $tretment->RX2;
			                      $RX3_new= $tretment->RX3;
			                      $RX4_new= $tretment->RX4;
			                      $RX5_new= $tretment->RX5;
			                      
			                      $RX_other_new= $tretment->RX_other;
			                      $RX_other1_new= $tretment->RX_other1;
			                      $other_equipment= $tretment->other_equipment;
			                      
			                      $SNEHAN_new= $tretment->SNEHAN;
			                      $SWEDAN_new= $tretment->SWEDAN;
			                      $VAMAN_new= $tretment->VAMAN;
			                      
			                      $VIRECHAN_new= $tretment->VIRECHAN;
			                      $BASTI_new= $tretment->BASTI;
			                      $NASYA_new= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN_new= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI_new= $tretment->SHIRODHARA_SHIROBASTI;
			                      $SHIROBASTI_new= $tretment->SHIROBASTI;
			                      $OTHER_new= $tretment->OTHER;
			                      
			                      $UTTARBASTI_new= $tretment->UTTARBASTI;
			                      $YONIDHAVAN_new= $tretment->YONIDHAVAN;
			                      $YONIPICHU_new= $tretment->YONIPICHU;
			                      
			                      $SWA1_new= $tretment->SWA1;
			                      $SWA2_new= $tretment->SWA2;
			                      
			                      $HEMATOLOGICAL_new= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCA_newL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL_new= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL_new= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY_new= $tretment->X_RAY;
			                      $ECG_new= $tretment->ECG;
			                      $USG_new= $tretment->USG;
			                      
			                      $symptoms_new= $tretment->sym_name;
			                      $sym1_new= $tretment->sym1;
			                      $sym2_new= $tretment->sym2;
			                      $sym3_new= $tretment->sym3;
			                      $PHYSIOTHERAPY_new= $tretment->PHYSIOTHERAPY;
			                      $c_o=$degis_id;
                                  $cvs ='S1S2 N';
                          $year = $this->session->userdata['acyear'];
                          $ipd_patient = $this->db->select('*')->from('patient_ipd')->where('yearly_reg_no',$profile->yearly_reg_no)->where('year(create_date)',$year)->get()->row();
                          
                          if($ipd_patient->manual_status==0){
                                        if($ipd_patient->proxy_id){
                                            $tretment_ipd=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$ipd_patient->proxy_id)
                                                ->where('department_id',$ipd_patient->department_id)
                                                ->where('ipd_opd ','ipd')
                                                ->get()
                                                ->row();
                                             //   print_r($this->db->last_query());
                                        }
                                        else
                                        {
                                            $tretment_ipd=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$ipd_patient->department_id)
                                                ->where('ipd_opd ','ipd')
                                                ->get()
                                                ->row();  
                                            if(empty($tretment)){
                                                $tretment_ipd=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$ipd_patient->department_id)
                                                    ->where('ipd_opd',$ipd_patient->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment_ipd=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$ipd_patient->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ','ipd')
                                            ->get()
                                            ->row();
                                    }
                                    
                                    if($ipd_patient->manual_status=='1' || $ipd_patient->created_by =='1' || $ipd_patient->created_by =='2')
                                    {
                                        $tretment_ipd=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$ipd_patient->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ','ipd')
                                            ->get()
                                            ->row();
                                      
                                      $tretment_manual=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ','ipd')
                                            ->get()
                                            ->row();
                                    }
                            ?>
                            <tbody>
                                 <tr>
                                     <td style="border-left: 1px solid #333; border-right: 1px solid #333;"> <?php  
                                            if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                            {
                                                echo date("d-m-Y",strtotime($date_f5));
                                            }
                                            else
                                            {
                                               echo date('d-m-Y',strtotime($profile->create_date)); 
                                            }
                                            ?></td>
                                     <td style="border-right: 1px solid #333;">
                                     <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                     <b> C/O :  </b><?php if($tretment_ipd->sym_name) { echo $tretment_ipd->sym_name;} else {  if($symptoms_new){ echo $symptoms_new;} else { echo $tretment_ipd->sym_name;}}?><br>
                                     <b> H/O : </b>
                                       <?php if($profile->department_id !='29'){ ?>
                                       <?php if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}?>
                                       <?php } ?>
                                       <br>
                                     <b> Family History : </b> <?php if($tretment->f_o) { echo $tretment->f_o;}else { echo $adv_date->f_h;}?><br>
                                    
                                    <?php 
                                        $temp1 = explode('-', $tretment->e_o);
                                        $temp_1 = $temp1[0];
                                        if(count($temp1)>1){
                                            $temp2 = explode(',', $temp1[1]);
                                            $rand_val = array_rand($temp2);
                                            $temp_2 = $temp2[$rand_val];
                                        }else{
                                            $temp_2 = '';
                                        }
                                    ?>
                                       
                                       
                                        <?php 
                                  if($adv_date->department_id =='29'){
                                  
                                  if($tretment->LMP || $tretment->NO_OF_DAYS ||$tretment->PATTERN ||$tretment->FLOW) {?>
                                      <b> M/H : </b><?php if($tretment->LMP){ echo $tretment->LMP; } ?>
                                       <?php if($tretment->NO_OF_DAYS){ echo $tretment->NO_OF_DAYS; } ?>
                                       <?php if($tretment->PATTERN){ echo $tretment->PATTERN; } ?>
                                       <?php if($tretment->FLOW){ echo $tretment->FLOW; } ?>
                                      
                                     <?php }else
                                     {
                                      echo "<b> M/H : <br>LMP Date : ";echo date("d-m-Y",strtotime($adv_date->lmp)).'<br>'; 
                                      echo "EDD Date : "; echo date("d-m-Y",strtotime($adv_date->edd));
                                     }

                                     
                                     } ?>
                                       
                                       <?php 
                                  if($adv_date->department_id =='29'){
                                  if($tretment->Obstetric_History || $tretment->Marita_Status ||$tretment->Marital_years) {?>
                                      <b> O/H : </b><?php if($tretment->Obstetric_History){ echo $tretment->Obstetric_History; } ?><br>
                                       <?php if($tretment->Marita_Status){ echo $tretment->Marita_Status; } ?><br>
                                       <?php if($tretment->Marital_years){ echo $tretment->Marital_years; } ?><br>
                                       
                                     <?php } } ?>
                                       <?php if($adv_date->department_id =='29'){ ?>
                                          <!--<b>M/H. :- <?php if($tretment->h_o){ echo $tretment->h_o; } ?></b>
                                          <br>
                                          <b>O/H. :-</b>-->
                                          <?php }?><br>
                                            <?php 
                                  if($adv_date->department_id =='29'){ 
                                    ?>
                                         <?php 
                                  
                                  
                                  if($adv_date->department_id =='29'){ 
                                    ?>
                                       <?php
                                   // echo $adv_date->;
                                         if($adv_date->dignosis =='SHWETA PRADAR  - SR ' || $adv_date->dignosis =='SHWETA PRADAR' || $adv_date->dignosis =='SHWETA PRADAR - SR' || $adv_date->dignosis =='SHWETAPRADAR-SRI' || $temp_patient->dignosis =='SHWETAPRADAR-SRI'){  ?>
                                       P/S/ :- Cx, Vg - Healthy
      White discharge ++
       No foul smell
<br>
                                      P/V. :- Ut- AV, N.S.
           Fornices clear, non tender <br>
                                       <?php }  } ?>
                                       
                                       <?php
                                         if($adv_date->dignosis =='YONIBHRANSHA-SRI' || $adv_date->dignosis =='YONIBHRANSHA' || $adv_date->dignosis =='YONIBHRANSH'){  ?>
                                       P/S/V. :- 1° Prolapes<br>Not Willing To Operate<br>
                                       <?php }  } ?>
<?php if($adv_date->department_id != '29'){ ?>
                                    <b><?php if($tretment->e_o) { ?> </b><?php echo 'E/O: '.$temp_1." - ".$temp_2;?> <?php }?><br>
                                  <?php } ?>    

                                     <b> O/E-</b><br>
                                       <?php if($profile->department_id == '32'){ ?>
                                     <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                      BP : 
                                      <?php if($tretment_manual->bp) { echo $tretment_manual->bp,"   mm of Hg";} ?><br>
                                       <?php }else{ ?>
                                        BP : 
                                      <?php if($tretment->bp) { echo $tretment->bp,"   mm of Hg";} else { echo $adv_date->bp,"   mm of Hg";}?><br>
                                       <?php } ?>
                                    <?php  if($tretment->temp) { ?>
                                      Temp : 
                                      <?php if($tretment->temp) { echo $tretment->temp;}?><br>
                                      <?php } ?>
                                      Pulse : 
                                      <?php if($tretment->pulse) { echo $tretment->pulse." /min";} else { echo 	          $adv_date->pulse." /min";} ?><br>
                                      नाडी : 
                                      <?php if( $tretment->nadi){ echo $tretment->nadi;}else { echo $adv_date->nadi; }?><br>
                                      S/E :-<br>
                                      RS : 
                                      <?php if($tretment->rs) { echo $tretment->rs; } else {  echo $adv_date->ur;}?><br>  
                                      CVS : 
                                      <?php if( $tretment->cvs) { echo  $tretment->cvs; } else { echo $adv_date->cvs;}?><br>
                                       CNS : 
                                      <?php echo 'CONSCIOUS , ORIENTED'; ?><br>
                                      P / A : 
                                      <?php 
                                      if($tretment->pa) 
                                        { 
                                            echo  $tretment->pa;
                                        }
                                       else 
                                       { 
                                            echo 'SOFT NT';
                                       }
                                       ?><br>

                                         P / V : 
                                      <?php 
                                      if($tretment->pv) 
                                        { 
                                            echo  $tretment->pv;
                                        }
                                       else 
                                       { 
                                            echo 'SOFT NT';
                                       }
                                       ?><br>
                                      <?php
                                       if($adv_date->department_id =='29'){ ?>
                                       <?php 
                                     if($adv_date->dignosis =='ANARTAV-SR' || $adv_date->dignosis =='ANARTAV' && $adv_date->proxy_id =='1'){ ?>
                                       UPT :- Negative<br>
                                       <? }  }?>

                                       <?php  if($adv_date->dignosis =='ANARTAV-SR' || $adv_date->dignosis =='ANARTAV' && $adv_date->proxy_id =='2'){ ?>
                                       O/H :- G3P1L1A1 <br>
                                        L1- female, LSCS<br>
                                        A1- D and E done<br>
                                        G3- P.P<br>
                                       <?php } ?>
                                       <?php
                                       if($adv_date->department_id =='29'){ 
                                       ?>
                                       
                                       <?php   if($adv_date->dignosis =='STANAGRANTI' || $adv_date->dignosis =='STANAGRANTI-SR'){ ?>
                                       L/E - Right breast - 2 immobile lumps , tenderness ++, inflammation +.
Left breast- NAD<br>
                                       <?php } } ?>
                                       
                                      <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                      <?//php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                      
                                    नेत्र
                                    : <?php  if($tretment->netra){ echo  $tretment->netra;} else { echo $adv_date->netra;}?><br>    
                                    जिव्हा
                                    : <?php if(  $tretment->giv){ echo  $tretment->givwa;} else { echo  $adv_date->givwa;}?><br>
                                    क्षुधा
                                    : <?php if($tretment->shudha){ echo  $tretment->shudha;} else{ echo  $adv_date->shudha;}?>
                                    <br>
                                    आहार : 
                                    <?php  if($tretment->ahar) { echo $tretment->ahar;} else { echo   $adv_date->ahar;}?><br> 
                                    मल : 
                                    <?php if($tretment->mal) { echo  $tretment->mal;}else { echo  $adv_date->mal;}?><br>
                                    मूत्र
                                    : <?php if(!empty($tretment->mutra)){ echo $tretment->mutra;} else { echo  $adv_date->mutra;}?><br>
                                    निद्रा
                                    : <?php if($tretment->nidra){ echo $tretment->nidra;} else  { echo $adv_date->nidra;}?>
                                    </td>
                                     
                                    <td style="border-right: 1px solid #333;">
                                    <?php if($New_OPD) {?> <span style="float:right;color: #ff000d;background-color: #eae4e4;"><?php  echo "<b>Admit the Patient in IPD ". (!empty($adv_date->name)?$adv_date->name:null).' Department Ward No. '.$ward.'</b>';?></span> <?php } else {?>
                                     
                                     <b> RX - </b> 
                                        <?php if($RX1_new) {echo "<br>";echo "=>".$RX1_new;echo "<br>";}?><br>
                                        <?php if($RX2_new) { echo '=> '.$RX2_new;echo "<br>";}?><br>
                                        <?php if($RX3_new) { echo '=> '.$RX3_new;echo "<br><br>";}?>
                                        <?php if($RX4_new) { echo '=> '.$RX4_new;echo "<br><br>";}?>
                                        <?php if($RX5_new) { echo '=> '.$RX5_new;echo "<br><br>";}?>
                                        <?php if($RX_other_new) { echo '=> '.$RX_other_new;echo "<br><br>";}?>
                                        <?php if($RX_other1_new) { echo '=> '.$RX_other1_new;echo "<br><br>";}?>
                                        <?php if($other_equipment) { echo '=> '.$other_equipment;echo "<br><br>";}?>
                                       
                                        <br><br>
                                        
                                      <?php if(($SNEHAN_new) || ($SWEDAN_new) || ($VAMAN_new) || ($VIRECHAN_new) || ($BASTI_new) || ($NASYA_new) || ($RAKTAMOKSHAN_new) || ($SHIRODHARA_SHIROBASTI_new) || ($SHIROBASTI_new) || ($UTTARBASTI_new) || ($YONIDHAVAN_new) || ($YONIPICHU_new) || ($OTHER_new) || ($SWA1_new) || ($SWA2_new)){?>
                                       <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN_new){  echo $SNEHAN_new.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN_new){  echo $SWEDAN_new.'<br>'; }?>
                                    
                                       <?php  if($VAMAN_new){  echo $VAMAN_new.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN_new){  echo $VIRECHAN_new.'<br>'; }?>
                                      
                                        <?php  if($BASTI_new){  echo $BASTI_new.'<br>'; }?>
                                     
                                       <?php  if($NASYA_new){  echo $NASYA_new.'<br>'; }?>
                                     
                                       <?php  if($RAKTAMOKSHAN_new){  echo $RAKTAMOKSHAN_new.'<br>'; }?>
                                    
                                       <?php  if($SHIRODHARA_SHIROBASTI_new){  echo $SHIRODHARA_SHIROBASTI_new.'<br>'; }?>
                                       
                                       <?php  if($SHIROBASTI_new){  echo $SHIROBASTI_new.'<br>'; }?>
                                    
                                       <?php  if($OTHER_new){  echo $OTHER_new.'<br>'; }?>
                                       
                                       <?php  if($UTTARBASTI_new){  echo $UTTARBASTI_new.'<br>'; }?>
                                     
                                       <?php  if($YONIDHAVAN_new){  echo $YONIDHAVAN_new.'<br>'; }?>
                                     
                                       <?php  if($YONIPICHU_new){  echo $YONIPICHU_new.'<br>'; }?>
                                     
                                       <?php  if($SWA1_new){  echo $SWA1_new.'<br>'; }?>
                                    
                                       <?php  if($SWA2_new){  echo $SWA2_new.'<br>'; }?>
                                       
                                        <?php }?>
                                      
                                      <?php if(($HEMATOLOGICAL_new) || ($SEROLOGYCAL_new) || ($BIOCHEMICAL_new) || ($MICROBIOLOGICAL_new) || ($X_RAY_new) || ($ECG_new) || ($USG_new) || ($PHYSIOTHERAPY_new)){?>
                                       <b> Adv- </b><br>
                                     
                                       <?php  if($HEMATOLOGICAL_new){  echo $HEMATOLOGICAL_new.'<br>'; }?>
                                     
                                       <?php  if($SEROLOGYCAL_new){  echo $SEROLOGYCAL_new.'<br>'; }?>
                                     
                                       <?php  if($BIOCHEMICAL_new){  echo $BIOCHEMICAL_new.'<br>'; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL_new){  echo $MICROBIOLOGICAL_new.'<br>'; }?>
                                     
                                       <?php  if($X_RAY_new){  echo $X_RAY_new.'<br>'; }?>
                                      
                                       <?php  if($ECG_new){  echo $ECG_new.'<br>'; }?>
                                     
                                       <?php  if($USG_new){  echo $USG_new.'<br>'; }?>
                                       
                                       <?php if($PHYSIOTHERAPY_new){ 
                                            $day = date('D',strtotime($profile->create_date)); 
                                            if($day == 'Mon' || $day == 'Thu'){
                                                echo $PHYSIOTHERAPY_new.'<br>';
                                            }
                                           }
                                        ?>
                                       
                                       <?php } }?>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                                           </td>
                                            <td></td>
                                        </tr>
                                       <!-- <tr>
                                            <td colspan="2">उर  परीक्षण :<?php echo $ur;?></td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">उदर परीक्षण: <?php echo $udar;?></td>
                                            <td></td>
                                        </tr>
                                                                  
                                        <tr>
                                            <td colspan="2">स्त्रोतस परीक्षण :</td>
                                            <td><?php echo $profile->strot_parishwan;?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td colspan="2">चिकित्सा सूत्र :  </td>
                                            <td><?php echo $profile->chiki_sutra;?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">चिकित्सा : </td>
                                            <td><?php echo $profile->checkup;?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td colspan="2">तपासणी : </td>
                                            <td><?php echo $profile->udar;?></td>
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php $i=$i+1;}?> 
                </div> 
            </div> 
            <div class="panel-footer">
                <div class="text-center">
                </div>
            </div>
        </div>
    </div>
</div>

