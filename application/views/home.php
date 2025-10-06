    <?php 
    defined('BASEPATH') OR exit('No direct script access allowed'); 
    //get site_align setting
    $settings = $this->db->select("site_align")
        ->get('setting')
        ->row();   
  if($this->session->userdata('acyear')== 2025){
          $departments = $this->db->select("*")
                ->from("department_new")
                ->order_by('dprt_id','asc')
                ->get()
                ->result();  

    } else{
$departments = $this->db->select("*")
                ->from("department")
                ->order_by('dprt_id','desc')
                ->get()
                ->result();  

    }
   

                     $user_role_id = $this->session->userdata('user_role');
                    $user_department_id = $this->session->userdata('department_id');
    ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="panel panel-bd">
                                <div class="panel-body">
                                    <div class="statistic-box">
                                        <?php 

                                            $section = 'opd';
                                            $year = '%'.$this->session->userdata['acyear'].'%';  


                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', $section);
                                            $this->db->where('yearly_reg_no !=','');
                                            $this->db->where('create_date LIKE', $year);
                                            $query = $this->db->get('patient');
                                            $num = $query->num_rows();
                                            
                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', $section);
                                            $this->db->where('old_reg_no !=','');
                                            $this->db->where('create_date LIKE', $year);
                                            $query = $this->db->get('patient');
                                            $num1 = $query->num_rows();
                                            //echo $num1;
                                        ?>
                                        <h2><span class="count-number"><?php echo $num + $num1; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                                        <div class="small">OPD Patient</div>
                                        <div class="sparkline2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                        <div class="panel-body">
                        <div class="statistic-box">
                            <?php 
                            $section = 'ipd';
                            $year = '%'.$this->session->userdata['acyear'].'%';  
                            $this->db->select('*');
                            $this->db->where('ipd_opd', $section);
                            $this->db->where('create_date LIKE', $year);
                            $query1 = $this->db->get('patient_ipd');
                            $num1 = $query1->num_rows();
                        // print_r($this->db->last_query());      
                            ?>
                            <!--<h2><span class="count-number"><?php  echo $num1; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>-->
                            <h2><span><?php  echo $num1; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>          
                            <div class="small">IPD Patient</div>
                            <div class="sparkline2"></div>
                            </div>
                        </div>
                </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="panel panel-bd">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <h2><span class="count-number"><?php echo (!empty($notify->total_app) ? $notify->total_app : null) ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                                    <div class="small"><?= display('appointment') ?></div>
                                    <div class="sparkline1"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="panel panel-bd">
                            <div class="panel-body">
                                <div class="statistic-box">
                                <h2><span class="count-number"><?php echo (!empty($notify->total_representative) ? $notify->total_representative : null) ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                                    <div class="small"><?= display('representative') ?></div>
                                <div class="sparkline4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



              <div class="row">
                    <!-- Total Product Sales area -->
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="panel panel-bd">
                            <div class="panel-body">
                                <div class="statistic-box">
                                    <?php 
                                        $section = 'opd';
                                        $year = '%'.$this->session->userdata['acyear'].'%';  
                                        $this->db->select('*');
                                        $this->db->where('ipd_opd', $section);
                                        $this->db->where('yearly_reg_no !=','');
                                        $this->db->where('create_date LIKE', $year);
                                        $query = $this->db->get('patient');
                                        $num = $query->num_rows();

                                        #22-12-2023
                                        $current_date = date('Y-m-d');

                                        $this->db->select('*');
                                        #$this->db->where('ipd_opd', $section);
                                        #$this->db->where('yearly_reg_no !=','');
                                        $this->db->where('create_date',$current_date);
                                        $query = $this->db->get('patient');
                                        $today_count = $query->num_rows();
                                        #print_r($this->db->last_query());die();
                                        #22-12-2023
                                        
                                        $this->db->select('*'); 
                                        $this->db->where('ipd_opd', $section);
                                        $this->db->where('old_reg_no !=','');
                                        $this->db->where('create_date LIKE', $year);
                                        $query = $this->db->get('patient');
                                        $num1 = $query->num_rows();
                                        //echo $num1;
                                    ?>
                                    <h2><span class="count-number"><?php echo $today_count; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                                    <div class="small">Today  OPD Patient</div>
                                    <div class="sparkline2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                

                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                <div class="panel panel-bd">
                                    <div class="panel-body">
                                    <div class="statistic-box">
                                        <?php 
                                        $section = 'ipd';
                                        $year = '%'.$this->session->userdata['acyear'].'%';  
                                        $this->db->select('*');
                                        $this->db->where('ipd_opd', $section);
                                        $this->db->where('create_date LIKE', $year);
                                        $query1 = $this->db->get('patient_ipd');
                                        $num1 = $query1->num_rows();
                                    // print_r($this->db->last_query());
                                        #22-12-2023
                                                $current_date = date('Y-m-d');
                                                $this->db->select('*');
                                                #$this->db->where('ipd_opd', $section);
                                                #$this->db->where('yearly_reg_no !=','');
                                                $this->db->where('create_date',$current_date);
                                                $query = $this->db->get('patient_ipd');
                                                $today_count = $query->num_rows();
                                                #print_r($this->db->last_query());die();
                                                #22-12-2023  
                                        ?>
                                        <!--<h2><span class="count-number"><?php  echo $num1; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>-->
                                        <h2><span><?php  echo $today_count; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                                        <div class="small"> Today IPD Patient</div>
                                        <div class="sparkline2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                    <div class="panel panel-bd">
                                        <div class="panel-body">
                                        <div class="statistic-box">
                                            <?php 
                                            $section = 'ipd';
                                            $year = '%'.$this->session->userdata['acyear'].'%';  
                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', $section);
                                            $this->db->where('create_date LIKE', $year);
                                            $query1 = $this->db->get('patient_ipd');
                                            $num1 = $query1->num_rows();
                                        // print_r($this->db->last_query());


                                            #22-12-2023
                                                    $current_date = date('Y-m-d');

                                                    $this->db->select('*');
                                                    #$this->db->where('ipd_opd', $section);
                                                    #$this->db->where('yearly_reg_no !=','');
                                                    $this->db->where('discharge_date',$current_date);
                                                    $query = $this->db->get('patient_ipd');
                                                    $today_count = $query->num_rows();
                                                    #print_r($this->db->last_query());die();
                                                    #22-12-2023
                                            
                                            ?>
                                            <!--<h2><span class="count-number"><?php  echo $num1; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>-->
                                            <h2><span><?php  echo $today_count; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>
                                            <div class="small"> Today Discharge Patient</div>
                                            <div class="sparkline2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                    <div class="panel panel-bd">
                                        <div class="panel-body">
                                        <div class="statistic-box">
                                            <?php 
                                            $section = 'ipd';
                                            $year = '%'.$this->session->userdata['acyear'].'%'; 
                                              $year1 = $this->session->userdata['acyear'];  
                                            $this->db->select('*');
                                            $this->db->where('ipd_opd', $section);
                                            $this->db->where('create_date LIKE', $year);
                                            $query1 = $this->db->get('patient_ipd');
                                            $num1 = $query1->num_rows();
                                        // print_r($this->db->last_query());


                                            #21-03-2024
                                                    $current_date = date('Y-m-d');

                                                   $this->db->select('*');
                                                    $this->db->where('YEAR(create_date)', $year1);
                                                    $this->db->where('discharge_date', '0000-00-00');
                                                    $query = $this->db->get('patient_ipd');
                                                    $On_bed_today_count = $query->num_rows();
                                                  #  print_r($this->db->last_query());
                                                       #21-03-2024
                                            
                                            ?>
                                            <!--<h2><span class="count-number"><?php  echo $num1; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i></span></h2>-->
                                            <h2 style='color:red;'><span><?php  echo $On_bed_today_count; ?></span> <span class="slight"><i class="fa fa-play fa-bed"> </i></span></h2>
                                            <div class="small"> On Bed Patient</div>
                                            <div class="sparkline2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>




