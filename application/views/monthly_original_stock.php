<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/get_monthly_report'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  
<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

   <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">
  
</div>  


<!--<div class="form-group">-->
<!--    <select class="form-control" name="section" id="section">-->
<!--        <option value="opd">opd</option>-->
<!--        <option value="ipd">ipd</option>-->
<!--    </select>-->
   <!-- <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>-->
<!--</div>-->



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
 
 
 
                   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Monthly Despense List</h3>
                    <h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-
                    
                    <?php
                    
                    if($datefrom != '')
                    {
                        echo date("d/m/Y", strtotime($datefrom));
                    }
                    else
                    {
                        echo date("d/m/Y");   
                    }
                    ?> To 
                      
                       <?php
                    
                    if($dateto != '')
                    {
                        echo date("d/m/Y", strtotime($dateto));
                    }
                    else
                    {
                        echo date("d/m/Y");   
                    }
                      ?>
                    </h4>     
                    
                   
                  
                        
                         
                         
                          
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" style="font-weight: bold;">
                    <thead >
                        <tr>
                            <th>Sr. No</th>
                      
                        
                            <th>Tab Name</th>
                           <!--<th>Batch Number</th>-->
                            <th>Opening Balance</th>
                            <th>Despensing Balance</th>
                            <th>Closing Balance</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                       // print_r($pharma);
                     // 	$result = $daily_count.sort(function(a, b) ;
                        foreach($daily_opening as $open){ ?>
                  	<?php $daily_despense=$this->db->select('sum(daily_pharma_patient_stock.daily_despensing_bal) as despense,daily_pharma_patient_stock.tab_name')
                  	->from('daily_pharma_patient_stock')
                	->join('pharma_original_stock','pharma_original_stock.id = daily_pharma_patient_stock.tab_name')
                  	->where('daily_pharma_patient_stock.tab_name',$open->tab_name)
                  	->where('daily_pharma_patient_stock.cretate_date >=',$datefrom)
                  	->where('daily_pharma_patient_stock.cretate_date <=',$dateto)
                  	->order_by('daily_pharma_patient_stock.id','ASC')
                  	->get()
                  	->row();
      				//print_r($this->db->last_query()); ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                    
                         
                            <td>
                              <?php 
                                                          
                                                          
                                                          
                                  $name1 = $this->db->select('*')->from('pharma_original_stock')->where('id',$open->tab_name)->get()->row();
                                    if($name1)
                                    {
                                        echo $tab_name = $name1->tab_name;
                                    }else
                                    {
                                        echo  $tab_name = $open->tab_name; 
                                    }
                        ?>
                          </td>
                          
                          <!-- <td><?php echo $open->batch_number; ?></td>-->
                          
                           <?php 
                              $added_stock = $this->db->select('sum(opening_stock)')
                              ->from('pharma_original_stock')
                              ->where('create_date >=',$datefrom)
                              ->where('create_date >=',$dateto)
                             // ->where('batch_number',$open->batch_number)
                              ->where('id',$tab_name)
                              ->or_where('tab_name',$tab_name)
                              ->get()
                              ->result();
                           //   print_r($this->db->last_query());
                          ?>
                            <td><?php echo $open->daily_opening_bal; ?></td>
                        
                            <td style="color:red;"><?php echo $daily_despense->despense; ?></td>
                       
                          
                          
                           <?php $daily_closing=$this->db->select('daily_pharma_patient_stock.daily_closing_bal as closing,daily_pharma_patient_stock.tab_name')
      	->from('daily_pharma_patient_stock')
      ->join('pharma_original_stock','pharma_original_stock.id = daily_pharma_patient_stock.tab_name')
      	->where('daily_pharma_patient_stock.tab_name',$open->tab_name)
        ->where('daily_pharma_patient_stock.cretate_date <=',$dateto)
        ->order_by('daily_pharma_patient_stock.id','DESC')
        ->get()
        ->row();
      //print_r($this->db->last_query()); ?>
                            <td><?php echo $daily_closing->closing; ?></td>
                        </tr>
                        <?php } $i++; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>



