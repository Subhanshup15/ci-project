<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print row">
                <div class="btn-group col-md-2"> 
                    <a class="btn btn-success" href="<?php echo base_url("acyear/create") ?>"> <i class="fa fa-plus"></i> Add Acadmic Year </a>  
                </div>
            </div>
        </div>
        <div class="panel-body">
                <table width="100%" id="patientdata" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>      
                            <th>Sr no</th>      
                            <th>Acadmic year</th>
                            <th><?php echo display('action') ?></th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($acyears)) { ?>
                            <?php $sl = 12141; ?>
                            <?php $i = 0; foreach ($acyears as $acyear) { $i++; ?>                               
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $acyear->year ?></td> <!-- //patient_id yearly sr no -->
                                    <td class="center">
                                        <a href="<?php echo base_url("acyear/delete/$acyear->id") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i></a> 
                                    </td> 
                                </tr>
                            <?php } ?>    
                        <?php } ?>    

                        
                    </tbody>
                <table>    
        </div>           
    </div>
</div>    
