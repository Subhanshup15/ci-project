<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
?>

<div class="row">
    
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="">
            
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
            </div>
            
            <!--<input type="text" name="section" class="form-control" id="section" value="<?//php echo 'ipd'; ?>" readonly>-->
        
            <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>

        </form>
    </div>
    
    
    <div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>

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
                          
                            if($department_id)
                            {
                                $dept_name=$this->db->select("*")
			                    ->from('department')
			                    ->where('dprt_id',$department_id)
                                ->get()
			                    ->row();
			               
			                    $name= $dept_name->name;
                            } 
                            else
                            {
                              
                               $name ='';
                            }
                           
                           if($dept_id)
                           {
                                $dept_name=$this->db->select("*")
			                    ->from('department')
			                    ->where('dprt_id',$dept_id)
                                ->get()
			                    ->row();
			                    $dept_name= $dept_name->name;
                           } 
                           else
                            {
                               $dept_name ='';
                            }
                             
                            $ipd = ($patients[0]->ipd_opd);
                                
                            if($ipd =='ipd')
                            {
                            
                         ?>    
                                
                                <h4 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} elseif($gob=='gob'){ echo "GOB"; } else { echo "";} ?> <h2>MidNight Register</h2> <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; } elseif($dept_name){ echo"(".$dept_name.")" ;}?></h3>
                                <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>     
                        
                        <?php }else{ ?>
                        
                                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "Departmental ";} else { echo ""; }?> <h2>MidNight Register</h2> <?php  if($name) { echo "(".$name.")";}?></h3>
                                <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>
                        
                        <?php  }  ?>
                    
                    </div>
                    
                    
                       <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                           
                            <thead>
                                <tr>
                                    <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                                    <th style="width: 30px;" rowspan="2"><?php echo "Department Name" ?></th>
                                    <th style="width: 30px; text-align: center;" rowspan="2"><?php echo "Prev.No Of Patient" ?></th> 
                                    <th style="width: 30px; text-align: center;" rowspan="2"><?php echo "Admitted" ?></th> 
                                    <th style="width: 30px; text-align: center;" rowspan="2"><?php echo "Discharge" ?></th> 
                                    <th style="width: 30px; text-align: center;" rowspan="2"><?php echo "Total No of Patient of Midnight" ?></th> 
                                 </tr>
                            </thead>
                           
                            
                            <tbody>
                     
                                <?php if (!empty($patients)) { ?>
                         
                                <?php 
                                
                                    $sl = 12141;
                                    $datefrom1=date('Y-m-d',strtotime($datefrom));
                                    $year1 = date('Y',strtotime($datefrom));
                                    $year2='%'.$year1.'%';
                           
                                    $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); ; 
					
                                ?>
                                
                                
                                <?php 
                                     
                                     $i = 0; 
                                     
                                     $aa_mn=0;$aa_mo=0;$aa_fn=0;$aa_fo=0; $aa_tt=0; 
                                     $ky_mn=0;$ky_mo=0;$ky_fn=0;$ky_fo=0; $ky_tt=0; $ky_ttn=0; $ky_ttan=0; $ky_ttdn=0; 
                                     $pn_mn=0;$pn_mo=0;$pn_fn=0;$pn_fo=0; $pn_tt=0; $pn_ttn=0; $pn_ttan=0; $pn_ttdn=0;
                                     $ba_mn=0;$ba_mo=0;$ba_fn=0;$ba_fo=0; $ba_tt=0; $ba_ttn=0;  $ba_ttan=0;  $ba_ttdn=0;
                                     $sly_mn=0;$sly_mo=0;$sly_fn=0;$sly_fo=0; $sly_tt=0; $sly_ttn=0; $sly_ttan=0; $sly_ttdn=0;
                                     $sky_mn=0;$sky_mo=0;$sky_fn=0;$sky_fo=0; $sky_tt=0; $sky_ttn=0; $sky_ttan=0; $sky_ttdn=0;
                                     $st_mn=0;$st_mo=0;$st_fn=0;$st_fo=0; $st_tt=0; $st_ttn=0; $st_ttan=0; $st_ttdn=0;
                                     $sw_mn=0;$sw_mo=0;$sw_fn=0;$sw_fo=0; $sw_tt=0;
                             
                              
                                    foreach ($patients as $patient) 
                                    { 
                                        $i++;
                            
                                        $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                                        $aa=date('Y-m-d', strtotime( $patient->create_date));
                                        $dd12=date('Y-m-d', strtotime($_GET['start_date']));
                              
                                        if($_GET['start_date'])
                                        {
                                            $dd1=date('Y-m-d', strtotime($_GET['start_date']));
                                        }
                                        else
                                        {
                                            $dd1=date('Y-m-d');
                                        }
                            
                                        //kay
                                        if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->yearly_reg_no))
                                        {
                                                if($dd != $dd1)
                                                {
                                                    $ky_mn++; 
                                        } 
                                                else
                                                {
                                                    
                                                }
                                         }
                                         if(($patient->sex=='M') && ($patient->department_id =='34') && ($patient->old_reg_no))
                                         {
                                               if($dd != $dd1)
                                               {
                                                    $ky_mo++;   
                                               } 
                                               else
                                               {
                                                   
                                               }
                                         }
                                         if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->yearly_reg_no))
                                         {
                                            if($dd != $dd1)
                                            { 
                                                $ky_fn++; 
                                            } 
                                            else
                                            {
                                                
                                            }
                                         }
                                         if(($patient->sex=='F') && ($patient->department_id =='34') && ($patient->old_reg_no))
                                         {
                                            
                                            if($dd != $dd1)
                                            { 
                                                $ky_fo++;
                                            } 
                                            else{
                                                
                                            }
                                             
                                         }
                                         if($patient->department_id =='34'){
                                             
                                            if($dd != $dd1)
                                            {      
                                                $ky_tt++; 
                                                if($aa != $dd1)
                                                {
                                                    $ky_ttn++; 
                                                }
                                            } 
                                            else if($dd == $dd1)
                                            {
                                                $ky_ttdn++;
                                            }
                                            else if($aa == $dd1)
                                            {
                                             
                                            }
                                            else
                                            {
                                                
                                            }
                                            if($dd1==$aa)
                                            {
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
                                
                           
                                 
                                   if($ipd == 'ipd')
                                   { 
                                        $che=trim($patient->dignosis);
                                        $section_tret='ipd';
                                        $len=strlen($che);
                                        $dd= substr($che,$len - 1);
                                         
                                        $str = $patient->dignosis;
                                        $arry=explode("-",$str);
                                        $t_c=count($arry);
                                         
                                   
                                        if($t_c=='2')
                                        {
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                        }
                                        else
                                        {
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                        }
                                       
                                    }
                                    else
                                    {
                                        $section_tret='opd';
                                        $che=trim($patient->dignosis);
                                        $section_tret='opd';
                                        $len=strlen($che);
                                        $dd= substr($che,$len - 1);
                                         
                                        $str = $patient->dignosis;
                                        $arry=explode("-",$str);
                                        $t_c=count($arry);
                                   
                                    
                                        if($t_c=='2')
                                        {
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                        }
                                        else
                                        {
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                        }
                                    
                                    }
                               
                              ?>
                             
                            <?php $sl++; ?>
                        
                        <?php } ?> 
                    
                    <?php } ?> 
                        
               
                            
