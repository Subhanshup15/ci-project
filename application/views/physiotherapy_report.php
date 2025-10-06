<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_physiotherapy_report')?>">
                                      
                                      <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
                              
                              
                              <div class="form-group">
                              
                                  <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                              
                                  <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
                              
                              </div>  
                              
                              <div class="form-group">
                              
                                  <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
                              
                                  <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
                              
                              </div> 
                              
                            <div class="form-group">
                                <!--<select class="form-control" name="section" id="section">
                                <option value="opd">opd</option>
                                <option value="ipd">ipd</option>
                                </select>-->
                                <input type="text" name="section" class="form-control" id="section" value="opd" readonly>
                            
                            </div>
                              
                              <button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>
                              
                              
                              
                              </form>   

        <div  class="panel panel-default thumbnail">
                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>    
            <div class="panel-heading  row" id="PrintMe">
                 <div class="col-sm-12" align="center">  
                <strong><?php echo $this->session->userdata('title') ?></strong>
                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                </div>
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <h2>Physiotherapy Patient List</h2>
                </div>
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <div>
                        <b> Date : <?php echo date('d/m/Y',strtotime($datefrom)) ?> To <?php echo date('d/m/Y',strtotime($dateto)) ?></b>
                    </div>
                </div>
            
            <div class="panel-body">
                <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                
                            <th rowspan='2'><?php echo "Sno" ?></th>
                              <th rowspan='2'><?php echo "Monthly No" ?></th>
                            <th colspan='2' style="text-align:center;"><?php echo "OPD No" ?></th> 
                            <th rowspan='2'><?php echo "Name" ?></th>                            
                            <th rowspan='2'><?php echo "Age" ?></th>
                            <th rowspan='2'><?php echo "Sex" ?></th>
                          <th rowspan='2'><?php echo "Date" ?></th>
                            <th rowspan='2'><?php echo "Dignosis" ?></th>
                            <th rowspan='2'><?php echo "Physiotherapy" ?></th>
                            <th rowspan='2'><?php echo "Department" ?></th>
                            <th rowspan='2' class="no-print"><?php echo display('action') ?></th>                         
                        </tr>
                        <tr>
                            <th style="widht:15%;">New</th>
                            <th style="widht:15%;">Old</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) {
                  
                        ?>
                            <?php 
                            $sl = 1;
                            $year = $this->session->userdata('acyear');
                            $Year = substr($year,2,2);
                            ?>
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
                            ->from('physiohterapy_opd_report_result')
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
                            
                            
                             foreach ($patients as $bcm) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <!-- <td><?php //echo $patient->patient_id; ?></td> // Yearly reg no -->
                                    <td><?php echo $sl; ?></td>
                                       <?php if($section == 'opd'){ ?>   <td style="padding: 2px;">
                                 <?php
                                    echo $monthly_number++;
                                    ?> 
                                    </td><?php } ?>
                                    <td><?php if($bcm->yearly_reg_no !=''){ echo $bcm->yearly_reg_no.'/'.$Year;  } ?></td> 
                                    <td><?php if($bcm->old_reg_no){echo $bcm->old_reg_no.'/'.$Year; }?></td> 
                                    <td><?php echo $bcm->firstname; ?></td>
                                    <td><?php echo $bcm->date_of_birth; ?></td> 
                                    <td><?php echo $bcm->sex; ?></td>      
                                   <td><?php echo date("d-m-Y",strtotime($bcm->create_date)); ?></td>      
                                    <td><?php echo $bcm->dignosis; ?></td>   
                                    <td><?php echo $bcm->physiohterapy; ?></td>   
                                    <!--<td><?php echo $bcm->patient_auto_id; ?></td>   -->
                                    
                                    <?php 
                                    $department = $this->db->select('*')
                                    ->where('dprt_id',$bcm->department_id)
                                    ->get('department')
                                    ->row();
                                    ?>
                                    <td>
                                        <?php echo $department->name; ?>
                                    </td>      
                                    <td class="center no-print">
                                        <a href="<?php echo base_url("patients/profile/$bcm->patient_auto_id/opd") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <!--<a href="<?php echo base_url("laboratory/editbiochemical/$bcm->patient_auto_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("laboratory/deletebiochemical/$bcm->patient_auto_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> -->
                                    </td>                                     
                                </tr>
                                <?php $sl++;?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
            </div> 
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#patientdata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function excel_all_customer(date1,date2,section){ 
	   //alert(date1+" "+date2);
		window.location='excel_all_customer?date1='+date1+'&date2='+date2+'&section='+section;
	//	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
		// location.href='www.google.com';
	}
</script>