<div class="row">
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
              
               
                    <div class="btn-group"> 
                        <a href="<?php
                         
                         $name = $haematology_pro[0]->firstname;
                         $date = $haematology_pro[0]->create_date;
                         
                         $dignosis = $haematology_pro[0]->dignosis;
                        
                        echo base_url("patients/hemeto_form/$patient_id/$section/$name/$date/$dignosis") ?>" class="btn btn-xs btn-success">ALL REPORT</a>
                    </div>
               <?php
               
                    if($section == 'ipd')
                    {
                        $patient_dignosis = $haematology_pro[0]->dignosis;
                        
                        $query = $this->db->select('*')
                        ->from('treatments1')
                        ->join('patient_ipd','patient_ipd.dignosis = treatments1.dignosis')
                        ->where('treatments1.dignosis',$patient_dignosis)
                        ->limit(1)
                        ->get()
                        ->result();
                        $count = $query->num_rows();
                    }
                    else
                    {
                        $patient_dignosis = $haematology_pro[0]->dignosis;
                        $query1 = $this->db->select('*')
                        ->from('treatments1')
                        //->join('investi_panch_opd_test_total_count','investi_panch_opd_test_total_count.dignosis = treatments1.dignosis')
                        ->where('treatments1.dignosis',$patient_dignosis)
                        ->limit(1)
                        ->get()
                        ->result();
                         $count = count($query1);
                    }
                        
            ?>

            <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php  echo base_url('patients/checkhemetoform'); ?>">
    
            <div class="panel-body">
                <div class="col-lg-12">
                    
                    <?php 
                    
                        for($i=0;$i<$count;$i++)
                        {
                            if($section=='opd')
                            {
                                //$this->db->where('HEMATOLOGICAL', $query1[$i]->HEMATOLOGICAL); 
                                $query2 = $this->db->get('treatments1');
                                $result = $query2->result();
                            }
                            else
                            {
                                //$this->db->where('HEMATOLOGICAL', $query1[$i]->HEMATOLOGICAL); 
                                $query2 = $this->db->get('treatments1');
                                $result = $query2->result();
                            }
                       
                    ?>
                    <?php 
                    $test_name_p = $result[0]->HEMATOLOGICAL;
                    $test = explode(",",$test_name_p);
                   // print_r($test);
                    $count_test = count($test);
                    for($j=0;$j<$count_test;$j++){
                    ?>
                        <div class="row">
                            <div class="col-md-1" style="text-align: end;">
                                <input type="checkbox" name="test_type" value="<?php $test_name = $test[$j]; echo $test_name; ?>">
                            </div>
                            <div class="col-md-11">
                                <h2><?php $test_name = $test[$j]; echo $test_name;"<br>"?> </h2>
                            </div>
                       </div>
                       
                   <?php } } ?> 
                   
                   <input type='hidden' name="section" value="<?php echo $section ;?>">
                   
                   <input type='hidden' name="id" value="<?php echo $patient_id ;?>">
                   
                   <input type='hidden' name="name" value="<?php echo $haematology_pro[0]->firstname;?>">
                   
                   <input type='hidden' name="date" value="<?php echo $haematology_pro[0]->create_date;?>">
                   
            </div>
            
            <button type="submit">Submit</button>
            
        </form>
            
            
            
            <?php
            
             
                if($section == 'ipd')
                {
                    $patient_id = $haematology_profile_ipd[0]->dignosis;
                    $query = $this->db->select('*')
                    ->from('treatments1')
                    ->join('patient_ipd','patient_ipd.dignosis = treatments1.dignosis')
                    ->where('treatments1.dignosis',$patient_id)
                    ->limit(1)
                    ->get()
                    ->result();
                    $test_n = $query1[0]->HEMATOLOGICAL;
                    $test_c = explode(",",$test_n);
                     $count = count($test_c);
                }
                else
                {
                    $patient_id = $haematology_pro[0]->dignosis;
                    $query1 = $this->db->select('*')
                    ->from('treatments1')
                    //->join('investi_panch_opd_test_total_count','investi_panch_opd_test_total_count.dignosis = treatments1.dignosis')
                    ->where('treatments1.dignosis',$patient_id)
                    ->limit(1)
                    ->get()
                    ->result();
                    
                     $test_n = $query1[0]->HEMATOLOGICAL;
                    $test_c = explode(",",$test_n);
                     $count = count($test_c);
                     //print_r($this->db->last_query());
                }
                   
            ?>



            <div class="panel-body">
                <div class="col-lg-12">
                    
                    <?php 
                        
                        for($i=0;$i<$count;$i++)
                        {
                            if($section=='opd')
                            {
                                $result = $this->db->select('DISTINCT(investigation_test_master.test_name),investigation_test_master.reference_range,investigation_test_master.report_type,investigation_test_master.unit')
                                ->from('investigation_test_master')
                                ->join('treatments1','treatments1.ipd_opd = investigation_test_master.ipd_opd')
                                ->where('treatments1.HEMATOLOGICAL LIKE', '%'.$test_c[$i].'%')
                                ->where('investigation_test_master.ipd_opd', 'opd')
                                ->where('investigation_test_master.report_type LIKE', '%'.$test_c[$i].'%')
                                ->get()
                                ->result();
                            }
                            else
                            {
                                $result = $this->db->select('DISTINCT(investigation_test_master.test_name),investigation_test_master.reference_range,investigation_test_master.report_type,investigation_test_master.unit')
                                ->from('investigation_test_master')
                                ->join('treatments1','treatments1.ipd_opd = investigation_test_master.ipd_opd')
                                ->where('treatments1.HEMATOLOGICAL LIKE', '%'.$test_c[$i].'%')
                                ->where('investigation_test_master.ipd_opd', 'opd')
                                ->where('investigation_test_master.report_type LIKE','%'.$test_c[$i].'%')
                                ->get()
                                ->result();
                            }
                           
                    ?>
                    
                    
                    <div class="row" <?php if($i<($count-1) || $i>0) { echo 'style="page-break-after: always; padding-bottom:10px;" '; } ?>>
                        <div style="border: 1px solid;">
                        
                        <div class="col-sm-12" align="center">  
                            <strong><?php echo $this->session->userdata('title') ?></strong>
                            <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                            <h1><?//php $test_name = $result[0]->test_type; echo $test_name.' '.'Examination Report';?> </h1>
                        <br>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 " style="border-bottom: 1px solid;margin-bottom: 20px;"> 
                            <div class="row">
                                <div class="col-xs-6"><strong>Patient Name:</strong> <strong><?php  echo $haematology_pro[0]->firstname; ?></strong></div>
                                <div class="col-xs-6"><strong> Date:</strong> <strong><?php echo date('d-m-Y',strtotime($haematology_pro[0]->create_date)); ?></strong></div>
                            </div>
                            <?php if($section == 'ipd'){ ?>
                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-xs-6"><strong>Gender:</strong> <?php if($haematology_pro[0]->sex == 'M'){ echo "Male"; } else{ echo"Female"; }?></strong></div>
                                <div class="col-xs-6"><strong>Age:</strong> <?php echo $haematology_pro[0]->date_of_birth; ?></strong></div>
                            </div>
                            <?php } else{ ?>
                             <div class="row" style="margin-bottom: 5px;">
                                <div class="col-xs-6"><strong>Gender:</strong> <?php if($haematology_pro[0]->sex == 'M'){ echo "Male"; } else{ echo"Female"; }?></strong></div>
                                <div class="col-xs-6"><strong>Age:</strong> <?php echo $haematology_pro[0]->date_of_birth; ?></strong></div>
                            </div>
                            <?php } ?>
                        </div>
                        
                        
                        <div class="col-md-12" style="border-bottom: 1px solid;">
                            
                            <div style="text-align:center;">
                                <h3> <?//php $name[$i] =  $result[0]->report_type; echo $name[$i].' '.'REPORT';?> </h3>
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
                                    <tr>
                                        <td><strong><?php echo $pp->test_name; ?></strong></td>
                                        <td><?//php echo $pp->result; ?></td>
                                        <td><?php echo $pp->unit; ?></td>
                                        <td><?php echo $pp->reference_range; ?></td>
                                    </tr>
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

