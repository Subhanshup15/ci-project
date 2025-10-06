<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <!-- <a class="btn btn-success" href="<?php echo base_url("laboratory/createhaemogram") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <a class="btn btn-primary" href="<?php echo base_url("laboratory/listhaemogram") ?>"> <i class="fa fa-list"></i>  List </a>   -->

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
                                    <td>Hb</td>
                                    <td><?php echo $profile->hbs; ?></td>
                                    <td>11.5gm-14.5%</td>
                                </tr>
                                <tr>
                                    <td>TLC</td>
                                    <td><?php echo $profile->tlc; ?></td>
                                    <td>4000-11000/Cumm</td>
                                </tr>
                                <tr>
                                    <td>Neutrophils</td>
                                    <td><?php echo $profile->dlc_neutor; ?></td>
                                    <td>50-70%</td>
                                </tr>
                                <tr>
                                    <td>Lymphocytes</td>
                                    <td><?php echo $profile->dlc_neutor; ?></td>
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
                                    <td>Basophils</td>
                                    <td><?php echo $profile->rafactor; ?></td>
                                    <td>0-1%</td>
                                </tr>

                                <tr>
                                    <td>ESR(Westergren)</td>
                                    <td><?php echo $profile->esr; ?></td>
                                    <td>2-10mm 1st.hr.WG</td>
                                </tr>
                                <tr>
                                    <td>Platelet count</td>
                                    <td><?php echo $profile->platelet_count; ?></td>
                                    <td>1.5-4.5 Lakh/Cumm</td>
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
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> 



           <!-- <div class="panel-footer">

                <div class="text-center">

                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>

                </div>

            </div>-->

        </div>

    </div>

 

</div>

