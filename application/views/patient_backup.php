<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php if($flag==1){ echo base_url('patients/getpatientbydepartment_gob_date'); } else if($department_by=='dpt') { echo base_url('patients/getpatientbydepartment_date'); } else { echo base_url('patients/patient_by_date'); }?>">
                                      
 
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
            <div class="col-sm-12" align="center">  
                <strong><?php echo $this->session->userdata('title') ?></strong>
                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
 
 
 
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
                                
                                if($ipd =='ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} elseif($gob=='gob'){ echo "GOB"; } else { echo "Central";} ?> Register of In Patient Department <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; } elseif($dept_name){ echo"(".$dept_name.")" ;}?></h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else { echo "Central"; }?> Register of Out Patient Department <?php  if($name) { echo "(".$name.")";}?></h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                     <?php  }  ?>
                
                          <?php  if($summery_report == 0) { if($ipd == 'ipd') {?>
                          <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
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
                         <?php } } } ?>
                         
                         
                </div>
              
                <div class="row col-sm-12" style="padding-bottom: 10px;font-size: 14px;">
                      <?php if($this->session->userdata('status')==0){?>
                    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/checked_data'); ?>">
                  <!--  <form  method="POST" action="<?php echo base_url('patients/checked_data'); ?>" >-->
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
                    <!--<div style="float: right;" >
                    <button onclick="excel_all_customer('<?php echo date('Y-m-d',strtotime($datefrom));?>','<?php echo date('Y-m-d',strtotime($dateto));?>','<?php echo $ipd;?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button>
                    </div>-->
                </div>
              
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?> style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php if($ipd == 'opd'){ echo "Yearly No"; } else { echo "S.No";} ?></th>
                            <?php if($ipd == 'opd'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Daily No."; ?></th><?php } ?>   
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "COPD" ?>
                            </th> 
                            
                           
                            <th rowspan="2"><?php echo "Full Name of Patient" ?></th>   
                               <th style="width: 30px;"><?php echo "Full Address"; ?></th>
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo "Age" ?></th> 
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo display('sex') ?></th> 
                            <?php  if($ipd == 'opd'){ ?>  <th rowspan="2"><?php echo "Diagnosis"; ?></th> <?php } ?> 
                         
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                            <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd') { echo "Bed No";} else { echo "Remark";}?></th><?php } ?> 
                            <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOA</th> <?php }?>
                             <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOD</th> <?php }?>
                             <?php  if($ipd == 'ipd'){ ?> <th style="width: 30px;" ><?php echo "Provisional Diagnosis" ?></th><?php }?>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" ><?php echo "Final Diagnosis" ?></th> <?php } ?>
                         
                            <?php if(($department_by !='dpt') && ($ipd == 'ipd')) {?><th style="width: 30px;" rowspan="2"><?php echo "Name of Treating Dr.";?></th> <?php } ?>
                          
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" ><?php echo "Sign. Of Incharge Sister" ?></th> <?php } ?>
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX1"?></th> <?php }?>  
                           <?php if($department_by  =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX2"?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX3"?></th> <?php }?>
                           
                           <?php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX4"?></th> <?php }?>  
                           <?php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX5"?></th> <?php }?>
                           
                           <?php if(($department_by =='dpt') && ($gob !='gob')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php if($name=='Shalyatantra') { echo "SHASTRAKARMA";} elseif($name =='Shalakyatantra'){ echo "SHASTRAKARMA"; } else { echo "AASAN-I";}?></th> <?php }?>
                           <?php if(($department_by =='dpt') && ($gob =='gob')) {?> <?php }?>
                            
                           <?php if(($department_by =='dpt') && ($gob !='gob')) {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php if($name=='Shalyatantra') { echo "VRANOPAKRAM";} elseif($name =='Shalakyatantra'){ echo "VRANOPAKRAM"; } else { echo "AASAN-II";}?></th> <?php }?>
                          <?php if(($department_by =='dpt') && ($gob =='gob')) {?> <?php }?>
                        
                           <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SNEHAN"; ?></th> <?php }?>  
                            <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SWEDAN"; ?></th> <?php }?>  
                           <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "VAMAN"; ?></th> <?php }?>
                          
                           <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "VIRECHAN"; ?></th> <?php }?>
                           <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "BASTI"; ?></th> <?php }?>  
                           <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "NASYA"; ?></th> <?php }?>
                           
                            <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "RAKTAMOKSHAN"; ?></th> <?php }?>
                           <?php if($gob  =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SHIRODHARA"; ?></th> <?php }?>  
                           <?php if($gob =='gob') {?> <th style="width: 30px;" rowspan="2"><?php  echo "OTHER"; ?></th> <?php }?>

                           
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
                            <th style="width: 30px;"><?php echo "Old No" ?></th>
                           
                                                    
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
                             
                              
                             foreach ($patients as $patient) { $i++;
                            
                              $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                              $aa=date('Y-m-d', strtotime( $patient->create_date));
                             $dd12=date('Y-m-d', strtotime($_GET['end_date']));
                              if($_GET['end_date']){
                                $dd1=date('Y-m-d', strtotime($_GET['end_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }
                             
                            //atya
                                 if(($patient->sex=='M') && ($patient->department_id =='35') && ($patient->yearly_reg_no)){
                                     $patient->discharge_date; 
                                     if($dd != $dd1){
                                      $aa_mn++; 
                                   } else{}
                                   
                                  }
                                 if(($patient->sex=='M') && ($patient->department_id =='35') && ($patient->old_reg_no)){
                                    $aa_mo++; 
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='35') && ($patient->yearly_reg_no)){
                                     if($dd != $dd1){
                                    $aa_fn++; 
                                     } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='35') && ($patient->old_reg_no)){
                                        if($dd != $dd1){
                                    $aa_fo++; 
                                        } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='35'){
                                       if($dd != $dd1){
                                    $aa_tt++; 
                                       } else{}
                                     
                                 }
                                 //kay
                                  if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->yearly_reg_no)){
                                        if($dd != $dd1){
                                    $ky_mn++; 
                                  } else{}
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->old_reg_no)){
                                       if($dd != $dd1){
                                        $ky_mo++;   
                                       } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->yearly_reg_no)){
                                 if($dd != $dd1){ 
                                    $ky_fn++; 
                                 } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->old_reg_no)){
                                    
                                    if($dd != $dd1){ 
                                    $ky_fo++;
                                    } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='34'){
                                     
                                    if($dd != $dd1){      
                                    $ky_tt++; 
                                    if($aa != $dd1){
                                       $ky_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $ky_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                       // $ky_ttan++;
                                    }
                                    else{}
                                    if($dd1==$aa){
                                  
                                      $ky_ttan++;
                                    }
                                 }
                                 
                                 //pan
                                  if(($patient->sex=='M') && ($patient->department_id =='33') && ($patient->yearly_reg_no)){
                                     if($dd != $dd1){      
                                    $pn_mn++; 
                                  } else{}
                                     
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='33') && ($patient->old_reg_no)){
                                     if($dd != $dd1){      
                                    $pn_mo++;  
                                     } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='33') && ($patient->yearly_reg_no)){
                                      if($dd != $dd1){  
                                    $pn_fn++;   
                                      } else{} 
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='33') && ($patient->old_reg_no)){
                                       if($dd != $dd1){  
                                    $pn_fo++; 
                                 } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='33'){
                                       if($dd != $dd1){  
                                    $pn_tt++; 
                                     
                                     if($aa != $dd1){
                                       $pn_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $pn_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                      //  $pn_ttan++;
                                    }
                                       else{}
                                       if($dd1==$aa){
                                  
                                      $pn_ttan++;
                                    }
                                       
                                     
                                 }
                                 
                                  //bal
                                  if(($patient->sex=='M') && ($patient->department_id =='32') && ($patient->yearly_reg_no)){
                                       if($dd != $dd1){ 
                                    $ba_mn++; 
                                  } else{}
                                     
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='32') && ($patient->old_reg_no)){
                                        if($dd != $dd1){ 
                                    $ba_mo++; 
                                        } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='32') && ($patient->yearly_reg_no)){
                                       if($dd != $dd1){ 
                                    $ba_fn++;   
                                 } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='32') && ($patient->old_reg_no)){
                                       if($dd != $dd1){ 
                                    $ba_fo++;
                                       } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='32'){
                                     if($dd != $dd1){ 
                                    $ba_tt++; 
                                 if($aa != $dd1){
                                       $ba_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $ba_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                      //  $ba_ttan++;
                                    } 
                                 else{}
                                 
                                  if($dd1==$aa){
                                  
                                     $ba_ttan++;
                                    }
                                       
                                     
                                 }
                                 
                                   //sly
                                  if(($patient->sex=='M') && ($patient->department_id =='31') && ($patient->yearly_reg_no)){
                                      if($dd != $dd1){ 
                                    $sly_mn++; 
                                      } else{}
                                     
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='31') && ($patient->old_reg_no)){
                                     if($dd != $dd1){ 
                                    $sly_mo++; 
                                 } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='31') && ($patient->yearly_reg_no)){
                                     if($dd != $dd1){ 
                                    $sly_fn++; 
                                     } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='31') && ($patient->old_reg_no)){
                                     if($dd != $dd1){ 
                                    $sly_fo++;
                                     } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='31'){
                                    if($dd != $dd1){ 
                                    $sly_tt++;
                                    if($aa != $dd1){
                                       $sly_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $sly_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                     //   $sly_ttan++;
                                    } 
                                    else{}
                                    
                                      if($dd1==$aa){
                                  
                                     $sly_ttan++;
                                    }
                                     
                                 }
                            
                              //sky
                                  if(($patient->sex=='M') && ($patient->department_id =='30') && ($patient->yearly_reg_no)){
                                     if($dd != $dd1){ 
                                    $sky_mn++; 
                                     } else{}
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='30') && ($patient->old_reg_no)){
                                     if($dd != $dd1){ 
                                    $sky_mo++;
                                     } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='30') && ($patient->yearly_reg_no)){
                                     if($dd != $dd1){ 
                                    $sky_fn++;   
                                     } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='30') && ($patient->old_reg_no)){
                                     if($dd != $dd1){ 
                                    $sky_fo++; 
                                     } else{}
                                 }
                                 
                                 if($patient->department_id =='30'){
                                    if($dd != $dd1){ 
                                    $sky_tt++; 
                                     if($aa != $dd1){
                                       $sky_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $sky_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                       // $sky_ttan++;
                                    } 
                                    else{}
                                      if($dd1==$aa){
                                  
                                     $sky_ttan++;
                                    }
                                 }
                            
                            
                              //st
                                  if(($patient->sex=='M') && ($patient->department_id =='29') && ($patient->yearly_reg_no)){
                                     if($dd != $dd1){ 
                                    $st_mn++; 
                                     } else{}
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='29') && ($patient->old_reg_no)){
                                     if($dd != $dd1){ 
                                    $st_mo++;   
                                     } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='29') && ($patient->yearly_reg_no)){
                                    if($dd != $dd1){ 
                                    $st_fn++;   
                                    } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='29') && ($patient->old_reg_no)){
                                     if($dd != $dd1){ 
                                    $st_fo++;  
                                     } else{}
                                 }
                                 
                                 if($patient->department_id =='29'){
                                    if($dd != $dd1){ 
                                    $st_tt++; 
                                     if($aa != $dd1){
                                       $st_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $st_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                       // $st_ttan++;
                                    }
                                     else{}
                                     
                                      if($dd1==$aa){
                                  
                                     $st_ttan++;
                                    }
                                 }
                                 
                                   //sw
                                  if(($patient->sex=='M') && ($patient->department_id =='28') && ($patient->yearly_reg_no)){
                                    if($dd != $dd1){ 
                                    $sw_mn++; 
                                    } else{}
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='28') && ($patient->old_reg_no)){
                                    if($dd != $dd1){ 
                                    $sw_mo++;   
                                    } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='28') && ($patient->yearly_reg_no)){
                                    if($dd != $dd1){ 
                                    $sw_fn++;   
                                    } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='28') && ($patient->old_reg_no)){
                                    if($dd != $dd1){ 
                                    $sw_fo++;  
                                    } else{}
                                 }
                                 
                                 if($patient->department_id =='28'){
                                     if($dd != $dd1){ 
                                    $sw_tt++; 
                                     } else{}
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
                                     //print_r($opd_ipd_p);
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
                                    
                                    
                                    
                                     /*$ss=date('Y-m-d',strtotime($dateto));
                                    if($ss <= '202-01-28'){
                                        $table='treatments';
                                    }else{
                                        
                                         $table='treatments1';
                                    }
                                    */
                                    
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
			                      
			                      $Only_1st_Dose= $tretment->Only_1st_Dose;
			                      
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                       
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
			                      
			                      
			                     $datefrom_n=date('Y-m-d',strtotime($datefrom));  
			                      
			                     $admit_date=date('Y-m-d',strtotime($patient->create_date));
                                 if($patient->discharge_date=='0000-00-00'){
                                     //$discharge_date=date('Y-m-d', strtotime($admit_date. ' + 5 days'));
                                     
                                     $today_date=date('Y-m-d', strtotime($datefrom_n));
                                 } else{
                                 //$discharge_date=date('Y-m-d',strtotime($patient->discharge_date));
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
                              ?>
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else if(($New_OPD ==$patient->yearly_reg_no) && ($old_OPD == $patient->old_reg_no) && ($ipd == 'opd')){ echo "color: #ff000d;font-weight: bold;"; } else { echo ""; } ?>">
                                    <?php if($getpatientbydepartment_date =='D'){ ?>
                                    <td style="padding:2px;"><?php echo $tot_serial1_d++; ?></td>
                                    <?php } else {?>
                                    <td style="padding:2px;"><?php if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; }} ?></td>
                                    <?php if($ipd == 'opd'){ ?> <td style="padding:2px;"><?php echo $i; ?></td><?php } ?>   
                                       
                                    <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;} ?></td> <?php } ?>  
                                     <!-- //patient_id yearly sr no -->                                                                       
                                    <!-- <td><?php echo $patient->daily_reg_no; ?></td> -->
                                    <!-- <td><?php echo $patient->monthly_reg_no; ?></td>  -->
                                    <?php 
                                    $date=date('Y',strtotime($patient->create_date));
                                    $dot_year=substr($date,2);
                                     $explode=explode('.',$patient->old_reg_no);
			                       //print_r($import);
                                    $explode[1];
                                     ?>
                                   <!-- <td  style="padding:2px;"><?php if($patient->yearly_reg_no) { echo $patient->yearly_reg_no.".".$dot_year;} ?></td>
                                    <td  style="padding:2px;"><?php if($patient->old_reg_no) { echo $patient->old_reg_no; if($explode[1]==''){echo ".".$dot_year;}}?>
                                                                 -->
                                                                 
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
                                   // echo ".".$yy."(New)";
                                } else {
                                   
                                } ?>
                                </td>
                                
                                <td>
                                <?php
                                
                               $y=date('Y',strtotime($patient->create_date));
                               if($y=='1970'){
                                   $y=$year;
                                   $yy=substr($y,2,2);
                               }else{
                               $yy=substr($y,2,2);
                               }
                                 if($patient->yearly_reg_no != null){
                                   
                                } else {
                                   echo	$old_reg_no= $patient->old_reg_no.".".$yy;
                                    //echo  ".".$yy."(Old)";
                                } ?>
                                </td>
                                    <!--<td><?php echo $patient->ipd_no?></td>-->
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>    
                                    <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                   
                                    <td  style="padding:2px;"><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> 
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                 <?php  if($ipd == 'opd'){ ?>  <td><?php  echo $p_dignosis_name;?></td> <?php }?>
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                    <?php if($department_by !='dpt') {?> <td  style="padding:2px;"><?php if($ipd == 'ipd') { echo $patient->bedNo;} else{ echo "";}?></td> <?php } ?>
                                    <?php  if($ipd == 'ipd'){ ?>  <td><?php  echo date('Y-m-d',strtotime($patient->create_date));?></td> <?php }?>
                                      <?php  if($ipd == 'ipd'){ ?>  <td><?php   if($patient->discharge_date=='0000-00-00'){ echo '';} else { echo date('Y-m-d',strtotime($patient->discharge_date));}?></td> <?php }?>
                                    <?php  if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  echo $p_dignosis_name; ?></td> <?php } ?>
                                   <?php if($ipd == 'ipd'){ ?>  <td  style="padding:2px;"><?php  if($tretment->POVISIONALdignosis) { echo $tretment->POVISIONALdignosis; } else { echo $p_dignosis_name;} ?></td> <?php } ?> 
                                   
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
                                      ->where('join_date <=', $datefrom1) 
			                          ->where('department_id', $patient->department_id) 
			                           ->order_by("user_id", "desc")
			                         ->limit(1)
			                          //->where('department_id', $patient->department_id) 
                                      ->get()
                                      ->row();
                                      }
                                     ?>
                                      <?php if(($department_by !='dpt') && ($ipd == 'ipd')){?>
                                    <td  style="padding:2px;"><?php  echo $doctor_name->firstname;?></td><?php } ?>
                                    
                                     
                                     <?php if($ipd == 'ipd'){ ?>  <td  style="padding:2px;"><?php  echo ''; ?></td> <?php } ?> 
                                     
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php  if(($Only_1st_Dose) && ($n==0)) { echo $Only_1st_Dose." "; } echo $RX1; ?></td> <?php } ?>  
                                      <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX2; ?></td>  <?php }?> 
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX3; ?></td>  <?php }?>
                                       
                                        <?php  if(($ipd == 'ipd') && ($department_by =='dpt')){?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX4; ?></td>  <?php }?> 
                                         <?php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX5; ?></td>  <?php }?> 
                                         
                                         <?php  if(($department_by =='dpt') && ($gob !='gob')) {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php  if($name=='Shalyatantra') { $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){echo $s_s; }} elseif($name=='Shalakyatantra'){ $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){echo $s_s; } } else { echo $SWA1;}?></td>  <?php }?>
                                         <?php if(($department_by =='dpt') && ($gob =='gob')) { }?>
                                          <?php if(($department_by =='dpt') && ($gob !='gob')) {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php if($name=='Shalyatantra') { echo $s_v;} elseif($name=='Shalakyatantra'){ echo $s_v; } else { echo $SWA2;} ?></td>  <?php }?> 
                                          <?php if(($department_by =='dpt') && ($gob =='gob')) { }?>
                                      <!--  <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $KARMA; ?></td> <?php } ?>-->  
                                     <!-- <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK1; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK2; ?></td>  <?php }?> -->
                                        <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SNEHAN; ?></td>  <?php }?> 
                                        <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SWEDAN; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $VAMAN;  ?></td>  <?php }?>
                                       
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $VIRECHAN; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $BASTI;  ?></td>  <?php }?>
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $NASYA; ?></td>  <?php }?> 
                                       
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $RAKTAMOKSHAN; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SHIRODHARA_SHIROBASTI;  ?></td>  <?php }?>
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $OTHER; ?></td>  <?php }?> 
                                        
                                    <?php                       
                                        if($patient->ipd_opd == 'ipd'){ ?>                                   
                                                <!-- <td><?php echo $patient->ipd_no?></td> -->
                                                <!-- <td><?php 

                                                //echo 'dd',$patient->discharge_date; 
                                                
                                                if($patient->discharge_date != ''){
                                                // echo date("d/m/Y", strtotime($patient->discharge_date)); 
                                                }
                                                
                                                ?></td>                                                                                             -->
                                        <?php }   ?>
                                        
                                        
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
                
              
                
                  <h3>Report Summary</h3>
                   
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                             <th style="width: 30px;" rowspan="2"><?php echo "Name" ?></th>
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "Male" ?>
                            </th> 
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "Female" ?>
                            </th> 
                           
                            <th rowspan="2">Total</th>   
                                              
                         </tr>
                        <tr>                
                           
                            <th >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th><?php echo "Old No" ?></th>
                            <th  >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th><?php echo "Old No" ?></th>
                                                    
                        </tr>
                    </thead>
                    <tbody>
                    <?php $n=1;
                    $male_new=array($aa_mn,$ky_mn,$pn_mn,$ba_mn,$sly_mn,$sky_mn,$st_mn,$sw_mn);
                            $male_old=array($aa_mo,$ky_mo,$pn_mo,$ba_mo,$sly_mo,$sky_mo,$st_mo,$sw_mo);
                            
                            $female_new=array($aa_fn,$ky_fn,$pn_fn,$ba_fn,$sly_fn,$sky_fn,$st_fn,$sw_fn);
                            $female_old=array($aa_fo,$ky_fo,$pn_fo,$ba_fo,$sly_fo,$sky_fo,$st_fo,$sw_fo);
                            
                            $total=array($aa_tt,$ky_tt,$pn_tt,$ba_tt,$sly_tt,$sky_tt,$st_tt,$sw_tt);
                            
                    
                     $dept=$this->db->select("*")
                               ->from('department')
                               ->order_by('dprt_id','desc')
                               ->get()
                               ->result_array();
                     
                    for($i=0;$i<count($dept);$i++){?>        
                     <?php if($total[$i] !='0'){?> <tr>
                        <td><?php echo $n++;?></td> 
                        <td><?php if(($dept[$i]['name'] == 'Swasthrakshnam') && ($ipd == 'ipd')) { echo $dept[$i]['name']."-KC";} else { echo $dept[$i]['name']; }?></td>  
                        <td><?php echo $male_new[$i];?></td>   
                        <td><?php echo $male_old[$i];?></td>  
                        <td><?php echo $female_new[$i];?></td>   
                        <td><?php echo $female_old[$i];?></td>   
                        <td><?php echo $total[$i];?></td>
                      </tr>
                      <?php } }?>
                      
                       <tr>
                        <td colspan="2">Grand Total</td> 
                        <td><?php echo array_sum($male_new);?></td>
                        <td><?php echo array_sum($male_old);?></td>
                         <td><?php echo array_sum($female_new);?></td>
                        <td><?php echo array_sum($female_old);?></td>
                        <td><?php echo array_sum($total);?></td>  
                        <tr></tr>
                     </tbody>
             </table>
                          
        <?php if($ipd=='ipd') {?>                    
            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                             <th style="width: 30px;" ></th>
                             <th style="width: 30px;" >काय</th>
                             <th style="width: 30px;" >पंच</th>
                             <th style="width: 30px;" >बाल</th>
                             <th style="width: 30px;" >शल्य</th>
                             <th style="width: 30px;" >शालक्य</th>
                             <th style="width: 30px;" >स्त्री</th>
                             <th style="width: 30px;" >एकूण</th>
                                              
                         </tr>
                    </thead>
                       <tbody>
                        <tr>                
                           
                             <td>मा. प्र.</td> 
                             <td><?php echo $k=$ky_tt + $ky_ttdn - $ky_ttan; ?></td>   
                             <td><?php echo $p=$pn_tt + $pn_ttdn - $pn_ttan; ?></td> 
                             <td><?php echo $b=$ba_tt + $ba_ttdn - $ba_ttan; ?></td>   
                             <td><?php echo $sl=$sly_tt + $sly_ttdn - $sly_ttan; ?></td> 
                             <td><?php echo $sk=$sky_tt + $sky_ttdn - $sky_ttan; ?></td>   
                             <td><?php echo $s= $st_tt + $st_ttdn - $st_ttan; ?></td> 
                             <td><?php echo $t_t= $k + $p + $b + $sl + $sk + $s; ?></td> 
                        </tr>
                        <tr>                
                           
                             <td>निर्गमन</td> 
                              <td><?php echo $ky_ttdn; ?></td>   
                             <td><?php echo $pn_ttdn; ?></td> 
                             <td><?php echo $ba_ttdn; ?></td>   
                             <td><?php echo $sly_ttdn; ?></td> 
                             <td><?php echo $sky_ttdn; ?></td>   
                             <td><?php echo $st_ttdn; ?></td> 
                             <td><?php echo  $t_d=$ky_ttdn + $pn_ttdn + $ba_ttdn + $sly_ttdn + $sky_ttdn + $st_ttdn;?></td> 
                        </tr>
                        <tr>                
                           
                             <td>आगमन</td> 
                             <td><?php echo $ky_ttan; ?></td>   
                             <td><?php echo $pn_ttan; ?></td> 
                             <td><?php echo $ba_ttan; ?></td>   
                             <td><?php echo $sly_ttan; ?></td> 
                             <td><?php echo $sky_ttan; ?></td>   
                             <td><?php echo $st_ttan; ?></td> 
                             <td><?php echo  $t_a=$ky_ttan + $pn_ttan + $ba_ttan + $sly_ttan + $sky_ttan + $st_ttan;  ?></td> 
                        </tr>
                         <tr>                
                           
                             <td>एकूण</td> 
                             <td><?php echo ($k + $ky_ttan) - $ky_ttdn; ?></td>   
                             <td><?php echo ($p + $pn_ttan) - $pn_ttdn; ?></td> 
                             <td><?php echo ($b + $ba_ttan) - $ba_ttdn; ?></td>   
                             <td><?php echo ($sl + $sly_ttan) - $sly_ttdn; ?></td> 
                             <td><?php echo ($sk + $sky_ttan) - $sky_ttdn; ?></td>   
                             <td><?php echo ($s + $st_ttan) - $st_ttdn; ?></td> 
                             <td> <?php echo $t_t +  $t_a - $t_d;?></td>   
                        </tr>
                    
                    </tbody>
               </table>
               <?php }?>
              
               <!-- <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>             
                            <th><?php echo "S. No" ?></th>
                            <th><?php echo "Department Name" ?></th>                            
                            <th><?php echo "Gender" ?></th>                            
                            <th><?php echo "New Patient" ?></th>                       
                            <th><?php echo "Old Patient" ?></th>  
                            <th><?php echo "Total Count" ?></th>                     
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($gendercount)) { ?>
                            <?php $sl = 12141;

?>
                            <?php $i = 0;  foreach ($gendercount as $patient) { $i++; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo $i;?> </td>
                                    <td><?php echo $patient->name; ?></td> <!-- //patient_id yearly sr no 
                                    <td><?php echo $patient->sex; ?></td>
                                    
                                    <td><?php echo $patient->New; ?></td>
                                    <td><?php echo $patient->old; ?></td>  
                                    
                                    <td><?php echo $patient->New + $patient->old; ?></td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                    
                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Grand Total</td>
                                    <td><strong><?php echo $gendercounttotal[0]->totalNew;  ?></strong></td>
                                    <td><strong><?php echo $gendercounttotal[0]->totalold;  ?></strong></td>
                                    <td><strong><?php echo $gendercounttotal[0]->totalNew + $gendercounttotal[0]->totalold;  ?></strong></td>
                                </tr>
                </table> --> <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>


<!-- OTP Submission -->
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog" >
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add patient discharge date</h4>
                                </div>
								<?php ?>
                                <div class="modal-body">
                                    <div class="row">

                                        <form id="otp_confirm_form" name="otp_confirm_form" method="POST">
                                            <div class="col-xs-12">
                                                <label>Enter patient reg no</label>
                                                <input type="text" id="yearly_reg_no" name="yearly_reg_no" class="form-control"  autocomplete="off" />
												<div id="error_otp"></div>
                                            </div>

                                            <div class="col-xs-12">
                                                <label>Discharge Date</label>
                                                <input type="text" id="discharge_date" name="discharge_date" class="form-control datepicker"  autocomplete="off" />
												<div id="error_otp"></div>
                                            </div>



                                            <div class="col-xs-12" style="margin-top: 20px">
                                                <button type="button" name="dischargedate" class="btn btn-primary" value="dischargedate" id="dischargedate">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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