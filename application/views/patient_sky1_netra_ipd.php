<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php echo error_reporting(0); ?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientbydepartment_date_sky1_netra_ipd'); ?>">

            <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; 
                                                                                            ?>">       -->


            <div class="form-group">

                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if ($department_id) {
                                                                                                    echo $department_id;
                                                                                                } else {
                                                                                                    echo $dept_id;
                                                                                                }; ?>">
            </div>

            <div class="form-group">

                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if ($department_id) {
                                                                                                    echo $department_id;
                                                                                                } else {
                                                                                                    echo $dept_id;
                                                                                                }; ?>">
                <input type="hidden" name="netra" class="form-control " id="netra" value="<?php echo $netra;  ?>">
            </div>


            <div class="form-group">
                <select class="form-control" name="section" id="section">
                    <option value="ipd" selected>ipd</option>
                    <!--<option value="ipd">ipd</option>-->
                </select>
            </div>



            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>



        </form>
    </div>
    <div class="col-sm-12" id="PrintMe">

        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print row">

                <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button>
                </div>

                <div class="btn-group col-md-2">
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i> <?php echo display('add_patient') ?> </a>
                </div>

                <?php
                $ipd = ($patients[0]->ipd_opd);

                if ($ipd == 'ipd') { ?>
                    <div class="btn-group col-md-2">
                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                    </div>
                <?php }  ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>

            </div>


            <div class="panel-body" style="font-size: 11px;">
                <div class="col-sm-2" align="left">
                    <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
                </div>
                <div class="col-sm-8" align="center">
                    <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;">
                        <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                    </h4>


                    <?php
                    if ($department_id) {
                        $dept_name = $this->db->select("*")

                            ->from('department')

                            ->where('dprt_id', $department_id)
                            ->get()

                            ->row();

                        $name = $dept_name->name;
                    } else {

                        $name = '';
                    }

                    if ($dept_id) {
                        $dept_name = $this->db->select("*")

                            ->from('department')

                            ->where('dprt_id', $dept_id)
                            ->get()

                            ->row();

                        $dept_name = $dept_name->name;
                    } else {

                        $dept_name = '';
                    }

                    $ipd = ($patients[0]->ipd_opd);
                    ?>

                    <h3 style="margin-top: 0px; margin-bottom: 15px;"> Departmental Register of In Patient Department Shalakyatantra (<?php echo $netra; ?>)</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?> To <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>

                    <?php if ($summery_report == 0) {
                        if ($ipd == 'ipd') { ?>
                            <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                            <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                            <?php }
                        if (!empty($department_id)) {
                            $doctor_name1 = $this->db->select("*")
                                ->from('user')
                                ->where('department_id', $department_id)
                                ->where('join_date<=', date("Y-m-d", strtotime($datefrom)))
                                ->where('Reliving_date>=', date("Y-m-d", strtotime($dateto)))
                                ->get()
                                ->row();
                            if (!empty($doctor_name1->firstname)) { ?>
                                <lable style="float: right;">Doctor Name: <?//php echo "<span style='font-weight: 600;'>" . $doctor_name1->firstname . "</span>"; ?></lable>
                    <?php }
                        }
                    } ?>


                </div>
                <div class="col-sm-2"></div>


                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php if ($gob == 'gob') {
                                                                                                                echo "style='font-size:10px;'";
                                                                                                            } ?>>

                    <thead>
                        <tr>

                            <!--<th style="width: 30px;" rowspan="2"><//?php echo "S.No" ?></th>-->

                            <th style="width: 30px;" rowspan="2"><?php if ($ipd == 'Ipd') {
                                                                        echo "Yearly No";
                                                                    } else {
                                                                        echo "S.No";
                                                                    } ?></th>
                            <?php if ($ipd == 'ipd') { ?> <th style="width: 30px;" rowspan="2"><?php echo "Daily No."; ?></th><?php } ?>
                            <?php if ($ipd == 'ipd') { ?> <th style="width: 30px;" rowspan="2"><?php echo "Monthly No."; ?></th><?php } ?>
                            <?php if ($ipd == 'ipd') { ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>


                            <th style="width: 30px; text-align: center;" colspan="2">
                                <?php echo "COPD" ?>
                            </th>
                            <?php if ($ipd == 'ipd') { ?> <th style="width: 30px;" rowspan="2"><?php echo "Date"; ?></th><?php } ?>

                            <th rowspan="2"><?php echo "Patient Name" ?></th>
                            <th rowspan="2" <?php if ($department_by == 'dpt') {
                                                echo "style='width:1px;'";
                                            } ?>><?php echo "Full Address" ?></th>
                            <th rowspan="2" <?php if ($gob == 'gob') {
                                                echo "style='width:1px;'";
                                            } ?>><?php echo "Age" ?></th>
                            <th rowspan="2" <?php if ($gob == 'gob') {
                                                echo "style='width:1px;'";
                                            } ?>><?php echo display('sex') ?></th>

                            <th rowspan="2" <?php if ($department_by == 'dpt') {
                                                echo "style='width:1px;'";
                                            } ?>><?php echo "Department" ?></th>
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                            <?php if ($ipd == 'ipd') { ?><th rowspan="2" style="width: 100px;">DOA</th><?php } ?>
                            <?php if ($ipd == 'ipd') { ?> <th rowspan="2">DOD</th> <?php } ?>
                            <?php if ($department_by != 'dpt') { ?> <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> <?php } ?>


                            <th style="width: 30px; text-align: center;">
                                <?php echo "Diagnosis" ?>
                            </th>

                            <?php if ($ipd == 'ipd') {
                                if ($department_by != 'dpt') { ?><th style="width: 30px;" rowspan="2">Doctor</th><?php }
                                                                                                                            } ?>
                            <?php if ($department_by != 'dpt') { ?><th style="width: 30px;" rowspan="2"><?php if ($ipd == 'ipd') {
                                                                                                            echo "Doctor";
                                                                                                        } else {
                                                                                                            echo "Date";
                                                                                                        } ?></th> <?php } ?>
                            <?php if ($department_by != 'dpt') { ?> <th style="width: 30px;" rowspan="2"><?php echo "Remark" ?></th><?php } ?>
                            <?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                echo "font-size: 10px;";
                                                                                            } ?>" rowspan="2"><?php echo "Treatment" ?></th> <?php } ?>
                            <?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                echo "font-size: 10px;";
                                                                                            } ?>" rowspan="2"><?php echo "Panchkarma" ?></th> <?php } ?>
                            <?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                echo "font-size: 10px;";
                                                                                            } ?>" rowspan="2"><?php echo "Investigation" ?></th> <?php } ?>

                            <!--<?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                    echo "font-size: 10px;";
                                                                                                } ?>" rowspan="2"><?php echo "RX1" ?></th> <?php } ?>  -->
                            <!--<?php if ($department_by  == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                    echo "font-size: 10px;";
                                                                                                } ?>" rowspan="2"><?php echo "RX2" ?></th> <?php } ?>  -->
                            <!--<?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                    echo "font-size: 10px;";
                                                                                                } ?>" rowspan="2"><?php echo "RX3" ?></th> <?php } ?>-->

                            <!--<?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                                                    echo "font-size: 10px;";
                                                                                                } ?>" rowspan="2"><?php if ($name == 'Shalyatantra') {
                                                                                                                                                                    echo "SHASTRAKARMA";
                                                                                                                                                                } elseif ($name == 'Shalakyatantra') {
                                                                                                                                                                    echo "SHASTRAKARMA";
                                                                                                                                                                } else {
                                                                                                                                                                    echo "ASHAN1" ?></th> <?php }
                                                                                                                                                                                                                                                                                                    } ?>
