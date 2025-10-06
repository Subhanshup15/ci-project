<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<?php ini_set('memory_limit', '-1');?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientby_investigation_date'); ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php echo $department_id; ?>">
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
           <div class="col-sm-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
	          	 </div> 
            <div class="col-sm-8" align="left">  
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
                               $ipd = ($patients[0]->ipd_opd);
                                
                                if($ipd == 'ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else {echo "Central";} ?> IPD Register <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; }?></h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else {echo "Date Wise Investigation";}?>  <?php  if($name) {echo "(".$name.")";}?></h3>
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
                         <?php } } }?>
                         
                         
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
                    <!--<div style="float: right; padding-top: 5px;" >
                    <button onclick="excel_all_customer_invistigation('<?php echo date('Y-m-d',strtotime($datefrom));?>','<?php echo date('Y-m-d',strtotime($dateto));?>','<?php echo $ipd;?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button>
                    </div>-->
                </div>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "COPD" ?>
                            </th> 
                            
                           
                            <th rowspan="2"><?php echo "Name" ?></th> 
                           <th rowspan="2"><?php echo "OPD/IPD" ?></th>  
                            <!--<th rowspan="2"><?php echo display('sex') ?></th>   
                            <th rowspan="2"><?php echo "Age" ?></th>-->          
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                             <th style="width: 30px;" rowspan="2"><?php echo "Sex"; ?></th>
                              <th style="width: 30px;" rowspan="2"><?php echo "Age"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Dignosis"; ?></th>
                           <?php if($ipd=='opd'){ if($department_by !='dpt'){ ?><th style="width: 30px;" rowspan="2">Doctor</th><?php } }?>
                            <?php if($department_by !='dpt') {?><th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd'){ echo "Doctor" ;} else { echo "Date";}?></th> <?php } ?>
                           <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "Remark"?></th><?php } ?> 
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "HEMATOLOGICAL"?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "SEROLOGYCAL"?></th> <?php }?>  
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "BIOCHEMICAL"; ?></th> <?php }?>  
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "MICROBIOLOGICAL"; ?></th> <?php }?>  
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "X-RAY"; ?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "ECG";?></th> <?php }?> 
                          <!-- <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "USG";?></th> <?php }?> -->
                           
                            <?php   
                                
                               $ipd = ($patients[0]->ipd_opd);
                                
                               if($ipd == 'ipd'){ ?>                                 
                                        <!-- <th><?php echo "Ipd No"?></th> -->
                                        <!-- <th style="width: 30px;"><?php echo "D. Date"?></th> -->
                              <?php  }  ?>
                            <th class="no-print" rowspan="2"><?php echo display('action') ?></th> 
                                                  
                         </tr>
                        <tr>                
                           
                            <th style="width: 80px;" >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th style="width: 80px;"><?php echo "Old No" ?></th>
                           
                                                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                            $datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y');
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
                       
                    if($department_by_section=='ipd'){
                         $num_ipd=  $num_ipd1;
                    }else{
                        $num_ipd=  $num_ipd1 - $attay_count +1 ;
                    }
                         
                          
