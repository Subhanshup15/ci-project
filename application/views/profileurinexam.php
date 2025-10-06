<div class="row">



    <div class="col-sm-12" id="PrintMe">



        <div  class="panel panel-default thumbnail">

 

            <div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("urineexamination/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  

                    <a class="btn btn-primary" href="<?php echo base_url("urineexamination") ?>"> <i class="fa fa-list"></i>  List </a>  

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
                                <th colspan="2">Physical Examination</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:70%;">Volume</td>
                                    <td style="width:30%"><?php echo $profile->volume; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Colour</td>
                                    <td style="width:30%"><?php echo $profile->colour; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Specific gravity</td>
                                    <td style="width:30%"><?php echo $profile->specificgravity; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Appearance</td>
                                    <td style="width:30%"><?php echo $profile->appearance; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Deposit</td>
                                    <td style="width:30%"><?php echo $profile->deposit; ?></td>
                                    
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
                                    <td style="width:70%;">Reaction</td>
                                    <td style="width:30%"><?php echo $profile->ketonebodies; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Albumin</td>
                                    <td style="width:30%"><?php echo $profile->albumin; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Sugar</td>
                                    <td style="width:30%"><?php echo $profile->sugar; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Bile salt</td>
                                    <td style="width:30%"><?php echo $profile->bilesalt; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Bile pigment</td>
                                    <td style="width:30%"><?php echo $profile->bilepigment; ?></td>
                                    
                                </tr>
                                
                                <tr>
                                    <td style="width:70%;">Occult blood</td>
                                    <td style="width:30%"><?php echo $profile->occultblood; ?></td>
                                    
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
                                    <td style="width:70%;">Epithelial cells</td>
                                    <td style="width:30%"><?php echo $profile->epithelialcells; ?></td>
                                    
                                </tr>

                                <tr>
                                    <td style="width:70%;">Pus cells</td>
                                    <td style="width:30%"><?php echo $profile->puscell; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:70%;">Red Blood Cell's</td>
                                    <td style="width:30%"><?php echo $profile->rbc; ?></td>
                                    
                                </tr>
                                
                                <tr>
                                    <td style="width:70%;">Crystals</td>
                                    <td style="width:30%"><?php echo $profile->crystals; ?></td>
                                    
                                </tr>
                                

                                <tr>
                                    <td style="width:70%;">Granules</td>
                                    <td style="width:30%"><?php echo $profile->granules; ?></td>
                                    
                                </tr>

                                <tr>
                                    <td style="width:70%;">Bacteria</td>
                                    <td style="width:30%"><?php echo $profile->casts; ?></td>
                                    
                                </tr>

                                <tr>
                                    <td style="width:70%;">Amorohous</td>
                                    <td style="width:30%"><?php echo $profile->amorohous; ?></td>
                                    
                                </tr>

                                <tr>
                                    <td style="width:70%;">Other</td>
                                    <td style="width:30%"><?php echo $profile->other; ?></td>
                                    
                                </tr>

                                
                                <tr>
                                    <td style="width:70%;">Pregnancy test</td>
                                    <td style="width:30%"><?php echo $profile->pregtest; ?></td>
                                    
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> 



         <!--   <div class="panel-footer">

                <div class="text-center">

                    <strong><?php echo $this->session->userdata('title') ?></strong>

                    <p class="text-center"><?php echo $this->session->userdata('address') ?></p>

                </div>

            </div>-->

        </div>

    </div>

 

</div>

