<div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/patho_count_monthwise');?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


    <div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
  
</div>  


<div class="form-group">
    <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>
</div>



<button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>



</form>
</div>
<div class="col-sm-12" id="PrintMe">
    <div class="panel panel-default thumbnail" style='border: none;'>
        <div class="panel-heading no-print row">
            <div class="btn-group"> 
                <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
            </div>
            <div class="btn-group col-md-2"> 
                <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
            </div>
        </div>
        <div class="panel-body" style="font-size: 11px;">
            <div>
                <div class="col-sm-2" align="left">
                    <!--<img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />-->
                </div> 
                <div class="col-sm-8" align="center">
                   <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    
                    <?php if($section == 'ipd'){ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> IPD PATHO Month Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> OPD PATHO Month Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                    <?php  }  ?>
                </div>
                 <div class="col-sm-2"></div>
                <!--<?//php print_r($resultData); ?>-->
                
           <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Hematology</th>
            <?php 
            // Get start and end months from user input
            $startMonth = (int)date("m", strtotime($datefrom));
            $endMonth = (int)date("m", strtotime($dateto));

            // Display month headers dynamically
            for ($i = $startMonth; $i <= $endMonth; $i++) {
                $month_name = date("M", mktime(0, 0, 0, $i, 10));
                echo "<th>" . strtoupper($month_name) . "</th>";
            }
            ?>
            <th>Total</th>
        </tr>
    </thead>
<tbody>
    <?php
    $grandMonthlyTotals = array_fill(1, 12, [
        "CBC" => 0, "BTCT" => 0, "ESR" => 0, 
        "CBC_ESR" => 0, "CBC_BTCT" => 0, "BTCT_ESR" => 0, "ALL" => 0
    ]); 
    $grandTotal = ["CBC" => 0, "BTCT" => 0, "ESR" => 0, "CBC_ESR" => 0, "CBC_BTCT" => 0, "BTCT_ESR" => 0, "ALL" => 0];

    $year = date("Y", strtotime($datefrom));
    $hasValidData = false;

    // Define test combinations
    $testCategories = [
        "CBC" => "CBC", 
        "BTCT" => "BTCT", 
        "ESR" => "ESR", 
        "CBC_ESR" => "CBC and ESR", 
        "CBC_BTCT" => "CBC and BTCT", 
        "BTCT_ESR" => "BTCT and ESR", 
        "ALL" => "CBC, BTCT, and ESR"
    ];

    foreach ($testCategories as $key => $label) {
        $monthlyTotal = 0;
        $rowData = [];

        for ($i = $startMonth; $i <= $endMonth; $i++) {
            $startOfMonth = date("Y-m-d", strtotime("{$year}-{$i}-01"));
            $endOfMonth = date("Y-m-t", strtotime($startOfMonth));

            // Query to count test occurrences based on test combination
            $this->db->select('COUNT(id) as Total_Count')
                ->from($table)
                ->where('create_date >=', $startOfMonth)
                ->where('create_date <=', $endOfMonth)
                ->where('ipd_opd', $section);

            // Apply filtering conditions based on test category
            switch ($key) {
                case "CBC":
                    $this->db->where('hematology =', "CBC");
                    //  print_r($this->db->last_query());
                    break;
                case "BTCT":
                    $this->db->where('hematology', "BTCT");
                    break;
                case "ESR":
                    $this->db->where('hematology', "ESR");
                    break;
                case "CBC_ESR":
                    $this->db->where("hematology LIKE '%ESR%'");
                    break;
                case "CBC_BTCT":
                    $this->db->where("hematology LIKE '%CBC%'")
                             ->where("hematology LIKE '%BTCT%'");
                    break;
                case "BTCT_ESR":
                    $this->db->where("hematology LIKE '%BTCT%'")
                             ->where("hematology LIKE '%ESR%'");
                    break;
                case "ALL":
                    $this->db->where("hematology LIKE '%CBC%'")
                             ->where("hematology LIKE '%BTCT%'")
                             ->where("hematology LIKE '%ESR%'");
                    break;
            }

            $monthCount = $this->db->get()->row()->Total_Count;
         #   print_r($this->db->last_query()); // Debugging: Print last query
            $rowData[$i] = $monthCount;
            $monthlyTotal += $monthCount;
            $grandMonthlyTotals[$i][$key] += $monthCount;
        }

        $grandTotal[$key] += $monthlyTotal;

        // Display only if there's data
        if ($monthlyTotal > 0) {
            $hasValidData = true;
            echo "<tr>";
            echo "<th>{$label}</th>";
            foreach ($rowData as $value) {
                echo "<td>{$value}</td>";
            }
            echo "<th>{$monthlyTotal}</th>";
            echo "</tr>";
        }
    }

    // Display Grand Total
    if ($hasValidData) {
        echo "<tr><th>Grand Total</th>";
        for ($i = $startMonth; $i <= $endMonth; $i++) {
            $sumMonth = array_sum($grandMonthlyTotals[$i]);
            echo "<th>{$sumMonth}</th>";
        }
        echo "<th>" . array_sum($grandTotal) . "</th></tr>";
    }
    ?>
