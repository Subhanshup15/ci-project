<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
    @media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "First Name"; }
	td:nth-of-type(2):before { content: "Last Name"; }
	td:nth-of-type(3):before { content: "Job Title"; }
	td:nth-of-type(4):before { content: "Favorite Color"; }
	td:nth-of-type(5):before { content: "Wars of Trek?"; }
	td:nth-of-type(6):before { content: "Secret Alias"; }
	td:nth-of-type(7):before { content: "Date of Birth"; }
	td:nth-of-type(8):before { content: "Dream Vacation City"; }
	td:nth-of-type(9):before { content: "GPA"; }
	td:nth-of-type(10):before { content: "Arbitrary Data"; }
}
#pagination{
margin: 40 40 0;
}
ul.tsc_pagination li a
{
border:solid 1px;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
padding-bottom:1px;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
color:#FFFFFF;
box-shadow:0px 1px #EDEDED;
-moz-box-shadow:0px 1px #EDEDED;
-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
margin:4px 0;
padding:0px;
height:100%;
overflow:hidden;
font:12px 'Tahoma';
list-style-type:none;
}
ul.tsc_pagination li
{
float:left;
margin:0px;
padding:0px;
margin-left:5px;
}
ul.tsc_pagination li a
{
color:black;
display:block;
text-decoration:none;
padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
border:none;
}
ul.tsc_pagination li a
{
color:#0A7EC5;
border-color:#8DC5E6;
background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
text-shadow:0px 1px #388DBE;
border-color:#3390CA;
background:#58B0E7;
background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}
</style>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php  echo base_url('patients/pharma_date_Despensing/'.$pharmas.'/'.$department_by_section.'/0/'.$datefrom.'/'.$dateto);  ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
 <input type="hidden" name="pharmas" class="form-control " id="pharmas" value="<?php echo $pharmas; ?>">
