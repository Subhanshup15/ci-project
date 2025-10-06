<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
#wrapper1, #wrapper2
{
width: 100%; 
border: none 0px RED;
overflow-x: scroll; 
overflow-y:hidden;
}
#wrapper1
{
height: 20px; 
}
#wrapper2
{
height: 100%; 
}
#div1 
{
width:1450px; height: 20px; 
}
#div2 
{
width:1450px; 
height: 100%; 
overflow: auto;
}

  
  #wrapper3, #wrapper4
{
width: 100%; 
border: none 0px RED;
overflow-x: scroll; 
overflow-y:hidden;
}
#wrapper3
{
height: 20px; 
}
#wrapper4
{
height: 100%; 
}
#div3 
{
width:1400px; height: 20px; 
}
#div4 
{
width:1400px; 
height: 100%; 
overflow: auto;
}
</style>

<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('Patient_New/patient_summery');?>">
<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  


<div class="form-group">
   
    <input type="text" name="section" class="form-control" id="section" value="<?php echo 'opd'; ?>" readonly>
</div>



<button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>



</form>
</div>
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print row">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              

                <?php   
                               $ipd = ($patients[0]->ipd_opd);
                                
                                if($ipd == 'ipd'){ ?>
                                    <div class="btn-group col-md-2"> 
                                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                                        </div> 
                              <?php }  ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
             <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
 
                    <?php   
                          if($department_id){
                            $dept_name=$this->db->select("*")

			                ->from('department_new')

			                ->where('dprt_id',$department_id)
                            ->get()

			                ->row();
			               
			               $name= $dept_name->name;
                           } else{
                               
                               $name ='';
                           }
                           
                           if($dept_id){
                            $dept_name=$this->db->select("*")

			                ->from('department_new')

			                ->where('dprt_id',$dept_id)
                            ->get()

			                ->row();
			               
			                 $dept_name= $dept_name->name;
                           } else{
                               
                               $dept_name ='';
                           }
                           
                               $ipd = ($patients[0]->ipd_opd);
                                
                        ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else { echo "Central"; }?> Register of Out Patient Department Summery <?php  if($name) { echo "(".$name.")";}?></h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>  </h4>
                         
                </div>
              <div class="col-xs-2"></div>
              </div>
              </div>
                <div class="row col-sm-12" style="padding-bottom: 10px;font-size: 14px;">
                      <?php if($this->session->userdata('status')==0){?>
                    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/checked_data'); ?>">
                    <div class="col-md-2" style="padding-top: 5px;">    
                    <input type="radio" name="check" value="0" <?php if((empty($check_data)) || ($check_data[0]->check_date==0)) { echo "checked";}?>>Unchecked 
                    <input type="radio" name="check" value="1"  <?php if((!empty($check_data)) && ($check_data[0]->check_date == 1)) { echo "checked";}?>>checked
                      </div>
                     <div class="col-md-2">
                    <input type="date" name="start_date1" class="form-control" id="start_date1" style="width:155px; margin-left: -21px;">
                    <input type="hidden" name="section" value="<?php if(($this->uri->segment(2) =='opd') || ($this->uri->segment(2)=='ipd')){ echo $this->uri->segment(2);} else { echo $_GET['section'];} ?>">
                    </div>
                    <div class="col-md-2">
                    <input type="submit" name="submit" class="btn btn-default active" value="Save" style="margin-left: -41px;">
                    </div>
                    </form>
                     <?php } ?>
                </div>
                <div class="scroller-container">
                  <div class="scroller-content">
              <div id="wrapper1">
    <div id="div1">
    </div>
