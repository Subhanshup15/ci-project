<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<?php  echo error_reporting(0);?>
<?php ini_set('memory_limit', '-1');?>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

<form class="form-inline" id="datefilter" name="datefilter" method="GET" action="<?php echo base_url('PatientNew/deptopdgender'); ?>">
                                      
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
</div>
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">

                <div class="btn-group"> 
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
                <div class="btn-group">
                    <input id="myInput" class="form-control" type="text" placeholder="Search..">
                </div>                    

            </div>


            <div class="panel-body" style="font-size: 11px;">
            <div class="col-sm-12" align="center">  
                    
                <strong><?php echo $this->session->userdata('title') ?></strong>
                <p class="text-center"><?php echo $this->session->userdata('address') ?></p>
                
                
                <h3 style="margin-top: 0px; margin-bottom: 15px;"><?php echo "OPD Total Patient Gender Wise"; ?></h3>
                <h4 style="margin-top: 0px; margin-bottom: 15px;">Start Date:-  <?php echo date("d/m/Y", strtotime($datefrom))  ?>   To  <?php echo date("d/m/Y", strtotime($dateto)) ?> </h4>
            </div>

            
            
               
          
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2"><?php echo "Date" ?></th>
                            <?php foreach($department as $dept){ ?>
                            <th colspan="2"><?php echo $dept->name; ?></th>
                            <?php } ?>
                            <th rowspan="2"><?php echo "Total" ?></th>
                        </tr>
                        <tr>
                        <?php foreach($department as $dept){ ?>
                            <th>M</th>
                            <th>F</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $a = 1; 
                        $grand_total = 0; 
                        $male_total = 0;
                        $female_total = 0;

                        foreach ($dates as $date){ 
                        ?>
                            <tr>
                                <td><?php echo date('d-m-Y',strtotime($date)); ?></td>
                                <?php foreach($department as $dept){ ?>
                                <th>
                                <?php 
                                $male_count = $this->db->select('COUNT(*) AS MaleCount')->from('patient')->where('department_id',$dept->dprt_id)->where('create_date',$date)->where('sex','M')->where('ipd_opd','opd')->get()->row();
                                echo $male_count->MaleCount;
                                ?>
                                </th>
                                <th>
                                <?php 
                                $female_count = $this->db->select('COUNT(*) AS FemaleCount')->from('patient')->where('department_id',$dept->dprt_id)->where('create_date',$date)->where('sex','F')->where('ipd_opd','opd')->get()->row();
                                echo $female_count->FemaleCount;
                                ?>
                                </th>
                                <?php } ?>
                                <th>
                                 <?php 
                                $total = $this->db->select('COUNT(*) AS Total')->from('patient')->where('create_date',$date)->where('ipd_opd','opd')->get()->row();
                                echo $total->Total;
                                ?>
                                </th>
                            </tr>
                        <?php 
                        } ?>
                        <tr>
                        <th>Grand Total</th>
                            <?php 
                            $grand_total = 0;
                            foreach($department as $dept){ ?>
                                <th colspan='2'>
                                 <?php 
                                $total = $this->db->select('COUNT(*) AS Total')
                                ->from('patient')
                                ->where('create_date>=',$datefrom)
                                ->where('create_date<=',$dateto)
                                ->where('department_id',$dept->dprt_id)
                                ->where('ipd_opd','opd')
                                ->get()
                                ->row();
                                $grand_total += $total->Total;
                                echo $total->Total;
                                
                                ?>
                                </th>
                            <?php } ?>
                            <th><?php echo $grand_total; ?></th>
                        </tr>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>


<!-- OTP Submission -->
                    


                    <script>
                        $(function() {
                            var d = new Date();
                            $("#discharge_date").datetimepicker({  
                                showSecond: false,
                                timeFormat: 'hh:mm',
                            }).datetimepicker("setDate", new Date());
                        });
                    </script>

</script>