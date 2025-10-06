<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

      <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/diet_sheet')?>">
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->
        <div class="form-group">
          <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
          <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
        </div>  
        <div class="form-group">
          <input type="text" name="section" class="form-control" id="section" value="ipd" readonly>
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
                    <h2>Diet Sheet Report</h2>
                </div>
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <div>
                    </div>
                </div>
            <div class="panel-body">
            <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                <thead>
                        <tr>                
                            <th>रुग्णाचे नाव :-</th>
                            <th><?php echo $patients->firstname; ?></th> 
                            <th>वय :-</th> 
                            <th><?php echo $patients->date_of_birth; ?></th>
                            <th>लिंग :-</th> 
                            <th><?php echo $patients->sex; ?></th> 
                      </tr>
                      <tr>                
                            <th>पत्ता :-</th>
                            <th colspan='5'><?php echo $patients->address; ?></th> 
                      </tr>
                      <tr>                
                            <th>आयपीडि /ओपिडी नंबर  :-</th>
                            <th><?php echo $patients->yearly_reg_no; ?></th> 
                            <th>बेड नंबर  :-</th> 
                            <th><?php echo $patients->bedNo; ?></th>
                            <th>रोग निदान  :-</th> 
                            <th><?php echo $patients->dignosis; ?></th> 
                      </tr>
            </table>

                <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                
                            <th rowspan='2'><?php echo "दिनांक" ?></th>
                            <th rowspan='2' style="text-align:center;"><?php echo "आहारचा प्रकार" ?></th> 
                            <th colspan='3' style="text-align:center;"><?php echo "वेळ" ?></th> 
                            <th rowspan='2'><?php echo "एकूण आहार " ?></th> 
                      </tr>
                      <tr>
                            <th>सकाळ</th>
                            <th>दुपार</th>
                            <th>संध्याकाळ</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?//php if (!empty($patients)) {
                  
                        ?>
                            <?php 
  
                            $sl = 1;
                            $year = $this->session->userdata('acyear');
                            $Year = substr($year,2,2);
                            ?>
                            <?//php foreach ($patients as $bcm) { 


                                $patient_ahar = $this->db->select('*')->from('patient')->where('yearly_reg_no',$patients->yearly_reg_no)
                                ->where('year(create_date)',$year)->get()->row();

                            if($patients->discharge_date == '0000-00-00') {
                                $dd = date("Y-m-d");
                            } else {
                                $dd = $patients->discharge_date;
                            }




                            $admit_date = $patients->create_date;
                            $discharge_date = $dd;

                            $start_date = $admit_date;
                            $end_date = $discharge_date;
                            $start_date_obj = new DateTime($start_date);
                            $end_date_obj = new DateTime($end_date);
                            $dates_between = array();

                            // Calculate the dates between admit date and discharge date
                            while ($start_date_obj <= $end_date_obj) {
                                $dates_between[] = $start_date_obj->format('Y-m-d');
                                $start_date_obj->modify('+1 day');
                            }



                            // Iterate over the dates and display information in a table row for each date
                            foreach($dates_between as $date) {
                        ?>


        <tr>
          <td rowspan="3"><?php echo date("d-m-Y",strtotime($date)); ?></td>
          <td>नास्टा</td>
          <td><i class="fa fa-check-square-o" aria-hidden="true"></i> </td>
          <td></td>
          <td></td>
          <td><?php echo $patient_ahar->ahar; ?></td>
        </tr>
        <tr>
            
            <td>पूर्णआहार</td>
            <td></td>
            <td><i class="fa fa-check-square-o" aria-hidden="true"></i></td>
            <td></td>
            <td><?php echo $patient_ahar->ahar; ?></td>
          </tr>
          <tr>
            
            <td>पूर्णआहार</td>
            <td></td>
            <td></td>
            <td><i class="fa fa-check-square-o" aria-hidden="true"></i></td>
            <td><?php echo $patient_ahar->ahar; ?></td>
          </tr>
       
                                                   <?php 
                                $sl++;
                            } 
                      //  } 
                        ?>

                        <?//php } ?> 
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