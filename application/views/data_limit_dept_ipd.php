<?php echo error_reporting(0);?>
<div class="row">

    <!--  form area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <!--<div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-primary" href="<?php echo base_url("department/deprt_panch") ?>"> <i class="fa fa-list"></i> Data Limit</a>  

                </div>

            </div> -->



            <div class="panel-body panel-form">
  <?php echo form_open('department/data_limit_dept_ipd_update','class="form-inner"') ?>
                <div class="row">

                            <div class="form-group row">

                                <label for="name" class="col-sm-offset-2 col-xs-3 col-form-label">Department Data Limit For IPD<i class="text-danger"></i></label>
                                <label for="name" class="col-xs-2 col-form-label" style="text-align: center;">Male<i class="text-danger"></i></label>
                                <label for="name" class="col-xs-2 col-form-label" style="text-align: center;">Female<i class="text-danger"></i></label>
                            </div>
				</div>
				
                <div class="row">
                           <?php for($i=0;$i<count($department);$i++){?>
                            <div class="form-group row">
                                 
                                <label for="name" class="col-sm-offset-2 col-xs-3 col-form-label" style="padding-left: 50px;"><?php echo $department[$i]->dept_name;?><i class="text-danger">*</i></label>
                                <input type="hidden" name="dept_id[]" value="<?php echo $department[$i]->dept_id;?>">
                                
                                <div class="col-xs-2">
                                    
                                    <input name="data_limit_m[]"  type="number" class="form-control" id="data_limit_m" placeholder="enter the number" value="<?php echo $department[$i]->data_limit_m; ?>" required>

                                </div>
                                <div class="col-xs-2">
                                    
                                    <input name="data_limit_f[]"  type="number" class="form-control" id="data_limit_f" placeholder="enter the number" value="<?php echo $department[$i]->data_limit_f; ?>" required>

                                </div>
                                
                            </div>
                            <?php } ?>
                </div>


                            



                            
                <div class="row">
                            <div class="form-group row">

                                <div class="col-sm-offset-6 col-sm-6">

                                    <div class="ui buttons">

                                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>

                                        <div class="or"></div>

                                        <button class="ui positive button"><?php echo display('save') ?></button>

                                    </div>

                                </div>

                            </div>


                    </div>
                 <?php echo form_close() ?>
                </div>

            </div>

        </div>

    </div>


