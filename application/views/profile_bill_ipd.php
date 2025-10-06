<div class="row">

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
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/opd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
                
                <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/opd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>

            </div> 



            <div class="panel-body">

                <div class="row">



                    <div class="col-sm-12" align="center">  
             <strong><?php echo $this->session->userdata('title') ?></strong>
                  <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
 
 
 

                    <br>

                    </div>

                    <div class="col-md-12 col-lg-12 " style="padding-left: 50px;"> 
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
                                             }
                   
                   ?>
                        <table class="table">
                        
                            <tr>
                                <td>बाह्यरुग्ण क्र.:</td>
                                <td>
                                <?php if($profile->yearly_reg_no != null){
                                    echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null);
                                } else {
                                    echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                } ?>
                                </td>
                                <td>दिनांक :</td>
                                <td><?php echo (!empty($profile->create_date)?$profile->create_date:null) ?></td>
                            </tr>
                            <tr>
                                <td>नाव :</td>
                                <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                <td>स्त्री / पु / मु / मुलगी:</td>
                                <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                            </tr>
                            <tr>
                            <td>वय :</td>
                                <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?></td>
                                <td>राहण्याचे ठिकाण :</td>
                                <td><?php echo $address; ?></td>
                                
                            </tr>
                            <tr>
                                <td>व्यवसाय :</td>
                                <td><?php echo $occupation;?></td>  
                                <td>व्याधिनाम :</td>
                                <td><?php echo $profile->dignosis;?></td>
                            </tr>
                            <tr>
                                <td>विभाग :</td>
                                <td><?php if($profile->department_id != null) {
                                    echo (!empty($profile->name)?$profile->name:null);
                                } ?></td> 
                                
                                <!--<?php $a=array(40,42,44,48,50,52,76,80,72);
                                  $key = array_rand($a); 
                                 ?>-->
                                <td>वजन  :</td>
                                <td><?php echo  $wieght;?></td>  
                            </tr>
                        </table>

                    </div>

                    

                </div>
                 
                  <div class="row"> 
              <div class="col-sm-12" align="center" style="padding-left: 50px;padding-right: 50px;"> 
            <table class="table table-bordered">
    <thead>
      <tr>
        <th>Particular</th>
        <th>Item</th>
        <th>Rate</th>
		<th>Amount</th>
      </tr>
    </thead>
    
    <?php 
      $section_tret='ipd';
                                        $len=strlen($profile->dignosis);
                                        $dd= substr($profile->dignosis,$len - 1);
                                      if($dd=='I'){
                                           $p_dignosis = '%'.$profile->dignosis.'%';
                                           $p_dignosis_name=$profile->dignosis;
                                      }else{
                                          
                                           $p_dignosis = '%'.$profile->dignosis.'I%';
                                           $p_dignosis_name=$profile->dignosis.'I';
                                      }
                                      
                                      
                                       $ss=date('Y-m-d',strtotime($dateto));
                                    if($ss <= '2020-01-28'){
                                        $table='treatments';
                                    }else{
                                        
                                         $table='treatments1';
                                    }
                                    
                                    
                                 if($profile->manual_status==0){
                                     $tretment=$this->db->select("*")

			                         ->from($table)

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
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
			                       
			                      $s_s= $tretment->skarma;
			                      $s_v= $tretment->vkarma;
			                      
			                      
			                       $SNEHAN= $tretment->SNEHAN;
			                     
			                      
			                      echo $SWEDAN= $tretment->SWEDAN;
			                      $VAMAN= $tretment->VAMAN;
			                      
			                     $VIRECHAN= $tretment->VIRECHAN;
			                      $BASTI= $tretment->BASTI;
			                      $NASYA= $tretment->NASYA;
			                      
			                      $RAKTAMOKSHAN= $tretment->RAKTAMOKSHAN;
			                      $SHIRODHARA_SHIROBASTI= $tretment->SHIRODHARA_SHIROBASTI;
			                      $OTHER= $tretment->OTHER;
			                      
			                     
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL;
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
			                      
			                      $X_RAY= $tretment->X_RAY;
			                      $ECG= $tretment->ECG;
    
    
    
    ?>
    <tbody>
      <tr>
        <td>IPD Charges</td>
        <td></td>
         <td></td>
		 <td></td>
      </tr>
      <tr>
         <td>Medicine</td>
        <td><?php echo $RX1.", ".$RX2.", ".$RX3 ?></td>
        <td></td>
		<td></td>
      </tr>
      <tr>
	   <tr>
         <td>Bed Charges</td>
        <td></td>
        <td></td>
		<td></td>
      </tr>
	   <tr>
         <td>Nursing Charges</td>
        <td></td>
        <td></td>
		<td></td>
      </tr>
	   
	  <tr>
         <td>Panchkarma</td>
        <td><?php echo $SNEHAN.", ".$SWEDAN.", ".$VAMAN.",".$VIRECHAN.", ".$BASTI.", ".$NASYA.",".$RAKTAMOKSHAN.",".$SHIRODHARA_SHIROBASTI.", ".$OTHER?></td>
        <td></td>
		<td></td>
      </tr>
	  <tr>
         <td>Shastrakarma</td>
        <td><?php echo $s_s;?></td>
        <td></td>
		<td></td>
      </tr>
	  <tr>
         <td>Ksharkarma</td>
        <td><?php echo $s_v;?></td>
        <td></td>
		<td></td>
      </tr>
      <tr>
        <td>Investigation I</td>
        <td><?php echo $X_RAY;?></td>
        <td></td>
		<td></td>
      </tr>
	   <tr>
        <td>Investigation II</td>
        <td><?php echo $ECG;?></td>
        <td></td>
		<td></td>
      </tr>
      <tr>
        <td colspan="3"><b>Grand Total</b></td>
        
		<td></td>
      </tr>
    </tbody>
  </table>
               
        </div>      
           </div> 

            </div> 



            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

