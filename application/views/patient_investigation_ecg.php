<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <?php ini_set('memory_limit','-1');?>
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getInvestigation_register_ecg/'.$section); ?>">
            <div class="form-group">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
            </div>
           <div class="form-group">
                <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
            </div>
            <div class="form-group">
                <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>
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
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>
            </div>


            <div class="panel-body" style="font-size:<?php if($patients[0]->ipd_opd =='ipd'){ echo "9px";} else { echo "11px"; }?> ;">
                <div class="row">
                    <div class="col-sm-2" align="left">
                        <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
                    </div> 
                    <div class="col-sm-8" align="center">  
                        <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                        <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                        
                        <?php if($section == 'ipd'){ ?>
                            <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "D-IPD Karma Panch";} else {echo "IPD ECG Register ";} ?>  <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; }?></h3>
                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                        <?php }else{ ?>
                            <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "D-OPD Karma Panch ";} else {echo " OPD ECG Register ";}?>   <?php  if($name) {echo "(".$name.")";}?></h3>
                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                        <?php   
                          if($department_id){
                            $dept_name=$this->db->select("*")

			                ->from('department')

			                ->where('dprt_id',$department_id)
                            ->get()

			                ->row();
			               
			               $name= $dept_name->name;
                           } else{
                               
                               $name ='';
                           }
                           
                           if($dept_id){
                            $dept_name=$this->db->select("*")

			                ->from('department')

			                ->where('dprt_id',$dept_id)
                            ->get()

			                ->row();
			               
			                 $dept_name= $dept_name->name;
                           } else{
                               
                               $dept_name ='';
                           }
                           
                               $ipd = ($patients[0]->ipd_opd);
                                
                        ?>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                           
                            <th style="width: 30px;" rowspan="2"><?php echo "Yearly No" ?></th>
                             <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                        <?php if($section == 'opd'){ ?>      <th style="width: 30px;" rowspan="2"><?php echo "Monthly No." ?></th> <?php }?>
                            <?php if($section == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                            <th style="width: 30px; text-align: center;" colspan="2" >
                                <?php echo "COPD" ?>
                            </th> 
                            <th rowspan="2"><?php echo "Name" ?></th> 
                            <th rowspan="2"><?php echo "Age" ?></th>    
                             <th rowspan="2"><?php echo "Address" ?></th>    
                            <th rowspan="2"><?php echo display('sex') ?></th>   
                            <th style="width: 30px;" rowspan="2"><?php echo "Department" ?></th> 
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                            <th rowspan="2"><?php echo "Dignosis" ?></th>
                            <th rowspan="2"><?php echo "Date" ?></th>
                            <th rowspan="2"><?php echo "ECG"?></th>
                            <th class="no-print" rowspan="2"><?php echo display('action') ?></th> 
                        </tr>
                        <tr>                
                            <th style="width: 80px;" >
                                <?php echo "New No" ?>
                            </th> 
                            <th style="width: 80px;"><?php echo "Old No" ?></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                      
                            $datefrom1 = date('Y-m-d', strtotime($dateto));
                            $year1 = date('Y', strtotime($dateto));
                            $year2 = '%' . $year1 . '%';
                            $ddd = date('Y-m-d', strtotime("-1day" . $datefrom1));

                            $last_date = date('Y-m-d', strtotime("-1day" . $datefrom));
                            $year = $this->session->userdata['acyear'];     
                            $monthOF_DATE = date("m",strtotime($datefrom));
                            $new_date_for_month = $year.'-'.$monthOF_DATE.'-01';
                            $monthlySerialNo = $this->db->select('COUNT(id) as total_count')
                            ->from('ecg_patient_count_opd')
                            ->where('ipd_opd', 'opd')
                            ->where('create_date >=', $new_date_for_month)
                            ->where('create_date <=', $last_date)
                            ->where('YEAR(create_date)', $year)
                            ->get()
                            ->row();
                            // print_r($this->db->last_query());

                            if ($new_date_for_month == $datefrom) {
                                $monthly_number = 1; // Starting from 1 for the new month
                            } else {
                                $last_count = $monthlySerialNo->total_count;
                                $monthly_number = $last_count + 1;
                            }
                        $a = 1;

                       
                       foreach($investiECGResult as $key => $pr){ ?>
                            <?php 
                                if($section == 'opd'){
                                    $patient = $this->db->where('id',$pr->patient_auto_id)->get('patient')->row();
                                }else{
                                    $patient = $this->db->where('id',$pr->patient_auto_id)->get('patient_ipd')->row();
                                    
                                    // patient ipd yearly no
                                    $ipd_no_date=date('Y-m-d',strtotime($patient->create_date));
                                    $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                    $year122=date('Y',strtotime($patient->create_date));
                                    $year2='%'.$year122.'%';
                                    
                                    $this->db->select('*');
                                    $this->db->where('ipd_opd', 'ipd');
                                    $this->db->where('id <', $patient->id);
                                    // $this->db->where('create_date <=', $d_ipd_no);
                                    $this->db->where('create_date LIKE', $year2);
                                    $query = $this->db->get('patient_ipd');
                                    $num_ipd_change = $query->num_rows();
                                    $ipd_no=$num_ipd_change;
                                }
                                $pDate = date('Y',strtotime($patient->create_date));
                                $dot_year = substr($pDate,2);

                             $dept_name=$this->db->select("*")->from('department')->where('dprt_id',$patient->department_id)->get()->row();

                            ?>
                            <tr>
                               
                                <td><?php echo ++$investiECGResultYearlyCount; ?></td>
                                 <td><?php echo $key+1; ?></td>
                                   <?php if($section == 'opd'){ ?>   <td style="padding: 2px;">
                                 <?php
                                    echo $monthly_number++;
                                    ?> 
                                    </td><?php } ?>
                                <?php if($section == 'ipd'){ ?><td><?php echo ++$ipd_no; ?></td><?php } ?>

    <?php 
                                    $date=date('Y',strtotime($patient->create_date));
                                    $dot_year=substr($date,2);
                                     $explode=explode('.',$patient->old_reg_no);
                                    $explode[1];
                                     ?>                         
                                   <td>
                                    <?php
                                        $year = $this->session->userdata['acyear'];
                                        $y=date('Y',strtotime($patient->create_date));
                                        if($y=='1970'){
                                        $y=$year;
                                        $yy=substr($y,2,2);
                                        }else{
                                        $yy=substr($y,2,2);
                                        }
                                        if($patient->yearly_reg_no != null){
                                        echo 	$yearly_reg_no= $patient->yearly_reg_no."/".$yy;
                                        } else {
                                        } ?>
                                </td>
                                
                                <td>
                                <?php
                                    $y=date('Y',strtotime($patient->fol_up_date));
                                    if($y=='1970'){
                                    $y=$year;
                                    $yy=substr($y,2,2);
                                    }else{
                                    $yy=substr($y,2,2);
                                    }
                                    if($patient->yearly_reg_no != null){
                                    } else {
                                    echo	$old_reg_no= $patient->old_reg_no."/".$yy;
                                    } ?>
                                </td>
                               <!-- <td><?php echo ($patient->yearly_reg_no)?$patient->yearly_reg_no.'.'.$dot_year:''; ?></td>
                                <td><?php echo ($patient->old_reg_no)?$patient->old_reg_no.'.'.$dot_year:''; ?></td> -->


                                <td><?php echo $patient->firstname; ?></td>
                                <td><?php echo $patient->date_of_birth; ?></td>
                                 <td><?php echo $patient->address; ?></td>
                                <td><?php echo $patient->sex; ?></td>
                                <td style="padding:2px;"><?php echo $dept_name->name; ?></td>
                                <td><?php echo $patient->dignosis; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                                <td><?php echo $pr->ecg; ?></td>
                                <td class="center no-print"  style="padding:2px;">
                                    <?php if($patient->ipd_opd == 'ipd'){ ?>
                                        <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                    <?php }else { ?>
                                        <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>      
                                    <?php } ?>
                                    <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                </td>       
                            </tr>
                            
                       <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <!-- Table Summery -->
                <h3>Report Summary</h3>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>             
                            <th><?php echo "S. No" ?></th>
                            <th><?php echo "Name" ?></th>                            
                            <th><?php echo "Total" ?></th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $name_array=array('ECG'); 
                            $tot_array=array($investiECGResultCount->ecgCount);
                        ?> 
                        <?php $n = 1; ?>
                        <?php for($i=0;$i<count($name_array);$i++) {  ?>
                            <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                <td><?php echo $n++;?> </td>
                                <td><?php echo $name_array[$i]; ?></td> <!-- //patient_id yearly sr no -->
                                <td><?php echo $tot_array[$i]; ?></td>
                            </tr>
                        <?php } ?> 
                        <tr>
                            <td colspan=2>Grand Total</td>
                            <td><?= array_sum($tot_array); ?></td>
                        </tr>
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){
  $('#btn_excel_download').click(function(){
			//"processing": true,
            //"serverSide": true,		
        $.ajax:{
            "url": "<?php echo base_url('patientList/opd')?>",
            "type": "POST",
			"data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
           // url: "<?php echo base_url()?>patientList/ipd",
           // type:"POST",
        },
        "columnDefs":[{
            "targets":[-1],
            "orderable":false,
        }]
  });
});
</script>

<script>
    $(function() {
        var d = new Date();
        $("#discharge_date").datetimepicker({  
            showSecond: false,
            timeFormat: 'hh:mm',
        }).datetimepicker("setDate", new Date());
    });
</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#patientdata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
