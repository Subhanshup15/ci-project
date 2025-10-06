<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('stock/daily_dispense_report_churn'); ?>">
            
            <div class="form-group" id="startDate">
                <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>
                <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">
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
            </div>
            <div class="panel-body">
                 <div class="col-xs-2" align="left">
                 <img src="<?php echo base_url('application/views/layout/Images/logo.jpeg'); ?>" style="height:120px; width:120px;border: 0.5px solid #0003;" />
	          	 </div> 
	          	 <div class="col-xs-8" align="center">
                    <h3 style="margin-top: 0px; margin-bottom: 0px;"><strong><?php echo $this->session->userdata('title') ?></strong></h3>
                    <h4 style="margin-top: 5px;margin-bottom: 5px;"><p class="text-center"><?php echo $this->session->userdata('address') ?></p></h4>
                </div> 
           
              
          <div class="row">
            
               <div class="col-sm-12" align="center">
                                
                                    <h3><strong><?php echo "Daily Stock Register"; ?></strong></h3>
                 
                                <h3 style="margin-bottom: 15px;">Date:-  <?php if($datefrom){ echo date("d/m/Y", strtotime($datefrom)); }else{ echo "00/00/0000"; } ?>   To  <?php if($dateto){ echo date("d/m/Y", strtotime($dateto)); }else{ echo "00/00/0000"; } ?> </h3><br>
                            </div>
                            <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Churna Register"; ?></strong></h2>
                            </div>
            <table class="table table-bordered table-striped table-hover">
             
                <tr>
                  <th>Sr.No</th>
                  <th>Tab Name</th>
                  <th>Daily Opening</th>
                  <th>Daily Opd Despense</th>
                  <th>Daily Ipd Despense</th>
                  <th>Daily Closing</th>
              
                </tr>
            
                  <?php
                $i = 1;
                foreach ($opd_stock_churn as $ds) { ?>
                <tr>
                 
                  <th><?php echo $i++; ?></th>
                  <td><b><?php echo $ds->tab_name; ?></b></td>
                  <td><b><?php echo $ds->opening_stock; ?></b></td>
                  <td style='color:red;'><b><?php echo $ds->opd_despense; ?></b></td>
                  <td style='color:red;'><b>
                    
                  <?php
                       foreach($ipd_stock_churn as $ipd) {
                         if(stripos($ipd->tab_name, $ds->tab_name) !== false){
                           echo $ipd->ipd_despense;
                         }
                       }
                  ?>
                    </b> </td>
                  <td><b>
                  
                    <?php
                       foreach($ipd_stock_churn as $ipd) {
                         if(stripos($ipd->tab_name, $ds->tab_name) !== false){
                           echo $ipd->closing_stock;
                         }
                       }
                  ?>
                  
                 </b> </td>
                  
                </tr>
                <?php } ?>
              
              
                
             
              
            </table>
            
            
            
            
          <!--   <div class="col-sm-12" align="center">
                                <h2 style="margin-bottom: 15px;"><strong><?php echo "Tablet Register"; ?></strong></h2>
                            </div>
            <table class="table table-bordered table-striped table-hover">
             
                <tr>
                  <th>Sr.No</th>
                  <th>Tab Name</th>
                  <th>Daily Opening</th>
                  <th>Daily Opd Despense</th>
                  <th>Daily Ipd Despense</th>
                  <th>Daily Closing</th>
                </tr>
            
                  <?php
                $i = 39;
                foreach ($opd_stock_tab as $ds) { ?>
                <tr>
                 
                  <th><?php echo $i++; ?></th>
                  <td><b><?php echo $ds->tab_name; ?></b></td>
                  <td><b><?php echo $ds->opening_stock; ?></b></td>
                  <td style='color:red;'><b><?php echo $ds->opd_despense; ?></b></td>
                  <td style='color:red;'><b>
                    
                  <?php
                       foreach($ipd_stock_tab as $ipd) {
                         if(stripos($ipd->tab_name, $ds->tab_name) !== false){
                           echo $ipd->ipd_despense;
                         }
                       }
                  ?>
                    </b> </td>
                  <td><b>
                  
                    <?php
                       foreach($ipd_stock_tab as $ipd) {
                         if(stripos($ipd->tab_name, $ds->tab_name) !== false){
                           echo $ipd->closing_stock;
                         }
                       }
                  ?>
                  
                 </b> </td>
                  
                </tr>
                <?php } ?>
              
              
                
             
              
            </table> -->
          </div>
          </div>
        </div>
    </div>
</div>