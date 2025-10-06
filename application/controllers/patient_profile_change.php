<div class="row">

<?php echo error_reporting(0);?>

    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>
                  <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/opd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
                
                <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/opd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>
                
                 <div class="btn-group" <?php if($profile->discharge_date =='0000-00-00')?>> 
                    <a class="btn btn-default" href="<?php echo base_url("patients/profile_bill/$id") ?>"> <i class="fa fa-list-alt"></i> Bill Receipt</a>   
                </div>

            </div> 



            <div class="panel-body">

                <div class="row">



                    <div class="col-sm-12" align="center">  
                      <strong><?php echo $this->session->userdata('title') ?></strong>
                      <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
 
 
 
                    <h1>OPD Case Paper</h1>

                    <br>

                    </div>

                    <div class="col-md-12 col-lg-12 " > 

                        <table class="table" style="border: 1px solid #333;">
                        
                            <tr>
                                <td>बाह्यरुग्ण क्र.<br/>O.P.D.:</td>
                                <td>
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
                                } ?>
                                </td>
                                <td>दिनांक <br/> Date:</td>
                                <td><?php echo (!empty($profile->create_date)?date('d-m-Y',strtotime($profile->create_date)):null) ?></td>
                            </tr>
                            <tr>
                                <td>नाव :</td>
                                <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                <td>स्त्री / पु / मु / मुलगी:</td>
                                <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                            </tr>
                            <tr>
                            <td>वय :</td>
                                <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?> Yr.</td>
                                <td>राहण्याचे ठिकाण :</td>
                                <td><?php echo (!empty($profile->address)?$profile->address:null) ?></td>
                                
                            </tr>
                            <tr>
                                <td>व्यवसाय :</td>
                                <td><?php if(!empty($profile->occupation)){ echo $profile->occupation; }else { echo "Other";}?></td>  
                                <td>व्याधिनाम :</td>
                                <td><?php echo $profile->dignosis;?></td>
                            </tr>
                            <tr>
                                <td>विभाग :</td>
                                <td><?php if($profile->department_id != null) {
                                    echo (!empty($profile->name)?$profile->name:null);
                                } ?></td> 
                                
                                <?php $a1=rand(25,44); ?>
                                <td>वजन  :</td>
                                <td><?php if($profile->wieght) {  echo  $profile->wieght;} else { echo $a1; }?>   kg.</td>  
                            </tr>
                        </table>

                    </div>

                    

                </div>
                  <!-- <hr style="border-color: brown;">-->
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
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                   } else {
                        $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->yearly_reg_no)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                   }
                 $f_date= $adv_date->create_date;
                 
           
              if($f_date){?>
               <div class="row">
                           
                <div class="col-md-12">
                        <table class="table">
                             <thead>
                                <th style="border-right: 1px solid #333; width:90px;">दिनांक </th>
                                <th style="border-right: 1px solid #333;"> लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
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
                                      
                                      $ss=date('Y-m-d',strtotime($profile->create_date));
                                  
                                      
                                      if($profile->manual_status==0){
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$profile->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                      
			                        $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      
			                      $SNEHAN= $tretment->SNEHAN;
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
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
                                     <td style="border-right: 1px solid #333;"><?php echo date('d-m-Y',strtotime($f_date)); ?></td>
                                     <td style="border-right: 1px solid #333;">
                                     <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                     <b> C/O :  </b><?php echo $symptoms;?><br>
                                     <b> H/O : </b> <?php if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}?><br>
                                     <b> Family History : </b> <?php if($profile->f_h) { echo $profile->f_h;}else { echo $f_o;}?><br>
                                    <b><?php if($tretment->e_o) { ?> </b><?php echo 'E/O: '.$tretment->e_o;?> <?php }?><br><br>
                                      
                                      <b> O/E-</b><br>
                                      
                                     <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                      BP : <?php if($adv_date->bp) { echo $adv_date->bp,"   mm of Hg";} else { echo $bp[$bp1],"   mm of Hg";}?><br>
                                      Pulse : <?php if($adv_date->pulse) { echo $adv_date->pulse." /min";} else { echo 	          $Pulse[$Pulse1]." /min";} ?><br>
                                      नाडी : <?php if( $adv_date->nad){ echo $adv_date->nadi;}else { echo $nadi[$nadi1]; }?><br>
                                      उर (RS): <?php if($tretment->rs) { echo $tretment->rs; }else { echo 'NAD';}?><br>  
                                      CVS : <?php if( $adv_date->cvs) { echo  $adv_date->cvs; } else { echo $cvs;}?><br>
                                      उदर (PA): <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $udar;}?><br>
                                      
                                      <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                      <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                      
                                      नेत्र : <?php  if($adv_date->netra){ echo  $adv_date->netra;} else { echo $netra[$netra1];}?><br>    
                                      जिव्हा : <?php if(  $adv_date->giv){ echo  $adv_date->givwa;} else { echo  $givwa[$givwa1];}?><br>
                                      क्षुधा : <?php if($adv_date->shudha){ echo  $adv_date->shudha;} else{ echo  $sudha[$sudha1];}?>
                                      <br>
                                      आहार : <?php  if($adv_date->ahar) { echo $adv_date->ahar;} else { echo   $ahar[$ahar1];}?><br> 
                                         मल : <?php if($tretment->mal_mutra) { echo  $tretment->mal_mutra;}else { echo $mal[$mal1];}?><br>
                                         मूत्र : <?php if(!empty($tretment->mutra)){ echo $tretment->mutra;} else { echo  $mutra[$mutra1];}?><br>
                                         निद्रा : <?php if($adv_date->nidra){ echo $adv_date->nidra;} else  { echo $nidra[$nidra1];}?>
                                    </td>
                                     
                                    <td style="border-right: 1px solid #333;">
                                     <b> RX - </b> <?php if($RX1) {echo "<br>";echo "=>".$RX1;echo "<br>";}?><br>
                                       <?php if($RX2) { echo '=> '.$RX2;echo "<br>";}?><br>
                                       <?php if($RX3) { echo '=> '.$RX3;echo "<br>";}?>
                                        <br><br>
                                        
                                     
                                         <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN){  echo $SNEHAN.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                    
                                       <?php  if($VAMAN){  echo $VAMAN.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN){  echo $VIRECHAN.'<br>'; }?>
                                      
                                        <?php  if($BASTI){  echo $BASTI.'<br>'; }?>
                                     
                                       <?php  if($NASYA){  echo $NASYA.'<br>'; }?>
                                     
                                       <?php  if($RAKTAMOKSHAN){  echo $RAKTAMOKSHAN.'<br>'; }?>
                                    
                                       <?php  if($SHIRODHARA_SHIROBASTI){  echo $SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                    
                                       <?php  if($OTHER){  echo $OTHER.'<br>'; }?>
                                     
                                       <?php  if($SWA1){  echo $SWA1.'<br>'; }?>
                                    
                                       <?php  if($SWA2){  echo $SWA2.'<br>'; }?>
                                       <b> Adv- </b><br>
                                     
                                       <?php  if($HEMATOLOGICAL){  echo $HEMATOLOGICAL.'<br>'; }?>
                                     
                                       <?php  if($SEROLOGYCAL){  echo $SEROLOGYCAL.'<br>'; }?>
                                     
                                       <?php  if($BIOCHEMICAL){  echo $BIOCHEMICAL.'<br>'; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL){  echo $MICROBIOLOGICAL.'<br>'; }?>
                                     
                                       <?php  if($X_RAY){  echo $X_RAY.'<br>'; }?>
                                      
                                       <?php  if($ECG){  echo $ECG.'<br>'; }?>
                                     
                                       <?php  if($USG){  echo $USG.'br>'; }?>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <?php }?>
                  <hr style="border-color: brown;">
         
                  <?php 
                   $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   
                    if($profile->old_reg_no){
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->old_reg_no)
                                     ->where('id >',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                   } else {
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->yearly_reg_no)
                                     ->where('id >',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                   }
                 $f_date= $adv_date->create_date;
                  $profile->yearly_reg_no;
           
              if($f_date) {
              ?>
                    <b style="padding-left: 32px;background-color: #e8d8c4;">Follow up Date: <?php echo date('d-m-Y',strtotime($f_date));?></b>
                    <div class="row">
                     <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th style="border-right: 1px solid #333; width:90px;">दिनांक </th>
                                <th style="border-right: 1px solid #333;"> लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
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
                                      
                                      if($profile->manual_status==0){
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$profile->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                      
			                      $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      
			                      $SNEHAN= $tretment->SNEHAN;
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;
			                      $symptoms= $tretment->sym_name;
			                      
			                      
			 $h_o='NAD';
	         $f_o='NAD';
	         $bp=array('130/80','124/86','138/88','148/90','110/70','150/84','148/72','128/60','140/90');
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
	          
	        /* $pr =array(12,3,6,9);
              $pr1=array_rand($pr);
	          $pr[$pr1];*/
	          
	          $pa_tre =array(40,45,50,55,60);
              $pa_tre1=array_rand($pa_tre);
	          $pa_tre[$pa_tre1];
	          
	         $complanints =array('Symptoms','Complaints');
             $complanints1=array_rand($complanints);
	          $complanints[$complanints1];
             
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
                                    <td style="border-right: 1px solid #333;"><?php echo date('d-m-Y',strtotime($f_date)); ?></td>
                                    <td style="border-right: 1px solid #333;">
                                     
                                     <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                     <b>C/O : </b> <?php echo $complanints[$complanints1]." Redured by ".$ruduce[$ruduce1].'%';?><br>
                                    
                                     <b><?php if($tretment->e_o) { ?></b><?php echo 'E/O: '.$tretment->e_o;?> <?php }?><br><br>
                                      
                                      <b> O/E-</b><br>
                                      
                                        <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                      BP : <?php if($adv_date->bp) { echo $adv_date->bp,"   mm of Hg";} else { echo $bp[$bp1],"   mm of Hg";}?><br>
                                      Pulse : <?php if($adv_date->pulse) { echo $adv_date->pulse." /min";} else { echo 	          $Pulse[$Pulse1]." /min";} ?><br>
                                      नाडी : <?php if( $adv_date->nad){ echo $adv_date->nadi;}else { echo $nadi[$nadi1]; }?><br>
                                      उर (RS): <?php if($tretment->rs) { echo $tretment->rs; }else { echo 'NAD';}?><br>  
                                      CVS : <?php if( $adv_date->cvs) { echo  $adv_date->cvs; } else { echo $cvs;}?><br>
                                      उदर (PA): <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $udar;}?><br>
                                      
                                      <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                      <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                      
                                      नेत्र : <?php  if($adv_date->netra){ echo  $adv_date->netra;} else { echo $netra[$netra1];}?><br>    
                                      जिव्हा : <?php if(  $adv_date->giv){ echo  $adv_date->givwa;} else { echo  $givwa[$givwa1];}?><br>
                                      क्षुधा : <?php if($adv_date->shudha){ echo  $adv_date->shudha;} else{ echo  $sudha[$sudha1];}?>
                                      <br>
                                      आहार : <?php  if($adv_date->ahar) { echo $adv_date->ahar;} else { echo   $ahar[$ahar1];}?><br> 
                                         मल : <?php if($tretment->mal_mutra) { echo  $tretment->mal_mutra;}else { echo $mal[$mal1];}?><br>
                                         मूत्र : <?php if(!empty($tretment->mutra)){ echo $tretment->mutra;} else { echo  $mutra[$mutra1];}?><br>
                                         निद्रा : <?php if($adv_date->nidra){ echo $adv_date->nidra;} else  { echo $nidra[$nidra1];}?>
                                    </td>
                                     
                                    <td style="border-right: 1px solid #333;">
                                     <b> RX - </b> <?php if($RX1) {echo "<br>";echo "=>".$RX1;echo "<br>";}?><br>
                                         <?php if($RX2) { echo '=> '.$RX2;echo "<br>";}?><br>
                                        <?php if($RX3) {echo '=> '.$RX3;echo "<br>";}?>
                                        <br><br>
                                        
                                            <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN){  echo $SNEHAN.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                    
                                       <?php  if($VAMAN){  echo $VAMAN.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN){  echo $VIRECHAN.'<br>'; }?>
                                      
                                        <?php  if($BASTI){  echo $BASTI.'<br>'; }?>
                                     
                                       <?php  if($NASYA){  echo $NASYA.'<br>'; }?>
                                     
                                       <?php  if($RAKTAMOKSHAN){  echo $RAKTAMOKSHAN.'<br>'; }?>
                                    
                                       <?php  if($SHIRODHARA_SHIROBASTI){  echo $SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                    
                                       <?php  if($OTHER){  echo $OTHER.'<br>'; }?>
                                     
                                       <?php  if($SWA1){  echo $SWA1.'<br>'; }?>
                                    
                                       <?php  if($SWA2){  echo $SWA2.'<br>'; }?>
                                       <b> Adv- </b><br>
                                     
                                       <?php  if($HEMATOLOGICAL){  echo  ''; }?>
                                     
                                       <?php  if($SEROLOGYCAL){  echo ''; }?>
                                     
                                       <?php  if($BIOCHEMICAL){  echo ''; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL){  echo ''; }?>
                                     
                                       <?php  if($X_RAY){  echo ''; }?>
                                      
                                       <?php  if($ECG){  echo ''; }?>
                                     
                                       <?php  if($USG){  echo ''; }?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                 <hr style="border-color: brown;">
                <?php }?>
               
              
            

            </div> 



            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

