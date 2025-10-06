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
                    <h2>Diet Sheet Register</h2>
                </div>
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <div>
                        <b> Date : <?php echo date('d/m/Y',strtotime($datefrom)) ?></b>
                    </div>
                </div>
            
            <div class="panel-body">
                <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                
                            <th rowspan='2'><?php echo "Sno" ?></th>
                        <th rowspan='2' style="text-align:center;"><?php echo "COPD No" ?></th> 
                          <th rowspan='2' style="text-align:center;"><?php echo "CIPD No" ?></th> 
                        <th rowspan='2'><?php echo "Name" ?></th> 
                        <th rowspan='2'><?php echo "Age" ?></th> 
                        <th rowspan='2'><?php echo "Sex" ?></th>
                        <th rowspan='2'><?php echo "Address" ?></th>      
                                                 
                        <th rowspan='2'><?php echo "Department" ?></th> 
                         <th rowspan='2'><?php echo "DOA" ?></th>
                          <th rowspan='2'><?php echo "Bed" ?></th>  
                            <th rowspan='2'><?php echo "DOD" ?></th>  
                        <th rowspan='2'><?php echo "Dignosis" ?></th>        
                        <th rowspan='2'><?php echo "Diet" ?></th>        
                        <th class="no-print" rowspan="2" style="width: 81px;"><?php echo display('action') ?></th>                 
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
                            <?php foreach ($patients as $bcm) { 



                                // patient ipd yearly no
			                      $ipd_no_date=date('Y-m-d',strtotime($bcm->create_date));
                                  $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                  $year122=date('Y',strtotime($bcm->create_date));
                                  $year2='%'.$year122.'%';

                                  $this->db->select('*');
                                  $this->db->where('ipd_opd', 'ipd');
                                  $this->db->where('id <', $bcm->id);
                                 // $this->db->where('create_date <=', $d_ipd_no);
                                  $this->db->where('create_date LIKE', $year2);
                                  $query = $this->db->get('patient_ipd');
                                  $num_ipd_change = $query->num_rows();
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;


                                $patient_ahar = $this->db->select('*')
                                    ->from('patient')
                                    ->where('yearly_reg_no',$bcm->yearly_reg_no)
                                    ->where('year(create_date)',$year)
                                    ->get()
                                    ->row();

                              
                      
                      ?>

                      <?php
                         $dept_name=$this->db->select("*")->from('department')->where('dprt_id',$bcm->department_id)->get()->row();
                      ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                   
                                  <td><?php echo $bcm->yearly_reg_no;?></td>
                                   <!--<td>
                                      <?php
                                      $year = $this->session->userdata['acyear'];

                                      $this->db->select('id, ROW_NUMBER() OVER (ORDER BY create_date) AS position');
                                      $this->db->from('patient_ipd');
                                      $this->db->where('YEAR(create_date)', $year);
                                      $query = $this->db->get();

                                      if ($query->num_rows() > 0)
                                      {
                                        foreach ($query->result() as $row) 
                                        {
                                          if($row->id == $bcm->id)
                                          {
                                            echo $row->position;
                                          }
                                        }
                                      }
                                    // echo $bcm->ipd_no_new;
                                      ?></td> -->


                                      <td  style="padding:2px;"><?php  echo $tot_serial_ipd_change++;   ?></td>
                                  <td><?php echo $bcm->firstname; ?></td>
                                  
                                   <td><?php echo $bcm->date_of_birth; ?></td>
                                   <td><?php echo $bcm->sex; ?></td>
                                   <td><?php echo $bcm->address; ?></td>
                                    <td style="padding:2px;"><?php echo $dept_name->name; ?></td>
                                     <td><?php echo date("d-m-Y",strtotime($bcm->create_date)); ?></td>
                                     <td><?php echo $bcm->bedNo; ?></td>
                                      <td><?php
                                      
                                      if($bcm->discharge_date == '0000-00-00')
                                      {
                                        $dd = '';
                                      }
                                      else
                                      {
                                        $dd = date("d-m-Y",strtotime($bcm->discharge_date));
                                      }
                                      
                                       echo $dd; ?></td>
                                    
                                  <td><?php echo $bcm->dignosis; ?></td> 

                                  <td><?php echo $patient_ahar->ahar; ?></td> 


                                  <td class="center no-print"  style="padding:2px;">
                                        <?php ?>
                                                <a href="<?php echo base_url("patients/view_diet_sheet/$bcm->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                         
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