<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
           <div class="col-md-12 col-sm-12">   
                    <div class="form-group row">
                      <label for="weight" class="col-xs-1 col-form-label">Create Date</label>
                     <div class="col-xs-4">
                      <input type="text" id="date" name="date" class=" datepicker  form-control" placeholder=''>
                     </div>
                      
                        <label for="dignosis" class="col-xs-1 col-form-label">Tablet</label>
                        <div class="col-xs-4">
                            <select name="tab_name" id="tab_name" class="form-control">
                                <option value="">Select Tab</option>
                                <?php 
                                //print_r($pharma_tab);
                                foreach($pharma_tab as $tab){ ?>
                                <option value="<?php echo $tab->tab_name; ?>"><?php echo $tab->tab_name; ?></option>
                                <?php } ?>
                            </select>                 
                        </div>
                    </div>
                    </div>
            <div class="panel-heading row">

                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>

                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              

                
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>
         </div>
         <div class="panel-body panel-form" id="PrintMe">
             
           <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <br>
           
             <hr>
            <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <?//php echo form_hidden('id',$biochemical->id); ?>        
                  
               
               <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Pharma Patient List With Dispense</h3>
                </div><br><br>     
                    
           <div class="row" >
             <div class="col-lg-12">
               <table class="table table-bordered table-striped">
                 <thead>
                   <tr>
                   <th>Sr. No</th>
                   <th>COPD No.</th>
                   <th>Tab Name</th>
                   <th>Despense</th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr>
                   <td id="srno"></td>
                   <td id="copd"></td>
                   <td id="tab_name_new"></td>
                   <td id="quantity"></td>
                     </tr>
                   <tr>
                     <td colspan='3'>Grand Total</td>
                     <td id='total'></td>
                   </tr>
                 </tbody>
               </table>
             </div>
           </div>
           
                </div>
               
            </div>
                
                <div class="form-group row no-print">
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

             // alert('failed');

          }

      });

  });



    
    
    $('body').on('keyup change', '#tab_name', function() {
        
        var tab_name_old = $('#tab_name').val();
       	var date = $('#date').val();
        $.ajax({
            url     : '<?php echo base_url('patients/fetch_datewise_despense') ?>',
            method  : 'post',
            dataType: 'json', 
            data    : {
                'tab_name' : tab_name_old,
                 'date' : date,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) { 
                  
                  
                  
                  $('#srno').empty();
                    $('#copd').empty();
                    $('#tab_name_new').empty();
                    $('#quantity').empty();
                  $('#total').empty();
                  
                  var tab_name_old = data.tab_name_old;
                  console.log(tab_name_old);
                   var newarray = data.patient_with_despense;
                  var a=1;
                for(var i=0;i<newarray.length;i++)
                {
                   var html = "<p>"+ a +"</p>";
                    $('#srno').append(html);
                   a++;
                }
                  
              //    if(data.patient_with_despense.tab_name)
                  
                   for(var j=0;j<newarray.length;j++)
                {
                   var html = "<p>"+ newarray[j].yearly_reg_no +"</p>";
                    $('#copd').append(html);
                }
                  
                  
                  for(var k=0;k<newarray.length;k++)
                {
                  	if(newarray[k].tab_name1 == tab_name_old )
                    {
                      var tab_name = newarray[k].tab_name1;
                    }
                  
                   if(newarray[k].tab_name2 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name2;
                  }
                  
                   if(newarray[k].tab_name3  == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name3;
                  }
                   if(newarray[k].tab_name4  == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name4;
                  }
                   if(newarray[k].tab_name5 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name5;
                  }
                   if(newarray[k].tab_name6 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name6;
                  }
                   if(newarray[k].tab_name7 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name7;
                  }
                   if(newarray[k].tab_name8 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name8;
                  }
                   if(newarray[k].tab_name9 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name9;
                  }
                   if(newarray[k].tab_name10 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name10;
                  }
                   if(newarray[k].tab_name11 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name11;
                  }
                   if(newarray[k].tab_name12 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name12;
                  }
                   if(newarray[k].tab_name13 == tab_name_old )
                  {
                    var tab_name = newarray[j].tab_name13;
                  }
                   if(newarray[k].tab_name14 == tab_name_old )
                  {
                    var tab_name = newarray[j].tab_name14;
                  }
                   if(newarray[k].tab_name15 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name15;
                  }
                   if(newarray[k].tab_name16 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name16;
                  }
                   if(newarray[k].tab_name17 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name17;
                  }
                   if(newarray[k].tab_name18 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name18;
                  }
                   if(newarray[k].tab_name19 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name19;
                  }
                   if(newarray[k].tab_name20 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name20;
                  }
                   if(newarray[k].tab_name21 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name21;
                  }
                   if(newarray[k].tab_name22 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name22;
                  }
                   if(newarray[k].tab_name23 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name23;
                  }
                  
                   if(newarray[k].tab_name24 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name24;
                  }
                  
                  if(newarray[k].tab_name25 == tab_name_old )
                  {
                    var tab_name = newarray[k].tab_name25;
                  }
                  
					var html = "<p>"+ tab_name +"</p>";
                  $('#tab_name_new').append(html);
                }
                  
                
                  
                  
                	let total_qty = 0; 
                  	let quantity = 0;
                	for(var l=0;l<newarray.length;l++)
                	{
                  
                  	if(newarray[l].tab_quantity1)
                    {
                        quantity = parseInt(newarray[l].tab_quantity1);
                    }
                  
                   if(newarray[l].tab_quantity2)
                  {
                     quantity = parseInt(newarray[l].tab_quantity2);
                  }
                  
                   if(newarray[l].tab_quantity3)
                  {
                     quantity = parseInt(newarray[l].tab_quantity3);
                  }
                   if(newarray[l].tab_quantity4)
                  {
                     quantity = parseInt(newarray[l].tab_quantity4);
                  }
                   if(newarray[l].tab_quantity5)
                  {
                     quantity = parseInt(newarray[l].tab_quantity5);
                  }
                   if(newarray[l].tab_quantity6)
                  {
                     quantity = parseInt(newarray[l].tab_quantity6);
                  }
                   if(newarray[l].tab_quantity7)
                  {
                     quantity = parseInt(newarray[l].tab_quantity7);
                  }
                   if(newarray[l].tab_quantity8)
                  {
                     quantity = parseInt(newarray[l].tab_quantity8);
                  }
                   if(newarray[l].tab_quantity9)
                  {
                     quantity = parseInt(newarray[l].tab_quantity9);
                  }
                   if(newarray[l].tab_quantity10)
                  {
                     quantity = parseInt(newarray[l].tab_quantity10);
                  }
                   if(newarray[l].tab_quantity11)
                  {
                     quantity = parseInt(newarray[l].tab_quantity11);
                  }
                   if(newarray[l].tab_quantity12)
                  {
                     quantity = parseInt(newarray[l].tab_quantity12);
                  }
                   if(newarray[l].tab_quantity13)
                  {
                     quantity = parseInt(newarray[l].tab_quantity13);
                  }
                   if(newarray[l].tab_quantity14)
                  {
                     quantity = parseInt(newarray[l].tab_quantity14);
                  }
                   if(newarray[l].tab_quantity15)
                  {
                     quantity = parseInt(newarray[l].tab_quantity15);
                  }
                   if(newarray[l].tab_quantity16)
                  {
                     quantity = parseInt(newarray[l].tab_quantity16);
                  }
                   if(newarray[l].tab_quantity17)
                  {
                     quantity = parseInt(newarray[l].tab_quantity17);
                  }
                   if(newarray[l].tab_quantity18)
                  {
                     quantity = parseInt(newarray[l].tab_quantity18);
                  }
                   if(newarray[l].tab_quantity19)
                  {
                     quantity = parseInt(newarray[l].tab_quantity19);
                  }
                   if(newarray[l].tab_quantity20)
                  {
                     quantity = parseInt(newarray[l].tab_quantity20);
                  }
                   if(newarray[l].tab_quantity21)
                  {
                     quantity = parseInt(newarray[l].tab_quantity21);
                  }
                   if(newarray[l].tab_quantity22)
                  {
                     quantity = parseInt(newarray[l].tab_quantity22);
                  }
                   if(newarray[l].tab_quantity23)
                  {
                     quantity = parseInt(newarray[l].tab_quantity23);
                  }
                  
                   if(newarray[l].tab_quantity24)
                  {
                     quantity = parseInt(newarray[l].tab_quantity24);
                  }
                  
                  if(newarray[l].tab_quantity25)
                  {
                     quantity = parseInt(newarray[l].tab_quantity25);
                  }
                  
                 // var new_array = array(quantity);
                  
                 
					var html = "<p>"+ quantity +"</p>";
                  $('#quantity').append(html);
                  //var final_quantity = parseInt(quantity);
                   total_qty = total_qty + quantity;
              //   var ttt = typeof(total_qty);
                 
                 // console.log(ttt);
                }
               // var total =  parseInt(total_qty);
                  
                    var html = "<p>"+ total_qty +"</p>";
                  $('#total').append(html);
                  
                  
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
              //  alert('failed!');
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