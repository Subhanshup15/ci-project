
 <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
 <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php if($flag==1){ echo base_url('Patient_New/gob_ipd_2025_date'); } ?>">

    <div class="form-group">
    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">

</div>  



<div class="form-group">
    <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>
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

                <?php   $ipd = ($patients[0]->ipd_opd);
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
                                
                                if($ipd =='ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} elseif($gob=='gob'){ echo "GOB"; } else { echo "Central";} ?> Register of In Patient Department <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; } elseif($dept_name){ echo"(".$dept_name.")" ;}?></h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else { echo "Central"; }?> Register of Out Patient Department <?php  if($name) { echo "(".$name.")";}?></h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>
                     <?php  }  ?>
                       
                       <?php  if($summery_report == 0) { if($ipd == 'ipd') {?>
                            <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                            <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                        <?php } } ?>
                         
                         
                          <?php if($this->session->userdata('user_role')==1){ ?>
                                <?php if(!empty($department_id))
                                {
                                    
                                    $doctor_name1= $this->db->select("*")
                                    ->from('user')
			                        ->where('department_id', $department_id)
			                        ->where('join_date<=', date("Y-m-d", strtotime($datefrom)))
			                        ->where('Reliving_date>=', date("Y-m-d", strtotime($dateto)))
                                    ->get()
                                    ->row();
                                    
                                    if(!empty($doctor_name1->firstname)){ ?>
                                        <lable style="float: right;margin-right: 50px;">Doctor Name: 
                                      
                                        </lable>
                                    <?php } } } else{   ?>
                                    
                                                    <?php if(!empty($department_id))
                                                    {
                                                        $doctor_name1= $this->db->select("*")
                                                        ->from('user')
                            			                ->where('department_id', $department_id)
                            			                 ->where('join_date<=', date("Y-m-d", strtotime($datefrom)))
			                                              ->where('Reliving_date>=', date("Y-m-d", strtotime($dateto)))
                                                        ->get()
                                                        ->row();
                                                        if(!empty($doctor_name1->firstname)){ ?>
                                                            <lable style="float: right;margin-right: 50px;">Doctor Name: <?php //echo"<span style='font-weight: 600;margin'>".$doctor_name1->firstname."</span>"; ?>
                                                            </lable>
                         
                                                    <?php } } }  ?>
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
              
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?> style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php if($ipd == 'opd'){ echo "Yearly No"; } else { echo "S.No";} ?></th>
                            <?php if($ipd == 'opd'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Daily No."; ?></th><?php } ?>   
                            <?php if($ipd == 'opd'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Monthly No."; ?></th><?php } ?>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "COPD" ?>
                            </th> 
                            
                           
                            <th rowspan="2"><?php echo "Patient Name" ?></th>   
                               <th rowspan="2" style="width: 30px;"><?php echo "Full Address"; ?></th>
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2" style="width: 10px;"><?php echo "Age" ?></th> 
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2" style="width: 10px;"><?php echo display('sex') ?></th> 
                            <!--<?php  if($ipd == 'opd'){ ?>  <th rowspan="2" style="width: 10px;"><?php echo "Diagnosis"; ?></th> <?php } ?> -->
                         
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                            <?php if($department_by !='dpt') {?><?php if($ipd == 'ipd') { ?> <th style="width: 30px;" rowspan="2"> Bed No </th> <?php } ?><?php } ?> 
                            <?php  if($ipd == 'ipd'){ ?><th  rowspan="2" style="width: 60px;">DOA</th><?php } ?> 
                             <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2" style="width: 60px;">DOD</th> <?php }?>
                             <?php  if($ipd == 'ipd'){ ?> <th  rowspan="2" style="width: 10px;"><?php echo " Diagnosis" ?></th><?php }?>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "Final Diagnosis" ?></th> <?php } ?>
                         
                            <?php if(($department_by !='dpt') && ($ipd == 'ipd')) {?><th style="width: 30px;" rowspan="2"><?php echo "Doctor Name";?></th> <?php } ?>
                          
                            
                            <?php 
                                if($department_by =='dpt') {
                            ?>
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "Treatment"?>
                                    </th>
                            <?php
                                }
                            ?>
                            
                           <!--<?//php if($department_by =='dpt') {?> <th style="width: 60px; <?//php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?//php echo "RX1"?></th> <?//php }?>  -->
                           <!--<?//php if($department_by  =='dpt') {?> <th style="width: 60px; <?//php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?//php echo "RX2"?></th> <?//php }?>  -->
                           <!--<?//php if($department_by =='dpt') {?> <th style="width: 60px; <?//php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?//php echo "RX3"?></th> <?//php }?>-->
                           
                           <!--<?//php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <th style="width: 60px; <?//php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?//php echo "RX4"?></th> <?//php }?>  -->
                           <!--<?//php  if(($ipd == 'ipd') && ($department_by =='dpt')) {?> <th style="width: 60px; <?//php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?//php echo "RX5"?></th> <?//php }?>-->
                           
                           <?php if($gob =='gob' || $department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "Panchkarma"; ?></th> <?php }?>
                           
                           <?php if($gob =='gob' || $department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "Investigation"; ?></th> <?php }?>
                           
                           <?php if(($department_by =='dpt') && ($gob !='gob')) {?> 
                                <?php if($name=='Shalyatantra') { ?>
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "SHASTRAKARMA"; ?>
                                    </th>
                                <?php } elseif($name =='Shalakyatantra'){ ?>
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "SHASTRAKARMA"; ?>
                                    </th>
                                <?php } elseif($name=='Swasthrakshnam') { ?> 
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "AASAN-I"; ?>
                                    </th>
                                <?php } ?>
                            <?php }?>
                           <?php if(($department_by =='dpt') && ($gob =='gob')) {?> <?php }?>
                            
                            <?php if(($department_by =='dpt') && ($gob !='gob')) {?> 
                                <?php if($name=='Shalyatantra') { ?>
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "VRANOPAKRAM"; ?>
                                    </th>
                                <?php } elseif($name =='Shalakyatantra'){ ?>
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "VRANOPAKRAM"; ?>
                                    </th>
                                <?php } elseif($name=='Swasthrakshnam') { ?> 
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "AASAN-II"; ?>
                                    </th>
                                <?php } ?>
                            <?php }?>
                          <?php if(($department_by =='dpt') && ($gob =='gob')) {?> <?php }?>
                        
                       
                           
                           

                           
                            <?php   
                                
                             $ipd = ($patients[0]->ipd_opd);
                                
                               if($ipd == 'ipd'){ ?>                                 
                                        <!-- <th><?php echo "Ipd No"?></th> -->
                                        <!-- <th style="width: 30px;"><?php echo "D. Date"?></th> -->
                              <?php  }  ?>
                                 
                                  
                           <th class="no-print" rowspan="2" style="width: 81px;"><?php echo display('action') ?></th> 
                                                  
                         </tr>
                        <tr>                
                           
                            <th style="width: 30px;" >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th style="width: 30px;"><?php echo "Follow-Up"?></th>
                           
                                                    
                        </tr>
                    </thead>
                    <?php //print_r($patients);//exit; ?>
                    <tbody>
                        <?php if (!empty($patients)) 
                        { ?>
                            <?php
                             $sl = 12141;
                            $datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y',strtotime($datefrom));
                            $year2='%'.$year1.'%';
                           
                         $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); ; 
					
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
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient_ipd');
                        $num_ipd = $query->num_rows();
                        $tot_serial_ipd=$num_ipd;                        
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
                    
                        
                        
                        ;
                        $array_no=count($patients);
                        $tot_serial=$tot_serial1 + $array_no + 1;
                        
                        $this->db->select('*');
                        $this->db->where('discharge_date like','%0000-00-00%');
                        $this->db->where('create_date <=', date('Y-m-d')." 23:59:00");
                        $query = $this->db->get('patient_ipd');
                        $num_ipd1 = $query->num_rows();
                        $attay_count= count($patients);
                        
                        
                          // for department Monthly no
                        $fdate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($datefrom1)) . ", first day of this month"));
                        $cdate = date('Y-m-d',strtotime("-1day".$datefrom1));
                        $this->db->select('count(*) as newCount');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('yearly_reg_no !=','');
                        if($department_id)
                            $this->db->where('department_id =',$department_id);
                        $this->db->where('create_date >=', $fdate);
                        $this->db->where('create_date <=', $cdate);
                        $this->db->where('create_date LIKE', $year2);
                        $query_d_m = $this->db->get('patient')->row();
                        $num_d_m = $query_d_m->newCount;
                                               
					    $this->db->select('count(*) as oldCount');
                        $this->db->where('ipd_opd', 'opd');
                        $this->db->where('old_reg_no !=','');
                        if($department_id)
                            $this->db->where('department_id =',$department_id);
                        $this->db->where('create_date >=', $fdate);
                        $this->db->where('create_date <=', $cdate);
                        $this->db->where('create_date LIKE', $year2);
                        $query_dd_m = $this->db->get('patient')->row();
                        $num1_d_m = $query_dd_m->oldCount;
                        
                        
                         $monthlySerialNo = $num_d_m + $num1_d_m;
                        if($monthlySerialNo==0){
                            $monthlySerialNo=1;
                        }
                        else{
                            $monthlySerialNo =$monthlySerialNo + 1;
                        }
                       
                    if($department_by_section=='ipd'){
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

                         
                         
                            $five_all_mn=0;$five_all_mo=0;$five_all_fn=0;$five_all_fo=0;
                            $five_sixteen_all_mn=0;$five_sixteen_all_mo=0;$five_sixteen_all_fn=0;$five_sixteen_all_fo=0;
                            $sixteen_fourtyfive_all_mn=0;$sixteen_fourtyfive_all_mo=0;$sixteen_fourtyfive_all_fn=0;$sixteen_fourtyfive_all_fo=0; 
                            $fourtyfive_sixty_all_mn=0;$fourtyfive_sixty_all_mo=0;$fourtyfive_sixty_all_fn=0;$fourtyfive_sixty_all_fo=0;
                            $sixty_above_all_mn=0;$sixty_above_all_mo=0;$sixty_above_all_fn=0;$sixty_above_all_fo=0;

                              
                             foreach ($patients as $patient) { $i++;
                            
                              $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                              $aa=date('Y-m-d', strtotime( $patient->create_date));
                             $dd12=date('Y-m-d', strtotime($_GET['start_date']));
                              if($_GET['start_date']){
                                $dd1=date('Y-m-d', strtotime($_GET['start_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }
                             
                                                if(stripos($patient->date_of_birth, 'MONTH') || stripos($patient->date_of_birth, 'MONTHS') || stripos($patient->date_of_birth, 'DAYS')) 
                                     {
                                       $calculate_year = $patient->date_of_birth; 
                                       $new_year = explode(" ",$calculate_year);
                                       $year__calculation = $new_year[0];
                                       if($year__calculation >='1' && $year__calculation <='12')
                                       {
                                         $age_year = $year__calculation;
                                       }
                                     }
                                      else
                                     {
                                        $month_days = $month_days = 0;                
                                     }
                                                              
                                                              
                                                              
                                                                                        $age_ranges = [
                                    ['min' => 0, 'max' => 5, 'male_new' => 'five_all_mn', 'male_old' => 'five_all_mo', 'female_new' => 'five_all_fn', 'female_old' => 'five_all_fo'],
                                    ['min' => 6, 'max' => 15, 'male_new' => 'five_sixteen_all_mn', 'male_old' => 'five_sixteen_all_mo', 'female_new' => 'five_sixteen_all_fn', 'female_old' => 'five_sixteen_all_fo'],
                                    ['min' => 16, 'max' => 45, 'male_new' => 'sixteen_fourtyfive_all_mn', 'male_old' => 'sixteen_fourtyfive_all_mo', 'female_new' => 'sixteen_fourtyfive_all_fn', 'female_old' => 'sixteen_fourtyfive_all_fo'],
                                    ['min' => 46, 'max' => 60, 'male_new' => 'fourtyfive_sixty_all_mn', 'male_old' => 'fourtyfive_sixty_all_mo', 'female_new' => 'fourtyfive_sixty_all_fn', 'female_old' => 'fourtyfive_sixty_all_fo'],
                                    ['min' => 61, 'max' => PHP_INT_MAX, 'male_new' => 'sixty_above_all_mn', 'male_old' => 'sixty_above_all_mo', 'female_new' => 'sixty_above_all_fn', 'female_old' => 'sixty_above_all_fo']
                                ];

                                $department_ids = ['36','35', '34', '33', '32', '31', '30', '29', '28'];

                                foreach ($age_ranges as $range) {
                                    if (
                                        in_array($patient->department_id, $department_ids) && 
                                        $patient->date_of_birth >= $range['min'] && 
                                        $patient->date_of_birth <= $range['max']
                                    ) {
                                        if ($patient->sex === 'M') {
                                            if ($patient->yearly_reg_no) {
                                                if ($dd != $dd1) ${$range['male_new']}++;
                                            }
                                            if ($patient->old_reg_no) {
                                                ${$range['male_old']}++;
                                            }
                                        } elseif ($patient->sex === 'F') {
                                            if ($patient->yearly_reg_no) {
                                                if ($dd != $dd1) ${$range['female_new']}++;
                                            }
                                            if ($patient->old_reg_no) {
                                                if ($dd != $dd1) ${$range['female_old']}++;
                                            }
                                        }
                                    }
                                }

                                if ($patient->department_id == '35' && $dd != $dd1) {
                                    $sixty_above_all_tt++;
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
                                  $date_f= date('Y-m-d', strtotime($datefrom));
                                  $tot_serial--;
                                  $tot_serial1++; 
                                  $tot_serial_ipd++;
                                  
                                  $date_f1=date('Y-m-d',strtotime($datefrom));
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
                                     
                          
                                      }
                                  }else{
                                      if($section_tret == 'ipd')
                                   {
                                      $tretment=$this->db->select("*")
			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->where('ipd_round_date ',$datefrom1)
                                     ->where('rounds','1')
                                     ->get()
                                     ->row();
                                   }else
                                   {
                                      $tretment=$this->db->select("*")
			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                   }
                                   
                                   
                                   if($patient->manual_status=='1' || $patient->created_by =='1' || $patient->created_by =='2')
                                    {
                                         if($section_tret == 'ipd')
                                   {
                                      $tretment=$this->db->select("*")
			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->where('ipd_round_date ',$datefrom1)
                                     ->where('rounds','1')
                                     ->get()
                                     ->row();
                                   }else
                                   {
                                      $tretment=$this->db->select("*")
			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    }
                                    
                                    
			                      
			                      $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      $RX4= $tretment->RX4;
			                      $RX5= $tretment->RX5;
			                      
			                      
			                      $RX_other_new= $tretment->RX_other;
			                      $RX_other1_new= $tretment->RX_other1;
			                      $other_equipment= $tretment->other_equipment;
			                      
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
                                   
			                        if($patient->manual_status=='1' || $patient->created_by =='1' || $patient->created_by =='2')
                                    {
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
			                      
			                      
			                      $RX_other= $tretment->RX_other;
			                      $RX_other1= $tretment->RX_other1;
			                      $other_equipment= $tretment->other_equipment;
			                         
			                         
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
                              <?php
                                
                              ?>
                              
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else if(($New_OPD ==$patient->yearly_reg_no) && ($old_OPD == $patient->old_reg_no) && ($ipd == 'opd')){ echo "color: #ff000d;font-weight: bold;"; } else { echo ""; } ?>">
                                    
                                    
                                    <?php if($getpatientbydepartment_date =='D'){ ?>
                                    <td style="padding:2px;"><?php if($ipd==opd){ echo $tot_serial1_d++; } else { echo $i; } ?></td>
                                    <?php } else {?>
                                    <td style="padding:2px;"><?php if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; }} ?></td>
                                    
                                    
                                    <?php if($ipd == 'opd'){ ?> <td style="padding:2px;"><?php echo $i; ?></td><?php } ?> 
                                    
                                       
                                    <?php 
                                        if($ipd == 'opd'){?>
                                            <?php if($department_by =='dpt'){?>
                                            <td style="padding: 2px;"><?php echo $monthlySerialNo++; ?> </td>
                                            <?php }else { ?>
                                            <td style="padding: 2px;">
                                        <?php echo $monthlySerialNo++;?></td>
                                    <?php } } ?>
                                     <?php if($ipd == 'ipd'){if($year122 == 2021){?>
                                        
                                        <td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; }?></td>
                                    <?php }else{ ?> 
                                        <td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;  } ?></td>
                                    <?php  } } ?> 
                                    
                                    <?php 
                                    $date=date('Y',strtotime($patient->create_date));
                                    $dot_year=substr($date,2);
                                     $explode=explode('.',$patient->old_reg_no);
                                    $explode[1];
                                     ?>
                                 
                                                                 
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
                                    echo 	$yearly_reg_no= $patient->yearly_reg_no."/".$yy;
                                   // echo ".".$yy."(New)";
                                } else {
                                   
                                } ?>
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
                                    //echo  ".".$yy."(Old)";
                                } ?>
                                </td>
                                  
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>    
                                    <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                   
                                    <td  style="padding:2px;"><?php echo $patient->date_of_birth; ?></td> 
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                 
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                    <?php if($department_by !='dpt') {?> 
                                        <?php if($ipd == 'ipd') { ?>
                                            <td  style="padding:2px;"><?php echo $patient->bedNo; ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php  if($ipd == 'ipd'){ ?>  <td><?php  echo date('d-m-Y',strtotime($patient->create_date));?></td> <?php }?>
                                    
                                    
                                    <?php if( $ipd == 'ipd') {?> <td>
                                  <?php 
                                    if($patient->discharge_date!='' && $patient->discharge_date!='0000-00-00') 
                                    { 
                                    echo date('d-m-Y',strtotime($patient->discharge_date));
                                    } 
                                  ?>
                                  </td> 
                                  <?php } ?>
                                    
                                    <?php  if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  echo $p_dignosis_name; ?></td> <?php } ?>
                                   <?php if($ipd == 'ipd'){ ?>  <td  style="padding:2px;"><?php  if($tretment->POVISIONALdignosis) { echo $tretment->POVISIONALdignosis; }else { echo $p_dignosis_name; } ?></td> <?php } ?> 
                                   
                                      <?php 
                                   
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
                                    <td  style="padding:2px;"><?//php  echo $doctor_name->firstname;?></td><?php } ?>
                                    
                                     
                                     
                              
                                        <?php if($department_by =='dpt') {?>
                                                <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                    <?php  if(($Only_1st_Dose) && ($n==0)) { echo $Only_1st_Dose." "; } ?>
                                                    <?php if($RX1){ echo $RX1.', <br>'; }?>
                                                    <?php if($RX2){ echo $RX2.', <br>'; }?>
                                                    <?php if($RX3){ echo $RX3.', <br>'; }?>
                                                    <?php if($RX4){ echo $RX4.', <br>'; }?>
                                                    <?php if($RX5){ echo $RX5.', <br>'; }?>
                                                    <?php if($RX_other){ echo $RX_other.', <br>'; }?>
                                                    <?php if($RX_other1){ echo $RX_other1.', <br>'; }?>
                                                    <?php if($other_equipment)
                                                    { 
                                                        ?>
                                                         <p><?php echo $other_equipment?></p> <br>'; 
                                                        <?php
                                                    }
                                                    ?>
                                        <?php }?>
                                        
                                        <?php if(($ipd == 'ipd' && $gob =='gob') || ($ipd == 'ipd' && $department_by =='dpt')) {?> 
                                          
                                          
                                          







<?php 
  $panch_patient_from_panchkarma_table = $this->db->select('*')->from('panchkarma_patient_count_ipd')->where('create_date',$datefrom)->where('patient_auto_id',$patient->id)->get()->row();
                                           

                                                if($patient->discharge_date>='2024-12-01')
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
                                                                                            }  else{                                          ?>

                                            <td  style="padding:2px;">
                                                <?php if($SNEHAN){ echo $SNEHAN.', <br>'; } ?>
                                                <?php if($SWEDAN){ echo $SWEDAN.', <br>'; } ?>
                                                
                                                <?php 
                                                $create_date = strtotime($patient->create_date);
                                               //echo "<br>";
                                                $final_date_vaman = strtotime("+6 days",$create_date);
                                                $vaman_date = date("d-m-Y",$final_date_vaman);
                                                //echo "<br>";
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                                <?php if($vaman_date == $d){ ?>
                                                <?php if($VAMAN){ echo $VAMAN.', <br>'; } ?>
                                                <?php } ?>
                                                
                                                
                                                
                                                <?php if($VIRECHAN){ echo $VIRECHAN.', <br>'; } ?>
                                                <?php if($BASTI){ echo $BASTI.', <br>'; } ?>
                                                
                                                <?php 
                                                $create_date = date("d-m-Y",strtotime($patient->create_date));
                                               
                                                $vaman_date = date("d-m-Y",$final_date_vaman);
                                                
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                            
                                            <?php if($create_date == $d) { ?> 
                                                <?php if($NASYA){ echo $NASYA.', <br>'; } ?>
                                                <?php } ?>
                                                
                                                
                                                <?php 
                                                $raktmokshan_date = date("d-m-Y",strtotime($patient->create_date));
                                               
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                                <?php if($raktmokshan_date == $d){ ?>
                                                <?php if($RAKTAMOKSHAN){ echo $RAKTAMOKSHAN.', <br>'; } ?>
                                                <?php } ?>
                                                
                                                
                                                <?php if($SHIRODHARA_SHIROBASTI){ echo $SHIRODHARA_SHIROBASTI.', <br>'; } ?>
                                                
                                                <?php 
                                                $shirobasti_date = strtotime($patient->create_date);
                                              
                                                $final_date_shirobasti = strtotime("+1 days",$create_date);
                                                $shirobasti_date = date("d-m-Y",$final_date_shirobasti);
                                              
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                            <?php if($shirobasti_date == $d) { ?>
                                                
                                                <?php if($SHIROBASTI){ echo $SHIROBASTI.', <br>'; } ?>
                                                
                                                <?php } ?>
                                                <?php if($OTHER){ echo $OTHER.', <br>'; } ?>
                                                
                                                <?php if($YONIDHAVAN){ echo $YONIDHAVAN.', <br>'; } ?>
                                                <?php if($YONIPICHU){ echo $YONIPICHU.', <br>'; } ?>
                                                <?php if($UTTARBASTI){ echo $UTTARBASTI.', <br>'; } ?>
                                            </td>  

                                            


<?php } ?>








                                        <?php } elseif($ipd == 'opd'){ ?>
                                            <?php if($patient->yearly_reg_no != '' || $patient->yearly_reg_no != NULL){ ?>
                                           
                                            <?php } else{ ?>
                                               
                                            <?php } ?>
                                        <?php } else{ ?>
                                           
                                        <?php } ?>
                                        
                                        
                                        <?php if($gob =='gob' || $department_by =='dpt') {?>
                                            <?php if($ipd == 'ipd' && date('Y-m-d',strtotime($patient->create_date)) == date('Y-m-d',strtotime($datefrom))){ ?>
                                                <td  style="padding:2px;">
                                                    <?php if($HEMATOLOGICAL){ echo $HEMATOLOGICAL.', <br>'; } ?>
                                                    <?php if($SEROLOGYCAL){ echo $SEROLOGYCAL.', <br>'; } ?>
                                                    <?php if($BIOCHEMICAL){ echo $BIOCHEMICAL.', <br>'; } ?>
                                                    <?php if($MICROBIOLOGICAL){ echo $MICROBIOLOGICAL.', <br>'; } ?>
                                                    <?php if($X_RAY){ echo $X_RAY.', <br>'; } ?>
                                                    <?php if($ECG){ echo $ECG.', <br>'; } ?>
                                                </td>
                                            <?php } elseif($ipd == 'opd'){ ?>
                                                <?php if($patient->yearly_reg_no != '' || $patient->yearly_reg_no != NULL){ ?>
                                                    <td style="padding:2px;">
                                                        <?php if($HEMATOLOGICAL){ echo $HEMATOLOGICAL.', <br>'; } ?>
                                                        <?php if($SEROLOGYCAL){ echo $SEROLOGYCAL.', <br>'; } ?>
                                                        <?php if($BIOCHEMICAL){ echo $BIOCHEMICAL.', <br>'; } ?>
                                                        <?php if($MICROBIOLOGICAL){ echo $MICROBIOLOGICAL.', <br>'; } ?>
                                                        <?php if($X_RAY){ echo $X_RAY.', <br>'; } ?>
                                                        <?php if($ECG){ echo $ECG.', <br>'; } ?>
                                                    </td>
                                                <?php } else{ ?>
                                                    <td style="padding:2px;"></td>
                                                <?php } ?>
                                            <?php } else{ ?>
                                                <td style="padding:2px;"></td>
                                            <?php } ?>
                                        <?php }?>
                                         
                                            <?php if(($department_by =='dpt') && ($gob !='gob')) {?> 
                                                <?php if($name=='Shalyatantra') { ?>
                                                    <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                        <?php
                                                            $admit_date=date('Y-m-d',strtotime($patient->create_date)); 
                                                            if($admit_date==date('Y-m-d',strtotime($datefrom))){
                                                                echo $s_s; 
                                                            }
                                                        ?>
                                                    </td>
                                                <?php } elseif($name=='Shalakyatantra'){ ?>
                                                    <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                        <?php
                                                            $admit_date=date('Y-m-d',strtotime($patient->create_date)); 
                                                            if($admit_date==date('Y-m-d',strtotime($datefrom))){
                                                                echo $s_s;
                                                            }
                                                        ?>
                                                    </td>
                                                <?php } elseif($name=='Swasthrakshnam'){ ?>
                                                    <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                        <?php echo $SWA1; ?>
                                                    </td> 
                                                <?php } ?>
                                            <?php }?>
                                         <?php if(($department_by =='dpt') && ($gob =='gob')) { }?>
                                         
                                         <?php if(($department_by =='dpt') && ($gob !='gob')) {?> 
                                                <?php if($name=='Shalyatantra') { ?>
                                                    <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                        <?php
                                                            echo $s_v;
                                                        ?>
                                                    </td>
                                                <?php } elseif($name=='Shalakyatantra'){ ?>
                                                    <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                        <?php
                                                            echo $s_v;
                                                        ?>
                                                    </td>
                                                <?php } elseif($name=='Swasthrakshnam'){ ?>
                                                    <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                        <?php echo $SWA2; ?>
                                                    </td> 
                                                <?php } ?>
                                            <?php }?>
                                        
                                        
                                 
                                        
                                    <td class="center no-print"  style="padding:2px;">
                                        <?php 
                                            if($patient->ipd_opd == 'ipd'){ ?>
                                            <?php if($patient->department_id == 30){ ?>
                                                <a href="<?php echo base_url("patients/ipdprofile_sky/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>

                                      <?php } else {?>
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                 <?php } ?><?php
                                         $user_role_id = $this->session->userdata('user_role');
                                         ?>   
                                            
                                            <?php if($user_role_id != '5') 
                                            {
                                            ?>
                                        <a href="<?php echo base_url("patients/edit_ipd/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <?php 
                                        } 
                                        ?>
                                            <?php }else { ?>
                                                <?php if($patient->department_id == 30){ ?>
                                                <a href="<?php echo base_url("patients/profile_sky/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <?php } else {?>
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <?php } ?>
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
                   
                           
 <?php 
$department_new =  $this->db->select('*')->from('department_new')->where('dprt_id',$dept_id)->where('dprt_id!=','28')->where('dprt_id!=','35')->where('dprt_id!=','27')->order_by('dprt_id','asc')
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
        ->where('create_date<=', $datefrom)
        ->group_start()
        ->where('discharge_date>',$datefrom)
        ->or_where('discharge_date like ','%0000-00-00%')
        ->group_end()
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'M')
        ->where('yearly_reg_no !=', '')
        ->get()
        ->row();

        $male_old = $this->db->select('count(*) as male_old')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
        ->where('create_date<=', $datefrom)
        ->group_start()
        ->where('discharge_date>',$datefrom)
        ->or_where('discharge_date like ','%0000-00-00%')
        ->group_end()
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'M')
        ->where('old_reg_no !=', '')
        ->get()
        ->row();

        $female_new = $this->db->select('count(*) as female_new')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
        ->where('create_date<=', $datefrom)
        ->group_start()
        ->where('discharge_date>',$datefrom)
        ->or_where('discharge_date like ','%0000-00-00%')
        ->group_end()
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'F')
        ->where('yearly_reg_no !=', '')
        ->get()
        ->row();

        $female_old = $this->db->select('count(*) as female_old')
        ->from('patient_ipd')
        ->where('department_id', $dept_new->dprt_id)
        ->where('create_date<=', $datefrom)
        ->group_start()
        ->where('discharge_date>',$datefrom)
        ->or_where('discharge_date like ','%0000-00-00%')
        ->group_end()
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'F')
        ->where('old_reg_no !=', '')
        ->get()
        ->row();



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
          
                       
       
            
        <?php
