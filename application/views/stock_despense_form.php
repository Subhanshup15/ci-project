<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print row">
                <div class="col-sm-12" align="center" style="margin-bottom: 10px;">
                     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
                    <br>
                    <p class="text-center"><h2><?= $pageHeading ?></h2></p>
                </div>
                <div class="col-xs-2" ></div>
            </div>
           
            
            <div class="panel-body">
                <div class="form-group row col-sm-12">
                    <?php echo form_open('stock/get_parma_patient', 'id="stockDespenseForm"');?>
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="opd_reg_no" class="col-form-label">Date<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <input name="create_date" class="datepicker form-control" data-date-format="dd-mm-yyyy" type="text" placeholder="<?php echo "Todays Date"; ?>" id="create_date"  value="<?= ($create_date)?date("d-m-Y", strtotime($create_date)):date("d-m-Y") ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="section" class="col-form-label">Section<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <select class="form-control" name="section" id="section" required>
                                    <option value="opd" <?= ($section=="opd")?"Selected":NULL ?>>opd</option>
                                    <option value="ipd" <?= ($section=="ipd")?"Selected":NULL ?>>ipd</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label class="col-form-label"></label>
                            </div>
                            <div class="row">
                                <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                 
                <?php echo form_close(); ?>
                
                   
                <?php echo form_open('stock/despensePatientStock', 'id="stockDespenseForm"');?>     
                                
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="opd_reg_no" class="col-form-label">Select Patient Name<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <!--<input name="opd_reg_no" autocomplete="off" type="text" class="form-control" id="opd_reg_no" placeholder="OPD Reg. No" value="<?= ($opd_reg_no)?$opd_reg_no:NULL ?>" >  -->
                                <input type="hidden" name="section" id="section" value="<?php echo $section; ?>"> 
                                <input type="hidden" name="create_date" id="create_date" value="<?php echo $create_date; ?>"> 
                               
                               <select name="opd_reg_no" autocomplete="off" class="form-control" id="opd_reg_no">
                                    
                                    <option value="">Select option</option>
                                    
                                       <?php foreach($patient_pharma as $pt) { ?>
                                            <option value="<?php echo $pt->firstname; ?>"><?php echo $pt->firstname; ?></option>';
                                       <?php } ?>
                                  
                                </select>
                        
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                
                            </div>
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label class="col-form-label"></label>
                            </div>
                            <div class="row">
                                <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
                            </div>
                        </div>
                    </div>
                
                    
                <?php echo form_close(); ?>
                
            </div>    
                
                
                 
                <div class="form-group row col-sm-12">
                    
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="firstname" class="col-form-label">Patient Name<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <input name="firstname" autocomplete="off" type="text" class="form-control" id="firstname" placeholder="Patient Name" value="<?= ($patient)?$patient->firstname:NULL ?>" readonly>    
                            </div>
                        </div>
                    </div>    
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="p_sex" class="col-form-label">Sex<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <input name="p_sex" autocomplete="off" type="text" class="form-control" id="p_sex" placeholder="Patient Sex" value="<?= ($patient)?$patient->sex:NULL ?>" readonly>    
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="p_age" class="col-form-label">Age<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <input name="p_age" autocomplete="off" type="text" class="form-control" id="p_age" placeholder="Patient Age" value="<?= ($patient)?$patient->date_of_birth:NULL ?>" readonly>    
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div style="margin: 0% 5% 0% 5%;">
                            <div class="row">
                                <label for="p_address" class="col-form-label">Address<i class="text-danger"></i></label>
                            </div>
                            <div class="row">
                                <input name="p_address" autocomplete="off" type="text" class="form-control" id="p_address" placeholder="Patient Address" value="<?= ($patient)?$patient->address:NULL ?>" readonly>    
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group row col-sm-12">
                    <?php 
                        if($section == 'ipd'){ 
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
                                    
                        /*if($patient->manual_status==0){
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
                        }*/
                        $RX1= $tretment->RX1;
                        $RX2= $tretment->RX2;
                        $RX3= $tretment->RX3;
                        $RX4= $tretment->RX4;
                        $RX5= $tretment->RX5;
                        
                        if($section == 'ipd'){
                            $tre_rx1 = $RX1;
                            $ex1=explode(",",$tre_rx1);
                            $tre_rx2 = $RX2;
                            $ex2=explode(",",$tre_rx2);
                            $tre_rx4 = $RX3;
                            $ex3=explode(",",$tre_rx4);
                            $tre_rx4 = $RX4;
                            $ex4=explode(",",$tre_rx4);
                            $tre_rx5 = $RX5;
                            $ex5=explode(",",$tre_rx5);
                            
                            $ex_x1=explode("x",$ex1[0]);
                            $ex_x2=explode("x",$ex2[0]);
                            $ex_x3=explode("x",$ex3[0]);
                            $ex_x4=explode("x",$ex4[0]);
                            $ex_x5=explode("x",$ex5[0]);
                            $RX1 = $ex_x1[0];
                            $RX2 = $ex_x2[0];
                            $RX3 = $ex_x3[0];
                            $RX4 = $ex_x4[0];
                            $RX5 = $ex_x5[0];
                        }
                        
                        $DRX1= $tretment->DRX1;
                        $DRX2= $tretment->DRX2;
                        $DRX3= $tretment->DRX3;
                        
                        if($section == 'ipd'){
                            $datefrom_n=date('Y-m-d',strtotime($create_date));
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
                            if(($DISTRIBUTION_IPD < $n) && ($section == 'ipd')){
                                /*if($patient->manual_status==0){
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
                                    }
                                }else{
                                    $tretment=$this->db->select("*")
                                        ->from('manual_treatments')
                                        ->where('patient_id_auto',$patient->id)
                                        ->where('dignosis LIKE',$p_dignosis)
                                        ->where('ipd_opd ',$section_tret)
                                        ->get()
                                        ->row();
                                }*/
                                
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
                                               // print_r($tretment);
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
                                
                                $tre_rx1 = $RX1;
                                $ex1=explode(",",$tre_rx1);
                                $tre_rx2 = $RX2;
                                $ex2=explode(",",$tre_rx2);
                                $tre_rx4 = $RX3;
                                $ex3=explode(",",$tre_rx4);
                                $tre_rx4 = $RX4;
                                $ex4=explode(",",$tre_rx4);
                                $tre_rx5 = $RX5;
                                $ex5=explode(",",$tre_rx5);
                                
                                $ex_x1=explode("x",$ex1[0]);
                                $ex_x2=explode("x",$ex2[0]);
                                $ex_x3=explode("x",$ex3[0]);
                                $ex_x4=explode("x",$ex4[0]);
                                $ex_x5=explode("x",$ex5[0]);
                                 $RX1 = $ex_x1[0];
                                 $RX2 = $ex_x2[0];
                                 $RX3 = $ex_x3[0];
                                 $RX4 = $ex_x4[0];
                                 $RX5 = $ex_x5[0];
                            }
                        }
                    ?>
                    
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan=2 style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Diagnosis</th>
                                <th rowspan=2 colspan=2 style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Treatment</th>
                                <th colspan=3 style="text-align:center;border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Medicine</th>
                                <th rowspan=2 colspan=2 style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Discharge Treatment</th>
                                <th colspan=3 style="text-align:center;border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Medicine</th>
                                <th rowspan=2 style="text-align:center;border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Total Despense Medicine</th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Quan.</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Days</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Total</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Quan.</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Days</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $medicineName = $this->db->get('pharma1')->result();
                          //  print_r($this->db->last_query());
                         // print_r($RX1); echo "<br>";
                         // print_r($RX2); echo "<br>";
                         // print_r($RX3); echo "<br>";
                         // print_r($RX4); echo "<br>";
                         // print_r($RX5);
                          
                            $str = $RX1;
                            $arry=explode(" ",$str);
                            $count = count($arry);
                            $arry=explode("-",$str);
                            $count = count($arry);
                          for($i=0;$i<$count;$i++){
                                        if($i==0){
                                            $ar1 = explode(' ',$arry[$i]);
                                            $ar1_count = count($ar1);
                                            //$rx1_quantity = '';
                                            
                                           $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                            $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                            $tempChurnaVal = 0;
                                            if($mgCheck == 1){
                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                            }
                                            elseif($gCheck == 1){
                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                $tempChurnaVal = $gVal[0];
                                                $c1 = $tempChurnaVal + $tempChurnaVal;
                                                //print_r($tempChurnaVal);print_r('<br>');
                                            }
                                            else{
                                                $tempChurnaVal = $ar1[$ar1_count - 1];
                                                //$tempChurnaVal = $tempChurnaVal;
                                                $c1 = $tempChurnaVal + $tempChurnaVal;
                                            }
                                        }
                                        elseif($i==($count-1)){
                                           $ar21 = explode(' ',$arry[$count-1]);
                                            $ar2_count = count($ar21);
                                            for($j=$ar2_count;$j>0;$j--){
                                                if($ar21[$j]!=''){
                                                     $ex = explode('D',$ar21[$j]);
                                                    $tab_days = $ex[0];
                                                    break;
                                                }
                                            }
                                        }
                                        else{
                                            if($arry[$i] != ''){
                                            }
                                        }
                                    }
                                    $totalRX1 = $c1 * $tab_days;
                       // print_r($tab_days);
                                    
                           
                            $str1 = $RX2;
                            $arry1=explode(" ",$str1);
                            $count1 = count($arry1);
                            $arry1=explode("-",$str1);
                            $count1 = count($arry1);
                          for($i=0;$i<$count1;$i++){
                                        if($i==0){
                                            $ar11 = explode(' ',$arry1[$i]);
                                            $ar1_count1 = count($ar11);
                                            //$rx1_quantity = '';
                                            
                                           $mgCheck1 = preg_match("/mg/", $ar11[$ar1_count1 - 1]);
                                            $gCheck1 = preg_match("/g/", $ar11[$ar1_count1 - 1]);
                                            $tempChurnaVal1 = 0;
                                            if($mgCheck1 == 1){
                                                $mgVal1 = preg_split("/[(A-Z)(a-z)]/", $ar11[$ar1_count1 - 1]);
                                                $tempChurnaVal1 = (int)$mgVal1[0] / 1000;
                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                            }
                                            elseif($gCheck1 == 1){
                                                $gVal1 = preg_split("/[(A-Z)(a-z)]/", $ar11[$ar1_count1 - 1]);
                                                $tempChurnaVal1 = $gVal1[0];
                                                //print_r($tempChurnaVal);print_r('<br>');
                                            }
                                            else{
                                                $tempChurnaVal1 = $ar11[$ar1_count1 - 1];
                                                $c11 = $tempChurnaVal1 + $tempChurnaVal1;
                                            }
                                        }
                                        elseif($i==($count1-1)){
                                           $ar21 = explode(' ',$arry1[$count1-1]);
                                            $ar2_count1 = count($ar21);
                                            for($j=$ar2_count1;$j>0;$j--){
                                                if($ar21[$j]!=''){
                                                     $ex = explode('D',$ar21[$j]);
                                                    $tab_days1 = $ex[0];
                                                    break;
                                                }
                                            }
                                        }
                                        else{
                                            if($arry2[$i] != ''){
                                            }
                                        }
                                    }      
                                $totalRX2 = $c11 * $tab_days1;
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                            $str2 = $RX3;
                            $arry2=explode(" ",$str2);
                            $count2 = count($arry2);
                            $arry2=explode("-",$str2);
                            $count2 = count($arry2);
                          for($i=0;$i<$count2;$i++){
                                        if($i==0){
                                            $ar12 = explode(' ',$arry2[$i]);
                                            $ar1_count2 = count($ar12);
                                            //$rx1_quantity = '';
                                            
                                           $mgCheck2 = preg_match("/mg/", $ar12[$ar1_count2 - 1]);
                                            $gCheck2 = preg_match("/g/", $ar12[$ar1_count2 - 1]);
                                            $tempChurnaVal1 = 0;
                                            if($mgCheck2 == 1){
                                                $mgVal2 = preg_split("/[(A-Z)(a-z)]/", $ar12[$ar1_count2 - 1]);
                                                $tempChurnaVal1 = (int)$mgVal1[0] / 1000;
                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                            }
                                            elseif($gCheck2 == 1){
                                                $gVal2 = preg_split("/[(A-Z)(a-z)]/", $ar12[$ar1_count2 - 1]);
                                                $tempChurnaVal2 = $gVal2[0];
                                                //print_r($tempChurnaVal);print_r('<br>');
                                            }
                                            else{
                                                $tempChurnaVal2 = $ar12[$ar1_count2 - 1];
                                                $c12 = $tempChurnaVal2 + $tempChurnaVal2;
                                            }
                                        }
                                        elseif($i==($count2-1)){
                                           $ar22 = explode(' ',$arry2[$count2-1]);
                                            $ar2_count2 = count($ar22);
                                            for($j=$ar2_count2;$j>0;$j--){
                                                if($ar22[$j]!=''){
                                                     $ex = explode('D',$ar22[$j]);
                                                    $tab_days2 = $ex[0];
                                                    break;
                                                }
                                            }
                                        }
                                        else{
                                            if($arry2[$i] != ''){
                                            }
                                        }
                                    }
                           $totalRX3 = $c12 * $tab_days2;
                           
                           
                           
                            ?>
                            
                            <tr>
                                <th rowspan=5 style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"><?= $patient->dignosis ?></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">RX1</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineRX1" id="medicineRX1"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <option value="<?php echo $x_val->name; ?>" <?php echo (stripos($RX1, $x_val->name) !== false)? 'Selected':'' ?>><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo $c1; ?>" name="quantityRX1" id="quantityRX1" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo $tab_days; ?>" name="daysRX1" id="daysRX1" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;" >
                                    <input type="text" value="<?php echo $totalRX1; ?>" name="totalRX1" id="totalRX1" class="form-control" style="width:45px;" readonly> 
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">DRX1</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineDRX1" id="medicineDRX1"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                       
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="quantityDRX1" id="quantityDRX1" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="daysDRX1" id="daysDRX1" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="totalDRX1" id="totalDRX1" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="grandtotalRX1DRX1" id="grandtotalRX1DRX1" class="form-control" style="width:100%;" readonly>
                                </th>
                                
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">RX2</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineRX2" id="medicineRX2"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                       <!-- <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>-->
                                        <option value="<?php echo $x_val->name; ?>" <?php echo (stripos($RX2, $x_val->name) !== false)? 'Selected':'' ?>><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo $c11; ?>" name="quantityRX2" id="quantityRX2" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo $tab_days; ?>" name="daysRX2" id="daysRX2" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo $totalRX2; ?>" name="totalRX2" id="totalRX2" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">DRX2</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineDRX2" id="medicineDRX2"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="quantityDRX2" id="quantityDRX2" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="daysDRX2" id="daysDRX2" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="totalDRX2" id="totalDRX2" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="grandtotalRX2DRX2" id="grandtotalRX2DRX2" class="form-control" style="width:100%;" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">RX3</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineRX3" id="medicineRX3"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <!--<option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>-->
                                         <option value="<?php echo $x_val->name; ?>" <?php echo (stripos($RX3, $x_val->name) !== false)? 'Selected':'' ?>><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo $c12;?>" name="quantityRX3" id="quantityRX3" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo"$tab_days2"; ?>" name="daysRX3" id="daysRX3" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="<?php echo"$totalRX3"; ?>" name="totalRX3" id="totalRX3" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">DRX3</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineDRX3" id="medicineDRX3"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="quantityDRX3" id="quantityDRX3" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="daysDRX3" id="daysDRX3" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="totalDRX3" id="totalDRX3" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="grandtotalRX3DRX3" id="grandtotalRX3DRX3" class="form-control" style="width:100%;" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">RX4</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineRX4" id="medicineRX4"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="quantityRX4" id="quantityRX4" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="daysRX4" id="daysRX4" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="totalRX4" id="totalRX4" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="grandtotalRX4DRX4" id="grandtotalRX4DRX4" class="form-control" style="width:100%;" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;width:5%;">RX5</th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <select name="medicineRX5" id="medicineRX5"  class="form-control select2" style="width:125px;">
                                        <option value="">Select option</option>
                                        <?php foreach($medicineName as $x_val ){ ?>
                                        <option value="<?php echo $x_val->name; ?>"><?php echo $x_val->name; ?></option>
                                        <?php }?>
                                    </select>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="quantityRX5" id="quantityRX5" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="daysRX5" id="daysRX5" class="form-control" style="width:100%;">
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="totalRX5" id="totalRX5" class="form-control" style="width:100%;" readonly>
                                </th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;"></th>
                                <th style="border: 1px solid black;border-collapse: collapse;background-color: #f2f2f2;">
                                    <input type="text" value="0" name="grandtotalRX5DRX5" id="grandtotalRX5DRX5" class="form-control" style="width:100%;" readonly>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
$("#opd_reg_no").on("click",".yourselector",function(e){

$.ajax({
    type: 'POST',
    url: "stock/despensePatientStock",
    data: {
        param: myparamvalue
    },
    beforeSend: function() {

    },
    complete: function() {

    },
    success: function(_result) {

    }
});

});
</script>


<script>

/*
quantityRX3
daysRX3
totalRX3
quantityDRX3
daysDRX3
totalDRX3
grandtotalRX3DRX3
*/

    $("#daysRX1").keyup(function(){
        var quantityRX1 = $("#quantityRX1").val();
        var daysRX1 = $("#daysRX1").val();
        var quantityDRX1 = $("#quantityDRX1").val();
        var daysDRX1 = $("#daysDRX1").val();
        var totalRX1 = parseFloat(quantityRX1) * parseFloat(daysRX1);
        
        $("#totalRX1").val(((parseFloat(quantityRX1))*(parseFloat(daysRX1))));
        
        //alert("totalRX1");
        
        var totalDRX1 = parseFloat(quantityDRX1) * parseFloat(daysDRX1);
        var grandtotalRX1DRX1 = totalRX1+totalDRX1;
       // $("#totalRX1").val(totalRX1);
        
         //document.getElementById("#totalRX1").value = totalRX1;
        
        $("#totalDRX1").val(totalDRX1);
        $("#grandtotalRX1DRX1").val(grandtotalRX1DRX1);
        
        //alert(totalDRX1);
    });
    
    
    $("#totalRX1").onload(function(){
        var quantityRX1 = $("#quantityRX1").val();
        var daysRX1 = $("#daysRX1").val();
        var quantityDRX1 = $("#quantityDRX1").val();
        var daysDRX1 = $("#daysDRX1").val();
        //var totalRX1 = parseFloat(quantityRX1) * parseFloat(daysRX1);
        $("#totalRX1").val(((parseFloat(quantityRX1))*(parseFloat(daysRX1))));
        //alert("totalRX1");
        var totalDRX1 = parseFloat(quantityDRX1) * parseFloat(daysDRX1);
        var grandtotalRX1DRX1 = totalRX1+totalDRX1;
         $("#grandtotalRX1DRX1").val(((parseFloat(quantityDRX1))*(parseFloat(daysDRX1))));
        // $("#totalRX1").val(totalRX1);
        //document.getElementById("#totalRX1").value = totalRX1;
        //("#totalDRX1").val(totalDRX1);
        // $("#grandtotalRX1DRX1").val(grandtotalRX1DRX1);
        //alert(totalDRX1);
    });
    
    
    $("#daysDRX1").keyup(function(){
        var quantityRX1 = $("#quantityRX1").val();
        var daysRX1 = $("#daysRX1").val();
        var quantityDRX1 = $("#quantityDRX1").val();
        var daysDRX1 = $("#daysDRX1").val();
        var totalRX1 = parseFloat(quantityRX1)*parseFloat(daysRX1);
        var totalDRX1 = parseFloat(quantityDRX1)*parseFloat(daysDRX1);
        var grandtotalRX1DRX1 = totalRX1+totalDRX1;
        $("#totalRX1").val(totalRX1);
        $("#totalDRX1").val(totalDRX1);
        $("#grandtotalRX1DRX1").val(grandtotalRX1DRX1);
    });
    $("#daysRX2").keyup(function(){
        var quantityRX2 = $("#quantityRX2").val();
        var daysRX2 = $("#daysRX2").val();
        var quantityDRX2 = $("#quantityDRX2").val();
        var daysDRX2 = $("#daysDRX2").val();
        var totalRX2 = parseFloat(quantityRX2)*parseFloat(daysRX2);
        var totalDRX2 = parseFloat(quantityDRX2)*parseFloat(daysDRX2);
        var grandtotalRX2DRX2 = totalRX2+totalDRX2;
        $("#totalRX2").val(totalRX2);
        $("#totalDRX2").val(totalDRX2);
        $("#grandtotalRX2DRX2").val(grandtotalRX2DRX2);
    });
    $("#daysDRX2").keyup(function(){
        var quantityRX2 = $("#quantityRX2").val();
        var daysRX2 = $("#daysRX2").val();
        var quantityDRX2 = $("#quantityDRX2").val();
        var daysDRX2 = $("#daysDRX2").val();
        var totalRX2 = parseFloat(quantityRX2)*parseFloat(daysRX2);
        var totalDRX2 = parseFloat(quantityDRX2)*parseFloat(daysDRX2);
        var grandtotalRX2DRX2 = totalRX2+totalDRX2;
        $("#totalRX2").val(totalRX2);
        $("#totalDRX2").val(totalDRX2);
        $("#grandtotalRX2DRX2").val(grandtotalRX2DRX2);
    });
    $("#daysRX3").keyup(function(){
        var quantityRX3 = $("#quantityRX3").val();
        var daysRX3 = $("#daysRX3").val();
        var quantityDRX3 = $("#quantityDRX3").val();
        var daysDRX3 = $("#daysDRX3").val();
        var totalRX3 = parseFloat(quantityRX3)*parseFloat(daysRX3);
        var totalDRX3 = parseFloat(quantityDRX3)*parseFloat(daysDRX3);
        var grandtotalRX3DRX3 = totalRX3+totalDRX3;
        $("#totalRX3").val(totalRX3);
        $("#totalDRX3").val(totalDRX3);
        $("#grandtotalRX3DRX3").val(grandtotalRX3DRX3);
    });
    $("#daysDRX3").keyup(function(){
        var quantityRX3 = $("#quantityRX3").val();
        var daysRX3 = $("#daysRX3").val();
        var quantityDRX3 = $("#quantityDRX3").val();
        var daysDRX3 = $("#daysDRX3").val();
        var totalRX3 = parseFloat(quantityRX3)*parseFloat(daysRX3);
        var totalDRX3 = parseFloat(quantityDRX3)*parseFloat(daysDRX3);
        var grandtotalRX3DRX3 = totalRX3+totalDRX3;
        $("#totalRX3").val(totalRX3);
        $("#totalDRX3").val(totalDRX3);
        $("#grandtotalRX3DRX3").val(grandtotalRX3DRX3);
    });
    $("#daysRX4").keyup(function(){
        var quantityRX4 = $("#quantityRX4").val();
        var daysRX4 = $("#daysRX4").val();
        var totalRX4 = parseFloat(quantityRX4)*parseFloat(daysRX4);
        var grandtotalRX4DRX4 = totalRX4;
        $("#totalRX4").val(totalRX4);
        $("#grandtotalRX4DRX4").val(grandtotalRX4DRX4);
    });
    $("#daysRX5").keyup(function(){
        var quantityRX5 = $("#quantityRX5").val();
        var daysRX5 = $("#daysRX5").val();
        var totalRX5 = parseFloat(quantityRX5)*parseFloat(daysRX5);
        var grandtotalRX5DRX5 = totalRX5;
        $("#totalRX5").val(totalRX5);
        $("#grandtotalRX5DRX5").val(grandtotalRX5DRX5);
    });
    
    
});
</script>