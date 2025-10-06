<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <form class="form-inline" id="datefilter" name="datefilter" method="GET"
            action="<?php echo base_url('commite_tab/opd_patient') ?>">
            <div class="form-group">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date"
                    placeholder="<?php echo display('start_date') ?>">

            </div>
            <div class="form-group">

                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

                <input type="text" name="end_date" class="form-control datepicker" id="end_date"
                    placeholder="<?php echo display('end_date') ?>">

            </div>

            <div class="form-group">
                <input type="text" name="section" class="form-control" id="section" value="opd" readonly>

            </div>

            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>



        </form>

        <div class="panel panel-default thumbnail">
            <div class="btn-group">
                <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i
                        class="fa fa-print"></i></button>
            </div>
            <div class="btn-group">
                <input id="myInput" class="form-control" type="text" placeholder="Search..">
            </div>
            <div id="PrintMe">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2 text-left">
                            <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>"
                                style="height:120px; width:120px; border: 0.5px solid #0003;" />
                        </div>

                        <div class="col-sm-10 text-center">
                            <h5 class="mb-1"><strong><?php echo $this->session->userdata('title') ?></strong></h5>
                            <p class="mb-2"><?php echo $this->session->userdata('address') ?></p>
                            <h2 class="mt-3">Center OPD Patient List</h2>
                            <b> Date : <?php echo date('d-m-Y', strtotime($datefrom)) ?> TO
                                <?php echo date('d-m-Y', strtotime($dateto)) ?></b>
                        </div>

                    </div>
                </div>




                <div class="panel-body">
                    <style>
                        .filter-section button {
                            margin-right: 5px;
                            padding: 5px 10px;
                            border: 1px solid #ddd;
                            background: #f5f5f5;
                            cursor: pointer;
                        }

                        .filter-section button.active {
                            background: #337ab7;
                            color: white;
                            border-color: #2e6da4;
                        }

                        .filter-row {
                            margin-bottom: 10px;
                        }
                    </style>

                    <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                        <thead>
                            <tr>

                                <th style="width: 30px;" rowspan='2'><?php echo "Daily No." ?></th>

                                <th style="width: 30px; text-align: center;" colspan='2'><?php echo "OPD No" ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Monthly No." ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Yearly No." ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Patient Name" ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Full Address" ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Date" ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Age" ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Sex" ?></th>
                                <th style="width: 30px;" rowspan='2'><?php echo "Department" ?></th>
                                <th style="width: 30px;" rowspan='2' class="no-print"><?php echo display('action') ?>
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 30px;">New No</th>
                                <th style="width: 30px;">Follow-Up</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Cyear = $this->session->userdata['acyear'];
                            $year = date('Y', strtotime($Cyear));
                            $start_date = $year . '-01-01';
                            $currt_date = date('Y-m-d', strtotime($datefrom . ' -1 days'));



                            $count = $this->db->from('patient')
                                ->where('create_date >=', $start_date)
                                ->where('create_date <=', $currt_date)
                                ->count_all_results();


                            // echo "<br>";
                            
                            // print_r($this->db->last_query());
                            

                            $selected_date = $datefrom; // Replace with your input date
                            
                            $month_start = date('Y-m-01', strtotime($selected_date));
                            $day_before = date('Y-m-d', strtotime($selected_date . ' -1 day'));

                            // Check if selected date is the first of the month
                            if ($selected_date == $month_start) {
                                $start_count = 1;
                            } else {
                                // Count all records from 1st to the day before selected date
                                $previous_count = $this->db->from('patient')
                                    ->where('create_date >=', $month_start)
                                    ->where('create_date <=', $day_before)
                                    ->count_all_results();

                                $start_count = $previous_count + 1;
                            }








                            ?>
                            <?php if (!empty($patients)) { ?>
                                <?php
                                $sl = 1;
                                $year = $this->session->userdata('acyear');
                                $Year = substr($year, 2, 2);
                                ?>
                                <?php foreach ($patients as $bcm) { ?>
                                    <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">

                                        <td><?php echo $sl; ?></td>

                                        <td><?php if ($bcm->yearly_reg_no != '') {
                                            echo $bcm->yearly_reg_no . '/' . $Year;
                                        } ?></td>
                                        <td><?php if ($bcm->old_reg_no) {
                                            echo $bcm->old_reg_no . '/' . $Year;
                                        } ?></td>
                                        <td> <?php echo $start_count++; ?></td>
                                        <td><?php echo ++$count; ?></td>
                                        <td><?php echo $bcm->firstname; ?></td>
                                        <td><?php echo $bcm->address; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($bcm->create_date)); ?></td>
                                        <td><?php echo $bcm->date_of_birth; ?></td>
                                        <td><?php echo $bcm->sex; ?></td>
                                        <?php
                                        // Get academic year first
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
                                        <td>
                                            <?php echo (!empty($bcm->department_id) && !empty($department->name)) ? $department->name : 'NA'; ?>
                                        </td>
                                        <td class="center no-print">
                                            <a href="<?= base_url("patients/profile/$bcm->id") ?>"
                                                class="btn btn-xs btn-success">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url("patients/edit/$bcm->id") ?>" class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>



                                    </tr>
                                    <?php $sl++; ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <h3>Report Summary</h3>

                    <?php
                    $departments = $this->db->order_by('dprt_id', 'asc')->get('department_new')->result();

                    $total = ['male_new' => 0, 'male_old' => 0, 'female_new' => 0, 'female_old' => 0];
                    ?>

                    <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2">S.No</th>
                                <th rowspan="2">Name</th>
                                <th colspan="2" style="text-align: center;">Male</th>
                                <th colspan="2" style="text-align: center;">Female</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <th>New No</th>
                                <th>Follow-Up</th>
                                <th>New No</th>
                                <th>Follow-Up</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departments as $i => $dept):
                                $counts = ['M' => ['yearly_reg_no !=' => 0, 'old_reg_no !=' => 0], 'F' => ['yearly_reg_no !=' => 0, 'old_reg_no !=' => 0]];

                                foreach (['M', 'F'] as $sex) {
                                    foreach (['yearly_reg_no !=' => 'new', 'old_reg_no !=' => 'old'] as $field => $type) {
                                        $key = strtolower(($sex == 'M' ? 'male' : 'female') . '_' . $type);
                                        $counts[$sex][$field] = $this->db->where([
                                            'department_id' => $dept->dprt_id,
                                            'ipd_opd' => 'opd',
                                            'sex' => $sex,
                                            $field => '',
                                        ])
                                            ->where('create_date >=', $datefrom)
                                            ->where('create_date <=', $dateto)
                                            ->from('patient')->count_all_results();

                                        $total[$key] += $counts[$sex][$field];
                                    }
                                }

                                $dept_total = array_sum(array_column($counts, 'yearly_reg_no !=')) + array_sum(array_column($counts, 'old_reg_no !='));
                                ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $dept->name ?></td>
                                    <td><?= $counts['M']['yearly_reg_no !='] ?></td>
                                    <td><?= $counts['M']['old_reg_no !='] ?></td>
                                    <td><?= $counts['F']['yearly_reg_no !='] ?></td>
                                    <td><?= $counts['F']['old_reg_no !='] ?></td>
                                    <td><?= $dept_total ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align:center;"><strong>Total</strong></td>
                                <td><?= $total['male_new'] ?></td>
                                <td><?= $total['male_old'] ?></td>
                                <td><?= $total['female_new'] ?></td>
                                <td><?= $total['female_old'] ?></td>
                                <td><?= array_sum($total) ?></td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#patientdata tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function excel_all_customer(date1, date2, section) {
        //alert(date1+" "+date2);
        window.location = 'excel_all_customer?date1=' + date1 + '&date2=' + date2 + '&section=' + section;
        //	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
        // location.href='www.google.com';
    }