$department_new =  $this->db->select('*')
    ->from('department_new')->where('dprt_id',$dept_id)
    ->where('dprt_id!=', '28')
    ->where('dprt_id!=', '35')
    ->where('dprt_id!=', '27')
    ->order_by('dprt_id', 'asc')
    ->get()->result();
?>
<table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 30px;"> </th>
            <?php foreach ($department_new as $dept_new) { ?>
                <th><?php echo $dept_new->name; ?></th>
            <?php } ?>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>OLD</td>
            <?php
            $a = 1;
            $total_old = 0;
            foreach ($department_new as $dept_new) {
                $old = $this->db->select('count(*) as old')
                    ->from('patient_ipd')
                    ->where('department_id', $dept_new->dprt_id)
                    ->where('create_date<', $datefrom)
                    ->group_start()
                    ->where('discharge_date>=', $datefrom)
                    ->or_where('discharge_date like ', '%0000-00-00%')
                    ->group_end()
                    ->where('ipd_opd', 'ipd')
                    ->get()
                    ->row();
                    $total_old += $old->old;

            ?>
                <td><?php echo $old->old; ?></td>
            <?php
            }  ?>
            <td><?php echo $total_old; ?></td>
        </tr>
        <tr>
            <td>DISCHARGE</td>
            <?php
            $total_discharge = 0;
            foreach ($department_new as $dept_new) {
                $discharge = $this->db->select('count(*) as discharge')
                    ->from('patient_ipd')
                    ->where('department_id', $dept_new->dprt_id)
                    ->where('create_date<=', $datefrom)
                    ->where('discharge_date', $datefrom)
                    ->where('ipd_opd', 'ipd')
                    ->get()
                    ->row();
                    $total_discharge += $discharge->discharge;
            ?>
                <td><?php echo $discharge->discharge; ?></td>
            <?php
            }
            ?>
            <td><?php echo $total_discharge; ?></td>
        </tr>
        <tr>
        <td>Total</td>
        <?php
        $total_total = 0;
            foreach ($department_new as $dept_new) {
                $total = $this->db->select('count(*) as total')
                    ->from('patient_ipd')
                    ->where('department_id', $dept_new->dprt_id)
                    ->where('create_date<', $datefrom)
                    ->group_start()
                    ->where('discharge_date>', $datefrom)
                    ->or_where('discharge_date like', '%0000-00-00%')
                    ->group_end()
                    ->where('ipd_opd', 'ipd')
                    ->get()
                    ->row();
                    $total_total += $total->total;
                    // print_r($this->db->last_query());
            ?>
        <td><?php echo $total->total; ?></td>
        <?php } ?>
        <td><?php echo $total_total; ?></td>
        </tr>
        <tr>
            <td>NEW</td>
            <?php
            $total_new = 0;
            foreach ($department_new as $dept_new) {
                $new = $this->db->select('count(*) as new')
                    ->from('patient_ipd')
                    ->where('department_id', $dept_new->dprt_id)
                    ->where('create_date=', $datefrom)
                    ->where('ipd_opd', 'ipd')
                    ->get()
                    ->row();
                    $total_new += $new->new;
            ?>
                <td><?php echo $new->new; ?></td>
            <?php } ?>

            <td><?php echo $total_new; ?></td>
        </tr>
        <tr>
            <td> GRAND TOTAL</td>

            <?php
            $total_grand_total = 0;
            foreach ($department_new as $dept_new) {
                $grand_total = $this->db->select('count(*) as grand_total')
                    ->from('patient_ipd')
                    ->where('department_id', $dept_new->dprt_id)
                    ->where('create_date<=', $datefrom)
                    ->group_start()
                    ->where('discharge_date >', $datefrom)
                    ->or_where('discharge_date like ', '%0000-00-00%')
                    ->group_end()
                    ->where('ipd_opd', 'ipd')
                    ->get()
                    ->row();
                    $total_grand_total += $grand_total->grand_total;
            ?>

                <td><?php echo $grand_total->grand_total; ?></td>
            <?php } ?>
            <td><?php echo $total_grand_total; ?></td>
        </tr>
    </tbody>