?>
                            <?php  $array_patho1= array(); $array_patho2= array(); $array_patho3= array(); 
                                   $array_xray= array();
                                  $m=1; $i = 0;
                                    $Sr_no=1;
                                  $HEMATOLOGICAL1=0;$SEROLOGYCAL1=0;$BIOCHEMICAL1=0;$MICROBIOLOGICAL1=0;$X_RAY1=0;$ECG1=0;$USG1=0;
                                 // print_r(count($patients));
                                  foreach ($patients as $patient) { $i++; 
                            
                                  $date_c=date('Y-m-d',strtotime($patient->create_date));
                                  $date_d=date('Y-m-d',strtotime($patient->discharge_date));
                                  $date_f= date('Y-m-d', strtotime($dateto));
                                  $tot_serial--;
                                   
                                 //  $p_dignosis = '%'.$patient->dignosis.'%';
                                    
                                    
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
                                    
                                    
                                     $ss=date('Y-m-d',strtotime($dateto));
                                   
                                        
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
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
			               
			                    
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL =$tretment->MICROBIOLOGICAL;
			                      $X_RAY= $tretment->X_RAY;
								  $ECG= $tretment->ECG;
								  $USG= $tretment->USG;
								  
								  
								  if($HEMATOLOGICAL){
								      $HEMATOLOGICAL1++;
								  }
			                    
			                     if($SEROLOGYCAL){
			                       $SEROLOGYCAL1++;
			                    }
			                     if($BIOCHEMICAL){
			                       $BIOCHEMICAL1++;
			                    }
			                    
			                     if($MICROBIOLOGICAL){
			                       $MICROBIOLOGICAL1++;
			                    }
			                    
			                    if($X_RAY){
			                       $X_RAY1++;
			                    }
			                      if($ECG){
			                       $ECG1++;
			                    }
			                    if($USG){
			                       $USG1++;
			                    }
			                    
                              ?>
                            
                                <?php if(($HEMATOLOGICAL !='') || ($SEROLOGYCAL !='') || ($BIOCHEMICAL !='') || ($MICROBIOLOGICAL !='') || ($X_RAY !='') || ($ECG !='')) {?><tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else { echo ""; } ?>">
                                    <td style="padding:2px;"><?php if(($HEMATOLOGICAL !='') || ($X_RAY !='') || ($ECG !='')) { echo $Sr_no++ ;} else{ echo $Sr_no++; } ?></td>
                                       
                                    <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $Sr_no++; } else{ echo $Sr_no++;} ?></td> <?php } ?>  
                                     <!-- //patient_id yearly sr no -->                                                                       
                                    <!-- <td><?php echo $patient->daily_reg_no; ?></td> -->
                                    <!-- <td><?php echo $patient->monthly_reg_no; ?></td>  -->
                                    <td  style="padding:2px;"><?php echo $patient->yearly_reg_no ?></td>
                                    <td  style="padding:2px;"><?php echo $patient->old_reg_no; ?></td> <!-- //old patient no -->
                                                                 
                                    <!--<td><?php echo $patient->ipd_no?></td>-->
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>  
                                    <td style="width: 30px;"  style="padding:2px;"><?php echo $patient->ipd_opd; ?></td> 
                                   <!-- <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    <td  style="padding:2px;"><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> -->
                                    <!-- <td><?php echo $patient->address; ?></td>   -->
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td> 
                                    <td  style="padding:2px;"><?php echo $patient->date_of_birth; ?></td> 
                                    <td  style="padding:2px;"><?php echo $patient->dignosis; ?></td> 
                                    <!--<td><?php echo date('Y-m-d',strtotime($patient->create_date)); ?></td> -->
                                      <?php if($ipd=='opd'){ if($department_by !='dpt') {?><td style="width: 30px;"><?php echo $doctor_name->firstname;?></td> <?php } }?>
                                      <?php if($department_by !='dpt') {?>
                                    <td  style="padding:2px;"><?php 
                                    $doctor_name= $this->db->select("*")
                                    ->from('user')
			                       ->where('department_id', $patient->department_id) 
                                    ->get()
                                    ->row();
                                    
                                    
                                    if($ipd == 'ipd'){ echo $doctor_name->firstname;} else { echo date('Y-m-d',strtotime($patient->create_date));}?></td><?php } ?>
                                     <?php if($department_by !='dpt') {?> <td  style="padding:2px;"></td> <?php } ?>  
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $HEMATOLOGICAL; ?></td> <?php } ?> 
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $SEROLOGYCAL; ?></td> <?php } ?> 
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $BIOCHEMICAL; ?></td> <?php } ?> 
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $MICROBIOLOGICAL; ?></td> <?php } ?> 
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $X_RAY; ?></td>  <?php }?> 
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo  $ECG;  ?></td>  <?php }?> 
                                    <!-- <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo  $USG;  ?></td>  <?php }?> -->
                                         
                                         
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
                                                
                                            <?php }else { ?>
                                                
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>      
                                            <?php } ?>
                                        <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
                                    </td>                                     
                                </tr>
                                <?php } $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <!-- Table Summery -->
                <h3>Report Summary</h3>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>             
                            <th><?php echo "Sr. No" ?></th>
                            <th><?php echo "Name" ?></th>                            
                            <th><?php echo "Total Count" ?></th>                     
                        </tr>
                    </thead>
                    <tbody>
                       
                           
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "1";?> </td>
                                    <td><?php echo "HEMATOLOGICAL"; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $HEMATOLOGICAL1; ?></td>
                                </tr>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "2";?> </td>
                                    <td><?php echo "SEROLOGYCAL"; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $SEROLOGYCAL1; ?></td>
                                </tr>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "3";?> </td>
                                    <td><?php echo "BIOCHEMICAL"; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $BIOCHEMICAL1; ?></td>
                                </tr>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "4";?> </td>
                                    <td><?php echo "MICROBIOLOGICAL"; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $MICROBIOLOGICAL1; ?></td>
                                </tr>
                                
                                 <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "5";?> </td>
                                    <td><?php echo "X-RAY"; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $X_RAY1; ?></td>
                                </tr>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "6";?> </td>
                                    <td><?php echo "ECG"; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $ECG1; ?></td>
                                </tr>
                                 <!-- <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo "7";?> </td>
                                    <td><?php echo "USG"; ?></td> 
                                    <td><?php echo $USG1; ?></td>
                                </tr>-->
                               
                                
                           
                    </tbody>
                    
                   <!-- <tr>
                                    <td colspan="2">Grand Total</td>
                                   
                                    <td></td>
                                   
                                </tr>-->
                </table>  <!-- /.table-responsive -->
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

function excel_all_customer_invistigation(date1,date2,section){ 
	   //alert(date1+" "+date2);
		window.location='excel_all_customer_invistigation?date1='+date1+'&date2='+date2+'&section='+section;
	//	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
		// location.href='www.google.com';
	}
</script>
</script>