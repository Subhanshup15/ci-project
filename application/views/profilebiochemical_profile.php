<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <!-- <a class="btn btn-success" href="<?php echo base_url("laboratory/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <a class="btn btn-primary" href="<?php echo base_url("laboratory") ?>"> <i class="fa fa-list"></i>  List </a>   -->

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
                                <td>Unit No:</td>
                                <td><?php echo (!empty($profile->unitno)?$profile->unitno:null) ?></td>  
                            </tr>
                            <tr>
                                <td>Ward No:</td>
                                <td><?php echo (!empty($profile->ward)?$profile->ward:null) ?></td>
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
                                <th>Investigation</th>
                                <th>Results</th>
                                <th>Normal Value</th>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>B.Sugar F</td>
                                    <td><?php echo $profile->bsugarf; ?></td>
                                    <td>70-110mg%</td>
                                </tr>
                                <tr>
                                    <td>Blood Sugar P.P./R</td>
                                    <td><?php echo $profile->blood_sugar_pp; ?></td>
                                    <td>110-150mg%</td>
                                </tr>
                                <tr>
                                    <td>Blood Urea</td>
                                    <td><?php echo $profile->blood_urea; ?></td>
                                    <td>20-40mg%</td>
                                </tr>
                                <tr>
                                    <td>S.Creatinine</td>
                                    <td><?php echo $profile->s_creatinine; ?></td>
                                    <td>.7-.14mg%</td>
                                </tr>
                                <tr>
                                    <td>S.Uric Acid</td>
                                    <td><?php echo $profile->s_uricacid; ?></td>
                                    <td>2-6mg%</td>
                                </tr>
                                <tr>
                                    <td>S.Na+</td>
                                    <td><?php echo $profile->s_na; ?></td>
                                    <td>135-155 meq/L</td>
                                </tr>
                                <tr>
                                    <td>S.K+</td>
                                    <td><?php echo $profile->s_k; ?></td>
                                    <td>3.5-5.5 meq/L</td>
                                </tr>
                                <tr>
                                    <td>Total Cholestrol</td>
                                    <td><?php echo $profile->total_cholestrol; ?></td>
                                    <td>150-200 mg/dl</td>
                                </tr>
                                <tr>
                                    <td>S.Tg</td>
                                    <td><?php echo $profile->s_tg; ?></td>
                                    <td>60-170 mg/dl</td>
                                </tr>
                                <tr>
                                    <td>H.D.L.</td>
                                    <td><?php echo $profile->h_dl; ?></td>
                                    <td>30-70 mg/dl</td>
                                </tr>
                              
                                <tr>
                                    <td>L.D.L</td>
                                    <td><?php echo $profile->ldl; ?></td>
                                    <td> 150 mg/dl </td>
                                </tr>

                                <tr>
                                    <td>V.L.D.L</td>
                                    <td><?php echo $profile->vldl; ?></td>
                                    <td> 14-45 mg/dl </td>
                                </tr>

                                <tr>
                                    <td>S. Billirubin T</td>
                                    <td><?php echo $profile->s_billirubin; ?></td>
                                    <td> 0.1-2.2 mg% </td>
                                </tr>

                                
                                <tr>
                                    <td>S. Billirubin D</td>
                                    <td><?php echo $profile->samyalse; ?></td>
                                    <td> 0.3-0.8 mg% </td>
                                </tr>
                                
                                <tr>
                                    <td>S.G.O.T</td>
                                    <td><?php echo $profile->sgot; ?></td>
                                    <td> 5-40 L.u/L </td>
                                </tr>

                                
                                <tr>
                                    <td>S.G.P.T</td>
                                    <td><?php echo $profile->sgot; ?></td>
                                    <td> 5-35 L.u/L </td>
                                </tr>

                                
                                <tr>
                                    <td>Total Protin</td>
                                    <td><?php echo $profile->total_protin; ?></td>
                                    <td> 5-35 L.u/L </td>
                                </tr>
                                
                                <tr>
                                    <td>Aib</td>
                                    <td><?php echo $profile->aib; ?></td>
                                    <td> 6-8 gm% </td>
                                </tr>

                                
                                <tr>
                                    <td>Golublian</td>
                                    <td><?php echo $profile->globulin; ?></td>
                                    <td> 1.8-2.5 gm% </td>
                                </tr>

                                
                                <tr>
                                    <td>Alk. Phosphatase</td>
                                    <td><?php echo $profile->alk_phosphatse; ?></td>
                                    <td> 1.8-2.5 gm% </td>
                                </tr>
                                <tr>
                                    <td>S.Calcium</td>
                                    <td><?php echo $profile->s_calcium; ?></td>
                                    <td> 8.5-10.5 mg% </td>
                                </tr>

                                <tr>
                                    <td>S.Amyalse</td>
                                    <td><?php echo $profile->s_calcium; ?></td>
                                    <td> 35- 140  Iu/L </td>
                                </tr>




                            </tbody>
                        </table>
                    </div>
                </div>

            </div> 



          <!--  <div class="panel-footer">

                <div class="text-center">

                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>

                </div>

            </div>-->

        </div>

    </div>

 

</div>

