<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php if($flag==1){ echo base_url('patients/getpatientbydepartment_gob_date'); } else if($department_by=='dpt') { echo base_url('patients/getpatientbydepartment_date_sky'); } else { echo base_url('patients/patient_by_date'); }?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
    <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
</div>  

<!--<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
</div>  -->


<div class="form-group">
    <!--<select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
    </select>-->
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
            <div class="col-sm-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
	          	 </div> 
            <div class="col-sm-8" align="center">  
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
                 <div class="col-sm-2"></div>
                
                
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?>>
                    
                    <thead>
                        <tr>
                            
                            <!--<th style="width: 30px;" rowspan="2"><//?php echo "S.No" ?></th>-->
                            
                            <th style="width: 30px;" rowspan="2"><?php if($ipd == 'opd'){ echo "Yearly No"; } else { echo "S.No";} ?></th>
                            <?php if($ipd == 'opd'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Daily No."; ?></th><?php } ?>  
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                                <?php echo "COPD" ?>
                            </th> 
							
                           
                            <th rowspan="2"><?php echo "Patient Name" ?></th> 
                             <th rowspan="2"><?php echo "Full Address"; ?></th>
                            <th rowspan="2" <?php  if($gob=='gob') { echo "style='width:1px;'";}?>><?php echo display('sex') ?></th>   
                            <th rowspan="2" <?php  if($gob=='gob') { echo "style='width:1px;'";}?>><?php echo "Age" ?></th>                  
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                           <?php  if($ipd == 'ipd'){ ?><th  rowspan="2" style="width: 100px;">DOA</th><?php } ?> 
                             <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOD</th> <?php }?>
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                          
                          <!--  <th style="width: 30px;" rowspan="2"><?php echo "Dignosis" ?></th>-->
                            
                            <th style="width: 30px; text-align: center;" colspan="2" >
                                <?php echo "Diagnosis" ?>
                            </th>
                            
                           <?php if($ipd=='opd'){ if($department_by !='dpt'){ ?><th style="width: 30px;" rowspan="2">Doctor</th><?php } }?>
                           <?php if($department_by !='dpt') {?><th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd'){ echo "Doctor" ;} else { echo "Date";}?></th> <?php } ?>
                           <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "Remark"?></th><?php } ?> 
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "Treatment"?></th> <?php }?>
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "Panchkarma"?></th> <?php }?>
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "Investigation"?></th> <?php }?>
                           
                           <!--<?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX1"?></th> <?php }?>  -->
                           <!--<?php if($department_by  =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX2"?></th> <?php }?>  -->
                           <!--<?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX3"?></th> <?php }?>-->
                           
                           <!--<?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php if($name=='Shalyatantra') { echo "SHASTRAKARMA";} elseif($name =='Shalakyatantra'){ echo "SHASTRAKARMA"; } else {echo "ASHAN1"?></th> <?php }}?>
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php if($name=='Shalyatantra') { echo "VRANOPAKRAM";} elseif($name =='Shalakyatantra'){ echo "VRANOPAKRAM"; } else {echo "ASHAN1"?></th> <?php }}?>
                           <?php if($gob =='gob') {?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "KARMA"?></th> <?php }?>  
                           <?php if($gob =='gob') {?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "PK1"?></th> <?php }?>  
                           <?php if($gob =='gob') {?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "PK2"?></th> <?php }?>--> 
                           
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
                            <th style="width: 30px;"><?php echo "Follow-Up No" ?></th>
                           <th style="width: 30px;" >
                            
                                <?php echo "Netra" ?>
                            </th> 
                            <th style="width: 30px;"><?php echo "Mukha,Dant" ?></th>
                                                    
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        <?php 
                        $n_count = 0;
                        $m_count = 0 ;?>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                            
                            $datefrom1=date('Y-m-d',strtotime($datefrom));
                            //$year1 = date('Y');
                            $year1 = $this->session->userdata['acyear'];
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
                        $array_no=count($patients);
                        $tot_serial=$tot_serial1 + $array_no + 1;
                        
                        $this->db->select('*');
                       // $this->db->where('ipd_opd', 'opd');
                        //$this->db->where('yearly_reg_no !=','');
                        $this->db->where('create_date <=', date('Y-m-d')." 23:59:00");
                        $this->db->where('create_date LIKE', $year2);
                        $query = $this->db->get('patient_ipd');
                        $num_ipd1 = $query->num_rows();
                        //$num_ipd11=$num_ipd1 + 1;
                        $attay_count= count($patients);
                        //$num_ipd=  $num_ipd1 - $attay_count +1 ;
                       
                    if($department_by_section=='ipd')
                    {
                       //  $num_ipd=  $num_ipd1;
                        $num_ipd=  1;
                    }
                     else
                    {
                        $num_ipd=  $num_ipd1 - $attay_count +1 ;
                    }
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
                        
                        
                           
                          
?>
                            <?php $i = 0; $daily_num=0;
                                                       $at_mn=0;$at_mo=0;$at_fn=0;$at_fo=0; $at_tt=0; $at_ttn=0; $at_ttan=0; $at_ttdn=0; 
                             $aa_mn=0;$aa_mo=0;$aa_fn=0;$aa_fo=0; $aa_tt=0; 
                             $ky_mn=0;$ky_mo=0;$ky_fn=0;$ky_fo=0; $ky_tt=0;
                             $pn_mn=0;$pn_mo=0;$pn_fn=0;$pn_fo=0; $pn_tt=0;
                             $ba_mn=0;$ba_mo=0;$ba_fn=0;$ba_fo=0; $ba_tt=0;
                             $sly_mn=0;$sly_mo=0;$sly_fn=0;$sly_fo=0; $sly_tt=0;
                             $sky_mn=0;$sky_mo=0;$sky_fn=0;$sky_fo=0; $sky_tt=0;
                             $st_mn=0;$st_mo=0;$st_fn=0;$st_fo=0; $st_tt=0;
                             $sw_mn=0;$sw_mo=0;$sw_fn=0;$sw_fo=0; $sw_tt=0;
                                                      
                             
                                                              $five_all_mn=0;$five_all_mo=0;$five_all_fn=0;$five_all_fo=0;
                            $five_sixteen_all_mn=0;$five_sixteen_all_mo=0;$five_sixteen_all_fn=0;$five_sixteen_all_fo=0;
                            $sixteen_fourtyfive_all_mn=0;$sixteen_fourtyfive_all_mo=0;$sixteen_fourtyfive_all_fn=0;$sixteen_fourtyfive_all_fo=0; 
                            $fourtyfive_sixty_all_mn=0;$fourtyfive_sixty_all_mo=0;$fourtyfive_sixty_all_fn=0;$fourtyfive_sixty_all_fo=0;
                            $sixty_above_all_mn=0;$sixty_above_all_mo=0;$sixty_above_all_fn=0;$sixty_above_all_fo=0;
                                                      
                                                       $sky_netra_m_n = 0;
                                                      $sky_mukha_m_n = 0;
                                                      $sky_netra_m_o = 0;
                                                      $sky_mukha_m_o = 0;
                                                      $sky_netra_f_n = 0;
                                                      $sky_mukha_f_n = 0;
                                                      $sky_netra_f_o = 0;
                                                      $sky_mukha_f_o = 0;
                              
                             foreach ($patients as $patient) { $i++;
                            
                               $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                              $aa=date('Y-m-d', strtotime( $patient->create_date));
                             $dd12=date('Y-m-d', strtotime($_GET['start_date']));
                              if($_GET['start_date']){
                                $dd1=date('Y-m-d', strtotime($_GET['start_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }
                                           
                                                              
                                if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth <= 5))
                                    {$patient->discharge_date; if($dd != $dd1)
                                    {$five_all_mn++;} else{}}
                                 if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth <= 5)){
                                   $five_all_mo++;}
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth <= 5))
                                 {if($dd != $dd1){$five_all_fn++; } else{} }
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth <= 5))
                                 {if($dd != $dd1){$five_all_fo++;} else{}}
                                
                                                              
                                      
                                                              
                                                              
                                  if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)){
                                     $patient->discharge_date;if($dd != $dd1){$five_sixteen_all_mn++;} else{}}
                                 if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 6 && $patient->date_of_birth <= 15))
                                 {$five_sixteen_all_mo++;}
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)){
                                 if($dd != $dd1){$five_sixteen_all_fn++;} else{}}
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)){
                                 if($dd != $dd1){ $five_sixteen_all_fo++; } else{}}
                                                     
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                  if(($patient->sex=='M')  && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)){
                                     $patient->discharge_date; 
                                     if($dd != $dd1){$sixteen_fourtyfive_all_mn++; } else{} }
                                 if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)){
                                    $sixteen_fourtyfive_all_mo++; }
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)){
                                     if($dd != $dd1){$sixteen_fourtyfive_all_fn++;} else{}}
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)){
                                     if($dd != $dd1){$sixteen_fourtyfive_all_fo++;} else{}}
                                                         
                                                              
                                                              
                                 if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)){
                                     $patient->discharge_date; if($dd != $dd1){ $fourtyfive_sixty_all_mn++;} else{}}
                                 if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)){
                                    $fourtyfive_sixty_all_mo++; }
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)){
                                     if($dd != $dd1){ $fourtyfive_sixty_all_fn++; } else{}}
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)){
                                        if($dd != $dd1){ $fourtyfive_sixty_all_fo++; } else{}}
                                 
                                 
                                                              
                                   if(($patient->sex=='M') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 61)){
                                     $patient->discharge_date; if($dd != $dd1){ $sixty_above_all_mn++; } else{} }
                                 if(($patient->sex=='M') && ($$patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 61)){
                                    $sixty_above_all_mo++; 
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->yearly_reg_no) && ($patient->date_of_birth >= 61)){
                                     if($dd != $dd1){
                                    $sixty_above_all_fn++; 
                                     } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='35' || $patient->department_id =='34' || $patient->department_id =='33' || $patient->department_id =='32' || $patient->department_id =='31' || $patient->department_id =='30' || $patient->department_id =='29' || $patient->department_id =='28') && ($patient->old_reg_no) && ($patient->date_of_birth >= 61)){
                                        if($dd != $dd1){
                                    $sixty_above_all_fo++; 
                                        } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='35'){
                                       if($dd != $dd1){
                                    $sixty_above_all_tt++; 
                                       } else{}
                                     
                                 } 
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                                              
                                      
                                                              
                                                              
                                                               //agad tantra
                                  if(($patient->sex=='M') && ($patient->department_id =='36') && ($patient->yearly_reg_no)){
                                        if($dd != $dd1){
                                    $at_mn++; 
                                  } else{}
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='36') && ($patient->old_reg_no)){
                                       if($dd != $dd1){
                                        $at_mo++;   
                                       } else{}
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='36') && ($patient->yearly_reg_no)){
                                 if($dd != $dd1){ 
                                    $at_fn++; 
                                 } else{}
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='36') && ($patient->old_reg_no)){
                                    
                                    if($dd != $dd1){ 
                                    $at_fo++;
                                    } else{}
                                     
                                 }
                                 
                                 if($patient->department_id =='36'){
                                     
                                    if($dd != $dd1){      
                                    $at_tt++; 
                                    if($aa != $dd1){
                                       $at_ttn++; 
                                    }
                                    } 
                                    else if($dd == $dd1){
                                        
                                        $at_ttdn++;
                                    }
                                    else if($aa == $dd1){
                                        
                                       // $ky_ttan++;
                                    }
                                    else{}
                                    if($dd1==$aa){
                                  
                                      $at_ttan++;
                                    }
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
                                    
                                    
                                  $table='treatments1';
                                  
                                    
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
                                  $RX_other= $tretment->RX_other;
                                  $RX_other1= $tretment->RX_other1;
                                  $other_equipment= $tretment->other_equipment;
                                                              
                                                              
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      $skya= $tretment->skya;
			                      /*
			                      print_r($skya);*/
			                      
			                      
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
			                      $SHIROBASTI= $tretment->SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      
			                     
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;
                                                              
                                                                     
                                                                 if(($patient->department_id =='30') && ($skya=='N') && ($patient->sex =='M') && ($patient->yearly_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_netra_m_n++; 
                                                                }
                                                                else
                                                                {}

                                                              }  
                                                              
                                                              
                                                              if(($patient->department_id =='30') && ($skya=='M') && ($patient->sex =='M') && ($patient->yearly_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_mukha_m_n++; 
                                                                }
                                                                else
                                                                {}

                                                              }  
                                                              if(($patient->department_id =='30') && ($skya=='N') && ($patient->sex =='M') && ($patient->old_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_netra_m_o++; 
                                                                }
                                                                else
                                                                {}

                                                              }  
                                                              
                                                              if(($patient->department_id =='30') && ($skya=='M') && ($patient->sex =='M') && ($patient->old_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_mukha_m_o++; 
                                                                }
                                                                else
                                                                {}

                                                              }  
                                                              
                                                              if(($patient->department_id =='30') && ($skya=='N') && ($patient->sex =='F') && ($patient->yearly_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_netra_f_n++; 
                                                                }
                                                                else
                                                                {}

                                                              }   
                                                              
                                                              if(($patient->department_id =='30') && ($skya=='M') && ($patient->sex =='F') && ($patient->yearly_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_mukha_f_n++; 
                                                                }
                                                                else
                                                                {}

                                                              }   
                                                              
                                                              
                                                              if(($patient->department_id =='30') && ($skya=='N') && ($patient->sex =='F') && ($patient->old_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_netra_f_o++; 
                                                                }
                                                                else
                                                                {}

                                                              }        
                                                              if(($patient->department_id =='30') && ($skya=='M') && ($patient->sex =='F') && ($patient->old_reg_no))
                                                              {
                                                                if($dd != $dd1)
                                                                {
                                                                  $sky_mukha_f_o++; 
                                                                }
                                                                else
                                                                {}

                                                              }       
			                      
			                     /* $n_count=0;
			                      $m_count=0;*/
			                      
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
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else { echo ""; } ?>">
                                    
                                    <!--<td style="padding:2px;"><?php// if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; } ?></td>-->
                                    
                                    <td style="padding:2px;">
                                
                                        <?php if($ipd == 'ipd')
                                        { 
                                            echo $i;
                                        }
                                        else
                                        {
                                        echo $tot_serial1_d++; 
                                        } ?></td>
                                    
                                   <?php if($ipd == 'opd'){ ?><td style="padding:2px;"><?php echo $daily_num=$daily_num+1; ?></td><?php }?>
                                    <!--<?//php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?//php  if($department_by_section=='ipd'){ echo $num_ipd++; } else{ echo $num_ipd++;} ?></td> <?//php } ?>  -->
                                    <?php if($ipd == 'ipd'){if($year122 == '2021'){ ?><td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $patient->patient_id; }?></td>
                                    <?php }else{ ?> 
                                        <td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;  } ?></td> 
                                    <?php  } } ?> 
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
                                    
                                    <td  style="padding:2px;"><?php if($patient->yearly_reg_no) {  echo $patient->yearly_reg_no.".".$dot_year; }?></td>
                                    <td  style="padding:2px;"><?php if($patient->old_reg_no) { echo $patient->old_reg_no; if($explode[1]==''){echo ".".$dot_year;}}?></td> <!-- //old patient no -->
                                                           
                                    <!--<td><?php echo $patient->ipd_no?></td>-->
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td> 
                                     <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    
                                    <td  style="padding:2px;"><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> 
                                    <?php  if($ipd == 'ipd'){ ?>  <td><?php  echo date('d-m-Y',strtotime($patient->create_date));?></td> <?php }?>
                                     <!-- <?php  if($ipd == 'ipd'){ ?>  <td style="width:100px;"><?php ?><?php if(date('d-m-Y',strtotime($patient->discharge_date)) == date('d-m-y',strtotime($datefrom))){ if($patient->discharge_date=='0000-00-00'){ echo "0000-00-00 ";} else{ echo $patient->discharge_date;}}?> </td> <?php }?>-->
                                    
                                    <?php if( $ipd == 'ipd') {?> <td  style="padding:2px; font-size: 10px; width: 81px;"><?php if($patient->discharge_date!='' ) { if ($patient->discharge_date!='0000-00-00'){ if(date('d-m-Y',strtotime($patient->discharge_date)) == date('d-m-Y',strtotime($datefrom))){ echo date('d-m-Y',strtotime($patient->discharge_date)); } } }?></td> <?php } ?>
                                    
                                    <!-- <td><?php echo $patient->address; ?></td>   -->
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                 <!--   <td  style="padding:2px;"><?php  if($ipd == 'ipd'){ echo $p_dignosis_name; } else {echo $p_dignosis_name;}?></td> -->
                                  
                                 <?php if($skya =="N" || $skya =="M") { ?>
                                   <td  style="padding:2px;"><?php if($skya =="N") { echo $p_dignosis_name; echo  $n_count++;  }?></td>
                                   
                                    <td  style="padding:2px;"><?php if($skya =="M") { echo $p_dignosis_name; echo $m_count++; }?></td>  
                                    <?php }else{ ?>
                                    <td  ></td>
                                   
                                    <td  ></td>  
                                    <?php } ?>
                                    
                                    
                                    
                                    
                                    
                                    <!--<td><?php echo date('Y-m-d',strtotime($patient->create_date)); ?></td> -->
                                      <?php 
                                       $doctor_name= $this->db->select("*")
                                      ->from('user')
			                          ->where('department_id', $patient->department_id) 
                                      ->get()
                                      ->row();
                                      if($ipd=='opd'){ if($department_by !='dpt') {?><td style="width: 30px;"><?php echo $doctor_name->firstname;?></td> <?php } }?>
                                      <?php if($department_by !='dpt') {?>
                                    <td  style="padding:2px;"><?php 
                                    
                                    if($ipd == 'ipd'){ echo $doctor_name->firstname;} else { echo date('Y-m-d',strtotime($patient->create_date));}?></td><?php } ?>
                                     <?php if($department_by !='dpt') {?> <td  style="padding:2px;"></td> <?php } ?>  
                                     <?php if($department_by =='dpt') {?>
                                        <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                            <?php if($RX1){ echo $RX1.', <br>'; }?>
                                            <?php if($RX2){ echo $RX2.', <br>'; }?>
                                           <?php if($RX3){ echo $RX3.', <br>'; }?>
                                           <?php if($RX4){ echo $RX4.', <br>'; }?>
                                           <?php if($RX5){ echo $RX5.', <br>'; }?>
                                          <?php if($RX_other){ echo $RX_other.', <br>'; }?>
                                          <?php if($RX_other1){ echo $RX_other1.', <br>'; }?>
                                          <?php if($other_equipment){ echo $other_equipment; }?>
                                        </td>
                                     <?php } ?>
                                     <?php if($department_by =='dpt') {?>
                                        <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
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
                                               //echo "<br>";
                                                //$final_date_vaman = strtotime("+7 days",$create_date);
                                                $vaman_date = date("d-m-Y",$final_date_vaman);
                                                //echo "<br>";
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                            
                                            <?php if($create_date == $d) { ?> 
                                                <?php if($NASYA){ echo $NASYA.', <br>'; } ?>
                                                <?php } ?>
                                            
                                            
                                            
                                            <?php 
                                                $raktmokshan_date = date("d-m-Y",strtotime($patient->create_date));
                                               //echo "<br>";
                                                //$final_date_vaman = strtotime("+7 days",$create_date);
                                                //$raktmokshan_date = date("d-m-Y",$final_date_raktmokshan);
                                                //echo "<br>";
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                                <?php if($raktmokshan_date == $d){ ?>
                                                <?php if($RAKTAMOKSHAN){ echo $RAKTAMOKSHAN.', <br>'; } ?>
                                                <?php } ?>
                                            
                                            <?php if($SHIRODHARA_SHIROBASTI){ echo $SHIRODHARA_SHIROBASTI.', <br>'; } ?>
                                            
                                             <?php 
                                                $create_date = strtotime($patient->create_date);
                                               //echo "<br>";
                                                $final_date_shirobasti = strtotime("+1 days",$create_date);
                                                $shirobasti_date = date("d-m-Y",$final_date_shirobasti);
                                                //echo "<br>";
                                                 $d = date("d-m-Y",strtotime($datefrom));
                                            ?>
                                            <?php if($shirobasti_date == $d){ ?>
                                            <?php if($SHIROBASTI){ echo $SHIROBASTI.', <br>'; } ?>
                                            <?php } ?>
                                            <?php if($OTHER){ echo $OTHER.', <br>'; } ?>
                                        </td>  
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
                                            <?php if($patient->yearly_reg_n8o != '' || $patient->yearly_reg_no != NULL){ ?>
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
                                    
                                     <!--<?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX1; ?></td> <?php } ?>  -->
                                     <!-- <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX2; ?></td>  <?php }?> -->
                                     <!--  <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX3; ?></td>  <?php }?> -->
                                        <!-- <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php if($name=='Shalyatantra') { $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){echo $s_s;}} elseif($name=='Shalakyatantra'){ $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){echo $s_s; }} else { echo $SWA1; ?></td>  <?php } }?>
                                          <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php if($name=='Shalyatantra') { echo $s_v;} elseif($name=='Shalakyatantra'){ echo $s_v; } else {echo $SWA2; ?></td>  <?php } }?> 
                                        <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $KARMA; ?></td> <?php } ?>  
                                      <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK1; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK2; ?></td>  <?php }?> -->
                                         
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
                                                <a href="<?php echo base_url("patients/ipdprofile_sky/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i>OLD</a>      

                                            <?php }else { ?>
                                                
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>      
                                            <?php } ?>
                                        <?php
                                         $user_role_id = $this->session->userdata('user_role');
                                         ?>   
                                            
                                            <?php if($user_role_id != '5') 
                                            {
                                            ?>
                                        <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <?php 
                                        } 
                                        ?>
                                        <!--<a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a>--> 
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
                            <th><?php echo "Follow-Up " ?></th>
                            <th  >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th><?php echo "Follow-Up " ?></th>
                                                    
                        </tr>
                    </thead>
                    <tbody>
                    <?php $n=1;
                              if($ipd=='ipd')
                    {
                              $male_new=array($at_mn,$ky_mn,$pn_mn,$ba_mn,$sly_mn,$sky_mn,$st_mn);
                              $male_old=array($at_mo,$ky_mo,$pn_mo,$ba_mo,$sly_mo,$sky_mo,$st_mo);
                              $female_new=array($at_fn,$ky_fn,$pn_fn,$ba_fn,$sly_fn,$sky_fn,$st_fn);
                              $female_old=array($at_fo,$ky_fo,$pn_fo,$ba_fo,$sly_fo,$sky_fo,$st_fo);
                              $total=array($at_tt,$ky_tt,$pn_tt,$ba_tt,$sly_tt,$sky_tt,$st_tt);
                              }
                              else
                              {
                                $male_new=array($at_mn,$aa_mn,$ky_mn,$pn_mn,$ba_mn,$sly_mn,$sky_mn,$st_mn,$sw_mn);
                              $male_old=array($at_mo,$aa_mo,$ky_mo,$pn_mo,$ba_mo,$sly_mo,$sky_mo,$st_mo,$sw_mo);
                              $female_new=array($at_fn,$aa_fn,$ky_fn,$pn_fn,$ba_fn,$sly_fn,$sky_fn,$st_fn,$sw_fn);
                              $female_old=array($at_fo,$aa_fo,$ky_fo,$pn_fo,$ba_fo,$sly_fo,$sky_fo,$st_fo,$sw_fo);
                              $total=array($at_tt,$aa_tt,$ky_tt,$pn_tt,$ba_tt,$sly_tt,$sky_tt,$st_tt,$sw_tt);
                              }
                    if($ipd=='ipd')
                    {
                      $dept=$this->db->select("*")
                               ->from('department')
                        		//->where('dprt_id !=','36')
                        		->where('dprt_id !=','35')
                        		->where('dprt_id !=','28')
                               ->order_by('dprt_id','desc')
                               ->get()
                               ->result_array();
                    }
                    else
                    {
                     $dept=$this->db->select("*")
                               ->from('department')
                               ->order_by('dprt_id','desc')
                               ->get()
                               ->result_array();
                    }
                   //  print_r($dept);
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
                       </tr>
                     </tbody>
             </table>
              
               <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th rowspan='3'>Sr. No.</th>
                    <th rowspan='3'>Name</th>
                    <th colspan='4'>Male</th>
                    <th colspan='4'>Female</th>
                    
                  </tr>
                  <tr>
                    <th colspan='2'>Netra</th>
                    <th colspan='2'>ENT</th>
                    <th colspan='2'>Netra</th>
                    <th colspan='2'>ENT</th>
                  </tr>
                  <tr>
                    <th>New</th>
                     <th>Old</th>
                    <th>New</th>
                     <th>Old</th>
                    <th>New</th>
                     <th>Old</th>
                    <th>New</th>
                     <th>Old</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                   
                    <td>1</td>
                    <td>Shalakyatantra</td>
                    <td><?php echo  $sky_netra_m_n; ?></td>
                    <td><?php echo $sky_netra_m_o; ?></td>
                    <td><?php echo $sky_mukha_m_n; ?></td>
                    <td><?php echo $sky_mukha_m_o; ?></td>
                    <td><?php echo   $sky_netra_f_n; ?></td>
                    <td><?php echo  $sky_netra_f_o; ?></td>
                    <td><?php echo $sky_mukha_f_n; ?></td>
                    <td><?php echo  $sky_mukha_f_o; ?></td>
                  </tr>
                  <tr>
                    <td colspan='2'>Total</td> 
                    <td style="text-align: center;" colspan='2'><?php echo $total_n_n_o_m = $sky_netra_m_n + $sky_netra_m_o; ?></td>
                    <td style="text-align: center;" colspan='2'><?php echo $total_m_n_o_m = $sky_mukha_m_n + $sky_mukha_m_o; ?></td>
                    <td style="text-align: center;" colspan='2'><?php echo $total_n_n_o_f = $sky_netra_f_n + $sky_netra_f_o; ?></td>
                    <td style="text-align: center;" colspan='2'><?php echo $total_m_n_o_f = $sky_mukha_f_n + $sky_mukha_f_o; ?></td>
                  </tr>
                  <tr>
                    <td colspan='2'>Grand Total</td>
                    <td colspan='8' style="text-align: center;"><?php echo $total = $total_n_n_o_m + $total_m_n_o_m + $total_n_n_o_f + $total_m_n_o_f; ?></td>
                  </tr>
                </tbody>
              </table>   
                       
                          
                          
                 <?//php if($ipd=='ipd') {?>                    
           <!-- <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                             <th style="width: 30px;" ></th>
                             <th style="width: 30px;" >KAYACHIKITSA</th>
                             <th style="width: 30px;" >PANCHKARMA</th>
                             <th style="width: 30px;" >BALROGA</th>
                             <th style="width: 30px;" >SHALYATANTRA</th>
                             <th style="width: 30px;" >SHALAKYATANTRA</th>
                             <th style="width: 30px;" >STRIROG</th>
                             <th style="width: 30px;" >TOTAL</th>
                                              
                         </tr>
                    </thead>
                    <tbody>
                        <tr>                
                           
                             <td>OLD</td> 
                             <td><?php echo $k=$ky_tt + $ky_ttdn - $ky_ttan; ?></td>   
                             <td><?php echo $p=$pn_tt + $pn_ttdn - $pn_ttan; ?></td> 
                             <td><?php echo $b=$ba_tt + $ba_ttdn - $ba_ttan; ?></td>   
                             <td><?php echo $sl=$sly_tt + $sly_ttdn - $sly_ttan; ?></td> 
                             <td><?php echo $sk=$sky_tt + $sky_ttdn - $sky_ttan; ?></td>   
                             <td><?php echo $s= $st_tt + $st_ttdn - $st_ttan; ?></td> 
                             <td><?php echo $t_t= $k + $p + $b + $sl + $sk + $s; ?></td> 
                        </tr>
                        <tr>                
                           
                             <td>DISCHARGE</td> 
                              <td><?php echo $ky_ttdn; ?></td>   
                             <td><?php echo $pn_ttdn; ?></td> 
                             <td><?php echo $ba_ttdn; ?></td>   
                             <td><?php echo $sly_ttdn; ?></td> 
                             <td><?php echo $sky_ttdn; ?></td>   
                             <td><?php echo $st_ttdn; ?></td> 
                             <td><?php echo  $t_d=$ky_ttdn + $pn_ttdn + $ba_ttdn + $sly_ttdn + $sky_ttdn + $st_ttdn;?></td> 
                        </tr>
                        <tr>                
                             <td>TOTAL</td> 
                             <td><?php echo $k - $ky_ttdn; ?></td>   
                             <td><?php echo $p - $pn_ttdn; ?></td> 
                             <td><?php echo $b - $ba_ttdn; ?></td>   
                             <td><?php echo $sl - $sly_ttdn; ?></td> 
                             <td><?php echo $sk - $sky_ttdn; ?></td>   
                             <td><?php echo $s - $st_ttdn; ?></td> 
                             <td> <?php echo $t_t  - $t_d;?></td>   
                        </tr>
                        <tr>                
                           
                             <td>NEW</td> 
                             <td><?php echo $ky_ttan; ?></td>   
                             <td><?php echo $pn_ttan; ?></td> 
                             <td><?php echo $ba_ttan; ?></td>   
                             <td><?php echo $sly_ttan; ?></td> 
                             <td><?php echo $sky_ttan; ?></td>   
                             <td><?php echo $st_ttan; ?></td> 
                             <td><?php echo  $t_a=$ky_ttan + $pn_ttan + $ba_ttan + $sly_ttan + $sky_ttan + $st_ttan;  ?></td> 
                        </tr>
                        <tr>                
                           
                             <td>GRAND TOTAL</td> 
                             <td><?php echo ($k + $ky_ttan) - $ky_ttdn; ?></td>   
                             <td><?php echo ($p + $pn_ttan) - $pn_ttdn; ?></td> 
                             <td><?php echo ($b + $ba_ttan) - $ba_ttdn; ?></td>   
                             <td><?php echo ($sl + $sly_ttan) - $sly_ttdn; ?></td> 
                             <td><?php echo ($sk + $sky_ttan) - $sky_ttdn; ?></td>   
                             <td><?php echo ($s + $st_ttan) - $st_ttdn; ?></td> 
                             <td> <?php echo $t_t +  $t_a - $t_d;?></td>   
                        </tr>
                    
                    </tbody>
                       <!--<tbody>
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
                        </tr>-->
                    
                    </tbody>
               </table>
               <?php// }?>
                       <!--<tbody>
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
                    
                    </tbody>-->
               </table>
                          
              
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
  
     <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                         <th>IPD</th>
                        <th>MALE</th>
                      	<th>FEMALE</th>
                      <th>Total</th>
                    </tr>
                <!--  <tr>
                    <th>OPD</th>
                    <th>New</th>
                    <th>Old</th>
                    <th>New</th>
                    <th>Old</th>
                  </tr>-->
                  
                </thead>
                <tbody>
                  
                  
                  
