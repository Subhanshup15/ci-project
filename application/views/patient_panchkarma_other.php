<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <?php ini_set('memory_limit','-1');?>
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getOtherPanchkarma_register/'.$section); ?>">
            <div class="form-group">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
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
                            <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "D-IPD Karma Panch";} else {echo "IPD Other Procedure Register - ( STRIROGA ) ";} ?>  <?php if($name=='Swasthrakshnam'){ echo "(".$name." -KC)";} elseif($name){ echo"(".$name.")" ; }?></h3>
                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                        <?php }else{ ?>
                            <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php if($name) { echo "D-OPD Karma Panch ";} else {echo " OPD Other Procedure Register - ( STRIROGA )";}?>   <?php  if($name) {echo "(".$name.")";}?></h3>
                            <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Yearly No" ?></th>
                            <?php if($section == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                            <th style="width: 30px; text-align: center;" colspan="2" >
                                <?php echo "COPD" ?>
                            </th> 
                            <th style="width: 50px;" rowspan="2"><?php echo "Name" ?></th> 
                            <th style="width: 50px;" rowspan="2"><?php echo "Address" ?></th> 
                            <th style="width: 30px;" rowspan="2"><?php echo "Age" ?></th>    
                            <th rowspan="2"><?php echo display('sex') ?></th>   
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                            <th rowspan="2"><?php echo "Dignosis" ?></th>
                            <th rowspan="2"><?php echo "Date" ?></th>
                            <th rowspan="2"><?php echo "UTTARBASTI"?></th>
                            <th rowspan="2"><?php  echo "YONIDHAVAN"; ?></th>
                            <th rowspan="2"><?php  echo "YONIPICHU"; ?></th>
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
                       <?php foreach($panchResult as $key => $pr){ ?>
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
                            ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo ++$panchResultYearlyCount; ?></td>
                                <?php if($section == 'ipd'){ ?><td><?php echo ++$ipd_no; ?></td><?php } ?>
                                <td><?php echo ($patient->yearly_reg_no)?$patient->yearly_reg_no.'.'.$dot_year:''; ?></td>
                                <td><?php echo ($patient->old_reg_no)?$patient->old_reg_no.'.'.$dot_year:''; ?></td>
                                <td><?php echo $patient->firstname; ?></td>
                                 <td><?php echo $patient->address; ?></td>
                                <td><?php echo $patient->date_of_birth; ?></td>
                                <td><?php echo $patient->sex; ?></td>
                                <td><?php echo $patient->dignosis; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                                <td><?php echo $pr->uttarbasti; ?></td>
                                <td><?php echo $pr->yonidhavan; ?></td>
                                <td><?php echo $pr->yonipichu; ?></td>
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
                <!--<table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">-->
                <table width="100%" id="reportSummary" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>             
                            <th><?php echo "S. No" ?></th>
                            <th><?php echo "Name" ?></th>                            
                            <th><?php echo "Total" ?></th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 12141; 
                            
                            
                            $name_array=array('UTTARBASTI','YONIDHAVAN','YONIPICHU'); 

                            $years=$this->session->userdata['acyear'];
                            
                            $tot_array=array($panchResultCount->uttarbastiCount, $panchResultCount->yonidhavanCount, $panchResultCount->yonipichuCount);
                              
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
                                                <input type="text" id="yearly_reg_no" name="yearly_reg_no" class="form-control"  autocomplete="off" />
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

<!-- //Discharge Date -->
                   
                    <script>
						$(document).ready(function(){
							$("#dischargedate").click(function(){
								var yearly_reg_no = document.getElementById("yearly_reg_no").value;
								var discharge_date = document.getElementById("discharge_date").value;

                                //alert('Hi');

								$.ajax({
									url: "<?php echo base_url(); ?>patients/dischargedate/" + discharge_date + "/" + yearly_reg_no,
									method: "POST",
									//data: {"otp": otp},
									dataType: "json",
                                    data: {
                                        '<?= $this->security->get_csrf_token_name(); ?>' : '<?= $this->security->get_csrf_hash(); ?>'
                                    },

									success: function (data) {
										//alert();
                                        if(data != "1") {
											//document.getElementById('otp_message').innerHTML = "Otp confirm";
											window.location.reload();
										}
										
									}
                                    // window.location.reload();
								});
								//alert();
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
</script>