<?php if ($department_by == 'dpt') { ?> <th style="width: 60px; <?php if ($gob == 'gob') {
                                                                    echo "font-size: 10px;";
                                                                } ?>" rowspan="2"><?php if ($name == 'Shalyatantra') {
                                                                                                                                    echo "VRANOPAKRAM";
                                                                                                                                } elseif ($name == 'Shalakyatantra') {
                                                                                                                                    echo "VRANOPAKRAM";
                                                                                                                                } else {
                                                                                                                                    echo "ASHAN1" ?></th> <?php }
                                                                                                                                                                                                                                                                    } ?>
<?php if ($gob == 'gob') { ?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "KARMA" ?></th> <?php } ?>  
<?php if ($gob == 'gob') { ?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "PK1" ?></th> <?php } ?>  
<?php if ($gob == 'gob') { ?> <th style="width: 60px; font-size: 10px;" rowspan="2"><?php echo "PK2" ?></th> <?php } ?>-->

                            <?php

                            $ipd = ($patients[0]->ipd_opd);

                            if ($ipd == 'ipd') { ?>
                                <!-- <th><?php echo "Ipd No" ?></th> -->
                                <!-- <th style="width: 30px;"><?php echo "D. Date" ?></th> -->
                            <?php  }  ?>

                            <th class="no-print" rowspan="2"><?php echo display('action') ?></th>

                        </tr>
                        <tr>

                            <th style="width: 30px;">

                                <?php echo "New No" ?>
                            </th>
                            <th style="width: 30px;"><?php echo "Follow-Up No" ?></th>
                            <?php if ($netra == 'netra') { ?>
                                <th style="width: 30px;"><?php echo "Netra" ?></th>
                            <?php } else { ?>
                                <th style="width: 30px;"><?php echo "Karn,Nasa,Mukha,Dant" ?></th>
                            <?php } ?>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $n_count = 0;
                        $m_count = 0; ?>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;

                            $datefrom1 = date('Y-m-d', strtotime($datefrom));
                            //$year1 = date('Y');
                            $year1 = $this->session->userdata['acyear'];
                            $year2 = '%' . $year1 . '%';

                            $ddd = date('Y-m-d', strtotime("-1day" . $datefrom1));
                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'ipd');
                            $this->db->where('yearly_reg_no !=', '');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient');
                            $num = $query->num_rows();

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'ipd');
                            $this->db->where('old_reg_no !=', '');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient');
                            $num1 = $query->num_rows();
                            $tot_serial1 = $num + $num1;
                            $array_no = count($patients);
                            $tot_serial = $tot_serial1 + $array_no + 1;

                            $this->db->select('*');
                            // $this->db->where('ipd_opd', 'opd');
                            //$this->db->where('yearly_reg_no !=','');
                            $this->db->where('create_date <=', date('Y-m-d') . " 23:59:00");
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient_ipd');
                            $num_ipd1 = $query->num_rows();
                            //$num_ipd11=$num_ipd1 + 1;
                            $attay_count = count($patients);
                            //$num_ipd=  $num_ipd1 - $attay_count +1 ;

                            if ($department_by_section == 'ipd') {
                                //  $num_ipd=  $num_ipd1;
                                $num_ipd =  1;
                            } else {
                                $num_ipd =  $num_ipd1 - $attay_count + 1;
                            }
                            // for department serial no

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'ipd');
                            $this->db->where('yearly_reg_no !=', '');
                            $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query_d = $this->db->get('patient');
                            $num_d = $query_d->num_rows();

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'ipd');
                            $this->db->where('old_reg_no !=', '');
                            $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query_dd = $this->db->get('patient');
                            $num1_d = $query_dd->num_rows();


                            $tot_serial1_d = $num_d + $num1_d;
                            if ($tot_serial1_d == 0) {
                                $tot_serial1_d = 1;
                            } else {
                                $tot_serial1_d = $tot_serial1_d + 1;
                            }
                            //


                            // for department Monthly no
                            $fdate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($datefrom1)) . ", first day of this month"));
                            //print_r($fdate);
                            $cdate = date('Y-m-d', strtotime("-1day" . $datefrom1));
                            $this->db->select('count(*) as newCount');
                            $this->db->where('ipd_opd', 'ipd');
                            $this->db->where('yearly_reg_no !=', '');
                            if ($department_id)
                                $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date >=', $fdate);
                            $this->db->where('create_date <=', $cdate);
                            $this->db->where('create_date LIKE', $year2);
                            $query_d_m = $this->db->get('patient')->row();
                            $num_d_m = $query_d_m->newCount;

                            //print_r($num_d_m);

                            $this->db->select('count(*) as oldCount');
                            $this->db->where('ipd_opd', 'ipd');
                            $this->db->where('old_reg_no !=', '');
                            if ($department_id)
                                $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date >=', $fdate);
                            $this->db->where('create_date <=', $cdate);
                            $this->db->where('create_date LIKE', $year2);
                            $query_dd_m = $this->db->get('patient')->row();
                            $num1_d_m = $query_dd_m->oldCount;


                            $monthlySerialNo = $num_d_m + $num1_d_m;
                            if ($monthlySerialNo == 0) {
                                $monthlySerialNo = 1;
                            } else {
                                $monthlySerialNo = $monthlySerialNo + 1;
                            }



                            ?>
                            <?php $i = 0;
                            $daily_num = 0;
                            $aa_mn = 0;
                            $aa_mo = 0;
                            $aa_fn = 0;
                            $aa_fo = 0;
                            $aa_tt = 0;
                            $ky_mn = 0;
                            $ky_mo = 0;
                            $ky_fn = 0;
                            $ky_fo = 0;
                            $ky_tt = 0;
                            $pn_mn = 0;
                            $pn_mo = 0;
                            $pn_fn = 0;
                            $pn_fo = 0;
                            $pn_tt = 0;
                            $ba_mn = 0;
                            $ba_mo = 0;
                            $ba_fn = 0;
                            $ba_fo = 0;
                            $ba_tt = 0;
                            $sly_mn = 0;
                            $sly_mo = 0;
                            $sly_fn = 0;
                            $sly_fo = 0;
                            $sly_tt = 0;
                            $sky_mn = 0;
                            $sky_mo = 0;
                            $sky_fn = 0;
                            $sky_fo = 0;
                            $sky_tt = 0;
                            $st_mn = 0;
                            $st_mo = 0;
                            $st_fn = 0;
                            $st_fo = 0;
                            $st_tt = 0;
                            $sw_mn = 0;
                            $sw_mo = 0;
                            $sw_fn = 0;
                            $sw_fo = 0;
                            $sw_tt = 0;


                            $sky_netra_m_n = 0;
                            $sky_mukha_m_n = 0;
                            $sky_netra_m_o = 0;
                            $sky_mukha_m_o = 0;
                            $sky_netra_f_n = 0;
                            $sky_mukha_f_n = 0;
                            $sky_netra_f_o = 0;
                            $sky_mukha_f_o = 0;

                            foreach ($patients as $patient) {
                                $i++;

                                $dd = date('Y-m-d', strtotime($patient->discharge_date));
                                $dd12 = date('Y-m-d', strtotime($_GET['end_date']));
                                if ($_GET['end_date']) {
                                    $dd1 = date('Y-m-d', strtotime($_GET['end_date']));
                                } else {
                                    $dd1 = date('Y-m-d');
                                }

                                //atya
                                if (($patient->sex == 'M') && ($patient->department_id == '35') && ($patient->yearly_reg_no)) {
                                    $patient->discharge_date;
                                    if ($dd != $dd1) {
                                        $aa_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '35') && ($patient->old_reg_no)) {
                                    $aa_mo++;
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '35') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $aa_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '35') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $aa_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '35') {
                                    if ($dd != $dd1) {
                                        $aa_tt++;
                                    } else {
                                    }
                                }
                                //kay
                                if (($patient->sex == 'M') && ($patient->department_id == '34') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ky_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '34') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ky_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '34') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ky_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '34') && ($patient->old_reg_no)) {

                                    if ($dd != $dd1) {
                                        $ky_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '34') {

                                    if ($dd != $dd1) {
                                        $ky_tt++;
                                    } else {
                                    }
                                }

                                //pan
                                if (($patient->sex == 'M') && ($patient->department_id == '33') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $pn_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '33') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $pn_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '33') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $pn_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '33') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $pn_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '33') {
                                    if ($dd != $dd1) {
                                        $pn_tt++;
                                    } else {
                                    }
                                }

                                //bal
                                if (($patient->sex == 'M') && ($patient->department_id == '32') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ba_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '32') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ba_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '32') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ba_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '32') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $ba_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '32') {
                                    if ($dd != $dd1) {
                                        $ba_tt++;
                                    } else {
                                    }
                                }

                                //sly
                                if (($patient->sex == 'M') && ($patient->department_id == '31') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sly_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '31') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sly_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '31') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sly_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '31') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sly_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '31') {
                                    if ($dd != $dd1) {
                                        $sly_tt++;
                                    } else {
                                    }
                                }

                                //sky
                                if (($patient->sex == 'M') && ($patient->department_id == '30') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '30') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '30') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '30') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '30') {
                                    if ($dd != $dd1) {
                                        $sky_tt++;
                                    } else {
                                    }
                                }


                                //st
                                if (($patient->sex == 'M') && ($patient->department_id == '29') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $st_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '29') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $st_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '29') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $st_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '29') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $st_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '29') {
                                    if ($dd != $dd1) {
                                        $st_tt++;
                                    } else {
                                    }
                                }

                                //sw
                                if (($patient->sex == 'M') && ($patient->department_id == '28') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sw_mn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'M') && ($patient->department_id == '28') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sw_mo++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '28') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sw_fn++;
                                    } else {
                                    }
                                }
                                if (($patient->sex == 'F') && ($patient->department_id == '28') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sw_fo++;
                                    } else {
                                    }
                                }

                                if ($patient->department_id == '28') {
                                    if ($dd != $dd1) {
                                        $sw_tt++;
                                    } else {
                                    }
                                }


                                $date_c = date('Y-m-d', strtotime($patient->create_date));
                                $date_d = date('Y-m-d', strtotime($patient->discharge_date));
                                $date_f = date('Y-m-d', strtotime($dateto));
                                $tot_serial--;
                                $tot_serial1++;


                                if ($ipd == 'ipd') {
                                    $che = trim($patient->dignosis);
                                    $section_tret = 'ipd';
                                    $len = strlen($che);
                                    $dd = substr($che, $len - 1);

                                    $str = $patient->dignosis;
                                    $arry = explode("-", $str);
                                    $t_c = count($arry);

                                    if ($t_c == '2') {
                                        $dd1 = substr($che, 0, -1);
                                        $p_dignosis = '%' . $arry[0] . '%';
                                        trim($p_dignosis);
                                        $p_dignosis_name = $patient->dignosis;
                                    } else {

                                        $p_dignosis = '%' . $che . '%';
                                        $p_dignosis_name = $patient->dignosis;
                                    }
                                } else {
                                    $section_tret = 'ipd';
                                    $che = trim($patient->dignosis);
                                    $section_tret = 'ipd';
                                    $len = strlen($che);
                                    $dd = substr($che, $len - 1);

                                    $str = $patient->dignosis;
                                    $arry = explode("-", $str);
                                    $t_c = count($arry);
                                    if ($t_c == '2') {
                                        $dd1 = substr($che, 0, -1);

                                        $p_dignosis = '%' . $arry[0] . '%';
                                        trim($p_dignosis);
                                        $p_dignosis_name = $patient->dignosis;
                                    } else {
                                        //echo $dd;

                                        $p_dignosis = '%' . $che . '%';
                                        $p_dignosis_name = $patient->dignosis;
                                    }
                                }


                                $table = 'treatments1';


                                if ($netra == 'netra') {
                                    $skyna_new = 'N';
                                } else {
                                    $skyna_new = 'M';
                                }

                                if ($patient->manual_status == 0) {
                                    if ($patient->proxy_id) {


                                        $tretment = $this->db->select("*")

                                            ->from('treatments1')
                                            ->where('dignosis LIKE', $p_dignosis)
                                            ->where('proxy_id', $patient->proxy_id)
                                            ->where('department_id', $patient->department_id)
                                            ->where('ipd_opd ', $section_tret)
                                            ->where('skya', $skyna_new)
                                            ->get()
                                            ->row();
                                    } else {

                                        $tretment = $this->db->select("*")

                                            ->from('treatments1')
                                            ->where('dignosis LIKE', $p_dignosis)
                                            ->where('department_id', $patient->department_id)
                                            ->where('ipd_opd ', $section_tret)
                                            ->where('skya', $skyna_new)
                                            ->get()
                                            ->row();

                                        if (empty($tretment)) {
                                            $tretment = $this->db->select("*")
                                                ->from('treatments1')
                                                ->where('department_id', $patient->department_id)
                                                ->where('ipd_opd', $patient->department_id)
                                                ->where('skya', $skyna_new)
                                                ->get()
                                                ->row();
                                        }
                                    }
                                } else {
                                    $tretment = $this->db->select("*")

                                        ->from('manual_treatments')
                                        ->where('patient_id_auto', $patient->id)
                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('ipd_opd ', $section_tret)
                                        // ->where('skya',$skyna_new)
                                        ->get()
                                        ->row();
                                }


                                $RX1 = $tretment->RX1;
                                $RX2 = $tretment->RX2;
                                $RX3 = $tretment->RX3;
                                $RX4 = $tretment->RX4;
                                $RX5 = $tretment->RX5;

                                $RX_other = $tretment->RX_other;
                                $RX_other1_medicine_name = $tretment->RX_other1_medicine_name;
                                $other_equipment = $tretment->other_equipment;



                                $KARMA = $tretment->KARMA;
                                $PK1 = $tretment->PK1;
                                $PK2 = $tretment->PK2;
                                $SWA1 = $tretment->SWA1;
                                $SWA2 = $tretment->SWA2;
                                $skya = $tretment->skya;
                                /*
print_r($skya);*/


                                $s_s = $tretment->skarma;
                                $s_v = $tretment->vkarma;

                                $SNEHAN = $tretment->SNEHAN;


                                $SWEDAN = $tretment->SWEDAN;
                                $VAMAN = $tretment->VAMAN;

                                $VIRECHAN = $tretment->VIRECHAN;
                                $BASTI = $tretment->BASTI;
                                $NASYA = $tretment->NASYA;

                                $RAKTAMOKSHAN = $tretment->RAKTAMOKSHAN;
                                $SHIRODHARA_SHIROBASTI = $tretment->SHIRODHARA_SHIROBASTI;
                                $OTHER = $tretment->OTHER;
                                $skya = $tretment->skya;


                                $HEMATOLOGICAL = $tretment->HEMATOLOGICAL;
                                $SEROLOGYCAL = $tretment->SEROLOGYCAL;
                                $BIOCHEMICAL = $tretment->BIOCHEMICAL;
                                $MICROBIOLOGICAL = $tretment->MICROBIOLOGICAL;

                                $X_RAY = $tretment->X_RAY;
                                $ECG = $tretment->ECG;



                                if (($patient->department_id == '30') && ($skya == 'N') && ($patient->sex == 'M') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_netra_m_n++;
                                    } else {
                                    }
                                }


                                if (($patient->department_id == '30') && ($skya == 'M') && ($patient->sex == 'M') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_mukha_m_n++;
                                    } else {
                                    }
                                }
                                if (($patient->department_id == '30') && ($skya == 'N') && ($patient->sex == 'M') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_netra_m_o++;
                                    } else {
                                    }
                                }

                                if (($patient->department_id == '30') && ($skya == 'M') && ($patient->sex == 'M') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_mukha_m_o++;
                                    } else {
                                    }
                                }

                                if (($patient->department_id == '30') && ($skya == 'N') && ($patient->sex == 'F') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_netra_f_n++;
                                    } else {
                                    }
                                }

                                if (($patient->department_id == '30') && ($skya == 'M') && ($patient->sex == 'F') && ($patient->yearly_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_mukha_f_n++;
                                    } else {
                                    }
                                }


                                if (($patient->department_id == '30') && ($skya == 'N') && ($patient->sex == 'F') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_netra_f_o++;
                                    } else {
                                    }
                                }
                                if (($patient->department_id == '30') && ($skya == 'M') && ($patient->sex == 'F') && ($patient->old_reg_no)) {
                                    if ($dd != $dd1) {
                                        $sky_mukha_f_o++;
                                    } else {
                                    }
                                }
                                /* $n_count=0;
$m_count=0;*/

                                // patient ipd yearly no
                                $ipd_no_date = date('Y-m-d', strtotime($patient->create_date));
                                $d_ipd_no = date('Y-m-d', strtotime("-1day" . $ipd_no_date));
                                $year122 = date('Y', strtotime($patient->create_date));
                                $year2 = '%' . $year122 . '%';

                                $this->db->select('*');
                                $this->db->where('ipd_opd', 'ipd');
                                $this->db->where('id <', $patient->id);
                                // $this->db->where('create_date <=', $d_ipd_no);
                                $this->db->where('create_date LIKE', $year2);
                                $query = $this->db->get('patient_ipd');
                                $num_ipd_change = $query->num_rows();
                                $tot_serial_ipd_change = $num_ipd_change;
                                $tot_serial_ipd_change++;


                                if ($tretment->skya) {
                            ?>

                                    <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>" style="  <?php if (($date_c == $date_f) && ($ipd == 'ipd')) {
                                                                                                                echo "color: #ff000d;font-weight: bold;";
                                                                                                            } else if (($date_d == $date_f) && ($ipd == 'ipd')) {
                                                                                                                echo "color: #4dd208;font-weight: bold;";
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>">

                                        <!--<td style="padding:2px;"><? php // if($ipd == 'ipd'){ echo $i;} else { echo $tot_serial1; } 
                                                                        ?></td>-->

                                        <td style="padding:2px;"><?php if ($ipd == 'ipd') {
                                                                        echo $i;
                                                                    } else {
                                                                        echo $tot_serial1_d++;
                                                                    } ?></td>

                                        <?php if ($ipd == 'ipd') { ?><td style="padding:2px;"><?php echo $daily_num = $daily_num + 1; ?></td><?php } ?>


                                        <?php
                                        if ($ipd == 'ipd') { ?>
                                            <?php if ($department_by == 'dpt') { ?>
                                                <td style="padding: 2px;"><?php echo $monthlySerialNo++; ?> </td>
                                            <?php } else { ?>
                                                <td style="padding: 2px;">
                                                    <?php echo $monthlySerialNo++; ?></td>
                                        <?php }
                                        } ?>



                                        <!--<? //php if($ipd == 'ipd'){ 
                                            ?><td  style="padding:2px;"><? //php  if($department_by_section=='ipd'){ echo $num_ipd++; } else{ echo $num_ipd++;} 
                                                                                                    ?></td> <? //php } 
                                                                                                                                                                                                    ?>  -->
                                        <?php if ($ipd == 'ipd') {
                                            if ($year122 == '2021') { ?><td style="padding:2px;"><?php if ($department_by_section == 'ipd') {
                                                                                                                        echo $patient->patient_id;
                                                                                                                    } ?></td>
                                            <?php } else { ?>
                                                <td style="padding:2px;"><?php if ($department_by_section == 'ipd') {
                                                                                echo $tot_serial_ipd_change;
                                                                            } else {
                                                                                echo $tot_serial_ipd_change++;
                                                                            } ?></td>
                                        <?php  }
                                        } ?>
                                        <!-- //patient_id yearly sr no -->
                                        <!-- <td><?php echo $patient->daily_reg_no; ?></td> -->
                                        <!-- <td><?php echo $patient->monthly_reg_no; ?></td>  -->
                                        <?php
                                        $date = date('Y', strtotime($patient->create_date));
                                        $dot_year = substr($date, 2);
                                        $explode = explode('.', $patient->old_reg_no);
                                        //print_r($import);
                                        $explode[1];
                                        ?>

                                        <td style="padding:2px;"><?php if ($patient->yearly_reg_no) {
                                                                        echo $patient->yearly_reg_no . "/" . $dot_year;
                                                                    } ?></td>
                                        <td style="padding:2px;"><?php if ($patient->old_reg_no) {
                                                                        echo $patient->old_reg_no;
                                                                        if ($explode[1] == '') {
                                                                            echo "/" . $dot_year;
                                                                        }
                                                                    } ?></td> <!-- //old patient no -->

                                        <!--<td><?php echo $patient->ipd_no ?></td>-->
                                        <td style="width: 159px;" style="padding:2px;"><?php echo date("d-m-Y", strtotime($patient->create_date)); ?></td>
                                        <td style="width: 159px;" style="padding:2px;"><?php echo $patient->firstname; ?></td>
                                        <?php if ($department_by == 'dpt') { ?><td style="padding:2px;"><?php echo $patient->address; ?></td><?php } ?>
                                        <td style="padding:2px;"><?php echo $patient->date_of_birth; ?></td>
                                        <td style="padding:2px;"><?php echo $patient->sex; ?></td>




                                        <?php
                                        $dept = $this->db->select('*')
                                            ->from('patient')
                                            ->join('department', 'department.dprt_id = patient.department_id')
                                            ->where('department.dprt_id', $patient->department_id)
                                            ->get()
                                            ->row();
                                        ?>


                                        <?php if ($department_by == 'dpt') { ?><td style="padding:2px;"><?php echo $dept->name; ?></td><?php } ?>
                                        <?php if ($ipd == 'ipd') { ?> <td><?php echo date('d-m-Y', strtotime($patient->create_date)); ?></td> <?php } ?>
                                        <!-- <?php if ($ipd == 'ipd') { ?>  <td style="width:100px;"><?php ?><?php if (date('d-m-Y', strtotime($patient->discharge_date)) == date('d-m-y', strtotime($datefrom))) {
                                                                                                                if ($patient->discharge_date == '0000-00-00') {
                                                                                                                    echo "0000-00-00 ";
                                                                                                                } else {
                                                                                                                    echo $patient->discharge_date;
                                                                                                                }
                                                                                                            } ?> </td> <?php } ?>-->

                                        <?php if ($ipd == 'ipd') { ?> <td style="padding:2px; font-size: 10px; width: 81px;"><?php if ($patient->discharge_date != '') {
                                                                                                                                if ($patient->discharge_date != '0000-00-00') {
                                                                                                                                    if (date('d-m-Y', strtotime($patient->discharge_date)) == date('d-m-Y', strtotime($datefrom))) {
                                                                                                                                        echo date('d-m-Y', strtotime($patient->discharge_date));
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            } ?></td> <?php } ?>

                                        <!-- <td><?php echo $patient->address; ?></td>   -->
                                        <?php if ($department_by != 'dpt') { ?> <td style="padding:2px;"><?php echo $patient->name; ?></td> <?php } ?>
                                        <!--   <td  style="padding:2px;"><?php if ($ipd == 'ipd') {
                                                                                echo $p_dignosis_name;
                                                                            } else {
                                                                                echo $p_dignosis_name;
                                                                            } ?></td> -->



                                        <td style="padding:2px;"><?php echo $p_dignosis_name;  ?><!--echo $m_count++;--></td>






                                        <!--<td><?php echo date('Y-m-d', strtotime($patient->create_date)); ?></td> -->
                                        <?php
                                        $doctor_name = $this->db->select("*")
                                            ->from('user')
                                            ->where('department_id', $patient->department_id)
                                            ->get()
                                            ->row();
                                        if ($ipd == 'ipd') {
                                            if ($department_by != 'dpt') { ?><td style="width: 30px;"><?php echo $doctor_name->firstname; ?></td> <?php }
                                                                                                            } ?>
                                        <?php if ($department_by != 'dpt') { ?>
                                            <td style="padding:2px;"><?php

                                                                        if ($ipd == 'ipd') {
                                                                            echo $doctor_name->firstname;
                                                                        } else {
                                                                            echo date('Y-m-d', strtotime($patient->create_date));
                                                                        } ?></td><?php } ?>
                                        <?php if ($department_by != 'dpt') { ?> <td style="padding:2px;"></td> <?php } ?>
                                        <?php if ($department_by == 'dpt') { ?>
                                            <td style="padding:2px;<?php if ($gob == 'gob') {
                                                                        echo "font-size: 10px;";
                                                                    } ?>">
                                                <?php if ($RX1) {
                                                    echo $RX1 . ', <br>';
                                                } ?>
                                                <?php if ($RX2) {
                                                    echo $RX2 . ', <br>';
                                                } ?>
                                                <?php if ($RX3) {
                                                    echo $RX3 . ', <br>';
                                                } ?>
                                                <?php if ($RX4) {
                                                    echo $RX4 . ', <br>';
                                                } ?>
                                                <?php if ($RX5) {
                                                    echo $RX5 . ', <br>';
                                                } ?>
                                                <?php if ($RX_other) {
                                                    echo $RX_other . ', <br>';
                                                } ?>
                                                <?php if ($RX_other1_medicine_name) {
                                                    echo $RX_other1_medicine_name . ', <br>';
                                                } ?>
                                                <?php if ($other_equipment) {
                                                    echo $other_equipment;
                                                } ?>

                                            </td>
                                        <?php } ?>
                                        <?php if ($department_by == 'dpt') { ?>
                                            <td style="padding:2px;<?php if ($gob == 'gob') {
                                                                        echo "font-size: 10px;";
                                                                    } ?>">
                                                <?php if ($SNEHAN) {
                                                    echo $SNEHAN . ', <br>';
                                                } ?>
                                                <?php if ($SWEDAN) {
                                                    echo $SWEDAN . ', <br>';
                                                } ?>
                                                <?php if ($VAMAN) {
                                                    echo $VAMAN . ', <br>';
                                                } ?>
                                                <?php if ($VIRECHAN) {
                                                    echo $VIRECHAN . ', <br>';
                                                } ?>
                                                <?php if ($BASTI) {
                                                    echo $BASTI . ', <br>';
                                                } ?>
                                                <?php if ($NASYA) {
                                                    echo $NASYA . ', <br>';
                                                } ?>
                                                <?php if ($RAKTAMOKSHAN) {
                                                    echo $RAKTAMOKSHAN . ', <br>';
                                                } ?>
                                                <?php if ($SHIRODHARA_SHIROBASTI) {
                                                    echo $SHIRODHARA_SHIROBASTI . ', <br>';
                                                } ?>
                                                <?php if ($SHIROBASTI) {
                                                    echo $SHIROBASTI . ', <br>';
                                                } ?>
                                                <?php if ($OTHER) {
                                                    echo $OTHER . ', <br>';
                                                } ?>
                                            </td>
                                        <?php } ?>


                                        <?php if ($gob == 'gob' || $department_by == 'dpt') { ?>
                                            <?php if ($ipd == 'ipd' && date('Y-m-d', strtotime($patient->create_date)) == date('Y-m-d', strtotime($datefrom))) { ?>
                                                <td style="padding:2px;">
                                                    <?php if ($HEMATOLOGICAL) {
                                                        echo $HEMATOLOGICAL . ', <br>';
                                                    } ?>
                                                    <?php if ($SEROLOGYCAL) {
                                                        echo $SEROLOGYCAL . ', <br>';
                                                    } ?>
                                                    <?php if ($BIOCHEMICAL) {
                                                        echo $BIOCHEMICAL . ', <br>';
                                                    } ?>
                                                    <?php if ($MICROBIOLOGICAL) {
                                                        echo $MICROBIOLOGICAL . ', <br>';
                                                    } ?>
                                                    <?php if ($X_RAY) {
                                                        echo $X_RAY . ', <br>';
                                                    } ?>
                                                    <?php if ($ECG) {
                                                        echo $ECG . ', <br>';
                                                    } ?>
                                                </td>
                                            <?php } elseif ($ipd == 'ipd') { ?>
                                                <?php if ($patient->yearly_reg_n8o != '' || $patient->yearly_reg_no != NULL) { ?>
                                                    <td style="padding:2px;">
                                                        <?php if ($HEMATOLOGICAL) {
                                                            echo $HEMATOLOGICAL . ', <br>';
                                                        } ?>
                                                        <?php if ($SEROLOGYCAL) {
                                                            echo $SEROLOGYCAL . ', <br>';
                                                        } ?>
                                                        <?php if ($BIOCHEMICAL) {
                                                            echo $BIOCHEMICAL . ', <br>';
                                                        } ?>
                                                        <?php if ($MICROBIOLOGICAL) {
                                                            echo $MICROBIOLOGICAL . ', <br>';
                                                        } ?>
                                                        <?php if ($X_RAY) {
                                                            echo $X_RAY . ', <br>';
                                                        } ?>
                                                        <?php if ($ECG) {
                                                            echo $ECG . ', <br>';
                                                        } ?>
                                                    </td>

                                                <?php } else { ?>
                                                    <td style="padding:2px;"></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <td style="padding:2px;"></td>
                                            <?php } ?>
                                        <?php } ?>

                                        <!--<?php if ($department_by == 'dpt') { ?> <td  style="padding:2px;<?php if ($gob == 'gob') {
                                                                                                                echo "font-size: 10px;";
                                                                                                            } ?>"><?php echo $RX1; ?></td> <?php } ?>  -->
                                        <!-- <?php if ($department_by == 'dpt') { ?> <td  style="padding:2px;<?php if ($gob == 'gob') {
                                                                                                                echo "font-size: 10px;";
                                                                                                            } ?>"><?php echo $RX2; ?></td>  <?php } ?> -->
                                        <!--  <?php if ($department_by == 'dpt') { ?> <td  style="padding:2px;<?php if ($gob == 'gob') {
                                                                                                                echo "font-size: 10px;";
                                                                                                            } ?>"><?php echo $RX3; ?></td>  <?php } ?> -->
                                        <!-- <?php if ($department_by == 'dpt') { ?> <td  style="padding:2px;<?php if ($gob == 'gob') {
                                                                                                                echo "font-size: 10px;";
                                                                                                            } ?>"><?php if ($name == 'Shalyatantra') {
                                                                                                                                                                    $admit_date = date('Y-m-d', strtotime($patient->create_date));
                                                                                                                                                                    if ($admit_date == date('Y-m-d', strtotime($dateto))) {
                                                                                                                                                                        echo $s_s;
                                                                                                                                                                    }
                                                                                                                                                                } elseif ($name == 'Shalakyatantra') {
                                                                                                                                                                    $admit_date = date('Y-m-d', strtotime($patient->create_date));
                                                                                                                                                                    if ($admit_date == date('Y-m-d', strtotime($dateto))) {
                                                                                                                                                                        echo $s_s;
                                                                                                                                                                    }
                                                                                                                                                                } else {
                                                                                                                                                                    echo $SWA1; ?></td>  <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>
<?php if ($department_by == 'dpt') { ?> <td  style="padding:2px;<?php if ($gob == 'gob') {
                                                                    echo "font-size: 10px;";
                                                                } ?>"><?php if ($name == 'Shalyatantra') {
                                                                                                                        echo $s_v;
                                                                                                                    } elseif ($name == 'Shalakyatantra') {
                                                                                                                        echo $s_v;
                                                                                                                    } else {
                                                                                                                        echo $SWA2; ?></td>  <?php }
                                                                                                                                                                                                                                    } ?> 
<?php if ($gob == 'gob') { ?> <td  style="padding:2px; font-size: 10px;"><?php echo $KARMA; ?></td> <?php } ?>  
<?php if ($gob == 'gob') { ?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK1; ?></td>  <?php } ?> 
<?php if ($gob == 'gob') { ?> <td  style="padding:2px; font-size: 10px;"><?php echo $PK2; ?></td>  <?php } ?> -->

                                        <?php
                                        if ($patient->ipd_opd == 'ipd') { ?>
                                            <!-- <td><?php echo $patient->ipd_no ?></td> -->
                                            <!-- <td><?php

                                                        //echo 'dd',$patient->discharge_date; 

                                                        if ($patient->discharge_date != '') {
                                                            // echo date("d/m/Y", strtotime($patient->discharge_date)); 
                                                        }

                                                        ?></td>                                                                                             -->
                                        <?php }   ?>
                                        <td class="center no-print" style="padding:2px;">

                                            <?php
                                            if ($patient->ipd_opd == 'ipd') { ?>
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>

                                            <?php } else { ?>

                                                <a href="<?php echo base_url("patients/profile_sky/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                            <?php } ?>
                                            <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                            <!--<a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a>-->
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php $sl++; ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table> <!-- /.table-responsive -->
                <!-- Table Summery -->

                <h3>Report Summary</h3>


                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th rowspan='3'>Sr. No.</th>
                            <th rowspan='3'>Name</th>
                            <th colspan='4'>Male</th>
                            <th colspan='4'>Female</th>

                        </tr>
                        <tr>
                            <th colspan='2'>Netra</th>
                            <th colspan='2'>Mukh</th>
                            <th colspan='2'>Netra</th>
                            <th colspan='2'>Mukh</th>
                        </tr>
                        <tr>
                            <th>New</th>
                            <th>Follow-Up</th>
                            <th>New</th>
                            <th>Follow-Up</th>
                            <th>New</th>
                            <th>Follow-Up</th>
                            <th>New</th>
                            <th>Follow-Up</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>


                            <td>1</td>
                            <td>Shalakyatantra</td>
                            <td><?php echo  $sky_netra_m_n; ?></td>
                            <td><?php echo $sky_netra_m_o; ?></td>
                            <td><?php echo $sky_mukha_m_n; ?></td>
                            <td><?php echo $sky_mukha_m_o; ?></td>
                            <td><?php echo   $sky_netra_f_n; ?></td>
                            <td><?php echo  $sky_netra_f_o; ?></td>
                            <td><?php echo $sky_mukha_f_n; ?></td>
                            <td><?php echo  $sky_mukha_f_o; ?></td>
                        </tr>
                        <tr>
                            <td colspan='2'>Total</td>
                            <td style="text-align: center;" colspan='2'><?php echo $total_n_n_o_m = $sky_netra_m_n + $sky_netra_m_o; ?></td>
                            <td style="text-align: center;" colspan='2'><?php echo $total_m_n_o_m = $sky_mukha_m_n + $sky_mukha_m_o; ?></td>
                            <td style="text-align: center;" colspan='2'><?php echo $total_n_n_o_f = $sky_netra_f_n + $sky_netra_f_o; ?></td>
                            <td style="text-align: center;" colspan='2'><?php echo $total_m_n_o_f = $sky_mukha_f_n + $sky_mukha_f_o; ?></td>
                        </tr>
                        <tr>
                            <td colspan='2'>Grand Total</td>
                            <td colspan='8' style="text-align: center;"><?php echo $total = $total_n_n_o_m + $total_m_n_o_m + $total_n_n_o_f + $total_m_n_o_f; ?></td>
                        </tr>
                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>


<!-- OTP Submission -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add patient discharge date</h4>
            </div>
            <?php ?>
            <div class="modal-body">
                <div class="row">

                    <form id="otp_confirm_form" name="otp_confirm_form" method="POST">
                        <div class="col-xs-12">
                            <label>Enter patient reg no</label>
                            <input type="text" id="yearly_reg_no" name="yearly_reg_no" class="form-control" autocomplete="off" />
                            <div id="error_otp"></div>
                        </div>

                        <div class="col-xs-12">
                            <label>Discharge Date</label>
                            <input type="text" id="discharge_date" name="discharge_date" class="form-control datepicker" autocomplete="off" />
                            <div id="error_otp"></div>
                        </div>



                        <div class="col-xs-12" style="margin-top: 20px">
                            <button type="button" name="dischargedate" class="btn btn-primary" value="dischargedate" id="dischargedate">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function() {
        $('#btn_excel_download').click(function() {
            //"processing": true,
            //"serverSide": true,		
            $.ajax: {
                    "url": "<?php echo base_url('patientList/ipd') ?>",
                    "type": "POST",
                    "data": {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                    // url: "<?php echo base_url() ?>patientList/ipd",
                    // type:"POST",
                },
                "columnDefs": [{
                    "targets": [-1],
                    "orderable": false,
                }]
        });
    });
</script>

<!-- //Discharge Date -->

<script>
    $(document).ready(function() {
        $("#dischargedate").click(function() {
            var yearly_reg_no = document.getElementById("yearly_reg_no").value;
            var discharge_date = document.getElementById("discharge_date").value;

            //alert('Hi');

            $.ajax({
                url: "<?php echo base_url(); ?>patients/dischargedate/" + discharge_date + "/" + yearly_reg_no,
                method: "POST",
                //data: {"otp": otp},
                dataType: "json",
                data: {
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
                },

                success: function(data) {
                    //alert();
                    if (data != "1") {
                        //document.getElementById('otp_message').innerHTML = "Otp confirm";
                        window.location.reload();
                    }

                }
                // window.location.reload();
            });
            //alert();
        });
    });
</script>
<script>
    $(function() {
        var d = new Date();
        $("#discharge_date").datetimepicker({
            showSecond: false,
            timeFormat: 'hh:mm',
        }).datetimepicker("setDate", new Date());
    });
</script>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#patientdata tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>