<?php
                    $male_new=array($five_all_mn,$five_sixteen_all_mn,$sixteen_fourtyfive_all_mn,$fourtyfive_sixty_all_mn,$sixty_above_all_mn);
                    //$male_old=array($five_all_mo,$five_sixteen_all_mo,$sixteen_fourtyfive_all_mo,$fourtyfive_sixty_all_mo,$sixty_above_all_mo);
                    $female_new=array($five_all_fn,$five_sixteen_all_fn,$sixteen_fourtyfive_all_fn,$fourtyfive_sixty_all_fn,$sixty_above_all_fn);
                   // $female_old=array($five_all_fo,$five_sixteen_all_fo,$sixteen_fourtyfive_all_fo,$fourtyfive_sixty_all_fo,$sixty_above_all_fo);

                  $total_male_new = array('0-5','05-16','16-45','45-60','60 & Above');
                  //print_r($male_new);
                  ?>
                  <?php for($j=0;$j<count($total_male_new);$j++) {?>
                    <tr>
                      <td><?php echo $total_male_new[$j]; ?></td>
                      <td><?php echo $male_new[$j]; ?></td>
                     <!-- <td><?php echo $male_old[$j]; ?></td>-->
                      <td><?php echo $female_new[$j]; ?></td>
                      <!--<td><?php echo $female_old[$j]; ?></td>-->
                      <td><?php echo $male_new[$j]+$female_new[$j] ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <!--  <td><b>Total</b></td>
                    <td><b><?//php echo array_sum($male_new);?></b></td>
                  <td><b><?//php echo array_sum($male_old);?></b></td>
                    <td><b><?//php echo array_sum($female_new);?></b></td>
                   <td><b><?//php echo array_sum($female_old);?></b></td>
                     <td colspan='2' style="text-align: center;"><b><?//php echo array_sum($male_new) + array_sum($female_new);?></b></td>-->
                  </tr>
                  <tr>																						
                      <td><b>SIGN</b></td>  
                    <td colspan='2'><b>TOTAL</b></td>
                       <td colspan='2'><b><?php echo array_sum($male_new) + array_sum($female_new);?></b></td>
                    </tr>
                </tbody>
            </table>  
            </div>
        </div>
    </div>
</div>


