<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div class="panel panel-default thumbnail">



            <div class="panel-heading">

                <div class="btn-group">

                    <a class="btn btn-success" href="<?php echo base_url("bed_manager/bed/form") ?>"> <i class="fa fa-plus"></i>  <?php echo display('add_bed') ?> </a>  

                </div>

            </div>



            <div class="panel-body">

                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th><?php echo display('serial') ?></th>
                            <th>Bed No</th>

                            <th>Name</th>

                            <th>gender</th>

                            <th>Department</th>

                            <th>Description</th>

                            <th>Status</th>

                            <th><?php echo display('action') ?></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($beds)) { ?>

                            <?php $sl = 1; ?>

                            <?php foreach ($beds as $bed) { ?>

                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $bed->id; ?></td>
                                    <td><?php echo $bed->name; ?></td>
                                     <td><?php echo $bed->gender; ?></td>
                                    <td><?php $deprtment=$this->db->select("*")

			                                   ->from('department_new')
			                                   ->where('dprt_id',$bed->department_id)
                                               ->get()
                                               ->row();
                                               echo $deprtment->name ?></td>

                                    <td><?php echo $bed->description; ?></td>

                                    <td><?php if($bed->status =='0'){echo "Inactive";}else { echo "Active"; } ?></td>

                                    <!--<td><?php echo (($bed->status==1)?display('active'):display('inactive')); ?></td>-->

                                    <td class="center">

                                        <a href="<?php echo base_url("bed_manager/bed/form/$bed->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 

                                        <!--<a href="<?php echo base_url("bed_manager/bed/delete/$bed->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a>--> 

                                    </td>

                                </tr>

                                <?php $sl++; ?>

                            <?php } ?> 

                        <?php } ?> 

                    </tbody>

                </table>  <!-- /.table-responsive -->
               <div class="dataTables_wrapper form-inline dt-bootstrap no-footer row" style="padding-left: 30px;">
               <?php foreach ($beds as $bed) {
               $deprtment=$this->db->select("*")
                               ->from('department_new')
			                   ->where('dprt_id',$bed->department_id)
                               ->get()
                               ->row();
                               
                                $patient_id=$this->db->select("*")
                               ->from('patient_ipd')
                               ->where('bed_status',1)
			                   ->where('bedNo',$bed->id)
                               ->get()
                               ->row();
                               
                              
                               if($deprtment->name=='Shalyatantra'){
                                   $short_name= 'SLY';
                               } else if($deprtment->name=='Shalakyatantra'){
                                   
                                    $short_name= 'SKY';
                               } else {
                                   
                                   $short_name= substr($deprtment->name,0,3);
                               }
               ?>
               <a href="<?php if($patient_id){ echo base_url('patients/ipdprofile/'.$patient_id->id); } ?>"><div class="col-md-1 form-control" style="text-align:center; width: 11%; <?php if($bed->status==1) { echo "background-color: #ff0000ba;"; }?>">
                   <span style='font-weight: 800;'><?php echo $bed->id."</span>"; echo " (".strtoupper($short_name." ".$bed->gender).")";?>
               </div></a>
              <?php } ?>
             </div>
            </div>

        </div>

    </div>

</div>