<!--  OPD PAGE    -->
  
    <?php
    // Check if the user is an administrator or has access to the specific department
    $user_department_id1 = 0;
    $isAdminOrDepartmentUser = ($user_role_id == '1' || ($user_role_id == '2' && $user_department_id1 == $user_department_id));
   
        ?>

                            
      <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default" id="js-timer">
                    <div class="panel-body">
                        <div class="widget-title">
                            <h3 style="text-align: center; background-color: #0aefff;">
                               TODAY OPD
                            </h3>
                        </div>

                        <?php
                        // Common variables
                        $section = 'opd';
                        $year = '%' . $this->session->userdata['acyear'] . '%';

                        // Subquery to retrieve department-wise data
                        $subquery = $this->db
                            ->select('ROW_NUMBER() OVER (ORDER BY department_id DESC) AS sr_no, department_id')
                            ->select('SUM(CASE WHEN ipd_opd = "opd" AND DATE(create_date) = CURDATE() AND sex = "F" THEN 1 ELSE 0 END) AS female_count', false)
                            ->select('SUM(CASE WHEN ipd_opd = "opd" AND DATE(create_date) = CURDATE() AND sex = "M" THEN 1 ELSE 0 END) AS male_count', false)
                            ->select('SUM(CASE WHEN ipd_opd = "opd" AND DATE(create_date) = CURDATE() THEN 1 ELSE 0 END) AS yearly_reg_no_count', false)
                            ->from('patient')
                            ->where('DATE(create_date)', 'CURDATE()', false)
                            ->where('ipd_opd', 'opd');

                        // Filter by department only if the user role is 2
                        if ($user_role_id == '2') {
                            $subquery->where('department_id', $user_department_id);
                        }

                        $subquery->group_by('department_id')
                            ->order_by('department_id', 'DESC');

                        $subquery = $subquery->get_compiled_select();

                        // Main query to retrieve data
                        $query = $this->db->select('sr_no, department_id, male_count, female_count, yearly_reg_no_count')
                            ->from("($subquery) AS sub", null, false)
                            ->get();
                        $result = $query->result();
                        ?>

                        <table width="50%" id="patientdata" class="table table-striped table-bordered table-hover">
                              <thead>
                        <tr style="background-color: yellow;">
                            <th rowspan="2">S.No</th>
                            <th rowspan="2">Department</th>
                            <th rowspan="2">Male</th>
                            <th rowspan="2">Female</th>
                            <th rowspan="2">Total</th>
                        </tr>
                    </thead>
                            <tbody>
                                <?php
                                // Initialize total counts
                                $totalMaleNew = 0;
                                $totalFemaleNew = 0;
                                $grandTotal = 0;

                                foreach ($result as $row) {
                                    // Retrieve department information
                                    $dept_name = $this->db->select("name")
                                        ->from('department_new')
                                        ->where('dprt_id', $row->department_id)
                                        ->get()
                                        ->row();

                                    // Output table rows
                                    ?>
                                    <tr>
                                        <td><?= $row->sr_no; ?></td>
                                        <td><?= $dept_name->name; ?></td>
                                        <td><?= $row->male_count; ?></td>
                                        <td><?= $row->female_count; ?></td>
                                        <td><?= $row->yearly_reg_no_count; ?></td>
                                    </tr>
                                    <?php
                                    // Update total counts
                                    $totalMaleNew += $row->male_count;
                                    $totalFemaleNew += $row->female_count;
                                    $grandTotal += $row->yearly_reg_no_count;
                                }
                                ?>

                                 <!-- Grand Total Row -->
                        <tr>
                            <td style="background-color: #a2d2ff;" colspan="2">Grand Total</td>
                            <td><?= $totalMaleNew; ?></td>
                            <td><?= $totalFemaleNew; ?></td>
                            <td style="background-color: #d8e2dc;"><?= $grandTotal; ?></td>
                        </tr>
                                <!-- ... Rest of the table remains unchanged ... -->

                            </tbody>
                        </table>
 


                            <?php
                            // Common variables
                            $section = 'opd';
                             $year = '%' . $this->session->userdata['acyear'] . '%';
                            $current_date = date('Y-m-d'); // Get the current date
                            

                            // Subquery to retrieve department-wise data
                            $subquery = $this->db
                                ->select('ROW_NUMBER() OVER (ORDER BY department_id DESC) AS sr_no, department_id')
                                ->select('COUNT(CASE WHEN ipd_opd = "opd" AND DATE(create_date) = "' . $current_date . '" THEN yearly_reg_no ELSE 0 END) AS yearly_reg_no', false)
                                ->select('COUNT(CASE WHEN ipd_opd = "opd" AND DATE(create_date) = "' . $current_date . '" THEN old_reg_no ELSE 0 END) AS old_reg_no', false)
                                ->select('COUNT(CASE WHEN ipd_opd = "opd" AND DATE(create_date) = "' . $current_date . '" THEN 1 ELSE 0 END) AS yearly_reg_no_count', false)
                                ->from('patient')
                                ->where('DATE(create_date)', $current_date)
                                ->where('ipd_opd', 'opd');
                                              
                            // Filter by department only if the user role is 2
                            if ($user_role_id == '2') {
                                $subquery->where('department_id', $user_department_id);
                            }

                            $subquery->group_by('department_id')
                                ->order_by('department_id', 'DESC');

                            $subquery = $subquery->get_compiled_select();

                            // Main query to retrieve data
                            $query = $this->db->select('sr_no, department_id, yearly_reg_no, old_reg_no, yearly_reg_no_count')
                                ->from("($subquery) AS sub", null, false)
                                ->get();
                            $result = $query->result();
                          #  print_r($this->db->last_query());
                            ?>
                   <div class="widget-title">
                            <h3 style="text-align: center; background-color: #0aefff;">
                               TODAY OPD  (NEW AND FOLLOW-UP PATIETN )
                            </h3>
                        </div>
                            <table width="50%" id="patientdata" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr style="background-color: yellow;">
                                        <th rowspan="2">S.No</th>
                                        <th rowspan="2">Department</th>
                                        <th rowspan="2">New</th>
                                        <th rowspan="2">Follow</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Initialize total counts
                                    $yearly_reg_no_total = 0;
                                    $old_reg_no_total = 0;
                                    $grandTotal = 0;

                                    foreach ($result as $row) {
                                        // Retrieve department information
                                        $dept_name = $this->db->select("name")
                                            ->from('department_new')
                                            ->where('dprt_id', $row->department_id)
                                            ->get()
                                            ->row();

                                        // Output table rows
                                    ?>
                                        <tr>
                                            <td><?= $row->sr_no; ?></td>
                                            <td><?= $dept_name->name; ?></td>
                                            <td><?= $row->yearly_reg_no; ?></td>
                                            <td><?= $row->old_reg_no; ?></td>
                                            <td><?= $row->yearly_reg_no_count; ?></td>
                                        </tr>
                                    <?php
                                        // Update total counts
                                        $yearly_reg_no_total += $row->yearly_reg_no;
                                        $old_reg_no_total += $row->old_reg_no;
                                        $grandTotal += $row->yearly_reg_no_count;
                                    }
                                    ?>

                                    <!-- Grand Total Row -->
                                    <tr>
                                        <td style="background-color: #a2d2ff;" colspan="2">Grand Total</td>
                                        <td><?= $yearly_reg_no_total; ?></td>
                                        <td><?= $old_reg_no_total; ?></td>
                                        <td style="background-color: #d8e2dc;"><?= $grandTotal; ?></td>
                                    </tr>
                                    <!-- ... Rest of the table remains unchanged ... -->

                                </tbody>
                            </table>



 
                        <canvas id="lineChart" height="170"></canvas>
                    </div> <!-- /.panel-body -->
                </div>
            </div>
        
                                        

