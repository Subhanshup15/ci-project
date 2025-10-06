<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 

                </div>
                

            </div> 



            <div class="panel-body">

                <div class="row">



                    <div class="col-sm-12" align="center">  
                 <!--   <strong><?php echo $this->session->userdata('title') ?></strong>
                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>-->
                    <strong><?php echo $this->session->userdata('title') ?></strong>
                  <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
 
 
                    <h1>Indoor patient file</h1>
                    <br>

                    </div>


                    <div class="col-md-12 col-lg-12 "> 

                        <table class="table">
                        <tr>22222222222222
                                <td>Ward No:</td>
                                <td><?php echo (!empty($profile->wardType)?$profile->wardType:null) ?></td>
                                <td>Bed No:</td>
                                <td><?php echo (!empty($profile->bedNo)?$profile->bedNo:null) ?></td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td><?php echo (!empty($profile->name)?$profile->name:null) ?></td>
                                <td>Doctor</td>
                                <td></td>
                            </tr>
                            <tr>
                            <td>Old Opd No</td>
                                <td><?php echo (!empty($profile->old_reg_no)?$profile->old_reg_no:null) ?></td>
                                <td>Opd No:</td>
                                <td><?php echo (!empty($profile->yearly_reg_no)?$profile->yearly_reg_no:null) ?></td>
                                
                            </tr>
                            <tr>
                                <td>Ipd No</td>
                                <td><?php echo (!empty($profile->ipd_no)?$profile->ipd_no:null) ?></td>  
                                
                            </tr>

                            <tr>
                                <td>Date of admission</td>
                                <td><?php echo (!empty($profile->create_date)?$profile->create_date:null) ?></td>
                                <td>Time</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Date of Discharge</td>
                                <td><?php echo (!empty($profile->discharge_date)?$profile->discharge_date:null) ?></td>
                                <td>Time</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Patient name</td>
                                <td><?php echo (!empty($profile->firstname)?$profile->firstname:null) ?></td>
                                <td>Age</td>
                                <td><?php echo (!empty($profile->date_of_birth)?$profile->date_of_birth:null) ?></td>
                            </tr>

                            <tr>
                                <td>Sex</td>
                                <td><?php echo (!empty($profile->sex)?$profile->sex:null) ?></td>
                                <td>Father / Husband Name </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Address</td>
                                <td colspan="3"><?php echo (!empty($profile->address)?$profile->address:null) ?></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Ph no</td>
                                <td colspan="3"><?php echo (!empty($profile->mobile)?$profile->mobile:null) ?></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Provisional Diagnosis</td>
                                <td colspan="3"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Final Diagnosis</td>
                                <td colspan="3"><?php echo (!empty($profile->dignosis)?$profile->dignosis:null) ?></td>
                                <td></td>
                                <td></td>
                            </tr>



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

