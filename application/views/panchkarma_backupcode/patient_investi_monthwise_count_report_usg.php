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
                    <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
                </div> 
                <div class="col-sm-8" align="center">
                   <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    
                    <?php if($section == 'ipd'){ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> IPD USG Month Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                    <?php }else{ ?>
                        <h3 style="margin-top: 0px; margin-bottom: 15px;"> OPD USG Month Wise Summery Count Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                    <?php  }  ?>
                </div>
                 <div class="col-sm-2"></div>
                <!--<?//php print_r($resultData); ?>-->
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <?php for($i=1; $i<=12; $i++){ ?>
                            <th><?php $month_name = date("M", mktime(0, 0, 0, $i, 10)); echo strtoupper($month_name); ?></th>
                            <?php } ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $panchkarma_item = array(
                                'usgCount' => 'USG'
                            ); 
                            $i = 0;
                        ?>
                        <?php 
                            $j1 = 0; $j2 = 0; $j3 = 0; $j4 = 0; $j5 = 0; $j6 = 0; $j7 = 0; $j8 = 0; $j9 = 0; $j10 = 0;$j11 = 0;$j12 = 0;
                            $total_j1 = 0; $total_j2 = 0; $total_j3 = 0; $total_j4 = 0; $total_j5 = 0; $total_j6 = 0; 
                            $total_j7 = 0; $total_j8 = 0; $total_j9 = 0; $total_j10 = 0; $total_j11 = 0; $total_j12 = 0;
                            $total = 0; $grandTotal = 0;
                        ?>
                        <?php foreach($panchkarma_item as $item => $key){ ?>
                            <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $j1 = $resultData[$i++][$item]; $total = $total + $j1 ; $total_j1 = $total_j1 + $j1 ; ?></td>
                                <td><?php echo $j2 = $resultData[$i++][$item]; $total = $total + $j2 ; $total_j2 = $total_j2 + $j2 ; ?></td>
                                <td><?php echo $j3 = $resultData[$i++][$item]; $total = $total + $j3 ; $total_j3 = $total_j3 + $j3 ; ?></td>
                                <td><?php echo $j4 = $resultData[$i++][$item]; $total = $total + $j4 ; $total_j4 = $total_j4 + $j4 ; ?></td>
                                <td><?php echo $j5 = $resultData[$i++][$item]; $total = $total + $j5 ; $total_j5 = $total_j5 + $j5 ; ?></td>
                                <td><?php echo $j6 = $resultData[$i++][$item]; $total = $total + $j6 ; $total_j6 = $total_j6 + $j6 ; ?></td>
                                <td><?php echo $j7 = $resultData[$i++][$item]; $total = $total + $j7 ; $total_j7 = $total_j7 + $j7 ; ?></td>
                                <td><?php echo $j8 = $resultData[$i++][$item]; $total = $total + $j8 ; $total_j8 = $total_j8 + $j8 ; ?></td>
                                <td><?php echo $j9 = $resultData[$i++][$item]; $total = $total + $j9 ; $total_j9 = $total_j9 + $j9 ; ?></td>
                                <td><?php echo $j10 = $resultData[$i++][$item]; $total = $total + $j10 ;  $total_j10 = $total_j10 + $j10; ?></td> 
                                <td><?php echo $j11 = $resultData[$i++][$item]; $total = $total + $j11 ;  $total_j11 = $total_j11 + $j11; ?></td>
                                <td><?php echo $j12 = $resultData[$i++][$item]; $total = $total + $j12 ;  $total_j12 = $total_j12 + $j12; ?></td>
                                <th><?php echo $total; $grandTotal = $grandTotal + $total; ?></th>
                                <?php if($i>=12){$i=0;} ?>
                                <?php  
                                    $j1 = 0; $j2 = 0; $j3 = 0; $j4 = 0; $j5 = 0; $j6 = 0; 
                                    $j7 = 0; $j8 = 0; $j9 = 0; $j10 = 0;$j11 = 0;$j12 = 0;
                                    $total = 0;
                                ?>
                            </tr>
                        <?php } ?>
                            <!--<tr>-->
                            <!--    <th>Grand Total</th>-->
                            <!--    <th><?php echo $total_j1; ?></th>-->
                            <!--    <th><?php echo $total_j2; ?></th>-->
                            <!--    <th><?php echo $total_j3; ?></th>-->
                            <!--    <th><?php echo $total_j4; ?></th>-->
                            <!--    <th><?php echo $total_j5; ?></th>-->
                            <!--    <th><?php echo $total_j6; ?></th>-->
                            <!--    <th><?php echo $total_j7; ?></th>-->
                            <!--    <th><?php echo $total_j8; ?></th>-->
                            <!--    <th><?php echo $total_j9; ?></th>-->
                            <!--    <th><?php echo $total_j10; ?></th> -->
                            <!--    <th><?php echo $total_j11; ?></th>-->
                            <!--    <th><?php echo $total_j12; ?></th>-->
                            <!--    <th><?php echo $grandTotal; ?></th>-->
                            <!--</tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>