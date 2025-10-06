<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('Patient_New/netra_mukh_report'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  

<div class="form-group">

  <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
    <input type="hidden" name="department_id" class="form-control" id="department_id" value="<?php echo $department_id; ?>">
  
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
 
 
                    
                   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Departmental Register of Out Patient Department Shalakyatantra(<?php if($department_id =='30'){ echo "NETRA";}else{ echo "MUKH"; } ?>)</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($start_date))  ?> To <?php echo date("d/m/Y", strtotime($end_date))  ?></h4>
                    
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" >
                    <thead >
                        <tr>
                            <th rowspan="2">Yearly No.</th>
                            <th rowspan="2">Monthly No.</th>
                            <th rowspan="2">Daily No.</th>
                            
                            <th colspan="2">COPD</th>
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Patient Name</th>
                            <th rowspan="2">Full Address</th>
                            <th rowspan="2">Age</th>
                            <th rowspan="2">Sex</th>
                            <th rowspan="2">Department</th>
                            <th rowspan="2">Dignosis (<?php if($netra =='N'){ echo "NETRA";}else{ echo "MUKH"; } ?>)</th>
                            <th rowspan="2">Treatment</th>
                            <th rowspan="2">Panchkarma</th>
                            <th rowspan="2">Investigation</th>
                            <th class="no-print">Action</th>
                        </tr>
                        <tr>
                            <th rowspan="2">New</th>
                            <th rowspan="2">Old</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;

                    


                        $netra_cnt = 0;
                        $netra_cnt_m = 0;
                        foreach($patients as $patient){ 



                            $dd=date('Y-m-d', strtotime( $patient->discharge_date));
                              
                             $dd12=date('Y-m-d', strtotime($_GET['end_date']));
                              if($_GET['end_date']){
                                  $dd1=date('Y-m-d', strtotime($_GET['end_date']));
                              }else{
                                 $dd1=date('Y-m-d');
                              }
                            $year = $this->session->userdata['acyear'];
                            $yy = date("y",strtotime($year));
                       
                             $dept_name = $this->db->select('*')
                            ->from('department_new')
                            ->where('dprt_id',$patient->department_id)
                            ->get()
                            ->row();

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
			                        //  ->where('dignosis LIKE',$p_dignosis)
			                        //  ->where('ipd_opd ',$section_tret)
                                     ->where('skya',$netra)
                                     ->get()
                                     ->row();
                                   }


                                   $SNEHAN= $tretment->SNEHAN;
			                     
			                      
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      $skya= $tretment->skya;
			                     
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;

                                  $RX_other = $tretment->RX_other;
			                      $RX_other1_medicine_name = $tretment->RX_other1_medicine_name;
			                      $other_equipment = $tretment->other_equipment ;

                                 
                                   




                            ?>
                        <tr>
                            <td><?php  echo  $netra_cnt = $mukha_netra_cnt_old_y + $i; ?></td>
                            <td><?php  echo  $netra_cnt_m = $mukha_netra_cnt_old_m + $i; ?></td>
                            <td><?php echo $i++; ?></td>
                           <td> <?php
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
                            <td><?php echo date("d-m-Y",strtotime($patient->create_date)); ?></td>
                            <td><?php echo $patient->firstname; ?></td>
                            <td><?php echo $patient->address; ?></td>
                            <td><?php echo $patient->date_of_birth; ?></td>
                            <td><?php echo $patient->sex; ?></td>
                            <td><?php echo $dept_name->name; ?></td>
                            <td><?php echo $patient->dignosis; ?></td>
                            <td><?php if($tretment->RX1){ echo $tretment->RX1.', <br>'; } ?>
                                <?php if($tretment->RX2){ echo $tretment->RX2.', <br>'; } ?>
                                <?php if($tretment->RX3){ echo $tretment->RX3.', <br>'; } ?>
                                <?php if($tretment->RX4){ echo $tretment->RX4.', <br>'; } ?>
                                <?php if($tretment->RX5){ echo $tretment->RX5.', <br>'; } ?>
                                <?php if($RX_other){ echo $RX_other.', <br>'; }?>
                                <?php if($RX_other1_medicine_name){ echo $RX_other1_medicine_name.', <br>'; }?>
                                <?php if($other_equipment){ echo $other_equipment; }?>
                                </td>
                            
                            <td>

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

                            </td>
                            <td>
                                <?php if($HEMATOLOGICAL){ echo $HEMATOLOGICAL.', <br>'; } ?>
                                <?php if($SEROLOGYCAL){ echo $SEROLOGYCAL.', <br>'; } ?>
                                <?php if($BIOCHEMICAL){ echo $BIOCHEMICAL.', <br>'; } ?>
                                <?php if($MICROBIOLOGICAL){ echo $MICROBIOLOGICAL.', <br>'; } ?>
                                <?php if($X_RAY){ echo $X_RAY.', <br>'; } ?>
                                <?php if($ECG){ echo $ECG.', <br>'; } ?>
                            </td>
                            <td class="no-print">
                                <a href="<?php echo base_url("patients/profile/$patient->id"); ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <h3>Report Summary</h3>
               <?php  $department_new =  $this->db->select('*')->from('department_new')->where('dprt_id',$department_id)->get()->row(); ?>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th rowspan='3'>Sr. No.</th>
                        <th rowspan='3'>Name</th>
                        <th colspan='2'>Male</th>
                        <th colspan='2'>Female</th>
                        <th colspan='2'>Total</th>

                        
                    </tr>
                    <tr>
                        <th colspan='2'><?php if($department_id == '30'){ echo "Netra"; }else{ echo "Mukh"; } ?></th>
                        <th colspan='2'><?php if($department_id == '30'){ echo "Netra"; }else{ echo "Mukh"; } ?></th>
                        
                    </tr>
                    <tr>
                        <th>New</th>
                        <th>Follow-Up</th>
                        <th>New</th>
                        <th>Follow-Up</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                    $total_male_new = 0;
                    $total_male_old = 0;
                    $total_female_new = 0;
                    $total_female_old = 0;

                
                        $male_new = $this->db->select('count(*) as male_new')->from('patient')->where('department_id', $department_id)->where('create_date', $start_date)->where('ipd_opd', 'opd')->where('sex', 'M')->where('yearly_reg_no !=', '')->get()->row();
                        // print_r($this->db->last_query());
                        $male_old = $this->db->select('count(*) as male_old')->from('patient')->where('department_id', $department_id)->where('create_date', $start_date)->where('ipd_opd', 'opd')->where('sex', 'M')->where('old_reg_no !=', '')->get()->row();
                        $female_new = $this->db->select('count(*) as female_new')->from('patient')->where('department_id', $department_id)->where('create_date', $start_date)->where('ipd_opd', 'opd')->where('sex', 'F')->where('yearly_reg_no !=', '')->get()->row();
                        $female_old = $this->db->select('count(*) as female_old')->from('patient')->where('department_id', $department_id)->where('create_date', $start_date)->where('ipd_opd', 'opd')->where('sex', 'F')->where('old_reg_no !=', '')->get()->row();

                        // Add to the total counts
                        $total_male_new += $male_new->male_new;
                        $total_male_old += $male_old->male_old;
                        $total_female_new += $female_new->female_new;
                        $total_female_old += $female_old->female_old;
                    ?>
                        <tr>
                            <td><?php echo $a++; ?></td>
                            <td><?php echo $department_new->name; ?></td>
                            <td><?php echo $male_new->male_new; ?></td>
                            <td><?php echo $male_old->male_old; ?></td>
                            <td><?php echo $female_new->female_new; ?></td>
                            <td><?php echo $female_old->female_old; ?></td>
                            <td><?php echo $male_new->male_new + $male_old->male_old + $female_new->female_new + $female_old->female_old; ?></td> <!-- Total per department -->
                        </tr>
                    
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
</div>



