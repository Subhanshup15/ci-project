<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <div class="col-sm-12">
<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php  echo base_url('patients/patient_despensing_2025_new'); ?>">
<div class="form-group">
    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
</div>  
<div class="form-group">
    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
</div>  
<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
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
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              
                <?php $ipd = $section; ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    
            </div>

            <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-2" align="left"></div> 
               
               
                <div class="col-sm-8" align="center">  
                <h3 style="margin-top: 0px; margin-bottom: 15px;">OPD Despensing Register</h3>
                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo !empty($datefrom) ? date("d/m/Y", strtotime($datefrom)) : '00/00/0000';?>
                To   
                  <?php echo !empty($dateto) ? date("d/m/Y", strtotime($dateto)) : '00/00/0000';?>
                  </h4>
                </div>
              
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <th style="width: 30px; text-align: center;"><?php echo "NEW OPD" ?></th> 
                            <th style="width: 30px; text-align: center;"><?php echo "Follow OPD" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Name of Patient" ?></th>
                             <th style="width: 30px;" rowspan="2"><?php echo "Date" ?></th>
                            <th style="width: 30px;" ><?php echo "Full Address" ?></th>
                            <th style="width: 30px;" rowspan="2">Age</th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Sex"?></th> 
                             <th style="width: 30px;" rowspan="2"><?php echo "Medicine"?></th>
                        </tr>
                       
                    </thead>
                    <?php 
                    $this->load->model('patient_model');
                ?>
                   <tbody>
                    <?php  


                    

                    
                     if ($patients): ?>
                        <?php $aaa = 1; ?>
                        <?php foreach ($patients as $patient): 

                        $che=trim($patient->dignosis);
                        $section_tret=$section;
                    
                        $p_dignosis = '%'.$che.'%';
                        $p_dignosis_name=$patient->dignosis;

                        $manual_status =  $patient->manual_status;
                        $department_id = $patient->department_id;
                        $proxy_id = $patient->proxy_id;
                         $che = $che;
                         $sex = $patient->sex;
                         $id = $patient->id;



                                    $tretment_new = $this->patient_model->get_tretment($manual_status, $department_id, $proxy_id, $che, $sex, $id,$section_tret);

                                   if($patient->manual_status==1 || $patient->created_by==1)
                                                    {
                                                       $RX11= $tretment_new->RX1;
                                                        $RX22= $tretment_new->RX2;
                                                        $RX33= $tretment_new->RX3;
                                                        
                                                        $RX111= $tretment_new->RX11;
                                                        $RX122= $tretment_new->RX12;
                                                        $RX133= $tretment_new->RX13;
                                                        
                                                        $tab_day1= $tretment_new->tab_day1;
                                                        $tab_power1= $tretment_new->tab_power1;
                                                        $tab_cycle1= $tretment_new->tab_cycle1;
                                                        $tab_sl1= $tretment_new->tab_sl1;
                                                        $tab_day2= $tretment_new->tab_day2;
                                                        $tab_power2= $tretment_new->tab_power2;
                                                        $tab_cycle2= $tretment_new->tab_cycle2;
                                                        $tab_sl2= $tretment_new->tab_sl2;
                                                        $tab_day3= $tretment_new->tab_day3;
                                                        $tab_power3= $tretment_new->tab_power3;
                                                        $tab_cycle3= $tretment_new->tab_cycle3;
                                                        $tab_sl3= $tretment_new->tab_sl3;
                                                        
                                                        $liquid_day1= $tretment_new->liquid_day1;
                                                        $liq_power1= $tretment_new->liq_power1;
                                                        $liq_cycle1= $tretment_new->liq_cycle1;
                                                        $liq_sl1= $tretment_new->liq_sl1;
                                                        $liquid_day2= $tretment_new->liquid_day2;
                                                        $liq_power2= $tretment_new->liq_power2;
                                                        $liq_cycle2= $tretment_new->liq_cycle2;
                                                        $liq_sl2= $tretment_new->liq_sl2;
                                                        $liquid_day3= $tretment_new->liquid_day3;
                                                        $liq_power3= $tretment_new->liq_power3;
                                                        $liq_cycle3= $tretment_new->liq_cycle3;
                                                        $liq_sl3= $tretment_new->liq_sl3;
                                                    }
                                                    else
                                                    {
                                                        


                                                        $RX1= $tretment_new->RX1;
                                                        $RX2= '';
                                                        $RX3= '';
                                                    }
                        ?>
                            <tr>
                                <td style="padding:2px;"><?php echo $aaa++; ?></td>
                                <td style="padding:2px;"><?php echo ($patient->yearly_reg_no); ?></td>
                                 <td style="padding:2px;"><?php echo ($patient->old_reg_no); ?></td>
                                <td style="padding:2px;"><?php echo $patient->firstname; ?></td> 
                                  <td style="padding:2px;"><?php echo date('d-m-Y', strtotime($patient->create_date)); ?></td>

                                <td style="padding:2px;"><?php echo $patient->address; ?></td> 
                                <td style="padding:2px;""><?php echo $patient->date_of_birth; ?></td>        
                                <td style="padding:2px;"><?php echo $patient->sex; ?></td>
                                    <td  style="padding:2px;">
                                    <?php 
                                            if($patient->old_reg_no)
                                            {
                                                // echo "hiiii";
                                                if($patient->manual_status === 1 || $patient->created_by === 1)
                                                {
                                                    // if($RX1){ echo $RX1; }
                                                    if($RX11){ $exRX11 = explode(",",$RX1); echo $exRX1[0]."<br>".$exRX1[1];  if($tab_power1) { echo " ".$tab_power1; echo " ";}  if($tab_cycle1) { echo " ".$tab_cycle1; echo " ";}  if($tab_day1) { echo " x ".$tab_day1; } if($tab_sl1) { echo " <br> ".$tab_sl1."<br>"; } }
                                                    if($RX22){ echo $RX22;  if($tab_power2) { echo " ".$tab_power2; echo " ";}  if($tab_cycle2) { echo " ".$tab_cycle2; echo " ";}  if($tab_day2) { echo " x ".$tab_day2; } if($tab_sl2) { echo " <br> ".$tab_sl2."<br>"; } }
                                                    if($RX33){ echo $RX33;  if($tab_power3) { echo " ".$tab_power3; echo " ";}  if($tab_cycle3) { echo " ".$tab_cycle3; echo " ";}  if($tab_day3) { echo " x ".$tab_day3; } if($tab_sl3) { echo " <br> ".$tab_sl3."<br>"; } }
                                                    if($RX111){ echo $RX111; if($liq_power1) { echo " ".$liq_power1; echo " ";}  if($liq_cycle1) { echo " ".$liq_cycle1; echo " ";}  if($liquid_day1) { echo " x ".$liquid_day1; }  if($liq_sl1) { echo " <br>  ".$liq_sl1."<br>";} }
                                                    if($RX122){ echo $RX122; if($liq_power2) { echo " ".$liq_power2; echo " ";}  if($liq_cycle2) { echo " ".$liq_cycle2; echo " ";}  if($liquid_day2) { echo " x ".$liquid_day2; }  if($liq_sl2) { echo " <br>  ".$liq_sl2."<br>";} }
                                                    if($RX133){ echo $RX133; if($liq_power3) { echo " ".$liq_power3; echo " ";}  if($liq_cycle3) { echo " ".$liq_cycle3; echo " ";}  if($liquid_day3) { echo " x ".$liquid_day3; }  if($liq_sl3) { echo " <br>  ".$liq_sl3."<br>";} }

                                                }
                                                else
                                                {
                                                    $session_year = $this->session->userdata['acyear'];
                                                    $patient_entry_count = $this->db->select('*')
                                                    ->from('patient')
                                                    ->where('old_reg_no',$patient->old_reg_no)
                                                    ->where('year(create_date)',$session_year)
                                                    ->get()
                                                    ->result();
                                                    if($patient_entry_count)
                                                    {
                                                        for($a = 0;$a<count($patient_entry_count);$a++)
                                                        {
                                                            if($a == 0)
                                                            {
                                                                $last_create_date = date('Y-m-d',strtotime($patient_entry_count[$a]->create_date));
                                                                $create_date = date('Y-m-d',strtotime($patient->create_date));
                                                                if($last_create_date == $create_date)
                                                                {
                                                                    echo $tretment_new->treatment_folup_one;
                                                                }
                                                            }
                                                            if($a == 1)
                                                            {
                                                                $last_create_date = date('Y-m-d',strtotime($patient_entry_count[$a]->create_date));
                                                                $create_date = date('Y-m-d',strtotime($patient->create_date));
                                                                if($last_create_date == $create_date)
                                                                {
                                                                    echo $tretment_new->treatment_folup_two;
                                                                }
                                                            }
                                                            if($a == 2)
                                                            {
                                                                $last_create_date = date('Y-m-d',strtotime($patient_entry_count[$a]->create_date));
                                                                $create_date = date('Y-m-d',strtotime($patient->create_date));
                                                                if($last_create_date == $create_date)
                                                                {
                                                                    echo $tretment_new->treatment_folup_three;
                                                                }
                                                            }
                                                            if($a == 3)
                                                            {
                                                                $last_create_date = date('Y-m-d',strtotime($patient_entry_count[$a]->create_date));
                                                                $create_date = date('Y-m-d',strtotime($patient->create_date));
                                                                if($last_create_date == $create_date)
                                                                {
                                                                    echo $tretment_new->treatment_folup_four;
                                                                }
                                                            }

                                                            if($a == 4)
                                                            {
                                                                $last_create_date = date('Y-m-d',strtotime($patient_entry_count[$a]->create_date));
                                                                $create_date = date('Y-m-d',strtotime($patient->create_date));
                                                                if($last_create_date == $create_date)
                                                                {
                                                                    echo $tretment_new->treatment_folup_five;
                                                                }
                                                            }
                                                        }
                                                    }


                                                }
                                            }
                                            else
                                            {
                                                if($patient->manual_status == 1 || $patient->created_by == 1)
                                                {
                                                   if($RX11){ $exRX1 = explode(",",$RX11); echo $exRX1[0]."<br>".$exRX1[1];  if($tab_power1) { echo " ".$tab_power1; echo " ";}  if($tab_cycle1) { echo " ".$tab_cycle1; echo " ";}  if($tab_day1) { echo " x ".$tab_day1; } if($tab_sl1) { echo " <br> ".$tab_sl1."<br>"; } }
                                                    if($RX22){ echo $RX22;  if($tab_power2) { echo " ".$tab_power2; echo " ";}  if($tab_cycle2) { echo " ".$tab_cycle2; echo " ";}  if($tab_day2) { echo " x ".$tab_day2; } if($tab_sl2) { echo " <br> ".$tab_sl2."<br>"; } }
                                                    if($RX33){ echo $RX33;  if($tab_power3) { echo " ".$tab_power3; echo " ";}  if($tab_cycle3) { echo " ".$tab_cycle3; echo " ";}  if($tab_day3) { echo " x ".$tab_day3; } if($tab_sl3) { echo " <br> ".$tab_sl3."<br>"; } }
                                                    if($RX111){ echo $RX111; if($liq_power1) { echo " ".$liq_power1; echo " ";}  if($liq_cycle1) { echo " ".$liq_cycle1; echo " ";}  if($liquid_day1) { echo " x ".$liquid_day1; }  if($liq_sl1) { echo " <br>  ".$liq_sl1."<br>";} }
                                                    if($RX122){ echo $RX122; if($liq_power2) { echo " ".$liq_power2; echo " ";}  if($liq_cycle2) { echo " ".$liq_cycle2; echo " ";}  if($liquid_day2) { echo " x ".$liquid_day2; }  if($liq_sl2) { echo " <br>  ".$liq_sl2."<br>";} }
                                                    if($RX133){ echo $RX133; if($liq_power3) { echo " ".$liq_power3; echo " ";}  if($liq_cycle3) { echo " ".$liq_cycle3; echo " ";}  if($liquid_day3) { echo " x ".$liquid_day3; }  if($liq_sl3) { echo " <br>  ".$liq_sl3."<br>";} }
                                                }
                                                else
                                                {
                                                     if($RX1){ echo $RX1; }
                                                }
                                                        
                                            }


                                    ?>
                                    </td>
                               
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>

            
            </div>
        </div>
    </div>
</div>




