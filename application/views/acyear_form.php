<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?php echo base_url("acyear") ?>"> <i class="fa fa-list"></i>  Acadmic year </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
         <?php echo form_open_multipart('acyear/create','class="form-inner"') ?>
         
            <div class="row">
               <div class="col-md-4 col-md-offset-4">
                  <div class="form-group row">
                     <label for="year" class="col-xs-3 col-form-label"> Year <i class="text-danger">*</i></label>
                     <div class="col-xs-9">
                        <input name="year" type="text" class="form-control" id="year" placeholder="Year" value="<?php echo $acyear->year ?>" >
                     </div>
                  </div>

                  <div class="form-group row">
               <label class="col-sm-1"><?php echo display('status') ?></label>
               <div class="col-xs-3">
                  <div class="form-check">
                     <label class="radio-inline">
                     <input type="radio" name="status" value="1" <?php echo  set_radio('status', '1', TRUE); ?> ><?php echo display('active') ?>
                     </label>
                     <label class="radio-inline">
                     <input type="radio" name="status" value="0" <?php echo  set_radio('status', '0'); ?> ><?php echo display('inactive') ?>
                     </label>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>