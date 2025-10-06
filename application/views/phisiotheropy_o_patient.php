<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="http://anjaneyaamc.verticaltechsoft.com/assets/css/custom-style1.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  
.modal-header .close {
    margin-top: -2px;
    font-size: :40px;
    color: red;
    font-size: 35px;
    opacity: 0.8;
}

.modal-header {
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    background: green;
    text-color: white;
    color: white;
    font-size: 21px;
}
</style>
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
             
           <?//php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <div class="row">
                <div class="col-lg-4">
                    <lable>Section </lable>
                    <select class="form-control" name="section" id="section">
                        <option value="opd">OPD</option>
                        <option value="ipd">IPD</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <lable>Date</lable>
                    <input type="text" name="date" id="date" placeholder="Date" class="datepicker form-control">
                </div>
                <div class="col-lg-4">
                    <lable>Name</lable>
                    <select class="form-control" name="patient_name" id="patient_name">
                    </select>
                    <!--<input type="text" name="patient_name" placeholder="Patient_name" id="patient_name" class="form-control">-->
                </div>
            </div>
            
            <br>
            <div class="row" style="padding: 20px;box-shadow: #307e43 1px 1px 5px 1px;margin: 10px;">
            <div class="row">
                <div class="col-md-6">
                    <lable>PHYSIOTHERAPY</lable>
                    <input type="text" name="PHYSIOTHERAPY" id="PHYSIOTHERAPY" placeholder="PHYSIOTHERAPY" class="form-control" readonly>
                </div>
               
            </div>
            </div>
             <hr>
            <?php echo form_open_multipart('patients/save_pharma_patient_count','class="form-inner"') ?>
            <?//php echo form_hidden('id',$biochemical->id); ?>        
                  
               <div class="col-md-6 col-sm-12">   
                    <div class="form-group row">
                    <label for="opd_no" class="col-xs-3 col-form-label">Opd No</label>
                    <div class="col-xs-9">
                    <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?//php echo $biochemical->opd_no ?>">    
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="name" class="col-xs-3 col-form-label">Name</label>
                    <div class="col-xs-9">
                    <input name="firstname" autocomplete="off" type="text" class="form-control" id="firstname" placeholder="Name" value="<?//php echo $biochemical->name ?>">    
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="age" class="col-xs-3 col-form-label">Age</label>
                    <div class="col-xs-9">
                    <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="Age" value="<?//php echo $biochemical->age ?>">    
                    </div>
                    </div> 
                    <div class="form-group row">
                    <label for="address" class="col-xs-3 col-form-label">Address</label>
                    <div class="col-xs-9">
                    <input name="address" autocomplete="off" type="text" class="form-control" id="address" placeholder="Address" value="<?//php echo $biochemical->age ?>">    
                    </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                     <label for="date" class="col-xs-3 col-form-label">Date</label>
                     <div class="col-xs-9">
                        <input name="create_date" autocomplete="off" type="text" class="datepicker form-control" id="create_date" placeholder="Date" value="<?php echo date('Y-m-d');?>">    
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="sex" class="col-xs-3 col-form-label">Sex</label>
                     <div class="col-xs-9">
                        <input name="sex" autocomplete="off" type="text" class="form-control" id="sex" placeholder="Sex" value="<?//php echo $biochemical->sex ?>">    
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="dignosis" class="col-xs-3 col-form-label">Dignosis</label>
                     <div class="col-xs-9">
                        <input name="dignosis" autocomplete="off" type="text" class="form-control" id="dignosis" placeholder="Dignosis" value="<?//php echo $biochemical->date ?>">    
                        <input name="patient_auto_id" autocomplete="off" type="hidden" class="form-control" id="patient_auto_id" placeholder="patient_auto_id" >    
                        <input name="old_patient" autocomplete="off" type="hidden" class="form-control" id="old_patient" placeholder="old_patient" >    
                        <!--<input name="new_patient" autocomplete="off" type="hidden" class="form-control" id="new_patient" placeholder="new_patient" >    -->
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="weight" class="col-xs-3 col-form-label">Weight</label>
                     <div class="col-xs-9">
                        <input name="weight" autocomplete="off" type="text" class="form-control" id="weight" placeholder="Weight" value="<?//php echo $biochemical->doctor ?>">    
                     </div>
                  </div>
                  
                  
                </div>
                <div id="tests"></div>
                <div id="tests1"></div>
            </div>
            <button type="button" class="btn btn-primary" name="submit" id="submit">Save</button>
                <p id="save_success" class="save_success"></p>
                <p id="save_failed" class="save_failed"></p>
               
               <?//php echo form_close() ?> 



            </div>
        </div> 
    </div>
