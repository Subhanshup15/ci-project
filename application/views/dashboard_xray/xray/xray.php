<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("xray/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  
                </div>
                
            </div> 
            <div class="panel-body">
                <table width="100%" id="patientdata" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                

                            <th><?php echo "Sno" ?></th>
                            <th><?php echo "Date" ?></th>
                            <th><?php echo "Regs No" ?></th>                            
                            <th><?php echo "OPD No" ?></th>
                            <th><?php echo "IPD No" ?></th>
                            <th><?php echo "Patient Name" ?></th>
                            <th><?php echo "Age" ?></th>   
                            <th><?php echo "Department Name" ?></th>   
                            <th><?php echo "Xray Chesast" ?></th>   
                            <th><?php echo "Xray Kub" ?></th>   
                            <th><?php echo "Other" ?></th>                                              
                            <th><?php echo display('action') ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($xrays)) { ?>
                            <?php $sl = 12141;
?>
                            <?php $i = 0; foreach ($xrays as $xray) { $i++; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <!-- <td><?php //echo $patient->patient_id; ?></td> // Yearly reg no -->
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $xray->create_date; ?></td>
                                    <td><?php echo $xray->reg_no; ?></td>
                                    <td><?php echo $xray->opd_no ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $xray->ipd_no; ?></td>
                                    <td><?php echo $xray->name; ?></td> 
                                    <td><?php echo $xray->age; ?></td> <!-- //old patient no -->
                                    <td><?php echo $xray->department_id; ?></td>        
                                    <td><?php echo $xray->xray_chesast; ?></td>
                                    <td><?php echo $xray->xray_kub; ?></td>
                                    <td><?php echo $xray->other; ?></td>                                   
                                 
                                    <td class="center">
                                        <a href="<?php echo base_url("xray/profile/$xray->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("xray/edit/$xray->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("xray/delete/$xray->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
                                    </td>                                     
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>