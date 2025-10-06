<div class="row">
    
  <!--<style>
       table tr, td {
  border: 3px solid red;
}
td {
  border: 0;
}




    </style>-->
    
    
    <style>
@import url('https://fonts.googleapis.com/css2?family=Khand&display=swap');
</style>
<?php echo error_reporting(0);?>


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
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/ipd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
                
                <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/ipd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>
                
                
                <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
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



            <div class="panel-body" style="padding-left: 50px;padding-right: 50px;">

                <div class="row" style="page-break-after: always;border: groove;">


                    <br>
                    <br>
                    <div class="col-sm-12" align="center">  
                   <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
                   <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
 
 
                    <span></span><h1 style="border: inset;background-color: #f1f0ee;">IPD PATIENT FILE</h1><span></span>

                    <br>

                    </div>

                  
                   <?php 
                                             
                                             if($profile->yearly_reg_no){
                                             $opd_data =$this->db->select("*")

			                                        ->from('patient')
			                                        ->where('yearly_reg_no', $profile->yearly_reg_no) 
			                                        //->or_where('old_reg_no', $profile->old_reg_no) 
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
                                             
                                                // patient ipd yearly no
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
						          
						          
						         
                                                
                                                 
                                        $datefrom1=date('Y-m-d',strtotime($profile->create_date));
                                        
                                       $doctor_name= $this->db->select("*")
                                      ->from('user')
                                       ->where('join_date <=', $datefrom1) 
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
                                                
                                                
                                                
                                                
                   
                   ?>
                   
                      
     <?php                               $che=trim($profile->dignosis);
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
                                     ->get()
                                     ->row();
                                     
                                     
                                 
                                         
                                     }
                                   
                                 echo $profile->proxy_id; 
                                     
                                    
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
                              //  print_r($tretment);
                                  $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $SNEHAN= $tretment->SNEHAN;
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
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
			                       
                                    ?>   
                   
                   
                    <div class="col-md-12 col-lg-12 "> 

                         <div class="container" style="width: 100%;">
        
  <table class="table" >
   
    <tbody>
      <tr>
        <td colspan="2">Ward:-     <span style="font-weight: bold;"><?php  if($profile->sex=='F') { echo 'Female';} else if($profile->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
        <td>Bed No:-  <span style="font-weight: bold;"><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></span></td>
      </tr>
      
      <tr>
        <td colspan="2">Department:-   <span style="font-weight: bold;"><span style="font-weight: bold;"><?php echo (!empty($profile->name)?$profile->name:null) ?> <?php if($ICU_C){ echo " [ICU-".$profile->sex."]";}?> </span></td>
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
        <td colspan="3">Address:- <span style="font-weight: bold;"><?php echo (!empty($profile->address)?$profile->address:null) ?> </span></td>
        
      </tr>
       <tr>
        <td colspan="3"></td>
        
       </tr>
       </tr>
       <tr>
        <td colspan="3">Phone No:- <span style="font-weight: bold;"> <?php echo $profile->phone;?></span></td>
        
      </tr>
       <tr>
        <td colspan="3">Provisional Diagnosis:-  <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></span></td>
        
      </tr>
       <tr>
        <td colspan="3"></td>
        
       </tr>
      <tr>
        <td colspan="3">Final Diagnosis:-  <span style="font-weight: bold;"><?php echo  $tretment->POVISIONALdignosis;  ?> </span></td>
        
      </tr>
      
    </tbody>
  </table>
</div>

</div>
</div>

<!--// patient info complite-->

 <div class="row" style="page-break-after: always;border: groove;">



                    <div class="col-sm-12" align="center">  
              
 <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
 <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>

<table class="table" >
   
    <tbody>
      <tr>
        <td style="line-height: 1.0;">Ward:-     <span style="font-weight: bold;"><?php  if($profile->sex=='F') { echo 'Female';} else if($profile->sex='M') { echo 'Male';} else { echo '';} ?></span></td>
        <td style="line-height: 1.0;">Bed No:-  <span style="font-weight: bold;"><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></span></td>
        <td style="line-height: 1.0;">Department:-   <span style="font-weight: bold;"><span style="font-weight: bold;"><?php echo (!empty($profile->name)?$profile->name:null) ?> <?php if($ICU_C){ echo " [ICU-".$profile->sex."]";}?> </span></td>
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
      
     
      
     <!-- <tr>
        <td style="line-height: 1.0;">Date of Dischage:-  <span style="font-weight: bold;"><?php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?> </span></td>
        <td style="line-height: 1.0;">Time:-   <span style="font-weight: bold;"><?php if($profile->discharge_date=='0000-00-00') { echo "-"; } else { echo $profile->dtime.' AM.'; } ?> </span></td>
    
        <?php 
        error_reporting(0);
        $string=$profile->firstname;
        $ex=explode(" ",$string);
       
          $lenght= count($ex);
        
          $parent_name= $ex[1]." ".$ex[2]. " ".$ex[3];
       
        ?>
        <td style="line-height: 1.0;">Father's / Husband's Name:-   <span style="font-weight: bold;"><?php echo $parent_name;?> </span></td>
        
      
      </tr>
      
      
       
       <tr>
        <td colspan="2" style="line-height: 1.0;">Phone No:- <span style="font-weight: bold;"> <?php echo '';//$profile->phone?></span></td>
          <td style="line-height: 1.0;">Provisional Diagnosis:-  <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></span></td>
      </tr>
      -->
       
      
    </tbody>
    </table>
 
                    <span></span><h1 style="border: inset;background-color: #f1f0ee;font-family: 'Khand', sans-serif;font-size: 23px;"> IPD Consent Form ( अंत:रुग्ण संमती पत्र )</h1><span></span>

                    <br>

                    </div>

                
                    <div class="col-md-12 col-lg-12 " style="padding-left: 31px;padding-right: 31px;"> 

                         <div class="container">
        
   
                        </div>
                         <p style="font-family: 'Khand', sans-serif;font-size: 15px;">मी/आम्ही ,<br>सौ/श्री/कु. <span style="font-weight: bold;border-bottom: 0px dotted #000;
    text-decoration: none; ">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></span> याचा / याची / मुलगा / मुलगी / पती / पत्नी / नातेवाईक   <span style="font-weight: bold ; border-bottom: 0px dotted #000;
    text-decoration: none;" ><?php echo   $parent_name;?></span>- मु.पो        <span style="font-weight: bold ; border-bottom: 0px dotted #000;
    text-decoration: none;" >    <?php echo (!empty($profile->address)?$profile->address:null) ?> </span> असे लिहून देतो कि, मी / आम्ही माझ्या रुग्णाचा उपचार करण्याच्या हेतूने  त्याला / तिला रुगणालयात भरती करीत आहे / आहोत. मला /आम्हाला / माझ्या रुग्णाच्या गांभीर्याची तसेच माझ्या रुग्णावर करण्यात येणाऱ्या आयुर्वेदिक, अॅलोपॅथी  उपचारांची पूर्ण माहिती, याचे फायदे आणि  तोटे, त्या उपचारांची मर्यादा या सगळ्यांची माहिती मला / आम्हाला आमच्या भाषेत डॉक्टरांनी दिली आहे. माझ्या / आमच्या रुग्णावर उपचार करत असताना आमच्या रुग्णाची कोणत्याही प्रकारची दुर्घटना किंवा त्याला / तिला हानी झाल्यास मी / आम्ही स्वतः त्यास जबाबदार राहू, तसेच याबाबत मी / आम्ही रुग्णालयाला जबाबदार धरणार नाही.
                            </p>
                        
                    
                            <br>
                            <br>
                             <br>
                            <span style="padding-left: 99px;">परिचारिका स्वाक्षरी</spa
                            n>
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
        <td style="line-height: 1.0;">Department:-   <span style="font-weight: bold;"><span style="font-weight: bold;"><?php echo (!empty($profile->name)?$profile->name:null) ?> <?php if($ICU_C){ echo " [ICU-".$profile->sex."]";}?> </span></td>
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
      
     
      
     <!-- <tr>
        <td style="line-height: 1.0;">Date of Dischage:-  <span style="font-weight: bold;"><?php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?> </span></td>
        <td style="line-height: 1.0;">Time:-   <span style="font-weight: bold;"><?php if($profile->discharge_date=='0000-00-00') { echo "-"; } else { echo $profile->dtime.' AM.'; } ?> </span></td>
    
        <?php 
        error_reporting(0);
        $string=$profile->firstname;
        $ex=explode(" ",$string);
       
          $lenght= count($ex);
        
          $parent_name= $ex[1]." ".$ex[2]. " ".$ex[3];
       
        ?>
        <td style="line-height: 1.0;">Father's / Husband's Name:-   <span style="font-weight: bold;"><?php echo $parent_name;?> </span></td>
        
      
      </tr>
      
      
       
       <tr>
        <td colspan="2" style="line-height: 1.0;">Phone No:- <span style="font-weight: bold;"> <?php echo '';//$profile->phone?></span></td>
          <td style="line-height: 1.0;">Provisional Diagnosis:-  <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></span></td>
      </tr>-->
      
       
      
    </tbody>
    </table>
 
                    <span></span><h1 style="border: inset;background-color: #f1f0ee;font-family: 'Khand', sans-serif;font-size: 23px;"> Procedure Consent Form ( शपथ पत्र )</h1><span></span>

                    <br>

                    </div>

                
                    <div class="col-md-12 col-lg-12 " style="padding-left: 31px;padding-right: 31px;"> 

                         <div class="container">
        
   
                        </div>
                        
                       
                            
                            
                            <p style="font-family: 'Khand', sans-serif;font-size: 15px;"> मी/आम्ही ,<br>
                            सौ/श्री/कु. <span style="font-weight: bold;border-bottom: 0px dotted #000;
    text-decoration: none; ">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></span> याचा / याची / मुलगा / मुलगी / पती / पत्नी / नातेवाईक   <span style="font-weight: bold ; border-bottom: 0px dotted #000;
    text-decoration: none;" ><?php echo   $parent_name;?></span>- मु.पो        <span style="font-weight: bold ; border-bottom: 0px dotted #000;
    text-decoration: none;" >    <?php echo (!empty($profile->address)?$profile->address:null) ?> </span>  . असे लिहून देतो कि, मी / आम्ही माझ्या रुग्णाचे शल्यकर्म / पंचकर्म करण्यासाठी त्याला / तिला रुगणालयात घेऊन आलो आहोत. आमच्या रुग्णावर करण्यात येणारे शल्यकर्म / पंचकर्म तसेच त्याला / तिला देण्यात येणारे संज्ञाहरण त्याचे फायदे तोटे याबद्दल मला / आम्हाला डॉक्टरांनी पूर्णपणे माहिती दिली आहे. तरी, कोणत्याही प्रकारची दुर्घटना, हानी झाल्यास मी किंवा माझा परिवार वैद्यांवर / रुग्णालयावर दावा करणार नाही. यासाठी सर्वस्वी मी / आम्ही जबाबदार आहे /आहोत.
                        </p>
                        
                        <span>1)	डॉक्टर <span>    <span style="font-weight: 900;border-bottom: 1px dotted #000;
    text-decoration: none;"><?php echo $doctor_name->firstname;?></span>
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
<!--// patient marathi info-->


