<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print row">
                <div class="btn-group col-md-4"> 
                    <a class="btn btn-success" href="<?php echo base_url("patient/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>
                <div class="col-md-8">
                   
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                      

                            <th><?php echo "Patient id" ?></th>
                            <th><?php echo "Yearly reg. no" ?></th>                            
                            <th><?php echo "Daily reg. no" ?></th>
                            <th><?php echo "Monthly reg. no" ?></th>
                            <th><?php echo "Old patient no" ?></th>
                            <th><?php echo display('first_name') ?></th>   
                            <th><?php echo display('sex') ?></th>   
                            <th><?php echo "Age" ?></th>                  
                            <th><?php echo display('address') ?></th>
                            <th><?php echo "Department" ?></th>
                            <th><?php echo display('action') ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;

?>
                            <?php foreach ($patients as $patient) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $patient->patient_id; ?></td> <!-- // Yearly reg no -->
                                    <td><?php echo $patient->yearly_reg_no ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $patient->daily_reg_no; ?></td>
                                    <td><?php echo $patient->monthly_reg_no; ?></td> 
                                    <td><?php echo $patient->old_reg_no; ?></td> <!-- //old patient no -->
                                    <td><?php echo $patient->firstname; ?></td>        
                                    <td><?php echo $patient->sex; ?></td>
                                    <td><?php 
                                    $dateOfBirth = $patient->date_of_birth;
                                    $today = date("Y-m-d");
                                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                    echo $diff->format('%y');    
                                    ?></td> 
                                    <td><?php echo $patient->address; ?></td>  
                                    <td><?php echo $patient->department_id; ?></td>  
                                    <td class="center">
                                        <a href="<?php echo base_url("patient/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("patient/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("patient/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
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


