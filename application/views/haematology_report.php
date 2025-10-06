<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_haematology_patients')?>">
                                      
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
                                <select class="form-control" name="section" id="section">
                                <option value="opd">opd</option>
                                <option value="ipd">ipd</option>
                                </select>
                            
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
                    <?php 
                    if($section == 'ipd'){
                    ?>
                    <h2>Hamatological Investigation IPD</h2>
                    <?php } else { ?>
                    <h2>Hamatological Investigation OPD</h2>
                    <? } ?>
                </div>
            
            <div class="panel-body">
                <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                
                            <th rowspan='2'><?php echo "Sno" ?></th>
                            <th colspan='2' style="text-align:center;"><?php echo "OPD No" ?></th> 
                            <th rowspan='2'><?php echo "Name" ?></th>                            
                            <th rowspan='2'><?php echo "Test" ?></th>
                            <th rowspan='2'><?php echo "Sex" ?></th>
                            <th rowspan='2'><?php echo "Dignosis" ?></th>
                            <th rowspan='2'><?php echo "Department" ?></th>
                             <th rowspan='2'>Report</th>
                            <th rowspan='2' class="no-print"><?php echo display('action') ?></th>                         
                        </tr>
                        <tr>
                            <th style="widht:15%;">New</th>
                            <th style="widht:15%;">Old</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($haematology)) {
                   //     print_r($haematology);
                         // $test = $haematology->hematology;
                        ?>
                            <?php $sl = 1;
?>
                            <?php foreach ($haematology as $hm) {  ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <!-- <td><?php //echo $patient->patient_id; ?></td> // Yearly reg no -->
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $hm->yearly_reg_no; ?></td> 
                                    <td><?php echo $hm->old_reg_no; ?></td> 
                                    <td><?php
                                                                 if($section=='opd')
                                                                 { $table='patient'; }
                                                                 else 
                                                                 { $table='patient_ipd'; }                  
                                                                 $name = $this->db->select('*')->from($table)->where('id',$hm->patient_name)->get()->row();
                                                                 if($name)
                                                                 {
                                                                   echo $name->firstname;
                                                                 }else {
                                                                   echo $hm->patient_name; } ?>
                                                                  
                                      
                                      </td>
                                    <td><?php echo $hm->date_of_birth; ?></td> 
                                    <td><?php echo $hm->sex; ?></td>      
                                    <td><?php echo $hm->dignosis; ?></td>   
                                    <!--<td><?php echo $hm->patient_auto_id; ?></td>   -->
                                    
                                    <?php 
                                    $department = $this->db->select('*')
                                    ->where('dprt_id',$hm->department_id)
                                    ->get('department')
                                    ->row();
                                    ?>
                                    <td>
                                        <?php echo $department->name; ?>
                                    </td>  
                                      <td>
                                        <?php echo $hm->hematology; ?>
                                    </td>      
                                    <td class="center no-print">
                                        <a href="<?php echo base_url("patients/get_haematology_patient_profile/$hm->patient_auto_id/$section") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("patients/edit_report/$hm->patient_auto_id/$section") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <!--<a href="<?php echo base_url("laboratory/deletebiochemical/$hm->patient_auto_id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a>--> 
                                    </td>                                     
                                </tr>
                                <?php $sl++;?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table> 
                
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
                            $name_array=array('HEMATOLOGICAL'); 
                            $tot_array=array($investiResultCountTest->hematologyCount);
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
                    
                </table> 
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