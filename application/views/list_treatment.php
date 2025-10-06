<?php error_reporting(0); ?>
<div class="row">
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-body">
                <table class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo display('serial') ?></th>
                            <th>Name</th>
                          <!--  <th>Department Name</th> -->
                            <th>RX1</th>
                            <th>RX2</th>
                            <th>RX3</th>
                            <th>RX4</th>
                            <th>RX5</th>
                            <th>IPD/OPD</th>
                        </tr>
                    </thead>
                            <?php
                            // $dept_name = $this->db
                            // ->select('dprt_id,name as department_name')
                            // ->where('dprt_id',$dignosi->department_id)
                            // ->get('department')
                            // ->row();
                                #  print_r($this->db->last_query());
                            ?>
                    <tbody>
                        <?php if (!empty($dignosis)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($dignosis as $dignosi) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">

                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $dignosi->dignosis; ?></td>
                                 <!--   <td><?php echo $dignosi->department_id; ?></td> -->
                                    <th><?php echo $dignosi->RX1; ?></th>
                                    <th><?php echo $dignosi->RX2; ?></th>
                                    <th><?php echo $dignosi->RX3; ?></th>
                                    <th><?php echo $dignosi->RX4; ?></th>
                                    <th><?php echo $dignosi->RX5; ?></th>
                                    <th><?php echo $dignosi->ipd_opd; ?></th>
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