</table>
                     <?php if(($department_by =='dpt') && ($ipd=='ipd')) {?>   
                       
                       <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                         <th>IPD</th>
                        <th>MALE</th>
                      	<th>FEMALE</th>
                      <th>Total</th>
                    </tr>
             
                </thead>
                <tbody>
                  
                  
                  
<?php
                    $male_new=array($five_all_mn,$five_sixteen_all_mn,$sixteen_fourtyfive_all_mn,$fourtyfive_sixty_all_mn,$sixty_above_all_mn);
                    $female_new=array($five_all_fn,$five_sixteen_all_fn,$sixteen_fourtyfive_all_fn,$fourtyfive_sixty_all_fn,$sixty_above_all_fn);

                  $total_male_new = array('0-5','05-16','16-45','45-60','60 & Above');
                  ?>
                  <?php for($j=0;$j<count($total_male_new);$j++) {?>
                    <tr>
                      <td><?php echo $total_male_new[$j]; ?></td>
                      <td><?php echo $male_new[$j]; ?></td>
                      <td><?php echo $female_new[$j]; ?></td>
                      <td><?php echo $male_new[$j]+$female_new[$j] ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                  </tr>
                  <tr>																						
                      <td><b>SIGN</b></td>  
                    <td colspan='2'><b>TOTAL</b></td>
                       <td colspan='2'><b><?php echo array_sum($male_new) + array_sum($female_new);?></b></td>
                    </tr>
                </tbody>
            </table>   
                      <?php }?>   
                        <?php if(($department_by =='dpt') && ($ipd!='ipd')){?>
                       <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th colspan='2'>MALE</th>
                      	<th colspan='2'>FEMALE</th>
                    </tr>
                  <tr>
                    <th>OPD</th>
                    <th>New</th>
                    <th>Old</th>
                    <th>New</th>
                    <th>Old</th>
                  </tr>
                  
                </thead>
                <tbody>
                  
                  
                  
<?php
                    $male_new=array($five_all_mn,$five_sixteen_all_mn,$sixteen_fourtyfive_all_mn,$fourtyfive_sixty_all_mn,$sixty_above_all_mn);
                    $male_old=array($five_all_mo,$five_sixteen_all_mo,$sixteen_fourtyfive_all_mo,$fourtyfive_sixty_all_mo,$sixty_above_all_mo);
                    $female_new=array($five_all_fn,$five_sixteen_all_fn,$sixteen_fourtyfive_all_fn,$fourtyfive_sixty_all_fn,$sixty_above_all_fn);
                    $female_old=array($five_all_fo,$five_sixteen_all_fo,$sixteen_fourtyfive_all_fo,$fourtyfive_sixty_all_fo,$sixty_above_all_fo);

                  $total_male_new = array('0-5','05-16','16-45','45-60','60 & Above');
                  //print_r($male_new);
                  ?>
                  <?php for($j=0;$j<count($total_male_new);$j++) {?>
                    <tr>
                      <td><?php echo $total_male_new[$j]; ?></td>
                      <td><?php echo $male_new[$j]; ?></td>
                      <td><?php echo $male_old[$j]; ?></td>
                      <td><?php echo $female_new[$j]; ?></td>
                      <td><?php echo $female_old[$j]; ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td><b>Total</b></td>
                    <td><b><?php echo array_sum($male_new);?></b></td>
                    <td><b><?php echo array_sum($male_old);?></b></td>
                    <td><b><?php echo array_sum($female_new);?></b></td>
                    <td><b><?php echo array_sum($female_old);?></b></td>
                  </tr>
                  <tr>																						
                      <td><b>Grand Total</b></td>
                       <td colspan='4' style="text-align: center;"><b><?php echo array_sum($male_new) + array_sum($male_old) + array_sum($female_new) + array_sum($female_old);?></b></td>
                    </tr>
                </tbody>
            </table>           
                     <?php }?>   
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