<!---------------------------------------------------------       Fetch Record    --------------------------------------------------------------->                        
                        
                        <?php 
                        
                            $n=1;
                            $total=array($ky_tt,$pn_tt,$ba_tt,$sly_tt,$sky_tt,$st_tt,$sw_tt);
                         
                        ?>
                       
                    </tbody>
                    
                    

                         <tr>
                        <td>1</td>
                        <td>Kayachikitsa</td>
                        <td><?php echo $k=$ky_tt + $ky_ttdn - $ky_ttan; ?></td>
                        <td><?php echo $ky_ttan; ?></td>
                        <td><?php echo $ky_ttdn; ?></td>
                        <td><?php echo ($k + $ky_ttan) - $ky_ttdn; ?></td>
                    </tr>

                       <tr>
                        <td>2</td>
                        <td>Panchkarma</td>
                        <td><?php echo $p=$pn_tt + $pn_ttdn - $pn_ttan; ?></td>
                        <td><?php echo $pn_ttan; ?></td>
                        <td><?php echo $pn_ttdn; ?></td>
                        <td><?php echo ($p + $pn_ttan) - $pn_ttdn; ?></td>
                    </tr>
 <tr>
                       <td>3</td>
                        <td>Balroga</td>
                        <td><?php echo $b=$ba_tt + $ba_ttdn - $ba_ttan; ?></td>
                        <td><?php echo $ba_ttan; ?></td>
                        <td><?php echo $ba_ttdn; ?></td>
                        <td><?php echo ($b + $ba_ttan) - $ba_ttdn; ?></td>
                    </tr>
                       <tr>
                        <td>4</td>
                        <td>Shalyatantra</td>
                        <td><?php echo $sl=$sly_tt + $sly_ttdn - $sly_ttan; ?></td>
                        <td><?php echo $sly_ttan; ?></td>
                        <td><?php echo $sly_ttdn; ?></td>
                        <td><?php echo ($sl + $sly_ttan) - $sly_ttdn; ?></td>
                    </tr>
                       <tr>
                        <td>5</td>
                        <td>Shalakyatantra</td>
                        <td><?php echo $sk=$sky_tt + $sky_ttdn - $sky_ttan; ?></td>
                        <td><?php echo $sky_ttan; ?></td>
                        <td><?php echo $sky_ttdn; ?></td>
                        <td><?php echo ($sk + $sky_ttan) - $sky_ttdn; ?></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Striroga / Prasutitantra</td>
                        <td><?php echo $s= $st_tt + $st_ttdn - $st_ttan; ?></td>
                        <td><?php echo $st_ttan; ?></td>
                        <td><?php echo $st_ttdn; ?></td>
                        <td><?php echo ($s + $st_ttan) - $st_ttdn; ?></td>
                    </tr>
                    <tr>
                        <td><b>Grand Total</b></td>
                        <td></td>
                        <td><b><?php echo $t_t= $k + $p + $b + $sl + $sk + $s; ?></b></td>
                        <td><b><?php echo  $t_a=$ky_ttan + $pn_ttan + $ba_ttan + $sly_ttan + $sky_ttan + $st_ttan;  ?></b></td>
                        <td><b><?php echo  $t_d=$ky_ttdn + $pn_ttdn + $ba_ttdn + $sly_ttdn + $sky_ttdn + $st_ttdn;?></b></td>
                        <td><b><?php echo array_sum($total);?><b></td>
                    </tr>
                
            </table>

        </div>
    </div>
</div>


        </div>
    
    </div>
    
 </div>