</div>  


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd" selected>opd</option>
       
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
                               $ipd = $ipd;
                                
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
                           
                               $ipd= $ipd;
                                
                                
                             $dbHost = "localhost";
                        $dbDatabase = "srpayurved_db";
                        $dbPasswrod = "gJXdRod3AOlyp4c9";
                        $dbUser = "srpayurved_db";
                        $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
                        $mysqli -> character_set_name();
                        // Change character set to utf8
                         $mysqli -> set_charset("utf8");
                         
                          $datefrom1=date('Y-m-d',strtotime($datefrom));
                         $datefrom1_like='%'.$datefrom1.'%';
                        
                          if($pharmas =='churna'){
                               $status='1';
                          }else {
                             $status='2';
                          }
                    
                     $previos_date = "SELECT * FROM pharma1_daily WHERE status ='$status'  ORDER BY id DESC";     
                     $previos_date1 = $mysqli->query($previos_date);
	                 $previos_date12=$previos_date1->fetch_assoc();
                     $previos_date122=$previos_date12['daily_date'];
                     
                     
                          
                    $check_number = "SELECT * FROM pharma1_daily WHERE  daily_date LIKE  '$datefrom1_like'";
	                $check_number_q = $mysqli->query($check_number);
	                // $check_number_result=$check_number_q->num_rows;
                      if($start==1){
                        $check_number_result=1;  
                     } else{
                          $check_number_result=11;
                     }               
                               ?>
                   <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php  if($pharmas=='churna') { echo 'Churna Register';} else if($pharmas=='tablet') { echo 'Tablet Register';} else{ echo $pharmas."-".$department_by_section." Register";}?></h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                
                        
                         
                         
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
                    <div style="padding-top: 5px;" >
                   <!-- <span style="color: white;background-color: dodgerblue;font-weight: 600;"> Last Update Date : <?php echo "$previos_date122";?> </span>-->
                    </div>
                
              
                <table id="" class="table table-striped table-bordered table-hover" <?php  if($gob=='gob') { echo "style='font-size:10px;'";}?> style="display:none";?>">
                    <thead>
                        <tr>
                           <th style="width: 30px;"><?php echo "S.No" ?></th>
                          
                            <th rowspan="2"><?php echo "Name" ?></th> 
                            <th rowspan="2"><?php echo "New No" ?></th> 
                            <th rowspan="2"><?php echo "Old No" ?></th>
                            
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
                             $sw_mn=0;$sw_mo=0;$sw_fn=0;$sw_fo=0; $sw_tt=0;
                             
                              
                             foreach ($patients as $patient) { $i++;
                                  $ipd=$patient->ipd_opd;
                            
			                      
                              ?>
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td style="padding:2px;"><?php echo $i; ?></td>
                                       
                                    <td><?php echo $pharma1->name?></td>
                                    <td></td>
                                    <td></td>
                                    
                                    
                                    
                                    
                                    
                                                                  
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  
                
                
 <?php if($pharmas == 'tablet'){?>               
 <div class="table-responsive">
   
  <table class="table table-bordered table-hover" style="display: none;">
    <tr>
      
        <th style="width:30px;">Name</th>
       
       <?php $m=0;foreach($patients as $patient){ $m++;?>
       <?php 
                                    $date=date('Y',strtotime($patient->create_date));
                                    $dot_year=substr($date,2);
                                     $explode=explode('.',$patient->old_reg_no);
			                       //print_r($import);
                                    $explode[1];
                                     ?>
        <!--<th><?//php $dd=date('y'); if($patient->yearly_reg_no){ $cc=$patient->yearly_reg_no.".".$dot_year;
         //} elseif($patient->old_reg_no) { if($explode[1]){ echo implode('<br>',str_split(strrev($patient->old_reg_no))); } else{ echo implode('<br>',str_split(strrev($patient->old_reg_no.".".$dot_year)));}} ?></th>-->
         
         <th><?php $dd=date('y'); if($patient->yearly_reg_no){ $cc=$patient->yearly_reg_no.".".$dot_year;
         } elseif($patient->old_reg_no) { if($explode[1]){ echo implode('<br>',str_split($patient->old_reg_no)); } else{ echo implode('<br>',str_split($patient->old_reg_no.".".$dot_year));}} ?></th>
       <?php }?>
       
      
    </tr>
    <?php 
    
    $KAMDUDA=0; $SUTSHEKAR=0;$AROGYAVARDHINI=0;$GANDHAK_RASAYAN=0;$TRIBHUVAN_KIRTI_VATI=0;$YOGARAJ_GUGGUL=0;$TRAYODASHANGA_GUGGUL=0;$TRASNADI_GUGGUL=0;$GANDHAK_RASAYAN_VATI=0;$LAGHUSUTHSHEKAR=0;
    
    $i=0;foreach ($pharma as $pharma1) { $i++;
    ?><tr>
       
       <td><?php echo $pharma1->name;?></td>
    <?php    
    
    foreach ($patients as $patient) { $i++; 
     if($ipd == 'ipd'){ 
                                        $section_tret='ipd';
                                        $len=strlen($patient->dignosis);
                                        $dd= substr($patient->dignosis,$len - 1);
                                      if($dd=='I'){
                                           $p_dignosis = '%'.$patient->dignosis.'%';
                                           $p_dignosis_name=$patient->dignosis;
                                      }else{
                                          
                                           $p_dignosis = '%'.$patient->dignosis.'I%';
                                           $p_dignosis_name=$patient->dignosis.'I';
                                      }
                                       
                                    }
                                    else{
                                         $section_tret='opd';
                                         $len=strlen($patient->dignosis);
                                         $dd= substr($patient->dignosis,$len - 1);
                                          if($dd=='I'){
                                               // echo $dd;
                                                $dd1=substr($patient->dignosis, 0, -1);
                                           $p_dignosis = '%'.$dd1.'%';
                                             $p_dignosis_name=$dd1;
                                      }else{
                                           //echo $dd;
                                           $p_dignosis = '%'.$patient->dignosis.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                      }
                                    }
                                    
                                    $ss=date('Y-m-d',strtotime($dateto));
                                   
                                    $table='treatments1';
                                   
                                    
                                 if($patient->manual_status==0){
                                     $tretment=$this->db->select("*")

			                         ->from($table)

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
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
			                      
			                      
    
    ?>
         
        <?php if(($pharma1->name=='SAMSHAMANI VATI') && (strpos($RX1, 'SAMSHAMANI VATI') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='RASNADI GUGGUL') && (strpos($RX2, 'RASNADI GUGGUL') !== false)) { $TRASNADI_GUGGUL++;	?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='TAPYADI LOHA GUTI') && ((strpos($RX2, 'TAPYADI LOHA GUTI') !== false) || (strpos($RX3, 'TAPYADI LOHA GUTI') !== false) ||(strpos($RX1, 'TAPYADI LOHA GUTI') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
          elseif(($pharma1->name=='NAGA GUTI') && ((strpos($RX3, 'NAGA GUTI') !== false) || (strpos($RX1, 'NAGA GUTI') !== false) || (strpos($RX2, 'NAGA GUTI') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='GOKSHURADI GUGGUL') && (strpos($RX2, 'GOKSHURADI GUGGUL') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
        elseif(($pharma1->name=='TRIBHUVAN KIRTI VATI') && (strpos($RX2, 'TRIBHUVAN KIRTI VATI') !== false)) { $TRIBHUVAN_KIRTI_VATI++;	?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='PUNARNAVADI GUGGUL') && ((strpos($RX3, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX2, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX1, 'PUNARNAVADI GUGGUL') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='KAISHOR GUGGUL') && ((strpos($RX2, 'KAISHOR GUGGUL') !== false) || (strpos($RX1, 'KAISHOR GUGGUL') !== false) || (strpos($RX3, 'KAISHOR GUGGUL') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='MEDOHAR VATI') && (strpos($RX3, 'MEDOHAR VATI') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='ARSHAKUTHAR VATI') && ((strpos($RX2, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX1, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX3, 'ARSHAKUTHAR VATI') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='TRIPHALA GUGGUL') && (strpos($RX2, 'TRIPHALA GUGGUL') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='SHWAS KUTHAR RAS') && ((strpos($RX1, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX2, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX3, 'SHWAS KUTHAR RAS') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='KANCHANAR GUGGUL') && ((strpos($RX1, 'KANCHANAR GUGGUL') !== false) || (strpos($RX2, 'KANCHANAR GUGGUL') !== false) || (strpos($RX3, 'KANCHANAR GUGGUL') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='SIMHANAD GUGGUL') && ((strpos($RX1, 'SIMHANAD GUGGUL') !== false) || (strpos($RX2, 'SIMHANAD GUGGUL') !== false) || (strpos($RX3, 'SIMHANAD GUGGUL') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='KUTAJ GHANA VATI') && (strpos($RX2, 'KUTAJ GHANA VATI') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
           elseif(($pharma1->name=='MAHAVATVIDHWANSA') && (strpos($RX2, 'MAHAVATVIDHWANSA') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
           elseif(($pharma1->name=='MAHAVATVIDHWANSA RAS') && (strpos($RX2, 'MAHAVATVIDHWANSA RAS') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
           elseif(($pharma1->name=='SUKSHMA TRIPHALA GUTI') && (strpos($RX2, 'SUKSHMA TRIPHALA GUTI') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='TRAYODASHANGA') && (strpos($RX1, 'TRAYODASHANGA') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
       
        elseif(($pharma1->name=='LAGHU SUTSHEKAR RAS') && ((strpos($RX2, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX3, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX1, 'LAGHU SUTSHEKAR RAS') !== false))) { $LAGHUSUTHSHEKAR++;?><td><?php echo "<p class='btn btn-success btn-xs' style='padding: 5px;'></p>20 Tbs";?></td><?php } 
        elseif(($pharma1->name=='LAGHU MALINI VASANT') && ((strpos($RX2, 'LAGHU MALINI VASANT') !== false) || (strpos($RX3, 'LAGHU MALINI VASANT') !== false) || (strpos($RX1, 'LAGHU MALINI VASANT') !== false))) { $LAGHUSUTHSHEKAR++;?><td><?php echo "<p class='btn btn-success btn-xs' style='padding: 5px;'></p>20 Tbs";?></td><?php } 
        elseif(($pharma1->name=='LAVANGADI VATI') && ((strpos($RX2, 'LAVANGADI VATI') !== false) || (strpos($RX1, 'LAVANGADI VATI') !== false) || (strpos($RX3, 'LAVANGADI VATI') !== false))) { $LAGHUSUTHSHEKAR++;?><td><?php echo "<p class='btn btn-success btn-xs' style='padding: 5px;'></p>20 Tbs";?></td><?php } 
        elseif(($pharma1->name=='CHANDRAPRABHA VATI') && (strpos($RX1, 'CHANDRAPRABHA VATI') !== false)) { $LAGHUSUTHSHEKAR++;?><td><?php echo "<p class='btn btn-success btn-xs' style='padding: 5px;'></p>20 Tbs";?></td><?php } 
        elseif(($pharma1->name=='SHANKHA VATI') && ((strpos($RX2, 'SHANKHA VATI') !== false) || (strpos($RX1, 'SHANKHA VATI') !== false) || (strpos($RX3, 'SHANKHA VATI') !== false))) { $LAGHUSUTHSHEKAR++;?><td><?php echo "<p class='btn btn-success btn-xs' style='padding: 5px;'></p>20 Tbs";?></td><?php } 

        elseif(($pharma1->name=='AROGYAVARDHINI VATI') && (strpos($RX1, 'AROGYAVARDHINI VATI') !== false)) { $AROGYAVARDHINI++;?><td><?php echo "<p class='btn btn-success btn-xs' style='padding: 5px;'></p>20 Tbs";?></td><?php } 
        elseif(($pharma1->name=='KAMDUDHA RAS') && ((strpos($RX1, 'KAMDUDHA RAS') !== false) || (strpos($RX2, 'KAMDUDHA RAS') !== false) || (strpos($RX3, 'KAMDUDHA RAS') !== false))) { $KAMDUDA++;?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
       elseif(($pharma1->name=='GANDHAK RASAYAN VATI') && ((strpos($RX1, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX2, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX3, 'GANDHAK RASAYAN VATI') !== false))) { $GANDHAK_RASAYAN_VATI++;?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
        elseif(($pharma1->name=='SHWAS KUTHAR') && (strpos($RX1, 'SHWAS KUTHAR') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='AMRUTA GUGGUL') && ((strpos($RX1, 'AMRUTA GUGGUL') !== false) || (strpos($RX2, 'AMRUTA GUGGUL') !== false) || (strpos($RX3, 'AMRUTA GUGGUL') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
	     elseif(($pharma1->name=='PRAVAL PANCHAMRUT VATI') && (strpos($RX1, 'PRAVAL PANCHAMRUT VATI') !== false)) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='KRUMI KUTHARRAS') && ((strpos($RX1, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX2, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX3, 'KRUMI KUTHAR RAS') !== false))) { $TRAYODASHANGA_GUGGUL++;	?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='TRAYODASHANGA GUGGUL') && ((strpos($RX1, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX2, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX3, 'TRAYODASHANGA GUGGUL') !== false))) { $TRAYODASHANGA_GUGGUL++;	?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 

         elseif(($pharma1->name=='SUTSHEKAR RAS VATI') && ((strpos($RX1, 'SUTSHEKAR RAS VATI') !== false) || (strpos($RX2, 'SUTSHEKAR RAS VATI') !== false) || (strpos($RX3, 'SUTSHEKAR RAS VATI') !== false))) { $SUTSHEKAR++;?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } 
         elseif(($pharma1->name=='YOGARAJ GUGGUL') && (strpos($RX1, 'YOGARAJ GUGGUL') !== false)) { $YOGARAJ_GUGGUL++;	?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tbs<?php } ?></td><?php } else{?>
       <td></td>
       <?php } }?>
       
      
       
     
    </tr>
   <?php }  ?>
  </table>
</div>
<?php } else {?>
<div class="table-responsive">
   
  <table class="table table-bordered table-hover">
    <tr>
      
        <th style="width:30px;">Name</th>
        <?php 
                                     $date=date('Y',strtotime($patient->create_date));
                                    $dot_year=substr($date,2);
                                     $explode=explode('.',$patient->old_reg_no);
			                       //print_r($import);
                                    $explode[1];
                                     ?>
                                   
       
       
       <?php $m=0;foreach($patients as $patient){ $m++;?>
        <!--<th ><?//php $dd=date('y'); if($patient->yearly_reg_no){ $cc=$patient->yearly_reg_no.".".$dot_year;
        //echo implode('<br>',str_split(strrev($cc))); } elseif($patient->old_reg_no) { if($explode[1]){ echo implode('<br>',str_split(strrev($patient->old_reg_no))); } else  { echo implode('<br>',str_split(strrev($patient->old_reg_no.".".$dot_year)));} } ?></th>-->
        
        <th ><?php $dd=date('y'); if($patient->yearly_reg_no){ $cc=$patient->yearly_reg_no.".".$dot_year;
        echo implode('<br>',str_split($cc)); } elseif($patient->old_reg_no) { if($explode[1]){ echo implode('<br>',str_split($patient->old_reg_no)); } else  { echo implode('<br>',str_split($patient->old_reg_no.".".$dot_year));} } ?></th>
        
       <?php }?>
       
      
    </tr>
    <?php 
    
    $ASHWAGANDHA=0;$SITOPALADI=0;$GANDHARVAHAREETAKI=0;$BALA=0;$KIRAT_TIKTA	=0;$HINGVASHTAK=0; 
    $i=0;foreach ($pharma as $pharma1) { $i++;
    ?><tr>
       
       <td><?php echo $pharma1->name;?></td>
    <?php     foreach ($patients as $patient) { $i++; 
     if($ipd == 'ipd'){ 
                                        $section_tret='ipd';
                                        $len=strlen($patient->dignosis);
                                        $dd= substr($patient->dignosis,$len - 1);
                                      if($dd=='I'){
                                           $p_dignosis = '%'.$patient->dignosis.'%';
                                           $p_dignosis_name=$patient->dignosis;
                                      }else{
                                          
                                           $p_dignosis = '%'.$patient->dignosis.'I%';
                                           $p_dignosis_name=$patient->dignosis.'I';
                                      }
                                       
                                    }
                                    else{
                                         
                                          $che=trim($patient->dignosis);
                                         $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $patient->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                         
                                          if($t_c=='2'){
                                               // echo $dd;
                                              
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
                                     
                                     /*$tretment=$this->db->select("*")

			                         ->from($table)

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();*/
                                     
                                     
                                     
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                      
			                          ->where('department_id',$patient->department_id)
			                         ->where('ipd_opd',$section_tret)
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
                                     
                                     
                                     
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                     if($patient->dignosis !='ATYARTAV-SR'){
			                        
			                        $RX1=$tretment->RX1;
			                      }else{
			                          $RX1='';
			                      } 
			                       if($patient->dignosis !='ATYARTAV-SR'){
			                      $RX2= $tretment->RX2;
			                      }else{
			                          $RX2=''; 
			                      }
			                       if($patient->dignosis !='ATYARTAV-SR'){
			                      $RX3= $tretment->RX3;
			                      }else{
			                          $RX3=''; 
			                      } 
			                      
			                      /*$RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;*/
			                      
			                    
    
    ?>
    
        <?php if(($pharma1->name=='MUSTA POWDER') && ((strpos($RX2, 'MUSTA POWDER') !== false) || (strpos($RX1, 'MUSTA POWDER') !== false) || (strpos($RX3, 'MUSTA POWDER') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 

         elseif(($pharma1->name=='SUNTHI CHURNA') && ((strpos($RX3, 'SUNTHI CHURNA') !== false)  || (strpos($RX1, 'SUNTHI CHURNA') !== false) || (strpos($RX2, 'SUNTHI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         elseif(($pharma1->name=='HINGVASHTAK CHURNA') && ((strpos($RX2, 'HINGVASHTAK CHURNA') !== false) || (strpos($RX1, 'HINGVASHTAK CHURNA') !== false) || (strpos($RX3, 'HINGVASHTAK CHURNA') !== false))) { $HINGVASHTAK++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
          elseif(($pharma1->name=='PATOLA CHURNA') && ((strpos($RX2, 'PATOLA CHURNA') !== false) || (strpos($RX3, 'PATOLA CHURNA') !== false) || (strpos($RX1, 'PATOLA CHURNA') !== false))) { $HINGVASHTAK++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
          elseif(($pharma1->name=='JAMBU CHURNA') && ((strpos($RX3, 'JAMBU CHURNA') !== false) || (strpos($RX1, 'JAMBU CHURNA') !== false) || (strpos($RX2, 'JAMBU CHURNA') !== false))) { $HINGVASHTAK++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         elseif(($pharma1->name=='HAREETAKI CHURNA') && ((strpos($RX1, 'HAREETAKI CHURNA') !== false) || (strpos($RX2, 'HAREETAKI CHURNA') !== false) || (strpos($RX3, 'HAREETAKI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='MANJISHTHA CHURNA') && ((strpos($RX1, 'MANJISHTHA CHURNA') !== false) || (strpos($RX2, 'MANJISHTHA CHURNA') !== false) || (strpos($RX3, 'MANJISHTHA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='PIPPALI CHURNA') && ((strpos($RX3, 'PIPPALI CHURNA') !== false) || (strpos($RX1, 'PIPPALI CHURNA') !== false) || (strpos($RX2, 'PIPPALI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='GOKSHUR CHURNA') && ((strpos($RX1, 'GOKSHUR CHURNA') !== false) || (strpos($RX2, 'GOKSHUR CHURNA') !== false) || (strpos($RX3, 'GOKSHUR CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='BALA POWDER') && ((strpos($RX2, 'BALA POWDER') !== false) || (strpos($RX1, 'BALA POWDER') !== false) || (strpos($RX3, 'BALA POWDER') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='SARIVA CHURNA') && ((strpos($RX2, 'SARIVA CHURNA') !== false) || (strpos($RX1, 'SARIVA CHURNA') !== false))) { $GANDHARVAHAREETAKI++; ?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='RASNA CHURNA') && ((strpos($RX1, 'RASNA CHURNA') !== false) || (strpos($RX2, 'RASNA CHURNA') !== false) || (strpos($RX3, 'RASNA CHURNA') !== false))) { $GANDHARVAHAREETAKI++; ?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }

         elseif(($pharma1->name=='GANDHARVAHAREETAKI CHURNA') && ((strpos($RX1, 'GANDHARVAHAREETAKI CHURNA') !== false) || (strpos($RX2, 'GANDHARVAHAREETAKI CHURNA') !== false) || (strpos($RX2, 'GANDHARVAHAREETAKI CHURNA') !== false))) { $GANDHARVAHAREETAKI++; ?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='PUNARNAVA CHURNA') && ((strpos($RX2, 'PUNARNAVA CHURNA') !== false) || (strpos($RX3, 'PUNARNAVA CHURNA') !== false) || (strpos($RX1, 'PUNARNAVA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='TRIKATU CHURNA') && ((strpos($RX2, 'TRIKATU CHURNA') !== false) || (strpos($RX1, 'TRIKATU CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='KHADIR CHURNA') && ((strpos($RX2, 'KHADIR CHURNA') !== false) || (strpos($RX1, 'KHADIR CHURNA') !== false) || (strpos($RX3, 'KHADIR CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='YASHTIMADHU CHURNA') && ((strpos($RX1, 'YASHTIMADHU CHURNA') !== false) || (strpos($RX2, 'YASHTIMADHU CHURNA') !== false) || (strpos($RX3, 'YASHTIMADHU CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }

         elseif(($pharma1->name=='SHATAVARI CHURNA') && ((strpos($RX1, 'SHATAVARI CHURNA') !== false) || (strpos($RX2, 'SHATAVARI CHURNA') !== false) || (strpos($RX3, 'SHATAVARI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='SARPAGANDHA CHURNA') && (strpos($RX1, 'SARPAGANDHA CHURNA') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='AVIPATTIKAR CHURNA') && ((strpos($RX2, 'AVIPATTIKAR CHURNA') !== false) || (strpos($RX1, 'AVIPATTIKAR CHURNA') !== false) || (strpos($RX3, 'AVIPATTIKAR CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='DARUHARIDRA CHURNA') && ((strpos($RX3, 'DARUHARIDRA CHURNA') !== false) || (strpos($RX2, 'DARUHARIDRA CHURNA') !== false) || (strpos($RX1, 'DARUHARIDRA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='KUTKI CHURNA') && ((strpos($RX2, 'KUTKI CHURNA') !== false) || (strpos($RX1, 'KUTKI CHURNA') !== false) || (strpos($RX3, 'KUTKI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='KIRATATIKTA CHURNA') && ((strpos($RX3, 'KIRATATIKTA CHURNA') !== false)  || (strpos($RX2, 'KIRATATIKTA CHURNA') !== false) || (strpos($RX1, 'KIRATATIKTA CHURNA') !== false))) {?><td><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='TRIPHALA CHURNA') && ((strpos($RX1, 'TRIPHALA CHURNA') !== false) || (strpos($RX2, 'TRIPHALA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='VACHA CHURNA') && ((strpos($RX3, 'VACHA CHURNA') !== false) || (strpos($RX1, 'VACHA CHURNA') !== false) || (strpos($RX2, 'VACHA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='CHOPCHINI CHURNA') && ((strpos($RX1, 'CHOPCHINI CHURNA') !== false)|| (strpos($RX2, 'CHOPCHINI CHURNA') !== false) || (strpos($RX3, 'CHOPCHINI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='VIDANGA CHURNA') && ((strpos($RX1, 'VIDANGA CHURNA') !== false) ||(strpos($RX2, 'VIDANGA CHURNA') !== false) || (strpos($RX3, 'VIDANGA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }

         elseif(($pharma1->name=='AMALAKI CHURNA') && ((strpos($RX2, 'AMALAKI CHURNA') !== false) || (strpos($RX1, 'AMALAKI CHURNA') !== false) || (strpos($RX3, 'AMALAKI CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a><?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='GULVEL CHURNA') && ((strpos($RX1, 'GULVEL CHURNA') !== false) || (strpos($RX2, 'GULVEL CHURNA') !== false) || (strpos($RX13, 'GULVEL CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a><?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }

         elseif(($pharma1->name=='GUDMAR CHURNA') && ((strpos($RX1, 'GUDMAR CHURNA') !== false) || (strpos($RX2, 'GUDMAR CHURNA') !== false) ||(strpos($RX3, 'GUDMAR CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='DASHAMOOL CHURNA') && ((strpos($RX1, 'DASHAMOOL') !== false) || (strpos($RX2, 'DASHAMOOL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='VASA CHURNA') && ((strpos($RX2, 'VASA CHURNA') !== false) || (strpos($RX3, 'VASA CHURNA') !== false) || (strpos($RX1, 'VASA CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='NAGKESHAR CHURNA') && (strpos($RX1, 'NAGKESHAR CHURNA') !== false) || (strpos($RX2, 'NAGKESHAR CHURNA') !== false) || (strpos($RX3, 'NAGKESHAR CHURNA') !== false) ) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php }
         elseif(($pharma1->name=='ASHOK CHURNA') && ((strpos($RX2, 'ASHOK CHURNA') !== false) || (strpos($RX1, 'ASHOK CHURNA') !== false)  || (strpos($RX3, 'ASHOK CHURNA') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         elseif(($pharma1->name=='NISHOTTAR CHURNA') && ((strpos($RX1, 'NISHOTTAR CHURNA') !== false) || (strpos($RX2, 'NISHOTTAR CHURNA') !== false) || (strpos($RX3, 'NISHOTTAR CHURNA') !== false))) { $SITOPALADI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         elseif(($pharma1->name=='ERANDAMOOL CHURNA') && ((strpos($RX3, 'ERANDAMOOL CHURNA') !== false) || (strpos($RX2, 'ERANDAMOOL CHURNA') !== false) || (strpos($RX1, 'ERANDAMOOL CHURNA') !== false))) { $SITOPALADI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         elseif(($pharma1->name=='CHITRAK CHURNA') && ((strpos($RX2, 'CHITRAK CHURNA') !== false) || (strpos($RX1, 'CHITRAK CHURNA') !== false) || (strpos($RX3, 'CHITRAK CHURNA') !== false))) { $SITOPALADI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         elseif(($pharma1->name=='LODHRA CHURNA') && ((strpos($RX2, 'LODHRA CHURNA') !== false) || (strpos($RX1, 'LODHRA CHURNA') !== false) || (strpos($RX3, 'LODHRA CHURNA') !== false))) { $SITOPALADI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 

         elseif(($pharma1->name=='SITOPALADI CHURNA') && ((strpos($RX2, 'SITOPALADI CHURNA') !== false) || (strpos($RX1, 'SITOPALADI CHURNA') !== false) || (strpos($RX3, 'SITOPALADI CHURNA') !== false))) { $SITOPALADI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } 
         
         elseif(($pharma1->name=='SAMSHAMANI VATI') && (strpos($RX1, 'SAMSHAMANI VATI') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='RASNADI GUGGUL') && ((strpos($RX1, 'RASNADI GUGGUL') !== false) || (strpos($RX2, 'RASNADI GUGGUL') !== false) || (strpos($RX3, 'RASNADI GUGGUL') !== false))) { $TRASNADI_GUGGUL++;	?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='TAPYADI LOHA GUTI') && ((strpos($RX2, 'TAPYADI LOHA GUTI') !== false) || (strpos($RX3, 'TAPYADI LOHA GUTI') !== false) ||(strpos($RX1, 'TAPYADI LOHA GUTI') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
          elseif(($pharma1->name=='NAGA GUTI') && ((strpos($RX3, 'NAGA GUTI') !== false) || (strpos($RX1, 'NAGA GUTI') !== false) || (strpos($RX2, 'NAGA GUTI') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='GOKSHURADI GUGGUL') && ((strpos($RX1, 'GOKSHURADI GUGGUL') !== false) || (strpos($RX2, 'GOKSHURADI GUGGUL') !== false) || (strpos($RX3, 'GOKSHURADI GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        elseif(($pharma1->name=='TRIBHUVAN KIRTI VATI') && (strpos($RX2, 'TRIBHUVAN KIRTI VATI') !== false)) { $TRIBHUVAN_KIRTI_VATI++;	?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='PUNARNAVADI GUGGUL') && ((strpos($RX3, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX2, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX1, 'PUNARNAVADI GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='KAISHOR GUGGUL') && ((strpos($RX2, 'KAISHOR GUGGUL') !== false) || (strpos($RX1, 'KAISHOR GUGGUL') !== false) || (strpos($RX3, 'KAISHOR GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='MEDOHAR VATI') && (strpos($RX3, 'MEDOHAR VATI') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='ARSHAKUTHAR VATI') && ((strpos($RX2, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX1, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX3, 'ARSHAKUTHAR VATI') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='TRIPHALA GUGGUL') && ((strpos($RX1, 'TRIPHALA GUGGUL') !== false) ||(strpos($RX2, 'TRIPHALA GUGGUL') !== false) || (strpos($RX3, 'TRIPHALA GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='SHWAS KUTHAR RAS') && ((strpos($RX1, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX2, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX3, 'SHWAS KUTHAR RAS') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='KANCHANAR GUGGUL') && ((strpos($RX1, 'KANCHANAR GUGGUL') !== false) || (strpos($RX2, 'KANCHANAR GUGGUL') !== false) || (strpos($RX3, 'KANCHANAR GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='SIMHANAD GUGGUL') && ((strpos($RX1, 'SIMHANAD GUGGUL') !== false) || (strpos($RX2, 'SIMHANAD GUGGUL') !== false) || (strpos($RX3, 'SIMHANAD GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p='';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='KUTAJ GHANA VATI') && (strpos($RX2, 'KUTAJ GHANA VATI') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
           elseif(($pharma1->name=='MAHAVATVIDHWANSA') && (strpos($RX2, 'MAHAVATVIDHWANSA') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
           elseif(($pharma1->name=='MAHAVATVIDHWANSA RAS') && ((strpos($RX1, 'MAHAVATVIDHWANSA RAS') !== false) || (strpos($RX2, 'MAHAVATVIDHWANSA RAS') !== false) || (strpos($RX3, 'MAHAVATVIDHWANSA RAS') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
           elseif(($pharma1->name=='SUKSHMA TRIPHALA GUTI') && (strpos($RX2, 'SUKSHMA TRIPHALA GUTI') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='TRAYODASHANGA') && (strpos($RX1, 'TRAYODASHANGA') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
       
        elseif(($pharma1->name=='LAGHU SUTSHEKAR RAS') && ((strpos($RX2, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX3, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX1, 'LAGHU SUTSHEKAR RAS') !== false))) { $LAGHUSUTHSHEKAR++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        elseif(($pharma1->name=='LAGHU MALINI VASANT') && ((strpos($RX2, 'LAGHU MALINI VASANT') !== false) || (strpos($RX3, 'LAGHU MALINI VASANT') !== false) || (strpos($RX1, 'LAGHU MALINI VASANT') !== false))) { $LAGHUSUTHSHEKAR++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        elseif(($pharma1->name=='LAVANGADI VATI') && ((strpos($RX2, 'LAVANGADI VATI') !== false) || (strpos($RX1, 'LAVANGADI VATI') !== false) || (strpos($RX3, 'LAVANGADI VATI') !== false))) { $LAGHUSUTHSHEKAR++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        
        elseif(($pharma1->name=='CHANDRAPRABHA VATI') && ((strpos($RX1, 'CHANDRAPRABHA VATI') !== false) || (strpos($RX2, 'CHANDRAPRABHA VATI') !== false) || (strpos($RX3, 'CHANDRAPRABHA VATI') !== false))) { $LAGHUSUTHSHEKAR++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        elseif(($pharma1->name=='SHANKHA VATI') && ((strpos($RX2, 'SHANKHA VATI') !== false) || (strpos($RX1, 'SHANKHA VATI') !== false) || (strpos($RX3, 'SHANKHA VATI') !== false))) { $LAGHUSUTHSHEKAR++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

        elseif(($pharma1->name=='AROGYAVARDHINI VATI') && ((strpos($RX1, 'AROGYAVARDHINI VATI') !== false) || (strpos($RX2, 'AROGYAVARDHINI VATI') !== false) || (strpos($RX3, 'AROGYAVARDHINI VATI') !== false))) { $AROGYAVARDHINI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        
        elseif(($pharma1->name=='KAMDUDHA RAS') && ((strpos($RX1, 'KAMDUDHA RAS') !== false) || (strpos($RX2, 'KAMDUDHA RAS') !== false) || (strpos($RX3, 'KAMDUDHA RAS') !== false))) { $KAMDUDA++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
       elseif(($pharma1->name=='GANDHAK RASAYAN VATI') && ((strpos($RX1, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX2, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX3, 'GANDHAK RASAYAN VATI') !== false))) { $GANDHAK_RASAYAN_VATI++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
        elseif(($pharma1->name=='SHWAS KUTHAR') && (strpos($RX1, 'SHWAS KUTHAR') !== false)) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='AMRUTA GUGGUL') && ((strpos($RX1, 'AMRUTA GUGGUL') !== false) || (strpos($RX2, 'AMRUTA GUGGUL') !== false) || (strpos($RX3, 'AMRUTA GUGGUL') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
	     elseif(($pharma1->name=='PRAVAL PANCHAMRUT VATI') && ((strpos($RX1, 'PRAVAL PANCHAMRUT VATI') !== false) || (strpos($RX2, 'PRAVAL PANCHAMRUT VATI') !== false) || (strpos($RX3, 'PRAVAL PANCHAMRUT VATI') !== false))) {?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='KRUMI KUTHAR RAS') && ((strpos($RX1, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX2, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX3, 'KRUMI KUTHAR RAS') !== false))) { $TRAYODASHANGA_GUGGUL++;	?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='TRAYODASHANGA GUGGUL') && ((strpos($RX1, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX2, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX3, 'TRAYODASHANGA GUGGUL') !== false))) { $TRAYODASHANGA_GUGGUL++;	?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 

         elseif(($pharma1->name=='SUTSHEKAR RAS VATI') && ((strpos($RX1, 'SUTSHEKAR RAS VATI') !== false) || (strpos($RX2, 'SUTSHEKAR RAS VATI') !== false) || (strpos($RX3, 'SUTSHEKAR RAS VATI') !== false))) { $SUTSHEKAR++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         elseif(($pharma1->name=='YOGARAJ GUGGUL') && ((strpos($RX1, 'YOGARAJ GUGGUL') !== false) || (strpos($RX2, 'YOGARAJ GUGGUL') !== false) || (strpos($RX3, 'YOGARAJ GUGGUL') !== false))) { $YOGARAJ_GUGGUL++;	?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>20 Tb<?php } ?></td><?php } 
         
         
         
         elseif(($pharma1->name=='ASHWAGANDHA CHURNA') && ((strpos($RX1, 'ASHWAGANDHA CHURNA') !== false) || (strpos($RX2, 'ASHWAGANDHA CHURNA') !== false) || (strpos($RX33, 'ASHWAGANDHA CHURNA') !== false))) { $ASHWAGANDHA++;?><td style="font-size:16px; font-weight:bold;"><?php if($department_by_section=='opd'){ $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } else { $opd_p= '';?><a href="<?php echo $opd_p; ?>"><p class='btn btn-success btn-xs' style='padding: 5px;'></p></a>10 gm<?php } ?></td><?php } else{?>
       <td></td>
      
       <?php } }?>
       
      
       
     
    </tr>
   <?php }  ?>
  </table>
</div>
</div>
<?php }?>
<?php 
$f_date=date('Y-m-d',strtotime($datefrom));
$t_date=date('Y-m-d',strtotime($dateto));
$sec_text="&section=";
//start_date=2020-01-29&end_date=2020-01-29&dept_id=&pharmas=churna&section=opd&filter=
$dd="?start_date=".$f_date."&end_date=".$t_date."&dept_id=&pharmas=".$pharmas.$sec_text.$department_by_section."&filter="; ?>

<div id="pagination" style="display: inline-block;">
<ul class="tsc_pagination">

<?php
echo "<li>". $links."</li>";
 ?>
</ul>
</div>
 

                <!-- /.table-responsive -->
                <!-- Table Summery -->
                <?php if($pharmas == 'tablet'){?>
                
                
                <?php     
                /*$gt=0; $KAMDUDA1=0; $SUTSHEKAR1=0;$AROGYAVARDHINI1=0;$GANDHAK_RASAYAN1=0;$TRIBHUVAN_KIRTI_VATI1=0;$YOGARAJ_GUGGUL1=0;$TRAYODASHANGA_GUGGUL1=0;$TRASNADI_GUGGUL1=0; $GANDHAK_RASAYAN_VATI1=0;$LAGHUSUTHSHEKAR1=0;$RASNADI_GUGGUL1=0;$GOKSHURADI_GUGGUL1=0;	
                $TRIPHALA_GUGGUL1=0;$SAMSHAMANI_VATI1=0;$MAHAVATVIDHWANSA1=0;$SHWAS_KUTHAR1=0;$PRAVAL_PANCHAMRUT1=0;$AMRUTA_GUGGUL1=0; $VASA1=0; $LAGHU_MALINI_VASANT1=0; $LAVANGADI_VATI1=0; $ARSHAKUTHAR_VATI1=0; $KRUMI_KUTHAR_RAS1=0;
                $CHANDRAPRABHA_VATI1=0; $KUTAJ_GHANA_VATI1=0; $MAHAVATVIDHWANSA_RAS1=0; $SUKSHMA_TRIPHALA_GUTI1=0; $PUNARNAVADI_GUGGUL1=0; $SHANKHA_VATI1=0;$SHWAS_KUTHAR_RAS1=0; $KAISHOR_GUGGUL1=0; $KANCHANAR_GUGGUL1=0; $MEDOHAR_VATI1=0;
                $TAPYADI_LOHA_GUTI1=0;$NAGA_GUTI1=0; $SIMHANAD_GUGGUL1=0;
                
                $ARSHAKUTHAR_VATI1=0;*/
                foreach ($patients_summary as $patients_sum) { 
                    $ipd=$patients_sum->ipd_opd;
                             if($ipd=='ipd'){ 
                                        $section_tret=$ipd;
                                        $len=strlen($patients_sum->dignosis);
                                        $dd= substr($patients_sum->dignosis,$len - 1);
                                      if($dd=='I'){
                                           $p_dignosis = '%'.$patients_sum->dignosis.'%';
                                           $p_dignosis_name=$patients_sum->dignosis;
                                      }else{
                                          
                                           $p_dignosis = '%'.$patients_sum->dignosis.'I';
                                           $p_dignosis_name=$patients_sum->dignosis.'I';
                                      }
                                       
                                    }
                                    else{
                                         $section_tret=$ipd;
                                         $len=strlen($patients_sum->dignosis);
                                         $dd= substr($patients_sum->dignosis,$len - 1);
                                          if($dd=='I'){
                                               // echo $dd;
                                                $dd1=substr($patients_sum->dignosis, 0, -1);
                                           $p_dignosis = '%'.$dd1.'%';
                                             $p_dignosis_name=$dd1;
                                      }else{
                                           //echo $dd;
                                           $p_dignosis = '%'.$patients_sum->dignosis.'%';
                                            $p_dignosis_name=$patients_sum->dignosis;
                                      }
                                    }
                
                                      
                                       $ss=date('Y-m-d',strtotime($dateto));
                                   
                                       $table='treatments1';
                                    
                                    
                                    
                                 if($patients_sum->manual_status==0){
                                    if($patients_sum->sym_id){
                                     $tretment=$this->db->select("*")

			                         ->from($table)

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
			                         ->where('sym_id ',$patients_sum->sym_id)
                                     ->get()
                                     ->row();
                                     }
                                     else{
                                     $tretment=$this->db->select("*")

			                         ->from($table)

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                     }
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patients_sum->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                      
			                      $RX11= $tretment->RX1;
			                      $RX22= $tretment->RX2;
			                      $RX33= $tretment->RX3;
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
			                    
    
    ?>
    
        <?php for($i=0;$i<count($pharma);$i++) {if(($pharma[$i]->name=='SAMSHAMANI VATI') && (strpos($RX11, 'SAMSHAMANI VATI') !== false)) { $SAMSHAMANI_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='RASNADI GUGGUL') && (strpos($RX22, 'RASNADI GUGGUL') !== false)) { $RASNADI_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='ARSHAKUTHAR VATI') && ((strpos($RX22, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX11, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX33, 'ARSHAKUTHAR VATI') !== false))) { $ARSHAKUTHAR_VATI1++;?><?php } 

        
        
        
         elseif(($pharma[$i]->name=='KANCHANAR GUGGUL') && ((strpos($RX11, 'KANCHANAR GUGGUL') !== false) || (strpos($RX22, 'KANCHANAR GUGGUL') !== false) || (strpos($RX33, 'KANCHANAR GUGGUL') !== false))) { $KANCHANAR_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='KRUMI KUTHAR RAS') && ((strpos($RX11, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX22, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX33, 'KRUMI KUTHAR RAS') !== false))) { $KRUMI_KUTHAR_RAS1++;	?><?php } 
         elseif(($pharma[$i]->name=='NAGA GUTI') && ((strpos($RX33, 'NAGA GUTI') !== false) || (strpos($RX22, 'NAGA GUTI') !== false) || (strpos($RX11, 'NAGA GUTI') !== false))) { $NAGA_GUTI1++;	?><?php } 

         elseif(($pharma[$i]->name=='GOKSHURADI GUGGUL') && ((strpos($RX22, 'GOKSHURADI GUGGUL') !== false) || (strpos($RX11, 'GOKSHURADI GUGGUL') !== false) || (strpos($RX33, 'GOKSHURADI GUGGUL') !== false))) { $GOKSHURADI_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='SHWAS KUTHAR') && (strpos($RX11, 'SHWAS KUTHAR') !== false)) { $SHWAS_KUTHAR1++;	?><?php } 
         elseif(($pharma[$i]->name=='TRIBHUVAN KIRTI VATI') && (strpos($RX22, 'TRIBHUVAN KIRTI VATI') !== false)) {	?><?php } 
         elseif(($pharma[$i]->name=='PUNARNAVADI GUGGUL') && ((strpos($RX33, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX22, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX11, 'PUNARNAVADI GUGGUL') !== false))) { $PUNARNAVADI_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='SHANKHA VATI') && ((strpos($RX22, 'SHANKHA VATI') !== false) || (strpos($RX11, 'SHANKHA VATI') !== false) || (strpos($RX33, 'SHANKHA VATI') !== false))) { $SHANKHA_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='SHWAS KUTHAR RAS') && ((strpos($RX11, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX22, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX33, 'SHWAS KUTHAR RAS') !== false)) ) { $SHWAS_KUTHAR_RAS1++;	?><?php } 
         elseif(($pharma[$i]->name=='KAISHOR GUGGUL') && ((strpos($RX22, 'KAISHOR GUGGUL') !== false) || (strpos($RX33, 'KAISHOR GUGGUL') !== false) || (strpos($RX11, 'KAISHOR GUGGUL') !== false))) { $KAISHOR_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='MEDOHAR VATI') && (strpos($RX33, 'MEDOHAR VATI') !== false)) { $MEDOHAR_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='TAPYADI LOHA GUTI') && ((strpos($RX22, 'TAPYADI LOHA GUTI') !== false) || (strpos($RX33, 'TAPYADI LOHA GUTI') !== false) || (strpos($RX11, 'TAPYADI LOHA GUTI') !== false))) { $TAPYADI_LOHA_GUTI1++;	?><?php } 

         elseif(($pharma[$i]->name=='TRIPHALA GUGGUL') && (strpos($RX22, 'TRIPHALA GUGGUL') !== false)) { 	?><?php } 

         elseif(($pharma[$i]->name=='KUTAJ GHANA VATI') && (strpos($RX22, 'KUTAJ GHANA VATI') !== false)) { $KUTAJ_GHANA_VATI1++;	?><?php } 
           elseif(($pharma[$i]->name=='MAHAVATVIDHWANSA') && (strpos($RX22, 'MAHAVATVIDHWANSA') !== false)) { $MAHAVATVIDHWANSA1++;	?><?php } 

         elseif(($pharma[$i]->name=='TRAYODASHANGA') && (strpos($RX11, 'TRAYODASHANGA') !== false)) {?><?php } 
        elseif(($pharma[$i]->name=='ARSHAKUTHAR VATI') && ((strpos($RX22, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX11, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX33, 'ARSHAKUTHAR VATI') !== false))) { $ARSHAKUTHAR_VATI1++;?><?php } 

        elseif(($pharma[$i]->name=='AROGYAVARDHINI VATI') && (strpos($RX11, 'AROGYAVARDHINI VATI') !== false)) { ?><?php } 
        elseif(($pharma[$i]->name=='KAMDUDHA RAS') && ((strpos($RX11, 'KAMDUDHA RAS') !== false) || (strpos($RX22, 'KAMDUDHA RAS') !== false) || (strpos($RX33, 'KAMDUDHA RAS') !== false))) { $KAMDUDA1++;?><?php } 
        elseif(($pharma[$i]->name=='LAGHU SUTSHEKAR RAS') && ((strpos($RX22, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX33, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX11, 'LAGHU SUTSHEKAR RAS') !== false))) { $LAGHUSUTHSHEKAR1++;?><?php } 
        elseif(($pharma[$i]->name=='LAGHUSUTHSHEKAR') && (strpos($RX11, 'LAGHUSUTHSHEKAR') !== false)) {?><?php } 
         elseif(($pharma[$i]->name=='CHANDRAPRABHA VATI') && (strpos($RX11, 'CHANDRAPRABHA VATI') !== false)) { $CHANDRAPRABHA_VATI1++;?><?php } 
        elseif(($pharma[$i]->name=='MAHAVATVIDHWANSA RAS') && (strpos($RX22, 'MAHAVATVIDHWANSA RAS') !== false)) { $MAHAVATVIDHWANSA_RAS1++;?><?php } 
          elseif(($pharma[$i]->name=='RASNADI GUGGUL') && (strpos($RX22, 'RASNADI GUGGUL') !== false)) { $RASNADI_GUGGUL1++;?><?php } 
          elseif(($pharma[$i]->name=='SIMHANAD GUGGUL') && ((strpos($RX11, 'SIMHANAD GUGGUL') !== false) || (strpos($RX22, 'SIMHANAD GUGGUL') !== false) || (strpos($RX33, 'SIMHANAD GUGGUL') !== false))) { $SIMHANAD_GUGGUL1++;?><?php } 

       elseif(($pharma[$i]->name=='RASNADI GUGGUL') && (strpos($RX22, 'RASNADI GUGGUL') !== false)) { $RASNADI_GUGGUL1++;?><?php } 
         elseif(($pharma[$i]->name=='AMRUTA GUGGUL') && ((strpos($RX11, 'AMRUTA GUGGUL') !== false) || (strpos($RX22, 'AMRUTA GUGGUL') !== false) || (strpos($RX33, 'AMRUTA GUGGUL') !== false))) { $AMRUTA_GUGGUL1++;	?><?php } 
	     elseif(($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI') && (strpos($RX11, 'PRAVAL PANCHAMRUT VATI') !== false)) { $PRAVAL_PANCHAMRUT1++;	?><?php } 
         elseif(($pharma[$i]->name=='GANDHAK RASAYAN VATI') && ((strpos($RX11, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX22, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX33, 'GANDHAK RASAYAN VATI') !== false))) { $GANDHAK_RASAYAN_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='TRAYODASHANGA GUGGUL') && ((strpos($RX11, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX22, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX33, 'TRAYODASHANGA GUGGUL') !== false))) { $TRAYODASHANGA_GUGGUL1++;	?><?php } 
          elseif(($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI') && (strpos($RX22, 'SUKSHMA TRIPHALA GUTI') !== false)) { $SUKSHMA_TRIPHALA_GUTI1++;	?><?php } 
        
         elseif(($pharma[$i]->name=='LAGHU MALINI VASANT') && ((strpos($RX22, 'LAGHU MALINI VASANT') !== false) || (strpos($RX11, 'LAGHU MALINI VASANT') !== false) || (strpos($R33, 'LAGHU MALINI VASANT') !== false))) { $LAGHU_MALINI_VASANT1++;?><?php } 
       elseif(($pharma[$i]->name=='LAVANGADI VATI') && ((strpos($RX22, 'LAVANGADI VATI') !== false) || (strpos($RX11, 'LAVANGADI VATI') !== false) || (strpos($RX33, 'LAVANGADI VATI') !== false))) { $LAVANGADI_VATI1++;?><?php } 
         elseif(($pharma[$i]->name=='SUTSHEKAR RAS VATI') && ((strpos($RX11, 'SUTSHEKAR RAS VATI') !== false) || (strpos($RX22, 'SUTSHEKAR RAS VATI') !== false)|| (strpos($RX33, 'SUTSHEKAR RAS VATI') !== false))) { $SUTSHEKAR1++;?><?php } 
         elseif(($pharma[$i]->name=='YOGARAJ GUGGUL') && (strpos($RX11, 'YOGARAJ GUGGUL') !== false)) { $YOGARAJ_GUGGUL1++;	?><?php } else{?>
       <td></td>
       <?php } } }?>
                
              <!--  <h3>Report Summary</h3>-->
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display: none;">
                    <thead>
                        <tr>
                            <th style="width: 30px;" ><?php echo "S.No" ?></th>
                             <th style="width: 30px;" ><?php echo "Name" ?></th>
                            <!-- <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Total Unit" ?>
                            </th> -->
                             <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Total Tables" ?>
                            </th> 
                           
                                              
                         </tr>
                       
                    </thead>
                    <tbody>
                    <?php $n=1;
                    for($i=0;$i<count($pharma);$i++){?>      
                    <tr>
                        
                       
                        <td><?php echo $n++;?></td> 
                        <td><?php echo $pharma[$i]->name;?></td>  
                     
                        <?php if($pharma[$i]->name=='KAMDUDHA RAS'){?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $KAMDUDA1 * 20; echo " Tbs";}?></td><?php }
                      
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $SUTSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $LAGHU_MALINI_VASANT1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $LAVANGADI_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $CHANDRAPRABHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $KUTAJ_GHANA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $PUNARNAVADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHANKHA VATI'){?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $SHANKHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KAISHOR GUGGUL'){?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $KAISHOR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $KANCHANAR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $KRUMI_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $TAPYADI_LOHA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='NAGA GUTI'){?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $NAGA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $SIMHANAD_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $TRAYODASHANGA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }

                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $GOKSHURADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                    	    	  elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $TRIBHUVAN_KIRTI_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $YOGARAJ_GUGGUL1 * 20; echo " Tbs"; }?></td><?php }

                           elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA1 * 20; echo " Tbs"; }?></td><?php }
                             elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='RASNADI GUGGUL'){?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $RASNADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                          elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $TRIPHALA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $PRAVAL_PANCHAMRUT1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $AMRUTA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $SUKSHMA_TRIPHALA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $MEDOHAR_VATI1 * 20; echo " Tbs";}?></td><?php }

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $SAMSHAMANI_VATI1 * 20; echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $AROGYAVARDHINI1 * 20; echo " Tbs";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php }?>
                        
                        
                      </tr>
                      <?php } ?>
                      
                      <!-- <tr>
                         <td></td>
                         <td>Grand Total</td>
                         <td><?php echo $gt." Tbs";?></td>
                      </tr>-->
                     </tbody>
                </table>
                
                
                
                 <h3>Today's Inventory</h3>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php if($fisrt_hide) { echo 'style="display:none"'; }?>>
                    <thead>
                        <tr>
                            <th style="width: 30px;" ><?php echo "S.No" ?></th>
                             <th style="width: 30px;" ><?php echo "Name" ?></th>
                             <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Opening Balance" ?>
                            </th>
                             <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Medicines Dispense(Tables)" ?>
                            </th> 
                            <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Closing Balance" ?>
                            </th> 
                            <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Requisite" ?>
                            </th> 
                           
                                              
                         </tr>
                       
                    </thead>
                    <tbody>
                    <?php $n=1;
                    for($i=0;$i<count($pharma);$i++){?>      
                    <tr>
                        
                       
                        <td><?php echo $n++;?></td> 
                        <td><?php echo $pharma[$i]->name;?></td>  
                        <td><?php echo $pharma[$i]->opening_bal;?></td>  
                       
                        <?php if($pharma[$i]->name=='KAMDUDHA RAS'){
                         
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=10000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($KAMDUDA1 * 20);
                        $to_day=$KAMDUDA1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                        
                        ?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $KAMDUDA1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SUTSHEKAR1 * 20);
                        $to_day=$SUTSHEKAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                        ?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $SUTSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($ARSHAKUTHAR_VATI1 * 20);
                        $to_day=$ARSHAKUTHAR_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($LAGHU_MALINI_VASANT1 * 20);
                        $to_day=$LAGHU_MALINI_VASANT1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                        
                        ?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $LAGHU_MALINI_VASANT1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($LAVANGADI_VATI1 * 20);
                        $to_day=$LAVANGADI_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}    
                        ?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $LAVANGADI_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=30000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($CHANDRAPRABHA_VATI1 * 20);
                        $to_day=$CHANDRAPRABHA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $CHANDRAPRABHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=10000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($KUTAJ_GHANA_VATI1 * 20);
                        $to_day=$KUTAJ_GHANA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $KUTAJ_GHANA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                         elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=12000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($MAHAVATVIDHWANSA_RAS1 * 20);
                        $to_day=$MAHAVATVIDHWANSA_RAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                         ?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA_RAS1 * 20; echo " Tbs";}?></td><?php }
                         
                        elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($PUNARNAVADI_GUGGUL1 * 20);
                        $to_day=$PUNARNAVADI_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $PUNARNAVADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='SHANKHA VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SHANKHA_VATI1 * 20);
                        $to_day=$SHANKHA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $SHANKHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='KAISHOR GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($KAISHOR_GUGGUL1 * 20);
                        $to_day=$KAISHOR_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $KAISHOR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=6000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($KANCHANAR_GUGGUL1 * 20);
                        $to_day=$KANCHANAR_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $KANCHANAR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=3500;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($ARSHAKUTHAR_VATI1 * 20);
                        $to_day=$ARSHAKUTHAR_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                        elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($KRUMI_KUTHAR_RAS1 * 20);
                        $to_day=$KRUMI_KUTHAR_RAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $KRUMI_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=15000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($TAPYADI_LOHA_GUTI1 * 20);
                        $to_day=$TAPYADI_LOHA_GUTI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $TAPYADI_LOHA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='NAGA GUTI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($NAGA_GUTI1 * 20);
                        $to_day=$NAGA_GUTI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $NAGA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=10000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SIMHANAD_GUGGUL1 * 20);
                        $to_day=$SIMHANAD_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $SIMHANAD_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($TRAYODASHANGA_GUGGUL1 * 20);
                        $to_day=$TRAYODASHANGA_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $TRAYODASHANGA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         

                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($GANDHAK_RASAYAN1 * 20);
                        $to_day=$GANDHAK_RASAYAN1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}      
                         
                         ?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($GOKSHURADI_GUGGUL1 * 20);
                        $to_day=$GOKSHURADI_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $GOKSHURADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                    	 elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){
                    	 if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=6000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($TRIBHUVAN_KIRTI_VATI1 * 20);
                        $to_day=$TRIBHUVAN_KIRTI_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                    	 ?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $TRIBHUVAN_KIRTI_VATI1 * 20; echo " Tbs";}?></td><?php }
                    	 
                         elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=30000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($YOGARAJ_GUGGUL1 * 20);
                        $to_day=$YOGARAJ_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $YOGARAJ_GUGGUL1 * 20; echo " Tbs"; }?></td><?php }
                         
                         

                         elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=12000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($MAHAVATVIDHWANSA1 * 20);
                        $to_day=$MAHAVATVIDHWANSA1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                         
                         ?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA1 * 20; echo " Tbs"; }?></td><?php }
                         
                         elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($LAGHUSUTHSHEKAR1 * 20);
                        $to_day=$LAGHUSUTHSHEKAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($LAGHUSUTHSHEKAR1 * 20);
                        $to_day=$LAGHUSUTHSHEKAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         
                         ?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($GANDHAK_RASAYAN_VATI1 * 20);
                        $to_day=$GANDHAK_RASAYAN_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                         ?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN_VATI1 * 20; echo " Tbs";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='RASNADI GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=12000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($RASNADI_GUGGUL1 * 20);
                        $to_day=$RASNADI_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                         ?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $RASNADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=50000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($TRIPHALA_GUGGUL1 * 20);
                        $to_day=$TRIPHALA_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $TRIPHALA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SHWAS_KUTHAR1 * 20);
                        $to_day=$SHWAS_KUTHAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=15000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($PRAVAL_PANCHAMRUT1 * 20);
                        $to_day=$PRAVAL_PANCHAMRUT1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                         ?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $PRAVAL_PANCHAMRUT1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4500;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($AMRUTA_GUGGUL1 * 20);
                        $to_day=$AMRUTA_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $AMRUTA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SUKSHMA_TRIPHALA_GUTI1 * 20);
                        $to_day=$SUKSHMA_TRIPHALA_GUTI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $SUKSHMA_TRIPHALA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SHWAS_KUTHAR_RAS1 * 20);
                        $to_day=$SHWAS_KUTHAR_RAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){
                       	 if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($MEDOHAR_VATI1 * 20);
                        $to_day=$MEDOHAR_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                       	 ?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $MEDOHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                       	 
                       	 

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($SAMSHAMANI_VATI1 * 20);
                        $to_day=$SAMSHAMANI_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         
                         ?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $SAMSHAMANI_VATI1 * 20; echo " Tbs";}?></td><?php }
                         
                         

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=30000;
                         if($che_no < 0 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($AROGYAVARDHINI1 * 20);
                        $to_day=$AROGYAVARDHINI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}    
                            
                        ?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $AROGYAVARDHINI1 * 20; echo " Tbs";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php }?>
                        
                        
                        
                          <?php if($pharma[$i]->name=='KAMDUDHA RAS'){?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KAMDUDA1 * 20); echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SUTSHEKAR1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($LAGHU_MALINI_VASANT1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($LAVANGADI_VATI1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($CHANDRAPRABHA_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KUTAJ_GHANA_VATI1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($MAHAVATVIDHWANSA_RAS1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($PUNARNAVADI_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHANKHA VATI'){?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SHANKHA_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KAISHOR GUGGUL'){?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KAISHOR_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KANCHANAR_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($ARSHAKUTHAR_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KRUMI_KUTHAR_RAS1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TAPYADI_LOHA_GUTI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='NAGA GUTI'){?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($NAGA_GUTI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SIMHANAD_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TRAYODASHANGA_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($ARSHAKUTHAR_VATI1 * 20); echo " Tbs";}?></td><?php }

                      


                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($GANDHAK_RASAYAN1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($GOKSHURADI_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                    	 elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TRIBHUVAN_KIRTI_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($YOGARAJ_GUGGUL1 * 20); echo " Tbs"; }?></td><?php }

                         elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($MAHAVATVIDHWANSA1 * 20); echo " Tbs"; }?></td><?php }
                         elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $pharma[$i]->opening_bal - ($LAGHUSUTHSHEKAR1 * 20); echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($LAGHUSUTHSHEKAR1 * 20); echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($GANDHAK_RASAYAN_VATI1 * 20); echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='RASNADI GUGGUL'){?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($RASNADI_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                          elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TRIPHALA_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SHWAS_KUTHAR1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($PRAVAL_PANCHAMRUT1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($AMRUTA_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SUKSHMA_TRIPHALA_GUTI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SHWAS_KUTHAR_RAS1 * 20); echo " Tbs";}?></td><?php }
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal -($MEDOHAR_VATI1 * 20); echo " Tbs";}?></td><?php }

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal- ($SAMSHAMANI_VATI1 * 20); echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($AROGYAVARDHINI1 * 20); echo " Tbs";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php }?>
                       
                       
                        <?php if($pharma[$i]->name=='KAMDUDHA RAS'){?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $KAMDUDA1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $SUTSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $LAGHU_MALINI_VASANT1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $LAVANGADI_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $CHANDRAPRABHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $KUTAJ_GHANA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $PUNARNAVADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHANKHA VATI'){?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $SHANKHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KAISHOR GUGGUL'){?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $KAISHOR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $KANCHANAR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $KRUMI_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $TAPYADI_LOHA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='NAGA GUTI'){?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $NAGA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $SIMHANAD_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $TRAYODASHANGA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }


                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $GOKSHURADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                    	    	  elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $TRIBHUVAN_KIRTI_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $YOGARAJ_GUGGUL1 * 20; echo " Tbs"; }?></td><?php }

                           elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA1 * 20; echo " Tbs"; }?></td><?php }
                             elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='RASNADI GUGGUL'){?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $RASNADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                          elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $TRIPHALA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $PRAVAL_PANCHAMRUT1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $AMRUTA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $SUKSHMA_TRIPHALA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $MEDOHAR_VATI1 * 20; echo " Tbs";}?></td><?php }

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $SAMSHAMANI_VATI1 * 20; echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $AROGYAVARDHINI1 * 20; echo " Tbs";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php }?>
                      </tr>
                      <?php } ?>
                      
                      <!-- <tr>
                         <td></td>
                         <td>Grand Total</td>
                         <td><?php echo $gt." Tbs";?></td>
                      </tr>-->
                     </tbody>
                </table>
                
                <?php } else { ?>
                
                <?php 
                $gt=0;$ASHWAGANDHA1=0;$SITOPALADI1=0;$GANDHARVAHAREETAKI1=0;$BALA1=0;$KIRAT_TIKTA1	=0;$HINGVASHTAK1=0; $LODHRA1=0; $YASHTIMADHU1=0;	
                $NAGKESHAR1=0;$ASHOK1=0;$SHATAVARI1=0;$PUNARNAVA1=0;$TRIKATU1=0;$DASHAMOOL1=0;$SARPAGANDA1=0;$SUNTI1=0;$MUSTA1=0; $VASA1=0; $AVIPATTIKAR1=0; $PATOLA1=0;
                $DARUHARIDRA1=0;$JAMBU1=0;$KHADIR1=0;$NISHOTTAR1=0;$ERANDAMOOL1=0; $CHITRAK1=0; $HAREETAKI1=0; $MANJISHTHA1=0; $GUDMAR1=0; $PIPPALI1=0; $AMALAKI1=0; $KUTKI1=0; $KIRATATIKTA1=0;
               $GOKSHUR1=0;$BALA_POWDER1=0;$SARIVA1=0; $TRIPHALA1=0; $GULVEL1=0; $VACHA1=0; $RASNA1=0; $CHOPCHINI1=0; $VIDANGA1=0; $MUSTA_POWDER1=0;
               
               $KAMDUDA1=0; $SUTSHEKAR1=0;$AROGYAVARDHINI1=0;$GANDHAK_RASAYAN1=0;$TRIBHUVAN_KIRTI_VATI1=0;$YOGARAJ_GUGGUL1=0;$TRAYODASHANGA_GUGGUL1=0;$TRASNADI_GUGGUL1=0; $GANDHAK_RASAYAN_VATI1=0;$LAGHUSUTHSHEKAR1=0;$RASNADI_GUGGUL1=0;$GOKSHURADI_GUGGUL1=0;	
                $TRIPHALA_GUGGUL1=0;$SAMSHAMANI_VATI1=0;$MAHAVATVIDHWANSA1=0;$SHWAS_KUTHAR1=0;$PRAVAL_PANCHAMRUT1=0;$AMRUTA_GUGGUL1=0; $VASA1=0; $LAGHU_MALINI_VASANT1=0; $LAVANGADI_VATI1=0; $ARSHAKUTHAR_VATI1=0; $KRUMI_KUTHAR_RAS1=0;
                $CHANDRAPRABHA_VATI1=0; $KUTAJ_GHANA_VATI1=0; $MAHAVATVIDHWANSA_RAS1=0; $SUKSHMA_TRIPHALA_GUTI1=0; $PUNARNAVADI_GUGGUL1=0; $SHANKHA_VATI1=0;$SHWAS_KUTHAR_RAS1=0; $KAISHOR_GUGGUL1=0; $KANCHANAR_GUGGUL1=0; $MEDOHAR_VATI1=0;
                $TAPYADI_LOHA_GUTI1=0;$NAGA_GUTI1=0; $SIMHANAD_GUGGUL1=0;
                $WALA1=0;$TRIPHALA_VATI1=0;    $ABHA1=0;$AMAPACHAK1=0;$ASTHIPOSHAK1=0;   $BRAMHI1=0;$LAKSHADI1=0;$LAKSHMIVILAS1=0;    $MAHAMANJISHTHADI1=0;$MAHASUDARSHAN1=0;$MAHAYOGRAJ1=0;   $RAJAPRAVARTINI1 =0;$SANJIVANEE1=0;$SAPTAMRUT1=0; 
               
               $BHASKAR1=0;$DHAMASA1=0;$JATAMASI1=0;   $MANJISHTHA1=0;$OVA1=0;$PASHANBHED1=0; $PATHA1=0;  
              
                foreach ($patients_summary as $patients_sum) { 
                       $ipd=$patients_sum->ipd_opd;
                                      $che=trim($patients_sum->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $patients_sum->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                         
                                          if($t_c=='2'){
                                               // echo $dd;
                                              
                                                $dd1=substr($che, 0, -1);
                                            $p_dignosis = '%'.$arry[0].'%';
                                            trim($p_dignosis);
                                             $p_dignosis_name=$patients_sum->dignosis;
                                      }else{
                                           //echo $dd;
                                           
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patients_sum->dignosis;
                                            
                                            
                                      }
                                      
                                    
                                   
                                    
                                    
                                       $ss=date('Y-m-d',strtotime($dateto));
                                   
                                        
                                       $table='treatments1';
                                   
                                    
                                    
                                    
                                 if($patients_sum->manual_status==0){
                                    
                                     
                                     
                                      $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                      
			                          ->where('department_id',$patients_sum->department_id)
			                         ->where('ipd_opd',$section_tret)
                                     ->get()
                                     ->row();
                                     
                                     
                                      if(empty($tretment)){
                                      $tretment=$this->db->select("*")
                                       ->from('treatments1')
                                      ->where('department_id',$patients_sum->department_id)
			                          ->where('ipd_opd',$patients_sum->department_id)
                                     ->get()
                                     ->row();   
                                         
                                     }
                                     
                                     
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patients_sum->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
			                     
			                      $RX11= $tretment->RX1;
			                      $RX22= $tretment->RX2;
			                      $RX33= $tretment->RX3;
			                      
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                     
			                     
			                    
    
    ?>
    
        <?php for($i=0;$i<count($pharma);$i++){  if(($pharma[$i]->name=='MUSTA') && (strpos($RX22, 'MUSTA') !== false)) { $MUSTA1++;?><?php } 
         elseif(($pharma[$i]->name=='SUNTHI CHURNA') && ((strpos($RX33, 'SUNTHI CHURNA') !== false) || (strpos($RX11, 'SUNTHI CHURNA') !== false) || (strpos($RX22, 'SUNTHI CHURNA') !== false))) { $SUNTI1++; ?><?php } 
        
        elseif(($pharma[$i]->name=='BHASKAR LAVAN') && ((strpos($RX33, 'BHASKAR LAVAN') !== false) || (strpos($RX11, 'BHASKAR LAVAN') !== false) || (strpos($RX22, 'BHASKAR LAVAN') !== false))) { $BHASKAR1++; ?><?php } 
        elseif(($pharma[$i]->name=='DHAMASA CHURNA') && ((strpos($RX33, 'DHAMASA CHURNA') !== false) || (strpos($RX11, 'DHAMASA CHURNA') !== false) || (strpos($RX22, 'DHAMASA CHURNA') !== false))) { $DHAMASA1++; ?><?php } 
        elseif(($pharma[$i]->name=='JATAMASI CHURNA') && ((strpos($RX33, 'JATAMASI CHURNA') !== false) || (strpos($RX11, 'JATAMASI CHURNA') !== false) || (strpos($RX22, 'JATAMASI CHURNA') !== false))) { $JATAMASI1++; ?><?php }
        elseif(($pharma[$i]->name=='MANJISHTHA CHURNA') && ((strpos($RX33, 'MANJISHTHA CHURNA') !== false) || (strpos($RX11, 'MANJISHTHA CHURNA') !== false) || (strpos($RX22, 'MANJISHTHA CHURNA') !== false))) { $MANJISHTHA1++; ?><?php } 
        
        elseif(($pharma[$i]->name=='OVA CHURNA') && ((strpos($RX33, 'OVA CHURNA') !== false) || (strpos($RX11, 'OVA CHURNA') !== false) || (strpos($RX22, 'OVA CHURNA') !== false))) { $OVA1++; ?><?php } 
        elseif(($pharma[$i]->name=='PASHANBHED CHURNA') && ((strpos($RX33, 'PASHANBHED CHURNA') !== false) || (strpos($RX11, 'PASHANBHED CHURNA') !== false) || (strpos($RX22, 'PASHANBHED CHURNA') !== false))) { $PASHANBHED1++; ?><?php } 
        elseif(($pharma[$i]->name=='PATHA CHURNA') && ((strpos($RX33, 'PATHA CHURNA') !== false) || (strpos($RX11, 'PATHA CHURNA') !== false) || (strpos($RX22, 'PATHA CHURNA') !== false))) { $PATHA1++; ?><?php } 
        
        
        
        
         elseif(($pharma[$i]->name=='WALA CURNA') && ((strpos($RX33, 'WALA CURNA') !== false) || (strpos($RX11, 'WALA CURNA') !== false) || (strpos($RX22, 'WALA CURNA') !== false))) { $WALA1++; ?><?php }        
         elseif(($pharma[$i]->name=='TRIPHALA VATI') && ((strpos($RX33, 'TRIPHALA VATI') !== false) || (strpos($RX11, 'TRIPHALA VATI') !== false) || (strpos($RX22, 'TRIPHALA VATI') !== false))) { $TRIPHALA_VATI1++; ?><?php }        


        elseif(($pharma[$i]->name=='ABHA GUGGUL') && ((strpos($RX33, 'ABHA GUGGUL') !== false) || (strpos($RX11, 'ABHA GUGGUL') !== false) || (strpos($RX22, 'ABHA GUGGUL') !== false))) { $ABHA1++; ?><?php }        
        elseif(($pharma[$i]->name=='AMAPACHAK VATI') && ((strpos($RX33, 'AMAPACHAK VATI') !== false) || (strpos($RX11, 'AMAPACHAK VATI') !== false) || (strpos($RX22, 'AMAPACHAK VATI') !== false))) { $AMAPACHAK1++; ?><?php }  
        elseif(($pharma[$i]->name=='ASTHIPOSHAK VATI') && ((strpos($RX33, 'ASTHIPOSHAK VATI') !== false) || (strpos($RX11, 'ASTHIPOSHAK VATI') !== false) || (strpos($RX22, 'ASTHIPOSHAK VATI') !== false))) { $ASTHIPOSHAK1++; ?><?php } 
        
        elseif(($pharma[$i]->name=='BRAMHI VATI') && ((strpos($RX33, 'BRAMHI VATI') !== false) || (strpos($RX11, 'BRAMHI VATI') !== false) || (strpos($RX22, 'BRAMHI VATI') !== false))) { $BRAMHI1++; ?><?php }        
        elseif(($pharma[$i]->name=='LAKSHADI GUGGUL') && ((strpos($RX33, 'LAKSHADI GUGGUL') !== false) || (strpos($RX11, 'LAKSHADI GUGGUL') !== false) || (strpos($RX22, 'LAKSHADI GUGGUL') !== false))) { $LAKSHADI1++; ?><?php }  
        elseif(($pharma[$i]->name=='LAKSHMIVILAS RAS') && ((strpos($RX33, 'LAKSHMIVILAS RAS') !== false) || (strpos($RX11, 'LAKSHMIVILAS RAS') !== false) || (strpos($RX22, 'LAKSHMIVILAS RAS') !== false))) { $LAKSHMIVILAS1++; ?><?php }
        
        elseif(($pharma[$i]->name=='MAHAMANJISHTHADI VATI') && ((strpos($RX33, 'MAHAMANJISHTHADI VATI') !== false) || (strpos($RX11, 'MAHAMANJISHTHADI VATI') !== false) || (strpos($RX22, 'MAHAMANJISHTHADI VATI') !== false))) { $MAHAMANJISHTHADI1++; ?><?php }        
        elseif(($pharma[$i]->name=='MAHASUDARSHAN VATI') && ((strpos($RX33, 'MAHASUDARSHAN VATI') !== false) || (strpos($RX11, 'MAHASUDARSHAN VATI') !== false) || (strpos($RX22, 'MAHASUDARSHAN VATI') !== false))) { $MAHASUDARSHAN1++; ?><?php }  
        elseif(($pharma[$i]->name=='MAHAYOGRAJ GUGGUL') && ((strpos($RX33, 'MAHAYOGRAJ GUGGUL') !== false) || (strpos($RX11, 'MAHAYOGRAJ GUGGUL') !== false) || (strpos($RX22, 'MAHAYOGRAJ GUGGUL') !== false))) { $MAHAYOGRAJ1++; ?><?php }
        
        elseif(($pharma[$i]->name=='RAJAPRAVARTINI VATI') && ((strpos($RX33, 'RAJAPRAVARTINI VATI') !== false) || (strpos($RX11, 'RAJAPRAVARTINI VATI') !== false) || (strpos($RX22, 'RAJAPRAVARTINI VATI') !== false))) { $RAJAPRAVARTINI1 ++; ?><?php }        
        elseif(($pharma[$i]->name=='RAJAPRAVARTINI VATI') && ((strpos($RX33, 'RAJAPRAVARTINI VATI') !== false) || (strpos($RX11, 'RAJAPRAVARTINI VATI') !== false) || (strpos($RX22, 'RAJAPRAVARTINI VATI') !== false))) { $SANJIVANEE1++; ?><?php }  
        elseif(($pharma[$i]->name=='SAPTAMRUT LOHA GUTI') && ((strpos($RX33, 'SAPTAMRUT LOHA GUTI') !== false) || (strpos($RX11, 'SAPTAMRUT LOHA GUTI') !== false) || (strpos($RX22, 'SAPTAMRUT LOHA GUTI') !== false))) { $SAPTAMRUT1++; ?><?php }



         elseif(($pharma[$i]->name=='HINGVASHTAK CHURNA') && ((strpos($RX22, 'HINGVASHTAK CHURNA') !== false) || (strpos($RX11, 'HINGVASHTAK CHURNA') !== false) || (strpos($RX33, 'HINGVASHTAK CHURNA') !== false))) {  $HINGVASHTAK1++; ?><?php } 
        elseif(($pharma[$i]->name=='JAMBU CHURNA') && ((strpos($RX33, 'JAMBU CHURNA') !== false) || (strpos($RX11, 'JAMBU CHURNA') !== false) || (strpos($RX22, 'JAMBU CHURNA') !== false))) { $JAMBU1++; ?><?php }        
         elseif(($pharma[$i]->name=='DARUHARIDRA CHURNA') && ((strpos($RX33, 'DARUHARIDRA CHURNA') !== false) || (strpos($RX11, 'DARUHARIDRA CHURNA') !== false) || (strpos($RX22, 'DARUHARIDRA CHURNA') !== false))) { $DARUHARIDRA1++; ?><?php }
         elseif(($pharma[$i]->name=='ERANDAMOOL CHURNA') && ((strpos($RX33, 'ERANDAMOOL CHURNA') !== false) || (strpos($RX11, 'ERANDAMOOL CHURNA') !== false) || (strpos($RX22, 'ERANDAMOOL CHURNA') !== false))) { $ERANDAMOOL1++; ?><?php }
         elseif(($pharma[$i]->name=='PIPPALI CHURNA') && ((strpos($RX33, 'PIPPALI CHURNA') !== false) || (strpos($RX11, 'PIPPALI CHURNA') !== false) || (strpos($RX22, 'PIPPALI CHURNA') !== false))) { $PIPPALI1++; ?><?php }
        elseif(($pharma[$i]->name=='KUTKI CHURNA') && ((strpos($RX22, 'KUTKI CHURNA') !== false) || (strpos($RX11, 'KUTKI CHURNA') !== false)  || (strpos($RX33, 'KUTKI CHURNA') !== false))) { $KUTKI1++; ?><?php }        
        elseif(($pharma[$i]->name=='KIRATATIKTA CHURNA') && ((strpos($RX33, 'KIRATATIKTA CHURNA') !== false) || (strpos($RX11, 'KIRATATIKTA CHURNA') !== false) || (strpos($RX22, 'KIRATATIKTA CHURNA') !== false))) { $KIRATATIKTA1++; ?><?php }        
        elseif(($pharma[$i]->name=='GOKSHUR CHURNA') && ((strpos($RX11, 'GOKSHUR CHURNA') !== false) || (strpos($RX22, 'GOKSHUR CHURNA') !== false) || (strpos($RX33, 'GOKSHUR CHURNA') !== false))) { $GOKSHUR1++; ?><?php }        
        elseif(($pharma[$i]->name=='SARIVA CHURNA') && ((strpos($RX22, 'SARIVA CHURNA') !== false) || (strpos($RX11, 'SARIVA CHURNA') !== false) || (strpos($RX33, 'SARIVA CHURNA') !== false))) { $SARIVA1++; ?><?php }        
        elseif(($pharma[$i]->name=='RASNA CHURNA') && ((strpos($RX11, 'RASNA CHURNA') !== false) || (strpos($RX22, 'RASNA CHURNA') !== false) || (strpos($RX33, 'RASNA CHURNA') !== false))) { $RASNA1++; ?><?php }        
        elseif(($pharma[$i]->name=='TRIPHALA CHURNA') && ((strpos($RX11, 'TRIPHALA CHURNA') !== false) || (strpos($RX22, 'TRIPHALA CHURNA') !== false))) { $TRIPHALA1++; ?><?php }          
         elseif(($pharma[$i]->name=='GANDHARVAHAREETAKI CHURNA') && ((strpos($RX22, 'GANDHARVAHAREETAKI CHURNA') !== false) || (strpos($RX11, 'GANDHARVAHAREETAKI CHURNA') !== false) || (strpos($RX33, 'GANDHARVAHAREETAKI CHURNA') !== false))) { $GANDHARVAHAREETAKI1++; ?><?php }
         elseif(($pharma[$i]->name=='PUNARNAVA CHURNA') && ((strpos($RX22, 'PUNARNAVA CHURNA') !== false) || (strpos($RX11, 'PUNARNAVA CHURNA') !== false) || (strpos($RX33, 'PUNARNAVA CHURNA') !== false))) { $PUNARNAVA1++;?><?php }
         elseif(($pharma[$i]->name=='VASA CHURNA') && ((strpos($RX22, 'VASA CHURNA') !== false) || (strpos($RX33, 'VASA CHURNA') !== false) || (strpos($RX11, 'VASA CHURNA') !== false))) { $VASA1++; ?><?php }
         elseif(($pharma[$i]->name=='AVIPATTIKAR CHURNA') && ((strpos($RX22, 'AVIPATTIKAR CHURNA') !== false) || (strpos($RX11, 'AVIPATTIKAR CHURNA') !== false) || (strpos($RX33, 'AVIPATTIKAR CHURNA') !== false))) { $AVIPATTIKAR1++; ?><?php }
         elseif(($pharma[$i]->name=='CHITRAK CHURNA') && ((strpos($RX22, 'CHITRAK CHURNA') !== false) || (strpos($RX11, 'CHITRAK CHURNA') !== false) || (strpos($RX33, 'CHITRAK CHURNA') !== false))) { $CHITRAK1++; ?><?php }
        elseif(($pharma[$i]->name=='HAREETAKI CHURNA') && ((strpos($RX11, 'HAREETAKI CHURNA') !== false) || (strpos($RX22, 'HAREETAKI CHURNA') !== false) || (strpos($RX33, 'HAREETAKI CHURNA') !== false))) { $HAREETAKI1++;?><?php }
        elseif(($pharma[$i]->name=='MANJISHTHA CHURNA') && ((strpos($RX22, 'MANJISHTHA CHURNA') !== false) || (strpos($RX33, 'MANJISHTHA CHURNA') !== false) || (strpos($RX11, 'MANJISHTHA CHURNA') !== false))) { $MANJISHTHA1++;?><?php }
	     elseif(($pharma[$i]->name=='LODHRA CHURNA') && ((strpos($RX22, 'LODHRA CHURNA') !== false) || (strpos($RX11, 'LODHRA CHURNA') !== false) || (strpos($RX33, 'LODHRA CHURNA') !== false))) { $LODHRA1++;?><?php }
	     elseif(($pharma[$i]->name=='VACHA CHURNA') && ((strpos($RX33, 'VACHA CHURNA') !== false) || (strpos($RX11, 'VACHA CHURNA') !== false) || (strpos($RX22, 'VACHA CHURNA') !== false))) { $VACHA1++;?><?php }
	     elseif(($pharma[$i]->name=='VIDANGA CHURNA') && ((strpos($RX33, 'VIDANGA CHURNA') !== false)  || (strpos($RX11, 'VIDANGA CHURNA') !== false) || (strpos($RX22, 'VIDANGA CHURNA') !== false))) { $VIDANGA1++;?><?php }
	     elseif(($pharma[$i]->name=='MUSTA POWDER') && ((strpos($RX22, 'MUSTA POWDER') !== false) || (strpos($RX11, 'MUSTA POWDER') !== false) || (strpos($RX33, 'MUSTA POWDER') !== false))) { $MUSTA_POWDER1++;?><?php }

         elseif(($pharma[$i]->name=='TRIKATU CHURNA') && ((strpos($RX22, 'TRIKATU CHURNA') !== false) || (strpos($RX11, 'TRIKATU CHURNA') !== false))) { $TRIKATU1++;?><?php }
         elseif(($pharma[$i]->name=='KHADIR CHURNA') && ((strpos($RX22, 'KHADIR CHURNA') !== false) || (strpos($RX11, 'KHADIR CHURNA') !== false) || (strpos($RX33, 'KHADIR CHURNA') !== false))) { $KHADIR1++;?><?php }
         elseif(($pharma[$i]->name=='YASHTIMADHU CHURNA') && ((strpos($RX22, 'YASHTIMADHU CHURNA') !== false) || (strpos($RX11, 'YASHTIMADHU CHURNA') !== false) || (strpos($RX33, 'YASHTIMADHU CHURNA') !== false))) { $YASHTIMADHU1++;?><?php }
         elseif(($pharma[$i]->name=='BALA POWDER') && ((strpos($RX22, 'BALA POWDER') !== false) || (strpos($RX11, 'BALA POWDER') !== false) || (strpos($RX11, 'BALA POWDER') !== false))) { $BALA_POWDER1++;?><?php }
         elseif(($pharma[$i]->name=='SHATAVARI CHURNA') && ((strpos($RX11, 'SHATAVARI CHURNA') !== false) || (strpos($RX22, 'SHATAVARI CHURNA') !== false) || (strpos($RX33, 'SHATAVARI CHURNA') !== false))) { $SHATAVARI1++;?><?php }
         elseif(($pharma[$i]->name=='PATOLA CHURNA') && ((strpos($RX11, 'PATOLA CHURNA') !== false) || (strpos($RX22, 'PATOLA CHURNA') !== false) || (strpos($RX33, 'PATOLA CHURNA') !== false))) { $PATOLA1++;?><?php }
         elseif(($pharma[$i]->name=='SARPAGANDHA CHURNA') && (strpos($RX11, 'SARPAGANDHA CHURNA') !== false)) { $SARPAGANDA1++;?><?php }
         elseif(($pharma[$i]->name=='AMALAKI CHURNA') && ((strpos($RX22, 'AMALAKI CHURNA') !== false) || (strpos($RX11, 'AMALAKI CHURNA') !== false) || (strpos($RX33, 'AMALAKI CHURNA') !== false))) { $AMALAKI1++;?><?php }
         elseif(($pharma[$i]->name=='GULVEL CHURNA') && ((strpos($RX11, 'GULVEL CHURNA') !== false) || (strpos($RX22, 'GULVEL CHURNA') !== false) ||(strpos($RX33, 'GULVEL CHURNA') !== false))) { $GULVEL1++;?><?php }
         elseif(($pharma[$i]->name=='GUDMAR CHURNA') && ((strpos($RX11, 'GUDMAR CHURNA') !== false) || (strpos($RX22, 'GUDMAR CHURNA') !== false) || (strpos($RX33, 'GUDMAR CHURNA') !== false))) { $GUDMAR1++;?><?php }
         elseif(($pharma[$i]->name=='DASHAMOOL CHURNA') && ((strpos($RX11, 'DASHAMOOL CHURNA') !== false) || (strpos($RX22, 'DASHAMOOL CHURNA') !== false))) { $DASHAMOOL1++;?><?php }
         elseif(($pharma[$i]->name=='NISHOTTAR CHURNA') && ((strpos($RX11, 'NISHOTTAR CHURNA') !== false) || (strpos($RX22, 'NISHOTTAR CHURNA') !== false) || (strpos($RX33, 'NISHOTTAR') !== false))) { $NISHOTTAR1++;?><?php }
         elseif(($pharma[$i]->name=='CHOPCHINI CHURNA') && ((strpos($RX11, 'CHOPCHINI CHURNA') !== false) || (strpos($RX22, 'CHOPCHINI CHURNA') !== false)  || (strpos($RX33, 'CHOPCHINI CHURNA') !== false))) { $CHOPCHINI1++;?><?php }

         elseif(($pharma[$i]->name=='NAGKESHAR CHURNA') && ((strpos($RX11, 'NAGKESHAR CHURNA') !== false) || (strpos($RX22, 'NAGKESHAR CHURNA') !== false)  || (strpos($RX33, 'NAGKESHAR CHURNA') !== false))) { $NAGKESHAR1++; ?><?php }
         elseif(($pharma[$i]->name=='ASHOK CHURNA') && ((strpos($RX22, 'ASHOK CHURNA') !== false) || (strpos($RX11, 'ASHOK CHURNA') !== false) || (strpos($RX33, 'ASHOK CHURNA') !== false))) { $ASHOK1++;?><td><?php } 

        elseif(($pharma[$i]->name=='SAMSHAMANI VATI') && (strpos($RX11, 'SAMSHAMANI VATI') !== false)) { $SAMSHAMANI_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='RASNADI GUGGULkkk') && (strpos($RX22, 'RASNADI GUGGUL') !== false)) { 	?><?php } 
         elseif(($pharma[$i]->name=='KANCHANAR GUGGUL') && ((strpos($RX11, 'KANCHANAR GUGGUL') !== false) || (strpos($RX22, 'KANCHANAR GUGGUL') !== false) || (strpos($RX33, 'KANCHANAR GUGGUL') !== false))) { $KANCHANAR_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='KRUMI KUTHAR RAS') && ((strpos($RX11, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX22, 'KRUMI KUTHAR RAS') !== false) || (strpos($RX33, 'KRUMI KUTHAR RAS') !== false))) { $KRUMI_KUTHAR_RAS1++;	?><?php } 
         elseif(($pharma[$i]->name=='NAGA GUTI') && ((strpos($RX33, 'NAGA GUTI') !== false) || (strpos($RX22, 'NAGA GUTI') !== false) || (strpos($RX11, 'NAGA GUTI') !== false))) { $NAGA_GUTI1++;	?><?php } 

         elseif(($pharma[$i]->name=='GOKSHURADI GUGGUL') && ((strpos($RX22, 'GOKSHURADI GUGGUL') !== false) || (strpos($RX11, 'GOKSHURADI GUGGUL') !== false) || (strpos($RX33, 'GOKSHURADI GUGGUL') !== false))) { $GOKSHURADI_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='SHWAS KUTHAR') && (strpos($RX11, 'SHWAS KUTHAR') !== false)) { $SHWAS_KUTHAR1++;	?><?php } 
         elseif(($pharma[$i]->name=='TRIBHUVAN KIRTI VATI') && ((strpos($RX11, 'TRIBHUVAN KIRTI VATI') !== false) || (strpos($RX22, 'TRIBHUVAN KIRTI VATI') !== false) ||(strpos($RX33, 'TRIBHUVAN KIRTI VATI') !== false))) { $TRIBHUVAN_KIRTI_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='PUNARNAVADI GUGGUL') && ((strpos($RX33, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX22, 'PUNARNAVADI GUGGUL') !== false) || (strpos($RX11, 'PUNARNAVADI GUGGUL') !== false))) { $PUNARNAVADI_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='SHANKHA VATI') && ((strpos($RX22, 'SHANKHA VATI') !== false) || (strpos($RX11, 'SHANKHA VATI') !== false) || (strpos($RX33, 'SHANKHA VATI') !== false))) { $SHANKHA_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='SHWAS KUTHAR RAS') && ((strpos($RX11, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX22, 'SHWAS KUTHAR RAS') !== false) || (strpos($RX33, 'SHWAS KUTHAR RAS') !== false))) { $SHWAS_KUTHAR_RAS1++;	?><?php } 
         elseif(($pharma[$i]->name=='KAISHOR GUGGUL') && ((strpos($RX22, 'KAISHOR GUGGUL') !== false) || (strpos($RX33, 'KAISHOR GUGGUL') !== false) || (strpos($RX11, 'KAISHOR GUGGUL') !== false))) { $KAISHOR_GUGGUL1++;	?><?php } 
         elseif(($pharma[$i]->name=='MEDOHAR VATI') && (strpos($RX33, 'MEDOHAR VATI') !== false)) { $MEDOHAR_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='TAPYADI LOHA GUTI') && ((strpos($RX22, 'TAPYADI LOHA GUTI') !== false) || (strpos($RX33, 'TAPYADI LOHA GUTI') !== false) || (strpos($RX11, 'TAPYADI LOHA GUTI') !== false))) { $TAPYADI_LOHA_GUTI1++;	?><?php } 

         elseif(($pharma[$i]->name=='TRIPHALA GUGGUL') && ((strpos($RX22, 'TRIPHALA GUGGUL') !== false) || (strpos($RX33, 'TRIPHALA GUGGUL') !== false) || (strpos($RX11, 'TRIPHALA GUGGUL') !== false))) { $TRIPHALA_GUGGUL1++;	?><?php } 

         elseif(($pharma[$i]->name=='KUTAJ GHANA VATI') && (strpos($RX22, 'KUTAJ GHANA VATI') !== false)) { $KUTAJ_GHANA_VATI1++;	?><?php } 
           elseif(($pharma[$i]->name=='MAHAVATVIDHWANSA') && (strpos($RX22, 'MAHAVATVIDHWANSA') !== false)) { $MAHAVATVIDHWANSA1++;	?><?php } 

         elseif(($pharma[$i]->name=='TRAYODASHANGA') && (strpos($RX11, 'TRAYODASHANGA') !== false)) {?><?php } 
        elseif(($pharma[$i]->name=='ARSHAKUTHAR VATI') && ((strpos($RX22, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX11, 'ARSHAKUTHAR VATI') !== false) || (strpos($RX33, 'ARSHAKUTHAR VATI') !== false))) { $ARSHAKUTHAR_VATI1++;?><?php } 

        elseif(($pharma[$i]->name=='AROGYAVARDHINI VATI') && ((strpos($RX11, 'AROGYAVARDHINI VATI') !== false) || (strpos($RX22, 'AROGYAVARDHINI VATI') !== false) || (strpos($RX33, 'AROGYAVARDHINI VATI') !== false))) { $AROGYAVARDHINI1++;?><?php } 
        elseif(($pharma[$i]->name=='KAMDUDHA RAS') && ((strpos($RX11, 'KAMDUDHA RAS') !== false) || (strpos($RX22, 'KAMDUDHA RAS') !== false) || (strpos($RX33, 'KAMDUDHA RAS') !== false))) { $KAMDUDA1++;?><?php } 
        elseif(($pharma[$i]->name=='LAGHU SUTSHEKAR RAS') && ((strpos($RX22, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX33, 'LAGHU SUTSHEKAR RAS') !== false) || (strpos($RX11, 'LAGHU SUTSHEKAR RAS') !== false))) { $LAGHUSUTHSHEKAR1++;?><?php } 
        elseif(($pharma[$i]->name=='LAGHUSUTHSHEKAR') && (strpos($RX11, 'LAGHUSUTHSHEKAR') !== false)) {?><?php } 
         elseif(($pharma[$i]->name=='CHANDRAPRABHA VATI') && ((strpos($RX11, 'CHANDRAPRABHA VATI') !== false) || (strpos($RX22, 'CHANDRAPRABHA VATI') !== false) || (strpos($RX33, 'CHANDRAPRABHA VATI') !== false))) { $CHANDRAPRABHA_VATI1++;?><?php } 
        elseif(($pharma[$i]->name=='MAHAVATVIDHWANSA RAS') && ((strpos($RX11, 'MAHAVATVIDHWANSA RAS') !== false) || (strpos($RX22, 'MAHAVATVIDHWANSA RAS') !== false) ||(strpos($RX33, 'MAHAVATVIDHWANSA RAS') !== false))) { $MAHAVATVIDHWANSA_RAS1++;?><?php } 
          elseif(($pharma[$i]->name=='RASNADI GUGGULkk') && (strpos($RX22, 'RASNADI GUGGUL') !== false)) { ?><?php } 
          elseif(($pharma[$i]->name=='SIMHANAD GUGGUL') && ((strpos($RX11, 'SIMHANAD GUGGUL') !== false) || (strpos($RX22, 'SIMHANAD GUGGUL') !== false) || (strpos($RX33, 'SIMHANAD GUGGUL') !== false))) { $SIMHANAD_GUGGUL1++;?><?php } 

       elseif(($pharma[$i]->name=='RASNADI GUGGUL') && ((strpos($RX22, 'RASNADI GUGGUL') !== false) || (strpos($RX11, 'RASNADI GUGGUL') !== false) || (strpos($RX33, 'RASNADI GUGGUL') !== false))) { $RASNADI_GUGGUL1++;?><?php } 
         elseif(($pharma[$i]->name=='AMRUTA GUGGUL') && ((strpos($RX11, 'AMRUTA GUGGUL') !== false) || (strpos($RX22, 'AMRUTA GUGGUL') !== false) || (strpos($RX33, 'AMRUTA GUGGUL') !== false))) { $AMRUTA_GUGGUL1++;	?><?php } 
	     elseif(($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI') && ((strpos($RX11, 'PRAVAL PANCHAMRUT VATI') !== false) || (strpos($RX22, 'PRAVAL PANCHAMRUT VATI') !== false) || (strpos($RX33, 'PRAVAL PANCHAMRUT VATI') !== false))) { $PRAVAL_PANCHAMRUT1++;	?><?php } 
         elseif(($pharma[$i]->name=='GANDHAK RASAYAN VATI') && ((strpos($RX11, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX22, 'GANDHAK RASAYAN VATI') !== false) || (strpos($RX33, 'GANDHAK RASAYAN VATI') !== false))) { $GANDHAK_RASAYAN_VATI1++;	?><?php } 
         elseif(($pharma[$i]->name=='TRAYODASHANGA GUGGUL') && ((strpos($RX11, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX22, 'TRAYODASHANGA GUGGUL') !== false) || (strpos($RX33, 'TRAYODASHANGA GUGGUL') !== false))) { $TRAYODASHANGA_GUGGUL1++;	?><?php } 
          elseif(($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI') && (strpos($RX22, 'SUKSHMA TRIPHALA GUTI') !== false)) { $SUKSHMA_TRIPHALA_GUTI1++;	?><?php } 
        
         elseif(($pharma[$i]->name=='LAGHU MALINI VASANT') && ((strpos($RX22, 'LAGHU MALINI VASANT') !== false) || (strpos($RX11, 'LAGHU MALINI VASANT') !== false) || (strpos($R33, 'LAGHU MALINI VASANT') !== false))) { $LAGHU_MALINI_VASANT1++;?><?php } 
       elseif(($pharma[$i]->name=='LAVANGADI VATI') && ((strpos($RX22, 'LAVANGADI VATI') !== false) || (strpos($RX11, 'LAVANGADI VATI') !== false) || (strpos($RX33, 'LAVANGADI VATI') !== false))) { $LAVANGADI_VATI1++;?><?php } 
         elseif(($pharma[$i]->name=='SUTSHEKAR RAS VATI') && ((strpos($RX11, 'SUTSHEKAR RAS VATI') !== false) || (strpos($RX22, 'SUTSHEKAR RAS VATI') !== false)|| (strpos($RX33, 'SUTSHEKAR RAS VATI') !== false))) { $SUTSHEKAR1++;?><?php } 
         elseif(($pharma[$i]->name=='YOGARAJ GUGGUL') && ((strpos($RX11, 'YOGARAJ GUGGUL') !== false) || (strpos($RX22, 'YOGARAJ GUGGUL') !== false) || (strpos($RX33, 'YOGARAJ GUGGUL') !== false)))  { $YOGARAJ_GUGGUL1++;	?><?php }









         elseif(($pharma[$i]->name=='SITOPALADI CHURNA') && ((strpos($RX22, 'SITOPALADI CHURNA') !== false) || (strpos($RX11, 'SITOPALADI CHURNA') !== false) || (strpos($RX33, 'SITOPALADI CHURNA') !== false))) { $SITOPALADI1++;?><?php } 
         elseif(($pharma[$i]->name=='ASHWAGANDHA CHURNA') && ((strpos($RX11, 'ASHWAGANDHA CHURNA') !== false) || (strpos($RX22, 'ASHWAGANDHA CHURNA') !== false) || (strpos($RX33, 'ASHWAGANDHA CHURNA') !== false))) { $ASHWAGANDHA1++;?><?php } else{?>
       <td></td>
       <?php } } 
                } 
                ?>
                <div style="page-break-before: always;">
                 <h3>Report Summary</h3>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="font-size:16px; font-weight:bold;">
                    <thead>
                        <tr>
                            <th style="width: 30px;" ><?php echo "S.No" ?></th>
                             <th style="width: 30px;" ><?php echo "Name" ?></th>
                            <!-- <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Total Unit" ?>
                            </th> -->
                            <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Total gm" ?>
                            </th>
                           
                                              
                         </tr>
                       
                    </thead>
                    <tbody>
                    <?php $n=1;
                   
                     $n=1;
                    for($i=0;$i<count($pharma);$i++){?>      
                    <tr>
                        <td><?php echo $n++;?></td> 
                        <td><?php echo $pharma[$i]->name;?></td>  
                      
                        <?php if($pharma[$i]->name=='LODHRA CHURNA'){?><td><?php if($LODHRA1=='0') { echo "-";} else {  echo $LODHRA1 * 10; echo " gm";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='BHASKAR LAVAN'){?><td><?php if($BHASKAR1=='0') { echo "-";} else {  echo $BHASKAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='DHAMASA CHURNA'){?><td><?php if($DHAMASA1=='0') { echo "-";} else {  echo $DHAMASA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='JATAMASI CHURNA'){?><td><?php if($JATAMASI1=='0') { echo "-";} else {  echo $JATAMASI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $MANJISHTHA1 * 10; echo " gm";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='OVA CHURNA'){?><td><?php if($OVA1=='0') { echo "-";} else {  echo $OVA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PASHANBHED CHURNA'){?><td><?php if($PASHANBHED1=='0') { echo "-";} else {  echo $PASHANBHED1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PATHA CHURNA'){?><td><?php if($PATHA1=='0') { echo "-";} else {  echo $PATHA1 * 10; echo " gm";}?></td><?php }
                         
                         
                        
                         elseif($pharma[$i]->name=='WALA CURNA'){?><td><?php if($WALA1=='0') { echo "-";} else {  echo $WALA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='TRIPHALA VATI'){?><td><?php if($TRIPHALA_VATI1=='0') { echo "-";} else {  echo $TRIPHALA_VATI1 * 20; echo " gm";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='ABHA GUGGUL'){?><td><?php if($ABHA1=='0') { echo "-";} else {  echo $ABHA1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMAPACHAK VATI'){?><td><?php if($AMAPACHAK1=='0') { echo "-";} else {  echo $AMAPACHAK1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ASTHIPOSHAK VATI'){?><td><?php if($ASTHIPOSHAK1=='0') { echo "-";} else {  echo $ASTHIPOSHAK1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='BRAMHI VATI'){?><td><?php if($BRAMHI1=='0') { echo "-";} else {  echo $BRAMHI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='LAKSHADI GUGGUL'){?><td><?php if($LAKSHADI1=='0') { echo "-";} else {  echo $LAKSHADI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='LAKSHMIVILAS RAS'){?><td><?php if($LAKSHMIVILAS1=='0') { echo "-";} else {  echo $LAKSHMIVILAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='MAHAMANJISHTHADI VATI'){?><td><?php if($MAHAMANJISHTHADI1=='0') { echo "-";} else {  echo $MAHAMANJISHTHADI1 * 20; echo " Tbs";}?></td><?php } 
                         elseif($pharma[$i]->name=='MAHASUDARSHAN VATI'){?><td><?php if($MAHASUDARSHAN1=='0') { echo "-";} else {  echo $MAHASUDARSHAN1 * 20; echo " Tbs";}?></td><?php } 
                         elseif($pharma[$i]->name=='MAHAYOGRAJ GUGGUL'){?><td><?php if($MAHAYOGRAJ1=='0') { echo "-";} else {  echo $MAHAYOGRAJ1 * 20; echo " Tbs";}?></td><?php }  
                         elseif($pharma[$i]->name=='RAJAPRAVARTINI VATI'){?><td><?php if($RAJAPRAVARTINI1 =='0') { echo "-";} else {  echo $RAJAPRAVARTINI1  * 20; echo " Tbs";}?></td><?php } 
                         elseif($pharma[$i]->name=='SANJIVANEE GUTI'){?><td><?php if($SANJIVANEE1=='0') { echo "-";} else {  echo $SANJIVANEE1 * 20; echo " Tbs";}?></td><?php }  
                         elseif($pharma[$i]->name=='SAPTAMRUT LOHA GUTI'){?><td><?php if($SAPTAMRUT1 =='0') { echo "-";} else {  echo $SAPTAMRUT1  * 20; echo " Tbs";}?></td><?php }  
                          
                        elseif($pharma[$i]->name=='JAMBU CHURNA'){?><td><?php if($JAMBU1=='0') { echo "-";} else {  echo $JAMBU1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ERANDAMOOL CHURNA'){?><td><?php if($ERANDAMOOL1=='0') { echo "-";} else {  echo $ERANDAMOOL1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='AMALAKI CHURNA'){?><td><?php if($AMALAKI1=='0') { echo "-";} else {  echo $AMALAKI1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='KUTKI CHURNA'){?><td><?php if($KUTKI1=='0') { echo "-";} else {  echo $KUTKI1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='GOKSHUR CHURNA'){?><td><?php if($GOKSHUR1=='0') { echo "-";} else {  echo $GOKSHUR1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='BALA POWDER'){?><td><?php if($BALA_POWDER1=='0') { echo "-";} else {  echo $BALA_POWDER1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='YASHTIMADHU CHURNA'){?><td><?php if($YASHTIMADHU1=='0') { echo "-";} else {  echo $YASHTIMADHU1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='SARIVA CHURNA'){?><td><?php if($SARIVA1=='0') { echo "-";} else {  echo $SARIVA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='TRIPHALA CHURNA'){?><td><?php if($TRIPHALA1=='0') { echo "-";} else {  echo $TRIPHALA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='GULVEL CHURNA'){?><td><?php if($GULVEL1=='0') { echo "-";} else {  echo $GULVEL1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='VACHA CHURNA'){?><td><?php if($VACHA1=='0') { echo "-";} else {  echo $VACHA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='RASNA CHURNA'){?><td><?php if($RASNA1=='0') { echo "-";} else {  echo $RASNA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='CHOPCHINI CHURNA'){?><td><?php if($CHOPCHINI1=='0') { echo "-";} else {  echo $CHOPCHINI1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='VIDANGA CHURNA'){?><td><?php if($VIDANGA1=='0') { echo "-";} else {  echo $VIDANGA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='MUSTA POWDER'){?><td><?php if($MUSTA_POWDER1=='0') { echo "-";} else {  echo $MUSTA_POWDER1 * 10; echo " gm";}?></td><?php }

                        elseif($pharma[$i]->name=='DARUHARIDRA CHURNA'){?><td><?php if($DARUHARIDRA1=='0') { echo "-";} else {  echo $DARUHARIDRA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ASHOK CHURNA'){?><td><?php if($ASHOK1=='0') { echo "-";} else {  echo $ASHOK1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ASHWAGANDHA CHURNA'){?><td><?php if($ASHWAGANDHA1=='0') { echo "-";} else {  echo $ASHWAGANDHA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='SUNTHI CHURNA'){?><td><?php if($SUNTI1=='0') { echo "-";} else {  echo $SUNTI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MUSTA'){?><td><?php if($MUSTA1=='0') { echo "-";} else {  echo $MUSTA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='KHADIR CHURNA'){?><td><?php if($KHADIR1=='0') { echo "-";} else {  echo $KHADIR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='NISHOTTAR CHURNA'){?><td><?php if($NISHOTTAR1=='0') { echo "-";} else {  echo $NISHOTTAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='CHITRAK CHURNA'){?><td><?php if($CHITRAK1=='0') { echo "-";} else {  echo $CHITRAK1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='GUDMAR CHURNA'){?><td><?php if($GUDMAR1=='0') { echo "-";} else {  echo $GUDMAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PIPPALI CHURNA'){?><td><?php if($PIPPALI1=='0') { echo "-";} else {  echo $PIPPALI1 * 10; echo " gm";}?></td><?php }

                         elseif($pharma[$i]->name=='SITOPALADI CHURNA'){?><td><?php if($SITOPALADI1=='0') { echo "-";} else {  echo $SITOPALADI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='TRIKATU CHURNA'){?><td><?php if($TRIKATU1=='0') { echo "-";} else {  echo $TRIKATU1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='DASHAMOOL CHURNA'){?><td><?php if($DASHAMOOL1=='0') { echo "-";} else {  echo $DASHAMOOL1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='HAREETAKI CHURNA'){?><td><?php if($HAREETAKI1=='0') { echo "-";} else {  echo $HAREETAKI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $MANJISHTHA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='KIRATATIKTA CHURNA'){?><td><?php if($KIRATATIKTA1=='0') { echo "-";} else {  echo $KIRATATIKTA1 * 10; echo " gm";}?></td><?php }

                          elseif($pharma[$i]->name=='VASA CHURNA'){?><td><?php if($VASA1=='0') { echo "-";} else {  echo $VASA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='AVIPATTIKAR CHURNA'){?><td><?php if($AVIPATTIKAR1=='0') { echo "-";} else {  echo $AVIPATTIKAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVA CHURNA'){?><td><?php if($PUNARNAVA1=='0') { echo "-";} else {  echo $PUNARNAVA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='GANDHARVAHAREETAKI CHURNA'){?><td><?php if($GANDHARVAHAREETAKI1=='0') { echo "-";} else {  echo $GANDHARVAHAREETAKI1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='NAGKESHAR CHURNA'){?><td><?php if($NAGKESHAR1=='0') { echo "-";} else { echo $NAGKESHAR1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='PATOLA CHURNA'){?><td><?php if($PATOLA1=='0') { echo "-";} else { echo $PATOLA1 * 10; echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='SARPAGANDHA CHURNA'){?><td><?php if($SARPAGANDA1=='0') { echo "-"; } else {  echo $SARPAGANDA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='SHATAVARI CHURNA'){?><td><?php if($SHATAVARI1=='0') { echo "-";} else { echo $SHATAVARI1 * 10; echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='BALA'){?><td><?php if($BALA1=='0') { echo "-"; } else {  echo $BALA1 * 10; echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='KIRAT TIKTA'){?><td><?php if($KIRAT_TIKTA1=='0') { echo "-";} else {  echo $KIRAT_TIKTA1 * 10; echo " gm";}?></td><?php }
                           
                           elseif($pharma[$i]->name=='KAMDUDHA RAS'){?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $KAMDUDA1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $SUTSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $LAGHU_MALINI_VASANT1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $LAVANGADI_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $CHANDRAPRABHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $KUTAJ_GHANA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $PUNARNAVADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHANKHA VATI'){?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $SHANKHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KAISHOR GUGGUL'){?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $KAISHOR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $KANCHANAR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $KRUMI_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $TAPYADI_LOHA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='NAGA GUTI'){?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $NAGA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $SIMHANAD_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $TRAYODASHANGA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }

                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $GOKSHURADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                    	    	  elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $TRIBHUVAN_KIRTI_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $YOGARAJ_GUGGUL1 * 20; echo " Tbs"; }?></td><?php }

                           elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA1 * 20; echo " Tbs"; }?></td><?php }
                             elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='RASNADI GUGGUL'){?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $RASNADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                          elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $TRIPHALA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $PRAVAL_PANCHAMRUT1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $AMRUTA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $SUKSHMA_TRIPHALA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $MEDOHAR_VATI1 * 20; echo " Tbs";}?></td><?php }

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $SAMSHAMANI_VATI1 * 20; echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $AROGYAVARDHINI1 * 20; echo " Tbs";}?></td>
                        <?php }
                           
                           
                            elseif($pharma[$i]->name=='HINGVASHTAK CHURNA'){?><td><?php if($HINGVASHTAK1=='0') { echo "-";} else {  echo $HINGVASHTAK1 * 10; echo " gm"; }?></td><?php }
                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI1111'){?><td><?php if($AROGYAVARDHINI1=='0') { echo "-";} else {  echo $AROGYAVARDHINI1 * 10; echo " gm";}?></td>
                        <?php }  else{?>
                        <td></td>
                        <?php } ?>
                      </tr>
                      </tr>
                      <?php } ?>
                      
                    <!-- <tr>
                         <td></td>
                         <td>Grand Total</td>
                         <td><?php echo $gt." gm";?></td>
                      </tr>-->
                     </tbody>
                </table>
                </div>
                <div style="page-break-before: always;">
              <!--  <h3>Today's Inventory</h3>-->
                 <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display: none; font-size:16px; font-weight:bold;">
                    <thead>
                        <tr>
                            <th style="width: 30px;" ><?php echo "S.No" ?></th>
                             <th style="width: 30px;" ><?php echo "Name" ?></th>
                              <th style="width: 30px;" >Opening Balance</th>
                            <!-- <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Total Unit" ?>
                            </th> -->
                            <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Medicines Dispense(gm)" ?>
                            </th>
                           <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Closing Balance" ?>
                            </th>
                            <th style="width: 30px; text-align: center;">
                            
                                <?php echo "Requisite" ?>
                            </th>
                                              
                         </tr>
                       
                    </thead>
                    <tbody>
                    <?php $n=1;
                   
                     $n=1;
                    for($i=0;$i<count($pharma);$i++){?>      
                    <tr>
                        <td><?php echo $n++;?></td> 
                        <td><?php echo $pharma[$i]->name;?></td>  
                        <td><?php echo $pharma[$i]->opening_bal;?></td> 
                    
                        
                        
                        <?php if($pharma[$i]->name=='LODHRA CHURNA'){
                            
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                              
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LODHRA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LODHRA1 * 10);
                           }
                        $to_day=$LODHRA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}  
                        
                        ?><td><?php if($LODHRA1=='0') { echo "-";} else {  echo $LODHRA1 * 10; echo " gm";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='BHASKAR LAVAN'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($BHASKAR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($BHASKAR1 * 10);
                           }
                        $to_day=$BHASKAR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($BHASKAR1=='0') { echo "-";} else {  echo $BHASKAR1 * 10; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='DHAMASA CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                              
                            $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($DHAMASA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($DHAMASA1 * 10);
                           }
                        $to_day=$DHAMASA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($DHAMASA1=='0') { echo "-";} else {  echo $DHAMASA1 * 10; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='JATAMASI CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($JATAMASI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($JATAMASI1 * 10);
                           }
                        $to_day=$JATAMASI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($JATAMASI1=='0') { echo "-";} else {  echo $JATAMASI1 * 10; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                              
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MANJISHTHA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MANJISHTHA1 * 10);
                           }
                        $to_day=$MANJISHTHA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $MANJISHTHA1 * 10; echo " Tbs"; }?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='OVA CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($OVA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($OVA1 * 10);
                           }
                        $to_day=$OVA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($OVA1=='0') { echo "-";} else {  echo $OVA1 * 10; echo " Tbs"; }?></td><?php }
                        
                        elseif($pharma[$i]->name=='PASHANBHED CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                            $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PASHANBHED1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PASHANBHED1 * 10);
                           }
                        $to_day=$PASHANBHED1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($PASHANBHED1=='0') { echo "-";} else {  echo $PASHANBHED1 * 10; echo " Tbs"; }?></td><?php }
                        
                         elseif($pharma[$i]->name=='PATHA CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PATHA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PATHA1 * 10);
                           }
                        $to_day=$PATHA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($PATHA1=='0') { echo "-";} else {  echo $PATHA1 * 10; echo " Tbs"; }?></td><?php }
                        
                        
                        
                        
                        
                        
                        
                        
                        elseif($pharma[$i]->name=='WALA CURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($WALA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($WALA1 * 10);
                           }
                        $to_day=$WALA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($WALA1=='0') { echo "-";} else {  echo $WALA1 * 10; echo " Tbs"; }?></td><?php }
                        
                        elseif($pharma[$i]->name=='TRIPHALA VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TRIPHALA_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TRIPHALA_VATI1 * 20);
                           }
                        $to_day=$TRIPHALA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($TRIPHALA_VATI1=='0') { echo "-";} else {  echo $TRIPHALA_VATI1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        
                         elseif($pharma[$i]->name=='ABHA GUGGUL'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($ABHA1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($ABHA1 * 20);
                           }
                        $to_day=$ABHA1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($ABHA1=='0') { echo "-";} else {  echo $ABHA1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='AMAPACHAK VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($AMAPACHAK1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($AMAPACHAK1 * 20);
                           }
                        $to_day=$AMAPACHAK1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($AMAPACHAK1=='0') { echo "-";} else {  echo $AMAPACHAK1 * 20; echo " Tbs"; }?></td><?php }
                        
                        elseif($pharma[$i]->name=='ASTHIPOSHAK VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=5000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           } 
                        $open=$pharma[$i]->opening_bal-($ASTHIPOSHAK1 * 20);
                        $to_day=$ASTHIPOSHAK1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($ASTHIPOSHAK1=='0') { echo "-";} else {  echo $ASTHIPOSHAK1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='BRAMHI VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                            $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($BRAMHI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($BRAMHI1 * 20);
                           }
                        $to_day=$BRAMHI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($BRAMHI1=='0') { echo "-";} else {  echo $BRAMHI1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='LAKSHADI GUGGUL'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LAKSHADI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LAKSHADI1 * 20);
                           }
                        $to_day=$LAKSHADI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($LAKSHADI1=='0') { echo "-";} else {  echo $LAKSHADI1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='LAKSHMIVILAS RAS'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LAKSHMIVILAS1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LAKSHMIVILAS1 * 20);
                           }
                        $to_day=$LAKSHMIVILAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($LAKSHMIVILAS1=='0') { echo "-";} else {  echo $LAKSHMIVILAS1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='MAHAMANJISHTHADI VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MAHAMANJISHTHADI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MAHAMANJISHTHADI1 * 20);
                           }
                        $to_day=$MAHAMANJISHTHADI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($MAHAMANJISHTHADI1=='0') { echo "-";} else {  echo $MAHAMANJISHTHADI1 * 20; echo " Tbs"; }?></td><?php }
                        
                        elseif($pharma[$i]->name=='MAHASUDARSHAN VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MAHASUDARSHAN1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MAHASUDARSHAN1 * 20);
                           }
                        $to_day=$MAHASUDARSHAN1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($MAHASUDARSHAN1=='0') { echo "-";} else {  echo $MAHASUDARSHAN1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='MAHAYOGRAJ GUGGUL'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MAHAYOGRAJ1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MAHAYOGRAJ1 * 20);
                           }
                        $to_day=$MAHAYOGRAJ1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($MAHAYOGRAJ1=='0') { echo "-";} else {  echo $MAHAYOGRAJ1 * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='RAJAPRAVARTINI VATI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($RAJAPRAVARTINI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($RAJAPRAVARTINI1 * 20);
                           }
                        $to_day=$RAJAPRAVARTINI1  * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($RAJAPRAVARTINI1 =='0') { echo "-";} else {  echo $RAJAPRAVARTINI1  * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='SANJIVANEE GUTI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SANJIVANEE1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SANJIVANEE1 * 20);
                           }
                        $to_day=$SANJIVANEE1  * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($SANJIVANEE1 =='0') { echo "-";} else {  echo $SANJIVANEE1  * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='SAPTAMRUT LOHA GUTI'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                            $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SAPTAMRUT1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SAPTAMRUT1 * 20);
                           }
                        $to_day=$SAPTAMRUT1  * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($SAPTAMRUT1 =='0') { echo "-";} else {  echo $SAPTAMRUT1  * 20; echo " Tbs"; }?></td><?php }
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        elseif($pharma[$i]->name=='HINGVASHTAK CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($HINGVASHTAK1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($HINGVASHTAK1 * 10);
                           }
                        $to_day=$HINGVASHTAK1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}
                        
                        ?><td><?php if($HINGVASHTAK1=='0') { echo "-";} else {  echo $HINGVASHTAK1 * 10; echo " gm"; }?></td><?php }
                            
                        elseif($pharma[$i]->name=='NAGKESHAR CHURNA'){
                            
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($NAGKESHAR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($NAGKESHAR1 * 10);
                           }
                        $to_day=$NAGKESHAR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}  
                            
                        ?><td><?php if($NAGKESHAR1=='0') { echo "-";} else { echo $NAGKESHAR1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='ASHOK CHURNA'){
                            
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($ASHOK1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($ASHOK1 * 10);
                           }
                        $to_day=$ASHOK1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}  
                            
                        ?><td><?php if($ASHOK1=='0') { echo "-";} else {  echo $ASHOK1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='GOKSHUR CHURNA'){
                            
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GOKSHUR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GOKSHUR1 * 10);
                           }
                        $to_day=$GOKSHUR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}  
                        ?><td><?php if($GOKSHUR1=='0') { echo "-";} else {  echo $GOKSHUR1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='GANDHARVAHAREETAKI CHURNA'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GANDHARVAHAREETAKI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GANDHARVAHAREETAKI1 * 10);
                           }
                        $to_day=$GANDHARVAHAREETAKI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}   
                            
                        ?><td><?php if($GANDHARVAHAREETAKI1=='0') { echo "-";} else {  echo $GANDHARVAHAREETAKI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='BALA POWDER'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($BALA_POWDER1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($BALA_POWDER1 * 10);
                           }
                        $to_day=$BALA_POWDER1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}     
                            
                        ?><td><?php if($BALA_POWDER1=='0') { echo "-";} else {  echo $BALA_POWDER1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='YASHTIMADHU CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($YASHTIMADHU1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($YASHTIMADHU1 * 10);
                           }
                        $to_day=$YASHTIMADHU1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                            
                        ?><td><?php if($YASHTIMADHU1=='0') { echo "-";} else {  echo $YASHTIMADHU1 * 10; echo " gm";}?></td><?php }  
                            
                        elseif($pharma[$i]->name=='SUNTHI CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SUNTI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SUNTI1 * 10);
                           }
                        $to_day=$SUNTI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($SUNTI1=='0') { echo "-";} else {  echo $SUNTI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='TRIKATU CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TRIKATU1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TRIKATU1 * 10);
                           }
                        $to_day=$TRIKATU1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                            
                        ?><td><?php if($TRIKATU1=='0') { echo "-";} else {  echo $TRIKATU1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='ASHWAGANDHA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($ASHWAGANDHA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($ASHWAGANDHA1 * 10);
                           }
                        $to_day=$ASHWAGANDHA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                            
                        ?><td><?php if($ASHWAGANDHA1=='0') { echo "-";} else {  echo $ASHWAGANDHA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='SARIVA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SARIVA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SARIVA1 * 10);
                           }
                        $to_day=$SARIVA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($SARIVA1=='0') { echo "-";} else {  echo $SARIVA1 * 10; echo " gm";}?></td><?php } 
                            
                        elseif($pharma[$i]->name=='TRIPHALA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TRIPHALA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TRIPHALA1 * 10);
                           }
                        $to_day=$TRIPHALA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($TRIPHALA1=='0') { echo "-";} else {  echo $TRIPHALA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='SITOPALADI CHURNA'){
                          if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SITOPALADI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SITOPALADI1 * 10);
                           }
                        $to_day=$SITOPALADI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($SITOPALADI1=='0') { echo "-";} else {  echo $SITOPALADI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='GULVEL CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GULVEL1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GULVEL1 * 10);
                           }
                        $to_day=$GULVEL1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($GULVEL1=='0') { echo "-";} else {  echo $GULVEL1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='SHATAVARI CHURNA'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SHATAVARI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SHATAVARI1 * 10);
                           }
                        $to_day=$SHATAVARI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}       
                        ?><td><?php if($SHATAVARI1=='0') { echo "-";} else { echo $SHATAVARI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='VACHA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($VACHA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($VACHA1 * 10);
                           }
                        $to_day=$VACHA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($VACHA1=='0') { echo "-";} else {  echo $VACHA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='PUNARNAVA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PUNARNAVA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PUNARNAVA1 * 10);
                           }
                        $to_day=$PUNARNAVA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                            
                        ?><td><?php if($PUNARNAVA1=='0') { echo "-";} else {  echo $PUNARNAVA1 * 10; echo " gm";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='DASHAMOOL CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($DASHAMOOL1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($DASHAMOOL1 * 10);
                           }
                        $to_day=$DASHAMOOL1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($DASHAMOOL1=='0') { echo "-";} else {  echo $DASHAMOOL1 * 10; echo " gm";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='RASNA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($RASNA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($RASNA1 * 10);
                           }
                        $to_day=$RASNA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($RASNA1=='0') { echo "-";} else {  echo $RASNA1 * 10; echo " gm";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='CHOPCHINI CHURNA'){
                          if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($CHOPCHINI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($CHOPCHINI1 * 10);
                           }
                        $to_day=$CHOPCHINI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($CHOPCHINI1=='0') { echo "-";} else {  echo $CHOPCHINI1 * 10; echo " gm";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='VIDANGA CHURNA'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($VIDANGA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($VIDANGA1 * 10);
                           }
                        $to_day=$VIDANGA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}  
                        ?><td><?php if($VIDANGA1=='0') { echo "-";} else {  echo $VIDANGA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='MUSTA POWDER'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MUSTA_POWDER1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MUSTA_POWDER1 * 10);
                           }
                        $to_day=$MUSTA_POWDER1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($MUSTA_POWDER1=='0') { echo "-";} else {  echo $MUSTA_POWDER1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='KIRATATIKTA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KIRATATIKTA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KIRATATIKTA1 * 10);
                           }
                        $to_day=$KIRATATIKTA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($KIRATATIKTA1=='0') { echo "-";} else {  echo $KIRATATIKTA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='KUTKI CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KUTKI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KUTKI1 * 10);
                           }
                        $to_day=$KUTKI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($KUTKI1=='0') { echo "-";} else {  echo $KUTKI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='AMALAKI CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($AMALAKI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($AMALAKI1 * 10);
                           }
                        $to_day=$AMALAKI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($AMALAKI1=='0') { echo "-";} else {  echo $AMALAKI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='PIPPALI CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PIPPALI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PIPPALI1 * 10);
                           }
                        $to_day=$PIPPALI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($PIPPALI1=='0') { echo "-";} else {  echo $PIPPALI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='PATOLA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PATOLA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PATOLA1 * 10);
                           }
                        $to_day=$PATOLA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($PATOLA1=='0') { echo "-";} else { echo $PATOLA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='DARUHARIDRA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($DARUHARIDRA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($DARUHARIDRA1 * 10);
                           }
                        $to_day=$DARUHARIDRA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($DARUHARIDRA1=='0') { echo "-";} else {  echo $DARUHARIDRA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='JAMBU CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=6000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($JAMBU1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($JAMBU1 * 10);
                           }
                        $to_day=$JAMBU1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                            
                        ?><td><?php if($JAMBU1=='0') { echo "-";} else {  echo $JAMBU1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='GUDMAR CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GUDMAR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GUDMAR1 * 10);
                           }
                        $to_day=$GUDMAR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($GUDMAR1=='0') { echo "-";} else {  echo $GUDMAR1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='MANJISHTHA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MANJISHTHA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MANJISHTHA1 * 10);
                           }
                        $to_day=$MANJISHTHA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                            
                        ?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $MANJISHTHA1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='AVIPATTIKAR CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=3500;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($AVIPATTIKAR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($AVIPATTIKAR1 * 10);
                           }
                        $to_day=$AVIPATTIKAR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($AVIPATTIKAR1=='0') { echo "-";} else {  echo $AVIPATTIKAR1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='HAREETAKI CHURNA'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($HAREETAKI1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($HAREETAKI1 * 10);
                           }
                        $to_day=$HAREETAKI1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}  
                        ?><td><?php if($HAREETAKI1=='0') { echo "-";} else {  echo $HAREETAKI1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='CHITRAK CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($CHITRAK1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($CHITRAK1 * 10);
                           }
                        $to_day=$CHITRAK1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($CHITRAK1=='0') { echo "-";} else {  echo $CHITRAK1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='ERANDAMOOL CHURNA'){
                          if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($ERANDAMOOL1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($ERANDAMOOL1 * 10);
                           }
                        $to_day=$ERANDAMOOL1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($ERANDAMOOL1=='0') { echo "-";} else {  echo $ERANDAMOOL1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='NISHOTTAR CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($NISHOTTAR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($NISHOTTAR1 * 10);
                           }
                        $to_day=$NISHOTTAR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($NISHOTTAR1=='0') { echo "-";} else {  echo $NISHOTTAR1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='KHADIR CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KHADIR1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KHADIR1 * 10);
                           }
                        $to_day=$KHADIR1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($KHADIR1=='0') { echo "-";} else {  echo $KHADIR1 * 10; echo " gm";}?></td><?php }
                            
                        elseif($pharma[$i]->name=='VASA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($VASA1 * 10);
                           } else{
                           $open=$pharma[$i]->opening_bal-($VASA1 * 10);
                           }
                        $to_day=$VASA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($VASA1=='0') { echo "-";} else {  echo $VASA1 * 10; echo " gm";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='KAMDUDHA RAS'){
                         
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=10000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KAMDUDA1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KAMDUDA1 * 20);
                           }
                        $to_day=$KAMDUDA1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                        
                        ?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $KAMDUDA1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SUTSHEKAR1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SUTSHEKAR1 * 20);
                           }
                        $to_day=$SUTSHEKAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                        ?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $SUTSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LAGHU_MALINI_VASANT1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LAGHU_MALINI_VASANT1 * 20);
                           }
                        $to_day=$LAGHU_MALINI_VASANT1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                        
                        ?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $LAGHU_MALINI_VASANT1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LAVANGADI_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LAVANGADI_VATI1 * 20);
                           }
                        $to_day=$LAVANGADI_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}    
                        ?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $LAVANGADI_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=30000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($CHANDRAPRABHA_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($CHANDRAPRABHA_VATI1 * 20);
                           }
                        $to_day=$CHANDRAPRABHA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $CHANDRAPRABHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=15000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KUTAJ_GHANA_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KUTAJ_GHANA_VATI1 * 20);
                           }
                        $to_day=$KUTAJ_GHANA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                        ?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $KUTAJ_GHANA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                         elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=12000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MAHAVATVIDHWANSA_RAS1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MAHAVATVIDHWANSA_RAS1 * 20);
                           }
                        $to_day=$MAHAVATVIDHWANSA_RAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                         ?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA_RAS1 * 20; echo " Tbs";}?></td><?php }
                         
                        elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PUNARNAVADI_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PUNARNAVADI_GUGGUL1 * 20);
                           }
                        $to_day=$PUNARNAVADI_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $PUNARNAVADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='SHANKHA VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SHANKHA_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SHANKHA_VATI1 * 20);
                           }
                        $to_day=$SHANKHA_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $SHANKHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='KAISHOR GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KAISHOR_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KAISHOR_GUGGUL1 * 20);
                           }
                        $to_day=$KAISHOR_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $KAISHOR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=6000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KANCHANAR_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KANCHANAR_GUGGUL1 * 20);
                           }
                        $to_day=$KANCHANAR_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $KANCHANAR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=3500;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($ARSHAKUTHAR_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($ARSHAKUTHAR_VATI1 * 20);
                           }
                        $to_day=$ARSHAKUTHAR_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                        elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($KRUMI_KUTHAR_RAS1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($KRUMI_KUTHAR_RAS1 * 20);
                           }
                        $to_day=$KRUMI_KUTHAR_RAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $KRUMI_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                        elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=15000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TAPYADI_LOHA_GUTI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TAPYADI_LOHA_GUTI1 * 20);
                           }
                        $to_day=$TAPYADI_LOHA_GUTI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                        ?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $TAPYADI_LOHA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                        
                        
                         elseif($pharma[$i]->name=='NAGA GUTI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($NAGA_GUTI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($NAGA_GUTI1 * 20);
                           }
                        $to_day=$NAGA_GUTI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $NAGA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=10000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SIMHANAD_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SIMHANAD_GUGGUL1 * 20);
                           }
                        $to_day=$SIMHANAD_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $SIMHANAD_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TRAYODASHANGA_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TRAYODASHANGA_GUGGUL1 * 20);
                           }
                        $to_day=$TRAYODASHANGA_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $TRAYODASHANGA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         

                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GANDHAK_RASAYAN1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GANDHAK_RASAYAN1 * 20);
                           }
                        $to_day=$GANDHAK_RASAYAN1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}      
                         
                         ?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GOKSHURADI_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GOKSHURADI_GUGGUL1 * 20);
                           }
                        $to_day=$GOKSHURADI_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $GOKSHURADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                    	 elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){
                    	 if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=6000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TRIBHUVAN_KIRTI_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TRIBHUVAN_KIRTI_VATI1 * 20);
                           }
                        $to_day=$TRIBHUVAN_KIRTI_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                    	 ?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $TRIBHUVAN_KIRTI_VATI1 * 20; echo " Tbs";}?></td><?php }
                    	 
                         elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=30000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($YOGARAJ_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($YOGARAJ_GUGGUL1 * 20);
                           }
                        $to_day=$YOGARAJ_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $YOGARAJ_GUGGUL1 * 20; echo " Tbs"; }?></td><?php }
                         
                         

                         elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=12000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MAHAVATVIDHWANSA1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MAHAVATVIDHWANSA1 * 20);
                           }
                        $to_day=$MAHAVATVIDHWANSA1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}     
                         
                         ?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA1 * 20; echo " Tbs"; }?></td><?php }
                         
                         elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=2000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LAGHUSUTHSHEKAR1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LAGHUSUTHSHEKAR1 * 20);
                           }
                        $to_day=$LAGHUSUTHSHEKAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($LAGHUSUTHSHEKAR1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($LAGHUSUTHSHEKAR1 * 20);
                           }
                        $to_day=$LAGHUSUTHSHEKAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         
                         ?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($GANDHAK_RASAYAN_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($GANDHAK_RASAYAN_VATI1 * 20);
                           }
                        $to_day=$GANDHAK_RASAYAN_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                         ?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN_VATI1 * 20; echo " Tbs";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='RASNADI GUGGUL'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=12000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($RASNADI_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($RASNADI_GUGGUL1 * 20);
                           }
                        $to_day=$RASNADI_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                         ?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $RASNADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=50000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($TRIPHALA_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($TRIPHALA_GUGGUL1 * 20);
                           }
                        $to_day=$TRIPHALA_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $TRIPHALA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SHWAS_KUTHAR1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SHWAS_KUTHAR1 * 20);
                           }
                        $to_day=$SHWAS_KUTHAR1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){
                        if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=15000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($PRAVAL_PANCHAMRUT1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($PRAVAL_PANCHAMRUT1 * 20);
                           }
                        $to_day=$PRAVAL_PANCHAMRUT1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}  
                         ?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $PRAVAL_PANCHAMRUT1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4500;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($AMRUTA_GUGGUL1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($AMRUTA_GUGGUL1 * 20);
                           }
                        $to_day=$AMRUTA_GUGGUL1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $AMRUTA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=4000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SUKSHMA_TRIPHALA_GUTI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SUKSHMA_TRIPHALA_GUTI1 * 20);
                           }
                        $to_day=$SUKSHMA_TRIPHALA_GUTI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $SUKSHMA_TRIPHALA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=8000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SHWAS_KUTHAR_RAS1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SHWAS_KUTHAR_RAS1 * 20);
                           }
                        $to_day=$SHWAS_KUTHAR_RAS1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         ?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                         
                         
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){
                       	 if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($MEDOHAR_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($MEDOHAR_VATI1 * 20);
                           }
                        $to_day=$MEDOHAR_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                       	 ?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $MEDOHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                       	 
                       	 

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SAMSHAMANI_VATI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SAMSHAMANI_VATI1 * 20);
                           }
                        $to_day=$SAMSHAMANI_VATI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);} 
                         
                         ?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $SAMSHAMANI_VATI1 * 20; echo " Tbs";}?></td><?php }
                         
                         

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=30000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                          
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($AROGYAVARDHINI1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($AROGYAVARDHINI1 * 20);
                           }
                        $to_day=$AROGYAVARDHINI1 * 20;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','2')";
                        $mysqli->query($query1);}    
                            
                        ?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $AROGYAVARDHINI1 * 20; echo " Tbs";}?></td>
                        <?php }
                        
                        
                            
                        elseif($pharma[$i]->name=='SARPAGANDHA CHURNA'){
                         if($check_number_result==0){
                         $che_no=$pharma[$i]->opening_bal;$stock=1000;
                         if($che_no < 300 ) {
                              $query11 = "insert into Add_stock(name,create_date,stock,ipd_opd,status) values('".$pharma[$i]->name."','".$datefrom1."','".$stock."','".$ipd."','1')";
                              $mysqli->query($query11);
                           
						   $open1=$pharma[$i]->opening_bal + $stock ; 
                           $open=$open1-($SARPAGANDA1 * 20);
                           } else{
                           $open=$pharma[$i]->opening_bal-($SARPAGANDA1 * 20);
                           }
                        $to_day=$SARPAGANDA1 * 10;
                        $query1 = "insert into pharma1_daily(name,opening_bal,daily_use,daily_date,ipd_opd,status) values('".$pharma[$i]->name."','".$open."','".$to_day."','".$datefrom1."','".$ipd."','1')";
                        $mysqli->query($query1);}      
                        ?><td><?php if($SARPAGANDA1=='0') { echo "-"; } else {  echo $SARPAGANDA1 * 10; echo " gm";}?></td><?php }
                      
                      
                       
                        
                        elseif($pharma[$i]->name=='AAAAROGYAVARDHINI VATI11111'){?><td><?php if($AROGYAVARDHINI1=='0') { echo "-";} else {  echo $AROGYAVARDHINI1 * 10; echo " gm";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php } ?>
                        
                        <?php if($pharma[$i]->name=='LODHRA CHURNA'){?><td><?php if($LODHRA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($LODHRA1 * 10); echo " gm";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='BHASKAR LAVAN'){?><td><?php if($BHASKAR1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($BHASKAR1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='DHAMASA CHURNA'){?><td><?php if($DHAMASA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($DHAMASA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='JATAMASI CHURNA'){?><td><?php if($JATAMASI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($JATAMASI1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MANJISHTHA1 * 10); echo " gm";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='OVA CHURNA'){?><td><?php if($OVA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($OVA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='PASHANBHED CHURNA'){?><td><?php if($PASHANBHED1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($PASHANBHED1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='PATHA CHURNA'){?><td><?php if($PATHA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($PATHA1 * 10); echo " gm";}?></td><?php }
                        
                        
                        
                        elseif($pharma[$i]->name=='WALA CURNA'){?><td><?php if($WALA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($WALA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='TRIPHALA VATI'){?><td><?php if($TRIPHALA_VATI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($TRIPHALA_VATI1 * 20); echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='ABHA GUGGUL'){?><td><?php if($ABHA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($ABHA1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='AMAPACHAK VATI'){?><td><?php if($AMAPACHAK1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($AMAPACHAK1 * 20); echo " Tbs";}?></td><?php } 
                        elseif($pharma[$i]->name=='ASTHIPOSHAK VATI'){?><td><?php if($ASTHIPOSHAK1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($ASTHIPOSHAK1 * 20); echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='BRAMHI VATI'){?><td><?php if($BRAMHI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($BRAMHI1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAKSHADI GUGGUL'){?><td><?php if($LAKSHADI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($LAKSHADI1 * 20); echo " Tbs";}?></td><?php } 
                        elseif($pharma[$i]->name=='LAKSHMIVILAS RAS'){?><td><?php if($LAKSHMIVILAS1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($LAKSHMIVILAS1 * 20); echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='MAHAMANJISHTHADI VATI'){?><td><?php if($MAHAMANJISHTHADI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MAHAMANJISHTHADI1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHASUDARSHAN VATI'){?><td><?php if($MAHASUDARSHAN1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MAHASUDARSHAN1 * 20); echo " Tbs";}?></td><?php } 
                        elseif($pharma[$i]->name=='MAHAYOGRAJ GUGGUL'){?><td><?php if($MAHAYOGRAJ1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MAHAYOGRAJ1 * 20); echo " Tbs";}?></td><?php }
                        
                         elseif($pharma[$i]->name=='RAJAPRAVARTINI VATI'){?><td><?php if($RAJAPRAVARTINI1 =='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($RAJAPRAVARTINI1  * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='SANJIVANEE GUTI'){?><td><?php if($SANJIVANEE1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($SANJIVANEE1 * 20); echo " Tbs";}?></td><?php } 
                        elseif($pharma[$i]->name=='SAPTAMRUT LOHA GUTI'){?><td><?php if($SAPTAMRUT1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($SAPTAMRUT1 * 20); echo " Tbs";}?></td><?php }
                        
                        
                        
                        elseif($pharma[$i]->name=='JAMBU CHURNA'){?><td><?php if($JAMBU1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($JAMBU1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ERANDAMOOL CHURNA'){?><td><?php if($ERANDAMOOL1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($ERANDAMOOL1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='AMALAKI CHURNA'){?><td><?php if($AMALAKI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($AMALAKI1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='KUTKI CHURNA'){?><td><?php if($KUTKI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($KUTKI1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='GOKSHUR CHURNA'){?><td><?php if($GOKSHUR1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($GOKSHUR1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='BALA POWDER'){?><td><?php if($BALA_POWDER1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($BALA_POWDER1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='YASHTIMADHU CHURNA'){?><td><?php if($YASHTIMADHU1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($YASHTIMADHU1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='SARIVA CHURNA'){?><td><?php if($SARIVA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($SARIVA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='TRIPHALA CHURNA'){?><td><?php if($TRIPHALA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($TRIPHALA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='GULVEL CHURNA'){?><td><?php if($GULVEL1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($GULVEL1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='VACHA CHURNA'){?><td><?php if($VACHA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($VACHA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='RASNA CHURNA'){?><td><?php if($RASNA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($RASNA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='CHOPCHINI CHURNA'){?><td><?php if($CHOPCHINI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($CHOPCHINI1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='VIDANGA CHURNA'){?><td><?php if($VIDANGA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($VIDANGA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='MUSTA POWDER'){?><td><?php if($MUSTA_POWDER1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MUSTA_POWDER1 * 10); echo " gm";}?></td><?php }

                        elseif($pharma[$i]->name=='DARUHARIDRA CHURNA'){?><td><?php if($DARUHARIDRA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($DARUHARIDRA1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ASHOK CHURNA'){?><td><?php if($ASHOK1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($ASHOK1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ASHWAGANDHA CHURNA'){?><td><?php if($ASHWAGANDHA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($ASHWAGANDHA1 * 10); echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='SUNTHI CHURNA'){?><td><?php if($SUNTI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($SUNTI1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MUSTA'){?><td><?php if($MUSTA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MUSTA1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='KHADIR CHURNA'){?><td><?php if($KHADIR1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($KHADIR1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='NISHOTTAR CHURNA'){?><td><?php if($NISHOTTAR1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($NISHOTTAR1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='CHITRAK CHURNA'){?><td><?php if($CHITRAK1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($CHITRAK1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='GUDMAR CHURNA'){?><td><?php if($GUDMAR1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($GUDMAR1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PIPPALI CHURNA'){?><td><?php if($PIPPALI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($PIPPALI1 * 10); echo " gm";}?></td><?php }

                         elseif($pharma[$i]->name=='SITOPALADI CHURNA'){?><td><?php if($SITOPALADI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($SITOPALADI1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='TRIKATU CHURNA'){?><td><?php if($TRIKATU1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($TRIKATU1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='DASHAMOOL CHURNA'){?><td><?php if($DASHAMOOL1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($DASHAMOOL1 * 10); echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='HAREETAKI CHURNA'){?><td><?php if($HAREETAKI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($HAREETAKI1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($MANJISHTHA1 * 10); echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='KIRATATIKTA CHURNA'){?><td><?php if($KIRATATIKTA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($KIRATATIKTA1 * 10); echo " gm";}?></td><?php }

                          elseif($pharma[$i]->name=='VASA CHURNA'){?><td><?php if($VASA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($VASA1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='AVIPATTIKAR CHURNA'){?><td><?php if($AVIPATTIKAR1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($AVIPATTIKAR1 * 10); echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVA CHURNA'){?><td><?php if($PUNARNAVA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($PUNARNAVA1 * 10); echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='GANDHARVAHAREETAKI CHURNA'){?><td><?php if($GANDHARVAHAREETAKI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($GANDHARVAHAREETAKI1 * 10); echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='NAGKESHAR CHURNA'){?><td><?php if($NAGKESHAR1=='0') { echo "-";} else { echo $pharma[$i]->opening_bal - ($NAGKESHAR1 * 10); echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='PATOLA CHURNA'){?><td><?php if($PATOLA1=='0') { echo "-";} else { echo $pharma[$i]->opening_bal - ($PATOLA1 * 10); echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='SARPAGANDHA CHURNA'){?><td><?php if($SARPAGANDA1=='0') { echo "-"; } else {  echo $pharma[$i]->opening_bal - ($SARPAGANDA1 * 10); echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='SHATAVARI CHURNA'){?><td><?php if($SHATAVARI1=='0') { echo "-";} else { echo $pharma[$i]->opening_bal - ($SHATAVARI1 * 10); echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='BALA'){?><td><?php if($BALA1=='0') { echo "-"; } else {  echo $pharma[$i]->opening_bal - ($BALA1 * 10); echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='KIRAT TIKTA'){?><td><?php if($KIRAT_TIKTA1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($KIRAT_TIKTA1 * 10); echo " gm";}?></td><?php }
                            
                            elseif($pharma[$i]->name=='KAMDUDHA RAS'){?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KAMDUDA1 * 20); echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SUTSHEKAR1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($LAGHU_MALINI_VASANT1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($LAVANGADI_VATI1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($CHANDRAPRABHA_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KUTAJ_GHANA_VATI1 * 20); echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($MAHAVATVIDHWANSA_RAS1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($PUNARNAVADI_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHANKHA VATI'){?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SHANKHA_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KAISHOR GUGGUL'){?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KAISHOR_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KANCHANAR_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($ARSHAKUTHAR_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($KRUMI_KUTHAR_RAS1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TAPYADI_LOHA_GUTI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='NAGA GUTI'){?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($NAGA_GUTI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SIMHANAD_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TRAYODASHANGA_GUGGUL1 * 20); echo " Tbs";}?></td><?php }

                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($GANDHAK_RASAYAN1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($GOKSHURADI_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                    	 elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TRIBHUVAN_KIRTI_VATI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($YOGARAJ_GUGGUL1 * 20); echo " Tbs"; }?></td><?php }

                         elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($MAHAVATVIDHWANSA1 * 20); echo " Tbs"; }?></td><?php }
                         elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $pharma[$i]->opening_bal - ($LAGHUSUTHSHEKAR1 * 20); echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($LAGHUSUTHSHEKAR1 * 20); echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($GANDHAK_RASAYAN_VATI1 * 20); echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='RASNADI GUGGUL'){?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($RASNADI_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                          elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($TRIPHALA_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SHWAS_KUTHAR1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($PRAVAL_PANCHAMRUT1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($AMRUTA_GUGGUL1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SUKSHMA_TRIPHALA_GUTI1 * 20); echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($SHWAS_KUTHAR_RAS1 * 20); echo " Tbs";}?></td><?php }
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal -($MEDOHAR_VATI1 * 20); echo " Tbs";}?></td><?php }

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal- ($SAMSHAMANI_VATI1 * 20); echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $pharma[$i]->opening_bal - ($AROGYAVARDHINI1 * 20); echo " Tbs";}?></td>
                        <?php }
                            
                            
                            elseif($pharma[$i]->name=='HINGVASHTAK CHURNA'){?><td><?php if($HINGVASHTAK1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($HINGVASHTAK1 * 10); echo " gm"; }?></td><?php }
                        elseif($pharma[$i]->name=='AAAAROGYAVARDHINI VATI111'){?><td><?php if($AROGYAVARDHINI1=='0') { echo "-";} else {  echo $pharma[$i]->opening_bal - ($AROGYAVARDHINI1 * 10); echo " gm";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php } ?>
                        
                        
                         <?php if($pharma[$i]->name=='LODHRA CHURNA'){?><td><?php if($LODHRA1=='0') { echo "-";} else {  echo $LODHRA1 * 10; echo " gm";}?></td><?php }
                         
                         
                         elseif($pharma[$i]->name=='BHASKAR LAVAN'){?><td><?php if($BHASKAR1=='0') { echo "-";} else {  echo $BHASKAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='DHAMASA CHURNA'){?><td><?php if($DHAMASA1=='0') { echo "-";} else {  echo $DHAMASA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='JATAMASI CHURNA'){?><td><?php if($JATAMASI1=='0') { echo "-";} else {  echo $JATAMASI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $MANJISHTHA1 * 10; echo " gm";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='OVA CHURNA'){?><td><?php if($OVA1=='0') { echo "-";} else {  echo $OVA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PASHANBHED CHURNA'){?><td><?php if($PASHANBHED1=='0') { echo "-";} else {  echo $PASHANBHED1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PATHA CHURNA'){?><td><?php if($PATHA1=='0') { echo "-";} else {  echo $PATHA1 * 10; echo " gm";}?></td><?php }
                         
                         
                        
                         elseif($pharma[$i]->name=='WALA CURNA'){?><td><?php if($WALA1=='0') { echo "-";} else {  echo $WALA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='TRIPHALA VATI'){?><td><?php if($TRIPHALA_VATI1=='0') { echo "-";} else {  echo $TRIPHALA_VATI1 * 20; echo " gm";}?></td><?php }
                         
                         elseif($pharma[$i]->name=='ABHA GUGGUL'){?><td><?php if($ABHA1=='0') { echo "-";} else {  echo $ABHA1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMAPACHAK VATI'){?><td><?php if($AMAPACHAK1=='0') { echo "-";} else {  echo $AMAPACHAK1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ASTHIPOSHAK VATI'){?><td><?php if($ASTHIPOSHAK1=='0') { echo "-";} else {  echo $ASTHIPOSHAK1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='BRAMHI VATI'){?><td><?php if($BRAMHI1=='0') { echo "-";} else {  echo $BRAMHI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='LAKSHADI GUGGUL'){?><td><?php if($LAKSHADI1=='0') { echo "-";} else {  echo $LAKSHADI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='LAKSHMIVILAS RAS'){?><td><?php if($LAKSHMIVILAS1=='0') { echo "-";} else {  echo $LAKSHMIVILAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='MAHAMANJISHTHADI VATI'){?><td><?php if($MAHAMANJISHTHADI1=='0') { echo "-";} else {  echo $MAHAMANJISHTHADI1 * 20; echo " Tbs";}?></td><?php } 
                         elseif($pharma[$i]->name=='MAHASUDARSHAN VATI'){?><td><?php if($MAHASUDARSHAN1=='0') { echo "-";} else {  echo $MAHASUDARSHAN1 * 20; echo " Tbs";}?></td><?php } 
                         elseif($pharma[$i]->name=='MAHAYOGRAJ GUGGUL'){?><td><?php if($MAHAYOGRAJ1=='0') { echo "-";} else {  echo $MAHAYOGRAJ1 * 20; echo " Tbs";}?></td><?php }  
                         elseif($pharma[$i]->name=='RAJAPRAVARTINI VATI'){?><td><?php if($RAJAPRAVARTINI1 =='0') { echo "-";} else {  echo $RAJAPRAVARTINI1  * 20; echo " Tbs";}?></td><?php } 
                         elseif($pharma[$i]->name=='SANJIVANEE GUTI'){?><td><?php if($SANJIVANEE1=='0') { echo "-";} else {  echo $SANJIVANEE1 * 20; echo " Tbs";}?></td><?php }  
                         elseif($pharma[$i]->name=='SAPTAMRUT LOHA GUTI'){?><td><?php if($SAPTAMRUT1 =='0') { echo "-";} else {  echo $SAPTAMRUT1  * 20; echo " Tbs";}?></td><?php }  
                          
                        elseif($pharma[$i]->name=='JAMBU CHURNA'){?><td><?php if($JAMBU1=='0') { echo "-";} else {  echo $JAMBU1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ERANDAMOOL CHURNA'){?><td><?php if($ERANDAMOOL1=='0') { echo "-";} else {  echo $ERANDAMOOL1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='AMALAKI CHURNA'){?><td><?php if($AMALAKI1=='0') { echo "-";} else {  echo $AMALAKI1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='KUTKI CHURNA'){?><td><?php if($KUTKI1=='0') { echo "-";} else {  echo $KUTKI1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='GOKSHUR CHURNA'){?><td><?php if($GOKSHUR1=='0') { echo "-";} else {  echo $GOKSHUR1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='BALA POWDER'){?><td><?php if($BALA_POWDER1=='0') { echo "-";} else {  echo $BALA_POWDER1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='YASHTIMADHU CHURNA'){?><td><?php if($YASHTIMADHU1=='0') { echo "-";} else {  echo $YASHTIMADHU1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='SARIVA CHURNA'){?><td><?php if($SARIVA1=='0') { echo "-";} else {  echo $SARIVA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='TRIPHALA CHURNA'){?><td><?php if($TRIPHALA1=='0') { echo "-";} else {  echo $TRIPHALA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='GULVEL CHURNA'){?><td><?php if($GULVEL1=='0') { echo "-";} else {  echo $GULVEL1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='VACHA CHURNA'){?><td><?php if($VACHA1=='0') { echo "-";} else {  echo $VACHA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='RASNA CHURNA'){?><td><?php if($RASNA1=='0') { echo "-";} else {  echo $RASNA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='CHOPCHINI CHURNA'){?><td><?php if($CHOPCHINI1=='0') { echo "-";} else {  echo $CHOPCHINI1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='VIDANGA CHURNA'){?><td><?php if($VIDANGA1=='0') { echo "-";} else {  echo $VIDANGA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='MUSTA POWDER'){?><td><?php if($MUSTA_POWDER1=='0') { echo "-";} else {  echo $MUSTA_POWDER1 * 10; echo " gm";}?></td><?php }

                        elseif($pharma[$i]->name=='DARUHARIDRA CHURNA'){?><td><?php if($DARUHARIDRA1=='0') { echo "-";} else {  echo $DARUHARIDRA1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ASHOK CHURNA'){?><td><?php if($ASHOK1=='0') { echo "-";} else {  echo $ASHOK1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='ASHWAGANDHA CHURNA'){?><td><?php if($ASHWAGANDHA1=='0') { echo "-";} else {  echo $ASHWAGANDHA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='SUNTHI CHURNA'){?><td><?php if($SUNTI1=='0') { echo "-";} else {  echo $SUNTI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MUSTA'){?><td><?php if($MUSTA1=='0') { echo "-";} else {  echo $MUSTA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='KHADIR CHURNA'){?><td><?php if($KHADIR1=='0') { echo "-";} else {  echo $KHADIR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='NISHOTTAR CHURNA'){?><td><?php if($NISHOTTAR1=='0') { echo "-";} else {  echo $NISHOTTAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='CHITRAK CHURNA'){?><td><?php if($CHITRAK1=='0') { echo "-";} else {  echo $CHITRAK1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='GUDMAR CHURNA'){?><td><?php if($GUDMAR1=='0') { echo "-";} else {  echo $GUDMAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PIPPALI CHURNA'){?><td><?php if($PIPPALI1=='0') { echo "-";} else {  echo $PIPPALI1 * 10; echo " gm";}?></td><?php }

                         elseif($pharma[$i]->name=='SITOPALADI CHURNA'){?><td><?php if($SITOPALADI1=='0') { echo "-";} else {  echo $SITOPALADI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='TRIKATU CHURNA'){?><td><?php if($TRIKATU1=='0') { echo "-";} else {  echo $TRIKATU1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='DASHAMOOL CHURNA'){?><td><?php if($DASHAMOOL1=='0') { echo "-";} else {  echo $DASHAMOOL1 * 10; echo " gm";}?></td><?php }
                        elseif($pharma[$i]->name=='HAREETAKI CHURNA'){?><td><?php if($HAREETAKI1=='0') { echo "-";} else {  echo $HAREETAKI1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='MANJISHTHA CHURNA'){?><td><?php if($MANJISHTHA1=='0') { echo "-";} else {  echo $MANJISHTHA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='KIRATATIKTA CHURNA'){?><td><?php if($KIRATATIKTA1=='0') { echo "-";} else {  echo $KIRATATIKTA1 * 10; echo " gm";}?></td><?php }

                          elseif($pharma[$i]->name=='VASA CHURNA'){?><td><?php if($VASA1=='0') { echo "-";} else {  echo $VASA1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='AVIPATTIKAR CHURNA'){?><td><?php if($AVIPATTIKAR1=='0') { echo "-";} else {  echo $AVIPATTIKAR1 * 10; echo " gm";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVA CHURNA'){?><td><?php if($PUNARNAVA1=='0') { echo "-";} else {  echo $PUNARNAVA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='GANDHARVAHAREETAKI CHURNA'){?><td><?php if($GANDHARVAHAREETAKI1=='0') { echo "-";} else {  echo $GANDHARVAHAREETAKI1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='NAGKESHAR CHURNA'){?><td><?php if($NAGKESHAR1=='0') { echo "-";} else { echo $NAGKESHAR1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='PATOLA CHURNA'){?><td><?php if($PATOLA1=='0') { echo "-";} else { echo $PATOLA1 * 10; echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='SARPAGANDHA CHURNA'){?><td><?php if($SARPAGANDA1=='0') { echo "-"; } else {  echo $SARPAGANDA1 * 10; echo " gm";}?></td><?php }
                          elseif($pharma[$i]->name=='SHATAVARI CHURNA'){?><td><?php if($SHATAVARI1=='0') { echo "-";} else { echo $SHATAVARI1 * 10; echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='BALA'){?><td><?php if($BALA1=='0') { echo "-"; } else {  echo $BALA1 * 10; echo " gm";}?></td><?php }
                           elseif($pharma[$i]->name=='KIRAT TIKTA'){?><td><?php if($KIRAT_TIKTA1=='0') { echo "-";} else {  echo $KIRAT_TIKTA1 * 10; echo " gm";}?></td><?php }
                           
                           elseif($pharma[$i]->name=='KAMDUDHA RAS'){?><td><?php if($KAMDUDA1=='0'){ echo "-";} else { echo $KAMDUDA1 * 20; echo " Tbs";}?></td><?php }
                        
                        elseif($pharma[$i]->name=='SUTSHEKAR RAS VATI'){?><td><?php if($SUTSHEKAR1=='0'){ echo "-";} else { echo $SUTSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAGHU MALINI VASANT'){?><td><?php if($LAGHU_MALINI_VASANT1=='0'){ echo "-";} else { echo $LAGHU_MALINI_VASANT1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='LAVANGADI VATI'){?><td><?php if($LAVANGADI_VATI1=='0'){ echo "-";} else { echo $LAVANGADI_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='CHANDRAPRABHA VATI'){?><td><?php if($CHANDRAPRABHA_VATI1=='0'){ echo "-";} else { echo $CHANDRAPRABHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KUTAJ GHANA VATI'){?><td><?php if($KUTAJ_GHANA_VATI1=='0'){ echo "-";} else { echo $KUTAJ_GHANA_VATI1 * 20; echo " Tbs";}?></td><?php }
                        elseif($pharma[$i]->name=='MAHAVATVIDHWANSA RAS'){?><td><?php if($MAHAVATVIDHWANSA_RAS1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PUNARNAVADI GUGGUL'){?><td><?php if($PUNARNAVADI_GUGGUL1=='0'){ echo "-";} else { echo $PUNARNAVADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHANKHA VATI'){?><td><?php if($SHANKHA_VATI1=='0'){ echo "-";} else { echo $SHANKHA_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KAISHOR GUGGUL'){?><td><?php if($KAISHOR_GUGGUL1=='0'){ echo "-";} else { echo $KAISHOR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KANCHANAR GUGGUL'){?><td><?php if($KANCHANAR_GUGGUL1=='0'){ echo "-";} else { echo $KANCHANAR_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='ARSHAKUTHAR VATI'){?><td><?php if($ARSHAKUTHAR_VATI1=='0'){ echo "-";} else { echo $ARSHAKUTHAR_VATI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='KRUMI KUTHAR RAS'){?><td><?php if($KRUMI_KUTHAR_RAS1=='0'){ echo "-";} else { echo $KRUMI_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TAPYADI LOHA GUTI'){?><td><?php if($TAPYADI_LOHA_GUTI1=='0'){ echo "-";} else { echo $TAPYADI_LOHA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='NAGA GUTI'){?><td><?php if($NAGA_GUTI1=='0'){ echo "-";} else { echo $NAGA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SIMHANAD GUGGUL'){?><td><?php if($SIMHANAD_GUGGUL1=='0'){ echo "-";} else { echo $SIMHANAD_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='TRAYODASHANGA GUGGUL'){?><td><?php if($TRAYODASHANGA_GUGGUL1=='0'){ echo "-";} else { echo $TRAYODASHANGA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }

                         elseif($pharma[$i]->name=='GANDHAK RASAYAN'){?><td><?php if($GANDHAK_RASAYAN1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='GOKSHURADI GUGGUL'){?><td><?php if($GOKSHURADI_GUGGUL1=='0'){ echo "-";} else { echo $GOKSHURADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                    	    	  elseif($pharma[$i]->name=='TRIBHUVAN KIRTI VATI'){?><td><?php if($TRIBHUVAN_KIRTI_VATI1=='0'){ echo "-";} else { echo $TRIBHUVAN_KIRTI_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='YOGARAJ GUGGUL'){?><td><?php if($YOGARAJ_GUGGUL1=='0'){ echo "-";} else { echo $YOGARAJ_GUGGUL1 * 20; echo " Tbs"; }?></td><?php }

                           elseif($pharma[$i]->name=='MAHAVATVIDHWANSA'){?><td><?php if($MAHAVATVIDHWANSA1=='0'){ echo "-";} else { echo $MAHAVATVIDHWANSA1 * 20; echo " Tbs"; }?></td><?php }
                             elseif($pharma[$i]->name=='LAGHUSUTHSHEKAR'){?><td><?php  if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else{ echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='LAGHU SUTSHEKAR RAS'){?><td><?php if($LAGHUSUTHSHEKAR1=='0'){ echo "-";} else { echo $LAGHUSUTHSHEKAR1 * 20; echo " Tbs";}?></td><?php }
                           elseif($pharma[$i]->name=='GANDHAK RASAYAN VATI'){?><td><?php if($GANDHAK_RASAYAN_VATI1=='0'){ echo "-";} else { echo $GANDHAK_RASAYAN_VATI1 * 20; echo " Tbs";}?></td><?php }
                            elseif($pharma[$i]->name=='RASNADI GUGGUL'){?><td><?php  if($RASNADI_GUGGUL1=='0'){ echo "-";} else { echo $RASNADI_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                          elseif($pharma[$i]->name=='TRIPHALA GUGGUL'){?><td><?php  if($TRIPHALA_GUGGUL1=='0'){ echo "-";} else { echo $TRIPHALA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR'){?><td><?php  if($SHWAS_KUTHAR1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='PRAVAL PANCHAMRUT VATI'){?><td><?php  if($PRAVAL_PANCHAMRUT1=='0'){ echo "-";} else { echo $PRAVAL_PANCHAMRUT1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='AMRUTA GUGGUL'){?><td><?php  if($AMRUTA_GUGGUL1=='0'){ echo "-";} else { echo $AMRUTA_GUGGUL1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SUKSHMA TRIPHALA GUTI'){?><td><?php  if($SUKSHMA_TRIPHALA_GUTI1=='0'){ echo "-";} else { echo $SUKSHMA_TRIPHALA_GUTI1 * 20; echo " Tbs";}?></td><?php }
                         elseif($pharma[$i]->name=='SHWAS KUTHAR RAS'){?><td><?php  if($SHWAS_KUTHAR_RAS1=='0'){ echo "-";} else { echo $SHWAS_KUTHAR_RAS1 * 20; echo " Tbs";}?></td><?php }
                       	 elseif($pharma[$i]->name=='MEDOHAR VATI'){?><td><?php  if($MEDOHAR_VATI1=='0'){ echo "-";} else { echo $MEDOHAR_VATI1 * 20; echo " Tbs";}?></td><?php }

                       	 elseif($pharma[$i]->name=='SAMSHAMANI VATI'){?><td><?php  if($SAMSHAMANI_VATI1=='0'){ echo "-";} else { echo $SAMSHAMANI_VATI1 * 20; echo " Tbs";}?></td><?php }

                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI'){?><td><?php if($AROGYAVARDHINI1=='0'){ echo "-";} else { echo $AROGYAVARDHINI1 * 20; echo " Tbs";}?></td>
                        <?php }
                           
                           
                            elseif($pharma[$i]->name=='HINGVASHTAK CHURNA'){?><td><?php if($HINGVASHTAK1=='0') { echo "-";} else {  echo $HINGVASHTAK1 * 10; echo " gm"; }?></td><?php }
                        elseif($pharma[$i]->name=='AROGYAVARDHINI VATI1111'){?><td><?php if($AROGYAVARDHINI1=='0') { echo "-";} else {  echo $AROGYAVARDHINI1 * 10; echo " gm";}?></td>
                        <?php } else{?>
                        <td></td>
                        <?php } ?>
                      </tr>
                      </tr>
                      <?php } ?>
                      
                    <!-- <tr>
                         <td></td>
                         <td>Grand Total</td>
                         <td><?php echo $gt." gm";?></td>
                      </tr>-->
                     </tbody>
                </table>
                </div>
                <?php } ?>
                          
              
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