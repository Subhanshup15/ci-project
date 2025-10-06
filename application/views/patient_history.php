<div class="row">
    <!--  table area -->
    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
            <div class="panel-heading no-print row">
                <lable><strong><?= $title; ?></strong></lable>             
            </div>
            <div class="panel-body" style="font-size: 12px;">
                
                <div class="row">
                    <center>
                        
                        <?php echo form_open('patients/patient_history','class="form-inline"') ?> 
                        
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            
                            <div class="form-group" style="width:30%;">
                                <label class="sr-only" for="opd_no"><?php echo "OPD No. "; ?></label>
                                <input type="text" name="opd_no" class="form-control" id="opd_no" placeholder="<?php echo "OPD No. or Patient Name"; ?>" value="<?= $search_value ?>" style="width:100%;">
                            </div>  
                            <div class="form-group" style="width:10%;">
                                <select class="form-control" name="section" id="section" style="width:100%;">
                                    <option value="opd" <?= ($section == 'opd')?"selected":'' ?>>opd</option>
                                    <option value="ipd" <?= ($section == 'ipd')?"selected":'' ?>>ipd</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="filter" style="width:10%;">Submit</button>
                        
                        <?php echo form_close() ?>
                    </center>
                </div>
                
                
                <div class="row" style="margin-top:20px;">
                    
                    <table class="datatable table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>C-OPD No.</th>
                                <?php if($section=='ipd'){ ?><th>C-IPD No</th><?php } ?>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Diagnosis</th>
                                <th>Department</th>
                                <th>Date</th>
                                <?php if($section=='ipd'){ ?><th>Bed No.</th><?php } ?>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php if(!empty($patient_data)){ ?>
                                <?php $i=0; ?>
                                
                                <?php foreach($patient_data as $data){ ?>
                                    <?php if($data->yearly_reg_no){ $patientOpdNo = $data->yearly_reg_no." (New)"; }elseif($data->old_reg_no){ $patientOpdNo = $data->old_reg_no." (Old)"; }else{ $patientOpdNo = ""; } ?>
                                    <?php $res = $this->db->where('dprt_id',$data->department_id)->get('department')->row(); ?>
                                    <?php 
                                        if($section == 'opd'){ $date = date('d-m-Y',strtotime($data->create_date)); }
                                        elseif($section == 'ipd'){ $date = "DOA : ".date('d-m-Y',strtotime($data->create_date))."<br>DOD : ".(($data->discharge_date!='0000-00-00')?date('d-m-Y',strtotime($data->discharge_date)):'00-00-0000');}
                                    ?>
                                    <?php
                                        // patient ipd yearly no
                                        $ipd_no_date=date('Y-m-d',strtotime($data->create_date));
                                        $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                        $year122=date('Y',strtotime($data->create_date));
                                        $year2='%'.$year122.'%';
                                        
                                        $this->db->select('*');
                                        $this->db->where('ipd_opd', 'ipd');
                                        $this->db->where('id <', $data->id);
                                        // $this->db->where('create_date <=', $d_ipd_no);
                                        $this->db->where('create_date LIKE', $year2);
                                        $query = $this->db->get('patient_ipd');
                                        $num_ipd_change = $query->num_rows();
                                        $ipd_no=$num_ipd_change+1;
                                    ?>
                                    <tr>
                                        <td><?= $i=$i+1 ?></td>
                                        <td><?= $patientOpdNo ?></td>
                                        <?php if($section == 'ipd'){ ?><td><?= $ipd_no ?></td><?php } ?>
                                        <td><?= $data->firstname ?></td>
                                        <td><?= $data->date_of_birth ?></td>
                                        <td><?= $data->sex ?></td>
                                        <td><?= $data->address ?></td>
                                        <td><?= $data->dignosis ?></td>
                                        <td><?= $res->name ?></td>
                                        <td><?= $date ?></td>
                                        <?php if($section == 'ipd'){ ?><td><?= $data->bedNo ?></td><?php } ?>
                                        <td>
                                            <?php if($section == 'ipd'){ ?>
                                                <a href="<?php echo base_url("patients/ipdprofile/$data->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                            <?php }else { ?>
                                                <a href="<?php echo base_url("patients/profile/$data->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>