<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET"
            action="<?php echo base_url('commite_tab/pankarma_patient_count') ?>">
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
                <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>"
                    readonly>

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

                            <h2 class="mt-3">Month Wise <?php if ($section == 'opd') {
                                echo 'OPD';
                            } else {
                                echo "IPD";
                            } ?>
                                Investigation Register - ( Patho Investigation )</h2>
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



 <h3 style="text-align: center;">Patient Count</h3>

                   <?php


// Define months array
$months_arr = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

// Query month-wise patient counts
if ($section == 'opd') {
    $this->db->from('panchkarma_patient_count_opd');
} else {
    $this->db->from('panchkarma_patient_count_ipd');
}

$patho_patient = $this->db->select("
        DATE_FORMAT(create_date, '%b') as month,
        COUNT(*) as total
    ")
    ->where('ipd_opd', $section) // this will match 'opd' or 'ipd'
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

                    <h3 style="text-align: center;"></h3><br>
                    <h3 style="text-align: center;">Panchkarma Therapy Count (Month-wise)</h3>

                    <?php
                    // Months array
                    $months_arr = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

                    // List of therapy columns from i.*
                    $therapy_columns = [
                        'snehan' => 'Snehan',
                        'swedan' => 'Swedan',
                        'vaman' => 'Vaman',
                        'virechan' => 'Virechan',
                        'nasya' => 'Nasya',
                        'raktmokshan' => 'Raktmokshan',
                        'shirodhara' => 'Shirodhara',
                        'shirobasti' => 'Shirobasti',
                        'uttarbasti' => 'Uttarbasti',
                        'basti' => 'Basti',
                        'others' => 'Others',
                        'yonidhavan' => 'Yonidhavan',
                        'yonipichu' => 'Yonipichu'
                    ];

                    // Function to count non-empty values per month from $patients array
                    function count_therapy_monthwise_from_list($patients, $column, $months_arr)
                    {
                        $counts = array_fill_keys($months_arr, 0);
                        foreach ($patients as $row) {
                            $month_key = strtoupper(date('M', strtotime($row->create_date)));
                            if (!empty(trim($row->$column))) {
                                $counts[$month_key] += 1;
                            }
                        }
                        return $counts;
                    }

                    // Build table data for all therapies
                    $therapy_data = [];
                    foreach ($therapy_columns as $col => $label) {
                        $therapy_data[$label] = count_therapy_monthwise_from_list($patients, $col, $months_arr);
                    }
                    ?>

                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <?php foreach ($months_arr as $m) { ?>
                                    <th><?= $m ?></th>
                                <?php } ?>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($therapy_data as $label => $counts) {
                                $total = array_sum($counts);
                                echo "<tr><td>{$label}</td>";
                                foreach ($counts as $val) {
                                    echo "<td>{$val}</td>";
                                }
                                echo "<td><b>{$total}</b></td></tr>";
                            }
                            ?>
                            <tr style="font-weight:bold;">
                                <td>Total</td>
                                <?php
                                $total_per_month = [];
                                foreach ($months_arr as $m) {
                                    $month_sum = 0;
                                    foreach ($therapy_data as $counts) {
                                        $month_sum += $counts[$m];
                                    }
                                    $total_per_month[$m] = $month_sum;
                                    echo "<td>{$month_sum}</td>";
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

// Therapy columns
$therapy_columns = [
    'snehan'      => 'Snehan',
    'swedan'      => 'Swedan',
    'vaman'       => 'Vaman',
    'virechan'    => 'Virechan',
    'nasya'       => 'Nasya',
    'raktmokshan' => 'Raktmokshan',
    'shirodhara'  => 'Shirodhara',
    'shirobasti'  => 'Shirobasti',
    'uttarbasti'  => 'Uttarbasti',
    'basti'       => 'Basti',
    'others'      => 'Others',
    'yonidhavan'  => 'Yonidhavan',
    'yonipichu'   => 'Yonipichu'
];

// Function to count non-empty values in a given column, grouped month-wise
function count_therapy_monthwise($db, $column, $datefrom, $dateto, $months_arr, $section)
{
    // Initialize all months with 0
    $counts = array_fill_keys($months_arr, 0);

    // Select table based on section
    if ($section == 'opd') {
        $db->from('panchkarma_patient_count_opd');
    } else {
        $db->from('panchkarma_patient_count_ipd');
    }

    // Query month-wise counts
    $rows = $db->select("DATE_FORMAT(create_date, '%b') as month, $column")
        ->where('ipd_opd', $section)
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

// Build month-wise data for all therapies
$therapy_counts = [];
foreach ($therapy_columns as $col => $label) {
    $therapy_counts[$label] = count_therapy_monthwise($this->db, $col, $datefrom, $dateto, $months_arr, $section);
}
?>

<table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Therapy Name</th>
            <?php foreach ($months_arr as $m) { ?>
                <th><?= $m ?></th>
            <?php } ?>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Print row function
        function print_row($label, $data) {
            $total = array_sum($data);
            echo "<tr><td>{$label}</td>";
            foreach ($data as $val) {
                echo "<td>{$val}</td>";
            }
            echo "<td><b>{$total}</b></td></tr>";
        }

        // Print each therapy row
        foreach ($therapy_counts as $label => $counts) {
            print_row($label, $counts);
        }
        ?>
        <tr style="font-weight:bold;">
            <td>Total Therapies</td>
            <?php
            $total_per_month = [];
            foreach ($months_arr as $m) {
                $month_total = 0;
                foreach ($therapy_counts as $counts) {
                    $month_total += $counts[$m];
                }
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