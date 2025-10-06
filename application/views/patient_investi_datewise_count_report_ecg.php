<div class="col-sm-12">
    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/getInvestiPanchCount/'.$section.'/ecg_investi/'.$report_cat.'/'.$report_type); ?>">
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
            <div class="btn-group col-md-2"> 
                <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
            </div>
        </div>
        <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-2" align="left">
                <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
            </div> 
            <div class="col-sm-8" align="center">
                <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <center><h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4></center>
                    
                <?php if($section == 'ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"> IPD ECG Date Wise Summery Count Register</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                <?php }else{ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"> OPD ECG Date Wise Summery Count Register</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                <?php  }  ?>
            </div>
            <div class="col-sm-2"></div>
            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>ECG</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $ecgCountTotal = 0; $grandTotal = 0;
                    ?>
                    <?php foreach($resultData as $result) { ?>
                        <?php $total = 0;?>
                        <tr>
                            <td><?php echo date('d-m-Y',strtotime($result->date)); ?></td>
                            <td><?php echo $result->ecgCount; $total = $total + $result->ecgCount; $ecgCountTotal = $ecgCountTotal + $result->ecgCount; ?></td>
                            <td><?php echo $total; $grandTotal = $grandTotal + $total; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>Grand Total</td>
                        <td><?php echo $ecgCountTotal; ?></td>
                        <td><?php echo $grandTotal; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>