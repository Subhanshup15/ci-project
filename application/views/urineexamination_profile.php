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
                <div class="col-md-12 col-lg-12 ">
                        <table class="table">
                            <thead>
                                <th colspan="2">Physical Examination</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:50%;">Color</td>
                                    <td style="width:50%;"><?php echo $profile->colour; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Appearance</td>
                                    <td style="width:50%;"><?php echo $profile->appearance; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Deposit</td>
                                    <td style="width:50%;"><?php echo $profile->deposit; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Reaction</td>
                                    <td style="width:50%;"><?php echo $profile->reaction; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Specific gravity</td>
                                    <td style="width:50%;"><?php echo $profile->specificgravity; ?></td>
                                    
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
                                    <td style="width:50%;">Albunium</td>
                                    <td style="width:50%;"><?php echo $profile->albunium; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Sugar</td>
                                    <td style="width:50%;"><?php echo $profile->sugar; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Ketone</td>
                                    <td style="width:50%;"><?php echo $profile->ketone; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Bilesalts</td>
                                    <td style="width:50%;"><?php echo $profile->bilesalts; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Bile pigmetics</td>
                                    <td style="width:50%;"><?php echo $profile->bilepigmetics; ?></td>
                                    
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
                                    <td style="width:50%;">Puscells</td>
                                    <td style="width:50%;"><?php echo $profile->puscells; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Epithelial</td>
                                    <td style="width:50%;"><?php echo $profile->epithelial; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Casts</td>
                                    <td style="width:50%;"><?php echo $profile->casts; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Crystals</td>
                                    <td style="width:50%;"><?php echo $profile->crystals; ?></td>
                                    
                                </tr>
                                <tr>
                                    <td style="width:50%;">Bacteria</td>
                                    <td style="width:50%;"><?php echo $profile->bacteria; ?></td>
                                    
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

