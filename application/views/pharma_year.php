<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<style>
    @media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "First Name"; }
	td:nth-of-type(2):before { content: "Last Name"; }
	td:nth-of-type(3):before { content: "Job Title"; }
	td:nth-of-type(4):before { content: "Favorite Color"; }
	td:nth-of-type(5):before { content: "Wars of Trek?"; }
	td:nth-of-type(6):before { content: "Secret Alias"; }
	td:nth-of-type(7):before { content: "Date of Birth"; }
	td:nth-of-type(8):before { content: "Dream Vacation City"; }
	td:nth-of-type(9):before { content: "GPA"; }
	td:nth-of-type(10):before { content: "Arbitrary Data"; }
}
#pagination{
margin: 40 40 0;
}
ul.tsc_pagination li a
{
border:solid 1px;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
padding-bottom:1px;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
color:#FFFFFF;
box-shadow:0px 1px #EDEDED;
-moz-box-shadow:0px 1px #EDEDED;
-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
margin:4px 0;
padding:0px;
height:100%;
overflow:hidden;
font:12px 'Tahoma';
list-style-type:none;
}
ul.tsc_pagination li
{
float:left;
margin:0px;
padding:0px;
margin-left:5px;
}
ul.tsc_pagination li a
{
color:black;
display:block;
text-decoration:none;
padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
border:none;
}
ul.tsc_pagination li a
{
color:#0A7EC5;
border-color:#8DC5E6;
background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
text-shadow:0px 1px #388DBE;
border-color:#3390CA;
background:#58B0E7;
background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}
</style>
<?php  echo error_reporting(0);?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php  echo base_url('patients/pharma_date_year/'.$pharmas.'/'.$department_by_section.'/0');  ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
 <input type="hidden" name="pharmas" class="form-control " id="pharmas" value="<?php echo $pharmas; ?>">
</div>  


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd" selected>opd</option>
         <option value="ipd" selected>ipd</option>
       
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

                <?php   
                               $ipd = $ipd;
                                
                                if($ipd == 'ipd'){ ?>
                                    <div class="btn-group col-md-2"> 
                                        <a id="otpconfirm" name="Otp_Confirm" data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary pull-right"> Add Discharge Date </a>
                                        </div> 
                              <?php }  ?>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-12" align="center">  
                   <strong><?php echo $this->session->userdata('title') ?></strong>
                  <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
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
                           
                               $ipd= $ipd;
                                
                                
                             $dbHost = "localhost";
                        $dbDatabase = "srpayurved_db";
                        $dbPasswrod = "gJXdRod3AOlyp4c9";
                        $dbUser = "srpayurved_db";
                        $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
                        $mysqli -> character_set_name();
                        // Change character set to utf8
                         $mysqli -> set_charset("utf8");
                         
                          $datefrom1=date('Y-m-d',strtotime($datefrom));
                         $datefrom1_like='%'.$datefrom1.'%';
                        
                          if($pharmas =='churna'){
                               $status='1';
                          }else {
                             $status='2';
                          }
                    
                     $previos_date = "SELECT * FROM pharma1_daily WHERE status ='$status'  ORDER BY id DESC";     
                     $previos_date1 = $mysqli->query($previos_date);
	                 //$previos_date12=$previos_date1->fetch_array(MYSQLI_ASSOC);
	                 $previos_date12=mysqli_fetch_assoc($previos_date1);
                     $previos_date122=$previos_date12['daily_date'];
                     
                     
                          
                    $check_number = "SELECT * FROM pharma1_daily WHERE  daily_date LIKE  '$datefrom1_like'";
	                $check_number_q = $mysqli->query($check_number);
	                // $check_number_result=$check_number_q->num_rows;
                      if($start==1){
                        $check_number_result=1;  
                     } else{
                          $check_number_result=$check_number_q->num_rows;
                     }               
                               ?>
                   <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php  if($pharmas=='churna') { echo 'Pharma Yearly Report';} else if($pharmas=='tablet') { echo 'Tablet Register';} else{ echo $pharmas."-".$department_by_section." Register";}?></h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>     
                
                        
                         
                         
                </div>
              
                <div class="row col-sm-12" style="padding-bottom: 10px;font-size: 14px;">
                      <?php if($this->session->userdata('status')==0){?>
                    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/checked_data'); ?>">
                  <!--  <form  method="POST" action="<?php echo base_url('patients/checked_data'); ?>" >-->
                    <div class="col-md-2" style="padding-top: 5px;">    
                    <input type="radio" name="check" value="0" <?php if((empty($check_data)) || ($check_data[0]->check_date==0)) { echo "checked";}?>>Unchecked 
                    <input type="radio" name="check" value="1"  <?php if((!empty($check_data)) && ($check_data[0]->check_date == 1)) { echo "checked";}?>>checked
                      </div>
                     <div class="col-md-2">
                    <input type="date" name="start_date1" class="form-control" id="start_date1" style="width:155px; margin-left: -21px;">
                    <input type="hidden" name="section" value="<?php if(($this->uri->segment(2) =='opd') || ($this->uri->segment(2)=='ipd')){ echo $this->uri->segment(2);} else { echo $_GET['section'];} ?>">
                    </div>
                    <div class="col-md-2">
                    <input type="submit" name="submit" class="btn btn-default active" value="Save" style="margin-left: -41px;">
                    </div>
                    </form>
                     <?php } ?>
                    <div style="float: right; padding-top: 5px;" >
                    <span style="color: white;background-color: dodgerblue;font-weight: 600;">  </span>
                    </div>
              
              
                
                
                
 

