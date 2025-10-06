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
                                <th colspan="2">Physical Examination</th>
                                <th></th>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:70%;">Volume</td>
                                    <td><?php echo $profile->volume; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Colour</td>
                                    <td><?php echo $profile->colour; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Reaction</td>
                                    <td><?php echo $profile->reaction; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Liquification Time</td>
                                    <td><?php echo $profile->liqification; ?></td>
                                    <!-- <td>20-40%/td> -->
                                </tr>
                                <tr>
                                    <td style="width:70%;">Total sperm count</td>
                                    <td><?php echo $profile->total_sperm_count; ?></td>
                                    <!-- <td>1-4%</td> -->
                                </tr>
                                                          

                            </tbody>
                        </table>


                        <table class="table">
                            <thead>
                                <th colspan="2">Chemical Examination</th>
                                <th></th>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:70%;">Active Sperms</td>
                                    <td><?php echo $profile->active_sperm; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Sluggish Sperms</td>
                                    <td><?php echo $profile->sluggidh_sperms; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Dead Sperms</td>
                                    <td><?php echo $profile->dead_sperms; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Pus Cells</td>
                                    <td><?php echo $profile->pus_cells; ?></td>
                                    <!-- <td>20-40%/td> -->
                                </tr>
                                <tr>
                                    <td style="width:70%;">R.B.C.'s</td>
                                    <td><?php echo $profile->rbcs; ?></td>
                                    <!-- <td>1-4%</td> -->
                                </tr>
                                                    

                            </tbody>
                        </table>


                        <table class="table">
                            <thead>
                                <th colspan="2">Microscopic Examination</th>
                                <th></th>                                
                            </thead>
                            <tbody>                                
                                <tr>
                                    <td style="width:70%;">Microscopic Examination</td>
                                    <td><?php echo $profile->morphology; ?></td>
                                    <!-- <td>20-40%/td> -->
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

            </div>
-->
        </div>

    </div>

 

</div>

