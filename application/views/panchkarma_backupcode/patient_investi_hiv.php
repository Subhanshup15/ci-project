<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<?php ini_set('memory_limit', '-1');?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getHivReport'); ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php echo $department_id; ?>">
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

                <!--<div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>              
-->
                <?php   
                               $ipd = ($patients[0]->ipd_opd);
                                
                                if($ipd == 'ipd'){ ?>
                                <!--    <div class="btn-group col-md-2"> 
                                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                                        </div> -->
                              <?php }  ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
             <div class="col-sm-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:100px; weight:100px;" />
	          	 </div> 
            <div class="col-sm-8" align="left">  
                   <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                    
 
                
                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php echo "HIV REGISTER"; ?></h3>
                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
            </div>
            <div class="col-sm-2"></div>
          
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="display:  <?php  if($summery_report == 1) { echo "none";}?>">
                    <thead>
                        <tr>
                            <th style="width: 30px;"><?php echo "S.No" ?></th>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;"><?php echo "COPD" ?></th> 
                            
                           
                            <th><?php echo "Name of Patient" ?></th> 
                            <th style="width: 30px;"><?php echo display('address') ?></th>
                           <th style="width: 30px;"><?php echo "Department" ?></th>
                             <th style="width: 30px;"><?php echo "Sex"; ?></th>
                              <th style="width: 30px;"><?php echo "Age"; ?></th>
                            <th style="width: 30px;"><?php echo "Dignosis"; ?></th>
                            <th><?php echo 'Date' ?></th> 
                            <th class="no-print"><?php echo display('action') ?></th> 
                                                  
                         </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;?>
                        <?php foreach($patientList as $patient){ ?>
                            <?php
                                if($section == 'opd'){
                                    $che=trim($patient->dignosis);
                                    //print_r($che);
                                    $section_tret='opd';
                                    $len=strlen($che);
                                    $dd= substr($che,$len - 1);
                                    $str = $patient->dignosis;
                                    $arry=explode("-",$str);
                                    $t_c=count($arry);
                                    if($t_c=='2'){
                                        $dd1=substr($che, 0, -1);
                                        $new_str = trim($arry[0]);
                                        $p_dignosis = '%'.$new_str.'%';
                                        $p_dignosis_name=$patient->dignosis;
                                    }else{
                                        $p_dignosis = '%'.$che.'%';
                                        $p_dignosis_name=$patient->dignosis;
                                    }   
                                }
                                else{
                                    $che=trim($patient->dignosis);
                                    //print_r($che);
                                    
                                    $section_tret='ipd';
                                    $len=strlen($che);
                                    $dd= substr($che,$len - 1);
                                    
                                    $str = $patient->dignosis;
                                    $arry=explode("-",$str);
                                    $t_c=count($arry);
                                    if($t_c=='2'){
                                        $dd1=substr($che, 0, -1);
                                        $new_str = trim($arry[0]);
                                        $p_dignosis = '%'.$new_str.'%';
                                        $p_dignosis_name=$patient->dignosis;
                                    }else{
                                        $p_dignosis = '%'.$che.'%';
                                        $p_dignosis_name=$patient->dignosis;
                                    }
                                }
                    
                                if($patient->manual_status==0){
                                    if($patient->proxy_id){
                                        $tretment=$this->db->select("*")
                                            ->from('treatments1')
                                            ->where('dignosis LIKE',$p_dignosis)
                                            //->where('dignosis LIKE',$p_dignosis_name)
                                            ->where('proxy_id',$patient->proxy_id)
                                            ->where('department_id',$patient->department_id)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();
                                    }
                                    else{
                                        $tretment=$this->db->select("*")
                                            ->from('treatments1')
                                            ->where('dignosis LIKE',$p_dignosis)
                                            ->where('department_id',$patient->department_id)
                                            ->where('ipd_opd ',$section_tret)
                                            ->get()
                                            ->row();  
                                    } 
                                }else{
                                    $tretment=$this->db->select("*")
                                        ->from('manual_treatments')
                                        ->where('patient_id_auto',$patient->id)
                                        ->where('dignosis LIKE',$p_dignosis)
                                        //->where('dignosis LIKE',$p_dignosis_name)
                                        ->where('ipd_opd ',$section_tret)
                                        ->get()
                                        ->row();
                                }
                                
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
                                $ipd_no = $num_ipd_change;
                                $ipd_no++;
                                
                                $date=date('Y',strtotime($patient->create_date));
                                $dot_year=substr($date,2);
                            
                            ?>
                            <?php if($tretment){ ?>
                                <?php if($tretment->SEROLOGYCAL){ ?>
                                <?//print_r($patient->firstname)?>
                                <?//print_r($tretment->SEROLOGYCAL)?>
                                    <?php if(stripos($tretment->SEROLOGYCAL, 'HIV') !== false){?>
                                        <tr>
                                            <td><?php echo $i = $i+1; ?></td>
                                            <?php if($section == 'ipd'){ ?>
                                                <td><?php echo $ipd_no; ?></td>
                                            <?php } ?>
                                            <td><?php echo ($patient->yearly_reg_no)?$patient->yearly_reg_no.".".$dot_year." (New)" : $patient->old_reg_no.".".$dot_year." (Follow Up)"; ?></td>
                                            <td><?php echo $patient->firstname; ?></td>
                                            <td><?php echo $patient->address; ?></td>
                                            <?php $department_Name = $this->db->select('name')->where('dprt_id', $patient->department_id)->get('department')->row(); ?>
                                            <td><?php echo $department_Name->name; ?></td>
                                            <td><?php echo $patient->sex; ?></td>
                                            <td><?php echo $patient->date_of_birth; ?></td>
                                            <td><?php echo $patient->dignosis; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($patient->create_date)); ?></td> 
                                            <td class="center no-print"  style="padding:2px;">
                                                <?php if($patient->ipd_opd == 'ipd'){ ?>
                                                    <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <?php }else { ?>
                                                    <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                                <?php } ?>
                                            </td>    
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <!-- Table Summery -->
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

function excel_all_customer_invistigation(date1,date2,section){ 
	   //alert(date1+" "+date2);
		window.location='excel_all_customer_invistigation?date1='+date1+'&date2='+date2+'&section='+section;
	//	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
		// location.href='www.google.com';
	}
</script>
</script>