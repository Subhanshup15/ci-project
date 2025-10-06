<?php error_reporting(0);?>
<div class="row">
<!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-body panel-form">
                <?php echo form_open('patients/save_pharma_tab','class="form-inner"') ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Tablet Name<i class="text-danger">*</i></label>
                            <input name="tab_name" class="form-control " type="text" placeholder="Tablet Name" id="tab_name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name">Type Of Medicine<i class="text-danger">*</i></label>
                            <select name="type_of_medicine" id="type_of_medicine" class="form-control">
                                <option value="churn">Churn</option>
                                <option value="tablet">Tablet</option>
                                <option value="syrup">Syrup</option>
                                <option value="oil">Oil</option>
                                <option value="inj">Injection</option>
                                <option value="guggul">Guggul</option>
                                <option value="vati">Vati</option>
                                <option value="drop">Drop</option>
                                <option value="cream">Cream</option>
                                <option value="ointment">Ointment</option>
                                <option value="gloves">Gloves</option>
                                <option value="kadha">Kadha</option>
                                <option value="lep">Lep</option>
                                <option value="scalp">Scalp</option>
                                <option value="Venflon">Venflon</option>
                                <option value="needle">Needle</option>
                                <option value="cord_clamp">Cord Clamp</option>
                                <option value="needle">Needle</option>
                                <option value="syring">Syring</option>
                                <option value="Spirit">Spirit</option>
                                <option value="Sanitizer">Sanitizer</option>
                                <option value="iv">Iv. Fluid(Fluid)</option>
                                <option value="paper_tape">Paper Tape</option>
                                <option value="BLade">Blade</option>
                                <option value="iv_set">IV Set</option>
                                <option value="catheter">Catheter</option>
                                <option value="tube">Tube</option>
                                <option value="mask">Mask</option>
                                <option value="sunspension">Suspension</option>
                                <option value="Emulsion">Emulsion</option>
                                <option value="Cotton">Cotton</option>
                                <option value="Liquid">Liquid</option>
                                <option value="Powder">Powder</option>
                                <option value="Ghrita">Ghrita</option>
                                <option value="Lotion">Lotion</option>
                                <option value="Soap">Soap</option>
                                <option value="Capsule">Capsule</option>
                                <option value="Gauze">Gauze</option>
                                <option value="Shampoo">Shampoo</option>
                                <option value="Solution">Solution</option>
                                <option value="Gel">Gel</option>
                                <option value="Kit">Kit</option>
                                <option value="Ras">Ras</option>
                                <option value="Bati">Bati</option>
                                <option value="Kashay">Kashay</option>
                                <option value="Suture">Suture</option>
                                <option value="Catgut">Catgut</option>
                                <option value="Vicryl">Vicryl</option>
                                <option Bandage="Vicryl">Bandage</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="description">Quantity In<i class="text-danger">*</i></label>
                            <select name="quantity_in" id="quantity_in" class="form-control">
                                <option value="GM">GM</option>
                                <option value="ML">ML</option>
                                <option value="QTY">QTY</option>
                            </select>   
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