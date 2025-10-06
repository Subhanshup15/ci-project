<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<?php ini_set('memory_limit', '-1');?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('PatientNew/new_monthwise_opd'); ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
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
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-12" align="center">  
                    
                <strong><?php echo $this->session->userdata('title') ?></strong>
                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                
                
                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php echo "MONTHWISE D-OPD REPORT"; ?></h3>
                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
            </div>

            
            
                <?php
                $months = [
                    '1' => "Jan",
                    '2' => "Feb",
                    '3' => "March",
                    '4' => "April",
                    '5' => "May",
                    '6' => "June",
                    '7' => "July",
                    '8' => "Aug",
                    '9' => "Sept",
                    '10' => "Oct",
                    '11' => "Nov",
                    '12' => "Dec"
                ];
            ?>
          
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo "S.No" ?></th>
                            <th><?php echo "Department" ?></th>
                            <?php for($i=1;$i<=count($months);$i++){ ?>
                            <th><?php echo $months[$i]; ?></th> 
                            <?php } ?>

                            <th><?php echo "Total" ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $a = 1; 
                        $grand_total = 0; // Variable to track the grand total

                        foreach ($department as $dept): 
                            $row_total = 0; // Track total for the current department
                        ?>
                            <tr>
                                <td><?php echo $a++; ?></td>
                                <th><?php echo $dept->name; ?></th>
                                <?php 
                                for ($j = 1; $j <= 12; $j++): 
                                    $count = isset($monthwise_data[$dept->dprt_id][$j]) 
                                            ? $monthwise_data[$dept->dprt_id][$j] 
                                            : 0;
                                    $row_total += $count; // Accumulate row total
                                ?>
                                    <td><?php echo $count; ?></td>
                                <?php endfor; ?>
                                <th><?php echo $row_total; ?></th>
                            </tr>
                            <?php $grand_total += $row_total; // Accumulate grand total ?>
                        <?php endforeach; ?>

                        <!-- Grand Total Row -->
                        <tr>
                            <th colspan="2">Grand Total</th>
                            <?php 
                            for ($j = 1; $j <= 12; $j++): 
                                // Calculate column totals for each month
                                $month_total = 0;
                                foreach ($department as $dept) {
                                    $month_total += isset($monthwise_data[$dept->dprt_id][$j]) 
                                                    ? $monthwise_data[$dept->dprt_id][$j] 
                                                    : 0;
                                }
                            ?>
                                <th><?php echo $month_total; ?></th>
                            <?php endfor; ?>
                            <th><?php echo $grand_total; ?></th>
                        </tr>
                    </tbody>

                </table>  
            </div>
        </div>
    </div>
</div>


<!-- OTP Submission -->
                    


                    <script>
                        $(function() {
                            var d = new Date();
                            $("#discharge_date").datetimepicker({  
                                showSecond: false,
                                timeFormat: 'hh:mm',
                            }).datetimepicker("setDate", new Date());
                        });
                    </script>

</script>