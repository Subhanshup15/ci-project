<div class="row">
   <!--  form area -->
   <div class="col-sm-12">
      <div  class="panel panel-default thumbnail">
         <div class="panel-heading no-print">
            <div class="btn-group"> 
            
            </div>
         </div>
         <div class="panel-body panel-form">
             <?php 
             if($section == 'ipd'){
                    $patient_auto_id = $haematology_report_ipd[0]->patient_auto_id;
                $this->db->distinct();
                $this->db->select('report_type');
                $this->db->where('patient_auto_id', $patient_auto_id); 
                $query = $this->db->get('investi_ipd_report_result');
                $query1 = $query->result();
                $count = $query->num_rows();
                // print_r($query);
               }else {
                 $patient_auto_id = $haematology_report_opd[0]->patient_auto_id;
                $this->db->distinct();
                $this->db->select('report_type');
                $this->db->where('patient_auto_id', $patient_auto_id); 
                $query = $this->db->get('investi_opd_report_result');
                $query1 = $query->result();
                $count = $query->num_rows();
                //print_r($query);
               }
             ?>
            <!-- <div class="col-lg-12">
               
            <div class="row">
            <div class="col-sm-3">
                <input name="opd_no" autocomplete="off" type="text" class="form-control" id="opd_no" placeholder="opd_no" value="<?//php echo $lab->opd_no ?>">    
            </div>
            <div class="col-sm-3">
                <input name="name" autocomplete="off" type="text" class="form-control" id="name" placeholder="name" value="<?//php echo $lab->opd_no ?>">
            </div>
            <div class="col-sm-3">
                <input name="sex" autocomplete="off" type="text" class="form-control" id="sex" placeholder="sex" value="<?//php echo $lab->opd_no ?>">
            </div>
            <div class="col-sm-3">
                <input name="age" autocomplete="off" type="text" class="form-control" id="age" placeholder="age" value="<?//php echo $lab->opd_no ?>">
            </div>
            </div>
            </div>-->
            <?php echo form_open_multipart('Patients/update_patient_report','class="form-inner"') ?>
            <?//php echo form_hidden('id',$lab->id); ?> 
                    <?php for($i=0;$i<$count;$i++){
                        if($section=='opd'){
                        $this->db->where('patient_auto_id', $patient_auto_id); 
                        $this->db->where('report_type', $query1[$i]->report_type); 
                        $query2 = $this->db->get('investi_opd_report_result');
                        $result = $query2->result();
                        }else{
                         $this->db->where('patient_auto_id', $patient_auto_id); 
                        $this->db->where('report_type', $query1[$i]->report_type); 
                        $query2 = $this->db->get('investi_ipd_report_result');
                        $result = $query2->result();}
                       // print_r($result);
                    ?>
                    <div class="col-sm-12" align="center">  
                            <strong><?php echo $this->session->userdata('title') ?></strong>
                            <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                            <h1> <?php $test_name = $result[0]->test_type; echo $test_name.' '.'Examination Report';?> </h1>
                          
                        <br>
                        </div>
                  <div class="col-lg-12" style="margin-top:20px;">
                       <div style="text-align:center;">
                                <h3> <?php $name =  $result[0]->report_section; echo $name.' '.'REPORT';?> </h3>
                            </div>
                      <table  class="table table-bordered table-hover table-striped">
                          <thead>
                              <tr>
                                  <th>TEST</th>
                                  <th>RESULT</th>
                                  <th>UNIT</th>
                                  <th>NORMAL VALUE</th>
                              </tr>
                          </thead>
                          <tbody>
                        
                    <?php foreach($result as $report) { ?>
                              <tr>
                                  <td><?php echo $report->test_name; ?></td>
                                  <td><input name="result" autocomplete="off" type="text" class="form-control" id="result" placeholder="" value="<?php echo $report->result; ?>"></td>
                                  <td><input name="unit" autocomplete="off" type="text" class="form-control" id="unit" placeholder="" value="<?php echo $report->unit; ?>" readonly></td>
                                  <td><input name="normal_value" autocomplete="off" type="text" class="form-control" id="normal_value" placeholder="" value="<?php echo $report->reference_range; ?>" readonly></td>
                              </tr>
                              <?php } ?>
                              
                          </tbody>
                      </table>
                  </div>
                  <div class="form-group row">
                  <div class="col-sm-12" style="text-align: center;">
                     <div class="ui buttons">
                        <button type="reset" class="ui button"><?php echo display('reset') ?></button>
                        <div class="or"></div>
                        <button class="ui positive button"><?php echo display('save') ?></button>
                     </div>
                  </div>
               </div>
               <hr>
                <?php } ?>
            
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

           url  : '<?= base_url('patient/check_patient/') ?>',

           type : 'post',

           dataType : 'JSON',

           data : {

               '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>',

               old_reg_no : pid.val()

           },

           success : function(data) 

           {

               if (data.status == true) {
                 //$('#yearly_reg_no').val(data.patient.yearly_reg_no);
                 //$('#yearly_no').val(data.patient.yearly_no);
                 
                 

                   $('#name').val(data.patient.firstname);
              $('#age').val(data.patient.date_of_birth);
              $('#sex').val(data.patient.sex);
              
                   $('#create_date').val(data.patient.create_date);

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

})

   </script>