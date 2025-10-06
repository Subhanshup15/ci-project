<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/pharma_list'); ?>">
                                      
 
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
     

</div>  

<!--<div class="form-group">-->

<!--    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>-->

<!--    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">-->
  
<!--</div>  -->


<div class="form-group">
    <select class="form-control" name="section" id="section">
        <option value="opd">opd</option>
        <option value="ipd">ipd</option>
    </select>
   <!-- <input type="text" name="section" class="form-control" id="section" value="<?php echo $section; ?>" readonly>-->
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
                    <a class="btn btn-success" href="<?php echo base_url("patients/add_pharma") ?>"> <i class="fa fa-plus"></i> Add Stock</a>  
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
 
 
 
                   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Pharma Stock List</h3>
                    <!--<h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?//php echo date("d/m/Y", strtotime($datefrom))  ?></h4>-->     
                    
                   
                  
                        
                         
                         
                          
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" >
                    <thead >
                        <tr>
                            <th>Sr. No</th>
                            <th>Tab Name</th>
                          	<th>Unit</th>
                            <th>Batch Number</th>
                            <th>Tablet Company Name</th>
                           <th>Stock Added Date</th>
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                           <th>MRP</th>
                           <th>RATE</th>
                           <th>Discount</th>
                           <th>GST</th>
                           <th>GST Amount</th>
                           <th>Final Amount</th>
                            <th>Added Quantity</th>
                            <th>Available Stock</th>
                            <th>Action</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                       // print_r($pharma);
                        foreach($pharma as $patient){ ?>
                      
                      <?php $qty = $this->db->select('quantity_in')->from('pharma_original_tab')->where('tab_name',$patient->tab_name)->get()->row(); ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $patient->tab_name; ?></td>
                           <td><?php echo $qty->quantity_in; ?></td>
                            <td><?php echo $patient->batch_number; ?></td>
                            <td><?php echo $patient->tablet_company_name; ?></td>
                          <td><?php echo date("d-m-Y",strtotime($patient->create_date)); ?></td>
                            <td><?php echo $patient->manufacturing_date; ?></td>
                            <td><?php echo $patient->expiry_date; ?></td>
                          
                          <td><?php echo $patient->mrp; ?></td>
                          <td><?php echo $patient->rate; ?></td>
                          <td><?php echo $patient->discount; ?></td>
                          <td><?php echo $patient->gst; ?></td>
                          <td><?php echo $patient->gst_amount; ?></td>
                           <td><?php echo $patient->total_amount; ?></td>
                          
                            <td><?php echo $patient->quantity; ?></td>
                            <td>
                                <?php
                                $closing_stock = $patient->closing_stock;
                                if($closing_stock =='0' && $patient->stock_end_flag =='1')
                                {  echo $patient->closing_stock; }else{
                                  if($closing_stock =='0')
                                {
                                echo $patient->quantity;
                                }
                                else
                                {
                                    echo $patient->closing_stock;
                                }}
                                ?></td>
                            <td>
                              <a href="<?php echo base_url("patients/edit_pharma/$patient->id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                            </td>
                        </tr>
                        <?php } $i++; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>



