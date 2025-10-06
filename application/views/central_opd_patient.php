
 <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php if($flag==1){ echo base_url('Patient_New/central_opd'); }?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


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
                                                            <lable style="float: right;margin-right: 50px;">Doctor Name: 
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
                            <th style="width: 30px; text-align: center;" colspan="2" ><?php echo "COPD" ?></th> 
                            <th rowspan="2"><?php echo "Patient Name" ?></th>   
                               <th rowspan="2" style="width: 30px;"><?php echo "Full Address"; ?></th>
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2" style="width: 10px;"><?php echo "Age" ?></th> 
                   <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2" style="width: 10px;"><?php echo display('sex') ?></th> 
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>   
                           <th class="no-print" rowspan="2" style="width: 81px;"><?php echo display('action') ?></th>                     
                         </tr>
                        <tr>                
                            <th style="width: 30px;" ><?php echo "New No" ?></th> 
                            <th style="width: 30px;"><?php echo "Follow-Up"?></th>                         
                        </tr>
                    </thead>
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
                            
                       
                              
                             foreach ($patients as $patient) { $i++;
                            
                              $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                              $aa=date('Y-m-d', strtotime( $patient->create_date));
                             $dd12=date('Y-m-d', strtotime($_GET['start_date']));
                              if($_GET['start_date']){
                                $dd1=date('Y-m-d', strtotime($_GET['start_date']));
                              }else{
                                 $dd1=date('Y-m-d');
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
                                     $New_OPD=$opd_ipd_p->yearly_reg_no;
			                         $old_OPD= $opd_ipd_p->old_reg_no;
                                 
			                  
			                      
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

			                    
			                      
			                      
			                      // patient ipd yearly no
			                      $ipd_no_date=date('Y-m-d',strtotime($patient->create_date));
                                  $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                  $year122=date('Y',strtotime($patient->create_date));
                                  $year2='%'.$year122.'%';
                                  $this->db->select('*');
                                  $this->db->where('ipd_opd', 'ipd');
                                  $this->db->where('id <', $patient->id);
                                  $this->db->where('create_date LIKE', $year2);
                                  $query = $this->db->get('patient_ipd');
                                  $num_ipd_change = $query->num_rows();
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;
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
                                    } ?>
                                </td>
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>    
                                    <td style="padding:2px;"><?php echo $patient->address; ?></td>
                                    <td  style="padding:2px;"><?php echo $patient->date_of_birth; ?></td> 
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                 
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                     
                               
                                        <?php if($ipd == 'opd'){ ?>
                                            <?php if($patient->yearly_reg_no != '' || $patient->yearly_reg_no != NULL){ ?>
                                           
                                            <?php } else{ ?>
                                               
                                            <?php } ?>
                                        <?php } else{ ?>
                                           
                                        <?php } ?>
                                        
                                       
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
                                    </td>                                     
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  
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