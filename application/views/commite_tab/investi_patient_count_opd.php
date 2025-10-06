<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET"
            action="<?php echo base_url('commite_tab/investi_patient_count_opd') ?>">
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

                            <h2 class="mt-3">Month Wise OPD Investigation Register - ( Patho Investigation )</h2>
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
                   <h3 style="text-align: center;">Patient Count</h3>

                   <?php


// Define months array
$months_arr = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

// Query month-wise patient counts
$patho_patient = $this->db->select("
        DATE_FORMAT(create_date, '%b') as month,
        COUNT(*) as total
    ")
    ->from('investi_patient_count_opd')
    ->where('ipd_opd', 'opd')
    ->where('create_date >=', $datefrom)
    ->where('create_date <=', $dateto)
    ->group_by("MONTH(create_date), DATE_FORMAT(create_date, '%b')")
    ->order_by("MIN(create_date)", "ASC")
    ->get()
    ->result();

// Fill default 0 for all months
$patient_counts = array_fill_keys($months_arr, 0);

// Assign query results to month array
foreach ($patho_patient as $row) {
    $patient_counts[strtoupper($row->month)] = $row->total;
}
?>


<table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Count</th>
            <?php foreach ($months_arr as $m) { ?>
                <th><?= $m ?></th>
            <?php } ?>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Patient Count</td>
            <?php 
            $year_total = 0;
            foreach ($months_arr as $m) { 
                echo "<td>{$patient_counts[$m]}</td>";
                $year_total += $patient_counts[$m];
            } 
            ?>
            <td><b><?= $year_total ?></b></td>
        </tr>
    </tbody>
</table>

                 <?php
// Define months array
$months_arr = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

// Query month-wise report counts
$patho_report = $this->db->select("
    DATE_FORMAT(create_date, '%b') as month,
    SUM(LENGTH(REPLACE(hematology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(hematology, ' ', ''), '[,]+', '')) + 1) AS hematologyCount,
    SUM(LENGTH(REPLACE(serology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(serology, ' ', ''), '[,]+', '')) + 1) AS serologyCount,
    SUM(LENGTH(REPLACE(biochemistry, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(biochemistry, ' ', ''), '[,]+', '')) + 1) AS biochemistryCount,
    SUM(LENGTH(REPLACE(microbiology, ' ', '')) - LENGTH(REGEXP_REPLACE(REPLACE(microbiology, ' ', ''), '[,]+', '')) + 1) AS microbiologyCount
")
->from('investi_patient_count_opd')
->where('ipd_opd', 'opd')
->where('create_date >=', $datefrom)
->where('create_date <=', $dateto)
->group_by("MONTH(create_date), DATE_FORMAT(create_date, '%b')")
->order_by("MIN(create_date)", "ASC")
->get()
->result();

// Fill default 0 arrays for all months
$hematology_counts = array_fill_keys($months_arr, 0);
$serology_counts   = array_fill_keys($months_arr, 0);
$biochemistry_counts = array_fill_keys($months_arr, 0);
$microbiology_counts = array_fill_keys($months_arr, 0);

// Assign results to month arrays
foreach ($patho_report as $row) {
    $month_key = strtoupper($row->month);
    $hematology_counts[$month_key]   = $row->hematologyCount;
    $serology_counts[$month_key]     = $row->serologyCount;
    $biochemistry_counts[$month_key] = $row->biochemistryCount;
    $microbiology_counts[$month_key] = $row->microbiologyCount;
}
?>

<h3 style="text-align: center;">Report wise Count (Month-wise)</h3>
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
        function print_row($label, $data) {
            $total = array_sum($data);
            echo "<tr><td>{$label}</td>";
            foreach ($data as $val) {
                echo "<td>{$val}</td>";
            }
            echo "<td><b>{$total}</b></td></tr>";
        }

        print_row('Hematology Count', $hematology_counts);
        print_row('Serology Count', $serology_counts);
        print_row('Biochemistry Count', $biochemistry_counts);
        print_row('Microbiology Count', $microbiology_counts);
        ?>
        <tr style="font-weight:bold;">
            <td>Total Tests</td>
            <?php
            $total_per_month = [];
            foreach ($months_arr as $m) {
                $month_total = $hematology_counts[$m] + $serology_counts[$m] + $biochemistry_counts[$m] + $microbiology_counts[$m];
                $total_per_month[$m] = $month_total;
                echo "<td>{$month_total}</td>";
            }
            echo "<td><b>" . array_sum($total_per_month) . "</b></td>";
            ?>
        </tr>
    </tbody>
</table>

                    <h3 style="text-align: center;">Patient wise Count (Month-wise)</h3>
                  <?php
// Months array for display order
$months_arr = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

// Function to count non-empty values in a given column, grouped month-wise
function count_tests_monthwise($db, $column, $datefrom, $dateto, $months_arr)
{
    // Initialize all months with 0
    $counts = array_fill_keys($months_arr, 0);

    // Query month-wise counts
    $rows = $db->select("DATE_FORMAT(create_date, '%b') as month, $column")
        ->from('investi_patient_count_opd')
        ->where('ipd_opd', 'opd')
        ->where('create_date >=', $datefrom)
        ->where('create_date <=', $dateto)
        ->get()
        ->result();

    // Loop through and count per month
    foreach ($rows as $row) {
        $month_key = strtoupper($row->month);
        if (!empty(trim($row->$column))) {
            $counts[$month_key] += 1;
        }
    }
    return $counts;
}

// Get month-wise counts for each category
$hematology_counts   = count_tests_monthwise($this->db, 'hematology', $datefrom, $dateto, $months_arr);
$serology_counts     = count_tests_monthwise($this->db, 'serology', $datefrom, $dateto, $months_arr);
$biochemistry_counts = count_tests_monthwise($this->db, 'biochemistry', $datefrom, $dateto, $months_arr);
$microbiology_counts = count_tests_monthwise($this->db, 'microbiology', $datefrom, $dateto, $months_arr);
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
        function print_row_monthwise($label, $data) {
            $total = array_sum($data);
            echo "<tr><td>{$label}</td>";
            foreach ($data as $val) {
                echo "<td>{$val}</td>";
            }
            echo "<td><b>{$total}</b></td></tr>";
        }

        print_row_monthwise('Hematology Count', $hematology_counts);
        print_row_monthwise('Serology Count', $serology_counts);
        print_row_monthwise('Biochemistry Count', $biochemistry_counts);
        print_row_monthwise('Microbiology Count', $microbiology_counts);
        ?>
        <tr style="font-weight:bold;">
            <td>Total Tests</td>
            <?php
            $total_per_month = [];
            foreach ($months_arr as $m) {
                $month_total = $hematology_counts[$m] + $serology_counts[$m] + $biochemistry_counts[$m] + $microbiology_counts[$m];
                $total_per_month[$m] = $month_total;
                echo "<td>{$month_total}</td>";
            }
            echo "<td><b>" . array_sum($total_per_month) . "</b></td>";
            ?>
        </tr>
    </tbody>
</table>



                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>