</div>
<div id="wrapper2">
    <div id="div2">
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?> style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "Yearly No"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Daily No."; ?></th>
                            <th style="width: 30px; text-align: center;" colspan="2" ><?php echo "COPD" ?></th> 
                            <th rowspan="2" style="width: 30px;"><?php echo "Patient Name" ?></th>
                            <th rowspan="2"><?php echo "Age" ?></th>
                            <th rowspan="2"><?php echo "Sex" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Full Address"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th>
                            <th rowspan="2" style="width: 30px;"><?php echo "Diagnosis"; ?></th>
                            <th rowspan="2" style="width: 30px;"><?php echo "Symptoms"; ?></th>
                            <th rowspan="2"><?php echo "Treatement"; ?></th>
                            <th rowspan="2"><?php echo "Panchkarma"; ?></th>
                            <th rowspan="2"><?php echo "Investigation"; ?></th>
                            <th class="no-print" rowspan="2"><?php echo display('action') ?></th> 
                        </tr>
                        <tr> 
                            <th style="width: 30px;" ><?php echo "New No" ?></th> 
                            <th style="width: 30px;"><?php echo "Follow-Up" ?></th>
                        </tr>
                    </thead>
                    <?php //print_r($patients);exit; ?>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                            $datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y',strtotime($datefrom));
                            $year2='%'.$year1.'%';
                           
                        $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); 
					
						$this->db->select('*');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('yearly_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient');
                        $num = $query->num_rows();
                      
					    $this->db->select('*');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('old_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient');
                        $num1 = $query->num_rows();
                        
                        $tot_serial1=$num + $num1;
                        
                         $this->db->select('*');
                        $this->db->where('ipd_opd', 'ipd');
                       // $this->db->where('old_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient_ipd');
                        $num_ipd = $query->num_rows();
                        
                        $tot_serial_ipd=$num_ipd;
                       
                        // for department serial no
                        
                        $this->db->select('*');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('yearly_reg_no !=','');
                        $this->db->where('department_id =',$department_id);
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_d = $this->db->get('patient');
                        $num_d = $query_d->num_rows();
                       
					    $this->db->select('*');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('old_reg_no !=','');
                        $this->db->where('department_id =',$department_id);
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_dd = $this->db->get('patient');
                        $num1_d = $query_dd->num_rows();
                        
                        
                         $tot_serial1_d=$num_d + $num1_d;
                         if($tot_serial1_d==0){
                             $tot_serial1_d=1;
                         }
                         else{
                             $tot_serial1_d =$tot_serial1_d + 1;
                         }
                        //
                        
                        
                        ;
                        $array_no=count($patients);
                        $tot_serial=$tot_serial1 + $array_no + 1;
                        
                        $this->db->select('*');
                       // $this->db->where('ipd_opd', 'opd');
                        $this->db->where('discharge_date like','%0000-00-00%');
                        $this->db->where('create_date <=', date('Y-m-d')." 23:59:00");
                       // $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient_ipd');
                        $num_ipd1 = $query->num_rows();
                        //$num_ipd11=$num_ipd1 + 1;
                        $attay_count= count($patients);
                        //$num_ipd=  $num_ipd1 - $attay_count +1 ;
                       
                    if($department_by_section=='ipd'){
                       //  $num_ipd=  $num_ipd1;
                         $num_ipd=  1;
                    }else{
                        $num_ipd=  $num_ipd1 - $attay_count + 1 ;
                    }
                           
                          
