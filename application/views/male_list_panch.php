<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/male_list_panch')?>">
                                      
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
                    
                    <h2><?php  if($section=='opd'){ echo 'OPD'; }else{ echo 'IPD'; }?> Male Panchkarma Total Patient</h2>
                    
                </div>
                <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  
                    <?php  
                    
                    if(date("d/m/Y", strtotime($datefrom))=='01/01/1970')
                    { 
                        echo date("d/m/Y");
                    }
                    else
                    { 
                        echo date("d/m/Y", strtotime($datefrom));
                    } 
                    ?> 
                    To 
                    <?php 
                     if(date("d/m/Y", strtotime($dateto)) == '01/01/1970')
                     {
                        echo date("d/m/Y");
                     }
                     else
                     {
                        echo date("d/m/Y", strtotime($dateto));
                     }  ?></h4>
                <?//php echo date("Y/m/d"); ?>
                </div>
            <div class="panel-body">
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 30px;" rowspan="2"><?php echo "S.No" ?></th>
                            <th style="width: 30px; text-align: center;" colspan="2" >
                                <?php echo "COPD" ?>
                            </th> 
                            <th style="width: 50px;" rowspan="2"><?php echo "Name" ?></th> 
                            <th style="width: 30px;" rowspan="2"><?php echo "Age" ?></th>    
                            <th rowspan="2"><?php echo display('sex') ?></th>   
                            <!-- <th style="width: 30px;"><?php echo display('address') ?></th> -->
                            <th rowspan="2"><?php echo "Dignosis" ?></th>
                            <th rowspan="2"><?php echo "Date" ?></th>
                            <th rowspan="2"><?php echo "SNEHAN"?></th>
                            <th rowspan="2"><?php  echo "SWEDAN"; ?></th>
                            <th rowspan="2"><?php  echo "VAMAN"; ?></th>
                            <th rowspan="2"><?php  echo "VIRECHAN"; ?></th>
                            <th rowspan="2"><?php  echo "BASTI"; ?></th>
                            <th rowspan="2"><?php  echo "NASYA"; ?></th>
                            <th rowspan="2"><?php  echo "SHIROBASTI"; ?></th>
                            <th rowspan="2"><?php  echo "RAKTAMOKSHAN"; ?></th>
                            <th rowspan="2"><?php  echo "SHIRODHARA"; ?></th>
                            <th style="width: 30px;" rowspan="2"><?php  echo "OTHER"; ?></th>
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
                       <?php
                       $i=1;
                       foreach($panchResult as $key => $pr){ ?>
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
                                
                                
                                $snehan = $pr->snehan;
                                $swedan = $pr->swedan;
                                $vaman = $pr->vaman;
                                $virechan = $pr->virechan;
                                $nasya = $pr->nasya;
                                $raktmokshan = $pr->raktmokshan;
                                $shirodhara = $pr->shirodhara;
                                $shirobasti = $pr->shirobasti;
                                $basti = $pr->basti;
                                $others = $pr->others;
                               // $shirodhara = $pr->shirodhara;
                                
                                
                                
                                $pDate = date('Y',strtotime($patient->create_date));
                                $dot_year = substr($pDate,2);
                                
                            ?>
                            
                            <?php if($snehan || $swedan || $vaman || $virechan || $nasya || $raktmokshan || $shirodhara || $shirobasti || $basti || $others){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo ($patient->yearly_reg_no)?$patient->yearly_reg_no.'.'.$dot_year:''; ?></td>
                                <td><?php echo ($patient->old_reg_no)?$patient->old_reg_no.'.'.$dot_year:''; ?></td>
                                <td><?php echo $patient->firstname; ?></td>
                                <td><?php echo $patient->date_of_birth; ?></td>
                                <td><?php echo $patient->sex; ?></td>
                                <td><?php echo $patient->dignosis; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                                <td><?php echo $pr->snehan; ?></td>
                                <td><?php echo $pr->swedan; ?></td>
                                <td><?php echo $pr->vaman; ?></td>
                                <td><?php echo $pr->virechan; ?></td>
                                <td><?php echo $pr->basti; ?></td>
                                <td><?php echo $pr->nasya; ?></td>
                                <td><?php echo $pr->shirobasti; ?></td>
                                <td><?php echo $pr->raktmokshan; ?></td>
                                <td><?php echo $pr->shirodhara; ?></td>
                               
                                
                                <td><?php echo $pr->others; ?></td>
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
                            
                       <?php } ?>
                    </tbody>
                    
                </table>
                <h3>Report Summary</h3>
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
                            $name_array=array('SNEHAN','SWEDAN','VAMAN','VIRECHAN','BASTI','NASYA','SHIROBASTI','RAKTMOKSHAN','SHIRODHARA','OTHER'); 
                            $tot_array=array($SnehanCount['0']->SnehanCount, $SwedanCount['0']->SwedanCount, $VamanCount['0']->VamanCount, $VirechanCount['0']->VirechanCount,
                            $NasyaCount['0']->NasyaCount,$RaktmokshanCount['0']->RaktmokshanCount,$ShirodharaCount['0']->ShirodharaCount,$ShirobastiCount['0']->ShirobastiCount,
                            $BastiCount['0']->BastiCount,$OthersCount['0']->OthersCount);
                        ?> 
                        <?php $n = 1; ?>
                        <?php for($i=0;$i<count($name_array);$i++) {  ?>
                            <tr>                                   
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