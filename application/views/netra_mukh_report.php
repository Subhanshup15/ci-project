<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/netra_mukh_report_report'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  

<div class="form-group">

  <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
    <input type="hidden" name="netra" class="form-control" id="netra" value="<?php echo $netra; ?>">
  
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
 
 
                    
                   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Departmental Register of Out Patient Department Shalakyatantra(<?php if($netra =='N'){ echo "NETRA";}else{ echo "MUKH"; } ?>)</h3>
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

                        $male_new = 0;$male_old = 0;
                        $female_new = 0;$female_old = 0;

                        $male_new_0_5 = 0;$male_new_6_15 = 0;$male_new_16_45 = 0;$male_new_46_60 = 0;$male_new_60_above = 0;
                        $male_old_0_5 = 0;$male_old_6_15 = 0;$male_old_16_45 = 0;$male_old_46_60 = 0;$male_old_60_above = 0;
                        $female_new_0_5 = 0;$female_new_6_15 = 0;$female_new_16_45 = 0;$female_new_46_60 = 0;$female_new_60_above = 0;
                        $female_old_0_5 = 0;$female_old_6_15 = 0;$female_old_16_45 = 0;$female_old_46_60 = 0;$female_old_60_above = 0;

                        #echo count($patients);die();
                       
                        
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
                            ->from('department')
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
                                     ->where('skya',$netra)
                                     ->get()
                                     ->row();
                                      }
                                      else{
                                          
                                       $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                      ->where('department_id',$patient->department_id)
                                     ->where('ipd_opd ',$section_tret)
                                    ->where('skya',$netra)
                                     ->get()
                                     ->row();  
                                     
                                      if(empty($tretment)){
                                      $tretment=$this->db->select("*")
                                       ->from('treatments1')
                                      ->where('department_id',$patient->department_id)
			                          ->where('ipd_opd',$patient->department_id)
                                      ->where('skya',$netra)
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


                                  if($patient->yearly_reg_no && $patient->sex == M && $skya== $netra)
                                  {
                                    $male_new++;
                                  }
                                  if($patient->old_reg_no && $patient->sex == M && $skya== $netra)
                                  {
                                    $male_old++;
                                  }

                                  if($patient->yearly_reg_no && $patient->sex == F && $skya== $netra)
                                  {
                                    $female_new++;
                                  }
                                  if($patient->old_reg_no && $patient->sex == F && $skya== $netra)
                                  {
                                    $female_old++;
                                  }

                                //   ###
                                //     if($skya =='M'){

                                //         $mukha_cnt += 1;

                                //     }else{
                                //         $mukha_cnt += 0;
                                //     }
                                    
                                //     if($skya =='N'){

                                //         $netra_cnt += 1;
                                //     }else{
                                //          $netra_cnt += 0;
                                //     }

                                //   ##



                                  if($patient->yearly_reg_no!='' && $patient->sex == 'M' && $patient->date_of_birth <= 5 && $skya == $netra)
                                  {
                                        $male_new_0_5++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)
                                  {
                                    $male_new_6_15++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)
                                  {
                                    $male_new_16_45++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)
                                  {
                                    $male_new_46_60++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 61)
                                  {
                                    $male_new_60_above++;
                                  }


                                  if($patient->old_reg_no && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth <= 5)
                                  {
                                    $male_old_0_5++;
                                  }
                                  if($patient->old_reg_no && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)
                                  {
                                    $male_old_6_15++;
                                  }
                                  if($patient->old_reg_no && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)
                                  {
                                    $male_old_16_45++;
                                  }
                                  if($patient->old_reg_no && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)
                                  {
                                    $male_old_46_60++;
                                  }
                                  if($patient->old_reg_no && $patient->sex == 'M' && $skya== $netra && $patient->date_of_birth >= 61)
                                  {
                                    $male_old_60_above++;
                                  }


                                  



                                  if($patient->yearly_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth <= 5)
                                  {
                                    $female_new_0_5++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)
                                  {
                                    $female_new_6_15++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)
                                  {
                                    $female_new_16_45++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)
                                  {
                                    $female_new_46_60++;
                                  }
                                  if($patient->yearly_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 61)
                                  {
                                    $female_new_60_above++;
                                  }


                                  if($patient->old_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth <= 5)
                                  {
                                    $female_old_0_5++;
                                  }
                                  if($patient->old_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 6 && $patient->date_of_birth <= 15)
                                  {
                                    $female_old_6_15++;
                                  }
                                  if($patient->old_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 16 && $patient->date_of_birth <= 45)
                                  {
                                    $female_old_16_45++;
                                  }
                                  if($patient->old_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 46 && $patient->date_of_birth <= 60)
                                  {
                                    $female_old_46_60++;
                                  }
                                  if($patient->old_reg_no!='' && $patient->sex == 'F' && $skya== $netra && $patient->date_of_birth >= 61)
                                  {
                                    $female_old_60_above++;
                                  }


                                   if($tretment->skya == $netra)
                                   {




                            ?>
                        <tr>
                            <td><?php  echo  $netra_cnt = $mukha_netra_cnt_old_y + $i; ?></td>
                            <td><?php  echo  $netra_cnt_m = $mukha_netra_cnt_old_m + $i; ?></td>
                            <td><?php echo $i++; ?></td>
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
                        <?php }} ?>
                    </tbody>
                </table>

                <h3>Report Summary</h3>
                 <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th rowspan='3'>Sr. No.</th>
                    <th rowspan='3'>Name</th>
                    <th colspan='2'>Male</th>
                    <th colspan='2'>Female</th>
                    
                  </tr>
                  <tr>
                    <th colspan='2'><?php if($netra == 'N'){ echo "Netra"; }else{ echo "Mukh"; } ?></th>
                    <th colspan='2'><?php if($netra == 'N'){ echo "Netra"; }else{ echo "Mukh"; } ?></th>
                    
                  </tr>
                  <tr>
                    <th>New</th>
                     <th>Follow-Up</th>
                    <th>New</th>
                     <th>Follow-Up</th>
                
                  </tr>
                </thead>


              
         
              <tbody>
                  <tr>                    
                    <td>1</td>
                    <td>Shalakyatantra</td>
                    <td><?php echo  $male_new; ?></td>
                    <td><?php echo $male_old; ?></td>
                    <td><?php echo $female_new; ?></td>
                    <td><?php echo $female_old; ?></td>
                    
                  </tr>
                  <tr>
                    <td colspan='2'>Total</td> 
                    <td style="text-align: center;" colspan='2'><?php echo $total_male = $male_new + $male_old; ?></td>
                    <td style="text-align: center;" colspan='2'><?php echo $total_female = $female_new + $female_old; ?></td>
                  </tr>
                  <tr>
                    <td colspan='2'>Grand Total</td>
                    <td colspan='4' style="text-align: center;"><?php echo $total = $total_male +  $total_female; ?></td>
                  </tr>
                </tbody>
              </table>  










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
                    $male_new=array($male_new_0_5,$male_new_6_15,$male_new_16_45,$male_new_46_60,$male_new_60_above);
                    $male_old=array($male_old_0_5,$male_old_6_15,$male_old_16_45,$male_old_46_60,$male_old_60_above);
                    $female_new=array($female_new_0_5,$female_new_6_15,$female_new_16_45,$female_new_46_60,$female_new_60_above);
                    $female_old=array($female_old_0_5,$female_old_6_15,$female_old_16_45,$female_old_46_60,$female_old_60_above);

                  $total_male_new = array('0-5','05-15','15-45','45-60','60 Above');
?>
            
                  
                  <?php 
                  
                  
                  for($j=0;$j<count($total_male_new);$j++) {?>
                    <tr>
                      <td><?php echo $total_male_new[$j]; ?></td>
                      <td><?php echo $male_new[$j]; ?></td>
                      <td><?php echo $male_old[$j]; ?></td>
                      <td><?php echo $female_new[$j]; ?></td>
                      <td><?php echo $female_old[$j]; ?></td>
                    </tr>
                  <?php }  ?>
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

                </div>
            </div>
        </div>
    </div>
</div>



