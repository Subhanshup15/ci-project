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
        <th>OPD NEW.</th>
        <th>OPD OLD.</th>
        <th>Department</th>
        <th>Diagnosis</th>
        <th>Name of Drugs</th>
        <th>Total Dispense</th>
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
        // $tablets = $this->db->select('*')->from($drug_table)->where('name', $pt->PatientName)->get()->result();
        
         if($section== 'ipd'){
    $tablets = $this->db->get_where($drug_table, ['name' => $pt->PatientName, 'push_date' => $datefrom])->result();
    }else{
    $tablets = $this->db->get_where($drug_table, ['name' => $pt->PatientName, 'create_date' => $datefrom])->result();

    }
        $tablet_count = count($tablets);

        if ($tablet_count === 0) {
            // If no drugs are found, print row without drug columns
            echo "<tr>
                    <th>{$i}</th>
                    <td><b>{$pt->PatientName}</b></td>
                    <td><b>" . ($patient_details->yearly_reg_no) . "</b></td>
                     <td><b>" . ($patient_details->old_reg_no) . "</b></td>
                    <td><b>{$dept->name}</b></td>
                    <td><b>{$patient_details->dignosis}</b></td>
                    <td>-</td> <!-- No RX1 found -->
                    <td>-</td> <!-- No RX1_despense found -->
                </tr>";
        } else {
            // Print first row with rowspan
            $rx1_despense_value = !empty($tablets[0]->RX1_despense) ? $tablets[0]->RX1_despense :
                (($section !== "opd") ? $tablets[0]->DRX_despense : "");

            $unit = "";
            if (stripos($tablets[0]->RX1, 'CHURNA') !== false) {
                $unit = "g";
            } elseif (stripos($tablets[0]->RX1, 'GUGGUL') !== false) {
                $unit = "mg";
            } elseif (stripos($tablets[0]->RX1, 'VATI') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'RAS') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'POWDER') !== false) {
                $unit = "g";
            }elseif (stripos($tablets[0]->RX1, 'GUTI') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'VEERATARADI KASHAY') !== false) {
                $unit = "ml";
            }elseif (stripos($tablets[0]->RX1, 'SUTSHEKHAR') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'VASANT') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'CHINTAMANI') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'GANDHARVHARITAKI') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'SARIVADYASAVA') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'KARPURGANDHAK') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'ASHOKARISHT') !== false) {
                $unit = "ml";
            }elseif (stripos($tablets[0]->RX1, 'SAPTAMRUT LOH') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'KUMARI AASAV') !== false) {
                $unit = "ml";
            }elseif (stripos($tablets[0]->RX1, 'GHRUT') !== false) {
                $unit = "ml";
            }elseif (stripos($tablets[0]->RX1, 'KASHAY') !== false) {
                $unit = "ml";
            }elseif (stripos($tablets[0]->RX1, 'BILWAVALEH') !== false) {
                $unit = "mg";
            }elseif (stripos($tablets[0]->RX1, 'ASHOK CHURNA') !== false) {
                $unit = "g";
            }


             $unit1 = "";
            if (stripos($tablets[0]->RX1, 'CHURNA') !== false) {
                $unit = "";
            } elseif (stripos($tablets[0]->RX1, 'GUGGUL') !== false) {
                $unit1 = "(125mg)";
            } elseif (stripos($tablets[0]->RX1, 'VATI') !== false) {
                $unit1 = "(125mg)";
            }elseif (stripos($tablets[0]->RX1, 'RAS') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'POWDER') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'GUTI') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'VEERATARADI KASHAY') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'SUTSHEKHAR') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'VASANT') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'CHINTAMANI') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'GANDHARVHARITAKI') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'SARIVADYASAVA') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'KARPURGANDHAK') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'ASHOKARISHT') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'SAPTAMRUT LOH') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'KUMARI AASAV') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'GHRUT') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'KASHAY') !== false) {
                $unit1 = "";
            }elseif (stripos($tablets[0]->RX1, 'KIRTI VATI') !== false) {
                $unit1 = "(125mg)";
            }

            echo "<tr>
                    <th rowspan='{$tablet_count}'>{$i}</th>
                    <td rowspan='{$tablet_count}'><b>{$pt->PatientName}</b></td>
                    <td rowspan='{$tablet_count}'><b>" . ($patient_details->yearly_reg_no) . "</b></td>
                      <td rowspan='{$tablet_count}'><b>" . ($patient_details->old_reg_no) . "</b></td>
                    <td rowspan='{$tablet_count}'><b>{$dept->name}</b></td>
                    <td rowspan='{$tablet_count}'><b>{$patient_details->dignosis}</b></td>
                    <td>{$tablets[0]->RX1}{$unit1}</td>
                    <td>{$rx1_despense_value} {$unit}</td>
                </tr>";

            // Print remaining tablets in new rows
            for ($j = 1; $j < $tablet_count; $j++) {
                $rx1_despense_value = !empty($tablets[$j]->RX1_despense) ? $tablets[$j]->RX1_despense :
                    (($section !== "opd") ? $tablets[$j]->DRX_despense : "");

                $unit = "";
                if (stripos($tablets[$j]->RX1, 'CHURNA') !== false) {
                    $unit = "g";
                } elseif (stripos($tablets[$j]->RX1, 'GUGGUL') !== false) {
                    $unit = "mg";
                } elseif (stripos($tablets[$j]->RX1, 'VATI') !== false) {
                    $unit = "mg";
                } elseif (stripos($tablets[$j]->RX1, 'RAS') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'POWDER') !== false) {
                    $unit = "g";
                }elseif (stripos($tablets[$j]->RX1, 'GUTI') !== false) {
                    $unit = "g";
                }elseif (stripos($tablets[$j]->RX1, 'VEERATARADI KASHAY') !== false) {
                    $unit = "ml";
                }elseif (stripos($tablets[$j]->RX1, 'SUTSHEKHAR') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'VASANT') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'CHINTAMANI') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'GANDHARVHARITAKI') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'SARIVADYASAVA') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'KARPURGANDHAK') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'ASHOKARISHT') !== false) {
                    $unit = "ml";
                }elseif (stripos($tablets[$j]->RX1, 'SAPTAMRUT LOH') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'KUMARI AASAV') !== false) {
                    $unit = "ml";
                }elseif (stripos($tablets[$j]->RX1, 'GHRUT') !== false) {
                    $unit = "ml";
                }elseif (stripos($tablets[$j]->RX1, 'KASHAY') !== false) {
                    $unit = "ml";
                }elseif (stripos($tablets[$j]->RX1, 'BILWAVALEH') !== false) {
                    $unit = "mg";
                }elseif (stripos($tablets[$j]->RX1, 'ASHOK CHURNA') !== false) {
                    $unit = "g";
                }

                $unit1 = "";
                if (stripos($tablets[$j]->RX1, 'CHURNA') !== false) {
                    $unit1 = "";
                } elseif (stripos($tablets[$j]->RX1, 'GUGGUL') !== false) {
                    $unit1 = "(125mg)";
                } elseif (stripos($tablets[$j]->RX1, 'LOHA GUTI') !== false) {
                    $unit1 = "(62.5mg)";
                } elseif (stripos($tablets[$j]->RX1, 'VATI') !== false) {
                   $unit1 = "(125mg)";
                } elseif (stripos($tablets[$j]->RX1, 'RAS') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'POWDER') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'GUTI') !== false) {
                    $unit1 = "(125mg)";
                }elseif (stripos($tablets[$j]->RX1, 'VEERATARADI KASHAY') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'SUTSHEKHAR') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'VASANT') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'CHINTAMANI') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'GANDHARVHARITAKI') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'SARIVADYASAVA') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'KARPURGANDHAK') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'ASHOKARISHT') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'SAPTAMRUT LOH') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'KUMARI AASAV') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'GHRUT') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'KASHAY') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'BILWAVALEH') !== false) {
                    $unit1 = "";
                }elseif (stripos($tablets[$j]->RX1, 'KIRTI VATI') !== false) {
                    $unit1 = "(125mg)";
                }

                echo "<tr>
                        <td>{$tablets[$j]->RX1}{$unit1}</td>
                        <td>{$rx1_despense_value} {$unit}</td>
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