<!--// patient marathi info-->





                
         <!-- Laboratory start -->     
              <div class="row" style="page-break-after: always;border: groove;">



                    <div class="col-sm-12" align="center">  
                
 
 
                    <span></span><h1 style="border: inset;background-color: #f1f0ee;font-size: 23px;">LABORATORY INVESTIGATION SLIP</h1><span></span>

                   

                    </div>

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
  
  
  
  
  
 
  <table class="table" style="page-break-after: always;">
   
    <tbody>
        <tr style="border: 2px solid #574646;">
        <th>INVESTIGATION</th>
        <th>RESULTS </th>
        <th>NORMAL VALUE</th>
       <th>INVESTIGATION</th>
        <th>RESULTS </th>
        <th>NORMAL VALUE</th>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;">Hb</td> 
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Hb.' %'; ?></td>
        <td style="border: 2px solid #574646;">11.5em-14.5%</td> 
        
        <td style="border: 2px solid #574646;">B.Sugar</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->B_Sugar.' mg%'; ?></td>
        <td style="border: 2px solid #574646;"> F 70-110 mg%</td>
      </tr>
      
      
      <tr>
          <td style="border: 2px solid #574646;"> TLC </td>
            <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->TLC.' Cumm';?></td>
            <td style="border: 2px solid #574646;">4000-11000/Cumm</td>
            <td style="border: 2px solid #574646;"> Blood Sugar</td>
            <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Blood_Sugar.' mg%'; ?></td>
            <td style="border: 2px solid #574646;">P.P/R 110-150 mg%</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;"> DLC Neutro</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->DLC_Neutro.' %';?></td>
        <td style="border: 2px solid #574646;">50-70% </td>
        <td style="border: 2px solid #574646;">Blood Urea</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Blood_Urea.' mg%'; ?></td>
        <td style="border: 2px solid #574646;">20-40 mg%</td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;">Lymphocytes</td>
         <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Lymphocytes.' %';?></td>
        <td style="border: 2px solid #574646;">20-40% </td>
        <td style="border: 2px solid #574646;"> S.Creatinine</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->S_Creatinine.' mg%'; ?></td>
        <td style="border: 2px solid #574646;">0.7-1.4 mg%</td>
      </tr>
      
      <tr> 
       <td style="border: 2px solid #574646;">Monocytes</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Monocytes.' %';?></td>
        <td style="border: 2px solid #574646;">1-4% </td>
        <td style="border: 2px solid #574646;">S.Uric Acid</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->S_Uric_Acid.' mg%'; ?></td>
        <td style="border: 2px solid #574646;">2-6 mg%</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">Eosinophils</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Eosinophils.' %';?></td>
        <td style="border: 2px solid #574646;">0.4% </td>
        <td style="border: 2px solid #574646;">S.Na</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->SNat.' meq/L'; ?></td>
        <td style="border: 2px solid #574646;">135-155 meq/L</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">ESR (Westergren)</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->ESR.' mm/hr';?></td>
        <td style="border: 2px solid #574646;"> 10-20 mm/hr</td>
        <td style="border: 2px solid #574646;"> S.K.+</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->SK.' meq/|'; ?></td>
        <td style="border: 2px solid #574646;">3.5-5.5 meq/|</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo '';?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">S.CL.</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Scl.' meq/|'; ?></td>
        <td style="border: 2px solid #574646;">95 - 105 meq/|</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">Platelet Count</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Platelet_Count.' Lakh/Cumm';?></td>
        <td style="border: 2px solid #574646;">1.5-4.5 Lakh/Cumm </td>
        <td style="border: 2px solid #574646;">Total Cholestrol </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->Total_Cholestrol.' mg/dl'; ?></td>
        <td style="border: 2px solid #574646;">150-200 mg/dl</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">M.P.</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if((strpos($HEMATOLOGICAL, 'M.P.') !== false) || (strpos($SEROLOGYCAL, 'M.P.') !== false) || (strpos($BIOCHEMICAL, 'M.P.') !== false) || (strpos($MICROBIOLOGICAL, 'M.P.') !== false)) { echo "Negative"; }?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">S.Tg </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->STg.' mg/dl'; ?></td>
        <td style="border: 2px solid #574646;">60-170 mg/dl</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">BT.</td>
        <td style="border: 2px solid #574646;font-weight: bold;"></td>
        <td style="border: 2px solid #574646;">1-5Mts, (3 methods)</td>
        <td style="border: 2px solid #574646;">H.DL</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->HDL.' mg/dl'; ?></td>
        <td style="border: 2px solid #574646;">30-70 mg/dl</td>
      </tr><tr>
        <td style="border: 2px solid #574646;">CT.</td>
        <td style="border: 2px solid #574646;font-weight: bold;"></td>
        <td style="border: 2px solid #574646;">1-6 Mts, (Wright Methods) </td>
        <td style="border: 2px solid #574646;">L.D.L</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->LDL.' mg/dl'; ?></td>
        <td style="border: 2px solid #574646;"> 150 mg/dl</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">Blood Group</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if($tretment->e_o){ if($profile->date_of_birth%2==0) { echo "B- ve"; } else { echo "AB+ ve";}} ?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">VLD.L </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->VLDL.' mg/dl'; ?></td>
        <td style="border: 2px solid #574646;">14-45 me/dl</td>
      </tr>
      
       <tr>
        <td style="border: 2px solid #574646;"> </td>
        <td style="border: 2px solid #574646;font-weight: bold;"></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">S.Billirubin T</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->BillirubinT + $profile->BillirubinI.' mg%'; ?></td>
        <td style="border: 2px solid #574646;">0.1-2.2 mg%</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">Hbs Ag </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if((strpos($HEMATOLOGICAL, 'HBsAg ') !== false) || (strpos($SEROLOGYCAL, 'HBsAg ') !== false) || (strpos($BIOCHEMICAL, 'HBsAg ') !== false) || (strpos($MICROBIOLOGICAL, 'HBsAg ') !== false)) { echo "Negative"; }?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">S.Billirubin I</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->BillirubinT.' mg%'; ?></td>
        <td style="border: 2px solid #574646;">0.1-2.2 mg%</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">HIV I & Il  </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if((strpos($HEMATOLOGICAL, 'HIV') !== false) || (strpos($SEROLOGYCAL, 'HIV') !== false) || (strpos($BIOCHEMICAL, 'HIV') !== false) || (strpos($MICROBIOLOGICAL, 'HIV') !== false)) { echo "Negative"; }?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">S.Billirubin D</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  echo $profile->BillirubinI.'  mg%'; ?></td>
        <td style="border: 2px solid #574646;">0.3-0.8mg%</td>
      </tr>
      
        <tr>
        
       
		<td style="border: 2px solid #574646;">HCV Test</td>
        <td style="border: 2px solid #574646;"><?php if((strpos($HEMATOLOGICAL, 'HCV') !== false) || (strpos($SEROLOGYCAL, 'HCV') !== false) || (strpos($BIOCHEMICAL, 'HCV') !== false) || (strpos($MICROBIOLOGICAL, 'HCV') !== false)) { echo "Not Detected"; }?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">VDRL</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if((strpos($HEMATOLOGICAL, 'VDRL') !== false) || (strpos($SEROLOGYCAL, 'VDRL') !== false) || (strpos($BIOCHEMICAL, 'VDRL') !== false) || (strpos($MICROBIOLOGICAL, 'VDRL') !== false)) { echo "Negative"; }?></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">S.G.O.T </td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">5-40 Lu/L</td>
      </tr>
      
      <?php $tretment->POVISIONALdignosis;
      
      if((strpos($tretment->POVISIONALdignosis, 'TYPHOID') !== false)){
          
          $wResult='Positive';
          $o='1:160';
          $h='1:160';
          $ah='1:80';
          $bh='1:80';
      }  if((strpos($HEMATOLOGICAL, 'Widal') !== false) || (strpos($SEROLOGYCAL, 'Widal') !== false) || (strpos($BIOCHEMICAL, 'Widal') !== false) || (strpos($MICROBIOLOGICAL, 'Widal') !== false)) { 
        
          $wResult='Negative';
          $o='1:40';
          $h='1:80';
          $ah='1:120';
          $bh='1:120';
          
      } else {
          $wResult ='';
          $o='';
          $h='';
          $ah='';
          $bh='';
      }
        
      ?>
      <tr>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;"><b>Widal Test</b></td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;font-weight: bold;"><?php echo $wResult;?></td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;"></td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;">S.G.P.T</td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;"></td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;">7-56 Lu/L</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">S. Typhi "O"</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php echo $o;?></td>
        <td style="border: 2px solid #574646;"> 1:40</td>
         <td style="border: 2px solid #574646;">Alb</td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">4,2-5.5 gm%</td>
      </tr>
       <tr>
        <td style="border: 2px solid #574646;">S. Typhi "H"</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php echo $h;?></td>
        <td style="border: 2px solid #574646;">1:80</td>
        <td style="border: 2px solid #574646;">Globulin </td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">1.8-2.5 gm%</td>
       
      </tr>
      <tr>
        <td style="border: 2px solid #574646;">S.Para Typhi "AH"</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php echo $ah ;?></td>
        <td style="border: 2px solid #574646;"> 1:160</td>
        <td style="border: 2px solid #574646;">Alk. Phosphatase</td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">37-147 U/L</td>
      </tr>
      
     
      <tr> 
        <td style="border: 2px solid #574646;">S. Para Typhi "BH"</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php echo $bh;?></td>
        <td style="border: 2px solid #574646;">1:320</td>
         <td style="border: 2px solid #574646;"> S.Calcium </td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">8,5-10.5mg%</td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;">Sputum for AFB </td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;"></td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;"></td>
       <td style="border: 2px solid #574646;border-top: 4px solid #574646;">S.Amyalse</td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;"></td>
        <td style="border: 2px solid #574646;border-top: 4px solid #574646;">35-140 IU/L</td>
      </tr>
      
      <tr>
          <td style="border: 2px solid #574646;">R.A. Factor</td> 
        <td style="border: 2px solid #574646;font-weight: bold;"><?php  if(strpos($tretment->sr, '850') !== false) { echo 'Positive';}  else if((strpos($HEMATOLOGICAL, 'RA Test') !== false) || (strpos($SEROLOGYCAL, 'RA Test') !== false) || (strpos($BIOCHEMICAL, 'RA Test') !== false) || (strpos($MICROBIOLOGICAL, 'RA Test') !== false)) { echo "Negative"; }?></td>
        <td style="border: 2px solid #574646;"></td>
        
       
		<td style="border: 2px solid #574646;">MT Test</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if((strpos($HEMATOLOGICAL, 'MT') !== false) || (strpos($SEROLOGYCAL, 'MT') !== false) || (strpos($BIOCHEMICAL, 'MT') !== false) || (strpos($MICROBIOLOGICAL, 'MT') !== false)) { echo "Negative"; }?></td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;"></td>
       	<td style="border: 2px solid #574646;">Dengue NS1</td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if(strpos($tretment->POVISIONALdignosis, 'DENGUE FEVER') !== false) { echo 'Positive';}  elseif((strpos($HEMATOLOGICAL, 'Dengue NS1') !== false) || (strpos($SEROLOGYCAL, 'Dengue NS1') !== false) || (strpos($BIOCHEMICAL, 'Dengue NS1') !== false) || (strpos($MICROBIOLOGICAL, 'Dengue NS1') !== false)) { echo "Negative"; } else { }?></td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
       <tr>
        <td style="border: 2px solid #574646;">COVID -19 Rapid Antigen Test </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if($Only_2nd_Day_Morning_covid) { echo "Negative" ;}?></td>
        <td style="border: 2px solid #574646;"></td>
       	<td style="border: 2px solid #574646;">RTPCR ( SARS -CoV-2)RNA </td>
        <td style="border: 2px solid #574646;font-weight: bold;"><?php if($Only_2nd_Day_Morning_covid) { echo "Negative" ;}?></td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      
     
     
      
      
       
      
    </tbody>
  </table>
  
 
         
  <table class="table" style="%;border: 2px solid #574646;">
   
    <tbody>
      <tr style="border: 2px solid #574646;">
        <td colspan="2" style="font-weight: bold;text-align: center;">URINE EXAMINATION REPORT</td>
        
      </tr>
      
      <tr>
        <td>PHYSICAL EXAMINATION</td>
        <td>MICROSCOPIC EXAMINATION</td>
        
      </tr>
      
      <tr>
        <td>Albumin:- <span style="font-weight: bold;">Nil</span></td>
        <td>Pus Cell:- <span style="font-weight: bold;"><?php if($profile->date_of_birth%2==0) { echo '2 to 4 / hpf'; } else { echo '3 to 7 / hpf';}?></span></td>
       
      </tr>
      
      <tr>
        <td >Sugar:- <span style="font-weight: bold;">Nil</span></td>
        <td>RBC:-<span style="font-weight: bold;"> Occasinally Present</span></td>
      </tr>
      
      <tr>
        <td >Bile Salt:-<span style="font-weight: bold;"> Nil</span></td>
        <td>Epithelial Cells:- <span style="font-weight: bold;"><?php if($profile->date_of_birth%2==0) { echo 'Scanty'; } else { echo 'Few';}?></span></td>
      </tr>
      
      <tr>
        <td>Bile Pigments:-<span style="font-weight: bold;"> Nil</span></td>
        <td>Crrystalls:- <span style="font-weight: bold;">Absent</span></td>
      </tr>
      
       <tr>
        <td >Ketone Bodies:-<span style="font-weight: bold;"> Nil</span></td>
         <td >Casts:- <span style="font-weight: bold;">Absent</span></td>
      </tr>
      <tr>
        <td>PREG. TEST:- </td>
        <td>Other:- </td>
      </tr>
      
        <tr style="border: 2px solid #574646;">
        <td colspan="2" style="font-weight: bold;text-align: center;">STOOL EXAMINATION REPORT</td>
        </tr>
        <tr>
        <td>PHYSICAL EXAMINATION</td>
        <td>MICROSCOPIC EXAMINATION</td>
        
      </tr>
      
      <tr>
        <td>Color:-  <span style="font-weight: bold;"><?php  echo $profile->Color; ?> </span></td>
        <td>Pus Cell:- <span style="font-weight: bold;"> <?php if($profile->date_of_birth%2==0) { echo '2 to 4 / hpf'; } else { echo '3 to 7 / hpf';}?></span></td>
      </tr>
      
       <tr>
        <td >Comsistency:- <span style="font-weight: bold;"><?php  echo $profile->Comsistency; ?> </span></td>
         <td >RBC:- <span style="font-weight: bold;">Occasinally Present</span></td>
      </tr>
      <tr>
        <td>MUCOUS:- <span style="font-weight: bold;"><?php  echo $profile->MUCOUS; ?></span></td>
        <td>Epithelial Cells: -<span style="font-weight: bold;">  <?php if($profile->date_of_birth%2==0) { echo 'Scanty'; } else { echo 'Few';}?> </span></td>
      </tr>
      
    </tbody>
  </table>
  
   
   
   <table class="table" style="%;border: 2px solid #574646;page-break-after: always">
   
    <tbody>
        <tr style="border: 2px solid #574646;">
        <td colspan="3" style="font-weight: bold;text-align: center;">SEMEN EXAMINATION REPORT</td>
        </tr>
        <tr>
        <td>PHYSICAL EXAMINATION</td>
        <td>CHEMICAL EXAMINATION</td>
        <td>MICROSCOPIC EXAMINATION</td>
        
      </tr>
      
      <tr>
        <td>Volume:-</td>
        <td>Active Sperms(%):-</td>
        <td>Morphology:-</td>
      </tr>
      
       <tr>
        <td>Colour:- </td>
         <td> Sluggish Sperms(%):- </td>
        <td></td>
      </tr>
      
      <tr>
       <td>Reaction:- </td>
       <td>Dead Sperms(%):- </td>
        <td> </td>
        
      </tr>
      
      <tr>
        <td>Liquefaction Time:-</td>
        <td> Puss Cells(%):- </td>
        <td></td>
      </tr>
      
      <tr>
        <td>Total Sperm Count:-</td>
        <td>R.B.C'S (%):- </td>
        <td> </td>
      </tr>
      
       </tbody>
  </table>
 <table class="table" style="%;border: 2px solid #574646;">
   
    <tbody>
       <tr style="border: 2px solid #574646;">
        <td colspan="3" style="font-weight: bold;text-align: center;">CULTURE & SENCITIVITY</td>
        </tr>
        <tr>
        <td style="border: 2px solid #574646;">SPECIMEN</td>
        <td style="border: 2px solid #574646;">AMIKACIN</td>
        <td style="border: 2px solid #574646;"></td>
        
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">AMOXYCILLIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
       <tr>
        <td style="border: 2px solid #574646;">CULUTURE GROWTH REPORT</td>
         <td style="border: 2px solid #574646;"> AZITHROMYCIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
       <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">CEFACLORC</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
     <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">EFADROXIL</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">CEFOTAXIME</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">CHLORAMPHIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">CIPROFLOX</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">CLOXACILLIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">DOXYCYCLINE</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">ERYTHROMYCIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">FRAMYCETINE</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;">S-SENSTIVE</td>
        <td style="border: 2px solid #574646;">GENTAMYCIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      
      <tr>
        <td style="border: 2px solid #574646;">MS- MODERATELY SENSITIVE</td>
        <td style="border: 2px solid #574646;"> LOMEFLOX</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;">R- RESISTANT</td>
        <td style="border: 2px solid #574646;">NALIDIXIC ACID</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">NETILMICIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">NORFLOXACIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
      <tr>
        <td style="border: 2px solid #574646;"></td>
        <td style="border: 2px solid #574646;">TOBRAMYCIN</td>
        <td style="border: 2px solid #574646;"></td>
      </tr>
      
        <tr style="border: 2px solid #574646;height: 53px;">
        <td colspan="3" style="font-weight: bold;">Remarks :-</td>
        </tr>
        
        <tr style="height: 60px;">
        <td></td>
        <td></td>
        <td style="padding-top: 18px;text-align: center;">(Auth.Signatory)</td>
      </tr>
    </tbody>
  </table>
  
  
  
