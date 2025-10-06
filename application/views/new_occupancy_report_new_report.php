<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">


    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('Patients/new_occupancy_report_new_report') ?>">

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
            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>
        </form>
    </div>
    <div class="col-sm-12">
        <div class="col-sm-12" id="PrintMe">
            <div class="panel panel-default thumbnail">
                <div class="panel-heading no-print">
                    <div class="btn-group">
                        <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="col-xs-2" align="left">
                        <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100%; width:100%;border: 0.5px solid #0003;" />
                    </div>
                    <div class="col-xs-8" align="center">
                        <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                        <h4 style="margin-top: 5px;margin-bottom: 5px;">
                            <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                        </h4>

                    <h3>Monthly Wise Bed Occupancy Report</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?> To <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>

                    </div>
                    <div class="col-xs-2"></div>
                        <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <?php foreach ($dates as $date): ?>
                                    <th><?php echo date('M Y', strtotime($date . '-01')); ?></th>
                                    <?php endforeach; ?>
                                    <th>Grand Total</th>
                                    <th>Department Wise Occupancy<th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Initialize arrays to store totals
                                $departmentGrandTotals = array_fill(0, count($dates), 0);
                                $monthlyGrandTotals = array_fill(0, count($dates), 0); // For month-wise totals
                                $grandTotal = 0; $totalBedCount = 0;
                                
                                foreach ($departments as $dept):
                                    $deptTotal = 0;
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($dept->name); ?></td>
                                        <?php foreach ($dates as $index => $date): ?>
                                            <td>
                                                <?php
                                                    $startDate = $date . '-01';
                                                    $endDate = date('Y-m-t', strtotime($startDate));
                                                    $totalCount = 0;

                                                    // Loop through each day of the month
                                                    for ($day = 1; $day <= date('t', strtotime($startDate)); $day++) {
                                                        $currentDate = date('Y-m-d', strtotime($date . '-' . $day));
                                                        
                                                        // Query to count patients for each day of the current month
                                                        $count_date_wise = $this->db->select('count(id) as CountDept')
                                                            ->from('patient_ipd')
                                                            ->where('create_date <=', $currentDate)
                                                            ->group_start()
                                                            ->where('discharge_date >', $currentDate)
                                                            ->or_where('discharge_date LIKE', '%0000-00-00%')
                                                            ->group_end()
                                                            ->where('department_id =', $dept->dprt_id)
                                                            ->where('ipd_opd', 'ipd')
                                                            ->get()
                                                            ->row();
                                                        
                                                        $totalCount += isset($count_date_wise->CountDept) ? $count_date_wise->CountDept : 0;
                                                    }

                                                    // Add totals to arrays
                                                    $departmentGrandTotals[$index] += $totalCount;
                                                    $monthlyGrandTotals[$index] += $totalCount;
                                                    $deptTotal += $totalCount;
                                                    $grandTotal += $totalCount;

                                                    echo $totalCount;
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <td class="grand-total"><?php echo $deptTotal; ?></td>

                                        <td class="grand-total">
                                            <?php
                                            // Total number of beds for the department
                                            $totalBedCount = $this->db->where('department_id', $dept->dprt_id)->from('beds')->count_all_results();
                                            //print_r($this->db->last_query());
                                            //echo $totalBedCount;
                                            // Ensure the total days are correctly calculated for all months
                                            $totalDays = array_sum(array_map(function($date) {
                                                return date('t', strtotime($date . '-01'));
                                            }, $dates));
                                            
                                            // Calculate overall occupancy percentage
                                        $overallOccupancyPercentage = $totalBedCount > 0 ? number_format(($deptTotal * 100) / ($totalBedCount * $totalDays), 2) : 0;

                                           // $overallOccupancyPercentage = ($deptTotal * 100);

                                            echo $overallOccupancyPercentage . '%';
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Grand Total</th>
                                    
                                    <?php foreach ($departmentGrandTotals as $total): ?>
                                        <td class="grand-total"><?php echo $total; ?></td>
                                    <?php endforeach; ?>
                                    <td class="grand-total"><?php echo $grandTotal; ?></td>
                                </tr>
                                <tr>
                                    <th>Month-Wise Total</th>
                                    <?php foreach ($monthlyGrandTotals as $index => $total): ?>
                                        <td class="grand-total">
                                            <?php
                                            $totalBedCount = $this->db->get('beds')->num_rows();
                                            $daysInMonth = date('t', strtotime($dates[$index] . '-01'));
                                            $occupancyPercentage = number_format(($total * 100) / ($totalBedCount * $daysInMonth), 2);
                                            echo $occupancyPercentage . '%';
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
                                    <td class="grand-total"></td>
                                </tr>

                                </tr>
                            <?php

                            
                                $year = $this->session->userdata['acyear'];
                                $totalBedCount = $this->db->get('beds')->num_rows();
                                $date1=date_create($datefrom);
                                $date2=date_create($dateto);
                                $diff=date_diff($date1,$date2);
                                $days = $diff->format("%a")+1;
                                $totalBedOccupancy=number_format(($grandTotal * 100)/($totalBedCount * $days),2);
                                ?>
                                <th colspan="16" style="text-align: center;">Average Bed Occupancy (In Percentage) : <?php echo $totalBedOccupancy.'%'; ?></th>

                           </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
        $('#table1').DataTable({

            dom: 'Bfrtip',
            responsive: true,
            pageLength: 1000,
            lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],

            buttons: [
                //'copy', 'csv', 'excel', 'print','pdf',

                // {
                // extend : 'pdfHtml5',
                // exportOptions: {
                //     columns: [1, 2,3,4,5,6,7,8,9]
                // }
                // },

                {
                extend : 'excelHtml5',
                exportOptions: {
                    columns: [0,1, 2,3,4,5,6,7,8,9]
                }
                },

            //      {
            //    extend: 'print',
            //     exportOptions: {
            //         columns: [0,1, 2,3,4,5,6,7,8,9]
            //     }
            //     },
            ],

            
        });
    });
  
</script>