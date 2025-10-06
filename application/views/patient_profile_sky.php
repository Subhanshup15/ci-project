<div class="row">

<?php $s= error_reporting(0); if($s) { echo "";}?>

    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>
                  <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/opd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
                
                <div class="btn-group"> 
               
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/opd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>
                
                <div class="btn-group"> 
                 
                   <!-- <a class="btn btn-success" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit"></i>Update Dignosis</a> -->
                     <!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i>Update Dignosis</button>-->
                </div>
                
                
                <div class="container">
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update Dignosis</h4>
                                </div>
                                <?php $id=$this->uri->segment(3);?>
                                <form action="<?= base_url('patients/UpdateDignosis') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="dignosis">Dignosis Name</label>
                                            <input type="text" name="dignosis" id="dignosis" placeholder="Dignosis" class="form-control">
                                            <input type="hidden" name="id" id="id"  value="<?php echo $id; ?>" class="form-control">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="submit" class="btn btn-primary">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                 <div class="btn-group" <?php if($profile->discharge_date =='0000-00-00')?>> 
                    <a class="btn btn-default" href="<?php echo base_url("patients/profile_bill/$id") ?>"> <i class="fa fa-list-alt"></i> Bill Receipt</a>   
                </div>

            </div> 
            
            
               <div class="panel-body">

                <div class="row">
                    <!--<div class="col-sm-12">  -->
                        <!--<div class="col-sm-2" align="center">-->
                        <!--    <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />-->
                        <!--</div>-->
                        <!--<div class="col-sm-8" align="center">-->
                        <!--    <strong><?php echo $this->session->userdata('title') ?></strong>-->
                        <!--    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>-->
                        <!--    <h1>OPD Case Paper</h1>-->
                        <!--</div>-->
                        <center>
                        <table style='width:100%;'>
                            <tr>
                                <td class='text-right' style="width:20%;"><img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" /></td>
                                <td class='text-center' style="width:90%;">
                                    <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                                    <h1>OPD Case Paper (Shalakya)</h1>
                                </td>
                            </tr>
                        </table>
                        </center>
                        <br>
                    <!--</div>-->
                    <?php  
                     $date_f1=date('Y',strtotime($profile->create_date));
                     $date_f2='%'.$date_f1.'%';
                    $opd_ipd_p=$this->db->select("*")

			                         ->from('patient_ipd')

			                          ->where('yearly_reg_no',$profile->yearly_reg_no)
			                         
			                         ->where('create_date LIKE',$date_f2)
                                     ->get()
                                     ->row();
                                     
                                      $New_OPD=$opd_ipd_p->yearly_reg_no;
                                     
                                        $che=trim($profile->dignosis);
                                        $section_tret='ipd';
                                        $len=strlen($che);
                                        $dd= substr($che,$len - 1);
                                        
                                        $str = $profile->dignosis;
                                        $arry=explode("-",$str);
                                        $t_c=count($arry);
                                        if($t_c=='2'){
                                        $dd1=substr($che, 0, -1);
                                        $new_str = trim($arry[0]);
                                        $p_dignosis = '%'.$new_str.'%';
                                        $p_dignosis_name=$profile->dignosis;
                                        }else{
                                        $p_dignosis = '%'.$che.'%';
                                        $p_dignosis_name=$profile->dignosis;
                                        }
                                      
                                      
                                      
                                    if($profile->manual_status==0){
                                        if($profile->proxy_id){
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$profile->proxy_id)
                                                ->where('department_id',$profile->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                        }
                                        else{
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$profile->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                            if(empty($tretment)){
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$profile->department_id)
                                                    ->where('ipd_opd',$profile->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$profile->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                  
                                  
                                     if($profile->sex=='M'){
                                         $ward='Male';
                                     }else if($profile->sex=='F'){
                                          $ward='Female';
                                     }else{
                                          $ward='';
                                     }
                    ?>
                <!--    <span style="float:right;color: #ff000d;background-color: #eae4e4;"><?php if($New_OPD) { echo "<b>Admit the Patient in IPD ". (!empty($profile->name)?$profile->name:null).' Department Ward No. '.$ward.'</b>';}?></span>-->
                    

                    <div class="col-md-12 col-lg-12 " > 
                        <table class="table" style="border: 1px solid #333;">
                        
                            <tr>
                                <td>बाह्यरुग्ण क्र.<br/>O.P.D.:</td>
                                <td>
                                <?php
                                
                               
                                
                                    // $temp_patient = $this->db->where('yearly_reg_no',$profile->yearly_reg_no)
                                    //             ->where('yearly_reg_no!=','')
                                    //             ->or_where('yearly_reg_no',$profile->old_reg_no)
                                    //             ->where('yearly_reg_no!=','')
                                    //             ->order_by('id','desc')->limit(1)->get('patient')->row();
 //   $year = $this->session->userdata['acyear'] ;
                                    $temp_patient = $this->db->where('id',$profile->id)
                                              //  ->limit(1)
                                                ->get('patient')
                                                ->row();
                                //   print_r($this->db->last_query());

                                    $y=date('Y',strtotime($temp_patient->create_date));
                                   if($y=='1970'){
                                       $yy=20;
                                   }else{
                                   $yy=substr($y,2,2);
                                   }
                                     if($temp_patient->yearly_reg_no != null){
                                        echo (!empty($temp_patient->yearly_reg_no)?$temp_patient->yearly_reg_no:null);
                                        echo ".".$yy."(New)";
                                    } else {
                                        echo (!empty($temp_patient->old_reg_no)?$temp_patient->old_reg_no:null);
                                        echo  ".".$yy."(Old)";
                                    }
                                
                                ?>
                                </td>
                                <td>दिनांक <br/> Date:</td>
                                <td><?php echo (!empty($temp_patient->create_date)?date('d-m-Y',strtotime($temp_patient->create_date)):null) ?></td>
                            </tr>
                            <tr>
                                <td>नाव :</td>
                                <td><?php echo (!empty($temp_patient->firstname)?$temp_patient->firstname:null) ?></td>
                                <td>स्त्री / पु :</td>
                                <td><?php echo (!empty($temp_patient->sex)?$temp_patient->sex:null) ?></td>
                            </tr>
                            <tr>
                            <td>वय :</td>
                                <td><?php echo (!empty($temp_patient->date_of_birth)?$temp_patient->date_of_birth:null) ?> Yr.</td>
                                <td>राहण्याचे ठिकाण :</td>
                                <td><?php echo (!empty($temp_patient->address)?$temp_patient->address:null) ?></td>
                                
                            </tr>
                            <tr>
                                <td>व्यवसाय :</td>
                                <td><?php if(!empty($temp_patient->occupation)){ echo $temp_patient->occupation; }else { echo "Other";}?></td>  
                                <td>व्याधिनाम :</td>
                                <td><?php echo $temp_patient->dignosis;?></td>
                            </tr>
                            <tr>
                                <td>विभाग :</td>
                                <td><?php if($temp_patient->department_id != null) {
                                    $department = $this->db->where('dprt_id',$temp_patient->department_id)->get('department')->row();
                                    echo (!empty($department->name)?$department->name:null);
                                } ?></td> 
                                
                                <?php $a1=rand(25,44); ?>
                                <td>वजन  :</td>
                                <td><?php if($temp_patient->wieght) {  echo  $temp_patient->wieght;} else { echo $a1; }?>   kg.</td> <br>
                            </tr>
                            <tr>
                                <td>Contact  :</td>
                                <td><?php if($temp_patient->phone) {  echo  $temp_patient->phone;} else { echo $temp_patient->phone; }?> </td> 
                            </tr>
                        </table>
                    </div>

                </div>
                
                  <!-- <hr style="border-color: brown;">-->
                  <?php
                   $pr =array(12,3,6,9);
                   $pr1=array_rand($pr);
	               $pr[$pr1];
	               
                    $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   if($profile->old_reg_no){
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->old_reg_no)
			                         //->where('create_date like',$current_Y1)
			                         ->where('create_date <= ',date('Y-m-d',strtotime($profile->create_date)))
			                         ->where('ipd_opd ','opd')
			                         ->order_by('id','DESC')
                                     ->get()
                                     ->row();
                   } else {
                        $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('yearly_reg_no',$profile->yearly_reg_no)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                   }
                 $f_date= $adv_date->create_date;
                 $new = $adv_date->yearly_reg_no;
           
              if($f_date && $new){?>
              
              
              <?php 
              $che=trim($adv_date->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $adv_date->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }
                                      
                                      $ss=date('Y-m-d',strtotime($adv_date->create_date));
                                  
                                      
                                    if($adv_date->manual_status==0){
                                        if($adv_date->proxy_id){
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$adv_date->proxy_id)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                        }
                                        else{
                                            $tretment=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                            if(empty($tretment)){
                                                $tretment=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$adv_date->department_id)
                                                    ->where('ipd_opd',$adv_date->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
                                    if($adv_date->manual_status=='1' || $adv_date->created_by =='1' || $adv_date->created_by =='2')
                                    {
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
                                    $RX1_new= $tretment->RX1;
			                      $RX2_new= $tretment->RX2;
			                      $RX3_new= $tretment->RX3;
			                      $RX4_new= $tretment->RX4;
			                      $RX5_new= $tretment->RX5;
			                      
			                      $RX_other_new= $tretment->RX_other;
			                      $RX_other1_new= $tretment->RX_other1;
			                      $other_equipment= $tretment->other_equipment;
			                      
			                      $SNEHAN_new= $tretment->SNEHAN;
			                      $SWEDAN_new= $tretment->SWEDAN;
			                      $VAMAN_new= $tretment->VAMAN;
			                      
			                      $VIRECHAN_new= $tretment->VIRECHAN;
			                      $BASTI_new= $tretment->BASTI;
			                      $NASYA_new= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN_new= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI_new= $tretment->SHIRODHARA_SHIROBASTI;
			                      $SHIROBASTI_new= $tretment->SHIROBASTI;
			                      $OTHER_new= $tretment->OTHER;
			                      
			                      $UTTARBASTI_new= $tretment->UTTARBASTI;
			                      $YONIDHAVAN_new= $tretment->YONIDHAVAN;
			                      $YONIPICHU_new= $tretment->YONIPICHU;
			                      
			                      $SWA1_new= $tretment->SWA1;
			                      $SWA2_new= $tretment->SWA2;
			                      
			                      $HEMATOLOGICAL_new= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCA_newL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL_new= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL_new= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY_new= $tretment->X_RAY;
			                      $ECG_new= $tretment->ECG;
			                      $USG_new= $tretment->USG;
			                      
			                      $symptoms_new= $tretment->sym_name;
			                      $sym1_new= $tretment->sym1;
			                      $sym2_new= $tretment->sym2;
			                      $sym3_new= $tretment->sym3;
			                      
			                      $PHYSIOTHERAPY_new= $tretment->PHYSIOTHERAPY;
                                    ?>
              
              
            <div class="row">
                    <div class="col-lg-12">
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <td style="width: 25%;">
                                <p>वर्तमान लक्षणे
                                <b>(Complaints)</b> 
                                :</p>
                                </td>
                                <td><b><?php echo $tretment->sym_name; ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                <p>पूर्व व्याधी इतिहास
                                <b>(Past History)</b>
                                :</p>
                                </td>
                                <td><b><?php echo $tretment->PAST_HISTORY; ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table  table-hover table-striped" style="border:1px solid;">
                        <thead>
                            <tr>
                                <th>A)</th>
                                <th>नेत्र परीक्षण </th>
                                <th>दक्षिण नेत्र (RE)
                                </th>
                                <th>वाम नेत्र (LE)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>बाह्य नेत्र </th>
                                <th><?php echo $tretment->BAHYA_NETRA_RE;?></th>
                                <th><?php echo $tretment->BAHYA_NETRA_LE;?></th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>वर्त्म मंडळ(Eyelid)</th>
                                <th><?php echo $tretment->VARTMA_MANDAL_RE;?></th>
                                <th><?php echo $tretment->VARTMA_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>शुक्ल मंडळ (Scelera)</th>
                                <th><?php echo $tretment->SHUKL_MANDAL_RE;?></th>
                                <th><?php echo $tretment->SHUKL_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>कृष्ण मंडळ (Cornea)</th>
                                <th><?php echo $tretment->KRUSHNA_MANDAL_RE;?></th>
                                <th><?php echo $tretment->KRUSHNA_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>तारका मंडळ(Iris)</th>
                                <th><?php echo $tretment->TARKA_MANDAL_RE;?></th>
                                <th><?php echo $tretment->TARKA_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>6</th>
                                 <th>दृष्टी मंडळ (Pupil & Lens)</th>
                                 <th><?php echo $tretment->DRUSHTI_MANDAL_RE;?></th>
                                <th><?php echo $tretment->DRUSHTI_MANDAL_LE;?></th>
                            </tr>    
                            <tr>
                                <th>7</th>
                                 <th>पूर्व वेश्म (Anterior Chember)</th>
                                 <th><?php echo $tretment->PURV_VESHMA_RE;?></th>
                                <th><?php echo $tretment->PURV_VESHMA_LE;?></th>
                            </tr>
                            <tr>
                                <th>8</th>
                                  <th>अभिंग 	</th>
                                  <th><?php echo $tretment->ABHING_RE;?></th>
                                <th><?php echo $tretment->ABHING_LE;?></th>
                            </tr>  
                            <tr>
                                <th>9</th>
                                  <th>सभिंग 	</th>
                                  <th><?php echo $tretment->SABHING_RE;?></th>
                                <th><?php echo $tretment->SABHING_LE;?></th>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="page-break-before: always;">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>B)</th>
                            <th>अन्य परिक्षण </th>
                            <th></th>
                            <th>दक्षिण नेत्र (RE)</th>
                            <th>वाम नेत्र (LE)</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>BP</th>
                            <th><?php echo $tretment->bp; ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>IOP</th>
                            <th></th>
                            <th><?php echo $tretment->IOP_RE; ?></th>
                            <th><?php echo $tretment->IOP_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>GONISCOPY</th>
                            <th><?php echo $tretment->GONISCOPY; ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>C)</th>
                            <th>पटल परिक्षण </th>
                            <th>दक्षिण नेत्र (RE)
                            </th>
                            <th>वाम नेत्र (LE)
                            </th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>Pupil</th>
                            <th><?php echo $tretment->PUPIL_RE; ?></th>
                            <th><?php echo $tretment->PUPIL_LE; ?></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>Lens</th>
                            <th><?php echo $tretment->LENS_RE; ?></th>
                            <th><?php echo $tretment->LENS_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>OD</th>
                            <th><?php echo $tretment->OD_RE; ?></th>
                            <th><?php echo $tretment->OD_LE; ?></th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>CDR</th>
                            <th><?php echo $tretment->CDR_RE; ?></th>
                            <th><?php echo $tretment->CDR_LE; ?></th>
                        </tr>
                        <tr>
                            <th>5</th>
                            <th>Macula</th>
                            <th><?php echo $tretment->MACULA_RE; ?></th>
                            <th><?php echo $tretment->MACULA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>6</th>
                            <th>FR</th>
                            <th><?//php echo $tretment->MACULA_RE; ?></th>
                            <th><?//php echo $tretment->MACULA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>7</th>
                            <th>Blood Vessels</th>
                            <th><?php echo $tretment->BLOOD_VESSELS_RE; ?></th>
                            <th><?php echo $tretment->BLOOD_VESSELS_LE; ?></th>
                        </tr>
                        <tr>
                            <th>8</th>
                            <th>Peripheral Retina</th>
                            <th><?php echo $tretment->PERIPHERAL_RETINA_RE; ?></th>
                            <th><?php echo $tretment->PERIPHERAL_RETINA_LE; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>कर्ण/नासा/मुख परिक्षण :-</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>D)</th>
                            <th>कर्ण
                            </th>
                            
                            <th>दक्षिण कर्ण </th>
                            <th>वाम कर्ण </th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>बाह्य कर्ण </th>
                            <th><?php echo $tretment->BAHYA_KARN_RE; ?></th>
                            <th><?php echo $tretment->BAHYA_KARN_LE; ?></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>कर्ण कुहर  (EAC)</th>
                            <th><?php echo $tretment->KARN_KUHAR_RE; ?></th>
                            <th><?php echo $tretment->KARN_KUHAR_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>मध्य कर्ण (TM)</th>
                            <th><?php echo $tretment->MADHYA_KARNA_RE; ?></th>
                            <th><?php echo $tretment->MADHYA_KARNA_LE; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>E)</th>
                            <th>नासा
                            </th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>बाह्य नासिका 
                            </th>
                            <th><?php echo $tretment->BAHYA_NASIKA_RE; ?></th>
                            <th><?php echo $tretment->BAHYA_NASIKA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>नासागुहा  (Nasal Cavity)
                            </th>
                            <th><?php echo $tretment->NASAGUHA_RE; ?></th>
                            <th><?php echo $tretment->NASAGUHA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>श्लैष्मिक कला  (Mucous Membrane)
                            </th>
                            <th><?php echo $tretment->SHAILSHRIK_KALA_RE; ?></th>
                            <th><?php echo $tretment->SHAILSHRIK_KALA_LE; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="page-break-before: always;">
                    <div class="col-lg-6">
                        <h4>मुख </h4>
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <th>ओष्ठ  -</th>
                                <th><?php echo $tretment->OSHTH; ?></th>
                            </tr>
                            <tr>
                                <th>दंत  -</th>
                                <th><?php echo $tretment->DANT; ?></th>
                            </tr>
                            <tr>
                                <th>जिव्हा  -</th>
                                <th><?php echo $tretment->JIVHA; ?></th>
                            </tr>
                            <tr>
                                <th>तालु   -</th>
                                <th><?php echo $tretment->TALU; ?></th>
                            </tr>
                            <tr>
                                <th>गिलायू  -</th>
                                <th><?php echo $tretment->GILAYU; ?></th>
                            </tr>
                            <tr>
                                <th>गल शुंडीका   -</th>
                                <th><?php echo $tretment->GAL_SHUNDIKA; ?></th>
                            </tr>
                            <tr>
                                <th>कंठ  -</th>
                                <th><?php echo $tretment->KANTH; ?></th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4>शिर 	
                        </h4>
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <th>आकृती 
                                -</th>
                                <th><?php echo $tretment->AKRUTI; ?></th>
                            </tr>
                            <tr>
                                <th>कपालस्ठी 
                                -</th>
                                <th><?php echo $tretment->KAPALASTHI; ?></th>
                            </tr>
                            <tr>
                                <th>अन्य 

                                -</th>
                                <th><?php echo $tretment->OTHER_CKECKUP; ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            <div class="row">
                  <div class="col-lg-6" >
                      <div style="border:1px solid;">
                      <b>मूत्र ,रक्त  ,क्ष ,किरण परिक्षण </b>
                      </div>
                  </div>
                  <div class="col-lg-6" >
                      <div style="border:1px solid;">
                        <b>Adv :-</b><br><?php if($other_equipment) { echo '=> '.$other_equipment;echo "<br><br>";}?>
                        
                      </div>
                  </div>
              </div>
            <br>
            <div class="row">
                  <div class="col-lg-12">
                      <table class="table table-bordered" style="border:1px solid;">
                          <tr>
                              <th style="width: 50%;"><b>निदान  (Dignosis) :-
                              <?php echo $tretment->dignosis; ?>
                              </b></th>
                              <th><b>
                                  चिकित्सा  (Treatment) :-
                               <br> <b> RX - </b> 
                                        <?php if($RX1_new) {echo "<br>";echo "=>".$RX1_new;echo "<br>";}?><br>
                                        <?php if($RX2_new) { echo '=> '.$RX2_new;echo "<br>";}?><br>
                                        <?php if($RX3_new) { echo '=> '.$RX3_new;echo "<br><br>";}?>
                                        <?php if($RX4_new) { echo '=> '.$RX4_new;echo "<br><br>";}?>
                                        <?php if($RX5_new) { echo '=> '.$RX5_new;echo "<br><br>";}?>
                                        <?php if($RX_other_new) { echo '=> '.$RX_other_new;echo "<br><br>";}?>
                                        <?php if($RX_other1_new) { echo '=> '.$RX_other1_new;echo "<br><br>";}?>
                                        <?php if($other_equipment) { echo '=> '.$other_equipment;echo "<br><br>";}?>
                                       
                              </b></th>
                          </tr>
                      </table>
                  </div>
              </div>
                  <?php }?>
                  
                  <?php 
                        $this->db->select('*');
                	    $this->db->where('patient_id_auto',$profile->id);
                	    $last_opd_no = $this->db->get('manual_treatments');
                        $count = $last_opd_no->num_rows();
                        //print_r($count);
                  ?>
                  
                  <hr style="border-color: brown;">
         
                  <?php 
                   $current_Y=date('Y',strtotime($profile->create_date));
                   $current_Y1='%'.$current_Y.'%';
                   $current_date=date('Y-m-d',strtotime($profile->create_date));
                   
                    if($profile->old_reg_no){
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->old_reg_no)
                                     ->where('id >=',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                     $opd_no = $profile->old_reg_no." (Old)";
                   } else {
                   $adv_date=$this->db->select("*")

			                         ->from('patient')
                                     ->where('old_reg_no',$profile->yearly_reg_no)
                                     ->where('id >=',$profile->id)
			                         ->where('create_date like',$current_Y1)
			                         ->where('ipd_opd ','opd')
                                     ->get()
                                     ->row();
                      $opd_no = $profile->old_reg_no." (Old)";
                      
                     // $count= count($adv_date);
                     // print_r($adv_date);
                   }
                    $f_date= $adv_date->create_date;
                    $dignosis = $adv_date->dignosis;
                    //$profile->yearly_reg_no;
                    $old = $adv_date->old_reg_no;
                  
                  
           
              if($f_date && $old) {
                  
                  
                  
                     $che=trim($adv_date->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $adv_date->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                         
                                    //       if($t_c=='2'){
                                    //           // echo $dd;
                                              
                                    //             $dd1=substr($che, 0, -1);
                                    //         $p_dignosis = '%'.$arry[0].'%';
                                    //           trim($p_dignosis);
                                    //          $p_dignosis_name=$adv_date->dignosis;
                                    //   }else{
                                    //       //echo $dd;
                                           
                                    //         $p_dignosis = '%'.$che.'%';
                                    //         $p_dignosis_name=$adv_date->dignosis;
                                            
                                            
                                    //   }
                                    
                                        if($t_c=='2'){
                                            $dd1=substr($che, 0, -1);
                                            $new_str = trim($arry[0]);
                                            $p_dignosis = '%'.$new_str.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }else{
                                            $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$adv_date->dignosis;
                                        }
                                    
                                    if($adv_date->manual_status==0){
                                        if($adv_date->proxy_id){
                                            $tretment_old=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('proxy_id',$adv_date->proxy_id)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();
                                               
                                        }
                                        else{
                                            $tretment_old=$this->db->select("*")
                                                ->from('treatments1')
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('department_id',$adv_date->department_id)
                                                ->where('ipd_opd ',$section_tret)
                                                ->get()
                                                ->row();  
                                                 //print_r($this->db->last_query());
                                            if(empty($tretment_old)){
                                                $tretment_old=$this->db->select("*")
                                                    ->from('treatments1')
                                                    ->where('department_id',$adv_date->department_id)
                                                    ->where('ipd_opd',$adv_date->department_id)
                                                    ->get()
                                                    ->row();   
                                            }
                                        }
                                    }else{
                                        $tretment_old=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    if($adv_date->manual_status=='1' || $adv_date->created_by =='1' || $adv_date->created_by =='2')
                                    {
                                        $tretment_old=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$adv_date->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                         //   print_r($this->db->last_query());
                                    }
			                      
			                      $RX1_old= $tretment_old->RX1;
			                      $RX2_old= $tretment_old->RX2;
			                      $RX3_old= $tretment_old->RX3;
			                      $RX4_old= $tretment_old->RX4;
			                      $RX5_old= $tretment_old->RX5;
			                      
			                      
                                $RX_other_old = $tretment_old->RX_other;
                                $RX_other1_old = $tretment_old->RX_other1;
                                $other_equipment_old = $tretment_old->other_equipment;
			                      
			                      $SNEHAN_old= $tretment_old->SNEHAN;
			                      $SWEDAN_old= $tretment_old->SWEDAN;
			                      $VAMAN_old= $tretment_old->VAMAN;
			                      
			                      $VIRECHAN_old= $tretment_old->VIRECHAN;
			                      $BASTI_old= $tretment_old->BASTI;
			                      $NASYA_old= $tretment_old->NASYA;
			                      
			                      $RAKTAMOKSHAN_old= $tretment_old->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI_old= $tretment_old->SHIRODHARA_SHIROBASTI;
			                      $SHIROBASTI_old= $tretment_old->SHIROBASTI;
			                      $OTHER_old= $tretment_old->OTHER;
			                      
			                      $SWA1_old= $tretment_old->SWA1;
			                      $SWA2_old= $tretment_old->SWA2;
			                      
			                      $HEMATOLOGICAL_old= $tretment_old->HEMATOLOGICAL;
			                      $SEROLOGYCAL_old= $tretment_old->SEROLOGYCAL;
			                      $BIOCHEMICAL_old= $tretment_old->BIOCHEMICAL;
			                      $MICROBIOLOGICAL_old= $tretment_old->MICROBIOLOGICAL;
			                      
			                      $X_RAY_old= $tretment_old->X_RAY;
			                      $ECG_old= $tretment_old->ECG;
			                      $USG_old= $tretment_old->USG;
			                      $symptoms_old= $tretment_old->sym_name;
			                      
			                      $PHYSIOTHERAPY_old= $tretment_old->PHYSIOTHERAPY;
              ?>
                <div style="page-break-before: always;">
                    <br><br>
                    <b style="padding-left: 32px;background-color: #e8d8c4;">Follow up Date: <?php echo date('d-m-Y',strtotime($f_date));?><span>&emsp;</span>OPD No: <?php echo $old.' (Old)';?></b><br>
                    <b style="padding-left: 32px;background-color: #e8d8c4;">Diagnosis: <?php echo $tretment_old->dignosis;?></b>
                    
                    
                    
                    <div class="row">
                    <div class="col-lg-12">
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <td style="width: 25%;">
                                <p>वर्तमान लक्षणे
                                <b>(Complaints)</b> 
                                :</p>
                                </td>
                                <td><b><?php echo $tretment_old->sym_name; ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                <p>पूर्व व्याधी इतिहास
                                <b>(Past History)</b>
                                :</p>
                                </td>
                                <td><b><?php echo $tretment_old->PAST_HISTORY; ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table  table-hover table-striped" style="border:1px solid;">
                        <thead>
                            <tr>
                                <th>A)</th>
                                <th>नेत्र परीक्षण </th>
                                <th>दक्षिण नेत्र (RE)
                                </th>
                                <th>वाम नेत्र (LE)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>बाह्य नेत्र </th>
                                <th><?php echo $tretment_old->BAHYA_NETRA_RE;?></th>
                                <th><?php echo $tretment_old->BAHYA_NETRA_LE;?></th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>वर्त्म मंडळ(Eyelid)</th>
                                <th><?php echo $tretment_old->VARTMA_MANDAL_RE;?></th>
                                <th><?php echo $tretment_old->VARTMA_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>शुक्ल मंडळ (Scelera)</th>
                                <th><?php echo $tretment_old->SHUKL_MANDAL_RE;?></th>
                                <th><?php echo $tretment_old->SHUKL_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>कृष्ण मंडळ (Cornea)</th>
                                <th><?php echo $tretment_old->KRUSHNA_MANDAL_RE;?></th>
                                <th><?php echo $tretment_old->KRUSHNA_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>तारका मंडळ(Iris)</th>
                                <th><?php echo $tretment_old->TARKA_MANDAL_RE;?></th>
                                <th><?php echo $tretment_old->TARKA_MANDAL_LE;?></th>
                            </tr>
                            <tr>
                                <th>6</th>
                                 <th>दृष्टी मंडळ (Pupil & Lens)</th>
                                 <th><?php echo $tretment_old->DRUSHTI_MANDAL_RE;?></th>
                                <th><?php echo $tretment_old->DRUSHTI_MANDAL_LE;?></th>
                            </tr>    
                            <tr>
                                <th>7</th>
                                 <th>पूर्व वेश्म (Anterior Chember)</th>
                                 <th><?php echo $tretment_old->PURV_VESHMA_RE;?></th>
                                <th><?php echo $tretment_old->PURV_VESHMA_LE;?></th>
                            </tr>
                            <tr>
                                <th>8</th>
                                  <th>अभिंग 	</th>
                                  <th><?php echo $tretment_old->ABHING_RE;?></th>
                                <th><?php echo $tretment_old->ABHING_LE;?></th>
                            </tr>  
                            <tr>
                                <th>9</th>
                                  <th>सभिंग 	</th>
                                  <th><?php echo $tretment_old->SABHING_RE;?></th>
                                <th><?php echo $tretment_old->SABHING_LE;?></th>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="page-break-before: always;">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>B)</th>
                            <th>अन्य परिक्षण </th>
                            <th></th>
                            <th>दक्षिण नेत्र (RE)</th>
                            <th>वाम नेत्र (LE)</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>BP</th>
                            <th><?php echo $tretment_old->bp; ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>IOP</th>
                            <th></th>
                            <th><?php echo $tretment_old->IOP_RE; ?></th>
                            <th><?php echo $tretment_old->IOP_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>GONISCOPY</th>
                            <th><?php echo $tretment_old->GONISCOPY; ?></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>C)</th>
                            <th>पटल परिक्षण </th>
                            <th>दक्षिण नेत्र (RE)
                            </th>
                            <th>वाम नेत्र (LE)
                            </th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>Pupil</th>
                            <th><?php echo $tretment_old->PUPIL_RE; ?></th>
                            <th><?php echo $tretment_old->PUPIL_LE; ?></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>Lens</th>
                            <th><?php echo $tretment_old->LENS_RE; ?></th>
                            <th><?php echo $tretment_old->LENS_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>OD</th>
                            <th><?php echo $tretment_old->OD_RE; ?></th>
                            <th><?php echo $tretment_old->OD_LE; ?></th>
                        </tr>
                        <tr>
                            <th>4</th>
                            <th>CDR</th>
                            <th><?php echo $tretment_old->CDR_RE; ?></th>
                            <th><?php echo $tretment_old->CDR_LE; ?></th>
                        </tr>
                        <tr>
                            <th>5</th>
                            <th>Macula</th>
                            <th><?php echo $tretment_old->MACULA_RE; ?></th>
                            <th><?php echo $tretment_old->MACULA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>6</th>
                            <th>FR</th>
                            <th><?//php echo $tretment->MACULA_RE; ?></th>
                            <th><?//php echo $tretment->MACULA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>7</th>
                            <th>Blood Vessels</th>
                            <th><?php echo $tretment_old->BLOOD_VESSELS_RE; ?></th>
                            <th><?php echo $tretment_old->BLOOD_VESSELS_LE; ?></th>
                        </tr>
                        <tr>
                            <th>8</th>
                            <th>Peripheral Retina</th>
                            <th><?php echo $tretment_old->PERIPHERAL_RETINA_RE; ?></th>
                            <th><?php echo $tretment_old->PERIPHERAL_RETINA_LE; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>कर्ण/नासा/मुख परिक्षण :-</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>D)</th>
                            <th>कर्ण
                            </th>
                            
                            <th>दक्षिण कर्ण </th>
                            <th>वाम कर्ण </th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>बाह्य कर्ण </th>
                            <th><?php echo $tretment_old->BAHYA_KARN_RE; ?></th>
                            <th><?php echo $tretment_old->BAHYA_KARN_LE; ?></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>कर्ण कुहर  (EAC)</th>
                            <th><?php echo $tretment_old->KARN_KUHAR_RE; ?></th>
                            <th><?php echo $tretment_old->KARN_KUHAR_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>मध्य कर्ण (TM)</th>
                            <th><?php echo $tretment_old->MADHYA_KARNA_RE; ?></th>
                            <th><?php echo $tretment_old->MADHYA_KARNA_LE; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" style="border:1px solid;">
                        <tr>
                            <th>E)</th>
                            <th>नासा
                            </th>
                            
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>बाह्य नासिका 
                            </th>
                            <th><?php echo $tretment_old->BAHYA_NASIKA_RE; ?></th>
                            <th><?php echo $tretment_old->BAHYA_NASIKA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>2</th>
                            <th>नासागुहा  (Nasal Cavity)
                            </th>
                            <th><?php echo $tretment_old->NASAGUHA_RE; ?></th>
                            <th><?php echo $tretment_old->NASAGUHA_LE; ?></th>
                        </tr>
                        <tr>
                            <th>3</th>
                            <th>श्लैष्मिक कला  (Mucous Membrane)
                            </th>
                            <th><?php echo $tretment_old->SHAILSHRIK_KALA_RE; ?></th>
                            <th><?php echo $tretment_old->SHAILSHRIK_KALA_LE; ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row" style="page-break-before: always;">
                    <div class="col-lg-6">
                        <h4>मुख </h4>
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <th>ओष्ठ  -</th>
                                <th><?php echo $tretment_old->OSHTH; ?></th>
                            </tr>
                            <tr>
                                <th>दंत  -</th>
                                <th><?php echo $tretment_old->DANT; ?></th>
                            </tr>
                            <tr>
                                <th>जिव्हा  -</th>
                                <th><?php echo $tretment_old->JIVHA; ?></th>
                            </tr>
                            <tr>
                                <th>तालु   -</th>
                                <th><?php echo $tretment_old->TALU; ?></th>
                            </tr>
                            <tr>
                                <th>गिलायू  -</th>
                                <th><?php echo $tretment_old->GILAYU; ?></th>
                            </tr>
                            <tr>
                                <th>गल शुंडीका   -</th>
                                <th><?php echo $tretment_old->GAL_SHUNDIKA; ?></th>
                            </tr>
                            <tr>
                                <th>कंठ  -</th>
                                <th><?php echo $tretment_old->KANTH; ?></th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4>शिर 	
                        </h4>
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <th>आकृती 
                                -</th>
                                <th><?php echo $tretment_old->AKRUTI; ?></th>
                            </tr>
                            <tr>
                                <th>कपालाष्ठी
                                -</th>
                                <th><?php echo $tretment_old->KAPALASTHI; ?></th>
                            </tr>
                            <tr>
                                <th>अन्य 

                                -</th>
                                <th><?php echo $tretment_old->OTHER_CKECKUP; ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            <div class="row">
                  <div class="col-lg-6" >
                      <div style="border:1px solid;">
                      <b>मूत्र ,रक्त  ,क्ष ,किरण परिक्षण </b>
                      </div>
                  </div>
                  <div class="col-lg-6" >
                      <div style="border:1px solid;">
                        <b>Adv :-</b><br>
                        
                      </div>
                  </div>
              </div>
            <br>
            <div class="row">
                  <div class="col-lg-12">
                      <table class="table table-bordered" style="border:1px solid;">
                          <tr>
                              <th style="width: 50%;"><b>निदान  (Dignosis) :-
                              <?php echo $tretment_old->dignosis; ?>
                              </b></th>
                              <th><b>
                                  चिकित्सा  (Treatment) :-
                               <br> <b> RX - </b> 
                                        <?php if($RX1_old) {echo "<br>";echo "=>".$RX1_old;echo "<br>";}?><br>
                                        <?php if($RX2_old) { echo '=> '.$RX2_old;echo "<br>";}?><br>
                                        <?php if($RX3_old) { echo '=> '.$RX3_old;echo "<br><br>";}?>
                                        <?php if($RX4_old) { echo '=> '.$RX4_old;echo "<br><br>";}?>
                                        <?php if($RX5_old) { echo '=> '.$RX5_old;echo "<br><br>";}?>
                                        <?php if($RX_other_old) { echo '=> '.$RX_other_old;echo "<br><br>";}?>
                                        <?php if($RX_other1_old) { echo '=> '.$RX_other1_old;echo "<br><br>";}?>
                                        <?php if($other_equipment) { echo '=> '.$other_equipment;echo "<br><br>";}?>
                                       
                              </b></th>
                          </tr>
                      </table>
                  </div>
              </div>
                      
                      
                      
                 <hr style="border-color: brown;">
                </div>
                <?php }?>
               
              
            
            
            

            </div> 
            



</div>
</div>
</div>