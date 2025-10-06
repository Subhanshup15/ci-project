<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("laboratory/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <a class="btn btn-primary" href="<?php echo base_url("laboratory") ?>"> <i class="fa fa-list"></i>  List </a>  

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
                                <td>Bed No:</td>
                                <td><?php echo (!empty($profile->bedno)?$profile->bedno:null) ?></td>
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
                                    <td>Hb</td>
                                    <td><?php echo $profile->hb; ?></td>
                                    <td>11.5gm-14.5%</td>
                                </tr>
                                <tr>
                                    <td>TLC</td>
                                    <td><?php echo $profile->tlc; ?></td>
                                    <td>4000-11000/Cumm</td>
                                </tr>
                                <tr>
                                    <td>DLC Neutro</td>
                                    <td><?php echo $profile->dlc_neutor; ?></td>
                                    <td>50-70%</td>
                                </tr>
                                <tr>
                                    <td>DLC Lymphocytes</td>
                                    <td><?php echo $profile->dlc_lymphocytes; ?></td>
                                    <td>20-40%/td>
                                </tr>
                                <tr>
                                    <td>Monocytes</td>
                                    <td><?php echo $profile->monocytes; ?></td>
                                    <td>1-4%</td>
                                </tr>
                                <tr>
                                    <td>Eosinophils</td>
                                    <td><?php echo $profile->eosinophils; ?></td>
                                    <td>0.4%</td>
                                </tr>
                                <tr>
                                    <td>Platelet Count</td>
                                    <td><?php echo $profile->esr; ?></td>
                                    <td>1.5-4.5 Lakh/Cumm</td>
                                </tr>
                                <tr>
                                    <td>M.P.</td>
                                    <td><?php echo $profile->platelet_count; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>M.P.</td>
                                    <td><?php echo $profile->mp; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>B.T.</td>
                                    <td><?php echo $profile->bt; ?></td>
                                    <td>1-5 Mts (lvy3 methods)</td>
                                </tr>
                                <tr>
                                    <td>C.T.</td>
                                    <td><?php echo $profile->ct; ?></td>
                                    <td>1-6 Mts (weight methods)</td>
                                </tr>
                                <tr>
                                    <td>Blood Group</td>
                                    <td><?php echo $profile->blood_group; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Hbs Ag</td>
                                    <td><?php echo $profile->hbs; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>HIV 1 & 2</td>
                                    <td><?php echo $profile->hiv; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>VDRL</td>
                                    <td><?php echo $profile->vdrl; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Widal Test S. Typhi</td>
                                    <td><?php echo $profile->widal_test; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>S. Paratyphi</td>
                                    <td><?php echo $profile->sparatyphi; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>R.A. Factor</td>
                                    <td><?php echo $profile->rafactor; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Mix Test</td>
                                    <td><?php echo $profile->mxtest; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Sputum For AFB</td>
                                    <td><?php echo $profile->sputum; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>S.Amyalse</td>
                                    <td><?php echo $profile->samyalse; ?></td>
                                    <td>35-140 IU/L</td>
                                </tr>
                                <tr>
                                    <td>B.sugar</td>
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
                                    <td>H.Dl</td>
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
                                    <td> 0.3-0.8 mg% </td>
                                </tr>




                            </tbody>
                        </table>
                    </div>
                </div>

            </div> 


<!--
            <div class="panel-footer">

                <div class="text-center">

                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>

                </div>

            </div>-->

        </div>

    </div>

 

</div>

