<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">

    <!--  table area -->
    <div class="col-sm-12">

    <form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('report/deptopdcountbydatefilter')?>">
                                      
        <!-- <input type="text" name="section" class="form-control" id="section" value="<?php //echo $date->section; ?>">       -->


<div class="form-group">

    <label class="sr-only" for="start_date"><?php echo display('start_date') ?></label>

    <input type="text" name="start_date" class="form-control datepicker" id="start_date" placeholder="<?php echo display('start_date') ?>">

</div>  

<div class="form-group">

    <label class="sr-only" for="end_date"><?php echo display('end_date') ?></label>

    <input type="text" name="end_date" class="form-control datepicker" id="end_date" placeholder="<?php echo display('end_date') ?>">

</div>  


<button type="submit" name="filter" class="btn btn-primary" id="filter" >Submit</button>



</form>

        <div  class="panel panel-default thumbnail"> 
            <div class="panel-heading no-print row">
                <div class="btn-group col-md-12"> 
                    <h3>Central OPD Chart</h3>
                    <h4><?php echo $this->session->userdata['title']; ?></h4>  
                </div>                
            </div> 
            <div class="panel-body">

            <h3>स्वास्थ्यरक्षण</h3>
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdater29 as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdater29)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater29 as $patient) {    ?>                                         
                                          
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                        
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdatercount29[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater29 as $patient) {         ?>                                    
                                          
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                                    
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdatercount29[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater29 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->datecount; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdatercount29[0]->totalcount; ?></strong></td>
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->




                <h3>अत्याईक</h3>
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdater35 as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdater35)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater35 as $patient) {    ?>                                         
                                          
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                        
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdatercount35[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater35 as $patient) {         ?>                                    
                                          
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                                    
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdatercount35[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater35 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->datecount; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdatercount35[0]->totalcount; ?></strong></td>
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->




                <h3>पंचकर्म</h3>
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdate33 as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdate33)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdate33 as $patient) {    ?>                                         
                                          
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                        
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdate33count[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdate33 as $patient) {         ?>                                    
                                          
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                                    
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdate33count[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdate33 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->datecount; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdate33count[0]->totalcount; ?></strong></td>
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->



                <h3>स्त्रीरोग</h3>        
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdater as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdater)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater as $patient) {   ?>                       
                                          
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                    
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdatercount[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater as $patient) {   ?>                                          
                                          
                                                      
                                                        
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                              
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdatercount[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->datecount; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>

                        <td><strong><?php echo $ipdcountdatercount[0]->totalcount; ?></strong></td>
                        
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->

                <h3>शालक्यतंत्र</h3>        
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdatere as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdatere)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdatere as $patient) {      ?>                                       
                                          
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                    
                                                     
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdaterecount[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdatere as $patient) {   ?>                                          
                                            
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                        
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdaterecount[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdatere as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->datecount; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdaterecount[0]->totalcount; ?></strong></td>
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->



                <h3>शल्यतंत्र</h3>        
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdater31 as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdater31)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater31 as $patient) {                                             
                                          ?>  
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdater31count[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater31 as $patient) {                                             
                                          ?>
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                                      
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdater31count[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater31 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->Total; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdater31count[0]->totalcount; ?></strong></td>
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->


                
                <h3>बालरोग</h3>        
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdater32 as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdater32)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater32 as $patient) {                                             
                                          ?>  
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdater32count[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater32 as $patient) {                                             
                                          ?>
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                                      
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdater32count[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater32 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->Total; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdater32count[0]->totalcount; ?></strong></td>
                        
                        
                    </tr>
                    
                </table>  <!-- /.table-responsive -->


                
                <h3>कायचिकित्सा</h3>        
                <table style="overflow: scroll" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>                            
                                <?php $i = 0; foreach ($ipdcountdater34 as $patient) { $i++; ?>
                                    <th><?php echo date("d", strtotime($patient->Date)); ?></th> 
                                <?php } ?>                            
                            <th rowspan="2"><?php echo "Total" ?></th>                   
                        </tr>
                        
                       
                    </thead>
                    <tbody>
                        <?php if (!empty($ipdcountdater34)) { ?>
                            <?php $sl = 12141; ?>                                                   

                                                  
                                <tr>                                    
                                    <td>New</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater34 as $patient) {                                             
                                          ?>  
                                                      
                                                        <td><?php echo $patient->Patientnewcount; ?></td>
                                                        
                                                
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdater34count[0]->newcount; ?></strong></td>
                                              
                                </tr>
                                <tr>                                    
                                    <td>Old</td>
                                                         
                                        <?php $j = 0; foreach($ipdcountdater34 as $patient) {                                             
                                          ?>
                                                        <td><?php echo $patient->Patientoldcount; ?></td>                                                 
                                                      
                                      <?php $j++; } ?>
                                      <td><strong><?php echo $ipdcountdater34count[0]->oldcount; ?></strong></td>
                                              
                                </tr>

                        <?php } ?> 
                    </tbody>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater34 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->Total; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdater34count[0]->totalcount; ?></strong></td>
                        
                    </tr>

<!-- 
                    <tr>
                        <td><strong>All Department Total</strong></td>
                        
                        <?php $k =0; foreach($ipdcountdater34 as $depart) { ?>

                            <td style="text-align:center">
                               <strong><?php echo $depart->Total; ?></strong>
                            </td>
                            
                        <?php  
                            $k++;
                        } ?>
                        <td><strong><?php echo $ipdcountdater34count[0]->totalcount; ?></strong></td>
                        
                    </tr> -->
                    
                </table>  <!-- /.table-responsive -->





            </div>
        </div>
    </div>
</div>
