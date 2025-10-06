<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sunday_casuality extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'dashboard_model',
            'setting_model',
            'department_model',
            'patient_model'
        )); 
    }
    
    public function cvb()
    {
         echo "asda";
    }
     
    public function data_push_2019()
    {
         error_reporting(0);
         echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
           date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
           echo date('d-m-Y H:i:s');
           echo "<script>
            $(document).ready(function () 
            {
              setTimeout('location.reload(true);', '5000');
            });
         </script>";
         
        $dbHost = "localhost";
        $dbDatabase = "srpayurved_db";
        $dbPasswrod = "gJXdRod3AOlyp4c9";
        $dbUser = "srpayurved_db";
        $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
        $mysqli -> character_set_name();
        $mysqli -> set_charset("utf8");
    
        //Prints the day
        date_default_timezone_set('Asia/kolkata');
        $last_date_insert="SELECT * FROM  patient ORDER BY id DESC LIMIT 1;";
        $last_date_insert_r = $mysqli->query($last_date_insert);
        $last_date_insert_row1=$last_date_insert_r->fetch_assoc();
        echo "last_date_insert".$late_date=$last_date_insert_row1['create_date'];

        // $c_date = date("Y-m-d");
        // if($c_date >= $late_date5){
        //$late_date = date('Y-m-d', strtotime("+1 days", strtotime($late_date5)));
        // }elseif($c_date <= $late_date5){
        //     $late_date = date('Y-m-d', strtotime("+1 days", strtotime($late_date5)));
        // }

        $holiday_date_new="select * from holiday where holiday_date='$late_date'";
        $holiday_date_new_r = $mysqli->query($holiday_date_new);
        $holiday_date_new_row1=$holiday_date_new_r->fetch_assoc();
        //  echo $holiday_date_new_row1['holiday_date'];
        $last_date = date("Y-m-d",strtotime($late_date));
        $last_date_holiday = date("Y-m-d",strtotime($holiday_date_new_row1['holiday_date']));
        if($last_date_holiday == $last_date || date("D",strtotime($late_date)) == 'Sun')
         {
            // echo "hiiiiii";
            $dlp = "SELECT * FROM holiday_data_limit";
            $dlp1 = $mysqli->query($dlp);
            $dlp11=$dlp1->fetch_assoc();
            $dlt=$dlp11['data_limit'];
            $dlt1=$dlt ;
        }
        else
        {
            $dlp = "SELECT * FROM data_limit";
            $dlp1 = $mysqli->query($dlp);
            $dlp11=$dlp1->fetch_assoc();
            $dlt=$dlp11['data_limit'];
            $dlt1=$dlt;
        }
        
        echo $last_date_count = "SELECT * FROM  patient where create_date='$late_date';";
         $last_date_count_r = $mysqli->query($last_date_count);
        //  echo "<br>";
          $last_date_count_num_rows = mysqli_num_rows($last_date_count_r);
        // echo "<br>";
        $dlt1_new =  $dlt1 - 15;
        // die();


         $current_date_new = date("Y-m-d");

         if($current_date_new == $last_date)
         {
                $late_date=$last_date;
         }else
         {
         if($last_date_count_num_rows > $dlt1_new)
            {
            
            echo $late_date = date('Y-m-d', strtotime("+1 days", strtotime($late_date)));
             //echo $late_date = date('Y-m-d', strtotime("0 days", strtotime($late_date)));
            $sunday = date('D',strtotime($late_date));
            }
        else
        {

           // echo "hiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii";
         
         $holidayList = "Select holiday_date from holiday";
         $result= $mysqli->query($holidayList);
         //$resHoliday=$result->fetch_array();
         while($row = mysqli_fetch_array($result))
         {
             $data[] = $row; 
         }

//die();
       //print_r($data);
       //die();
       for($i=0; $i<count($data); $i++)
       {
                $sunday = date('D',strtotime($late_date));
                    if(date('Y-m-d',strtotime($data[$i]['holiday_date'])) == date('Y-m-d',strtotime($late_date)) || $sunday == 'Sun')
                    {
                         $sunday = date('D',strtotime($late_date));
                       // $late_date = date('Y-m-d', strtotime("+1 days", strtotime($late_date)));
                          
                            $late_date=$late_date;
                             
                            $holiday = 'holiday';
                        
                    }
                }
            }
         }
           
            echo "last_date_insert_11 =====> ".$late_date;

           
            //CJOB Auto Push Code Start -------------------------------------------------------
            $time_date=date('H:i:s');
            $tempDate = date('Y-m-d');
            $tempDate1 = date('Y-m-d', strtotime("-1 days", strtotime($tempDate)));

            $dt1=$tempDate1;
            $dt2='%'.$dt1.'%';
            $sqlQuery1 = "SELECT * FROM patient WHERE create_date LIKE '$dt2'";
            $sqlQueryRes1 = $mysqli->query($sqlQuery1);
            $sqlQueryRowCount1=mysqli_num_rows($sqlQueryRes1);
            
            $sqlQuery2 = "SELECT * FROM patient_ipd WHERE create_date LIKE '$dt2'";
            $sqlQueryRes2 = $mysqli->query($sqlQuery2);
            $sqlQueryRowCount2=mysqli_num_rows($sqlQueryRes2);
            $finalSqlQueryRowCount=$sqlQueryRowCount1 + $sqlQueryRowCount2;
        
            // addition of opd and ipd patient for that specific date $finalSqlQueryRowCount

                // Today's patient master limit 
                $dlp = "SELECT * FROM data_limit";
                $dlp1 = $mysqli->query($dlp);
                $dlp11=$dlp1->fetch_assoc();
                $dlt=$dlp11['data_limit'];
                $dlt1=$dlt - 15;
                ///////// $dlt1 this variable stands for daily opd limit  //////////

                $late_date_convert=date('Y-m-d',strtotime($late_date));
                $ldt1=$late_date_convert;
                $ldt2='%'.$ldt1.'%';
                $lSqlQuery1 = "SELECT * FROM patient WHERE create_date LIKE '$ldt2'";
                $lSqlQueryRes1 = $mysqli->query($lSqlQuery1);
                $lSqlQueryRowCount1=mysqli_num_rows($lSqlQueryRes1);
                
                $lSqlQuery2 = "SELECT * FROM patient_ipd WHERE create_date LIKE '$ldt2'";
                $lSqlQueryRes2 = $mysqli->query($lSqlQuery2);
                $lSqlQueryRowCount2=mysqli_num_rows($lSqlQueryRes2);
                $lFinalSqlQueryRowCount=$lSqlQueryRowCount1 + $lSqlQueryRowCount2;
            
                // Today's patient master limit 
                $ldlp = "SELECT * FROM data_limit";
                $ldlp1 = $mysqli->query($ldlp);
                $ldlp11=$ldlp1->fetch_assoc();
                $ldlt=$ldlp11['data_limit'];
                $ldlt1=$ldlt - 15;
                
                if($lFinalSqlQueryRowCount > $ldlt1)
                {
                    //set holiday
                    $opd_ipd_time = "SELECT * FROM `holiday`";
                    $opd_ipd_time1 = $mysqli->query($opd_ipd_time);
                    
                    while($row = mysqli_fetch_array($opd_ipd_time1))
                    {
                        $data[] = $row; 
                    }
                    
                    for($i=0;$i<count($data);$i++)
                    {
                        $data[$i]['holiday_date'];
                        $holiday_date=date('Y-m-d', strtotime("+1 days", strtotime($late_date_convert)));
                        if(date('Y-m-d',strtotime($holiday_date)) == date('Y-m-d',strtotime($data[$i]['holiday_date'])))
                        {
                            $holiday="holiday";
                        }
                    }
                  
                }
                
                $ADV_DAY=$late_date_convert; //Working Code
                $ADV_DAY1=$late_date_convert; //Working Code
                echo "<br>";
                echo "CR======>";
                echo $ADV_DAY;
                echo "======>";
                echo $ADV_DAY1;
                echo "===>";
                echo "Back Dated Data";
                echo "<br>";
                
                $start_time_m= date('H:i:s',strtotime('01:00:00'));
                $end_time_m= date('H:i:s',strtotime('23:55:45'));
                $start_time_e= date('H:i:s',strtotime('03:00:00'));
                $end_time_e= date('H:i:s',strtotime('23:30:00'));
        
        // CJOB Auto push code End -----------------------------------------------------------------
        
        if($ADV_DAY1 >='2024-12-31')
        {
            exit;
        }
        echo  "current date ".$date = $ADV_DAY;
        echo "<br>";
        echo "strat date morning ".$date1=$ADV_DAY1;
        
        echo "<br>";
        echo "end date morning".$date2 = $ADV_DAY1;
        echo "<br>";
        
        echo "strat date evening ".$date33=$ADV_DAY1;
        echo "<br>";
        echo "end date evening".$date44 = $ADV_DAY1;
        echo "<br>";
        echo "Today is ".$w_day1 = date('D',strtotime($ADV_DAY1))."<br>";
        
        $w_day= date('D',strtotime($ADV_DAY1));
        
        //end set holiday
        if(($date1 <= $date) && ($date2 >= $date))
        { echo "Yes";}
                $auto_on_off = "SELECT * FROM auto_on_off";
                $auto_on_off1 = $mysqli->query($auto_on_off);
                $auto_on_off2=$auto_on_off1->fetch_assoc();
                $auto_on_off3=$auto_on_off2['status'];
        
                $date3=$ADV_DAY1;
                $date22='%'.$date3.'%';
                 $sql2 = "SELECT * FROM patient WHERE create_date LIKE '$date22'";
                $result2 = $mysqli->query($sql2);
                $rowcount=mysqli_num_rows($result2);
                
                $sql22 = "SELECT * FROM patient_ipd WHERE create_date LIKE '$date22'";
                $result22 = $mysqli->query($sql22);
                $rowcount1=mysqli_num_rows($result22);
                $rowcount_two=$rowcount + $rowcount1;
                //$rowcount_two=$rowcount;
                echo "<br>";
                echo "today's count ".$rowcount_two."<br>";
        
                // Today's patient master limit 
                $data_limit_patient = "SELECT * FROM data_limit";
                $data_limit_patient1 = $mysqli->query($data_limit_patient);
                $data_limit_patient11=$data_limit_patient1->fetch_assoc();
                $data_limit=$data_limit_patient11['data_limit'];
                $data_limit1=$data_limit - 15;
                $rand_data_limit=rand($data_limit1,$data_limit);
                
                echo "<br>data_limit ".$data_limit."<br>";
                echo "<br>data_limit1 ".$data_limit1."<br>";
                echo "<br>rand_data_limit ".$rand_data_limit."<br>";
                // end Today's patient master limit
       
            
                $today_limit_day='%'.$ADV_DAY1.'%';
                // today's opd(new/old) limit
                $today_old = "SELECT * FROM patient WHERE flag='1' AND create_date LIKE  '$today_limit_day'";
                $today_old1 = $mysqli->query($today_old);
                $result_t_old = $today_old1->num_rows;
                echo "today old count". $result_t_old;
                
                $today_new = "SELECT * FROM patient WHERE flag='0' AND create_date LIKE  '$today_limit_day'";
                $today_new1 = $mysqli->query($today_new);
                $result_t_new = $today_new1->num_rows;
                echo "today new count". $result_t_new;
            // end today's opd(new/old) limit
        
            // today's opd(new/old) percentage
                //$today_old_percentage=round($data_limit * (40/100));
                $today_old_percentage = '0';
                $today_new_percentage=round($data_limit * (60/100));
                /*$today_new_percentage_M=round($today_new_percentage*(60/100));
                $today_old_percentage_M=round($today_old_percentage*(60/100));*/
               // $today_new_percentage_M=round($today_new_percentage*(100/100));
               $today_new_percentage_M = '0';
                $today_old_percentage_M=round($today_old_percentage*(100/100));
                echo "<br>today new percentge limit ".$today_new_percentage."<br>";
                echo "<br>today old percentge limit ".$today_old_percentage."<br>";
                echo "<br>today new percentge limit Morning ".$today_new_percentage_M."<br>";
                echo "<br>today old percentge limit Morning ".$today_old_percentage_M."<br>";
                
            
            // end today's opd(new/old) percentage
            
                
                
        if($auto_on_off3=='0')
        {
            echo "Date  ==>".$date; echo "<br>";
      echo "Date1  ==>".$date1; echo "<br>";
      echo "Date2  ==>".$date2; echo "<br>";

      echo "Push date  ==>".$ADV_DAY1; echo "<br>";
      echo "ipd opd row count  ==>".$rowcount_two; echo "<br>";
      echo "Random Limit  ==>".$rand_data_limit; echo "<br>";


        if(($date1 <= $date) && ($date2 >= $date) && ($ADV_DAY1) && ($rowcount_two<=$rand_data_limit))
        { //echo "hiiiiii";
        
            $rand=rand(6,9);
            echo "<br>";
            echo "old ipd rand day ".$rand."<br>";
            $old_date=date('Y-m-d', strtotime("-$rand days", strtotime($ADV_DAY1)));
        
            $old_date1='%'.$old_date.'%';
            $old_rand=rand(1,2);
            
        $sql1="SELECT * FROM  patient WHERE  yearly_reg_no !='' ORDER BY id DESC LIMIT 1;";
        $result1 = $mysqli->query($sql1);
        $row1=$result1->fetch_assoc();
        echo "Sr no is ".$srno=$row1['yearly_reg_no'];
        if(empty($srno)){
            $srno=0; 
        }else{
            $srno=$row1['yearly_reg_no'];
        }
            echo "Sr no is real ".$srno;
            $rand=rand(5,8);
            echo "<br>";
            echo "old ipd rand day ".$rand."<br>";
            $old_date=date('Y-m-d', strtotime("-$rand days", strtotime($ADV_DAY1)));
            // date('Y-m-d', strtotime("-$rand days", strtotime($ADV_DAY1)));
            
            // $old_date1='%'.$old_date.'%';
            // $old_rand=rand(1,2);
            // // $old_date1 = "SELECT * FROM patient WHERE flag= 0 AND department_id!='35'  AND create_date LIKE  '$old_date1' AND yearly_reg_no !='' ORDER BY rand(id)  LIMIT  $old_rand";
            // echo $old_date1 = "SELECT * FROM patient WHERE flag = 0 AND department_id!='35'  AND manual_status='0' AND  create_date LIKE  '$old_date1' AND yearly_reg_no !=''  or created_by = '' ORDER BY rand(id)  LIMIT  $old_rand";
            // $result11 = $mysqli->query($old_date1);
            // // $row1=$result11->fetch_assoc();
            // //$old_date111=$row1['created_date'];
            
            // echo "old_record is ".$result11->num_rows;
            
            
            // if ($result11->num_rows > 0) {
            //     $flag='1';
            //     $ipd_opd1='opd';
            //     $ipd_opd2='ipd';
            //     $n=1;
                
            // }   // kkkk
            
          //  else{
            $rand=(rand(1,3));
            
            // CJOB Auto Push Code Start -------------------------------------------------------------

        $dlp = "SELECT * FROM holiday_data_limit";
        $dlp1 = $mysqli->query($dlp);
        $dlp11=$dlp1->fetch_assoc();
        $dlt=$dlp11['data_limit'];

        $dlne = $dlt - 5;

        $dlp_new = "SELECT * FROM data_limit";
        $dlp1_new = $mysqli->query($dlp_new);
        $dlp11_new=$dlp1_new->fetch_assoc();
        $dlt_new=$dlp11_new['data_limit'];

      
        $new_patient_limit_for_emr = $dlt_new - $dlt_new_even;
        $todays_total_count = "select * from patient where create_date='$ADV_DAY1'";
        $todays_total_count_q = $mysqli->query($todays_total_count);
        $todays_total_count_q_r=$todays_total_count_q->num_rows;

        if($holiday == 'holiday'  || $sunday == 'Sun')
        {
             echo $sql = "SELECT * FROM items_casuality WHERE flag=0 ORDER by RAND()  LIMIT  $rand"; 
             $update_flag = 1;
        }

            // CJOB Auto Push Code End ---------------------------------------------------------------

            $result = $mysqli->query($sql);
            
            if ($result->num_rows > 0) 
            {
                //admit patient
                echo  "<br>current date for admit ".$date_admit = $ADV_DAY;
                echo "<br>";
                echo "strat date for admit ".$date_admit1=$ADV_DAY1." 01:45";
                echo "<br>";
                
                echo "end date for admit ".$date_admit2 = $ADV_DAY1." 23:45";
                echo "<br>";
                $sql_admit = "SELECT * FROM patient WHERE flag = 1 AND ipd_opd ='opd' AND ipd_flag = 0 LIMIT  1";
                $result_admit = $mysqli->query($sql_admit);
                $row_admit=$result_admit->fetch_assoc();
                
                echo "$single_record".$single_record=$result_admit->num_rows;
                //$old_date111=$row1['created_date'];
                // end admit patient
                
                //admit_todays  
                $admit_todays1='%'.$ADV_DAY1.'%';
                $admit_todays = "SELECT * FROM patient_ipd WHERE  create_date LIKE  '$admit_todays1' AND ipd_opd ='ipd' AND ipd_flag = 1";
                    $admit_todayss = $mysqli->query($admit_todays);
                //$admit_todayss1=$admit_todayss->fetch_assoc();
                $total_admit_todays=$admit_todayss->num_rows;
                echo "<br>today_total_admit".$total_admit_todays."<br>";
                // end admit_todays
                
                
                
                    //master limit admit patient
                    $admit_todays_limit = "SELECT * FROM admit_patient_limit";
                    $admit_todayss1 = $mysqli->query($admit_todays_limit);
                    $admit_todayss11=$admit_todayss1->fetch_assoc();
                    $admit_limit=$admit_todayss11['data_limit'];
                    // end master limit admit patient
                
                    $value=date('d',strtotime($ADV_DAY1)); 
                    if ($value % 2) {
                        //$admit_limit=$admit_todayss11['data_limit'] + 2;
                        $admit_limit=$admit_todayss11['data_limit'];
                    } else {
                        $admit_limit=$admit_todayss11['data_limit'] + 1;
                    }
               
                echo "<br>today_total_admit_limit ".$admit_limit."<br>";
                
                //discharge_todays  
                $discharge_todays1='%'.$ADV_DAY1.'%';
                $discharge_todays = "SELECT * FROM patient_ipd WHERE  discharge_date LIKE  '$discharge_todays1' AND discharge_date !='' AND ipd_opd ='ipd'";
                $discharge_todayss = $mysqli->query($discharge_todays);
                //$admit_todayss1=$admit_todayss->fetch_assoc();
                $total_discharge_todays=$discharge_todayss->num_rows;
                echo "<br>today_total_discharge ".$total_discharge_todays."<br>";
                echo "<br>today_total_discharge_limit ".$discharge_limit."<br>";
                // end discharge_todays
                
                // discharge patient 
                echo  "<br>current date for discharge ".$date_discharge = $ADV_DAY;
                echo "<br>";
                echo "strat date for discharge ".$date_discharge1=$ADV_DAY1." 01:00";
                echo "<br>";
                echo "end date for discharge ".$date_discharge2 = $ADV_DAY1."  23:45";
                
               
                    
                    echo '<br>';
                    if($discharge_todayss11['data_limit'] != -1){
                    echo $Check_discharge_patient = "SELECT * FROM `patient_ipd` WHERE discharge_date ='0000-00-00' AND create_date < '$ADV_DAY1' AND ipd_opd ='ipd' order by rand() LIMIT 1";
                    /////echo $Check_discharge_patient = "SELECT * FROM `patient_ipd` WHERE discharge_date ='0000-00-00' AND create_date < '$ADV_DAY1' AND ipd_opd ='ipd' LIMIT 1";
                    $Check_discharge_patient1 = $mysqli->query($Check_discharge_patient);
                    $Check_discharge_patient2 = $Check_discharge_patient1->fetch_assoc();
                    
                    $che=trim($Check_discharge_patient2['dignosis']);
                    $len=strlen($che);
                    $dd= substr($che,$len - 1);
                    $str = $Check_discharge_patient2['dignosis'];
                    $arry=explode("-",$str);
                    $t_c=count($arry);
                    if($t_c=='2'){
                        $dd1=substr($che, 0, -1);
                        $new_str = trim($arry[0]);
                        $dis_dia = '%'.$new_str.'%';
                        $dis_p_dignosis_name=$Check_discharge_patient2['dignosis'];
                    }else{
                        $dis_dia = '%'.$che.'%';
                        $dis_p_dignosis_name=$Check_discharge_patient2['dignosis'];
                    }
                    $dis_proxy_id = $Check_discharge_patient2['proxy_id'];
                    $dis_department_id = $Check_discharge_patient2['department_id'];
                    $dis_p_id = $Check_discharge_patient2['id'];
                    $dis_p_create_date = date('Y-m-d', strtotime($Check_discharge_patient2['create_date']));
                    
                    $tretment=$this->db->select("*")
                        ->from('treatments1')
                        ->where('dignosis LIKE',$dis_dia)
                        ->where('proxy_id',$dis_proxy_id)
                        ->where('department_id', $dis_department_id)
                        ->where('ipd_opd','ipd')
                        ->get()
                        ->row();
                    $ipd_days= $tretment->ipd_days;      
                    
                    echo '<br>';
                    echo $ipd_days;
                    echo '<br>';
                    
                    $date1=date_create(date("Y-m-d", strtotime($dis_p_create_date)));
                    $date2=date_create(date("Y-m-d", strtotime($ADV_DAY1)));
                    $diff=date_diff($date1,$date2);
                    $Days = $diff->d;
                    
                    echo '<br>';
                    echo 'Discharge Diff. Days ==> '.$Days;
                    echo '<br>';
                        
                    if($Days >= $ipd_days){
                        echo '<br>';
                        echo 'Patient On Bed Days :- '.$Days.'<br>';
                        echo $discharge_patient = "SELECT * FROM `patient_ipd` WHERE id = '$dis_p_id' AND ipd_opd ='ipd'";
                        $discharge_patient1 = $mysqli->query($discharge_patient);
                        $discharge_patient2 = $discharge_patient1->fetch_assoc();
                        $dis_id = $discharge_patient2['id'];
                        $master_id_dis = $discharge_patient2['master_g_id'];
                        $bed_remove=$discharge_patient2['bedNo'];
             
                    ////if(($date_discharge1 <= $date_discharge) && ($date_discharge2 >= $date_discharge) && ($total_discharge_todays <= $discharge_limit)){
                    if(($date_discharge1 <= $date_discharge) && ($date_discharge2 >= $date_discharge)){
                        //////////////////////if((date('Y-m-d',strtotime($date_discharge1)) <= date('Y-m-d',strtotime($date_discharge))) && (date('Y-m-d',strtotime($date_discharge2)) >= date('Y-m-d',strtotime($date_discharge)))){
                        echo "<br>discharge_id :".$dis_id."<br>";
                    //$date_of_dis=$ADV_DAY;
                    $date_of_dis=$ADV_DAY1;
                    $query3 = "update patient_ipd set discharge_date = '$date_of_dis' where id = ".$dis_id;
                    $mysqli->query($query3);
                    
                    if($master_id_dis){
                    $discharge_patient_nav = "SELECT * FROM `patient_ipd` WHERE discharge_date ='0000-00-00' AND master_g_id ='$master_id_dis' AND ipd_opd ='ipd'";
                    $discharge_patient_nav1 = $mysqli->query($discharge_patient_nav);
                    $discharge_patient_nav2 = $discharge_patient_nav1->fetch_assoc();
                    $dis_id_nav = $discharge_patient_nav2['id']; 
                    
                    $query33 = "update patient_ipd set discharge_date = '$date_of_dis' where id = ".$dis_id_nav;
                    $mysqli->query($query33);
                    
                    if($bed_remove){
                        $query2222 = "update beds set status = 0 where id=".$bed_remove;
                            $mysqli->query($query2222);
                            
                            $query22222 = "update patient_ipd set bed_status = 0 where id = ".$dis_id;
                            $mysqli->query($query22222);
                    }
                    
                    
                    }
                    }
                    }
                    }
                //end discharge patient
                
                
                    $m=0;
                    $k=1;
                    $ipd_opd2='opd';
                    $ipd_opd='ipd';
                    $ipd_flag = 1;
                    
                    $adress_def=array();
                    $address = "SELECT * FROM address";
                    $address1 = $mysqli->query($address);
                    while($address2=$address1->fetch_assoc()){
                // $auto_on_off2['description']."<br>";
                    array_push($adress_def,$address2['name']);
                    }
                    
                    
                    
                    while($row = $result->fetch_assoc()) {
                    $m++;
                    if(($row['SEX']=='M') && ($row['VIBHAG'] !=32)){
                        
                        $occupation= array('Farmer','Office','Business','Job','Labor','Jobless','Teacher','other');
                        if(!empty($row['Weight'])){
                            $a=array($row['Weight']); 
                        }
                        else {
                        $a=array(41,49,44,48,50,55,61,51,63,56,67);
                        }
                    
                    }
                    else if(($row['SEX']=='F') && ($row['VIBHAG'] !=32)){
                        $occupation= array('Farmer','Office','Business','Job','Labor','Jobless','Teacher','other');
                        if(!empty($row['Weight'])){
                            $a=array($row['Weight']); 
                        }
                        else {
                        $a=array(41,49,44,48,50,55,61,51,63,56,67);
                        }
                    }
                    else{
                        $occupation= array('Student','Other');
                        if(!empty($row['Weight'])){
                            $a=array($row['Weight']); 
                        }
                        else {
                        $a=array(41,49,44,48,50,55,61,51,63,56,67);
                        }
                        $key = array_rand($a);
                    }
                    
                    $c_o=$row['NIDAN'];
                    $h_o='NAD';
                    $f_o='NAD';
                    //$bp=array('130/80','124/86','138/88','116/90','110/70','136/84','132/72','128/60','140/90');
                    $bp = array('122/82','128/78','120/80','118/78','110/70','116/76','130/82','112/72','114/74','124/84','126/86');
                    $nadi=array('मंडूकगति', 'सर्पगती' , 'हंसगति','अविशेष');
                    
                    //$Pulse =array(76,78,88,90,68,72,82,66,74,92,64);
                if($row['VIBHAG'] !=32){
                    $Pulse =array('78','84','86','80','76','74','70','88','90','72','82');
                }else{
                    $Pulse =array('92','104','108','106','96','98','94','90','100','102','110');
                }
                    
                    $ur= 'अविशेष';
                    $cvs ='S1S2 N';
                    $udar='soft';
                    $netra=array('आविल','अच्छ','ईषत्पित्त')  ;
                    $givwa=array('साम','निराम');
                    $sudha=array('तीक्ष्णाग्नि', 'समाग्नि', 'विषमाग्नि');     
                
                    $ahar=array('प्रभुत ','अल्प ','मध्यम');
                    $mal=array('साम ','निराम ','कठीण ','दुर्गंधीयुक्त ','अविशेष');
                    $mutra=array('पीत','आविल','दुर्गंधीयुक्त','अविशेष');
                    $nidra=array('अविशेष','प्रभुत','अल्प');   
                    
                    $key = array_rand($a); 
                    $a[$key];
                    $key1 =array_rand($occupation);
                    $occupation[$key1];
                    $key2=array_rand($adress_def);
                    $adress_def[$key2];
                    
                    $c_o1=array_rand($c_o);
                    $c_o[$c_o1];
                    
                    $bp1=array_rand($bp);
                    $bp[$bp1];
                    
                    $nadi1=array_rand($nadi);
                    $nadi[$nadi1];
                    
                    $Pulse1=array_rand($Pulse);
                    $Pulse[$Pulse1];
                    
                    $netra1=array_rand($netra);
                    $netra[$netra1];
                    
                    $givwa1=array_rand($givwa);
                    $givwa[$givwa1];
                    
                    
                    $sudha1=array_rand($sudha);
                    $sudha[$sudha1];
                    
                    $ahar1=array_rand($ahar);
                    $ahar[$ahar1];
                    
                    $mal1=array_rand($mal);
                    $mal[$mal1];
                    
                    $mutra1=array_rand($mutra);
                    $mutra[$mutra1];
                    
                    $nidra1=array_rand($nidra);
                    $nidra[$nidra1];
                    
                    $ruduce =array(10,25,50,75);
                    $ruduce1=array_rand($ruduce);
                    $ruduce[$ruduce1];
                    
                    if($k == 1){
                    $date_only_new = date('Y-m-d H:i',strtotime('-15 minutes'))."<br>";
                    }
                    else if($k == 2){
                    $date_only_new = date('Y-m-d H:i',strtotime('- 14 minutes'))."<br>";
                    }
                    else if($k == 3){
                    $date_only_new = date('Y-m-d H:i',strtotime('- 12 minutes'))."<br>";
                    }
                    else if($k == 4){
                    $date_only_new = date('Y-m-d H:i',strtotime(' -11 minutes'))."<br>";
                    }
                    else if($k == 5){
                    $date_only_new = date('Y-m-d H:i',strtotime('-11 minutes'))."<br>";
                    }
                    else if($k == 6){
                    $date_only_new = date('Y-m-d H:i',strtotime('-7 minutes'))."<br>";
                    }
                    else if($k == 7){
                    $date_only_new = date('Y-m-d H:i',strtotime('-5 minutes'))."<br>";
                    }
                    else if($k == 8){
                    $date_only_new = date('Y-m-d H:i',strtotime('-2 minutes'))."<br>";
                    }
                    
                    else {
                    $date_only_new = $ADV_DAY1."<br>";
                    }
                    $date_only_new1 = $ADV_DAY1."<br>";
                    $k++;
                    if(empty($row['CopddD_New'])){
                        $CopddD_New=NULL;
                        $Copdd_Old=$row['Copdd_Old'];
                        
                        echo "<br>Sno: " . $row["Sno"]. " - Name: " . $row["NAME"]. "<br>";
                        $department_id = $row['VIBHAG'];
						
                        if($row["NAME"]){
                           
                            $query1 = "insert into patient(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date, wieght,occupation,c_o,h_o,f_h,pulse,bp,nadi,ur,cvs,udar,netra,givwa,shudha,ahar,mal,mutra,nidra,sym_reduce_per) values('".$row["Sno"]."','".$row["yealry_number"]."','".$row['Daily']."','".$row['Monthly']."','".$Copdd_Old."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$adress_def[$key2]."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd2."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_only_new1."','".$a[$key]."','".$occupation[$key1]."','".$c_o."','".$h_o."','".$f_o."','".$Pulse[$Pulse1]."','".$bp[$bp1]."','".$nadi[$nadi1]."','".$ur."','".$cvs."','".$udar."','".$netra[$netra1]."','".$givwa[$givwa1]."','".$sudha[$sudha1]."','".$ahar[$ahar1]."','".$mal[$mal1]."','".$mutra[$mutra1]."','".$nidra[$nidra1]."','".$ruduce[$ruduce1]."')";
                            //echo $query1;
                            $mysqli->query($query1);
                            $query2 = "update items_casuality set flag = 1 where Sno=".$row["Sno"];
                            $mysqli->query($query2);
                          
                        } //name if end
                     
                      
                    
                    if(($single_record == $m  ) && ($total_admit_todays <= $admit_limit)){
                        
                        
                        if(($date_admit1 <= $date_admit) && ($date_admit2 >= $date_admit)){
                            if(($row['VIBHAG'] == '35') || ($row['VIBHAG'] == '28'))
                                {
                                }
                            else{
                                    $gender1=$row['SEX'];
                                $depart_id1= $row['VIBHAG'];
                                if($depart_id1 == '28'){
                                $depart_id='34';
                            }else{
                                    $depart_id= $row['VIBHAG'];
                            }
                            
                            $dep_bed_limit = "SELECT * FROM data_lmit_dept_ipd_sunday where dept_id=".$depart_id;
                                $dep_bed_limit1 = $mysqli->query($dep_bed_limit);
                                $dep_bed_limit11=$dep_bed_limit1->fetch_assoc();
                               
                                $data_limit=$dep_bed_limit11['data_limit_mf'];
                               
                                $dep_bed_limit_total=$data_limit;
                            // end master data_lmit_dept_ipd_sunday
                            
                                //patient check in bed with gender
                               echo $check_bed = "SELECT * FROM patient_ipd where discharge_date LIKE '%0000-00-00%' and  sex='$SEX_Check' and department_id=".$depart_id;
                                $bed_status1 = $mysqli->query($check_bed);
                                echo "//////////////////";  echo "<br>";
                                echo "depart_id:".$depart_id;
                                echo "//////////////////";  echo "<br>";
                                echo  '$dep_bed_limit_total :'.$dep_bed_limit_total;
                                echo "<br>";
                                echo "//////////////////";
                                echo  'bed_status_total :'.$bed_status_total=$bed_status1->num_rows;
                                echo "//////////////////";
                            // end patient check in bed with gender
                            
                                $bed = "SELECT * FROM beds WHERE gender ='$gender1' AND department_id ='$depart_id' AND status ='0' LIMIT  1";
                                $bed_no = $mysqli->query($bed);
                                $bed_no1=$bed_no->fetch_assoc(); 
                                if ($bed_no1) {
                                $admit_bed=$bed_no1['id'];
                                }else{
                                    $admit_bed ='';
                                }
                            
                            //Admit only available diagnosis in ipd
                            // $nivan=$row['NIDAN']."I";
                            // $nivan1='%'.$nivan.'%';
                            
                            $che=trim($row['NIDAN']);
                            $len=strlen($che);
                            $dd= substr($che,$len - 1);
                            $str = $row['NIDAN'];
                            $arry=explode("-",$str);
                            $t_c=count($arry);
                            if($t_c=='2'){
                                $dd1=substr($che, 0, -1);
                                $new_str = trim($arry[0]);
                                $nivan = '%'.$new_str.'%';
                                $p_dignosis_name=$row['NIDAN'];
                            }else{
                                $nivan = '%'.$che.'%';
                                $p_dignosis_name=$row['NIDAN'];
                            }
                            echo $nivan1 = $nivan;
                            
                            $proxy_id = $row['proxy_id'];
                            //$department_id = $row['VIBHAG'];
                            $department_id = $depart_id;
                            
                            $admit_avai_diagnosis = "SELECT * FROM treatments1 WHERE dignosis like '$nivan1' AND proxy_id = '$proxy_id' AND department_id = '$department_id' AND ipd_opd ='ipd'";
                            
                            //$admit_avai_diagnosis = "SELECT * FROM treatments1 WHERE dignosis like '$nivan1' AND ipd_opd ='ipd'";
                            $admit_avai_diagnosis1 = $mysqli->query($admit_avai_diagnosis);
                            $admit_avai_diagnosis2=$admit_avai_diagnosis1->fetch_assoc(); 
                            
                            echo "<br>=====> 7 ";
                            print_r($admit_avai_diagnosis2);
                            echo "<br><br><br>"; 
                            
                            if($bed_status_total < $dep_bed_limit_total){ 
                            //if($admit_avai_diagnosis2){ 
                            if($admit_avai_diagnosis2 && $admit_bed != ''){ 
                            $bed_status='1';

                            $query12 = "insert into patient_ipd(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,ipd_flag) values('".$row["Sno"]."','".$row["yealry_number"]."','".$row['Daily']."','".$row['Monthly']."','".$Copdd_Old."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$row['Address']."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_only_new1."','".$ipd_flag."')";
                            $this->db->query($query12);
                            // $mysqli->query($query12); 
                            $query22 = "update patient_ipd set ipd_flag = 1 where patient_id=".$row["Sno"];
                            $mysqli->query($query22);
                            
                                $query222 = "update beds set status = 1 where id=".$admit_bed;
                                $mysqli->query($query222);
                                }
                            }
                            }
                        }
                        } 
                    else{
                        
                        echo "<br>no admit";
                    }
                    
                    }else {
                        
                        
                        //$CopddD_New=$row['CopddD_New'];
                        
                        // CJOB Auto Push Code Start ------------------------------------------------------------
                        
                        //$CopddD_New=$row['CopddD_New'];
                        $tempQuery1 = "SELECT * FROM  patient ORDER BY id DESC LIMIT 1";
                        $tempQueryResult1 = $mysqli->query($tempQuery1);
                        $tempQueryRow1=$tempQueryResult1->fetch_assoc();
                        /*print_r($tempQueryRow1);
                        die();*/
                        
                        $tempQuery = "SELECT * FROM  patient WHERE  yearly_reg_no !='' ORDER BY id DESC LIMIT 1";
                        $tempQueryResult = $mysqli->query($tempQuery);
                        $tempQueryRow=$tempQueryResult->fetch_assoc();
                        /*print_r($tempQueryRow);
                        die();*/
                        //$CopddD_New=$row['CopddD_New'];
                        $CopddD_New=$tempQueryRow['yearly_reg_no']+1;


                            $tempQuery1 = "SELECT * FROM  patient_ipd WHERE  ipd_no_new !='' ORDER BY id DESC LIMIT 1";
                        $tempQueryResult1 = $mysqli->query($tempQuery1);
                        $tempQueryRow1=$tempQueryResult1->fetch_assoc();
                        
                        $last_created_date = date("Y",strtotime($tempQueryRow1['create_date']));
                        
                        $push_date = date("Y",strtotime($ADV_DAY));
                        
                        if($tempQueryRow1)
                        {
                        if($last_created_date < $push_date)
                        {
                            $ipd_no_new = '1';
                        }
                        else
                        {
                        $ipd_no_new=$tempQueryRow1['ipd_no_new']+1;
                        }
                        }
                        else
                        {
                        $ipd_no_new = '1';
                        }
                        
                        // CJOB Auto Push Code End ----------------------------------------------------------------
                        
                        //check dublicate New Yearly Number
                            $d_number=date('Y',strtotime($ADV_DAY1));
                            $d_number_like='%'.$d_number.'%';
                            $check_number = "SELECT * FROM patient WHERE  create_date LIKE  '$d_number_like' AND ipd_opd ='opd' AND yearly_reg_no ='$CopddD_New'";
                            $check_number_q = $mysqli->query($check_number);
                            $check_number_result=$check_number_q->num_rows;
                            //check dublicate New Yearly Number end 
                        
                        $Copdd_Old=NULL;
                        echo "<br>Sno: " . $row["Sno"]. " - Name: " . $row["NAME"]. "<br>";
                        $department_id = $row['VIBHAG'];
					
                            if($check_number_result==0){
                            if($row["NAME"]){
                                //echo $query1 = "insert into patient(patient_id,yearly_no,yearly_reg_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,wieght,occupation ,c_o,h_o,f_h,pulse,bp,nadi,ur,cvs,udar,netra,givwa,shudha,ahar,mal,mutra,nidra,proxy_id) values('".$row["Sno"]."','".$row["yealry_number"]."','".$CopddD_New."','".$row['Daily']."','".$row['Monthly']."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$adress_def[$key2]."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd2."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_only_new1."','".$a[$key]."','".$occupation[$key1]."','".$c_o."','".$h_o."','".$f_o."','".$Pulse[$Pulse1]."','".$bp[$bp1]."','".$nadi[$nadi1]."','".$ur."','".$cvs."','".$udar."','".$netra[$netra1]."','".$givwa[$givwa1]."','".$sudha[$sudha1]."','".$ahar[$ahar1]."','".$mal[$mal1]."','".$mutra[$mutra1]."','".$nidra[$nidra1]."','".$row['proxy_id']."')";
                                echo $query1 = "insert into patient(patient_id,yearly_no,yearly_reg_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,wieght,occupation ,c_o,h_o,f_h,pulse,bp,nadi,ur,cvs,udar,netra,givwa,shudha,ahar,mal,mutra,nidra,proxy_id) values('".$CopddD_New."','".$CopddD_New."','".$CopddD_New."','".$row['Daily']."','".$row['Monthly']."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$adress_def[$key2]."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd2."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_only_new1."','".$a[$key]."','".$occupation[$key1]."','".$c_o."','".$h_o."','".$f_o."','".$Pulse[$Pulse1]."','".$bp[$bp1]."','".$nadi[$nadi1]."','".$ur."','".$cvs."','".$udar."','".$netra[$netra1]."','".$givwa[$givwa1]."','".$sudha[$sudha1]."','".$ahar[$ahar1]."','".$mal[$mal1]."','".$mutra[$mutra1]."','".$nidra[$nidra1]."','".$row['proxy_id']."')";
                                $yes= $this->db->query($query1);
                                echo 'yes'.$yes;
                                echo "<br>";
                                
                                //echo $query1;
                                if($yes){
                                    if($update_flag == 1){
                                        $query2 = "update items_casuality set flag = 1 where Sno=".$row["Sno"];
                                        $mysqli->query($query2);
                                    }
                                }
                                } //name if end
                            }  
                           

                
                        if(($single_record == $m  ) && ($total_admit_todays <= $admit_limit)){
                        
                        
                        if(($date_admit1 <= $date_admit) && ($date_admit2 >= $date_admit)){
                            
                                if(($row['VIBHAG'] == '35') ||($row['VIBHAG'] == '28'))
                                {
                                }
                                else{
                                    
                                    $gender1=$row['SEX'];
                                $depart_id1= $row['VIBHAG'];
                                if($depart_id1 == '28'){
                                $depart_id='34';
                            }else{
                                    $depart_id= $row['VIBHAG'];
                            }
                            
                         
                            /////////////////////////////######## IPF CASE PAPER############//////////////////
                                $hb =array(11.5,12.0,12.5,13.0,13.5,14.0,14.5);
                                $hb1=array_rand($hb);
                                $hb[$hb1];
                                
                                $TLC =array(4000,4500,5000,5500,6000,6500,7000,7500,8000,8500,9000,9500,10000,11000);
                                $TLC1=array_rand($TLC);
                                $TLC[$TLC1];
                                
                                
                                $DLC_Neutro =array(50,55,60,65,70);
                                $DLC_Neutro1=array_rand($DLC_Neutro);
                                $DLC_Neutro[$DLC_Neutro1];
                                
                                $Lymphocytes =array(20,25,30,35,40);
                                $Lymphocytes1=array_rand($Lymphocytes);
                                $Lymphocytes[$Lymphocytes1];
                                
                                
                                $Monocytes =array(1,2,3,4);
                                $Monocytes1=array_rand($Monocytes);
                                $Monocytes[$Monocytes1];
                                
                                $Eosinophils =array(0.1,0.2,0.3,0.4);
                                $Eosinophils1=array_rand($Eosinophils);
                                $Eosinophils[$Eosinophils1];
                                
                                
                                $ESR =array(10,14,16,18,20);
                                $ESR1=array_rand($ESR);
                                $ESR[$ESR1];
                                
                            
                                $Platelet_Count=array(1.5,2.0,2.5,3.0,3.5,4.0,4.5);
                                $Platelet_Count1=array_rand($Platelet_Count);
                                $Platelet_Count[$Platelet_Count1];
                                
                                $B_Sugar=array(70,80,90,100,110);
                                $B_Sugar1=array_rand($B_Sugar);
                                $B_Sugar[$B_Sugar1];
                                
                                $Blood_Sugar=array(110,120,130,140,150);
                                $Blood_Sugar1=array_rand($Blood_Sugar);
                                $Blood_Sugar[$Blood_Sugar1];
                                
                                $Blood_Urea=array(20,25,30,35,40);
                                $Blood_Urea1=array_rand($Blood_Urea);
                                $Blood_Urea[$Blood_Urea1];
                                
                                $S_Creatinine=array(0.4,0.5,0.7,0.9,1.2,1.4);
                                $S_Creatinine1=array_rand($S_Creatinine);
                                $S_Creatinine[$S_Creatinine1];
                            
                                $S_Uric_Acid=array(2,3,4,5,6);
                                $S_Uric_Acid1=array_rand($S_Uric_Acid);
                                $S_Uric_Acid[$S_Uric_Acid1];
                                
                                $SNat	=array(135,140,145,150,155);
                                $SNat1=array_rand($SNat);
                                $SNat[$SNat1];
                                
                                
                                
                                
                                $SK=array(3.5,4.0,4.5,5.0,5.5);
                                $SK1=array_rand($SK);
                                $SK[$SK1];
                                
                                $Total_Cholestrol=array(150,160,170,180,190,200);
                                $Total_Cholestrol1=array_rand($Total_Cholestrol);
                                $Total_Cholestrol[$Total_Cholestrol1];
                                
                                $STg=array(60,80,90,100,120,140,150,160,170);
                                $STg1=array_rand($STg);
                                $STg[$STg1];
                                
                                
                                $HDL=array(30,40,50,60,70);
                                $HDL1=array_rand($HDL);
                                $HDL[$HDL1];
                                
                                $LDL=array(110,120,130,140,150);
                                $LDL1=array_rand($LDL);
                                $LDL[$LDL1];
                                
                                $VLDL=array(14,15,18,20,25,28,34,36,38,42,44,45);
                                $VLDL1=array_rand($VLDL);
                                $VLDL[$VLDL1];
                                
                                
                            $atime=array('9:00','9:05','9:10','09:15','09:20','09:30');
                                $atime1=array_rand($atime);
                                $atime[$atime1];
                                
                                $dtime=array('9:15','9:30','9:45','10:00','10:30','10:45');
                                $dtime1=array_rand($dtime);
                                $dtime[$dtime1];
                                
                                $phone=array(98,97,96,94);
                                $phone1=array_rand($phone);
                                $phone[$phone1];
                                
                                $digits = 8;
                                $digi8=rand(pow(10, $digits1),pow(10,$digits)-1);
                                $phonedigit10=$phone[$phone1].$digi8;
                                
                                
                                //##
                                $BillirubinT=array(0.1,0.2,0.4,0.8,0.5);
                                $BillirubinT1=array_rand($BillirubinT);
                                $BillirubinT[$BillirubinT1];
                                
                                $BillirubinI=array(0.3,0.7,0.4,0.8,0.5);
                                $BillirubinI1=array_rand($BillirubinI);
                                $BillirubinI[$BillirubinI1];
                            
                                $Color=array('Yellow','Brown','Dark Brown','Black');
                                $Color1=array_rand($Color);
                                $Color[$Color1];
                                
                                $MUCOUS=array('+++','++++');
                                $MUCOUS1=array_rand($MUCOUS);
                                $MUCOUS[$MUCOUS1];
                                
                                $Comsistency=array('Liguid','Semi Solid','Solid','Hard');
                                $Comsistency1=array_rand($Comsistency);
                                $Comsistency[$Comsistency1];
                                
                                $raj=array('सामान्य ','अप्रवृत्ती ','अतिप्रवृत्ती ','अल्प प्रवृत्ती – काल');
                                $raj1=array_rand($raj);
                                $raj[$raj1];
                                
                                
                                $samajik=array('Medium','Average', 'Above Poverty Line','Below Poverty Line','Poor','Modirate');
                                $samajik1=array_rand($samajik);
                                $samajik[$samajik1];
                                
                                $aharfood=array('Non vegetarian','Vegetarian', 'Non vegetarian +  Vegetarian');
                                $aharfood1=array_rand($aharfood);
                                $aharfood[$aharfood1];
                                
                                
                                $aharghatak=array('Medium','Average', 'Above average','Below average','Poor');
                                $aharghatak1=array_rand($aharghatak);
                                $aharghatak[$aharghatak1];
                                
                                
                                $nidtra=array('Normal');
                                $nidtra1=array_rand($nidtra);
                                $nidtra[$nidtra1];
                                
                                
                                $vyasan=array('Tea','Coffee','Tobacco','Smoking');
                                $vyasan1=array_rand($vyasan);
                                $vyasan[$vyasan1];
                                
                                $mutrapra=array('4-Yellow','5-Faint yellow','6-Dark yellow','7-Pale Yellow','8-Yellow');
                                $mutrapra1=array_rand($mutrapra);
                                $mutrapra[$mutrapra1];
                                
                                
                                $urine=array('NAD','NILL');
                                $urine1=array_rand($urine);
                                $urine[$urine1];
                                
                                $purushpra=array('1-Yellow','2-Dark yellow','1-Brown','2-Dark yellow','1-Dark Brown','2-blackest');
                                $purushpra1=array_rand($purushpra);
                                $purushpra[$purushpra1];
                                
                                $apanwayu=array('NAD','Normal','Excessive');
                                $apanwayu1=array_rand($apanwayu);
                                $apanwayu[$apanwayu1];
                            
                            
                                $koshth=array('क्रूर','मध्यम ','मृदू');
                                $koshth1=array_rand($koshth);
                                $koshth[$koshth1];
                                
                                
                                $samanyaatur=array('Pitta','Vata','Pittakapha','Vatapitta','VataKaPha','Sam');
                                $samanyaatur1=array_rand($samanyaatur);
                                $samanyaatur[$samanyaatur1];
                                
                                
                                $tap=array('96.5','96','97.5','97');
                                $tap1=array_rand($tap);
                                $tap[$tap1];
                                
                                
                                $sharir=array('Medium','Modrate','Well built','Thin','Central Obesity');
                                $sharir1=array_rand($sharir);
                                $sharir[$sharir1];
                                
                                $aharshakti=array('Medium','Strong');
                                $aharshakti1=array_rand($aharshakti);
                                $aharshakti[$aharshakti1];
                                
                                
                                $vyamshakti=array('Medium','Strong');
                                $vyamshakti1=array_rand($vyamshakti);
                                $vyamshakti[$vyamshakti1];
                                
                                
                            $rand_no=rand(1,5);
                                if($rand_no=='1'){
                                    $second='अल्पोपशय';$three='अल्पोपशय';$four='25';$five='50';$six='75';$seven='उपशय';$eight='उपशय';$nine='उपशय';
                                    
                                    $SPO2='88,90,92,91,93,94,96,97,98';
                                    $Input='2000,2020,2010,2060,2100,2080,2160,2140,2120';
                                    $Output='1600,1640,1680,1670,1720,1750,1800,1940,1960';
                                    
                                }else if($rand_no=='2'){
                                    $second='25';$three='50';$four='75';$five='अल्पोपशय';$six='अल्पोपशय';$seven='अल्पोपशय';$eight='उपशय';$nine='उपशय';
                                
                                    $SPO2='90,91,92,94,93,94,98,97,98';
                                    $Input='2010,2020,2040,2160,2100,2080,2160,2140,2120';
                                    $Output='1640,1650,1670,1670,1750,1780,1800,1940,1960';
                                }
                                else if($rand_no=='3'){
                                    $second='Same complaint';$three='10';$four='25';$five='50';$six='75';$seven='उपशय';$eight='उपशय';$nine='उपशय';
                                    
                                    $SPO2='92,91,92,88,93,94,98,96,98';
                                    $Input='2040,2020,2010,2060,2100,2090,2140,2140,2120';
                                    $Output='1750,1700,1680,1800,1850,1670,1680,1840,1940';
                                }
                                else if($rand_no=='4'){
                                    $second='10';$three='25';$four='50';$five='75';$six='उपशय';$seven='उपशय';$eight='अल्पोपशय';$nine='अल्पोपशय'; 
                                
                                    $SPO2='89,90,91,93,94,94,97,96,98';
                                    $Input='2020,2020,2010,2080,2080,2180,2160,2140,2120';
                                    $Output='1680,1670,1700,1750,1840,1850,1900,1950,1950';
                                }
                                
                                else if($rand_no=='5'){
                                    
                                    $second='Same complaint';$three='Same complaint';$four='10';$five='25';$six='50';$seven='75';$eight='अल्पोपशय';$nine='अल्पोपशय';
                                    
                                    $SPO2='89,88,90,94,94,94,96,97,98';
                                    $Input='2000,2010,2040,2030,2120,2080,2160,2140,2140';
                                    $Output='1600,1620,1690,1670,1740,1750,1800,1940,1960';
                                    
                                }
                                else{
                                    $second='';$three='';$four='';$five='';$six='';$seven='';$eight='';$nine='';
                                    
                                    $SPO2='88,91,90,88,93,95,97,96,98'; 
                                    $Input='2030,2020,2080,2060,2120,2080,2140,2150,2120';
                                    $Output='1640,1640,1690,1670,1720,1750,1840,1940,1980';
                                }
                                
                              
                            
                                $gcondition=array('Fair','Moderate');
                                $gcondition1=array_rand($gcondition);
                                $gcondition[$gcondition1];
                                
                                $Scl=array('95','96','98','99','100','102','103','105');
                                $Scl1=array_rand($Scl);
                                $Scl[$Scl1];
                           
                            
                            /////////////////////////////######## IPF CASE PAPER############//////////////////
                            
                            
                                $SEX_Check=$row['SEX'];
                            
                                //master data_lmit_dept_ipd_sunday
                                $dep_bed_limit = "SELECT * FROM data_lmit_dept_ipd_sunday where dept_id=".$depart_id;
                                $dep_bed_limit1 = $mysqli->query($dep_bed_limit);
                                $dep_bed_limit11=$dep_bed_limit1->fetch_assoc();
                                
                                $data_limit=$dep_bed_limit11['data_limit_mf'];
                                
                                $dep_bed_limit_total=$data_limit;
                            // end master data_lmit_dept_ipd_sunday
                            
                                //patient check in bed with gender
                               echo $check_bed = "SELECT * FROM patient_ipd where discharge_date LIKE '%0000-00-00%' and  sex='$SEX_Check' and department_id=".$depart_id;
                                $bed_status1 = $mysqli->query($check_bed);
                                echo "//////////////////";  echo "<br>";
                                echo "depart_id:".$depart_id;
                                echo "//////////////////";  echo "<br>";
                                echo  '$dep_bed_limit_total :'.$dep_bed_limit_total;
                                echo "<br>";
                                echo "//////////////////";
                                echo  'bed_status_total :'.$bed_status_total=$bed_status1->num_rows;
                                echo "//////////////////";
                            // end patient check in bed with gender
                            
                            
                                $bed = "SELECT * FROM beds WHERE gender ='$SEX_Check' AND department_id ='$depart_id' AND status ='0' LIMIT  1";
                                $bed_no = $mysqli->query($bed);
                                $bed_no1=$bed_no->fetch_assoc(); 
                                if ($bed_no1) {
                                $admit_bed=$bed_no1['id'];
                                }else{
                                    $admit_bed ='';
                                }
                            
                            //Admit only available diagnosis in ipd
                            //echo $nivan=$row['NIDAN'];
                            // $nivan1='%'.$nivan.'%';
                            
                            $che=trim($row['NIDAN']);
                            $len=strlen($che);
                            $dd= substr($che,$len - 1);
                            $str = $row['NIDAN'];
                            $arry=explode("-",$str);
                            $t_c=count($arry);
                            if($t_c=='2'){
                                $dd1=substr($che, 0, -1);
                                $new_str = trim($arry[0]);
                                $nivan = '%'.$new_str.'%';
                                $p_dignosis_name=$row['NIDAN'];
                            }else{
                                $nivan = '%'.$che.'%';
                                $p_dignosis_name=$row['NIDAN'];
                            }
                            echo $nivan1 = $nivan;
                            
                            $proxy_id = $row['proxy_id'];
                            //$department_id = $row['VIBHAG'];
                            $department_id = $depart_id;
                            echo "<br><br><br><br>";
                            echo $admit_avai_diagnosis = "SELECT * FROM treatments1 WHERE dignosis like '$nivan1' AND proxy_id = '$proxy_id' AND department_id = '$department_id' AND ipd_opd ='ipd'";
                            echo "<br><br><br><br>";
                            //$admit_avai_diagnosis = "SELECT * FROM treatments1 WHERE dignosis like '$nivan1' AND ipd_opd ='ipd'";
                            
                            $admit_avai_diagnosis1 = $mysqli->query($admit_avai_diagnosis);
                            $admit_avai_diagnosis2=$admit_avai_diagnosis1->fetch_assoc();
                            
                            echo "<br>=====> 8 ";
                            print_r($admit_avai_diagnosis2);
                            echo "<br><br><br>";   
                            
                                
                            if($bed_status_total < $dep_bed_limit_total){  
                                // echo "testtesttesttest";
                            //if($admit_avai_diagnosis2){ 
                            if($admit_avai_diagnosis2 && $admit_bed != ''){ 
                                echo "testtesttesttest";
                            $bed_status='1';
                            echo $ipd_patient_check_query = "SELECT * FROM patient WHERE create_date = '$date_only_new1' AND yearly_reg_no = '$CopddD_New'";
                            echo "RajMali4";
                            $ipd_patient_check_query1 = $mysqli->query($ipd_patient_check_query);
                            //$ipd_patient_check_quer2=$ipd_patient_check_query1->fetch_assoc();
                            if ($ipd_patient_check_query1) {
                            // Check if any rows were returned
                            if ($ipd_patient_check_query1->num_rows > 0) {
                                $ipd_patient_check_quer2 = $ipd_patient_check_query1->fetch_assoc();

                            if($ipd_patient_check_quer2){
                                $query12 = "insert into patient_ipd(patient_id,yearly_no,yearly_reg_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,ipd_flag,bedNo,Hb,TLC,DLC_Neutro,Lymphocytes,Monocytes,Eosinophils,ESR,Platelet_Count,B_Sugar,Blood_Sugar,Blood_Urea,S_Creatinine,S_Uric_Acid,SNat,SK,Total_Cholestrol,STg,HDL,LDL,VLDL,atime,dtime,phone ,BillirubinT,BillirubinI,Color,MUCOUS,Comsistency,raj,samajik,aharfood,aharghatak,nidtra,vyasan,mutrapra,urine,purushpra,apanwayu,koshth,samanyaatur,tap,sharir,aharshakti,vyamshakti,second,three,four,five,six,seven,eight,nine,SPO2,Input,Output,proxy_id,gcondition,Scl,ipd_no_new) values('".$row["Sno"]."','".$row["yealry_number"]."','".$CopddD_New."','".$row['Daily']."','".$row['Monthly']."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$adress_def[$key2]."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_only_new1."','".$ipd_flag."','".$admit_bed."','".$hb[$hb1]."','".$TLC[$TLC1]."','".$DLC_Neutro[$DLC_Neutro1]."','".$Lymphocytes[$Lymphocytes1]."','".$Monocytes[$Monocytes1]."','".$Eosinophils[$Eosinophils1]."','".$ESR[$ESR1]."','".$Platelet_Count[$Platelet_Count1]."','".$B_Sugar[$B_Sugar1]."','".$Blood_Sugar[$Blood_Sugar1]."','".$Blood_Urea[$Blood_Urea1]."','".$S_Creatinine[$S_Creatinine1]."','".$S_Uric_Acid[$S_Uric_Acid1]."','".$SNat[$SNat1]."','".$SK[$SK1]."','".$Total_Cholestrol[$Total_Cholestrol1]."','". $STg[$STg1]."','".$HDL[$HDL1]."','".$LDL[$LDL1]."','".$VLDL[$VLDL1]."','".$atime[$atime1]."','".$dtime[$dtime1]."','".$phonedigit10."','".$BillirubinT[$BillirubinT1]."','".$BillirubinI[$BillirubinI1]."','".$Color[$Color1]."','".$MUCOUS[$MUCOUS1]."','".$Comsistency[$Comsistency1]."','".$raj[$raj1]."','".$samajik[$samajik1]."','".$aharfood[$aharfood1]."','".$aharghatak[$aharghatak1]."','".$nidtra[$nidtra1]."','".$vyasan[$vyasan1]."','".$mutrapra[$mutrapra1]."','".$urine[$urine1]."','".$purushpra[$purushpra1]."','".$apanwayu[$apanwayu1]."','".$koshth[$koshth1]."','".$samanyaatur[$samanyaatur1]."','".$tap[$tap1]."','".$sharir[$sharir1]."','".$aharshakti[$aharshakti1]."','".$vyamshakti[$vyamshakti1]."','".$second."','".$three."','".$four."','". $five."','".$six."','".$seven."','".$eight."','".$nine."','".$SPO2."','".$Input."','".$Output."','".$row['proxy_id']."','".$gcondition[$gcondition1]."','".$Scl[$Scl1]."','".$ipd_no_new."')";
                                //$mysqli->query($query12); 
                                $this->db->query($query12);
                                echo $query12;
                                $query22 = "update patient_ipd set ipd_flag = 1 where patient_id=".$row["Sno"];
                                $mysqli->query($query22);
                                
                                $query2222 = "update patient set flag = 1,ipd_patient_flag = 1 where yearly_reg_no='$CopddD_New' ORDER BY id DESC LIMIT 1";
                                $mysqli->query($query2222);
                                
                                    $query222 = "update beds set status = 1 where id=".$admit_bed;
                                    $mysqli->query($query222);
                                    }
                                }
                                }  
                            }
                            }
                            }
                        }
                        } 
                        else{
                        
                        echo "<br>no admit";
                        }
                    
                    }
                    
                    
            }
            
            
            echo "insert data succesfully using crone job (only new...)" ;
            } else {
            echo "master data no available(only new)";
            }
          //  }  ////
            
            $mysqli->close();
            
    
            }

            else {
                echo "Auto Stopped";
            }
        }

 }
   
     