</div>
<div class="container">
      <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="">
      <!-- Modal content-->
      <div class="modal-content" style="width: 898px;">
          
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Investigation</h4>
        </div>
        <div class="modal-body">
         <form id="patient_investi">
             <div class="form-group">
                 <div>
                     <div>
                          <?php
                            if(function_exists('date_default_timezone_set')) {
                                
                                date_default_timezone_set("Asia/Kolkata");
                            }
                            $date = date("Y-m-d");
                            $date1 =  date("h:i a");
                           // echo $date . '<br/>';
                            //echo $date1;
                        ?>
                         
                         <input type="hidden" id="patient_id_final" name="patient_id_final">
                         <input type="hidden" id="name_final" name="name_final">
                         <input type="hidden" id="dignosis_final" name="dignosis_final">
                         <input type="hidden" id="section_final" name="section_final">
                         <input type="hidden" id="create_date_final" name="create_date_final">
                         <input type="hidden" id="time"  name="time" value="<?php echo $date1 =  date("h:i a"); ?>">
                        
                        
                         
                     </div>
                     <table class="table table-bordered">
                         <thead>
                             <tr>
                                 <th>Sr.No.</th>
                                 <th>Test Name</th>
                                 <th>Result</th>
                                 <th>Unit</th>
                                 <th>Reference Range</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                    <td id="srno"></td>
                                    <td id="testname"></td>
                                    <td id="result1"></td>
                                    <td id="unit"></td>
                                    <td id="test_type1">
                                    <p id="report_type"></p>
                                    <p id="report_section"></p>
                                    <p id="reference_range"></p>
                                    
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                     
                 </div>
             </div>
            <button type="button" class="btn btn-primary"  data-dismiss="modal" name="submit" id="submit">Save</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </form>
        </div>
      
      </div>
      
    </div>
  </div>
  
