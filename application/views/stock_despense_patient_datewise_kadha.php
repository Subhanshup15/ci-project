<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<style>
div.scrollmenu 
{
  background-color: #fff;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}
</style>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php  echo base_url('stock/patient_report_datewise_kadha'); ?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>
   <input type="hidden" name="dept_id" class="form-control " id="dept_id" value="<?php if($department_id) { echo $department_id; } else { echo $dept_id; }; ?>">
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
                <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" id="hideshow"><i class="fa fa-print"></i></button> 
            </div>
            <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("patients/create") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_patient') ?> </a>  
                </div>  
                 <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>  
        </div>
        <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-12" align="center">  
              <div class="scrollmenu">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <?php // $tablets = $this->db->get('pharma1')->result();
  				$tablets = $this->db->select('*')->from('pharma1_kadha_oil')->get()->result(); 
                       
  
                    foreach($tablets as $tab){ ?>
                    <th><?php
                    
                    //$a = explode(" ",$tab->name);
                    
                    $words = explode(' ', $tab->name);
                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];

                    ?></th>
                    <?php } ?>
                    <!--<th>Action</th>-->
                </tr>
                <?php 
                $i = 1;
                foreach($patient as $patient){
                    
                    
                   $name = $patient->name;
                  $date = $datefrom;
                   if($section == 'opd')
                   {
                   $test = $this->db->select('*')
                    ->from('kadha_daily_opd_patient')
                    ->where('name ',$name)
                    ->where('create_date',$date)
                    ->get()
                    ->result();
                   }else
                   {
                     $test = $this->db->select('DISTINCT(RX1),RX1_despense,DRX_despense,name,DRX')
                    ->from('kadha_daily_ipd_patient')
                   // ->where('discharge_date >=',$date)
                    ->where('name ',$name)
                   	->where('push_date >=',$date)
                    ->where('push_date <=',$date)
                  //  ->or_where('discharge_date',$date)
                    ->get()
                    ->result();
                  //  print_r($this->db->last_query());
                   }
                    // print_r($this->db->last_query());
                    // echo "<br>";
                   
                    
               if($patient->RX1_despense != '0')
               {
                
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $patient->name; ?></td>
                    <?php foreach($tablets as $tab) { ?>
                    <td>
                        <?php foreach($test as $t){ ?>
                      
                        <?php if(stripos($t->RX1, $tab->name) !== false){ ?>
                      <?php if($section == 'opd'){ ?>
                      <b><a style='color:red;'  href="<?php echo base_url("patients/profile/$patient->patient_auto_id") ?>"><?php echo $total = $t->RX1_despense; ?></a></b>
                     <?php } else { ?>
                      <b><a class="no-print withhref" id="withhref" style='color:red;' href="<?php echo base_url("patients/ipdprofile/$patient->patient_auto_id") ?>">
                        <?php 
                  if(stripos($t->DRX, $tab->name) !== false && (stripos($t->RX1, $tab->name) !== false))
                     	{ 
                        	 		$total = $t->RX1_despense;
                                    $total1 = $t->DRX_despense;
                                    $main = $total + $total1;
                                   echo '<button class="btn-primary">'.$total1.'</button>';
                         } 
                         else
                		 { 
                             echo $t->RX1_despense; 
                		 } 
                            
                        ?>
                       </a>
                      </b>
					<?php } ?>
                      
                        <?php }  ?>
                        <?php }  ?>
                    </td>
                    <?php  } ?>
                    <!--<td>Grand Total</td>-->
                    <!--<td></td>-->
                </tr>
                <?php } 
                    }
                 ?>
                <tr>
                    <td colspan='2'>Grand Total</td>
                <?php
                   $total = 0;
                foreach($tablets as $tab) 
                { 
                  $total = 0;
                 $date = $datefrom;
                if($section == 'ipd')
                {
                //  $table_name = 'pharma_daily_ipd_patient';
                  $testtab =  $this->db->select('SUM(RX1_despense) as SUM,tab_name,SUM(DRX_despense) as drx')
                    ->from('kadha_daily_ipd_patient')
                    ->where('tab_name',$tab->name)
                    ->where('push_date',$date)
                   // ->order_by('id','desc')
                    ->get()
                    ->result();
                }
                else
                {
                 	$testtab =  $this->db->select('SUM(RX1_despense) as SUM,tab_name')
                    ->from('kadha_daily_opd_patient')
                    ->where('tab_name',$tab->name)
                    ->where('create_date',$date)
                   // ->order_by('id','desc')
                    ->get()
                    ->result();     
                }
                   
                      
                ?>
                	<td style="color:red;">
                      <?php foreach($testtab as $tb)
                		{
                  		?>
                      <?php if(stripos($tab->name, $tb->tab_name) !== false) { ?>
                      <b>
                        <?php 
                       echo  $total = $tb->SUM + $tb->drx; 
                        ?>
                      </b>
                      
                      <?php } else { ?>
                      <b>
                        <?php 
                      		echo '0'; 
                        ?>
                      </b>
                      <?php }?>
                      <?php } ?>
                	</td>
                <?php  } ?>
                </tr>
            </table>
                </div>
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

