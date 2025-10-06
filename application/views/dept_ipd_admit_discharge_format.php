<div class="row">
    <div class="col-sm-12" id="PrintMe">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading no-print">
                <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger">
                        <i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-sm-12" align="center">
                    <h3><strong><?php echo $this->session->userdata('title'); ?></strong></h3>
                    <h4><?php echo $this->session->userdata('address'); ?></h4>
                    <h5>दैनंदिन अंतररुग्ण नोंदणी अहवाल</h5>
                    <h5>Start Date: <?php echo date("d/m/Y", strtotime($datefrom)); ?> To
                        <?php echo date("d/m/Y", strtotime($dateto)); ?></h5>
                </div>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th rowspan="2">Date</th>
            <th rowspan="2">Type</th>
            <?php foreach ($departments as $dept): ?>
                <th colspan="2"><?php echo $dept['name']; ?></th>
            <?php endforeach; ?>
            <th rowspan="2">Total (Admit)<hr>Discharge</th>
            <th rowspan="2">Grand Total</th>
        </tr>
        <tr>
            <?php foreach ($departments as $dept): ?>
                <th>M</th>
                <th>F</th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $date1 = date_create($datefrom);
        $date2 = date_create($dateto);
        $diff = date_diff($date1, $date2);
        $days = $diff->format('%a');

        $grandTotal = 0;
        $admitCounttotal = 0;
        $dischargeCounttotal = 0;

        for ($i = 0; $i <= $days; $i++):
            $checkDate = date('Y-m-d', strtotime("+$i days", strtotime($datefrom)));
            $row_total = 0;
        ?>
        <tr>
            <td><?php echo date('d-m-Y', strtotime($checkDate)); ?></td>
            <td>
                <strong>Admit:</strong><br>
                <hr>
                <strong>Discharge:</strong><br>
                <hr>
                <strong>Total:</strong>
            </td>

            <?php
            $admitCounttotalPerDate = 0;
            $dischargeCounttotalPerDate = 0;

            foreach ($departments as $dept):
                // Male Admit
                $admitMale = $this->db->where([
                    'department_id' => $dept['id'],
                    'DATE(create_date)' => $checkDate,
                    'ipd_opd' => 'ipd',
                    'sex' => 'M'
                ])->count_all_results('patient_ipd');

                // Female Admit
                $admitFemale = $this->db->where([
                    'department_id' => $dept['id'],
                    'DATE(create_date)' => $checkDate,
                    'ipd_opd' => 'ipd',
                    'sex' => 'F'
                ])->count_all_results('patient_ipd');

                // Male Discharge
                $dischargeMale = $this->db->where([
                    'department_id' => $dept['id'],
                    'DATE(discharge_date)' => $checkDate,
                    'ipd_opd' => 'ipd',
                    'sex' => 'M'
                ])->count_all_results('patient_ipd');

                // Female Discharge
                $dischargeFemale = $this->db->where([
                    'department_id' => $dept['id'],
                    'DATE(discharge_date)' => $checkDate,
                    'ipd_opd' => 'ipd',
                    'sex' => 'F'
                ])->count_all_results('patient_ipd');

                // Totals
                $totalAdmit = $admitMale + $admitFemale;
                $totalDischarge = $dischargeMale + $dischargeFemale;
                $total = $totalAdmit + $totalDischarge;

                $admitCounttotal += $totalAdmit;
                $dischargeCounttotal += $totalDischarge;

                $admitCounttotalPerDate += $totalAdmit;
                $dischargeCounttotalPerDate += $totalDischarge;
                $row_total += $total;
            ?>
                <td>
                    <div> <?php echo $admitMale; ?><hr> <br> <?php echo $dischargeMale; ?> <hr> <br> <?php echo $admitMale + $dischargeMale; ?></div>
                </td>
                <td>
                    <div><?php echo $admitFemale; ?> <hr> <br> <?php echo $dischargeFemale; ?> <hr> <br>  <?php echo $admitFemale + $dischargeFemale; ?></div>
                </td>
            <?php endforeach; ?>

            <td>
                <?php echo $admitCounttotalPerDate; ?>
                <hr><br>
                <?php echo $dischargeCounttotalPerDate; ?>
                <hr><br>
                <?php echo $dischargeCounttotalPerDate + $admitCounttotalPerDate; ?>
            </td>
            <td><?php echo $row_total; ?></td>
        </tr>
        <?php endfor; ?>
    </tbody>
</table>

            </div>
        </div>
    </div>
</div>