<div class="table-responsive">
   
  <table class="table table-bordered table-hover">
    <tr>
      
        <th style="width:30px;">Name</th>
        <?php 
                                     //$date=date('Y',strtotime($patient->create_date));
                                   // $dot_year=substr($date,2);
                                  //   $explode=explode('.',$patient->old_reg_no);
			                       //print_r($import);
                                  //  $explode[1];
                                     ?>
                                   
       
       
       <?php $m=0;foreach($patients__date as $pharmass){ $m++;
	   if($m==1) { $Month_name='Jan';} else if($m==2) { $Month_name='Feb';} else if($m==3) { $Month_name='Mar';} else if($m==4) { $Month_name='Apr';}
	   else if($m==5) { $Month_name='May';} else if($m==6) { $Month_name='Jun';} else if($m==7) { $Month_name='Jul';} else if($m==8) { $Month_name='Aug';}
	   else if($m==9) { $Month_name='Sep';} else if($m==10) { $Month_name='Oct';} else if($m==11) { $Month_name='Nov';} else if($m==12) { $Month_name='Dec';} else {
		    $Month_name="-";
	   }
	   ?>
        <th ><?php  echo $Month_name; //echo implode('<br>',str_split(strrev($pharmass->daily_date))); ?></th>
       <?php }?>
        <th ><?php echo "requisite"; ?></th>
        <th ><?php echo "Closing"; ?></th>
       
      
    </tr>
    <?php 
    
    $ASHWAGANDHA=0;$SITOPALADI=0;$GANDHARVAHAREETAKI=0;$BALA=0;$KIRAT_TIKTA	=0;$HINGVASHTAK=0; 
    $i=0;$n=0;foreach ($pharma as $pharma1) { $i++;
    ?><tr>
       
       <td><?php echo $pharma1->name;?></td>
    <?php     
    
    
    
        $dateee=$this->db->select("COUNT(*),sum(daily_use) as tot")

		->from('pharma1_daily')
		
        ->where ('daily_date >=', $datefrom)
		->where('daily_date <=', $dateto)
        ->where('name =', $pharma1->name)
	
        ->group_by('month_flag')
		->get()
        ->result();
  
       ?>
      <?php for($i=0;$i<count($dateee);$i++) {  //$n_d= $patients__date[$i]->daily_date;?>
       <td><?php echo $dateee[$i]->tot;?></td>
       <?php }?>
        <td><?php echo $pharma_req[$n]->req; ?></td>
        <td><?php echo $pharma_close[$n]->opening_bal; $n++?></td>
    </tr>
    
   <?php  }  ?>
  </table>
</div>



               
              
                          
              
               
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

function excel_all_customer(date1,date2,section){ 
	   //alert(date1+" "+date2);
		window.location='excel_all_customer?date1='+date1+'&date2='+date2+'&section='+section;
	//	 redirect('patients/excel_all_customer/'+date1+'/'+date2);
		// location.href='www.google.com';
	}
</script>