?>
                            <?php $i = 0; 
                             $aa_mn=0;$aa_mo=0;$aa_fn=0;$aa_fo=0; $aa_tt=0; 
                             $ky_mn=0;$ky_mo=0;$ky_fn=0;$ky_fo=0; $ky_tt=0; $ky_ttn=0; $ky_ttan=0; $ky_ttdn=0; 
                             $pn_mn=0;$pn_mo=0;$pn_fn=0;$pn_fo=0; $pn_tt=0; $pn_ttn=0; $pn_ttan=0; $pn_ttdn=0;
                             $ba_mn=0;$ba_mo=0;$ba_fn=0;$ba_fo=0; $ba_tt=0; $ba_ttn=0;  $ba_ttan=0;  $ba_ttdn=0;
                             $sly_mn=0;$sly_mo=0;$sly_fn=0;$sly_fo=0; $sly_tt=0; $sly_ttn=0; $sly_ttan=0; $sly_ttdn=0;
                             $sky_mn=0;$sky_mo=0;$sky_fn=0;$sky_fo=0; $sky_tt=0; $sky_ttn=0; $sky_ttan=0; $sky_ttdn=0;
                             $st_mn=0;$st_mo=0;$st_fn=0;$st_fo=0; $st_tt=0; $st_ttn=0; $st_ttan=0; $st_ttdn=0;
                             $sw_mn=0;$sw_mo=0;$sw_fn=0;$sw_fo=0; $sw_tt=0;
                             $vs_mn=0;$vs_mo=0;$vs_fn=0;$vs_fo=0; $vs_tt=0; $vs_ttn=0; $vs_ttan=0; $vs_ttdn=0;
                               $skym_mn=0;$skym_mo=0;$skym_fn=0;$skym_fo=0; $skym_tt=0; $skym_ttn=0; $skym_ttan=0; $skym_ttdn=0;

                             
                              
                             foreach ($patients as $patient) { $i++;
                            
                            $dept_name=$this->db->select("*")->from('department_new')->where('dprt_id',$patient->department_id)->get()->row();
                            
                              $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                              $aa=date('Y-m-d', strtotime( $patient->create_date));
                             $dd12=date('Y-m-d', strtotime($_GET['end_date']));
                              if($_GET['end_date']){
                                $dd1=date('Y-m-d', strtotime($_GET['end_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }
                            
                           

                            
                                  $date_c=date('Y-m-d',strtotime($patient->create_date));
                                  $date_d=date('Y-m-d',strtotime($patient->discharge_date));
                                  $date_f= date('Y-m-d', strtotime($dateto));
                                  $tot_serial--;
                                  $tot_serial1++; 
                                  $tot_serial_ipd++;
                                  
                                  $date_f1=date('Y-m-d',strtotime($dateto));
                                  $date_f2='%'.$date_f1.'%';
                                   $opd_ipd_p=$this->db->select("*")

			                         ->from('patient_ipd')

			                          ->where('yearly_reg_no',$patient->yearly_reg_no)
			                          ->where('old_reg_no ',$patient->old_reg_no)
			                         ->where('create_date LIKE',$date_f2)
                                     ->get()
                                     ->row();
                                     $New_OPD=$opd_ipd_p->yearly_reg_no;
			                         $old_OPD= $opd_ipd_p->old_reg_no;
                                 
                                   if($ipd == 'ipd'){ 
                                         $che=trim($patient->dignosis);
                                        $section_tret='ipd';
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
                                       
                                    }
                                    else{
                                         $section_tret='opd';
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
                                    
			                      $symptoms= $tretment->sym_name;
			                      
			                      $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      $RX4= $tretment->RX4;
			                      $RX5= $tretment->RX5;
			                      
			                      $Only_1st_Dose= $tretment->Only_1st_Dose;
			                      
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
			                      $YONIDHAVAN= $tretment->YONIDHAVAN;
			                      $YONIPICHU= $tretment->YONIPICHU;
			                      $UTTARBASTI= $tretment->UTTARBASTI;
			                       
			                      $s_s= $tretment->skarma;
			                      $s_v= $tretment->vkarma;
			                      
			                    
			                      
			                      
			                       $SNEHAN= $tretment->SNEHAN;
			                     
			                      
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      
			                     
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;
			                      
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
			                      
			                      
			                     $datefrom_n=date('Y-m-d',strtotime($datefrom));  
			                      
			                     $admit_date=date('Y-m-d',strtotime($patient->create_date));
                                 if($patient->discharge_date=='0000-00-00'){
                                     
                                     $today_date=date('Y-m-d', strtotime($datefrom_n));
                                 } else{
                                  $today_date=date('Y-m-d', strtotime($datefrom_n));
                                 }  
                                 
                                    $date1=date_create($admit_date);
                                    $date2=date_create($today_date);
                                    $diff=date_diff($date1,$date2);
                                    $n= $diff->format("%a");
                                    
			                     $DISTRIBUTION_IPD=$tretment->DISTRIBUTION_IPD; 
                                 $ipd_days=$tretment->ipd_days; 
                                 $last_days=$ipd_days - $DISTRIBUTION_IPD;
                                 $DISTRIBUTION_IPD=$DISTRIBUTION_IPD - 1; 
			                     if(($DISTRIBUTION_IPD < $n) && ($ipd == 'ipd')){
			                         
			                         
			                         if($patient->manual_status==0){
                                      if($patient->proxy_id){
			                          
			                         
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                     ->where('proxy_id',$patient->proxy_id)
                                     ->where('department_id',$patient->department_id)
                                     ->order_by("id", "desc")
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                      }
                                      else{
                                          
                                       $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                      ->where('department_id',$patient->department_id)
                                      ->order_by("id", "desc")
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
			                         
			                     
			                     }
			                      
			                      
			                      // patient ipd yearly no
			                      $ipd_no_date=date('Y-m-d',strtotime($patient->create_date));
                                  $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                  $year122=date('Y',strtotime($patient->create_date));
                                  $year2='%'.$year122.'%';

                                  $this->db->select('*');
                                  $this->db->where('ipd_opd', 'ipd');
                                  $this->db->where('id <', $patient->id);
                                 // $this->db->where('create_date <=', $d_ipd_no);
                                  $this->db->where('create_date LIKE', $year2);
                                  $query = $this->db->get('patient_ipd');
                                  $num_ipd_change = $query->num_rows();
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;
						          
                                $date_f1=date('Y',strtotime($patient->create_date));
                                $date_f2='%'.$date_f1.'%';
                                $opd_ipd_p=$this->db->select("*")

			                         ->from('patient_ipd')

			                          ->where('yearly_reg_no',$patient->yearly_reg_no)
			                         
			                         ->where('create_date LIKE',$date_f2)
                                     ->get()
                                     ->row();
                                     
                                      $New_OPD=$opd_ipd_p->yearly_reg_no;
                              ?>
                              <?php
                                
                              ?>
                              
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else if(($New_OPD ==$patient->yearly_reg_no) && ($old_OPD == $patient->old_reg_no) && ($ipd == 'opd')){ echo "color: #ff000d;font-weight: bold;"; } else { echo ""; } ?>">
                                    
                                    <td style="padding:2px;"><?php echo $tot_serial1; ?></td>
                                    <td style="padding:2px;"><?php echo $i; ?></td>
                                    <td>
                                        <?php
                                            $year = $this->session->userdata['acyear'];
                                            $y=date('Y',strtotime($patient->create_date));
                                            if($y=='1970'){
                                                $y=$year;
                                                $yy=substr($y,2,2);
                                            }else{
                                                $yy=substr($y,2,2);
                                            }
                                            if($patient->yearly_reg_no != null){
                                                echo 	$yearly_reg_no= $patient->yearly_reg_no.".".$yy;
                                            }
                                        ?>
                                    </td>
                                      <td>
                                <?php
                                    $y=date('Y',strtotime($patient->fol_up_date));
                                    if($y=='1970'){
                                    $y=$year;
                                    $yy=substr($y,2,2);
                                    }else{
                                    $yy=substr($y,2,2);
                                    }
                                    if($patient->yearly_reg_no != null){
                                    } else {
                                    echo	$old_reg_no= $patient->old_reg_no."/".$yy;
                                    } ?>
                                </td>
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>    
                                    
                                    <td style="padding:2px;"><?php echo $patient->date_of_birth; ?></td> 
                                    <td style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                    <td style="padding:2px;"><?php echo $dept_name->name; ?></td>
                                    <td style="padding:2px;"><?php  echo $p_dignosis_name;?></td>
                                    <td style="padding:2px;"><?php  echo $symptoms;?></td>
                                    <?php if($New_OPD) {?> 
                                    	<td style="float:right;color: #ff000d;background-color: #eae4e4;"><?php  echo "<b>Admit the Patient in IPD ". (!empty($profile->name)?$profile->name:null).' Department Ward No. '.$ward.'</b>';?></td> 
                                    <?php } else {?>
                                    	<td style="padding:2px;">
                                    		<?php if($RX1){echo $RX1.', ';}?>
                                    		<?php if($RX2){echo $RX2.', ';}?>
                                    		<?php if($RX3){echo $RX3.', ';}?>
                                    		<?php if($RX4){echo $RX4.', ';}?>
                                    		<?php if($RX5){echo $RX5.', ';}?>
                                    	</td>
                                    <?php } ?>


                                   <?php
                                    $panch_patient_from_panchkarma_table = $this->db->select('*')->from('panchkarma_patient_count_opd')->where('patient_auto_id',$patient->id)->get()->row();
                                            
                                                if($patient->create_date>='2024-08-10')
                                                {
                                                    if($panch_patient_from_panchkarma_table)
                                                {
                                                    ?>
                                                    <td  style="padding:2px;">
                                                    <?php if($panch_patient_from_panchkarma_table->snehan){ echo $panch_patient_from_panchkarma_table->snehan.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->swedan){ echo $panch_patient_from_panchkarma_table->swedan.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->vaman){ echo $panch_patient_from_panchkarma_table->vaman.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->virechan){ echo $panch_patient_from_panchkarma_table->virechan.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->basti){ echo $panch_patient_from_panchkarma_table->basti.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->nasya){ echo $panch_patient_from_panchkarma_table->nasya.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->raktmokshan){ echo $panch_patient_from_panchkarma_table->raktmokshan.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->shirodhara){ echo $panch_patient_from_panchkarma_table->shirodhara.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->shirobasti){ echo $panch_patient_from_panchkarma_table->shirobasti.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->others){ echo $panch_patient_from_panchkarma_table->others.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->yonidhavan){ echo $panch_patient_from_panchkarma_table->yonidhavan.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->yonipichu){ echo $panch_patient_from_panchkarma_table->yonipichu.', <br>'; } ?>
                                                    <?php if($panch_patient_from_panchkarma_table->uttarbasti){ echo $panch_patient_from_panchkarma_table->uttarbasti.', <br>'; } ?>
                                            </td> 
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td></td>
                                                    <?php
                                                }
                                            ?>
                                            <?php }
                                            else{
                                            ?>
                                                <td  style="padding:2px;">
                                                <?php if($SNEHAN){ echo $SNEHAN.', <br>'; } ?>
                                                <?php if($SWEDAN){ echo $SWEDAN.', <br>'; } ?>
                                                <?php if($VAMAN){ echo $VAMAN.', <br>'; } ?>
                                                <?php if($VIRECHAN){ echo $VIRECHAN.', <br>'; } ?>
                                                <?php if($BASTI){ echo $BASTI.', <br>'; } ?>
                                                <?php if($NASYA){ echo $NASYA.', <br>'; } ?>
                                                <?php if($RAKTAMOKSHAN){ echo $RAKTAMOKSHAN.', <br>'; } ?>
                                                <?php if($SHIRODHARA_SHIROBASTI){ echo $SHIRODHARA_SHIROBASTI.', <br>'; } ?>
                                                <?php if($SHIROBASTI){ echo $SHIROBASTI.', <br>'; } ?>
                                                <?php if($OTHER){ echo $OTHER.', <br>'; } ?>
                                                <?php if($YONIDHAVAN){ echo $YONIDHAVAN.', <br>'; } ?>
                                                <?php if($YONIPICHU){ echo $YONIPICHU.', <br>'; } ?>
                                                <?php if($UTTARBASTI){ echo $UTTARBASTI.', <br>'; } ?>
                                            </td>  
                                              <?php } ?>
                                    

                                       <?php if($New_OPD) {?> 
                                    	<td></td> 
                                    <?php } else {?>




                                   <?php    $investi_patient_from_investigation_table = $this->db->select('*')->from('investi_patient_count_opd')->where('patient_auto_id',$patient->id)->get()->row();
                                           

                                                if($patient->create_date>='2025-01-01')
                                                {
                                                    if($investi_patient_from_investigation_table)
                                                {
                                                    ?>
                    <td  style="padding:2px;">
                    <?php if($investi_patient_from_investigation_table->hematology){ echo $investi_patient_from_investigation_table->hematology.', <br>'; } ?>
                    <?php if($investi_patient_from_investigation_table->serology){ echo $investi_patient_from_investigation_table->serology.', <br>'; } ?>
                    <?php if($investi_patient_from_investigation_table->biochemistry){ echo $investi_patient_from_investigation_table->biochemistry.', <br>'; } ?>
                    <?php if($investi_patient_from_investigation_table->microbiology){ echo $investi_patient_from_investigation_table->microbiology.', <br>'; } ?>

                    </td> 
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td></td>
                                                    <?php
                                                }} else{
                                            ?>
                                                    <td style="padding:2px;">
                                                        <?php if($HEMATOLOGICAL){ echo $HEMATOLOGICAL.', <br>'; } ?>
                                                        <?php if($SEROLOGYCAL){ echo $SEROLOGYCAL.', <br>'; } ?>
                                                        <?php if($BIOCHEMICAL){ echo $BIOCHEMICAL.', <br>'; } ?>
                                                        <?php if($MICROBIOLOGICAL){ echo $MICROBIOLOGICAL.', <br>'; } ?>
                                                        <?php if($X_RAY){ echo $X_RAY.', <br>'; } ?>
                                                        <?php if($ECG){ echo $ECG.', <br>'; } ?>
                                                     
                                                    </td>
                                          <?php } ?>


                                    <?php }?>
                                    <td class="center no-print"  style="padding:2px;">
                                        <?php 
                                            if($patient->ipd_opd == 'ipd'){ ?>
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                 <a href="<?php echo base_url("patients/edit_ipd/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                            <?php }else { ?>
                                                
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                                 <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                            <?php } ?>
                                       
                                       <!-- <a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> -->
                                    </td>                                     
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <!-- Table Summery -->
                
              </div>
              </div>
                
                  <h3>Report Summary</h3>
                   
                      <?php 
$department_new =  $this->db->select('*')->from('department_new')->order_by('dprt_id','asc')->get()->result();
?>

<table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
            <th style="width: 30px;" rowspan="2"><?php echo "Name" ?></th>
            <th style="width: 30px; text-align: center;" colspan="2"><?php echo "Male" ?></th>
            <th style="width: 30px; text-align: center;" colspan="2"><?php echo "Female" ?></th>
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            <th><?php echo "New No" ?></th>
            <th><?php echo "Follow-Up " ?></th>
            <th><?php echo "New No" ?></th>
            <th><?php echo "Follow-Up " ?></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $a = 1;
    $total_male_new = 0;
    $total_male_old = 0;
    $total_female_new = 0;
    $total_female_old = 0;

    foreach($department_new as $dept_new){
        $male_new = $this->db->select('count(*) as male_new')->from('patient')->where('department_id', $dept_new->dprt_id)->where('create_date', $datefrom)->where('ipd_opd', 'opd')->where('sex', 'M')->where('yearly_reg_no !=', '')->get()->row();
        $male_old = $this->db->select('count(*) as male_old')->from('patient')->where('department_id', $dept_new->dprt_id)->where('create_date', $datefrom)->where('ipd_opd', 'opd')->where('sex', 'M')->where('old_reg_no !=', '')->get()->row();
        $female_new = $this->db->select('count(*) as female_new')->from('patient')->where('department_id', $dept_new->dprt_id)->where('create_date', $datefrom)->where('ipd_opd', 'opd')->where('sex', 'F')->where('yearly_reg_no !=', '')->get()->row();
        $female_old = $this->db->select('count(*) as female_old')->from('patient')->where('department_id', $dept_new->dprt_id)->where('create_date', $datefrom)->where('ipd_opd', 'opd')->where('sex', 'F')->where('old_reg_no !=', '')->get()->row();

        // Add to the total counts
        $total_male_new += $male_new->male_new;
        $total_male_old += $male_old->male_old;
        $total_female_new += $female_new->female_new;
        $total_female_old += $female_old->female_old;
    ?>
        <tr>
            <td><?php echo $a++; ?></td>
            <td><?php echo $dept_new->name; ?></td>
            <td><?php echo $male_new->male_new; ?></td>
            <td><?php echo $male_old->male_old; ?></td>
            <td><?php echo $female_new->female_new; ?></td>
            <td><?php echo $female_old->female_old; ?></td>
            <td><?php echo $male_new->male_new + $male_old->male_old + $female_new->female_new + $female_old->female_old; ?></td> <!-- Total per department -->
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
            <td><?php echo $total_male_new; ?></td>
            <td><?php echo $total_male_old; ?></td>
            <td><?php echo $total_female_new; ?></td>
            <td><?php echo $total_female_old; ?></td>
            <td><?php echo $total_male_new + $total_male_old + $total_female_new + $total_female_old; ?></td> <!-- Total for all departments -->
        </tr>
    </tfoot>
</table>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function(){
  $('#btn_excel_download').click(function(){
			//"processing": true,
            //"serverSide": true,		
        $.ajax:{
            "url": "<?php echo base_url('patientList/opd')?>",
            "type": "POST",
			"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
           // url: "<?php echo base_url()?>patientList/ipd",
           // type:"POST",
        },
        "columnDefs":[{
            "targets":[-1],
            "orderable":false,
        }]
  });
});
</script>

<!-- //Discharge Date -->
                   
                    <script>
						$(document).ready(function(){
							$("#dischargedate").click(function(){
								var yearly_reg_no = document.getElementById("yearly_reg_no").value;
								var discharge_date = document.getElementById("discharge_date").value;

                                //alert('Hi');

								$.ajax({
									url: "<?php echo base_url(); ?>patients/dischargedate/" + discharge_date + "/" + yearly_reg_no,
									method: "POST",
									//data: {"otp": otp},
									dataType: "json",
                                    data: {
                                        '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>'
                                    },

									success: function (data) {
										//alert();
                                        if(data != "1") {
											//document.getElementById('otp_message').innerHTML = "Otp confirm";
											window.location.reload();
										}
										
									}
                                    // window.location.reload();
								});
								//alert();
							});
						});
					</script>
                    <script>
                        $(function() {
                            var d = new Date();
                            $("#discharge_date").datetimepicker({  
                                showSecond: false,
                                timeFormat: 'hh:mm',
                            }).datetimepicker("setDate", new Date());
                        });
                    </script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#patientdata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function excel_all_customer(date1,date2,section){ 
	   //alert(date1+" "+date2);
		window.location='excel_all_customer?date1='+date1+'&date2='+date2+'&section='+section;
	//	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
		// location.href='www.google.com';
	}
</script>