<!--  OPD PAGE   END  -->


<!-- IPD PAGE          -->




    <div class="col-lg-6">

        <div class="panel panel-default" id="js-timer">

            <div class="panel-body">

                <div class="widget-title">
                    <h3 style="text-align: center; background-color: #b7ffd8;">TODAY IPD</h3>
                </div>
              <?php
$section = 'ipd';
$year = '%' . $this->session->userdata['acyear'] . '%';

// Start building the subquery
$subquery = $this->db
    ->select('ROW_NUMBER() OVER (ORDER BY department_id DESC) AS sr_no, department_id')
    ->select('SUM(CASE WHEN ipd_opd = "ipd" AND DATE(create_date) = CURRENT_DATE AND sex = "F" THEN 1 ELSE 0 END) AS female_count', false)
    ->select('SUM(CASE WHEN ipd_opd = "ipd" AND DATE(create_date) = CURRENT_DATE AND sex = "M" THEN 1 ELSE 0 END) AS male_count', false)
    ->select('SUM(CASE WHEN ipd_opd = "ipd" AND DATE(create_date) = CURRENT_DATE THEN 1 ELSE 0 END) AS yearly_reg_no_count', false)
    ->from('patient_ipd')
    ->where('DATE(create_date)', 'CURRENT_DATE', false)
    ->where('ipd_opd', 'ipd');

