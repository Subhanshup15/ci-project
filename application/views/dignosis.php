<div class="row">

    <!--  table area -->

    <div class="col-sm-12">

        <div  class="panel panel-default thumbnail">

 

            <!--<div class="panel-heading no-print">

                <div class="btn-group"> 

                    <a class="btn btn-success" href="<?php echo base_url("dignosis/createdignosis") ?>"> <i class="fa fa-plus"></i>  Add dignosis </a>  

                </div>

            </div>-->

            <div class="panel-body">

                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>

                        <tr>

                            <th><?php echo display('serial') ?></th>

                            <th>Name</th>

                            <th>Description</th>

                            <!-- <th><?//php echo display('status') ?></th> -->

                            <!--<th><?//php echo display('action') ?></th>-->

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($dignosis)) { ?>

                            <?php $sl = 1; ?>

                            <?php foreach ($dignosis as $dignosi) { ?>

                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>

                                    <td><?php echo $dignosi->dignosis; ?></td>

                                    <!--<td><?php echo character_limiter($dignosi->description, 60); ?></td>-->
                                    <td></td>

                                    <!-- <td><?php echo (($dignosi->status==1)?display('active'):display('inactive')); ?></td> -->

                                    <!--<td class="center">-->

                                        <!--<a href="<?//php echo base_url("dignosis/edit_dignosis/$dignosi->id_digno") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> -->
                                        <!--<a href="<?//php echo base_url("dignosis/edit_dignosis/$dignosi->id") ?>" class="btn btn-xs  btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?//php echo base_url("dignosis/delete_dignosis/$dignosi->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a>
                                        --><!--<a href="<?//php echo base_url("dignosis/delete_dignosis/$dignosi->id_digno") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-xs  btn-danger"><i class="fa fa-trash"></i></a> -->

                                    <!--</td>-->

                                </tr>

                                <?php $sl++; ?>

                            <?php } ?> 

                        <?php } ?> 

                    </tbody>

                </table>  <!-- /.table-responsive -->

            </div>

        </div>

    </div>

</div>

