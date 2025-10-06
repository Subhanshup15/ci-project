<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('Patient_New/admitpatientdate'); ?>">
                                      
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

    <input type="hidden" name="section" class="form-control " id="section" value="ipd">

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

			                ->from('department')

			                ->where('dprt_id',$department_id)
                            ->get()

			                ->row();
			               
			               $name= $dept_name->name;
                           } else{
                               
                               $name ='';
                           }
                           
                           if($dept_id){
                            $dept_name=$this->db->select("*")

			                ->from('department')

			                ->where('dprt_id',$dept_id)
                            ->get()

			                ->row();
			               
			                 $dept_name= $dept_name->name;
                           } else{
                               
                               $dept_name ='';
                           }
                           
                               $ipd = ($patients[0]->ipd_opd);
                                
                    ?>            
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Central IPD Admit Patient Register</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                  
                
                          <?php  if($ipd == 'ipd') {?>
                         <!-- <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>-->
                         <!--<span style="float:right;"> <button onclick="excel_all_customer('<?php echo date('Y-m-d',strtotime($datefrom));?>','<?php echo date('Y-m-d',strtotime($dateto));?>','<?php echo 'ipd';?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button></span>-->

                          <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                         <?php }
                         if(!empty($department_id)){
                         $doctor_name1= $this->db->select("*")
                                    ->from('user')
			                       ->where('department_id', $department_id) 
                                    ->get()
                                    ->row();
                         if(!empty($doctor_name1->firstname)){ ?>
                         <lable style="float: right;">Doctor Name: <?php echo"<span style='font-weight: 600;'>".$doctor_name1->firstname."</span>"; ?></lable>
                         <?php } } ?>
                         

                </div>
                 <div class="col-xs-2"></div>
                 </div>
                 </div>
                
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?>>
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "COPD" ?>
                            </th> 
                            
                           
                            <th rowspan="2"><?php echo "Patient Name" ?></th> 
                       <!--     <th rowspan="2"><?php echo "Address" ?></th>    -->
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo display('sex') ?></th>   
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo "Age" ?></th>                  
                            <th rowspan="2" style="width: 1px;"><?php echo display('address') ?></th>
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                            <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "Bed No";?></th><?php } ?>
                            <th rowspan="2"  ><?php echo "Provisional Dignosis" ?></th>
                            <th rowspan="2" style="width: 30px;"><?php echo "Final Diagnosis";?></th>
                           <?php if($ipd=='opd'){ if($department_by !='dpt'){ ?><th style="width: 30px;" rowspan="2">Doctor Name</th><?php } }?>
                            <?php if($department_by !='dpt') {?><th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd'){ echo "Doctor Name" ;} else { echo "Date";}?></th> <?php } ?>
                          <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOA</th> <?php }?>
                           <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "DOD"?></th><?php } ?> 
                         
                            
                          
                           
                            <?php   
                                
                             $ipd = ($patients[0]->ipd_opd);
                                
                               if($ipd == 'ipd'){ ?>                                 
                                        <!-- <th><?php echo "Ipd No"?></th> -->
                                        <!-- <th style="width: 30px;"><?php echo "D. Date"?></th> -->
                              <?php  }  ?>
                            <th class="no-print" rowspan="2"><?php echo display('action') ?></th> 
                                                  
                         </tr>
                        <tr>                
                           
                            <th style="width: 30px;" >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th style="width: 30px;"><?php echo "Follow-up" ?></th>
                           
                                                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                            $datefrom1=date('Y-m-d',strtotime($datefrom));
                             $year1 = $this->session->userdata['acyear'];
                           // $year1 = date('Y');
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
                        
                        ////////////////////////////////////// serial no//////////////////
                         $dddd=date('Y-m-d',strtotime($datefrom));
                      if($dddd >='2020-02-01') {
                          $tot_serial_ipd=161;
                      } else{
                          $tot_serial_ipd=$num_ipd;
                      }
                       // $tot_serial_ipd=$num_ipd;
                        
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
                             $ky_mn=0;$ky_mo=0;$ky_fn=0;$ky_fo=0; $ky_tt=0;
                             $pn_mn=0;$pn_mo=0;$pn_fn=0;$pn_fo=0; $pn_tt=0;
                             $ba_mn=0;$ba_mo=0;$ba_fn=0;$ba_fo=0; $ba_tt=0;
                             $sly_mn=0;$sly_mo=0;$sly_fn=0;$sly_fo=0; $sly_tt=0;
                             $sky_mn=0;$sky_mo=0;$sky_fn=0;$sky_fo=0; $sky_tt=0;
                             $st_mn=0;$st_mo=0;$st_fn=0;$st_fo=0; $st_tt=0;
                             $vs_mn=0;$vs_mo=0;$vs_fn=0;$vs_fo=0; $vs_tt=0;
                            $skym_mn=0;$skym_mo=0;$skym_fn=0;$skym_fo=0; $skym_tt=0; $skym_ttn=0; $skym_ttan=0; $skym_ttdn=0;

                             
                              
                             foreach ($patients as $patient) { $i++;
                            
                              $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                             $dd12=date('Y-m-d', strtotime($_GET['end_date']));
                              if($_GET['end_date']){
                                  $dd1=date('Y-m-d', strtotime($_GET['end_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }


                              //sky_m
                                    if ($patient->department_id == '36') {
                                    $isNewReg = ($patient->yearly_reg_no || $patient->old_reg_no);
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    if ($isMale) {
                                    if ($patient->yearly_reg_no && $dd != $dd1) $skym_mn++;
                                    if ($patient->old_reg_no && $dd != $dd1) $skym_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($patient->yearly_reg_no && $dd != $dd1) $skym_fn++;
                                    if ($patient->old_reg_no && $dd != $dd1) $skym_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $sky_tt++;
                                    if ($aa != $dd1) $skym_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $skym_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $skym_ttan++;
                                    }
                                    }


                                                    

                                    if ($patient->department_id == '35') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $aa_mn++;
                                    if ($isOldReg) $aa_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $aa_fn++;
                                    if ($isOldReg && $dd != $dd1) $aa_fo++;
                                    }
                                    if ($dd != $dd1) $aa_tt++;
                                    }


                                    if ($patient->department_id == '34') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $ky_mn++;
                                    if ($isOldReg && $dd != $dd1) $ky_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $ky_fn++;
                                    if ($isOldReg && $dd != $dd1) $ky_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $ky_tt++;
                                    if ($aa != $dd1) $ky_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $ky_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $ky_ttan++;
                                    }
                                    }

                                    if ($patient->department_id == '33') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $pn_mn++;
                                    if ($isOldReg && $dd != $dd1) $pn_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $pn_fn++;
                                    if ($isOldReg && $dd != $dd1) $pn_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $pn_tt++;
                                    if ($aa != $dd1) $pn_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $pn_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $pn_ttan++;
                                    }
                                    }


                                    if ($patient->department_id == '32') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $ba_mn++;
                                    if ($isOldReg && $dd != $dd1) $ba_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $ba_fn++;
                                    if ($isOldReg && $dd != $dd1) $ba_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $ba_tt++;
                                    if ($aa != $dd1) $ba_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $ba_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $ba_ttan++;
                                    }
                                    }


                                    //sly
                                    if ($patient->department_id == '31') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $sly_mn++;
                                    if ($isOldReg && $dd != $dd1) $sly_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $sly_fn++;
                                    if ($isOldReg && $dd != $dd1) $sly_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $sly_tt++;
                                    if ($aa != $dd1) $sly_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $sly_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $sly_ttan++;
                                    }
                                    }


                                    //sky
                                    if ($patient->department_id == '30') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $sky_mn++;
                                    if ($isOldReg && $dd != $dd1) $sky_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $sky_fn++;
                                    if ($isOldReg && $dd != $dd1) $sky_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $sky_tt++;
                                    if ($aa != $dd1) $sky_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $sky_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $sky_ttan++;
                                    }
                                    }


                                    //st
                                    if ($patient->department_id == '29') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $st_mn++;
                                    if ($isOldReg && $dd != $dd1) $st_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $st_fn++;
                                    if ($isOldReg && $dd != $dd1) $st_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $st_tt++;
                                    if ($aa != $dd1) $st_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $st_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $st_ttan++;
                                    }
                                    }


                                    //sw
                                    if ($patient->department_id == '28') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $sw_mn++;
                                    if ($isOldReg && $dd != $dd1) $sw_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $sw_fn++;
                                    if ($isOldReg && $dd != $dd1) $sw_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $sw_tt++;
                                    }
                                    }


                                    //agad
                                    if ($patient->department_id == '27') {
                                    $isMale = ($patient->sex == 'M');
                                    $isFemale = ($patient->sex == 'F');
                                    $isNewReg = ($patient->yearly_reg_no);
                                    $isOldReg = ($patient->old_reg_no);
                                    if ($isMale) {
                                    if ($isNewReg && $dd != $dd1) $vs_mn++;
                                    if ($isOldReg && $dd != $dd1) $vs_mo++;
                                    }
                                    if ($isFemale) {
                                    if ($isNewReg && $dd != $dd1) $vs_fn++;
                                    if ($isOldReg && $dd != $dd1) $vs_fo++;
                                    }
                                    if ($dd != $dd1) {
                                    $vs_tt++;
                                    if ($aa != $dd1) $vs_ttn++;
                                    } elseif ($dd == $dd1) {
                                    $vs_ttdn++;
                                    }
                                    if ($dd1 == $aa) {
                                    $vs_ttan++;
                                    }
                                    }

                                 
                            
                                  $date_c=date('Y-m-d',strtotime($patient->create_date));
                                  $date_d=date('Y-m-d',strtotime($patient->discharge_date));
                                  $date_f= date('Y-m-d', strtotime($dateto));
                                  $tot_serial--;
                                  $tot_serial1++; 
                                  $tot_serial_ipd++; 
			                         
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
                                            $p_dignosis = '%'.$arry[0].'%';
                                             trim($p_dignosis);
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
                                                
                                            $p_dignosis = '%'.$arry[0].'%';
                                                         trim($p_dignosis);
                                             $p_dignosis_name=$patient->dignosis;
                                      }else{
                                           //echo $dd;
                                           
                                           $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                            
                                            
                                      }
                                    }
                                    
                                 if($patient->manual_status==0){
                                     
                                      $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('proxy_id',$patient->proxy_id)
			                         ->where('department_id',$patient->department_id)
			                         ->where('ipd_opd',$section_tret)
                                     ->get()
                                     ->row();
                                  
                                     if(empty($tretment)){
                                     
                                     
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         //->where('dignosis LIKE',$p_dignosis)
			                         //->where('ipd_opd ',$section_tret)
			                          ->where('department_id',$patient->department_id)
			                          ->where('ipd_opd',$patient->department_id)
                                     ->get()
                                     ->row();
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
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                       
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
                              ?>
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; }  else { echo ""; } ?>">
                                    <td style="padding:2px;"><?php if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; } ?></td>
                                       
                                    <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php echo $tot_serial_ipd_change;  ?></td> <?php } ?>  
                                    <?php 
                                    $date=date('Y',strtotime($patient->create_date));
                                    $dot_year=substr($date,2);
                                     $explode=explode('.',$patient->old_reg_no);
                                    $explode[1];
                                     ?>
                                    <td  style="padding:2px;"><?php if($patient->yearly_reg_no) { echo $patient->yearly_reg_no."/".$dot_year;} ?></td>
                                    <td  style="padding:2px;"><?php if($patient->old_reg_no) { echo $patient->old_reg_no; if($explode[1]==''){echo ".".$dot_year;}}?></td> <!-- //old patient no -->
                                                                 
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>
                                    <!--  <td  style="padding:2px;"><?php echo $patient->address; ?></td>   -->      
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    <td  style="padding:2px;"><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> 
                                  <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                    <?php if($department_by !='dpt') {?> <td  style="padding:2px;"><?php echo $patient->bedNo;?></td> <?php } ?>
                                    <td  style="padding:2px;"><?php  if($ipd == 'ipd'){ echo $p_dignosis_name; } else {echo $p_dignosis_name;}?></td> 
                                    <td  style="padding:2px;"><?php   if($tretment->POVISIONALdignosis){echo $tretment->POVISIONALdignosis;}else {echo $p_dignosis_name;}?></td> 
                                      <?php 
                                       // $join_date=date('Y-m-d',strtotime($patient->join_date));
                                       // $Reliving_date=date('Y-m-d',strtotime($patient->Reliving_date));
                                        $datefrom1=date('Y-m-d',strtotime($datefrom));
                                        
                                       $doctor_name= $this->db->select("*")
                                      ->from('user')
                                       ->where('join_date <=', $datefrom1) 
			                          ->where('department_id', $patient->department_id) 
			                           ->order_by("user_id", "desc")
			                         ->limit(1)
                                      ->get()
                                      ->row();
                                       $doctor_name->firstname;
                                      
                                      if(empty($doctor_name)){
                                          $doctor_name= $this->db->select("*")
                                      ->from('user')
                                      
			                          ->where('department_id', $patient->department_id) 
                                      ->get()
                                      ->row();
                                      }
                                      if($ipd=='opd'){ if($department_by !='dpt') {?><td style="width: 30px;"><?php echo $doctor_name->firstname;?></td> <?php } }?>
                                      
                                      <?php if($department_by !='dpt') {?>
                                    <td  style="padding:2px;"><?php 
                                    
                                    if($ipd == 'ipd'){ echo $doctor_name->firstname;} else { echo date('Y-m-d',strtotime($patient->create_date));}?></td><?php } ?>
                                    <?php  if($ipd == 'ipd'){ ?>  <td style="padding:2px; "><?php  echo date('d-m-Y',strtotime($patient->create_date));?></td> <?php }?>
                                    <?php if($department_by !='dpt') {?> 
                                    <td  style="padding:2px; width: 81px;">
                                        <?php
                                        if($patient->discharge_date!='0000-00-00')
                                        {
                                        echo date('d-m-Y',strtotime($patient->discharge_date));
                                        }else
                                        {
                                            echo"00-00-0000";
                                        }
                                        
                                        ?>
                                    </td> 
                                        <?php } ?> 
                                   

                                         
                                  
                                    <td class="center no-print"  style="padding:2px;">
                                        <?php 
                                            if($patient->ipd_opd == 'ipd'){ ?>
 												<?php if($patient->department_id == 30){ ?>
                                                <a href="<?php echo base_url("patients/ipdprofile_sky/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <?php } else {?>
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <?php } ?>                                                 
                                      		<a href="<?php echo base_url("patients/edit_ipd/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                            <?php }else { ?>
                                                
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                                 <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                            <?php } ?>
                                    </td>                                     
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  
                
                  <h3>Report Summary</h3>
        <?php 
$department_new =  $this->db->select('*')
->from('department_new')
->where('dprt_id!=','28')
->where('dprt_id!=','35')
// ->where('dprt_id!=','27')
->order_by('dprt_id','asc')
->get()->result();
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
        $male_new = $this->db->select('count(*) as male_new')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
        ->where('create_date>=', $datefrom)
         ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'M')
        ->where('yearly_reg_no !=', '')
        ->get()
        ->row();

        $male_old = $this->db->select('count(*) as male_old')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
        ->where('create_date>=', $datefrom)
         ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'M')
        ->where('old_reg_no !=', '')
        ->get()
        ->row();

        $female_new = $this->db->select('count(*) as female_new')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
       ->where('create_date>=', $datefrom)
         ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'F')
        ->where('yearly_reg_no !=', '')
        ->get()
        ->row();

        $female_old = $this->db->select('count(*) as female_old')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
         ->where('create_date>=', $datefrom)
         ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'F')
        ->where('old_reg_no !=', '')
        ->get()
        ->row();
       # print_r($this->db->last_query());



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

