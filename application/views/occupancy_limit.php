<div class="row">

    <!--  form area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <!--<div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-primary" href="<?php echo base_url("department/occupancy_limit") ?>"> <i class="fa fa-list"></i> Data Limit</a>  

                </div>

            </div> -->



            <div class="panel-body panel-form">

                <div class="row">





                        <?php echo form_open('department/occupancy_limit','class="form-inner"') ?>



                            <?php //echo form_hidden('dprt_id',$department->dprt_id) ?>



                            <div class="form-group row">

                                <label for="name" class="col-xs-3 col-form-label">Set Occupancy Limit<i class="text-danger">*</i></label>

                                <div class="col-xs-9">
                                    <input type="hidden" name="id" value="<?php echo $department->id;?>">
                                    <input name="data_limit"  type="number" class="form-control" id="data_limit" placeholder="enter the number" value="<?php echo $department->data_limit; ?>" required>

                                </div>

                            </div>



                            <div class="form-group row">

                                <label for="description" class="col-xs-3 col-form-label"><?php echo display('description') ?></label>

                                <div class="col-xs-9">

                                    <textarea name="description" class="form-control"  placeholder="<?php echo display('description') ?>" rows="7"><?php echo $department->description ?></textarea>

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
