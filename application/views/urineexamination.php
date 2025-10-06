<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("urineexamination/create") ?>"> <i class="fa fa-plus"></i>  Add </a>  
                </div>
                
            </div> 
            <div class="panel-body">
                <table width="100%" id="patientdata" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>              
                            <th><?php echo "Sno" ?></th>
                            <th><?php echo "Name" ?></th>                            
                            <th><?php echo "Age" ?></th>
                            <th><?php echo "Sex" ?></th>
                            <th><?php echo "OPD No" ?></th>
                            <th><?php echo "Date" ?></th>
                            <th><?php echo display('action') ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($urineexaminations)) { ?>
                            <?php $sl = 12141;
?>
                            <?php $i = 0; foreach ($urineexaminations as $lab) { $i++; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <!-- <td><?php //echo $patient->patient_id; ?></td> // Yearly reg no -->
                                    <td><?php echo $lab->id; ?></td>
                                    <td><?php echo $lab->name; ?></td>
                                    <td><?php echo $lab->age ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $lab->sex; ?></td>
                                    <td><?php echo $lab->opd_no; ?></td>
                                    <td><?php echo $lab->date; ?></td>                                
                                 
                                    <td class="center">
                                        <a href="<?php echo base_url("urineexamination/profile/$lab->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("urineexamination/edit/$lab->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <!--<a href="<?php echo base_url("urineexamination/delete/$lab->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a>--> 
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