<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('stock/new_despense_report_patientwise'); ?>">
            
            <div class="form-group" id="startDate">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>  

            <div class="form-group" id="section">
                <label class="sr-only" for="section"><?php echo display('section') ?></label>
                
                <select name="section" class="form-control" id="section">
                <option value="opd">OPD</option>
                <option value="ipd">IPD</option>
                </select>
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
            </div>
            <div class="panel-body">
                 <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
                    <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                </div> 
           
              
          <div class="row">
            
               <div class="col-sm-12" align="center">
                                
                                    <h3><strong><?php echo "Daily Stock Register"; ?></strong></h3>
                 
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo ($section == 'ipd')?'IPD':'OPD';  ?><?php echo " Despense Report"; ?></strong></h2>
                            </div>
            <table class="table table-bordered table-striped table-hover">
             
                <tr>
                  <th>Sr.No</th>
                  <th>Patient Name</th>
                  <th>OPD No.</th>
                  <th>Department</th>
                  <th>Dignosis</th>
                  <th>Name of Drugs</th>
                  <th>Total Despense</th>
                </tr>
            
                  <?php
                            $i = 1;
                            foreach ($patient as $pt) { 
                                // Fetch patient details
                                $patient_details = $this->db->select('*')->from($table)->where('id', $pt->patient_auto_id)->get()->row();
                                
                                if (!$patient_details) continue; // Skip iteration if no patient found

                                // Fetch department details
                                $dept = $this->db->select('*')->from('department_new')->where('dprt_id', $patient_details->department_id)->get()->row();

                                // Fetch drugs prescribed to the patient
                                $tablets = $this->db->select('*')->from($drug_table)->where('name', $pt->PatientName)->get()->result();
                                
                                $tablet_count = count($tablets);
                                
                                if ($tablet_count === 0) {
                                    // If no drugs are found, print row without drug columns
                                    echo "<tr>
                                            <th>{$i}</th>
                                            <td><b>{$pt->PatientName}</b></td>
                                            <td><b>" . ($patient_details->yearly_reg_no ?: $patient_details->old_reg_no) . "</b></td>
                                            <td><b>{$dept->name}</b></td>
                                            <td><b>{$patient_details->dignosis}</b></td>
                                            <td>-</td> <!-- No RX1 found -->
                                            <td>-</td> <!-- No RX1_despense found -->
                                        </tr>";
                                } else {

                                            $rx1_despense_value = !empty($tablets[0]->RX1_despense) ? $tablets[0]->RX1_despense : 
                                                        (($section !== "opd") ? $tablets[0]->DRX_despense : "");

                                    // Print first row with rowspan
                                            echo "<tr>
                                            <th rowspan='{$tablet_count}'>{$i}</th>
                                            <td rowspan='{$tablet_count}'><b>{$pt->PatientName}</b></td>
                                            <td rowspan='{$tablet_count}'><b>" . ($patient_details->yearly_reg_no ?: $patient_details->old_reg_no) . "</b></td>
                                            <td rowspan='{$tablet_count}'><b>{$dept->name}</b></td>
                                            <td rowspan='{$tablet_count}'><b>{$patient_details->dignosis}</b></td>
                                            <td>{$tablets[0]->RX1}</td>
                                            <td>{$rx1_despense_value}</td>
                                        </tr>";

                                    // Print remaining tablets in new rows
                                    for ($j = 1; $j < $tablet_count; $j++) {
                                                    $rx1_despense_value = !empty($tablets[$j]->RX1_despense) ? $tablets[$j]->RX1_despense : 
                                                            (($section !== "opd") ? $tablets[$j]->DRX_despense : "");


                                        echo "<tr>
                                                <td>{$tablets[$j]->RX1}</td>
                                                <td>{$rx1_despense_value}</td>
                                            </tr>";
                                    }
                                }
                                $i++;
                            }
                            ?>


              
              
                
             
              
            </table>
            
            
            
            
         
          </div>
          </div>
        </div>
    </div>
</div>