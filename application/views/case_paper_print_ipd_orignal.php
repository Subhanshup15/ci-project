<div class="row">

<?php echo error_reporting(0);?>


    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>
               <!--  <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/treatment/$id/ipd/$profile->dignosis") ?>"> <i class="fa fa-plus"></i>Add Treatment</a>  
                </div>
				<div class="btn-group"> 
                
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/case_paper_print/ipd") ?>">Back </a>  
                </div>
                
                <div class="btn-group"> 
                <?php $id=$this->uri->segment(3);
                
                 ?>
 
                    <a class="btn btn-success" href="<?php echo base_url("patients/patient_check/$id/ipd") ?>"> <i class="fa fa-edit"></i>edit Check Up</a>   
                </div>
                <div class="btn-group" <?php if($profile->discharge_date =='0000-00-00'){ echo "style='display: none;'";} else { echo "style='display: block;'";}?> > 
                    <a class="btn btn-default" href="<?php echo base_url("patients/ipdprofile_bill/$id") ?>"> <i class="fa fa-list-alt"></i> Bill Receipt</a>   
                </div>-->

            </div> 

 

            <div class="panel-body" style="">
               

                <div class="row" style="">
                <? foreach($patients as $profile){
               $number= $profile->id;
               
                ?>
                <div class="col-sm-6" align="center">

                    <div class="col-sm-12" align="center">  
                    <strong><?php echo $this->session->userdata('title') ?></strong>
                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                    <h1>IPD Case Paper</h1>

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
                                             
                                             
                                              // patient ipd yearly no
			                      $ipd_no_date=date('Y-m-d',strtotime($profile->create_date));
                                  $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                  $year122=date('Y',strtotime($profile->create_date));
                                  $year2='%'.$year122.'%';

                                  $this->db->select('*');
                                  $this->db->where('ipd_opd', 'ipd');
                                  $this->db->where('id <', $profile->id);
                                 // $this->db->where('create_date <=', $d_ipd_no);
                                  $this->db->where('create_date LIKE', $year2);
                                  $query = $this->db->get('patient_ipd');
                                  $num_ipd_change = $query->num_rows();
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;
                   
                   ?>
                    <div class="col-md-12 col-lg-12 "> 

                        <table class="table">
                            <tr>
                                <td>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                        <td>संपूर्ण नाव :</td>
                                        <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                        </tr>
                                        <tr>
                                        <td>वय :</td>
                                        <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?></td>
                                        </tr>
                                        <tr>
                                        <td>पुरुष / स्त्री :</td>
                                        <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                                        </tr>
                                        <tr>
                                        <td>पत्ता :</td>
                                        <td><?php echo $address; ?></td>
                                        </tr>
                                       
                                        <tr>
                                            <td>संपर्क क्रमांक</td>
                                            <td><?php echo (!empty($profile->mobile)?$profile->mobile:null) ?></td>
                                        <tr>
                                       <!-- <tr>
                                            <td>जात</td>
                                            <td><?php echo (!empty($profile->religion)?$profile->religion:null) ?></td>
                                        <tr>
                                        <tr>
                                            <td>उत्पन्न</td>
                                            <td></td>
                                        <tr>-->
                                        <tr>
                                            <td>व्यवसाय :</td>
                                            <td><?php echo (!empty($profile->occupation)?$profile->occupation:$occupation) ?></td>
                                        <tr>
                                        <tr>
                                            <td>वजन :</td>
                                            <td><?php echo $wieght;?></td>
                                        <tr>
                                        <tr>
                                            <td>जवळच्या नातेवाईकाचे नाव व पत्ता :</td>
                                            <td></td>
                                        <tr>
                                        <tr>
                                            <td>विभाग प्रमुख वैद्यकीय अधिकारी :</td>
                                            <td>
                                                <?php $depart =$this->db->select("*")

			                                        ->from('user')
			                                        ->where('department_id', $profile->department_id) 
                                                    ->get()
                                                    ->row();
                                                    echo $depart->firstname; ?>
                                                
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>विद्यार्थी :</td>
                                            <td></td>
                                        <tr>
                                        <tr>
                                            <td>रोगनिदान :</td>
                                            <td><?php echo $profile->dignosis; ?></td>
                                        <tr>
                                        
                                    </table>
                                </td>
                                <table class="table">
                                        <tr>
                                            <td>अंतर रुग्ण नोंदणी क्र.</td>
                                            <td><?php echo $tot_serial_ipd_change; ?></td>
                                        </tr>
                                        <tr>
                                            <td>बाह्य रुग्ण नोंदणी क्र.</td>
                                            <td><?php    
                                            $ddd= date('Y',strtotime($profile->create_date));
                                            $yy=substr($ddd,2,2);
                                            
                               
                                 if($profile->yearly_reg_no != null){
                                    echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null);
                                    echo ".".$yy."(New)";
                                } else {
                                    echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null);
                                    echo  ".".$yy."(Old)";
                                }  ?></td>
                                        </tr>
                                        <tr>
                                            <td>कक्ष </td>
                                            <td><?php $depart =$this->db->select("*")

			                                        ->from('department')
			                                        ->where('dprt_id', $profile->department_id) 
                                                    ->get()
                                                    ->row();
                                                    echo (!empty($depart->name)?$depart->name:null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>खाट </td>
                                            <td><?php $bed_no =$this->db->select("*")

			                                        ->from('beds')
			                                        ->where('id', $profile->bedNo) 
                                                    ->get()
                                                    ->row();
                                                    echo (!empty($bed_no->id)?$bed_no->id."   (  ". $bed_no->name.")":null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>दाखल केल्याचा दिनांक </td>
                                            <td><?php echo (!empty($profile->create_date)?date('d-m-Y',strtotime($profile->create_date)):null) ?></td>
                                        </tr>
                                        <tr>
                                            <td> दाखल केल्याचा वेळ</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>डिस्चार्ज तारीखनांक </td>
                                            <td><?php echo (!empty($profile->discharge_date)?$profile->discharge_date:null) ?></td>
                                        </tr>
                                        <tr>
                                            <td>डिस्चार्ज वेळ </td>
                                            <td></td>
                                        </tr>
                                        <tr rolspan="2">
                                            <td>M.L.C / NON M.L.C.</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>M.L.C No</td>
                                            <td></td>
                                        </tr>
                                        <tr rowspan="5">
                                            <td>निष्कर्ष : </td>
                                            <<td><?php echo $profile->nishkrsh; ?></td>
                                            </tr>
                                       <!-- <tr>
                                            <td></td>
                                            <td>सुधारणा झाली </td>  
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>मुळीच सुधारणा झाली नाही</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>पळाला</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>मृत्यू पावला</td>
                                        </tr>-->
                                        <tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">प्रमुख वेदना: </td>
                                <td><?php echo $profile->compliance?></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br></td>
                                <td></td>
                                
                            </tr>
                            

                            <tr>
                                <td colspan="2">वर्तमान व्याधीवृत्त : </td>
                                <td><?php echo $profile->vyadhi?></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br></td>
                                <td></td>
                                
                            </tr>
                            

                            <tr>
                                <td colspan="2"><!--कुल वृत्त :-->H/O:   <?php echo $h_o;?> </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2"><!--कुल वृत्त --> Family history:    <?php echo $f_h;?>   </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <table class="table">
                                        <tbody>
                                                <tr>
                                                    <td>नाडी:      <?php echo $nadii; ?> </td>
                                                    <td>जिव्हा:   <?php echo $givwa;?></td>
                                                    <td>रक्तदाब:    <?php echo $bp;?></td>
                                                </tr>
                                                <tr>
                                                    <td>मल :   <?php echo $mal;?></td>
                                                    <td>शब्द :   <?php echo $profile-shabhd;?> </td>
                                                    <!--<td>वजन : <?php echo $profile->wieght;?></td>-->
                                                </tr>
                                                <tr>
                                                    <td>मुत्र: <?php echo $mutra;?>   </td>
                                                    <td>स्पर्श:  <?php echo $profile->parsh;?> </td>
                                                    <td>आकृती :   <?php echo $profile->akruti;?></td>
                                                </tr>
                                                <tr>
                                                    <td>श्वसन:  <?php echo $profile->shwsan;?> </td>
                                                    <td>दृक:    <?php echo $profile->dk;?> </td>
                                                    <td>तापमान :   <?php echo $profile->tapman;?></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                
                                </td>
                                <td></td>
                                
                            </tr>
                            

                            
                            <tr>
                                <td colspan="2">उर  परीक्षण :<?php echo $ur;?></td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            

                            <tr>
                                <td colspan="2">उदर परीक्षण: <?php echo $udar;?></td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>                            
                            <tr>
                                <td colspan="2">स्त्रोतस परीक्षण </td>
                                <td><?php echo $profile->strot_parishwan;?></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">चिकित्सा सूत्र  </td>
                                <td><?php echo $profile->chiki_sutra;?></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            

                            <tr>
                                <td colspan="2">चिकित्सा : </td>
                                <td><?php echo $profile->checkup;?></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            

                            <tr>
                                <td colspan="2">तपासणी : </td>
                                <td><?php echo $profile->udar;?></td>
                                
                            </tr>
                            <tr>
                                <td colspan="2"><br> </td>
                                <td></td>
                                
                            </tr>
                            
                        </table>

                    </div>

                    

                </div>
                
                 
                
                <?php }?> 
                
            </div> 
              

                

            </div> 
   


            <div class="panel-footer">

                <div class="text-center">

                   
                </div>

            </div>

        </div>

    </div>

 

</div>

