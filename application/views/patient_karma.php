<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
<?php ini_set('memory_limit','-1');?>
<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientbydepartment_karma_date'); ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<!--<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php echo $department_id; ?>">
</div> --> 


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


            <div class="panel-body" style="font-size:<?php if($patients[0]->ipd_opd =='ipd'){ echo "9px";} else { echo "11px"; }?> ;">
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
                               $ipd = ($patients[0]->ipd_opd);
                                
                                if($ipd == 'ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "D-IPD Karma Panch";} else {echo "IPD Procedure Register - ( Panchkarma ) ";} ?>  <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; }?></h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "D-OPD Karma Panch ";} else {echo " OPD Procedure Register - ( Panchkarma )";}?>   <?php  if($name) {echo "(".$name.")";}?></h3>
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
              
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                           <th style="width: 30px;" rowspan="2">S. No.</th>
                             
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "COPD" ?>
                            </th> 
                            
                           
                            <th rowspan="2"><?php echo "Name" ?></th> 
                            <th rowspan="2"><?php echo "Age" ?></th>    
                            <th rowspan="2"><?php echo display('sex') ?></th>   
                                        
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                           <?php if($department_by =='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                            <th style="width: 30px;" rowspan="2"><?php echo "Dignosis" ?></th>
                           <?php if($ipd=='opd'){ if($department_by !='dpt'){ ?><th style="width: 30px;" rowspan="2">Doctor</th><?php } }?>
                            <?php if($department_by !='dpt') {?><th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd'){ echo "Doctor" ;} else { echo "Date";}?></th> <?php } ?>
                           <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "Remark"?></th><?php } ?> 
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "SNEHAN"?></th> <?php }?>  
                           <!--<?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php if($name=='Swasthrakshnam'){ echo "SWA1";} else { echo "SWEDAN/SWA1"; }?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php if($name=='Swasthrakshnam'){ echo "SWA2";} else { echo "VAMAN/SWA2"; }?></th> <?php }?> -->
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SWEDAN"; ?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "VAMAN"; ?></th> <?php }?>
                          
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "VIRECHAN"; ?></th> <?php }?>
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "BASTI"; ?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "NASYA"; ?></th> <?php }?>
                           
                            <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "RAKTAMOKSHAN"; ?></th> <?php }?>
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SHIRODHARA"; ?></th> <?php }?>  
                           <?php if($department_by  =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "SHIROBASTI"; ?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 30px;" rowspan="2"><?php  echo "OTHER"; ?></th> <?php }?>
                           
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
                        if($tot_serial1==0){
                            $tot_serial1=1;
                        }else{
                            $tot_serial1=$tot_serial1;
                        }
                        
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
                            <?php $i = 1; $n=1;
                                $SNEHAN1=0; $SWEDAN1=0;$VAMAN1=0;$VIRECHAN1=0;$BASTI1=0;$NASYA1=0;$RAKTAMOKSHAN1=0;$SHIRODHARA_SHIROBASTI1=0; $SHIROBASTI1=0;$OTHER1=0; $VAMAN2=0; $RAKTAMOKSHAN2=0;
                               foreach ($patients as $patient) {  $i++; 
                            
                                  $date_c=date('Y-m-d',strtotime($patient->create_date));
                                  $date_d=date('Y-m-d',strtotime($patient->discharge_date));
                                  $date_f= date('Y-m-d', strtotime($dateto));
                                  $tot_serial--;
                                   
                                   if($ipd == 'ipd'){ 
                                    //      $che=trim($patient->dignosis);
                                    //     $section_tret='ipd';
                                    //      $len=strlen($che);
                                    //      $dd= substr($che,$len - 1);
                                         
                                    //      $str = $patient->dignosis;
                                    //      $arry=explode("-",$str);
                                    //      $t_c=count($arry);
                                         
                                    //     if($t_c=='2'){
                                    //       $dd1=substr($che, 0, -1);
                                    //         $p_dignosis = '%'.$arry[0].'%';
                                    //          trim($p_dignosis);
                                    //          $p_dignosis_name=$patient->dignosis;
                                    //   }else{
                                          
                                    //       $p_dignosis = '%'.$che.'%';
                                    //         $p_dignosis_name=$patient->dignosis;
                                            
                                    //   }
                                    
                                        $che=trim($patient->dignosis);
                                        //print_r($che);
                                        
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
                                    //      $section_tret='opd';
                                    //       $che=trim($patient->dignosis);
                                    //     $section_tret='opd';
                                    //      $len=strlen($che);
                                    //      $dd= substr($che,$len - 1);
                                         
                                    //      $str = $patient->dignosis;
                                    //      $arry=explode("-",$str);
                                    //      $t_c=count($arry);
                                    //       if($t_c=='2'){
                                    //             $dd1=substr($che, 0, -1);
                                                
                                    //         $p_dignosis = '%'.$arry[0].'%';
                                    //                      trim($p_dignosis);
                                    //          $p_dignosis_name=$patient->dignosis;
                                    //   }else{
                                    //       //echo $dd;
                                           
                                    //       $p_dignosis = '%'.$che.'%';
                                    //         $p_dignosis_name=$patient->dignosis;
                                            
                                            
                                    //   }
                                        $che=trim($patient->dignosis);
                                        //print_r($che);
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
                                     
                            //           if(empty($tretment)){
                            //           $tretment=$this->db->select("*")
                            //           ->from('treatments1')
                            //           ->where('department_id',$patient->department_id)
			                         // ->where('ipd_opd',$patient->department_id)
                            //          ->get()
                            //          ->row();   
                                         
                            //          }
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
			               
                                $admit_date=date('Y-m-d',strtotime($patient->create_date));
                                $vaman_virachan_date=date('Y-m-d',strtotime("+7 days", strtotime($admit_date))); 
                                
                                // print_r($admit_date);
                                // print_r($dateto);print_r('<br>');
                                
                                $date1=date_create($admit_date);
                                $date2=date_create($dateto);
                                $diff=date_diff($date1,$date2);
                                $diffDay = $diff->format("%a");
                                $shirobastiCheck = ($diffDay % 2);
                                
                                // print_r($date1);print_r(' ');
                                // print_r($date2);print_r('<br>');
                                
                            
			                     if(($ipd=='opd')  || ($ipd=='ipd')){
			                       
			                      $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
								  $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
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
			                      
			                      
			                       if($SNEHAN){
			                          $SNEHAN1++;
			                       }
			                       
			                       if($SWEDAN){
			                          $SWEDAN1++;
			                       }
			                       
			                       if($ipd=='opd'){
			                           if($VAMAN){
			                                //$VAMAN = $VAMAN1++; 
			                                $VAMAN1++;
			                           }
			                       }
			                       else{
			                       
			                        if(($VAMAN) && ($vaman_virachan_date==date('Y-m-d',strtotime($dateto)))) {
    			                          //$VAMAN=$VAMAN1++;
    			                          $VAMAN1++;
    			                       }
			                       }
			                       if($ipd=='opd'){
    			                       if($VIRECHAN){
    			                          $VIRECHAN1++;
    			                       }
			                       }
			                       else{
			                       
			                        if(($VIRECHAN) && ($vaman_virachan_date==date('Y-m-d',strtotime($dateto)))) {
    			                          //$VAMAN=$VAMAN1++;
    			                          $VIRECHAN1++;
    			                       }
			                       }
			                       
			                        if($BASTI){
			                          $BASTI1++;
			                       }
			                       
			                       if($NASYA){
			                          $NASYA1++;
			                       }
			                       
			                       
			                       if($ipd=='opd'){
			                            if($RAKTAMOKSHAN){
    			                          //$RAKTAMOKSHAN = $RAKTAMOKSHAN;
    			                          $RAKTAMOKSHAN1++;
			                            }
			                       }
			                       else{
			                           
			                        if(($RAKTAMOKSHAN) && ($admit_date==date('Y-m-d',strtotime($dateto)))) {
			                          //$RAKTAMOKSHAN = $RAKTAMOKSHAN1++;
			                          $RAKTAMOKSHAN1++;
			                       }
			                       }
			                       if($SHIRODHARA_SHIROBASTI){
			                          $SHIRODHARA_SHIROBASTI1++;
			                       }
			                       
			                       if($ipd=='opd'){
    			                       if($SHIROBASTI){
    			                          $SHIROBASTI1++;
    			                       }
			                       }
			                       else{
			                       
			                        if(($SHIROBASTI) && ($shirobastiCheck == 0)) {
    			                          //$VAMAN=$VAMAN1++;
    			                          $SHIROBASTI1++;
    			                       }
			                       }
			                       
			                       if($OTHER){
			                          $OTHER1++;
			                       }
			                      $ex_name=explode('-',$p_dignosis_name);
			                     
			                      if($ex_name[1]=='SW'){
			                          $SW=$ex_name[1];
			                      }
			                      else{
			                          $SW='';
			                      }
			                     }
			                     else{
			                       
			                           $KARMA= $tretment->KARMA;
			                      $PK1= $tretment->PK1;
			                      $PK2= $tretment->PK2;
								  $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
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
			                      
			                       if($SNEHAN){
			                      $p_date=date('Y-m-d',strtotime($patient->create_date));
			                      $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $sn=$diff->format("%a");
			                          $SNEHAN1+=$sn;
			                       }
			                       
			                       if($SWEDAN){
			                      $p_date=date('Y-m-d',strtotime($patient->create_date));
			                   $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $sw=$diff->format("%a");
			                          $SWEDAN1+=$sw;
			                       }
			                       
			                        if($VAMAN){
			                               $p_date=date('Y-m-d',strtotime($patient->create_date));
			                      $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $va=$diff->format("%a");
			                            
			                          $VAMAN1+=$va;
			                       }
			                       if($VIRECHAN){
			                            $p_date=date('Y-m-d',strtotime($patient->create_date));
			                      $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $vi=$diff->format("%a");
			                          $VIRECHAN1+=$vi;
			                       }
			                       
			                        if($BASTI){
			                             $p_date=date('Y-m-d',strtotime($patient->create_date));
			                    $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $ba=$diff->format("%a");
			                            
			                          $BASTI1+=$ba;
			                       }
			                       
			                       if($NASYA){
			                            $p_date=date('Y-m-d',strtotime($patient->create_date));
			                     $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $na=$diff->format("%a");
			                          $NASYA1+=$na;
			                       }
			                       
			                       
			                        if($RAKTAMOKSHAN){
			                          $p_date=date('Y-m-d',strtotime($patient->create_date));
			                      $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $ra=$diff->format("%a");
			                            
			                          $RAKTAMOKSHAN1+=$ra;
			                       }
			                       if($SHIRODHARA_SHIROBASTI){
			                            $p_date=date('Y-m-d',strtotime($patient->create_date));
			                     $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $shi=$diff->format("%a");
			                          $SHIRODHARA_SHIROBASTI1+=$shi;
			                       }
			                       
			                       if($SHIROBASTI){
			                            $p_date=date('Y-m-d',strtotime($patient->create_date));
			                      $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $shiro=$diff->format("%a");
			                          $SHIROBASTI1+=$shiro;
			                       }
			                       
			                       if($OTHER){
			                            $p_date=date('Y-m-d',strtotime($patient->create_date));
			                    $c_date= date('Y-m-d',strtotime($dateto));
			                      $date1=date_create($p_date);
                                  $date2=date_create($c_date);
                                  $diff=date_diff($date1,$date2);
                                  $ot=$diff->format("%a");
			                          $OTHER1+=$ot;
			                       }
			                      $ex_name=explode('-',$p_dignosis_name);
			                     
			                      if($ex_name[1]=='SW'){
			                          $SW=$ex_name[1];
			                      }
			                      else{
			                          $SW='';
			                      }
			                     }
                              ?>
                              
                                 <?php if($department_by =='dpt') { if(($SNEHAN !='') || ($SWEDAN !='') || ($VAMAN !='') || ($VIRECHAN !='') || ($BASTI !='')  || ($NASYA !='') || ($RAKTAMOKSHAN !='') || ($SHIRODHARA_SHIROBASTI !='') || ($SHIROBASTI !='') || ($OTHER !='')) { ?><tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else { echo ""; } ?>">
                                    
                                   <!-- <!------------------- Yearly No. ------------------------>                    
                <?//php if($getpatientbydepartment_date =='D'){ ?>
                    <!--<td style="padding:2px;"><?//php if($ipd==ipd){ echo $tot_serial1_d++; } else { echo $i; } ?></td>-->
                <?//php } else {?>
                    <!--<td style="padding:2px;"><?//php if($ipd == 'opd'){ echo $i++;} else { echo $tot_serial1++; } ?></td>-->
                <?//php } ?>
                <!------------------- End Yearly No. ------------------------>
                
                               <!-- <td style="padding:2px;"><?//php if($ipd == 'opd'){ echo $n++;} else{ echo $tot_serial1++; } ?></td>-->
                                       
                                   <td style="padding:2px;"><?php  echo $n++; ?></td>
                                    
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
                                    <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ if($patient->patient_id) { echo $patient->patient_id; } } else{ echo $num_ipd++;} ?></td> <?php } ?>  
                                    <td  style="padding:2px;"><?php if($patient->yearly_reg_no) {echo $patient->yearly_reg_no.".".$dot_year;} ?></td>
                                    <td  style="padding:2px;"><?php if($patient->old_reg_no) { echo $patient->old_reg_no;if($explode[1]==''){echo ".".$dot_year;}}?></td> <!-- //old patient no -->
                                                                 
                                    <!--<td><?php echo $patient->ipd_no?></td>-->
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>   
                                    <td  style="padding:2px;"><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> 
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    
                                    <!-- <td><?php echo $patient->address; ?></td>   -->
                                   <?php if($department_by =='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                    <td  style="padding:2px;"><?php if($ipd == 'ipd'){ echo $p_dignosis_name ; } else { echo $p_dignosis_name;}?></td> 
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
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $SNEHAN; ?></td> <?php } ?>  
                                      <!--<?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php if($SW=='SW'){ echo $SWA1; } else { echo $SWEDAN; } ?></td>  <?php }?> 
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php if($SW=='SW'){ echo $SWA2; } else {  $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto))){ echo $VAMAN;   $VAMAN2++;}} ?></td>  <?php }?> -->
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $SWEDAN; ?></td>  <?php }?> 
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php if($vaman_virachan_date==date('Y-m-d',strtotime($dateto)) && $ipd == 'ipd'){ echo $VAMAN; }elseif($ipd == 'opd'){ echo $VAMAN;}?></td>  <?php }?>
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php if($vaman_virachan_date==date('Y-m-d',strtotime($dateto)) && $ipd == 'ipd'){ echo $VIRECHAN; }elseif($ipd == 'opd'){ echo $VIRECHAN;}?></td>  <?php }?>
                                       <!--<?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $VIRECHAN; ?></td>  <?php }?> -->
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $BASTI;  ?></td>  <?php }?>
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $NASYA; ?></td>  <?php }?> 
                                       
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php $admit_date=date('Y-m-d',strtotime($patient->create_date)); if($admit_date==date('Y-m-d',strtotime($dateto)) && $ipd == 'ipd'){ echo $RAKTAMOKSHAN; }elseif($ipd == 'opd'){ echo $RAKTAMOKSHAN;}?></td>  <?php }?> 
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $SHIRODHARA_SHIROBASTI;  ?></td>  <?php }?>
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php if($shirobastiCheck == 0 && $ipd == 'ipd'){ echo $SHIROBASTI; }elseif($ipd == 'opd'){ echo $SHIROBASTI;}?></td>  <?php }?>
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;"><?php echo $OTHER; ?></td>  <?php }?> 
                                      
                                       
                                         
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
                                        <!--<a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> -->
                                    </td>                                     
                                </tr>
                                <?php  }  $sl++; ?>
                            <?php } 
                               }
                          } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <!-- Table Summery -->
                <h3>Report Summary</h3>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>             
                            <th><?php echo "S. No" ?></th>
                            <th><?php echo "Name" ?></th>                            
                            <th><?php echo "Total" ?></th>                            
                                              
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php $sl = 12141; 
                            if($years=='2020'){
                                $name_array=array('SNEHAN','SWEDAN','VAMAN','VIRECHAN','BASTI','NASYA','RAKTAMOKSHAN','SHIRODHARA','OTHER');
                            }else{
                                $name_array=array('SNEHAN','SWEDAN','VAMAN','VIRECHAN','BASTI','NASYA','RAKTAMOKSHAN','SHIRODHARA','SHIROBASTI','OTHER');
                            }
                            // $name_array=array('BASTI','NASYA','VAMAN','VIRECHAN','BASTI','NASYA','RAKTAMOKSHAN','SHIRODHARA','OTHER');
                            $years=$this->session->userdata['acyear'];
                            if($years=='2020'){
                            $tot_array=array(  $SNEHAN1,$SWEDAN1,'23',$VIRECHAN1,$BASTI1,$NASYA1,'18',$SHIRODHARA_SHIROBASTI1,$OTHER1);
                            }else{
                            $tot_array=array(  $SNEHAN1,$SWEDAN1,$VAMAN1,$VIRECHAN1,$BASTI1,$NASYA1,$RAKTAMOKSHAN1,$SHIRODHARA_SHIROBASTI1,$SHIROBASTI1,$OTHER1);
                            }
?> 
                            <?php $n = 1;  for($i=0;$i<count($name_array);$i++) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo $n++;?> </td>
                                    <td><?php echo $name_array[$i]; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $tot_array[$i]; ?></td>
                               </tr>
                               
                           
                        <?php } ?> 
                                <tr>
                                    <td colspan=2>Grand Total</td>
                                    <td><?= array_sum($tot_array); ?></td>
                                </tr>
                    </tbody>
                    
                     <!-- <tr>
                                    <td colspan="2">Grand Total</td>
                                   
                                    <td><?php echo array_sum($tot_array);?></td>
                                    
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
</script>
</script>