<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?//php  echo error_reporting(0); ?>
<div class="row">
    <!--  table area -->
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
                <div class="panel-body" style="font-size: 11px;">
              <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
 
 
                    <hr style="border: 1px solid black; background-color:black;">
                    <h5>MONTHWISE <?php if($section=='opd') { echo "D-OPD"; }  else if($section=='ipd'){ echo "D-IPD";} else { echo "BED OCCUPANCY";}?> REPORT</h5>  
                </div>
                <div class="col-xs-2"></div>
                </div>
                </div>
                <div class="col-sm-12" align="center" style="margin-top:20px;">
                    <div class="col-sm-6" align="left">
                        <div style='display: inline-block;' align='left'><strong>( Main Hospital )</strong></div>
                    </div>
                    <div class="col-sm-6" align="right">
                        <?php 
                            $year = $this->session->userdata['acyear'];
                            $date_from = $year.'-01-01';
                            $date_to = $year.'-12-31';
                        ?>
                        <div style='display: inline-block;' align='right'><strong>From: <?php echo date('d-M-Y', strtotime($date_from)); ?> To: <?php echo date('d-M-Y', strtotime($date_to)); ?></strong></div>
                    </div>
                </div>
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover" style="font-family: initial;">
                    <thead>
                        <tr>
                            <th style="width: 30px;"><?php echo "S.No" ?></th>
                            <th style="width: 124px;"><?php echo "Name" ?></th> 
                            <th style="width: 30px;">Jan</th> 
                            <th style="width: 30px;">Feb</th>
                            <th style="width: 30px;">March</th>
                            <th style="width: 30px;">April</th> 
                            <th style="width: 30px;">May</th>
                            <th style="width: 30px;">June</th>
                             <th style="width: 30px;">July</th> 
                            <th style="width: 30px;">Aug</th>
                            <th style="width: 30px;">Sept</th>
                            <th style="width: 30px;">Oct</th> 
                            <th style="width: 30px;">Nov</th>
                            <th style="width: 30px;">Dec</th>
                            <th style="width: 30px;">Grand Total</th>                      
                         </tr>
                       
                    </thead>
                    <tbody>
                        <?php
                            $jan1=0; $feb1=0; $march1=0;$april1=0;$may1=0;$june1=0;
                            $jully1=0; $aguest1=0;$sebt1=0;$octo1=0;$nove1=0;$desm1=0; 
                            $tot_sum=0; $tot_sum1=0; $sr_no=1;
                            
                            for($i=0;$i<count($department);$i++) { 
                        ?>
                                <tr class="even gradeC"  style="color: #4dd208;font-weight: bold;">
                                    <td style="padding:2px; color: #2f323a; width:90px;"><?php echo $sr_no++; ?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $department[$i]->name; ?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $jan[$i]; $jan1+=$jan[$i];  $tot_sum+=$jan[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $feb[$i]; $feb1+=$feb[$i]; $tot_sum+=$feb[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $march[$i]; $march1+=$march[$i]; $tot_sum+=$march[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $april[$i]; $april1+=$april[$i]; $tot_sum+=$april[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $may[$i]; $may1+=$may[$i]; $tot_sum+=$may[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $june[$i]; $june1+=$june[$i]; $tot_sum+=$june[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $jully[$i]; $jully1+=$jully[$i]; $tot_sum+=$jully[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $aguest[$i]; $aguest1+=$aguest[$i]; $tot_sum+=$aguest[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $sebt[$i]; $sebt1+=$sebt[$i]; $tot_sum+=$sebt[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $octo[$i]; $octo1+=$octo[$i]; $tot_sum+=$octo[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $nove[$i]; $nove1+=$nove[$i]; $tot_sum+=$nove[$i];?></td>
                                    <td style="padding:2px; color: #2f323a;"><?php echo $desm[$i];  $desm1+=$desm[$i]; $tot_sum+=$desm[$i];?></td>
                                    
                                    <td  style="padding:2px; color: #2f323a;"><?php echo $tot_sum; $tot_sum=0; ?></td>
                                </tr>
                        <?php
                            }
                        ?>
                        <tr class="even gradeC"  style="color: #4dd208;font-weight: bold;">
                            <td style="padding:2px; color: #2f323a;" colspan="2"><?php echo "Grand Total"; ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($jan); $tot_sum1+=array_sum($jan);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($feb); $tot_sum1+=array_sum($feb);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($march); $tot_sum1+=array_sum($march);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($april); $tot_sum1+=array_sum($april);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($may); $tot_sum1+=array_sum($may);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($june); $tot_sum1+=array_sum($june);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($jully); $tot_sum1+=array_sum($jully);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($aguest); $tot_sum1+=array_sum($aguest);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($sebt); $tot_sum1+=array_sum($sebt);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($octo); $tot_sum1+=array_sum($octo);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($nove); $tot_sum1+=array_sum($nove);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php echo array_sum($desm); $tot_sum1+=array_sum($desm);?></td>
                            <td style="padding:2px; color: #2f323a;"><?php $tot_sum; echo $tot_sum1?></td>
                        </tr>
                        
                        <?php if($month_bed=='month_bed'){ ?>
                        <?php $totalBedCount = $this->db->get('beds')->num_rows(); ?>
                        <tr class="even gradeC"  style="color: #4dd208;font-weight: bold;">
                            <?php
                                function getMonthOccupancy($year, $month, $monthCount, $totalBedCount){
                                    $fromDate = $year.'-'.$month.'-01';
                                    $toDate = date("Y-m-t", strtotime($fromDate));
                                    $date1=date_create($fromDate);
                                    $date2=date_create($toDate);
                                    $diff=date_diff($date1,$date2); 
                                    $days = $diff->format("%a")+1;
                                    $totalBedOccupancy=number_format(($monthCount * 100)/($totalBedCount * $days),2);
                                    echo $totalBedOccupancy.'%';
                                }
                            ?>
                            <td style="padding:2px; color: #2f323a;" colspan="2">Monthly Average Bed Occupancy (In Percentage)</td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '01', array_sum($jan), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '02', array_sum($feb), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '03', array_sum($march), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '04', array_sum($april), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '05', array_sum($may), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '06', array_sum($june), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '07', array_sum($jully), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '08', array_sum($aguest), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '09', array_sum($sebt), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '10', array_sum($octo), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '11', array_sum($nove), $totalBedCount); ?></td>
                            <td style="padding:2px; color: #2f323a;"><?php getMonthOccupancy($year, '12', array_sum($desm), $totalBedCount); ?></td>
                            
                        </tr>
                        <tr style="font-weight: bold;">
                            <?php
                                $checkLastPatient = $this->db->where('year(create_date)',$year)->order_by('id','desc')->limit(1)->get('patient_ipd')->row();
                                $date1=date_create($date_from);
                                $date2=date_create($checkLastPatient->create_date);
                                $diff=date_diff($date1,$date2);
                                $days = $diff->format("%a")+1;
                                $totalBedOccupancy=number_format(($tot_sum1 * 100)/($totalBedCount * $days),2);
                            ?>
                            <th colspan="15" style='text-align: center;'>Average Bed Occupancy (In Percentage) : <?php echo $totalBedOccupancy.'%';?></th>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>  <!-- /.table-responsive -->
                
                
                <!-- Table Summery -->
                <!--<?//php if($month_bed=='month_bed'){?>-->
                <?//php 
                    // $acyear = $this->session->userdata('acyear'); 
                    // if($acyear == 2020){
                    //     $TT=($tot_sum1*100)/(100*365);
                    // }
                    // elseif($acyear == 2021){
                    //     $TT=($tot_sum1*100)/(100*300);
                    // }
                //?>
               <!-- <p style="color: black;font-weight: bold;background-color: burlywood;"><?//php echo "  Bed Occupancy in Percentage:  ".number_format($TT,2)."%";?></p>-->
               <!--<?//php }?>-->
                
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
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#patientdata tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
