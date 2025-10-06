<style>
    @import url('https://fonts.googleapis.com/css2?family=Khand&display=swap');
</style>
<div class="row">
    <?php echo error_reporting(0);?>
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  
                </div>
                
                <div class="btn-group"> 
                <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>
                
                <div class="btn-group"> 
                    <?php $id=$this->uri->segment(3);?>
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/ipd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
                
                <div class="btn-group"> 
                    <?php $id=$this->uri->segment(3);?>
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/ipd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>
                <div class="btn-group"> 
                    <?php $id=$this->uri->segment(3);?>
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check_LABORATORY/$id/ipd") ?>"> <i class="fa fa-edit"></i>update LABORATORY</a>   
                </div>
                <div class="btn-group">
                    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/discharge_patient_by_id'); ?>">
                        <input type="hidden" name="discharge_id" class="form-control" id="discharge_id" value="<?php echo $profile->id; ?>">    
                        <input type="hidden" name="bedno" class="form-control" id="bedno" value="<?php echo $profile->bedNo; ?>">    
                        <div class="form-group">
                            <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="discharge_date" class="form-control datepicker" id="discharge_date" placeholder="<?php echo display('discharge_date') ?>" required>
                        </div>  
                        <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
                    </form>
                </div>
                <div class="btn-group" <?php if($profile->discharge_date =='0000-00-00'){ echo "style='display: none;'";} else { echo "style='display: block;'";}?> > 
                    <a class="btn btn-default" href="<?php echo base_url("patients/ipdprofile_bill/$id") ?>"> <i class="fa fa-list-alt"></i> Bill Receipt</a>   
                </div>
            </div>
            
          
                <div class="row" style="page-break-after: always;border: groove;">
                  <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
                    <div class="col-xs-8" align="center">
                        <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                        <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                        <h1 style="border: inset;background-color: #f1f0ee;">IPD PATIENT FILE</h1>
                        <br>
                    </div>
                     <div class="col-xs-2"></div>
                     </div>
                     </div>
                    <div class="col-md-12 col-lg-12 "> 
                        <div class="container" style="width: 100%;">
                            <?php 
                            //print_r($profile);
                                //////////////////////////////////////////////////
                                
                                if($profile->yearly_reg_no){
                                   $year = '%'.$this->session->userdata['acyear'].'%';
                                    $opd_data =$this->db->select("*")
                                    
                                    ->from('patient')
                                    ->where('yearly_reg_no', $profile->yearly_reg_no) 
                                   // ->where('year(create_date)',$year)
                                    //->or_where('old_reg_no', $profile->old_reg_no) 
                                    ->order_by('id', 'DESC')
                                    ->get()
                                    ->row();
                                   // print_r($this->db->last_query());
                                    $wieght= $opd_data->wieght;
                                    $occupation = $opd_data->occupation;
                                    $address =$opd_data->address;
                                    $nadi=$opd_data->nadi;
                                    $givwa=$opd_data->givwa;
                                    $bp=$opd_data->bp;
                                    $mal=$opd_data->mal;
                                    $mutra=$opd_data->mutra;
                                    $ur=$opd_data->ur;
                                    $udar=$opd_data->udar;
                                    $pulse=$opd_data->pulse;
                                    $netra=$opd_data->netra;
                                    $sudha=$opd_data->shudha;
                                    $ahar=$opd_data->ahar;
                                    $mal=$opd_data->mal;
                                    $multa=$opd_data->mutra;
                                    $nidra=$opd_data->nidra;
                                
                                }else if($profile->old_reg_no){
                                    
                                    $opd_data =$this->db->select("*")
                                    ->from('patient')
                                    ->where('old_reg_no', $profile->old_reg_no) 
                                    // ->or_where('old_reg_no', $profile->yearly_reg_no) 
                                    ->get()
                                    ->row();
                                    $wieght= $opd_data->wieght;
                                    $occupation = $opd_data->occupation;
                                    $address =$opd_data->address;
                                    $nadi=$opd_data->nadi;
                                    $givwa=$opd_data->givwa;
                                    $bp=$opd_data->bp;
                                    $mal=$opd_data->mal;
                                    $mutra=$opd_data->mutra;
                                    $ur=$opd_data->ur;
                                    $udar=$opd_data->udar;
                                    $h_o=$opd_data->h_o;
                                    $f_h=$opd_data->f_h;
                                    $pulse=$opd_data->pulse;
                                    $netra=$opd_data->netra;
                                    $sudha=$opd_data->shudha;
                                    
                                    $ahar=$opd_data->ahar;
                                    $mal=$opd_data->mal;
                                    $multa=$opd_data->mutra;
                                    $nidra=$opd_data->nidra;
                                }
                                
                                //////////////////////////////////////////////////
                            
                                /////////// Start Set Doctor Name Code ///////////
                                
                                $datefrom1=date('Y-m-d',strtotime($profile->create_date));
                                $doctor_name= $this->db->select("*")
                                                ->from('user')
                                                //->where('join_date <=', $datefrom1) 
                                                ->where('department_id', $profile->department_id) 
                                                ->order_by("user_id", "desc")
                                                ->limit(1)
                                                ->get()
                                                ->row();
                                $doctor_name->firstname;
                                
                                if(empty($doctor_name)){
                                    $doctor_name= $this->db->select("*")
                                                    ->from('user')
                                                    ->where('department_id', $patient->department_id) 
                                                    ->get()
                                                    ->row();
                                }
                                //////////// End Set Doctor Name Code ////////////
                                
                                /////////// Start set IPD & D-IPD No code ///////////
                                
                                $ipd_no_date=date('Y-m-d',strtotime($profile->create_date));
                                $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                $year122=date('Y',strtotime($profile->create_date));
                                $year2='%'.$year122.'%';
                                
                                $year1222=substr($year122,2,2);
                                
                                
                                $this->db->select('*');
                                $this->db->where('ipd_opd', 'ipd');
                                $this->db->where('id <', $profile->id);
                                $this->db->where('create_date LIKE', $year2);
                                $query = $this->db->get('patient_ipd');
                                $num_ipd_change = $query->num_rows();
                                $tot_serial_ipd_change=$num_ipd_change;
                                $tot_serial_ipd_change++;
                                
                                $this->db->select('*');
                                $this->db->where('ipd_opd', 'ipd');
                                $this->db->where('id <', $profile->id);
                                $this->db->where('department_id =',$profile->department_id);
                                $this->db->where('create_date LIKE', $year2);
                                $query = $this->db->get('patient_ipd');
                                $num_Dipd_change = $query->num_rows();
                                $tot_serial_Dipd_change=$num_Dipd_change;
                                $tot_serial_Dipd_change++;
                                
                                //////////// End set IPD & D-IPD No code ////////////
                                
                                /////////////////////////////////////////////////////
                                
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
                                
                                $ss=date('Y-m-d',strtotime($profile->create_date));
                                
                                //echo $profile->proxy_id;
                                if($profile->manual_status==0){
                                    $tretarray=$this->db->select("*")
                                        ->from('treatments1')
                                        ->where('dignosis LIKE',$p_dignosis)
                                        ->where('proxy_id',$profile->proxy_id)
                                        ->where('department_id',$profile->department_id)
                                        ->where('ipd_opd',$section_tret)
                                        ->get()
                                        ->num_rows();
                                    // echo $tretarray;
                                    
                                    if($tretarray > 2){
                                        $tretment=$this->db->select("*")
                                            ->from('treatments1')
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd',$section_tret)
                                            //->where('ICU',$profile->sex)
                                            ->where('proxy_id',$profile->proxy_id)
                                            ->where('department_id',$profile->department_id)
                                            ->get()
                                            ->row();
                                            
                                    } else {
                                        $tretment=$this->db->select("*")
                                            ->from('treatments1')
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('proxy_id',$profile->proxy_id)
                                            ->where('department_id',$profile->department_id)
                                            ->where('ipd_opd',$section_tret)
                                            ->limit(1)
                                            ->get()
                                            ->row();
                                           // print_r($this->db->last_query());
                                    }
                                    echo $profile->proxy_id; 
                                }
                                else{
                                    $tretment=$this->db->select("*")
                                        ->from('manual_treatments')
                                        ->where('patient_id_auto',$profile->id)
                                        ->where('dignosis LIKE',$p_dignosis)
                                        ->where('ipd_opd ',$section_tret)
                                        ->order_by("id", "desc")
                                        ->get()
                                        ->row();
                                }
                                
                                if($profile->manual_status=='1' || $profile->created_by =='1' || $profile->created_by =='2')
                                    {
                                        $tretment=$this->db->select("*")
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$profile->id)
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    
                                    
                                //  print_r($tretment);
                                $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
                                $SEROLOGYCAL= $tretment->SEROLOGYCAL;
                                $BIOCHEMICAL= $tretment->BIOCHEMICAL;
                                $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                                
                                $SNEHAN= $tretment->SNEHAN;
                                $SWEDAN= $tretment->SWEDAN;
                                $VAMAN= $tretment->VAMAN;
                                
                                $YONIDHAVAN= $tretment->YONIDHAVAN;
			                    $YONIPICHU= $tretment->YONIPICHU;
			                     $UTTARBASTI= $tretment->UTTARBASTI;
			                     
			                     $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
                                
                                $VIRECHAN= $tretment->VIRECHAN;
                                $BASTI= $tretment->BASTI;
                                $NASYA= $tretment->NASYA;
                                
                                $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
                                $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
                                $SHIROBASTI = $tretment->SHIROBASTI;
                                $OTHER= $tretment->OTHER;
                                
                                
                                $skarma= $tretment->skarma;
                                $vkarma= $tretment->vkarma;
                                
                                $X_RAY= $tretment->X_RAY;
                                $ECG= $tretment->ECG;
                                $USG= $tretment->USG;
                                
                                $DSRX1= $tretment->RX1;
                                $DSRX2= $tretment->RX2;
                                $DSRX3= $tretment->RX3;
                                $DSRX4= $tretment->RX4;
                                $DSRX5= $tretment->RX5;
                                
                                // $DSRX5= $tretment->RX5;
                                // $DSRX5= $tretment->RX5;
                                
                                $DRX1= $tretment->DRX1;
                                $DRX2= $tretment->DRX2;
                                $DRX3= $tretment->DRX3;
                                
                                $ICU_Order= $tretment->ICU_Order;
                                $Post_Operative=$tretment->Post_Operative;
                                $symptoms= $tretment->sym_name;
                                $ICU_C= $tretment->ICU;
                                
                                echo $tretment->sr;
                                
                                $str_p_o = $Post_Operative;
                                $ex_str_p_o=explode(",",$str_p_o);
                                
                                $covid_date=date('Y-m-d',strtotime($profile->create_date));
                                if(($covid_date >='2020-03-22') && ($covid_date <='2021-07-30')){
                                    $Only_2nd_Day_Morning_covid=$tretment->Only_2nd_Day_Morning_covid;
                                    $Sp_Investigations_pandamic=$tretment->Sp_Investigations_pandamic;
                                }else{
                                    $Only_2nd_Day_Morning_covid='';
                                    $Sp_Investigations_pandamic='';
                                }
                                
                                $tre_covid_2nd_morning = $Only_2nd_Day_Morning_covid;
                                $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                
                                $tre_spe_invet = $Sp_Investigations_pandamic;
                                $ex_spe_invet=explode(",",$tre_spe_invet);
                                
                                /////////////////////////////////////////////////////
                                
                            ?>
                            <table class="table" >
                                <tbody>
                                    <tr>
                                        <td colspan="2">Ward:-     <span style="font-weight: bold;"><?php  if($profile->sex=='F') { echo 'Female';} else if($profile->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
                                        <td>Bed No:-  <span style="font-weight: bold;"><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></span></td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        
                                        <td colspan="2">Department:-   <span style="font-weight: bold;"><?php echo (!empty($profile->name)?$profile->name:null) ?> <?//php if($ICU_C){ echo " [ICU-".$profile->sex."]";}?> </span></td>
                                        
                                        
                                                <td>Doctor's Name:- <span style="font-weight: bold;"><?php echo $doctor_name->firstname;?></span></td>
                                                
                                    </tr>
                                    
                                    
                                    
                                    <tr>
                                        <td>C-OPD No:-  <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                        <td>C-IPD :-   <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                        <td>D-IPD:-   <span style="font-weight: bold;"><?php echo  $tot_serial_Dipd_change; echo".".$year1222;?> </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Date of Admission:-   <span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>
                                        <td>Time:- <span style="font-weight: bold;"><?php echo $profile->atime;?>  AM.</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Date of Dischage:-  <span style="font-weight: bold;"><?php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?> </span></td>
                                        <td>Time:-   <span style="font-weight: bold;"><?php if($profile->discharge_date=='0000-00-00') { echo "-"; } else { echo $profile->dtime.' AM.'; } ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Patient's Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                        <td>Age:-  <span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?>&nbsp; Yrs.&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sex:-<?php echo (!empty($profile->sex)?$profile->sex:null);?> , Weight  : <?php echo $wieght; ?> Kg.  </span></td>
                                    </tr>
                                    
                                    <tr>
                                        <?php 
                                            error_reporting(0);
                                            $string=$profile->firstname;
                                            $ex=explode(" ",$string);
                                            $lenght= count($ex);
                                            $parent_name= $ex[0]." ".$ex[2]. " ".$ex[3];
                                        ?>
                                        <td colspan="3">Father's / Husband's Name:-   <span style="font-weight: bold;"><?php echo $parent_name;?> </span></td>
                                    </tr>
                                    <tr>
                                <td>Contact  :</td>
                                <td><?php if($temp_patient->phone) {  echo  $temp_patient->phone;} else { echo $temp_patient->phone; }?> </td> 
                            </tr>
                                    <tr>
                                        <td colspan="3">Address:- <span style="font-weight: bold;"><?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                    </tr>
                                    <!--<tr>
                                        <td colspan="3">Phone No:- <span style="font-weight: bold;"> <?php echo $profile->phone;?></span></td>
                                    </tr>-->
                                    <tr>
                                        <td colspan="3">Provisional Diagnosis:-  <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Final Diagnosis:-  <span style="font-weight: bold;"><?php echo  $tretment->POVISIONALdignosis;  ?> </span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" style="page-break-after: always;border: groove;">
                    <div class="col-sm-12" align="center">
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                        
                        <table class="table" >
                            <tbody>
                                <tr>
                                    <td style="line-height: 1.0;">Ward:-     <span style="font-weight: bold;"><?php  if($profile->sex=='F') { echo 'Female';} else if($profile->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
                                    <td style="line-height: 1.0;">Bed No:-  <span style="font-weight: bold;"><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></span></td>
                                    <td style="line-height: 1.0;">Department:-   <span style="font-weight: bold;"><?php echo (!empty($profile->name)?$profile->name:null) ?> <?php if($ICU_C){ echo " [ICU-".$profile->sex."]";}?> </span></td>
                                </tr>
                                <tr>
                                    <td style="line-height: 1.0;">C-OPD No:-  <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                    <td style="line-height: 1.0;">C-IPD :-   <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                    <td style="line-height: 1.0;">D-IPD:-   <span style="font-weight: bold;"><?php echo  $tot_serial_Dipd_change; echo".".$year1222;?> </span></td>
                                </tr>
                                <tr>
                                    <td style="line-height: 1.0;">Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                    <td style="line-height: 1.0;">Age:-  <span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?>&nbsp; Yrs.&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sex:-<?php echo (!empty($profile->sex)?$profile->sex:null) ?> </span></td>
                                    <td style="line-height: 1.0;">Address:- <span style="font-weight: bold;"><?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                </tr>
                                <tr>
                                    <td style="line-height: 1.0;">Doctor's Name:- <span style="font-weight: bold;"><?php echo $doctor_name->firstname;?></span></td>
                                    <td style="line-height: 1.0">DOA:-   <span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>
                                    <td style="line-height: 1.0;">Time:- <span style="font-weight: bold;"><?php echo $profile->atime;?>  AM.</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <h1 style="border: inset;background-color: #f1f0ee;font-family: 'Khand', sans-serif;font-size: 23px;"> IPD Consent Form ( अंत:रुग्ण संमती पत्र )</h1>
                        <br>
                    </div>
                    <div class="col-md-12 col-lg-12 " style="padding-left: 31px;padding-right: 31px;"> 
                        <p style="font-family: 'Khand', sans-serif;font-size: 15px;">मी/आम्ही ,<br>सौ/श्री/कु. <span style="font-weight: bold;border-bottom: 0px dotted #000;
                        text-decoration: none; ">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></span> याचा / याची / मुलगा / मुलगी / पती / पत्नी / नातेवाईक   <span style="font-weight: bold ; border-bottom: 0px dotted #000;
                        text-decoration: none;" ><?php echo   $parent_name;?></span>- मु.पो        <span style="font-weight: bold ; border-bottom: 0px dotted #000;
                        text-decoration: none;" >    <?php echo (!empty($profile->address)?$profile->address:null) ?> </span> असे लिहून देतो कि, मी / आम्ही माझ्या रुग्णाचा उपचार करण्याच्या हेतूने  त्याला / तिला रुगणालयात भरती करीत आहे / आहोत. मला /आम्हाला / माझ्या रुग्णाच्या गांभीर्याची तसेच माझ्या रुग्णावर करण्यात येणाऱ्या आयुर्वेदिक, अॅलोपॅथी  उपचारांची पूर्ण माहिती, याचे फायदे आणि  तोटे, त्या उपचारांची मर्यादा या सगळ्यांची माहिती मला / आम्हाला आमच्या भाषेत डॉक्टरांनी दिली आहे. माझ्या / आमच्या रुग्णावर उपचार करत असताना आमच्या रुग्णाची कोणत्याही प्रकारची दुर्घटना किंवा त्याला / तिला हानी झाल्यास मी / आम्ही स्वतः त्यास जबाबदार राहू, तसेच याबाबत मी / आम्ही रुग्णालयाला जबाबदार धरणार नाही.
                        </p>
                        
                        <br>
                        <br>
                        <br>
                        <span style="padding-left: 99px;">परिचारिका स्वाक्षरी</span>
                        <span style="float: right;padding-right: 99px;">                      रुग्ण स्वाक्षरी </span> 
                        <span style="padding-left: 99px;">नातेवाईक स्वाक्षरी </span>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <?php if(($profile->department_id=='33') || ($profile->department_id=='31')){?>
                    <div class="row" style="page-break-after: always;border: groove;">
                        <div class="col-sm-12" align="center" >  
                            <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                            <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                            <table class="table" >
                                <tbody>
                                    <tr>
                                        <td style="line-height: 1.0;">Ward:-     <span style="font-weight: bold;"><?php  if($profile->sex=='F') { echo 'Female';} else if($profile->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
                                        <td style="line-height: 1.0;">Bed No:-  <span style="font-weight: bold;"><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></span></td>
                                        <td style="line-height: 1.0;">Department:-   <span style="font-weight: bold;"><?php echo (!empty($profile->name)?$profile->name:null) ?> <?php if($ICU_C){ echo " [ICU-".$profile->sex."]";}?> </span></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 1.0;">C-OPD No:-  <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                        <td style="line-height: 1.0;">C-IPD :-   <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                        <td style="line-height: 1.0;">D-IPD:-   <span style="font-weight: bold;"><?php echo  $tot_serial_Dipd_change; echo".".$year1222;?> </span></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 1.0;">Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                        <td style="line-height: 1.0;">Age:-  <span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?>&nbsp; Yrs.&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sex:-<?php echo (!empty($profile->sex)?$profile->sex:null) ?> </span></td>
                                        <td style="line-height: 1.0;">Address:- <span style="font-weight: bold;"><?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td style="line-height: 1.0;">Doctor's Name:- <span style="font-weight: bold;"><?php echo $doctor_name->firstname;?></span></td>
                                        <td style="line-height: 1.0">DOA:-   <span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>
                                        <td style="line-height: 1.0;">Time:- <span style="font-weight: bold;"><?php echo $profile->atime;?>  AM.</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1 style="border: inset;background-color: #f1f0ee;font-family: 'Khand', sans-serif;font-size: 23px;"> Procedure Consent Form ( शपथ पत्र )</h1>
                            <br>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 " style="padding-left: 31px;padding-right: 31px;"> 
                        
                            <p style="font-family: 'Khand', sans-serif;font-size: 15px;"> मी/आम्ही ,<br>
                            सौ/श्री/कु. <span style="font-weight: bold;border-bottom: 0px dotted #000;   text-decoration: none; ">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></span> याचा / याची / मुलगा / मुलगी / पती / पत्नी / नातेवाईक   <span style="font-weight: bold ; border-bottom: 0px dotted #000; text-decoration: none;" >
                                <?php echo   $parent_name;?></span>- मु.पो        <span style="font-weight: bold ; border-bottom: 0px dotted #000; text-decoration: none;" >    <?php echo (!empty($profile->address)?$profile->address:null) ?> </span>  . असे लिहून देतो कि, मी / आम्ही माझ्या रुग्णाचे शल्यकर्म / पंचकर्म करण्यासाठी त्याला / तिला रुगणालयात घेऊन आलो आहोत. आमच्या रुग्णावर करण्यात येणारे शल्यकर्म / पंचकर्म तसेच त्याला / तिला देण्यात येणारे संज्ञाहरण त्याचे फायदे तोटे याबद्दल मला / आम्हाला डॉक्टरांनी पूर्णपणे माहिती दिली आहे. तरी, कोणत्याही प्रकारची दुर्घटना, हानी झाल्यास मी किंवा माझा परिवार वैद्यांवर / रुग्णालयावर दावा करणार नाही. यासाठी सर्वस्वी मी / आम्ही जबाबदार आहे /आहोत.
                            </p>

                            <span>1)	डॉक्टर </span>    <span style="font-weight: 900;border-bottom: 1px dotted #000; text-decoration: none;"><?php echo $doctor_name->firstname;?></span>
                            <br>     <span>2)	भूलतज्ञ ------------------</span>
                            <br>       <span>3)	शस्त्रकर्म ------------------ </span>
                            <br>
                            <br>
                            <br>
                            <span style="padding-left: 99px;">परिचारिका स्वाक्षरी</span>
                            <span style="float: right;padding-right: 99px;">                      रुग्ण स्वाक्षरी </span> 
                            <span style="padding-left: 99px;">नातेवाईक स्वाक्षरी </span>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                <?php }?>
                <div class="row" style="page-break-after: always;border: groove;">
                    <div class="col-sm-12" align="center" >
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                        <h1 style="border: inset;background-color: #f1f0ee;font-size: 23px;">LABORATORY INVESTIGATION SLIP</h1>
                    </div>.
                    <div class="col-md-12 col-lg-12 "> 
                        <div class="container" style="width: 100%;">
                            <table class="table lab lab1" style="">
                                <tbody>
                                    <tr>
                                        <td colspan="3">Patient's Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Age:- <span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?>&nbsp; Yrs. &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; Sex:- <?php echo (!empty($profile->sex)?$profile->sex:null) ?></span></td>
                                        <td>Date:- <span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?> </span></td>
                                        <td>C-IPD:- <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Ward:- <span style="font-weight: bold;"><?php  if($profile->sex=='F') { echo 'Female';} else if($profile->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
                                        <td>Bed No:-  <span style="font-weight: bold;"><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                                $patient_auto_id = $profile->id;
                                $this->db->distinct();
                                $this->db->select('report_type');
                                $this->db->where('patient_auto_id', $patient_auto_id); 
                                $query = $this->db->get('investi_ipd_report_result');
                                $query1 = $query->result();
                               // print_r($this->db->last_query());
                                $count = $query->num_rows();
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php for($i=0;$i<$count;$i++){
                                    
                                     $this->db->where('patient_auto_id', $patient_auto_id); 
                                    $this->db->where('report_type', $query1[$i]->report_type); 
                                    $query2 = $this->db->get('investi_ipd_report_result');
                                    $result = $query2->result();
                                   // print_r($result);
                    ?>
                    
                    <div class="row" <?php if($i<($count-1) || $i>0) { echo 'style="page-break-after: always; padding-bottom:10px;" '; } ?>>
                        <div style="border: 1px solid;">
                        <div class="col-sm-12" align="center" style="margin-top: 7px;">  
                           
                            <h1> <?php $test_name = $result[0]->test_type; echo $test_name.' '.'Examination Report';?> </h1>
                          
                        <br>
                        </div>
                       
                        <div class="col-md-12" style="border-bottom: 1px solid;">
                            <div style="text-align:center;">
                                <h3> <?php $name =  $result[0]->report_section; echo $name.' '.'REPORT';?> </h3>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    <th>Unit</th>
                                    <th>Normal Value</th>
                                </thead>
                                <tbody>
                                    <?php foreach($result as $profile => $pp) { ?>
                                    <?//php if ($pp->report_type == 'CBC') {?> 
                                    <tr>
                                        <td><strong><?php echo $pp->test_name; ?></strong></td>
                                        <td><?php echo $pp->result; ?></td>
                                        <td><?php echo $pp->unit; ?></td>
                                        <td><?php echo $pp->reference_range; ?></td>
                                    </tr>
                                    <?//php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="text-align:center; border-bottom: 1px solid;margin-bottom: 20px;">
                            <b>------- End Report -------</b> 
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <b> Lab Assistant Signature</b>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <b> Doctor Signature</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                    <?php } ?>
                                </div>
                            </div>
                           
                            
                           
                        </div>
                    </div>
                </div>
                
                
               
                
                <div class="row" style="page-break-after: always;border: groove;">
                    
                    <?php 
                    $result4 = $this->db->select('DISTINCT(ipd_round_date),(id),`sym_name`, `h_o`, `local_examination`, `e_o`, `f_o`, `bp`, `pulse`, `nadi`, `shudha`, `rs`, `cvs`, `ra`, `pa`, `pr`, `pv`, `netra`, `givwa`, `ahar`, `mal`, `mutra`, `tapman`, `nidra`, `old_investigation`,`surgical_history`,`nidra1`,`vyasan`,`urine`,`purish_pravrutti`
                                  ,`stool`,`apanvayu`,`koshth`,`prakruti`,`shariripraman`,`aharshakti`,`vyayam_shakti`,`samprapti_ghatak`,`vishesh_shtrots_pariksha`,`naidanik_pariksha`,`vyavched_nidan`,`vyadhi_vinishray`,`ashthvidh_psriksha_mutra`,`PAST_HISTORY`')
                      ->where(['patient_id_auto'=>$profile->id])
                      ->order_by('ipd_round_date,id', 'ASC')
                      ->limit(1)
                      ->get('manual_treatments')
                      ->row();
                       // print_r($this->db->last_query());
                    ?>
                    <div class="col-sm-12" align="center" >
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                    </div>
                    
                    <div class="col-md-12 col-lg-12 "> 
                        <div class="container" style="width: 100%;">
                            <table class="table" style="page-break-after: always;border: groove;">
                            
                                <tbody>
                                    <tr>
                                        <td colspan="2">रुग्ण नाम :  <span style="font-weight: bold;">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                    
                                    </tr>
                                    
                                    <tr>
                                        <td>1.	वेदना विशेष व काल </td>
                                        <td>:<span style="font-weight: bold;"> <?php if($result4->sym_name){ echo  $result4->sym_name;}else { echo $symptoms; }  ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>(Chief Complains with duration )</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td> 2.इतिहास (History)</td>
                                        <td>:<span style="font-weight: bold;"> <?php   if($result4->h_o) { echo $result4->h_o;} else { echo '';}  ?></span></td></td>
                                    </tr>
                                    <tr>
                                        <td>  i)पूर्व व्याधी इतिहास<br>(History of Pastillness )
                                        </td>
                                        <td>:
                                        <?php 
                                       
                                                echo $result4->PAST_HISTORY; 
                                           
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td>  ii) शस्त्रकर्म इतिहास </td>
                                        <td>:
                                        <?php 
                                       
                                                echo $result4->surgical_history; 
                                           
                                        ?></td>
                                    </tr>
                                    <tr>
                                        <td>(Surgical History)</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td> iii)कौटुंबिक इतिहास</td>
                                        <td>:  <span style="font-weight: bold;"> <?php echo  $f_h=$opd_data->f_h;  ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>(Family History)</td>
                                        <td> </td>
                                    </tr>
                                  
                                    <tr>
                                        <td> 3.	सामान्य आतुर परीक्षा </td>
                                       
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  तापमान -<span style="font-weight: bold;">   <?php  if($result4->tapman) {echo 'Temp :'.$result4->tapman.'ºF<br>';} else{ echo $profile->tap.' °F';} ?>
                                        </span><br>: रक्तदाब - 
                                          <span style="font-weight: bold;"> <?php if($result4->bp) {   echo $result4->bp; }  else { echo $bp; }?> mm of Hg</span>  </td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td>:  नाडी   - 
                                        <span style="font-weight: bold;"> 
                                        <?php  if( $result4->nadi){echo $result4->nadi;} ?></span></td>
                                    </tr>
                                    
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
      
      <div class="row">
                <div class="col-lg-12">
                    <table class="table  table-hover table-striped" style="border:1px solid;">
                        <thead>
                            <tr>
                                <th>4)</th>
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
                                 <th>पूर्व वेश्म (Anterior Chamber)</th>
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
      
      <div class="row">
                <div class="col-lg-12">
                    <table class="table table-hover table-striped" style="border:1px solid;">
                        <tr>
                            <th>5)</th>
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
                            <th><?php echo $tretment->MACULA_RE; ?></th>
                            <th><?php echo $tretment->MACULA_LE; ?></th>
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
                            <th>6)</th>
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
                            <th>7)</th>
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
                        <h4>8) मुख </h4>
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
                        <h4>9) शिर 	
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
      
      <div class="row" style="page-break-before: always;">
                    <div class="col-lg-12">
                        <h4>
                         10) विशिष्ठ परिक्षण -
                      </h4>
                        <table class="table" style="border:1px solid;">
                            <tr>
                                <th> K1 -</th>
                                <th><?php echo $tretment->k_one; ?></th>
                            </tr>
                            <tr>
                                <th>K2  -</th>
                                <th><?php echo $tretment->k_two; ?></th>
                            </tr>
                            <tr>
                                <th>Axil Length-</th>
                                <th><?php echo $tretment->axil_length; ?></th>
                            </tr>
                            <tr>
                                <th>PCIOL  -</th>
                                <th><?php echo $tretment->pciol; ?></th>
                            </tr>
                            <tr>
                                <th>Sac Syringing  -</th>
                              <th>
                               <div class="row">
                                <div class="col-lg-6">
                                  RE -  <?php echo $tretment->sac_syringing_re; ?>
                                </div>
                                <div class="col-lg-6">
                                  LE -  <?php echo $tretment->sac_syringing_le; ?>
                                </div>
                                </div>
                          </th>
                            </tr>
                            <tr>
                                <th>IOP -</th>
                              <th>
                                <div class="row">
                                <div class="col-lg-6">
                                  RE -  <?php echo $tretment->iop_re_ipd; ?>
                                </div>
                                <div class="col-lg-6">
                                  LE -	 <?php echo $tretment->iop_le_ipd; ?>
                                </div>
                                </div>
                              </th>
                            </tr>
                           
                        </table>
                    </div>
        
                   
                </div>
       <div class="row" style="page-break-before: always;">
                    <div class="col-lg-12">
                      
          <table class="table table-bordered table-hover table-striped">
        <tr>
          <td><b>11) व्याधी विनीश्चय</b>    </td>
                                        <td>: <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:$result4->vyadhi_vinishray) ?></span></td>
                                    </tr>
                        </table>
                    </div>
            </div>
                 <div class="row" style="page-break-before: always;">
                    <div class="col-lg-12">
                       <h4>
                         12) चिकित्सा  -
                      </h4>
          <table class="table table-bordered table-hover table-striped">
            <tr>
              <th>A)स्थानिक -</th>
              <th><?php echo $tretment->stanik; ?></th>
            </tr>
            <tr>
              <th>b)सार्वदैविक -</th>
              <th><?php echo $tretment->sarvdaivik; ?></th>
            </tr>
            <tr>
              <th>c)शस्त्रकर्म -</th>
              <th></th>
            </tr>
            <tr>
              <th>i. पूर्वकर्म (Pre-Operative) -</th>
              <th><?php echo $tretment->purvkarm; ?></th>
            </tr>
            
            <tr>
              <th>ii. प्रधानकर्म (Operative Notes)-</th>
              <th><?php echo $tretment->pradhankarm; ?></th>
            </tr>
            
            </table>
                      </div>
            </div>
                <div class="row" style="page-break-after: always;border: groove;">
                    <div class="col-sm-12" align="center"> 
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                        <span></span><h1 style="border: inset;background-color: #f1f0ee;font-family: 'Khand', sans-serif;padding: 3px;font-size: 23px;">Diet Sheet (निर्देशित आहार कल्पना)</h1><span></span>
                    </div>
                    <?php 
                    
                    $diet0=$this->db->select("*")
                    
                    ->from('diet')
                    ->get()
                    ->row();
                    // print_r($diet0);
                    
                    $diet=$this->db->select("*")
                    
                    ->from('diet')
                    ->where('srno',$tretment->sr)
                    // ->where('diagnosis LIKE',$p_dignosis)
                    ->get()
                    ->row();
                    // print_r($diet)
                    ?>
                    <div class="col-md-12 col-lg-12 "> 
                    
                        <div class="container" style="width: 100%; padding-right: 0px;padding-left: 0px;">
                        
                            <table class="table lab lab1" style="%;">
                                <tbody>
                                    <tr>
                                        <td>C.O.P.D.No.:- <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                        <td>C.I.P.D. No:- <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                        <td>D-IPD:-   <span style="font-weight: bold;"><?php echo  $tot_serial_Dipd_change; echo".".$year1222;?> </span></td>
                                    </tr>
                                    <tr>
                                        <td>Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                        <td>Age :-<span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?> yrs.</span></td>
                                        <td>Sex :-<span style="font-weight: bold;"><?php echo $profile->sex;?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Address:-<span style="font-weight: bold;"> <?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                        <td>Provisional Diagnosis:-  <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></span></td>
                                        <td>Contact :-<span style="font-weight: bold;"> <?php echo $profile->phone;?></span></td>
                                    </tr>
                                    <tr>
                                        <td>D.O.A.:-<span style="font-weight: bold;">
                                            <?php  
                                            if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                            {
                                                echo date("d-m-Y",strtotime($date_f5));
                                            }
                                            else
                                            {
                                               echo date('d-m-Y',strtotime($profile->create_date)); 
                                            }
                                            ?>
                                            
                                            </span></td>
                                        <!-- <td>D.O.D.:- <span style="font-weight: bold;"> <?php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?></span></td>-->
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class="table" style="border: 2px solid #574646;">
                                <tbody>
                                    <tr>
                                        <?php if($diet->gai_dudha) { ?><td style="font-weight: bold;"><li><?php echo "गाईचे दुध ". $diet0->gai_dudha; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>
                                        <?php if($diet->sunth_gdudha) { ?><td style="font-weight: bold;"><li><?php echo " सुंठ + गोदुग्ध   ". $diet0->sunth_gdudha; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->pej) { ?><td style="font-weight: bold;"><li><?php echo " पेज ". $diet0->pej; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>   
                                        <?php if($diet->mrudshay) { ?><td style="font-weight: bold;"><li><?php echo " मुग्दयूष ". $diet0->mrudshay; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>
                                        <?php if($diet->abmil) { ?><td style="font-weight: bold;"><li><?php echo " आंबील ". $diet0->abmil; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>
                                        <?php if($diet->alimbusar) { ?><td style="font-weight: bold;"><li><?php echo " आर्द्रकयुक्त लिंबू सरबत ". $diet0->alimbusar; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>    
                                        <?php if($diet->htak) { ?><td style="font-weight: bold;"><li><?php echo " हिंग्वाष्टक युक्त ताक ". $diet0->htak; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>
                                        <?php if($diet->bhajsup) { ?><td style="font-weight: bold;"><li><?php echo "भाज्यांचे सूप  ". $diet0->bhajsup; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>
                                        <?php if($diet->maunsahar) { ?><td style="font-weight: bold;"><li><?php echo "मांसरस  ". $diet0->maunsahar; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>
                                        <?php if($diet->chaha_cofe) { ?><td style="font-weight: bold;"><li><?php echo "चहा/कॉफी  ". $diet0->chaha_cofe; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr> 
                                        <?php if($diet->khir) { ?><td style="font-weight: bold;"><li><?php echo "खीर  ". $diet0->khir; ?> </li></td><?php  }?>
                                    
                                    </tr>
                                    <tr>  
                                        <?php if($diet->naralpa) { ?><td style="font-weight: bold;"><li><?php echo " नारळ पाणी ". $diet0->naralpa; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->usras) { ?><td style="font-weight: bold;"><li><?php echo "उसाचा रस  ". $diet0->usras; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->svpey) { ?><td style="font-weight: bold;"><li><?php echo " शर्करा वर्जित पेय ". $diet0->svpey; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr> 
                                        <?php if($diet->khimaubhat) { ?><td style="font-weight: bold;"><li><?php echo " खिमट/मऊ भात ". $diet0->khimaubhat; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->shira) { ?><td style="font-weight: bold;"><li><?php echo "शिरा  ". $diet0->shira; ?> </li></td><?php  }?>
                                    
                                    </tr>
                                    <tr>  
                                        <?php if($diet->pohe_upma) { ?><td style="font-weight: bold;"><li><?php echo " पोहे/उपमा ". $diet0->pohe_upma; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->abhurji_amlet) { ?><td style="font-weight: bold;"><li><?php echo " आम्लेट/भुर्जी/अंडी ". $diet0->abhurji_amlet; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->ukad) { ?><td style="font-weight: bold;"><li><?php echo " उकड ". $diet0->ukad; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr> 
                                        <?php if($diet->dhavan) { ?><td style="font-weight: bold;"><li><?php echo "धावन  ". $diet0->dhavan; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->edli) { ?><td style="font-weight: bold;"><li><?php echo "इडली  ". $diet0->edli; ?> </li></td><?php  }?>
                                    
                                    </tr>
                                    <tr>  
                                        <?php if($diet->vbhat) { ?><td style="font-weight: bold;"><li><?php echo "वरण रक्तशालीभात  ". $diet0->vbhat; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->mugkhich) { ?><td style="font-weight: bold;"><li><?php echo " मुगाची खिचडी ". $diet0->mugkhich; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->palebha) { ?><td style="font-weight: bold;"><li><?php echo "पालेभाज्या  ". $diet0->palebha; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr> 
                                        <?php if($diet->phalbha) { ?><td style="font-weight: bold;"><li><?php echo " फळभाज्या ". $diet0->phalbha; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->kaddha) { ?><td style="font-weight: bold;"><li><?php echo "कडधान्य उसळी  ". $diet0->kaddha; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->kanbha) { ?><td style="font-weight: bold;"><li><?php echo "कंद भाज्या  ". $diet0->kanbha; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->maunsahar2) { ?><td style="font-weight: bold;"><li><?php echo "मांसाहार  ". $diet0->maunsahar2; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->machahar) { ?><td style="font-weight: bold;"><li><?php echo "मत्स्याहार  ". $diet0->machahar; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr> 
                                        <?php if($diet->poli) { ?><td style="font-weight: bold;"><li><?php echo "पोळी  ". $diet0->poli; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->jbnsbhakri) { ?><td style="font-weight: bold;"><li><?php echo "ज्वारी/बाजरी/नाचणी/सातूची भाकरी  ". $diet0->jbnsbhakri; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->god) { ?><td style="font-weight: bold;"><li><?php echo "गोड पदार्थ  ". $diet0->god; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr> 
                                        <?php if($diet->amboli) { ?><td style="font-weight: bold;"><li><?php echo "आंबोळी  ". $diet0->amboli; ?> </li></td><?php  }?>
                                    </tr>
                                    <tr>  
                                        <?php if($diet->etar) { ?><td style="font-weight: bold;"><li><?php echo "". $diet->etar." ".$diet0->etar; ?> </li></td><?php  }?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="row" style="page-break-after: always;border: groove;">
                    <div class="col-sm-12" align="center">  
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                        <span></span><h1 style="border: inset;background-color: #f1f0ee;font-size: 19px;padding-top: 7px;font-family: 'Khand', sans-serif;">दैनंदिन चिकित्सा पत्रक</h1><span></span>
                    </div>
                    <div class="col-md-12 col-lg-12 "> 
                        <div class="container" style="width: 100%;padding-right: 0px;padding-left: 0px;">
                            <table class="table" style="border: 2px solid #574646;">
                                <tbody>
                                    <tr>
                                        <td style="border: 2px solid #574646;width: 112px;">दिनांक / वेळ:-</td>
                                        <td style="border: 2px solid #574646;width: 349px;">लक्षणे</td>
                                        <td style="border: 2px solid #574646;">चिकित्सा</td>
                                    </tr>
                                    <?php 
                                    
                                        // print_r($profile->id);
                                        $result1= $this->db->select('DISTINCT(ipd_round_date),rounds')
                                                ->where(['patient_id_auto'=>$profile->id])
                                                ->order_by('ipd_round_date', 'ASC')
                                                ->get('manual_treatments')
                                                ->result();
                         // print_r($this->db->last_query());
                                        /*print_r($result1);
                                        die();*/
                         // print_r($this->db->last_query());
                                        
                                        /*$result2= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'1'])
                                            ->order_by('ipd_round_date', 'ASC')
                                            ->get('manual_treatments')
                                            ->result();
                                        
                                        $result3 = $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'2'])
                                            ->order_by('ipd_round_date', 'ASC')
                                            ->get('manual_treatments')
                                            ->result();*/
                                            
                                    ?>
                                    <?php 
                                        //print_r($profile->manual_status);
                                        /////////////////////////////// Start Manual Tratement///////////////
                                        if($profile->manual_status == 1){
                                            //print_r('Manual Treatement');
                                    ?>
                                    <?php if($result1){?>
                                            <?php $count = 0;?>
                                            <?php foreach($result1 as $r1 => $rs1){?>
                                                    <?php 
                                                        $lastIndex = count($result1) - 1;
                                                        
                                                        if($lastIndex != $r1){
                                                            //echo $r1."&nbsp;&nbsp;";
                                                            $date1 = date('Y-m-d', strtotime($rs1->ipd_round_date)); 
                                                            //echo $date1;
                                                            //echo "&nbsp;&nbsp;";
                                                             $date2 = date('Y-m-d', strtotime($result1[$r1+1]->ipd_round_date));
                                                            //echo $date2;
                                                            //echo "&nbsp;&nbsp;";
                                                            $diff = abs(strtotime($date2)-strtotime($date1));
                                                            $days = $diff/(60*60*24);
                                                           // echo $days;
                                                        }
                                                        else{
                                                            $res= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'1', 'ipd_round_date'=>$result1[$lastIndex]->ipd_round_date])
                                                                    ->order_by('ipd_round_date', 'ASC')
                                                                    ->get('manual_treatments')
                                                                    ->row();
                                                                    //print_r($this->db->last_query());
                                                             $days = $res->ipd_days;
                                                          //  echo $days;
                                                        }
                                                    ?>
                                                    <?php 
                                                        if($days>1){
                                                          //echo "hiiiii";
                                                    ?>
                                                    <?php 
                                                          
                                                          
                                                            for($i=0; $i<$days; $i++){
                                                            //  echo 'hiiii';
                                                                $ipd_round_date = $rs1->ipd_round_date;
                                                                if($i==0){
                                                                    $ipd_round_date_temp = $rs1->ipd_round_date;
                                                                    //echo $ipd_round_date_temp;
                                                                    //echo "<br>";
                                                                }else{
                                                                    //echo $i;
                                                                    $ipd_round_date_temp = date('Y-m-d',strtotime($i.' days', strtotime($rs1->ipd_round_date)));
                                                                    //echo $ipd_round_date_temp;
                                                                    //echo "<br>";
                                                                }
                                                              
                                                                $result2= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'1', 'ipd_round_date'=>$ipd_round_date])
                                                                           ->order_by('ipd_round_date', 'ASC')
                                                                            //->order_by('id', 'ASC')
                                                                            ->get('manual_treatments')
                                                                            ->row();
                                                            //  print_r($this->db->last_query());
                                                                $result3= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'2', 'ipd_round_date'=>$ipd_round_date])
                                                                            ->order_by('ipd_round_date', 'ASC')
                                                                            //->order_by('id', 'ASC')
                                                                            ->get('manual_treatments')
                                                                            ->row();
                                                                //print_r($result2);
                                                                                
                                                    ?>
                                                    <?php 
                                                                if($ipd_round_date_temp <= $profile->discharge_date || $profile->discharge_date=='0000-00-00'){
                                                                  //echo "hiiii<br>";
                                                                    if($result2){
                                                                        $count = $count + 1;
                                                    ?>
                                                                        <tr>
                                                                            <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <?php 
                                                                                    //echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                    echo date('d-m-Y',strtotime($ipd_round_date_temp));
                                                                                    echo "<br> Round ".$count;
                                                                                    echo "<br>";
                                                             						$a=array("9","9.30","10","10.30","11");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."<br>";
                                                                                    /*if($i%2==0){ 
                                                                                        echo $profile->atime.' AM.'; 
                                                                                    } else{
                                                                                        echo ($time[0]).' '.($time[1] + 9)."   AM";
                                                                                        
                                                                                    } */
                                                                                ?>
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <b> C/O :  </b><?php if($result2->sym_name) { echo $result2->sym_name;}?><br>
                                                                                <?php
                                                                                    $num_2=is_numeric($profile->second);
                                                                                    $num_3=is_numeric($profile->three);
                                                                                    $num_4=is_numeric($profile->four);
                                                                                    $num_5=is_numeric($profile->five);
                                                                                    $num_6=is_numeric($profile->six);
                                                                                    $num_7=is_numeric($profile->seven);
                                                                                    $num_8=is_numeric($profile->eight);
                                                                                    $num_9=is_numeric($profile->nine);
                                                                                
                                                                                    if($i==1){ if($num_2==1){ echo "Symptoms reduced by ".$profile->second."%<br>"; } else { echo $profile->second."<br>";} }
                                                                                    else if($i==2){ if($num_3==1){ echo "Symptoms reduced by ".$profile->three."%<br>"; } else { echo $profile->three."<br>";} }
                                                                                    else if($i==3){ if($num_4==1){ echo "Symptoms reduced by ".$profile->four."%<br>"; } else { echo $profile->four."<br>";} }
                                                                                    else if($i==4){ if($num_5==1){ echo "Symptoms reduced by ".$profile->five."%<br>"; } else { echo $profile->five."<br>";} }
                                                                                    
                                                                                    else if($i==5){ if($num_6==1){ echo "Symptoms reduced by ".$profile->six."%<br>"; } else { echo $profile->six."<br>";} }
                                                                                    else if($i==6){ if($num_7==1){ echo "Symptoms reduced by ".$profile->seven."%<br>"; } else { echo $profile->seven."<br>";} }
                                                                                    else if($i==7){ if($num_8==1){ echo "Symptoms reduced by ".$profile->eight."%<br>"; } else { echo $profile->eight."<br>";} }
                                                                                    else if($i==8){ if($num_8==1){ echo "Symptoms reduced by ".$profile->nine."%<br>"; } else { echo $profile->nine."<br>";} }
                                                                                    else { if($i==0) { echo '';} else{ echo "उपशय <br>" ;}}
                                                                                    
                                                                                ?>
                                                                                <b> H/O : </b> <?php if($result2->h_o) { echo $result2->h_o;}?><br>
                                                                                <b> Family History : </b> <?php if($result2->f_o) { echo $result2->f_o;}?><br><br>
                                                                                <!--<b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>-->
                                                                                 <b>Pulse :</b> <?php if($result2->pulse) { echo $result2->pulse.'/min';}?><br>
                                                                                <?php 
                                                                                    $str = $bp;
                                                                                    $ex=explode("/",$str);
                                                                                ?>
                                                                               <?php if($profile->department_id != 32){ ?> BP : <?php if($result2->bp) { echo $result2->bp."   mm of Hg";}else{ echo $profile->bp."   mm of Hg";}?><br><?php } ?>
                                                                                
                                                                                <!--<b> O/E-</b><br>-->
                                                                                
                                                                                <?php if($result2->tapman) { echo 'Temp :'.$result2->tapman.'ºF<br>';} ?>
                                                                                
                                                                                <?php if($result2->SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>
                                                                                
                                                                                
                                                                                RS: <?php if($result2->rs) { echo $result2->rs;}?><br>
                                                                                CVS : <?php  if($result2->cvs) { echo $result2->cvs;}?><br>
                                                                                 <?php if(!empty($result2->pr)) { echo 'PR: '.$result2->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                                                                <?php if(!empty($result2->pv)) { echo  'PV: '.$result2->pv.'<br>'; } ?>
                                                                                नाडी : <?php if($result2->nadi) { echo $result2->nadi;}?><br>
                                                                                
                                                                                
                                                                                <!--उदर (PA): <?//php if($result2->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>-->
                                                                                
                                                                                
                                                                               <!-- नेत्र :// <?php  if($result2->netra) { echo $result2->netra;}?><br> -->   
                                                                                जिव्हा : <?php if($result2->givwa) { echo $result2->givwa;}?><br>
                                                                                
                                                                                क्षुधा : <?php if($result2->shudha) { echo $result2->shudha;} ?><br>
                                                                                <br>
                                                                                
                                                                                
                                                                                आहार : <?php   if($result2->ahar){ echo $result2->ahar;} ?><br> 
                                                                                
                                                                                मल : <?php  if($result2->mal) { echo $result2->mal;}  ?><br>
                                                                                मूत्र : <?php if($result2->mutra) { echo $result2->mutra;}?><br> 
                                                                                
                                                                                
                                                                                निद्रा : <?php if($result2->nidra){ echo $result2->nidra;} else  {/* echo $nidra[$nidra1];*/ echo $profile->nidra;}?> <br>    </br>
                                                                                
                                                                                
                                                                                <?php if(($result2->Input) && ($i>= 1)){ echo '<b>I/O Chart:</b><br>';$ex_Input=explode(",",$profile->Input); if($profile->department_id=='32'){ echo 'Input: '.($ex_Input[$i]- 800).'ml';} else if($profile->sex=='M') {  echo 'Input: '.$ex_Input[$i].'ml';} else { echo 'Input: '.($ex_Input[$i]- 200).'ml';} }?> <br>
                                                                                <?php if(($result2->Output) && ($i>= 1)){ $ex_Output=explode(",",$profile->Output);  if($profile->department_id=='32'){ echo 'Output: '.($ex_Output[$i]- 600).'ml'; } else if($profile->sex=='M') { echo 'Output: '.$ex_Output[$i].'ml';} else { echo 'Output: '.($ex_Output[$i]- 200).'ml'; }}?> <br>
                                                                                </b>
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                    <b>
                                                                                        <?php 
                                                                                            $tre_icu = $result2->ICU_Order;
                                                                                            $ex_icu=explode(",",$tre_icu);
                                                                                            if(($result2->ICU_Order))  {
                                                                                                if($ex_icu[0]) { 
                                                                                                    echo "=>".$ex_icu[0].'<br>'; 
                                                                                                }  
                                                                                                if($ex_icu[1]) { 
                                                                                                    echo "=>".$ex_icu[1].'<br>'; 
                                                                                                } 
                                                                                                if($ex_icu[2]) { 
                                                                                                    echo "=>".$ex_icu[2].'<br>'; 
                                                                                                } 
                                                                                                if($ex_icu[3]) { 
                                                                                                    echo "=>".$ex_icu[3].'<br>'; 
                                                                                                }   
                                                                                                if($ex_icu[4]) { 
                                                                                                    echo "=>".$ex_icu[4].'<br>'; 
                                                                                                } 
                                                                                                if($ex_icu[5]) { 
                                                                                                    echo "=>".$ex_icu[5].'<br>'; 
                                                                                                } 
                                                                                                if($ex_icu[6]) { 
                                                                                                    echo "=>".$ex_icu[6].'<br>'; 
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </b> 
                                                                                    <?php 
                                                                                        $tre_1STDOSE = $result2->Only_1st_Dose;
                                                                                        $ex_1STDOSE=explode(",",$tre_1STDOSE);
                                                                                        if(!empty($result2->Post_Operative)) {  
                                                                                            echo "=> ".$ex_1STDOSE[0];echo "<br>"; 
                                                                                            if($ex_1STDOSE[1]) { 
                                                                                                echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                            } 
                                                                                            if($ex_1STDOSE[2]) { 
                                                                                                echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                            }
                                                                                        } else if(($result2->Only_1st_Dose)) {
                                                                                    ?>
                                                                                    <b> =></b> 
                                                                                    <?php 
                                                                                            echo "".$ex_1STDOSE[0];echo "<br>"; 
                                                                                            if($ex_1STDOSE[1]) { 
                                                                                                echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                            } 
                                                                                            if($ex_1STDOSE[2]) { 
                                                                                                echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                            }
                                                                                        } else {}?>
                                                                                    <?php 
                                                                                        if((($result2->VAMAN)  || ($result2->RAKTAMOKSHAN) || ($result2->SHIRODHARA_SHIROBASTI) || ($result2->skarma)))  {
                                                                                    ?>
                                                                                    <b>
                                                                                    <?php 
                                                                                            echo " ".$result2->skarma;
                                                                                    ?>
                                                                                    </b><br>
                                                                                    <?php
                                                                                        }
                                                                                    ?>
                                                                                    <b>
                                                                                    <?php  
                                                                                        if(($result2->Pr_Op_Medication)) {
                                                                                    ?>
                                                                                     
                                                                                    <?php 
                                                                                            echo "=>".$result2->Pr_Op_Medication;
                                                                                            echo "<br>";
                                                                                        }
                                                                                    ?>
                                                                                    <?php  
                                                                                        if(($result2->Pr_Op_Medication2nd)) {
                                                                                    ?>
                                                                                    <?php 
                                                                                            echo "=>".$result2->Pr_Op_Medication2nd;
                                                                                            echo "<br>";
                                                                                        }
                                                                                    ?>
                                                                                    </b><br>
                                                                                
                                                                                
                                                                                    <b> RX - </b> 
                                                                                    <?php 
                                                                                        
                                                                                        $RX1= $result2->RX1;
                                                                                        $RX2= $result2->RX2;
                                                                                        $RX3= $result2->RX3;
                                                                                        $RX4= $result2->RX4;
                                                                                        $RX5= $result2->RX5; 
                                                                                        
                                                                                        $RX6= $result2->RX6;
                                                                                        $RX7= $result2->RX7;
                                                                                        $RX8= $result2->RX8;
                                                                                        $RX9= $result2->RX9;
                                                                                        $RX10= $result2->RX10;
                                                                                        
                                                                                        $RX_other= $result2->RX_other; 
                                                                                        $RX_other1= $result2->RX_other1; 
                                                                                        $other_equipment = $result2->other_equipment;
                                                                                        
                                                                                        $tre_rx1 = $RX1;
                                                                                        $ex=explode(",",$tre_rx1);
                                                                                        $tre_rx2 = $RX2;
                                                                                        $ex2=explode(",",$tre_rx2);
                                                                                        $tre_rx3 = $RX3;
                                                                                        $ex3=explode(",",$tre_rx4);
                                                                                        $tre_rx4 = $RX4;
                                                                                        $ex4=explode(",",$tre_rx4);
                                                                                        $tre_rx5 = $RX5;
                                                                                        $ex5=explode(",",$tre_rx5);
                                                                                        
                                                                                        $tre_rx6 = $RX6;
                                                                                        $ex6=explode(",",$tre_rx6);
                                                                                        $tre_rx7 = $RX7;
                                                                                        $ex7=explode(",",$tre_rx7);
                                                                                        $tre_rx8 = $RX8;
                                                                                        $ex8=explode(",",$tre_rx8);
                                                                                        $tre_rx9 = $RX9;
                                                                                        $ex9=explode(",",$tre_rx9);
                                                                                        $tre_rx10 = $RX10;
                                                                                        $ex10=explode(",",$tre_rx10);
                                                                                        
                                                                                        $tre_rx_other = $RX_other;
                                                                                        $ex11=explode(",",$tre_rx_other);
                                                                                        //echo "$tre_rx_other";
                                                                                        $tre_rx_other1 = $RX_other1;
                                                                                        $ex12=explode(",",$tre_rx_other1);
                                                                                    ?>
                                                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                    
                                                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                    <?php if($RX_other) { $ex_x110=explode("x",$ex11[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex11[1]) { $ex_x111=explode("x",$ex11[1]); echo "=>".$ex_x111[0].'<br>'; } if($ex11[2]) { $ex_x111=explode("x",$ex11[2]); echo "=>".$ex_x112[0].'<br>'; }}?>
                                                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex12[0]);  echo "=>".$ex_x120[0];echo "<br>";  if($ex12[1]) { $ex_x121=explode("x",$ex21[1]); echo "=>".$ex_x121[0].'<br>'; } if($ex12[2]) { $ex_x121=explode("x",$ex12[2]); echo "=>".$ex_x122[0].'<br>'; }}?>
                                                                                     <?php if($other_equipment)
                                                                                    {
                                                                                      $test = explode(",",$other_equipment);
                                                                                      $count = count($test);
                                                                                      for($i=0;$i<$count;$i++)
                                                                                      {
                                                                                        echo $test[$i].'<br>';
                                                                                      }
                                                                                    }                                                                                   
                                                                          ?>
                                                                                    <br>
                                                                                    
                                                                                    
                                                                                <?php if(($result2->SNEHAN) || ($result2->SWEDAN) || ($result2->VAMAN) || ($result2->VIRECHAN) || ($result2->BASTI) || ($result2->NASYA) || ($result2->RAKTAMOKSHAN) || ($result2->SHIRODHARA_SHIROBASTI) || ($result2->OTHER) || ($result2->SWA1) || ($result2->SWA2)){?>
                                                                                <b> उपक्रम-</b><br>   
                                                                                    
                                                                                    <?php  if($result2->SNEHAN){  echo $result2->SNEHAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result2->SWEDAN){  echo $result2->SWEDAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if(($result2->VAMAN)  && ($i==0)) {  echo $result2->VAMAN.'<br>';  $VAMAN_1D=$result2->VAMAN;  }?>
                                                                                    
                                                                                    <?php  if($result2->VIRECHAN){  echo $result2->VIRECHAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result2->BASTI){  echo $result2->BASTI.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result2->NASYA){  echo $result2->NASYA.'<br>'; }?>
                                                                                    
                                                                                    <?php  if(($result2->RAKTAMOKSHAN)  && ($i==0)) { echo $result2->RAKTAMOKSHAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if(($result2->SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo $result2->SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                                                    
                                                                                    <?php if($result2->OTHER){  if(strpos($result2->OTHER, '1D') !== false) { if($i==0) { echo $result2->OTHER.'<br> '; $OTHER_1D=$result2->OTHER; } else{ echo '';} }  else { echo $result2->OTHER.'<br>'; } }?>
                                                                                    
                                                                                    <?php  if($result2->SWA1){  echo $result2->SWA1.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result2->SWA2){  echo $result2->SWA2.'<br>'; }?>
                                                                                <?php }?>
                                                                                
                                                                                <?php
                                                                                $tre_covid_2nd_morning = $result2->Only_2nd_Day_Morning_covid;
                                                                                $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                                                                
                                                                                //if((($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)  || ($Sp_Investigations_pandamic)) && ($i==0)){
                                                                                // if(($result2->HEMATOLOGICAL) || ($result2->SEROLOGYCAL) || ($result2->BIOCHEMICAL) || ($result2->MICROBIOLOGICAL) || ($result2->X_RAY) || ($result2->ECG) || ($result2->USG) || ($result2->Sp_Investigations_pandamic)){
                                                                                if(($result2->HEMATOLOGICAL!='') || ($result2->SEROLOGYCAL!='') || ($result2->BIOCHEMICAL!='') || ($result2->MICROBIOLOGICAL!='') || ($result2->X_RAY!='') || ($result2->ECG!='') || ($result2->USG!='') || ($result2->Sp_Investigations_pandamic!='')){
                                                                            ?>
                                                                                <br>
                                                                                <b> Adv- </b><br>
                                                                                
                                                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'CBC') !== false) || (strpos($result2->SEROLOGYCAL, 'CBC') !== false) || (strpos($result2->BIOCHEMICAL, 'CBC') !== false) || (strpos($result2->MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'ESR') !== false) || (strpos($result2->SEROLOGYCAL, 'ESR') !== false) || (strpos($result2->BIOCHEMICAL, 'ESR') !== false) || (strpos($result2->MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'LFT') !== false) || (strpos($result2->SEROLOGYCAL, 'LFT') !== false) || (strpos($result2->BIOCHEMICAL, 'LFT') !== false) || (strpos($result2->MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'RFT') !== false) || (strpos($result2->SEROLOGYCAL, 'RFT') !== false) || (strpos($result2->BIOCHEMICAL, 'RFT') !== false) || (strpos($result2->MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                <?php  if($result2->HEMATOLOGICAL){  echo $result2->HEMATOLOGICAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->SEROLOGYCAL){  echo $result2->SEROLOGYCAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->BIOCHEMICAL){  echo $result2->BIOCHEMICAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->MICROBIOLOGICAL){  echo $result2->MICROBIOLOGICAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->X_RAY){  echo $result2->X_RAY.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->ECG){  echo $result2->ECG.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->USG){  echo $result2->USG.'<br>'; }?>
                                                                                
                                                                                <?php 
                                                                                
                                                                                    $tre_spe_invet = $result2->Sp_Investigations_pandamic;
                                                                                    $ex_spe_invet=explode(",",$tre_spe_invet);
                                                                                    
                                                                                    
                                                                                    if($result2->Sp_Investigations_pandamic){  echo "<br><b>=>".$ex_spe_invet[0];echo "<br>"; echo "<b>=>".$ex_2d_morn[0]; if($ex_spe_invet[1]) { echo "<br>=>".$ex_spe_invet[1].'<br>'; } }?>
                                                                                
                                                                                <?php }?>
                                                                                <?php 
                                                                                   
                                                                                   
                                                                                   if(($result2->Only_2nd_Day_Morning_covid)) {?><b>  <?php echo "<br>"; if($ex_2d_morn[1]) { echo "=>".$ex_2d_morn[1].'<br>'; }echo "<br>";}?></b>
                                                                                 
                                                                                     
                                                                                    <?php  if(($result2->vkarma)){  if(strpos($result2->vkarma, 'KSHAR SUTRA') !== false){ echo "=>".$result2->vkarma.'<br>'; }else{ /*echo "=>".$result2->vkarma.'<br>';*/}}?>
                                                                                    
                                                                                    <?php if($result2->PHYSIOTHERAPY){ ?>
                                                                                    <br><p>Physiotheropy - <?php echo $result2->PHYSIOTHERAPY; ?></p>
                                                                                    <?php } ?>
                                                                                    
                                                                                    
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        
                                                                        <?php if($result2->paschat_karm) {?>
                                                                            <tr style="page-break-after: always;">
                                                                                <td style="border-right: 2px solid #574646;">
                                                                                    <?php 
                                                                                        //echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                        //echo date('d-m-Y',strtotime($ipd_round_date_temp));
                                                                                        echo date('d-m-Y',strtotime($result2->ipd_round_date));
                                                                                        echo "<br> Round ".$count;
                                                                                        echo "<br>";
                                                                                        $a=array("9","9.30","10","10.30","11");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."<br>";
                                                                                        /*if($i%2==0){ 
                                                                                            echo $profile->atime.' AM.'; 
                                                                                        } else{
                                                                                            echo ($time[0]).' '.($time[1] + 9)."   AM";
                                                                                            
                                                                                        } */
                                                                                    ?>
                                                                                </td>
                                                                                <td style="border-right: 2px solid #574646;">
                                                                                    
                                                                                    <?php 
                                                                                    
                                                                                    $str_p_o = $result2->Post_Operative;
                                                                                    $ex_str_p_o=explode(",",$str_p_o);
                                                                                    
                                                                                    $str = $result2->bp;
                                                                                    $ex=explode("/",$str);
                                                                                    ?>
                                                                                    
                                                                                    
                                                                                    Pulse : <?php if($result2->pulse) { echo $result2->pulse." /min"; } else { echo $profile->pulse." /min";} ?><br>
                                                                                    
                                                                                    
                                                                                    नाडी : <?php if($result2->nadi){ echo $result2->nadi;}else { echo $profile->nadi; }?><br>
                                                                                    
                                                                                    
                                                                                    RS: <?php if($result2->rs) { echo $result2->rs; }else { echo $profile->ur; }?><br>  
                                                                                    
                                                                                    CVS : <?php if($result2->cvs){ echo $result2->cvs;} else{echo $profile->cvs;}?><br>
                                                                                    <!--उदर (PA): <?//php if($result2->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $profile->udar;}?>--><br>
                                                                                    
                                                                                    </b>
                                                                                    
                                                                                </td>
                                                                                <td style="border-right: 2px solid #574646;"><?php echo "<b> Post Operative Notes- <br>";  if($result2->Post_Operative) { echo "=>".$ex_str_p_o[0];echo "<br>"; if($ex_str_p_o[1]) { echo "=>".$ex_str_p_o[1].'<br>'; } if($ex_str_p_o[2]) { echo "=>".$ex_str_p_o[2].'<br>'; } if($ex_str_p_o[3]) { echo "=>".$ex_str_p_o[3].'<br>'; } if($ex_str_p_o[4]) { echo "=>".$ex_str_p_o[4].'<br>'; }
                                                                                
                                                                                    if($ex_str_p_o[5]) { echo "=>".$ex_str_p_o[5].'<br>'; } if($ex_str_p_o[6]) { echo "=>".$ex_str_p_o[6].'<br>'; } if($ex_str_p_o[7]) { echo "=>".$ex_str_p_o[7].'<br>'; } if($ex_str_p_o[8]) { echo "=>".$ex_str_p_o[8].'<br>'; } 
                                                                                    if($ex_str_p_o[9]) { echo "=>".$ex_str_p_o[9].'<br>'; } if($ex_str_p_o[10]) { echo "=>".$ex_str_p_o[10].'<br>'; } if($ex_str_p_o[11]) { echo "=>".$ex_str_p_o[11].'<br>'; } if($ex_str_p_o[12]) { echo "=>".$ex_str_p_o[12].'<br>'; } 
                                                                                    if($ex_str_p_o[13]) { echo "=>".$ex_str_p_o[13].'<br>'; } if($ex_str_p_o[14]) { echo "=>".$ex_str_p_o[14].'<br>'; } if($ex_str_p_o[15]) { echo "=>".$ex_str_p_o[15].'<br>'; } if($ex_str_p_o[16]) { echo "=>".$ex_str_p_o[16].'<br>'; } 
                                                                                    if($ex_str_p_o[17]) { echo "=>".$ex_str_p_o[17].'<br>'; } if($ex_str_p_o[18]) { echo "=>".$ex_str_p_o[18].'<br>'; } if($ex_str_p_o[19]) { echo "=>".$ex_str_p_o[19].'<br>'; } if($ex_str_p_o[20]) { echo "=>".$ex_str_p_o[20].'<br>'; } 
                                                                                    if($ex_str_p_o[21]) { echo "=>".$ex_str_p_o[21].'<br>'; } if($ex_str_p_o[22]) { echo "=>".$ex_str_p_o[22].'<br>'; } if($ex_str_p_o[23]) { echo "=>".$ex_str_p_o[23].'<br>'; } if($ex_str_p_o[24]) { echo "=>".$ex_str_p_o[24].'<br>'; } 
                                                                                    echo "</b><br>"; }?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php   }?>
                                                                        
                                                                        
                                                                <?php }  
                                                                    else if($result2 == '' || $result2 == null){ 
                                                                        $count = $count + 1;
                                                    ?>
                                                                        <tr>
                                                                            <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <?php 
                                                                                    //echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                    echo date('d-m-Y',strtotime($ipd_round_date_temp));
                                                                                    echo "<br> Round ".$count;
                                                                                    echo "<br>";
                                                                                    $a=array("9","9.30","10","10.30","11");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."<br>";
                                                                                    /*if($i%2==0){ 
                                                                                        echo $profile->atime.' AM.'; 
                                                                                    } else{
                                                                                        echo ($time[0]).' '.($time[1] + 9)."   AM";
                                                                                        
                                                                                    } */
                                                                                ?>
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <b> C/O :  </b><?php if($result2->sym_name) { echo $result2->sym_name;}?><br>
                                                                                
                                                                                <?php
                                                                                    $num_2=is_numeric($profile->second);
                                                                                    $num_3=is_numeric($profile->three);
                                                                                    $num_4=is_numeric($profile->four);
                                                                                    $num_5=is_numeric($profile->five);
                                                                                    $num_6=is_numeric($profile->six);
                                                                                    $num_7=is_numeric($profile->seven);
                                                                                    $num_8=is_numeric($profile->eight);
                                                                                    $num_9=is_numeric($profile->nine);
                                                                                
                                                                                    if($i==1){ if($num_2==1){ echo "Symptoms reduced by ".$profile->second."%<br>"; } else { echo $profile->second."<br>";} }
                                                                                    else if($i==2){ if($num_3==1){ echo "Symptoms reduced by ".$profile->three."%<br>"; } else { echo $profile->three."<br>";} }
                                                                                    else if($i==3){ if($num_4==1){ echo "Symptoms reduced by ".$profile->four."%<br>"; } else { echo $profile->four."<br>";} }
                                                                                    else if($i==4){ if($num_5==1){ echo "Symptoms reduced by ".$profile->five."%<br>"; } else { echo $profile->five."<br>";} }
                                                                                    
                                                                                    else if($i==5){ if($num_6==1){ echo "Symptoms reduced by ".$profile->six."%<br>"; } else { echo $profile->six."<br>";} }
                                                                                    else if($i==6){ if($num_7==1){ echo "Symptoms reduced by ".$profile->seven."%<br>"; } else { echo $profile->seven."<br>";} }
                                                                                    else if($i==7){ if($num_8==1){ echo "Symptoms reduced by ".$profile->eight."%<br>"; } else { echo $profile->eight."<br>";} }
                                                                                    else if($i==8){ if($num_8==1){ echo "Symptoms reduced by ".$profile->nine."%<br>"; } else { echo $profile->nine."<br>";} }
                                                                                    else { if($i==0) { echo '';} else{ echo "उपशय <br>" ;}}
                                                                                    
                                                                                ?>
                                                                                <b> H/O : </b> <?php if($profile->h_o) { echo $profile->h_o;}?><br>
                                                                                <b> Family History : </b> <?php if($profile->f_o) { echo $profile->f_o;}?><br><br>
                                                                                <b> Pulse :</b> <?php if($profile->pulse) { echo $profile->pulse.'/min';}?><br>
                                                                                <?php 
                                                                                    $str = $bp;
                                                                                    $ex=explode("/",$str);
                                                                                ?>
                                                                                 <?php if($result2->department_id != 32){ ?>BP : <?php echo $profile->bp; ?><br><?php } ?>
                                                                                <!--<b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>-->
                                                                                
                                                                                <!--<b> O/E-</b><br>-->
                                                                                
                                                                                <?php if($profile->tapman) { echo 'Temp :'.$profile->tapman.'ºF<br>';} ?>
                                                                                
                                                                                <?php if($profile->SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>
                                                                                RS : <?php if($profile->rs) { echo $profile->rs;}?><br>  
                                                                                
                                                                                CVS : <?php  if($profile->cvs) { echo $profile->cvs;}?><br>
                                                                                
                                                                                <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                                                                <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                                                                नाडी : <?php if($profile->nadi) { echo $profile->nadi;}?><br>
                                                                                
                                                                                
                                                                                
                                                                                <!--उदर (PA): <?//php $profile->udar;?><br>-->
                                                                                
                                                                                
                                                                                <!--नेत्र : <?php// echo $profile->netra;?><br-->    
                                                                                जिव्हा : <?php echo $profile->givwa;?><br>
                                                                                
                                                                                क्षुधा : <?php echo $profile->shudha; ?><br>
                                                                                <br>
                                                                                
                                                                                
                                                                                आहार : <?php  echo $profile->ahar;?><br> 
                                                                                
                                                                                मल : <?php echo $profile->mal;  ?><br>
                                                                                मूत्र : <?php echo $profile->mutra;?><br> 
                                                                                
                                                                                
                                                                                निद्रा : <?php echo $profile->nidra;?> <br>    </br>
                                                                                
                                                                                
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                               
                                                                                <?php if(($result2->Pr_Op_Medication)) {?><b> - </b> <?php echo " ".$result2->Pr_Op_Medication;echo "<br>";}?>
                                                                                <?php if(($result2->Pr_Op_Medication2nd)) {?><b> - </b> <?php echo " ".$result2->Pr_Op_Medication2nd;echo "<br><br>";}?>
                                                                                <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br><br>
                                                                                    <b> उपक्रम-</b><br> 
                                                                                    
                                                                                    <?php  echo "C.T.ALL";?>
                                                                            </td>
                                                                        </tr>
                                                                
                                                    <?php
                                                                        
                                                                    }
                                                                }
                                                    ?>
                                                    <?php 
                                                                if($ipd_round_date_temp < $profile->discharge_date || $profile->discharge_date=='0000-00-00'){
                                                                    if($result3){
                                                                        $count = $count + 1;
                                                                        
                                                                        $RX1= $result3->RX1;
                                                                        $RX2= $result3->RX2;
                                                                        $RX3= $result3->RX3;
                                                                        $RX4= $result3->RX4;
                                                                        $RX5= $result3->RX5;
                                                                        
                                                                        $RX6= $result3->RX6;
                                                                        $RX7= $result3->RX7;
                                                                        $RX8= $result3->RX8;
                                                                        $RX9= $result3->RX9;
                                                                        $RX10= $result3->RX10;
                                                                        
                                                                        $RX_other= $result3->RX_other; 
                                                                        $RX_other1= $result3->RX_other1; 
                                                                        $other_equipment = $result3->other_equipment; 
                                                    ?>
                                                                        <tr>
                                                                            <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <?php 
                                                                                    //echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                    echo date('d-m-Y',strtotime($ipd_round_date_temp));
                                                                                    echo "<br> Round ".$count;
                                                                                    echo "<br>";
                                                                                    $a=array("9","9.30","10","10.30","11");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."<br>";
                                                                                   /* if($i%2==0){ 
                                                                                        echo $profile->atime.' AM.'; 
                                                                                    } else{
                                                                                        echo ($time[0]).' '.($time[1] + 9)."   AM";
                                                                                        
                                                                                    } */
                                                                                ?>
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                               <!-- <b> C/O :  </b><?php echo "No Fresh Complaint";?><br>-->
                                                                                  <b> C/O :  </b><?php if($result3->sym_name){ echo $result3->sym_name;}else{ echo ""; }?><br>
                                                                                <b> Family History : </b> <?php if($result3->f_o && $ipd_date) { echo $result3->f_o;}?><br><br>
                                                                                <!--<b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>-->
                                                                                
                                                                                <b> O/E-</b><br>
                                                                                <?php $ipd_date = date('d-m-Y',strtotime($ipd_round_date_temp)); ?>
                                                                                <?php if($result3->tapman && $ipd_date){ echo 'Temp :'.$result3->tapman.'ºF<br>';} ?>
                                                                                
                                                                                <?php if($result3->SPO2 && $ipd_date){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>
                                                                                <?php 
                                                                                    $str = $bp;
                                                                                    $ex=explode("/",$str);
                                                                                ?>
                                                                                <b>
                                                                                <?php if($result3->department_id != 32){ ?>BP : <?php if($result3->bp && $ipd_date) { echo $result3->bp."   mm of Hg";}?><br><?php } ?>
                                                                                
                                                                                
                                                                                Pulse : <?php if($result3->pulse && $ipd_date) { echo $result3->pulse.'/min';}?><br>
                                                                                
                                                                                
                                                                                नाडी : <?php if($result3->nadi) { echo $result3->nadi;}?><br>
                                                                                
                                                                                
                                                                                RS: <?php if($result3->rs) { echo $result3->rs;}?><br>  
                                                                                
                                                                                CVS : <?php  if($result3->cvs) { echo $result3->cvs;}?><br>
                                                                                <!--उदर (PA): <?//php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>-->
                                                                        
                                                                                </b>
                                                                              
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <b>
                                                                                    <?php 
                                                                                        $tre_icu = $result3->ICU_Order;
                                                                                        $ex_icu=explode(",",$tre_icu);
                                                                                        if(($result3->ICU_Order))  {
                                                                                            if($ex_icu[0]) { 
                                                                                                echo "=>".$ex_icu[0].'<br>'; 
                                                                                            }  
                                                                                            if($ex_icu[1]) { 
                                                                                                echo "=>".$ex_icu[1].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[2]) { 
                                                                                                echo "=>".$ex_icu[2].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[3]) { 
                                                                                                echo "=>".$ex_icu[3].'<br>'; 
                                                                                            }   
                                                                                            if($ex_icu[4]) { 
                                                                                                echo "=>".$ex_icu[4].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[5]) { 
                                                                                                echo "=>".$ex_icu[5].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[6]) { 
                                                                                                echo "=>".$ex_icu[6].'<br>'; 
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                </b> 
                                                                                <?php 
                                                                                    $tre_1STDOSE = $result3->Only_1st_Dose;
                                                                                    $ex_1STDOSE=explode(",",$tre_1STDOSE);
                                                                                    if(!empty($result3->Post_Operative)) {  
                                                                                        echo "=> ".$ex_1STDOSE[0];echo "<br>"; 
                                                                                        if($ex_1STDOSE[1]) { 
                                                                                            echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                        } 
                                                                                        if($ex_1STDOSE[2]) { 
                                                                                            echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                        }
                                                                                    } else if(($result3->Only_1st_Dose)) {
                                                                                ?>
                                                                                <b> =></b> 
                                                                                <?php 
                                                                                        echo "".$ex_1STDOSE[0];echo "<br>"; 
                                                                                        if($ex_1STDOSE[1]) { 
                                                                                            echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                        } 
                                                                                        if($ex_1STDOSE[2]) { 
                                                                                            echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                        }
                                                                                    } else {}?>
                                                                                <?php 
                                                                                    if((($result3->VAMAN)  || ($result3->RAKTAMOKSHAN) || ($result3->SHIRODHARA_SHIROBASTI) || ($result3->skarma)))  {
                                                                                ?>
                                                                                <b>
                                                                                <?php 
                                                                                        echo " ".$result3->skarma;
                                                                                ?>
                                                                                </b><br>
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                                <b>
                                                                                <?php  
                                                                                    if(($result3->Pr_Op_Medication)) {
                                                                                ?>
                                                                                <?php 
                                                                                        echo "=>".$result3->Pr_Op_Medication;
                                                                                        echo "<br>";
                                                                                    }
                                                                                ?>
                                                                                <?php  
                                                                                    if(($result3->Pr_Op_Medication2nd)) {
                                                                                ?>
                                                                                <?php 
                                                                                        echo "=>".$result3->Pr_Op_Medication2nd;
                                                                                        echo "<br>";
                                                                                    }
                                                                                ?>
                                                                                </b><br>
                                                                                <?php if($RX1 || $RX2 || $RX3 || $RX4 || $RX5 || $RX6 || $RX7 || $RX8 || $RX9 || $RX10 || $RX_other || $RX_other1 || $other_equipment){?>
                                                                                    <b> RX - </b> 
                                                                                    <?php 
                                                                                        $tre_rx1 = $RX1;
                                                                                        $ex=explode(",",$tre_rx1);
                                                                                        $tre_rx2 = $RX2;
                                                                                        $ex2=explode(",",$tre_rx2);
                                                                                        $tre_rx4 = $RX3;
                                                                                        $ex3=explode(",",$tre_rx4);
                                                                                        $tre_rx4 = $RX4;
                                                                                        $ex4=explode(",",$tre_rx4);
                                                                                        $tre_rx5 = $RX5;
                                                                                        $ex5=explode(",",$tre_rx5);
                                                                                         $tre_rx6 = $RX6;
                                                                                        $ex6=explode(",",$tre_rx6);
                                                                                        $tre_rx7 = $RX7;
                                                                                        $ex7=explode(",",$tre_rx7);
                                                                                        $tre_rx8 = $RX8;
                                                                                        $ex8=explode(",",$tre_rx8);
                                                                                        $tre_rx9 = $RX9;
                                                                                        $ex9=explode(",",$tre_rx9);
                                                                                        $tre_rx10 = $RX10;
                                                                                        $ex10=explode(",",$tre_rx10);
                                                                                        
                                                                                         $tre_rx_other = $RX_other;
                                                                                        $ex11=explode(",",$tre_rx_other);
                                                                                        //echo "$tre_rx_other";
                                                                                        $tre_rx_other1 = $RX_other1;
                                                                                        $ex12=explode(",",$tre_rx_other1);
                                                                                        
                                                                                        
                                                                                        $tre_other_equipment = $other_equipment;
                                                                                        $ex13=explode(",",$tre_other_equipment);
                                                                                        
                                                                                    ?>
                                                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>

                                                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                 <?php if($RX_other) { $ex_x110=explode("x",$ex11[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex11[1]) { $ex_x111=explode("x",$ex11[1]); echo "=>".$ex_x111[0].'<br>'; } if($ex11[2]) { $ex_x111=explode("x",$ex11[2]); echo "=>".$ex_x112[0].'<br>'; }}?>
                                                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex12[0]);  echo "=>".$ex_x120[0];echo "<br>";  if($ex12[1]) { $ex_x121=explode("x",$ex12[1]); echo "=>".$ex_x121[0].'<br>'; } if($ex12[2]) { $ex_x121=explode("x",$ex12[2]); echo "=>".$ex_x122[0].'<br>'; }}?>
                                                                                   
                                                                                   
 																				<?php if($other_equipment)
                                                                                    {
                                                                                      $test = explode(",",$other_equipment);
                                                                                      $count = count($test);
                                                                                      for($i=0;$i<$count;$i++)
                                                                                      {
                                                                                        echo $test[$i].'<br>';
                                                                                      }
                                                                                    }                                                                                   
                                                                          ?>                                                                                    
                                                                                    <br>
                                                                                    
                                                                                <?php 
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                ?>
                                                                                       <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br>
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                                 <b> उपक्रम-</b><br>   
                                                                                 
                                                                                <?php if(($result3->SNEHAN) || ($result3->SWEDAN) || ($result3->VAMAN) || ($result3->VIRECHAN) || ($result3->BASTI) || ($result3->NASYA) || ($result3->RAKTAMOKSHAN) || ($result3->SHIRODHARA_SHIROBASTI) || ($result3->OTHER) || ($result3->SWA1) || ($result3->SWA2)){?>
                                                                                   
                                                                                    <?php  if($result3->SNEHAN){  echo $result3->SNEHAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result3->SWEDAN){  echo $result3->SWEDAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if(($result3->VAMAN)  && ($i==0)) {  echo $result3->VAMAN.'<br>';  $VAMAN_1D=$result3->VAMAN;  }?>
                                                                                    
                                                                                    <?php  if($result3->VIRECHAN){  echo $result3->VIRECHAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result3->BASTI){  echo $result3->BASTI.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result3->NASYA){  echo $result3->NASYA.'<br>'; }?>
                                                                                    
                                                                                    <?php  if(($result3->RAKTAMOKSHAN)  && ($i==0)) { echo $result3->RAKTAMOKSHAN.'<br>'; }?>
                                                                                    
                                                                                    <?php  if(($result3->SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo $result3->SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                                                    
                                                                                    <?php if($result3->OTHER){  if(strpos($result3->OTHER, '1D') !== false) { if($i==0) { echo $result3->OTHER.'<br> '; $OTHER_1D=$result3->OTHER; } else{ echo '';} }  else { echo $result3->OTHER.'<br>'; } }?>
                                                                                    
                                                                                    <?php  if($result3->SWA1){  echo $result3->SWA1.'<br>'; }?>
                                                                                    
                                                                                    <?php  if($result3->SWA2){  echo $result3->SWA2.'<br>'; }?>
                                                                                <?php 
                                                                                    }
                                                                                    else{
                                                                                        echo "C.T.ALL";
                                                                                    }
                                                                                ?>
                                                                                
                                                                                
                                                                                <?php
                                                                                $tre_covid_2nd_morning = $result3->Only_2nd_Day_Morning_covid;
                                                                                $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                                                                
                                                                                //if((($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)  || ($Sp_Investigations_pandamic)) && ($i==0)){
                                                                                // if(($result3->HEMATOLOGICAL) || ($result3->SEROLOGYCAL) || ($result3->BIOCHEMICAL) || ($result3->MICROBIOLOGICAL) || ($result3->X_RAY) || ($result3->ECG) || ($result3->USG) || ($result3->Sp_Investigations_pandamic)){
                                                                                if(($result3->HEMATOLOGICAL!='') || ($result3->SEROLOGYCAL!='') || ($result3->BIOCHEMICAL!='') || ($result3->MICROBIOLOGICAL!='') || ($result3->X_RAY!='') || ($result3->ECG!='') || ($result3->USG!='') || ($result3->Sp_Investigations_pandamic!='')){
                                                                            ?>
                                                                                <br>
                                                                                <b> Adv- </b><br>
                                                                                
                                                                                <?php //if((strpos($result3->HEMATOLOGICAL, 'CBC') !== false) || (strpos($result3->SEROLOGYCAL, 'CBC') !== false) || (strpos($result3->BIOCHEMICAL, 'CBC') !== false) || (strpos($result3->MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                                                                <?php //if((strpos($result3->HEMATOLOGICAL, 'ESR') !== false) || (strpos($result3->SEROLOGYCAL, 'ESR') !== false) || (strpos($result3->BIOCHEMICAL, 'ESR') !== false) || (strpos($result3->MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                                                                <?php //if((strpos($result3->HEMATOLOGICAL, 'LFT') !== false) || (strpos($result3->SEROLOGYCAL, 'LFT') !== false) || (strpos($result3->BIOCHEMICAL, 'LFT') !== false) || (strpos($result3->MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                                                                <?php //if((strpos($result3->HEMATOLOGICAL, 'RFT') !== false) || (strpos($result3->SEROLOGYCAL, 'RFT') !== false) || (strpos($result3->BIOCHEMICAL, 'RFT') !== false) || (strpos($result3->MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                <?php  if($result3->HEMATOLOGICAL){  echo $result3->HEMATOLOGICAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->SEROLOGYCAL){  echo $result3->SEROLOGYCAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->BIOCHEMICAL){  echo $result3->BIOCHEMICAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->MICROBIOLOGICAL){  echo $result3->MICROBIOLOGICAL.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->X_RAY){  echo $result3->X_RAY.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->ECG){  echo $result3->ECG.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->USG){  echo $result3->USG.'<br>'; }?>
                                                                                
                                                                                <?php 
                                       
                                                                                   $tre_spe_invet = $result3->Sp_Investigations_pandamic;
                                                                                    $ex_spe_invet=explode(",",$tre_spe_invet);
                                                                                    
                                                                                    
                                                                                   if($result3->Sp_Investigations_pandamic){  echo "<br><b>=>".$ex_spe_invet[0];echo "<br>"; echo "<b>=>".$ex_2d_morn[0]; if($ex_spe_invet[1]) { echo "<br>=>".$ex_spe_invet[1].'<br>'; } }?>
                                                                                   
                                                                                    <?php }?>
                                                                                    
                                                                                   <?php 
                                                                                   
                                                                                   
                                                                                   if(($result3->Only_2nd_Day_Morning_covid)) {?><b>  <?php echo "<br>"; if($ex_2d_morn[1]) { echo "=>".$ex_2d_morn[1].'<br>'; }echo "</b><br>";}?>
                                                                                 
                                                                                     
                                                                                    <?php  if(($result3->vkarma)){  if(strpos($result3->vkarma, 'KSHAR SUTRA') !== false){ echo "=>".$result3->vkarma.'<br>'; }else{/*echo "=>".$result3->vkarma.'<br>';*/}}?>
                                                                            
                                                                            
                                                                                    <?php if($result3->PHYSIOTHERAPY){ ?>
                                                                                    <br><p>Physiotheropy - <?php echo $result3->PHYSIOTHERAPY; ?></p>
                                                                                    <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                <?php }  
                                                                    else if($result3 == '' || $result3 == null){ 
                                                                        $count = $count + 1;
                                                    ?>
                                                                        <tr>
                                                                            <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <?php 
                                                                                    //echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                    echo date('d-m-Y',strtotime($ipd_round_date_temp));
                                                                                    echo "<br> Round ".$count;
                                                                                    echo "<br>";
                                                                                    $a=array("6","6.30","7","7.30","8");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."PM";
                                                                                    /*if($i%2==0){ 
                                                                                        echo $profile->atime.' PM.'; 
                                                                                    } else{
                                                                                        echo ($time[0]).' '.($time[1] + 9)."   PM";
                                                                                        
                                                                                    } */
                                                                                ?>
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <b> C/O :  </b><?php if($result3->sym_name){ echo $result3->sym_name;}else{ echo ""; }?><br>
                                                                                <b> Family History : </b> <?php if(!empty($profile->f_h)) { echo $profile->f_h.'<br>';} else { echo ''.$f_h;}?><br><br>
                                                                                <b> O/E-  </b><br>
                                                                                <?php if(!empty($profile->tapman)){ echo $profile->tapman; }else { echo ""; } ?>                                                                    <?php $str = $bp;
                                                                                $ex=explode("/",$str);
                                                                                ?>
                                                                                <b>
                                                                                <!--<?php if($profile->department_id != 32){ ?>BP : <?php if(!empty($profile->bp)){ echo $profile->bp." mm of Hg";  }else{   echo "190/100 mm of Hg"; }?><br><?php } ?>
                                                                                
                                                                                Pulse : <?php if($profile->pulse) { echo $profile->pulse." mm of Hg"; } else { echo "78 /min";} ?><br>
                                                                                
                                                                                नाडी : <?php if($profile->nadi){ echo $profile->nadi;}else { echo "सर्पगती"; }?><br>
                                                                                RS: <?php if($profile->rs) { echo $profile->rs; }else {  echo "अविशेष"; }?><br>
                                                                                
                                                                                CVS : <?php echo $profile->cvs;?><br>
                                                                                उदर (PA): <?//php if($profile->pa) { echo $profile->pa;} else { echo "soft";}?><br>
                                                                                 -->
                                                                                 
                                                                                 <?php if($profile->department_id != 32){ ?>BP : <?php if(!empty($profile->bp)){ echo $profile->bp." mm of Hg";  }else{   echo ""; }?><br><?php } ?>
                                                                                
                                                                                Pulse : <?php if($profile->pulse) { echo $profile->pulse." mm of Hg"; } else { echo "";} ?><br>
                                                                                
                                                                                नाडी : <?php if($profile->nadi){ echo $profile->nadi;}else { echo ""; }?><br>
                                                                                RS: <?php if($profile->rs) { echo $profile->rs; }else {  echo ""; }?><br>
                                                                                
                                                                                CVS : <?php echo $profile->cvs;?><br>
                                                                                <!--उदर (PA): <?//php if($profile->pa) { echo $profile->pa;} else { echo "";}?><br>-->
                                                                                
                                                                                </b>
                            
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                <?php if($result3->Pr_Op_Medication) {?><b> - </b> <?php echo " ".$result3->Pr_Op_Medication;echo "<br>";}?>
                                                                                <?php if($result3->Pr_Op_Medication2nd) {?><b> - </b> <?php echo " ".$result3->Pr_Op_Medication2nd;echo "<br><br>";}?>
                                                                                <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br><br>
                                                                                <b> उपक्रम-</b><br> 
                                                                                    
                                                                                <?php  echo "C.T.ALL";?>
                                                                            </td>
                                                                        </tr>
                                                                <?php } 
                                                                }
                                                    ?>
                                                    <?php 
                                                                if($count == 2){ $count = 0;}
                                                    ?>
                                                    <?php
                                                            }
                                                    ?>
                                                    <?php
                                                        }
                                                        elseif($days == '1'){
                                                         // echo "hiiiii";
                                                    ?>
                                                    <?php 
                                                            
                                                            $result2= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'1', 'ipd_round_date'=>$rs1->ipd_round_date])
                                                                        ->order_by('ipd_round_date', 'ASC')
                                                                        ->get('manual_treatments')
                                                                        ->row();
                                                          //print_r($this->db->last_query());
                                                            $result3= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'2', 'ipd_round_date'=>$rs1->ipd_round_date])
                                                                        ->order_by('ipd_round_date', 'ASC')
                                                                        ->get('manual_treatments')
                                                                        ->row();
                                                            //print_r($this->db->last_query());
                                                            
                                                    ?>
                                                    
                                                    <?php 
                                                          if($rs1->ipd_round_date <= $profile->discharge_date || $profile->discharge_date == '0000-00-00' &&  $result2->rounds == '1')
                                                          {
                                                           // echo "hiiii";
                                                          }
                                                         // echo $rs1->ipd_round_date;
                                                            if($rs1->ipd_round_date <= $profile->discharge_date || $profile->discharge_date=='0000-00-00' && $result2->rounds == '1'){
                                                                
                                                              //echo "hiiiiiii<br>";
                                                              if($result2){
                                                                    $count = $count + 1;
                                                            ?>
                                                                    <tr>
                                                                        <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <?php 
                                                                                echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                echo "<br> Round ".$count;
                                                                                echo "<br>";
                                                                                 $a=array("9","9.30","10","10.30","11");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."AM";
                                                                                /*if($i%2==0){ 
                                                                                    echo $profile->atime.' AM.'; 
                                                                                } else{
                                                                                    echo ($time[0]).' '.($time[1] + 9)."   PM";
                                                                                    
                                                                                } */
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <b> C/O :  </b><?php if($result2->sym_name) 
                                                                            { 
                                                                               $array_sym = explode(",",$result2->sym_name);
                                                                                //print_r($array_sym);
                                                                                //echo $result2->sym_name;echo "<br>";
                                                                                echo $array_sym[0];echo "<br>";
                                                                                echo $array_sym[1];echo "<br>";
                                                                                echo $array_sym[2];echo "<br>";
                                                                                echo $array_sym[3];echo "<br>";
                                                                            }?><br>
                                                                            <?php
                                                                                $num_2=is_numeric($profile->second);
                                                                                $num_3=is_numeric($profile->three);
                                                                                $num_4=is_numeric($profile->four);
                                                                                $num_5=is_numeric($profile->five);
                                                                                $num_6=is_numeric($profile->six);
                                                                                $num_7=is_numeric($profile->seven);
                                                                                $num_8=is_numeric($profile->eight);
                                                                                $num_9=is_numeric($profile->nine);
                                                                            
                                                                                if($i==1){ if($num_2==1){ echo "Symptoms reduced by ".$profile->second."%<br>"; } else { echo $profile->second."<br>";} }
                                                                                else if($i==2){ if($num_3==1){ echo "Symptoms reduced by ".$profile->three."%<br>"; } else { echo $profile->three."<br>";} }
                                                                                else if($i==3){ if($num_4==1){ echo "Symptoms reduced by ".$profile->four."%<br>"; } else { echo $profile->four."<br>";} }
                                                                                else if($i==4){ if($num_5==1){ echo "Symptoms reduced by ".$profile->five."%<br>"; } else { echo $profile->five."<br>";} }
                                                                                
                                                                                else if($i==5){ if($num_6==1){ echo "Symptoms reduced by ".$profile->six."%<br>"; } else { echo $profile->six."<br>";} }
                                                                                else if($i==6){ if($num_7==1){ echo "Symptoms reduced by ".$profile->seven."%<br>"; } else { echo $profile->seven."<br>";} }
                                                                                else if($i==7){ if($num_8==1){ echo "Symptoms reduced by ".$profile->eight."%<br>"; } else { echo $profile->eight."<br>";} }
                                                                                else if($i==8){ if($num_8==1){ echo "Symptoms reduced by ".$profile->nine."%<br>"; } else { echo $profile->nine."<br>";} }
                                                                                else { if($i==0) { echo '';} else{ echo "उपशय <br>" ;}}
                                                                                
                                                                            ?>
                                                                            <b> H/O : </b> <?php if($result2->h_o) { echo $result2->h_o;}?><br>
                                                                            <b> Family History : </b> <?php if($result2->f_o) { echo $result2->f_o;}?><br><br>
                                                                            <!--<b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>-->
                                                                            <b> E/O : </b> <?php if($result2->e_o) { echo $result2->e_o;}?><br>
                                                                            <b> KCO : </b> <?php if($result2->kco) { echo $result2->kco;}?><br>
                                                                            <b> O/E-</b><br>
                                                                            
                                                                            <?php if($result2->tapman) { echo 'Temp :'.$result2->tapman.'ºF<br>';} ?>
                                                                            
                                                                            <?php if($result2->SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>
                                                                            <?php 
                                                                                $str = $bp;
                                                                                $ex=explode("/",$str);
                                                                            ?>
                                                                            <b>
                                                                            <?php if($result2->department_id != 32){ ?>BP : <?php if($result2->bp) { echo $result2->bp."   mm of Hg";}else{ echo $profile->bp;}?><br><?php } ?>
                                                                            
                                                                            
                                                                            Pulse : <?php if($result2->pulse) { echo $result2->pulse.'/min';}?><br>
                                                                            
                                                                            RS: <?php if($result2->rs) { echo $result2->rs;}?><br>  
                                                                            
                                                                            CVS : <?php  if($result2->cvs) { echo $result2->cvs;}?><br>
                                                                            <!--उदर (PA): <?//php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>-->
                                                                            <!--उदर (PA): <?//php  if($result2->pa) { echo $result2->pa;}?><br><br>-->
                                                                            
                                                                            
                                                                            
                                                                            <!-- नेत्र : <?//php  if($result2->netra) { echo $result2->netra;}?>--><br>   
                                                                            
                                                                            <?php if(($result2->Input)){ echo '<b>I/O Chart:</b><br>';$ex_Input=explode(",",$profile->Input); if($profile->department_id=='32'){ echo 'Input: '.($ex_Input[$i]- 800).'ml';} else if($profile->sex=='M') {  echo 'Input: '.$ex_Input[$i].'ml';} else { echo 'Input: '.($ex_Input[$i]- 200).'ml';} }?> <br>
                                                                            <?php if(($result2->Output)){ $ex_Output=explode(",",$profile->Output);  if($profile->department_id=='32'){ echo 'Output: '.($ex_Output[$i]- 600).'ml'; } else if($profile->sex=='M') { echo 'Output: '.$ex_Output[$i].'ml';} else { echo 'Output: '.($ex_Output[$i]- 200).'ml'; }}?> <br>
                                                                            </b>
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                                
                                                                                <b>
                                                                                    <?php 
                                                                                        $tre_icu = $result2->ICU_Order;
                                                                                        $ex_icu=explode(",",$tre_icu);
                                                                                        if(($result2->ICU_Order))  {
                                                                                            if($ex_icu[0]) { 
                                                                                                echo "=>".$ex_icu[0].'<br>'; 
                                                                                            }  
                                                                                            if($ex_icu[1]) { 
                                                                                                echo "=>".$ex_icu[1].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[2]) { 
                                                                                                echo "=>".$ex_icu[2].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[3]) { 
                                                                                                echo "=>".$ex_icu[3].'<br>'; 
                                                                                            }   
                                                                                            if($ex_icu[4]) { 
                                                                                                echo "=>".$ex_icu[4].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[5]) { 
                                                                                                echo "=>".$ex_icu[5].'<br>'; 
                                                                                            } 
                                                                                            if($ex_icu[6]) { 
                                                                                                echo "=>".$ex_icu[6].'<br>'; 
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                </b> 
                                                                                <?php 
                                                                                    $tre_1STDOSE = $result2->Only_1st_Dose;
                                                                                    $ex_1STDOSE=explode(",",$tre_1STDOSE);
                                                                                    if(!empty($result2->Post_Operative)) {  
                                                                                        echo "=> ".$ex_1STDOSE[0];echo "<br>"; 
                                                                                        if($ex_1STDOSE[1]) { 
                                                                                            echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                        } 
                                                                                        if($ex_1STDOSE[2]) { 
                                                                                            echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                        }
                                                                                    } else if(($result2->Only_1st_Dose)) {
                                                                                ?>
                                                                                <b> =></b> 
                                                                                <?php 
                                                                                        echo "".$ex_1STDOSE[0];echo "<br>"; 
                                                                                        if($ex_1STDOSE[1]) { 
                                                                                            echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                        } 
                                                                                        if($ex_1STDOSE[2]) { 
                                                                                            echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                        }
                                                                                    } else {}?>
                                                                                <?php 
                                                                                    if((($result2->VAMAN)  || ($result2->RAKTAMOKSHAN) || ($result2->SHIRODHARA_SHIROBASTI) || ($result2->skarma)))  {
                                                                                ?>
                                                                                <b>
                                                                                <?php 
                                                                                        echo " ".$result2->skarma;
                                                                                ?>
                                                                                </b><br>
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                                <b>
                                                                                <?php  
                                                                                    if($result2->Pr_Op_Medication) {
                                                                                ?>
                                                                                <?php 
                                                                                        echo "=>".$result2->Pr_Op_Medication;
                                                                                        echo "<br>";
                                                                                    }
                                                                                ?>
                                                                                <?php  
                                                                                    if($result2->Pr_Op_Medication2nd) {
                                                                                ?>
                                                                                <?php 
                                                                                        echo "=>".$result2->Pr_Op_Medication2nd;
                                                                                        echo "<br>";
                                                                                    }
                                                                                ?>
                                                                                </b><br>
                                                                                
                                                                                <b> RX - </b> 
                                                                                <?php 
                                                                                    
                                                                                    $RX1= $result2->RX1;
                                                                                    $RX2= $result2->RX2;
                                                                                    $RX3= $result2->RX3;
                                                                                    $RX4= $result2->RX4;
                                                                                    $RX5= $result2->RX5;
                                                                                    
                                                                                    $RX6= $result2->RX6;
                                                                                    $RX7= $result2->RX7;
                                                                                    $RX8= $result2->RX8;
                                                                                    $RX9= $result2->RX9;
                                                                                    $RX10= $result2->RX10;
                                                                                    
                                                                                    $RX_other= $result2->RX_other; 
                                                                                    $RX_other1= $result2->RX_other1; 
                                                                                    $other_equipment= $result2->other_equipment; 
                                                                                    
                                                                                    $tre_rx1 = $RX1;
                                                                                    $ex=explode(",",$tre_rx1);
                                                                                    $tre_rx2 = $RX2;
                                                                                    $ex2=explode(",",$tre_rx2);
                                                                                    $tre_rx4 = $RX3;
                                                                                    $ex3=explode(",",$tre_rx4);
                                                                                    $tre_rx4 = $RX4;
                                                                                    $ex4=explode(",",$tre_rx4);
                                                                                    $tre_rx5 = $RX5;
                                                                                    $ex5=explode(",",$tre_rx5);
                                                                                     
                                                                                     $tre_rx6 = $RX6;
                                                                                        $ex6=explode(",",$tre_rx6);
                                                                                        $tre_rx7 = $RX7;
                                                                                        $ex7=explode(",",$tre_rx7);
                                                                                        $tre_rx8 = $RX8;
                                                                                        $ex8=explode(",",$tre_rx8);
                                                                                        $tre_rx9 = $RX9;
                                                                                        $ex9=explode(",",$tre_rx9);
                                                                                        $tre_rx10 = $RX10;
                                                                                        $ex10=explode(",",$tre_rx10);
                                                                                        
                                                                                        $tre_other = $RX_other;
                                                                                        $ex_other=explode(",",$tre_rx5);
                                                                                        $tre_other1 = $RX_other1;
                                                                                        $ex_other1=explode(",",$tre_rx5);
                                                                                    ?>
                                                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                                                                    
                                                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                   <!-- <?php if($RX_other) { $ex_x110=explode("x",$ex11[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex11[1]) { $ex_x111=explode("x",$ex11[1]); echo "=>".$ex_x111[0].'<br>'; } if($ex11[2]) { $ex_x111=explode("x",$ex11[2]); echo "=>".$ex_x112[0].'<br>'; }}?>
                                                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex12[0]);  echo "=>".$ex_x120[0];echo "<br>";  if($ex12[1]) { $ex_x121=explode("x",$ex21[1]); echo "=>".$ex_x121[0].'<br>'; } if($ex12[2]) { $ex_x121=explode("x",$ex12[2]); echo "=>".$ex_x122[0].'<br>'; }}?>-->
                                                                                    
                                                                                    
                                                                                    <?php if($RX_other) { echo '=> '.$RX_other;echo "<br>";}?><br>
                                                                                    <?php if($RX_other1) { echo '=> '.$RX_other1;echo "<br>";}?><br>
                                                                          
                                                                          <?php if($other_equipment)
                                                                                    {
                                                                                      $test = explode(",",$other_equipment);
                                                                                      $count = count($test);
                                                                                      for($i=0;$i<$count;$i++)
                                                                                      {
                                                                                        echo $test[$i].'<br>';
                                                                                      }
                                                                                    }                                                                                   
                                                                          ?>
                                                                                
                                                                            <?php if(($result2->SNEHAN) || ($result2->SWEDAN) || ($result2->VAMAN) || ($result2->VIRECHAN) || ($result2->BASTI) || ($result2->NASYA) || ($result2->RAKTAMOKSHAN) || ($result2->SHIRODHARA_SHIROBASTI) || ($result2->OTHER) || ($result2->SWA1) || ($result2->SWA2)){?>
                                                                            <b> उपक्रम-</b><br>   
                                                                                
                                                                                <?php  if($result2->SNEHAN){  echo $result2->SNEHAN.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->SWEDAN){  echo $result2->SWEDAN.'<br>'; }?>
                                                                                
                                                                                <?php  if(($result2->VAMAN)  && ($i==0)) {  echo $result2->VAMAN.'<br>';  $VAMAN_1D=$result2->VAMAN;  }?>
                                                                                
                                                                                <?php  if($result2->VIRECHAN){  echo $result2->VIRECHAN.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->BASTI){  echo $result2->BASTI.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->NASYA){  echo $result2->NASYA.'<br>'; }?>
                                                                                
                                                                                <?php  if(($result2->RAKTAMOKSHAN)  && ($i==0)) { echo $result2->RAKTAMOKSHAN.'<br>'; }?>
                                                                                
                                                                                <?php  if(($result2->SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo $result2->SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                                                
                                                                                <?php if($result2->OTHER){  if(strpos($result2->OTHER, '1D') !== false) { if($i==0) { echo $result2->OTHER.'<br> '; $OTHER_1D=$result2->OTHER; } else{ echo '';} }  else { echo $result2->OTHER.'<br>'; } }?>
                                                                                
                                                                                <?php  if($result2->SWA1){  echo $result2->SWA1.'<br>'; }?>
                                                                                
                                                                                <?php  if($result2->SWA2){  echo $result2->SWA2.'<br>'; }?>
                                                                            <?php }?>
                                                                            
                                                                            <?php
                                                                            $tre_covid_2nd_morning = $result2->Only_2nd_Day_Morning_covid;
                                                                            $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                                                            
                                                                            //if((($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)  || ($Sp_Investigations_pandamic)) && ($i==0)){
                                                                            // if(($result2->HEMATOLOGICAL) || ($result2->SEROLOGYCAL) || ($result2->BIOCHEMICAL) || ($result2->MICROBIOLOGICAL) || ($result2->X_RAY) || ($result2->ECG) || ($result2->USG) || ($result2->Sp_Investigations_pandamic)){
                                                                            if(($result2->HEMATOLOGICAL!='') || ($result2->SEROLOGYCAL!='') || ($result2->BIOCHEMICAL!='') || ($result2->MICROBIOLOGICAL!='') || ($result2->X_RAY!='') || ($result2->ECG!='') || ($result2->USG!='') || ($result2->Sp_Investigations_pandamic!='')){
                                                                        ?>
                                                                            <br>
                                                                            <b> Adv- </b><br>
                                                                            
                                                                            <?php //if((strpos($result2->HEMATOLOGICAL, 'CBC') !== false) || (strpos($result2->SEROLOGYCAL, 'CBC') !== false) || (strpos($result2->BIOCHEMICAL, 'CBC') !== false) || (strpos($result2->MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                                                            <?php //if((strpos($result2->HEMATOLOGICAL, 'ESR') !== false) || (strpos($result2->SEROLOGYCAL, 'ESR') !== false) || (strpos($result2->BIOCHEMICAL, 'ESR') !== false) || (strpos($result2->MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                                                            <?php //if((strpos($result2->HEMATOLOGICAL, 'LFT') !== false) || (strpos($result2->SEROLOGYCAL, 'LFT') !== false) || (strpos($result2->BIOCHEMICAL, 'LFT') !== false) || (strpos($result2->MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                                                            <?php //if((strpos($result2->HEMATOLOGICAL, 'RFT') !== false) || (strpos($result2->SEROLOGYCAL, 'RFT') !== false) || (strpos($result2->BIOCHEMICAL, 'RFT') !== false) || (strpos($result2->MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            <?php  if($result2->HEMATOLOGICAL){  echo $result2->HEMATOLOGICAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result2->SEROLOGYCAL){  echo $result2->SEROLOGYCAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result2->BIOCHEMICAL){  echo $result2->BIOCHEMICAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result2->MICROBIOLOGICAL){  echo $result2->MICROBIOLOGICAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result2->X_RAY){  echo $result2->X_RAY.'<br>'; }?>
                                                                            
                                                                            <?php  if($result2->ECG){  echo $result2->ECG.'<br>'; }?>
                                                                            
                                                                            <?php  if($result2->USG){  echo $result2->USG.'<br>'; }?>
                                                                            
                                                                            <?php 
                                                                                    
                                                                                $tre_spe_invet = $result2->Sp_Investigations_pandamic;
                                                                                $ex_spe_invet=explode(",",$tre_spe_invet);
                                                                                
                                                                                
                                                                                if($result2->Sp_Investigations_pandamic){  echo "<br><b>=>".$ex_spe_invet[0];echo "<br>"; echo "<b>=>".$ex_2d_morn[0]; if($ex_spe_invet[1]) { echo "<br>=>".$ex_spe_invet[1].'<br>'; } }?>
                                                                            
                                                                            <?php }?>
                                                                            <?php 
                                                                               
                                                                               
                                                                               if(($result2->Only_2nd_Day_Morning_covid)) {?><b><br>  <?php if($ex_2d_morn[1]) { echo "=>".$ex_2d_morn[1].'<br>'; }}?></b><br>
                                                                             
                                                                                 
                                                                                <?php  if(($result2->vkarma)){  if(strpos($result2->vkarma, 'KSHAR SUTRA') !== false){ echo "=>".$result2->vkarma.'<br>'; }else{/*echo "=>".$result2->vkarma.'<br>';*/}}?>
                
                                                                                <?php if($result2->PHYSIOTHERAPY){ ?>
                                                                                    <br><p>Physiotheropy - <?php echo $result2->PHYSIOTHERAPY; ?></p>
                                                                                    <?php } ?>
                                                                                
                                                                        </td>
                                                                    </tr>
                                                                    <?php if(($result2->paschat_karm)) {?>
                                                                        <tr style="page-break-after: always;">
                                                                            <td style="border-right: 2px solid #574646;">
                                                                                <?php 
                                                                                    //echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                    //echo date('d-m-Y',strtotime($ipd_round_date_temp));
                                                                                 //  echo date('d-m-Y',strtotime($result2->ipd_round_date));
                                                                                 //  echo "<br> Round ".$count;
                                                                                 //  echo "<br>";
                                                                                 //  $a=array("6","6.30","7","7.30","8");
                                                                                 //  $random_keys=array_rand($a,2);
                                                                                 //  echo $a[$random_keys[0]]."PM";
                                                                                    /*if($i%2==0){ 
                                                                                        echo $profile->atime.' AM.'; 
                                                                                    } else{
                                                                                        echo ($time[0]).' '.($time[1] + 9)."   PM";
                                                                                        
                                                                                    } */
                                                                                ?>
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;">
                                                                                
                                                                                <?php 
                                                                                
                                                                                $str_p_o = $result2->paschat_karm;
                                                                                $ex_str_p_o=explode(",",$str_p_o);
                                                                                
                                                                                $str = $result2->bp;
                                                                                $ex=explode("/",$str);
                                                                                ?>
                                                                               <!-- <?//php if($result2->department_id != 32){ ?><b> BP : <?//php if((empty($result2->bp))) {   echo "200/110 mm of Hg"; }  else if($result2->bp) { if($ex[0]%2==0){ echo ($ex[0] + 2).'/'.($ex[1] + 2)."   mm of Hg";} else{ echo $result2->bp,"   mm of Hg";}} ?><br><?//
                                                                              // php } ?>-->
                                                                                  <?//php if($result2->department_id != 32){ ?><!--<b> BP : <?//php if($result2->bp) {   echo $result2->bp; }  else { echo ""; } } ?>
                                                                                
                                                                                <!--Pulse : <?php if($result2->pulse) { echo $result2->pulse." /min"; } else { echo $profile->pulse." /min";} ?><br>
                                                                                Pulse : <?php if($result2->pulse) { echo $result2->pulse." /min"; } else { echo "";} ?><br>-->
                                                                                
                                                                               <!-- नाडी : <?php if($result2->nadi){ echo $result2->nadi;}else { echo $profile->nadi; }?><br>
                                                                                नाडी : <?php if($result2->nadi){ echo $result2->nadi;}else { echo ""; }?><br>-->
                                                                                
                                                                                <!--उर (RS): <?php if($result2->rs) { echo $result2->rs; }else { echo $profile->ur; }?><br> 
                                                                                RS: <?php if($result2->rs) { echo $result2->rs; }else { echo ""; }?><br>  -->
                                                                                
                                                                                <!--CVS : <?php if($result2->cvs){ echo $result2->cvs;} else{echo $profile->cvs;}?><br>
                                                                                CVS : <?php if($result2->cvs){ echo $result2->cvs;} else{echo "";}?><br>-->
                                                                                
                                                                                <!--उदर (PA): <?//php if($result2->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $profile->udar;}?><br>-->
                                                                                <!--उदर (PA): <?//php if($result2->pa) { echo $result2->pa; }else { echo ""; }?>--><br>
                                                                                
                                                                                </b>
                                                                                
                                                                            </td>
                                                                            <td style="border-right: 2px solid #574646;">
                                                                                <?php 
                                                                                    echo "<b> Post Operative Notes- <br>";  
                                                                                    if($result2->paschat_karm) { echo $ex_str_p_o[0];echo "<br>";
                                                                                                                if($ex_str_p_o[1]) { echo $ex_str_p_o[1].'<br>'; } 
                                                                                                                if($ex_str_p_o[2]) { echo $ex_str_p_o[2].'<br>'; } if($ex_str_p_o[3]) { echo $ex_str_p_o[3].'<br>'; } if($ex_str_p_o[4]) 
                                                                                                                { echo $ex_str_p_o[4].'<br>'; }
                                                                            
                                                                                if($ex_str_p_o[5]) { echo $ex_str_p_o[5].'<br>'; } if($ex_str_p_o[6]) { echo $ex_str_p_o[6].'<br>'; } if($ex_str_p_o[7]) { echo $ex_str_p_o[7].'<br>'; } if($ex_str_p_o[8]) { echo $ex_str_p_o[8].'<br>'; } 
                                                                                if($ex_str_p_o[9]) { echo $ex_str_p_o[9].'<br>'; } if($ex_str_p_o[10]) { echo $ex_str_p_o[10].'<br>'; } if($ex_str_p_o[11]) { echo $ex_str_p_o[11].'<br>'; } if($ex_str_p_o[12]) { echo $ex_str_p_o[12].'<br>'; } 
                                                                                if($ex_str_p_o[13]) { echo $ex_str_p_o[13].'<br>'; } if($ex_str_p_o[14]) { echo $ex_str_p_o[14].'<br>'; } if($ex_str_p_o[15]) { echo $ex_str_p_o[15].'<br>'; } if($ex_str_p_o[16]) { echo $ex_str_p_o[16].'<br>'; } 
                                                                                if($ex_str_p_o[17]) { echo $ex_str_p_o[17].'<br>'; } if($ex_str_p_o[18]) { echo $ex_str_p_o[18].'<br>'; } if($ex_str_p_o[19]) { echo $ex_str_p_o[19].'<br>'; } if($ex_str_p_o[20]) { echo $ex_str_p_o[20].'<br>'; } 
                                                                                if($ex_str_p_o[21]) { echo $ex_str_p_o[21].'<br>'; } if($ex_str_p_o[22]) { echo $ex_str_p_o[22].'<br>'; } if($ex_str_p_o[23]) { echo $ex_str_p_o[23].'<br>'; } if($ex_str_p_o[24]) { echo $ex_str_p_o[24].'<br>'; } 
                                                                                echo "</b><br>"; }?>
                                                                            </td>
                                                                        </tr>
                                                                    <?php   }?>
                                                            <?php }  
                                                                else if($result2 == '' || $result2 == null){ 
                                                                    $count = $count + 1;
                                                            ?>
                                                                    <tr>
                                                                        <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <?php 
                                                                                echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                echo "<br> Round ".$count;
                                                                                echo "<br>";
                                                                                $a=array("9","9.30","10","10.30","11");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."AM";
                                                                                /*if($i%2==0){ 
                                                                                    echo $profile->atime.' AM.'; 
                                                                                } else{
                                                                                    echo ($time[0]).''.($time[1] + 9)."   AM";
                                                                                    
                                                                                } */
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <b> C/O :  </b><?php if($result2->sym_name) { echo $result2->sym_name;}?><br>
                                                                            <?php
                                                                                $num_2=is_numeric($profile->second);
                                                                                $num_3=is_numeric($profile->three);
                                                                                $num_4=is_numeric($profile->four);
                                                                                $num_5=is_numeric($profile->five);
                                                                                $num_6=is_numeric($profile->six);
                                                                                $num_7=is_numeric($profile->seven);
                                                                                $num_8=is_numeric($profile->eight);
                                                                                $num_9=is_numeric($profile->nine);
                                                                            
                                                                                if($i==1){ if($num_2==1){ echo "Symptoms reduced by ".$profile->second."%<br>"; } else { echo $profile->second."<br>";} }
                                                                                else if($i==2){ if($num_3==1){ echo "Symptoms reduced by ".$profile->three."%<br>"; } else { echo $profile->three."<br>";} }
                                                                                else if($i==3){ if($num_4==1){ echo "Symptoms reduced by ".$profile->four."%<br>"; } else { echo $profile->four."<br>";} }
                                                                                else if($i==4){ if($num_5==1){ echo "Symptoms reduced by ".$profile->five."%<br>"; } else { echo $profile->five."<br>";} }
                                                                                
                                                                                else if($i==5){ if($num_6==1){ echo "Symptoms reduced by ".$profile->six."%<br>"; } else { echo $profile->six."<br>";} }
                                                                                else if($i==6){ if($num_7==1){ echo "Symptoms reduced by ".$profile->seven."%<br>"; } else { echo $profile->seven."<br>";} }
                                                                                else if($i==7){ if($num_8==1){ echo "Symptoms reduced by ".$profile->eight."%<br>"; } else { echo $profile->eight."<br>";} }
                                                                                else if($i==8){ if($num_8==1){ echo "Symptoms reduced by ".$profile->nine."%<br>"; } else { echo $profile->nine."<br>";} }
                                                                                else { if($i==0) { echo '';} else{ echo "उपशय <br>" ;}}
                                                                                
                                                                            ?>
                                                                            <b> H/O : </b> <?php if($profile->h_o) { echo $profile->h_o;}?><br>
                                                                            <b> Family History : </b> <?php if($profile->f_o) { echo $profile->f_o;}?><br><br>
                                                                            <!--<b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>-->
                                                                            
                                                                            <b> O/E-</b><br>
                                                                            
                                                                            <?php if($profile->tapman) { echo 'Temp :'.$profile->tapman.'ºF<br>';} ?>
                                                                            
                                                                           <!-- <?php if($profile->SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>-->
                                                                              <?php if($profile->SPO2){ echo 'SPO2 : '.$profile->SPO2 ;} else{  echo '';}?> <br>
                                                                            <?php 
                                                                                $str = $bp;
                                                                                $ex=explode("/",$str);
                                                                            ?>
                                                                            <b>
                                                                            <?php if($profile->department_id != 32){ ?>BP : <?php echo $profile->bp; ?><br><?php } ?>
                                                                            
                                                                            
                                                                            Pulse : <?php if($profile->pulse) { echo $profile->pulse.'/min';}?><br>
                                                                            
                                                                            
                                                                            नाडी : <?php if($profile->nadi) { echo $profile->nadi;}?><br>
                                                                            
                                                                            
                                                                            RS: <?php if($profile->rs) { echo $profile->rs;}?><br>  
                                                                            
                                                                            CVS : <?php  if($profile->cvs) { echo $profile->cvs;}?><br>
                                                                            <!--उदर (PA): <?//php $profile->udar;?>--><br>
                                                                            
                                                                            
                                                                            <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                                                            <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                                                            
                                                                            नेत्र : <?php echo $profile->netra;?><br>    
                                                                            जिव्हा : <?php echo $profile->givwa;?><br>
                                                                            
                                                                            क्षुधा : <?php echo $profile->shudha; ?><br>
                                                                            <br>
                                                                            
                                                                            
                                                                            आहार : <?php  echo $profile->ahar;?><br> 
                                                                            
                                                                            मल : <?php echo $profile->mal;  ?><br>
                                                                            मूत्र : <?php echo $profile->mutra;?><br> 
                                                                            
                                                                            
                                                                            निद्रा : <?php echo $profile->nidra;?> <br>    </br>
                                                                            
                                                                            
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <?php if($result2->Pr_Op_Medication) {?><b> - </b> <?php echo " ".$result2->Pr_Op_Medication;echo "<br>";}?>
                                                                            <?php if($result2->Pr_Op_Medication2nd) {?><b> - </b> <?php echo " ".$result2->Pr_Op_Medication2nd;echo "<br><br>";}?>
                                                                            <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br><br>
                                                                                <b> उपक्रम-</b><br> 
                                                                                
                                                                                <?php  echo "C.T.ALL";?>
                                                                        </td>
                                                                    </tr>
                                                            <?php } 
                                                            }
                                                    ?>
                                                    <?php 
                                                            if($rs1->ipd_round_date < $profile->discharge_date || $profile->discharge_date=='0000-00-00' && $rs1->rounds == '2'){
                                                               // echo $rs1->rounds;
                                                                if($result3){
                                                                  
                                                                //  echo 'hiiiiii';
                                                                  
                                                                    $count = $count + 1;
                                                                    
                                                                    $RX1= $result3->RX1;
                                                                    $RX2= $result3->RX2;
                                                                    $RX3= $result3->RX3;
                                                                    $RX4= $result3->RX4;
                                                                    $RX5= $result3->RX5; 
                                                                    
                                                                    $RX6= $result3->RX6;
                                                                    $RX7= $result3->RX7;
                                                                    $RX8= $result3->RX8;
                                                                    $RX9= $result3->RX9;
                                                                    $RX10= $result3->RX10; 
                                                                    
                                                                    $RX_other= $result3->RX_other; 
                                                                    $RX_other1= $result3->RX_other1; 
                                                                    
                                                                    $other_equipment = $result3->other_equipment; 
                                                            ?>
                                                                    <tr>
                                                                        <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <?php 
                                                                                echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                echo "<br> Round ".$count;
                                                                                echo "<br>";
                                                                                $a=array("6","6.30","7","7.30","8");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."PM";
                                                                                /*if($i%2==0){ 
                                                                                    echo $profile->atime.' AM.'; 
                                                                                } else{
                                                                                    echo ($time[0]).' '.($time[1] + 9)."   AM";
                                                                                    
                                                                                } */
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                             <b> C/O :  </b><?php if($result3->sym_name){ echo $result3->sym_name;}else{ echo ""; }?><br>
                                                                            <b> Family History : </b> <?php if($result3->f_o) { echo $result3->f_o;}?><br><br>
                                                                            <!--<b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>-->
                                                                            
                                                                            <b> O/E-</b><br>
                                                                            
                                                                            <?php if($result3->tapman) { echo 'Temp :'.$result3->tapman.'ºF<br>';} ?>
                                                                            
                                                                           <!-- <?php if($result3->SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>-->
                                                                            <?php if($result3->SPO2){ echo 'SPO2 : '.$result3->SPO2 ;} else{  echo '';}?> <br>
                                                                            <?php 
                                                                                $str = $bp;
                                                                                $ex=explode("/",$str);
                                                                            ?>
                                                                            <b>
                                                                            <?php if($result3->department_id != 32){ ?>BP : <?php if($result3->bp) { echo $result3->bp."   mm of Hg";}?><br><?php } ?>
                                                                            
                                                                            
                                                                            Pulse : <?php if($result3->pulse) { echo $result3->pulse.'/min';}?><br>
                                                                            
                                                                            
                                                                            नाडी : <?php if($result3->nadi) { echo $result3->nadi;}?><br>
                                                                            
                                                                            
                                                                            RS: <?php if($result3->rs) { echo $result3->rs;}?><br>  
                                                                            
                                                                            CVS : <?php  if($result3->cvs) { echo $result3->cvs;}?><br>
                                                                           <!-- उदर (PA): <?//php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>-->
                                                                            <!--उदर (PA): //php if($result3->pa) -->
                                                                            <!--//{-->
                                                                            <!--   //echo $result3->pa; -->
                                                                            <!--//} else { echo $udar;}?><br>-->
                                                                    
                                                                            </b>
                                                                          
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <b>
                                                                                <?php 
                                                                                    $tre_icu = $result3->ICU_Order;
                                                                                    $ex_icu=explode(",",$tre_icu);
                                                                                    if(($result3->ICU_Order))  {
                                                                                        if($ex_icu[0]) { 
                                                                                            echo "=>".$ex_icu[0].'<br>'; 
                                                                                        }  
                                                                                        if($ex_icu[1]) { 
                                                                                            echo "=>".$ex_icu[1].'<br>'; 
                                                                                        } 
                                                                                        if($ex_icu[2]) { 
                                                                                            echo "=>".$ex_icu[2].'<br>'; 
                                                                                        } 
                                                                                        if($ex_icu[3]) { 
                                                                                            echo "=>".$ex_icu[3].'<br>'; 
                                                                                        }   
                                                                                        if($ex_icu[4]) { 
                                                                                            echo "=>".$ex_icu[4].'<br>'; 
                                                                                        } 
                                                                                        if($ex_icu[5]) { 
                                                                                            echo "=>".$ex_icu[5].'<br>'; 
                                                                                        } 
                                                                                        if($ex_icu[6]) { 
                                                                                            echo "=>".$ex_icu[6].'<br>'; 
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </b> 
                                                                            <?php 
                                                                                $tre_1STDOSE = $result3->Only_1st_Dose;
                                                                                $ex_1STDOSE=explode(",",$tre_1STDOSE);
                                                                                if(!empty($result3->Post_Operative)) {  
                                                                                    echo "=> ".$ex_1STDOSE[0];echo "<br>"; 
                                                                                    if($ex_1STDOSE[1]) { 
                                                                                        echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                    } 
                                                                                    if($ex_1STDOSE[2]) { 
                                                                                        echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                    }
                                                                                } else if(($result3->Only_1st_Dose)) {
                                                                            ?>
                                                                            <b> =></b> 
                                                                            <?php 
                                                                                    echo "".$ex_1STDOSE[0];echo "<br>"; 
                                                                                    if($ex_1STDOSE[1]) { 
                                                                                        echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                                                    } 
                                                                                    if($ex_1STDOSE[2]) { 
                                                                                        echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                                                    }
                                                                                } else {}?>
                                                                            <?php 
                                                                                if((($result3->VAMAN)  || ($result3->RAKTAMOKSHAN) || ($result3->SHIRODHARA_SHIROBASTI) || ($result3->skarma)))  {
                                                                            ?>
                                                                            <b>
                                                                            <?php 
                                                                                    echo " ".$result3->skarma;
                                                                            ?>
                                                                            </b><br>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <b>
                                                                            <?php  
                                                                                if($result3->Pr_Op_Medication) {
                                                                            ?>
                                                                            <?php 
                                                                                    echo "=>".$result3->Pr_Op_Medication;
                                                                                    echo "<br>";
                                                                                }
                                                                            ?>
                                                                            <?php  
                                                                                if($result3->Pr_Op_Medication2nd) {
                                                                            ?>
                                                                            <?php 
                                                                                    echo "=>".$result3->Pr_Op_Medication2nd;
                                                                                }
                                                                            ?>
                                                                            </b><br><br>
                                                                            <?php if($RX1 || $RX2 || $RX3 || $RX4 || $RX5 || $RX6 || $RX7 || $RX8 || $RX9 || $RX10 || $RX_other || $RX_other1){?>
                                                                                <b> RX - </b> 
                                                                                <?php 
                                                                                    $tre_rx1 = $RX1;
                                                                                    $ex=explode(",",$tre_rx1);
                                                                                    $tre_rx2 = $RX2;
                                                                                    $ex2=explode(",",$tre_rx2);
                                                                                    $tre_rx4 = $RX3;
                                                                                    $ex3=explode(",",$tre_rx4);
                                                                                    $tre_rx4 = $RX4;
                                                                                    $ex4=explode(",",$tre_rx4);
                                                                                    $tre_rx5 = $RX5;
                                                                                    $ex5=explode(",",$tre_rx5);
                                                                                    
                                                                                    $tre_rx6 = $RX6;
                                                                                    $ex6=explode(",",$tre_rx6);
                                                                                        
                                                                                        $tre_rx7 = $RX7;
                                                                                        $ex7=explode(",",$tre_rx7);
                                                                                        $tre_rx8 = $RX8;
                                                                                        $ex8=explode(",",$tre_rx8);
                                                                                        $tre_rx9 = $RX9;
                                                                                        $ex9=explode(",",$tre_rx9);
                                                                                        $tre_rx10 = $RX10;
                                                                                        $ex10=explode(",",$tre_rx10);
                                                                                        
                                                                                        $tre_other = $RX_other;
                                                                                        $ex_other=explode(",",$tre_other);
                                                                                        
                                                                                        $tre_other1 = $RX_other1;
                                                                                        $ex_other1=explode(",",$tre_other1);
                                                                                        
                                                                                         $tre_other_equipment = $other_equipment;
                                                                                        $ex13=explode(",",$tre_other_equipment);
                                                                                        
                                                                                    ?>
                                                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                                                                    
                                                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                    <?php if($RX_other) { $ex_x110=explode("x",$ex_other[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex_other11[1]) { $ex_x111=explode("x",$ex_other111[1]); echo "=>".$ex_x11[0].'<br>'; } if($ex_other111[2]) { $ex_x111=explode("x",$ex_other11[2]); echo "=>".$ex_x111[0].'<br>'; }}?>
                                                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex_other1[0]);  echo "=>".$ex_x120[0];echo "<br>"; if($ex_other12[1]) { $ex_x121=explode("x",$ex_other121[1]); echo "=>".$ex_x12[0].'<br>'; } if($ex_other121[2]) { $ex_x121=explode("x",$ex_other21[2]); echo "=>".$ex_x121[0].'<br>'; }}?>
                                                                                    
                                                                                       <?php if($other_equipment)
                                                                                    	{
                                                                                      $test = explode(",",$other_equipment);
                                                                                      $count = count($test);
                                                                                      for($i=0;$i<$count;$i++)
                                                                                      {
                                                                                        echo $test[$i].'<br>';
                                                                                      }
																						//	echo $other_equipment; 
                                                                                    }
                                                                          ?>                                                                                    
                                                                                    <br>
                                                                                
                                                                               
                                                                               
                                                                                
                                                                                
                                                                            <?php 
                                                                                }
                                                                                else
                                                                                {
                                                                            ?>
                                                                                   <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                             <b> उपक्रम-</b><br>   
                                                                             
                                                                            <?php if(($result3->SNEHAN) || ($result3->SWEDAN) || ($result3->VAMAN) || ($result3->VIRECHAN) || ($result3->BASTI) || ($result3->NASYA) || ($result3->RAKTAMOKSHAN) || ($result3->SHIRODHARA_SHIROBASTI) || ($result3->OTHER) || ($result3->SWA1) || ($result3->SWA2)){?>
                                                                               
                                                                                <?php  if($result3->SNEHAN){  echo $result3->SNEHAN.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->SWEDAN){  echo $result3->SWEDAN.'<br>'; }?>
                                                                                
                                                                                <?php  if(($result3->VAMAN)  && ($i==0)) {  echo $result3->VAMAN.'<br>';  $VAMAN_1D=$result3->VAMAN;  }?>
                                                                                
                                                                                <?php  if($result3->VIRECHAN){  echo $result3->VIRECHAN.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->BASTI){  echo $result3->BASTI.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->NASYA){  echo $result3->NASYA.'<br>'; }?>
                                                                                
                                                                                <?php  if(($result3->RAKTAMOKSHAN)  && ($i==0)) { echo $result3->RAKTAMOKSHAN.'<br>'; }?>
                                                                                
                                                                                <?php  if(($result3->SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo $result3->SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                                                
                                                                                <?php if($result3->OTHER){  if(strpos($result3->OTHER, '1D') !== false) { if($i==0) { echo $result3->OTHER.'<br> '; $OTHER_1D=$result3->OTHER; } else{ echo '';} }  else { echo $result3->OTHER.'<br>'; } }?>
                                                                                
                                                                                <?php  if($result3->SWA1){  echo $result3->SWA1.'<br>'; }?>
                                                                                
                                                                                <?php  if($result3->SWA2){  echo $result3->SWA2.'<br>'; }?>
                                                                            <?php 
                                                                                }
                                                                                else{
                                                                                    echo "C.T.ALL";
                                                                                }
                                                                            ?>
                                                                            
                                                                            
                                                                            <?php
                                                                            $tre_covid_2nd_morning = $result3->Only_2nd_Day_Morning_covid;
                                                                            $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                                                            
                                                                            //if((($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)  || ($Sp_Investigations_pandamic)) && ($i==0)){
                                                                            // if(($result3->HEMATOLOGICAL) || ($result3->SEROLOGYCAL) || ($result3->BIOCHEMICAL) || ($result3->MICROBIOLOGICAL) || ($result3->X_RAY) || ($result3->ECG) || ($result3->USG) || ($result3->Sp_Investigations_pandamic)){
                                                                            if(($result3->HEMATOLOGICAL!='') || ($result3->SEROLOGYCAL!='') || ($result3->BIOCHEMICAL!='') || ($result3->MICROBIOLOGICAL!='') || ($result3->X_RAY!='') || ($result3->ECG!='') || ($result3->USG!='') || ($result3->Sp_Investigations_pandamic!='')){
                                                                        ?>
                                                                            <br>
                                                                            <b> Adv- </b><br>
                                                                            
                                                                            <?php //if((strpos($result3->HEMATOLOGICAL, 'CBC') !== false) || (strpos($result3->SEROLOGYCAL, 'CBC') !== false) || (strpos($result3->BIOCHEMICAL, 'CBC') !== false) || (strpos($result3->MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                                                            <?php //if((strpos($result3->HEMATOLOGICAL, 'ESR') !== false) || (strpos($result3->SEROLOGYCAL, 'ESR') !== false) || (strpos($result3->BIOCHEMICAL, 'ESR') !== false) || (strpos($result3->MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                                                            <?php //if((strpos($result3->HEMATOLOGICAL, 'LFT') !== false) || (strpos($result3->SEROLOGYCAL, 'LFT') !== false) || (strpos($result3->BIOCHEMICAL, 'LFT') !== false) || (strpos($result3->MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                                                            <?php //if((strpos($result3->HEMATOLOGICAL, 'RFT') !== false) || (strpos($result3->SEROLOGYCAL, 'RFT') !== false) || (strpos($result3->BIOCHEMICAL, 'RFT') !== false) || (strpos($result3->MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            <?php  if($result3->HEMATOLOGICAL){  echo $result3->HEMATOLOGICAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result3->SEROLOGYCAL){  echo $result3->SEROLOGYCAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result3->BIOCHEMICAL){  echo $result3->BIOCHEMICAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result3->MICROBIOLOGICAL){  echo $result3->MICROBIOLOGICAL.'<br>'; }?>
                                                                            
                                                                            <?php  if($result3->X_RAY){  echo $result3->X_RAY.'<br>'; }?>
                                                                            
                                                                            <?php  if($result3->ECG){  echo $result3->ECG.'<br>'; }?>
                                                                            
                                                                            <?php  if($result3->USG){  echo $result3->USG.'<br>'; }?>
                                                                            
                                                                            <?php 
                                           
                                                                               $tre_spe_invet = $result3->Sp_Investigations_pandamic;
                                                                                $ex_spe_invet=explode(",",$tre_spe_invet);
                                                                                
                                                                                
                                                                               if($result3->Sp_Investigations_pandamic){  echo "<br><b>=>".$ex_spe_invet[0];echo "<br>"; echo "<b>=>".$ex_2d_morn[0]; if($ex_spe_invet[1]) { echo "<br>=>".$ex_spe_invet[1].'<br>'; } }?>
                                                                               
                                                                                <?php }?>
                                                                                
                                                                               <?php 
                                                                               
                                                                               
                                                                               if(($result3->Only_2nd_Day_Morning_covid)) {?><b>  <?php echo "<br>"; if($ex_2d_morn[1]) { echo "=>".$ex_2d_morn[1].'<br>'; }echo "</b><br>";}?>
                                                                             
                                                                                 
                                                                                <?php  if(($result3->vkarma)){  if(strpos($result3->vkarma, 'KSHAR SUTRA') !== false){ echo "=>".$result3->vkarma.'<br>'; }else{/*echo "=>".$result3->vkarma.'<br>';*/}}?>
                                                                       
                                                                                    <?php if($result3->PHYSIOTHERAPY){ ?>
                                                                                    <br><p>Physiotheropy - <?php echo $result3->PHYSIOTHERAPY; ?></p>
                                                                                    <?php } ?>
                                                                       
                                                                        </td>
                                                                    </tr>
                                                            <?php }  
                                                                else if($result3 == '' || $result3 == null){ 
                                                                    $count = $count + 1;
                                                            ?>
                                                                    <tr>
                                                                        <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <?php 
                                                                                echo date('d-m-Y',strtotime($rs1->ipd_round_date));
                                                                                echo "<br> Round ".$count;
                                                                                echo "<br>";
                                                                                $a=array("6","6.30","7","7.30","8");
                                                                                    $random_keys=array_rand($a,2);
                                                                                    echo $a[$random_keys[0]]."PM";
                                                                                /*if($i%2==0){ 
                                                                                    echo $profile->atime.' AM.'; 
                                                                                } else{
                                                                                    echo ($time[0]).' '.($time[1] + 9)."   AM";
                                                                                    
                                                                                } */
                                                                            ?>
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <b> C/O :  </b><?php echo "No Fresh Complaint";?><br>
                                                                            <b> Family History : </b> <?php if(!empty($profile->f_h)) { echo $profile->f_h.'<br>';} else { echo ''.$f_h;}?><br><br>
                                                                            <b> E/O : </b> <?php if($result2->e_o) { echo $result2->e_o;}?><br>
                                                                            <b> O/E-  </b><br>
                                                                            <?php if(!empty($profile->tapman)){ echo $profile->tapman; }else {echo ''; } ?>                                                                    <?php $str = $bp;
                                                                            $ex=explode("/",$str);
                                                                            ?>
                                                                            <b>
                                                                            <?php if($profile->department_id != 32){ ?>BP : <?php if(!empty($profile->bp)){ echo $profile->bp." mm of Hg";  }else{   echo ""; }?><br><?php } ?>
                                                                            
                                                                            Pulse : <?php if($profile->pulse) { echo $profile->pulse." mm of Hg"; } else { echo "";} ?><br>
                                                                            
                                                                            नाडी : <?php if($profile->nadi){ echo $profile->nadi;}else { echo ""; }?><br>
                                                                            RS: <?php if($profile->rs) { echo $profile->rs; }else {  echo ""; }?><br>
                                                                            
                                                                            CVS : <?php echo $profile->cvs;?><br>
                                                                            <!--उदर (PA): <?//php if($profile->pa) { echo $profile->pa;} else { echo "";}?>--><br>
                                                                            
                                                                            </b>
                        
                                                                        </td>
                                                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                                                            <?php if(($result3->Pr_Op_Medication)) {?><b> - </b> <?php echo " ".$result3->Pr_Op_Medication;echo "<br>";}?>
                                                                            <?php  
                                                                                if(($result3->Pr_Op_Medication2nd)) {
                                                                            ?>
                                                                            <b>
                                                                            <?php 
                                                                                    echo "=>".$result3->Pr_Op_Medication2nd;
                                                                                    echo "<br><br>";
                                                                                }
                                                                            ?>
                                                                            
                                                                            <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br><br>
                                                                            <b> उपक्रम-</b><br> 
                                                                                
                                                                            <?php  echo "C.T.ALL";?>
                                                                        </td>
                                                                    </tr>
                                                            <?php } 
                                                            }
                                                    ?>
                                                    <?php 
                                                            if($count == 2){ $count = 0;}
                                                    ?>
                                                    <?php
                                                        }
                                                    ?>
                                            <?php } ?>
                                    <?php } ?>
                                            <?php if($profile->discharge_date != '0000-00-00'):?>
                                            <tr>
                                                <td style="border-right: 2px solid #574646;"></td>
                                                <td style="border-right: 2px solid #574646;"></td>
                                                <td style="border-right: 2px solid #574646;"><b> Patient is discharged <br> Follow up after 7 days in OPD.  </b></td>
                                            </tr>
                                            <?php endif;?>
        
                                    <?php
                                        }
                                        ///////////////////////////// End Manual Treatement ///////////////////
                                        ///////////////////////////// Start Auto Treatment/////////////////////
                                        else{
                                            
                                    ?>
                                    
                                    <?php
                                    
                                        function displayDates($date1, $date2, $format = 'd-m-Y' ) {
                                            $dates = array();
                                            $current = strtotime($date1);
                                            $date2 = strtotime($date2);
                                            $stepVal = '+1 day';
                                            while( $current <= $date2 ) {
                                                $dates[] = date($format, $current);
                                                $current = strtotime($stepVal, $current);
                                            }
                                            return $dates;
                                        }
                                    
                                    
                                       //echo $admit_date=date('Y-m-d',strtotime($profile->create_date));
                                       
                                     
                                            if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                            {
                                            echo   $admit_date =  $date_f5;
                                            }
                                            else
                                            {
                                               $admit_date = date('Y-m-d',strtotime($profile->create_date)); 
                                            }
                                           
                                        if($profile->discharge_date=='0000-00-00'){
                                            //$discharge_date=date('Y-m-d', strtotime($admit_date. ' + 5 days'));
                                            $discharge_date=date('Y-m-d');
                                        } else{
                                            
                                            if(date('d-m-Y',strtotime($profile->discharge_date))=='01-01-1970')
                                            {
                                             echo  $discharge_date =  $date_f6;
                                            }
                                            else
                                            {
                                               $discharge_date = date('Y-m-d',strtotime($profile->discharge_date)); 
                                            }
                                            
                                            //$discharge_date=date('Y-m-d',strtotime($profile->discharge_date));
                                        }
                                        $date = displayDates($admit_date, $discharge_date);
                                        // print_r($date);
                                    ?>
                                    <!--  -----------------------################## MORNING TIME ###########################------------------  -->
                                    <?php 
                                    //   $RX1=substr($RX1, 0, -7);
                                    //  $RX2=substr($RX2, 0, -7);
                                    //    $RX3=substr($RX3, 0, -7);
                                    //    $RX4=substr($RX4, 0, -7);
                                    //    $RX5=substr($RX5, 0, -7);
                                    ?>
                                    <?php 
                                    
                                        $DISTRIBUTION_IPD=$tretment->DISTRIBUTION_IPD; 
                                        $ipd_days=$tretment->ipd_days; 
                                        $last_days=$ipd_days - $DISTRIBUTION_IPD;
                                        $DISTRIBUTION_IPD=$DISTRIBUTION_IPD - 1;
                                        
                                        $arry=array();
                                        for($i=0;$i<count($date);$i++){
                                    
                                    
                                            $tretment_manual=$this->db->select("*")
                                            
                                                ->from('manual_treatments')
                                                ->where('patient_id_auto',$profile->id)
                                                ->where('rounds',$i)
                                                ->where('ipd_opd',$section_tret)
                                                ->get()
                                                ->num_rows();
                                            
                                            //print_r($this->db->last_query());
                                            if($tretment_manual==0){
                                                $rounds=-1;
                                            }else{
                                                $rounds=$tretment_manual;
                                            }
                                    
                                            if($i==$rounds){
                                                $RX1= $tretment_manual->RX1;
                                                $RX2= $tretment_manual->RX2;
                                                $RX3= $tretment_manual->RX3;
                                                $RX4= $tretment_manual->RX4;
                                                $RX5= $tretment_manual->RX5;
                                                
                                                $RX6= $tretment_manual->RX6;
                                                $RX7= $tretment_manual->RX7;
                                                $RX8= $tretment_manual->RX8;
                                                $RX9= $tretment_manual->RX9;
                                                $RX10= $tretment_manual->RX10;  
                                            
                                            
                                            } else{
                                                $RX1= $tretment->RX1;
                                                $RX2= $tretment->RX2;
                                                $RX3= $tretment->RX3;
                                                $RX4= $tretment->RX4;
                                                $RX5= $tretment->RX5;
                                                
                                                $RX6= $tretment_manual->RX6;
                                                $RX7= $tretment_manual->RX7;
                                                $RX8= $tretment_manual->RX8;
                                                $RX9= $tretment_manual->RX9;
                                                $RX10= $tretment_manual->RX10;  
                                            
                                            }
                                    
                                    
                                    
                                    if($DISTRIBUTION_IPD < $i){
                                        array_push($arry,$i);
                                    
                                        if($profile->manual_status==0){
                                            $section_tret='ipd';
                                            $tretarray=$this->db->select("*")
                                            
                                            ->from('treatments1')
                                            
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('proxy_id',$profile->proxy_id)
                                            ->where('department_id',$profile->department_id)
                                            ->where('ipd_opd',$section_tret)
                                            ->get()
                                            ->num_rows();
                                        
                                        
                                            if($tretarray > 2){
                                                $tretment=$this->db->select("*")
                                                
                                                    ->from('treatments1')
                                                    
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('department_id',$profile->department_id)
                                                    ->where('ipd_opd',$section_tret)
                                                    // ->where('ICU',$profile->sex)
                                                    ->where('proxy_id',$profile->proxy_id)
                                                    ->order_by("id", "desc")
                                                    ->where('DISTRIBUTION_IPD',$last_days)
                                                    ->get()
                                                    ->row();
                                            
                                            } else {
                                                $tretment=$this->db->select("*")
                                                
                                                    ->from('treatments1')
                                                    ->where('proxy_id',$profile->proxy_id)
                                                    ->where('department_id',$profile->department_id)
                                                    ->where('dignosis LIKE',$p_dignosis)
                                                    ->where('ipd_opd',$section_tret)
                                                    ->order_by("id", "desc")
                                                    ->get()
                                                    ->row();
                                            
                                            }
                                        
                                        
                                        }else{
                                            $tretment=$this->db->select("*")
                                            
                                                ->from('manual_treatments')
                                                ->where('patient_id_auto',$profile->id)
                                                ->where('dignosis LIKE',$p_dignosis)
                                                ->where('ipd_opd ',$section_tret)
                                                ->order_by("id", "desc")
                                                ->get()
                                                ->row();
                                        }
                                    
                                    
                                        $tretment_manual=$this->db->select("*")
                                        
                                            ->from('manual_treatments')
                                            ->where('patient_id_auto',$profile->id)
                                            ->where('rounds',$i)
                                            ->where('ipd_opd',$section_tret)
                                            ->get()
                                            ->num_rows();
                                        if($tretment_manual==0){
                                            $rounds=-1;
                                        }else{
                                            $rounds=$tretment_manual;
                                        }
                                
                                        if($i==$rounds){
                                            $RX1= $tretment_manual->RX1;
                                            $RX2= $tretment_manual->RX2;
                                            $RX3= $tretment_manual->RX3;
                                            $RX4= $tretment_manual->RX4;
                                            $RX5= $tretment_manual->RX5; 
                                            
                                            $RX6= $tretment_manual->RX6;
                                                $RX7= $tretment_manual->RX7;
                                                $RX8= $tretment_manual->RX8;
                                                $RX9= $tretment_manual->RX9;
                                                $RX10= $tretment_manual->RX10;  
                                        } else{
                                            $RX1= $tretment->RX1;
                                            $RX2= $tretment->RX2;
                                            $RX3= $tretment->RX3;
                                            $RX4= $tretment->RX4;
                                            $RX5= $tretment->RX5;
                                            
                                            $RX6= $tretment_manual->RX6;
                                                $RX7= $tretment_manual->RX7;
                                                $RX8= $tretment_manual->RX8;
                                                $RX9= $tretment_manual->RX9;
                                                $RX10= $tretment_manual->RX10;  
                                        
                                        }
                                    
                                    
                                        $Input='';
                                        $Output='';
                                        if(count($arry)==1){
                                            $ICU_Order= $tretment->ICU_Order;
                                        } else{
                                            $ICU_Order= '';
                                        }
                                    } 
                                    else{
                                    
                                    }
                                    ?>
                                    
                                    <tr>
                                        <?php $str1 = $profile->atime; $time=explode(":",$str1);?>
                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                            <?php 
                                                echo date('d-m-Y',strtotime($date[$i])); 
                                                echo "<br>";
                                                if($profile->manual_status =='1')
                                                {
                                                if($i%2==0){ 
                                                    echo $profile->atime.' AM.'; 
                                                } else
                                                {
                                                    echo ($time[0]).':'.($time[1] + 9)."AM";
                                                } 
                                                }
                                                else
                                                {
                                                   echo(rand(9,11)).AM; 
                                                }
                                            ?>
                                        </td>
                                        
                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;"> 
                                            <b> 
                                            <?php 
                                                if(($tretment->kco)  && ($i==0)){ 
                                                    echo 'K/C/O : '.$tretment->kco.'<br>';
                                                } 
                                            ?>
                                            </b>
                                            <b> C/O :  </b><?php if($tretment_manual->sym_name) { echo $tretment_manual->sym_name;} else { echo $symptoms; }?><br>
                                            <?php
                                                $num_2=is_numeric($profile->second);
                                                $num_3=is_numeric($profile->three);
                                                $num_4=is_numeric($profile->four);
                                                $num_5=is_numeric($profile->five);
                                                $num_6=is_numeric($profile->six);
                                                $num_7=is_numeric($profile->seven);
                                                $num_8=is_numeric($profile->eight);
                                                $num_9=is_numeric($profile->nine);
                                            
                                                if($i==1){ if($num_2==1){ echo "Symptoms reduced by ".$profile->second."%<br>"; } else { echo $profile->second."<br>";} }
                                                else if($i==2){ if($num_3==1){ echo "Symptoms reduced by ".$profile->three."%<br>"; } else { echo $profile->three."<br>";} }
                                                else if($i==3){ if($num_4==1){ echo "Symptoms reduced by ".$profile->four."%<br>"; } else { echo $profile->four."<br>";} }
                                                else if($i==4){ if($num_5==1){ echo "Symptoms reduced by ".$profile->five."%<br>"; } else { echo $profile->five."<br>";} }
                                                
                                                else if($i==5){ if($num_6==1){ echo "Symptoms reduced by ".$profile->six."%<br>"; } else { echo $profile->six."<br>";} }
                                                else if($i==6){ if($num_7==1){ echo "Symptoms reduced by ".$profile->seven."%<br>"; } else { echo $profile->seven."<br>";} }
                                                else if($i==7){ if($num_8==1){ echo "Symptoms reduced by ".$profile->eight."%<br>"; } else { echo $profile->eight."<br>";} }
                                                else if($i==8){ if($num_8==1){ echo "Symptoms reduced by ".$profile->nine."%<br>"; } else { echo $profile->nine."<br>";} }
                                                else { if($i==0) { echo '';} else{ echo "उपशय <br>" ;}}
                                                
                                            ?>
                                            <b> H/O : </b> <?php if($tretment_manual->h_o) { echo $tretment_manual->h_o;}  else { if(($tretment->h_o) && ($i==0)) { echo $tretment->h_o;} else { echo $h_o;} }?><br>
                                            <b> Family History : </b> <?php if($tretment_manual->f_o) { echo $tretment_manual->f_o;}  else { if(!empty($profile->f_h)) { echo $profile->f_h.'<br>';} else { echo $f_h.''; } }?>
                                            <b><?php if(($tretment->e_o) && ($i==0)) { ?> </b><?php  if(($tretment->sr=='877') || ($tretment->sr=='882')){ if($profile->date_of_birth%2==0) { echo "<br>Bd Group: B- ve"; } else { echo "<br>AB+ ve";}} else{ echo '<br>Bd Group : E/O: '.$tretment->e_o;}?> <?php }?><br><br>
                                            Pulse : <?php if($tretment_manual->pulse) { echo $tretment_manual->pulse.'/min';}  else { if($pulse) { if($i%2==0) { echo $pulse." /min";} else { echo ($pulse + 2)." /min";} } else { echo $Pulse[$Pulse1]." /min";}} ?><br>
                                            <?php 
if($profile->department_id != 32)
    { ?>
    BP : <?php 
        if($tretment_manual->bp)
        { 
            echo $tretment_manual->bp."   mm of Hg";
        } 
        else 
        { 
            if((!empty($tretment->bp)) && ($i==0)) 
        {  
            echo "210/120 mm of Hg"; 
        }  
        else 
        if($bp) 
        { 
            if($ex[0]%2==0)
        { 
            echo ($ex[0] + 4).'/'.($ex[1] + 4)."   mm of Hg";
        } else
        { 
            echo $bp,"   mm of Hg";
        }
        } 
        else 
        {
            echo $bp[$bp1],"   mm of Hg";
        } 
        }?><br>
    <?php 
    } 
    ?><br>
                                            <!--<b> O/E-</b><br>-->
                                        
                                            <?php if($tretment_manual->tapman) { echo 'Temp :'.$tretment_manual->tapman.'ºF<br>';}  else   {echo "";  } ?>
                                            
                                            <!--<?//php if($SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>-->
                                            <?php if($tretment_manual->SPO2){ echo $tretment_manual->SPO2 ;} else{  echo '';}?> <br>
                                            <?php 
                                                $str = $bp;
                                                $ex=explode("/",$str);
                                            ?>

                                           RS: <?php if($tretment_manual->rs) { echo $tretment_manual->rs;}  else { if($tretment->rs) { echo $tretment->rs; }else { echo $ur; }}?><br>  
                                            CVS : <?php  if($tretment_manual->cvs) { echo $tretment_manual->cvs;}  else { echo $cvs;}?><br>
                                            <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                            <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                            
                                            नाडी : <?php if($tretment_manual->nadi) { echo $tretment_manual->nadi;}  else { if($nadi){ echo $nadi;}else { echo $nadi[$nadi1]; } }?><br>
                                            
                                            
                                            
                                             <!--उदर (PA): <?//php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?>--><br>
                                            
                                            
                                            
                                            नेत्र : <?php  if($tretment_manual->netra) { echo $tretment_manual->netra;}  else { if($netra){ echo  $netra;} else { echo $netra[$netra1]; }}?><br   >    
                                            जिव्हा : <?php if($tretment_manual->givwa) { echo $tretment_manual->givwa;}  else {  if($givwa){ if($i%2==0){ echo $givwa;} else { echo 'निराम'; } }}?><br>
                                            
                                            क्षुधा : <?php if($tretment_manual->shudha) { echo $tretment_manual->shudha;}  else {  if($sudha){ echo  $sudha ;} else{ echo    $sudha[$sudha1];}} ?><br>
                                            <br>
                                            
                                            
                                            आहार : <?php   if($tretment_manual->ahar){ echo $tretment_manual->ahar;}  else { if($ahar) { echo $ahar;} else { echo   $ahar[$ahar1];}}?><br> 
                                            
                                            मल : <?php  if($tretment_manual->mal) { echo $tretment_manual->mal;}  else { if($tretment->mal_mutra) { echo  $tretment->mal_mutra;}else { if($i%2==0)  { echo  $mal;}  else {  echo 'कठीण';}}}?><br>
                                            मूत्र : <?php if($tretment_manual->mutra) { echo $tretment_manual->mutra;}  else {  if(!empty($tretment->mutra)){ echo $tretment->mutra;} else {   if($i%2==0)  {  echo  $mutra;}  else {   echo 'आविल'; }}}?><br 
                                            
                                            
                                            निद्रा : <?php if($nidra){ echo $nidra;} else  { echo $nidra[$nidra1];}?> <br>    </br>
                                            
                                            
                                            <?php if(($Input) && ($i>= 1)){ echo '<b>I/O Chart:</b><br>';$ex_Input=explode(",",$profile->Input); if($profile->department_id=='32'){ echo 'Input: '.($ex_Input[$i]- 800).'ml';} else if($profile->sex=='M') {  echo 'Input: '.$ex_Input[$i].'ml';} else { echo 'Input: '.($ex_Input[$i]- 200).'ml';} }?> <br>
                                            <?php if(($Output) && ($i>= 1)){ $ex_Output=explode(",",$profile->Output);  if($profile->department_id=='32'){ echo 'Output: '.($ex_Output[$i]- 600).'ml'; } else if($profile->sex=='M') { echo 'Output: '.$ex_Output[$i].'ml';} else { echo 'Output: '.($ex_Output[$i]- 200).'ml'; }}?> <br>
                                        </td>
                                        
                                        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;">
                                            <b>
                                                <?php 
                                                    $tre_icu = $ICU_Order;
                                                    $ex_icu=explode(",",$tre_icu);
                                                    if(($ICU_Order) && (($i==0) || ($DISTRIBUTION_IPD < $i)))  {
                                                 
                                                        if($ex_icu[0]) { 
                                                            echo "=>".$ex_icu[0].'<br>'; 
                                                        }  
                                                        if($ex_icu[1]) { 
                                                            echo "=>".$ex_icu[1].'<br>'; 
                                                        } 
                                                        if($ex_icu[2]) { 
                                                            echo "=>".$ex_icu[2].'<br>'; 
                                                        } 
                                                        if($ex_icu[3]) { 
                                                            echo "=>".$ex_icu[3].'<br>'; 
                                                        }   
                                                        if($ex_icu[4]) { 
                                                            echo "=>".$ex_icu[4].'<br>'; 
                                                        } 
                                                        if($ex_icu[5]) { 
                                                            echo "=>".$ex_icu[5].'<br>'; 
                                                        } 
                                                        if($ex_icu[6]) { 
                                                            echo "=>".$ex_icu[6].'<br>'; 
                                                        }
                                                    }
                                                ?>
                                            </b> 
                                            <?php 
                                                $tre_1STDOSE = $Only_1st_Dose;
                                                $ex_1STDOSE=explode(",",$tre_1STDOSE);
                                                if(!empty($Post_Operative)) {  
                                                    echo "=> ".$ex_1STDOSE[0];echo "<br>"; 
                                                    if($ex_1STDOSE[1]) { 
                                                        echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                    } 
                                                    if($ex_1STDOSE[2]) { 
                                                        echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                    }
                                                } else if(($Only_1st_Dose) && ($i==0)) {
                                            ?>
                                                    <b> =></b> 
                                            <?php 
                                                    echo "".$ex_1STDOSE[0];echo "<br>"; 
                                                    if($ex_1STDOSE[1]) { 
                                                        echo "=>".$ex_1STDOSE[1].'<br>'; 
                                                    } 
                                                    if($ex_1STDOSE[2]) { 
                                                        echo "=>".$ex_1STDOSE[2].'<br>'; 
                                                    }
                                                } else {}?>
                                            <?php 
                                                if((($VAMAN)  || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || ($tretment->skarma))  && ($i==1))  {
                                            ?>
                                                    <b>
                                            <?php 
                                                    echo " ".$tretment->skarma;
                                            ?>
                                                    </b><br>
                                            <?php
                                                }
                                            ?>
                                            
                                            <?php  
                                                if(($Pr_Op_Medication2nd) && ($i==1)) {
                                            ?>
                                                    <b>
                                            <?php 
                                                    echo "=>".$Pr_Op_Medication2nd; echo "</b><br>";
                                                }
                                            ?>
                                                <b> RX - </b> 
                                            <?php 
                                                $tre_rx1 = $RX1;
                                                $ex=explode(",",$tre_rx1);
                                                $tre_rx2 = $RX2;
                                                $ex2=explode(",",$tre_rx2);
                                                $tre_rx4 = $RX3;
                                                $ex3=explode(",",$tre_rx4);
                                                $tre_rx4 = $RX4;
                                                $ex4=explode(",",$tre_rx4);
                                                $tre_rx5 = $RX5;
                                                $ex5=explode(",",$tre_rx5);
                                            $tre_rx6 = $RX6;
                                                                                        $ex6=explode(",",$tre_rx6);
                                                                                        $tre_rx7 = $RX7;
                                                                                        $ex7=explode(",",$tre_rx7);
                                                                                        $tre_rx8 = $RX8;
                                                                                        $ex8=explode(",",$tre_rx8);
                                                                                        $tre_rx9 = $RX9;
                                                                                        $ex9=explode(",",$tre_rx9);
                                                                                        $tre_rx10 = $RX10;
                                                                                        $ex10=explode(",",$tre_rx10);
                                                                                        
                                                                                        $tre_other = $RX_other;
                                                                                        $ex_other=explode(",",$tre_rx5);
                                                                                        $tre_other1 = $RX_other1;
                                                                                        $ex_other1=explode(",",$tre_rx5);
                                                                                    ?>
                                                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                                                                    
                                                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                    <!--<?php if($RX_other) { $ex_x110=explode("x",$ex_other[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex_other11[1]) { $ex_x111=explode("x",$ex_other111[1]); echo "=>".$ex_x11[0].'<br>'; } if($ex_other111[2]) { $ex_x111=explode("x",$ex_other11[2]); echo "=>".$ex_x111[0].'<br>'; }}?>
                                                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex_other1[0]);  echo "=>".$ex_x120[0];echo "<br>"; if($ex_other12[1]) { $ex_x121=explode("x",$ex_other121[1]); echo "=>".$ex_x12[0].'<br>'; } if($ex_other121[2]) { $ex_x121=explode("x",$ex_other21[2]); echo "=>".$ex_x121[0].'<br>'; }}?>
                                                                                    -->
                                                                                    <?php if($RX_other) { echo '=> '.$RX_other;echo "<br>";}?><br>
                                                                                    <?php if($RX_other1) { echo '=> '.$RX_other1;echo "<br>";}?>
                                                                                    <br><br>
                                            
                                            
                                            
                                            <?php if(($SNEHAN) || ($SWEDAN) || ($VAMAN) || ($VIRECHAN) || ($BASTI) || ($NASYA) || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || $SHIROBASTI || ($OTHER) || ($SWA1) || ($SWA2) || ($YONIDHAVAN) || ($YONIPICHU) || ($UTTARBASTI)){?>
                                            <b> उपक्रम-</b><br>   
                                            <?php  if($SNEHAN){  echo $SNEHAN.'<br>'; }?>
                                            
                                            <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                            
                                            <?php 
                                                $create_date = strtotime($profile->create_date);
                                                $final_date_vaman = strtotime("+6 days",$create_date);
                                               $vaman_date = date("d-m-Y",$final_date_vaman);
                                              //echo "<br>";
                                             // echo $date[$i];
                                            ?>
                                            <?php if($vaman_date == $date[$i]) { ?>
                                            <?php  echo $VAMAN; ?>
                                            <?//php  if(($VAMAN)  && ($i==0)) {  echo $VAMAN.'<br>';  $VAMAN_1D=$VAMAN;  }?>
                                            <?php } ?>
                                            <?php  if($VIRECHAN){  echo $VIRECHAN.'<br>'; }?>
                                            
                                            <?php  if($BASTI){  echo $BASTI.'<br>'; }?>
                                            <?php 
                                                $create_date = date("d-m-Y",strtotime($profile->create_date));
                                                $final_date_nasya = strtotime("+7 days",$create_date);
                                               $nasya_date = date("d-m-Y",$final_date_nasya);
                                               // echo "<br>";
                                               // echo $date[$i];
                                            ?>
                                            <?php if($create_date == $date[$i]){ ?>
                                            <?php  if($NASYA){  echo $NASYA.'<br>'; }?>
                                            <?php } ?>
                                            <?php  if(($RAKTAMOKSHAN)  && ($i==0)) { echo $RAKTAMOKSHAN.'<br>'; }?>
                                            
                                            <?php  if($SHIRODHARA_SHIROBASTI) {  echo $SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                            
                                            <?php 
                                                $create_date = strtotime($profile->create_date);
                                                $final_date_shirobasti = strtotime("+1 days",$create_date);
                                               $shirobasti_date = date("d-m-Y",$final_date_shirobasti);
                                               // echo "<br>";
                                               // echo $date[$i];
                                            ?>
                                            <?php if($shirobasti_date == $date[$i]){ ?>
                                            <?php  if($SHIROBASTI) {  echo $SHIROBASTI.'<br>'; }?>
                                            <?php } ?>
                                            
                                            
                                            <?php if($OTHER){  if(strpos($OTHER, '1D') !== false) { if($i==0) { echo $OTHER.'<br> '; $OTHER_1D=$OTHER; } else{ echo '';} }  else { echo $OTHER.'<br>'; } }?>
                                            
                                            <?php  if($SWA1){  echo $SWA1.'<br>'; }?>
                                            
                                            <?php  if($SWA2){  echo $SWA2.'<br>'; }?>
                                           
                                           <?php  if($YONIDHAVAN){  echo $YONIDHAVAN.'<br>'; }?>
                                           <?php  if($YONIPICHU){  echo $YONIPICHU.'<br>'; }?>
                                           <?php  if($UTTARBASTI){  echo $UTTARBASTI.'<br>'; }}?>
                                        
                                            <?php
                                                $tre_covid_2nd_morning = $Only_2nd_Day_Morning_covid;
                                                $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                            
                                                // if((($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)  || ($Sp_Investigations_pandamic)) && ($i==0)){
                                                if((($HEMATOLOGICAL!='') || ($SEROLOGYCAL!='') || ($BIOCHEMICAL!='') || ($MICROBIOLOGICAL!='') || ($X_RAY!='') || ($ECG!='') || ($USG!='')  || ($Sp_Investigations_pandamic!='')) && ($i==0)){
                                            ?>
                                                <b> Adv- </b><br>
                                            
                                            <?php //if((strpos($HEMATOLOGICAL, 'CBC') !== false) || (strpos($SEROLOGYCAL, 'CBC') !== false) || (strpos($BIOCHEMICAL, 'CBC') !== false) || (strpos($MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                            <?php //if((strpos($HEMATOLOGICAL, 'ESR') !== false) || (strpos($SEROLOGYCAL, 'ESR') !== false) || (strpos($BIOCHEMICAL, 'ESR') !== false) || (strpos($MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                            <?php //if((strpos($HEMATOLOGICAL, 'LFT') !== false) || (strpos($SEROLOGYCAL, 'LFT') !== false) || (strpos($BIOCHEMICAL, 'LFT') !== false) || (strpos($MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                            <?php //if((strpos($HEMATOLOGICAL, 'RFT') !== false) || (strpos($SEROLOGYCAL, 'RFT') !== false) || (strpos($BIOCHEMICAL, 'RFT') !== false) || (strpos($MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                            
                                            
                                            
                                            
                                            <?php  if($HEMATOLOGICAL){  echo $HEMATOLOGICAL.'<br>'; }?>
                                            
                                            <?php  if($SEROLOGYCAL){  echo $SEROLOGYCAL.'<br>'; }?>
                                            
                                            <?php  if($BIOCHEMICAL){  echo $BIOCHEMICAL.'<br>'; }?>
                                            
                                            <?php  if($MICROBIOLOGICAL){  echo $MICROBIOLOGICAL.'<br>'; }?>
                                            
                                            <?php  if($X_RAY){  echo $X_RAY.'<br><br>'; }?>
                                            
                                            <?php  if($ECG){  echo $ECG.'<br><br>'; }?>
                                            
                                            <?php  if($USG){  echo $USG.'<br><br>'; }?>
                                            <?php 
                                            
                                            $tre_spe_invet = $Sp_Investigations_pandamic;
                                            $ex_spe_invet=explode(",",$tre_spe_invet);
                                            
                                            
                                            if($Sp_Investigations_pandamic){  echo "<br><b>=>".$ex_spe_invet[0];echo "<br>"; echo "<b>=>".$ex_2d_morn[0]; if($ex_spe_invet[1]) { echo "<br>=>".$ex_spe_invet[1].'<br>'; } }?>
                                            
                                            <?php }?>
                                            
                                            <?php 
                                            
                                            
                                            if(($Only_2nd_Day_Morning_covid) && ($i==1)) {?><b>  <?php echo "<br>"; if($ex_2d_morn[1]) { echo "=>".$ex_2d_morn[1].'<br>'; }echo "<br>";?></b><?php }?>
                                            
                                            
                                            <?php  if(($vkarma) && ($i ==7)){  if(strpos($vkarma, 'KSHAR SUTRA') !== false){ echo "=>".$vkarma.'<br>'; }}?>
                                            
                                            
                                        </td>
                                    </tr>
                                    <?php if(($Post_Operative) && ($i==1)) {?>
                                    <tr style="page-break-after: always;"><td style="border-right: 2px solid #574646;"><?php echo date('d-m-Y',strtotime($date[$i])); echo "<br> 01:30 PM"; ?></td>
                                        <td style="border-right: 2px solid #574646;">
                                        
                                            <?php $str = $bp;
                                            $ex=explode("/",$str);
                                            ?>
                                            <?php if($profile->department_id != 32){ ?><b> BP : <?php if((!empty($tretment->bp)) && ($i==0)) {   echo "200/110 mm of Hg"; }  else if($bp) { if($ex[0]%2==0){ echo ($ex[0] + 2).'/'.($ex[1] + 2)."   mm of Hg";} else{ echo $bp,"   mm of Hg";}} else { echo $bp[$bp1],"   mm of Hg";} ?><br><?php } ?>
                                            
                                            
                                            Pulse : <?php if($pulse) { if($i%2==0) { echo $pulse." /min";} else { echo ($pulse + 4)." /min";} } else { echo 	          $Pulse[$Pulse1]." /min";} ?><br>
                                            
                                            
                                            नाडी : <?php if($nadi){ echo $nadi;}else { echo $nadi[$nadi1]; }?><br>
                                            
                                            
                                         RS: <?php if($tretment->rs) { echo $tretment->rs; }else { echo $ur; }?><br>  
                                            
                                            CVS : <?php echo $cvs;?><br>
                                            <!--उदर (PA): <?//php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?></b>--><br>
                                            
                                        </td>
                                        <td style="border-right: 2px solid #574646;"><?php echo "<b> Post Operative Notes- <br>";  if($Post_Operative) { echo "=>".$ex_str_p_o[0];echo "<br>"; if($ex_str_p_o[1]) { echo "=>".$ex_str_p_o[1].'<br>'; } if($ex_str_p_o[2]) { echo "=>".$ex_str_p_o[2].'<br>'; } if($ex_str_p_o[3]) { echo "=>".$ex_str_p_o[3].'<br>'; } if($ex_str_p_o[4]) { echo "=>".$ex_str_p_o[4].'<br>'; }
                                        
                                            if($ex_str_p_o[5]) { echo "=>".$ex_str_p_o[5].'<br>'; } if($ex_str_p_o[6]) { echo "=>".$ex_str_p_o[6].'<br>'; } if($ex_str_p_o[7]) { echo "=>".$ex_str_p_o[7].'<br>'; } if($ex_str_p_o[8]) { echo "=>".$ex_str_p_o[8].'<br>'; } 
                                            if($ex_str_p_o[9]) { echo "=>".$ex_str_p_o[9].'<br>'; } if($ex_str_p_o[10]) { echo "=>".$ex_str_p_o[10].'<br>'; } if($ex_str_p_o[11]) { echo "=>".$ex_str_p_o[11].'<br>'; } if($ex_str_p_o[12]) { echo "=>".$ex_str_p_o[12].'<br>'; } 
                                            if($ex_str_p_o[13]) { echo "=>".$ex_str_p_o[13].'<br>'; } if($ex_str_p_o[14]) { echo "=>".$ex_str_p_o[14].'<br>'; } if($ex_str_p_o[15]) { echo "=>".$ex_str_p_o[15].'<br>'; } if($ex_str_p_o[16]) { echo "=>".$ex_str_p_o[16].'<br>'; } 
                                            if($ex_str_p_o[17]) { echo "=>".$ex_str_p_o[17].'<br>'; } if($ex_str_p_o[18]) { echo "=>".$ex_str_p_o[18].'<br>'; } if($ex_str_p_o[19]) { echo "=>".$ex_str_p_o[19].'<br>'; } if($ex_str_p_o[20]) { echo "=>".$ex_str_p_o[20].'<br>'; } 
                                            if($ex_str_p_o[21]) { echo "=>".$ex_str_p_o[21].'<br>'; } if($ex_str_p_o[22]) { echo "=>".$ex_str_p_o[22].'<br>'; } if($ex_str_p_o[23]) { echo "=>".$ex_str_p_o[23].'<br>'; } if($ex_str_p_o[24]) { echo "=>".$ex_str_p_o[24].'<br>'; } 
                                            echo "</b><br>"; }?>
                                        </td>
                                    </tr> 
                                    <?php }?>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <!--  -----------------------################## EVENING TIME ###########################------------------  -->
                                    <?php 
                                        $total_d= count($date) - 1;
                                        if($i ==$total_d){ } else{?> 
                                    
                                    <tr>
                                    
                                    
                                    
                                    <td style="border-right: 2px solid #574646;"><?php echo date('d-m-Y',strtotime($date[$i])); 
                                    echo "<br>";
                                    
                                    if($i%2==0)
                                    {  
                                        echo "07:25 PM";
                                    } 
                                    else
                                    {
                                        echo  "07:15 PM";
                                    } 
                                    ?>
                                    </td>
                                    
                                    
                                    <td style="border-right: 2px solid #574646;"> <b>
                                    <b> C/O :  </b><?php echo "No Fresh Complaint";?><br>
                                    
                                    <!--<b> Family History : </b> <?php if(!empty($profile->f_h)) { echo $profile->f_h.'<br>';} else { echo ''.$f_h;}?>-->
                                    <b> Family History : </b> <?php if($profile->f_h) { echo $profile->f_h.'<br>';} else { echo '';}?><br>
                                    
                                    <!--<b> O/E-</b><br>--><br>
                                    
                                    <!--<?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>-->
                                    <?php if($tretment->temp) {echo $tretment->temp;}else{ echo ''; } ?>
                                    
                                    
                                    <?php $str = $bp;
                                    $ex=explode("/",$str);
                                    ?>
                                    <!--BP : <?//php if((!empty($tretment->bp)) && ($i==0)) {   echo "190/100 mm of Hg"; }  else  if($bp) { if($ex[0]%2==0){ echo $bp,"   mm of Hg"; } else{ echo ($ex[0] + 4).'/'.($ex[1] + 4)."   mm of Hg"; }} else { echo $bp[$bp1],"   mm of Hg";}?><br>-->
                                    
                                   <?php if($profile->department_id != 32){ ?><b> BP : <?php if((!empty($tretment->bp)) && ($i==0)) {   echo "200/110 mm of Hg"; }  else if($bp) { if($ex[0]%2==0){ echo ($ex[0] + 2).'/'.($ex[1] + 2)."   mm of Hg";} else{ echo $bp,"   mm of Hg";}} else { echo $bp[$bp1],"   mm of Hg";} ?><br><?php } ?>
                                    
                                    <!--Pulse : <?php if($pulse) { { if($i%2==0) { echo ($pulse +2)." /min";} else { echo ($pulse)." /min";} }} else { echo 	          $Pulse[$Pulse1]." /min";} ?><br>-->
                                   
                                   
                                    Pulse : <?php if($pulse) { { if($i%2==0) { echo ($pulse +2)." /min";} else { echo ($pulse)." /min";} }} else { echo $Pulse[$Pulse1]." /min";} ?><br>
                                    
                                    नाडी : <?php if($nadi){ echo $nadi;}else { echo $nadi[$nadi1]; }?><br>
                                    
                                    RS: <?php if($tretment->rs) { echo $tretment->rs; }else {  echo ''; }?><br>  
                                    
                                    CVS : <?php echo $cvs;?><br>
                                    <!--उदर (PA): <?//php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i -1; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?>--><br>
                                    
                                    
                                    <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                    <?php if(!empty($tretment->pv)) { echo 'PV: '.$tretment->pv.'<br>'; } ?>
                                    
                                    
                                    </td>
                                    
                                    <td style="border-right: 2px solid #574646;">
                                       
                                    <?php if(($Pr_Op_Medication) && ($i==0)) {?><b> - </b> <?php echo " ".$Pr_Op_Medication;echo "<br>";}?>
                                    <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br><br>
                                    
                                    
                                    
                                    <?php if(($SNEHAN) || ($SWEDAN) || ($VAMAN) || ($VIRECHAN) || ($BASTI) || ($NASYA) || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI)|| $SHIROBASTI || ($OTHER) || ($SWA1) || ($SWA2) || ($YONIDHAVAN) || ($YONIPICHU) || ($UTTARBASTI)){?>
                                    <b> उपक्रम-</b><br>   
                                    <?php  echo "C.T.ALL";?>
                                    
                                    
                                    
                                    <?php   }?>
                                    </td>
                                    
                                    
                                    </tr>
                                    
                                    <?php }     }?>
                                    
                                    <?php if($profile->discharge_date != '0000-00-00'){ ?>
                                        <tr>
                                            <td style="border-right: 2px solid #574646;"></td>
                                            <td style="border-right: 2px solid #574646;"></td>
                                            <td style="border-right: 2px solid #574646;"><b> Patient is discharged <br> Follow up after 7 days in OPD.  </b></td>
                                        </tr>
                                    <?php } ?>
                                    
                                    
                                    <?php
                                    }
                                    ////////////////////////////// End Auto Treatment//////////////////////
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                <?php if($profile->manual_status == 1){?>
                <?php 
                    $res1= $this->db->select(['DISTINCT(Post_Operative)', 'ipd_round_date'])
                    ->where(['patient_id_auto'=>$profile->id, 'Post_Operative != '=> ''])
                    ->order_by('ipd_round_date', 'ASC')
                    ->Limit(1)
                    ->get('manual_treatments')
                    ->row();
                    //print_r($this->db->last_query($res1));
                    //print_r($res1);
                ?>
                    <?php if($res1) { ?>
                        <div class="row" style="page-break-after: always;border: groove;">
                            
                            <div class="col-sm-12" align="center"> 
                                <strong style="font-family: -webkit-body;font-size: 20px;"><?php echo $this->session->userdata('title') ?></strong>
                                <p class="text-center" style="font-family: -webkit-body;font-size: 20px;"><?php echo $this->session->userdata('address') ?></p>
                                <span></span><h1 style="border: inset;background-color: #f1f0ee;">Post Operative Notes</h1><span></span>
                            </div>
                        
                            <div class="col-md-12 col-lg-12 "> 
                                <div class="container" style="width: 100%; padding-right: 0px;padding-left: 0px;">
                                    <table class="table lab lab1" style="%;">
                                        <tbody>
                                            <tr>
                                                <td>C.O.P.D.No.:- <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                                <td>C.I.P.D. No:- <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                                <td>Contact :-<span style="font-weight: bold;">  <?php echo $profile->phone;?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Patient's Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                                <td>Age :-<span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?> yrs.</span></td>
                                                <td>Sex :-<span style="font-weight: bold;"><?php echo $profile->sex;?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Address:-<span style="font-weight: bold;"> <?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                                <td>D.O.A.:-<span style="font-weight: bold;">
                                                    <?php
                                                    //echo date('d-m-Y',strtotime($profile->create_date));
                                                    
                                                    if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                                        {
                                                           echo date('d-m-Y',strtotime($date_f5));
                                                        }
                                                        else
                                                        {
                                                            echo date('d-m-Y',strtotime($profile->create_date)); 
                                                        }
                                                    
                                                    ?>
                                                    
                                                    </span></td>
                                                <td>D.O.D.:- <span style="font-weight: bold;"> 
                                                <?php if($profile->discharge_date=='0000-00-00') 
                                                { 
                                                    echo $profile->discharge_date; 
                                                }
                                                else 
                                                { 
                                                    //echo date('d-m-Y',strtotime($profile->discharge_date)); 
                                                    
                                                    if(date('d-m-Y',strtotime($profile->discharge_date))=='01-01-1970')
                                                    {
                                                      echo date('d-m-Y',strtotime($date_f6));
                                                    }
                                                    else
                                                    {
                                                        echo date('d-m-Y',strtotime($profile->discharge_date)); 
                                                    }
                                                }
                                                ?>
                                                </span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table" style="border: 2px solid #574646;">
                                        <tbody>
                                            <tr>
                                                <?php 
                                                    $str_p_o = $res1->Post_Operative;
                                                    $ex_str_p_o=explode(",",$str_p_o);
                                                ?>
                                                <td colspan="6">Post Operative Notes : <br> <span style="font-weight: bold;">
                                                    <?php  if($res1->Post_Operative) { echo "=>".$ex_str_p_o[0];echo "<br>"; if($ex_str_p_o[1]) { echo "=>".$ex_str_p_o[1].'<br>'; } if($ex_str_p_o[2]) { echo "=>".$ex_str_p_o[2].'<br>'; } if($ex_str_p_o[3]) { echo "=>".$ex_str_p_o[3].'<br>'; } if($ex_str_p_o[4]) { echo "=>".$ex_str_p_o[4].'<br>'; }
                                                    if($ex_str_p_o[5]) { echo "=>".$ex_str_p_o[5].'<br>'; } if($ex_str_p_o[6]) { echo "=>".$ex_str_p_o[6].'<br>'; } if($ex_str_p_o[7]) { echo "=>".$ex_str_p_o[7].'<br>'; } if($ex_str_p_o[8]) { echo "=>".$ex_str_p_o[8].'<br>'; } 
                                                    if($ex_str_p_o[9]) { echo "=>".$ex_str_p_o[9].'<br>'; } if($ex_str_p_o[10]) { echo "=>".$ex_str_p_o[10].'<br>'; } if($ex_str_p_o[11]) { echo "=>".$ex_str_p_o[11].'<br>'; } if($ex_str_p_o[12]) { echo "=>".$ex_str_p_o[12].'<br>'; } 
                                                    if($ex_str_p_o[13]) { echo "=>".$ex_str_p_o[13].'<br>'; } if($ex_str_p_o[14]) { echo "=>".$ex_str_p_o[14].'<br>'; } if($ex_str_p_o[15]) { echo "=>".$ex_str_p_o[15].'<br>'; } if($ex_str_p_o[16]) { echo "=>".$ex_str_p_o[16].'<br>'; } 
                                                    if($ex_str_p_o[17]) { echo "=>".$ex_str_p_o[17].'<br>'; } if($ex_str_p_o[18]) { echo "=>".$ex_str_p_o[18].'<br>'; } if($ex_str_p_o[19]) { echo "=>".$ex_str_p_o[19].'<br>'; } if($ex_str_p_o[20]) { echo "=>".$ex_str_p_o[20].'<br>'; } 
                                                    if($ex_str_p_o[21]) { echo "=>".$ex_str_p_o[21].'<br>'; } if($ex_str_p_o[22]) { echo "=>".$ex_str_p_o[22].'<br>'; } if($ex_str_p_o[23]) { echo "=>".$ex_str_p_o[23].'<br>'; } if($ex_str_p_o[24]) { echo "=>".$ex_str_p_o[24].'<br>'; } 
                                                    echo "</b><br>"; }?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else{ ?>
                    <?php if($Post_Operative) { ?>
                        <div class="row" style="page-break-after: always;border: groove;">
                        
                        <div class="col-sm-12" align="center"> 
                            <strong style="font-family: -webkit-body;font-size: 20px;"><?php echo $this->session->userdata('title') ?></strong>
                            <p class="text-center" style="font-family: -webkit-body;font-size: 20px;"><?php echo $this->session->userdata('address') ?></p>
                            <span></span><h1 style="border: inset;background-color: #f1f0ee;">Post Operative Notes</h1><span></span>
                        </div>
                    
                        <div class="col-md-12 col-lg-12 "> 
                            <div class="container" style="width: 100%; padding-right: 0px;padding-left: 0px;">
                                <table class="table lab lab1" style="%;">
                                    <tbody>
                                        <tr>
                                            <td>C.O.P.D.No.:- <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                            <td>C.I.P.D. No:- <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                            <td>Contact :-<span style="font-weight: bold;">  <?php echo $profile->phone;?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Patient's Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                            <td>Age :-<span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?> yrs.</span></td>
                                            <td>Sex :-<span style="font-weight: bold;"><?php echo $profile->sex;?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Address:-<span style="font-weight: bold;"> <?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                            <!--<td>D.O.A.:-<span style="font-weight: bold;"><?//php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>-->
                                            <!--<td>D.O.D.:- <span style="font-weight: bold;"> <?//php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?></span></td>-->
                                            <td>D.O.A.:-<span style="font-weight: bold;">
                                                    <?php
                                                    //echo date('d-m-Y',strtotime($profile->create_date));
                                                    
                                                    if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                                        {
                                                            echo date('d-m-Y',strtotime($date_f5));
                                                        }
                                                        else
                                                        {
                                                            echo date('d-m-Y',strtotime($profile->create_date)); 
                                                        }
                                                    
                                                    ?>
                                                    
                                                    </span></td>
                                                <td>D.O.D.:- <span style="font-weight: bold;"> 
                                                <?php if($profile->discharge_date=='0000-00-00') 
                                                { 
                                                    echo $profile->discharge_date; 
                                                }
                                                else 
                                                { 
                                                    //echo date('d-m-Y',strtotime($profile->discharge_date)); 
                                                    
                                                    if(date('d-m-Y',strtotime($profile->discharge_date))=='01-01-1970')
                                                    {
                                                       echo date('d-m-Y',strtotime($date_f6));
                                                    }
                                                    else
                                                    {
                                                        echo date('d-m-Y',strtotime($profile->discharge_date)); 
                                                    }
                                                }
                                                ?>
                                                </span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table" style="border: 2px solid #574646;">
                                    <tbody>
                                        <tr>
                                            <td colspan="6">Post Operative Notes : <br> <span style="font-weight: bold;">
                                                <?php  if($Post_Operative) { echo "=>".$ex_str_p_o[0];echo "<br>"; if($ex_str_p_o[1]) { echo "=>".$ex_str_p_o[1].'<br>'; } if($ex_str_p_o[2]) { echo "=>".$ex_str_p_o[2].'<br>'; } if($ex_str_p_o[3]) { echo "=>".$ex_str_p_o[3].'<br>'; } if($ex_str_p_o[4]) { echo "=>".$ex_str_p_o[4].'<br>'; }
                                                if($ex_str_p_o[5]) { echo "=>".$ex_str_p_o[5].'<br>'; } if($ex_str_p_o[6]) { echo "=>".$ex_str_p_o[6].'<br>'; } if($ex_str_p_o[7]) { echo "=>".$ex_str_p_o[7].'<br>'; } if($ex_str_p_o[8]) { echo "=>".$ex_str_p_o[8].'<br>'; } 
                                                if($ex_str_p_o[9]) { echo "=>".$ex_str_p_o[9].'<br>'; } if($ex_str_p_o[10]) { echo "=>".$ex_str_p_o[10].'<br>'; } if($ex_str_p_o[11]) { echo "=>".$ex_str_p_o[11].'<br>'; } if($ex_str_p_o[12]) { echo "=>".$ex_str_p_o[12].'<br>'; } 
                                                if($ex_str_p_o[13]) { echo "=>".$ex_str_p_o[13].'<br>'; } if($ex_str_p_o[14]) { echo "=>".$ex_str_p_o[14].'<br>'; } if($ex_str_p_o[15]) { echo "=>".$ex_str_p_o[15].'<br>'; } if($ex_str_p_o[16]) { echo "=>".$ex_str_p_o[16].'<br>'; } 
                                                if($ex_str_p_o[17]) { echo "=>".$ex_str_p_o[17].'<br>'; } if($ex_str_p_o[18]) { echo "=>".$ex_str_p_o[18].'<br>'; } if($ex_str_p_o[19]) { echo "=>".$ex_str_p_o[19].'<br>'; } if($ex_str_p_o[20]) { echo "=>".$ex_str_p_o[20].'<br>'; } 
                                                if($ex_str_p_o[21]) { echo "=>".$ex_str_p_o[21].'<br>'; } if($ex_str_p_o[22]) { echo "=>".$ex_str_p_o[22].'<br>'; } if($ex_str_p_o[23]) { echo "=>".$ex_str_p_o[23].'<br>'; } if($ex_str_p_o[24]) { echo "=>".$ex_str_p_o[24].'<br>'; } 
                                                echo "</b><br>"; }?>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <?php }?>
                
                
                <?php if($profile->discharge_date != '0000-00-00' && date('Y-m-d',strtotime($profile->discharge_date)) <= date('Y-m-d')){ ?>
                <!--  Discharge Cardstart -->     
                <div class="row" style="page-break-after: always;border: groove;">
                
                    <div class="col-sm-12" align="center"> 
                        <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
                        <span></span><h1 style="border: inset;background-color: #f1f0ee;font-size: 23px;">Discharge Card</h1><span></span>
                    </div>
                
                    <div class="col-md-12 col-lg-12 "> 
                        <div class="container" style="width: 100%; padding-right: 0px;padding-left: 0px;">
                            <table class="table lab lab1" style="%;">
                                <tbody>
                                    <tr>
                                        <td>C.O.P.D.No.:- <span style="font-weight: bold;"><?php  echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?>  <?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ; echo".".$year1222;?></span></td>
                                        <td>C.I.P.D. No:- <span style="font-weight: bold;"><?php echo $tot_serial_ipd_change; echo".".$year1222;?> </span></td>
                                        <td>Contact :-<span style="font-weight: bold;">  <?php echo $profile->phone;?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Patient's Name:-    <span style="font-weight: bold;"><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
                                        <td>Age :-<span style="font-weight: bold;"><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?> yrs.</span></td>
                                        <td>Sex :-<span style="font-weight: bold;"><?php echo $profile->sex;?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Address:-<span style="font-weight: bold;"> <?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
                                        <td>D.O.A.:-<span style="font-weight: bold;">
                                            <?php 
                                            
                                            //echo date('d-m-Y',strtotime($profile->create_date)); 
                                            
                                            if(date('d-m-Y',strtotime($profile->create_date))=='01-01-1970')
                                                {
                                                  echo date('d-m-Y',strtotime($date_f5));
                                                }
                                                else
                                                {
                                                    echo date('d-m-Y',strtotime($profile->create_date)); 
                                                }
                                            
                                            ?>
                                            
                                            </span></td>
                                        <td>D.O.D.:- <span style="font-weight: bold;"> 
                                        <?php if($profile->discharge_date=='0000-00-00') 
                                        { 
                                        echo $profile->discharge_date; 
                                        } 
                                        else 
                                        { 
                                       // echo date('d-m-Y',strtotime($profile->discharge_date));
                                         if(date('d-m-Y',strtotime($profile->discharge_date))=='01-01-1970')
                                                {
                                                  echo date('d-m-Y',strtotime($date_f6));
                                                }
                                                else
                                                {
                                                    echo date('d-m-Y',strtotime($profile->discharge_date)); 
                                                }
                                        } ?>
                                        </span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if($profile->manual_status == 1)
                            { ?>
                                <?php 
                                    $result2= $this->db->where(['patient_id_auto'=>$profile->id, 'rounds'=>'1'])
                                                ->order_by('ipd_round_date', 'DESC')
                                                ->limit(1)
                                                ->get('manual_treatments')
                                                ->row();
                                                // print_r($this->db->last_query());
                                ?>
                                <table class="table" style="border: 2px solid #574646;">
                                    <tbody>
                                        <tr>
                                            <td colspan="6">General Condition: <span style="font-weight: bold;"> <?php  echo $profile->gcondition; ?></span>
                                        </tr>
                                        <tr>
                                            <td> O/e /Temp:&nbsp;&nbsp;&nbsp; &nbsp; <span style="font-weight: bold;"><?php  echo $result2->tapman;?>°F</span></td>
                                            <?php 
                                                $str = $result2->bp;
                                                $ex=explode("/",$str);
                                            ?>
                                            <td>B.P.:&nbsp;&nbsp;&nbsp; &nbsp; <span style="font-weight: bold;"><?php if($result2->bp) { if($ex[0]%2==0){ echo ($ex[0] ).'/'.($ex[1] )."   mm of Hg";} else{ echo $profile->bp,"   mm of Hg";}} else { echo $result2->bp,"   mm of Hg";}?>  </span></td>
                                            <td>Pulse:&nbsp;&nbsp;&nbsp; &nbsp;<span style="font-weight: bold;">    <?php if($result2->pulse) { { if($result2->pulse%2==0) { echo ($result2->pulse)." /min";} else { echo ($profile->pulse)." /min";} }} else { echo $result2->pulse." /min";} ?>  </span></td>
                                            <td>RS: <span style="font-weight: bold;">     <?php if($result2->rs) { echo $result2->rs; }else {  echo $profile->ur; }?>             </span></td>
                                            <td>CVS : <span style="font-weight: bold;">      <?php echo $result2->cvs;?>      </span></td>
                                            <td>PA: <span style="font-weight: bold;">          <?php if($result2->pa) { echo  $result2->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $profile->udar;}?>     </span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Investigation: <br> <span style="font-weight: bold;">    
                                                <?php $tre_spe_inves = $result2->Sp_Investigations_pandamic;
                                                $ex_spe_inves=explode(",",$tre_spe_inves);?>
                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'CBC') !== false) || (strpos($result2->SEROLOGYCAL, 'CBC') !== false) || (strpos($result2->BIOCHEMICAL, 'CBC') !== false) || (strpos($result2->MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'ESR') !== false) || (strpos($result2->SEROLOGYCAL, 'ESR') !== false) || (strpos($result2->BIOCHEMICAL, 'ESR') !== false) || (strpos($result2->MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'LFT') !== false) || (strpos($result2->SEROLOGYCAL, 'LFT') !== false) || (strpos($result2->BIOCHEMICAL, 'LFT') !== false) || (strpos($result2->MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                                <?php //if((strpos($result2->HEMATOLOGICAL, 'RFT') !== false) || (strpos($result2->SEROLOGYCAL, 'RFT') !== false) || (strpos($result2->BIOCHEMICAL, 'RFT') !== false) || (strpos($result2->MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                            
                                                <?php  if($result2->HEMATOLOGICAL) { echo $result2->HEMATOLOGICAL."<br>";} if($result2->SEROLOGYCAL){ echo $result2->SEROLOGYCAL."<br>";} if($result2->BIOCHEMICAL) { echo $result2->BIOCHEMICAL."<br>";} if($result2->MICROBIOLOGICAL) { echo $result2->MICROBIOLOGICAL."<br>";} if($result2->X_RAY) { echo $result2->X_RAY."<br>";} if($result2->ECG) { echo $result2->ECG."<br>";} if($result2->USG){ echo $result2->USG;} if($result2->Sp_Investigations_pandamic){  echo '=>'.$ex_spe_inves[0];echo "<br>"; if($ex_spe_inves[1]) { echo "=>".$ex_spe_inves[1].'<br>'; }}    ?>    
                                            
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Brief History : <br><span style="font-weight: bold;">   <?php if($result2->kco) { ?>: </b><?php echo 'K/C/O : '.$result2->kco.'<br>';}?>
                                                <?php if($result2->h_o) { if ($result2->h_o =='NAD') { } else { echo $result2->h_o;}} else { echo '';}?>
                                                <?php echo $result2->sym_name; ?><br>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Treatment Received : <br><span style="font-weight: bold;">  
                                                <?php 
                                                
                                                    $tre_rx1DS = $result2->DSRX1;
                                                    $exDS=explode(",",$tre_rx1DS);
                                                    $tre_rx2DS = $result2->DSRX2;
                                                    $ex2DS=explode(",",$tre_rx2DS);
                                                    $tre_rx3DS = $result2->DSRX3;
                                                    $ex3DS=explode(",",$tre_rx3DS);
                                                    $tre_rx4DS = $result2->DSRX4;
                                                    $ex4DS=explode(",",$tre_rx4DS);
                                                    $tre_rx5DS = $result2->DSRX5;
                                                    $ex5DS=explode(",",$tre_rx5DS);
                                                ?>
                                                <?php if($result2->DSRX1) { echo "=>".str_replace("?","-->",$exDS[0]);echo "<br>"; if($exDS[1]) { echo "=>".str_replace("?","-->",$exDS[1]).'<br>'; } if($exDS[2]) { echo "=>".str_replace("?","-->",$exDS[2]).'<br>'; }}?>
                                                <?php if($result2->DSRX2) { echo "=>".str_replace("?","-->",$ex2DS[0]);echo "<br>"; if($ex2DS[1]) { echo "=>".str_replace("?","-->",$ex2DS[1]).'<br>'; } if($ex2DS[2]) { echo "=>".str_replace("?","-->",$ex2[2]).'<br>'; }}?>
                                                <?php if($result2->DSRX3) { echo "=>".str_replace("?","-->",$ex3DS[0]);echo "<br>"; if($ex3DS[1]) { echo "=>".$ex3DS[1].'<br>'; } if($ex3DS[2]) { echo "=>".$ex3DS[2].'<br>'; }}?>
                                                <?php if($result2->DSRX4) { echo "=>".$ex4DS[0];echo "<br>"; if($ex4DS[1]) { echo "=>".$ex4DS[1].'<br>'; } if($ex4DS[2]) { echo "=>".$ex4DS[2].'<br>'; }}?>
                                                <?php if($result2->DSRX5) { echo "=>".$ex5DS[0];echo "<br>"; if($ex5DS[1]) { echo "=>".$ex5DS[1].'<br>'; } if($ex5DS[2]) { echo "=>".$ex5DS[2].'<br>'; }}?>
                                              
                                              <?php if($result2->other_equipment_drx) 
                                                {
                                                  $test = explode(",",$result2->other_equipment_drx);
                                                  $count = count($test); 
                                                  for($i=0;$i<$count;$i++)
                                                  {
                                                    echo $test[$i].'<br>';
                                                  }
                                                }
 				?>
                                              
                                              
                                                <?php                        
                                                    $tre_rx = $result2->RX1;
                                                    $ex=explode(",",$tre_rx);
                                                    $tre_rx2 = $result2->RX2;
                                                    $ex2=explode(",",$tre_rx2);
                                                    $tre_rx3 = $result2->RX3;
                                                    $ex3=explode(",",$tre_rx3);
                                                    $tre_rx4 = $result2->RX4;
                                                    $ex4=explode(",",$tre_rx4);
                                                    $tre_rx5 = $result2->RX5;
                                                    $ex5=explode(",",$tre_rx5);
                                                $tre_rx6 = $RX6;
                                                                                        $ex6=explode(",",$tre_rx6);
                                                                                        $tre_rx7 = $RX7;
                                                                                        $ex7=explode(",",$tre_rx7);
                                                                                        $tre_rx8 = $RX8;
                                                                                        $ex8=explode(",",$tre_rx8);
                                                                                        $tre_rx9 = $RX9;
                                                                                        $ex9=explode(",",$tre_rx9);
                                                                                        $tre_rx10 = $RX10;
                                                                                        $ex10=explode(",",$tre_rx10);
                                                                                        
                                                                                        $tre_other = $RX_other;
                                                                                        $ex_other=explode(",",$tre_rx5);
                                                                                        $tre_other1 = $RX_other1;
                                                                                        $ex_other1=explode(",",$tre_rx5);
                                                                                    ?>
                                                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                                                                    
                                                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                                                    
                                                                                    
                                                                                    <?php if($RX_other) { $ex_x110=explode("x",$ex_other[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex_other11[1]) { $ex_x111=explode("x",$ex_other111[1]); echo "=>".$ex_x11[0].'<br>'; } if($ex_other111[2]) { $ex_x111=explode("x",$ex_other11[2]); echo "=>".$ex_x111[0].'<br>'; }}?>
                                                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex_other1[0]);  echo "=>".$ex_x120[0];echo "<br>"; if($ex_other12[1]) { $ex_x121=explode("x",$ex_other121[1]); echo "=>".$ex_x12[0].'<br>'; } if($ex_other121[2]) { $ex_x121=explode("x",$ex_other21[2]); echo "=>".$ex_x121[0].'<br>'; }}?>
                                                                                    <br>
                                                <?php  if($result2->SWEDAN){  echo $result2->SWEDAN.'<br>'; }?>
                                                
                                                <?php  if(($result2->VAMAN)  && ($i==0)) {  echo "=>".$result2->VAMAN.'<br>'; }?>
                                                
                                                <?php  if($result2->VIRECHAN){  echo "=>".$result2->VIRECHAN.'<br>'; }?>
                                                
                                                <?php  if($result2->VAMAN){  echo "=>".$result2->VAMAN.'<br>'; }?>
                                                
                                                <?php  if($result2->BASTI){  echo "=>".$result2->BASTI.'<br>'; }?>
                                                
                                                <?php  if($result2->NASYA){  echo "=>".$result2->NASYA.'<br>'; }?>
                                                
                                                <?php  if(($result2->RAKTAMOKSHAN)  && ($i==0)) { echo "=>".$result2->RAKTAMOKSHAN.'<br>'; }?>
                                                
                                                <?php  if(($result2->SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo"=>".$result2->SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                
                                                <?php  if($result2->OTHER){  echo "=>".$result2->OTHER.'<br>'; }?>
                                                
                                                <?php  if($result2->OTHER){  echo "=>".$result2->OTHER_1D.'<br>'; }?>
                                                
                                                <?php  if($result2->SWA1){  echo "=>".$result2->SWA1.'<br>'; }?>
                                                
                                                <?php  if($result2->SWA2){  echo "=>".$result2->SWA2.'<br>'; }?>
                                                
                                                
                                                <?php  if($result2->skarma){  echo "=>".$result2->skarma.'<br>'; }?>
                                                
                                                <?php  if($result2->vkarma){  echo "=>".$result2->vkarma.'<br>'; }?>
                                                
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Treatment Advised: <br><span style="font-weight: bold;"> 
                                                <?php if($result2->DRX1) { echo $result2->DRX1.'<br> ';} if($result2->DRX2) {  echo $result2->DRX2.'<br> ' ;} if($result2->DRX3) {  echo  $result2->DRX3;} ?>  
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Follow Up : &nbsp; &nbsp;After  7  days.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Medical Officer :</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } else{ ?>
                                <table class="table" style="border: 2px solid #574646;">
                                    <tbody>
                                        <tr>
                                            <td colspan="6">General Condition: <span style="font-weight: bold;"> <?php  echo $profile->gcondition; ?></span>
                                        </tr>
                                        <tr>
                                            <td> O/e /Temp:&nbsp;&nbsp;&nbsp; &nbsp; <span style="font-weight: bold;"><?php  echo $profile->tap;?>°F</span></td>
                                            <?php $str = $bp;
                                            $ex=explode("/",$str);
                                            ?>
                                            <td>B.P.:&nbsp;&nbsp;&nbsp; &nbsp; <span style="font-weight: bold;"><?php if($bp) { if($ex[0]%2==0){ echo ($ex[0] + 2).'/'.($ex[1] + 2)."   mm of Hg";} else{ echo $bp,"   mm of Hg";}} else { echo $bp[$bp1],"   mm of Hg";}?>  </span></td>
                                            <td>Pulse:&nbsp;&nbsp;&nbsp; &nbsp;<span style="font-weight: bold;">    <?php if($pulse) { { if($pulse%2==0) { echo ($pulse +2)." /min";} else { echo ($pulse)." /min";} }} else { echo 	          $Pulse[$Pulse1]." /min";} ?>  </span></td>
                                            <td>RS: <span style="font-weight: bold;">     <?php if($tretment->rs) { echo $tretment->rs; }else {  echo $ur; }?>             </span></td>
                                            <td>CVS : <span style="font-weight: bold;">      <?php echo $cvs;?>      </span></td>
                                            <td>PA: <span style="font-weight: bold;">          <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $udar;}?>     </span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Investigation: <br> <span style="font-weight: bold;">    
                                                <?php $tre_spe_inves = $Sp_Investigations_pandamic;
                                                $ex_spe_inves=explode(",",$tre_spe_inves);?>
                                                <?php //if((strpos($HEMATOLOGICAL, 'CBC') !== false) || (strpos($SEROLOGYCAL, 'CBC') !== false) || (strpos($BIOCHEMICAL, 'CBC') !== false) || (strpos($MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
                                                <?php //if((strpos($HEMATOLOGICAL, 'ESR') !== false) || (strpos($SEROLOGYCAL, 'ESR') !== false) || (strpos($BIOCHEMICAL, 'ESR') !== false) || (strpos($MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
                                                <?php //if((strpos($HEMATOLOGICAL, 'LFT') !== false) || (strpos($SEROLOGYCAL, 'LFT') !== false) || (strpos($BIOCHEMICAL, 'LFT') !== false) || (strpos($MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
                                                <?php //if((strpos($HEMATOLOGICAL, 'RFT') !== false) || (strpos($SEROLOGYCAL, 'RFT') !== false) || (strpos($BIOCHEMICAL, 'RFT') !== false) || (strpos($MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
                                            
                                                <?php  if($HEMATOLOGICAL) { echo $HEMATOLOGICAL."<br>";} if($SEROLOGYCAL){ echo $SEROLOGYCAL."<br>";} if($BIOCHEMICAL) { echo $BIOCHEMICAL."<br>";} if($MICROBIOLOGICAL) { echo $MICROBIOLOGICAL."<br>";} if($X_RAY) { echo $X_RAY."<br>";} if($ECG) { echo $ECG."<br>";} if($USG){ echo $USG;} if($Sp_Investigations_pandamic){  echo '=>'.$ex_spe_inves[0];echo "<br>"; if($ex_spe_inves[1]) { echo "=>".$ex_spe_inves[1].'<br>'; }}    ?>    
                                            
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Brief History : <br><span style="font-weight: bold;">   <?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';}?>
                                                <?php if($tretment->h_o) { if ($tretment->h_o =='NAD') { } else { echo $tretment->h_o;}} else { echo '';}?>
                                                <?php echo $symptoms; ?><br>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Treatment Received : <br><span style="font-weight: bold;">  
                                                <?php 
                                                
                                                    $tre_rx1DS = $DSRX1;
                                                    $exDS=explode(",",$tre_rx1DS);
                                                    $tre_rx2DS = $DSRX2;
                                                    $ex2DS=explode(",",$tre_rx2DS);
                                                    $tre_rx3DS = $DSRX3;
                                                    $ex3DS=explode(",",$tre_rx3DS);
                                                    $tre_rx4DS = $DSRX4;
                                                    $ex4DS=explode(",",$tre_rx4DS);
                                                    $tre_rx5DS = $DSRX5;
                                                    $ex5DS=explode(",",$tre_rx5DS);
                                                ?>
                                                <?php if($DSRX1) { echo "=>".str_replace("?","-->",$exDS[0]);echo "<br>"; if($exDS[1]) { echo "=>".str_replace("?","-->",$exDS[1]).'<br>'; } if($exDS[2]) { echo "=>".str_replace("?","-->",$exDS[2]).'<br>'; }}?>
                                                <?php if($DSRX2) { echo "=>".str_replace("?","-->",$ex2DS[0]);echo "<br>"; if($ex2DS[1]) { echo "=>".str_replace("?","-->",$ex2DS[1]).'<br>'; } if($ex2DS[2]) { echo "=>".str_replace("?","-->",$ex2[2]).'<br>'; }}?>
                                                <?php if($DSRX3) { echo "=>".str_replace("?","-->",$ex3DS[0]);echo "<br>"; if($ex3DS[1]) { echo "=>".$ex3DS[1].'<br>'; } if($ex3DS[2]) { echo "=>".$ex3DS[2].'<br>'; }}?>
                                                <?php if($DSRX4) { echo "=>".$ex4DS[0];echo "<br>"; if($ex4DS[1]) { echo "=>".$ex4DS[1].'<br>'; } if($ex4DS[2]) { echo "=>".$ex4DS[2].'<br>'; }}?>
                                                <?php if($DSRX5) { echo "=>".$ex5DS[0];echo "<br>"; if($ex5DS[1]) { echo "=>".$ex5DS[1].'<br>'; } if($ex5DS[2]) { echo "=>".$ex5DS[2].'<br>'; }}?>
                                                
                                                <?php                        
                                                    $tre_rx = $RX1;
                                                    $ex=explode(",",$tre_rx);
                                                    $tre_rx2 = $RX2;
                                                    $ex2=explode(",",$tre_rx2);
                                                    $tre_rx3 = $RX3;
                                                    $ex3=explode(",",$tre_rx3);
                                                    $tre_rx4 = $RX4;
                                                    $ex4=explode(",",$tre_rx4);
                                                    $tre_rx5 = $RX5;
                                                    $ex5=explode(",",$tre_rx5);
                                                    $tre_rx6 = $RX6;
                                                    $ex6=explode(",",$tre_rx6);
                                                    $tre_rx7 = $RX7;
                                                    $ex7=explode(",",$tre_rx7);
                                                    $tre_rx8 = $RX8;
                                                    $ex8=explode(",",$tre_rx8);
                                                    $tre_rx9 = $RX9;
                                                    $ex9=explode(",",$tre_rx9);
                                                    $tre_rx10 = $RX10;
                                                    $ex10=explode(",",$tre_rx10);
                                                    
                                                    $tre_other = $RX_other;
                                                    $ex_other=explode(",",$tre_rx5);
                                                    $tre_other1 = $RX_other1;
                                                    $ex_other1=explode(",",$tre_rx5);
                                                ?>
                                                    <?php if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                                    <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                                    <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                                    <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                                    <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                                    
                                                    <?php if($RX6) { $ex_x60=explode("x",$ex6[0]);  echo "<br>=>".$ex_x60[0];echo "<br>"; if($ex6[1]) { $ex_x61=explode("x",$ex6[1]);  echo "=>".$ex_x61[0].'<br>'; } if($ex6[2]) { $ex_x61=explode("x",$ex6[2]); echo "=>".$ex_x61[0].'<br>'; }}?>
                                                    <?php if($RX7) { $ex_x70=explode("x",$ex7[0]);  echo "=>".$ex_x70[0];echo "<br>"; if($ex7[1]) { $ex_x71=explode("x",$ex7[1]);  echo "=>".$ex_x71[0].'<br>'; } if($ex7[2]) { $ex_x71=explode("x",$ex7[2]);  echo "=>".$ex_x72[0].'<br>'; }}?>
                                                    <?php if($RX8) { $ex_x80=explode("x",$ex8[0]); echo "=>".$ex_x80[0];echo "<br>"; if($ex8[1]) { $ex_x81=explode("x",$ex8[1]); echo "=>".$ex_x81[0].'<br>'; } if($ex8[2]) { $ex_x81=explode("x",$ex8[2]); echo "=>".$ex_x82[0].'<br>'; }}?>
                                                    <?php if($RX9) { $ex_x90=explode("x",$ex9[0]); echo "=>".$ex_x90[0];echo "<br>"; if($ex9[1]) { $ex_x91=explode("x",$ex9[1]); echo "=>".$ex_x91[0].'<br>'; } if($ex9[2]) { $ex_x91=explode("x",$ex9[2]);echo "=>".$ex_x92[0].'<br>'; }}?><br>
                                                    <?php if($RX10) { $ex_x100=explode("x",$ex10[0]);  echo "=>".$ex_x100[0];echo "<br>"; if($ex10[1]) { $ex_x101=explode("x",$ex10[1]); echo "=>".$ex_x101[0].'<br>'; } if($ex10[2]) { $ex_x101=explode("x",$ex10[2]); echo "=>".$ex_x101[0].'<br>'; }}?>
                                                    
                                                    
                                                    <?php if($RX_other) { $ex_x110=explode("x",$ex_other[0]);  echo "=>".$ex_x110[0];echo "<br>"; if($ex_other11[1]) { $ex_x111=explode("x",$ex_other111[1]); echo "=>".$ex_x11[0].'<br>'; } if($ex_other111[2]) { $ex_x111=explode("x",$ex_other11[2]); echo "=>".$ex_x111[0].'<br>'; }}?>
                                                    <?php if($RX_other1) { $ex_x120=explode("x",$ex_other1[0]);  echo "=>".$ex_x120[0];echo "<br>"; if($ex_other12[1]) { $ex_x121=explode("x",$ex_other121[1]); echo "=>".$ex_x12[0].'<br>'; } if($ex_other121[2]) { $ex_x121=explode("x",$ex_other21[2]); echo "=>".$ex_x121[0].'<br>'; }}?>
                                                    <br>
                                                                                    
                                                                                    
                                                <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                                
                                                <?php  if(($VAMAN)  && ($i==0)) {  echo "=>".$VAMAN.'<br>'; }?>
                                                
                                                <?php  if($VIRECHAN){  echo "=>".$VIRECHAN.'<br>'; }?>
                                                
                                                <?php  if($VAMAN_1D){  echo "=>".$VAMAN_1D.'<br>'; }?>
                                                
                                                <?php  if($BASTI){  echo "=>".$BASTI.'<br>'; }?>
                                                
                                                <?php  if($NASYA){  echo "=>".$NASYA.'<br>'; }?>
                                                
                                                <?php  if(($RAKTAMOKSHAN)  && ($i==0)) { echo "=>".$RAKTAMOKSHAN.'<br>'; }?>
                                                
                                                <?php  if($SHIRODHARA_SHIROBASTI) {  echo"=>".$SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                
                                                <?php  if($SHIROBASTI) {  echo"=>".$SHIROBASTI.'<br>'; }?>
                                                
                                                <?php  if(($SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo"=>".$SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                                
                                                <?php  if($OTHER){  echo "=>".$OTHER.'<br>'; }?>
                                                
                                                <?php  if($OTHER_1D){  echo "=>".$OTHER_1D.'<br>'; }?>
                                                
                                                <?php  if($SWA1){  echo "=>".$SWA1.'<br>'; }?>
                                                
                                                <?php  if($SWA2){  echo "=>".$SWA2.'<br>'; }?>
                                                
                                                <?php  if($YONIDHAVAN){  echo $YONIDHAVAN.'<br>'; }?>
                                               <?php  if($YONIPICHU){  echo $YONIPICHU.'<br>'; }?>
                                               <?php  if($UTTARBASTI){  echo $UTTARBASTI.'<br>'; }}?>
                                                
                                                
                                                <?php  if($skarma){  echo "=>".$skarma.'<br>'; }?>
                                                
                                                <?php  if($vkarma){  echo "=>".$vkarma.'<br>'; }?>
                                                
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Treatment Advised: <br><span style="font-weight: bold;"> 
                                                <?php 
                                                    if($DRX1) { echo $DRX1.'<br> ';} 
                                                    if($DRX2) {  echo $DRX2.'<br> ' ;} 
                                                    if($DRX3) {  echo  $DRX3;} 
                                                ?>  
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Follow Up : &nbsp; &nbsp;After  7  days.</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Medical Officer :</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php }?>
                        </div>
                    </div>
                </div>
               
                
            </div>
        </div>
    </div>
</div>