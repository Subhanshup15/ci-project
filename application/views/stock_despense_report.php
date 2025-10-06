<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('stock/stock_despense_report'); ?>">
            <div class="form-group" id="startDate">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>  
            <div class="form-group" id="endDate">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
            </div>
            <div class="form-group">
                <select class="form-control" name="section" id="section">
                    <option value="">Select Section</option>
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
            </div>
            <div class="panel-body">
                 <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
            </div></div>
            <div class="col-xs-2" ></div>
                    <?php if($section=='opd'):?>
                        <div>
                            <div class="col-sm-12" align="center">
                                <?php if($section):?>
                                    <h3><strong><?php echo "Daily ".ucfirst($section)." Stock Despense Register"; ?></strong></h3>
                                <?php else: ?>
                                    <h3><strong><?php echo "Daily Stock Despense Register"; ?></strong></h3>
                                <?php endif;?>
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Churna Despense Register"; ?></strong></h2>
                            </div>
                            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan='2' style="width: 30px;">Sr. No</th>
                                        <th rowspan='2' style="width: 30px;">OPD NO</th>
                                        <th rowspan='2' style="width: 30px;">Name</th>
                                        <?php
                                            $churnaColSpan=0;
                                            foreach($churnaMedicineName as $md):
                                                if($md->status == 1):
                                                    $churnaColSpan = $churnaColSpan + 1;
                                                endif;
                                            endforeach;
                                        ?>
                                        <th colspan=<?php echo $churnaColSpan;?> style='text-align: center;'> Churna </th>
                                    </tr>
                                    <tr>
                                        <?php foreach($churnaMedicineName as $md):?>
                                            <th style="width: 30px;">
                                                <?php //echo $md->name; 
                                                    $words = explode(' ', $md->name);
                                                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];
                                                    // for($i=0;$i<strlen($words[0]);$i++){
                                                    //     echo $words[0][$i].'<br>';
                                                    // }
                                                ?>
                                            </th>
                                        <?php endforeach;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?//php print_r($patientData);?>
                                    <?php $pcount=0; foreach($patientData as $pData):?>
                                    <tr>
                                        <?php
                                            $che=trim($pData->dignosis);
                                            //print_r($che);
                                            
                                            $section_tret='opd';
                                            $len=strlen($che);
                                            $dd= substr($che,$len - 1);
                                            
                                            $str = $pData->dignosis;
                                            $arry=explode("-",$str);
                                            $t_c=count($arry);
                                            if($t_c=='2'){
                                                $dd1=substr($che, 0, -1);
                                                $new_str = trim($arry[0]);
                                                $p_dignosis = '%'.$new_str.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }else{
                                                $p_dignosis = '%'.$che.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }
                                            // if($pData->manual_status == 0){
                                            //     $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>c->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                            //             ->get('treatments1')
                                            //             ->row();
                                            // }
                                            
                                            if($pData->manual_status==0){
                                                if($pData->proxy_id){
                                                    $tretment=$this->db->select("*")
                                                        ->from('treatments1')
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('proxy_id',$pData->proxy_id)
                                                        ->where('department_id',$pData->department_id)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                                else{
                                                    $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('department_id',$pData->department_id)
                                                    ->where('ipd_opd ',$section_tret)
                                                    ->get()
                                                    ->row();  
                                                    // if(empty($tretment)){
                                                    //     $tretment=$this->db->select("*")
                                                    //         ->from('treatments1')
                                                    //         ->where('department_id',$pData->department_id)
                                                    //         ->where('ipd_opd',$pData->department_id)
                                                    //         ->get()
                                                    //         ->row();   
                                                    // }
                                                }
                                            }else{
                                                $tretment=$this->db->select("*")
                                                    ->from('manual_treatments')
                                                    ->where('patient_id_auto',$pData->id)
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('ipd_opd ',$section_tret)
                                                    ->get()
                                                    ->row();
                                            }
                                            
                                            //print_r($tretment);
                                            if($tretment){
                                        ?>
                                                <th><?php echo $pcount = $pcount+1;?></th>
                                                <th>
                                                    <?php 
                                                        if($pData->yearly_reg_no != '' || $pData->yearly_reg_no != NULL)
                                                        {
                                                            echo $pData->yearly_reg_no.' (New)';
                                                        }
                                                        if($pData->old_reg_no != '' || $pData->old_reg_no != NULL)
                                                        {
                                                            echo $pData->old_reg_no.' (Follow UP)';
                                                        }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php
                                                        if($pData->department_id == 28){ $deptShortName = 'SW'; }
                                                        if($pData->department_id == 29){ $deptShortName = 'STRI'; }
                                                        if($pData->department_id == 30){ $deptShortName = 'SKY'; }
                                                        if($pData->department_id == 31){ $deptShortName = 'SLY'; }
                                                        if($pData->department_id == 32){ $deptShortName = 'BAL'; }
                                                        if($pData->department_id == 33){ $deptShortName = 'PK'; }
                                                        if($pData->department_id == 34){ $deptShortName = 'KC'; }
                                                        if($pData->department_id == 35){ $deptShortName = 'ATY'; }
                                                        echo $pData->firstname.' ('.$deptShortName.')';
                                                    ?>
                                                </th>
                                        <?php
                                                foreach($churnaMedicineName as $md):
                                                    //print_r($md->name);
                                                    
                                                    // if(stripos($tretment->RX1, $md->name) !== false){
                                                    //     //echo 'RX1   '.$tretment->RX1;
                                                    //     $str = $tretment->RX1;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX2, $md->name) !== false){
                                                    //     // echo 'RX2   '.$tretment->RX2;
                                                    //     $str = $tretment->RX2;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX3, $md->name) !== false){
                                                    //     // echo 'RX3   '.$tretment->RX3;
                                                    //     $str = $tretment->RX3;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //     // echo 'RX4   '.$tretment->RX4;
                                                    //     $str = $tretment->RX4;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //     // echo 'RX5   '.$tretment->RX5;
                                                    //     $str = $tretment->RX5;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count-1;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    
                                                    
                                                    if(stripos($tretment->RX1, $md->name) !== false){
                                                        ///////echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX1;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        //print_r("<br>");
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                //print_r($ar1[$ar1_count - 1]);
                                                                //print_r("<br>");
                                                                if($md->status == 1){
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ///////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        $tabletCount = $tabletCount + 1;
                                                    }
                                                    elseif(stripos($tretment->RX2, $md->name) !== false){
                                                        ///////echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX2;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        //print_r("<br>");
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                //print_r($ar1);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                //print_r($ar1[$ar1_count - 1]);
                                                                //print_r("<br>");
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                                
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ///////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        $tabletCount = $tabletCount + 1;
                                                    }
                                                    elseif(stripos($tretment->RX3, $md->name) !== false){
                                                        ///////echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX3;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        //print_r("<br>");
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                //print_r($ar1);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                //print_r($ar1[$ar1_count - 1]);
                                                                //print_r("<br>");
                                                                if($md->status == 1){
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                        
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ///////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        $tabletCount = $tabletCount + 1;
                                                    }
                                                    
                                                    ///////RX4 & RX5 Only for IPD
                                                    // elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //     ///////echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //     $str = $tretment->RX4;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                    //     //print_r("<br>");
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             //print_r($ar1);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             //print_r($ar1[$ar1_count - 1]);
                                                    //             //print_r("<br>");
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                    //                 $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     ///////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar1[$ar1_count - 1];
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar2[0]);
                                                    //                 $gCheck = preg_match("/g/", $ar2[0]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     ///////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar2[0];
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                                        
                                                    //                     $mgCheck = preg_match("/mg/", $arry[$i]);
                                                    //                     $gCheck = preg_match("/g/", $arry[$i]);
                                                    //                     $tempChurnaVal = 0;
                                                    //                     if($mgCheck == 1){
                                                    //                         $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                         ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                    //                     elseif($gCheck == 1){
                                                    //                         $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = $gVal[0];
                                                    //                         ///////print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                                        
                                                    //                     $c1 = $c1 + $tempChurnaVal;
                                                    //                 }else{
                                                    //                     $c1 = $c1 + $arry[$i];
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                        
                                                    //     $tabletCount = $tabletCount + 1;
                                                    // }
                                                    // elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //     //////echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //     $str = $tretment->RX5;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                    //     //print_r("<br>");
                                                    //     for($i=0;$i<$count-1;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             //print_r($ar1);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             //print_r($ar1[$ar1_count - 1]);
                                                    //             //print_r("<br>");
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                    //                 $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     //////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     //////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar1[$ar1_count - 1];
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar2[0]);
                                                    //                 $gCheck = preg_match("/g/", $ar2[0]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     //////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     //////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar2[0];
                                                    //             }
                                                                
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                                        
                                                    //                     $mgCheck = preg_match("/mg/", $arry[$i]);
                                                    //                     $gCheck = preg_match("/g/", $arry[$i]);
                                                    //                     $tempChurnaVal = 0;
                                                    //                     if($mgCheck == 1){
                                                    //                         $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                         //////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                    //                     elseif($gCheck == 1){
                                                    //                         $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = $gVal[0];
                                                    //                         //////print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                                        
                                                    //                     $c1 = $c1 + $tempChurnaVal;
                                                    //                 }else{
                                                    //                     $c1 = $c1 + $arry[$i];
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                        
                                                        
                                                    //     $tabletCount = $tabletCount + 1;
                                                    // }
                                                    
                                                    
                                        ?>
                                                    <?php $churnaTotalPerPatient = $c1*$tab_days; ?>
                                                    <td><?php if($churnaTotalPerPatient != 0){ ?><strong style='color:red;'><?php echo $churnaTotalPerPatient; ?></strong><?php }else{ ?><strong><?php echo '-'; //echo $churnaTotalPerPatient; ?></strong><?php }?></td>
                                                    <?php $c1=0; $tab_days=0;?>
                                        <?php
                                                endforeach;
                                            }
                                        ?>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div style="page-break-before: always;">
                            <div class="col-sm-12" align="center">
                                <?php if($section):?>
                                    <h3><strong><?php echo "Daily ".ucfirst($section)." Stock Despense Register"; ?></strong></h3>
                                <?php else: ?>
                                    <h3><strong><?php echo "Daily Stock Despense Register"; ?></strong></h3>
                                <?php endif;?>
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Tablet Despense Register"; ?></strong></h2>
                            </div>
                            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan='2' style="width: 30px;">Sr. No</th>
                                        <th rowspan='2' style="width: 30px;">OPD NO</th>
                                        <th rowspan='2' style="width: 30px;">Name</th>
                                        <?php
                                            $churnaColSpan=0;$tabColSpan=0;
                                            foreach($tabletMedicineName as $md):
                                                if($md->status == 2):
                                                    $tabColSpan = $tabColSpan + 1;
                                                endif;
                                            endforeach;
                                        ?>
                                        <th colspan=<?php echo $tabColSpan;?> style='text-align: center;'> Tablet </th>
                                    </tr>
                                    <tr>
                                        <?php foreach($tabletMedicineName as $md): ;?>
                                            <th style="width: 30px;">
                                                <?php //echo $md->name; 
                                                    $words = explode(' ', $md->name);
                                                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];
                                                    // for($i=0;$i<strlen($words[0]);$i++){
                                                    //     echo $words[0][$i].'<br>';
                                                    // }
                                                ?>
                                            </th>
                                        <?php endforeach;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?//php print_r($patientData);?>
                                    <?php $pcount=0; foreach($patientData as $pData):?>
                                    <tr>
                                        <?php
                                            $che=trim($pData->dignosis);
                                            //print_r($che);
                                            
                                            $section_tret='opd';
                                            $len=strlen($che);
                                            $dd= substr($che,$len - 1);
                                            
                                            $str = $pData->dignosis;
                                            $arry=explode("-",$str);
                                            $t_c=count($arry);
                                            if($t_c=='2'){
                                                $dd1=substr($che, 0, -1);
                                                $new_str = trim($arry[0]);
                                                $p_dignosis = '%'.$new_str.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }else{
                                                $p_dignosis = '%'.$che.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }
                                            // if($pData->manual_status == 0){
                                            //     $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                            //             ->get('treatments1')
                                            //             ->row();
                                            // }
                                            
                                            if($pData->manual_status==0){
                                                if($pData->proxy_id){
                                                    $tretment=$this->db->select("*")
                                                        ->from('treatments1')
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('proxy_id',$pData->proxy_id)
                                                        ->where('department_id',$pData->department_id)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                                else{
                                                    $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('department_id',$pData->department_id)
                                                    ->where('ipd_opd ',$section_tret)
                                                    ->get()
                                                    ->row();  
                                                    // if(empty($tretment)){
                                                    //     $tretment=$this->db->select("*")
                                                    //         ->from('treatments1')
                                                    //         ->where('department_id',$pData->department_id)
                                                    //         ->where('ipd_opd',$pData->department_id)
                                                    //         ->get()
                                                    //         ->row();   
                                                    // }
                                                }
                                            }else{
                                                $tretment=$this->db->select("*")
                                                    ->from('manual_treatments')
                                                    ->where('patient_id_auto',$pData->id)
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('ipd_opd ',$section_tret)
                                                    ->get()
                                                    ->row();
                                            }
                                            
                                            //print_r($tretment);
                                            if($tretment){
                                        ?>
                                                <th><?php echo $pcount = $pcount+1;?></th>
                                                <th>
                                                    <?php 
                                                        if($pData->yearly_reg_no != '' || $pData->yearly_reg_no != NULL)
                                                        {
                                                            echo $pData->yearly_reg_no.' (New)';
                                                        }
                                                        if($pData->old_reg_no != '' || $pData->old_reg_no != NULL)
                                                        {
                                                            echo $pData->old_reg_no.' (Follow UP)';
                                                        }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php
                                                        if($pData->department_id == 28){ $deptShortName = 'SW'; }
                                                        if($pData->department_id == 29){ $deptShortName = 'STRI'; }
                                                        if($pData->department_id == 30){ $deptShortName = 'SKY'; }
                                                        if($pData->department_id == 31){ $deptShortName = 'SLY'; }
                                                        if($pData->department_id == 32){ $deptShortName = 'BAL'; }
                                                        if($pData->department_id == 33){ $deptShortName = 'PK'; }
                                                        if($pData->department_id == 34){ $deptShortName = 'KC'; }
                                                        if($pData->department_id == 35){ $deptShortName = 'ATY'; }
                                                        echo $pData->firstname.' ('.$deptShortName.')';
                                                    ?>
                                                </th>
                                        <?php
                                                foreach($tabletMedicineName as $md):
                                                    //print_r($md->name);
                                                    // if(stripos($tretment->RX1, $md->name) !== false){
                                                    //     //echo 'RX1   '.$tretment->RX1;
                                                    //     $str = $tretment->RX1;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX2, $md->name) !== false){
                                                    //     // echo 'RX2   '.$tretment->RX2;
                                                    //     $str = $tretment->RX2;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX3, $md->name) !== false){
                                                    //     // echo 'RX3   '.$tretment->RX3;
                                                    //     $str = $tretment->RX3;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //     // echo 'RX4   '.$tretment->RX4;
                                                    //     $str = $tretment->RX4;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    // elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //     // echo 'RX5   '.$tretment->RX5;
                                                    //     $str = $tretment->RX5;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                        
                                                    //     for($i=0;$i<$count-1;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                    //                 $c1 = intval($c1) + 1;
                                                    //             }else{
                                                    //                 $c1 = intval($c1) + intval($ar2[0]);
                                                    //             }
                                                                
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($arry[$i]);
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // }
                                                    
                                                    
                                                    if(stripos($tretment->RX1, $md->name) !== false){
                                                        ///////echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX1;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        //print_r("<br>");
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                //print_r($ar1[$ar1_count - 1]);
                                                                //print_r("<br>");
                                                                if($md->status == 1){
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ///////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        $tabletCount = $tabletCount + 1;
                                                    }
                                                    elseif(stripos($tretment->RX2, $md->name) !== false){
                                                        ///////echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX2;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        //print_r("<br>");
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                //print_r($ar1);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                //print_r($ar1[$ar1_count - 1]);
                                                                //print_r("<br>");
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                                
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ///////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        $tabletCount = $tabletCount + 1;
                                                    }
                                                    elseif(stripos($tretment->RX3, $md->name) !== false){
                                                        ///////echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX3;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        //print_r("<br>");
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                //print_r($ar1);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                //print_r($ar1[$ar1_count - 1]);
                                                                //print_r("<br>");
                                                                if($md->status == 1){
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                        
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ///////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ///////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        $tabletCount = $tabletCount + 1;
                                                    }
                                                    
                                                    
                                                    ///////RX4 & RX5 Only For IPD
                                                    // elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //     ///////echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //     $str = $tretment->RX4;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                    //     //print_r("<br>");
                                                        
                                                    //     for($i=0;$i<$count;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             //print_r($ar1);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             //print_r($ar1[$ar1_count - 1]);
                                                    //             //print_r("<br>");
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                    //                 $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     ///////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar1[$ar1_count - 1];
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar2[0]);
                                                    //                 $gCheck = preg_match("/g/", $ar2[0]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     ///////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar2[0];
                                                    //             }
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                                        
                                                    //                     $mgCheck = preg_match("/mg/", $arry[$i]);
                                                    //                     $gCheck = preg_match("/g/", $arry[$i]);
                                                    //                     $tempChurnaVal = 0;
                                                    //                     if($mgCheck == 1){
                                                    //                         $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                         ///////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                    //                     elseif($gCheck == 1){
                                                    //                         $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = $gVal[0];
                                                    //                         ///////print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                                        
                                                    //                     $c1 = $c1 + $tempChurnaVal;
                                                    //                 }else{
                                                    //                     $c1 = $c1 + $arry[$i];
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                        
                                                    //     $tabletCount = $tabletCount + 1;
                                                    // }
                                                    // elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //     //////echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //     $str = $tretment->RX5;
                                                    //     $arry=explode(" ",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     // print_r($arry);
                                                    //     $arry=explode("-",$str);
                                                    //     $count = count($arry);
                                                    //     //print_r($arry[$count-1]);
                                                    //     //print_r($arry);
                                                    //     //print_r("<br>");
                                                    //     for($i=0;$i<$count-1;$i++){
                                                    //         if($i==0){
                                                    //             $ar1 = explode(' ',$arry[$i]);
                                                    //             //print_r($ar1);
                                                    //             $ar1_count = count($ar1);
                                                    //             // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //             //print_r($ar1[$ar1_count - 1]);
                                                    //             //print_r("<br>");
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                    //                 $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     //////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     //////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar1[$ar1_count - 1];
                                                    //             }
                                                    //         }
                                                    //         elseif($i==($count-1)){
                                                    //             $ar2 = explode(' ',$arry[$count-1]);
                                                    //             $ar2_count = count($ar2);
                                                    //             // array_push($tabletRoundArray, $ar2[0]);
                                                    //             if($md->status == 1){
                                                                    
                                                    //                 $mgCheck = preg_match("/mg/", $ar2[0]);
                                                    //                 $gCheck = preg_match("/g/", $ar2[0]);
                                                    //                 $tempChurnaVal = 0;
                                                    //                 if($mgCheck == 1){
                                                    //                     $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                     //////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                    //                 elseif($gCheck == 1){
                                                    //                     $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                    //                     $tempChurnaVal = $gVal[0];
                                                    //                     //////print_r($tempChurnaVal);print_r('<br>');
                                                    //                 }
                                                                    
                                                    //                 $c1 = $c1 + $tempChurnaVal;
                                                    //             }else{
                                                    //                 $c1 = $c1 + $ar2[0];
                                                    //             }
                                                                
                                                                
                                                    //             //print_r($ar2);
                                                                
                                                    //             for($j=$ar2_count;$j>0;$j--){
                                                    //                 if($ar2[$j]!=''){
                                                    //                     $ex = explode('D',$ar2[$j]);
                                                    //                     $tab_days = $ex[0];
                                                    //                     //print_r($tab_days);
                                                    //                     break;
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         else{
                                                    //             if($arry[$i] != ''){
                                                    //                 // array_push($tabletRoundArray, $arry[$i]);
                                                    //                 if($md->status == 1){
                                                                        
                                                    //                     $mgCheck = preg_match("/mg/", $arry[$i]);
                                                    //                     $gCheck = preg_match("/g/", $arry[$i]);
                                                    //                     $tempChurnaVal = 0;
                                                    //                     if($mgCheck == 1){
                                                    //                         $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                    //                         //////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                    //                     elseif($gCheck == 1){
                                                    //                         $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                    //                         $tempChurnaVal = $gVal[0];
                                                    //                         //////print_r($tempChurnaVal);print_r('<br>');
                                                    //                     }
                                                                        
                                                    //                     $c1 = $c1 + $tempChurnaVal;
                                                    //                 }else{
                                                    //                     $c1 = $c1 + $arry[$i];
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //     }
                                                        
                                                        
                                                    //     $tabletCount = $tabletCount + 1;
                                                    // }
                                                    
                                        ?>
                                                    <?php $tabletTotalPerPatient = $c1*$tab_days; ?>
                                                    <td><?php if($tabletTotalPerPatient != 0){ ?><strong style='color:red;'><?php echo $tabletTotalPerPatient; ?></strong><?php }else{ ?><strong><?php echo '-'; //echo $tabletTotalPerPatient; ?></strong><?php }?></td>
                                                    <?php $c1=0; $tab_days=0;?>
                                        <?php
                                                endforeach;
                                            }
                                        ?>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php elseif($section=='ipd'):?>
                        <div>
                            <div class="col-sm-12" align="center">
                                <?php if($section):?>
                                    <h3><strong><?php echo "Daily ".ucfirst($section)." Stock Despense Register"; ?></strong></h3>
                                <?php else: ?>
                                    <h3><strong><?php echo "Daily Stock Despense Register"; ?></strong></h3>
                                <?php endif;?>
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Churna Despense Register"; ?></strong></h2>
                            </div>
                            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan='2' style="width: 30px;">Sr. No</th>
                                        <th colspan='2' style="width: 10px;">OPD & IPD NO</th>
                                        <th rowspan='2' style="width: 30px;">Name</th>
                                        <?php
                                            $churnaColSpan=0;
                                            foreach($churnaMedicineName as $md):
                                                if($md->status == 1):
                                                    $churnaColSpan = $churnaColSpan + 1;
                                                endif;
                                            endforeach;
                                        ?>
                                        <th colspan=<?php echo $churnaColSpan;?> style='text-align: center;'> Churna </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 10px;">OPD No</th>
                                        <th style="width: 10px;">IPD No</th>
                                        <?php foreach($churnaMedicineName as $md):?>
                                            <th style="width: 30px;">
                                                <?php //echo $md->name; 
                                                    $words = explode(' ', $md->name);
                                                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];
                                                    // for($i=0;$i<strlen($words[0]);$i++){
                                                    //     echo $words[0][$i].'<br>';
                                                    // }
                                                ?>
                                            </th>
                                        <?php endforeach;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $pcount=0; foreach($disPatientData as $disPData):?>
                                        <tr>
                                            <?php
                                                $che=trim($disPData->dignosis);
                                                //print_r($che);
                                                $section_tret='ipd';
                                                $len=strlen($che);
                                                $dd= substr($che,$len - 1);
                                                
                                                $str = $disPData->dignosis;
                                                $arry=explode("-",$str);
                                                $t_c=count($arry);
                                                if($t_c=='2'){
                                                    $dd1=substr($che, 0, -1);
                                                    $new_str = trim($arry[0]);
                                                    $p_dignosis = '%'.$new_str.'%';
                                                    $p_dignosis_name=$disPData->dignosis;
                                                }else{
                                                    $p_dignosis = '%'.$che.'%';
                                                    $p_dignosis_name=$disPData->dignosis;
                                                }
                                                
                                                // if($disPData->manual_status==0){
                                                //     if($disPData->proxy_id){
                                                //         $tretment=$this->db->select("*")
                                                //             ->from('treatments1')
                                                //             ->where('dignosis LIKE',$p_dignosis)
                                                //             ->where('proxy_id',$disPData->proxy_id)
                                                //             ->where('department_id',$disPData->department_id)
                                                //             ->where('ipd_opd ',$section_tret)
                                                //             ->get()
                                                //             ->row();
                                                //     }
                                                // }else{
                                                //     $tretment=$this->db->select("*")
                                                //         ->from('manual_treatments')
                                                //         ->where('patient_id_auto',$disPData->id)
                                                //         ->where('dignosis LIKE',$p_dignosis)
                                                //         ->where('ipd_opd ',$section_tret)
                                                //         ->get()
                                                //         ->row();
                                                // }
                                                
                                                if($disPData->manual_status==0){
                                                    if($disPData->proxy_id){
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            ->where('proxy_id',$disPData->proxy_id)
                                                            ->where('department_id',$disPData->department_id)
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }else{
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            //////->where('proxy_id',$disPData->proxy_id)
                                                            ->where('department_id',$disPData->department_id)
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }
                                                }else{
                                                    $tretment=$this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$disPData->id)
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                                
                                                // patient ipd yearly no
                                            
                                                $ipd_no_date=date('Y-m-d',strtotime($disPData->create_date));
                                                $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                                $year122=date('Y',strtotime($disPData->create_date));
                                                $year2='%'.$year122.'%';
                                                
                                                $this->db->select('*');
                                                $this->db->where('ipd_opd', 'ipd');
                                                $this->db->where('id <', $disPData->id);
                                                // $this->db->where('create_date <=', $d_ipd_no);
                                                $this->db->where('create_date LIKE', $year2);
                                                $query = $this->db->get('patient_ipd');
                                                $num_ipd_change = $query->num_rows();
                                                $tot_serial_ipd_change=$num_ipd_change;
                                                $tot_serial_ipd_change++;
                                                
                                                if($tretment){
                                            ?>
                                                    <th style='color:#4dd208;'><?php echo $pcount = $pcount+1;?></th>
                                                    <th style='color:#4dd208;'>
                                                        <?php 
                                                            if($disPData->yearly_reg_no != '' || $disPData->yearly_reg_no != NULL)
                                                            {
                                                                echo $disPData->yearly_reg_no.' (New)';
                                                            }
                                                            if($disPData->old_reg_no != '' || $disPData->old_reg_no != NULL)
                                                            {
                                                                echo $disPData->old_reg_no.' (Follow UP)';
                                                            }
                                                        ?>
                                                    </th>
                                                    <th style='color:#4dd208;'>
                                                        <?php 
                                                            $currentYear = $this->session->userdata['acyear'];
                                                            if($disPData->ipd_opd == 'ipd'){
                                                                if($year122 < $currentYear){ 
                                                                    echo $disPData->patient_id; 
                                                                }else{ 
                                                                    echo $tot_serial_ipd_change++;  
                                                                } 
                                                            }
                                                        ?>
                                                    </th>
                                                    <th style='color:#4dd208;'>
                                                        <?php
                                                            if($disPData->department_id == 28){ $deptShortName = 'SW'; }
                                                            if($disPData->department_id == 29){ $deptShortName = 'STRI'; }
                                                            if($disPData->department_id == 30){ $deptShortName = 'SKY'; }
                                                            if($disPData->department_id == 31){ $deptShortName = 'SLY'; }
                                                            if($disPData->department_id == 32){ $deptShortName = 'BAL'; }
                                                            if($disPData->department_id == 33){ $deptShortName = 'PK'; }
                                                            if($disPData->department_id == 34){ $deptShortName = 'KC'; }
                                                            if($disPData->department_id == 35){ $deptShortName = 'ATY'; }
                                                            echo $disPData->firstname.' ('.$deptShortName.')';
                                                        ?>
                                                    </th>
                                            <?php
                                                    foreach($churnaMedicineName as $md):
                                                        if(stripos($tretment->DRX1, $md->name) !== false){
                                                            //echo 'DRX1   '.$tretment->DRX1;print_r("=====>");print_r($disPData->firstname);print_r('<br>');
                                                            $str = $tretment->DRX1;
                                                            $arry=explode(" ",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            // print_r($arry);
                                                            $arry=explode("-",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            //print_r($arry);
                                                            //print_r("<br>");
                                                            
                                                            for($i=0;$i<$count;$i++){
                                                                if($i==0){
                                                                    $ar1 = explode(' ',$arry[$i]);
                                                                    
                                                                    $ar1_count = count($ar1);
                                                                    // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                    //print_r($ar1[$ar1_count - 1]);
                                                                    //print_r("<br>");
                                                                    if($md->status == 1){
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
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar1[$ar1_count - 1];
                                                                    }
                                                                }
                                                                elseif($i==($count-1)){
                                                                    $ar2 = explode(' ',$arry[$count-1]);
                                                                    $ar2_count = count($ar2);
                                                                    // array_push($tabletRoundArray, $ar2[0]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                        $gCheck = preg_match("/g/", $ar2[0]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar2[0];
                                                                    }
                                                                    
                                                                    //print_r($ar2);
                                                                    
                                                                    for($j=$ar2_count;$j>0;$j--){
                                                                        if($ar2[$j]!=''){
                                                                            $ex = explode('D',$ar2[$j]);
                                                                            $tab_days1 = $ex[0];
                                                                            //print_r($tab_days1);
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    if($arry[$i] != ''){
                                                                        // array_push($tabletRoundArray, $arry[$i]);
                                                                        if($md->status == 1){
                                                                            
                                                                            $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                            $gCheck = preg_match("/g/", $arry[$i]);
                                                                            $tempChurnaVal = 0;
                                                                            if($mgCheck == 1){
                                                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            elseif($gCheck == 1){
                                                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = $gVal[0];
                                                                                //print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            
                                                                            $c2 = $c2 + $tempChurnaVal;
                                                                        }else{
                                                                            $c2 = $c2 + $arry[$i];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            $tabletCount = $tabletCount + 1;
                                                        }
                                                        elseif(stripos($tretment->DRX2, $md->name) !== false){
                                                            //echo 'DRX2   '.$tretment->DRX2;print_r("=====>");print_r($disPData->firstname);print_r('<br>');
                                                            $str = $tretment->DRX2;
                                                            $arry=explode(" ",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            // print_r($arry);
                                                            $arry=explode("-",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            //print_r($arry);
                                                            //print_r("<br>");
                                                            
                                                            for($i=0;$i<$count;$i++){
                                                                if($i==0){
                                                                    $ar1 = explode(' ',$arry[$i]);
                                                                    //print_r($ar1);
                                                                    $ar1_count = count($ar1);
                                                                    // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                    //print_r($ar1[$ar1_count - 1]);
                                                                    //print_r("<br>");
                                                                    if($md->status == 1){
                                                                        
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
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar1[$ar1_count - 1];
                                                                    }
                                                                    
                                                                }
                                                                elseif($i==($count-1)){
                                                                    $ar2 = explode(' ',$arry[$count-1]);
                                                                    $ar2_count = count($ar2);
                                                                    // array_push($tabletRoundArray, $ar2[0]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                        $gCheck = preg_match("/g/", $ar2[0]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar2[0];
                                                                    }
                                                                    
                                                                    //print_r($ar2);
                                                                    for($j=$ar2_count;$j>0;$j--){
                                                                        if($ar2[$j]!=''){
                                                                            $ex = explode('D',$ar2[$j]);
                                                                            $tab_days1 = $ex[0];
                                                                            //print_r($tab_days1);
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    if($arry[$i] != ''){
                                                                        // array_push($tabletRoundArray, $arry[$i]);
                                                                        if($md->status == 1){
                                                                            
                                                                            $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                            $gCheck = preg_match("/g/", $arry[$i]);
                                                                            $tempChurnaVal = 0;
                                                                            if($mgCheck == 1){
                                                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            elseif($gCheck == 1){
                                                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = $gVal[0];
                                                                                //print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            
                                                                            $c2 = $c2 + $tempChurnaVal;
                                                                        }else{
                                                                            $c2 = $c2 + $arry[$i];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            $tabletCount = $tabletCount + 1;
                                                        }
                                                        elseif(stripos($tretment->DRX3, $md->name) !== false){
                                                            //echo 'DRX3   '.$tretment->DRX3;print_r("=====>");print_r($disPData->firstname);print_r('<br>');
                                                            $str = $tretment->DRX3;
                                                            $arry=explode(" ",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            // print_r($arry);
                                                            $arry=explode("-",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            //print_r($arry);
                                                            //print_r("<br>");
                                                            
                                                            for($i=0;$i<$count;$i++){
                                                                if($i==0){
                                                                    $ar1 = explode(' ',$arry[$i]);
                                                                    //print_r($ar1);
                                                                    $ar1_count = count($ar1);
                                                                    // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                    //print_r($ar1[$ar1_count - 1]);
                                                                    //print_r("<br>");
                                                                    if($md->status == 1){
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
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                            
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar1[$ar1_count - 1];
                                                                    }
                                                                }
                                                                elseif($i==($count-1)){
                                                                    $ar2 = explode(' ',$arry[$count-1]);
                                                                    $ar2_count = count($ar2);
                                                                    // array_push($tabletRoundArray, $ar2[0]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                        $gCheck = preg_match("/g/", $ar2[0]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar2[0];
                                                                    }
                                                                    
                                                                    //print_r($ar2);
                                                                    
                                                                    for($j=$ar2_count;$j>0;$j--){
                                                                        if($ar2[$j]!=''){
                                                                            $ex = explode('D',$ar2[$j]);
                                                                            $tab_days1 = $ex[0];
                                                                            //print_r($tab_days1);
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    if($arry[$i] != ''){
                                                                        // array_push($tabletRoundArray, $arry[$i]);
                                                                        if($md->status == 1){
                                                                            
                                                                            $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                            $gCheck = preg_match("/g/", $arry[$i]);
                                                                            $tempChurnaVal = 0;
                                                                            if($mgCheck == 1){
                                                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            elseif($gCheck == 1){
                                                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = $gVal[0];
                                                                                //print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            
                                                                            $c2 = $c2 + $tempChurnaVal;
                                                                        }else{
                                                                            $c2 = $c2 + $arry[$i];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            $tabletCount = $tabletCount + 1;
                                                        }
                                            ?>
                                                    <?php $disChurnaTotalPerPatient = $c2*$tab_days1; ?>
                                                    <td><?php if($disChurnaTotalPerPatient != 0){ ?><strong style='color:#4dd208;'><?php echo $disChurnaTotalPerPatient; ?></strong><?php }else{ ?><strong><?php echo '-'; //echo $disChurnaTotalPerPatient; ?></strong><?php }?></td>
                                                    <?php $c2=0; $tab_days1=0;?>
                                            <?php
                                                    endforeach;
                                                }
                                            ?>
                                        </tr>
                                    <?php endforeach;?>
                                    
                                    <?php foreach($patientData as $pData):?>
                                    <tr>
                                        <?php
                                            $che=trim($pData->dignosis);
                                            //print_r($che);
                                            
                                            $section_tret='opd';
                                            $len=strlen($che);
                                            $dd= substr($che,$len - 1);
                                            
                                            $str = $pData->dignosis;
                                            $arry=explode("-",$str);
                                            $t_c=count($arry);
                                            if($t_c=='2'){
                                                $dd1=substr($che, 0, -1);
                                                $new_str = trim($arry[0]);
                                                $p_dignosis = '%'.$new_str.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }else{
                                                $p_dignosis = '%'.$che.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }
                                            
                                            ///////////// $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                            /////////////             ->get('treatments1')
                                            /////////////             ->row();
                                            ///////////// // $DISTRIBUTION_IPD=$tretment1->DISTRIBUTION_IPD; 
                                            ///////////// // $ipd_days=$tretment1->ipd_days; 
                                            ///////////// // $last_days=$ipd_days - $DISTRIBUTION_IPD;
                                            ///////////// // $DISTRIBUTION_IPD=$DISTRIBUTION_IPD - 1;
                                            ///////////// // if($pData->manual_status == 0){
                                            ///////////// //     $tretarray = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                            ///////////// //             ->get('treatments1')
                                            ///////////// //             ->result();
                                            ///////////// // }
                                            
                                            if($patient->manual_status==0){
                                                if($pData->proxy_id){
                                                    $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                                        ->get('treatments1')
                                                        ->row();
                                                }else{
                                                    $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'ipd_opd'=>$pData->ipd_opd])
                                                        ->get('treatments1')
                                                        ->row();
                                                }
                                            }else{
                                                $tretment=$this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$pData->id)
                                                        ->where('dignosis LIKE',$p_dignosis_name)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                            }
                                            
                                            $datefrom_n=date('Y-m-d',strtotime($datefrom));  
                                            $admit_date=date('Y-m-d',strtotime($pData->create_date));
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
                                            if($DISTRIBUTION_IPD < $n){
                                                if($patient->manual_status==0){
                                                    $section_tret='ipd';
                                                    // $tretarray=$this->db->select("*")
                                                    //     ->from('treatments1')
                                                    //     ->where('dignosis LIKE',$p_dignosis)
                                                    //     ->where('proxy_id',$patient->proxy_id)
                                                    //     ->where('department_id',$patient->department_id)
                                                    //     ->where('ipd_opd',$section_tret)
                                                    //     ->get()->result();
                                                    
                                                    if($pData->proxy_id){
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis_name)
                                                            ->where('proxy_id',$pData->proxy_id)
                                                            ->where('department_id',$pData->department_id)
                                                            ->order_by("id", "desc")
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }
                                                    else{
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            ->where('department_id',$pData->department_id)
                                                            ->order_by("id", "desc")
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();  
                                                    
                                                        // if(empty($tretment)){
                                                        //     $tretment=$this->db->select("*")
                                                        //         ->from('treatments1')
                                                        //         ->where('department_id',$pData->department_id)
                                                        //         ->where('ipd_opd',$pData->department_id)
                                                        //         ->get()
                                                        //         ->row();   
                                                        // }
                                                    }
                                                }else{
                                                    $tretment=$this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$pData->id)
                                                        ->where('dignosis LIKE',$p_dignosis_name)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                            }
                                            
                                            // patient ipd yearly no
                                            
                                            $ipd_no_date=date('Y-m-d',strtotime($pData->create_date));
                                            $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                            $year122=date('Y',strtotime($pData->create_date));
                                            $year2='%'.$year122.'%';
                                            
                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', 'ipd');
                                            $this->db->where('id <', $pData->id);
                                            // $this->db->where('create_date <=', $d_ipd_no);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query = $this->db->get('patient_ipd');
                                            $num_ipd_change = $query->num_rows();
                                            $tot_serial_ipd_change=$num_ipd_change;
                                            $tot_serial_ipd_change++;
                                            
                                            
                                            //print_r($tretment);
                                            if($tretment){
                                        ?>
                                                <th><?php echo $pcount = $pcount+1;?></th>
                                                <th>
                                                    <?php 
                                                        if($pData->yearly_reg_no != '' || $pData->yearly_reg_no != NULL)
                                                        {
                                                            echo $pData->yearly_reg_no.' (New)';
                                                        }
                                                        if($pData->old_reg_no != '' || $pData->old_reg_no != NULL)
                                                        {
                                                            echo $pData->old_reg_no.' (Follow UP)';
                                                        }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php 
                                                        $currentYear = $this->session->userdata['acyear'];
                                                        if($pData->ipd_opd == 'ipd'){
                                                            if($year122 < $currentYear){ 
                                                                echo $pData->patient_id; 
                                                            }else{ 
                                                                echo $tot_serial_ipd_change++;  
                                                            } 
                                                        }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php
                                                        if($pData->department_id == 28){ $deptShortName = 'SW'; }
                                                        if($pData->department_id == 29){ $deptShortName = 'STRI'; }
                                                        if($pData->department_id == 30){ $deptShortName = 'SKY'; }
                                                        if($pData->department_id == 31){ $deptShortName = 'SLY'; }
                                                        if($pData->department_id == 32){ $deptShortName = 'BAL'; }
                                                        if($pData->department_id == 33){ $deptShortName = 'PK'; }
                                                        if($pData->department_id == 34){ $deptShortName = 'KC'; }
                                                        if($pData->department_id == 35){ $deptShortName = 'ATY'; }
                                                        echo $pData->firstname.' ('.$deptShortName.')';
                                                    ?>
                                                </th>
                                        <?php
                                                foreach($churnaMedicineName as $md):
                                                    $temp1 = 0;
                                                    // if(count($tretarray) >= 2){
                                                    //     foreach($tretarray as $tret){
                                                    //         $tretment=$this->db->select("*")
                                                    //             ->from('treatments1')
                                                    //             ->where('dignosis LIKE',$p_dignosis)
                                                    //             ->where('department_id',$pData->department_id)
                                                    //             ->where('ipd_opd',$pData->ipd_opd)
                                                    //             ->where('proxy_id',$pData->proxy_id)
                                                    //             ->where('id',$tret->id)
                                                    //             ->get()
                                                    //             ->row();
                                                                
                                                    //         if(stripos($tretment->RX1, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX1;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                                    
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX2, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX2;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX3, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX3;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX4;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX5;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count-1;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //     }
                                                    // }
                                                    // else{
                                                    //     $tretment=$this->db->select("*")
                                                    //         ->from('treatments1')
                                                    //         ->where('proxy_id',$pData->proxy_id)
                                                    //         ->where('department_id',$pData->department_id)
                                                    //         ->where('dignosis LIKE',$p_dignosis)
                                                    //         ->where('ipd_opd',$pData->ipd_opd)
                                                    //         ->order_by("id", "desc")
                                                    //         ->get()
                                                    //         ->row();
                                                    //     if(stripos($tretment->RX1, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX1;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX2, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX2;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX3, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX3;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX4;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX5;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count-1;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    // }
                                                    
                                                    if(stripos($tretment->RX1, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX1;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX2, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX2;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        /////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX3, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX3;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX4, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX4;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX5, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX5;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count-1;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ///////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    
                                        ?>
                                                <?php $churnaTotalPerPatient = $temp1; ?>
                                                <td><?php if($churnaTotalPerPatient != 0){ ?><strong style='color:red;'><?php echo $churnaTotalPerPatient; ?></strong><?php }else{ ?><strong><?php echo '-'; //echo $churnaTotalPerPatient; ?></strong><?php }?></td>
                                                <?php $c1=0;$temp1=0; //$tab_days=0;?>
                                        <?php
                                                endforeach;
                                            }
                                        ?>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <div style="page-break-before: always;">
                            <div class="col-sm-12" align="center">
                                <?php if($section):?>
                                    <h3><strong><?php echo "Daily ".ucfirst($section)." Stock Despense Register"; ?></strong></h3>
                                <?php else: ?>
                                    <h3><strong><?php echo "Daily Stock Despense Register"; ?></strong></h3>
                                <?php endif;?>
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Tablet Despense Register"; ?></strong></h2>
                            </div>
                            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan='2' style="width: 30px;">Sr. No</th>
                                        <th colspan='2' style="width: 10px;">OPD & IPD NO</th>
                                        <th rowspan='2' style="width: 30px;">Name</th>
                                        <?php
                                            $tabletColSpan=0;
                                            foreach($tabletMedicineName as $md):
                                                if($md->status == 2):
                                                    $tabletColSpan = $tabletColSpan + 1;
                                                endif;
                                            endforeach;
                                        ?>
                                        <th colspan=<?php echo $tabletColSpan;?> style='text-align: center;'> Tablet </th>
                                    </tr>
                                    <tr>
                                        <th style="width: 10px;">OPD No</th>
                                        <th style="width: 10px;">IPD No</th>
                                        <?php foreach($tabletMedicineName as $md):?>
                                            <th style="width: 30px;">
                                                <?php //echo $md->name; 
                                                    $words = explode(' ', $md->name);
                                                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];
                                                    // for($i=0;$i<strlen($words[0]);$i++){
                                                    //     echo $words[0][$i].'<br>';
                                                    // }
                                                ?>
                                            </th>
                                        <?php endforeach;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $pcount=0; foreach($disPatientData as $disPData):?>
                                        <tr>
                                            <?php
                                                $che=trim($disPData->dignosis);
                                                //print_r($che);
                                                $section_tret='ipd';
                                                $len=strlen($che);
                                                $dd= substr($che,$len - 1);
                                                
                                                $str = $disPData->dignosis;
                                                $arry=explode("-",$str);
                                                $t_c=count($arry);
                                                if($t_c=='2'){
                                                    $dd1=substr($che, 0, -1);
                                                    $new_str = trim($arry[0]);
                                                    $p_dignosis = '%'.$new_str.'%';
                                                    $p_dignosis_name=$disPData->dignosis;
                                                }else{
                                                    $p_dignosis = '%'.$che.'%';
                                                    $p_dignosis_name=$disPData->dignosis;
                                                }
                                                
                                                if($disPData->manual_status==0){
                                                    if($disPData->proxy_id){
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            ->where('proxy_id',$disPData->proxy_id)
                                                            ->where('department_id',$disPData->department_id)
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }else{
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            //->where('proxy_id',$disPData->proxy_id)
                                                            ->where('department_id',$disPData->department_id)
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }
                                                }else{
                                                    $tretment=$this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$disPData->id)
                                                        ->where('dignosis LIKE',$p_dignosis)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                                
                                                // patient ipd yearly no
                                            
                                                $ipd_no_date=date('Y-m-d',strtotime($disPData->create_date));
                                                $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                                $year122=date('Y',strtotime($disPData->create_date));
                                                $year2='%'.$year122.'%';
                                                
                                                $this->db->select('*');
                                                $this->db->where('ipd_opd', 'ipd');
                                                $this->db->where('id <', $disPData->id);
                                                // $this->db->where('create_date <=', $d_ipd_no);
                                                $this->db->where('create_date LIKE', $year2);
                                                $query = $this->db->get('patient_ipd');
                                                $num_ipd_change = $query->num_rows();
                                                $tot_serial_ipd_change=$num_ipd_change;
                                                $tot_serial_ipd_change++;
                                                
                                                if($tretment){
                                            ?>
                                                    <th style='color:#4dd208;'><?php echo $pcount = $pcount+1;?></th>
                                                    <th style='color:#4dd208;'>
                                                        <?php 
                                                            if($disPData->yearly_reg_no != '' || $disPData->yearly_reg_no != NULL)
                                                            {
                                                                echo $disPData->yearly_reg_no.' (New)';
                                                            }
                                                            if($disPData->old_reg_no != '' || $disPData->old_reg_no != NULL)
                                                            {
                                                                echo $disPData->old_reg_no.' (Follow UP)';
                                                            }
                                                        ?>
                                                    </th>
                                                    <th style='color:#4dd208;'>
                                                        <?php 
                                                            $currentYear = $this->session->userdata['acyear'];
                                                            if($disPData->ipd_opd == 'ipd'){
                                                                if($year122 < $currentYear){ 
                                                                    echo $disPData->patient_id; 
                                                                }else{ 
                                                                    echo $tot_serial_ipd_change++;  
                                                                } 
                                                            }
                                                        ?>
                                                    </th>
                                                    <th style='color:#4dd208;'>
                                                        <?php
                                                            if($disPData->department_id == 28){ $deptShortName = 'SW'; }
                                                            if($disPData->department_id == 29){ $deptShortName = 'STRI'; }
                                                            if($disPData->department_id == 30){ $deptShortName = 'SKY'; }
                                                            if($disPData->department_id == 31){ $deptShortName = 'SLY'; }
                                                            if($disPData->department_id == 32){ $deptShortName = 'BAL'; }
                                                            if($disPData->department_id == 33){ $deptShortName = 'PK'; }
                                                            if($disPData->department_id == 34){ $deptShortName = 'KC'; }
                                                            if($disPData->department_id == 35){ $deptShortName = 'ATY'; }
                                                            echo $disPData->firstname.' ('.$deptShortName.')';
                                                        ?>
                                                    </th>
                                            <?php
                                                    foreach($tabletMedicineName as $md):
                                                        if(stripos($tretment->DRX1, $md->name) !== false){
                                                            //echo 'DRX1   '.$tretment->DRX1;print_r("=====>");print_r($disPData->firstname);print_r('<br>');
                                                            $str = $tretment->DRX1;
                                                            $arry=explode(" ",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            // print_r($arry);
                                                            $arry=explode("-",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            //print_r($arry);
                                                            //print_r("<br>");
                                                            
                                                            for($i=0;$i<$count;$i++){
                                                                if($i==0){
                                                                    $ar1 = explode(' ',$arry[$i]);
                                                                    
                                                                    $ar1_count = count($ar1);
                                                                    // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                    //print_r($ar1[$ar1_count - 1]);
                                                                    //print_r("<br>");
                                                                    if($md->status == 1){
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
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar1[$ar1_count - 1];
                                                                    }
                                                                }
                                                                elseif($i==($count-1)){
                                                                    $ar2 = explode(' ',$arry[$count-1]);
                                                                    $ar2_count = count($ar2);
                                                                    // array_push($tabletRoundArray, $ar2[0]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                        $gCheck = preg_match("/g/", $ar2[0]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar2[0];
                                                                    }
                                                                    
                                                                    //print_r($ar2);
                                                                    
                                                                    for($j=$ar2_count;$j>0;$j--){
                                                                        if($ar2[$j]!=''){
                                                                            $ex = explode('D',$ar2[$j]);
                                                                            $tab_days1 = $ex[0];
                                                                            //print_r($tab_days1);
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    if($arry[$i] != ''){
                                                                        // array_push($tabletRoundArray, $arry[$i]);
                                                                        if($md->status == 1){
                                                                            
                                                                            $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                            $gCheck = preg_match("/g/", $arry[$i]);
                                                                            $tempChurnaVal = 0;
                                                                            if($mgCheck == 1){
                                                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            elseif($gCheck == 1){
                                                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = $gVal[0];
                                                                                //print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            
                                                                            $c2 = $c2 + $tempChurnaVal;
                                                                        }else{
                                                                            $c2 = $c2 + $arry[$i];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            $tabletCount = $tabletCount + 1;
                                                        }
                                                        elseif(stripos($tretment->DRX2, $md->name) !== false){
                                                            //echo 'DRX2   '.$tretment->DRX2;print_r("=====>");print_r($disPData->firstname);print_r('<br>');
                                                            $str = $tretment->DRX2;
                                                            $arry=explode(" ",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            // print_r($arry);
                                                            $arry=explode("-",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            //print_r($arry);
                                                            //print_r("<br>");
                                                            
                                                            for($i=0;$i<$count;$i++){
                                                                if($i==0){
                                                                    $ar1 = explode(' ',$arry[$i]);
                                                                    //print_r($ar1);
                                                                    $ar1_count = count($ar1);
                                                                    // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                    //print_r($ar1[$ar1_count - 1]);
                                                                    //print_r("<br>");
                                                                    if($md->status == 1){
                                                                        
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
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar1[$ar1_count - 1];
                                                                    }
                                                                    
                                                                }
                                                                elseif($i==($count-1)){
                                                                    $ar2 = explode(' ',$arry[$count-1]);
                                                                    $ar2_count = count($ar2);
                                                                    // array_push($tabletRoundArray, $ar2[0]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                        $gCheck = preg_match("/g/", $ar2[0]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar2[0];
                                                                    }
                                                                    
                                                                    //print_r($ar2);
                                                                    for($j=$ar2_count;$j>0;$j--){
                                                                        if($ar2[$j]!=''){
                                                                            $ex = explode('D',$ar2[$j]);
                                                                            $tab_days1 = $ex[0];
                                                                            //print_r($tab_days1);
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    if($arry[$i] != ''){
                                                                        // array_push($tabletRoundArray, $arry[$i]);
                                                                        if($md->status == 1){
                                                                            
                                                                            $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                            $gCheck = preg_match("/g/", $arry[$i]);
                                                                            $tempChurnaVal = 0;
                                                                            if($mgCheck == 1){
                                                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            elseif($gCheck == 1){
                                                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = $gVal[0];
                                                                                //print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            
                                                                            $c2 = $c2 + $tempChurnaVal;
                                                                        }else{
                                                                            $c2 = $c2 + $arry[$i];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            $tabletCount = $tabletCount + 1;
                                                        }
                                                        elseif(stripos($tretment->DRX3, $md->name) !== false){
                                                            //echo 'DRX3   '.$tretment->DRX3;print_r("=====>");print_r($disPData->firstname);print_r('<br>');
                                                            $str = $tretment->DRX3;
                                                            $arry=explode(" ",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            // print_r($arry);
                                                            $arry=explode("-",$str);
                                                            $count = count($arry);
                                                            //print_r($arry[$count-1]);
                                                            //print_r($arry);
                                                            //print_r("<br>");
                                                            
                                                            for($i=0;$i<$count;$i++){
                                                                if($i==0){
                                                                    $ar1 = explode(' ',$arry[$i]);
                                                                    //print_r($ar1);
                                                                    $ar1_count = count($ar1);
                                                                    // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                    //print_r($ar1[$ar1_count - 1]);
                                                                    //print_r("<br>");
                                                                    if($md->status == 1){
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
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                            
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar1[$ar1_count - 1];
                                                                    }
                                                                }
                                                                elseif($i==($count-1)){
                                                                    $ar2 = explode(' ',$arry[$count-1]);
                                                                    $ar2_count = count($ar2);
                                                                    // array_push($tabletRoundArray, $ar2[0]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                        $gCheck = preg_match("/g/", $ar2[0]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            //print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        
                                                                        $c2 = $c2 + $tempChurnaVal;
                                                                    }else{
                                                                        $c2 = $c2 + $ar2[0];
                                                                    }
                                                                    
                                                                    //print_r($ar2);
                                                                    
                                                                    for($j=$ar2_count;$j>0;$j--){
                                                                        if($ar2[$j]!=''){
                                                                            $ex = explode('D',$ar2[$j]);
                                                                            $tab_days1 = $ex[0];
                                                                            //print_r($tab_days1);
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                else{
                                                                    if($arry[$i] != ''){
                                                                        // array_push($tabletRoundArray, $arry[$i]);
                                                                        if($md->status == 1){
                                                                            
                                                                            $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                            $gCheck = preg_match("/g/", $arry[$i]);
                                                                            $tempChurnaVal = 0;
                                                                            if($mgCheck == 1){
                                                                                $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                                //print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            elseif($gCheck == 1){
                                                                                $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                                $tempChurnaVal = $gVal[0];
                                                                                //print_r($tempChurnaVal);print_r('<br>');
                                                                            }
                                                                            
                                                                            $c2 = $c2 + $tempChurnaVal;
                                                                        }else{
                                                                            $c2 = $c2 + $arry[$i];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                            $tabletCount = $tabletCount + 1;
                                                        }
                                            ?>
                                                    <?php $disTabletTotalPerPatient = $c2*$tab_days1; ?>
                                                    <td><?php if($disTabletTotalPerPatient != 0){ ?><strong style='color:#4dd208;'><?php echo $disTabletTotalPerPatient; ?></strong><?php }else{ ?><strong><?php echo '-'; //echo $disTabletTotalPerPatient; ?></strong><?php }?></td>
                                                    <?php $c2=0; $tab_days1=0;?>
                                            <?php
                                                    endforeach;
                                                }
                                            ?>
                                        </tr>
                                    <?php endforeach;?>
                                    
                                    <?php foreach($patientData as $pData):?>
                                    <tr>
                                        <?php
                                            $che=trim($pData->dignosis);
                                            //print_r($che);
                                            
                                            $section_tret='opd';
                                            $len=strlen($che);
                                            $dd= substr($che,$len - 1);
                                            
                                            $str = $pData->dignosis;
                                            $arry=explode("-",$str);
                                            $t_c=count($arry);
                                            if($t_c=='2'){
                                                $dd1=substr($che, 0, -1);
                                                $new_str = trim($arry[0]);
                                                $p_dignosis = '%'.$new_str.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }else{
                                                $p_dignosis = '%'.$che.'%';
                                                $p_dignosis_name=$pData->dignosis;
                                            }
                                            ////////////////// $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                            //////////////////             ->get('treatments1')
                                            //////////////////             ->row();
                                            ////////////////// // $DISTRIBUTION_IPD=$tretment1->DISTRIBUTION_IPD; 
                                            ////////////////// // $ipd_days=$tretment1->ipd_days; 
                                            ////////////////// // $last_days=$ipd_days - $DISTRIBUTION_IPD;
                                            ////////////////// // $DISTRIBUTION_IPD=$DISTRIBUTION_IPD - 1;
                                            ////////////////// // if($pData->manual_status == 0){
                                            ////////////////// //     $tretarray = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                            ////////////////// //             ->get('treatments1')
                                            ////////////////// //             ->result();
                                            ////////////////// // }
                                            
                                            if($patient->manual_status==0){
                                                if($pData->proxy_id){
                                                    $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'proxy_id'=>$pData->proxy_id, 'ipd_opd'=>$pData->ipd_opd])
                                                        ->get('treatments1')
                                                        ->row();
                                                }else{
                                                    $tretment = $this->db->where(['dignosis like'=>$p_dignosis, 'department_id'=>$pData->department_id, 'ipd_opd'=>$pData->ipd_opd])
                                                        ->get('treatments1')
                                                        ->row();
                                                }
                                            }else{
                                                $tretment=$this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$pData->id)
                                                        ->where('dignosis LIKE',$p_dignosis_name)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                            }
                                            
                                            $datefrom_n=date('Y-m-d',strtotime($datefrom));  
                                            $admit_date=date('Y-m-d',strtotime($pData->create_date));
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
                                            if($DISTRIBUTION_IPD < $n){
                                                if($patient->manual_status==0){
                                                    $section_tret='ipd';
                                                    // $tretarray=$this->db->select("*")
                                                    //     ->from('treatments1')
                                                    //     ->where('dignosis LIKE',$p_dignosis)
                                                    //     ->where('proxy_id',$patient->proxy_id)
                                                    //     ->where('department_id',$patient->department_id)
                                                    //     ->where('ipd_opd',$section_tret)
                                                    //     ->get()->result();
                                                    
                                                    if($pData->proxy_id){
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis_name)
                                                            ->where('proxy_id',$pData->proxy_id)
                                                            ->where('department_id',$pData->department_id)
                                                            ->order_by("id", "desc")
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();
                                                    }
                                                    else{
                                                        $tretment=$this->db->select("*")
                                                            ->from('treatments1')
                                                            ->where('dignosis LIKE',$p_dignosis)
                                                            ->where('department_id',$pData->department_id)
                                                            ->order_by("id", "desc")
                                                            ->where('ipd_opd ',$section_tret)
                                                            ->get()
                                                            ->row();  
                                                    
                                                        // if(empty($tretment)){
                                                        //     $tretment=$this->db->select("*")
                                                        //         ->from('treatments1')
                                                        //         ->where('department_id',$pData->department_id)
                                                        //         ->where('ipd_opd',$pData->department_id)
                                                        //         ->get()
                                                        //         ->row();   
                                                        // }
                                                    }
                                                }else{
                                                    $tretment=$this->db->select("*")
                                                        ->from('manual_treatments')
                                                        ->where('patient_id_auto',$pData->id)
                                                        ->where('dignosis LIKE',$p_dignosis_name)
                                                        ->where('ipd_opd ',$section_tret)
                                                        ->get()
                                                        ->row();
                                                }
                                            }
                                            
                                            // patient ipd yearly no
                                            
                                            $ipd_no_date=date('Y-m-d',strtotime($pData->create_date));
                                            $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                            $year122=date('Y',strtotime($pData->create_date));
                                            $year2='%'.$year122.'%';
                                            
                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', 'ipd');
                                            $this->db->where('id <', $pData->id);
                                            // $this->db->where('create_date <=', $d_ipd_no);
                                            $this->db->where('create_date LIKE', $year2);
                                            $query = $this->db->get('patient_ipd');
                                            $num_ipd_change = $query->num_rows();
                                            $tot_serial_ipd_change=$num_ipd_change;
                                            $tot_serial_ipd_change++;
                                            
                                            //print_r($tretment);
                                            if($tretment){
                                        ?>
                                                <th><?php echo $pcount = $pcount+1;?></th>
                                                <th>
                                                    <?php 
                                                        if($pData->yearly_reg_no != '' || $pData->yearly_reg_no != NULL)
                                                        {
                                                            echo $pData->yearly_reg_no.' (New)';
                                                        }
                                                        if($pData->old_reg_no != '' || $pData->old_reg_no != NULL)
                                                        {
                                                            echo $pData->old_reg_no.' (Follow UP)';
                                                        }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php 
                                                        $currentYear = $this->session->userdata['acyear'];
                                                        if($pData->ipd_opd == 'ipd'){
                                                            if($year122 < $currentYear){ 
                                                                echo $pData->patient_id; 
                                                            }else{ 
                                                                echo $tot_serial_ipd_change++;  
                                                            } 
                                                        }
                                                    ?>
                                                </th>
                                                <th>
                                                    <?php
                                                        if($pData->department_id == 28){ $deptShortName = 'SW'; }
                                                        if($pData->department_id == 29){ $deptShortName = 'STRI'; }
                                                        if($pData->department_id == 30){ $deptShortName = 'SKY'; }
                                                        if($pData->department_id == 31){ $deptShortName = 'SLY'; }
                                                        if($pData->department_id == 32){ $deptShortName = 'BAL'; }
                                                        if($pData->department_id == 33){ $deptShortName = 'PK'; }
                                                        if($pData->department_id == 34){ $deptShortName = 'KC'; }
                                                        if($pData->department_id == 35){ $deptShortName = 'ATY'; }
                                                        echo $pData->firstname.' ('.$deptShortName.')';
                                                    ?>
                                                </th>
                                        <?php
                                                foreach($tabletMedicineName as $md):
                                                    $temp1 = 0;
                                                    // if(count($tretarray) >= 2){
                                                    //     foreach($tretarray as $tret){
                                                    //         $tretment=$this->db->select("*")
                                                    //             ->from('treatments1')
                                                    //             ->where('dignosis LIKE',$p_dignosis)
                                                    //             ->where('department_id',$pData->department_id)
                                                    //             ->where('ipd_opd',$pData->ipd_opd)
                                                    //             ->where('proxy_id',$pData->proxy_id)
                                                    //             ->where('id',$tret->id)
                                                    //             ->get()
                                                    //             ->row();
                                                                
                                                    //         if(stripos($tretment->RX1, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX1;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                                    
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX2, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX2;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX3, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX3;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX4;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //         elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //             //print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //             //echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //             $str = $tretment->RX5;
                                                    //             $arry=explode(" ",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             // print_r($arry);
                                                    //             $arry=explode("-",$str);
                                                    //             $count = count($arry);
                                                    //             //print_r($arry[$count-1]);
                                                    //             //print_r($arry);
                                                                
                                                    //             for($i=0;$i<$count-1;$i++){
                                                    //                 if($i==0){
                                                    //                     $ar1 = explode(' ',$arry[$i]);
                                                    //                     $ar1_count = count($ar1);
                                                    //                     // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                     }
                                                    //                 }
                                                    //                 elseif($i==($count-1)){
                                                    //                     $ar2 = explode(' ',$arry[$count-1]);
                                                    //                     $ar2_count = count($ar2);
                                                    //                     // array_push($tabletRoundArray, $ar2[0]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($ar2[0]);
                                                    //                     }
                                                                        
                                                                        
                                                    //                     //print_r($ar2);
                                                                        
                                                    //                     for($j=$ar2_count;$j>0;$j--){
                                                    //                         if($ar2[$j]!=''){
                                                    //                             $ex = explode('D',$ar2[$j]);
                                                    //                             $tab_days = $ex[0];
                                                    //                             //print_r($tab_days);
                                                    //                             break;
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //                 else{
                                                    //                     if($arry[$i] != ''){
                                                    //                         // array_push($tabletRoundArray, $arry[$i]);
                                                    //                         if($md->status == 1){
                                                    //                             $c1 = intval($c1) + 1;
                                                    //                         }else{
                                                    //                             $c1 = intval($c1) + intval($arry[$i]);
                                                    //                         }
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //             //print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //             //$tabletCount $tabletCount + 1;
                                                    //             $c1 = 0;
                                                    //         }
                                                    //     }
                                                    // }
                                                    // else{
                                                    //     $tretment=$this->db->select("*")
                                                    //         ->from('treatments1')
                                                    //         ->where('proxy_id',$pData->proxy_id)
                                                    //         ->where('department_id',$pData->department_id)
                                                    //         ->where('dignosis LIKE',$p_dignosis)
                                                    //         ->where('ipd_opd',$pData->ipd_opd)
                                                    //         ->order_by("id", "desc")
                                                    //         ->get()
                                                    //         ->row();
                                                    //     if(stripos($tretment->RX1, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX1;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX2, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX2;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX3, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX3;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX4, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX4;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    //     elseif(stripos($tretment->RX5, $md->name) !== false){
                                                    //         ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                    //         ////echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                    //         $str = $tretment->RX5;
                                                    //         $arry=explode(" ",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         // print_r($arry);
                                                    //         $arry=explode("-",$str);
                                                    //         $count = count($arry);
                                                    //         //print_r($arry[$count-1]);
                                                    //         //print_r($arry);
                                                            
                                                    //         for($i=0;$i<$count-1;$i++){
                                                    //             if($i==0){
                                                    //                 $ar1 = explode(' ',$arry[$i]);
                                                    //                 $ar1_count = count($ar1);
                                                    //                 // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar1[$ar1_count - 1]);
                                                    //                 }
                                                    //             }
                                                    //             elseif($i==($count-1)){
                                                    //                 $ar2 = explode(' ',$arry[$count-1]);
                                                    //                 $ar2_count = count($ar2);
                                                    //                 // array_push($tabletRoundArray, $ar2[0]);
                                                    //                 if($md->status == 1){
                                                    //                     $c1 = intval($c1) + 1;
                                                    //                 }else{
                                                    //                     $c1 = intval($c1) + intval($ar2[0]);
                                                    //                 }
                                                                    
                                                                    
                                                    //                 //print_r($ar2);
                                                                    
                                                    //                 for($j=$ar2_count;$j>0;$j--){
                                                    //                     if($ar2[$j]!=''){
                                                    //                         $ex = explode('D',$ar2[$j]);
                                                    //                         $tab_days = $ex[0];
                                                    //                         //print_r($tab_days);
                                                    //                         break;
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //             else{
                                                    //                 if($arry[$i] != ''){
                                                    //                     // array_push($tabletRoundArray, $arry[$i]);
                                                    //                     if($md->status == 1){
                                                    //                         $c1 = intval($c1) + 1;
                                                    //                     }else{
                                                    //                         $c1 = intval($c1) + intval($arry[$i]);
                                                    //                     }
                                                    //                 }
                                                    //             }
                                                    //         }
                                                    //         $temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                    //         ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                    //         //$tabletCount $tabletCount + 1;
                                                    //         $c1 = 0;
                                                    //     }
                                                    // }
                                                    
                                                    
                                                    if(stripos($tretment->RX1, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX1   '.$tretment->RX1;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX1;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX2, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX2   '.$tretment->RX2;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX2;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        /////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX3, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX3   '.$tretment->RX3;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX3;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX4, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX4   '.$tretment->RX4;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX4;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ////////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    elseif(stripos($tretment->RX5, $md->name) !== false){
                                                        ////print_r($tretment->DISTRIBUTION_IPD);print_r('<br>');
                                                        ////echo 'RX5   '.$tretment->RX5;print_r("=====>");print_r($patient->firstname);print_r('<br>');
                                                        $str = $tretment->RX5;
                                                        $arry=explode(" ",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        // print_r($arry);
                                                        $arry=explode("-",$str);
                                                        $count = count($arry);
                                                        //print_r($arry[$count-1]);
                                                        //print_r($arry);
                                                        
                                                        for($i=0;$i<$count-1;$i++){
                                                            if($i==0){
                                                                $ar1 = explode(' ',$arry[$i]);
                                                                $ar1_count = count($ar1);
                                                                // array_push($tabletRoundArray, $ar1[$ar1_count - 1]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar1[$ar1_count - 1]);
                                                                    $gCheck = preg_match("/g/", $ar1[$ar1_count - 1]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar1[$ar1_count - 1]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar1[$ar1_count - 1];
                                                                }
                                                            }
                                                            elseif($i==($count-1)){
                                                                $ar2 = explode(' ',$arry[$count-1]);
                                                                $ar2_count = count($ar2);
                                                                // array_push($tabletRoundArray, $ar2[0]);
                                                                if($md->status == 1){
                                                                    
                                                                    $mgCheck = preg_match("/mg/", $ar2[0]);
                                                                    $gCheck = preg_match("/g/", $ar2[0]);
                                                                    $tempChurnaVal = 0;
                                                                    if($mgCheck == 1){
                                                                        $mgVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                        ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                    elseif($gCheck == 1){
                                                                        $gVal = preg_split("/[(A-Z)(a-z)]/", $ar2[0]);
                                                                        $tempChurnaVal = $gVal[0];
                                                                        ////print_r($tempChurnaVal);print_r('<br>');
                                                                    }
                                                                
                                                                    $c1 = $c1 + $tempChurnaVal;
                                                                    
                                                                    //$c1 = intval($c1) + 1;
                                                                }else{
                                                                    $c1 = $c1 + $ar2[0];
                                                                }
                                                                
                                                                
                                                                //print_r($ar2);
                                                                
                                                                for($j=$ar2_count;$j>0;$j--){
                                                                    if($ar2[$j]!=''){
                                                                        $ex = explode('D',$ar2[$j]);
                                                                        $tab_days = $ex[0];
                                                                        //print_r($tab_days);
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            else{
                                                                if($arry[$i] != ''){
                                                                    // array_push($tabletRoundArray, $arry[$i]);
                                                                    if($md->status == 1){
                                                                        
                                                                        $mgCheck = preg_match("/mg/", $arry[$i]);
                                                                        $gCheck = preg_match("/g/", $arry[$i]);
                                                                        $tempChurnaVal = 0;
                                                                        if($mgCheck == 1){
                                                                            $mgVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = (int)$mgVal[0] / 1000;
                                                                            ////print_r($mgVal[0]);print_r('=======');print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                        elseif($gCheck == 1){
                                                                            $gVal = preg_split("/[(A-Z)(a-z)]/", $arry[$i]);
                                                                            $tempChurnaVal = $gVal[0];
                                                                            ////print_r($tempChurnaVal);print_r('<br>');
                                                                        }
                                                                    
                                                                        $c1 = $c1 + $tempChurnaVal;
                                                                        
                                                                        //$c1 = intval($c1) + 1;
                                                                    }else{
                                                                        $c1 = $c1 + $arry[$i];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        //$temp1 = (int)$temp1 + (int)$c1 * (int)$tretment->DISTRIBUTION_IPD;
                                                        
                                                        ///////////$temp1 = (int)$temp1 + (int)$c1;
                                                        $temp1 = $temp1 + $c1;
                                                        
                                                        ////print_r($temp1);print_r('====rrrrrrrr======');print_r('<br>');
                                                        //$tabletCount = $tabletCount + 1;
                                                        $c1 = 0;
                                                    }
                                                    
                                        ?>
                                                <?php $tabletTotalPerPatient = $temp1; ?>
                                                <td><?php if($tabletTotalPerPatient != 0){ ?><strong style='color:red;'><?php echo $tabletTotalPerPatient; ?></strong><?php }else{ ?><strong><?php echo '-'; //echo $tabletTotalPerPatient; ?></strong><?php }?></td>
                                                <?php $c1=0;$temp1=0; //$tab_days=0;?>
                                        <?php
                                                endforeach;
                                            }
                                        ?>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#reportType').on('change', function(){
        var type = $('#reportType').val();
        if(type=='d'){
            $('#startDate').show();
            $('#endDate').hide();
        }
        else if(type=='m'){
            $('#startDate').show();
            $('#endDate').show();
            $('#section').next(".select2-container").hide();
        }
        else if(type=='y'){
            $('#startDate').hide();
            $('#endDate').hide();
            $('#section').next(".select2-container").hide();
        }
    });
</script>