// Filter by department only if the user role is 2
if ($user_role_id == '2') {
    $subquery->where('department_id', $user_department_id);
}

$subquery->group_by('department_id')
    ->order_by('department_id DESC');

// Get the compiled select statement
$subquery = $subquery->get_compiled_select();

// Use the subquery in the main query
$query = $this->db->select('sr_no, department_id, male_count, female_count, yearly_reg_no_count')
    ->from("($subquery) AS sub", null, false)
    ->get();

$result = $query->result();
?>

                <table width="50%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="background-color: yellow;">
                            <th rowspan="2">S.No</th>
                            <th rowspan="2">Department</th>
                            <th rowspan="2">Male</th>
                            <th rowspan="2">Female</th>
                            <th rowspan="2">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $totalMaleNew = 0;
                        $totalFemaleNew = 0;
                        $grandTotal = 0;

                        foreach ($result as $row) {
                            // Retrieve department information
                            $dept_name = $this->db->select("name")
                                ->from('department_new')
                                ->where('dprt_id', $row->department_id)
                                ->get()
                                ->row();

                            // Output table rows
                        ?>
                            <tr>
                                <td><?= $row->sr_no; ?></td>
                                <td><?= $dept_name->name; ?></td>
                                <td><?= $row->male_count; ?></td>
                                <td><?= $row->female_count; ?></td>
                                <td><?= $row->yearly_reg_no_count; ?></td>
                            </tr>
                        <?php
                            $totalMaleNew += $row->male_count;
                            $totalFemaleNew += $row->female_count;
                            $grandTotal += $row->yearly_reg_no_count;
                        }
                        ?>

                        <!-- Grand Total Row -->
                        <tr>
                            <td style="background-color: #a2d2ff;" colspan="2">Grand Total</td>
                            <td><?= $totalMaleNew; ?></td>
                            <td><?= $totalFemaleNew; ?></td>
                            <td style="background-color: #d8e2dc;"><?= $grandTotal; ?></td>
                        </tr>

                        <?php
                        // Check if both male and female counts are zero
                        if ($totalMaleNew == 0 && $totalFemaleNew == 0) :
                        ?>
                            <tr>
                                <td colspan="5">No males or females</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>



       <div class="widget-title">
                    <h3 style="text-align: center; background-color: #c1fba4;">TODAY DISCHARGE IPD</h3>
                </div>
              <?php
