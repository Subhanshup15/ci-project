<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
   <!--  table area -->
   <div class="col-sm-12">
      <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/anesthesia_register')?>">
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
   <!--     <option value="opd">opd</option>  -->
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
             <?php   if($section == 'ipd'){ ?>
                <h3 style="margin:0px"><strong><?php echo " IPD Anesthesia Register"; ?></strong></h3>
                <?php } else { ?>
                <h3 style="margin:0px"><strong><?php echo " OPD Anesthesia Register"; ?></strong></h3>
                <?php } ?>
                 
               
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
                        <th rowspan='2'><?php echo "Date" ?></th>
                        
                        <th colspan='2' style="text-align:center;"><?php echo "OPD No" ?></th>
                       <?php if($section=='ipd'){?>  <th rowspan='2'><?php echo "C-IPD" ?></th>  <?php }?>
                        <th rowspan='2'><?php echo "Name" ?></th>
                         <th rowspan='2'><?php echo "Full Address" ?></th>
                        <th rowspan='2'><?php echo "Age" ?>-<?php echo "Sex" ?></th>
                       
                       <th rowspan='2'><?php echo "ASF Grade  " ?></th>
                        <th rowspan='2'><?php echo "Department" ?></th>
                        <th rowspan='2'><?php echo "Dignosis" ?></th>
                        <th rowspan='2'><?php echo " Name  of ANESTHESIA" ?></th>
                         <th rowspan='2'><?php echo "Type of Anesthesia" ?></th>
                          <th rowspan='2'><?php echo "Procedure done" ?></th>
                            <th rowspan='2'><?php echo "Dureation" ?></th>

                              <th rowspan='2'><?php echo "Remark" ?></th>
                       
                       <!-- <th rowspan='2' class="no-print"><?php echo display('action') ?></th> -->
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
                                    
                                   
  
                                    if($patient->manual_status==0){
                                    if($patient->proxy_id){
                                    $tretment=$this->db->select("*")
                                    ->from('treatments1')
                                    ->where('dignosis LIKE',$p_dignosis)
                                    ->where('proxy_id',$patient->proxy_id)
                                    ->where('department_id',$patient->department_id)
                                    ->where('ipd_opd ',$section_tret)
                                    ->get()
                                    ->row();
                                    //  print_r($this->db->last_query());
                                    }
                                    else{
                                    $tretment=$this->db->select("*")
                                    ->from('treatments1')
                                    ->where('dignosis LIKE',$p_dignosis)
                                    ->where('department_id',$patient->department_id)
                                    ->where('ipd_opd ',$section_tret)
                                    ->get()
                                    ->row();  
                                    if(empty($tretment)){
                                    $tretment=$this->db->select("*")
                                    ->from('treatments1')
                                    ->where('department_id',$patient->department_id)
                                    ->where('ipd_opd',$patient->department_id)
                                    ->get()
                                    ->row();   
                                    }
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
                                    
                                    if($patient->manual_status=='1' || $patient->created_by =='1' || $patient->created_by =='2')
                                    {
                                    $tretment=$this->db->select("*")
                                    ->from('manual_treatments')
                                    ->where('patient_id_auto',$patient->id)
                                    ->where('dignosis LIKE',$p_dignosis)
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
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;



                                if($tretment){
                                $ANESTHESIA = ($tretment->ANESTHESIA) ? $tretment->ANESTHESIA : null;

                                if($ANESTHESIA)
                                # print_r($this->db->last_query());
                                {

                                   
                    ?>
                     <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($patient->create_date)); ?></td>
                            <td><b><?php if($patient->yearly_reg_no !=''){ echo $patient->yearly_reg_no.'.'.$Year;  } ?></b></td> 
                            <td><?php if($patient->old_reg_no){echo $patient->old_reg_no.'.'.$Year; }?></td>
                            <?php if($section=='ipd'){  ?>    <td  ><?php  echo $tot_serial_ipd_change; ?></td> <?php  }?>
                            <td><?php echo $patient->firstname; ?></td>
                            <td><?php echo $patient->address; ?></td>
                            <td><?php echo $patient->date_of_birth; ?> - <?php echo $patient->sex; ?></td>
                            <td></td>
                       <?php 
                           $department = $this->db->select('*')
                           ->where('dprt_id',$patient->department_id)
                           ->get('department')
                           ->row();
                           ?>
                        <td>
                           <?php echo $department->name; ?>
                        </td>
                        <td><?php echo $patient->dignosis; ?></td>
                       <td> <b><?php
                       if($tretment->ANESTHESIA)
                            {
                              echo  $ANESTHESIA= $tretment->ANESTHESIA.'<br>'; 
                            }
                     
                          ?> </b></td>
                         <td></td>
                           <td></td>
                             <td></td>
                              <td></td>
                       <!-- <td class="center no-print">
                           <a href="<?php echo base_url("patients/profile/$patient->id/opd") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                        </td>
                     </tr> -->
                    <?php $sl++; ?>
                     <?php }
						} 
                    }
                    ?> 
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