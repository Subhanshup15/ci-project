<div class="row">

    <!--  form area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">
            <div class="panel-body panel-form">
                <div class="row">
                <div class="form-group row">
                              <?php echo form_open('department/save_auto','class="form-inner"') ?>
                                <label class="col-sm-3" style ="padding-left:65px;">AUTO</label>

                                <div class="col-xs-2"> 

                                    <div class="form-check">
                                        <label class="radio-inline"><input type="radio" name="auto" value="0" <?php if($auto[0]->status=='0'){ echo "checked"; }?>>ON</label>
                                        <label class="radio-inline"><input type="radio" name="auto" value="1" <?php if($auto[0]->status=='1'){ echo "checked"; }?>>OFF</label>
                                    </div>
                                   
                                </div>
                                
                             

                               <div class="col-xs-3"> 

                                    <div class="ui buttons">

                                         <button class="ui positive button"><?php echo display('save') ?></button>

                                    </div>

                                </div>

                            </div>

                            </div>
                             <?php echo form_close() ?>
                      </div>
                      <hr>
                <div class="row">
                     <?php echo form_open('department/save_opd_ipd_time','class="form-inner"') ?>
                         
                           <?php for($i=0;$i<count($department); $i++){?>
                            <div class="row">
                            <div class="form-group row">

                                <label for="name" class="col-xs-3 col-form-label" style ="padding-left:65px;">Set Start Time <?php echo ucfirst($department[$i]->name); ?><i class="text-danger">*</i></label>
                                 <input name="id[]"  type="hidden" class="form-control" id="start_time" placeholder="enter the Start Time" value="<?php echo $department[$i]->id; ?>" required>
                                <div class="col-xs-3">
                                   
                                    <input name="start_time[]"  type="text" class="form-control timepicker" id="start_time" placeholder="enter the Start Time" value="<?php echo $department[$i]->start_time; ?>" required>

                                </div>
                                 <div class="col-xs-3">
                                   
                                    <input name="end_time[]"  type="text" class="form-control timepicker" id="start_time" placeholder="enter the Start Time" value="<?php echo $department[$i]->end_time; ?>" required>

                                </div>

                            </div>
                          </div>
                           <?php } ?>
                            <!--Radio-->

                            <div class="form-group row">

                                <label class="col-sm-3" style ="padding-left:65px;"><?php echo display('status') ?></label>

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



