<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?//php  echo error_reporting(0); ?>
<div class="row">
    <!--  table area -->

    <?php  $section = $this->uri->segment(3);?>

    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientby_month_new/' . urlencode($section));?>">
            <div class="form-group">
                <label for=""> From </label>
            </div>  
            <div class="form-group">
                <select name="start_month" id="start_month" class="form-control">
                    <?php for($m=1; $m<=12; $m++): ?>
                        <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>"><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
                    <?php endfor; ?>
                </select>
            </div>  
            
            <div class="form-group">
                <select name="start_year" id="start_year" class="form-control">
                    <?php for($y=2021; $y<=date('Y'); $y++): ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div> 

            <div class="form-group">
                <label for=""> To </label>
            </div>  

            <div class="form-group">
                <select name="end_month" id="end_month" class="form-control">
                    <?php for($m=1; $m<=12; $m++): ?>
                        <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>"><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
                    <?php endfor; ?>
                </select>
            </div>  
            
            <div class="form-group">
                <select name="end_year" id="end_year" class="form-control">
                    <?php for($y=2021; $y<=date('Y'); $y++): ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>  
            
            <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
        </form>
    </div>

    <div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">

                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>

                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              

                <?php   
                    $ipd = ($patients[0]->ipd_opd);
                    if($ipd == 'ipd'){ ?>
                        <div class="btn-group col-md-2"> 
                            <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                        </div> 
                <?php }  ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    
            </div>

            <div class="panel-body">
                <div class="panel-body" style="font-size: 11px;">
              <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                <hr style="border: 1px solid black; background-color:black;">
                <h5>MONTHWISE <?php if($section=='opd') { echo "D-OPD"; }  else if($section=='ipd'){ echo "D-IPD";} else { echo "BED OCCUPANCY";}?> REPORT</h5>  
                </div>
                <div class="col-xs-2"></div>
                </div>
                </div>
                <div class="col-sm-12" align="center" style="margin-top:20px;">
                    <div class="col-sm-6" align="left">
                        <div style='display: inline-block;' align='left'><strong>( Main Hospital )</strong></div>
                    </div>
                    <div class="col-sm-6" align="right">
                        <?php 
                            $year = $this->session->userdata['acyear'];
                           // $date_from = $year.'-01-01';
                            //$date_to = $year.'-12-31';
                        ?>
                        <div style='display: inline-block;' align='right'><strong>From: <?php echo date('d-M-Y', strtotime($date_from)); ?> To: <?php echo date('d-M-Y', strtotime($date_to)); ?></strong></div>
                    </div>
                </div>
                <?php
                // Initialize arrays to hold totals
                $department_totals = [];
                $month_totals = [];

                // Prepare the data for each department and month
                $start_timestamp = strtotime("$start_year-$start_month-01");
                $end_timestamp = strtotime("$end_year-$end_month-01");

                while ($start_timestamp <= $end_timestamp) {
                    $month = date('Y-m', $start_timestamp);
                    $month_totals[$month] = 0; // Initialize month total
                    $start_timestamp = strtotime('+1 month', $start_timestamp);
                }
                ?>

                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="font-family: initial;">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <?php
                            $start_timestamp = strtotime("$start_year-$start_month-01");
                            $end_timestamp = strtotime("$end_year-$end_month-01");

                            // Generate the column headers for each month
                            while ($start_timestamp <= $end_timestamp) {
                               // echo '<th>' . date('F y', $start_timestamp) . '</th>'; // full month name
                                echo '<th>' . date('M y', $start_timestamp) . '</th>'; // short month name
                                $start_timestamp = strtotime('+1 month', $start_timestamp);
                            }
                            echo '<th>Total</th>'; // Grand total for each department
                            ?>
                        </tr>
                    </thead>
                        <tbody>
                            <?php foreach ($department_data as $dept_id => $dept) { 
                                $department_total = 0; // Initialize department total
                            ?>
                                <tr style="color: #2f323a;">
                                    <td><?php echo $dept['name']; ?></td>
                                    <?php
                                    // Reset the timestamp for each department
                                    $start_timestamp = strtotime("$start_year-$start_month-01");
                                    
                                    while ($start_timestamp <= $end_timestamp) {
                                        $month = date('Y-m', $start_timestamp);
                                        $count = $dept['data'][$month] ?? 0;
                                        $department_total += $count; // Update department total
                                        $month_totals[$month] += $count; // Update month total
                                        echo '<td>' . $count . '</td>';
                                        $start_timestamp = strtotime('+1 month', $start_timestamp);
                                    }
                                    echo '<td>' . $department_total . '</td>'; // Display department total
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="color: #2f323a;">
                                <th>Grand Total	</th>
                                <?php
                    
                                $start_timestamp = strtotime("$start_year-$start_month-01");
                                $end_timestamp = strtotime("$end_year-$end_month-01");

                                while ($start_timestamp <= $end_timestamp) {
                                    $month = date('Y-m', $start_timestamp);
                                    echo '<th>' . ($month_totals[$month] ?? 0) . '</th>';
                                    $start_timestamp = strtotime('+1 month', $start_timestamp);
                                }
                                ?>
                                <th><?php echo array_sum($month_totals); ?></th> <!-- Grand total for all departments -->
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
</div>

