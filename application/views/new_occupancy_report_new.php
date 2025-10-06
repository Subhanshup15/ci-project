<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">


    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET"
            action="<?php echo base_url('Patients/new_occupancy_report_new') ?>">

            <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; 
            ?>">-->


            <div class="form-group">

                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

                <input type="text" name="start_date" class="form-control datepicker" id="start_date"
                    placeholder="<?php echo display('start_date') ?>">

            </div>

            <div class="form-group">

                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

                <input type="text" name="end_date" class="form-control datepicker" id="end_date"
                    placeholder="<?php echo display('end_date') ?>">

            </div>


            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>



        </form>
    </div>
    <div class="col-sm-12">

        <div class="col-sm-12" id="PrintMe">

            <div class="panel panel-default thumbnail">
                <div class="panel-heading no-print">
                    <div class="btn-group">
                        <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i
                                class="fa fa-print"></i></button>
                    </div>
                </div>


                <div class="panel-body">
                    <div class="col-xs-2" align="left">
                        <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>"
                            style="height:100%; width:100%;border: 0.5px solid #0003;" />
                    </div>
                    <div class="col-xs-8" align="center">
                        <h3 style="margin-top: 0px; margin-bottom: 0px;">
                            <strong><?php echo $this->session->userdata('title') ?></strong>
                        </h3>
                        <h4 style="margin-top: 5px;margin-bottom: 5px;">
                            <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                        </h4>


                        <h3>Monthly Wise Bed Occupancy Report</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-
                            <?php echo date("d/m/Y", strtotime($datefrom)) ?> To
                            <?php echo date("d/m/Y", strtotime($dateto)) ?>
                        </h4>

                    </div>
                    <div class="col-xs-2"></div>
                    <?php
                    // $date1 = date_create($datefrom);
                    // $date2 = date_create($dateto);
                    // $diff = date_diff($date1, $date2);
                    // $days = $diff->format('%a');
                    
                    $date1 = date_create($datefrom);
                    $date2 = date_create($dateto);
                    $diff = date_diff($date1, $date2);
                    // $days = $diff->format('%a');
                    
                    $interval = $date1->diff($date2);
                    $days = $interval->format('%a') + 1;
                    //echo $days; 
                    $previous_new = 0;
                    $total = 0;
                    $ipdPatientCount = array();
                    $aa = 1;

                    $jan_grand_total = 0;
                    $feb_grand_total = 0;
                    $march_grand_total = 0;
                    $april_grand_total = 0;
                    $may_grand_total = 0;
                    $june_grand_total = 0;
                    $jully_grand_total = 0;
                    $aug_grand_total = 0;
                    $sept_grand_total = 0;
                    $oct_grand_total = 0;
                    $nov_grand_total = 0;
                    $dec_grand_total = 0;
                    $all_month_grand_total = 0;
                    ?>
                    <!-- First Table - Gender-related data -->
                    <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>March</th>
                                <th>April</th>
                                <th>May</th>
                                <th>June</th>
                                <th>Jully</th>
                                <th>Aug</th>
                                <th>Sep</th>
                                <th>Oct</th>
                                <th>Nov</th>
                                <th>Dec</th>
                                <th>Grand Total</th>

                                <th>Department Wise Occupancy
                                <th>


                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $a = 1;


                            $date1 = date_create($datefrom);
                            $date2 = date_create($dateto);
                            $diff = date_diff($date1, $date2);
                            $days = $diff->format('%a');
                            //echo $days; 
                            $previous_new = 0;
                            $total = 0;
                            $ipdPatientCount = array();
                            $aa = 1;
                            $Grand_total = 0;
                            foreach ($department as $dept) { ?>
                                <tr>
                                    <th><?php echo $a++; ?></th>
                                    <th><?php echo $dept->name; ?></th>
                                    <th>
                                        <?php
                                        $jan_total = 0;
                                        $jan_days = 0;

                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }





                                        for ($i = 0; $i < $daysn; $i++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$i days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '01') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $jan_total += $count_date_wise->CountDept;

                                                $jan_days++;
                                            }
                                        }
                                        // echo $jan_days;
                                        echo $jan_total;

                                        $jan_grand_total += $jan_total;

                                        ?>
                                    </th>


                                    <th>


                                        <?php
                                        $feb_total = 0;
                                        $feb_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($j = 0; $j < $daysn; $j++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$j days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '02') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $feb_total += $count_date_wise->CountDept;
                                                $feb_days++;
                                            }
                                        }
                                        echo $feb_total;

                                        $feb_grand_total += $feb_total;
                                        ?>


                                    </th>


                                    <th>

                                        <?php
                                        $march_total = 0;
                                        $march_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($k = 0; $k < $daysn; $k++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$k days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '03') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $march_total += $count_date_wise->CountDept;
                                                $march_days++;
                                            }
                                        }
                                        echo $march_total;

                                        $march_grand_total += $march_total;
                                        ?>

                                    </th>
                                    <th>
                                        <?php
                                        $april_total = 0;
                                        $april_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($l = 0; $l < $daysn; $l++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$l days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '04') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $april_total += $count_date_wise->CountDept;
                                                $april_days++;
                                            }
                                        }
                                        echo $april_total;

                                        $april_grand_total += $april_total;
                                        ?>
                                    </th>
                                    <th>
                                        <?php
                                        $may_total = 0;
                                        $may_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($m = 0; $m < $daysn; $m++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$m days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '05') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $may_total += $count_date_wise->CountDept;
                                                $may_days++;
                                            }
                                        }
                                        echo $may_total;

                                        $may_grand_total += $may_total;
                                        ?>

                                    </th>
                                    <th>
                                        <?php
                                        $june_total = 0;
                                        $june_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($n = 0; $n < $daysn; $n++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$n days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '06') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $june_total += $count_date_wise->CountDept;
                                                $june_days++;
                                            }
                                        }
                                        echo $june_total;

                                        $june_grand_total += $june_total;
                                        ?>

                                    </th>
                                    <th>

                                        <?php
                                        $jully_total = 0;
                                        $jully_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($o = 0; $o < $daysn; $o++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$o days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '07') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $jully_total += $count_date_wise->CountDept;
                                                $jully_days++;
                                            }
                                        }
                                        echo $jully_total;
                                        $jully_grand_total += $jully_total;
                                        ?>


                                    </th>
                                    <th>

                                        <?php
                                        $aug_total = 0;
                                        $aug_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($p = 0; $p < $daysn; $p++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$p days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '08') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $aug_total += $count_date_wise->CountDept;
                                                $aug_days++;
                                            }
                                        }
                                        echo $aug_total;
                                        $aug_grand_total += $aug_total;
                                        ?>



                                    </th>
                                    <th>

                                        <?php
                                        $sept_total = 0;
                                        $sept_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($q = 0; $q < $daysn; $q++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$q days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '09') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $sept_total += $count_date_wise->CountDept;
                                                $sept_days++;
                                            }
                                        }
                                        echo $sept_total;
                                        $sept_grand_total += $sept_total;
                                        ?>

                                    </th>
                                    <th>

                                        <?php
                                        $oct_total = 0;
                                        $oct_days = 0;
                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }
                                        for ($r = 0; $r < $daysn; $r++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$r days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '10') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $oct_total += $count_date_wise->CountDept;
                                                $oct_days++;
                                            }
                                        }
                                        echo $oct_total;
                                        $oct_grand_total += $oct_total;
                                        ?>

                                    </th>
                                    <th>
                                        <?php
                                        $nov_total = 0;
                                        $nov_days = 0;


                                       $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }


                                        for ($s = 0; $s < $daysn; $s++) {
                                            $checkDate = "";

                                            $checkDate = date('d-m-Y', strtotime("+$s days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            if ($MonthOfDate == '11') {

                                                $new_date = date("Y-m-d", strtotime($checkDate));

                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $nov_total += $count_date_wise->CountDept;
                                                $nov_days++;
                                            }
                                        }
                                        echo $nov_total;
                                        $nov_grand_total += $nov_total;
                                        ?>
                                    </th>
                                    <th>

                                        <?php
                                        $dec_total = 0;
                                        $dec_days = 0;


                                        $year = $this->session->userdata['acyear'];
                                        if ($year >= 2025) {
                                            if ($dept->dprt_id == 27) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }
                                        } else {
                                            if ($dept->dprt_id == 29) {
                                                $daysn = $days + 1;
                                            } else {
                                                $daysn = $days;
                                            }

                                        }


                                        for ($t = 0; $t < $daysn; $t++) {
                                            $checkDate = "";
                                            $checkDate = date('d-m-Y', strtotime("+$t days", strtotime($datefrom)));
                                            $MonthOfDate = date('m', strtotime($checkDate));
                                            $new_date = date("Y-m-d", strtotime($checkDate));
                                            if ($MonthOfDate == '12') {
                                                $count_date_wise = $this->db->select('count(id) as CountDept')->from('patient_ipd')
                                                    ->where('create_date <=', $new_date)
                                                    ->group_start()
                                                    ->where('discharge_date >', $new_date)
                                                    ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                    ->group_end()
                                                    ->where('department_id =', $dept->dprt_id)
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()
                                                    ->row();
                                                // print_r($this->db->last_query());
                                                $dec_total += $count_date_wise->CountDept;
                                                $dec_days++;
                                            }
                                        }
                                        echo $dec_total;
                                        $dec_grand_total += $dec_total;
                                        ?>
                                    </th>
                                    <th>


                                        <?php echo $Grand_total =
                                            $jan_total + $feb_total + $march_total + $april_total +
                                            $may_total + $june_total + $jully_total + $aug_total +
                                            $sept_total + $oct_total + $nov_total + $dec_total;
                                        $all_month_grand_total += $Grand_total;
                                        ?>
                                    </th>

                                    <th>

                                        <?php
                                        $year = $this->session->userdata['acyear'];

                                        if ($year >= 2025) {
                                            $table = 'beds';
                                        } elseif ($year == 2024) {
                                            $table = 'beds_2024';
                                        } elseif ($year == 2023) {
                                            $table = 'beds_2023';
                                        } else {  // Corrected this part
                                            $table = 'beds_2023';
                                        }

                                        $this->db->where('department_id', $dept->dprt_id);
                                        $totalBedCount = $this->db->get($table)->num_rows();

                                        // $totalBedCount = $this->db->get($table)->num_rows();
                                        $date1 = date_create($datefrom);
                                        $date2 = date_create($dateto);
                                        $diff = date_diff($date1, $date2);
                                        $days = $diff->format("%a") + 1;
                                        $totalBedOccupancy = number_format(($Grand_total * 100) / ($totalBedCount * $days), 2);
                                        echo $totalBedOccupancy . '%';

                                        ?>

                                    </th>


                                </tr>
                            <?php } ?>

                            <tr>
                                <th colspan='2'>Grand Total</th>
                                <th><?php echo $jan_grand_total; ?></th>
                                <th><?php echo $feb_grand_total; ?></th>
                                <th><?php echo $march_grand_total; ?></th>
                                <th><?php echo $april_grand_total; ?></th>
                                <th><?php echo $may_grand_total; ?></th>
                                <th><?php echo $june_grand_total; ?></th>
                                <th><?php echo $jully_grand_total; ?></th>
                                <th><?php echo $aug_grand_total; ?></th>
                                <th><?php echo $sept_grand_total; ?></th>
                                <th><?php echo $oct_grand_total; ?></th>
                                <th><?php echo $nov_grand_total; ?></th>
                                <th><?php echo $dec_grand_total; ?></th>
                                <th><?php echo $all_month_grand_total; ?></th>
                                <th></th>
                            </tr>

                            <tr>

                            <tr>
                                <th colspan='2'>Month Wise Occupancy</th>

                                <th>
                                    <?php
                                    $year = $this->session->userdata['acyear'];
                                    $totalBedCount = $this->db->get($table)->num_rows();
                                    #   print_r($this->db->last_query());
                                    $date1 = date_create($datefrom);
                                    $date2 = date_create($dateto);
                                    $diff = date_diff($date1, $date2);
                                    $days = $diff->format("%a") + 1;
                                    $jan_days_value = ($jan_days != 0) ? $jan_days : 1;
                                    $totalBedOccupancy = number_format(($jan_grand_total * 100) / ($totalBedCount * $jan_days_value), 2);
                                    echo $totalBedOccupancy . '%';
                                    ?>
                                </th>


                                <th>
                                    <?php
                                    $year = $this->session->userdata['acyear'];
                                    $totalBedCount = $this->db->get($table)->num_rows();
                                    #   print_r($this->db->last_query());
                                    $date1 = date_create($datefrom);
                                    $date2 = date_create($dateto);
                                    $diff = date_diff($date1, $date2);
                                    $days = $diff->format("%a") + 1;
                                    $feb_days_value = ($feb_days != 0) ? $feb_days : 1;
                                    $totalBedOccupancy = number_format(($feb_grand_total * 100) / ($totalBedCount * $feb_days_value), 2);
                                    echo $totalBedOccupancy . '%';
                                    ?>
                                </th>

                                <th>
                                    <?php
                                    $year = $this->session->userdata['acyear'];
                                    $totalBedCount = $this->db->get($table)->num_rows();
                                    #  print_r($this->db->last_query());
                                    $date1 = date_create($datefrom);
                                    $date2 = date_create($dateto);
                                    $diff = date_diff($date1, $date2);
                                    $days = $diff->format("%a") + 1;
                                    $march_days_value = ($march_days != 0) ? $march_days : 1;
                                    $totalBedOccupancy = number_format(($march_grand_total * 100) / ($totalBedCount * $march_days_value), 2);
                                    echo $totalBedOccupancy . '%';
                                    ?>

                                </th>


                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                #  print_r($this->db->last_query());
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $april_days_value = ($april_days != 0) ? $april_days : 1;
                                $totalBedOccupancy = number_format(($april_grand_total * 100) / ($totalBedCount * $april_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>



                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                #    print_r($this->db->last_query());               
                                
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $may_days_value = ($may_days != 0) ? $may_days : 1;
                                $totalBedOccupancy = number_format(($may_grand_total * 100) / ($totalBedCount * $may_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>


                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                #  print_r($this->db->last_query());
                                
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $june_days_value = ($june_days != 0) ? $june_days : 1;
                                $totalBedOccupancy = number_format(($june_grand_total * 100) / ($totalBedCount * $june_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>


                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                #  print_r($this->db->last_query());
                                
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $jully_days_value = ($jully_days != 0) ? $jully_days : 1;
                                $totalBedOccupancy = number_format(($jully_grand_total * 100) / ($totalBedCount * $jully_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>



                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $aug_days_value = ($aug_days != 0) ? $aug_days : 1;
                                $totalBedOccupancy = number_format(($aug_grand_total * 100) / ($totalBedCount * $aug_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>




                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                #   print_r($this->db->last_query());
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $sept_days_value = ($sept_days != 0) ? $sept_days : 1;
                                $totalBedOccupancy = number_format(($sept_grand_total * 100) / ($totalBedCount * $sept_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>


                                <th><?php
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get($table)->num_rows();
                                $date1 = date_create($datefrom);
                                $date2 = date_create($dateto);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a") + 1;
                                $oct_days_value = ($oct_days != 0) ? $oct_days : 1;
                                $totalBedOccupancy = number_format(($oct_grand_total * 100) / ($totalBedCount * $oct_days_value), 2);
                                echo $totalBedOccupancy . '%';
                                ?>
                                </th>

                                <th>
                                    <?php
                                    $year = $this->session->userdata['acyear'];
                                    $totalBedCount = $this->db->get($table)->num_rows();
                                    #   print_r($this->db->last_query());
                                    
                                    $date1 = date_create($datefrom);
                                    $date2 = date_create($dateto);
                                    $diff = date_diff($date1, $date2);
                                    $days = $diff->format("%a") + 1;
                                    $nov_days_value = ($nov_days != 0) ? $nov_days : 1;
                                    $totalBedOccupancy = number_format(($nov_grand_total * 100) / ($totalBedCount * $nov_days_value), 2);
                                    echo $totalBedOccupancy . '%';
                                    ?>
                                </th>


                                <th>
                                    <?php
                                    $year = $this->session->userdata['acyear'];
                                    $totalBedCount = $this->db->get($table)->num_rows();
                                    #   print_r($this->db->last_query());
                                    
                                    $date1 = date_create($datefrom);
                                    $date2 = date_create($dateto);
                                    $diff = date_diff($date1, $date2);
                                    $days = $diff->format("%a") + 1;
                                    $dec_days_value = ($dec_days != 0) ? $dec_days : 1;
                                    $totalBedOccupancy = number_format(($dec_grand_total * 100) / ($totalBedCount * $dec_days_value), 2);
                                    echo $totalBedOccupancy . '%';
                                    ?>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php


                            $year = $this->session->userdata['acyear'];
                            $totalBedCount = $this->db->get($table)->num_rows();
                            # print_r($this->db->last_query());
                            
                            $date1 = date_create($datefrom);
                            $date2 = date_create($dateto);
                            $diff = date_diff($date1, $date2);
                            $days = $diff->format("%a") + 1;
                            $totalBedOccupancy = number_format(($all_month_grand_total * 100) / ($totalBedCount * $days), 2);
                            ?>
                            <th colspan="16" style="text-align: center;">Average Bed Occupancy (In Percentage) :
                                <?php echo $totalBedOccupancy . '%'; ?>
                            </th>

                            </tr>




                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>