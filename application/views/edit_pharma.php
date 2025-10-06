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
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-body panel-form">
            <?php echo form_open('patients/update_stock_details','class="form-inner"') ?>
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php
                            
                            // print_r($pharma_stock);
                           // foreach($pharma_stock as $pharma_stock):?>
                            <input type="hidden" name="id" id="id" value="<?php echo $pharma_stock->id; ?>" >
                            <label for="description">Tablet Name<i class="text-danger">*</i></label>
                            <?php 
                                 //if($stock->tab_name=='')
                              // { ?>
                            <select name="tab_name" id="tab_name" class="form-control">
                                <option value="<?php echo $pharma_stock->tab_name;?>" selected><?php echo $pharma_stock->tab_name;?></option>
                                
                               <?php foreach($pharma_tab as $tab){
                                   
                                $t = array($pharma_stock->tab_name);
                                
                                $a1 = array($tab->tab_name);
                                
                                $b = array_diff($a1,$t);
                                ?>
                               
                                <option value="<?php  print_r($b[0]); ?>">
                                <?php  print_r($b[0]); ?>
                                </option>
                                
                                <?php } ?>
                               
                                
                                <!--<input name="tab_name" class="form-control " type="text" placeholder="Tab Name" id="tab_name" value="<?php echo $stock->tab_name;  ?>" readonly>-->
                                <?//php } ?>
                                 
                                
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="description">Batch Number<i class="text-danger">*</i></label>
                            <input name="batch_number" class="form-control " type="text" placeholder="Batch Number" id="batch_number" value="<?php echo $pharma_stock->batch_number;  ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Date<i class="text-danger">*</i></label>
                            <input name="create_date" class="form-control " type="text" placeholder="Create Date" id="create_date" value="<?php if($pharma_stock->create_date){ echo $pharma_stock->create_date;}else{ echo date('Y-m-d');} ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="name">Tablet Company Name<i class="text-danger">*</i></label>
                            <input name="tablet_company_name" class="form-control " type="text" placeholder="Tablet Company Name" id="tablet_company_name" value="<?php echo $pharma_stock->tablet_company_name; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Manufacturing Date<i class="text-danger">*</i></label>
                            <input name="manufacturing_date" class="form-control date-picker" type="text" placeholder="Manufacturing Date" value="<?php echo $pharma_stock->manufacturing_date; ?>" id="manufacturing_date" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Expiry Date<i class="text-danger">*</i></label>
                            <input name="expiry_date" class="form-control date-picker" type="text" placeholder="Expiry Date" value="<?php echo $pharma_stock->expiry_date; ?>" id="expiry_date" required>
                        </div>
                    </div>
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Quantity<i class="text-danger">*</i></label>
                            <input name="quantity" class="form-control " type="text" placeholder="Quantity" value="<?php echo $pharma_stock->quantity; ?>" id="quantity" >
                        </div>
                    </div>
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Closing Stock<i class="text-danger">*</i></label>
                            <input name="closing_stock" class="form-control " type="text" placeholder="Closing Stock" value="<?php echo $pharma_stock->closing_stock; ?>" id="closing_stock" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">MRP<i class="text-danger">*</i></label>
                            <input name="mrp" class="form-control " type="text" placeholder="MRP" value="<?php echo $pharma_stock->mrp; ?>" id="mrp" >
                        </div>
                    </div>
              
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Rate<i class="text-danger">*</i></label>
                            <input name="rate" class="form-control " type="text" placeholder="Rate" value="<?php echo $pharma_stock->rate; ?>" id="rate" >
                        </div>
                    </div>
              
              
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Discount<i class="text-danger">*</i></label>
                            <input name="discount" class="form-control " type="text" placeholder="Dscount" value="<?php echo $pharma_stock->discount; ?>" id="discount" >
                        </div>
                    </div>
              
              
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">GST<i class="text-danger">*</i></label>
                            <input name="gst" class="form-control " type="text" placeholder="GST" value="<?php echo $pharma_stock->gst; ?>" id="gst" >
                        </div>
                    </div>
              
              
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">GST Amount<i class="text-danger">*</i></label>
                            <input name="gst_amount" class="form-control " type="text" placeholder="GST Amount" value="<?php echo $pharma_stock->gst_amount; ?>" id="gst_amount" >
                        </div>
                    </div>
              
              
              <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Total Amount<i class="text-danger">*</i></label>
                            <input name="total_amount" class="form-control " type="text" placeholder="Total Amount" value="<?php echo $pharma_stock->total_amount; ?>" id="total_amount" >
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
    
<script>
     <script>
  $( function() {
    $( "#create_date" ).datepicker();
  } );
  </script>
</script>