/////////////////////////////////////////////////////////////Data Push//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////End Code/////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        /// echo("hello");exit;
        // redirect to dashboard home page
       
        if($this->session->userdata('isLogIn')) 
        $this->redirectTo($this->session->userdata('user_role'));

        $this->form_validation->set_rules('email', display('email'),'required|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', display('password'),'required|max_length[32]|md5');
        //$this->form_validation->set_rules('user_role',display('user_role'),'required');
        #-------------------------------#
        $setting = $this->setting_model->read();
        $data['title']   = (!empty($setting->title)?$setting->title:null);
        $data['logo']    = (!empty($setting->logo)?$setting->logo:null); 
        $data['favicon'] = (!empty($setting->favicon)?$setting->favicon:null); 
        $data['footer_text'] = (!empty($setting->footer_text)?$setting->footer_text:null); 

        $data['user'] = (object)$postData = [
            'email'     => $this->input->post('email',true),
            'password'  => md5($this->input->post('password',true)),
            'user_role' => $this->input->post('user_role',true), 
            'acyear' => $this->input->post('acyear'),
        ]; 



        #-------------------------------#
        if ($this->form_validation->run() === true) 
        {

            $this->session->set_userdata($postData);

            //check user data
            $check_user = $this->dashboard_model->check_user($postData); 

            if ($postData['user_role'] == 10) 
            {
                $check_user = $this->dashboard_model->check_patient($postData); 
            } 
            else 
            {
                $check_user = $this->dashboard_model->check_user($postData); 
            }

            if ($check_user->num_rows() === 1) {
                //retrive setting data and store to session



                //store data in session
                
                
               $temp = explode(',',$setting->title);
               
               $title = $temp[0]."</h4><br><h2 style='margin-top:-7px;text-transform:uppercase;'>".$temp[1]."</h2>";
               
                
                $this->session->set_userdata([
                    'isLogIn'   => true,
                    'user_id' => (($postData['user_role']==10)?$check_user->row()->id:$check_user->row()->user_id),
                    'patient_id' => (($postData['user_role']==10)?$check_user->row()->patient_id:null),
                    'email'     => $check_user->row()->email,
                    'fullname'  => $check_user->row()->firstname.' '.$check_user->row()->lastname,
                    'user_role' => (($postData['user_role']==10)?10:$check_user->row()->user_role),
                    'picture'   => $check_user->row()->picture,
                    'department_id'   => $check_user->row()->department_id, 
                    'title'     => (!empty($title)?$title:null),
                    /*'title'     => (!empty($setting->title)?$setting->title:null),*/
                    'address'   => (!empty($setting->description)?$setting->description:null),
                    'logo'      => (!empty($setting->logo)?$setting->logo:null),
                    'favicon'      => (!empty($setting->favicon)?$setting->favicon:null),
                    'footer_text' => (!empty($setting->footer_text)?$setting->footer_text:null),
                    'status' => $check_user->row()->status
                ]);

                //redirect to dashboard home page
                $this->redirectTo($postData['user_role']);

            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('incorrect_email_password'));
                //redirect to login form
                redirect('login');
            }

        } else {
            $this->load->view('layout/login_wrapper',$data);
        } 
    }  
    
  
}
?>