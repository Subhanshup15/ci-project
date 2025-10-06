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
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
 
                
                <?php if($section == 'ipd'){ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"> IPD Panchkarma Procedure Summery Count Register</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                <?php }else{ ?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;"> OPD Panchkarma Procedure Summery Count Register</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                <?php  }  ?>
            </div>
             <div class="col-xs-2"></div
            </div>
            </div>
            <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Name</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grandTotal = 0; ?>
                    <tr>
                        <td>1</td>
                        <td>SNEHAN</td>
                        <td><?php echo $resultData->snehanCount; $grandTotal = $grandTotal + $resultData->snehanCount;?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SWEDAN</td>
                        <td><?php echo $resultData->swedanCount; $grandTotal = $grandTotal + $resultData->swedanCount;?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>VAMAN</td>
                        <td><?php echo $resultData->vamanCount; $grandTotal = $grandTotal + $resultData->vamanCount;?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>VIRECHAN</td>
                        <td><?php echo $resultData->virechanCount; $grandTotal = $grandTotal + $resultData->virechanCount;?></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>NASYA</td>
                        <td><?php echo $resultData->nasyaCount; $grandTotal = $grandTotal + $resultData->nasyaCount;?></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>RAKTMOKSHAN</td>
                        <td><?php echo $resultData->raktmokshanCount; $grandTotal = $grandTotal + $resultData->raktmokshanCount;?></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>SHIRODHARA</td>
                        <td><?php echo $resultData->shirodharaCount; $grandTotal = $grandTotal + $resultData->shirodharaCount;?></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>SHIROBASTI</td>
                        <td><?php echo $resultData->shirobastiCount; $grandTotal = $grandTotal + $resultData->shirobastiCount;?></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>BASTI</td>
                        <td><?php echo $resultData->bastiCount; $grandTotal = $grandTotal + $resultData->bastiCount;?></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>OTHER</td>
                        <td><?php echo $resultData->othersCount; $grandTotal = $grandTotal + $resultData->othersCount;?></td>
                    </tr>
                    <tr>
                        <td colspan=2>Grand Total</td>
                        <td><?php echo $grandTotal;?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>