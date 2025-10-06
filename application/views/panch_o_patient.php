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
                    <lable>SNEHAN</lable>
                    <input type="text" name="SNEHAN" id="SNEHAN" placeholder="SNEHAN" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <lable>SWEDAN</lable>
                    <input type="text" name="SWEDAN" id="SWEDAN" placeholder="SWEDAN" class="form-control" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <lable>VAMAN</lable>
                    <input type="text" name="VAMAN" id="VAMAN" placeholder="VAMAN" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <lable>VIRECHAN</lable>
                    <input type="text" name="VIRECHAN" id="VIRECHAN" placeholder="VIRECHAN" class="form-control" readonly>
                </div>
                
            </div>
            
            
            <div class="row">
                <div class="col-md-6">
                    <lable>BASTI</lable>
                    <input type="text" name="BASTI" id="BASTI" placeholder="BASTI" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <lable>NASYA</lable>
                    <input type="text" name="NASYA" id="NASYA" placeholder="NASYA" class="form-control" readonly>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <lable>RAKTAMOKSHAN</lable>
                    <input type="text" name="RAKTAMOKSHAN" id="RAKTAMOKSHAN" placeholder="RAKTAMOKSHAN" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <lable>SHIRODHARA_SHIROBASTI</lable>
                    <input type="text" name="SHIRODHARA_SHIROBASTI" id="SHIRODHARA_SHIROBASTI" placeholder="SHIRODHARA_SHIROBASTI" class="form-control" readonly>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <lable>YONIDHAVAN</lable>
                    <input type="text" name="YONIDHAVAN" id="YONIDHAVAN" placeholder="YONIDHAVAN" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <lable>YONIPICHU</lable>
                    <input type="text" name="YONIPICHU" id="YONIPICHU" placeholder="YONIPICHU" class="form-control" readonly>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <lable>UTTARBASTI</lable>
                    <input type="text" name="UTTARBASTI" id="UTTARBASTI" placeholder="UTTARBASTI" class="form-control" readonly>
                </div>
                 <div class="col-md-6">
                    <lable>SHIROBASTI</lable>
                    <input type="text" name="SHIROBASTI" id="SHIROBASTI" placeholder="SHIROBASTI" class="form-control" readonly>
                </div>
            </div>
             <div class="row">
                <div class="col-md-6">
                    <lable>OTHER</lable>
                    <input type="text" name="OTHER" id="OTHER" placeholder="OTHER" class="form-control" readonly>
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

            url     : '<?php echo base_url('patients/fetch_patient_panch') ?>',

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

            url     : '<?php echo base_url('patients/fetch_treatment_panch') ?>',

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
                    $('#tests1').empty();
                    
                    if(data.SNEHAN){
                     var SNEHAN = data.SNEHAN;
                    }
                    
                    if(data.SWEDAN){
                     var SWEDAN = data.SWEDAN;
                    }
                    if(data.VAMAN){
                     var VAMAN = data.VAMAN;
                    }
                    if(data.VIRECHAN){
                     var VIRECHAN = data.VIRECHAN;
                    }
                    if(data.BASTI){
                     var BASTI = data.BASTI;
                    }
                    if(data.NASYA){
                     var NASYA = data.NASYA;
                    }
                    if(data.RAKTAMOKSHAN){
                     var RAKTAMOKSHAN = data.RAKTAMOKSHAN;
                    }
                    if(data.SHIRODHARA_SHIROBASTI){
                     var SHIRODHARA_SHIROBASTI = data.SHIRODHARA_SHIROBASTI;
                    }
                    if(data.YONIDHAVAN){
                     var YONIDHAVAN = data.YONIDHAVAN;
                    }
                    if(data.YONIPICHU){
                     var YONIPICHU = data.YONIPICHU;
                    }
                    if(data.UTTARBASTI){
                     var UTTARBASTI = data.UTTARBASTI;
                    }
                    if(data.SHIROBASTI){
                     var SHIROBASTI = data.SHIROBASTI;
                    }
                    if(data.OTHER){
                     var OTHER = data.OTHER;
                    }
                    

                    $('#SNEHAN').val(data.SNEHAN);
                    $('#SWEDAN').val(data.SWEDAN);
                    $('#VAMAN').val(data.VAMAN);
                    $('#VIRECHAN').val(data.VIRECHAN);
                    $('#BASTI').val(data.BASTI);
                    $('#NASYA').val(data.NASYA);
                    $('#RAKTAMOKSHAN').val(data.RAKTAMOKSHAN);
                    $('#SHIRODHARA_SHIROBASTI').val(data.SHIRODHARA_SHIROBASTI);
                    $('#YONIDHAVAN').val(data.YONIDHAVAN);
                    $('#YONIPICHU').val(data.YONIPICHU);
                    $('#UTTARBASTI').val(data.UTTARBASTI);
                    $('#SHIROBASTI').val(data.SHIROBASTI);
                    $('#OTHER').val(data.OTHER);
                    
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
                    
                    if(SNEHAN){
                    $('#tests').append(
                                         '<input type="checkbox" name="SNEHAN_final" id="SNEHAN_final" value="' + SNEHAN + '">'+ SNEHAN +'<br>'
                            );
                    }
                    if(SWEDAN){
                    $('#tests').append(
                                         '<input type="checkbox" name="SWEDAN_final" id="SWEDAN_final" value="' + SWEDAN + '">'+ SWEDAN +'<br>'
                            );
                    }
                    if(VIRECHAN){
                    $('#tests').append(
                                         '<input type="checkbox" name="VIRECHAN_final" id="VIRECHAN_final" value="' + VIRECHAN + '">'+ VIRECHAN +'<br>'
                            );
                    }
                    if(BASTI){
                    $('#tests').append(
                                         '<input type="checkbox" name="BASTI_final" id="BASTI_final" value="' + BASTI + '">'+ BASTI +'<br>'
                            );
                    }
                    if(NASYA){
                    $('#tests').append(
                                         '<input type="checkbox" name="NASYA_final" id="NASYA_final" value="' + NASYA + '">'+ NASYA +'<br>'
                            );
                    }
                    if(RAKTAMOKSHAN){
                    $('#tests').append(
                                         '<input type="checkbox" name="RAKTAMOKSHAN_final" id="RAKTAMOKSHAN_final" value="' + RAKTAMOKSHAN + '">'+ RAKTAMOKSHAN +'<br>'
                            );
                    }
                    if(SHIRODHARA_SHIROBASTI){
                    $('#tests').append(
                                         '<input type="checkbox" name="SHIRODHARA_SHIROBASTI_final" id="SHIRODHARA_SHIROBASTI_final" value="' + SHIRODHARA_SHIROBASTI + '">'+ SHIRODHARA_SHIROBASTI +'<br>'
                            );
                    }
                    if(VAMAN){
                    $('#tests').append(
                                         '<input type="checkbox" name="VAMAN_final" id="VAMAN_final" value="' + VAMAN + '">'+ VAMAN +'<br>'
                            );
                    }
                    if(YONIDHAVAN){
                    $('#tests').append(
                                         '<input type="checkbox" name="YONIDHAVAN_final" id="YONIDHAVAN_final" value="' + YONIDHAVAN + '">'+ YONIDHAVAN +'<br>'
                            );
                    }
                    if(YONIPICHU){
                    $('#tests').append(
                                         '<input type="checkbox" name="YONIPICHU_final" id="YONIPICHU_final" value="' + YONIPICHU + '">'+ YONIPICHU +'<br>'
                            );
                    }
                    if(UTTARBASTI){
                    $('#tests').append(
                                         '<input type="checkbox" name="UTTARBASTI_final" id="UTTARBASTI_final" value="' + UTTARBASTI + '">'+ UTTARBASTI +'<br>'
                            );
                    }
                    
                    if(SHIROBASTI){
                    $('#tests').append(
                                         '<input type="checkbox" name="SHIROBASTI_final" id="SHIROBASTI_final" value="' + SHIROBASTI + '">'+ SHIROBASTI +'<br>'
                            );
                    }
                    
                    if(OTHER){
                    $('#tests').append(
                                         '<input type="checkbox" name="OTHER_final" id="OTHER_final" value="' + OTHER + '">'+ OTHER +'<br>'
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
        
        
        if ($('#SNEHAN_final').is(":checked"))
            {var SNEHAN = $('#SNEHAN_final').val();}
            if ($('#SWEDAN_final').is(":checked"))
            {var SWEDAN = $('#SWEDAN_final').val();}
             if ($('#VAMAN_final').is(":checked"))
            {var VAMAN = $('#VAMAN_final').val();}
            if ($('#VIRECHAN_final').is(":checked"))
            {var VIRECHAN = $('#VIRECHAN_final').val();}
            if ($('#BASTI_final').is(":checked"))
            {var BASTI = $('#BASTI_final').val();}
            if ($('#NASYA_final').is(":checked"))
            {var NASYA = $('#NASYA_final').val();}
            if ($('#RAKTAMOKSHAN_final').is(":checked"))
            {var RAKTAMOKSHAN = $('#RAKTAMOKSHAN_final').val();}
            if ($('#SHIRODHARA_SHIROBASTI_final').is(":checked"))
            {var SHIRODHARA_SHIROBASTI = $('#SHIRODHARA_SHIROBASTI_final').val();}
            if ($('#YONIDHAVAN_final').is(":checked"))
            {var YONIDHAVAN = $('#YONIDHAVAN_final').val();}
            if ($('#YONIPICHU_final').is(":checked"))
            {var YONIPICHU = $('#YONIPICHU_final').val();}
            if ($('#UTTARBASTI_final').is(":checked"))
            {var UTTARBASTI = $('#UTTARBASTI_final').val();}
            if ($('#SHIROBASTI_final').is(":checked"))
            {var SHIROBASTI = $('#SHIROBASTI_final').val();}
            if ($('#OTHER_final').is(":checked"))
            {var OTHER = $('#OTHER_final').val();}
        
        $.ajax({

            url:'<?php echo base_url('patients/save_panch_data') ?>',

            type:'post',

            dataType:'json', 

            data:{
                'section' : section,
                'name' : name,
                'patient_auto_id' : patient_auto_id,
                'dignosis' : dignosis,
                'create_date' : create_date,
                'SNEHAN' : SNEHAN,
                'SWEDAN' : SWEDAN,
                'VAMAN' : VAMAN,
                'VIRECHAN' : VIRECHAN,
                'BASTI' : BASTI,
                'NASYA' : NASYA,
                'RAKTAMOKSHAN' : RAKTAMOKSHAN,
                'SHIRODHARA_SHIROBASTI' : SHIRODHARA_SHIROBASTI,
                'YONIDHAVAN' : YONIDHAVAN,
                'YONIPICHU' : YONIPICHU,
                'UTTARBASTI' : UTTARBASTI,
                'SHIROBASTI' : SHIROBASTI,
                'OTHER' : OTHER,
               
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