$section = 'ipd';
$year = '%' . $this->session->userdata['acyear'] . '%';

// Start building the subquery
$subquery = $this->db
    ->select('ROW_NUMBER() OVER (ORDER BY department_id DESC) AS sr_no, department_id')
    ->select('SUM(CASE WHEN ipd_opd = "ipd" AND DATE(discharge_date) = CURRENT_DATE AND sex = "F" THEN 1 ELSE 0 END) AS female_count', false)
    ->select('SUM(CASE WHEN ipd_opd = "ipd" AND DATE(discharge_date) = CURRENT_DATE AND sex = "M" THEN 1 ELSE 0 END) AS male_count', false)
    ->select('SUM(CASE WHEN ipd_opd = "ipd" AND DATE(discharge_date) = CURRENT_DATE THEN 1 ELSE 0 END) AS yearly_reg_no_count', false)
    ->from('patient_ipd')
    ->where('DATE(discharge_date)', 'CURRENT_DATE', false)
    ->where('ipd_opd', 'ipd');

// Filter by department only if the user role is 2
if ($user_role_id == '2') {
    $subquery->where('department_id', $user_department_id);
}

$subquery->group_by('department_id')
    ->order_by('department_id DESC');

// Get the compiled select statement
$subquery = $subquery->get_compiled_select();

