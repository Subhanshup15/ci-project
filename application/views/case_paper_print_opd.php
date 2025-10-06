
  <style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table td, .table th {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table th {
            background-color: #333;
            color: white;
        }
    </style>
<div class="row">

<?php 
    //echo error_reporting(0);
    error_reporting(0);
?>

    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>
              

            </div> 

           <?php  foreach($patients as $profile){
                $number= $profile->id;
                 $pr =array(12,3,6,9);
             $pr1=array_rand($pr);
	          $pr[$pr1];
           ?>
<style>
        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table td, .table th {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table th {
            background-color: #333;
            color: white;
        }
    </style>
            <div class="panel-body" style="">

                <div class="row" style="">

                <div class="col-sm-6" align="center"> 
                
                <div style="page-break-before: always;">
                <div class="row">

                    <center>
                        <table style='width:90%;'>
                            <tr>
                                <td class='text-right' style="width:20%;"><img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" /></td>
                                <td class='text-center' style="width:90%;">
                                    <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                                    <h1>OPD Case Paper</h1>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <br>
              
                 
                    <div class="col-md-12 col-lg-12 "> 

                        <table class="table" style="border: 1px solid #333;">
                            <tr>
                                <td></td>
                                <td></td>
                                <td>डॉक्टर.:</td>
                              
                                <td>
                                    <?php 
                                        $doctor_name= $this->db->select("*")
                                            ->from('user')
                                            //->where('join_date <=', date('Y-m-d',strtotime($profile->create_date))) 
                                            ->where('department_id', $profile->department_id) 
                                            ->order_by("user_id", "desc")
                                            ->limit(1)
                                            ->get()
                                            ->row();
                                        $doctor_name->firstname;
                                        
                                        if(empty($doctor_name)){
                                        $doctor_name= $this->db->select("*")
                                        ->from('user')
                                        ->where('join_date <=', date('Y-m-d',strtotime($profile->create_date))) 
                                        ->where('department_id', $profile->department_id) 
                                        ->order_by("user_id", "desc")
                                        ->limit(1)
                                        //->where('department_id', $patient->department_id) 
                                        ->get()
                                        ->row();
                                        }
                                        
                                        //echo $doctor_name->firstname;
                                    ?>
                                </td>
                          
                            </tr>
                          
                            <tr>
                                <td>बाह्यरुग्ण क्र.<br/>O.P.D.:</td>
                                <td>
                                <?php
                                
                               $y=date('Y',strtotime($profile->create_date));
                             
                               $yy=substr($y,2,2);
                               
                                 if($profile->yearly_reg_no != null){
                                    echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null);
                                  //  echo "/".$yy."(New)";
                                  echo  "/".$yy;
                                } else {
                                    echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                   // echo  "/".$yy."(Old)";
                                   echo  "/".$yy;
                                } ?>
                                </td>
                                <td>दिनांक <br/> Date:</td>
                                <td><?php echo (!empty($profile->create_date)?date('d-m-Y',strtotime($profile->create_date)):null) ?></td>
                            </tr>
                          
                            <tr>
                                <td>Name  :</td>
                                <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                <td>Male/Female:</td>
                                <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                            </tr>
                           
                            <tr>
                            <td>Age :</td>
                                <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?> Yr.</td>
                                <td>Address:</td>
                                <td><?php echo (!empty($profile->address)?$profile->address:null) ?></td>                              
                            </tr>
                          
                            <tr>
                                <td>Occupation :</td>
                                <td><?php  if(!empty($profile->occupation)) { echo $profile->occupation; } else { echo 'other';} ?></td>  
                                <td>Dignosis :</td>
                                <td><?php echo $profile->dignosis;?></td>
                            </tr>
                         
                            <tr>
                            <td>Department: </td>
                            <td><?php if($profile->department_id != null) {
                            echo (!empty($profile->name)?$profile->name:null);
                            } ?></td>                             
                            <?php $a1=rand(25,44);?>
                            <td>Weight  :</td>
                            <td><?php if($profile->wieght) {  echo  $profile->wieght;} else { echo $a1; }?>   kg.</td>  
                            </tr>
                        </table>
                    </div>
                </div>
                                
                <?php 

                            $date_f1=date('Y',strtotime($profile->create_date));
                            $date_f2='%'.$date_f1.'%';
                            $opd_ipd_p=$this->db->select("*")
                            ->from('patient_ipd')
                            ->where('yearly_reg_no',$profile->yearly_reg_no)
                            ->where('create_date LIKE',$date_f2)
                            ->get()
                            ->row();



                            $New_OPD='';
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
                            $p_dignosis_name=$patient->dignosis;
                            }else{
                            $p_dignosis = '%'.$che.'%';
                            $p_dignosis_name=$patient->dignosis;
                            }


                            $tretment_ipd=$this->db->select("*")
                            ->from('treatments1')
                            ->where('dignosis LIKE',$p_dignosis)
                            ->where('proxy_id',$opd_ipd_p->proxy_id)
                            ->where('department_id',$profile->department_id)
                            ->where('ipd_opd',$section_tret)
                            ->get()
                            ->row();

                            if(empty($tretment_ipd)){
                            $tretment_ipd=$this->db->select("*")
                            ->from('treatments1')
                            //->where('dignosis LIKE',$p_dignosis)
                            //->where('ipd_opd ',$section_tret)
                            ->where('dignosis LIKE',$p_dignosis)
                            ->where('proxy_id',$profile->proxy_id)
                            ->where('department_id',$profile->department_id)
                            ->where('ipd_opd',$section_tret)
                            ->get()
                            ->row();
                            }

                            if(empty($tretment_ipd)){
                            $tretment_ipd=$this->db->select("*")
                            ->from('treatments1')
                            //->where('dignosis LIKE',$p_dignosis)
                            //->where('ipd_opd ',$section_tret)
                            ->where('department_id',$profile->department_id)
                            ->where('ipd_opd',$profile->department_id)
                            ->get()
                            ->row();
                            }

                            if($profile->sex=='M'){
                            $ward='Male';
                            }else if($profile->sex=='F'){
                            $ward='Female';
                            }else{
                            $ward='';
                            }
                            ?>

               <div class="row">
                <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th style="border-left: 1px solid #333; border-right: 1px solid #333; width:90px;">दिनांक </th>
                                <th style="border-right: 1px solid #333;"> लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
                            </thead>
                            <?php     

                                $che=trim($profile->dignosis);
                                $section_tret='opd';                                       
                                $len=strlen($che);
                                $dd= substr($che,$len - 1);                                       
                                $str = $profile->dignosis;
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

                                $ss=date('Y-m-d',strtotime($profile->create_date));                                                                 
                                if($profile->manual_status==0){
                                $tretment=$this->db->select("*")
                                ->from('treatments1')
                                ->where('dignosis LIKE',$p_dignosis)
                                ->where('department_id',$profile->department_id)
                                ->where('ipd_opd',$section_tret)
                                ->get()
                                ->row();

                                if(empty($tretment)){
                                $tretment=$this->db->select("*")
                                ->from('treatments1')
                                ->where('department_id',$profile->department_id)
                                ->where('ipd_opd',$profile->department_id)
                                ->get()
                                ->row();   

                                }
                                }else{
                                $tretment=$this->db->select("*")
                                ->from('manual_treatments')
                                ->where('patient_id_auto',$profile->id)
                                ->where('dignosis LIKE',$p_dignosis)
                                ->where('ipd_opd ',$section_tret)
                                ->get()
                                ->row();
                                }
                                    
			                      $ANUPAN_RX1= $tretment->ANUPAN_RX1;
			                      $ANUPAN_RX2= $tretment->ANUPAN_RX2;
			                      $ANUPAN_RX3= $tretment->ANUPAN_RX3;
			                      $ANUPAN_RX4= $tretment->ANUPAN_RX4;
			                      $ANUPAN_RX5= $tretment->ANUPAN_RX5;
			                      
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
			                      $OTHER= $tretment->OTHER;
			                      
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
			                      $YONIDHAVAN= $tretment->YONIDHAVAN;
			                      $YONIPICHU= $tretment->YONIPICHU;
			                      $UTTARBASTI= $tretment->UTTARBASTI;
			                      
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

                                    //$bp=array('130/80','124/86','138/88','150/90','110/70','148/84','148/72','128/60','140/90');

                                    $bp = array('122/82','128/78','120/80','118/78','110/70','116/76','130/82','112/72','114/74','124/84','126/86');


                                    $nadi=array('मंडूकगति', 'सर्पगती' , 'हंसगति','अविशेष');   

                                    //$Pulse =array(76,78,88,90,68,72,82,66,74,92,64);
                                    if($row['VIBHAG'] !=32){
                                    $Pulse =array('78','84','86','80','76','74','70','88','90','72','82');
                                    }else{
                                    $Pulse =array('92','104','108','106','96','98','94','90','100','102','110');
                                    }

                                    $ur= 'अविशेष';
                                    $cvs ='S1S2 N';
                                    $udar='soft';
                                    $netra=array('आविल','अच्छ','इषतपीत') ;
                                    $givwa=array('साम','निराम');
                                    $sudha=array('तीक्ष्णाग्नि','मंदाग्नि','समाग्नी ','विषमाग्नी');  

                                    $ahar=array('प्रभत ','अल्प ','मध्यम');
                                    $mal=array('साम ','निराम ','कठीण ','दुर्गंधीयुक्त ','अविशेष');
                                    $mutra=array('पीत','आविल','दुर्गंधीयुक्त','अविशेष');
                                    $nidra=array('अविशेष','प्रभुत','अल्प'); 


                                    $ruduce =array(10,25,50,75);
                                    $ruduce1=array_rand($ruduce);
                                    $ruduce[$ruduce1];



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
                                    <td style="border-left: 1px solid #333; border-right: 1px solid #333;"><?php echo (!empty($profile->create_date)?date('d-m-Y',strtotime($profile->create_date)):null) ?></td>
                                    <td style="border-right: 1px solid #333;">
                                     <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                     <b> C/O :  </b><?php if($tretment_ipd->sym_name) { echo $tretment_ipd->sym_name;} else {  if($symptoms){ echo $symptoms;} else { echo $tretment_ipd->sym_name;}}?><br>
                                     <b> H/O : </b> <?php if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}?><br>
                                     <b> Family History : </b> <?php if($tretment->f_h) { echo $tretment->f_h;}else { echo $f_o;}?><br>

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
                                    <b><?php if($tretment->e_o) { ?> </b><?php echo 'E/O: '.$temp_1." - ".$temp_2;?> <?php }?><br><br>
                                      
                                      <b> O/E-</b><br>
                                      
                                     <!--<?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>-->
                                   
                                     
                                     <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                     <?php if($profile->department_id != 32){ ?>BP : <?php if($profile->bp) { echo $profile->bp."   mm of Hg";} else { echo "130/82 mm of Hg";}?><br><?php } ?>
                                     Pluse : <?php if($profile->pulse) { echo $profile->pulse." /min";}else{ echo "74 /min"; } ?><br>
                                     नाडी  : <?php if($profile->nadi) { echo $profile->nadi;}else{ echo "मंडूकगति"; } ?><br>
                                     उर (rs) : <?php if($profile->ur ) { echo $profile->ur;}else{ echo "अविशेष"; } ?><br>
                                     CVS  : <?php if($profile->cvs) { echo $profile->cvs;}else{ echo "S1S2 N"; } ?><br>
                                     उदर (PA) : <?php if($profile->udar	) { echo $profile->udar;}else{ echo "Soft"; } ?><br>
                                     नेत्र : <?php if($profile->netra) { echo $profile->netra;}else{ echo "आविल"; } ?><br>
                                     जिव्हा : <?php if($profile->givwa) { echo $profile->givwa;}else{ echo "साम"; } ?><br>
                                     क्षुधा : <?php if($profile->shudha) { echo $profile->shudha;}else{ echo "समाग्नी"; } ?><br>
                                     आहार : <?php if($profile->ahar) { echo $profile->ahar;}else{ echo "मध्यम"; } ?><br>
                                     मल : <?php if($profile->mal) { echo $profile->mal;}else{ echo "साम"; } ?><br>
                                     मूत्र : <?php if($profile->mutra) { echo $profile->mutra;}else{ echo "आविल"; } ?><br>
                                     निद्रा : <?php if($profile->nidra) { echo $profile->nidra;}else{ echo "अविशेष"; } ?><br>
                                     
                                    </td>
                                     
                                    <td style="border-right: 1px solid #333;">
                                         <?php if($New_OPD) {?> <span style="float:right;color: #ff000d;background-color: #eae4e4;"><?php  echo "<b>Admit the Patient in IPD ". (!empty($profile->name)?$profile->name:null).' Department Ward No. '.$ward.'</b>';?></span> <?php } else {?>
                                        <b> RX - </b> 
                                        <?php if($RX1) { echo "<br>=> ".$RX1."<br>"; if($ANUPAN_RX1){ echo "Anupan - ".$ANUPAN_RX1."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX2) { echo "=> ".$RX2."<br>"; if($ANUPAN_RX2){ echo "Anupan - ".$ANUPAN_RX2."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX3) { echo "=> ".$RX3."<br>"; if($ANUPAN_RX3){ echo "Anupan - ".$ANUPAN_RX3."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX4) { echo "=> ".$RX4."<br>"; if($ANUPAN_RX4){ echo "Anupan - ".$ANUPAN_RX4."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX5) { echo "=> ".$RX5."<br>"; if($ANUPAN_RX5){ echo "Anupan - ".$ANUPAN_RX5."<br><br>";}else{ echo "<br>";} } ?>
                                        <br><br>
                                                                                                                                                                                       
			                     
                                       <?php if(($SNEHAN) || ($SWEDAN) || ($VAMAN) || ($VIRECHAN) || ($BASTI) || ($NASYA) || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || ($OTHER) || ($SWA1) || ($SWA2) || ($YONIDHAVAN) || ($YONIPICHU) || ($UTTARBASTI)){?>
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
                                       
                                       <?php  if($YONIDHAVAN){  echo $YONIDHAVAN.'<br>'; }?>
                                       <?php  if($YONIPICHU){  echo $YONIPICHU.'<br>'; }?>
                                       <?php  if($UTTARBASTI){  echo $UTTARBASTI.'<br>'; }}?>
                                       
                                       
                                        <?php if(($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)){?>
                                       <b> Adv- </b><br>
                                     
                                       <?php  if($HEMATOLOGICAL){  echo $HEMATOLOGICAL.'<br>'; }?>
                                     
                                       <?php  if($SEROLOGYCAL){  echo $SEROLOGYCAL.'<br>'; }?>
                                     
                                       <?php  if($BIOCHEMICAL){  echo $BIOCHEMICAL.'<br>'; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL){  echo $MICROBIOLOGICAL.'<br>'; }?>
                                     
                                       <?php  if($X_RAY){  echo $X_RAY.'<br>'; }?>
                                      
                                       <?php  if($ECG){  echo $ECG.'<br>'; }?>
                                     
                                       <?php  if($USG){  echo $USG.'<br>'; } } }?>
                                    </td>
                                </tr>
                                
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>

  <?php 
                   $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->yearly_reg_no)
                                     ->where('id >',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd','opd')
                                     ->get()
                                     ->row();
                $f_date= $adv_date->create_date;
           
              if($f_date) {
              ?>
                    
                    <div class="row">
                     <b style="padding-left: 32px;background-color: #e8d8c4;page-break-before: always;">Follow up Date: <?php echo date('d-m-Y',strtotime($f_date));?><span>&emsp;</span>OPD No: <?php echo $profile->yearly_reg_no." (Old)";?></b>
                     <div class="col-md-12">
                        <table class="table" style="border-collapse: collapse;">
                             <thead>
                                <th style="border-left: 1px solid #333; border-right: 1px solid #333;width:90px;" >दिनांक </th>
                                <th style="border-right: 1px solid #333;"  > लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
                            </thead>
                            <?php 
                                        $che=trim($profile->dignosis);
                                        $section_tret='opd';
                                        
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $profile->dignosis;
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
                                      
                                      
                                      if($profile->manual_status==0){
                                      $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                          ->where('department_id',$profile->department_id)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                     
                                     
                                      if(empty($tretment)){
                                      $tretment=$this->db->select("*")
                                       ->from('treatments1')
                                      ->where('department_id',$profile->department_id)
			                          ->where('ipd_opd',$profile->department_id)
                                     ->get()
                                     ->row();   
                                         
                                     }
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$profile->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                      $ANUPAN_RX1= $tretment->ANUPAN_RX1;
			                      $ANUPAN_RX2= $tretment->ANUPAN_RX2;
			                      $ANUPAN_RX3= $tretment->ANUPAN_RX3;
			                      $ANUPAN_RX4= $tretment->ANUPAN_RX4;
			                      $ANUPAN_RX5= $tretment->ANUPAN_RX5;
			                      
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
			                      $OTHER= $tretment->OTHER;
			                      
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
			                      $YONIDHAVAN= $tretment->YONIDHAVAN;
			                      $YONIPICHU= $tretment->YONIPICHU;
			                      $UTTARBASTI= $tretment->UTTARBASTI;
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;
			                      $symptoms= $tretment->sym_name;
			                      
			                      
			                      	 $h_o='NAD';
	         $f_o='NAD';
	         //$bp=array('130/80','124/86','138/88','148/90','110/70','150/84','148/72','128/60','140/90');
	         $bp = array('122/82','128/78','120/80','118/78','110/70','116/76','130/82','112/72','114/74','124/84','126/86');
	         
	         $nadi=array('मंडूकगति', 'सर्पगती' , 'हंसगति','अविशेष');   
             //$Pulse =array(76,78,88,90,68,72,82,66,74,92,64);
            if($row['VIBHAG'] !=32){
                $Pulse =array('78','84','86','80','76','74','70','88','90','72','82');
            }else{
                $Pulse =array('92','104','108','106','96','98','94','90','100','102','110');
            }
             
             
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
                                    <td style="border-left: 1px solid #333; border-right: 1px solid #333;"><?php echo date('d-m-Y',strtotime($f_date)); ?></td>
                                    <td style="border-right: 1px solid #333;">
                                     
                                    <b><?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
                                    <!--<b>C/O : </b> <?//php echo $complanints[$complanints1]." Reduced by ".$ruduce[$ruduce1].'%';?><br>-->
                                    <b>C/O : </b> <?php echo "Symptoms Reduced by ".$adv_date->sym_reduce_per.'%';?><br>
                                    
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
                                    <b><?php if($tretment->e_o) { ?> </b><?php echo 'E/O: '.$temp_1." - ".$temp_2;?> <?php }?><br><br>
                                      
                                      <b> O/E-</b><br>
                                      
                                 
                                      
                                        <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                        <?php if($adv_date->department_id != 32){ ?>BP : <?php if($adv_date->bp) { echo $adv_date->bp."   mm of Hg";} else { echo "130/82 mm of Hg";}?><br><?php } ?>
                                        Pluse : <?php if($adv_date->pulse) { echo $adv_date->pulse." /min";}else{ echo "74 /min"; } ?><br>
                                        नाडी  : <?php if($adv_date->nadi) { echo $adv_date->nadi;}else{ echo "मंडूकगति"; } ?><br>
                                        उर (rs) : <?php if($adv_date->ur ) { echo $adv_date->ur;}else{ echo "अविशेष"; } ?><br>
                                        CVS  : <?php if($adv_date->cvs) { echo $adv_date->cvs;}else{ echo "S1S2 N"; } ?><br>
                                        उदर (PA) : <?php if($adv_date->udar	) { echo $adv_date->udar;}else{ echo "Soft"; } ?><br>
                                        नेत्र : <?php if($adv_date->netra) { echo $adv_date->netra;}else{ echo "आविल"; } ?><br>
                                        जिव्हा : <?php if($adv_date->givwa) { echo $adv_date->givwa;}else{ echo "साम"; } ?><br>
                                        क्षुधा : <?php if($adv_date->shudha) { echo $adv_date->shudha;}else{ echo "समाग्नी"; } ?><br>
                                        आहार : <?php if($adv_date->ahar) { echo $adv_date->ahar;}else{ echo "मध्यम"; } ?><br>
                                        मल : <?php if($adv_date->mal) { echo $adv_date->mal;}else{ echo "साम"; } ?><br>
                                        मूत्र : <?php if($adv_date->mutra) { echo $adv_date->mutra;}else{ echo "आविल"; } ?><br>
                                        निद्रा : <?php if($adv_date->nidra) { echo $adv_date->nidra;}else{ echo "अविशेष"; } ?><br>
                                     
                                    </td>
                                     
                                    <td style="border-right: 1px solid #333;">
                                        <b> RX - </b> 
                                        <?php if($RX1) { echo "<br>=> ".$RX1."<br>"; if($ANUPAN_RX1){ echo "Anupan - ".$ANUPAN_RX1."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX2) { echo "=> ".$RX2."<br>"; if($ANUPAN_RX2){ echo "Anupan - ".$ANUPAN_RX2."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX3) { echo "=> ".$RX3."<br>"; if($ANUPAN_RX3){ echo "Anupan - ".$ANUPAN_RX3."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX4) { echo "=> ".$RX4."<br>"; if($ANUPAN_RX4){ echo "Anupan - ".$ANUPAN_RX4."<br><br>";}else{ echo "<br>";} } ?>
                                        <?php if($RX5) { echo "=> ".$RX5."<br>"; if($ANUPAN_RX5){ echo "Anupan - ".$ANUPAN_RX5."<br><br>";}else{ echo "<br>";} } ?>
                                        <br><br>
                                       
                                      <?php if(($SNEHAN) || ($SWEDAN) || ($VAMAN) || ($VIRECHAN) || ($BASTI) || ($NASYA) || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || ($OTHER) || ($SWA1) || ($SWA2) || ($YONIDHAVAN) || ($YONIPICHU) || ($UTTARBASTI)){?>
 
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
                                    
                                       <?php  if($SWA2){  echo $SWA2.'<br>';  }?>
                                       
                                       <?php  if($YONIDHAVAN){  echo $YONIDHAVAN.'<br>'; }?>
                                       <?php  if($YONIPICHU){  echo $YONIPICHU.'<br>'; }?>
                                       <?php  if($UTTARBASTI){  echo $UTTARBASTI.'<br>'; }}?>
                                       
                                 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php }?>
                </div>
                
               
              
            </div> 
            
             <?php } ?>
             
            
            
            </div> 

            </div> 
		  


            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

