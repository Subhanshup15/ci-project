<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('stock/oil_stock_import_report'); ?>">
            <div class="form-group" id="startDate">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>  
            <div class="form-group" id="endDate">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
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
            </div>
            <div class="panel-body">
                <div>
                    <div class="col-sm-12" align="center" style="margin-bottom: 10px;">
                        <h3><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                        <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                    </div>
                    <div>
                        <div class="col-sm-12" align="center">
                            <h3><strong><?php echo "Oil Stock Import Register"; ?></strong></h3>
                            <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                        </div>
                        <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">S.No</th>
                                    <th style="width: 30px;">Name</th>
                                    <th style="width: 30px;">Date</th>
                                    <th style="width: 30px; text-align: center;">Opening Stock</th>
                                    <th style="width: 30px; text-align: center;">Added Stock</th>
                                    <th style="width: 30px; text-align: center;">Total Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?//php print_r($oilstockImportData);?>
                                <?php $i=0;?>
                                <?php foreach($oilstockImportData as $stImpData){ ?>
                                    <tr>
                                        <td><?php echo $i=$i+1;?></td>
                                        <td><?php echo $stImpData->name; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($stImpData->create_date)); ?></td>
                                        <td><?php echo $stImpData->current_stock; ?></td>
                                        <td><?php echo $stImpData->added_stock; ?></td>
                                        <td><?php echo $stImpData->total_stock; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
