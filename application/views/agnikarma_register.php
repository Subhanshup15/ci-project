<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
<?php 
 error_reporting(0);
 ?>
   <!--  table area -->
   <div class="col-sm-12">
      <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/getpatientby_agnikarma')?>">
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
              <!-- <input type="text" name="section" class="form-control" id="section" value="opd" readonly> -->
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
            <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">.
            <?php 	if($section == 'ipd') {?>
               <h2> IPD Agnikarma Patient List</h2>
               <?php }else{?>
                <h2> OPD Agnikarma Patient List</h2>
            <?php }?>
            </div>
            <div class="col-lg-12" style="text-align:center;margin-top: 10px;margin-bottom: 10px;">
               <div>
                  <b> Date : <?php echo date('d/m/Y',strtotime($datefrom)) ?> To <?php echo date("d/m/Y",strtotime($dateto)); ?></b>
               </div>
            </div>
            <div class="panel-body">
               <table width="100%" id="patientdata" class=" table table-striped table-bordered table-hover">
                  <thead>
                     <tr>
                        <th rowspan='2'><?php echo "Sno" ?></th>
                        <th colspan='2' style="text-align:center;"><?php echo "OPD No" ?></th>
                       <?php  if($section == 'ipd') { ?>     <th rowspan='2'><?php echo "IPD No" ?></th> <?php } ?>
                        <th rowspan='2'><?php echo "Name" ?></th>
                         <th rowspan='2'><?php echo "Full Address" ?></th>
                        <th rowspan='2'><?php echo "Age" ?></th>
                        <th rowspan='2'><?php echo "Sex" ?></th>
                       <th rowspan='2'><?php echo "Date" ?></th>
                        <th rowspan='2'><?php echo "Dignosis" ?></th>
                        <th rowspan='2'><?php echo "Agnikarma" ?></th>
                        <th rowspan='2'><?php echo "Department" ?></th>
                        <th rowspan='2' class="no-print"><?php echo display('action') ?></th>
                     </tr>
                     <tr>
                        <th style="widht:15%;">New</th>
                        <th style="widht:15%;">Old</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php $sl='1';
                    $year = $this->session->userdata('acyear');
                            $Year = substr($year,2,2);
                    ?>
                     <?php foreach ($patients as $patient) 
			{
  							
  				 					if($section == 'ipd')
                                    { 
                                         $che=trim($patient->dignosis);
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
                                    else
                                    {
                                          $che=trim($patient->dignosis);
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
                                    
                                    
                                    
                                 if($patient->manual_status==0)
                                 {
                                      if($patient->proxy_id)
                                      {
                                         $tretment=$this->db->select("*")
                                         ->from('treatments1')
                                         ->where('dignosis LIKE',$p_dignosis)
                                         ->where('proxy_id',$patient->proxy_id)
                                         ->where('department_id',$patient->department_id)
                                         ->where('ipd_opd ',$section_tret)
                                         ->where('OTHER LIKE','%AGNIKARMA%')
                                         ->get()
                                         ->row();
                                       // echo "<pre>";
                                    //$OTHER = $tretment->OTHER;
                                           // print_r($this->db->last_query());
                                          //  die();
                                      }
                                      else
                                      {
                                        $tretment=$this->db->select("*")
                                          ->from('treatments1')
                                          ->where('dignosis LIKE',$p_dignosis)
                                          ->where('department_id',$patient->department_id)
                                          ->where('ipd_opd',$section_tret)
                                          ->where('OTHER LIKE','%AGNIKARMA%')
                                          ->get()
                                          ->row();  
                                      //   $OTHER = $tretment->OTHER;
                                      }
                                  }
  									else
                                 {
                                     if($section_tret == 'ipd')
                                     {
                                        $tretment=$this->db->select("*")
                                       ->from('manual_treatments')
                                       ->where('patient_id_auto',$patient->id)
                                       ->where('dignosis LIKE',$p_dignosis)
                                       ->where('ipd_opd',$section_tret)
                                       ->where('ipd_round_date ',$datefrom1)
                                       ->where('rounds','1')
                                      	->where('OTHER LIKE','%AGNIKARMA%')
                                       ->get()
                                       ->row();
                                    //    $OTHER = $tretment->OTHER;
                                     }
                                     else
                                     {
                                        $tretment=$this->db->select("*")
                                       ->from('manual_treatments')
                                       ->where('patient_id_auto',$patient->id)
                                       ->where('dignosis LIKE',$p_dignosis)
                                       ->where('ipd_opd',$section_tret)
                                          ->where('OTHER LIKE','%AGNIKARMA%')
                                       ->get()
                                       ->row();
                                              //   print_r($this->db->last_query());

                                      //  $OTHER = $tretment->OTHER;
                                     }
                                   }
                                   if($patient->manual_status=='1' || $patient->created_by =='1' || $patient->created_by =='2')
                                    {
                                         if($section_tret == 'ipd')
                                         {
                                            $tretment=$this->db->select("*")
                                           ->from('manual_treatments')
                                           ->where('patient_id_auto',$patient->id)
                                           ->where('dignosis LIKE',$p_dignosis)
                                           ->where('ipd_opd',$section_tret)
                                           ->where('ipd_round_date ',$datefrom1)
                                           ->where('rounds','1')
                                              ->where('OTHER LIKE','%AGNIKARMA%')
                                           ->get()
                                           ->row();
                                          //  $OTHER = $tretment->OTHER;
                                         }
                                           else
                                         {
                                            $tretment=$this->db->select("*")
                                           ->from('manual_treatments')
                                           ->where('patient_id_auto',$patient->id)
                                           ->where('dignosis LIKE',$p_dignosis)
                                           ->where('ipd_opd',$section_tret)
                                           ->where('OTHER LIKE','%AGNIKARMA%')
                                           ->get()
                                           ->row();
                                         //     $OTHER = $tretment->OTHER;
                                         }
                                    }
  					if($tretment)
                    {
                    ?>
                     <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                        <td><?php echo $sl; ?></td>
                        <td><?php if($patient->yearly_reg_no !=''){ echo $patient->yearly_reg_no;  } ?></td>
                        <td><?php if($patient->old_reg_no){echo $patient->old_reg_no; }?></td>
                         <?php  if($section == 'ipd') { ?>   <td><?php echo $patient->ipd_no_new; ?></td> <?php } ?>
                        <td><?php echo $patient->firstname; ?></td>
                         <td><?php echo $patient->address; ?></td>
                        <td><?php echo $patient->date_of_birth; ?></td>
                        <td><?php echo $patient->sex; ?></td>
                       <td><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                        <td><?php echo $patient->dignosis; ?></td>
                        <td><?php echo  $OTHER = $tretment->OTHER; ?></td>
                        <?php 
                           $department = $this->db->select('*')
                           ->where('dprt_id',$patient->department_id)
                           ->get('department')
                           ->row();
                           ?>
                        <td>
                           <?php echo $department->name; ?>
                        </td>
                        <td class="center no-print">
                           <a href="<?php echo base_url("patients/profile/$patient->id/opd") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                        </td>
                     </tr>
                    <?php $sl++; ?>
                     <?php }
						} ?> 
                  </tbody>
               </table>
               <!-- /.table-responsive -->
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