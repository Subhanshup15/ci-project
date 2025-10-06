<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET"
            action="<?php echo base_url('commite_tab/xray_ecg_usg_patient_count_opd') ?>">
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

            <div class="form-group">
                <input type="text" name="section" class="form-control" id="section" value="opd" readonly>

            </div>

            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>



        </form>

        <div class="panel panel-default thumbnail">
            <div class="btn-group">
                <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i
                        class="fa fa-print"></i></button>
            </div>
            <div class="btn-group">
                <input id="myInput" class="form-control" type="text" placeholder="Search..">
            </div>
            <div id="PrintMe">

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-xs-2" align="left">
                            <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>"
                                style="height:120px; width:120px;border: 0.5px solid #0003;" />
                        </div>
                        <div class="col-xs-8" align="center">
                            <h3 style="margin-top: 0px; margin-bottom: 0px;">
                                <strong><?php echo $this->session->userdata('title') ?></strong>
                            </h3>
                            <h4 style="margin-top: 5px;margin-bottom: 5px;">
                                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                            </h4>

                            <h2 class="mt-3">Month Wise XRAY-ECG-USG Register OPD</h2>
                            <b> Date : <?php echo date('d-m-Y', strtotime($datefrom)) ?> TO
                                <?php echo date('d-m-Y', strtotime($dateto)) ?></b><br><br>
                        </div>

                    </div>
                </div>




                <div class="panel-body">
                    <style>
                        .filter-section button {
                            margin-right: 5px;
                            padding: 5px 10px;
                            border: 1px solid #ddd;
                            background: #f5f5f5;
                            cursor: pointer;
                        }

                        .filter-section button.active {
                            background: #337ab7;
                            color: white;
                            border-color: #2e6da4;
                        }

                        .filter-row {
                            margin-bottom: 10px;
                        }
                    </style>




                    <h3 style="text-align: center;"></h3><br>




                    <?php
                    // Define months array
                    $months_arr = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

                    // Query month-wise report counts
                    $patho_report = $this->db->select("
    DATE_FORMAT(create_date, '%b') as month,
    SUM(LENGTH(REPLACE(xray, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(xray, ' ', ''), '[,]+', '')) + 1) AS xrayCount
")
                        ->from('xray_patient_count_opd')
                        ->where('ipd_opd', 'opd')
                        ->where('create_date >=', $datefrom)
                        ->where('create_date <=', $dateto)
                        ->group_by("MONTH(create_date), DATE_FORMAT(create_date, '%b')")
                        ->order_by("MIN(create_date)", "ASC")
                        ->get()
                        ->result();

                    // Fill default 0 arrays for all months
                    $xrayCount = array_fill_keys($months_arr, 0);


                    // Assign results to month arrays
                    foreach ($patho_report as $row) {
                        $month_key = strtoupper($row->month);
                        $xrayCount[$month_key] = $row->xrayCount;

                    }
                    ?>
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Test Name</th>
                                <?php foreach ($months_arr as $m) { ?>
                                    <th><?= $m ?></th>
                                <?php } ?>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Helper to print row
                            function print_row($label, $data)
                            {
                                $total = array_sum($data);
                                echo "<tr><td>{$label}</td>";
                                foreach ($data as $val) {
                                    echo "<td>{$val}</td>";
                                }
                                echo "<td><b>{$total}</b></td></tr>";
                            }

                            print_row('Xray Count', $xrayCount);

                            ?>

                        </tbody>
                    </table>
                    <?php
                    // Define months array
                    $months_arr = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

                    // Query month-wise ECG counts
                    $ecg_report = $this->db->select("
    DATE_FORMAT(create_date, '%b') as month,
    COUNT(*) AS ecgCount
")
                        ->from('ecg_patient_count_opd') // <-- Your ECG IPD table
                        ->where('ipd_opd', 'opd')
                        ->where('create_date >=', $datefrom)
                        ->where('create_date <=', $dateto)
                        ->group_by("MONTH(create_date), DATE_FORMAT(create_date, '%b')")
                        ->order_by("MIN(create_date)", "ASC")
                        ->get()
                        ->result();

                    // Fill default 0 arrays for all months
                    $ecgCount = array_fill_keys($months_arr, 0);

                    // Assign results to month arrays
                    foreach ($ecg_report as $row) {
                        $month_key = strtoupper($row->month);
                        $ecgCount[$month_key] = $row->ecgCount;
                    }
                    ?>

                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Test Name</th>
                                <?php foreach ($months_arr as $m) { ?>
                                    <th><?= $m ?></th>
                                <?php } ?>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Helper to print row
                            if (!function_exists('print_row')) {
                                function print_row($label, $data)
                                {
                                    $total = array_sum($data);
                                    echo "<tr><td>{$label}</td>";
                                    foreach ($data as $val) {
                                        echo "<td>{$val}</td>";
                                    }
                                    echo "<td><b>{$total}</b></td></tr>";
                                }
                            }


                            // Print ECG row
                            print_row('ECG Count', $ecgCount);
                            ?>


                        </tbody>
                    </table>




                    <?php
                    // Make sure this is defined only once in the file
                    if (!function_exists('print_row')) {
                        function print_row($label, $data)
                        {
                            $total = array_sum($data);
                            echo "<tr><td>{$label}</td>";
                            foreach ($data as $val) {
                                echo "<td>{$val}</td>";
                            }
                            echo "<td><b>{$total}</b></td></tr>";
                        }
                    }

                    // Months array
                    $months_arr = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

                    // Query month-wise USG counts
                    $usg_report = $this->db->select("
    DATE_FORMAT(create_date, '%b') as month,
    COUNT(*) AS usgCount
")
                        ->from('usg_patient_count_opd') // <-- USG OPD table
                        ->where('ipd_opd', 'opd')
                        ->where('create_date >=', $datefrom)
                        ->where('create_date <=', $dateto)
                        ->group_by("MONTH(create_date), DATE_FORMAT(create_date, '%b')")
                        ->order_by("MIN(create_date)", "ASC")
                        ->get()
                        ->result();

                    // Fill default 0 values for all months
                    $usgCount = array_fill_keys($months_arr, 0);

                    // Assign query results to month array
                    foreach ($usg_report as $row) {
                        $month_key = strtoupper($row->month);
                        $usgCount[$month_key] = $row->usgCount;
                    }
                    ?>

                    <!-- USG Table -->
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Test Name</th>
                                <?php foreach ($months_arr as $m) { ?>
                                    <th><?= $m ?></th>
                                <?php } ?>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Print USG row
                            print_row('USG Count', $usgCount);
                            ?>

                        </tbody>
                    </table>


                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>