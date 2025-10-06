<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_gob_patient_new_date');  ?>">
                                      
 
        <!--<input type="text" name="section" class="form-control" id="section" value="<?php echo $date->section; ?>"> -->  


<div class="form-group">
    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
    <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
</div>  

<div class="form-group">
    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
</div>  


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="ipd">ipd</option>
    </select>
    <!--<input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>-->
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
                        <!--<h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($datefrom)) ?> </h4>-->
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                  
                     <?php  }  ?>
                
                          
                          
                          
                        <?php  if($summery_report == 0) { if($ipd == 'ipd') {?>
                            <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                            <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                        <?php }  ?>
                         
                         
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
                                        <lable style="float: right;margin-right: 50px;">Doctor Name: <?php echo"<span style='font-weight: 600;margin'>".$doctor_name1->firstname."</span>"; ?></lable>
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
                                                            <lable style="float: right;margin-right: 50px;">Doctor Name: <?php echo"<span style='font-weight: 600;margin'>".$doctor_name1->firstname."</span>"; ?></lable>
                         
                                                    <?php } } }  } ?>
                                                    
                         
                         
                         
                </div>
                
                 <div class="col-sm-2"></div>
              
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
                    <button onclick="excel_all_customer('<?//php echo date('Y-m-d',strtotime($datefrom));?>','<?//php echo date('Y-m-d',strtotime($datefrom));?>','<?//php echo $ipd;?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button>
                    </div>-->
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
                            
                        
                            <th rowspan="2"><?php echo "Patient Name"; ?></th> 
                            
                               
                                
                         
                             <?php  if($ipd == 'ipd'){ ?> <th  rowspan="2" style="width: 10px;"><?php echo " Diagnosis" ?></th><?php }?>
                         
                       
                            <?php 
                                if($department_by =='dpt') {
                            ?>
                                    <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2">
                                        <?php echo "Treatment"?>
                                    </th>
                            <?php
                                }
                            ?>
                          
                          <?php
                          // print_r($patients_new);
                          
                         $create_date = $patients_new->create_date;
                           $discharge_date = $patients_new->discharge_date;
                          
                            
          $date1=date("Y-m-d", strtotime($create_date));
          $date2=date("Y-m-d", strtotime($discharge_date));
          $date3=date_create($date1);
          $date4=date_create($date2);
          $diff=date_diff($date3,$date4);
          $moth = $diff->format("%a");
          $monthDays = $moth;
                          
                          ?>
                               <th <?php echo "colspan='$monthDays'" ?> rowspan="2">Date</th>
                            
                          
                           <?php if($gob =='gob' || $department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "Panchkarma"; ?></th> <?php }?>
                           
                           <?php if($gob =='gob' || $department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "Investigation"; ?></th> <?php }?>
                           

                           
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
                          <?php 
  								
  								
                          ?>
                         
                                                    
                        </tr>
                      
                    </thead>
                    <?php //print_r($patients);//exit; ?>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
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
                        
                        
                        // for department Monthly no
                        $fdate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($datefrom1)) . ", first day of this month"));
                        //print_r($fdate);
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
                        
                        //print_r($num_d_m);
                       
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
                                 $today_date=date('Y-m-d',strtotime($patient->discharge_date));
                                //  $today_date=date('Y-m-d', strtotime($datefrom_n));
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
			                          
                                     $Ntretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                     ->where('proxy_id',$patient->proxy_id)
                                     ->where('department_id',$patient->department_id)
                                     ->order_by("id", "desc")
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                       // print_r($this->db->last_query());echo '<br>';
                                      }
                                      else{
                                          
                                       $Ntretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                      ->where('department_id',$patient->department_id)
                                      ->order_by("id", "desc")
                                     ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();  
                                     
                                      if(empty($Ntretment)){
                                      $Ntretment=$this->db->select("*")
                                       ->from('treatments1')
                                      ->where('department_id',$patient->department_id)
			                          ->where('ipd_opd',$patient->department_id)
                                     ->get()
                                     ->row();   
                                         
                                       }
                                      }
                                  }else{
                                      $Ntretment=$this->db->select("*")
                                      ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                    // print_r($this->db->last_query());
                                   }
                                   if($patient->manual_status=='1' || $patient->created_by =='1' || $patient->created_by =='2')
                                    {
                                        $Ntretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$patient->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
			                         
			                      $NRX1= $Ntretment->RX1;
			                      $NRX2= $Ntretment->RX2;
			                      $NRX3= $Ntretment->RX3;
			                      $NRX4= $Ntretment->RX4;
			                      $NRX5= $Ntretment->RX5;
			                      
			                      $NRX_other= $Ntretment->RX_other;
			                      $NRX_other1= $Ntretment->RX_other1;
			                      $Nother_equipment= $Ntretment->other_equipment;
			                         
			                      
                                   
                                   $NOnly_1st_Dose= $Ntretment->Only_1st_Dose;
			                      
			                      $NKARMA= $Ntretment->KARMA;
			                      $NPK1= $Ntretment->PK1;
			                      $NPK2= $Ntretment->PK2;
			                      $NSWA1= $Ntretment->SWA1;
			                      $NSWA2= $Ntretment->SWA2;
			                      $NYONIDHAVAN= $Ntretment->YONIDHAVAN;
			                      $NYONIPICHU= $Ntretment->YONIPICHU;
			                      $NUTTARBASTI= $Ntretment->UTTARBASTI;
			                       
			                      $Ns_s= $Ntretment->skarma;
			                      $Ns_v= $Ntretment->vkarma;
			                      
			                    
			                      
			                      
			                       $NSNEHAN= $Ntretment->SNEHAN;
			                     
			                      
			                      $NSWEDAN= $Ntretment->SWEDAN;
			                      $NVAMAN= $Ntretment->VAMAN;
			                      
			                      $NVIRECHAN= $Ntretment->VIRECHAN;
			                      $NBASTI= $Ntretment->BASTI;
			                      $NNASYA= $Ntretment->NASYA;
			                      
			                      $NRAKTAMOKSHAN= $Ntretment->RAKTAMOKSHAN;
			                      $NSHIRODHARA_SHIROBASTI= $Ntretment->SHIRODHARA_SHIROBASTI;
			                      $NOTHER= $Ntretment->OTHER;
			                      
			                     
			                      
			                      $NHEMATOLOGICAL= $Ntretment->HEMATOLOGICAL;
			                      $NSEROLOGYCAL= $Ntretment->SEROLOGYCAL;
			                      $NBIOCHEMICAL= $Ntretment->BIOCHEMICAL;
			                      $NMICROBIOLOGICAL= $Ntretment->MICROBIOLOGICAL;
			                      
			                      $NX_RAY= $Ntretment->X_RAY;
			                      $NECG= $Ntretment->ECG;
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
                                    <td  style="padding:2px;"><?php if($ipd==opd){ echo $tot_serial1_d++; } else { echo $i; } ?></td>
                                    <?php } else {?>
                                    <td  style="padding:2px;"><?php if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; }} ?></td>
                                    
                                    
                                    <?php if($ipd == 'opd'){ ?> <td  style="padding:2px;"><?php echo $i; ?></td><?php } ?>  
                                       
                                       
                                        <?php 
                                        if($ipd == 'opd'){?>
                                            <?php if($department_by =='dpt'){?>
                                            <td style="padding: 2px;"><?php echo $monthlySerialNo++; ?> </td>
                                            <?php }else { ?>
                                            <td style="padding: 2px;">
                                        <?php echo $monthlySerialNo++;?></td>
                                    <?php } } ?>
                                       
                                       
                                    <!--<?//php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?//php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;} ?></td> <?//php } ?>  -->
                                    <?php if($ipd == 'ipd'){if($year122 == $this->session->userdata['acyear']){ ?>
                                        <td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;  } ?></td> 
                                    <?php }else{ ?> 
                                        <td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $patient->patient_id; }?></td>
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
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>    
                                   
                                   
                                    <?php  if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  echo $p_dignosis_name; ?></td> <?php } ?>
                                  
										<?php
                                         					if($RX1)
                                                              {
                                                                $treatment_array = array($RX1);
                                                              }
                                                              if($RX1 && $RX2)
                                                              {
                                                                $treatment_array = array($RX1,$RX2);
                                                              }
                                                               if($RX1 && $RX2 && $RX3)
                                                              {
                                                                $treatment_array = array($RX1,$RX2,$RX3);
                                                              }
                                                              
                                                              if($RX1 && $RX2 && $RX3 && $RX4)
                                                              {
                                                                $treatment_array = array($RX1,$RX2,$RX3,$RX4);
                                                              }
                                                              if($RX1 && $RX2 && $RX3 && $RX4 && $RX5)
                                                              {
                                                                $treatment_array = array($RX1,$RX2,$RX3,$RX4,$RX5);
                                                              }
                                                              
                                                              
                                                              

                                                              if($NRX1)
                                                              {
                                                                $Ntreatment_array = array($NRX1);
                                                              }
                                                              if($NRX1 && $NRX2)
                                                              {
                                                                $Ntreatment_array = array($NRX1,$NRX2);
                                                              }
                                                               if($NRX1 && $NRX2 && $NRX3)
                                                              {
                                                                $Ntreatment_array = array($NRX1,$NRX2,$NRX3);
                                                              }
                                                              
                                                              if($NRX1 && $NRX2 && $NRX3 && $NRX4)
                                                              {
                                                                $Ntreatment_array = array($NRX1,$NRX2,$NRX3,$NRX4);
                                                              }
                                                              if($NRX1 && $NRX2 && $NRX3 && $NRX4 && $NRX5)
                                                              {
                                                                $Ntreatment_array = array($NRX1,$NRX2,$NRX3,$NRX4,$NRX5);
                                                              }
                                                        //    print_r($Ntreatment_array);
                                                              
                                                               
                                                              
                                  
                                  			?>
                                  
                                  
                                   
                                        <?php if($department_by =='dpt') {?>
                                  
                                                <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>">
                                                  
                                        <?php
                                                                          
                                                                          
                                                    if($patient->discharge_date=='0000-00-00' || $patient->discharge_date=='1970-01-01')
                                                    {
                                                     $discharge_date = date('Y-m-d');
                                                    }
                                                                          
                                                                          else
                                                                          {

                                                                            $discharge_date = $patient->discharge_date;
                                                                          }
                                                        
                                                                          $date1=date("Y-m-d", strtotime($patient->create_date));
                                                                          $date2=date("Y-m-d", strtotime($discharge_date));
                                                                          $date3=date_create($date1);
                                                                          $date4=date_create($date2);
                                                                          $diff=date_diff($date3,$date4);
                                                                          $moth = $diff->format("%a");
                                                                          $monthDays = $moth+1;
                                                                          
                                  
                                                  ?>
                                                  
                                                
                                               
                                                  
                                                 
                                                  
                                                  
                                                 <?php $array_count = count($treatment_array); 
                                                 // echo  $array_count;  
                                                   for($k=0;$k<$array_count;$k++)   
                                                   {
                                                      if($treatment_array[$k])
                                                      {
                                                       echo   $str = $treatment_array[$k].'<br><hr>';
                                                          $arry=explode(" ",$str);
                                                          $count = count($arry);
                                                          //print_r($arry[$count-1]);
                                                          // print_r($arry);
                                                          $arry=explode("-",$str);
                                                          $count = count($arry);
                                                        	//	echo '<br>';
                                                          	//print_r($arry[$count-1]);
                                                        	$new_new_rx = explode(" ",$arry[0]);
                                                        	$count_new_new = count($new_new_rx);
                                                       // print_r($new_new_rx[0].$new_new_rx[1]);
                                                          	//print_r($count_new_new);
                                                      // echo '<br>';
                                                        
                                                        
                                                        
                                                          $temp2 = 0;
                                                          for($l=0;$l<$count;$l++)
                                                          {
                                                              if($l==0){
                                                                  $ar1 = explode(' ',$arry[$l]);
                                                                  $ar1_count = count($ar1);
                                                                  // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                
                                                                      $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                      $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                      $tempChurnaVal = 0;
                                                                      if($mgCheck == 1)
                                                                      {
                                                                          	$mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                          	$tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                         	$c1 = $c1 + $tempChurnaVal;
                                                                          //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                      }
                                                                      elseif($gCheck == 1)
                                                                      {
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        //print_r($tempChurnaVal);print_r('<br>');
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                      }
                                                                      else
                                                                      {
                                                                        $tempChurnaVal = $ar1[$ar1_count - 1];
                                                                      }
                                                                     
                                                                 
                                                              }
                                                              elseif($l==($count-1))
                                                              {
                                                                  $ar2 = explode(' ',$arry[$count-1]);
                                                                  $ar2_count = count($ar2);
                                                                  // array_push($tabletRoundArray, $ar2[0]);
                                                                
                                                                          $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                          $gCheck = preg_match("/g/", $ar2[0]);
                                                                          $tempChurnaVal = 0;
                                                                          if($mgCheck == 1)
                                                                          {
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            $c1 = $c1 + $tempChurnaVal;
                                                                              //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                          }
                                                                          elseif($gCheck == 1)
                                                                          {
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            $c1 = $c1 + $tempChurnaVal;
                                                                          }
                                                                          else
                                                                          {
                                                                              $tempChurnaVal = $ar2[0];
                                                                          }

                                                                      //$c1 = intval($c1) + 1;
                                                                  //print_r($ar2);

                                                                  for($j=$ar2_count;$j>0;$j--)
                                                                  {
                                                                      if($ar2[$j]!='')
                                                                      {
                                                                          $ex = explode('D',$ar2[$j]);
                                                                          $tab_days = $ex[0];
                                                                          //print_r($tab_days);
                                                                          break;
                                                                      }
                                                                  }
                                                              }
                                                              else
                                                              {
                                                                  if($arry[$l] != '')
                                                                  {
                                                                          $mgCheck = preg_match("/mg/", $arry[$l]);
                                                                          $gCheck = preg_match("/g/", $arry[$l]);
                                                                          $tempChurnaVal = 0;
                                                                          if($mgCheck == 1)
                                                                          {
                                                                              $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$l]);
                                                                              $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                             	$c1 = $c1 + $tempChurnaVal;
                                                                              //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                          }
                                                                          elseif($gCheck == 1)
                                                                          {
                                                                              $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$l]);
                                                                              $tempChurnaVal = $gVal[0];
                                                                             $c1 = $c1 + $tempChurnaVal;
                                                                              //print_r($tempChurnaVal);print_r('<br>');
                                                                          }

                                                                         
                                                                      	}
                                                                		else
                                                                  		{
                                                                        	$tempChurnaVal = $arry[$l];
                                                                      	}
                                                                  
                                                              }
                                                          }
                                                          //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;

                                                          ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                          $temp1 = $temp1 + $c1;
                                                          $temp2 = $temp2 + $c1;
                                                        // echo  $tempChurnaVal.'<br>' ;
                                                          ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                          $tabletCount = $tabletCount;
                                                          $c1 = 0;
                                                      }
                                                     
                                                  
                                                   }
                                                  
                                                  ?>
                                                  
                                                  
                                                  
                                                  
                                                   <?php $Narray_count = count($Ntreatment_array); 
                                                 // echo  $array_count;  
                                                   for($k=0;$k<$Narray_count;$k++)   
                                                   {
                                                      if($Ntreatment_array[$k])
                                                      {
                                                       echo   $str = $Ntreatment_array[$k].'<br><hr>';
                                                          $arry=explode(" ",$str);
                                                          $count = count($arry);
                                                          //print_r($arry[$count-1]);
                                                          // print_r($arry);
                                                          $arry=explode("-",$str);
                                                          $count = count($arry);
                                                        	//	echo '<br>';
                                                          	//print_r($arry[$count-1]);
                                                        	$new_new_rx = explode(" ",$arry[0]);
                                                        	$count_new_new = count($new_new_rx);
                                                       // print_r($new_new_rx[0].$new_new_rx[1]);
                                                          	//print_r($count_new_new);
                                                      // echo '<br>';
                                                        
                                                        
                                                        
                                                          $temp2 = 0;
                                                          for($l=0;$l<$count;$l++)
                                                          {
                                                              if($l==0){
                                                                  $ar1 = explode(' ',$arry[$l]);
                                                                  $ar1_count = count($ar1);
                                                                  // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                
                                                                      $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                      $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                      $tempChurnaVal = 0;
                                                                      if($mgCheck == 1)
                                                                      {
                                                                          	$mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                          	$tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                         	$c1 = $c1 + $tempChurnaVal;
                                                                          //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                      }
                                                                      elseif($gCheck == 1)
                                                                      {
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        //print_r($tempChurnaVal);print_r('<br>');
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                      }
                                                                      else
                                                                      {
                                                                        $tempChurnaVal = $ar1[$ar1_count - 1];
                                                                      }
                                                                     
                                                                 
                                                              }
                                                              elseif($l==($count-1))
                                                              {
                                                                  $ar2 = explode(' ',$arry[$count-1]);
                                                                  $ar2_count = count($ar2);
                                                                  // array_push($tabletRoundArray, $ar2[0]);
                                                                
                                                                          $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                          $gCheck = preg_match("/g/", $ar2[0]);
                                                                          $tempChurnaVal = 0;
                                                                          if($mgCheck == 1)
                                                                          {
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            $c1 = $c1 + $tempChurnaVal;
                                                                              //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                          }
                                                                          elseif($gCheck == 1)
                                                                          {
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            $c1 = $c1 + $tempChurnaVal;
                                                                          }
                                                                          else
                                                                          {
                                                                              $tempChurnaVal = $ar2[0];
                                                                          }

                                                                      //$c1 = intval($c1) + 1;
                                                                  //print_r($ar2);

                                                                  for($j=$ar2_count;$j>0;$j--)
                                                                  {
                                                                      if($ar2[$j]!='')
                                                                      {
                                                                          $ex = explode('D',$ar2[$j]);
                                                                          $tab_days = $ex[0];
                                                                          //print_r($tab_days);
                                                                          break;
                                                                      }
                                                                  }
                                                              }
                                                              else
                                                              {
                                                                  if($arry[$l] != '')
                                                                  {
                                                                          $mgCheck = preg_match("/mg/", $arry[$l]);
                                                                          $gCheck = preg_match("/g/", $arry[$l]);
                                                                          $tempChurnaVal = 0;
                                                                          if($mgCheck == 1)
                                                                          {
                                                                              $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$l]);
                                                                              $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                             	$c1 = $c1 + $tempChurnaVal;
                                                                              //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                          }
                                                                          elseif($gCheck == 1)
                                                                          {
                                                                              $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$l]);
                                                                              $tempChurnaVal = $gVal[0];
                                                                             $c1 = $c1 + $tempChurnaVal;
                                                                              //print_r($tempChurnaVal);print_r('<br>');
                                                                          }

                                                                         
                                                                      	}
                                                                		else
                                                                  		{
                                                                        	$tempChurnaVal = $arry[$l];
                                                                      	}
                                                                  
                                                              }
                                                          }
                                                          //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;

                                                          ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                          $temp1 = $temp1 + $c1;
                                                          $temp2 = $temp2 + $c1;
                                                        // echo  $tempChurnaVal.'<br>' ;
                                                          ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                          $tabletCount = $tabletCount;
                                                          $c1 = 0;
                                                      }
                                                     
                                                  
                                                   }
                                                  
                                                  ?>
                                                  
                                                    <?//php  if(($Only_1st_Dose) && ($n==0)) { echo $Only_1st_Dose." "; } ?>
                                                    <?//php if($RX1){ echo $RX1.', <br>'; }?>
                                                    <?//php if($RX2){ echo $RX2.', <br>'; }?>
                                                    <?//php if($RX3){ echo $RX3.', <br>'; }?>
                                                    <?//php if($RX4){ echo $RX4.', <br>'; }?>
                                                    <?//php if($RX5){ echo $RX5.', <br>'; }?>
                                                    <?//php if($RX_other){ echo $RX_other.', <br>'; }?>
                                                    <?//php if($RX_other1){ echo $RX_other1.', <br>'; }?>
                                                    <?//php if($other_equipment){ echo $other_equipment; }?>
                                        <?php }?>
                                        
                                                  
                                                   <?php
                                                    $discharge_date = $patient->discharge_date;
                                                    if($patient->discharge_date=='0000-00-00')
                                                    {
                                                     $discharge_date = date('Y-m-d');
                                                    }
                                                              else
                                                              {

                                                                $discharge_date = $patient->discharge_date;
                                                              }
                                                              
                                  	$begin = new DateTime($patient->create_date);
                                	$end = new DateTime($discharge_date);

                                	 $interval = DateInterval::createFromDateString('1 day');
                                	$period = new DatePeriod($begin, $interval, $end);
                                                              $a = 0;
                                    foreach($period as $pr)
                                    {
                                     // count($pr->format("Y-m-d")[0]);
                                     // $newarray = array($pr->format("Y-m-d"));

                                     // print_r($newarray);
                                      $a = $a + 1;
                                      ///////echo '<br>';
                                      
                                          echo '<td>'.$pr->format("Y-m-d \n").'<br>'.$pr->format("l").'</td>';
                                    }
                                                            //  $a++;
                                  
                                  ?>
                     
                                        
                                        
                                        <?php if(($ipd == 'ipd' && $gob =='gob') || ($ipd == 'ipd' && $department_by =='dpt')) {?> 
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
                                        <?php } elseif($ipd == 'opd'){ ?>
                                            <?php if($patient->yearly_reg_no != '' || $patient->yearly_reg_no != NULL){ ?>
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
                                            <?php } else{ ?>
                                               <td style="padding:2px;"><?php if($SNEHAN){ echo $SNEHAN.', <br>'; } ?>
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
                                                <?php if($UTTARBASTI){ echo $UTTARBASTI.', <br>'; } ?></td>
                                            <?php } ?>
                                        <?php } else{ ?>
                                            <!--<td style="padding:2px;"></td>-->
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
                                          <?php if(($department_by =='dpt') && ($gob =='gob')) { }?>
                                          
                                      <!--  <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $KARMA; ?></td> <?php } ?>-->  
                                      <!--<?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK1; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK2; ?></td>  <?php }?>--> 
                                       
                                       <!-- <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SNEHAN; ?></td>  <?php }?> -->
                                       <!-- <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SWEDAN; ?></td>  <?php }?> -->
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $VAMAN;  ?></td>  <?php }?>-->
                                       
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $VIRECHAN; ?></td>  <?php }?> -->
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $BASTI;  ?></td>  <?php }?>-->
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $NASYA; ?></td>  <?php }?> -->
                                       
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $RAKTAMOKSHAN; ?></td>  <?php }?> -->
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $SHIRODHARA_SHIROBASTI;  ?></td>  <?php }?>-->
                                       <!--<?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $OTHER; ?></td>  <?php }?>-->
                                       
                                      <!-- <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $YONIDHAVAN; ?></td>  <?php }?> 
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $YONIPICHU;  ?></td>  <?php }?>
                                       <?php if($gob =='gob') {?> <td  style="padding:2px;"><?php echo $UTTARBASTI; ?></td>  <?php }?>-->
                                        
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
                            <th><?php echo "Follow-Up " ?></th>
                            <th  >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th><?php echo "Follow-Up " ?></th>
                                                    
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
                        </tr>
                    
                    </tbody>-->
               </table>
               <?php }?>
              
              
               <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th colspan='3'>MALE</th>
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

                  $total_male_new = array('0-5','05-16','16-45','45-60','60 Above');
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