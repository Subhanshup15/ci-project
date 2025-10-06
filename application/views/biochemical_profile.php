<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("biochemical/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <a class="btn btn-primary" href="<?php echo base_url("biochemical") ?>"> <i class="fa fa-list"></i>  List </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>

            </div> 



            <div class="panel-body">

                <div class="row">



                     <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    </div>
                    <div class="col-xs-2" align="left"></div>
                </div>
            </div><br>


                    <div class="col-md-12 col-lg-12 "> 

                        <table class="table">
                            <tr>
                                <td>Name:</td>
                                <td><?php echo (!empty($profile->name)?$profile->name:null) ?></td>
                                <td>Sex:</td>
                                <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                            </tr>
                            <tr>
                            <td>Date:</td>
                                <td><?php echo (!empty($profile->date)?$profile->date:null) ?></td>
                                <td>Ref By Doctor:</td>
                                <td><?php echo (!empty($profile->doctor)?$profile->doctor:null) ?></td>  
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td><?php echo (!empty($profile->age)?$profile->age:null) ?></td>
                                
                                <td>OPD Number:</td>
                                <td><?php echo (!empty($profile->opd_no)?$profile->opd_no:null) ?></td>
                                
                            </tr>
                        </table>

                    </div>

                    

                </div>

                <div class="row">
                <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th>Test</th>
                                <th>Result</th>
                                <th>Normal Values</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Blood Sugar Random</td>
                                    <td><?php echo $profile->bs_random; ?></td>
                                    <td>80- 110 mg/dl</td>
                                    
                                </tr>
                                <tr>
                                <td>Blood Sugar Fasting</td>
                                    <td><?php echo $profile->bs_fasting; ?></td>
                                    <td>80- 110 mg/dl</td>
                                </tr>
                                <tr>
                                <td>Blood Sugar Post Prandial </td>
                                    <td><?php echo $profile->bs_bb; ?></td>
                                    <td>80- 140 mg/dl</td>
                                </tr>
                                <tr>
                                <td>Blood Urea </td>
                                    <td><?php echo $profile->blood_urea; ?></td>
                                    <td>15 - 40 mg/dl</td>
                                </tr>
                                <tr>
                                    <td>Sr. Creatinine </td>
                                    <td><?php echo $profile->srcretinity; ?></td>
                                    <td>M : 0.9 - 1.4 mg/dl <br/> F: 0.8- 1.2 mg/dl </td>
                                </tr>

                                <tr>
                                    <td>Sr. Billirubin</td>
                                    <td><?php echo $profile->srbillirubin; ?></td>
                                    <td>0.1 - I mg/dl <br/> 0.1 -0.25 mg/dl <br/> 0.2- I mg/dl </td>
                                </tr>

                                <tr>
                                    <td>S.G.O.T</td>
                                    <td><?php echo $profile->sgot; ?></td>
                                    <td>0-35 U/L</td>
                                </tr>

                                <tr>
                                    <td>S.G.O.T</td>
                                    <td><?php echo $profile->sgot2; ?></td>
                                    <td>0-43 U/L</td>
                                </tr>

                                <tr>
                                    <td>Sr. Alkaline Phosphate</td>
                                    <td><?php echo $profile->sralkalinephosphare; ?></td>
                                    <td>60-70 U/L</td>
                                </tr>

                                <tr>
                                    <td>Sr. Cholesterol</td>
                                    <td><?php echo $profile->srcholesterol; ?></td>
                                    <td>150-250 mg/dl</td>
                                </tr>

                                <tr>
                                    <td> Sr. Triglyserides</td>
                                    <td><?php echo $profile->srtriglyserides; ?></td>
                                    <td>M: 60-165 mg/dl</td>
                                </tr>

                                <tr>
                                    <td>Sr. Uric acid level</td>
                                    <td><?php echo $profile->sruricscidlevel; ?></td>
                                    <td>M: 3.4-7 mg/dl <br/> F : 2.4 - 5.7 mg/dl</td>
                                </tr>

                                <tr>
                                    <td>Sr. Protien total </td>
                                    <td><?php echo $profile->srprotienlevel	; ?></td>
                                    <td>6 - 8 gm/dl</td>
                                </tr>

                                <tr>
                                    <td>Sr. Albumin level</td>
                                    <td><?php echo $profile->sralbuminlevel; ?></td>
                                    <td>3.3-5 gm/dl </td>
                                </tr>

                                <tr>
                                    <td>Sr. Calcium level</td>
                                    <td><?php echo $profile->srcaciumlevel; ?></td>
                                    <td>8.5 - 10.5 mg/dl</td>
                                </tr>

                                <tr>
                                    <td>Ck. M.B.</td>
                                    <td><?php echo $profile->ckmb; ?></td>
                                    <td>0-24 U/dl</td>
                                </tr>

                                <tr>
                                    <td>Sr.C.H.E. </td>
                                    <td><?php echo $profile->srche; ?></td>
                                    <td>3700-11500U/L Pathologist / Techincian</td>
                                </tr>
                                
                            </tbody>
                        </table>


                        
                    </div>
                </div>

            </div> 



            <!--<div class="panel-footer">

                <div class="text-center">

                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>

                </div>

            </div>
-->
        </div>

    </div>

 

</div>

