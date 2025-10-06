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



                    <div class="col-sm-12" align="center">  
                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                    <h1>Serology Examination Reports</h1>

                    <br>

                    </div>


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
                                    <td>Hbs Ag</td>
                                    <td><?php echo $profile->hbs; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>HIV I &amp;II</td>
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

