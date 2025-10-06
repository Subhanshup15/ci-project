<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">

<script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
        });
    </script>
    <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
<?php error_reporting(0);?>
<div class="row">
    

    <!--  form area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

        <div class="panel-heading no-print row">

                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/pharma_list") ?>"> <i class="fa fa-plus"></i> Stock List</a>  
                </div>              

            </div>

            <div class="panel-body panel-form">

                





                        <?php echo form_open('patients/save_pharma_patient','class="form-inner"') ?>

<div class="row">

                            

    <div class="col-lg-6">
        <div class="form-group">
            <label for="description">Tablet Name<i class="text-danger">*</i></label>
                <select name="tab_name" id="tab_name" class="form-control">
                    <option value="">Select Tab</option>
                    <?php 
                    //print_r($pharma_tab);
                    foreach($pharma_tab as $tab){ ?>
                    <option value="<?php echo $tab->tab_name; ?>"><?php echo $tab->tab_name; ?></option>
                    <?php } ?>
                </select> 
            <!--<input name="tab_name" class="form-control " type="text" placeholder="Tablet Name" id="tab_name" required>-->
        </div>
        <div class="form-group">
            <label for="description">Batch Number<i class="text-danger">*</i></label>
            <input name="batch_number" class="form-control " type="text" placeholder="Batch Number" id="batch_number" required>
        </div>
        
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Date<i class="text-danger">*</i></label>
            <input name="create_date" class=" form-control " type="text" placeholder="Create Date" id="create_date" value="<?php echo date('Y-m-d');?>"required>
        </div>
        <div class="form-group">
            <label for="name">Tablet Company Name<i class="text-danger">*</i></label>
            <input name="tablet_company_name" class="form-control " type="text" placeholder="Tablet Company Name" id="tablet_company_name" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Manufacturing Date<i class="text-danger">*</i></label>
            <input name="manufacturing_date" class=" form-control date-picker" type="text" placeholder="Manufacturing Date" id="manufacturing_date" required>
        </div>
        <div class="form-group">
            <label for="name">Expiry Date<i class="text-danger">*</i></label>
            <input name="expiry_date" class=" form-control date-picker" type="text" placeholder="Expiry Date" id="expiry_date" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">Quantity<i class="text-danger">*</i></label>
            <input name="quantity" class="form-control " type="text" placeholder="Quantity" id="quantity" required>
        </div>
        <div class="form-group">
            <label for="name">Agency Name<i class="text-danger">*</i></label>
            <input name="agency_name" class="form-control " type="text" placeholder="Agency Name" id="agency_name" required>
        </div>
    </div>
  
  
  <div class="col-lg-6">
        <div class="form-group">
            <label for="name">M.R.P.<i class="text-danger">*</i></label>
            <input name="mrp" class=" form-control" type="text" placeholder="M.R.P." id="mrp" required>
        </div>
        <div class="form-group">
            <label for="name">RATE<i class="text-danger">*</i></label>
            <input name="rate" class=" form-control" type="text" placeholder="RATE" id="rate" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name">DISC<i class="text-danger">*</i></label>
            <input name="discount" class="form-control " type="text" placeholder="DISC" id="discount" required>
        </div>
        <div class="form-group">
            <label for="name">GST%<i class="text-danger">*</i></label>
            <input name="gst" class="form-control " type="GST%" placeholder="GST %" id="gst" required>
        </div>
    </div>
   <div class="col-lg-6">
        <div class="form-group">
            <label for="name">GST AMT<i class="text-danger">*</i></label>
            <input name="gst_amount" class="form-control " type="text" placeholder="GST AMT" id="gst_amount" required>
        </div>
        <div class="form-group">
            <label for="name">AMOUNT<i class="text-danger">*</i></label>
            <input name="total_amount" class="form-control " type="GST%" placeholder="AMOUNT" id="total_amount" required>
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
    
<!--<script>
  $( function() {
    $( "#create_date" ).datepicker();
  } );
</script>-->