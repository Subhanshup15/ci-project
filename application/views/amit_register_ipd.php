<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php echo error_reporting(0); ?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

          <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('Patient_New/getpatientbydepartment_admit_register_date'); ?>">

            <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; 
                                                                                            ?>">       -->


            <div class="form-group">

                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

            </div>

            <div class="form-group">

                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if ($department_id) {
                                                                                                    echo $department_id;
                                                                                                } else {
                                                                                                    echo $dept_id;
                                                                                                }; ?>">
            </div>


            <div class="form-group">
                <select class="form-control" name="section" id="section">
                    <option value="ipd">ipd</option>
                </select>

            </div>



            <button type="submit" name="filter" class="btn btn-primary" id="filter">Submit</button>



        </form>
    </div>
    <div class="col-sm-12" id="PrintMe">

        <div class="panel panel-default thumbnail">

            <div class="panel-heading no-print row">

                <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger"><i class="fa fa-print"></i></button>
                </div>

                <div class="btn-group col-md-2">
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i> <?php echo display('add_patient') ?> </a>
                </div>

                <?php
                $ipd = ($patients[0]->ipd_opd);

                if ($ipd == 'ipd') { ?>
                    <div class="btn-group col-md-2">
                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                    </div>
                <?php }  ?>
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

                            if ($ipd == 'ipd') { ?>
                                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if ($name) {
                                                                                        echo "Departmental ";
                                                                                    } elseif ($gob == 'gob') {
                                                                                        echo "GOB";
                                                                                    } else {
                                                                                        echo "Central";
                                                                                    } ?> IPD Admit Register <?php if ($name == 'Swasthrakshnam') {
                                                                                                                                                                                                                echo "(" . $name . " -KC)";
                                                                                                                                                                                                            } elseif ($name) {
                                                                                                                                                                                                                echo "(" . $name . ")";
                                                                                                                                                                                                            } elseif ($dept_name) {
                                                                                                                                                                                                                echo "(" . $dept_name . ")";
                                                                                                                                                                                                            } ?></h3>
                                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?> To <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                            <?php } else { ?>
                                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if ($name) {
                                                                                        echo "Departmental ";
                                                                                    } else {
                                                                                        echo "Central";
                                                                                    } ?> OPD Register <?php if ($name) {
                                                                                                                                                                        echo "(" . $name . ")";
                                                                                                                                                                    } ?></h3>
                                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:- <?php echo date("d/m/Y", strtotime($datefrom))  ?> To <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                            <?php  }  ?>

                            <?php if ($summery_report == 0) {
                                if ($ipd == 'ipd') { ?>
                                    <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                                    <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                                    <?php }
                                if (!empty($department_id)) {
                                    $doctor_name1 = $this->db->select("*")
                                        ->from('user')
                                        ->where('department_id', $department_id)
                                        ->get()
                                        ->row();
                                    if (!empty($doctor_name1->firstname)) { ?>
                                        <lable style="float: right;">Doctor Name: <?//php echo "<span style='font-weight: 600;'>" . $doctor_name1->firstname . "</span>"; ?></lable>
                            <?php }
                                }
                            } ?>


                        </div>
                        <div class="col-xs-2"></div>
                    </div>
                </div>
                <div class="row col-sm-12" style="padding-bottom: 10px;font-size: 14px;">
                    <?php if ($this->session->userdata('status') == 0) { ?>
                        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/checked_data'); ?>">
                            <!--  <form  method="POST" action="<?php echo base_url('patients/checked_data'); ?>" >-->
                            <div class="col-md-2" style="padding-top: 5px;">
                                <input type="radio" name="check" value="0" <?php if ((empty($check_data)) || ($check_data[0]->check_date == 0)) {
                                                                                echo "checked";
                                                                            } ?>>Unchecked
                                <input type="radio" name="check" value="1" <?php if ((!empty($check_data)) && ($check_data[0]->check_date == 1)) {
                                                                                echo "checked";
                                                                            } ?>>checked
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="start_date1" class="form-control" id="start_date1" style="width:155px; margin-left: -21px;">
                                <input type="hidden" name="section" value="<?php if (($this->uri->segment(2) == 'opd') || ($this->uri->segment(2) == 'ipd')) {
                                                                                echo $this->uri->segment(2);
                                                                            } else {
                                                                                echo $_GET['section'];
                                                                            } ?>">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" class="btn btn-default active" value="Save" style="margin-left: -41px;">
                            </div>
                        </form>
                    <?php } ?>
                    <!--<div style="float: right;" >
                    <button onclick="excel_all_customer('<?php echo date('Y-m-d', strtotime($datefrom)); ?>','<?php echo date('Y-m-d', strtotime($dateto)); ?>','<?php echo $ipd; ?>')" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;EXCEL</button>
                    </div>-->
                </div>

                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" <?php if ($gob == 'gob') {
                                                                                                                echo "style='font-size:10px;'";
                                                                                                            } ?> style="display:  <?php if ($summery_report == 1) {
                                                                                                                                                                                                echo "none";
                                                                                                                                                                                            } ?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <?php if ($ipd == 'ipd') { ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>


                            <th style="width: 30px; text-align: center;" colspan="2">

                                <?php echo "COPD" ?>
                            </th>


                            <th rowspan="2"><?php echo "Name" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo display('sex') ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Age" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo display('address') ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Bed No"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Provisional Dignosis" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Final Diagnosis"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Doctor"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "DOA" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "DOD" ?></th>

                            
                            
                            <th style="width: 30px;" rowspan="2"><?php echo "Investigation" ?></th>
                        </tr>
                        <tr>

                            <th style="width: 30px;">

                                <?php echo "New No" ?>
                            </th>
                            <th style="width: 30px;"><?php echo "Old No" ?></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                            $datefrom1 = date('Y-m-d', strtotime($datefrom));
                            $year1 = date('Y', strtotime($datefrom));
                            $year2 = '%' . $year1 . '%';

                            $ddd = date('Y-m-d', strtotime("-1day" . $datefrom1));

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('yearly_reg_no !=', '');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient');
                            $num = $query->num_rows();

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('old_reg_no !=', '');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient');
                            $num1 = $query->num_rows();

                            $tot_serial1 = $num + $num1;

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'ipd');
                            // $this->db->where('old_reg_no !=','');
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient_ipd');
                            $num_ipd = $query->num_rows();

                            $tot_serial_ipd = $num_ipd;

                            // for department serial no

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('yearly_reg_no !=', '');
                            $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query_d = $this->db->get('patient');
                            $num_d = $query_d->num_rows();

                            $this->db->select('*');
                            $this->db->where('ipd_opd', 'opd');
                            $this->db->where('old_reg_no !=', '');
                            $this->db->where('department_id =', $department_id);
                            $this->db->where('create_date <=', $ddd);
                            $this->db->where('create_date LIKE', $year2);
                            $query_dd = $this->db->get('patient');
                            $num1_d = $query_dd->num_rows();


                            $tot_serial1_d = $num_d + $num1_d;
                            if ($tot_serial1_d == 0) {
                                $tot_serial1_d = 1;
                            } else {
                                $tot_serial1_d = $tot_serial1_d + 1;
                            }
                                //


                            ;
                            $array_no = count($patients);
                            $tot_serial = $tot_serial1 + $array_no + 1;

                            $this->db->select('*');
                            // $this->db->where('ipd_opd', 'opd');
                            $this->db->where('discharge_date like', '%0000-00-00%');
                            $this->db->where('create_date <=', date('Y-m-d') . " 23:59:00");
                            // $this->db->where('create_date LIKE', $year2);
                            $query = $this->db->get('patient_ipd');
                            $num_ipd1 = $query->num_rows();
                            //$num_ipd11=$num_ipd1 + 1;
                            $attay_count = count($patients);
                            //$num_ipd=  $num_ipd1 - $attay_count +1 ;

                            if ($department_by_section == 'ipd') {
                                //  $num_ipd=  $num_ipd1;
                                $num_ipd =  1;
                            } else {
                                $num_ipd =  $num_ipd1 - $attay_count + 1;
                            }


                            ?>
                            <?php $i = 0;
                        

                            foreach ($patients as $patient) {
                                $i++;

                                $dd = date('Y-m-d', strtotime($patient->discharge_date));
                                $aa = date('Y-m-d', strtotime($patient->create_date));
                                $dd12 = date('Y-m-d', strtotime($_GET['end_date']));
                                if ($_GET['end_date']) {
                                    $dd1 = date('Y-m-d', strtotime($_GET['end_date']));
                                } else {
                                    $dd1 = date('Y-m-d');
                                }



                           


                                $date_c = date('Y-m-d', strtotime($patient->create_date));
                                $date_d = date('Y-m-d', strtotime($patient->discharge_date));
                                $date_f = date('Y-m-d', strtotime($dateto));
                                $tot_serial--;
                                $tot_serial1++;
                                $tot_serial_ipd++;

                                $date_f1 = date('Y-m-d', strtotime($dateto));
                                $date_f2 = '%' . $date_f1 . '%';
                                $opd_ipd_p = $this->db->select("*")

                                    ->from('patient_ipd')

                                    ->where('yearly_reg_no', $patient->yearly_reg_no)
                                    ->where('old_reg_no ', $patient->old_reg_no)
                                    ->where('create_date LIKE', $date_f2)
                                    ->get()
                                    ->row();
                                //print_r($opd_ipd_p);
                                $New_OPD = $opd_ipd_p->yearly_reg_no;
                                $old_OPD = $opd_ipd_p->old_reg_no;

                                if ($ipd == 'ipd') {
                                    $che = trim($patient->dignosis);
                                    $section_tret = 'ipd';
                                    $len = strlen($che);
                                    $dd = substr($che, $len - 1);

                                    $str = $patient->dignosis;
                                    $arry = explode("-", $str);
                                    $t_c = count($arry);

                                    if ($t_c == '2') {
                                        $dd1 = substr($che, 0, -1);
                                        $p_dignosis = '%' . $arry[0] . '%';
                                        trim($p_dignosis);
                                        $p_dignosis_name = $patient->dignosis;
                                    } else {

                                        $p_dignosis = '%' . $che . '%';
                                        $p_dignosis_name = $patient->dignosis;
                                    }
                                } else {
                                    $section_tret = 'opd';
                                    $che = trim($patient->dignosis);
                                    $section_tret = 'opd';
                                    $len = strlen($che);
                                    $dd = substr($che, $len - 1);

                                    $str = $patient->dignosis;
                                    $arry = explode("-", $str);
                                    $t_c = count($arry);
                                    if ($t_c == '2') {
                                        $dd1 = substr($che, 0, -1);

                                        $p_dignosis = '%' . $arry[0] . '%';
                                        trim($p_dignosis);
                                        $p_dignosis_name = $patient->dignosis;
                                    } else {
                                        //echo $dd;

                                        $p_dignosis = '%' . $che . '%';
                                        $p_dignosis_name = $patient->dignosis;
                                    }
                                }


                                /*$ss=date('Y-m-d',strtotime($dateto));
                                    if($ss <= '202-01-28'){
                                        $table='treatments';
                                    }else{
                                        
                                         $table='treatments1';
                                    }
                                    */

                                if ($patient->manual_status == 0) {

                                    $tretment = $this->db->select("*")

                                        ->from('treatments1')

                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('proxy_id', $patient->proxy_id)
                                        ->where('department_id', $patient->department_id)
                                        ->where('ipd_opd', $section_tret)
                                        ->get()
                                        ->row();

                                    if (empty($tretment)) {


                                        $tretment = $this->db->select("*")

                                            ->from('treatments1')

                                            //->where('dignosis LIKE',$p_dignosis)
                                            //->where('ipd_opd ',$section_tret)
                                            ->where('department_id', $patient->department_id)
                                            ->where('ipd_opd', $patient->department_id)
                                            ->get()
                                            ->row();
                                    }
                                } else {
                                    $tretment = $this->db->select("*")

                                        ->from('manual_treatments')
                                        ->where('patient_id_auto', $patient->id)
                                        //->where('dignosis LIKE',$p_dignosis)
                                        ->where('ipd_opd ', $section_tret)
                                        ->get()
                                        ->row();
                                }

                                $RX1 = $tretment->RX1;
                                $RX2 = $tretment->RX2;
                                $RX3 = $tretment->RX3;
                                $RX4 = $tretment->RX4;
                                $RX5 = $tretment->RX5;

                                $RX_other = $tretment->RX_other;
                                $RX_other1 = $tretment->RX_other1;
                                $other_equipment = $tretment->other_equipment;

                                $KARMA = $tretment->KARMA;
                                $PK1 = $tretment->PK1;
                                $PK2 = $tretment->PK2;
                                $SWA1 = $tretment->SWA1;
                                $SWA2 = $tretment->SWA2;

                                $s_s = $tretment->skarma;
                                $s_v = $tretment->vkarma;


                                $SNEHAN = $tretment->SNEHAN;


                                $SWEDAN = $tretment->SWEDAN;
                                $VAMAN = $tretment->VAMAN;

                                $VIRECHAN = $tretment->VIRECHAN;
                                $BASTI = $tretment->BASTI;
                                $NASYA = $tretment->NASYA;

                                $RAKTAMOKSHAN = $tretment->RAKTAMOKSHAN;
                                $SHIRODHARA_SHIROBASTI = $tretment->SHIRODHARA_SHIROBASTI;
                                $OTHER = $tretment->OTHER;



                                $HEMATOLOGICAL = $tretment->HEMATOLOGICAL;
                                $SEROLOGYCAL = $tretment->SEROLOGYCAL;
                                $BIOCHEMICAL = $tretment->BIOCHEMICAL;
                                $MICROBIOLOGICAL = $tretment->MICROBIOLOGICAL;

                                $X_RAY = $tretment->X_RAY;
                                $ECG = $tretment->ECG;


                                // patient ipd yearly no
                                $ipd_no_date = date('Y-m-d', strtotime($patient->create_date));
                                $d_ipd_no = date('Y-m-d', strtotime("-1day" . $ipd_no_date));
                                $year122 = date('Y', strtotime($patient->create_date));
                                $year2 = '%' . $year122 . '%';

                                $this->db->select('*');
                                $this->db->where('ipd_opd', 'ipd');
                                $this->db->where('id <', $patient->id);
                                // $this->db->where('create_date <=', $d_ipd_no);
                                $this->db->where('create_date LIKE', $year2);
                                $query = $this->db->get('patient_ipd');
                                $num_ipd_change = $query->num_rows();
                                $tot_serial_ipd_change = $num_ipd_change;
                                $tot_serial_ipd_change++;

                                if ($patient->manual_status == 0) {
                                    $tretarray = $this->db->select("*")
                                        ->from('treatments1')
                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('proxy_id', $patient->proxy_id)
                                        ->where('department_id', $patient->department_id)
                                        ->where('ipd_opd', 'ipd')
                                        ->get()
                                        ->result();
                                    if (empty($tretarray)) {

                                        $tretarray = $this->db->select("*")
                                            ->from('treatments1')
                                            ->where('dignosis LIKE', $p_dignosis)
                                            ->where('department_id', $patient->department_id)
                                            ->where('ipd_opd', 'ipd')
                                            ->get()
                                            ->result();
                                        if (empty($tretarray)) {

                                            $tretarray = $this->db->select("*")
                                                ->from('treatments1')
                                                ->where('department_id', $patient->department_id)
                                                ->where('ipd_opd', $patient->department_id)
                                                ->get()
                                                ->result();
                                        }
                                    }
                                } else {
                                    $tretarray = $this->db->select("*")
                                        ->from('manual_treatments')
                                        ->where('patient_id_auto', $patient->id)
                                        ->where('dignosis LIKE', $p_dignosis)
                                        ->where('ipd_opd ', $section_tret)
                                        ->get()
                                        ->result();
                                }
                                //print_r($tretarray);
                                if (count($tretarray) == 2) {
                                    $rowFlag = 1;
                                } else {
                                    $rowFlag = 0;
                                }

                            ?>

                                <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>" style="  <?php if (($date_c == $date_f) && ($ipd == 'ipd')) {
                                                                                                            echo "color: #ff000d;font-weight: bold;";
                                                                                                        } else if (($date_d == $date_f) && ($ipd == 'ipd')) {
                                                                                                            echo "color: #4dd208;font-weight: bold;";
                                                                                                        } else if (($New_OPD == $patient->yearly_reg_no) && ($old_OPD == $patient->old_reg_no) && ($ipd == 'opd')) {
                                                                                                            echo "color: #ff000d;font-weight: bold;";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>">

                                    <?php if ($getpatientbydepartment_date == 'D') { ?>
                                        <td <?php if ($rowFlag == 1) {
                                                echo 'rowspan="2"';
                                            } ?> style="padding:2px;"><?php if ($ipd == opd) {
                                                                                                                        echo $tot_serial1_d++;
                                                                                                                    } else {
                                                                                                                        echo $i;
                                                                                                                    } ?></td>
                                    <?php } else { ?>
                                        <td <?php if ($rowFlag == 1) {
                                                echo 'rowspan="2"';
                                            } ?> style="padding:2px;"><?php if ($ipd == 'ipd') {
                                                                                                                        echo $i;
                                                                                                                    } else {
                                                                                                                        echo $tot_serial1;
                                                                                                                    } ?></td>
                                    <?php } ?>

                                    <!--<? //php if($ipd == 'ipd'){ 
                                        ?><td  style="padding:2px;"><? //php  if($department_by_section=='ipd'){ echo $tot_serial_ipd_change; } else{ echo $tot_serial_ipd_change++;} 
                                                                                                ?></td> <? //php } 
                                                                                                                                                                                                                        ?>  -->


                                    <?php if ($ipd == 'ipd') { ?>
                                        <?php if ($cyear < '2022') { ?>
                                            <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                            echo 'rowspan="2"';
                                                                        } ?>><?php if ($department_by_section == 'ipd') {
                                                                                                                            echo $tot_serial_ipd_change;
                                                                                                                        } else {
                                                                                                                            echo $tot_serial_ipd_change++;
                                                                                                                        } ?></td>

                                        <?php } else { ?>
                                            <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                            echo 'rowspan="2"';
                                                                        } ?>><?php if ($department_by_section == 'ipd') {
                                                                                                                            echo $tot_serial_ipd_change;
                                                                                                                        } else {
                                                                                                                            echo $tot_serial_ipd_change++;
                                                                                                                        } ?></td>
                                        <?php  } ?>
                                    <?php } ?>




                                    <td <?php if ($rowFlag == 1) {
                                            echo 'rowspan="2"';
                                        } ?>>
                                        <?php
                                        $year = $this->session->userdata['acyear'];

                                        $y = date('Y', strtotime($patient->fol_up_date));
                                        if ($y == '1970') {
                                            $y = $year;
                                            $yy = substr($y, 2, 2);
                                        } else {
                                            $yy = substr($y, 2, 2);
                                        }
                                        if ($patient->yearly_reg_no != null) {
                                            echo     $yearly_reg_no = $patient->yearly_reg_no . "/" . $yy;
                                            // echo ".".$yy."(New)";
                                        } else {
                                        } ?>
                                    </td>

                                    <td <?php if ($rowFlag == 1) {
                                            echo 'rowspan="2"';
                                        } ?>>
                                        <?php

                                        $y = date('Y', strtotime($patient->fol_up_date));
                                        if ($y == '1970') {
                                            $y = $year;
                                            $yy = substr($y, 2, 2);
                                        } else {
                                            $yy = substr($y, 2, 2);
                                        }
                                        if ($patient->yearly_reg_no != null) {
                                        } else {
                                            echo    $old_reg_no = $patient->old_reg_no . "/" . $yy;
                                            //echo  ".".$yy."(Old)";
                                        } ?>
                                    </td>
                                    <!--<td><?php echo $patient->ipd_no ?></td>-->

                                    <td style="width: 159px;" style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                                        echo 'rowspan="2"';
                                                                                    } ?>><?php echo $patient->firstname; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->sex; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->date_of_birth; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->address; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->name; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $patient->bedNo; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $p_dignosis_name; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $tretarray[0]->POVISIONALdignosis; ?></td>
                                    <?php
                                    $doctor_name = $this->db->select("*")
                                        ->from('user')
                                        ->where('department_id', $patient->department_id)
                                        ->where('user_id', $patient->doctor_id)
                                        ->get()
                                        ->row();
                                    ?>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo $doctor_name->firstname; ?></td>
                                    <td style="padding:2px;" <?php if ($rowFlag == 1) {
                                                                    echo 'rowspan="2"';
                                                                } ?>><?php echo date('d-m-Y', strtotime($patient->create_date)); ?></td>
 <td style="padding:2px;" <?php if ($rowFlag == 1) {echo 'rowspan="2"';} ?>>
 <?php if ($patient->discharge_date == '0000-00-00') {echo "-";} else {echo date('d-m-Y', strtotime($patient->discharge_date));} ?></td>


                             
 
 <td  style="padding:2px;">
                                                    <?php if($HEMATOLOGICAL){ echo $HEMATOLOGICAL.', <br>'; } ?>
                                                    <?php if($SEROLOGYCAL){ echo $SEROLOGYCAL.', <br>'; } ?>
                                                    <?php if($BIOCHEMICAL){ echo $BIOCHEMICAL.', <br>'; } ?>
                                                    <?php if($MICROBIOLOGICAL){ echo $MICROBIOLOGICAL.', <br>'; } ?>
                                                    <?php if($X_RAY){ echo $X_RAY.', <br>'; } ?>
                                                    <?php if($ECG){ echo $ECG.', <br>'; } ?>
                                                </td>

                            
                                </tr>
                                <?php if ($rowFlag == 1) { ?>
                                    <tr>
                                   
                                    </tr>
                                <?php } ?>
                                <?php $sl++; ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>


                <h3>Report Summary</h3>


             


                                
 <?php 
