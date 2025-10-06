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
                    
                    if($section == 'ipd')
                    {
                        $dignosis = $haematology_profile_ipd[0]->dignosis;
                        $query = 
                        $query = $this->db->select('HEMATOLOGICAL')
                        ->from('treatments1')
                        ->join('patient_ipd','patient_ipd.dignosis = treatments1.dignosis')
                        ->where('treatments1.dignosis',$dignosis)
                        ->limit(1)
                        ->get()
                        ->result();
                        $count = $query->num_rows();
                    }
                    else
                    {
                        $dignosis = $haematology_profile_opd[0]->dignosis;
                        $query1 = $this->db->select('HEMATOLOGICAL')
                        ->from('treatments1')
                        ->join('patient','patient.dignosis = treatments1.dignosis')
                        ->where('treatments1.dignosis',$dignosis)
                        ->limit(1)
                        ->get()
                        ->result();
                        //print_r($this->db->last_query());
                        $count = count($query1);
                    }
             ?>
            
            <?php echo form_open_multipart('Patients/insert_hemeto_patient','class="form-inner"') ?>
            <?//php echo form_hidden('id',$lab->id); ?> 
                   
                    <?php 
                
                        for($i=0;$i<$count;$i++)
                        {
                            if($section=='opd')
                            {
                                $result = $this->db->select('DISTINCT(investigation_test_master.test_name),investigation_test_master.reference_range,investigation_test_master.report_type,investigation_test_master.unit,investigation_test_master.test_type,investigation_test_master.report_section')
                                ->from('investigation_test_master')
                                ->join('treatments1','treatments1.ipd_opd = investigation_test_master.ipd_opd')
                                ->where('treatments1.HEMATOLOGICAL LIKE', '%'.$test_type.'%')
                                ->where('investigation_test_master.ipd_opd', 'opd')
                                ->where('investigation_test_master.report_type', $test_type)
                                ->get()
                                ->result();
                               // print_r($this->db->last_query());
                            }
                            else
                            {
                                $result = $this->db->select('DISTINCT(investigation_test_master.test_name),investigation_test_master.reference_range,investigation_test_master.report_type,investigation_test_master.unit,investigation_test_master.test_type,investigation_test_master.report_section')
                                ->from('investigation_test_master')
                                ->join('treatments1','treatments1.ipd_opd = investigation_test_master.ipd_opd')
                                ->where('treatments1.HEMATOLOGICAL', '%'.$test_type.'%')
                                ->where('investigation_test_master.ipd_opd', 'ipd')
                                ->where('investigation_test_master.report_type', $test_type)
                                ->get()
                                ->result();
                            }
                           
                    ?>
                    
                    <div class="col-sm-12" align="center">  
                            <strong><?php echo $this->session->userdata('title') ?></strong>
                            <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                            <h1> <?//php $test_name = $result[0]->HEMATOLOGICAL; echo $test_name.' '.'Examination Report';?> </h1>
                          
                        <br>
                        </div>
                  <div class="col-lg-12" style="margin-top:20px;">
                       <div style="text-align:center;">
                                <h3> <?//php $name =  $result[0]->report_section; echo $name.' '.'REPORT';?> </h3>
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
                            <?php
                           // $i=1;
                            foreach($result as $profile => $pp) { ?>  
                    
                              <tr>
                            <td><input name="test_name[]" type="text"  class="form-control" id="test_name" value="<?php echo $pp->test_name; ?>" readonly></td>
                            <td><input name="result[]" autocomplete="off" type="text" class="form-control" id="result" placeholder="" value=""></td>
                            <td><input name="unit[]" autocomplete="off" type="text" class="form-control" id="unit" placeholder="" value="<?php echo $pp->unit; ?>" readonly></td>
                            <td><input name="normal_value[]" autocomplete="off" type="text" class="form-control" id="normal_value" placeholder="" value="<?php echo $pp->reference_range; ?>" readonly>
                                <input name="section[]" autocomplete="off" type="hidden" class="form-control" id="section" placeholder="" value="<?php echo $section; ?>" readonly>
                                <input name="dignosis[]" autocomplete="off" type="hidden" class="form-control" id="dignosis" placeholder="" value="<?php echo $dignosis; ?>" readonly>
                                <input name="patient_auto_id[]" autocomplete="off" type="hidden" class="form-control" id="patient_auto_id" placeholder="" value="<?php echo $patient_id; ?>" readonly>
                                <input name="report_type[]" autocomplete="off" type="hidden" class="form-control" id="report_type" placeholder="" value="<?php echo $test_type; ?>" readonly>
                                <input name="name[]" autocomplete="off" type="hidden" class="form-control" id="name" placeholder="" value="<?php echo $name; ?>" readonly>
                                <input name="test_type[]" type="hidden" class="form-control" id="test_type" value="<?php echo $pp->test_type; ?>" readonly>
                                <input name="report_section[]" type="hidden"  class="form-control" id="report_section" value="<?php echo $pp->report_section; ?>" readonly>
                                <input name="date[]" type="hidden"  class="form-control" id="date" value="<?php  echo $date; ?>" readonly>
                                  <?//php echo $i++;?>
                                  </td>
                              </tr>
                              
                              <?php }
                             
                              ?>
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