</tbody>

</table>
    
          <?php 
$sections = ['serology', 'biochemistry', 'microbiology']; // Define sections

// Get date range from user input
$startMonth = (int)date("m", strtotime($datefrom));
$endMonth = (int)date("m", strtotime($dateto));
$year = date("Y", strtotime($datefrom));

foreach ($sections as $sectionType) { 
    // Fetch unique test types dynamically from database
    $testTypes = $this->db->select("DISTINCT($sectionType) as test_name")
                          ->from($table)
                          ->where("$sectionType IS NOT NULL AND $sectionType != ''")
                          ->get()
                          ->result_array();
//   print_r($this->db->last_query());
    if (!empty($testTypes)) {
?>
        <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><?= strtoupper($sectionType) ?></th>
                    <?php 
                    for ($i = $startMonth; $i <= $endMonth; $i++) {
                        $month_name = date("M", mktime(0, 0, 0, $i, 10));
                        echo "<th>" . strtoupper($month_name) . "</th>";
                    }
                    ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandMonthlyTotals = array_fill(1, 12, 0);
                $grandTotal = 0;

                foreach ($testTypes as $testRow) {
                    $test = trim($testRow['test_name']);
                    echo "<tr><th>{$test}</th>";
                    $monthlyTotal = 0;

                    for ($i = $startMonth; $i <= $endMonth; $i++) {
                        $startOfMonth = date("Y-m-d", strtotime("{$year}-{$i}-01"));
                        $endOfMonth = date("Y-m-t", strtotime($startOfMonth));

                        // Query to count test occurrences using FIND_IN_SET()
                        $this->db->select('COUNT(id) as Total_Count')
                            ->from($table)
                            ->where('create_date >=', $startOfMonth)
                            ->where('create_date <=', $endOfMonth)
                            ->where("FIND_IN_SET('$test', $sectionType) >", 0);
                        
                        if ($data['section']) {
                            $this->db->where('ipd_opd', $data['section']); // Ensure correct section
                        }
                    //   print_r($this->db->last_query());

                        $monthCount = $this->db->get()->row()->Total_Count;

                        echo "<td>{$monthCount}</td>";
                        $monthlyTotal += $monthCount;
                        $grandMonthlyTotals[$i] += $monthCount;
                    }

                    echo "<th>{$monthlyTotal}</th></tr>";
                    $grandTotal += $monthlyTotal;
                }
                ?>

                <!-- Grand Total Row -->
                <tr>
                    <th>Grand Total</th>
                    <?php
                    for ($i = $startMonth; $i <= $endMonth; $i++) {
                        echo "<th>{$grandMonthlyTotals[$i]}</th>";
                    }
                    ?>
                    <th><?= $grandTotal ?></th>
                </tr>
            </tbody>
        </table>
<?php 
    } // End if test types exist
} // End foreach sections
?>

            </div>
        </div>
    </div>
</div>