// Use the subquery in the main query
$query = $this->db->select('sr_no, department_id, male_count, female_count, yearly_reg_no_count')
    ->from("($subquery) AS sub", null, false)
    ->get();

$result = $query->result();
?>

                <table width="50%" id="patientdata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr style="background-color: yellow;">
                            <th rowspan="2">S.No</th>
                            <th rowspan="2">Department</th>
                            <th rowspan="2">Male</th>
                            <th rowspan="2">Female</th>
                            <th rowspan="2">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $totalMaleNew = 0;
                        $totalFemaleNew = 0;
                        $grandTotal = 0;

                        foreach ($result as $row) {
                            // Retrieve department information
                            $dept_name = $this->db->select("name")
                                ->from('department_new')
                                ->where('dprt_id', $row->department_id)
                                ->get()
                                ->row();

                            // Output table rows
                        ?>
                            <tr>
                                <td><?= $row->sr_no; ?></td>
                                <td><?= $dept_name->name; ?></td>
                                <td><?= $row->male_count; ?></td>
                                <td><?= $row->female_count; ?></td>
                                <td><?= $row->yearly_reg_no_count; ?></td>
                            </tr>
                        <?php
                            $totalMaleNew += $row->male_count;
                            $totalFemaleNew += $row->female_count;
                            $grandTotal += $row->yearly_reg_no_count;
                        }
                        ?>

                        <!-- Grand Total Row -->
                        <tr>
                            <td style="background-color: #a2d2ff;" colspan="2">Grand Total</td>
                            <td><?= $totalMaleNew; ?></td>
                            <td><?= $totalFemaleNew; ?></td>
                            <td style="background-color: #d8e2dc;"><?= $grandTotal; ?></td>
                        </tr>

                        <?php
                        // Check if both male and female counts are zero
                        if ($totalMaleNew == 0 && $totalFemaleNew == 0) :
                        ?>
                            <tr>
                                <td colspan="5">No males or females</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <canvas id="lineChart" height="100"></canvas>

            </div> <!-- /.panel-body -->

        </div>

    </div>
    
    <!-- /.row --> 

</div> <!-- /.row -->

 
</div>
 
<!-- IPD PAGE  END --> 


<script type="text/javascript"> 

    $(window).on('load', function(){

        //line chart

        var ctx = document.getElementById("lineChart");

        var myChart = new Chart(ctx, {

            type: 'line',

            data: {

                labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],

                datasets: [

                    {

                        label: "Patient",

                        borderColor: "#2C3136",

                        borderWidth: "1",

                        backgroundColor: "rgba(0,0,0,.07)",

                        pointHighlightStroke: "rgba(26,179,148,1)",

                        data: [

                            <?php 

                            if (!empty($chart[0])) {

                                for ($i=0; $i < 12 ; $i++) { 

                                   echo (!empty($chart[0][$i])?$chart[0][$i]->patient:0).", ";

                                }

                            }

                            ?>

                        ]

                    },

                    {

                        label: "Appointment",

                        borderColor: "#73BC4D",

                        borderWidth: "1",

                        backgroundColor: "#73BC4D",

                        pointHighlightStroke: "rgba(26,179,148,1)",

                        data: [

                            <?php

                            if (!empty($chart[1])) {

                                for ($i=0; $i < 12 ; $i++) { 

                                   echo (!empty($chart[1][$i])?$chart[1][$i]->appointment:0).", ";

                                }

                            } 

                            ?> 

                        ]

                    }

                ]

            },

            options: {

                responsive: true,

                tooltips: {

                    mode: 'index',

                    intersect: false

                },

                hover: {

                    mode: 'nearest',

                    intersect: true

                }



            }

        });

    });

</script>

 