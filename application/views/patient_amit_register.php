<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php echo error_reporting(0); ?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientbydepartment_admit_register_date'); ?>">

            <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; 
                                                                                            ?>">       -->


            <div class="form-group">

                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

            </div>

            <div class="form-group">

                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if ($department_id) {
                                                                                                    echo $department_id;
                                                                                                } else {
                                                                                                    echo $dept_id;
                                                                                                }; ?>">
            </div>


            <div class="form-group">
                <select class="form-control" name="section" id="section">
                    <option value="ipd">ipd</option>
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
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-xs-2" align="left">
                            <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
                        </div>
                        <div class="col-xs-8" align="center">
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

                            if ($ipd == 'ipd') { ?>
                                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if ($name) {
                                                                                        echo "Departmental ";
                                                                                    } elseif ($gob == 'gob') {
                                                                                        echo "GOB";
                                                                                    } else {
                                                                                        echo "Central";
                                                                                    } ?> IPD Admit Register <?php if ($name == 'Swasthrakshnam') {
                                                                                                                                                                                                                echo "(" . $name . " -KC)";
                                                                                                                                                                                                            } elseif ($name) {
                                                                                                                                                                                                                echo "(" . $name . ")";
                                                                                                                                                                                                            } elseif ($dept_name) {
                                                                                                                                                                                                                echo "(" . $dept_name . ")";
                                                                                                                                                                                                            } ?></h3>
                                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?> To <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                            <?php } else { ?>
                                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if ($name) {
                                                                                        echo "Departmental ";
                                                                                    } else {
                                                                                        echo "Central";
                                                                                    } ?> OPD Register <?php if ($name) {
                                                                                                                                                                        echo "(" . $name . ")";
                                                                                                                                                                    } ?></h3>
                                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?> To <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                            <?php  }  ?>

                            <?php if ($summery_report == 0) {
                                if ($ipd == 'ipd') { ?>
                                    <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                                    <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                                    <?php }
                                if (!empty($department_id)) {
                                    $doctor_name1 = $this->db->select("*")
                                        ->from('user')
                                        ->where('department_id', $department_id)
                                        ->get()
                                        ->row();
                                    if (!empty($doctor_name1->firstname)) { ?>
                                        <lable style="float: right;">Doctor Name: <?//php echo "<span style='font-weight: 600;'>" . $doctor_name1->firstname . "</span>"; ?></lable>
                            <?php }
                                }
                            } ?>


                        </div>
                        <div class="col-xs-2"></div>
                    </div>
                </div>
                <div class="row col-sm-12" style="padding-bottom: 10px;font-size: 14px;">
                    <?php if ($this->session->userdata('status') == 0) { ?>
                        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/checked_data'); ?>">
                            <!--  <form  method="POST" action="<?php echo base_url('patients/checked_data'); ?>" >-->
                            <div class="col-md-2" style="padding-top: 5px;">
                                <input type="radio" name="check" value="0" <?php if ((empty($check_data)) || ($check_data[0]->check_date == 0)) {
                                                                                echo "checked";
                                                                            } ?>>Unchecked
                                <input type="radio" name="check" value="1" <?php if ((!empty($check_data)) && ($check_data[0]->check_date == 1)) {
                                                                                echo "checked";
                                                                            } ?>>checked
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="start_date1" class="form-control" id="start_date1" style="width:155px; margin-left: -21px;">
                                <input type="hidden" name="section" value="<?php if (($this->uri->segment(2) == 'opd') || ($this->uri->segment(2) == 'ipd')) {
                                                                                echo $this->uri->segment(2);
                                                                            } else {
                                                                                echo $_GET['section'];
                                                                            } ?>">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" class="btn btn-default active" value="Save" style="margin-left: -41px;">
                            </div>
                        </form>
                    <?php } ?>
                    <!--<div style="float: right;" >
                    <button onclick="excel_all_customer('<?php echo date('Y-m-d', strtotime($datefrom)); ?>','<?php echo date('Y-m-d', strtotime($dateto)); ?>','<?php echo $ipd; ?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button>
                    </div>-->
                </div>

                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php if ($gob == 'gob') {
                                                                                                                echo "style='font-size:10px;'";
                                                                                                            } ?> style="display:  <?php if ($summery_report == 1) {
                                                                                                                                                                                                echo "none";
                                                                                                                                                                                            } ?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <?php if ($ipd == 'ipd') { ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>


                            <th style="width: 30px; text-align: center;" colspan="2">

                                <?php echo "COPD" ?>
                            </th>


                            <th rowspan="2"><?php echo "Name" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo display('sex') ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Age" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo display('address') ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Bed No"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Provisional Dignosis" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Final Diagnosis"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Doctor"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "DOA" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "DOD" ?></th>

                            <!--  <th style="width: 30px;" rowspan="2"><?php echo "Treat. Start Date" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "RX1" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "RX2" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "RX3" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "RX4" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "RX5" ?></th>
                          <th style="width: 30px;" rowspan="2"><?php echo "Other Equipment" ?></th>-->
                            <th style="width: 30px;" rowspan="2"><?php echo "Panchakarma" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Investigation" ?></th>
                        </tr>
                        <tr>

                            <th style="width: 30px;">

                                <?php echo "New No" ?>
                            </th>
                            <th style="width: 30px;"><?php echo "Old No" ?></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                            $datefrom1 = date('Y-m-d', strtotime($datefrom));
                            $year1 = date('Y', strtotime($datefrom));
                            $year2 = '%' . $year1 . '%';

                            $ddd = date('Y-m-d', strtotime("-1day" . $datefrom1));

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('yearly_reg_no !=', '');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient');
                            $num = $query->num_rows();

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('old_reg_no !=', '');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient');
                            $num1 = $query->num_rows();

                            $tot_serial1 = $num + $num1;

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'ipd');
                            // $this->db->where('old_reg_no !=','');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient_ipd');
                            $num_ipd = $query->num_rows();

                            $tot_serial_ipd = $num_ipd;

                            // for department serial no

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('yearly_reg_no !=', '');
                            $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query_d = $this->db->get('patient');
                            $num_d = $query_d->num_rows();

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
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


                            ;
                            $array_no = count($patients);
                            $tot_serial = $tot_serial1 + $array_no + 1;

                            $this->db->select('*');
                            // $this->db->where('ipd_opd', 'opd');
                            $this->db->where('discharge_date like', '%0000-00-00%');
                            $this->db->where('create_date <=', date('Y-m-d') . " 23:59:00");
                            // $this->db->where('create_date LIKE', $year2);
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


                            ?>
                            <?php $i = 0;
                            $vs_mn = 0;
                            $vs_mo = 0;
                            $vs_fn = 0;
                            $vs_fo = 0;
                            $vs_tt = 0;
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
                            $ky_ttn = 0;
                            $ky_ttan = 0;
                            $ky_ttdn = 0;
                            $pn_mn = 0;
                            $pn_mo = 0;
                            $pn_fn = 0;
                            $pn_fo = 0;
                            $pn_tt = 0;
                            $pn_ttn = 0;
                            $pn_ttan = 0;
                            $pn_ttdn = 0;
                            $ba_mn = 0;
                            $ba_mo = 0;
                            $ba_fn = 0;
                            $ba_fo = 0;
                            $ba_tt = 0;
                            $ba_ttn = 0;
                            $ba_ttan = 0;
                            $ba_ttdn = 0;
                            $sly_mn = 0;
                            $sly_mo = 0;
                            $sly_fn = 0;
                            $sly_fo = 0;
                            $sly_tt = 0;
                            $sly_ttn = 0;
                            $sly_ttan = 0;
                            $sly_ttdn = 0;
                            $sky_mn = 0;
                            $sky_mo = 0;
                            $sky_fn = 0;
                            $sky_fo = 0;
                            $sky_tt = 0;
                            $sky_ttn = 0;
                            $sky_ttan = 0;
                            $sky_ttdn = 0;
                            $st_mn = 0;
                            $st_mo = 0;
                            $st_fn = 0;
                            $st_fo = 0;
                            $st_tt = 0;
                            $st_ttn = 0;
                            $st_ttan = 0;
                            $st_ttdn = 0;
                            $sw_mn = 0;
                            $sw_mo = 0;
                            $sw_fn = 0;
                            $sw_fo = 0;
                            $sw_tt = 0;


                            foreach ($patients as $patient) {
                                $i++;

                                $dd = date('Y-m-d', strtotime($patient->discharge_date));
                                $aa = date('Y-m-d', strtotime($patient->create_date));
                                $dd12 = date('Y-m-d', strtotime($_GET['end_date']));
                                if ($_GET['end_date']) {
                                    $dd1 = date('Y-m-d', strtotime($_GET['end_date']));
                                } else {
                                    $dd1 = date('Y-m-d');
                                }



                                //atya
                                if ($patient->department_id == '35' && $dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $aa_mn += $patient->yearly_reg_no ? 1 : 0;
                                $aa_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $aa_fn += $patient->yearly_reg_no ? 1 : 0;
                                $aa_fo += $patient->old_reg_no ? 1 : 0;
                                }
                                $aa_tt++;
                                }



                                //kay
                                if ($patient->department_id == '34' && $dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $ky_mn += $patient->yearly_reg_no ? 1 : 0;
                                $ky_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $ky_fn += $patient->yearly_reg_no ? 1 : 0;
                                $ky_fo += $patient->old_reg_no ? 1 : 0;
                                }

                                $ky_tt++; // Always increment total for department 34

                                // Additional conditions
                                if ($aa != $dd1) {
                                $ky_ttn++;
                                }
                                } elseif ($patient->department_id == '34' && $dd == $dd1) {
                                $ky_ttdn++;
                                }

                                if ($patient->department_id == '34' && $aa == $dd1) {
                                $ky_ttan++;
                                }



                                //pan
                                if ($patient->department_id == '33' && $dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $pn_mn += $patient->yearly_reg_no ? 1 : 0;
                                $pn_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $pn_fn += $patient->yearly_reg_no ? 1 : 0;
                                $pn_fo += $patient->old_reg_no ? 1 : 0;
                                }

                                $pn_tt++; // Increment total for department 33

                                if ($aa != $dd1) {
                                $pn_ttn++;
                                }
                                } elseif ($patient->department_id == '33' && $dd == $dd1) {
                                $pn_ttdn++;
                                }

                                if ($patient->department_id == '33' && $aa == $dd1) {
                                $pn_ttan++;
                                }



                                //bal
                                if ($patient->department_id == '32' && $dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $ba_mn += $patient->yearly_reg_no ? 1 : 0;
                                $ba_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $ba_fn += $patient->yearly_reg_no ? 1 : 0;
                                $ba_fo += $patient->old_reg_no ? 1 : 0;
                                }

                                $ba_tt++; // Total for department 32

                                if ($aa != $dd1) {
                                $ba_ttn++;
                                }
                                } elseif ($patient->department_id == '32' && $dd == $dd1) {
                                $ba_ttdn++;
                                }

                                if ($patient->department_id == '32' && $aa == $dd1) {
                                $ba_ttan++;
                                }




                                //sly
                                if ($patient->department_id == '31' && $dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $sly_mn += $patient->yearly_reg_no ? 1 : 0;
                                $sly_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $sly_fn += $patient->yearly_reg_no ? 1 : 0;
                                $sly_fo += $patient->old_reg_no ? 1 : 0;
                                }

                                $sly_tt++; // Increment total for department 31

                                if ($aa != $dd1) {
                                $sly_ttn++;
                                }
                                } elseif ($patient->department_id == '31' && $dd == $dd1) {
                                $sly_ttdn++;
                                }

                                if ($patient->department_id == '31' && $aa == $dd1) {
                                $sly_ttan++;
                                }



                                //sky
                                if ($patient->department_id == '30' && $dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $sky_mn += $patient->yearly_reg_no ? 1 : 0;
                                $sky_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $sky_fn += $patient->yearly_reg_no ? 1 : 0;
                                $sky_fo += $patient->old_reg_no ? 1 : 0;
                                }

                                $sky_tt++; // Total for department 30

                                if ($aa != $dd1) {
                                $sky_ttn++;
                                }
                                } elseif ($patient->department_id == '30' && $dd == $dd1) {
                                $sky_ttdn++;
                                }

                                if ($patient->department_id == '30' && $aa == $dd1) {
                                $sky_ttan++;
                                }



                                //st
                                if ($patient->department_id == '29') {
                                if ($dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $st_mn += $patient->yearly_reg_no ? 1 : 0;
                                $st_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $st_fn += $patient->yearly_reg_no ? 1 : 0;
                                $st_fo += $patient->old_reg_no ? 1 : 0;
                                }

                                $st_tt++; // Total for department 29

                                if ($aa != $dd1) {
                                $st_ttn++;
                                }
                                } elseif ($dd == $dd1) {
                                $st_ttdn++;
                                }

                                if ($aa == $dd1) {
                                $st_ttan++;
                                }
                                }


                                //sw
                                if ($patient->department_id == '28') {
                                if ($dd != $dd1) {
                                if ($patient->sex == 'M') {
                                $sw_mn += $patient->yearly_reg_no ? 1 : 0;
                                $sw_mo += $patient->old_reg_no ? 1 : 0;
                                } elseif ($patient->sex == 'F') {
                                $sw_fn += $patient->yearly_reg_no ? 1 : 0;
                                $sw_fo += $patient->old_reg_no ? 1 : 0;
                                }
                                $sw_tt++; // Total for department 28
                                }
                                }


                                //vis
                                if ($patient->department_id == '27') {
                                if ($patient->sex == 'M') {
                                if ($patient->yearly_reg_no) {
                                if ($dd != $dd1) {
                                $vs_mn++;
                                }
                                } elseif ($patient->old_reg_no) {
                                $vs_mo++;
                                }
                                } elseif ($patient->sex == 'F') {
                                if ($patient->yearly_reg_no) {
                                if ($dd != $dd1) {
                                $vs_fn++;
                                }
                                } elseif ($patient->old_reg_no) {
                                if ($dd != $dd1) {
                                $vs_fo++;
                                }
                                }
                                }

                                if ($dd != $dd1) {
                                $vs_tt++; // Total for department 27
                                }
                                }


                                $date_c = date('Y-m-d', strtotime($patient->create_date));
                                $date_d = date('Y-m-d', strtotime($patient->discharge_date));
                                $date_f = date('Y-m-d', strtotime($dateto));
                                $tot_serial--;
                                $tot_serial1++;
                                $tot_serial_ipd++;

                                $date_f1 = date('Y-m-d', strtotime($dateto));
                                $date_f2 = '%' . $date_f1 . '%';
                                $opd_ipd_p = $this->db->select("*")

                                    ->from('patient_ipd')

                                    ->where('yearly_reg_no', $patient->yearly_reg_no)
                                    ->where('old_reg_no ', $patient->old_reg_no)
                                    ->where('create_date LIKE', $date_f2)
                                    ->get()
                                    ->row();
                                //print_r($opd_ipd_p);
                                $New_OPD = $opd_ipd_p->yearly_reg_no;
                                $old_OPD = $opd_ipd_p->old_reg_no;

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
                                    $section_tret = 'opd';
                                    $che = trim($patient->dignosis);
                                    $section_tret = 'opd';
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


                                /*$ss=date('Y-m-d',strtotime($dateto));
                                    if($ss <= '202-01-28'){
                                        $table='treatments';
                                    }else{
                                        
                                         $table='treatments1';
                                    }
                                    */

                                if ($patient->manual_status == 0) {

                                    $tretment = $this->db->select("*")

                                        ->from('treatments1')

                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('proxy_id', $patient->proxy_id)
                                        ->where('department_id', $patient->department_id)
                                        ->where('ipd_opd', $section_tret)
                                        ->get()
                                        ->row();

                                    if (empty($tretment)) {


                                        $tretment = $this->db->select("*")

                                            ->from('treatments1')

                                            //->where('dignosis LIKE',$p_dignosis)
                                            //->where('ipd_opd ',$section_tret)
                                            ->where('department_id', $patient->department_id)
                                            ->where('ipd_opd', $patient->department_id)
                                            ->get()
                                            ->row();
                                    }
                                } else {
                                    $tretment = $this->db->select("*")

                                        ->from('manual_treatments')
                                        ->where('patient_id_auto', $patient->id)
                                        //->where('dignosis LIKE',$p_dignosis)
                                        ->where('ipd_opd ', $section_tret)
                                        ->get()
                                        ->row();
                                }

                                $RX1 = $tretment->RX1;
                                $RX2 = $tretment->RX2;
                                $RX3 = $tretment->RX3;
                                $RX4 = $tretment->RX4;
                                $RX5 = $tretment->RX5;

                                $RX_other = $tretment->RX_other;
                                $RX_other1 = $tretment->RX_other1;
                                $other_equipment = $tretment->other_equipment;

                                $KARMA = $tretment->KARMA;
                                $PK1 = $tretment->PK1;
                                $PK2 = $tretment->PK2;
                                $SWA1 = $tretment->SWA1;
                                $SWA2 = $tretment->SWA2;

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



                                $HEMATOLOGICAL = $tretment->HEMATOLOGICAL;
                                $SEROLOGYCAL = $tretment->SEROLOGYCAL;
                                $BIOCHEMICAL = $tretment->BIOCHEMICAL;
                                $MICROBIOLOGICAL = $tretment->MICROBIOLOGICAL;

                                $X_RAY = $tretment->X_RAY;
                                $ECG = $tretment->ECG;


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

                                if ($patient->manual_status == 0) {
                                    $tretarray = $this->db->select("*")
                                        ->from('treatments1')
                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('proxy_id', $patient->proxy_id)
                                        ->where('department_id', $patient->department_id)
                                        ->where('ipd_opd', 'ipd')
                                        ->get()
                                        ->result();
                                    if (empty($tretarray)) {

                                        $tretarray = $this->db->select("*")
                                            ->from('treatments1')
                                            ->where('dignosis LIKE', $p_dignosis)
                                            ->where('department_id', $patient->department_id)
                                            ->where('ipd_opd', 'ipd')
                                            ->get()
                                            ->result();
                                        if (empty($tretarray)) {

                                            $tretarray = $this->db->select("*")
                                                ->from('treatments1')
                                                ->where('department_id', $patient->department_id)
                                                ->where('ipd_opd', $patient->department_id)
                                                ->get()
                                                ->result();
                                        }
                                    }
                                } else {
                                    $tretarray = $this->db->select("*")
                                        ->from('manual_treatments')
                                        ->where('patient_id_auto', $patient->id)
                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('ipd_opd ', $section_tret)
                                        ->get()
                                        ->result();
                                }
                                //print_r($tretarray);
                                if (count($tretarray) == 2) {
                                    $rowFlag = 1;
                                } else {
                                    $rowFlag = 0;
                                }

                            ?>

                                <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>" style="  <?php if (($date_c == $date_f) && ($ipd == 'ipd')) {
                                                                                                            echo "color: #ff000d;font-weight: bold;";
                                                                                                        } else if (($date_d == $date_f) && ($ipd == 'ipd')) {
                                                                                                            echo "color: #4dd208;font-weight: bold;";
                                                                                                        } else if (($New_OPD == $patient->yearly_reg_no) && ($old_OPD == $patient->old_reg_no) && ($ipd == 'opd')) {
                                                                                                            echo "color: #ff000d;font-weight: bold;";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>">

                                    <?php if ($getpatientbydepartment_date == 'D') { ?>
                                        <td <?php if ($rowFlag == 1) {
                                                echo 'rowspan="2"';
                                            } ?> style="padding:2px;"><?php if ($ipd == opd) {
                                                                                                                        echo $tot_serial1_d++;
                                                                                                                    } else {
                                                                                                                        echo $i;
                                                                                                                    } ?></td>
                                    <?php } else { ?>
                                        <td <?php if ($rowFlag == 1) {
                                                echo 'rowspan="2"';
                                            } ?> style="padding:2px;"><?php if ($ipd == 'ipd') {
                                                                                                                        echo $i;
                                                                                                                    } else {
                                                                                                                        echo $tot_serial1;
                                                                                                                    } ?></td>
                                    <?php } ?>

                                    <!--<? //php if($ipd == 'ipd'){ 
                                        ?><td  style="padding:2px;"><? //php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;} 
                                                                                                ?></td> <? //php } 
                                                                                                                                                                                                                        ?>  -->


                                    <?php if ($ipd == 'ipd') { ?>
                                        <?php if ($cyear < '2022') { ?>
                                            <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                            echo 'rowspan="2"';
                                                                        } ?>><?php if ($department_by_section == 'ipd') {
                                                                                                                            echo $tot_serial_ipd_change;
                                                                                                                        } else {
                                                                                                                            echo $tot_serial_ipd_change++;
                                                                                                                        } ?></td>

                                        <?php } else { ?>
                                            <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                            echo 'rowspan="2"';
                                                                        } ?>><?php if ($department_by_section == 'ipd') {
                                                                                                                            echo $tot_serial_ipd_change;
                                                                                                                        } else {
                                                                                                                            echo $tot_serial_ipd_change++;
                                                                                                                        } ?></td>
                                        <?php  } ?>
                                    <?php } ?>




                                    <td <?php if ($rowFlag == 1) {
                                            echo 'rowspan="2"';
                                        } ?>>
                                        <?php
                                        $year = $this->session->userdata['acyear'];

                                        $y = date('Y', strtotime($patient->fol_up_date));
                                        if ($y == '1970') {
                                            $y = $year;
                                            $yy = substr($y, 2, 2);
                                        } else {
                                            $yy = substr($y, 2, 2);
                                        }
                                        if ($patient->yearly_reg_no != null) {
                                            echo     $yearly_reg_no = $patient->yearly_reg_no . "/" . $yy;
                                            // echo ".".$yy."(New)";
                                        } else {
                                        } ?>
                                    </td>

                                    <td <?php if ($rowFlag == 1) {
                                            echo 'rowspan="2"';
                                        } ?>>
                                        <?php

                                        $y = date('Y', strtotime($patient->fol_up_date));
                                        if ($y == '1970') {
                                            $y = $year;
                                            $yy = substr($y, 2, 2);
                                        } else {
                                            $yy = substr($y, 2, 2);
                                        }
                                        if ($patient->yearly_reg_no != null) {
                                        } else {
                                            echo    $old_reg_no = $patient->old_reg_no . "/" . $yy;
                                            //echo  ".".$yy."(Old)";
                                        } ?>
                                    </td>
                                    <!--<td><?php echo $patient->ipd_no ?></td>-->

                                    <td style="width: 159px;" style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                                        echo 'rowspan="2"';
                                                                                    } ?>><?php echo $patient->firstname; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->sex; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->date_of_birth; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->address; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->name; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->bedNo; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $p_dignosis_name; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $tretarray[0]->POVISIONALdignosis; ?></td>
                                    <?php
                                    $doctor_name = $this->db->select("*")
                                        ->from('user')
                                        ->where('department_id', $patient->department_id)
                                        ->where('user_id', $patient->doctor_id)
                                        ->get()
                                        ->row();
                                    ?>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $doctor_name->firstname; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo date('d-m-Y', strtotime($patient->create_date)); ?></td>
 <td style="padding:2px;" <?php if ($rowFlag == 1) {echo 'rowspan="2"';} ?>>
 <?php if ($patient->discharge_date == '0000-00-00') {echo "-";} else {echo date('d-m-Y', strtotime($patient->discharge_date));} ?></td>
                                  
                                  <!--  <td style="padding:2px;"><?php echo date('d-m-Y', strtotime($patient->create_date)); ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[0]->RX1; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[0]->RX2; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[0]->RX3; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[0]->RX4; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[0]->RX5; ?></td>

                                    <td style="padding:2px;"><?php echo $tretarray[0]->RX_other . '<br>' . $tretarray[0]->RX_other1 . '<br>' . $tretarray[0]->other_equipment; ?></td> -->

  <td  style="padding:2px;">
                                                <?php if($SNEHAN){ echo $SNEHAN.', <br>'; } ?>
                                                <?php if($SWEDAN){ echo $SWEDAN.', <br>'; } ?>
                                                <?php if($VAMAN){ echo $VAMAN.', <br>'; } ?>
                                                <?php if($VIRECHAN){ echo $VIRECHAN.', <br>'; } ?>
                                                <?php if($BASTI){ echo $BASTI.', <br>'; } ?>
                                                <?php if($NASYA){ echo $NASYA.', <br>'; } ?>
                                                <?php if($RAKTAMOKSHAN){ echo $RAKTAMOKSHAN.', <br>'; } ?>
                                                <?php if($SHIRODHARA_SHIROBASTI){ echo $SHIRODHARA_SHIROBASTI.', <br>'; } ?>
                                                <?php if($SHIROBASTI){ echo $SHIROBASTI.', <br>'; } ?>
                                                <?php if($OTHER){ echo $OTHER.', <br>'; } ?>
                                                
                                                <?php if($YONIDHAVAN){ echo $YONIDHAVAN.', <br>'; } ?>
                                                <?php if($YONIPICHU){ echo $YONIPICHU.', <br>'; } ?>
                                                <?php if($UTTARBASTI){ echo $UTTARBASTI.', <br>'; } ?>
                                                
                                            </td>  
 <td  style="padding:2px;">
                                                    <?php if($HEMATOLOGICAL){ echo $HEMATOLOGICAL.', <br>'; } ?>
                                                    <?php if($SEROLOGYCAL){ echo $SEROLOGYCAL.', <br>'; } ?>
                                                    <?php if($BIOCHEMICAL){ echo $BIOCHEMICAL.', <br>'; } ?>
                                                    <?php if($MICROBIOLOGICAL){ echo $MICROBIOLOGICAL.', <br>'; } ?>
                                                    <?php if($X_RAY){ echo $X_RAY.', <br>'; } ?>
                                                    <?php if($ECG){ echo $ECG.', <br>'; } ?>
                                                </td>

                                <!--    <td style="padding:2px;">
                                        <?php if ($tretarray[0]->$SNEHAN) {
                                            echo $tretarray[0]->SNEHAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$SWEDAN) {
                                            echo $tretarray[0]->SWEDAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$VAMAN) {
                                            echo $tretarray[0]->VAMAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$VIRECHAN) {
                                            echo $tretarray[0]->VIRECHAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$BASTI) {
                                            echo $tretarray[0]->BASTI . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$NASYA) {
                                            echo $tretarray[0]->NASYA . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$RAKTAMOKSHAN) {
                                            echo $tretarray[0]->RAKTAMOKSHAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$SHIRODHARA_SHIROBASTI) {
                                            echo $tretarray[0]->SHIRODHARA_SHIROBASTI . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->$OTHER) {
                                            echo $tretarray[0]->OTHER . ' ,' . '<br>';
                                        } ?>
                                    </td>  -->
                                   <!-- <td style="padding:2px;">
                                        <?php if ($tretarray[0]->HEMATOLOGICAL) {
                                            echo $tretarray[0]->HEMATOLOGICAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->SEROLOGYCAL) {
                                            echo $tretarray[0]->SEROLOGYCAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->BIOCHEMICAL) {
                                            echo $tretarray[0]->BIOCHEMICAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->MICROBIOLOGICAL) {
                                            echo $tretarray[0]->MICROBIOLOGICAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->X_RAY) {
                                            echo $tretarray[0]->X_RAY . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->ECG) {
                                            echo  $tretarray[0]->ECG . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[0]->USG) {
                                            echo  $tretarray[0]->USG . ' ,' . '<br>';
                                        } ?>
                                    </td> -->
                                </tr>
                                <?php if ($rowFlag == 1) { ?>
                                    <tr>
                                        <!--  <?php $days = $tretarray[0]->DISTRIBUTION_IPD; ?>
                                    <td style="padding:2px;"><?php echo date('d-m-Y', strtotime($days . " days", strtotime($patient->create_date))); ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[1]->RX1; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[1]->RX2; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[1]->RX3; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[1]->RX4; ?></td>
                                    <td style="padding:2px;"><?php echo $tretarray[1]->RX5; ?></td>
                                   <td style="padding:2px;"><?php echo $tretarray[1]->RX_other . '<br>' . $tretarray[1]->RX_other1 . '<br>' . $tretarray[1]->other_equipment; ?></td>
                                    <td style="padding:2px;">
                                        <?php if ($tretarray[1]->SNEHAN) {
                                            echo $tretarray[1]->SNEHAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->SWEDAN) {
                                            echo $tretarray[1]->SWEDAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->VAMAN) {
                                            echo $tretarray[1]->VAMAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->VIRECHAN) {
                                            echo $tretarray[1]->VIRECHAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->BASTI) {
                                            echo $tretarray[1]->BASTI . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->NASYA) {
                                            echo $tretarray[1]->NASYA . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->RAKTAMOKSHAN) {
                                            echo $tretarray[1]->RAKTAMOKSHAN . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->SHIRODHARA_SHIROBASTI) {
                                            echo $tretarray[1]->SHIRODHARA_SHIROBASTI . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->OTHER) {
                                            echo $tretarray[1]->OTHER . ' ,' . '<br>';
                                        } ?>
                                    </td>
                                    <td style="padding:2px;">
                                        <?php if ($tretarray[1]->HEMATOLOGICAL) {
                                            echo $tretarray[1]->HEMATOLOGICAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->SEROLOGYCAL) {
                                            echo $tretarray[1]->SEROLOGYCAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->BIOCHEMICAL) {
                                            echo $tretarray[1]->BIOCHEMICAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->MICROBIOLOGICAL) {
                                            echo $tretarray[1]->MICROBIOLOGICAL . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->X_RAY) {
                                            echo $tretarray[1]->X_RAY . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->ECG) {
                                            echo  $tretarray[1]->ECG . ' ,' . '<br>';
                                        } ?>
                                        <?php if ($tretarray[1]->USG) {
                                            echo  $tretarray[1]->USG . ' ,' . '<br>';
                                        } ?>
                                    </td>  -->
                                    </tr>
                                <?php } ?>
                                <?php $sl++; ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table> <!-- /.table-responsive -->
                <!-- Table Summery -->



                <h3>Report Summary</h3>

                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Name" ?></th>
                            <th style="width: 30px; text-align: center;" colspan="2">

                                <?php echo "Male" ?>
                            </th>
                            <th style="width: 30px; text-align: center;" colspan="2">

                                <?php echo "Female" ?>
                            </th>

                            <th rowspan="2">Total</th>

                        </tr>
                        <tr>

                            <th>

                                <?php echo "New No" ?>
                            </th>
                            <th><?php echo "Old No" ?></th>
                            <th>

                                <?php echo "New No" ?>
                            </th>
                            <th><?php echo "Old No" ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1;
                        $male_new = array($aa_mn, $ky_mn, $pn_mn, $ba_mn, $sly_mn, $sky_mn, $st_mn, $sw_mn,$vs_mn);
                        $male_old = array($aa_mo, $ky_mo, $pn_mo, $ba_mo, $sly_mo, $sky_mo, $st_mo, $sw_mo,$vs_mo);

                        $female_new = array($aa_fn, $ky_fn, $pn_fn, $ba_fn, $sly_fn, $sky_fn, $st_fn, $sw_fn,$vs_fn);
                        $female_old = array($aa_fo, $ky_fo, $pn_fo, $ba_fo, $sly_fo, $sky_fo, $st_fo, $sw_fo,$vs_fo);

                        $total = array($aa_tt, $ky_tt, $pn_tt, $ba_tt, $sly_tt, $sky_tt, $st_tt, $sw_tt,$vs_tt);


                        $dept = $this->db->select("*")
                            ->from('department')
                            ->order_by('dprt_id', 'desc')
                            ->get()
                            ->result_array();


                            

                        for ($i = 0; $i < count($dept); $i++) { ?>
                            <?php if ($total[$i] != '0') { ?> <tr>
                                    <td><?php echo $n++; ?></td>
                                    <td><?php if (($dept[$i]['name'] == 'Swasthrakshnam') && ($ipd == 'ipd')) {
                                            echo $dept[$i]['name'] . "-KC";
                                        } else {
                                            echo $dept[$i]['name'];
                                        } ?></td>
                                    <td><?php echo $male_new[$i]; ?></td>
                                    <td><?php echo $male_old[$i]; ?></td>
                                    <td><?php echo $female_new[$i]; ?></td>
                                    <td><?php echo $female_old[$i]; ?></td>
                                    <td><?php echo $total[$i]; ?></td>
                                </tr>
                        <?php }
                        } ?>

                        <tr>
                            <td colspan="6">Grand Total</td>
                            <td><?php echo array_sum($total); ?></td>
                        <tr></tr>
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
                    "url": "<?php echo base_url('patientList/opd') ?>",
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

    function excel_all_customer(date1, date2, section) {
        //alert(date1+" "+date2);
        window.location = 'excel_all_customer?date1=' + date1 + '&date2=' + date2 + '&section=' + section;
        //	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
        // location.href='www.google.com';
    }
</script>