</script>
<script>
    $(document).ready(function () {
        // Add filter buttons above the table
        $('<div class="filter-section no-print">\
        <div class="filter-row gender-filter">\
            <strong>Gender:</strong>\
            <button class="btn btn-default active" data-gender="">All</button>\
            <button class="btn btn-default" data-gender="M">Male</button>\
            <button class="btn btn-default" data-gender="F">Female</button>\
        </div>\
       \
      </div>').insertBefore('#patientdata');

        // Apply filters when buttons are clicked
        $('.gender-filter button').click(function () {
            $('.gender-filter button').removeClass('active');
            $(this).addClass('active');
            filterPatients();
        });

        $('.opd-type-filter button').click(function () {
            $('.opd-type-filter button').removeClass('active');
            $(this).addClass('active');
            filterPatients();
        });

        function filterPatients() {
            var gender = $('.gender-filter button.active').data('gender');
            var opdType = $('.opd-type-filter button.active').data('opd-type');

            $('#patientdata tbody tr').each(function () {
                var rowGender = $(this).find('td:eq(9)').text().trim();
                var newOpd = $(this).find('td:eq(4)').text().trim();
                var oldOpd = $(this).find('td:eq(5)').text().trim();

                var genderMatch = (gender === '' || rowGender === gender);
                var opdTypeMatch = true;

                if (opdType === 'new') {
                    opdTypeMatch = (newOpd !== '' && oldOpd === '');
                } else if (opdType === 'old') {
                    opdTypeMatch = (oldOpd !== '');
                }

                $(this).toggle(genderMatch && opdTypeMatch);
            });
        }
    });
</script>