$department_new =  $this->db->select('*')->from('department_new')->where('dprt_id',$dept_id)->order_by('dprt_id','asc')
->get()->row();
?>

<table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
            <th style="width: 30px;" rowspan="2"><?php echo "Name" ?></th>
            <th style="width: 30px; text-align: center;" colspan="2"><?php echo "Male" ?></th>
            <th style="width: 30px; text-align: center;" colspan="2"><?php echo "Female" ?></th>
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            <th><?php echo "New No" ?></th>
            <th><?php echo "Follow-Up " ?></th>
            <th><?php echo "New No" ?></th>
            <th><?php echo "Follow-Up " ?></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $a = 1;
    $total_male_new = 0;
    $total_male_old = 0;
    $total_female_new = 0;
    $total_female_old = 0;

    
        $male_new = $this->db->select('count(*) as male_new')
        ->from('patient_ipd')
        ->where('department_id', $dept_id)
        ->where('create_date>=', $datefrom)
        ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'M')
        ->where('yearly_reg_no !=', '')
        ->get()
        ->row();
        // print_r($this->db->last_query());

        $male_old = $this->db->select('count(*) as male_old')
        ->from('patient_ipd')
        ->where('department_id',$dept_id)
        ->where('create_date>=', $datefrom)
        ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'M')
        ->where('old_reg_no !=', '')
        ->get()
        ->row();

        $female_new = $this->db->select('count(*) as female_new')
        ->from('patient_ipd')
        ->where('department_id',$dept_id)
        ->where('create_date>=', $datefrom)
        ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'F')
        ->where('yearly_reg_no !=', '')
        ->get()
        ->row();

        $female_old = $this->db->select('count(*) as female_old')
        ->from('patient_ipd')
        ->where('department_id', $dept_id)
        ->where('create_date>=', $datefrom)
        ->where('create_date<=', $dateto)
        ->where('ipd_opd', 'ipd')
        ->where('sex', 'F')
        ->where('old_reg_no !=', '')
        ->get()
        ->row();



        $total_male_new += $male_new->male_new;
        $total_male_old += $male_old->male_old;
        $total_female_new += $female_new->female_new;
        $total_female_old += $female_old->female_old;
    ?>
        <tr>
            <td><?php echo $a++; ?></td>
            <td><?php echo $department_new->name; ?></td>
            <td><?php echo $male_new->male_new; ?></td>
            <td><?php echo $male_old->male_old; ?></td>
            <td><?php echo $female_new->female_new; ?></td>
            <td><?php echo $female_old->female_old; ?></td>
            <td><?php echo $male_new->male_new + $male_old->male_old + $female_new->female_new + $female_old->female_old; ?></td> <!-- Total per department -->
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="text-align: center;"><strong>Total</strong></td>
            <td><?php echo $total_male_new; ?></td>
            <td><?php echo $total_male_old; ?></td>
            <td><?php echo $total_female_new; ?></td>
            <td><?php echo $total_female_old; ?></td>
            <td><?php echo $total_male_new + $total_male_old + $total_female_new + $total_female_old; ?></td> <!-- Total for all departments -->
        </tr>
    </tfoot>
</table>
            </div>
        </div>
    </div>
</div>
