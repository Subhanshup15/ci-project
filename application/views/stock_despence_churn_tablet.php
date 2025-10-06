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

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php  echo base_url('stock/stock_despence_churn_tablet'); ?>">
                                      
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
          
          
           <div class="col-sm-12">
	          	     <div class="row">
	          	     <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          <div class="col-xs-8" align="center">
               <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
             <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                
                       </div>
              <div class="col-xs-2"></div>
           <div class="col-sm-12" align="center">
                                
                                    <?php   if($section == 'ipd'){ ?>
                <h3 style="margin:0px"><strong><?php echo "Daily IPD Medicine Dispensing Register"; ?></strong></h3>
                <?php } else { ?>
                <h3 style="margin:0px"><strong><?php echo "Daily OPD Medicine Dispensing Register"; ?></strong></h3>
                <?php } ?>
                 
                 
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Churna Register"; ?></strong></h2>
                            </div>

                            <div class="row" style="page-break-after: always;">
            <div class="col-sm-12" align="center">  
              <div class="scrollmenu">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                    <th>Sr.No</th>
                  <?php if($section == 'opd'){ ?><th>Yearly No</th><?php } ?>   
                  	<?php if($section == 'ipd'){ ?><th>CIPD No</th><?php } ?>   
                   <th >COPD</th>
                    <th >Name</th>
                  
                
                
                    <?php // $tablets = $this->db->get('pharma1')->result();
  			           	$tablets = $this->db->select('*')->from('pharma1')->where('status','1')->get()->result(); 
                     
                  
                  
                 
  
                    foreach($tablets as $tab){ ?>
                    <th><?php
                    
                    //$a = explode(" ",$tab->name);
                    
                    $words = explode(' ', $tab->name);
                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];

                    ?></th>
                    <?php } ?>
                    <!--<th>Action</th>-->
                </tr>
              </thead>
                <?php 
                    //  print_r($patients);
                        $i = 1;
              	 
                  if($section == 'opd'){
                      
                      		$datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y',strtotime($datefrom));
                            $year2='%'.$year1.'%';
                           
                         $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); ; 
					
						
                       
                        // for department serial no
                        
                        $this->db->select('DISTINCT(name)');
                        $this->db->where('yearly_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_d = $this->db->get('pharma_daily_opd_patient');
                        $num_d = $query_d->num_rows();//0
                        
					    $this->db->select('DISTINCT(name)');
                        $this->db->where('old_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_dd = $this->db->get('pharma_daily_opd_patient');
                        $num1_d = $query_dd->num_rows();
                        
                        
                         $tot_serial1_d=$num_d + $num1_d;
                         if($tot_serial1_d==0){
                             $tot_serial1_d=1;
                         }
                         else{
                             $tot_serial1_d =$tot_serial1_d + 1;
                         }
                        //
                    }
              
              
              
              
              
               if($section == 'ipd'){
                      
                      		$datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y',strtotime($datefrom));
                            $year2='%'.$year1.'%';
                           
                         $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); ; 
					
						
                       
                        // for department serial no
                        
                        $this->db->select('DISTINCT(name)');
                        $this->db->where('yearly_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_d = $this->db->get('pharma_daily_ipd_patient');
                        $num_d = $query_d->num_rows();//0
                        
					    $this->db->select('DISTINCT(name)');
                        $this->db->where('old_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_dd = $this->db->get('pharma_daily_ipd_patient');
                        $num1_d = $query_dd->num_rows();
                        
                        
                         $tot_serial1_d=$num_d + $num1_d;
                         if($tot_serial1_d==0){
                             $tot_serial1_d=1;
                         }
                         else{
                             $tot_serial1_d =$tot_serial1_d + 1;
                         }
                        //
                    }
                foreach($patient as $patient){
                   $name = $patient->name;
                  $date = $datefrom;
                  
                        $dig = $this->db->select('*')
                        ->from('patient')
                        ->where('id',$patient->patient_auto_id)
                        ->where('create_date',$patient->create_date)
                        ->get()
                        ->row();

                        $dig_ipd = $this->db->select('*')
                        ->from('patient_ipd')
                        ->where('id',$patient->patient_auto_id)
                        ->where('create_date',$patient->create_date)
                        ->get()
                        ->row();

                        if ($this->session->userdata('acyear') >= 2025) {

                        $dept_name=$this->db->select("*")->from('department_new')->where('dprt_id',$dig->department_id)->get()->row();
                        $dept_name1=$this->db->select("*")->from('department_new')->where('dprt_id',$dig_ipd->department_id)->get()->row();

                      #  print_r($this->db->last_query());

                        }
                        else
                        {

                        $dept_name=$this->db->select("*")->from('department')->where('dprt_id',$dig->department_id)->get()->row();
                        $dept_name1=$this->db->select("*")->from('department')->where('dprt_id',$dig_ipd->department_id)->get()->row();
                        }   

               // $ipd_no = $this->db->select('ipd_no_new')->from('patient_ipd')->where('yearly_reg_no',$patient->yearly_reg_no)->where('create_date',$patient->create_date)->get()->row();
                  
                  $year=date("Y",strtotime($date));
                   if($section == 'opd')
                   {
                   $test = $this->db->select('*')
                    ->from('pharma_daily_opd_patient')
                    ->where('name ',$name)
                    ->where('create_date',$date)
                    ->get()
                    ->result();
                   }else
                   {
                     $test = $this->db->select('DISTINCT(RX1),RX1_despense,DRX_despense,name,DRX,patient_auto_id')
                    ->from('pharma_daily_ipd_patient')
                    ->where('name ',$name)
                   	->where('push_date >=',$date)
                    ->where('push_date <=',$date)
                    ->where('push_date LIKE','%'.$year.'%')
                    ->get()
                    ->result();
                   // print_r($this->db->last_query());
                   }
                  
                  if($patient->yearly_reg_no)
                  {
                    $opd_number = $patient->yearly_reg_no.'<br>(New)';
                  }
                  else
                  {
                    $opd_number = $patient->old_reg_no.'<br>(Follow Up)';
                  }
                  
                  if($section == 'ipd'){
                   // patient ipd yearly no
			                      $ipd_no_date=$patient->create_date;
                                  $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                  $year122=date('Y',strtotime($ipd_no_date));
                                  $year2='%'.$year122.'%';

                                  $this->db->select('*');
                                 // $this->db->where('ipd_opd', 'ipd');
                                  $this->db->where('patient_auto_id <', $test['0']->patient_auto_id);
                                 // $this->db->where('create_date <=', $d_ipd_no);
                                  $this->db->where('create_date LIKE', $year2);
                                  $query = $this->db->get('pharma_daily_ipd_patient');
                                  $num_ipd_change = $query->num_rows();
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;
                  
                  }
                  
                    
                  
               if($patient->RX1_despense != '0')
               {
                
                ?>
              <tbody>
                <tr>
                    <td><?php echo $i++; ?></td>
                  <?php if($section=='opd'){ ?>  <td style="padding:2px;"><b><?php  echo $tot_serial1_d++; ?></b></td><?php } ?>
                   <?php if($section == 'ipd') { ?>
                  <td><b>  <?//php echo $ipd_no->ipd_no_new;?></b></td>
                                     
                                    <?php   } ?> 
                  <td><b><?php echo $opd_number; ?></b></td>
                   <td><b><?php echo $patient->name . ' (' . $dept_name->name . ')'; ?></b></td>

                   

                    <?php foreach($tablets as $tab) { ?>
                    <td>
                        <?php foreach($test as $t){ ?>
                      
                        <?php if(stripos($t->RX1, $tab->name) !== false){ ?>
                      <?php if($section == 'opd'){ ?>
                      <b style='color: red;'><?php echo $total = $t->RX1_despense; ?></b>
                     <?php } else { ?>
                      <b style='color: red;'>
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
                       
                      </b>
				      	<?php } ?>
                      
                        <?php }  ?>
                        <?php }  ?>
                    </td>
                    <?php  } ?>
                </tr>
                <?php } 
                    }
                 ?>
                 <tr>
                    <td <?php if($section){ echo 'colspan="4"'; } else { echo 'colspan="3"'; } ?>>Grand Total</td>
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
                    ->from('pharma_daily_ipd_patient')
                    ->where('tab_name',$tab->name)
                    ->where('push_date',$date)
                   // ->order_by('id','desc')
                    ->get()
                    ->result();
                }
                else
                {
                 	$testtab =  $this->db->select('SUM(RX1_despense) as SUM,tab_name')
                    ->from('pharma_daily_opd_patient')
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
              </tbody>
            </table>
                </div>
            </div>
              </div>
          
          
          <div class="row" style="page-break-after: always;">
          
          <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Tablet Register"; ?></strong></h2>
                            </div>
           <div class="col-sm-12" align="center">  
              <div class="scrollmenu">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                    <th>Sr.No</th>
                   <?php if($section == 'ipd') { ?><th>CIPD No.</th><?php } ?>
                   <?php if($section == 'opd') { ?><th>Yearly No.</th><?php } ?>
                   <th>COPD</th>
                   <th>Name</th>
                  
                
                
                    <?php // $tablets = $this->db->get('pharma1')->result();
  		    		$tablets = $this->db->select('*')->from('pharma1')->where('status','2')->get()->result(); 
                       
  
                    foreach($tablets as $tab){ ?>
                    <th><?php
                    
                    //$a = explode(" ",$tab->name);
                    
                    $words = explode(' ', $tab->name);
                    echo $words[0][0].'<br>'.$words[0][1].'<br>'.$words[0][2].'<br>'.$words[0][3].'<br>'.$words[0][4].'<br>'.$words[0][5];

                    ?></th>
                    <?php } ?>
                    <!--<th>Action</th>-->
                </tr>
                </thead>
                <?php 
                $i = 1;
              
              
              
               if($section == 'opd'){
                      
                      		$datefrom1=date('Y-m-d',strtotime($datefrom));
                            $year1 = date('Y',strtotime($datefrom));
                            $year2='%'.$year1.'%';
                           
                         $ddd=date('Y-m-d',strtotime("-1day".$datefrom1)); ; 
					
						
                       
                        // for department serial no
                        
                        $this->db->select('DISTINCT(name)');
                        $this->db->where('yearly_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_d = $this->db->get('pharma_daily_opd_patient');
                        $num_d = $query_d->num_rows();//0
                        
					    $this->db->select('DISTINCT(name)');
                        $this->db->where('old_reg_no !=','');
                        $this->db->where('create_date <=', $ddd);
                        $this->db->where('create_date LIKE', $year2);
                        $query_dd = $this->db->get('pharma_daily_opd_patient');
                        $num1_d = $query_dd->num_rows();
                        
                        
                         $tot_serial1_d=$num_d + $num1_d;
                         if($tot_serial1_d==0){
                             $tot_serial1_d=1;
                         }
                         else{
                             $tot_serial1_d =$tot_serial1_d + 1;
                         }
                        //
                    }
              
              
             // echo '<pre>';
             // print_r($patients);
             // echo '<pre>';
                foreach($patients as $patient){
                    
                    
                   $name = $patient->name;
                  $date = $datefrom;
                  
                   $dig = $this->db->select('*')
                        ->from('patient')
                        ->where('id',$patient->patient_auto_id)
                        ->where('create_date',$patient->create_date)
                        ->get()
                        ->row();

                        $dig_ipd = $this->db->select('*')
                        ->from('patient_ipd')
                        ->where('id',$patient->patient_auto_id)
                        ->where('create_date',$patient->create_date)
                        ->get()
                        ->row();

                        if ($this->session->userdata('acyear') == 2025) {

                        $dept_name=$this->db->select("*")->from('department_new')->where('dprt_id',$dig->department_id)->get()->row();
                        $dept_name1=$this->db->select("*")->from('department_new')->where('dprt_id',$dig_ipd->department_id)->get()->row();

                        // print_r($this->db->last_query());

                        }
                        else
                        {

                        $dept_name=$this->db->select("*")->from('department')->where('dprt_id',$dig->department_id)->get()->row();
                        $dept_name1=$this->db->select("*")->from('department')->where('dprt_id',$dig_ipd->department_id)->get()->row();
                        }   
                //  $ipd_no = $this->db->select('ipd_no_new')->from('patient_ipd')->where('yearly_reg_no',$patient->yearly_reg_no)->where('create_date',$patient->create_date)->get()->row();
                   if($section == 'opd')
                   {
                   $test = $this->db->select('*')
                    ->from('pharma_daily_opd_patient')
                    ->where('name ',$name)
                    ->where('create_date',$date)
                    ->get()
                    ->result();
                   }else
                   {
                     $test = $this->db->select('DISTINCT(RX1),RX1_despense,DRX_despense,name,DRX,id')
                    ->from('pharma_daily_ipd_patient')
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
                   
                  
                   if($patient->yearly_reg_no)
                  {
                    $opd_number = $patient->yearly_reg_no.'<br>(New)';
                  }
                  else
                  {
                    $opd_number = $patient->old_reg_no.'<br>(Follow Up)';
                  }
                    
                  
                  
                   if($section == 'ipd'){
                   // patient ipd yearly no
			                      $ipd_no_date=$patient->create_date;
                                  $d_ipd_no=date('Y-m-d',strtotime("-1day".$ipd_no_date));
                                  $year122=date('Y',strtotime($ipd_no_date));
                                  $year2='%'.$year122.'%';

                                  $this->db->select('*');
                                 // $this->db->where('ipd_opd', 'ipd');
                                  $this->db->where('id <', $test['0']->id);
                                 // $this->db->where('create_date <=', $d_ipd_no);
                                  $this->db->where('create_date LIKE', $year2);
                                  $query = $this->db->get('pharma_daily_ipd_patient');
                                  $num_ipd_change = $query->num_rows();
						          $tot_serial_ipd_change=$num_ipd_change;
						          $tot_serial_ipd_change++;
                  
                  }
                  
               if($patient->RX1_despense != '0')
               {
                ?>
              <tbody>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <?php if($section == 'opd') { ?> <td><b>  <?php echo $tot_serial1_d++; ?> </b></td><?php } ?>
                  <?php if($section == 'ipd') { ?> <td><b>  <?//php echo $ipd_no->ipd_no_new;?> </b></td><?php  } ?> 
                  <td><b><?php echo $opd_number; ?></b></td>
                  <td><b><?php echo $patient->name . ' (' . $dept_name->name . ')'; ?></b></td>
                    <?php foreach($tablets as $tab) { ?>
                    <td>
                        <?php foreach($test as $t){ ?>
                      
                        <?php if(stripos($t->RX1, $tab->name) !== false){ ?>
                      <?php if($section == 'opd'){ ?>
                      <?php if(stripos($t->RX1, $tab->name) !== false && $t->yearly_reg_no) { ?>
                      <b style='color: red;'><?php echo $total = $t->RX1_despense; ?></b>
                      <?php } elseif(stripos($t->RX1, $tab->name) !== false && $t->old_reg_no) { ?>
                      <b style='color: red;'><?php echo $total = $t->RX1_despense; ?></b>
                      <?php } ?>
                     <?php } else { ?>
                      <b style='color: red;'>
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
                      </b>
                <?php } ?>
                            
                        <?php }  ?>
                        <?php }  ?>
                    </td>
                    <?php  } ?>
                </tr>
                <?php } 
                    }
                 ?>
                  <tr>
                    <td <?php if($section){ echo 'colspan="4"'; } else { echo 'colspan="3"'; } ?>>Grand Total</td>
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
                    ->from('pharma_daily_ipd_patient')
                    ->where('tab_name',$tab->name)
                    ->where('push_date',$date)
                   // ->order_by('id','desc')
                    ->get()
                    ->result();
                }
                else
                {
                 	$testtab =  $this->db->select('SUM(RX1_despense) as SUM,tab_name')
                    ->from('pharma_daily_opd_patient')
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
                </tbody>
            </table>
                </div>
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

