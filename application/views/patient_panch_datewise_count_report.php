<div class="col-sm-12">
    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/getInvestiPanchCount/'.$section.'/panch/'.$report_cat.'/'.$report_type.'/'.$other_reg); ?>">
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
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xs-2" align="left">
                        <!--<img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />-->
                    </div> 
                    <div class="col-xs-8" align="center">
                        <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                        <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                        <?php if($section == 'ipd'){ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> IPD Panchkarma Date Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                        <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> OPD Panchkarma Date Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                    <?php  }  ?>
                    </div>
                    <div class="col-xs-2">
                    </div>
                </div>
            </div>
            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>SNEHAN</th>
                        <th>SWEDAN</th>
                        <th>VAMAN</th>
                        <th>VIRECHAN</th>
                        <th>NASYA</th>
                        <th>RAKTMOKSHAN</th>
                        <th>SHIRODHARA</th>
                        <th>SHIROBASTI</th>
                        <th>BASTI</th>
                        <th>OTHER</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $snehanCountTotal = 0; $swedanCountTotal = 0; $vamanCountTotal = 0; $virechanCountTotal = 0; 
                        $nasyaCountTotal = 0; $raktmokshanCountTotal = 0; $shirodharaCountTotal = 0; $shirobastiCountTotal = 0;
                        $bastiCountTotal = 0; $othersCountTotal = 0; $grandTotal = 0;
                    ?>
                    <?php foreach($resultData as $result) { ?>
                        <?php $total = 0;?>
                        <tr>
                            <td><?php echo date('d-m-Y',strtotime($result->date)); ?></td>
                            <td><?php echo $result->snehanCount; $total = $total + $result->snehanCount; $snehanCountTotal = $snehanCountTotal + $result->snehanCount; ?></td>
                            <td><?php echo $result->swedanCount; $total = $total + $result->swedanCount; $swedanCountTotal = $swedanCountTotal + $result->swedanCount; ?></td>
                            <td><?php echo $result->vamanCount; $total = $total + $result->vamanCount; $vamanCountTotal = $vamanCountTotal + $result->vamanCount; ?></td>
                            <td><?php echo $result->virechanCount; $total = $total + $result->virechanCount; $virechanCountTotal = $virechanCountTotal + $result->virechanCount; ?></td>
                            <td><?php echo $result->nasyaCount; $total = $total + $result->nasyaCount; $nasyaCountTotal = $nasyaCountTotal + $result->nasyaCount; ?></td>
                            <td><?php echo $result->raktmokshanCount; $total = $total + $result->raktmokshanCount; $raktmokshanCountTotal = $raktmokshanCountTotal + $result->raktmokshanCount; ?></td>
                            <td><?php echo $result->shirodharaCount; $total = $total + $result->shirodharaCount; $shirodharaCountTotal = $shirodharaCountTotal + $result->shirodharaCount; ?></td>
                            <td><?php echo $result->shirobastiCount; $total = $total + $result->shirobastiCount; $shirobastiCountTotal = $shirobastiCountTotal + $result->shirobastiCount; ?></td>
                            <td><?php echo $result->bastiCount; $total = $total + $result->bastiCount; $bastiCountTotal = $bastiCountTotal + $result->bastiCount; ?></td>
                            <td><?php echo $result->othersCount; $total = $total + $result->othersCount; $othersCountTotal = $othersCountTotal + $result->othersCount; ?></td>
                            <td><?php echo $total; $grandTotal = $grandTotal + $total; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>Grand Total</td>
                        <td><?php echo $snehanCountTotal; ?></td>
                        <td><?php echo $swedanCountTotal; ?></td>
                        <td><?php echo $vamanCountTotal; ?></td>
                        <td><?php echo $virechanCountTotal; ?></td>
                        <td><?php echo $nasyaCountTotal; ?></td>
                        <td><?php echo $raktmokshanCountTotal; ?></td>
                        <td><?php echo $shirodharaCountTotal; ?></td>
                        <td><?php echo $shirobastiCountTotal; ?></td>
                        <td><?php echo $bastiCountTotal; ?></td>
                        <td><?php echo $othersCountTotal; ?></td>
                        <td><?php echo $grandTotal; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>