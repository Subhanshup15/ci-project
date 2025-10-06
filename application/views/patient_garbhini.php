<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<!--<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientby_investigation_date'); ?>">
                                      
        


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



</form>-->
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

                <?php   
                               $ipd = ($patients[0]->ipd_opd);
                                
                                if($ipd == 'ipd'){ ?>
                                    <div class="btn-group col-md-2"> 
                                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                                        </div> 
                              <?php }  ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body">
           <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
 
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
                               $ipd = ($patients[0]->ipd_opd);
                           ?>     
                               
                        <h3 style="margin-top: 0px; margin-bottom: 15px;">Delivery Register</h3>
                        <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo '01-01-'.$this->session->userdata['acyear'];  ?>   To  <?php echo '31-12-'.$this->session->userdata['acyear']; ?> </h4>
                  
                  
                          <?php  if($ipd == 'ipd') {?>
                          <span style="float:right;background-color: #4dd208;padding: 2px;">Discharge</span>
                          <span style="float:right;background-color: #ff000d;padding: 2px;">Admit</span>
                         <?php }
                         if(!empty($department_id)){
                         $doctor_name1= $this->db->select("*")
                                    ->from('user')
			                       ->where('department_id', $department_id) 
                                    ->get()
                                    ->row();
                         if(!empty($doctor_name1->firstname)){ ?>
                         <lable style="float: right;">Doctor Name: <?php echo"<span style='font-weight: 600;'>".$doctor_name1->firstname."</span>"; ?></lable>
                         <?php } } ?>
                         
                         
                </div>
                 <div class="col-xs-2"></div>
                 </div>
                 </div>
               <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <?php if($ipd == 'ipd'){ ?><th style="width: 30px;" rowspan="2"><?php echo "CIPD No" ?></th><?php } ?>   
                                                                                                     
                           
                            <th style="width: 30px; text-align: center;" colspan="2" >
                            
                                <?php echo "COPD" ?>
                            </th> 
                            
                           
                            <th rowspan="2" style="width: 240px;"><?php echo "Name" ?></th> 
                             
                            <!--<th rowspan="2"><?php echo display('sex') ?></th> -->  
                            <th style="width: 30px;" rowspan="2"><?php echo "Age" ?></th>         
                           
                            
                           
							<th style="width: 30px;" rowspan="2"><?php echo "Treatment" ?></th>
							<th style="width: 30px;" rowspan="2">Date</th> 
                            <th style="width: 96px;" rowspan="2">Doctor</th>
                            <th style="width: 30px;" rowspan="2"><?php echo "Investigation"?></th>
                            
                           
                           
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
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 12141;
                           
                        
                       
                       
                   
                           
                          