</div>

 </div>
</div>
  <!-- Laboratory start  end-->                
                
   
<div class="col-sm-12" align="center">    
<strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
<p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
</div>
<table class="table" style="page-break-after: always;border: groove;">
   
    <tbody>
      <tr>
        <td colspan="2">रुग्ण नाम :  <span style="font-weight: bold;">   <?php echo (!empty($profile->firstname)?$profile->firstname:null) ?> </span></td>
       
      </tr>
      
      <tr>
        <td>1.	वेदना विशेष व काल </td>
        <td>:<span style="font-weight: bold;"> <?php echo  $symptoms;  ?></span></td>
        
      </tr>
      
      <tr>
        <td>(Chief Complains with duration )</td>
        <td></td>
        
      </tr>
      
     <tr>
        <td> 2.इतिहास (History)</td>
        <td>:<span style="font-weight: bold;"> <?php   if($tretment->h_o) { echo $tretment->h_o;} else { echo $h_o;}  ?></span></td></td>
      </tr>
      
      <tr>
        <td>  ii)पूर्व इतिहास / शस्त्रकर्म इतिहास </td>
        <td>:</td>
      </tr>
      
      <tr>
        <td>( History of Pastillness / Surgical History)</td>
        <td></td>
      </tr>
      
      <tr>
        <td> iii)कौटुंबिक इतिहास</td>
        <td>:  <span style="font-weight: bold;"> <?php echo  $f_h=$opd_data->f_h;  ?></span></td>
      </tr>
      
      <tr>
        <td>Family History</td>
        <td> </td>
      </tr>
      
       <tr>
        <td> iv)रज प्रवृत्ती इतिहास</td>
        <td>: <span style="font-weight: bold;">      <?php  $t = $profile->date_of_birth; if($profile->sex=='F') {  if (($t <= "48")   && ($t >="15")) { echo $profile->raj; } }  else { echo "-";}?></span></td>
      </tr>
      
      <tr>
        <td> व्यक्तिगत इतिहास </td>
        <td>:  व्यवसाय -    <span style="font-weight: bold;"><?php echo $occupation; ?></span></td>
      </tr>
      
      <tr>
        <td>  </td>
        <td>: सामाजिक आर्थिक स्थिती  -<span style="font-weight: bold;"> <?php  echo $profile->samajik; ?>     </span> </td>
      </tr>
      
       <tr>
        <td>  </td>
        <td>: आहार    -<span style="font-weight: bold;">     <?php  echo $profile->aharfood; ?> </span></td>
      </tr>
      
       <tr>
        <td>  </td>
        <td>:  आहार घटक मात्रा   -<span style="font-weight: bold;">  <?php  echo $profile->aharghatak; ?>    </span></td>
      </tr>
      
       <tr>
        <td style="float: right;"> निद्रा  </td>
        <td>:<span style="font-weight: bold;">  <?php  echo $profile->nidtra; ?> </span></td>
      </tr>
      
       <tr>
        <td style="float: right;">  व्यसन </td>
        <td>: -<span style="font-weight: bold;">   <?php  echo $profile->vyasan; ?> </span> </td>
      </tr>
       <tr>
        <td style="float: right;">   मुत्र प्रवृत्ती</td>
        <?php
        $str =  $profile->mutrapra;
        $a=explode("-",$str);
        ?> 
        <td>:  संख्या-<span style="font-weight: bold;"> <?php  echo $a[0]; ?>  </span>   वर्ण -<span style="font-weight: bold;"> <?php  echo     $a[1]; ?>   </span></td>
      </tr>
       <tr>
        <td style="float: right;"> (Urine ) संबंधित लक्षण </td>
        <td>: -<span style="font-weight: bold;">  <?php if($profile->urine=='NILL'){ echo 'NIL';}  else { echo $profile->urine;}?> </span></td>
      </tr>
       <tr>
        <td style="float: right;">  पुरीष प्रवृत्ती </td>
        <?php
          $str =  $profile->purushpra;
        $a1=explode("-",$str);
      
        ?> 
        <td>:  संख्या  -<span style="font-weight: bold;"> <?php  echo $a1[0]; ?>   </span>   वर्ण   -<span style="font-weight: bold;"><?php echo $a1[1]; ?>   </span></td>

      </tr>
       <tr>
        <td style="float: right;"> (Stool)   संबंधित लक्षण  </td>
        <td>:<span style="font-weight: bold;">   <?php  echo ''; ?> </span></td>
      </tr>
       <tr>
        <td style="float: right;">      अपानवायू</td>
        <td>: -<span style="font-weight: bold;">    <?php  echo $profile->apanwayu; ?></span> </td>
      </tr>
       <tr>
        <td style="float: right;"> कोष्ठ</td>
        <td>: -<span style="font-weight: bold;">   <?php  echo $profile->koshth; ?></span>  </td>
      </tr>
      
      <tr>
        <td> 3.	सामान्य आतुर परीक्षा </td>
        <td>प्रकृती: -<span style="font-weight: bold;">   <?php  echo $profile->samanyaatur; ?> </span>  </td>
      </tr>
      
      
      <tr>
        <td> </td>
        <td>:  तापमान -<span style="font-weight: bold;">   <?php  if(!empty($tretment->temp)) { $rand=104;echo 'Temp :'.$rand.'ºF<br>';} else{ echo $profile->tap.' °F';} ?> </span><br>: रक्तदाब - <span style="font-weight: bold;"> <?php if(!empty($tretment->bp)) {   echo "220/120 mm of Hg"; }  else { echo $bp; }?> mm of Hg</span  </td>
      </tr>
      
      <tr>
        <td> </td>
        <td>:  नाडी   - <span style="font-weight: bold;"> <?php echo $pulse;?> /min</span> &nbsp;&nbsp;&nbsp; &nbsp; वजन  :   <span style="font-weight: bold;"><?php echo $wieght; ?> Kg.</span></td>
      </tr>
      
      <tr>
        <td> </td>
        <td>:  शरीरप्रमाण  -<span style="font-weight: bold;"> <?php  echo $profile->sharir; ?>  </span></td>
      </tr>
      
       <tr>
        <td> </td>
        <td>:  आहारशक्ती    -<span style="font-weight: bold;">   <?php  echo $profile->aharshakti; ?> </span> </td>
      </tr>
       <tr>
        <td> </td>
        <td>:  व्यायाम शक्ती  -<span style="font-weight: bold;"> <?php  echo $profile->vyamshakti; ?>   </span></td>
      </tr>
      
      <tr>
        <td style="padding-left: 23px;">अष्टविध परीक्षा </td>
        <td>:   नाडी - <span style="font-weight: bold;"> <?php echo $nadi;?></span> &nbsp;&nbsp;&nbsp; &nbsp;   </td>
      </tr>
      <tr>
        <td> </td>
        <td>:  मुत्र  - <span style="font-weight: bold;"> <?php echo $mutra;?></span> &nbsp;&nbsp;&nbsp; &nbsp;  </td>
      </tr>
      
      
      <tr>
        <td> </td>
        <td>:   मल  - <span style="font-weight: bold;"> <?php echo $mal;?></span>&nbsp;&nbsp;&nbsp; &nbsp;  </td>
      </tr>
      
      
      <tr>
        <td> </td>
        <td>:  जिद्द्वा  - <span style="font-weight: bold;"> <?php echo $givwa;?></span>&nbsp;&nbsp;&nbsp; &nbsp;   </td>
      </tr>
      
      <tr>
        <td> 4.	संप्राप्ती घटक</td>
        <td>: -<span style="font-weight: bold;">   <?php  echo $tretment->SROTAS.','.$tretment->DOSHA.','.$tretment->DUSHYA; ?></span></td>
      </tr>
      
      <tr>
        <td style="padding-left: 23px;"> वर्तमान वेदना इतिहास</td>
        <td>:  <span style="font-weight: bold;"> <?php echo  $tretment->sym_name;  ?></span> </td>
      </tr>
      
      
      <tr>
        <td>   </td>
        <td>:    </td>
      </tr>
      
      <tr>
        <td>   </td>
        <td>:   </td>
      </tr>
      
       <tr>
        <td>५. विशेष स्त्रोतस परीक्षा</td>
        <td>:<span style="font-weight: bold;"> <?php echo $tretment->SROTAS; ?></span></td>
      </tr>
       <tr>
        <td>  ६. नैदानिक परीक्षा </td>
        <td>: <?php //echo 'CBR,ESR,LFT,RFT, Lipid Profile,';  ?>
        <?php if((strpos($HEMATOLOGICAL, 'CBC') !== false) || (strpos($SEROLOGYCAL, 'CBC') !== false) || (strpos($BIOCHEMICAL, 'CBC') !== false) || (strpos($MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'ESR') !== false) || (strpos($SEROLOGYCAL, 'ESR') !== false) || (strpos($BIOCHEMICAL, 'ESR') !== false) || (strpos($MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'LFT') !== false) || (strpos($SEROLOGYCAL, 'LFT') !== false) || (strpos($BIOCHEMICAL, 'LFT') !== false) || (strpos($MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'RFT') !== false) || (strpos($SEROLOGYCAL, 'RFT') !== false) || (strpos($BIOCHEMICAL, 'RFT') !== false) || (strpos($MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
      
        <?php echo $HEMATOLOGICAL.",".$SEROLOGYCAL.",".$BIOCHEMICAL.",".$MICROBIOLOGICAL.",".$X_RAY.",".$ECG.",".$USG;     ?> 
        <?php if($Sp_Investigations_pandamic){  echo "<br>=>".$ex_spe_invet[0];echo "<br>"; echo ""; if($ex_spe_invet[1]) { echo "=>".$ex_spe_invet[1].'<br>'; } }?>
        
         </td>
        
        
      </tr>
       <tr>
        <td> ७. व्यवछेदक निदान </td>
        <td>:<span style="font-weight: bold;"><?php echo  $tretment->POVISIONALdignosis;  ?></span></td>
      </tr>
       <tr>
        <td> 8. व्याधी विनीश्चय    </td>
        <td>: <span style="font-weight: bold;"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></span></td>
      </tr>
      
       <tr>
        <td> दिनांक  : <span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?> </span></td>
        <td style="padding-left: 215px;">हस्ताक्षर : </td>
      </tr>
      
    </tbody>
  </table>

                       </div>
                       
                       
                       
                        <!--  Diet Register -->     
<div class="row" style="page-break-after: always;padding-left: 50px;padding-right: 50px;">
 
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
      <td>D.O.A.:-<span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>
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
<!--// end diet register-->
                       
                       
                       
                       <div class="row" style="page-break-after: always;padding-left: 50px;padding-right: 50px;">



                    <div class="col-sm-12" align="center">  
                  
         <strong style="font-family: -webkit-body;font-size: 17px;"><?php echo $this->session->userdata('title') ?></strong>
         <p class="text-center" style="font-family: -webkit-body;font-size: 13px;"><?php echo $this->session->userdata('address') ?></p>
 
                    <span></span><h1 style="border: inset;background-color: #f1f0ee;font-size: 19px;padding-top: 7px;font-family: 'Khand', sans-serif;">दैनंदिन चिकित्सा पत्रक</h1><span></span>

                   

                    </div>

                
                    <div class="col-md-12 col-lg-12 "> 

                         <div class="container" style="width: 100%;padding-right: 0px;padding-left: 0px;">
        
        <?php
        
         
			                      
			                      $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      $RX4= $tretment->RX4;
			                      $RX5= $tretment->RX5;
			                      
			                      
			                      
			                      $DRX1= $tretment->DRX1;
			                      $DRX2= $tretment->DRX2;
			                      $DRX3= $tretment->DRX3;
			                      
			                      $SNEHAN= $tretment->SNEHAN;
			                      $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                      $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      
			                      $SWA1= $tretment->SWA1;
			                      $SWA2= $tretment->SWA2;
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;
			                      $USG= $tretment->USG;
			                      
			                      $symptoms= $tretment->sym_name;
			                      
			                      $Pr_Op_Medication= $tretment->Pr_Op_Medication;
			                      $Pr_Op_Medication2nd= $tretment->Pr_Op_Medication2nd;
                                  $Only_1st_Dose= $tretment->Only_1st_Dose;
                                  
                                  $SPO2= $tretment->SPO2;
                                  $Input= $tretment->Input;
                                  $Output= $tretment->Output;
                                  $covid_date=date('Y-m-d',strtotime($profile->create_date));
                                  if(($covid_date >='2020-03-22') && ($covid_date <='2021-07-30')){
                                    $Only_2nd_Day_Morning_covid=$tretment->Only_2nd_Day_Morning_covid;
                                    $Sp_Investigations_pandamic=$tretment->Sp_Investigations_pandamic;
                                  }else{
                                  $Only_2nd_Day_Morning_covid='';
                                  $Sp_Investigations_pandamic='';
                                  }
        
                                  $cvs ='S1S2 N';
              $ruduce =array(10,25,50,75);
              $ruduce1=array_rand($ruduce);
	          $ruduce[$ruduce1];                    
                                  
              $pa_tre =array(40,45,50,55,60);
              $pa_tre1=array_rand($pa_tre);
	          $pa_tre[$pa_tre1];
             
              
              $pr =array(12,3,6,9);
              $pr1=array_rand($pr);
	          $pr[$pr1];
              
              $bp1=array_rand($bp);
	          $bp[$bp1];
	          
	          $nadi1=array_rand($nadi);
	          $nadi[$nadi1];
	          
	          $Pulse1=array_rand($Pulse);
	          $Pulse[$Pulse1];
	          
	          $netra1=array_rand($netra);
	          $netra[$netra1];
	          
	           $givwa1=array_rand($givwa);
	           $givwa[$givwa1];
	           
	           
	           $sudha1=array_rand($sudha);
	           $sudha[$sudha1];
	           
	           $ahar1=array_rand($ahar);
	           $ahar[$ahar1];
	           
	           $mal1=array_rand($mal);
	           $mal[$mal1];
	           
	           $mutra1=array_rand($mutra);
	           $mutra[$mutra1];
	           
	           $nidra1=array_rand($nidra);
	           $nidra[$nidra1];
        ?>
        
        
        
        
  <table class="table" style="border: 2px solid #574646;">
   
    <tbody>
      <tr>
        <td style="border: 2px solid #574646;width: 112px;">दिनांक / वेळ:-</td>
        <td style="border: 2px solid #574646;width: 349px;">लक्षणे</td>
        <td style="border: 2px solid #574646;">चिकित्सा</td>
      </tr>
      
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
   
   
   $admit_date=date('Y-m-d',strtotime($profile->create_date));
   if($profile->discharge_date=='0000-00-00'){
       $discharge_date=date('Y-m-d', strtotime($admit_date. ' + 5 days'));
   } else{
   $discharge_date=date('Y-m-d',strtotime($profile->discharge_date));
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
			                      
			                     
                                 } else{
                                   $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      $RX4= $tretment->RX4;
			                      $RX5= $tretment->RX5;  
                                     
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
                                 } else{
                                     $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      $RX4= $tretment->RX4;
			                      $RX5= $tretment->RX5;  
                                     
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
          <?php $str1 = $profile->atime;
                $time=explode(":",$str1);
          ?>
        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;"><?php echo date('d-m-Y',strtotime($date[$i])); 
        echo "<br>";
        
        if($i%2==0){ echo $profile->atime.' AM.'; } else{
            echo ($time[0]).':'.($time[1] + 5)."   AM";} 
        ?></td>
        
        <td style="border-right: 2px solid #574646;border-top: 1px solid #574646;"> <b><?php if(($tretment->kco)  && ($i==0)){ ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';?> <?php }?>
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
                                      
                                       <b> O/E-</b><br>
                                    
                                     <?php if($tretment_manual->tapman) { echo 'Temp :'.$tretment_manual->tapman.'ºF<br>';}  else { if(!empty($tretment->temp)) { $rand=104; $rand=$rand - $i; echo 'Temp :'.$rand.'ºF<br>'; if($i%2==0){  $rand=$rand - $i;}}} ?>
                                    
                                     <?php if($SPO2){ $ex_spo2=explode(",",$profile->SPO2);  echo 'SPO2: '.$ex_spo2[$i].'%';}?> <br>
                                      <?php $str = $bp;
                                     $ex=explode("/",$str);
                                     ?>
                                     
                                      BP : <?php if($tretment_manual->bp) { echo $tretment_manual->bp."   mm of Hg";}  else { if((!empty($tretment->bp)) && ($i==0)) {   echo "210/120 mm of Hg"; }  else if($bp) { if($ex[0]%2==0){ echo ($ex[0] + 4).'/'.($ex[1] + 4)."   mm of Hg";} else{ echo $bp,"   mm of Hg";}} else { echo $bp[$bp1],"   mm of Hg";} }?><br>
                                      
                                     
                                      Pulse : <?php if($tretment_manual->pulse) { echo $tretment_manual->pulse.'/min';}  else { if($pulse) { if($i%2==0) { echo $pulse." /min";} else { echo ($pulse + 2)." /min";} } else { echo 	          $Pulse[$Pulse1]." /min";}} ?><br>
                                      
                                      
                                      नाडी : <?php if($tretment_manual->nadi) { echo $tretment_manual->nadi;}  else { if($nadi){ echo $nadi;}else { echo $nadi[$nadi1]; } }?><br>
                                      
                                      
                                      उर (RS): <?php if($tretment_manual->rs) { echo $tretment_manual->rs;}  else { if($tretment->rs) { echo $tretment->rs; }else { echo $ur; }}?><br>  
                                      
                                      CVS : <?php  if($tretment_manual->cvs) { echo $tretment_manual->cvs;}  else { echo $cvs;}?><br>
                                      उदर (PA): <?php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>
                                      
                                     
                                     <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                     <?php if(!empty($tretment->pv)) { echo  'PV: '.$tretment->pv.'<br>'; } ?>
                                     
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
            
               <?php 
               $tre_icu = $ICU_Order;
                $ex_icu=explode(",",$tre_icu);
               
               if(($ICU_Order) && (($i==0) || ($DISTRIBUTION_IPD < $i)))  {?><b></b> <?php if($ex_icu[0]) { echo "=>".$ex_icu[0].'<br>'; }  if($ex_icu[1]) { echo "=>".$ex_icu[1].'<br>'; } if($ex_icu[2]) { echo "=>".$ex_icu[2].'<br>'; } if($ex_icu[3]) { echo "=>".$ex_icu[3].'<br>'; }   if($ex_icu[4]) { echo "=>".$ex_icu[4].'<br>'; } if($ex_icu[5]) { echo "=>".$ex_icu[5].'<br>'; } if($ex_icu[6]) { echo "=>".$ex_icu[6].'<br>'; }}?>
                <?php 
                $tre_1STDOSE = $Only_1st_Dose;
                                     $ex_1STDOSE=explode(",",$tre_1STDOSE);
                if(!empty($Post_Operative)) {  echo "=> ".$ex_1STDOSE[0];echo "<br>"; if($ex_1STDOSE[1]) { echo "=>".$ex_1STDOSE[1].'<br>'; } if($ex_1STDOSE[2]) { echo "=>".$ex_1STDOSE[2].'<br>'; }} else if(($Only_1st_Dose) && ($i==0)) {?><b> =></b> <?php echo "".$ex_1STDOSE[0];echo "<br>"; if($ex_1STDOSE[1]) { echo "=>".$ex_1STDOSE[1].'<br>'; } if($ex_1STDOSE[2]) { echo "=>".$ex_1STDOSE[2].'<br>'; }} else {}?>
                 <?php if((($VAMAN)  || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || ($tretment->skarma))  && ($i==1))  {?><b>   <?php echo " ".$tretment->skarma;echo "</b><br>";}?>
                  <?php  if(($Pr_Op_Medication2nd) && ($i==1)) {?><b>  <?php echo "=>".$Pr_Op_Medication2nd; echo "</b><br>";}?>
             <b> RX - </b> <?php 
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
           
                                        if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                       <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                       <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                        <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                       <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x51=explode("x",$ex5[2]); echo "=>".$ex_x51[0].'<br>'; }}?>
                                        <br><br>
                                        
                                        
                                        
                                       <?php if(($SNEHAN) || ($SWEDAN) || ($VAMAN) || ($VIRECHAN) || ($BASTI) || ($NASYA) || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || ($OTHER) || ($SWA1) || ($SWA2)){?>
                                       <b> उपक्रम-</b><br>   
                                      <?php  if($SNEHAN){  echo $SNEHAN.'<br>'; }?>
                                      
                                      <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                    
                                       <?php  if(($VAMAN)  && ($i==0)) {  echo $VAMAN.'<br>';  $VAMAN_1D=$VAMAN;  }?>
                                     
                                       <?php  if($VIRECHAN){  echo $VIRECHAN.'<br>'; }?>
                                      
                                        <?php  if($BASTI){  echo $BASTI.'<br>'; }?>
                                     
                                       <?php  if($NASYA){  echo $NASYA.'<br>'; }?>
                                     
                                       <?php  if(($RAKTAMOKSHAN)  && ($i==0)) { echo $RAKTAMOKSHAN.'<br>'; }?>
                                    
                                       <?php  if(($SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo $SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                    
                                       <?php if($OTHER){  if(strpos($OTHER, '1D') !== false) { if($i==0) { echo $OTHER.'<br> '; $OTHER_1D=$OTHER; } else{ echo '';} }  else { echo $OTHER.'<br>'; } }?>
                                     
                                       <?php  if($SWA1){  echo $SWA1.'<br>'; }?>
                                 
                                       <?php  if($SWA2){  echo $SWA2.'<br>'; }?>
                                       <?php }?>
                                       
                                        <?php
                                         $tre_covid_2nd_morning = $Only_2nd_Day_Morning_covid;
                                        $ex_2d_morn=explode(",",$tre_covid_2nd_morning);
                                        
                                        if((($HEMATOLOGICAL) || ($SEROLOGYCAL) || ($BIOCHEMICAL) || ($MICROBIOLOGICAL) || ($X_RAY) || ($ECG) || ($USG)  || ($Sp_Investigations_pandamic)) && ($i==0)){?>
                                       <b> Adv- </b><br>
                                      
                                      <?php if((strpos($HEMATOLOGICAL, 'CBC') !== false) || (strpos($SEROLOGYCAL, 'CBC') !== false) || (strpos($BIOCHEMICAL, 'CBC') !== false) || (strpos($MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'ESR') !== false) || (strpos($SEROLOGYCAL, 'ESR') !== false) || (strpos($BIOCHEMICAL, 'ESR') !== false) || (strpos($MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'LFT') !== false) || (strpos($SEROLOGYCAL, 'LFT') !== false) || (strpos($BIOCHEMICAL, 'LFT') !== false) || (strpos($MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'RFT') !== false) || (strpos($SEROLOGYCAL, 'RFT') !== false) || (strpos($BIOCHEMICAL, 'RFT') !== false) || (strpos($MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
        
       
                                      
                                      
                                       <?php  if($HEMATOLOGICAL){  echo $HEMATOLOGICAL.'<br>'; }?>
                                     
                                       <?php  if($SEROLOGYCAL){  echo $SEROLOGYCAL.'<br>'; }?>
                                     
                                       <?php  if($BIOCHEMICAL){  echo $BIOCHEMICAL.'<br>'; }?>
                                     
                                       <?php  if($MICROBIOLOGICAL){  echo $MICROBIOLOGICAL.'<br>'; }?>
                                     
                                       <?php  if($X_RAY){  echo $X_RAY.'<br>'; }?>
                                      
                                       <?php  if($ECG){  echo $ECG.'<br>'; }?>
                                     
                                       <?php  if($USG){  echo $USG.'<br>'; }?>
                                       <?php 
                                       
                                       $tre_spe_invet = $Sp_Investigations_pandamic;
                                        $ex_spe_invet=explode(",",$tre_spe_invet);
                                        
                                        
                                       if($Sp_Investigations_pandamic){  echo "<br><b>=>".$ex_spe_invet[0];echo "<br>"; echo "<b>=>".$ex_2d_morn[0]; if($ex_spe_invet[1]) { echo "<br>=>".$ex_spe_invet[1].'<br>'; } }?>
                                       
                                        <?php }?>
                                        
                                       <?php 
                                       
                                       
                                       if(($Only_2nd_Day_Morning_covid) && ($i==1)) {?><b>  <?php echo "<br>"; if($ex_2d_morn[1]) { echo "=>".$ex_2d_morn[1].'<br>'; }echo "</b><br>";}?>
                                     
                                         
                                        <?php  if(($vkarma) && ($i ==7)){  if(strpos($vkarma, 'KSHAR SUTRA') !== false){ echo "=>".$vkarma.'<br>'; }}?>
                                        
                                        
        </td>
        </tr>
         <?php if(($Post_Operative) && ($i==1)) {?><tr style="page-break-after: always;"><td style="border-right: 2px solid #574646;"><?php echo date('d-m-Y',strtotime($date[$i])); echo "<br> 01:30 PM"; ?></td>
         <td style="border-right: 2px solid #574646;">
           
            <?php $str = $bp;
                                     $ex=explode("/",$str);
                                     ?>
            <b> BP : <?php if((!empty($tretment->bp)) && ($i==0)) {   echo "200/110 mm of Hg"; }  else if($bp) { if($ex[0]%2==0){ echo ($ex[0] + 2).'/'.($ex[1] + 2)."   mm of Hg";} else{ echo $bp,"   mm of Hg";}} else { echo $bp[$bp1],"   mm of Hg";} ?><br>
                                      
                                     
                                      Pulse : <?php if($pulse) { if($i%2==0) { echo $pulse." /min";} else { echo ($pulse + 4)." /min";} } else { echo 	          $Pulse[$Pulse1]." /min";} ?><br>
                                      
                                      
                                      नाडी : <?php if($nadi){ echo $nadi;}else { echo $nadi[$nadi1]; }?><br>
                                      
                                      
                                      उर (RS): <?php if($tretment->rs) { echo $tretment->rs; }else { echo $ur; }?><br>  
                                      
                                      CVS : <?php echo $cvs;?><br>
                                      उदर (PA): <?php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>
             
         </td>
        <td style="border-right: 2px solid #574646;"><?php echo "<b> Post Operative Notes- <br>";  if($Post_Operative) { echo "=>".$ex_str_p_o[0];echo "<br>"; if($ex_str_p_o[1]) { echo "=>".$ex_str_p_o[1].'<br>'; } if($ex_str_p_o[2]) { echo "=>".$ex_str_p_o[2].'<br>'; } if($ex_str_p_o[3]) { echo "=>".$ex_str_p_o[3].'<br>'; } if($ex_str_p_o[4]) { echo "=>".$ex_str_p_o[4].'<br>'; }
        
        if($ex_str_p_o[5]) { echo "=>".$ex_str_p_o[5].'<br>'; } if($ex_str_p_o[6]) { echo "=>".$ex_str_p_o[6].'<br>'; } if($ex_str_p_o[7]) { echo "=>".$ex_str_p_o[7].'<br>'; } if($ex_str_p_o[8]) { echo "=>".$ex_str_p_o[8].'<br>'; } 
        if($ex_str_p_o[9]) { echo "=>".$ex_str_p_o[9].'<br>'; } if($ex_str_p_o[10]) { echo "=>".$ex_str_p_o[10].'<br>'; } if($ex_str_p_o[11]) { echo "=>".$ex_str_p_o[11].'<br>'; } if($ex_str_p_o[12]) { echo "=>".$ex_str_p_o[12].'<br>'; } 
        if($ex_str_p_o[13]) { echo "=>".$ex_str_p_o[13].'<br>'; } if($ex_str_p_o[14]) { echo "=>".$ex_str_p_o[14].'<br>'; } if($ex_str_p_o[15]) { echo "=>".$ex_str_p_o[15].'<br>'; } if($ex_str_p_o[16]) { echo "=>".$ex_str_p_o[16].'<br>'; } 
        if($ex_str_p_o[17]) { echo "=>".$ex_str_p_o[17].'<br>'; } if($ex_str_p_o[18]) { echo "=>".$ex_str_p_o[18].'<br>'; } if($ex_str_p_o[19]) { echo "=>".$ex_str_p_o[19].'<br>'; } if($ex_str_p_o[20]) { echo "=>".$ex_str_p_o[20].'<br>'; } 
          if($ex_str_p_o[21]) { echo "=>".$ex_str_p_o[21].'<br>'; } if($ex_str_p_o[22]) { echo "=>".$ex_str_p_o[22].'<br>'; } if($ex_str_p_o[23]) { echo "=>".$ex_str_p_o[23].'<br>'; } if($ex_str_p_o[24]) { echo "=>".$ex_str_p_o[24].'<br>'; } 
        echo "</b><br>"; }?></td></tr> <?php   }?>
           
           
         
      
      
   
      <!--  -----------------------################## EVENING TIME ###########################------------------  -->
      <?php 
       $total_d= count($date) - 1;
      if($i ==$total_d){ } else{?> 
      
      <tr>
       
      
       
        <td style="border-right: 2px solid #574646;"><?php echo date('d-m-Y',strtotime($date[$i])); 
        echo "<br>";
        
        if($i%2==0){  echo "07:25 PM";} else{
            echo  "07:15 PM";} 
        ?>
        </td>
        
        
        <td style="border-right: 2px solid #574646;"> <b>
                                     <b> C/O :  </b><?php echo "No Fresh Complaint";?><br>
                                    
                                     <b> Family History : </b> <?php if(!empty($profile->f_h)) { echo $profile->f_h.'<br>';} else { echo ''.$f_h;}?>
                                   
                                      
                                       <b> O/E-</b><br>
                                    
                                     <?php if(!empty($tretment->temp)) { $rand=rand(101,104);echo 'Temp :'.$rand.'ºF<br>'; } ?>
                                     
                                     
                                     <?php $str = $bp;
                                     $ex=explode("/",$str);
                                     ?>
                                      BP : <?php if((!empty($tretment->bp)) && ($i==0)) {   echo "190/100 mm of Hg"; }  else  if($bp) { if($ex[0]%2==0){ echo $bp,"   mm of Hg"; } else{ echo ($ex[0] + 4).'/'.($ex[1] + 4)."   mm of Hg"; }} else { echo $bp[$bp1],"   mm of Hg";}?><br>
                                      
                                      Pulse : <?php if($pulse) { { if($i%2==0) { echo ($pulse +2)." /min";} else { echo ($pulse)." /min";} }} else { echo 	          $Pulse[$Pulse1]." /min";} ?><br>
                                      
                                      नाडी : <?php if($nadi){ echo $nadi;}else { echo $nadi[$nadi1]; }?><br>
                                      उर (RS): <?php if($tretment->rs) { echo $tretment->rs; }else {  echo $ur; }?><br>  
                                      CVS : <?php echo $cvs;?><br>
                                       उदर (PA): <?php if($tretment->pa) { if($profile->date_of_birth%2==0) { $PArand='56';}  else { $PArand='58'; }  $PArand=$PArand - $i -1; echo  'Abdominal girth:'.' '.$PArand.' inches,Rajidarshan';} else { echo $udar;}?><br>
                                     
                                     
                                     <?php if(!empty($tretment->pr)) { echo 'PR: '.$tretment->pr.' '.$pr[$pr1]." o'clock position<br>"; } ?>
                                     <?php if(!empty($tretment->pv)) { echo 'PV: '.$tretment->pv.'<br>'; } ?>
                                     
                                     
                                     </td>
                                    
        <td style="border-right: 2px solid #574646;">
             <?php if(($Pr_Op_Medication) && ($i==0)) {?><b> - </b> <?php echo " ".$Pr_Op_Medication;echo "<br>";}?>
             <b> RX - </b>  <br> <?php  echo "C.T.ALL";?> <br><br>
                                        
                                        
                                        
                                       <?php if(($SNEHAN) || ($SWEDAN) || ($VAMAN) || ($VIRECHAN) || ($BASTI) || ($NASYA) || ($RAKTAMOKSHAN) || ($SHIRODHARA_SHIROBASTI) || ($OTHER) || ($SWA1) || ($SWA2)){?>
                                       <b> उपक्रम-</b><br>   
                                      <?php  echo "C.T.ALL";?>
                                      
                                     
                                        
                                        <?php   }?>
        </td>
        
        
      </tr>
      
     <?php }     }?>
      
      
        <tr>
        <td style="border-right: 2px solid #574646;"></td>
        <td style="border-right: 2px solid #574646;"></td>
        <td style="border-right: 2px solid #574646;"><b> Patient is discharged <br> Follow up after 7 days in OPD.  </b></bt></td>
      </tr>
      
      
      
      
    </tbody>
  </table>
</div>

</div>
</div>    



 <!--  Post operative notes-->   
<?php if($Post_Operative) { ?>
<div class="row" style="padding-left: 50px;padding-right: 50px;page-break-after: always;">

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
      <td>D.O.A.:-<span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>
      <td>D.O.D.:- <span style="font-weight: bold;"> <?php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?></span></td>
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
        </span></td>
        
      </tr>
      
      
    </tbody>
  </table>
</div>
</div>
</div>
<?php }?>
<!-- end post operative notes-->






<!--  Discharge Cardstart -->     
<div class="row" style="padding-left: 50px;padding-right: 50px;">

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
      <td>D.O.A.:-<span style="font-weight: bold;"><?php echo date('d-m-Y',strtotime($profile->create_date)); ?></span></td>
      <td>D.O.D.:- <span style="font-weight: bold;"> <?php if($profile->discharge_date=='0000-00-00') { echo $profile->discharge_date; } else { echo date('d-m-Y',strtotime($profile->discharge_date)); } ?></span></td>
       </tr>
       
      
    </tbody>
  </table>
  
  
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
      
      <!--<tr  colspan="">
         <?php $str = $bp;
         $ex=explode("/",$str);
          ?>
         <td>B.P.:&nbsp;&nbsp;&nbsp; &nbsp; <span style="font-weight: bold;"><?php if($bp) { if($ex[0]%2==0){ echo ($ex[0] + 2).'/'.($ex[1] + 2)."   mm of Hg";} else{ echo $bp,"   mm of Hg";}} else { echo $bp[$bp1],"   mm of Hg";}?>  </span></td> 
      </tr>
      
        <tr colspan="6">
           <td>Pulse:&nbsp;&nbsp;&nbsp; &nbsp;<span style="font-weight: bold;">    <?php if($pulse) { { if($pulse%2==0) { echo ($pulse +2)." /min";} else { echo ($pulse)." /min";} }} else { echo 	          $Pulse[$Pulse1]." /min";} ?>  </span></td>

      </tr>
      
       <tr colspan="6">
         <td>RS: <span style="font-weight: bold;">     <?php if($tretment->rs) { echo $tretment->rs; }else {  echo $ur; }?>             </span></td>

      </tr>
      
       <tr colspan="6">
         <td>CVS : <span style="font-weight: bold;">      <?php echo $cvs;?>      </span></td>

      </tr>
      
      
       <tr colspan="6">
         <td>PA: <span style="font-weight: bold;">          <?php if($tretment->pa) { echo  $tretment->pa.' '.$pa_tre[$pa_tre1].' inches,Rajidarshan';} else { echo $udar;}?>     </span></td>

      </tr>-->
      
      <!-- <tr>
        <td colspan="6">General Condition: <span style="font-weight: bold;"> <?php  echo $profile->gcondition; ?></span>
        
        </td>
        
      </tr>
      -->
      <tr>
        <td colspan="6">Investigation: <br> <span style="font-weight: bold;">    <?php  
         $tre_spe_inves = $Sp_Investigations_pandamic;
                                        $ex_spe_inves=explode(",",$tre_spe_inves);?>
        <?php if((strpos($HEMATOLOGICAL, 'CBC') !== false) || (strpos($SEROLOGYCAL, 'CBC') !== false) || (strpos($BIOCHEMICAL, 'CBC') !== false) || (strpos($MICROBIOLOGICAL, 'CBC') !== false)) {  } else { echo "CBC,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'ESR') !== false) || (strpos($SEROLOGYCAL, 'ESR') !== false) || (strpos($BIOCHEMICAL, 'ESR') !== false) || (strpos($MICROBIOLOGICAL, 'ESR') !== false)) { } else { echo "ESR,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'LFT') !== false) || (strpos($SEROLOGYCAL, 'LFT') !== false) || (strpos($BIOCHEMICAL, 'LFT') !== false) || (strpos($MICROBIOLOGICAL, 'LFT') !== false)) { } else { echo "LFT,";}?>
        <?php if((strpos($HEMATOLOGICAL, 'RFT') !== false) || (strpos($SEROLOGYCAL, 'RFT') !== false) || (strpos($BIOCHEMICAL, 'RFT') !== false) || (strpos($MICROBIOLOGICAL, 'RFT') !== false)) { } else { echo "RFT,";}?>
        
                                
      <?php  if($HEMATOLOGICAL) { echo $HEMATOLOGICAL."<br>";} if($SEROLOGYCAL){ echo $SEROLOGYCAL."<br>";} if($BIOCHEMICAL) { echo $BIOCHEMICAL."<br>";} if($MICROBIOLOGICAL) { echo $MICROBIOLOGICAL."<br>";} if($X_RAY) { echo $X_RAY."<br>";} if($ECG) { echo $ECG."<br>";} if($USG){ echo $USG;} if($Sp_Investigations_pandamic){  echo '=>'.$ex_spe_inves[0];echo "<br>"; if($ex_spe_inves[1]) { echo "=>".$ex_spe_inves[1].'<br>'; }}    ?>    
        
        
        
        </span></td>
        
      </tr>
      
      <tr>
        <td colspan="6">Brief History : <br><span style="font-weight: bold;">   <?php if($tretment->kco) { ?>: </b><?php echo 'K/C/O : '.$tretment->kco.'<br>';}?>
        <?php if($tretment->h_o) { if ($tretment->h_o =='NAD') { } else { echo $tretment->h_o;}} else { echo '';}?>
        <?php echo $symptoms; ?><br>
        </span></td>
        
      </tr>
      
     
      <tr>
        <td colspan="6">Treatment Received : <br><span style="font-weight: bold;">         <?php 
        
        
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
             
                                        if($DSRX1) { echo "=>".str_replace("?","-->",$exDS[0]);echo "<br>"; if($exDS[1]) { echo "=>".str_replace("?","-->",$exDS[1]).'<br>'; } if($exDS[2]) { echo "=>".str_replace("?","-->",$exDS[2]).'<br>'; }}?>
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
             
                                         if($RX1) { $ex_x=explode("x",$ex[0]);  echo "<br>=>".$ex_x[0];echo "<br>"; if($ex[1]) { $ex_x1=explode("x",$ex[1]);  echo "=>".$ex_x1[0].'<br>'; } if($ex[2]) { $ex_x2=explode("x",$ex[2]); echo "=>".$ex_x2[0].'<br>'; }}?>
                                       <?php if($RX2) { $ex_x20=explode("x",$ex2[0]);  echo "=>".$ex_x20[0];echo "<br>"; if($ex2[1]) { $ex_x21=explode("x",$ex2[1]);  echo "=>".$ex_x21[0].'<br>'; } if($ex2[2]) { $ex_x22=explode("x",$ex2[2]);  echo "=>".$ex_x22[0].'<br>'; }}?>
                                       <?php if($RX3) { $ex_x30=explode("x",$ex3[0]); echo "=>".$ex_x30[0];echo "<br>"; if($ex3[1]) { $ex_x31=explode("x",$ex3[1]); echo "=>".$ex_x31[0].'<br>'; } if($ex3[2]) { $ex_x32=explode("x",$ex3[2]); echo "=>".$ex_x32[0].'<br>'; }}?>
                                        <?php if($RX4) { $ex_x40=explode("x",$ex4[0]); echo "=>".$ex_x40[0];echo "<br>"; if($ex4[1]) { $ex_x41=explode("x",$ex4[1]); echo "=>".$ex_x41[0].'<br>'; } if($ex4[2]) { $ex_x42=explode("x",$ex4[2]);echo "=>".$ex_x42[0].'<br>'; }}?><br>
                                       <?php if($RX5) { $ex_x50=explode("x",$ex5[0]);  echo "=>".$ex_x50[0];echo "<br>"; if($ex5[1]) { $ex_x51=explode("x",$ex5[1]); echo "=>".$ex_x51[0].'<br>'; } if($ex5[2]) { $ex_x52=explode("x",$ex5[2]); echo "=>".$ex_x52[0].'<br>'; }}?>
                                            
                                       
                                       
                                       
                                        
        <?php  if($SWEDAN){  echo $SWEDAN.'<br>'; }?>
                                    
                                       <?php  if(($VAMAN)  && ($i==0)) {  echo "=>".$VAMAN.'<br>'; }?>
                                     
                                       <?php  if($VIRECHAN){  echo "=>".$VIRECHAN.'<br>'; }?>
                                       
                                        <?php  if($VAMAN_1D){  echo "=>".$VAMAN_1D.'<br>'; }?>
                                      
                                        <?php  if($BASTI){  echo "=>".$BASTI.'<br>'; }?>
                                     
                                       <?php  if($NASYA){  echo "=>".$NASYA.'<br>'; }?>
                                     
                                       <?php  if(($RAKTAMOKSHAN)  && ($i==0)) { echo "=>".$RAKTAMOKSHAN.'<br>'; }?>
                                    
                                       <?php  if(($SHIRODHARA_SHIROBASTI)  && ($i==0)) {  echo"=>".$SHIRODHARA_SHIROBASTI.'<br>'; }?>
                                    
                                       <?php  if($OTHER){  echo "=>".$OTHER.'<br>'; }?>
                                      
                                      <?php  if($OTHER_1D){  echo "=>".$OTHER_1D.'<br>'; }?>
                                     
                                       <?php  if($SWA1){  echo "=>".$SWA1.'<br>'; }?>
                                    
                                       <?php  if($SWA2){  echo "=>".$SWA2.'<br>'; }?>
                                       
                                       
                                        <?php  if($skarma){  echo "=>".$skarma.'<br>'; }?>
                                    
                                       <?php  if($vkarma){  echo "=>".$vkarma.'<br>'; }?>
                                       
                                     
                                      
                                       
                                       
                                       
                                       
                                       </span></td>
        
        
        
        
       
                                      
      </tr>
      
      <tr>
        <td colspan="6">Treatment Advised: <br><span style="font-weight: bold;"> 
        
        
        <?php if($DRX1) { echo $DRX1.'<br> ';} if($DRX2) {  echo $DRX2.'<br> ' ;} if($DRX3) {  echo  $DRX3;} ?>  
        </span></td>
        
      </tr>
      
      
      <tr>
        <td colspan="6">Follow Up : &nbsp; &nbsp;After  7  days.</td>
        
      </tr>
      
      
      <tr>
        <td colspan="6">Medical Officer :</td>
        
      </tr>
      
      
      
    </tbody>
  </table>
</div>
</div>
</div>







</div>

<!--// patient marathi info-->
       
       
         
                
                
                
                
 </div> <!-- final row end-->
            
            
           
           
           



            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

