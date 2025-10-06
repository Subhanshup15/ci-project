<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('commite_tab/ipd_patient') ?>">
            <div class="form-group">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>
            <div class="form-group">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
            </div>
            <div class="form-group">
                <input type="text" name="section" class="form-control" id="section" value="ipd" readonly>
            </div>
            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>
        </form>
        
        <div class="panel panel-default thumbnail">
            <div class="btn-group">
                <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button>
            </div>
            <div class="btn-group">
                <input id="myInput" class="form-control" type="text" placeholder="Search..">
            </div>
            
            <div id="PrintMe">
                <div class="panel-heading row">
                    <div class="col-sm-12" align="center">
                        <strong><?php echo $this->session->userdata('title') ?></strong>
                        <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                    </div>
                    <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                        <h2> Central Register of In Patient Department </h2>
                    </div>
                </div>

                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <div>
                        <b> Date : <?php echo date('d-m-Y', strtotime($datefrom)) ?> TO <?php echo date('d-m-Y', strtotime($dateto)) ?></b>
                    </div>
                </div>
                
                <div class="panel-body">
                    <!-- Status Filter Buttons -->
                    <style>
                        .status-label {
                            font-weight: bold;
                        }
                        .admit-label {
                            color: red; /* Red */
                        }
                        .discharge-label {
                            color: #5cb85c; /* Green */
                        }
                        .onbed-label {
                            color: red; /* Blue */
                        }
                        .new-admission td {
                            color: red;
                           
                            font-weight: bold;
                        }
                        .discharged-patient td {
                            color: #5cb85c;
                             font-weight: bold;
                           
                        }
                        .onbed-patient td {
                            color: #293336;
                           
                        }
                    </style>

                    <!-- Filter Buttons -->
                    <div class="btn-group mb-3 no-print">
                        <button class="btn btn-default filter-btn" data-filter="all">Show All</button>
                         <button class="btn btn-danger filter-btn" data-filter="new-admission">New Admissions</button>
                        <button class="btn btn-primary filter-btn" data-filter="onbed">On Bed</button>
                        <button class="btn btn-success filter-btn" data-filter="discharged">Discharged</button>
                    </div>

                    <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width:30px" rowspan="2">Sno.</th>
                                <th style="width:30px" rowspan="2">C-IPD No.</th>
                                <th style="width:30px" colspan="2" style="text-align:center;">OPD No.</th>
                                <th style="width:30px" rowspan="2">Name.</th>
                                <th style="width:30px" rowspan="2">Age.</th>
                                 <th style="width:30px" rowspan="2">Sex.</th>
                                 <th style="width:30px" rowspan="2">Department.</th>
                                  <th style="width:30px" rowspan="2">BedNo.</th>
                                <th  style="width:30px" rowspan="2"> DOA.</th>
                                <th  style="width:30px" rowspan="2"> DOD.</th>
                               
                               
                                <th  style="width:30px" rowspan="2">Diagnosis.</th>
                                
                               <!-- <th rowspan="2">Address</th> -->
                                <th  style="width:30px" rowspan="2">Status.</th>
                                <th  style="width:30px" rowspan="2" class="no-print"><?php echo display('action'); ?></th>
                            </tr>
                            <tr>
                                <th style="width:30px" >New No</th>
                                <th style="width:30px" >Follow-Up</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($patients)) {
                                $sl = 1;
                                $year = $this->session->userdata('acyear');
                                $Year = substr($year, 2, 2);
                                foreach ($patients as $bcm) {
                                    // Check patient status
                                    $onbed_patient = $this->db->select('*')->from('patient_ipd')
                                        ->where('yearly_reg_no', $bcm->yearly_reg_no)
                                        ->where('discharge_date','0000-00-00')
                                        ->get()->row();


                                        $admission_row = $this->db->select('*')
                                        ->from('patient_ipd')
                                        ->where('yearly_reg_no', $bcm->yearly_reg_no)
                                        ->where('create_date', $datefrom)
                                        ->get()
                                        ->row();

                                    // print_r($this->db->last_query());
                                    // echo "<br>";

                                    $isNewAdmission = false;

                                    if ($admission_row && $admission_row->create_date == $bcm->create_date) {
                                        $isNewAdmission = true;
                                    }


                                    $discharge_patient = $this->db->select('*')->from('patient_ipd')
                                        ->where('yearly_reg_no', $bcm->yearly_reg_no)
                                        ->where('discharge_date', $datefrom)
                                        ->get()->row();

                                    $isNew = !empty($bcm->yearly_reg_no);
                                    $rowClass = ($sl & 1) ? 'odd gradeX' : 'even gradeC';
                                    $rowClass .= $isNew ? ' new-patient' : ' old-patient';

                                    // Add status class
                                    if (!empty($onbed_patient && $isNewAdmission!='1')) {
                                        $rowClass .= ' onbed-patient';
                                        $status = 'On Bed';
                                        $statusClass = 'onbed-label';
                                    } elseif ($isNewAdmission) {
                                        $rowClass .= ' new-admission';
                                        $status = 'New Admission';
                                        $statusClass = 'admit-label';
                                    } elseif (!empty($discharge_patient)) {
                                        $rowClass .= ' discharged-patient';
                                        $status = 'Discharged';
                                        $statusClass = 'discharge-label';
                                    } else {
                                        $status = '';
                                        $statusClass = '';
                                    }

                                    $occ = $this->db->select('occupation')->from('patient')
                                        ->where('id', $bcm->id)->get()->row();

                                         $Cyear = $this->session->userdata['acyear'];

                                        // Choose department table based on academic year
                                        if ($Cyear == '2025') {
                                            $departmentTable = 'department_new';
                                        } else {
                                            $departmentTable = 'department';
                                        }

                                        // Get department row for a given department_id
                                        $department = $this->db->select('*')
                                            ->where('dprt_id', $bcm->department_id)
                                            ->get($departmentTable)
                                            ->row();
                                    
                                    ?>
                                    <tr class="<?php echo $rowClass; ?>">
                                        <td><?php echo $sl; ?></td>
                                         <td><?php echo $bcm->ipd_no_new; ?></td>
                                        <td><?php echo $isNew ? $bcm->yearly_reg_no . '/' . $Year : ''; ?></td>
                                        <td><?php echo !$isNew && $bcm->old_reg_no ? $bcm->old_reg_no . '/' . $Year : ''; ?></td>
                                        <td><?php echo $bcm->firstname; ?></td>
                                        <td><?php echo $bcm->date_of_birth; ?></td>
                                          <td><?php echo $bcm->sex; ?></td>
                                           <td><?php echo $department->name ?? 'NA'; ?></td>
                                           <td><?php echo $bcm->bedNo ?? 'NA'; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($bcm->create_date)); ?></td>
                                        <td><strong><?php echo ($bcm->discharge_date != '0000-00-00') ? date('d-m-Y', strtotime($bcm->discharge_date)) : ''; ?></strong></td>
                                      
                                      
                                        <td><?php echo $bcm->dignosis; ?></td>
                                       
                                       <!-- <td><?php echo $bcm->address; ?></td> -->
                                        <td>
                                            <?php if ($status): ?>
                                                <span class="status-label <?php echo $statusClass; ?>"><?php echo $status; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="center no-print" style="padding:2px;">
                                            <a href="<?php echo base_url("patients/ipdprofile_new/{$bcm->id}"); ?>" class="btn btn-xs btn-success">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?php echo base_url("patients/edit_ipd/{$bcm->id}"); ?>" class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sl++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Filter patients by status
        $('.filter-btn').on('click', function () {
            const filter = $(this).data('filter');
            const $rows = $('#patientdata tbody tr');

            if (filter === 'new') {
                $rows.hide().filter('.new-patient').show();
            } else if (filter === 'old') {
                $rows.hide().filter('.old-patient').show();
            } else if (filter === 'new-admission') {
                $rows.hide().filter('.new-admission').show();
            } else if (filter === 'onbed') {
                $rows.hide().filter('.onbed-patient').show();
            } else if (filter === 'discharged') {
                $rows.hide().filter('.discharged-patient').show();
            } else {
                $rows.show();
            }
        });

        // Search functionality
        $("#myInput").on("keyup", function () {
            const value = $(this).val().toLowerCase();
            $("#patientdata tbody tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function excel_all_customer(date1, date2, section) {
        window.location = 'excel_all_customer?date1=' + date1 + '&date2=' + date2 + '&section=' + section;
    }

    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>