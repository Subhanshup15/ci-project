<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_investigation_patient'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  

<!--<div class="form-group">-->

<!--    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>-->

<!--    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">-->
  
<!--</div>  -->


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
    </select>
   <!-- <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>-->
</div>



<button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>



</form>
</div>
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">

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


            <div class="panel-body" style="font-size: 11px;">
            
	          	 <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
 
 
                    <?php if($section == 'opd') {?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">OPD Investigation Patient List</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>     
                    <?php } else {?>
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">IPD Investigation Patient List</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>
                    <?php } ?>
                        
                         
                         
                          
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table  width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" >
                    <thead >
                        <tr>
                            <th rowspan="2">Sr. No</th>
                            <th colspan="2">COPD No.</th>
                            <th rowspan="2">Name</th>
                            <!--<th rowspan="2">Age</th>
                            <th rowspan="2">Sex</th>-->
                            <th rowspan="2">Dignosis</th>
                            <!--<th rowspan="2">Date</th>-->
                            <th rowspan="2">HEMATOLOGICAL</th>
                            <th rowspan="2">SEROLOGYCAL</th>
                            <th rowspan="2">BIOCHEMICAL</th>
                            <th rowspan="2">MICROBIOLOGICAL</th>
                          </tr>
                          <tr>
                              <th>new</th>
                              <th>old</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $k = 1;
                        foreach($patients as $patient){
                            //echo 'hiiii';
                            //echo $section;
                            if($section == 'ipd')
                                            {
                                                $che=trim($patient->dignosis);////kusta-KCI
                                                $section_tret='ipd';
                                                $len=strlen($che);//9
                                                $dd= substr($che,$len - 1);
                                                print_r($che);
                                                $str = $patient->dignosis;
                                                $arry=explode("-",$str);
                                                $t_c=count($arry);
                                                if($t_c=='2'){
                                                    $dd1=substr($che, 0, -1);
                                                    $new_str = trim($arry[0]);
                                                    $p_dignosis = '%'.$new_str.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }else{
                                                    $p_dignosis = '%'.$che.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }
                                            }
                                        else
                                            {
                                                $section_tret='opd';
                                                $che=trim($patient->dignosis);
                                                $section_tret='opd';
                                                $len=strlen($che);
                                                $dd= substr($che,$len - 1);
                                                $str = $patient->dignosis;
                                                $arry=explode("-",$str);
                                                $t_c=count($arry);
                                                if($t_c=='2'){
                                                    $dd1=substr($che, 0, -1);
                                                    $new_str = trim($arry[0]);
                                                    $p_dignosis = '%'.$new_str.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }else{
                                                    $p_dignosis = '%'.$che.'%';
                                                    $p_dignosis_name=$patient->dignosis;
                                                }
                                            }
                                    
                                    
                                    
                                 if($patient->manual_status==0){
                                      if($patient->proxy_id){
			                          
			                         
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                     ->where('proxy_id',$patient->proxy_id)
                                     ->where('department_id',$patient->department_id)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                      }
                                      else{
                                          
                                       $tretment=$this->db->select("*")

			                         ->from('treatments1')
                                     ->where('dignosis LIKE',$p_dignosis)
                                      ->where('department_id',$patient->department_id)
                                     ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();  
                                      }
                                  }else{
                                      $tretment=$this->db->select("*")
                                      ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                            $HEMATOLOGICAL = $tretment->HEMATOLOGICAL;
                            $SEROLOGYCAL = $tretment->SEROLOGYCAL;
                            $BIOCHEMICAL = $tretment->BIOCHEMICAL;
                            $MICROBIOLOGICAL= $tretment->MICROBIOLOGICAL;
                        ?>
                        <?php if($HEMATOLOGICAL || $SEROLOGYCAL || $BIOCHEMICAL || $MICROBIOLOGICAL) { ?>
                            <input type="hidden" id="section" name="section[]" value="<?php echo $section; ?>" >
                            <input type="hidden" id="patient_auto_id" name="patient_auto_id[]" value="<?php echo $patient->id; ?>" >
                            <input type="hidden" id="new_patient" name="new_patient[]" value="<?php echo $patient->yearly_reg_no; ?>" >
                            <input type="hidden" id="old_patient" name="old_patient[]" value="<?php echo $patient->old_reg_no; ?>" >
                            <input type="hidden" id="name" name="name[]" value="<?php echo $patient->firstname; ?>" >
                            <input type="hidden" id="dignosis" name="dignosis[]" value="<?php echo $patient->dignosis; ?>" >
                            <input type="hidden" id="create_date" name="create_date[]" value="<?php echo date("d-m-Y",strtotime($patient->create_date)); ?>">

                        <tr>
                            <?//php echo form_open_multipart('Patients/insert_panch_patient','class="form-inner"') ?>
                            <!--<form action="<?//php echo base_url('patients/insert_panch_patient'); ?>" method="post" enctype="multipart/form-data">-->
                            <td><?php echo $k++; ?></td>
                            <td>
                               
                                <?php echo $patient->yearly_reg_no; ?></td>
                            <td>
                                
                                <?php echo $patient->old_reg_no; ?></td>
                            <td>
                                
                                <?php echo $patient->firstname; ?></td>
                            <!--<td>
                                <input type="text" name="age[]" value="<?//php echo $patient->date_of_birth; ?>" hidden>
                                <?//php echo $patient->date_of_birth; ?></td>
                            <td>
                                <input type="text" name="sex[]" value="<?//php echo $patient->sex; ?>" hidden>
                                <?//php echo $patient->sex; ?></td>-->
                            <td>
                                
                                <?php echo $patient->dignosis; ?></td>
                                <?//php echo date("d-m-Y",strtotime($patient->create_date)); ?>
                                <td>
                                                                    <input type="hidden" name="section" id="section" value="<?php echo $section; ?>">

                                <?php if($HEMATOLOGICAL !=''){
                                $hm = $HEMATOLOGICAL;    
                                $h_array = explode(",",$hm);
                                $h_count = count($h_array);
                                for($i=0;$i<$h_count;$i++){
                                ?>
                                <input type="checkbox" id="report_type" name="hematology" value="<?php echo $h_array[$i]; ?>">&nbsp;<?php echo $h_array[$i]; ?><br>
                                <?php }} ?>
                                </td>
                                <td>
                                <?php if($SEROLOGYCAL !=''){ 
                                $se = $SEROLOGYCAL;    
                                $s_array = explode(",",$se);
                                $s_count = count($s_array);
                                for($i=0;$i<$s_count;$i++){
                                
                                ?>
                                <input type="checkbox" id="report_type" name="serology[]" value="<?php echo $s_array[$i]; ?>">&nbsp;<?php echo $s_array[$i]; ?><br>
                                
                                <?php }} ?>
                                </td>
                            <td>
                                <?php if($BIOCHEMICAL !=''){ 
                                $bi = $BIOCHEMICAL;    
                                $b_array = explode(",",$bi);
                                $b_count = count($b_array);
                                for($i=0;$i<$b_count;$i++){
                                ?>
                                <input type="checkbox" id="report_type" name="biochemical[]" value="<?php echo $b_array[$i]; ?>">&nbsp;<?php echo $b_array[$i]; ?><br>
                                <?php }} ?>
                                </td>
                            <td>
                                <?php if($MICROBIOLOGICAL !=''){ 
                                $mi = $MICROBIOLOGICAL;    
                                $m_array = explode(",",$mi);
                                $m_count = count($m_array);
                                for($i=0;$i<$m_count;$i++){
                                ?>
                                <input type="checkbox" id="report_type" name="microbiology[]" value="<?php echo $m_array[$i]; ?>">&nbsp;<?php echo $m_array[$i]; ?><br>
                                <?php } } ?>
                                </td>
                        </tr>
                        <?php } ?>
                        <?php } $i++; ?>
                    </tbody>
                </table>
                </div>
                
                          <div class="form-group row">
                    <div class="col-sm-offset-5 col-sm-6">
                        <div class="ui buttons">
                            <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                            <div class="or"></div>
                            <button class="ui positive button"><?php echo display('save') ?></button>
                        </div>
                    </div>
                </div>
                <!--</form>-->
                <?//php echo form_close() ?> 
       
            </div>
        </div>
    </div>
</div>
<div class="container">
  <!--<h2>Modal Example</h2>-->
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
         <form>
             <div class="form-group">
                 <div
             </div>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</div>
</div>
<script>
$(document).ready(function() {
     $('body').on('keyup change', '#report_type', function() {
    //  $('#report_type').click(function (){

       
        if ($('#report_type').is(':checked')) {
                $('#myModal').modal('show');
            }
      
            
        
        var section = $('#section').val();
        var section = $('#section').val();
        var name = $('#name').val();
        var patient_auto_id = $('#patient_auto_id').val();
        var dignosis = $('#dignosis').val();
        var old_patient = $('#old_patient').val();
        var new_patient = $('#new_patient').val();
        var create_date = $('#create_date').val();
        
        //  alert(report_type);
        //  alert(section);
        //  alert(name);
        //  alert(patient_auto_id);
        //  alert(dignosis);
        //  alert(old_patient);
        //  alert(new_patient);
        //  alert(create_date);


        $.ajax({

            url     : '<?php echo base_url('patients/fetch_patient_investi_hm') ?>',

            method  : 'post',

            dataType: 'json', 

            data    : {

                'report_type' : report_type,
                'section' : section,
                'name' : name,
                'patient_auto_id' : patient_auto_id,
                'dignosis' : dignosis,
                'old_patient' : old_patient,
                'new_patient' : new_patient,
                'create_date' : create_date,
                

                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'

            },
               // alert(hiii);
              //  console.log(section)
            success : function(data) {
                 console.log(data);
                 
                //  alert(data.patient_investi);
                //  alert(data.name);
                //  alert(data.patient_auto_id);
                // $('#patient_name').empty();
                // if (data.status == true) { 
                //     var newarray = data.patient_name;
                //     for(var i=0;i<newarray.length;i++)
                //     {
                //         if(newarray[i])
                //         {
                //             if(newarray[i].yearly_reg_no)
                //             {
                //                 var number = newarray[i].yearly_reg_no;
                //             }
                //             else
                //             {
                //                 var number = newarray[i].old_reg_no;
                //             }
                //             $('#patient_name').append(
                //                         '<option value="' + newarray[i].firstname + '" selected>' + newarray[i].firstname + '('+ number +')</option>'
                //             );
                //         }
                //     }
                // } else {
                //     $(".invlid_patient_id").text('<?php echo display("invalid_patient_id") ?>');
                // }
            },
            error   : function() {
                alert('failed!');
            } 
        });
    });
})
</script>
