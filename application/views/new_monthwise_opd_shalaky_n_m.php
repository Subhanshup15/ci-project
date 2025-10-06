<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<?php ini_set('memory_limit', '-1');?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('PatientNew/new_monthwise_opd_shalaky_n_m'); ?>">
                                      
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
                
                
                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php echo "Shalakyatantra Netra Mukha"; ?></h3>
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
            <th><?php echo "Month"; ?></th>
            <?php foreach ($department as $dept): ?>
                <th><?php echo $dept->name; ?></th>
            <?php endforeach; ?>
            <th><?php echo "Total"; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $grand_total = 0; // Track grand total for all departments
        for ($j = 1; $j <= 12; $j++): 
            $row_total = 0; // Track total for each month
        ?>
            <tr>
                <th><?php echo $months[$j]; ?></th>
                <?php 
                foreach ($department as $dept): 
                    $count = isset($monthwise_data[$dept->dprt_id][$j]) 
                            ? $monthwise_data[$dept->dprt_id][$j] 
                            : 0;
                    $row_total += $count; // Accumulate row total
                ?>
                    <td><?php echo $count; ?></td>
                <?php endforeach; ?>
                <th><?php echo $row_total; ?></th>
            </tr>
            <?php $grand_total += $row_total; // Accumulate grand total ?>
        <?php endfor; ?>

        <!-- Grand Total Row -->
        <tr>
            <th>Grand Total</th>
            <?php 
            foreach ($department as $dept): 
                $dept_total = 0;
                for ($j = 1; $j <= 12; $j++) {
                    $dept_total += isset($monthwise_data[$dept->dprt_id][$j]) 
                                    ? $monthwise_data[$dept->dprt_id][$j] 
                                    : 0;
                }
            ?>
                <th><?php echo $dept_total; ?></th>
            <?php endforeach; ?>
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