</div>
<script >
function form_submit()
{
document.getElementById("patient_investi").submit();
} 
</script>
<script>
$(document).ready(function() {
    $('body').on('keyup change', '#date', function() {
        var date = $('#date').val();
        var section = $('#section').val();
        $.ajax({

            url     : '<?php echo base_url('patients/fetch_patient_phisiotheropy') ?>',

            method  : 'post',

            dataType: 'json', 

            data    : {

                'create_date' : date,
                
                'section' : section,
                

                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'

            },
            success : function(data) {
                $('#patient_name').empty();
                if (data.status == true) { 
                    var newarray = data.patient_name;
                    for(var i=0;i<newarray.length;i++)
                    {
                        if(newarray[i])
                        {
                            if(newarray[i].yearly_reg_no)
                            {
                                var number = newarray[i].yearly_reg_no;
                            }
                            else
                            {
                                var number = newarray[i].old_reg_no;
                            }
                            $('#patient_name').append(
                                        '<option value="' + newarray[i].firstname + '" selected>' + newarray[i].firstname + '('+ number +')</option>'
                            );
                        }
                    }
                } else {
                    $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
    
    $('body').on('keyup change', '#patient_name', function() {
        
        var patient_name = $('#patient_name').val();
        var date = $('#date').val();
        var section = $('#section').val();

        $.ajax({

            url     : '<?php echo base_url('patients/fetch_treatment_phisiotheropy') ?>',

            method  : 'post',

            dataType: 'json', 

            data    : {
                'patient_name' : patient_name,
                'create_date' : date,
                'section' : section,
                
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success : function(data) {
                if (data.status == true) {
                   $('#tests').empty();
                    

                    $('#PHYSIOTHERAPY').val(data.PHYSIOTHERAPY);
                    
                    
                    $('#patient_auto_id').val(data.id);
                    $('#dignosis').val(data.dignosis);
                    
                    var newpatient = data.yearly_reg_no;
                    var oldpatient = data.old_reg_no;
                    
                    if(newpatient)
                    {
                        var number = newpatient;
                    }
                    else
                    {
                        var number = oldpatient;
                    }
               
                    $('#opd_no').val(number);
                    $('#firstname').val(data.firstname);
                    $('#age').val(data.date_of_birth);
                    $('#sex').val(data.sex);
                    $('#weight').val(data.weight);
                    $('#address').val(data.address);
                    $('#create_date').val(data.create_date);
                    
                    if(data.PHYSIOTHERAPY){
                     var PHYSIOTHERAPY = data.PHYSIOTHERAPY;
                    }
                    //var X_RAY = date.X_RAY;
                    
                    if(PHYSIOTHERAPY){
                    $('#tests').append(
                                         '<input type="test" name="PHYSIOTHERAPY_final" id="PHYSIOTHERAPY_final" readonly="readonly" value="' + PHYSIOTHERAPY + '"><br><br>'
                            );
                    }
                    if(PHYSIOTHERAPY){
                    $('#tests').append(
                                        //  '<input type="text" name="xray_result" id="xray_result"><br>'
                                         '<textarea id="PHYSIOTHERAPY_result" placeholder="Add Result" name="PHYSIOTHERAPY_result" rows="4" cols="50">'
                            );
                    }
                      
                       
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
$(document).ready(function() {
      $('body').on('keyup change', '#test_type', function() {
        if ($("input[name='test_type']:checked").val()) {
                $('#myModal').modal('show');
            } 
         var test_type =[];
        $("input[name='test_type']:checked").val(function(){
            test_type.push(this.value);
        });
        
        
        var section = $('#section').val();
        var name = $('#patient_name').val();
        var patient_auto_id = $('#patient_auto_id').val();
        var dignosis = $('#dignosis').val();
        var opd_number = $('#opd_no').val();
        var create_date = $('#create_date').val();
        
        $.ajax({

            url     : '<?php echo base_url('patients/fetch_patient_investi_hm') ?>',

            method  : 'post',

            dataType: 'json', 

            data    : {

                'test_type' : test_type,
                'section' : section,
                'name' : name,
                'patient_auto_id' : patient_auto_id,
                'dignosis' : dignosis,
                'new_patient' : opd_number,
                'create_date' : create_date,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'

            },
            success : function(data) {
                if (data.status == true) { 
                    $('#srno').empty();
                    $('#testname').empty();
                    $('#result1').empty();
                    $('#unit').empty();
                    $('#reference_range').empty();
                    $('#report_type').empty();
                    $('#report_section').empty();
                    $('#test_type').empty();
                    
                    var newarray = data.patient_investi;
                    var a=1;
                for(var i=0;i<newarray.length;i++)
                {
                   var html = "<p>"+ a +"</p>";
                    $('#srno').append(html);
                   a++;
                }
                for(var j=0;j<newarray.length;j++)
                {
                   var html = "<input type='text' name='testname' style='margin-top: 3px;' id='testname' readonly='readonly' value="+ newarray[j].test_name +">";
                    $('#testname').append(html);
                }
                for(var k=0;k<newarray.length;k++)
                {
                  var html = "<input type='text' style='margin-top: 3px;' class='someclass' placeholder='Result'  name='result' id='result' required='required' />";
                    $('#result1').append(html);
                }
                for(var l=0;l<newarray.length;l++)
                {
                   var html = "<input type='text' style='margin-top: 3px;' name='unit' id='unit' readonly='readonly' value="+ newarray[l].unit +">";
                    $('#unit').append(html);
                }
                for(var m=0;m<newarray.length;m++)
                {
                   var html = "<input type='text' style='margin-top: 3px;' name='reference_range' id='reference_range' readonly='readonly' value='"+ newarray[m].min_range +' - '+ newarray[m].max_range +"'>";
                    $('#reference_range').append(html);
                }
                for(var x=0;x<newarray.length;x++)
                {
                   var html = "<input type='hidden' style='margin-top: 3px;' name='report_type' id='report_type' readonly='readonly' value="+ newarray[x].report_type +">";
                    $('#report_type').append(html);
                }
                for(var y=0;y<newarray.length;y++)
                {
                   var html = "<input type='hidden' style='margin-top: 3px;' name='report_section' id='report_section' readonly='readonly' value="+ newarray[y].report_section +">";
                    $('#report_section').append(html);
                }
                for(var p=0;p<newarray.length;p++)
                {
                   var html = "<input type='hidden' style='margin-top: 3px;' name='test_type1' id='test_type1' readonly='readonly' value="+ newarray[p].test_type +">";
                    $('#test_type1').append(html);
                }
                    $('#patient_id_final').val(data.patient_auto_id);
                    $('#name_final').val(data.name);
                    $('#dignosis_final').val(data.dignosis);
                    $('#section_final').val(data.section);
                    $('#create_date_final').val(data.create_date);
                } 
                else 
                {
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
$("#submit").click(function(){

        var section = $('#section').val();
        var name = $('#patient_name').val();
        var patient_auto_id = $('#patient_auto_id').val();
        var dignosis = $('#dignosis').val();
        var opd_number = $('#opd_no').val();
        var create_date = $('#create_date').val();
        
        
        var PHYSIOTHERAPY = $('#PHYSIOTHERAPY_final').val();
        var PHYSIOTHERAPY_result = $('#PHYSIOTHERAPY_result').val();
        
    
    
        
        $.ajax({

            url:'<?php echo base_url('patients/save_phisiotheropy_data') ?>',

            type:'post',

            dataType:'json', 

            data:{
                'section' : section,
                'name' : name,
                'patient_auto_id' : patient_auto_id,
                'dignosis' : dignosis,
                'create_date' : create_date,
                'PHYSIOTHERAPY' : PHYSIOTHERAPY,
                'PHYSIOTHERAPY_result' : PHYSIOTHERAPY_result,
                
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
              },
               success:function(data) {
                
                 console.log(data);
                if (data.status == true) { 
                    console.log(data);
                  alert('save Successfully!');
                } else {
                    alert('failed');
                }
            },
            error:function() {
                alert('failed!');
            } 
        });
})
   </script>
   <script>
  $( function() {
    $( "#create_date" ).datepicker();
  } );
</script>