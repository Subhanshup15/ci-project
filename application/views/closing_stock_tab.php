<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
               <a class="btn btn-primary" href="<?//php echo base_url("biochemical") ?>"> <i class="fa fa-list"></i>  List </a>  
            </div>
         </div>
         <div class="panel-body panel-form">
             
           <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
           
            
            <br>
           
             <hr>
            <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <?//php echo form_hidden('id',$biochemical->id); ?>        
                  
               <div class="col-md-12 col-sm-12">   

                  
                  
                    <div class="form-group row">
                        <label for="dignosis" class="col-xs-2 col-form-label">Tablet</label>
                        <div class="col-xs-4">
                            <select name="tab_name" id="tab_name" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
                                <option value="<?php echo $tab->id; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>
                            </select>                 
                        </div>
                        <label for="weight" class="col-xs-3 col-form-label">Available Stock</label>
                     <div class="col-xs-3">
                         <input type="text" id="closing_stock_tab" name="closing_stock_tab" class="form-control" placeholder='Available Stock' readonly>
                         
                        
                     </div>
                    </div>
                 
                    <div class="form-group row">
                        <label for="weight" class="col-xs-2 col-form-label">Agency Name</label>
                        <div class="col-xs-4">
                         	<input type="text" id="agency_name" name="agency_name" class="form-control" placeholder='Agency Name' readonly>
                     	</div>
                          <label for="weight" class="col-xs-2 col-form-label">Unit</label>
                          <div class="col-xs-4">
                              <input type="text" id="Unit" name="Unit" class="form-control" placeholder='Unit' readonly>
                          </div>
                    	</div>
                	</div>
           
           
        
        			<div class="form-group row">
                        <label for="weight" class="col-xs-2 col-form-label">Batch Number</label>
                        <div class="col-xs-4">
                         	<input type="text" id="batch_number" name="batch_number" class="form-control" placeholder='Batch Number' readonly>
                     	</div>
                          <label for="weight" class="col-xs-2 col-form-label">Stock Added Date</label>
                          <div class="col-xs-4">
                              <input type="text" id="date_added_stock" name="date_added_stock" class="form-control" placeholder='Stock Added Date' readonly>
                          </div>
                    	</div>
                	</div>
        
        			<div class="form-group row">
                        <label for="weight" class="col-xs-2 col-form-label">Manufacturing Date</label>
                        <div class="col-xs-4">
                         	<input type="text" id="manufacturing_date" name="manufacturing_date" class="form-control" placeholder='Manufacturing Date' readonly>
                     	</div>
                          <label for="weight" class="col-xs-2 col-form-label">Expiry Date</label>
                          <div class="col-xs-4">
                              <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder='Expiry Date' readonly>
                          </div>
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

<script>
$(document).ready(function() {
   
  $('#opd_no').keyup(function(){

      var pid = $(this);
       
      $.ajax({

          url  : '<?= base_url('patients/check_patient/') ?>',

          type : 'post',

          dataType : 'JSON',

          data : {

              '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',

              old_reg_no : pid.val()

          },

          success : function(data) 
           

          {
              //console.log(data);

              if (data.status == true) {
                 //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                 //$('#yearly_no').val(data.patient.yearly_no);
                 
                $('#firstname').val(data.patient.firstname);
                $('#age').val(data.patient.date_of_birth);
                $('#sex').val(data.patient.sex);
                $('#weight').val(data.patient.wieght);
                $('#dignosis').val(data.patient.dignosis);
                $('#id').val(data.patient.id);
                $('#address').val(data.patient.address);

              } else if (data.status == false) {

                  pid.next().text(data.message).addClass('text-danger').removeClass('text-success');

              } else {

                  pid.next().text(data.message).addClass('text-danger').removeClass('text-success');

              }

          }, 

          error : function()

          {

              alert('failed');

          }

      });

  });



    
    
    $('body').on('keyup change', '#tab_name', function() {
        
        var tab_name = $('#tab_name').val();
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_closing_stock') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name' : tab_name,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                    $('#closing_stock_tab').val(data.closing_stock);
                    $('#agency_name').val(data.agency_name);
                  	$('#Unit').val(data.unit);
                  
                  	$('#batch_number').val(data.batch_number);
                    $('#date_added_stock').val(data.stock_added_date);
                  	$('#manufacturing_date').val(data.manufacturing_date);
                  	$('#expiry_date').val(data.expiry_date);
                  
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
   
    
    
})
   </script>
   <script>
  $( function() {
    $( "#create_date" ).datepicker();
  } );
</script>