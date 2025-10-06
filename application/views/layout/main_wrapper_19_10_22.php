<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
//get site_align setting
$settings = $this->db->select("site_align")
    ->get('setting')
    ->row();   

 $departments = $this->db->select("*")

                ->from("department")

                ->order_by('dprt_id','desc')

                ->get()

                ->result();  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php echo $this->session->userdata('title') ?></title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?= base_url($this->session->userdata('favicon')) ?>">

        <!-- jquery ui css -->
        <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Bootstrap --> 
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        

        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>



        <!-- Font Awesome 4.7.0 -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- semantic css -->
        <link href="<?php echo base_url(); ?>assets/css/semantic.min.css" rel="stylesheet" type="text/css"/> 
        <!-- sliderAccess css -->
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
        <!-- slider  -->
        <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
        <!-- DataTables CSS -->
        <link href="<?= base_url('assets/datatables/css/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
  

        <!-- pe-icon-7-stroke -->
        <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- themify icon css -->
        <link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- Pace css -->
        <link href="<?php echo base_url('assets/css/flash.css') ?>" rel="stylesheet" type="text/css"/>

        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
        <?php if (!empty($settings->site_align) && $settings->site_align == "RTL") {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>       


        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        

    </head>

    <body class="hold-transition sidebar-mini">
        <!--div class="se-pre-con"></div-->

        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header"> 

                <?php $logo = $this->session->userdata('logo'); ?>
               <!-- <a href="<?php echo base_url('dashboard/home') ?>" class="logo"> <!-- Logo 
                    <span class="logo-mini">
                        <img src="http://www.brharneayurved.com/img/logo.png" alt="">
                    </span>
                    <span class="logo-lg">
                        <img src="http://www.brharneayurved.com/img/logo.png" alt="">
                    </span>
                </a>-->
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="pe-7s-keypad"></span>
                    </a>

                    

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- settings -->
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('dashboard/profile'); ?>"><i class="pe-7s-users"></i> <?php echo display('profile') ?></a></li>
                                    <li><a href="<?php echo base_url('dashboard/form'); ?>"><i class="pe-7s-settings"></i> <?php echo display('edit_profile') ?></a></li>
                                    <?php if('user_role' != '2-10'){ ?>
                                    <li><a href="<?php echo base_url('setting'); ?>"><i class="pe-7s-settings"></i> <?php echo display('Setting') ?></a></li>
                                    <?php }?>
                                    <li><a href="<?php echo base_url('logout') ?>"><i class="pe-7s-key"></i> <?php echo display('logout') ?></a></li>
                                    <li><span style="text-align: center;">AYear - <?php  print_r($this->session->userdata('acyear')); ?></span></li>
                                </ul>
                            </li>
                           </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel text-center">
                        <?php $picture = $this->session->userdata('picture'); ?>
                        <div class="image">
                            <!--<img src="https://admin-blog.housejoy.in/wp-content/uploads/2016/12/ayurvedic_blog_header.jpg" class="img-circle" alt="User Image">-->
                            <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" />
                            <!--“/home/m0labn2gb1i3/public_html/matoshriayurvedhospital/application/views/layout/Images”.-->
                            
                        </div>
                        <div class="info">
                            
                            <p> <?php 
                            
                            echo nl2br($this->session->userdata('title'));
                            
                            
                            /*$str = $this->session->userdata('title');
                                      $word= "MEDICAL";
                                        if (strpos($str, $word) === false) {
                                            echo "<br>";
                                        } */
                            
                            ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i>
                            <?php   
                                $userRoles = array( 
                                    '1' => display('admin'),
                                    '2' => display('doctor'),
                                    '3' => display('accountant'),
                                    '4' => display('laboratorist'),
                                    '5' => display('nurse'),
                                    '6' => display('pharmacist'),
                                    '7' => display('receptionist'),
                                    '8' => display('representative'), 
                                    '9' => display('case_manager'),
                                    '4' => "Xray" 
                                ); 
                                echo $userRoles[$this->session->userdata('user_role')];
                                $user_role_id = $this->session->userdata('user_role');
                                $user_department_id = $this->session->userdata('department_id');
                            ?></a>
                        </div>
                    </div> 

                    <!-- sidebar menu -->
                    <ul class="sidebar-menu"> 

                        <li class="<?php echo (($this->uri->segment(1) == 'dashboard') ? "active" : null) ?>">
                            <a style="color: #8fd35c;" href="<?php echo base_url('dashboard/home') ?>"><i class="fa fa ti-home"></i> <?php echo display('dashboard') ?></a>
                        </li> 
                        <?php if($user_role_id=='1'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "department") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-sitemap"></i> <span><?php echo display('department') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("department/create") ?>"><?php echo display('add_department') ?></a></li>
                                <li><a href="<?php echo base_url("department") ?>"><?php echo display('department_list') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "dignosis") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-sitemap"></i> <span>Nidan</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url("dignosis/createdignosis") ?>">Add Nidan</a></li>
                                <li><a href="<?//php echo base_url("dignosis/create_sub_dignosis") ?>">Add Sub Cat</a></li>
                                <li><a href="<?//php echo base_url("dignosis/create_treatment") ?>">Add Treatment</a></li>-->
                                <li><a href="<?php echo base_url("dignosis") ?>">Dignosis List</a></li> 
                                <!--<li><a href="<?//php echo base_url("dignosis/list_sub_cat") ?>">Dignosis Category List</a></li>--> 
                                <li><a href="<?php echo base_url("dignosis/list_treatment") ?>">Treatment List</a></li> 
                            </ul>
                        </li>
                        <?php } ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "doctor") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-user-md"></i> <span><?php echo display('doctor') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if($user_role_id=='1'){ ?>
                                <li><a href="<?php echo base_url("doctor/create") ?>"><?php echo display('add_doctor') ?></a></li>
                                <?php } ?>
                                <li><a href="<?php echo base_url("doctor") ?>"><?php echo display('doctor_list') ?></a></li> 
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "patient") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-wheelchair"></i> <span><?php echo display('patient') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if($user_role_id=='1' || $user_role_id=='7'){ ?>
                                <li><a href="<?php echo base_url("patients/create") ?>"><?php echo display('add_patient') ?></a></li>
                                <!-- <li><a href="<?php echo base_url("patients/create1") ?>"><?php echo display('add_patient') ?></a></li>-->
                                <li><a href="<?php echo base_url("patientList/opd") ?>">Central OPD Patient</a></li> 
                                <li><a href="<?php echo base_url("patientList/ipd") ?>">Central IPD Patient</a></li> 
                                  
                                <li><a href="<?php echo base_url("patients/admitpatient") ?>">Admit Patient</a></li>
                                <li><a href="<?php echo base_url("patients/patientdischargedate") ?>">Discharge Patient</a></li> 
                                <li><a href="<?php echo base_url("patients/patientoccupancy") ?>">Occupancy Register</a></li> 
                                <?php } ?>
                                <?php if($user_role_id=='1'){ ?>
                                <li><a href="<?php echo base_url("patients/case_paper_print/opd") ?>">OPD Case Paper Print</a></li> 
                                <li><a href="<?php echo base_url("patients/case_paper_print/ipd") ?>">IPD Case Paper Print</a></li>
                                
                                <li><a href="<?php echo base_url("patients/patient_summery") ?>">Patient Summery</a></li>
                                
                                <li><a href="<?php echo base_url("patients/get_all_bills/opd") ?>">OPD Bills Print</a></li>
                                <li><a href="<?php echo base_url("patients/get_all_ipd_bills/ipd") ?>">IPD Bills Print</a></li>
                                <li><a href="<?php echo base_url("patients/get_monthly_bill_report") ?>">Monthly Bills Report</a></li>
                                <li><a href="<?php echo base_url("patients/get_bill_summery_report") ?>">Bills Summery Report</a></li>
                                <?php } ?>
                                <!--<li><a href="<?php echo base_url("patients/document") ?>"><?php echo display('document_list') ?></a></li>  -->
                            </ul>
                        </li> 
                        <?php if($user_role_id=='1'){ ?>
                        <li class="treeview <?php  echo (($this->uri->segment(1) == "bed_manager") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-bed"></i> <span><?php echo display('bed_manager') ?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                              <!--  <li><a href="<?php echo base_url("bed_manager/bed/form") ?>"><?php echo display('add_bed') ?></a></li> -->
                                <li><a href="<?php echo base_url("bed_manager/bed") ?>"><?php echo display('bed_list') ?></a></li> 
                                <!--<li><a href="<?php echo base_url("bed_manager/bed_assign/create") ?>"><?php echo display('bed_assign') ?></a></li> 
                                <li><a href="<?php echo base_url("bed_manager/bed_assign") ?>"><?php echo display('bed_assign_list') ?></a></li> -->
                                <li><a href="<?php echo base_url("bedList/ipd") ?>"><?php echo display('bed_assign_list') ?></a></li> 
                              <!--  <li><a href="<?php echo base_url("bed_manager/report") ?>"><?php echo display('report') ?></a></li> -->
                            </ul>
                        </li>

                        <li class="treeview <?php echo (($this->uri->segment(1) == "hospital_activities") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-hospital-o"></i> <span><?php echo display('hospital_activities') ?> </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('hospital_activities/birth/form') ?>"> <?php echo display('add_birth_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/birth/index') ?>"><?php echo display('birth_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/death/form') ?>"> <?php echo display('add_death_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/death/index') ?>"><?php echo display('death_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/operation/form') ?>"> <?php echo display('add_operation_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/operation/index') ?>"><?php echo display('operation_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/investigation/form') ?>"> <?php echo display('add_investigation_report') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/investigation/index') ?>"><?php echo display('investigation_report') ?></a></li>


                                <li><a href="<?php echo base_url('hospital_activities/category/form') ?>"> <?php echo display('add_medicine_category') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/category/index') ?>"><?php echo display('medicine_category_list') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/medicine/form') ?>"> <?php echo display('add_medicine') ?></a></li>
                                <li><a href="<?php echo base_url('hospital_activities/medicine/index') ?>"><?php echo display('medicine_list') ?></a></li>
                            </ul>
                        </li> 
                         
                        <li class="treeview  <?php echo (($this->uri->segment(1) == "human_resources") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-users"></i> <span><?php echo display('human_resources') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("human_resources/employee/form") ?>"><?php echo display('add_employee') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/accountant") ?>"><?php echo display('accountant_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/laboratorist") ?>"><?php echo display('laboratorist_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/nurse") ?>"><?php echo display('nurse_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/pharmacist") ?>"><?php echo display('pharmacist_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/receptionist") ?>"><?php echo display('receptionist_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/representative") ?>"><?php echo display('representative_list') ?></a></li>
                                <li><a href="<?php echo base_url("human_resources/employee/index/case_manager") ?>"><?php echo display('case_manager_list') ?></a></li>
                            </ul>
                        </li> 
                        <?php } ?>
                        <?php if($user_role_id=='1' || $user_role_id=='2' || $user_role_id=='5'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "gob") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-wheelchair"></i> <span>GOB</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php if($user_role_id=='1' || $user_role_id=='5'){ ?>
                                <li><a href="<?php echo base_url("patients/getpatientbydepartment_gob1")?>">GOB IPD Patient</a></li> 
                                <?php } ?>
                                <?php if($user_role_id=='1' || $user_role_id=='2' || $user_role_id=='5'){ ?>
                                <li>
                                    <a href="#"><i class="fa fa-stethoscope"></i> <span>D-IPD GOB</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <?php foreach ($departments as $department) { ?>
                                            <!--<li>-->
                                            <!--    <a href="<?//php echo base_url("patients/getpatientbydepartment_gob_dept/"); echo $department->dprt_id;?>/ipd"><?//php if($department->description=='Swasthrakshnam'){ echo $department->description.""; } else { echo $department->description; }?></a>-->
                                            <!--<li>    -->
                                            <?php if($user_department_id == $department->dprt_id || $user_role_id=='1' || $user_role_id=='5'){ ?>
                                                <?php if(($department->description != 'Aatyaika') && ($department->description != 'Swasthrakshnam') && ( $department->description != 'Shalakyatantra')){?>
                                                    <li>
                                                        <a href="<?php echo base_url("patients/getpatientbydepartment_gob_dept/"); echo $department->dprt_id;?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                                    <li>    
                                                <?php }else if($department->description =='Shalakyatantra') {?>
                                                    <li>
                                                        <a href="<?php echo base_url("patients/getpatientbydepartment_gob_dept/"); echo $department->dprt_id;?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                                    <li>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>  
                                    </ul> 
                                </li>
                                <?php } ?>
                            </ul>
                        </li> 
                        <?php } ?>
                        <?php if($user_role_id=='1' || $user_role_id=='2'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "opd") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-stethoscope"></i> <span>D-OPD</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php foreach ($departments as $department) { ?>
                                    <?php if($user_department_id == $department->dprt_id || $user_role_id=='1'){ ?>
                                        <?php if($department->description=='Shalakyatantra'){ ?>
                                        <li>
                                            <a href="<?php echo base_url("patients/getpatientbydepartment_sky1/$department->dprt_id");?>/opd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description.""; } else { echo $department->description; } ?></a>
                                        <li> 
                                        <?php } else {?>
                                        <li>
                                            <a href="<?php echo base_url("patients/getpatientbydepartment1/$department->dprt_id");?>/opd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description.""; } else { echo $department->description; } ?></a>
                                        <li>    
                                        <?php } ?> 
                                    <?php } ?>
                                <?php } ?>
                            </ul>    
                        </li>
                        <?php } ?>
                        <!--<li class="treeview <?php echo (($this->uri->segment(1) == "opd") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-stethoscope"></i> <span>D-OPD KARMA/PANCH</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php foreach ($departments as $department) { ?>
                                    <li>
                                        <a href="<?php echo base_url("patients/getpatientbydepartment_karma/$department->dprt_id");?>/opd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; } ?></a>
                                    <li>    
                                <?php } ?>  
                            </ul>    
                        </li>-->
                        <?php if($user_role_id=='1' || $user_role_id=='2' || $user_role_id=='5'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "ipd") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-plus-square"></i> <span>D-IPD</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php foreach ($departments as $department) { ?>
                                    <?php if($user_department_id == $department->dprt_id || $user_role_id=='1' || $user_role_id=='5'){ ?>
                                        <?php if(($department->description != 'Aatyaika') && ($department->description != 'Swasthrakshnam') && ( $department->description != 'Shalakyatantra')){?>
                                            <li>
                                                <a href="<?php echo base_url("patients/getpatientbydepartment/"); echo $department->dprt_id;?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                            <li>    
                                        <?php } else if($department->description =='Shalakyatantra') {?>
                                            <li>
                                                <a href="<?php echo base_url("patients/getpatientbydepartment_sky/"); echo $department->dprt_id;?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                            <li>
                                        <?php } ?>
                                    <?php } ?>
                               <?php } ?>    
                            </ul>    
                        </li>
                        <?php } ?>
                        <?php if($user_role_id=='1' || $user_role_id=='2'){ ?>
                         <li class="treeview <?php echo (($this->uri->segment(1) == "ipd") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-plus-square"></i> <span>D-IPD Admit Register</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php foreach ($departments as $department) { ?>
                                    <?php if($user_department_id == $department->dprt_id || $user_role_id=='1'){ ?>
                                        <?php if(($department->description != 'Aatyaika') && ($department->description != 'Swasthrakshnam') && ( $department->description != 'Shalakyatantra')){?>
                                            <li>
                                                <a href="<?php echo base_url("patients/getpatientbydepartment_admit_register/"); echo $department->dprt_id;?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                            <li>    
                                        <?php }else if($department->description =='Shalakyatantra') {?>
                                            <li>
                                                <a href="<?php echo base_url("patients/getpatientbydepartment_admit_register/"); echo $department->dprt_id;?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                            <li>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>   
                            </ul>    
                        </li>
                        <?php } ?>
                        
                        
                        <!--<li class="treeview <?php echo (($this->uri->segment(1) == "opd") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa-stethoscope"></i> <span>D-IPD KARMA/PANCH</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <?php foreach ($departments as $department) { ?>
                                    <li>
                                        <a href="<?php echo base_url("patients/getpatientbydepartment_karma/$department->dprt_id");?>/ipd"><?php if($department->description=='Swasthrakshnam'){ echo $department->description." -KC"; } else { echo $department->description; }?></a>
                                    <li>    
                                <?php } ?>  
                            </ul>    
                        </li>-->
                        <!--==============================================================================-->
                        <!--<li class="<?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">-->
                        <!--    <a href="<?php echo base_url('patients/getpatientbydepartment_karma');?>/opd"><i class="fa fa ti-home"></i>OPD  Panchkarma Register</a>-->
                        <!--</li> -->
                        <!--<li class="<?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">-->
                        <!--    <a href="<?php echo base_url('patients/getpatientbydepartment_karma');?>/ipd"><i class="fa fa ti-home"></i>IPD Panchkarma Register</a>-->
                        <!--</li> -->
                        <!--==============================================================================-->
                        
                        <?php if($user_role_id=='1'){ ?>
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD Panchkarma Procedure" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientbydepartment_karma');?>/opd">Procedure Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/pt/y");?>">Procedure Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/pt/d");?>">Procedure Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/pt/m");?>">Procedure Month wise<br>Count Report</a></li>

                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/te");?>">OPD Panchakarma Testwise<br>Count Report</a></li>-->
                                
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span style="text-align:center;"><?php echo "OPD Other Panchkarma <br>&emsp;&emsp; Procedure" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                
                                <li><a href="<?php echo base_url('patients/getpatientbydepartment_karma_other');?>/opd">Other Procedure Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/pt/y/o");?>">Other Procedure Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/pt/d/o");?>">Other Procedure Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/pt/m/o");?>">Other Procedure Month wise<br>Count Report</a></li>
                                
                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/te");?>">OPD Panchakarma Testwise<br>Count Report</a></li>-->
                                
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD Panchkarma Procedure" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientbydepartment_karma');?>/ipd">Procedure Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/pt/y");?>">Procedure Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/pt/d");?>">Procedure Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/pt/m");?>">Procedure Month wise<br>Count Report</a></li>

                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/te");?>">Testwise Count</a></li>-->
                                
                            </ul>
                        </li> 
                        
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span style="text-align:center;"><?php echo "IPD Other Panchkarma <br>&emsp;&emsp; Procedure" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientbydepartment_karma_other');?>/ipd">Other Procedure Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/pt/y/o");?>">Other Procedure Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/pt/d/o");?>">Other Procedure Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/pt/m/o");?>">Other Procedure Month wise<br>Count Report</a></li>
                                
                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/te");?>">Testwise Count</a></li>-->
                                
                            </ul>
                        </li> 
                        
                        <!--<li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD Investigation" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientby_investigation');?>/opd">Investigation Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/pt/y");?>">Investigation Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/pt/d");?>">Investigation Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/pt/m");?>">Investigation Month wise<br>Count Report</a></li>
                                
                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/te");?>">OPD Panchakarma Testwise<br>Count Report</a></li>
                                
                            </ul>
                        </li> -->
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD Investigation Testwise" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientby_investigation_testwise');?>/opd">Testwise Investigation Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/te/y");?>">Investigation Test Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/te/d");?>">Investigation Test Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/te/m");?>">Investigation Test Month wise<br>Count Report</a></li>
                                
                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/panch/te");?>">OPD Panchakarma Testwise<br>Count Report</a></li>-->
                                
                            </ul>
                        </li> 
                       <!-- <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD Investigation" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientby_investigation');?>/ipd">Investigation Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/pt/y");?>">Investigation Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/pt/d");?>">Investigation Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/pt/m");?>">Investigation Month wise<br>Count Report</a></li>
                                
                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/te");?>">Testwise Count</a></li>
                                
                            </ul>
                        </li> -->
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD Investigation Testwise" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url('patients/getpatientby_investigation_testwise');?>/ipd">Testwise Investigation Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/te/y");?>">Investigation Test Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/te/d");?>">Investigation Test Date wise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/te/m");?>">Investigation Test Month wise<br>Count Report</a></li>
                                
                                <!--<li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/panch/te");?>">Testwise Count</a></li>-->
                                
                            </ul>
                        </li>
                        
                         <!--=======================  X-Ray ========================-->
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD X-Ray Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_xray_investigation');?>/opd">X-Ray Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_xray/opd');?>">X-Ray Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/xray_investi/pt/y");?>">X-Ray Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/xray_investi/pt/d");?>">X-Ray Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/xray_investi/pt/m");?>">X-Ray Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD Testwise X-Ray<br>&emsp;&emsp;Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_xray_investigation_testwise');?>/opd">Testwise X-Ray Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_xray_testwise/opd');?>">Testwise X-Ray Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/xray_investi/te/y");?>">X-Ray Test Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/xray_investi/te/d");?>">X-Ray Test Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/xray_investi/te/m");?>">X-Ray Test Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD X-Ray Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_xray_investigation');?>/ipd">X-Ray Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_xray/ipd');?>">X-Ray Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/xray_investi/pt/y");?>">X-Ray Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/xray_investi/pt/d");?>">X-Ray Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/xray_investi/pt/m");?>">X-Ray Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD Testwise X-Ray<br>&emsp;&emsp;Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_xray_investigation_testwise');?>/ipd">Testwise X-Ray Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_xray_testwise/ipd');?>">Testwise X-Ray Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/xray_investi/te/y");?>">X-Ray Test Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/xray_investi/te/d");?>">X-Ray Test Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/xray_investi/te/m");?>">X-Ray Test Month wise Count<br>Report</a></li>
                            </ul>
                        </li>
                        <!--=======================  ECG ========================-->
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD ECG Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_ecg_investigation');?>/opd">ECG Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_ecg/opd');?>">ECG Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/ecg_investi/pt/y");?>">ECG Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/ecg_investi/pt/d");?>">ECG Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/ecg_investi/pt/m");?>">ECG Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD ECG Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_ecg_investigation');?>/ipd">ECG Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_ecg/ipd');?>">ECG Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/ecg_investi/pt/y");?>">ECG Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/ecg_investi/pt/d");?>">ECG Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/ecg_investi/pt/m");?>">ECG Month wise Count<br>Report</a></li>
                            </ul>
                        </li>
                        <!--=======================  USG ========================-->
                         <!-- <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "Investigation<br>&emsp;&emsp;Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_usg_investigation_testwise');?>/ipd">Testwise USG Register</a></li>
                                <li><a href="<?php echo base_url('patients/get_haematology_patients');?>">Haematology Report</a></li>
                                <li><a href="<?php echo base_url("patients/get_seriology_patients");?>">Seriology Report</a></li>
                                <li><a href="<?php echo base_url("patients/get_biochemistry_patients");?>">Biochemical Report</a></li>
                                <li><a href="<?php echo base_url("patients/get_microbiology_patients");?>">Microbiology Report</a></li>
                            </ul>
                        </li>-->
                        
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD USG Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_usg_investigation');?>/opd">USG Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_usg/opd');?>">USG Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/usg_investi/pt/y");?>">USG Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/usg_investi/pt/d");?>">USG Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/usg_investi/pt/m");?>">USG Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'opd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "OPD Testwise USG<br>&emsp;&emsp;Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_usg_investigation_testwise');?>/opd">Testwise USG Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_usg_testwise/opd');?>">Testwise USG Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/usg_investi/te/y");?>">USG Test Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/usg_investi/te/d");?>">USG Test Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/usg_investi/te/m");?>">USG Test Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD USG Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_usg_investigation');?>/ipd">USG Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_usg/ipd');?>">USG Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/usg_investi/pt/y");?>">USG Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/usg_investi/pt/d");?>">USG Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/usg_investi/pt/m");?>">USG Month wise Count<br>Report</a></li>
                            </ul>
                        </li> 
                        <li class="treeview  <?php echo (($this->uri->segment(1) == 'ipd') ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-home"></i> <span><?php echo "IPD Testwise USG<br>&emsp;&emsp;Register Reports" ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php echo base_url('patients/getpatientby_usg_investigation_testwise');?>/ipd">Testwise USG Register</a></li>-->
                                <li><a href="<?php echo base_url('patients/getInvestigation_register_usg_testwise/ipd');?>">Testwise USG Register</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/usg_investi/te/y");?>">USG Test Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/usg_investi/te/d");?>">USG Test Date wise Count<br>Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/usg_investi/te/m");?>">USG Test Month wise Count<br>Report</a></li>
                            </ul>
                        </li>
                        
                        <?php } ?>
                        
                        <?php if($user_role_id=='1' || $user_role_id=='6'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(2) == "pharma") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-pencil-alt"></i> PHARMA
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            
                            <ul class="treeview-menu">
                                <!--<li><a href="<?//php  echo base_url("patients/pharma/churna/opd") ?>">Churna(Powder)/ Tablet OPD</a></li>-->
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_ipd/churna/ipd") ?>">Churna(Powder)Tablet IPD</a></li>-->
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_Month/churna/opd") ?>">Pharma Month OPD Report</a></li>-->
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_Month/churna/ipd") ?>">Pharma Month IPD Report</a></li>-->
                                
                              
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_year/churna/opd") ?>">Pharma Yearly OPD Report</a></li>-->
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_year/churna/ipd") ?>">Pharma Yearly IPD Report</a></li>-->
                                
                                <!--<?php  $start_date = date('Y-m-d'); $end_date = date('Y-m-d');?>-->
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_date_Despensing/churna/opd/0/$start_date/$end_date") ?>">Despensing Churna(Powder)/ Tablet OPD </a></li>-->
                                <!--<li><a href="<?//php  echo base_url("patients/pharma_ipd_date_Despensing/churna/ipd") ?>">Despensing Churna(Powder)Tablet IPD</a></li>-->
                                <li><a href="<?php  echo base_url("stock/despensePatientStock") ?>">Stock Despense Form</a></li>
                                <li><a href="<?php  echo base_url("stock/stock_report") ?>">Stock Report</a></li>
                                <li><a href="<?php  echo base_url("stock/stock_despense_report") ?>">Stock Despense Report</a></li>
                                <li><a href="<?php  echo base_url("stock/stock_import_report") ?>">Stock Import Report</a></li>
                                
                                <!-- <li><a href="<?php  echo base_url("patients/pharma/churna/ipd") ?>">Churna(Powder)-IPD</a></li>     
                                 <li><a href="<?php  echo base_url("patients/pharma/tablet/ipd") ?>">Tablet -IPD</a></li>     -->
                            </ul>        
                        </li>    
                        <?php } ?>
                        <?php if($user_role_id=='1'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "report") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-pencil-alt"></i> Reports
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php  echo base_url("report/deptopd") ?>">Department wise Opd count</a></li>
                                <li><a href="<?php  echo base_url("report/deptipd") ?>">Department wise Ipd count</a></li>     
                                <li><a href="<?php  echo base_url("report/deptopddate") ?>">Date wise Opd count</a></li>
                                <li><a href="<?php  echo base_url("report/deptipddate") ?>">Date wise IPD count</a></li>
                                <li><a href="<?php  echo base_url("report/genderwisereport") ?>">Gender wise report</a></li>
                                <li><a href="<?php  echo base_url("report/genderwiseipdreport") ?>">Gender wise ipd report</a></li>
                                 <li><a href="<?php echo base_url("patients/getpatientby_garbhini");?>/opd">ANC (GARBHINI) Record Report</a></li>
                               <!-- <li><a href="<?php echo base_url("patients/getpatientby_investigation");?>/opd">Date wise Investigation</a></li>-->
                                <li><a href="<?php echo base_url("patients/getpatientby_month");?>/ipd">Month wise D-IPD Report</a></li>
                                <li><a href="<?php echo base_url("patients/getpatientby_month");?>/opd">Month wise D-OPD Report</a></li>
                               <!-- <li><a href="<?php echo base_url("patients/getpatientby_month_bed");?>/ipd">Month wise D-Occupancy Report</a></li>-->
                                <li><a href="<?php echo base_url("patients/patient_by_date_occupancy1111");?>">Month wise D-Occupancy Report</a></li>
                                <!--<li><a href="<?//php echo base_url("patients/bed_occupancy") ?>">Bed Occupancy Report</a></li> -->
                               <!--  <li><a href="<?php echo base_url('patients/panchkarma_ipd');?>/ipd">IPD Panchkarma Report</a> </li> -->
                                 
                                 <li><a href="<?php echo base_url("patients/getMukh_dant_data_sky/30/opd");?>">Month wise (Netra, Mukha Dant)<br>Shalakyatantra</a></li>
                                 
                                <li><a href="<?php echo base_url("patients/getpatientby_investigation_ceg");?>/opd">ECG Register</a></li> 
                                <li><a href="<?php echo base_url("patients/getpatientby_investigation_xray");?>/opd">X-RAY Register</a></li> 
                             <!--   <li><a href="#">HIV Register</a></li> -->
                                <li><a href="<?php echo base_url('patients/PHYSIOTHERAPY');?>/opd">PHYSIOTHERAPY Register</a> </li> 
                                <li><a href="<?php echo base_url('patients/Ksharsutra');?>/ipd">Ksharsutra Register</a> </li>
                                
                                <!--<li><a href="<?//php echo base_url('patients/ot');?>/ipd">Operation Theater Register</a> </li>-->
                                <li><a href="<?php echo base_url('patients/minor_ot');?>/ipd">Minor Operation Theater Register</a> </li>
                                <li><a href="<?php echo base_url('patients/major_ot');?>/ipd">Major Operation Theater Register</a> </li>
                                
                                <!--<li><a href="<?php echo base_url("patients/getpatientby_garbhini");?>/ipd">Delivery Register</a></li>-->
                                <li><a href="<?php echo base_url("patients/delivery_register");?>/ipd">Delivery Register</a></li>
                                <!--li><a href="<?php echo base_url("patients/Geriatric");?>/opd">Geriatric Diseases - OPD Register</a></li> 
                                <li><a href="<?php echo base_url("patients/National");?>/opd">National Health Programme Register</a></li> 
                                <li><a href="<?php echo base_url("patients/Manas");?>/opd">Manas Rog Register</a></li> 
                                <li><a href="<?php echo base_url("patients/Skin");?>/opd">Skin OPD Register</a></li> 
                                
                                <li><a href="<?php  echo base_url("patients/pharma_Month/churna/opd") ?>">Pharma Month Report</a></li>
                                
                                
                                <li><a href="<?php echo base_url("patients/despensing/opd");?>">OPD Despensing Register</a></li>
                                <li><a href="<?php echo base_url("patients/despensing/ipd");?>">IPD Despensing Register</a></li>
                                -->
                               <!-- <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/pt");?>">OPD Investigation Patientwise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/pt");?>">IPD Investigation Patientwise<br>Count Report</a></li>
                                
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/opd/investi/te");?>">OPD Investigation Testwise<br>Count Report</a></li>
                                <li><a href="<?php echo base_url("report/getInvestiPanchCount/ipd/investi/te");?>">IPD Investigation Testwise<br>Count Report</a></li>-->
                                
                                <li><a href="<?php  echo base_url("report/dept_gender_ipd_occupancy_summery_report") ?>">Departmentwise Male / Female<br>IPD Occupancy Summery Report</a></li>
                                
                                <!-- <li><a href="<?php  echo base_url("report/labcount") ?>">Lab count report</a></li> -->
                               <!-- <li><a href="<?php  echo base_url("report/assign_by_all") ?>"> <?php echo display('assign_by_all') ?> </a></li>
                                <li><a href="<?php  echo base_url("report/assign_by_all_doctor") ?>"><?php echo display('assign_by_doctor') ?> </a></li>                    
                                <li><a href="<?php  echo base_url("report/assign_by_all_representative") ?>"> <?php echo display('assign_by_representative') ?>  </a></li>
                                <li><a href="<?php  echo base_url("report/assign_to_all_doctor") ?>"> <?php echo display('assign_to_doctor') ?></a></li>  -->

                            </ul>        
                        </li> 
                        <?php } ?>
                        <?php if($user_role_id=='1' || $user_role_id=='4'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "laboratory") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-pencil-alt"></i> Laboratory
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("urineexamination/create") ?>">Add Urine Examination 1</a></li>
                                <!-- <li><a href="<?php echo base_url("hemogram/create") ?>">Add Haemogram Report 1</a></li> -->
                                <li><a href="<?php echo base_url("biochemical/create") ?>">Add Biochemical Test 1</a></li>

                                <li><a href="<?php echo base_url("laboratory/urineexamination") ?>">Add Urine Examination 2</a></li>
                                <li><a href="<?php echo base_url("laboratory/haemogram") ?>">Add Haemogram Report</a></li>
                                <li><a href="<?php echo base_url("laboratory/biochemical") ?>">Add Biochemical Test 2</a></li>
                                <li><a href="<?php echo base_url("laboratory/seological") ?>">Add Seological Test</a></li>
                                <li><a href="<?php echo base_url("laboratory/stool") ?>">Add Stool Examination Report</a></li>
                                <li><a href="<?php echo base_url("laboratory/semen") ?>">Add Semen Examination Report</a></li>

                                <li><a href="<?php echo base_url("urineexamination") ?>">List Urine Examination 1 </a></li>
                                <!-- <li><a href="<?php echo base_url("hemogram") ?>">List Haemogram Report 1</a></li> -->
                                <li><a href="<?php echo base_url("biochemical") ?>">List Biochemical Test 1</a></li>

                                <li><a href="<?php echo base_url("laboratory/listurineexamination") ?>">List Urine Examination 2 </a></li>
                               
                                <li><a href="<?php echo base_url("laboratory/listhaemogram") ?>">List Haemogram Report</a></li>
                                <li><a href="<?php echo base_url("laboratory/listbiochemical") ?>">List Biochemical Test 2</a></li>
                                <li><a href="<?php echo base_url("laboratory/listseological") ?>">List Seological Test</a></li>
                               
                                <li><a href="<?php echo base_url("laboratory/liststool") ?>">List Stool Examination Report</a></li>
                                <li><a href="<?php echo base_url("laboratory/listsemen") ?>">List Semen Examination Report</a></li>



                                <li><a href="<?php echo base_url("xray/create") ?>">Add Xray Report</a></li>
                                <li><a href="<?php echo base_url("xray") ?>">Xray List</a></li>
                            </ul>        
                        </li>  
                        <?php } ?>
                        <?php if($user_role_id=='1'){ ?>
                        <li class="treeview <?php  echo (($this->uri->segment(1) == "acyear" || $this->uri->segment(1) == "acyear") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-pencil-alt"></i> <span>Ac Year</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php  echo base_url("acyear/create") ?>">Add Acyear</a></li>
                                <li><a href="<?php  echo base_url("acyear") ?>">List Acyear</a></li> 
                            </ul>
                        </li>           

                        <li class="treeview <?php  echo (($this->uri->segment(1) == "appointment" || $this->uri->segment(1) == "report") ? "active" : null) ?>">
                            <a href="#">
                                <i class="fa fa ti-pencil-alt"></i> <span><?php echo display('appointment') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php  echo base_url("appointment/create") ?>"><?php echo display('add_appointment') ?></a></li>
                                <li><a href="<?php  echo base_url("appointment") ?>"><?php echo display('appointment_list') ?></a></li> 
                            </ul>
                        </li> 
                        <?php } ?>
                        <?php if($user_role_id=='1' || $user_role_id=='3'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "account_manager") ? "active" : null) ?>">

                                    <a href="#">

                                        <i class="fa fa-money"></i><span><?php echo display('account_manager') ?></span>

                                        <span class="pull-right-container">

                                            <i class="fa fa-angle-left pull-right"></i>

                                        </span>

                                    </a>

                                    <ul class="treeview-menu">

                                        <li><a href="<?php echo base_url("account_manager/account/create") ?>"><?php echo display('add_account') ?></a></li>

                                        <li><a href="<?php echo base_url("account_manager/account") ?>"><?php echo display('account_list') ?></a></li> 

                                        <li><a href="<?php echo base_url("account_manager/invoice/create") ?>"><?php echo display('add_invoice') ?></a></li>

                                        <li><a href="<?php echo base_url("account_manager/invoice") ?>"><?php echo display('invoice_list') ?></a></li> 

                                        <li><a href="<?php echo base_url("account_manager/payment/create") ?>"><?php echo display('add_payment') ?></a></li>

                                        <li><a href="<?php echo base_url("account_manager/payment") ?>"><?php echo display('payment_list') ?></a></li> 

                                        <li><a href="<?php echo base_url("account_manager/report") ?>"><?php echo display('report') ?></a></li>

                                        <li><a href="<?php echo base_url("account_manager/report/debit") ?>"><?php echo display('debit_report') ?></a></li> 

                                        <li><a href="<?php echo base_url("account_manager/report/credit") ?>"><?php echo display('credit_report') ?></a></li> 

                                    </ul>

                        </li>
                        <?php } ?>
                        <?php if($user_role_id=='1'){ ?>
                        <li class="treeview <?php echo (($this->uri->segment(1) == "messages") ? "active" : null) ?>">

                            <a href="#">

                                <i class="fa fa-comments-o"></i><span><?php echo display('messages') ?></span>

                                <span class="pull-right-container">

                                    <i class="fa fa-angle-left pull-right"></i>

                                </span>

                            </a> 

                            <ul class="treeview-menu">

                                <li><a href="<?php echo base_url("messages/message/new_message") ?>"> <?php echo display('new_message') ?> </a></li> 

                                <li><a href="<?php echo base_url("messages/message") ?>"> <?php echo display('inbox') ?> </a></li> 

                                <li><a href="<?php echo base_url("messages/message/sent") ?>"><?php echo display('sent') ?> </a></li>

                            </ul>

                        </li>





                        <li class="<?php echo (($this->uri->segment(1) == 'mail') ? "active" : null) ?>">

                            <a href="<?php echo base_url('mail/email') ?>"><i class="fa ti-email"></i> <?php echo display('send_mail') ?></a>

                        </li>  

                       
                        <?php $active =$this->uri->segment(2);?>
                        <li class="treeview <?php echo (($this->uri->segment(2) == 'data_limit') ? "active" : null) ?>">

                            <a href="#">

                                <i class="fa fa-database"></i><span> Daily Data Limit  For OPD</span>

                                <span class="pull-right-container">

                                    <i class="fa fa-angle-left pull-right"></i>

                                </span>

                            </a> 
                            
                       
                            <ul class="treeview-menu">

                               <li class="<?php echo (($this->uri->segment(2) == 'data_limit') ? "active" : null) ?>">

                               <a href="<?php echo base_url('department/data_limit') ?>"><i class="fa fa-database"></i> <?php echo "Patient limit";  ?></a>
                               
                              </li>
                              	
                              <li class="<?php echo (($this->uri->segment(2) == 'data_limit_dept_opd') ? "active" : null) ?>">

                              <a href="<?php echo base_url('department/data_limit_dept_opd') ?>"><i class="fa fa-user"></i> <?php echo "Department Data Limit(OPD)"; ?></a>

                              </li>
                              
                              <li class="<?php echo (($this->uri->segment(2) == 'add_holiday') ? "active" : null) ?>">

                              <a href="<?php echo base_url('department/add_holiday') ?>"><i class="fa-sun-o"></i> <?php echo "Add Holiday"; ?></a>

                              </li>
                              	
                             <!--<li class="<?php echo (($this->uri->segment(2) == 'deprt_kaya') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_kaya') ?>"><i class="fa fa-building-o"></i> <?php echo "Department - Kayachikitsa"; ?></a>

                             </li> 
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_panch') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_panch') ?>"><i class="fa fa-building-o"></i> <?php echo "Department - Panchkarma"; ?></a>

                             </li> 
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_bal') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_bal') ?>"><i class="fa fa-building-o"></i> <?php echo "Department -Balroga"; ?></a>

                             </li> 
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_shalya') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_shalya') ?>"><i class="fa fa-building-o"></i> <?php echo "Department -Shalyatantra"; ?></a>

                             </li>
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_shalakya') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_shalakya') ?>"><i class="fa fa-building-o"></i> <?php echo "Department -Shalakyatantra"; ?></a>

                             </li> 
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_stri') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_stri') ?>"><i class="fa fa-building-o"></i> <?php echo "Department -Striroga"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_swasth') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_swasth') ?>"><i class="fa fa-building-o"></i> <?php echo "Department -Swasthrakshnam"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_aatya') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_aatya') ?>"><i class="fa fa-building-o"></i> <?php echo "Department -Aatyaika"; ?></a>

                             </li>-->
                            </ul>
                           
                        </li>
                      


                     
                        <?php $active =$this->uri->segment(2);?>
                        <li class="treeview <?php echo (($this->uri->segment(2) == 'Admit_limit') ? "active" : null) ?>">

                            <a href="#">

                                <i class="fa fa-database"></i><span> Daily Data Limit For IPD </span>

                                <span class="pull-right-container">

                                    <i class="fa fa-angle-left pull-right"></i>

                                </span>

                            </a> 
                            
                       
                            <ul class="treeview-menu">

                               
                              <li class="<?php echo (($this->uri->segment(2) == 'Admit_limit') ? "active" : null) ?>">

                              <a href="<?php echo base_url('department/Admit_limit') ?>"><i class="fa fa-user"></i> <?php echo "Admit Patient"; ?></a>

                              </li> 
                              <li class="<?php echo (($this->uri->segment(2) == 'Discharge_limit') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/Discharge_limit') ?>"><i class="fa fa-user"></i> <?php echo "Discharge Patient"; ?></a>

                             </li> 
                             <li class="<?php echo (($this->uri->segment(2) == 'occupancy_limit') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/occupancy_limit') ?>"><i class="fa fa-user"></i> <?php echo "Occupancy Patient"; ?></a>

                             </li> 
                             <li class="<?php echo (($this->uri->segment(2) == 'data_limit_dept_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/data_limit_dept_ipd') ?>"><i class="fa fa-user"></i> <?php echo "Department Data Limit(IPD)"; ?></a>

                             </li>  
                             
                             <!--<li class="<?php echo (($this->uri->segment(2) == 'deprt_kaya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_kaya_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept - Kayachikitsa(Male)"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_kaya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_kaya_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept - Kayachikitsa(Female)"; ?></a>

                             </li> 
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_panch_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_panch_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept - Panchkarma(Male)"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_panch_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_panch_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept - Panchkarma(Female)"; ?></a>

                             </li>
                             
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_bal_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_bal_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Balroga(Male)"; ?></a>

                             </li> 
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_bal_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_bal_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Balroga(female)"; ?></a>

                             </li> 
                             
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_shalya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_shalya_ipd_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Shalyatantra(Male)"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_shalya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_shalya_ipd_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Shalyatantra(Female)"; ?></a>

                             </li>
                             
                             
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_shalakya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_shalakya_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Shalakyatantra(Male)"; ?></a>

                             </li> 
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_shalakya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_shalakya_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Shalakyatantra(Female)"; ?></a>

                             </li> 
                             
                             
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_stri_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_stri_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Striroga(Male)"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_stri_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_stri_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Striroga(Female)"; ?></a>

                             </li>
                             
                             
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_swasth_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_swasth_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Swasthrakshnam(Male)"; ?></a>

                             </li>
                              <li class="<?php echo (($this->uri->segment(2) == 'deprt_swasth_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_swasth_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Swasthrakshnam(Female)"; ?></a>

                             </li>
                             
                             
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_aatya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_aatya_ipd/m') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Aatyaika(Male)"; ?></a>

                             </li>
                             <li class="<?php echo (($this->uri->segment(2) == 'deprt_aatya_ipd') ? "active" : null) ?>">

                             <a href="<?php echo base_url('department/deprt_aatya_ipd/f') ?>"><i class="fa fa-building-o"></i> <?php echo "Dept -Aatyaika(Female)"; ?></a>

                             </li>-->
                            </ul>
                           
                        </li>
                        <li class="<?php echo (($this->uri->segment(1) == 'mail') ? "active" : null) ?>">

                            <a href="<?php echo base_url('department/set_time') ?>"><i class="fa ti-time"></i>Set OPD/IPD Time</a>

                        </li>
                       <?php }?>

                    </ul>
                </div> <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">

                    <div class="p-l-30 p-r-30">
                        <div class="header-icon"><i class="pe-7s-world"></i></div>
                        <div class="header-title">
                            <h1><?php echo str_replace('_', ' ', ucfirst($this->uri->segment(1))) ?></h1>
                            <small><?php echo (!empty($title)?$title:null) ?></small> 
                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <div class="content"> 

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
                   


                    <!-- content-->
                    <?php echo (!empty($content)?$content:null) ?> 

                </div> <!-- /.content -->
            </div> <!-- /.content-wrapper -->

            <footer class="main-footer">
                <?= ($this->session->userdata('footer_text')!=null?$this->session->userdata('footer_text'):null) ?>
            </footer>
        </div> <!-- ./wrapper -->
 
        <!-- jquery-ui js -->
        <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
        <!-- pace js -->
        <script src="<?php echo base_url('assets/js/pace.min.js') ?>" type="text/javascript"></script>  
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>  

        <!-- bootstrap timepicker -->
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-sliderAccess.js" type="text/javascript"></script> 
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> 
        <!-- select2 js -->
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/js/sparkline.min.js') ?>" type="text/javascript"></script> 
        <!-- Counter js -->
        <script src="<?php echo base_url('assets/js/waypoints.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery.counterup.min.js') ?>" type="text/javascript"></script>

        <!-- ChartJs JavaScript -->
        <script src="<?php echo base_url('assets/js/Chart.min.js') ?>" type="text/javascript"></script>
        
        <!-- semantic js -->
        <script src="<?php echo base_url() ?>assets/js/semantic.min.js" type="text/javascript"></script>
        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url("assets/datatables/js/dataTables.min.js") ?>"></script>
        <!-- tinymce texteditor -->
        <script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js" type="text/javascript"></script> 

        <!-- Admin Script -->
        <script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script> 

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/wickedpicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/daterange.js" type="text/javascript"></script>
                        <script>
                                $(function() {
                                $('input[name="daterange"]').daterangepicker({
                                    opens: 'left'
                                }, function(start, end, label) {
                                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                                });
                                });
                        </script>

<script>
                           $(document).ready(function(){
                            $('#acyear').on('change', function(){
                                var acyear = $(this).val();
                                //alert(acyear);
                                
                                $.ajax({                                  

                                    url: "<?php echo base_url(); ?>setting/acyear/" + acyear,
                                    type: 'post',
                                    dataType: 'json',

                                    success: function(data){
                                        window.location.reload();
                                    } 
                                })
                                
                            })
                           })
                    </script>

                    

    </body>
</html>