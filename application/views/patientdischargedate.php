<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/patientdischargebydate'); ?>">
                                      
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
<input type="hidden" name="section" class="form-control " id="section" value="ipd">

<!--<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
    </select>

</div>-->



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
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Central IPD Discharge Patient Register</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                  
                
                          <?php  if($ipd == 'ipd') {?>
                          <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                         <!-- <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>-->
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
                             <th rowspan="2"><?php echo "Address" ?></th>   
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo display('sex') ?></th>   
                            <th  <?php  if($gob=='gob') { echo "style='width:1px;'";}?> rowspan="2"><?php echo "Age" ?></th>                  
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                           <?php if($department_by !='dpt'){ ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>
                            <th rowspan="2" style="width: 30px;"><?php echo "Dignosis" ?></th>
                           <?php if($ipd=='opd'){ if($department_by !='dpt'){ ?><th style="width: 30px;" rowspan="2">Doctor</th><?php } }?>
                            <?php if($department_by !='dpt') {?><th style="width: 30px;" rowspan="2"><?php if($ipd == 'ipd'){ echo "Doctor Name" ;} else { echo "Date";}?></th> <?php } ?>
                           <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "DOA"?></th><?php } ?>
                           <?php  if($ipd == 'ipd'){ ?>  <th  rowspan="2">DOD</th> <?php }?>
                           <?php if($department_by !='dpt') {?> <th style="width: 30px;" rowspan="2"><?php echo "Bed No";?></th><?php } ?> 
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX1"?></th> <?php }?>  
                           <?php if($department_by  =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX2"?></th> <?php }?>  
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "RX3"?></th> <?php }?>
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "ASHAN1"?></th> <?php }?>
                           <?php if($department_by =='dpt') {?> <th style="width: 60px; <?php if($gob =='gob') { echo "font-size: 10px;";}?>" rowspan="2"><?php echo "ASHAN2"?></th> <?php }?>
                          <!-- <?php if($gob =='gob') {?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "KARMA"?></th> <?php }?>  -->
                           <!--<?php if($gob =='gob') {?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "PK1"?></th> <?php }?>  
                           <?php if($gob =='gob') {?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "PK2"?></th> <?php }?> -->
                           
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
                            <th style="width: 30px;"><?php echo "Follow-Up" ?></th>
                           
                                                    
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
                            //  $at_mn=0;$at_mo=0;$at_fn=0;$at_fo=0; $at_tt=0;
                             $aa_mn=0;$aa_mo=0;$aa_fn=0;$aa_fo=0; $aa_tt=0; 
                             $ky_mn=0;$ky_mo=0;$ky_fn=0;$ky_fo=0; $ky_tt=0;
                             $pn_mn=0;$pn_mo=0;$pn_fn=0;$pn_fo=0; $pn_tt=0;
                             $ba_mn=0;$ba_mo=0;$ba_fn=0;$ba_fo=0; $ba_tt=0;
                             $sly_mn=0;$sly_mo=0;$sly_fn=0;$sly_fo=0; $sly_tt=0;
                             $sky_mn=0;$sky_mo=0;$sky_fn=0;$sky_fo=0; $sky_tt=0;
                             $st_mn=0;$st_mo=0;$st_fn=0;$st_fo=0; $st_tt=0;
                             $sw_mn=0;$sw_mo=0;$sw_fn=0;$sw_fo=0; $sw_tt=0;
                              $vs_mn=0;$vs_mo=0;$vs_fn=0;$vs_fo=0; $vs_tt=0;
                              
                             foreach ($patients as $patient) { $i++;
                            
                              $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                             $dd12=date('Y-m-d', strtotime($_GET['end_date']));
                              if($_GET['end_date']){
                                  $dd1=date('Y-m-d', strtotime($_GET['end_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }
                            //  //agad
                            //       if(($patient->sex=='M') && ($patient->department_id =='36') && ($patient->yearly_reg_no)){
                                      
                            //         $at_mn++; 
                                 
                            //      }
                            //      if(($patient->sex=='M') && ($patient->department_id =='36') && ($patient->old_reg_no)){
                                      
                            //         $at_mo++;   
                                     
                                     
                            //      }
                            //      if(($patient->sex=='F') && ($patient->department_id =='36') && ($patient->yearly_reg_no)){
                                
                            //         $at_fn++; 
                                 
                            //      }
                            //      if(($patient->sex=='F') && ($patient->department_id =='36') && ($patient->old_reg_no)){
                                    
                                   
                            //         $at_fo++;
                                    
                                     
                            //      }
                                 
                            //      if($patient->department_id =='36'){
                                     
                                   
                            //         $at_tt++; 
                                   
                                     
                            //      }
                            //atya
                                 if(($patient->sex=='M') && ($patient->department_id =='35') && ($patient->yearly_reg_no)){
                                     
                                      $aa_mn++; 
                                  
                                  }
                                 if(($patient->sex=='M') && ($patient->department_id =='35') && ($patient->old_reg_no)){
                                    $aa_mo++; 
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='35') && ($patient->yearly_reg_no)){
                                    
                                    $aa_fn++; 
                                     
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='35') && ($patient->old_reg_no)){
                                       
                                    $aa_fo++; 
                                       
                                     
                                 }
                                 
                                 if($patient->department_id =='35'){
                                     
                                    $aa_tt++; 
                                     
                                     
                                 }
                                 //kay
                                  if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->yearly_reg_no)){
                                      
                                    $ky_mn++; 
                                 
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->old_reg_no)){
                                      
                                    $ky_mo++;   
                                     
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->yearly_reg_no)){
                                
                                    $ky_fn++; 
                                 
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->old_reg_no)){
                                    
                                   
                                    $ky_fo++;
                                    
                                     
                                 }
                                 
                                 if($patient->department_id =='34'){
                                     
                                   
                                    $ky_tt++; 
                                   
                                     
                                 }
                                 
                                 //pan
                                  if(($patient->sex=='M') && ($patient->department_id =='33') && ($patient->yearly_reg_no)){
                                        
                                    $pn_mn++; 
                                 
                                     
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='33') && ($patient->old_reg_no)){
                                       
                                    $pn_mo++;  
                                   
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='33') && ($patient->yearly_reg_no)){
                                     
                                    $pn_fn++;   
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='33') && ($patient->old_reg_no)){
                                      
                                    $pn_fo++; 
                                 
                                     
                                 }
                                 
                                 if($patient->department_id =='33'){
                                      
                                    $pn_tt++; 
                                    
                                     
                                 }
                                 
                                  //bal
                                  if(($patient->sex=='M') && ($patient->department_id =='32') && ($patient->yearly_reg_no)){
                                       if($dd != $dd1){ 
                                    $ba_mn++; 
                                  } else{}
                                     
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='32') && ($patient->old_reg_no)){
                                       
                                    $ba_mo++; 
                                    
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='32') && ($patient->yearly_reg_no)){
                                      
                                    $ba_fn++;   
                                
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='32') && ($patient->old_reg_no)){
                                     
                                    $ba_fo++;
                                     
                                     
                                 }
                                 
                                 if($patient->department_id =='32'){
                                   
                                    $ba_tt++; 
                               
                                 }
                                 
                                   //sly
                                  if(($patient->sex=='M') && ($patient->department_id =='31') && ($patient->yearly_reg_no)){
                                      if($dd != $dd1){ 
                                    $sly_mn++; 
                                      } else{}
                                     
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='31') && ($patient->old_reg_no)){
                                  
                                    $sly_mo++; 
                               
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='31') && ($patient->yearly_reg_no)){
                                   
                                    $sly_fn++; 
                                    
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='31') && ($patient->old_reg_no)){
                                  
                                    $sly_fo++;
                                   
                                     
                                 }
                                 
                                 if($patient->department_id =='31'){
                                  
                                    $sly_tt++;
                                   
                                     
                                 }
                            
                              //sky
                                  if(($patient->sex=='M') && ($patient->department_id =='30') && ($patient->yearly_reg_no)){
                                     
                                    $sky_mn++; 
                                    
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='30') && ($patient->old_reg_no)){
                                     
                                    $sky_mo++;
                                     
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='30') && ($patient->yearly_reg_no)){
                                     
                                    $sky_fn++;   
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='30') && ($patient->old_reg_no)){
                                    
                                    $sky_fo++; 
                                     
                                 }
                                 
                                 if($patient->department_id =='30'){
                                    
                                    $sky_tt++; 
                                    
                                 }
                            
                            
                              //st
                                  if(($patient->sex=='M') && ($patient->department_id =='29') && ($patient->yearly_reg_no)){
                                    
                                    $st_mn++; 
                                    
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='29') && ($patient->old_reg_no)){
                                     
                                    $st_mo++;   
                                    
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='29') && ($patient->yearly_reg_no)){
                                   
                                    $st_fn++;   
                                   
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='29') && ($patient->old_reg_no)){
                                    
                                    $st_fo++;  
                                    
                                 }
                                 
                                 if($patient->department_id =='29'){
                                  
                                    $st_tt++; 
                                   
                                 }
                                 
                                   //sw
                                  if(($patient->sex=='M') && ($patient->department_id =='28') && ($patient->yearly_reg_no)){
                                    
                                    $sw_mn++; 
                                   
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='28') && ($patient->old_reg_no)){
                                   
                                    $sw_mo++;   
                                   
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='28') && ($patient->yearly_reg_no)){
                                    
                                    $sw_fn++;   
                                   
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='28') && ($patient->old_reg_no)){
                                    
                                    $sw_fo++;  
                                    
                                 }
                                 
                                 if($patient->department_id =='28'){
                                    
                                    $sw_tt++; 
                                     
                                 } 

                                 //agad

                                if(($patient->sex=='M') && ($patient->department_id =='27') && ($patient->yearly_reg_no)){
                                      
                                    $vs_mn++; 
                                 
                                 }
                                 if(($patient->sex=='M') && ($patient->department_id =='27') && ($patient->old_reg_no)){
                                      
                                    $vs_mo++;   
                                     
                                     
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='27') && ($patient->yearly_reg_no)){
                                
                                    $vs_fn++; 
                                 
                                 }
                                 if(($patient->sex=='F') && ($patient->department_id =='27') && ($patient->old_reg_no)){
                                    
                                   
                                    $vs_fo++;
                                    
                                     
                                 }
                                 
                                 if($patient->department_id =='27'){
                                     
                                   
                                    $vs_tt++; 
                                   
                                     
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
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else { echo ""; } ?>">
                                    <td style="padding:2px;"><?php if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; } ?></td>
                                       
                                    <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  echo $tot_serial_ipd_change; ?></td> <?php } ?>  
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
                                    <td  style="padding:2px;"><?php if($patient->yearly_reg_no) { echo $patient->yearly_reg_no."/".$dot_year;} ?></td>
                                    <td  style="padding:2px;"><?php if($patient->old_reg_no) { echo $patient->old_reg_no; if($explode[1]==''){echo "/".$dot_year;}}?></td> <!-- //old patient no -->
                                                                 
                                    <!--<td><?php echo $patient->ipd_no?></td>-->
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>
                                    <td  style="padding:2px;"><?php echo $patient->address; ?></td>        
                                    <td  style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    <td  style="padding:2px;"><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> 
                                    <!-- <td><?php echo $patient->address; ?></td>   -->
                                   <?php if($department_by !='dpt'){ ?> <td  style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                    <td  style="padding:2px;"><?php  if($ipd == 'ipd'){ echo $p_dignosis_name; } else {echo $p_dignosis_name;}?></td> 
                                    <!--<td><?php echo date('Y-m-d',strtotime($patient->create_date)); ?></td> -->
                                      <?php 
                                       $doctor_name= $this->db->select("*")
                                      ->from('user')
			                          ->where('department_id', $patient->department_id) 
                                      ->get()
                                      ->row();
                                      if($ipd=='opd'){ if($department_by !='dpt') {?><td style="width: 30px;"><?php echo $doctor_name->firstname;?></td> <?php } }?>
                                      <?php if($department_by !='dpt') {?>
                                    <td  style="padding:2px;"> <?php 
                                    
                                    if($ipd == 'ipd'){ echo $doctor_name->firstname;} else { echo date('Y-m-d',strtotime($patient->create_date));}?></td><?php } ?>
                                     <?php if($department_by !='dpt') {?> <td  style="padding:2px; width: 81px;"><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td> <?php } ?>
                                      <?php if($department_by !='dpt') {?> <td  style="padding:2px; width: 81px;"><?php echo date('d-m-Y',strtotime($patient->discharge_date));?></td> <?php } ?>  
                                      <?php if($department_by !='dpt') {?> <td  style="padding:2px;"><?php echo $patient->bedNo;?></td> <?php } ?>  
                                     <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX1; ?></td> <?php } ?>  
                                      <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX2; ?></td>  <?php }?> 
                                       <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $RX3; ?></td>  <?php }?> 
                                         <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $SWA1; ?></td>  <?php }?>
                                          <?php if($department_by =='dpt') {?> <td  style="padding:2px;<?php if($gob =='gob') { echo "font-size: 10px;";}?>"><?php echo $SWA2; ?></td>  <?php }?> 
                                      <!--  <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $KARMA; ?></td> <?php } ?>-->  
                                     <!-- <?php if($gob =='gob') {?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK1; ?></td>  <?php }?> 
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
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                 <a href="<?php echo base_url("patients/edit_ipd/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                            <?php }else { ?>
                                                
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                                 <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                            <?php } ?>
                                       
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
                             <th style="width: 30px;" rowspan="2"><?php echo "Department Name" ?></th>
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
                            <th><?php echo "Follow-Up" ?></th>
                            <th  >
                            
                                <?php echo "New No" ?>
                            </th> 
                            <th><?php echo "Follow-Up" ?></th>
                                                    
                        </tr>
                    </thead>
                    <tbody>
                    <?php $n=1;
                      $male_new=array($ky_mn,$pn_mn,$ba_mn,$sly_mn,$sky_mn,$st_mn,$vs_mn);
                            $male_old=array($ky_mo,$pn_mo,$ba_mo,$sly_mo,$sky_mo,$st_mo,$vs_mo);
                            
                            $female_new=array($ky_fn,$pn_fn,$ba_fn,$sly_fn,$sky_fn,$st_fn,$vs_fn);
                            $female_old=array($ky_fo,$pn_fo,$ba_fo,$sly_fo,$sky_fo,$st_fo,$vs_fo);
                            
                            $total=array($ky_tt,$pn_tt,$ba_tt,$sly_tt,$sky_tt,$st_tt,$vs_tt);
                            
                    $dept=$this->db->select("*")
                               ->from('department')
                        		//->where('dprt_id !=','36')
                        		->where('dprt_id !=','35')
                        		->where('dprt_id !=','28')
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
                        <td colspan="6">Grand Total</td> 
                        <td><?php echo array_sum($total);?></td>  
                        <tr></tr>
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
</script>