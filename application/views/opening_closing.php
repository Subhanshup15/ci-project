<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  
    error_reporting(0);
    //echo error_reporting(0);
?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('patients/opening_closing'); ?>">
                                      
 
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
 
 
 
                   
                    <h3 style="margin-top: 0px; margin-bottom: 15px;">Pharma Stock List</h3>
                    <!--<h4 style="margin-top: 0px; margin-bottom: 15px;"> Date:-  <?//php echo date("d/m/Y", strtotime($datefrom))  ?></h4>-->     
                    
                   
                  
                        
                         
                         
                          
                </div><br><br>
                <div class="table-responsive" style="width: 100%;"> 
                <table width="100%" id="patientdata"  class="table table-striped table-bordered table-hover table-responsive" >
                    <thead >
                        <tr>
                            <th>Sr. No</th>
                            <th>Tab Name</th>
                            <th>Opening Stock</th>
                            <th>Closing Stock</th>
                            <th>Expiry Date</th>
                          </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                       // print_r($pharma);
                        foreach($pharma as $patient){ ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $patient->tab_name; ?></td>
                            <td><?php echo $patient->opening_stock; ?></td>
                            <td><?php echo $patient->closing_stock; ?></td>
                            <td><?php echo $patient->expiry_date; ?></td>
                        </tr>
                        <?php } $i++; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>



