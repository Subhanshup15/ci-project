<div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/xray_count_monthwise');?>">
                                      
 
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
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> IPD X-Ray Month Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> OPD X-Ray Month Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                    <?php  }  ?>
                </div>
                 <div class="col-sm-2"></div>
                <!--<?//php print_r($resultData); ?>-->
                
                
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
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
                       
                      <tbody>
    <?php
    $grandMonthlyTotals = array_fill(1, 12, 0); // Array to store grand totals for each month
    $grandTotal = 0; // Overall grand total

    // Parse selected date range
    $startMonth = (int)date("m", strtotime($datefrom));
    $endMonth = (int)date("m", strtotime($dateto));
    $year = date("Y", strtotime($datefrom));

    foreach ($XrayData as $xray) {
        echo "<tr>";
        echo "<th>{$xray->Xray_data}</th>";
        $monthlyTotal = 0;

        // Loop through the selected months
        for ($i = $startMonth; $i <= $endMonth; $i++) {
            $startOfMonth = date("Y-m-d", strtotime("{$year}-{$i}-01"));
            $endOfMonth = date("Y-m-t", strtotime($startOfMonth));

            // Query to get count for the specific month
            $monthCount = $this->db->select('COUNT(id) as Total_Count')
                ->from($table)
                ->where('create_date >=', $startOfMonth)
                ->where('create_date <=', $endOfMonth)
                ->where('xray', $xray->Xray_data)
                ->where('ipd_opd', $section)
                ->get()
                ->row()
                ->Total_Count;

            echo "<td>{$monthCount}</td>";

            // Add month count to totals
            $monthlyTotal += $monthCount;
            $grandMonthlyTotals[$i] += $monthCount;
        }

        // Display total count for the row
        echo "<th>{$monthlyTotal}</th>";
        echo "</tr>";

        // Add row total to grand total
        $grandTotal += $monthlyTotal;
    }
    ?>

    <!-- Grand Total Row -->
    <tr>
        <th>Grand Total</th>
        <?php
        // Loop through the selected months and display grand totals
        for ($i = $startMonth; $i <= $endMonth; $i++) {
            echo "<th>{$grandMonthlyTotals[$i]}</th>";
        }
        ?>
        <th><?php echo $grandTotal; ?></th>
    </tr>
</tbody>


                </table>
            </div>
        </div>
    </div>
</div>