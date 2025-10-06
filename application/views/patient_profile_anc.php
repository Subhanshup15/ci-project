
<?php error_reporting(0);//echo error_reporting(0);?>
<div class="row">
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group"> 
                    <?php $id=$this->uri->segment(3);?>
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/opd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
                <div class="btn-group"> 
                    <?php $id=$this->uri->segment(3);?>
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/opd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>
                <div class="btn-group" <?php if($profile->discharge_date =='0000-00-00')?>> 
                    <a class="btn btn-default" href="<?php echo base_url("patients/profile_bill/$id") ?>"> <i class="fa fa-list-alt"></i> Bill Receipt</a>   
                </div>
            </div> 
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
                        <h1>ANC REGISTER</h1><br>
                    </div>
            <div class="col-xs-2"></div>
            </div>
            </div>
                    <div class="col-md-12 col-lg-12 " > 
                        <table class="table" style="border: 1px solid #333;">
                            <tr>
                                <td style="width: 161px;font-weight: bold;border-top: 1px solid #333;">C-OPD Case No:</td>
                                <td style="border-top: 1px solid #333;">
                                <?php
                                    $y=date('Y',strtotime($profile->create_date));
                                    if($y=='1970'){
                                        $yy=20;
                                    }else{
                                        $yy=substr($y,2,2);
                                    }
                                    if($profile->yearly_reg_no != null){
                                        echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null);
                                        echo ".".$yy."(New)";
                                    } else {
                                        echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                        echo  ".".$yy."(Old)";
                                    }
                                ?>
                                </td>
                                <td style="font-weight: bold;border-top: 1px solid #333;">O.H.:</td>
                                <td style="border-top: 1px solid #333;"></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Patients Name:</td>
                                <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                <td style="font-weight: bold;">LMP:</td>
                                <td><?php echo $profile->lmp;?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="font-weight: bold;">EDD:</td>
                                <td><?php echo $profile->edd;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- <hr style="border-color: brown;">-->
                <?php
                    $pr =array(12,3,6,9);
                    $pr1=array_rand($pr);
                    $pr[$pr1];
                    
                    if($profile->old_reg_no){
                        $opd_no = $profile->old_reg_no;
                    } else {
                        $opd_no = $profile->yearly_reg_no;
                    }
                    $c_year = $this->session->userdata['acyear'];
                    $p_year = $this->session->userdata['acyear']-1;
                    $this->db->where('old_reg_no !=','');
                    $this->db->where('old_reg_no',$opd_no);
                    $this->db->where(['create_date>='=>$c_year.'-01-01', 'create_date<='=>$c_year.'-12-31']);
                    $this->db->or_where('yearly_reg_no !=','');
                    $this->db->where('yearly_reg_no',$opd_no);
                    $this->db->where(['create_date>='=>$c_year.'-01-01', 'create_date<='=>$c_year.'-12-31']);
                    $this->db->order_by('create_date','ASC');
                    $result = $this->db->get('patient')->result();
                    
                    //print_r($result);

                ?>
                <?php foreach($result as $patient): ?>
                    
                    <?php if($patient->yearly_reg_no){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th style="border: 1px solid #333; width:10%;">Date </th>
                                        <th style="border: 1px solid #333; width:40%;"> Chief Complaints    </th>
                                        <th style="border: 1px solid #333; width:25%;">Treatment </th>
                                        <th style="border: 1px solid #333; width:25%;">Investigation </th>
                                    </thead>
                                    <?php 
                                        $che=trim($patient->dignosis);
                                        $section_tret='opd';
                                        $len=strlen($che);
                                        $dd= substr($che,$len - 1);
                                        $str = $patient->dignosis;
                                        $arry=explode("-",$str);
                                        $t_c=count($arry);
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                        }
                                        if($patient->manual_status==0){
                                            if($patient->proxy_id){
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('proxy_id',$patient->proxy_id)
                                                    ->where('department_id',$patient->department_id)
                                                    ->where('ipd_opd ',$section_tret)
                                                    ->get()
                                                    ->row();
                                            }
                                            else{
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('department_id',$patient->department_id)
                                                    ->where('ipd_opd ',$section_tret)
                                                    ->get()
                                                    ->row();  
                                                // if(empty($tretment)){
                                                //     $tretment=$this->db->select("*")
                                                //         ->from('treatments1')
                                                //         ->where('department_id',$patient->department_id)
                                                //         ->where('ipd_opd',$patient->department_id)
                                                //         ->get()
                                                //         ->row();   
                                                // }
                                            }
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
                                        $RX4= $tretment->RX4;
                                        $RX5= $tretment->RX5;
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
                                        $SWA1= $tretment->SWA1;
                                        $SWA2= $tretment->SWA2;
                                        $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                        $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                        $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                        $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                        $X_RAY= $tretment->X_RAY;
                                        $ECG= $tretment->ECG;
                                        $USG= $tretment->USG;
                                        $symptoms= $tretment->sym_name;
                                        $sym1= $tretment->sym1;
                                        $sym2= $tretment->sym2;
                                        $sym3= $tretment->sym3;
                                        $c_o=$degis_id;
                                        $h_o='NAD';
                                        $f_o='NAD';
                                        $bp=array('130/80','124/86','138/88','150/90','110/70','148/84','148/72','128/60','140/90');
                                        $nadi=array('मंडूकगति', 'सर्पगती' , 'हंसगति','अविशेष');   
                                        $Pulse =array(76,78,88,90,68,72,82,66,74,92,64);
                                        $ur= 'अविशेष';
                                        $cvs ='S1S2 N';
                                        $udar='soft';
                                        $netra=array('आविल','अच्छ','इषतपीत') ;
                                        $givwa=array('साम','निराम');
                                        $sudha=array('तीक्ष्णाग्नि','मंदाग्नि','समाग्नी ','विषग्नी');  
                                        $ahar=array('प्रभत ','अल्प ','मध्यम');
                                        $mal=array('साम ','निराम ','कठीण ','दुर्गंधीयुक्त ','अविशेष');
                                        $mutra=array('पीत','आविल','दुर्गंधीयुक्त','अविशेष');
                                        $nidra=array('अविशेष','प्रभुत','अल्प'); 
                                        $ruduce =array(10,25,50,75);
                                        $ruduce1=array_rand($ruduce);
                                        $ruduce[$ruduce1];
                                        /*$pr =array(12,3,6,9);
                                        $pr1=array_rand($pr);
                                        $pr[$pr1];*/
                                        $pa_tre =array(40,45,50,55,60);
                                        $pa_tre1=array_rand($pa_tre);
                                        $pa_tre[$pa_tre1];
                                        $bp1=array_rand($bp);
                                        $bp[$bp1];
                                        $nadi1=array_rand($nadi);
                                        $nadi[$nadi1];
                                        $Pulse1=array_rand($Pulse);
                                        $Pulse[$Pulse1];
                                        $netra1=array_rand($netra);
                                        $netra[$netra1];
                                        $givwa1=array_rand($givwa);
                                        $givwa[$givwa1];
                                        $sudha1=array_rand($sudha);
                                        $sudha[$sudha1];
                                        $ahar1=array_rand($ahar);
                                        $ahar[$ahar1];
                                        $mal1=array_rand($mal);
                                        $mal[$mal1];
                                        $mutra1=array_rand($mutra);
                                        $mutra[$mutra1];
                                        $nidra1=array_rand($nidra);
                                        $nidra[$nidra1];
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td style="border: 1px solid #333;"><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                                        <td style="border: 1px solid #333;">
                                            <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                            <b> C/O :  </b><?php echo $symptoms;?><br>
                                            <b> H/O : </b> <?php if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}?><br>
                                            <b> Family History : </b> <?php if($patient->f_h) { echo $patient->f_h;}else { echo $f_o;}?><br>
                                            <b><?php if($tretment->e_o) { ?> </b><?php echo 'E/O: '.$tretment->e_o;?> <?php }?><br><br>
                                            <b> O/E-</b><br>
                                            <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                            BP : <?php if($patient->bp) { echo $patient->bp,"   mm of Hg";} else { echo $bp[$bp1],"   mm of Hg";}?><br>
                                            Pulse : <?php if($patient->pulse) { echo $patient->pulse." /min";} else { echo $Pulse[$Pulse1]." /min";} ?><br>
                                            नाडी : <?php if( $patient->nad){ echo $patient->nadi;}else { echo $nadi[$nadi1]; }?><br>
                                            उर (RS): <?php if($tretment->rs) { echo $tretment->rs; }else { echo 'NAD';}?><br>  
                                            CVS : <?php if( $patient->cvs) { echo  $patient->cvs; } else { echo $cvs;}?><br>
                                            उदर (PA): <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $udar;}?><br>
                                            
                                            <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                            <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                            
                                            नेत्र : <?php  if($patient->netra){ echo  $patient->netra;} else { echo $netra[$netra1];}?><br>    
                                            जिव्हा : <?php if(  $patient->giv){ echo  $patient->givwa;} else { echo  $givwa[$givwa1];}?><br>
                                            क्षुधा : <?php if($patient->shudha){ echo  $patient->shudha;} else{ echo  $sudha[$sudha1];}?>
                                            <br>
                                            आहार : <?php  if($patient->ahar) { echo $patient->ahar;} else { echo   $ahar[$ahar1];}?><br> 
                                            मल : <?php if($tretment->mal_mutra) { echo  $tretment->mal_mutra;} else if ($patient->mal){ echo $patient->mal;} else { echo $mal[$mal1];}?><br>
                                            मूत्र : <?php if(!empty($tretment->mutra)){ echo $tretment->mutra;} else if ($patient->mutra){ echo $patient->mutra;}        else { echo  $mutra[$mutra1];}?><br>
                                            निद्रा : <?php if($patient->nidra){ echo $patient->nidra;} else  { echo $nidra[$nidra1];}?><br>
                                            FHS : <?php echo $patient->fhs;?><br>
                                            AG : <?php echo $patient->ag;?><br>
                                        </td>
                                        <td style="border: 1px solid #333;">
                                            <b> RX - </b> <?php if($RX1) {echo "<br>";echo "=>".$RX1;echo "<br>";}?><br>
                                            <?php if($RX2) { echo '=> '.$RX2;echo "<br>";}?><br>
                                            <?php if($RX3) { echo '=> '.$RX3;echo "<br>";}?><br>
                                            <?php if($RX4) { echo '=> '.$RX4;echo "<br>";}?><br>
                                            <?php if($RX5) { echo '=> '.$RX5;echo "<br>";}?>
                                            <br><br>
                                            <?php if(($SNEHAN) or ($VAMAN) or ($VIRECHAN) or ($BASTI) or ($NASYA) or ($RAKTAMOKSHAN) or ($SHIRODHARA_SHIROBASTI) or ($SHIROBASTI) or ($OTHER)){?> 
                                                <b>उपक्रम-</b><br>   
                                                <?php  if($SNEHAN){  echo $SNEHAN.'<br>'; }?>
                                                <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                                <?php  if($VAMAN){  echo $VAMAN.'<br>'; }?>
                                                <?php  if($VIRECHAN){  echo $VIRECHAN.'<br>'; }?>
                                                <?php  if($BASTI){  echo $BASTI.'<br>'; }?>
                                                <?php  if($NASYA){  echo $NASYA.'<br>'; }?>
                                                <?php  if($RAKTAMOKSHAN){  echo $RAKTAMOKSHAN.'<br>'; }?>
                                                <?php  if($SHIRODHARA_SHIROBASTI){  echo $SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                <?php  if($SHIROBASTI){  echo $SHIROBASTI.'<br>'; }?>
                                                <?php  if($OTHER){  echo $OTHER.'<br>'; }?>
                                                <?php  if($SWA1){  echo $SWA1.'<br>'; }?>
                                                <?php  if($SWA2){  echo $SWA2.'<br>'; }?>
                                            <?php } ?>
                                        </td>
                                        <td style="border: 1px solid #333;">
                                            <b> Adv- </b><br>
                                            <?php  if($HEMATOLOGICAL){  echo $HEMATOLOGICAL.'<br>'; }?>
                                            <?php  if($SEROLOGYCAL){  echo $SEROLOGYCAL.'<br>'; }?>
                                            <?php  if($BIOCHEMICAL){  echo $BIOCHEMICAL.'<br>'; }?>
                                            <?php  if($MICROBIOLOGICAL){  echo $MICROBIOLOGICAL.'<br>'; }?>
                                            <?php  if($X_RAY){  echo $X_RAY.'<br>'; }?>
                                            <?php  if($ECG){  echo $ECG.'<br>'; }?>
                                            <?php  if($USG){  echo $USG.'<br>'; }?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php }else{ ?>
                        <div  style="page-break-before: always;">
                            <b style="padding-left: 32px;background-color: #e8d8c4;">Follow up Date: <?php echo date('d-m-Y',strtotime($patient->create_date));?></b>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <th style="border: 1px solid #333; width:10%;">Date </th>
                                            <th style="border: 1px solid #333; width:40%;"> Chief Complaints    </th>
                                            <th style="border: 1px solid #333; width:25%;">Treatment </th>
                                            <th style="border: 1px solid #333; width:25%;">Investigation </th>
                                        </thead>
                                        <?php 
                                            $che=trim($patient->dignosis);
                                            $section_tret='opd';
                                            $len=strlen($che);
                                            $dd= substr($che,$len - 1);
                                            $str = $patient->dignosis;
                                            $arry=explode("-",$str);
                                            $t_c=count($arry);
                                            if($t_c=='2'){
                                                $dd1=substr($che, 0, -1);
                                                $new_str = trim($arry[0]);
                                                $p_dignosis = '%'.$new_str.'%';
                                                $p_dignosis_name=$patient->dignosis;
                                            }else{
                                                $p_dignosis = '%'.$che.'%';
                                                $p_dignosis_name=$patient->dignosis;
                                            }
                                            if($patient->manual_status==0){
                                                if($patient->proxy_id){
                                                    $tretment=$this->db->select("*")
                                                        ->from('treatments1')
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('proxy_id',$patient->proxy_id)
                                                        ->where('department_id',$patient->department_id)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                                else{
                                                    $tretment=$this->db->select("*")
                                                        ->from('treatments1')
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('department_id',$patient->department_id)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();  
                                                    if(empty($tretment)){
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('department_id',$patient->department_id)
                                                            ->where('ipd_opd',$patient->department_id)
                                                            ->get()
                                                            ->row();   
                                                    }
                                                }
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
                                            $RX4= $tretment->RX4;
                                            $RX5= $tretment->RX5;
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
                                            $SWA1= $tretment->SWA1;
                                            $SWA2= $tretment->SWA2;
                                            $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                            $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                            $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                            $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                            $X_RAY= $tretment->X_RAY;
                                            $ECG= $tretment->ECG;
                                            $USG= $tretment->USG;
                                            $symptoms= $tretment->sym_name;
                                            $sym1= $tretment->sym1;
                                            $sym2= $tretment->sym2;
                                            $sym3= $tretment->sym3;
                                            $c_o=$degis_id;
                                            $h_o='NAD';
                                            $f_o='NAD';
                                            $bp=array('130/80','124/86','138/88','150/90','110/70','148/84','148/72','128/60','140/90');
                                            $nadi=array('मंडूकगति', 'सर्पगती' , 'हंसगति','अविशेष');   
                                            $Pulse =array(76,78,88,90,68,72,82,66,74,92,64);
                                            $ur= 'अविशेष';
                                            $cvs ='S1S2 N';
                                            $udar='soft';
                                            $netra=array('आविल','अच्छ','इषतपीत') ;
                                            $givwa=array('साम','निराम');
                                            $sudha=array('तीक्ष्णाग्नि','मंदाग्नि','समाग्नी ','विषग्नी');  
                                            $ahar=array('प्रभत ','अल्प ','मध्यम');
                                            $mal=array('साम ','निराम ','कठीण ','दुर्गंधीयुक्त ','अविशेष');
                                            $mutra=array('पीत','आविल','दुर्गंधीयुक्त','अविशेष');
                                            $nidra=array('अविशेष','प्रभुत','अल्प'); 
                                            $ruduce =array(10,25,50,75);
                                            $ruduce1=array_rand($ruduce);
                                            $ruduce[$ruduce1];
                                            /*$pr =array(12,3,6,9);
                                            $pr1=array_rand($pr);
                                            $pr[$pr1];*/
                                            $pa_tre =array(40,45,50,55,60);
                                            $pa_tre1=array_rand($pa_tre);
                                            $pa_tre[$pa_tre1];
                                            $bp1=array_rand($bp);
                                            $bp[$bp1];
                                            $nadi1=array_rand($nadi);
                                            $nadi[$nadi1];
                                            $Pulse1=array_rand($Pulse);
                                            $Pulse[$Pulse1];
                                            $netra1=array_rand($netra);
                                            $netra[$netra1];
                                            $givwa1=array_rand($givwa);
                                            $givwa[$givwa1];
                                            $sudha1=array_rand($sudha);
                                            $sudha[$sudha1];
                                            $ahar1=array_rand($ahar);
                                            $ahar[$ahar1];
                                            $mal1=array_rand($mal);
                                            $mal[$mal1];
                                            $mutra1=array_rand($mutra);
                                            $mutra[$mutra1];
                                            $nidra1=array_rand($nidra);
                                            $nidra[$nidra1];
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td style="border: 1px solid #333;"><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                                                <td style="border: 1px solid #333;">
                                                    <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                                    <b> C/O :  </b><?php echo $symptoms;?><br>
                                                    <b> H/O : </b> <?php if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}?><br>
                                                    <b> Family History : </b> <?php if($profile->f_h) { echo $profile->f_h;}else { echo $f_o;}?><br>
                                                    <b><?php if($tretment->e_o) { ?> </b><?php echo 'E/O: '.$tretment->e_o;?> <?php }?><br><br>
                                                    <b> O/E-</b><br>
                                                    <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                                    BP : <?php if($patient->bp) { echo $patient->bp,"   mm of Hg";} else { echo $bp[$bp1],"   mm of Hg";}?><br>
                                                    Pulse : <?php if($patient->pulse) { echo $patient->pulse." /min";} else { echo $Pulse[$Pulse1]." /min";} ?><br>
                                                    नाडी : <?php if( $patient->nad){ echo $patient->nadi;}else { echo $nadi[$nadi1]; }?><br>
                                                    उर (RS): <?php if($tretment->rs) { echo $tretment->rs; }else { echo 'NAD';}?><br>  
                                                    CVS : <?php if( $patient->cvs) { echo  $patient->cvs; } else { echo $cvs;}?><br>
                                                    उदर (PA): <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $udar;}?><br>
                                                    
                                                    <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                                    <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                                    
                                                    नेत्र : <?php  if($patient->netra){ echo  $patient->netra;} else { echo $netra[$netra1];}?><br>    
                                                    जिव्हा : <?php if(  $patient->giv){ echo  $patient->givwa;} else { echo  $givwa[$givwa1];}?><br>
                                                    क्षुधा : <?php if($patient->shudha){ echo  $patient->shudha;} else{ echo  $sudha[$sudha1];}?>
                                                    <br>
                                                    आहार : <?php  if($patient->ahar) { echo $patient->ahar;} else { echo   $ahar[$ahar1];}?><br> 
                                                    मल : <?php if($tretment->mal_mutra) { echo  $tretment->mal_mutra;} else if ($patient->mal){ echo $patient->mal;} else { echo $mal[$mal1];}?><br>
                                                    मूत्र : <?php if(!empty($tretment->mutra)){ echo $tretment->mutra;} else if ($patient->mutra){ echo $patient->mutra;}        else { echo  $mutra[$mutra1];}?><br>
                                                    निद्रा : <?php if($patient->nidra){ echo $patient->nidra;} else  { echo $nidra[$nidra1];}?><br>
                                                    FHS : <?php echo $patient->fhs;?><br>
                                                    AG : <?php echo $patient->ag;?><br>
                                                </td>
                                                <td style="border: 1px solid #333;">
                                                    <b> RX - </b> <?php if($RX1) {echo "<br>";echo "=>".$RX1;echo "<br>";}?><br>
                                                    <?php if($RX2) { echo '=> '.$RX2;echo "<br>";}?><br>
                                                    <?php if($RX3) { echo '=> '.$RX3;echo "<br>";}?><br>
                                                    <?php if($RX4) { echo '=> '.$RX4;echo "<br>";}?><br>
                                                    <?php if($RX5) { echo '=> '.$RX5;echo "<br>";}?>
                                                    <br><br>
                                                    <?php if(($SNEHAN) or ($VAMAN) or ($VIRECHAN) or ($BASTI) or ($NASYA) or ($RAKTAMOKSHAN) or ($SHIRODHARA_SHIROBASTI) or ($SHIROBASTI) or ($OTHER)){?> 
                                                        <b>उपक्रम-</b><br>   
                                                        <?php  if($SNEHAN){  echo $SNEHAN.'<br>'; }?>
                                                        <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                                        <?php  if($VAMAN){  echo $VAMAN.'<br>'; }?>
                                                        <?php  if($VIRECHAN){  echo $VIRECHAN.'<br>'; }?>
                                                        <?php  if($BASTI){  echo $BASTI.'<br>'; }?>
                                                        <?php  if($NASYA){  echo $NASYA.'<br>'; }?>
                                                        <?php  if($RAKTAMOKSHAN){  echo $RAKTAMOKSHAN.'<br>'; }?>
                                                        <?php  if($SHIRODHARA_SHIROBASTI){  echo $SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                        <?php  if($SHIROBASTI){  echo $SHIROBASTI.'<br>'; }?>
                                                        <?php  if($OTHER){  echo $OTHER.'<br>'; }?>
                                                        <?php  if($SWA1){  echo $SWA1.'<br>'; }?>
                                                        <?php  if($SWA2){  echo $SWA2.'<br>'; }?>
                                                    <?php } ?>
                                                </td>
                                                <td style="border: 1px solid #333;">
                                                    <b> Adv- </b><br>
                                                    <?php  if($HEMATOLOGICAL){  echo $HEMATOLOGICAL.'<br>'; }?>
                                                    <?php  if($SEROLOGYCAL){  echo $SEROLOGYCAL.'<br>'; }?>
                                                    <?php  if($BIOCHEMICAL){  echo $BIOCHEMICAL.'<br>'; }?>
                                                    <?php  if($MICROBIOLOGICAL){  echo $MICROBIOLOGICAL.'<br>'; }?>
                                                    <?php  if($X_RAY){  echo $X_RAY.'<br>'; }?>
                                                    <?php  if($ECG){  echo $ECG.'<br>'; }?>
                                                    <?php  if($USG){  echo $USG.'<br>'; }?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div> 

            <div class="panel-footer">
                <div class="text-center"></div>
            </div>
        </div>
    </div>
</div>

