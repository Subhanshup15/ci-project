
<?php error_reporting(0);?>
<div class="row">

    <!--  form area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">



            <div class="panel-body panel-form">

                <div class="row">





                        <?php echo form_open('department/save_holiday','class="form-inner"') ?>



                            <?php //echo form_hidden('dprt_id',$department->dprt_id) ?>



                            <div class="form-group row">

                                <label for="name" class="col-xs-3 col-form-label">Add New Holiday<i class="text-danger">*</i></label>

                                <div class="col-xs-9">
                                   <input name="create_date" class="datepicker form-control " type="text" placeholder="Create Date" id="create_date" value="<?php echo date('Y-m-d');?>">

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?></label>

                                <div class="col-xs-9">

                                    <textarea name="description" class="form-control"  placeholder="<?php echo display('description') ?>" rows="7"><?php echo $holiday->description ?></textarea>

                                </div>

                            </div>



                            <!--Radio-->

                            <div class="form-group row">

                                <label class="col-sm-3"><?php echo display('status') ?></label>

                                <div class="col-xs-9"> 

                                    <div class="form-check">

                                        <label class="radio-inline"><input type="radio" name="status" value="1" checked><?php echo display('active') ?></label>

                                        <label class="radio-inline"><input type="radio" name="status" value="0"><?php echo display('inactive') ?></label>

                                    </div>

                                </div>

                            </div>

                            

                            <div class="form-group row">

                                <div class="col-sm-offset-3 col-sm-6">

                                    <div class="ui buttons">

                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>

                                        <div class="or"></div>

                                        <button class="ui positive button"><?php echo display('save') ?></button>

                                    </div>

                                </div>

                            </div>



                        <?php echo form_close() ?>



                    </div>

                </div>

            </div>

        </div>

    </div>
    
    <div class="row">
    
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
          
            <div class="panel-body">
           
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                
                            <th style="width: 30px;">Sr No.</th>
                            <th style="width: 30px;">Holiday Date</th>                                                                                   
                            <th style="width: 30px;">Description</th> 
                            <th style="width: 30px;">Action</th>
                                                   
                        </tr>
                    </thead>
                    <tbody>
                        <?php $m = 1; foreach ($patients as $patient) { $i++; ?>
                                <tr class="">
                                    <td><?php echo $m++; ?></td>
                                    <td><?php echo $patient->holiday_date; ?></td>
                                    <td><?php echo $patient->description ?></td>
                                    
                                   
                                    <td class="">
                                        <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Edit</a> 
                                        <a href="#" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i>Delete</a> 
                                           <?php //echo base_url("patient/edit/$patient->id/ipd") ?>
                                    </td>                                     
                                </tr>
                                <?php $m++; ?>
                            <?php } ?> 
                       
                    </tbody>
                </table>  <!-- /.table-responsive -->
              
              
				
               
                   
            </div>
        </div>
    </div>
</div>
    
<script>
     <script>
  $( function() {
    $( "#create_date" ).datepicker();
  } );
  </script>
</script>