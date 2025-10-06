<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
    #wrapper1,
    #wrapper2 {
        width: 100%;
        border: none 0px RED;
        overflow-x: scroll;
        overflow-y: hidden;
    }

    #wrapper1 {
        height: 20px;
    }

    #wrapper2 {
        height: 100%;
    }

    #div1 {
        width: 1450px;
        height: 20px;
    }

    #div2 {
        width: 1450px;
        height: 100%;
        overflow: auto;
    }


    #wrapper3,
    #wrapper4 {
        width: 100%;
        border: none 0px RED;
        overflow-x: scroll;
        overflow-y: hidden;
    }

    #wrapper3 {
        height: 20px;
    }

    #wrapper4 {
        height: 100%;
    }

    #div3 {
        width: 1400px;
        height: 20px;
    }

    #div4 {
        width: 1400px;
        height: 100%;
        overflow: auto;
    }
</style>
<?php
error_reporting(0);
?>

<div class="row">

    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="">

            <div class="form-group">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if ($department_id) {
                                                                                                    echo $department_id;
                                                                                                } else {
                                                                                                    echo $dept_id;
                                                                                                }; ?>">
            </div>

            <div class="form-group">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
            </div>


            <div class="form-group">
                <select class="form-control" name="section" id="section">
                    <option value="ipd">ipd</option>
                </select>
            </div>

            <!--<input type="text" name="section" class="form-control" id="section" value="<? //php echo 'ipd'; 
                                                                                            ?>" readonly>-->

            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>

        </form>
    </div>


    <div class="col-sm-12" id="PrintMe">

        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print row">
                <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button>
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
                            <h4 style="margin-top: 5px;margin-bottom: 5px;">
                                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                            </h4>

                            <?php

                            if ($department_id) {
                                $dept_name = $this->db->select("*")
                                    ->from('department_new')
                                    ->where('dprt_id', $department_id)
                                    ->get()
                                    ->row();

                                $name = $dept_name->name;
                            } else {

                                $name = '';
                            }

                            if ($dept_id) {
                                $dept_name = $this->db->select("*")
                                    ->from('department_new')
                                    ->where('dprt_id', $dept_id)
                                    ->get()
                                    ->row();
                                $dept_name = $dept_name->name;
                            } else {
                                $dept_name = '';
                            }

                            $ipd = ($patients[0]->ipd_opd);

                            if ($ipd == 'ipd') {

                            ?>

                                <h4 style="margin-top: 0px; margin-bottom: 15px;"><?php if ($name) {
                                                                                        echo "Departmental ";
                                                                                    } elseif ($gob == 'gob') {
                                                                                        echo "GOB";
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?> <h2>MidNight Register</h2> <?php if ($name == 'Swasthrakshnam') {
                                                                                                                                                                                                                    echo "(" . $name . " -KC)";
                                                                                                                                                                                                                } elseif ($name) {
                                                                                                                                                                                                                    echo "(" . $name . ")";
                                                                                                                                                                                                                } elseif ($dept_name) {
                                                                                                                                                                                                                    echo "(" . $dept_name . ")";
                                                                                                                                                                                                                } ?></h3>
                                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>

                                <?php } else { ?>

                                    <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if ($name) {
                                                                                            echo "Departmental ";
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?> <h2>MidNight Register</h2> <?php if ($name) {
                                                                                                                                                                                    echo "(" . $name . ")";
                                                                                                                                                                                } ?></h3>
                                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?></h4>

                                <?php  }  ?>

                        </div>


                        <div id="wrapper1">
                            <div id="div1">
                            </div>
                        </div>
                        <div id="wrapper2">
                            <div id="div2">

                                

                                   <?php
                            $department_new =  $this->db->select('*')
                                ->from('department_new')
                                ->where('dprt_id!=', '28')
                                ->where('dprt_id!=', '35')
                                // ->where('dprt_id!=', '27')
                                ->order_by('dprt_id', 'asc')
                                ->get()->result();
                            ?>

                            


                        <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th rowspan="2">S.No</th>
                                    <th rowspan="2">Department Name</th>
                                    <th colspan="2" style="text-align: center;">Previous Patients</th>
                                    <th colspan="2" style="text-align: center;">Admitted</th>
                                    <th colspan="2" style="text-align: center;">Discharged</th>
                                    <th colspan="2" style="text-align: center;">Midnight Total</th>
                                </tr>
                                <tr>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Male</th>
                                    <th>Female</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $a = 1;

                                // Totals
                                $totals = [
                                    'prev_m' => 0, 'prev_f' => 0,
                                    'adm_m' => 0, 'adm_f' => 0,
                                    'dis_m' => 0, 'dis_f' => 0,
                                    'mid_m' => 0, 'mid_f' => 0
                                ];

                                foreach ($department_new as $dept) {
                                    $last_day = date('Y-m-d', strtotime('-1 day', strtotime($datefrom)));

                                    // Previous (admitted before start and not yet discharged)
                                    $prev_m = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                        ->where('department_id', $dept->dprt_id)
                                        ->where('sex', 'M')
                                        ->where('create_date <=', $last_day)
                                        ->group_start()
                                            ->where('discharge_date >', $last_day)
                                            ->or_where('discharge_date', '0000-00-00')
                                        ->group_end()
                                        ->where('ipd_opd', 'ipd')
                                        ->get()->row()->cnt;

                                        $prev_f = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                            ->where('department_id', $dept->dprt_id)
                                            ->where('sex', 'F')
                                            ->where('create_date <=', $last_day)
                                            ->group_start()
                                                ->where('discharge_date >', $last_day)
                                                ->or_where('discharge_date', '0000-00-00')
                                            ->group_end()
                                            ->where('ipd_opd', 'ipd')
                                            ->get()->row()->cnt;

                                        // Admitted
                                        $adm_m = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                            ->where('department_id', $dept->dprt_id)
                                            ->where('sex', 'M')
                                            ->where('create_date >=', $datefrom)
                                            ->where('create_date <=', $dateto)
                                            ->where('ipd_opd', 'ipd')
                                            ->get()->row()->cnt;

                                        $adm_f = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                            ->where('department_id', $dept->dprt_id)
                                            ->where('sex', 'F')
                                            ->where('create_date >=', $datefrom)
                                            ->where('create_date <=', $dateto)
                                            ->where('ipd_opd', 'ipd')
                                            ->get()->row()->cnt;

                                            // Discharged
                                            $dis_m = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                                ->where('department_id', $dept->dprt_id)
                                                ->where('sex', 'M')
                                                ->where('discharge_date >=', $datefrom)
                                                ->where('discharge_date <=', $dateto)
                                                ->where('ipd_opd', 'ipd')
                                                ->get()->row()->cnt;

                                            $dis_f = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                                ->where('department_id', $dept->dprt_id)
                                                ->where('sex', 'F')
                                                ->where('discharge_date >=', $datefrom)
                                                ->where('discharge_date <=', $dateto)
                                                ->where('ipd_opd', 'ipd')
                                                ->get()->row()->cnt;

                                                // Midnight total
                                                $mid_m = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                                    ->where('department_id', $dept->dprt_id)
                                                    ->where('sex', 'M')
                                                    ->where('create_date <=', $dateto)
                                                    ->group_start()
                                                        ->where('discharge_date >', $dateto)
                                                        ->or_where('discharge_date', '0000-00-00')
                                                    ->group_end()
                                                    ->where('ipd_opd', 'ipd')
                                                    ->get()->row()->cnt;

                                                        $mid_f = $this->db->select('COUNT(*) as cnt')->from('patient_ipd')
                                                            ->where('department_id', $dept->dprt_id)
                                                            ->where('sex', 'F')
                                                            ->where('create_date <=', $dateto)
                                                            ->group_start()
                                                                ->where('discharge_date >', $dateto)
                                                                ->or_where('discharge_date', '0000-00-00')
                                                            ->group_end()
                                                            ->where('ipd_opd', 'ipd')
                                                            ->get()->row()->cnt;

                                                        // Accumulate totals
                                                        $totals['prev_m'] += $prev_m;
                                                        $totals['prev_f'] += $prev_f;
                                                        $totals['adm_m'] += $adm_m;
                                                        $totals['adm_f'] += $adm_f;
                                                        $totals['dis_m'] += $dis_m;
                                                        $totals['dis_f'] += $dis_f;
                                                        $totals['mid_m'] += $mid_m;
                                                        $totals['mid_f'] += $mid_f;
                                                    ?>
                                                    <tr>
                                                        <td><?= $a++; ?></td>
                                                        <td><?= $dept->name; ?></td>
                                                        <td><?= $prev_m ?></td>
                                                        <td><?= $prev_f ?></td>
                                                        <td><?= $adm_m ?></td>
                                                        <td><?= $adm_f ?></td>
                                                        <td><?= $dis_m ?></td>
                                                        <td><?= $dis_f ?></td>
                                                        <td><?= $mid_m ?></td>
                                                        <td><?= $mid_f ?></td>
                                                    </tr>
                                            <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr style="font-weight: bold;">
                                                    <td colspan="2" style="text-align: center;">Total</td>
                                                    <td><?= $totals['prev_m'] ?></td>
                                                    <td><?= $totals['prev_f'] ?></td>
                                                    <td><?= $totals['adm_m'] ?></td>
                                                    <td><?= $totals['adm_f'] ?></td>
                                                    <td><?= $totals['dis_m'] ?></td>
                                                    <td><?= $totals['dis_f'] ?></td>
                                                    <td><?= $totals['mid_m'] ?></td>
                                                    <td><?= $totals['mid_f'] ?></td>
                                                </tr>
                                            </tfoot>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

</div>

<script>
    var wrapper1 = document.getElementById('wrapper1');
    var wrapper2 = document.getElementById('wrapper2');
    wrapper1.onscroll = function() {
        wrapper2.scrollLeft = wrapper1.scrollLeft;
    };
    wrapper2.onscroll = function() {
        wrapper1.scrollLeft = wrapper2.scrollLeft;
    };
</script>