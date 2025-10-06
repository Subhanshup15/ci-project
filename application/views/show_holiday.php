<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<div class="row">
    
<div class="col-sm-12" id="PrintMe">

        <div  class="panel panel-default thumbnail">
 
          
            <div class="panel-body">
           
                <table width="100%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>                
                            <th style="width: 30px;">Sr No.</th>
                            <th style="width: 30px;">Holiday Date</th>                                                                                   
                            <th style="width: 30px;">Description</th> 
                            <th style="width: 30px;">Action</th>
                                                   
                        </tr>
                    </thead>
                    <tbody>
                        <?php $m = 1; foreach ($patients as $patient) { $i++; ?>
                                <tr class="">
                                    <td><?php echo $m++; ?></td>
                                    <td><?php echo $patient->holiday_date; ?></td>
                                    <td><?php echo $patient->description ?></td>
                                    
                                   
                                    <td class="">
                                        <a href="<?php echo base_url("patient/edit/$patient->id/ipd") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Edit</a> 
                                        <a href="<?php echo base_url("patient/delete/$patient->id/ipd") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>')"><i class="fa fa-trash"></i>Delete</a> 
                                           
                                    </td>                                     
                                </tr>
                                <?php $m++; ?>
                            <?php } ?> 
                       
                    </tbody>
                </table>  <!-- /.table-responsive -->
              
              
				
               
                    <thead>
                        <tr>             
                            <th><?php echo "S. No" ?></th>
                            <th><?php echo "Department Name" ?></th>                            
                            <th><?php echo "Gender" ?></th>                            
                            <th><?php echo "New Patient" ?></th>                       
                            <th><?php echo "Old Patient" ?></th>  
                            <th><?php echo "Total Count" ?></th>                     
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if (!empty($gendercount)) { ?>
                            <?php $sl = 12141;

?>
                            <?php $i = 0; foreach ($gendercount as $patient) { $i++; ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">                                   
                                    <td><?php echo $i;?> </td>
                                    <td><?php echo $patient->name; ?></td> <!-- //patient_id yearly sr no -->
                                    <td><?php echo $patient->sex; ?></td>
                                    
                                    <td><?php echo $patient->New; ?></td>
                                    <td><?php echo $patient->old; ?></td>  
                                    
                                    <td><?php echo $patient->Gender; ?></td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                    
                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Grand Total</td>
                                    <td><strong><?php echo $gendercounttotal[0]->totalNew;  ?></strong></td>
                                    <td><strong><?php echo $gendercounttotal[0]->totalold;  ?></strong></td>
                                    <td><strong><?php echo $gendercounttotal[0]->totalGender;  ?></strong></td>
                                </tr>
                </table>  <!-- /.table-responsive -->
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

                                
								$.ajax({
                                 url : "<?php echo base_url(); ?>patient/dischargedate/"+yearly_reg_no+ 
                                 type : "POST",
                                 dataType : "json",
                                  data : {"discharge_date" : discharge_date, "yearly_reg_no" : yearly_reg_no},
                                  success : function(data) {
									  alert(data);
                                // do something
                                    },
                                 error : function(data) {
                                   // do something
                                    }
                                 });
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
</script>