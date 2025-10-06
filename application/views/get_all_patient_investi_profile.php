<div class="row">
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 
            <?php
            
           
           // print_r($haematology_profile_opd);
               if($section == 'ipd'){
                 $patient_auto_id = $get_all_patient_investi_profile->patient_auto_id;
                 $this->db->distinct();
                 $this->db->select('report_type');
                 $this->db->where('patient_auto_id', $patient_auto_id); 
                 $query = $this->db->get('investi_ipd_report_result');
                 $query1 = $query->result();
                 $count = $query->num_rows();
                // print_r($query);
               }else {
                 
                 $patient_auto_id = $get_all_patient_investi_profile->patient_auto_id;
                 $this->db->distinct();
                 $this->db->select('report_type');
                 $this->db->where('patient_auto_id', $patient_auto_id); 
                 $query = $this->db->get('investi_opd_report_result');
                 $query1 = $query->result();
                 // print_r($this->db->last_query());
                 $count = $query->num_rows();
                 
                 
                //print_r($query);
               }
                //print_r($this->db->last_query());..
          if($section == 'ipd')
          {
            $table = 'patient_ipd';
          }
          else
          {
            $table = 'patient';
          }
          	$opd_number = $this->db->select('*')->from($table)->where('id',$patient_auto_id)->get()->row();
          
            ?>

            <div class="panel-body">
                <div class="col-lg-12">
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
                    
                    <div class="row" <?php if($i<($count-1) || $i>0) { echo 'style="page-break-after: always; padding-bottom:10px;" '; } ?>>
                        <div style="border: 1px solid;">
                        <div class="col-sm-12" align="center" style="margin-top: 7px;">  
                            <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
                            <h1> <?php $test_name = $result[0]->test_type; echo $test_name.' '.'Examination Report';?> </h1>
                          
                        <br>
                        </div>
                        <div class="col-md-12 col-lg-12 " style="border-bottom: 1px solid;margin-bottom: 20px;">
                          <div class="row">
                            	<div class="col-xs-6"><strong>COPD Number:</strong> <?php  echo ($opd_number->yearly_reg_no)?$opd_number->yearly_reg_no:$opd_number->old_reg_no; ?></div>
                          </div>
                            <div class="row">
                                <div class="col-xs-6"><strong>Patient Name:</strong><?php  echo $opd_number->firstname; ?></div>
                                <div class="col-xs-6"><strong> Date:</strong> <strong><?php echo date('d-m-Y',strtotime($haematology_pro[0]->create_date)); ?></strong></div>
                            </div>
                            <?php if($section == 'ipd'){ ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-xs-6"><strong>Gender:</strong> <?php if($opd_number->sex == 'M'){ echo "Male"; } else{ echo"Female"; }?></strong></div>
                                <div class="col-xs-6"><strong>Age:</strong> <?php echo $opd_number->date_of_birth; ?></strong></div>
                            </div>
                            <?php } else{ ?>
                             <div class="row" style="margin-bottom: 5px;">
                                <div class="col-xs-6"><strong>Gender:</strong> <?php if($opd_number->sex == 'M'){ echo "Male"; } else{ echo"Female"; }?></strong></div>
                                <div class="col-xs-6"><strong>Age:</strong> <?php echo $opd_number->date_of_birth; ?></strong></div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-12" style="border-bottom: 1px solid;">
                            <div style="text-align:center;">
                                <!--<h3> <?php $name =  $result[0]->report_section; echo $name.' '.'REPORT';?> </h3>-->
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Test</th>
                                    <th>Result</th>
                                    <th>Unit</th>
                                    <th>Normal Value</th>
                                </thead>
                                <tbody>
                                    <?php foreach($result as $profile => $pp) { ?>
                                    <?//php if ($pp->report_type == 'CBC') {?> 
                                    <tr>
                                        <td><strong><?php echo $pp->test_name; ?></strong></td>
                                        <td><?php echo $pp->result; ?></td>
                                        <td><?php echo $pp->unit; ?></td>
                                        <td><?php echo $pp->reference_range; ?></td>
                                    </tr>
                                    <?//php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div style="text-align:center; border-bottom: 1px solid;margin-bottom: 20px;">
                            <b>------- End Report -------</b> 
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <b> Lab Assistant Signature</b>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <b> Doctor Signature</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                    <?php } ?>
                </div>
            </div> 
        </div>
    </div>
</div>