?>
                            <?php  $array_patho1= array(); $array_patho2= array(); $array_patho3= array(); 
                                   $array_xray= array(); $array_ecg= array(); 
                                  $m=1; $i = 0; foreach ($patients as $patient) { $i++; 
                            
                                  $date_c=date('Y-m-d',strtotime($patient->create_date));
                                  $date_d=date('Y-m-d',strtotime($patient->discharge_date));
                                  $date_f= date('Y-m-d', strtotime($dateto));
                                  $tot_serial--;
                                   
                                    if($ipd == 'ipd'){ 
                                         $che=trim($patient->dignosis);
                                        $section_tret='ipd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $patient->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                         
                                        if($t_c=='2'){
                                           $dd1=substr($che, 0, -1);
                                            $p_dignosis = '%'.$arry[0].'%';
                                             trim($p_dignosis);
                                             $p_dignosis_name=$patient->dignosis;
                                      }else{
                                          
                                          $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                            
                                      }
                                       
                                    }
                                    else{
                                         $section_tret='opd';
                                          $che=trim($patient->dignosis);
                                        $section_tret='opd';
                                         $len=strlen($che);
                                         $dd= substr($che,$len - 1);
                                         
                                         $str = $patient->dignosis;
                                         $arry=explode("-",$str);
                                         $t_c=count($arry);
                                          if($t_c=='2'){
                                                $dd1=substr($che, 0, -1);
                                                
                                            $p_dignosis = '%'.$arry[0].'%';
                                                         trim($p_dignosis);
                                             $p_dignosis_name=$patient->dignosis;
                                      }else{
                                           //echo $dd;
                                           
                                           $p_dignosis = '%'.$che.'%';
                                            $p_dignosis_name=$patient->dignosis;
                                            
                                            
                                      }
                                    }
                                    
                                  if($patient->manual_status==0){
                                     
                                      $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('proxy_id',$patient->proxy_id)
			                         ->where('department_id',$patient->department_id)
			                         ->where('ipd_opd',$section_tret)
                                     ->get()
                                     ->row();
                                  
                                     if(empty($tretment)){
                                     
                                     
                                     $tretment=$this->db->select("*")

			                         ->from('treatments1')

			                         //->where('dignosis LIKE',$p_dignosis)
			                         //->where('ipd_opd ',$section_tret)
			                          ->where('department_id',$patient->department_id)
			                          ->where('ipd_opd',$patient->department_id)
                                     ->get()
                                     ->row();
                                     }
                                  }else{
                                      $tretment=$this->db->select("*")

			                         ->from('manual_treatments')
                                     ->where('patient_id_auto',$patient->id)
			                         ->where('dignosis LIKE',$p_dignosis)
			                         ->where('ipd_opd ',$section_tret)
                                     ->get()
                                     ->row();
                                   }
                                    
								  
								  $RX1= $tretment->RX1;
			                      $RX2= $tretment->RX2;
			                      $RX3= $tretment->RX3;
			                      
			                      $HEMATOLOGICAL= $tretment->HEMATOLOGICAL; 
			                      $SEROLOGYCAL= $tretment->SEROLOGYCAL;
			                      $BIOCHEMICAL= $tretment->BIOCHEMICAL;
			                      $MICROBIOLOGICAL =$tretment->MICROBIOLOGICAL;
			                      $X_RAY= $tretment->X_RAY;
								  $ECG= $tretment->ECG;
								  $USG= $tretment->USG;
								  
								  if(!empty($department_id)){
                                    $doctor_name1= $this->db->select("*")
                                    ->from('user')
			                       ->where('department_id', $department_id) 
                                    ->get()
                                    ->row();
                                    print_r($this->db->last_query());
                                    die();
								  }
			               
                              ?>
                              
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>" style="  <?php if(($date_c==$date_f) && ($ipd == 'ipd')){ echo "color: #ff000d;font-weight: bold;"; } else if(($date_d==$date_f) && ($ipd == 'ipd')) { echo "color: #4dd208;font-weight: bold;" ;} else { echo ""; } ?>">
                                    <td style="padding:2px;"><?php  echo $m++;?></td>
                                       
                                    <?php if($ipd == 'ipd'){ ?><td  style="padding:2px;"><?php  if($department_by_section=='ipd'){ echo $num_ipd--; } else{ echo $num_ipd++;} ?></td> <?php } ?>  
                                     <!-- //patient_id yearly sr no -->                                                                       
                                    
                                    <td  style="padding:2px;"><?php echo $patient->yearly_reg_no ?></td>
                                    <td  style="padding:2px;"><?php echo $patient->old_reg_no; ?></td> <!-- //old patient no -->
                                                                 
                                    
                                    
                                    <td style="width: 159px;"  style="padding:2px;"><?php echo $patient->firstname; ?></td>  
                                      
                                   <!-- <td  style="padding:2px;"><?php echo $patient->sex; ?></td>-->
                                    <td  style="padding:2px;"><?php echo $patient->date_of_birth; ?></td>
                                    <!-- <td><?php echo $patient->address; ?></td>   -->
                                   <!-- <td  style="padding:2px;"><?php echo $patient->dignosis; ?></td> -->
									 <td  style="padding:2px;"><?php echo $RX1.'<br>'.$RX2.'<br>'.$RX3; ?></td>
									  <td><?php echo date('Y-m-d',strtotime($patient->create_date)); ?></td>
									  <td style="width: 159px;"  style="padding:2px;"><?php echo $doctor_name1->firstname; ?></td>  
									<td  style="padding:2px;"><?php echo $HEMATOLOGICAL.'<br>'.$SEROLOGYCAL.'<br>'.$BIOCHEMICAL.'<br>'.$MICROBIOLOGICAL.'<br>'.$X_RAY.'<br>'.$ECG.'<br>'.$USG;?></td>

                                    <td class="center no-print"  style="padding:2px;">
                                        <?php 
                                            if($patient->ipd_opd == 'ipd'){ ?>
                                                <a href="<?php echo base_url("patients/ipdprofile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                
                                            <?php }else { ?>
                                                
                                                <a href="<?php echo base_url("patients/profile/$patient->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>      
                                            <?php } ?>
                                        <a href="<?php echo base_url("patients/edit/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php echo base_url("patients/delete/$patient->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
                                    </td>                                     
                                </tr>
                                <?php } $sl++; ?>
                            <?php } ?> 
                      
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