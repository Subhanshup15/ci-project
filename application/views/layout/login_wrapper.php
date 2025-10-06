<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

//get site_align setting

$settings = $this->db->select("site_align")

    ->get('setting')

    ->row();

?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= display('login') ?> - <?php echo (!empty($title)?$title:null) ?></title>


        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo (!empty($favicon)?$favicon:null) ?>">
        <!-- Bootstrap --> 
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
            
        <?php } ?>
        
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/fonts/iconic/css/material-design-iconic-font.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/vendor/animate/animate.css">
        <!--===============================================================================================-->	
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/css/util.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/loginv6/css/main.css">
        <!--===============================================================================================-->

        <!-- style css -->
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>

        

    </head>

    <body style="background-image: url('<?php echo base_url('assets/images/bgImage.jpg')?>');  background-attachment: fixed; background-repeat: no-repeat; background-size: cover; background-position: center;">

        <!-- Content Wrapper -->

        <div class="login-wrapper"> 

            <div class="container-center" style=" border-top: 0px;">

                <div class="panel panel-bd" style="margin-right: 100%; margin-top: -80px; width:80%; border: 0px; opacity:0.8;box-shadow:20px 20px 20px 20px rgba(0, 0, 0,1);overflow: visible;" >

                    <div class="panel-heading" style="background-color: transparent; border-bottom:0px;">

                        <div class="view-header">

                            <div class="header-icon">

                                <i class="pe-7s-unlock"></i>

                            </div>

                            <div class="header-title" style="text-align: center; margin-left:0px;">

                                <b><h3><?php echo (!empty($title)?$title:null) ?></h3></b>

                                <small><strong><?= display('please_login') ?></strong></small>

                            </div>

                        </div>

                        <div class="">

                            

                            <!-- alert message -->

                            <?php if ($this->session->flashdata('message') != null) {  ?>

                            <div class="alert alert-info alert-dismissable">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                <?php echo $this->session->flashdata('message'); ?>

                            </div> 

                            <?php } ?>

                            

                            <?php if ($this->session->flashdata('exception') != null) {  ?>

                            <div class="alert alert-danger alert-dismissable">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                <?php echo $this->session->flashdata('exception'); ?>

                            </div>

                            <?php } ?>

                            

                            <?php if (validation_errors()) {  ?>

                            <div class="alert alert-danger alert-dismissable">

                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                <?php echo validation_errors(); ?>

                            </div>

                            <?php } ?> 

                        </div>

                    </div>





                    <div class="panel-body">

                        <?php echo form_open('login','id="loginForm" novalidate'); ?>
                        
                            <div class="wrap-input100 validate-input m-t-20 m-b-30" data-validate = "Enter Email">
        						<input class="input100" type="text" name="email" id="email">
        						<span class="focus-input100" data-placeholder="Email"></span>
        					</div>
                            
                            <div class="wrap-input100 validate-input m-t-20 m-b-30" data-validate = "Enter Password">
        						<input class="input100" type="password" name="password" id="password">
        						<span class="focus-input100" data-placeholder="Password"></span>
        					</div>
        					<div class= "wrap-input100 col-sm-12">
        					    <div class= "row">
                                    <!--<div class="col-sm-6 validate-input m-t-20 m-b-30" data-validate = "User Role">-->
                                    <!--    <select class="input100" id="user_role" name="user_role">-->
                                    <!--    <option value="" selected>User Role</option>-->
                                    <!--    <option value="1">admin</option>-->
                                    <!--    <option value="2">doctor</option>-->
                                    <!--    <option value="3">accountant</option>-->
                                    <!--    <option value="4">laboratorist</option>-->
                                    <!--    <option value="5">nurse</option>-->
                                    <!--    <option value="6">pharmacist</option>-->
                                    <!--    <option value="7">receptionist</option>-->
                                    <!--    <option value="8">representative</option>-->
                                    <!--    <option value="9">case_manager</option>-->
                                    <!--    <option value="10">patient</option>-->
                                    <!--    </select>-->
                                    <!--</div>-->
        					        <div class="col-sm-6 validate-input m-t-20 m-b-30" data-validate = "Ac-Year">
                					    <select class="input100" id="acyear" name="acyear">
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>         
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>    
                                            <option value="2023" selected>2023</option>   
                                             <option value="2024" selected>2024</option> 
                                             <option value="2025" selected>2025</option> 
                                        </select>
        					        </div>
        					    </div>
        					</div>
        					
        					
        					
        					

                            <!--<div class="form-group">

                                <label class="control-label" for="email"><?= display('email') ?></label>

                                <input type="text" placeholder="<?= display('email') ?>" name="email" id="email" class="form-control"> 

                            </div>-->

                            <!--<div class="form-group">

                                <label class="control-label" for="password"><?= display('password') ?></label>

                                <input type="password"  placeholder="<?= display('password') ?>" name="password" id="password" class="form-control"> 

                            </div>-->

                            <!--<div class="form-group">

                                <label class="control-label" for="user_role"><?= display('user_role') ?></label>

                                <//?php

                                    $userRoles = array(

                                        ''  => display('select_user_role'),

                                        '1' => display('admin'),

                                        '2' => display('doctor'),

                                        '3' => display('accountant'),

                                        '4' => display('laboratorist'),

                                        '5' => display('nurse'),

                                        '6' => display('pharmacist'),

                                        '7' => display('receptionist'),

                                        '8' => display('representative'), 

                                        '9' => display('case_manager'), 

                                        '10' => display('patient'),
                                        
                                        '11' => "Xray"

                                    );

                                    echo form_dropdown('user_role', $userRoles, $user->user_role, 'class="form-control" id="user_role" ');



                                ?>

                            </div> -->


                            
                            <!--<div class="form-group">

                                <label class="control-label" for="acyear">Select Acadmic Year</label>
                                <select class="form-control" id="acyear" name="acyear">
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>         
                                    <option value="2020">2020</option>
                                    <option value="2021" selected>2021</option>    
                                </select>    
                                

                            </div>        -->


                            <div class="container-login100-form-btn" style="opacity: 1;">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
                            <!--<div class="container-login100-form-btn"> 

                                <button  type="submit" class="btn btn-success"><?= display('login') ?></button> 

                            </div>
-->
                        </form>

                    </div>

                </div>

            </div>

        </div>
        
        
	
        <!-- /.content-wrapper -->

        <script src="<?php echo base_url('assets/js/app/app.js')?>" type="text/javascript">></script>
        <script src="<?php echo base_url('assets/js/vendor/all.js')?>" type="text/javascript">></script>                           

        <!-- jQuery -->

        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>

        <!-- bootstrap js -->



        <script type="text/javascript">

        $(document).ready(function() {
            
            $('#email').click();

            var info = $('table tbody tr');

            info.click(function() {

                var email    = $(this).children().first().text(); 

                var password = $(this).children().first().next().text();

                var user_role = $(this).attr('data-role');  



                $("input[name=email]").val(email);

                $("input[name=password]").val(password);

                $('select option[value='+user_role+']').attr("selected", "selected"); 

            });

        });

        </script>
        
        
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/bootstrap/js/popper.js"></script>
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/daterangepicker/moment.min.js"></script>
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        	<script src="<?php echo base_url(); ?>assets/loginv6/js/main.js"></script>



    </body>

</html>