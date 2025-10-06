<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('dashboard_receptionist/patient/patient/patient_by_date')?>">
                                      
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
 
            <div class="panel-heading no-print row">
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("dashboard_receptionist/patient/patient/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>

                              

                <?php   
                               $ipd = ($patients[0]->ipd_opd);
                                
                                if($ipd == 'ipd'){ ?>
                                    <div class="btn-group col-md-2"> 
                                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                                        </div> 
                              <?php }  ?>


            </div>


            <div class="panel-body">
                <table width="100%" id="patientdata" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                

                            <th><?php echo "Reg. No" ?></th>
                            <th><?php echo "Yearly No" ?></th>                            
                            <th><?php echo "Daily No" ?></th>
                            <th><?php echo "Monthly No" ?></th>
                            <th><?php echo "Old No" ?></th>
                            <th><?php echo "Patient Name" ?></th>   
                            <th><?php echo display('sex') ?></th>   
                            <th><?php echo "Age" ?></th>                  
                            <th><?php echo display('address') ?></th>
                            <th><?php echo "Department" ?></th>
                            <th><?php echo "Admit Date"?></th>                            
                            <?php   
                                
                               $ipd = ($patients[0]->ipd_opd);
                                
                               if($ipd == 'ipd'){ ?>                                 
                                        
                                        <th><?php echo "Discharge Date"?></th>
                                        

                                   
                              <?php  }  ?>
                            <th><?php echo display('action') ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;

?>
                            <?php $i = 0; foreach ($patients as $patient) { $i++; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <!-- <td><?php //echo $patient->patient_id; ?></td> // Yearly reg no -->
                                    <td><?php echo $patient->yearly_no; ?></td>
                                    <td><?php echo $patient->yearly_reg_no ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $patient->daily_reg_no; ?></td>
                                    <td><?php echo $patient->monthly_reg_no; ?></td> 
                                    <td><?php echo $patient->old_reg_no; ?></td> <!-- //old patient no -->
                                    <td><?php echo $patient->firstname; ?></td>        
                                    <td><?php echo $patient->sex; ?></td>
                                    <td><?php 
                                    echo $patient->date_of_birth;   
                                    ?></td> 
                                    <td><?php echo $patient->address; ?></td>  
                                    <td><?php echo $patient->name; ?></td> 
                                    <td><?php echo date("d/m/Y", strtotime($patient->create_date)) ?></td> 
                                    <?php                       
                                        if($patient->ipd_opd == 'ipd'){ ?>                                   
                                                <th><?php echo date("d/m/Y", strtotime($patient->discharge_date)); ?></th>                                            
                                        <?php }   ?>
                                    <td class="center">
                                        <a href="<?php echo base_url("dashboard_receptionist/patient/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php echo base_url("dashboard_receptionist/patient/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("dashboard_receptionist/patient/$patient->ipd_opd/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
                                    </td>                                     
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<!-- OTP Submission -->
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog" >
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add patient discharge date</h4>
                                </div>
								<?php ?>
                                <div class="modal-body">
                                    <div class="row">

                                        <form id="otp_confirm_form" name="otp_confirm_form" method="POST">
                                            <div class="col-xs-12">
                                                <label>Enter patient reg no</label>
                                                <input type="text" id="yearly_no" name="yearly_no" class="form-control"  autocomplete="off" />
												<div id="error_otp"></div>
                                            </div>

                                            <div class="col-xs-12">
                                                <label>Discharge Date</label>
                                                <input type="text" id="discharge_date" name="discharge_date" class="form-control datepicker"  autocomplete="off" />
												<div id="error_otp"></div>
                                            </div>



                                            <div class="col-xs-12" style="margin-top: 20px">
                                                <button type="button" name="dischargedate" class="btn btn-primary" value="dischargedate" id="dischargedate">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>


<script>

$(document).ready(function(){
  $('#btn_excel_download').click(function(){
			"processing": true,
            "serverSide": true,		
        "ajax":{
            "url": "<?php echo base_url('dashboard_receptionist/patient/patientList/opd')?>",
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

<!-- //Discharge Date -->
<script>
						$(document).ready(function(){
							$("#dischargedate").click(function(){
								var yearly_no = document.getElementById("yearly_no").value;
								var discharge_date = document.getElementById("discharge_date").value;

								$.ajax({
									url: "<?php echo base_url(); ?>dashboard_receptionist/patient/patient/dischargedate/" + discharge_date + "/" + yearly_no,
									method: "POST",
									//data: {"otp": otp},
									dataType: "json",
                                    data: {
                                        '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>'
                                    },

									success: function (data) {
										//alert();
										if(data == "0") {
											window.location.reload();
										}
										else
										{
											document.getElementById('error_otp').innerHTML = "Patient not valid";
										}
									}
								});
								//alert();
							});
						});
					</script>



