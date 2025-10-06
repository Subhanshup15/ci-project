<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->


<div class="row">

<?php $s= error_reporting(0); if($s) { echo "";}?>

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
                
                <div class="btn-group"> 
                 
                   <!-- <a class="btn btn-success" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit"></i>Update Dignosis</a> -->
                     <!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i>Update Dignosis</button>-->
                </div>
                

       <?php if($profile->department_id == 31){ ?>
                <?php $id=$this->uri->segment(3); ?>
                    <div class="btn-group"> 
                      <button type="button" class="btn btn-primary" name="submit" id="submit"><i class="fa fa-plus"></i>Add Ksharsutra</button>
                    </div>

                    <input type="hidden" name="section" id="section" value="<?php echo $profile->ipd_opd; ?>" >
                    <input type="hidden" name="patient_auto_id" id="patient_auto_id" value="<?php echo $profile->id; ?>" >
                    <input type="hidden" name="kstatus" id="kstatus" value="1" >
             <?php } ?>
                

                
                <div class="container">
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update Dignosis</h4>
                                </div>
                                <?php $id=$this->uri->segment(3);?>
                                <form action="<?= base_url('patients/UpdateDignosis') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="dignosis">Dignosis Name</label>
                                            <input type="text" name="dignosis" id="dignosis" placeholder="Dignosis" class="form-control">
                                            <input type="hidden" name="id" id="id"  value="<?php echo $id; ?>" class="form-control">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="submit" class="btn btn-primary">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                 <div class="btn-group" <?php if($profile->discharge_date =='0000-00-00')?>> 
                    <a class="btn btn-default" href="<?php echo base_url("patients/profile_bill/$id") ?>"> <i class="fa fa-list-alt"></i> Bill Receipt</a>   
                </div>

            </div> 






            <div class="panel-body">

                <div class="row">
                    <!--<div class="col-sm-12">  -->
                        <!--<div class="col-sm-2" align="center">-->
                        <!--    <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />-->
                        <!--</div>-->
                        <!--<div class="col-sm-8" align="center">-->
                        <!--    <strong><?php echo $this->session->userdata('title') ?></strong>-->
                        <!--    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>-->
                        <!--    <h1>OPD Case Paper</h1>-->
                        <!--</div>-->
                        <center>
                        <table style='width:100%;'>
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
                    <!--</div>-->
                    <?php  
                     $date_f1=date('Y',strtotime($profile->create_date));
                     $date_f2='%'.$date_f1.'%';
                    $opd_ipd_p=$this->db->select("*")
			                         ->from('patient_ipd')
			                          ->where('yearly_reg_no',$profile->yearly_reg_no)
			                         ->where('create_date LIKE',$date_f2)
                                     ->get()
                                     ->row();
                                     
                                      $New_OPD=$opd_ipd_p->yearly_reg_no;
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
                                        $p_dignosis_name=$profile->dignosis;
                                        }else{
                                        $p_dignosis = '%'.$che.'%';
                                        $p_dignosis_name=$profile->dignosis;
                                        }
                                      
                                    if($profile->manual_status==0){
                                        if($profile->proxy_id){
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$profile->proxy_id)
                                                ->where('department_id',$profile->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                        }
                                        else{
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

                                    if($profile->manual_status=='1' || $profile->created_by !='')
                                    {
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$profile->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
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
                    

                    <div class="col-md-12 col-lg-12 " > 
                        <table class="table" style="border: 1px solid #333;">
                            <tr>
                                <td>बाह्यरुग्ण क्र.<br/>O.P.D.:</td>
                                <td>
                                <?php
                                //   $year = $this->session->userdata['acyear'] ;
                                    $temp_patient = $this->db->where('id',$profile->id)
                                              //  ->limit(1)
                                                ->get('patient')
                                                ->row();
                                //   print_r($this->db->last_query());
                                    $y=date('Y',strtotime($temp_patient->create_date));
                                   if($y=='1970'){
                                       $yy=20;
                                   }else{
                                   $yy=substr($y,2,2);
                                   }
                                     if($temp_patient->yearly_reg_no != null){
                                        echo (!empty($temp_patient->yearly_reg_no)?$temp_patient->yearly_reg_no:null);
                                        echo "/".$yy."(New)";
                                    } else {
                                        echo (!empty($temp_patient->old_reg_no)?$temp_patient->old_reg_no:null);
                                        echo  "/".$yy."(Old)";
                                    }
                                
                                ?>
                                </td>
                                <td>दिनांक <br/> Date:</td>
                                <td><?php echo (!empty($temp_patient->create_date)?date('d-m-Y',strtotime($temp_patient->create_date)):null) ?></td>
                            </tr>
                            <tr>
                                <td>नाव :</td>
                                <td><?php echo (!empty($temp_patient->firstname)?$temp_patient->firstname:null) ?></td>
                                <td>स्त्री / पु / मु / मुलगी:</td>
                                <td><?php echo (!empty($temp_patient->sex)?$temp_patient->sex:null) ?></td>
                            </tr>
                            <tr>
                            <td>वय :</td>
                                <td><?php echo (!empty($temp_patient->date_of_birth)?$temp_patient->date_of_birth:null) ?> Yr.</td>
                                <td>राहण्याचे ठिकाण :</td>
                                <td><?php echo (!empty($temp_patient->address)?$temp_patient->address:null) ?></td>
                                
                            </tr>
                            <tr>
                                <td>व्यवसाय :</td>
                                <td><?php if(!empty($temp_patient->occupation)){ echo $temp_patient->occupation; }else { echo "Other";}?></td>  
                                <td>व्याधिनाम :</td>
                                <td><?php echo $temp_patient->dignosis;?></td>
                            </tr>
                            <tr>
                                <td>विभाग :</td>
                                        <td> <?php 
                                        $year = '%' . $this->session->userdata['acyear'] . '%';
                                        $Cyear = $this->session->userdata['acyear'];
                                        $departmentTable = ($Cyear == '2025') ? 'department_new' : 'department';
                                        if (!is_null($temp_patient->department_id)) {
                                        $department = $this->db
                                        ->where('dprt_id', $temp_patient->department_id)
                                        ->get($departmentTable)
                                        ->row();
                                        echo !empty($department->name) ? $department->name : null;
                                        }
                                        ?></td> 
                                <?//php $a1=rand(25,44); ?>
                                <td>वजन  :</td>
                                <td><?php if($temp_patient->wieght) {  echo  $temp_patient->wieght;} else { echo $tretment->weight; } ?>   kg.</td> <br>
                            </tr>
                            <tr>
                                <td>Contact  :</td>
                                <td><?php if($temp_patient->phone) {  echo  $temp_patient->phone;} else { echo $temp_patient->phone; }?> </td> 
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
			                         //->where('create_date like',$current_Y1)
			                         ->where('create_date <= ',date('Y-m-d',strtotime($profile->create_date)))
			                         ->where('ipd_opd ','opd')
			                         ->order_by('id','DESC')
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
                 $new = $adv_date->yearly_reg_no;
           
              if($f_date && $new){?>
               <div class="row">
                           
                <div class="col-md-12">
                        <table class="table">
                             <thead>
                                <th style="border-left: 1px solid #333; border-right: 1px solid #333; width:90px;">दिनांक </th>
                                <th style="border-right: 1px solid #333;"> लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
                            </thead>
                            <?php       $che=trim($adv_date->dignosis);
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
                                        }
                                        else{
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
                                    
                                    if($adv_date->manual_status=='1' || $adv_date->created_by !='')
                                    {
                                        $tretment=$this->db->select("*")
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
			                      $SEROLOGYCA_new= $tretment->SEROLOGYCAL;
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
                                 	$weight_new = $tretment->weight;
		    /* $h_o='NAD';
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
	          $pr[$pr1];
	          
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
                            */
                                  
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
                                     <td style="border-left: 1px solid #333; border-right: 1px solid #333;"><?php echo date('d-m-Y',strtotime($f_date)); ?></td>
                                     <td style="border-right: 1px solid #333;">
                                     <b><?php if($tretment->kco) { ?> </b><?php echo '<b>K/C/O : </b>'.$tretment->kco.'<br>';?> <?php }?>
                                     
                                      <b> C/O :  </b><?php if($tretment_ipd->sym_name) { echo $tretment_ipd->sym_name;} else {  if($symptoms_new){ echo $symptoms_new;} else { echo $tretment_ipd->sym_name;}}?><br>

                                    
                                       
                                       
                                       
                                     <b> H/O : </b> <?php if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}?><br>
                                       <?php if($weight_new){ ?>
                                       <b>Weight : </b><?php echo $weight_new.' KG'; ?><br>
                                       <?php } ?>
                                      
                                       
                                       <?php 
                                  if($adv_date->department_id =='29'){
                                  if($tretment->M_H){?>
                                       <b> M/H : </b><?php echo $tretment->M_H; ?><br>
                                  <?php
                                  }
                                    if($tretment->O_H){
                                    ?>
                                       <b> O/H : </b><?php echo $tretment->O_H; ?><br>
                                       <?php
                                    }
                                    if($tretment->PSV){
                                    ?>
                                       <b> P/S/V : </b><?php echo $tretment->PSV; ?><br>
                                       <?php
                                    }
                                  if($tretment->LMP || $tretment->NO_OF_DAYS ||$tretment->PATTERN ||$tretment->FLOW) {?>
                                      <b> M/H : </b><?php if($tretment->LMP){ echo $tretment->LMP; } ?>
                                       <?php if($tretment->NO_OF_DAYS){ echo $tretment->NO_OF_DAYS; } ?>
                                       <?php if($tretment->PATTERN){ echo $tretment->PATTERN; } ?>
                                       <?php if($tretment->FLOW){ echo $tretment->FLOW; } ?>
                                     <?php } } ?>
                                       
                                       <?php 
                                  if($adv_date->department_id =='29'){
                                  if($tretment->Obstetric_History || $tretment->Marita_Status ||$tretment->Marital_years) {?>
                                      <b> O/H : </b><?php if($tretment->Obstetric_History){ echo $tretment->Obstetric_History; } ?><br>
                                       <?php if($tretment->Marita_Status){ echo $tretment->Marita_Status; } ?><br>
                                       <?php if($tretment->Marital_years){ echo $tretment->Marital_years; } ?><br>
                                       
                                     <?php } } ?>
                                       
                                       
                                       
                                     <b> Family History : </b> <?php if($tretment->f_o) { echo $tretment->f_o;}else { echo $adv_date->f_h;}?><br>
                                    <?php if($tretment->old_investigation){ ?>
                                        <b>Old Investigation : <?php echo $tretment->old_investigation; ?></b>
                                    
                                    <?php } ?>
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
                                     
                                     
                                     <?php if($tretment->temp){ ?>
                                        
                                     <p> Temp :  <?php echo $tretment->temp; ?></p>
                                        
                                     <?php } ?>
                                     
                                     <?//php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                      BP : 
                                      <?php if($tretment->bp) { echo $tretment->bp,"   mm of Hg";} else { echo $adv_date->bp,"   mm of Hg";}?><br>
                                    <?php  if($tretment->temp) { ?>
                                      Temp : 
                                      <?php if($tretment->temp) { echo $tretment->temp;}?><br>
                                      <?php } ?>
                                      Pulse : 
                                      <?php if($tretment->pulse) { echo $tretment->pulse." /min";} else { echo 	          $adv_date->pulse." /min";} ?><br>
                                      नाडी : 
                                      <?php if( $tretment->nadi){ echo $tretment->nadi;}else { echo $adv_date->nadi; }?><br>
                                      RS : 
                                      <?php if($tretment->rs) { echo $tretment->rs; } else {  echo $adv_date->ur;}?><br>  
                                      CVS : 
                                      <?php if( $tretment->cvs) { echo  $tretment->cvs; } else { echo $adv_date->cvs;}?><br>
                                      P / A : 
                                      <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1];} else { echo $udar;}?><br>
                                           <?php 
                                  if($adv_date->department_id =='29'){ 
                                    ?>
                                       <?php
                                         if($adv_date->dignosis =='YONIBHRANSHA-SRI' || $adv_date->dignosis =='YONIBHRANSHA' || $adv_date->dignosis =='YONIBHRANSH' || $adv_date->dignosis=='GARBHASHAYA BHRAVSHA'){  ?>
                                       P/S/V. :- 1° Prolapes<br>Not Willing To Operate<br>
                                       <?php }  } ?>
                                       
                                   <?php 
                                  if($adv_date->department_id =='29'){ 
                                    ?>
                                       <?php
                                         if($adv_date->lmp || $adv_date->edd || $adv_date->fhs){  ?>
                                      FHS :-<?php echo $adv_date->fhs; ?> <br>
                                       LMP :-<?php echo $adv_date->lmp; ?> <br>
                                       EDD :-<?php echo $adv_date->edd; ?> <br>
                                       <?php }  } ?>
                                       
                                       
                                       <?php 
                                  
                                  
                                  if($adv_date->department_id =='29'){ 
                                    ?>
                                       <?php
                                    //echo $new_str;
                                         if($new_str =='SHWETA PRADAR  - SR ' || $new_str =='SHWETA PRADAR' || $new_str =='SHWETA PRADAR - SR' || $new_str =='SHWETAPRADAR-SRI'){  ?>
                                       P/S/ :- Cx, Vg - Healthy
      White discharge ++
       No foul smell
<br>
                                      P/V. :- Ut- AV, N.S.
           Fornices clear, non tender <br>
                                       <?php }  } ?>
                                       
                                       
                                      <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                      <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                      
                                    नेत्र
                                    : <?php  if($tretment->netra){ echo  $tretment->netra;} else { echo $adv_date->netra;}?><br>    
                                    जिव्हा
                                    : <?php if(  $tretment->givwa){ echo  $tretment->givwa;} else { echo  $adv_date->givwa;}?><br>
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
                                    <?php if($New_OPD) {?> <span style="float:right;color: #ff000d;background-color: #eae4e4;"><?php  echo "<b>Admit the Patient in IPD ". (!empty($profile->name)?$profile->name:null).' Department Ward No. '.$ward.'</b>';?></span> <?php } else {?>
                                     
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
                                        <?php if($profile->department_id == '33'){ ?>
                                      <?php if(($SNEHAN_new) || ($SWEDAN_new) || ($VAMAN_new) || ($VIRECHAN_new) || ($BASTI_new) || ($NASYA_new) || ($RAKTAMOKSHAN_new) || ($SHIRODHARA_SHIROBASTI_new) || ($SHIROBASTI_new) || ($UTTARBASTI_new) || ($YONIDHAVAN_new) || ($YONIPICHU_new) || ($OTHER_new) || ($SWA1_new) || ($SWA2_new)){?>
                                       <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN_new){  echo 'SHEHAN => '.$SNEHAN_new.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN_new){  echo 'SWEDAN => '.$SWEDAN_new.'<br>'; }?>
                                    
                                       <?php  if($VAMAN_new){  echo 'VAMAN => '.$VAMAN_new.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN_new){  echo 'VIRECHAN => '.$VIRECHAN_new.'<br>'; }?>
                                      
                                        <?php  if($BASTI_new){  echo 'BASTI => '.$BASTI_new.'<br>'; }?>
                                     
                                       <?php  if($NASYA_new){  echo 'NASYA => '.$NASYA_new.'<br>'; }?>
                                     
                                       <?php  if($RAKTAMOKSHAN_new){  echo 'RAKTMOKSHAN => '.$RAKTAMOKSHAN_new.'<br>'; }?>
                                    
                                       <?php  if($SHIRODHARA_SHIROBASTI_new){  echo 'SHRODHARA => '.$SHIRODHARA_SHIROBASTI_new.'<br>'; }?>
                                       
                                       <?php  if($SHIROBASTI_new){  echo 'SHIROBASTI => '.$SHIROBASTI_new.'<br>'; }?>
                                    
                                       <?php  if($OTHER_new){  echo 'OTHER => '.$OTHER_new.'<br>'; }?>
                                       
                                       <?php  if($UTTARBASTI_new){  echo 'UTTARBASTI => '.$UTTARBASTI_new.'<br>'; }?>
                                     
                                       <?php  if($YONIDHAVAN_new){  echo 'YONIDHAVAN => '.$YONIDHAVAN_new.'<br>'; }?>
                                     
                                       <?php  if($YONIPICHU_new){  echo 'YONIPICHU => '.$YONIPICHU_new.'<br>'; }?>
                                     
                                       <?php  if($SWA1_new){  echo 'VAMAN => '.$SWA1_new.'<br>'; }?>
                                    
                                       <?php  if($SWA2_new){  echo 'VAMAN => '.$SWA2_new.'<br>'; }?>
                                       
                                        <?php }?>
                                      <?php } else {?>
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
                                      <?php } ?>
                                      <?php if($profile->yearly_reg_no){ ?>
                                      <?php if(($HEMATOLOGICAL_new) || ($SEROLOGYCA_new) || ($BIOCHEMICAL_new) || ($MICROBIOLOGICAL_new) || ($X_RAY_new) || ($ECG_new) || ($USG_new) || ($PHYSIOTHERAPY_new)){?>
                                       <b> Adv- </b><br>
                                     
                                       <?php  if($HEMATOLOGICAL_new){  echo $HEMATOLOGICAL_new.'<br>'; }?>
                                     
                                       <?php  if($SEROLOGYCA_new){  echo $SEROLOGYCA_new.'<br>'; }?>
                                     
                                       <?php  if($BIOCHEMICAL_new){  echo $BIOCHEMICAL_new.'<br>'; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL_new){  echo $MICROBIOLOGICAL_new.'<br>'; }?>
                                     
                                       <?php  if($X_RAY_new){  echo $X_RAY_new.'<br>'; }?>
                                      
                                       <?php  if($ECG_new){  echo $ECG_new.'<br>'; }?>
                                     
                                       <?php  if($USG_new){  echo $USG_new.'<br>'; }?>
                                       
                                       <?php if($PHYSIOTHERAPY_new){ 
                                           
                                                echo $PHYSIOTHERAPY_new.'<br>';
                                            
                                           }
                                        ?>
                                      
                                      
                                      <?//php if($PHYSIOTHERAPY_new){ 
                                        //    $day = date('D',strtotime($profile->create_date)); 
                                        //    if($day == 'Mon' || $day == 'Thu'){
                                        //        echo $PHYSIOTHERAPY_new.'<br>';
                                        //    }
                                        //   }
                                        ?>
                                      
                                       
                                       <?php } } } ?>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                   <?php
                                $patient_auto_id = $adv_date->id;
                                $this->db->distinct();
                                $this->db->select('report_type');
                                $this->db->where('patient_auto_id', $patient_auto_id); 
                                $query = $this->db->get('investi_opd_report_result');
                                $query1 = $query->result();
                               // print_r($this->db->last_query());
                                $count = $query->num_rows();
                                  if($count >='1'){
                            ?>
                  
                  <div class="row" style="page-break-after: always;border: groove;">
                    <div class="col-sm-12" align="center" >
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                        <h1 style="border: inset;background-color: #f1f0ee;font-size: 23px;">LABORATORY INVESTIGATION SLIP</h1>
                    </div>
                    <div class="col-md-12 col-lg-12 "> 
                        <div class="container" style="width: 100%;">
                            <table class="table lab lab1" style="">
                                <tbody>
                                    <tr>
                                        <td>Patient's Name:-    <span style="font-weight: bold;"><?php echo (!empty($adv_date->firstname)?$adv_date->firstname:null) ?></span></td>
                                      <td>COPD No. :-  <span style="font-weight: bold;"><?php echo (!empty($adv_date->yearly_reg_no)?$adv_date->yearly_reg_no:null) ?></td>
                                  </tr>
                                    <tr>
                                        <td>Age:- <span style="font-weight: bold;"><?php echo (!empty($adv_date->date_of_birth)?$adv_date->date_of_birth:null) ?>&nbsp; Yrs. &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Sex:- <?php echo (!empty($adv_date->sex)?$adv_date->sex:null) ?></span></td>
                                        <td>Date:- <span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($adv_date->create_date)); ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Ward:- <span style="font-weight: bold;"><?php  if($adv_date->sex=='F') { echo 'Female';} else if($adv_date->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
                                  </tr>
                                </tbody>
                            </table>
                            <?php
                                $patient_auto_id = $profile->id;
                                $this->db->distinct();
                                $this->db->select('report_type');
                                $this->db->where('patient_auto_id', $patient_auto_id); 
                                $query = $this->db->get('investi_opd_report_result');
                                $query1 = $query->result();
                               // print_r($this->db->last_query());
                                $count = $query->num_rows();
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php for($i=0;$i<$count;$i++){
                                    
                                     $this->db->where('patient_auto_id', $patient_auto_id); 
                                    $this->db->where('report_type', $query1[$i]->report_type); 
                                    $query2 = $this->db->get('investi_opd_report_result');
                                    $result = $query2->result();
                                   // print_r($result);
                    ?>
                    
                    <div class="row" <?php if($i<($count-1) || $i>0) { echo 'style="page-break-after: always; padding-bottom:10px;" '; } ?>>
                        <div style="border: 1px solid;">
                        <div class="col-sm-12" align="center" style="margin-top: 7px;">  
                           
                            <h1> <?php $test_name = $result[0]->test_type; echo $test_name.' '.'Examination Report';?> </h1>
                          
                        <br>
                        </div>
                       
                        <div class="col-md-12" style="border-bottom: 1px solid;">
                            <div style="text-align:center;">
                                <h3> <?php $name =  $result[0]->report_section; echo $name.' '.'REPORT';?> </h3>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    <th>Unit</th>
                                    <th>Normal Value</th>
                                </thead>
                                <tbody>
                                    <?php foreach($result as $profilepatient => $pp) { ?>
                                    <tr>
                                        <td><strong><?php echo $pp->test_name; ?></strong></td>
                                        <td><?php echo $pp->result; ?></td>
                                        <td><?php echo $pp->unit; ?></td>
                                        <td><?php echo $pp->reference_range; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="text-align:center; border-bottom: 1px solid;margin-bottom: 20px;">
                            <b>------- End Report -------</b> 
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <b> Lab Assistant Signature</b>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <b> Doctor Signature</b>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                  
                  
                    <?php } ?>
                  
                  
                  
                 
                  
                  
                  
                  
                  <?php }?>
                  
                  <?php 
                        $this->db->select('*');
                	    $this->db->where('patient_id_auto',$profile->id);
                	    $last_opd_no = $this->db->get('manual_treatments');
                        $count = $last_opd_no->num_rows();
                       // print_r($count);
                  ?>
                  
                  <hr style="border-color: brown;">
         
                  <?php 
                   $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   
                    if($profile->old_reg_no){
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->old_reg_no)
                                     ->where('id >=',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                     $opd_no = $profile->old_reg_no." (Old)";
                     // $opd_no_old = $profile->old_reg_no;
                   } else {
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->yearly_reg_no)
                                     ->where('id >=',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                      $opd_no = $profile->old_reg_no." (Old)";
                      $opd_no_old = $profile->old_reg_no;
                     // $count= count($adv_date);
                     // print_r($adv_date);
                   }
                    $f_date= $adv_date->create_date;
                    $dignosis = $adv_date->dignosis;
                    //$profile->yearly_reg_no;
              $year = $this->session->userdata['acyear'];
              $newyear = '%'.$year.'%';
              $old = $adv_date->old_reg_no;
              
                  
            //  print_r($this->db->last_query());
                  
           
              if($f_date && $old) {
                
                $old_record_count = $this->db->select('*')
                    ->from('patient')
                    ->where('old_reg_no',$old)
                    ->where('create_date like',$newyear)
                    ->order_by('create_date','ASC')
                    ->get()
                    ->result();
              $count=count($old_record_count);
                
                for($i = 0; $i < $count;$i++)
                {
                  //print_r($old_record_count[$i]->create_date);
                //echo  $old_record_count['create_date'][$i];
                 // echo 'hi';
              ?>
                <div style="page-break-before: always;">
                    <br><br>
                    <b style="padding-left: 32px;background-color: #e8d8c4;">Follow up Date: <?php echo date('d-m-Y',strtotime($old_record_count[$i]->create_date));?><span>&emsp;</span>OPD No: <?php echo $opd_no;?></b><br>
                    <b style="padding-left: 32px;background-color: #e8d8c4;">Diagnosis: <?php echo  $old_record_count[$i]->dignosis;?></b><br>
                  <b style="padding-left: 32px;background-color: #e8d8c4;">Department ID: 
                    <?php
                  
                  $dept_id  = $this->db->select('*')->from('department')->where('dprt_id',$old_record_count[$i]->department_id)->get()->row();
                  echo  $dept_id->name;?></b>
                    <div class="row">
                     <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th style="border-left: 1px solid #333; border-right: 1px solid #333; width:90px;">दिनांक </th>
                                <th style="border-right: 1px solid #333;"> लक्षणे    </th>
                                <th style="border-right: 1px solid #333;">चिकित्सा </th>
                            </thead>
                            <?php 
                                        $che=trim($old_record_count[$i]->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $old_record_count[$i]->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                         
                                    //       if($t_c=='2'){
                                    //           // echo $dd;
                                              
                                    //             $dd1=substr($che, 0, -1);
                                    //         $p_dignosis = '%'.$arry[0].'%';
                                    //           trim($p_dignosis);
                                    //          $p_dignosis_name=$adv_date->dignosis;
                                    //   }else{
                                    //       //echo $dd;
                                           
                                    //         $p_dignosis = '%'.$che.'%';
                                    //         $p_dignosis_name=$adv_date->dignosis;
                                            
                                            
                                    //   }
                                    
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$old_record_count[$i]->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$old_record_count[$i]->dignosis;
                                        }
                                    
                                    if($old_record_count[$i]->manual_status==0){
                                        if($old_record_count[$i]->proxy_id){
                                            $tretment_old=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$old_record_count[$i]->proxy_id)
                                                ->where('department_id',$old_record_count[$i]->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                               
                                        }
                                        else{
                                            $tretment_old=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$old_record_count[$i]->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                                 //print_r($this->db->last_query());
                                            if(empty($tretment_old)){
                                                $tretment_old=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$old_record_count[$i]->department_id)
                                                    ->where('ipd_opd',$old_record_count[$i]->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment_old=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$old_record_count[$i]->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    if($old_record_count[$i]->manual_status=='1' || $old_record_count[$i]->created_by =='1' || $old_record_count[$i]->created_by =='2')
                                    {
                                        $tretment_old=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$old_record_count[$i]->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
			                      
			                      $RX1_old= $tretment_old->RX1;
			                      $RX2_old= $tretment_old->RX2;
			                      $RX3_old= $tretment_old->RX3;
			                      
                  					$RX4_old= $tretment_old->RX4;
			                      $RX5_old= $tretment_old->RX5;
			                      
                                $RX_other_old = $tretment_old->RX_other;
                                $RX_other1_old = $tretment_old->RX_other1;
                                $other_equipment = $tretment_old->other_equipment;
			                      $weight = $tretment_old->weight;
			                      $SNEHAN_old= $tretment_old->SNEHAN;
			                      $SWEDAN_old= $tretment_old->SWEDAN;
			                      $VAMAN_old= $tretment_old->VAMAN;
			                      
			                      $VIRECHAN_old= $tretment_old->VIRECHAN;
			                      $BASTI_old= $tretment_old->BASTI;
			                      $NASYA_old= $tretment_old->NASYA;
			                      
			                      $RAKTAMOKSHAN_old= $tretment_old->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI_old= $tretment_old->SHIRODHARA_SHIROBASTI;
			                      $SHIROBASTI_old= $tretment_old->SHIROBASTI;
			                      $OTHER_old= $tretment_old->OTHER;
			                      
			                      $SWA1_old= $tretment_old->SWA1;
			                      $SWA2_old= $tretment_old->SWA2;
			                      
			                      $HEMATOLOGICAL_old= $tretment_old->HEMATOLOGICAL;
			                      $SEROLOGYCAL_old= $tretment_old->SEROLOGYCAL;
			                      $BIOCHEMICAL_old= $tretment_old->BIOCHEMICAL;
			                      $MICROBIOLOGICAL_old= $tretment_old->MICROBIOLOGICAL;
			                      
			                      $X_RAY_old= $tretment_old->X_RAY;
			                      $ECG_old= $tretment_old->ECG;
			                      $USG_old= $tretment_old->USG;
			                      $symptoms_old= $tretment_old->sym_name;
			                      
			                      $PHYSIOTHERAPY_old= $tretment_old->PHYSIOTHERAPY;
                            ?>
                            <tbody>
                              <tr>
                                    <td style="border-left: 1px solid #333; border-right: 1px solid #333;"><?php echo date('d-m-Y',strtotime($old_record_count[$i]->create_date)); ?></td>
                                    <td style="border-right: 1px solid #333;">
                                     
                                     <b><?php if($tretment_old->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment_old->kco.'<br>';?> <?php }?>
                                     <!--<b>C/O : </b> <?//php echo $complanints[$complanints1]." Redured by ".$ruduce[$ruduce1].'%';?><br>-->
                                     <b>C/O : </b> <?php echo $symptoms_old;?><br>
                                      <b> H/O : </b> <?php if($tretment_old->h_o) { echo $tretment_old->h_o;}else { echo $adv_date->h_o;}?><br>
                                       <?php if($weight){ ?>
                                       <b>Weight : </b><?php echo $weight.' KG'; ?><br>
                                       <?php } ?>
                                     <b> Family History : </b> <?php if($tretment_old->f_o) { echo $tretment_old->f_o;}else { echo $adv_date->f_o;}?><br>
                                 <?php if($tretment_old->local_examination !='' && $tretment_old->local_examination !=NULL) {?>    <b>Local Examination :</b> <?php if($tretment_old->local_examination) { echo $tretment_old->local_examination;}?> <br><?php } ?>
                                 <?php if($tretment_old->old_investigation !='' && $tretment_old->old_investigation !=NULL) {?>    <b>Old Investigation :</b> <?php if($tretment_old->old_investigation) { echo $tretment_old->old_investigation;}?> <br><?php } ?>
                                    
                                    
                                    
                                     
                                     
                                    <?php 
                                        $temp1 = explode('-', $tretment_old->e_o);
                                        $temp_1 = $temp1[0];
                                        if(count($temp1)>1){
                                            $temp2 = explode(',', $temp1[1]);
                                            $rand_val = array_rand($temp2);
                                            $temp_2 = $temp2[$rand_val];
                                        }else{
                                            $temp_2 = '';
                                        }
                                    ?>
                                    <b><?//php if($tretment_old->e_o) { ?> </b><?//php echo 'E/O: '.$temp_1." - ".$temp_2;?> <?//php }?><br><br>
                                      <?php 
                                  if($adv_date->department_id =='29'){
                                  if($tretment_old->LMP || $tretment_old->NO_OF_DAYS ||$tretment_old->PATTERN ||$tretment_old->FLOW) {?>
                                      <b> M/H : </b><?php if($tretment_old->LMP){ echo $tretment_old->LMP; } ?><br>
                                       <?php if($tretment_old->NO_OF_DAYS){ echo $tretment_old->NO_OF_DAYS; } ?><br>
                                       <?php if($tretment_old->PATTERN){ echo $tretment_old->PATTERN; } ?><br>
                                       <?php if($tretment_old->FLOW){ echo $tretment_old->FLOW; } ?><br>
                                     <?php } } ?>
                                      
                                      
                                      <?php 
                                  if($adv_date->department_id =='29'){
                                  if($tretment_old->Obstetric_History || $tretment_old->Marita_Status ||$tretment_old->Marital_years) {?>
                                      <b> O/H : </b><?php if($tretment_old->Obstetric_History){ echo $tretment_old->Obstetric_History; } ?><br>
                                       <?php if($tretment_old->Marita_Status){ echo $tretment_old->Marita_Status; } ?><br>
                                       <?php if($tretment_old->Marital_years){ echo $tretment_old->Marital_years; } ?><br>
                                       
                                     <?php } } ?>
                                      
                                      
                                      
                                      
                                      <b> O/E-</b><br>
                                      
                                        <?//php if(!empty($tretment_old->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                      BP : <?php if($tretment_old->bp) { echo $tretment_old->bp,"   mm of Hg";} else { echo $adv_date->bp,"   mm of Hg";}?><br>
                                      <?php  if($tretment->temp) { ?>
                                      Temp : 
                                      <?php if($tretment->temp) { echo $tretment->temp,"ºF";}?><br>
                                      <?php } ?>
                                      Pulse : <?php if($tretment_old->pulse) { echo $tretment_old->pulse." /min";} else { echo 	          $adv_date->pulse." /min";} ?><br>
                                      नाडी : <?php if( $tretment_old->nadi){ echo $tretment_old->nadi;}else { echo $adv_date->nadi; }?><br>
                                      RS : <?php if($tretment_old->rs) { echo $tretment_old->rs; }else { echo 'NAD';}?><br>  
                                      CVS : <?php if( $tretment_old->cvs) { echo  $tretment_old->cvs; } else { echo $adv_date->cvs;}?><br>
                                      P / A : 
                                      <?php if($tretment_old->ra) { echo  $tretment_old->ra.' '.$pa_tre[$pa_tre1];} else { echo $adv_date->udar;}?><br>
                                      
                                      <?php if(!empty($tretment_old->pr)) { echo 'PR: '.$tretment_old->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                      <?php if(!empty($tretment_old->pv)) { echo  'PV: '.$tretment_old->pv.'<br>'; } ?>
                                      
                                    
                                        नेत्र
                                        : <?php  if($tretment_old->netra){ echo  $tretment_old->netra;} else { echo $adv_date->netra;}?><br>    
                                        जिव्हा 
                                        : <?php if(  $tretment_old->givwa){ echo  $tretment_old->givwa;} else { echo  $adv_date->givwa;}?><br>
                                        क्षुधा
                                        : <?php if($tretment_old->shudha){ echo  $tretment_old->shudha;} else{ echo  $adv_date->shudha;}?>
                                        <br>
                                        आहार : 
                                        <?php  if($tretment_old->ahar) { echo $tretment_old->ahar;} else { echo   $adv_date->ahar;}?><br> 
                                        मल : 
                                        <?php if($tretment_old->mal) { echo  $tretment_old->mal;}else { echo $adv_date->mal;}?><br>
                                        मूत्र
                                        : <?php if(!empty($tretment_old->mutra)){ echo $tretment_old->mutra;} else { echo  $adv_date->mutra;}?><br>
                                        निद्रा
                                        : <?php if($tretment_old->nidra){ echo $tretment_old->nidra;} else  { echo $adv_date->nidra;}?>
                                    </td>
                                     
                                    <td style="border-right: 1px solid #333;">
                                <b> RX - </b> 
                                        <?php if($RX1_old) {echo "<br>";echo "=>".$RX1_old;echo "<br>";}?><br>
                                        <?php if($RX2_old) { echo '=> '.$RX2_old;echo "<br>";}?><br>
                                        <?php if($RX3_old) {echo '=> '.$RX3_old;echo "<br><br>";}?>
                                       <?php if($RX4_old) {echo '=> '.$RX4_old;echo "<br><br>";}?>
                                       <?php if($RX5_old) {echo '=> '.$RX5_old;echo "<br><br>";}?>
                                        <?php if($RX_other_old) { echo '=> '.$RX_other_old;echo "<br><br>";}?>
                                       <?php if($RX_other1_old) { echo '=> '.$RX_other1_old;echo "<br><br>";}?>
                                       <?php if($other_equipment) { echo '=> '.$other_equipment;echo "<br><br>";}?>
                                        <br><br>
                                      
                                      
                                      
                                      <?php if($profile->department_id == '33'){ ?>
                                        <?php if(($SNEHAN_old) || ($SWEDAN_old) || ($VAMAN_old) || ($VIRECHAN_old) || ($BASTI_old) || ($NASYA_old) || ($RAKTAMOKSHAN_old) || ($SHIRODHARA_SHIROBASTI_old) || ($SHIROBASTI_old) || ($OTHER_old) || ($SWA1_old) || ($SWA2_old)){?>
                                       <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN_old){  echo 'SHEHAN => '.$SNEHAN_old.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN_old){  echo 'SWEDAN => '.$SWEDAN_old.'<br>'; }?>
                                    
                                       <?php  if($VAMAN_old){  echo 'VAMAN => '.$VAMAN_old.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN_old){  echo 'VIRECHAN => '.$VIRECHAN_old.'<br>'; }?>
                                      
                                        <?php  if($BASTI_old){  echo 'BASTI => '.$BASTI_old.'<br>'; }?>
                                     
                                       <?php  if($NASYA_old){  echo 'NASYA => '.$NASYA_old.'<br>'; }?>
                                     
                                       <?php  if($RAKTAMOKSHAN_old){  echo 'RAKTMOKSHAN => '.$RAKTAMOKSHAN_old.'<br>'; }?>
                                    
                                       <?php  if($SHIRODHARA_SHIROBASTI_old){  echo 'SHRODHARA => '.$SHIRODHARA_SHIROBASTI_old.'<br>'; }?>
                                       
                                       <?php  if($SHIROBASTI_old){  echo 'SHIROBASTI => '.$SHIROBASTI_old.'<br>'; }?>
                                    
                                       <?php  if($OTHER_old){  echo 'OTHER => '.$OTHER_old.'<br>'; }?>
                                       
                                       <?php  if($UTTARBASTI_old){  echo 'UTTARBASTI => '.$UTTARBASTI_old.'<br>'; }?>
                                     
                                       <?php  if($YONIDHAVAN_old){  echo 'YONIDHAVAN => '.$YONIDHAVAN_old.'<br>'; }?>
                                     
                                       <?php  if($YONIPICHU_old){  echo 'YONIPICHU => '.$YONIPICHU_old.'<br>'; }?>
                                     
                                       <?php  if($SWA1_old){  echo 'VAMAN => '.$SWA1_old.'<br>'; }?>
                                    
                                       <?php  if($SWA2_old){  echo 'VAMAN => '.$SWA2_old.'<br>'; }?>
                                       
                                        <?php }?>
                                      <?php } else {?>
                                        <?php if(($SNEHAN_old) || ($SWEDAN_old) || ($VAMAN_old) || ($VIRECHAN_old) || ($BASTI_old) || ($NASYA_old) || ($RAKTAMOKSHAN_old) || ($SHIRODHARA_SHIROBASTI_old) || ($SHIROBASTI_old) || ($OTHER_old) || ($SWA1_old) || ($SWA2_old)){?>
                                       <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN_old){  echo $SNEHAN_old.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN_old){  echo $SWEDAN_old.'<br>'; }?>
                                    
                                       <?php  if($VAMAN_old){  echo $VAMAN_old.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN_old){  echo $VIRECHAN_old.'<br>'; }?>
                                      
                                        <?php  if($BASTI_old){  echo $BASTI_old.'<br>'; }?>
                                     
                                       <?php  if($NASYA_old){  echo $NASYA_old.'<br>'; }?>
                                     
                                       <?php  if($RAKTAMOKSHAN_old){  echo $RAKTAMOKSHAN_old.'<br>'; }?>
                                    
                                       <?php  if($SHIRODHARA_SHIROBASTI_old){  echo $SHIRODHARA_SHIROBASTI_old.'<br>'; }?>
                                       
                                       <?php  if($SHIROBASTI_old){  echo $SHIROBASTI_old.'<br>'; }?>
                                    
                                       <?php  if($OTHER_old){  echo $OTHER_old.'<br>'; }?>
                                       
                                       <?php  if($UTTARBASTI_old){  echo $UTTARBASTI_old.'<br>'; }?>
                                     
                                       <?php  if($YONIDHAVAN_old){  echo $YONIDHAVAN_old.'<br>'; }?>
                                     
                                       <?php  if($YONIPICHU_old){  echo $YONIPICHU_old.'<br>'; }?>
                                     
                                       <?php  if($SWA1_old){  echo $SWA1_old.'<br>'; }?>
                                    
                                       <?php  if($SWA2_old){  echo $SWA2_old.'<br>'; }?>
                                       
                                        <?php }?>
                                      <?php } ?>
                                    
                                       
                                       <?php if(($HEMATOLOGICAL_old) || ($SEROLOGYCAL_old) || ($BIOCHEMICAL_old) || ($MICROBIOLOGICAL_old) || ($X_RAY_old) || ($ECG_old) || ($USG_old) || ($PHYSIOTHERAPY_old)){ ?>
                                       <b> Adv- </b><br>
                                     
                                       <?php  if($HEMATOLOGICAL_old){  echo  $HEMATOLOGICAL_old; }?>
                                     
                                       <?php  if($SEROLOGYCAL_old){  echo $SEROLOGYCAL_old; }?>
                                     
                                       <?php  if($BIOCHEMICAL_old){  echo $BIOCHEMICAL_old; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL_old){  echo $MICROBIOLOGICAL_old; }?>
                                     
                                       <?php  if($X_RAY_old){  echo $X_RAY_old; }?><br>
                                      
                                       <?php  if($ECG_old){  echo $ECG_old; }?><br>
                                     
                                       <?php  if($USG_old){  echo $USG_old; }?><br>
                                       
                                       <?php if($PHYSIOTHERAPY_old){ 
                                            $day = date('D',strtotime($adv_date->create_date)); 
                                            if($day == 'Mon' || $day == 'Thu'){
                                                echo $PHYSIOTHERAPY_old.'<br>';
                                            }
                                           }
                                        ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        
                
                
                
                
                <?php } } ?>
               
              
            
            
            

            </div> 



            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<script>
$("#submit").click(function(){

        var section = $('#section').val();
        var patient_auto_id = $('#patient_auto_id').val();
        var kstatus = $('#kstatus').val();
        

        $.ajax({

            url:'<?php echo base_url('patients/save_ksharsutra') ?>',

            type:'post',

            dataType:'json', 

            data:{
                'section' : section,
                'patient_auto_id' : patient_auto_id,
                'kstatus' : kstatus,

                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
              },
               success:function(data) {
                
                 console.log(data);
                if (data.status == true) { 
                    console.log(data);
                  alert('save Successfully!');
                } else {
                    alert('failed');
                }
            },
            error:function() {
                alert('failed!');
            } 
        });
})
   </script>