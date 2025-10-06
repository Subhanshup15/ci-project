
<?php error_reporting(0);?>
<div class="row">

    <!--  form area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">



            <div class="panel-body panel-form">

                





                        <?php echo form_open('patients/add_investigation_original','class="form-inner"') ?>

<div class="row">

                            

    <div class="col-lg-6">
        <div class="form-group">
            <label for="description"> Name<i class="text-danger">*</i></label>
                
            <input name="name" class="form-control " type="text" placeholder="Name" id="name" required>
        </div>
        <div class="form-group">
            <label for="description">Age<i class="text-danger">*</i></label>
            <input name="age" class="form-control " type="text" placeholder="Age" id="age" required>
        </div>
        
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Date<i class="text-danger">*</i></label>
            <input name="create_date" class="datepicker form-control " type="text" placeholder="Create Date" id="create_date" value="<?php echo date('Y-m-d');?>" required>
        </div>
        <div class="form-group">
            <label for="name">Gender<i class="text-danger">*</i></label>
            <input name="sex" class="form-control " type="text" placeholder="Gender" id="sex" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Manufacturing Date<i class="text-danger">*</i></label>
            <input name="manufacturing_date" class="form-control " type="text" placeholder="Manufacturing Date" id="manufacturing_date" required>
        </div>
        <div class="form-group">
            <label for="name">Expiry Date<i class="text-danger">*</i></label>
            <input name="expiry_date" class="form-control " type="text" placeholder="Expiry Date" id="expiry_date" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Quantity<i class="text-danger">*</i></label>
            <input name="quantity" class="form-control " type="text" placeholder="Create Date" id="quantity" required>
        </div>
        <!--<div class="form-group">
            <label for="name">Expiry Date<i class="text-danger">*</i></label>
            <input name="tablet_company_name" class="form-control " type="text" placeholder="Tablet Company Name" id="tablet_company_name" required>
        </div>-->
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
 </div>


                        <?php echo form_close() ?>



                   

                </div>

            </div>

        </div>

    </div>
    
    <div class="row">
    
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
          
            <div class="panel-body">
           

              
				
               
                   
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