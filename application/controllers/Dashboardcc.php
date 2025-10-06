<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
    
     public function cvb(){
         
         echo "asda";
     }
    
     public function data_push_2019(){
        error_reporting(0);
     
       	$dbHost = "localhost";
        $dbDatabase = "srpayurved_db";
        $dbPasswrod = "gJXdRod3AOlyp4c9";
        $dbUser = "srpayurved_db";
        $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
       $mysqli -> character_set_name();
       // Change character set to utf8
       $mysqli -> set_charset("utf8");

       
      //set time limit of opd ipd 
       $opd_ipd_time = "SELECT * FROM `opd_ipd_time`";
	   $opd_ipd_time1 = $mysqli->query($opd_ipd_time);
	   $k=1;
	    while($row = mysqli_fetch_array($opd_ipd_time1))
       {
         if($k==1){
             $name1=  $row['name'];
             $start_time_m= $row['start_time'];
             $end_time_m= $row['end_time'];
       }
        else if($k==2){
             $name2=  $row['name'];
             $start_time_e= $row['start_time'];
             $end_time_e= $row['end_time'];
       }
       $k++; 
     
     }
     
     //end time limit of opd ipd 
        
       //Prints the day
      date_default_timezone_set('Asia/kolkata');
	  
	   $last_date_insert="SELECT * FROM  patient ORDER BY id DESC LIMIT 1;";
       $last_date_insert_r = $mysqli->query($last_date_insert);
	   $last_date_insert_row1=$last_date_insert_r->fetch_assoc();
	   echo "last_date_insert".$late_date=$last_date_insert_row1['create_date'];

	  $time_date=date('H:i');
	  $late_date_convert=date('Y-m-d',strtotime($late_date));
      //$ADV_DAY=date('Y-m-d H:i');
	  $ADV_DAY=$late_date_convert." ".$time_date;
      $ADV_DAY1=$late_date_convert;
    
	  
      echo  "current date ".$date = $ADV_DAY;
      echo "<br>";
      echo "strat date morning ".$date1=$ADV_DAY1." ".$start_time_m;
      echo "<br>";
      echo "end date morning".$date2 = $ADV_DAY1." ".$end_time_m;
      echo "<br>";
      
      echo "strat date evening ".$date33=$ADV_DAY1." ".$start_time_e;
      echo "<br>";
      echo "end date evening".$date44 = $ADV_DAY1." ".$end_time_e;
      echo "<br>";
      echo "Today is ".$w_day1 = date('D',strtotime($ADV_DAY1))."<br>";
      
      $w_day= date('D',strtotime($ADV_DAY1));
      
      //set holiday
       $opd_ipd_time = "SELECT * FROM `holiday`";
	   $opd_ipd_time1 = $mysqli->query($opd_ipd_time);
	  
	   while($row = mysqli_fetch_array($opd_ipd_time1))
        {
         $data[] = $row; 
        }
   
   
      for($i=0;$i<count($data);$i++){
       
          $data[$i]['holiday_date'];
       
         if(date('Y-m-d',strtotime($date)) == date('Y-m-d',strtotime($data[$i]['holiday_date']))){
           $holiday="holiday";
         }
      }
   
     if(empty($holiday)){
      echo "no holiday";   
     } else{
         echo "today is holiday";
     }
  
    //end set holiday
     
  if(($date1 <= $date) && ($date2 >= $date)){ echo "Yes";}
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
       echo "<br>";
	   echo "today's count ".$rowcount_two."<br>";
	   
	     // Today's patient master limit 
             $data_limit_patient = "SELECT * FROM data_limit";
	         $data_limit_patient1 = $mysqli->query($data_limit_patient);
	         $data_limit_patient11=$data_limit_patient1->fetch_assoc();
             $data_limit=$data_limit_patient11['data_limit'];
             $data_limit1=$data_limit - 7;
             $rand_data_limit=rand($data_limit1,$data_limit);
             echo "<br>rand_data_limit ".$rand_data_limit."<br>";
        // end Today's patient master limit
	
		if($rowcount_two<=$rand_data_limit){
			$ADV_DAY=$late_date_convert." ".$time_date;
           echo $ADV_DAY1=$late_date_convert;
		} else {
		    
		  if($ADV_DAY1=='2019-12-31'){
		     echo "still date-".$ADV_DAY1;exit;
		  }
		  for($i=0;$i<count($data);$i++){
       
           $data[$i]['holiday_date'];
           $holiday_date=date('Y-m-d', strtotime("+1 days", strtotime($ADV_DAY1)));
          if(date('Y-m-d',strtotime($holiday_date)) == date('Y-m-d',strtotime($data[$i]['holiday_date']))){
            $holiday="holiday";
         
           }
          }
   
           if(!empty($holiday)){
              
                $ADV_DAY=$holiday_date." ".$time_date;
             $ADV_DAY1=$holiday_date;
			 $next_date=date('Y-m-d', strtotime("+1 days", strtotime($ADV_DAY1)));
			 $w_day= date('D',strtotime($next_date));
			 if($w_day !='Sun'){
				 $ADV_DAY=$next_date." ".$time_date;
                echo $ADV_DAY1=$next_date; 
			 } else {
				 
				 $next_date=date('Y-m-d', strtotime("+2 days", strtotime($ADV_DAY1)));
				 $w_day= date('D',strtotime($next_date));
			  if($w_day !='Sun'){
				 $ADV_DAY=$next_date." ".$time_date;
                 echo $ADV_DAY1=$next_date; 
			 }
			 }
             } 
		    
		    else{
		    
			
			 $ADV_DAY=$late_date_convert." ".$time_date;
             $ADV_DAY1=$late_date_convert;
			 $next_date=date('Y-m-d', strtotime("+1 days", strtotime($ADV_DAY1)));
			 $w_day= date('D',strtotime($next_date));
			 if($w_day !='Sun'){
				 $ADV_DAY=$next_date." ".$time_date;
                echo $ADV_DAY1=$next_date; 
			 } else {
				 
				 $next_date=date('Y-m-d', strtotime("+2 days", strtotime($ADV_DAY1)));
				 $w_day= date('D',strtotime($next_date));
			  if($w_day !='Sun'){
				 $ADV_DAY=$next_date." ".$time_date;
                 echo $ADV_DAY1=$next_date; 
			 }
			 }
		}
        
        }    
      
        
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
             $today_old_percentage=round($data_limit * (40/100));
             $today_new_percentage=round($data_limit * (60/100));
             /*$today_new_percentage_M=round($today_new_percentage*(60/100));
             $today_old_percentage_M=round($today_old_percentage*(60/100));*/
             $today_new_percentage_M=round($today_new_percentage*(100/100));
             $today_old_percentage_M=round($today_old_percentage*(100/100));
             echo "<br>today new percentge limit ".$today_new_percentage."<br>";
             echo "<br>today old percentge limit ".$today_old_percentage."<br>";
             echo "<br>today new percentge limit Morning ".$today_new_percentage_M."<br>";
             echo "<br>today old percentge limit Morning ".$today_old_percentage_M."<br>";
              
	       
	     // end today's opd(new/old) percentage
	     
	        
            
      if($auto_on_off3=='0'){
      
       /*if(($date1 <= $date) && ($date2 >= $date) && ($w_day !='Sun') &&($rowcount_two<=$rand_data_limit) && (empty($holiday))){*/
	  if(($date1 <= $date) && ($date2 >= $date) && ($w_day !='Sun') &&($ADV_DAY1)){
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
	   $rand=rand(5,7);
       echo "<br>";
       echo "old ipd rand day ".$rand."<br>";
       $old_date=date('Y-m-d', strtotime("-$rand days", strtotime($ADV_DAY1)));
      // date('Y-m-d', strtotime("-$rand days", strtotime($ADV_DAY1)));
      
       $old_date1='%'.$old_date.'%';
	   $old_rand=rand(3,4);
	   $old_date1 = "SELECT * FROM patient WHERE flag= 0 AND create_date LIKE  '$old_date1' AND yearly_reg_no !='' LIMIT  $old_rand";
	   $result11 = $mysqli->query($old_date1);
	   // $row1=$result11->fetch_assoc();
	   //$old_date111=$row1['created_date'];
	   
	   echo "old_record is ".$result11->num_rows;
	   
	  
	   if ($result11->num_rows > 0) {
	    $flag='1';
	    $ipd_opd1='opd';
	    $ipd_opd2='ipd';
	    $n=1;
	    
	       
	    
	    if($result_t_old <= $today_old_percentage_M){
	    while($row1 = $result11->fetch_assoc()) {
	         
	         if($n == 1){
               $date_opd_old = date('Y-m-d H:i:s',strtotime('-10 minutes'))."<br>";
              }
              else if($n == 2){
               $date_opd_old = date('Y-m-d H:i:s',strtotime('-5 minutes'))."<br>";
              }
              else if($n == 3){
               $date_opd_old = date('Y-m-d H:i:s',strtotime('-2 minutes'))."<br>";
              }
            
              else {
              $date_opd_old = date('Y-m-d H:i:s')."<br>";
              }
              $date_opd_old1=$ADV_DAY1;
              //echo $date_opd_old;
             
                    $yearly_reg_no=NULL;
                    $old_reg_no = $row1['yearly_reg_no'];
                    
                   echo "<br> id old: " . $row1["id"]. " - Name: " . $row1["firstname"]." - yearly reg id: " . $row1["yearly_reg_no"]."<br>";
                   
                   //FOLLOW UP OLD GARBHINI 
                    if($row1['dignosis']=='GARBHINI-SR'){
                        $follow_up=$row1['follow_up'] + 1;
                        $master_g_id=$row1['master_g_id'];
                        $date202= date('Y-m-d',strtotime($row1['create_date']));
                        $today202=$ADV_DAY1;
                        $datetime1 = date_create($date202); 
                        $datetime2 = date_create($today202); 
  
                        $inter = date_diff($datetime1, $datetime2); 
                        $inter1=$inter->format('%a'); 
                        if($inter1 <=30){
                             
                        }else{
                        $date_opd_old1=$ADV_DAY1; 
                        if($row1["firstname"]){
                        $query12 = "insert into patient(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,flag,'master_g_id','follow_up','wieght') values('".$row1["patient_id"]."','".$row1["yearly_no"]."','".$row1['daily_reg_no']."','".$row1['monthly_reg_no']."','".$row1['yearly_reg_no']."','".$row1["firstname"]."','".$row1['sex']."','".$row1['date_of_birth']."','".$row1['address']."','".$row1['department_id']."','".$row1['dignosis']."','".$ipd_opd1."','".$row1['ipd_no']."','".$row1['discharge_date']."','".$date_opd_old1."','".$flag."','".$master_g_id."','".$follow_up."','".$row1['wieght']."')";
                        $mysqli->query($query12);
                        }
                        if($follow_up==9){
                          $master_gar_nav = "SELECT * FROM garbhini_navjat where id='$master_g_id'";
                          $master_gar_nav1 = $mysqli->query($master_gar_nav);
	                      $master_gar_nav12=$master_gar_nav1->fetch_assoc();
                          $master_nav=$master_gar_nav12['id'];
                          
                         $last_id1 = "SELECT * total FROM patient_ipd where create_date LIKE '$year' ORDER BY id DESC LIMIT 1";
                         $last_id11 = $mysqli->query($last_id1);
	                     $last_id22=$last_id11->fetch_assoc();
	                     $patient_id1=$last_id22['patient_id'] + 1;
	                     if($last_id22['yearly_reg_no']){
                         $yearly_reg_no1=$last_id22['yearly_reg_no'] + 1;
	                     }else{
	                       $yearly_reg_no1=$last_id22['old_reg_no'] + 1;  
	                     }
                         $year_no1 = $last_id22['yearly_no'] + 1;
                         $daily_reg_no1 = $last_id22['daily_reg_no'] + 1;
                          
                          //Garbhini and navjat entry
                          $query13 = "insert into patient_ipd(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,'master_g_id','follow_up',wieght) values('".$patient_id1."','".$year_no1."','".$daily_reg_no1."','','".$yearly_reg_no1."','".$row1["firstname"]."','".$row1['sex']."','".$row1['date_of_birth']."','".$row1['address']."','".$row1['department_id']."','".$row1['dignosis']."','".$ipd_opd2."','".$row1['ipd_no']."','".$row1['discharge_date']."','".$date_opd_old1."','".$master_g_id."','".$follow_up."','".$row1['wieght']."')";
                          $mysqli->query($query13); 
                           
                          $query13 = "insert into patient_ipd(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,'master_g_id','follow_up',wieght) values('".$patient_id1."','".$year_no1."','".$daily_reg_no1."','','".$yearly_reg_no1."','".$master_gar_nav12["b_name"]."','".$master_gar_nav12['b_sex']."','','".$master_gar_nav12['address']."','".$master_gar_nav12['department_id']."','".$master_gar_nav12['b_dignosis']."','".$ipd_opd2."','','','".$date_opd_old1."','".$master_g_id."','''".$row1['wieght']."')";
                          $mysqli->query($query13); 
                          $query22 = "update patient set flag = 1 where id=".$row1["id"];
                         }
                        }
               
                       }
                       else{
                       $fol_up_date=date('Y-m-d',strtotime($row1["create_date"]));
                       if($row1["firstname"]){
	                   $query12 = "insert into patient(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,flag,fol_up_date) values('".$row1["patient_id"]."','".$row1["yearly_no"]."','".$row1['daily_reg_no']."','".$row1['monthly_reg_no']."','".$row1['yearly_reg_no']."','".$row1["firstname"]."','".$row1['sex']."','".$row1['date_of_birth']."','".$row1['address']."','".$row1['department_id']."','".$row1['dignosis']."','".$ipd_opd1."','".$row1['ipd_no']."','".$row1['discharge_date']."','".$date_opd_old1."','".$flag."','".$fol_up_date."')";
                       $mysqli->query($query12);
                       $query22 = "update patient set flag = 1 where id=".$row1["id"];
                       $mysqli->query($query22);
                       }
                       }
                       echo $i."<br>";
                       $n++;
               
			 
         }
	    }
	    
	     if($result_t_new<= $today_new_percentage_M){
       //if($result_t_new){
	   $rand=(rand(4,5));
       $sql = "SELECT * FROM items WHERE flag= 0 AND Sno > $srno ORDER by id ASC LIMIT  $rand";
      // $sql = "SELECT * FROM items WHERE flag= 0  ORDER by id ASC  LIMIT  $rand";
       $result = $mysqli->query($sql);
         //echo $result->num_rows;
         if ($result->num_rows > 0) 
	   {
          // output data of each row
        
        
           //admit patient
           echo  "<br>current date for admit ".$date_admit = $ADV_DAY;
           echo "<br>";
           echo "strat date for admit ".$date_admit1=$ADV_DAY1." 01:00";
           echo "<br>";
           
           echo "end date for admit ".$date_admit2 = $ADV_DAY1." 23:45";
           $sql_admit = "SELECT * FROM patient WHERE flag = 1 AND ipd_opd ='opd' AND ipd_flag = 0 LIMIT  1";
           $result_admit = $mysqli->query($sql_admit);
	       $row_admit=$result_admit->fetch_assoc();
	      
	       $single_record=$result_admit->num_rows;
	       //$old_date111=$row1['created_date'];
	       // end admit patient
	       
	       //admit_todays  
	        $admit_todays1='%'.$ADV_DAY1.'%';
	        $admit_todays = "SELECT * FROM patient_ipd WHERE  create_date LIKE  '$admit_todays1' AND ipd_opd ='ipd' AND ipd_flag = 1";
	         $admit_todayss = $mysqli->query($admit_todays);
	        //$admit_todayss1=$admit_todayss->fetch_assoc();
            $total_admit_todays=$admit_todayss->num_rows;
            echo "<br>today_total_admit ".$total_admit_todays."<br>";
            // end admit_todays
            
            
             //master limit admit patient
             $admit_todays_limit = "SELECT * FROM admit_patient_limit";
	         $admit_todayss1 = $mysqli->query($admit_todays_limit);
	         $admit_todayss11=$admit_todayss1->fetch_assoc();
             $admit_limit=$admit_todayss11['data_limit'];
            // end master limit admit patient
            
            
             //master limit occupancy patient
             $occupancy_todays_limit = "SELECT * FROM occupancy_limit";
	         $occupancy_todayss1 = $mysqli->query($occupancy_todays_limit);
	         $occupancy_todayss11=$occupancy_todayss1->fetch_assoc();
             $occupancy_limit=$occupancy_todayss11['data_limit'];
            // end master limit occupancy patient
            
            //occupancy_todays  
	        $occupancy_todays = "SELECT * FROM patient_ipd WHERE  discharge_date ='0000-00-00' AND ipd_opd ='ipd'";
	        $occupancy_todayss = $mysqli->query($occupancy_todays);
	        //$admit_todayss1=$admit_todayss->fetch_assoc();
            $total_occupancy_todays=$occupancy_todayss->num_rows;
            echo "<br>today_total_occupancy ".$total_occupancy_todays."<br>";
            // end occupancy_todays
            
            //master limit discharge patient
             $discharge_todays_limit = "SELECT * FROM discharge_patient_limit";
	         $discharge_todayss1 = $mysqli->query($discharge_todays_limit);
	         $discharge_todayss11=$discharge_todayss1->fetch_assoc();
             $discharge_limit=$discharge_todayss11['data_limit'];
            // end master limit discharge patient
            
            
            //discharge_todays  
	        $discharge_todays1='%'.$ADV_DAY1.'%';
	        $discharge_todays = "SELECT * FROM patient_ipd WHERE  discharge_date LIKE  '$discharge_todays1' AND ipd_opd ='ipd'";
	        $discharge_todayss = $mysqli->query($discharge_todays);
	        //$admit_todayss1=$admit_todayss->fetch_assoc();
            $total_discharge_todays=$discharge_todayss->num_rows;
            echo "<br>today_total_discharge ".$total_discharge_todays."<br>";
            // end discharge_todays
            
            // discharge patient 
            echo  "<br>current date for discharge ".$date_discharge = $ADV_DAY;
            echo "<br>";
            echo "strat date for discharge ".$date_discharge1=$ADV_DAY1." 01:00";
            echo "<br>";
            echo "end date for discharge ".$date_discharge2 = $ADV_DAY1." 23:45";
            
            $rand_dis=rand(7,10);
            $old_date_dis=date('Y-m-d', strtotime("-$rand_dis days", strtotime($ADV_DAY1)));
            $old_date_dis1='%'.$old_date_dis.'%';
            
            $discharge_patient = "SELECT * FROM `patient_ipd` WHERE discharge_date ='0000-00-00' AND create_date LIKE  '$old_date_dis1' AND ipd_opd ='ipd'  LIMIT 1";
            $discharge_patient1 = $mysqli->query($discharge_patient);
            $discharge_patient2 = $discharge_patient1->fetch_assoc();
            $dis_id = $discharge_patient2['id'];
            $master_id_dis = $discharge_patient2['master_g_id'];
            $bed_remove=$discharge_patient2['bedNo'];
            echo "<br>dis id before".$dis_id;
              if(($date_discharge1 <= $date_discharge) && ($date_discharge2 >= $date_discharge) && ($total_discharge_todays <= $discharge_limit)){
                   echo "<br>discharge_id :".$dis_id."<br>";
             $date_of_dis=$ADV_DAY;
             $query3 = "update patient_ipd set discharge_date = '$date_of_dis' where id = ".$dis_id;
             $mysqli->query($query3);
             if($master_id_dis){
             $discharge_patient_nav = "SELECT * FROM `patient_ipd` WHERE discharge_date ='0000-00-00' AND master_g_id ='$master_id_dis' AND ipd_opd ='ipd'";
             $discharge_patient_nav1 = $mysqli->query($discharge_patient_nav);
             $discharge_patient_nav2 = $discharge_patient_nav1->fetch_assoc();
             $dis_id_nav = $discharge_patient_nav2['id']; 
             
             $query33 = "update patient_ipd set discharge_date = '$date_of_dis' where id = ".$dis_id_nav;
             $mysqli->query($query33);
             }
             if($bed_remove){
                 $query2222 = "update beds set status = 0 where id=".$bed_remove;
                      $mysqli->query($query2222);
                      
                       $query22222 = "update patient_ipd set bed_status = 0 where bedNo=".$bed_remove;
                      $mysqli->query($query22222);
             }else{
                 
                 
             }
              }
            //end discharge patient
            
             
            
        
        
              $m=0;
              $j=1;
              $ipd_opd2='opd';
              $ipd_opd='ipd';
              
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
                  
	              $occupation= array('Farmer','Office','Business','Driver','Labor','Jobless','Teacher','other');
	              $a=array(41,49,44,48,50,55,61,51,63,56,67);
              	
	         }
	         else if(($row['SEX']=='F') && ($row['VIBHAG'] !=32)){
	              $occupation= array('Farmer','Office','Business','Driver','Labor','Jobless','Teacher','other');
	              $a=array(41,49,44,48,50,55,61,51,63,56,67);
	         }
	         else{
	              $occupation= array('Student');
	              $a=array(16, 18, 20, 22,14,11,13);
                  $key = array_rand($a);
	         }
	          
	          
	          $c_o=$row['NIDAN'];
	         $h_o='NAD';
	         $f_o='NAD';
	         $bp=array('130/80','124/86','138/88','149/90','110/70','150/84','148/72','128/60','140/90');
	         $nadi=array('मंडूकगति', 'सर्पगती ' , 'हंसगति','अविशेष');
              $Pulse =array(76,78,88,90,68,72,82,75,81,77,85);
             $ur= 'अविशेष';
             $cvs ='S1S2 N';
             $udar='soft';
             $netra=array('आविल','अच्छ','इष्टपित')  ;
             $givwa=array('साम','निराम');
             $sudha=array('तीक्षाग','मंदाग  ','समाग्नी ','विषमाग्नी');  
            
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
	           
	          
              if($j == 1){
               $date_new = date('Y-m-d H:i',strtotime('- 10 minutes'))."<br>";
              }
              else if($j == 2){
               $date_new = date('Y-m-d H:i',strtotime('- 7 minutes'))."<br>";
              }
               else if($j == 3){
               $date_new = date('Y-m-d H:i',strtotime('- 4 minutes'))."<br>";
              }
               else if($j == 4){
               $date_new = date('Y-m-d H:i',strtotime('- 2 minutes'))."<br>";
              }
               
              else {
              $date_new =$ADV_DAY."<br>";
              }
             $date_new1=$ADV_DAY1;
              $j++;
                if(empty($row['CopddD_New'])){
                    $CopddD_New=NULL;
                    $Copdd_Old=$row['Copdd_Old'];
                      echo "<br>Sno: " . $row["Sno"]. " - Name: " . $row["NAME"]."<br>";
                      
                      if($row["NAME"]){
	                  $query1 = "insert into patient(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,wieght,occupation,c_o,h_o,f_h,pulse,bp,nadi,ur,cvs,udar,netra,givwa,shudha,ahar,mal,mutra,nidra) values('".$row["Sno"]."','".$row["yealry_number"]."','".$row['Daily']."','".$row['Monthly']."','".$Copdd_Old."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$adress_def[$key2]."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd2."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_new1."','".$a[$key]."','".$occupation[$key1]."' ,'".$c_o."','".$h_o."','".$f_o."','".$Pulse[$Pulse1]."','".$bp[$bp1]."','".$nadi[$nadi1]."','".$ur."','".$cvs."','".$udar."','".$netra[$netra1]."','".$givwa[$givwa1]."','".$sudha[$sudha1]."','".$ahar[$ahar1]."','".$mal[$mal1]."','".$mutra[$mutra1]."','".$nidra[$nidra1]."')";
                      $mysqli->query($query1);                                                                                                                                                                       
			          $query2 = "update items set flag=1 where Sno=".$row["Sno"];
                      $mysqli->query($query2);
                      }
            //MASTER GARBHINI INSERT INTO PATIENT
            $month=date('m');
           
            $year = '%'.$this->session->userdata['acyear'].'%';
            $year1=$this->session->userdata['acyear'];
            $d=cal_days_in_month(CAL_GREGORIAN,$month,$year1);
            $dd='%GARBHINI-SR%';
            $start_date=$year1.'-'.$month.'-01 00:00:00';
            //echo "<br>";
            $end_date=$year1.'-'.$month.'-'.$d.' 23:59:00'; 
           
             $auto_on_off = "SELECT count(*) as total FROM patient where create_date LIKE '$year' and dignosis LIKE '$dd' and create_date >='$start_date'and create_date <='$end_date'";
          
	         $auto_on_off1 = $mysqli->query($auto_on_off);
	         $auto_on_off2=$auto_on_off1->fetch_assoc();
             $auto_on_off3=$auto_on_off2['total'];
            
            $rand =rand(4,5);
           
            if($auto_on_off3 <= $rand){
              
                
               $G= "SELECT * FROM patient where create_date LIKE '$year' and dignosis LIKE '$dd' and create_date >='$start_date'and create_date <='$end_date' ORDER BY id DESC LIMIT 1";
               $G1 = $mysqli->query($G);
	           $G2=$G1->fetch_assoc();
               $G3= date('Y-m-d',strtotime($G2['create_date']));
               $today=date('Y-m-d');
               $datetime1 = date_create($G3); 
               $datetime2 = date_create($today); 
  
               $interval = date_diff($datetime1, $datetime2); 
               $interval1=$interval->format('%a'); 
               $rand1=rand(4,6);
               if($interval1 <= $rand1){
                  // echo "no";
                   
                         
               }else{
                   // echo "yes";
                    $last_id = "SELECT * FROM patient where create_date LIKE '$year' and  yearly_reg_no !='' ORDER BY id DESC LIMIT 1";
                    $last_id1 = $mysqli->query($last_id);
	                $last_id2=$last_id1->fetch_assoc();
	                     $patient_id=$last_id2['patient_id'] + 1;
                         $yearly_reg_no=$last_id2['yearly_reg_no'] + 1;
                         $year_no = $last_id2['yearly_no'] + 1;
                         $daily_reg_no = $last_id2['daily_reg_no'] + 1;
                        // $old_reg_no = $last_id2['old_reg_no'] + 1;
                        
                        $master_gar = "SELECT * FROM garbhini_navjat where status ='0'  ORDER BY id DESC LIMIT 1";
                        $master_gar1 = $mysqli->query($master_gar);
	                    $master_gar2=$master_gar1->fetch_assoc();
                        $master_id=$master_gar2['id'];
                         
                      if($m == 1){  
                    if($master_gar2['m_name']){
                      $date_new1=$ADV_DAY1;
                      if($master_gar2['m_name']){
                      $query1 = "insert into patient(patient_id,yearly_reg_no,yearly_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,master_g_id,follow_up,wieght,occupation) values('".$patient_id."','".$yearly_reg_no."','".$year_no."','".$daily_reg_no."','','".$master_gar2['m_name']."','".$master_gar2['sex']."','".$master_gar2['age']."','".$adress_def[$key2]."','".$master_gar2['department_id']."','".$master_gar2['dignosis']."','".$master_gar2['ipd_opd']."','','','".$date_new1."','".$master_gar2['id']."','".$master_gar2['follow_up']."','".$a[$key]."','".$occupation[$key1]."')";
                      $mysqli->query($query1);
			          $query2 = "update garbhini_navjat set status=1 where id=".$master_id;
                      $mysqli->query($query2);
                      }
                          
                      }
                          
                      }     
                   }

                   } else {
                   echo "No garbhini limit over";
                  }
                      //END GARBHINI
                      
                      
              
                     if(($single_record == $m) && ($total_admit_todays <= $admit_limit)){
                  
                   
                      if(($date_admit1 <= $date_admit) && ($date_admit2 >= $date_admit) && ($total_discharge_todays <= $discharge_limit)) {
                          if(($row['VIBHAG'] == '35') || ($row['VIBHAG'] == '28')){
                          }
                          else{
                          
                          $gender1=$row['SEX'];
                          $depart_id1= $row['VIBHAG'];
                          
                        if($depart_id1 == '28'){
                            $depart_id='34';
                        }else{
                             $depart_id= $row['VIBHAG'];
                        }
                         $bed = "SELECT * FROM beds WHERE gender ='$gender1' AND department_id ='$depart_id' AND status ='0' LIMIT  1";
                         $bed_no = $mysqli->query($bed);
	                     $bed_no1=$bed_no->fetch_assoc(); 
	                       if ($bed_no1) {
                            $admit_bed=$bed_no1['id'];
                            }else{
	                          $admit_bed ='';
	                        }
	                        //Admit only available diagnosis in ipd
	                    $nivan=$row['NIDAN']."I";
	                    $nivan1='%'.$nivan.'%';
	                    $admit_avai_diagnosis = "SELECT * FROM treatments WHERE dignosis like '$nivan1' AND ipd_opd ='ipd'";
                        $admit_avai_diagnosis1 = $mysqli->query($admit_avai_diagnosis);
	                    $admit_avai_diagnosis2=$admit_avai_diagnosis1->fetch_assoc(); 
	                    if($admit_avai_diagnosis2){ 
	                        
	                        $bed_status='1';
                      $query12 = "insert into patient_ipd(patient_id,yearly_no,daily_reg_no,monthly_reg_no,old_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,bedNo,bed_status,discharge_date,create_date) values('".$row["Sno"]."','".$row["yealry_number"]."','".$row['Daily']."','".$row['Monthly']."','".$row['Copdd_Old']."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$row['Address']."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd."','".$row1['ipd_no']."','".$admit_bed."','".$bed_status."','".$row['Dischargedate']."','".$date_new."')";
                      $mysqli->query($query12); 
                      $query22 = "update patient_ipd set ipd_flag = 1 where patient_id=".$row["Sno"];
                      $mysqli->query($query22);
                      
                      $query222 = "update beds set status = 1 where id=".$admit_bed;
                      $mysqli->query($query222);
	                    }
                       }
                      }
                      else {
                         echo "<br>no admit<br>";
                       
                     }
                   }
                }
                else {
                    $CopddD_New=$row['CopddD_New'];

                     $Copdd_Old=NULL;
                     $date_new1=$ADV_DAY1;
                     echo "<br>Sno: " . $row["Sno"]. " - Name: " . $row["NAME"]."<br>";
                     if($row["NAME"]){
                        
	                  $query1 = "insert into patient(patient_id,yearly_no,yearly_reg_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,wieght,occupation,c_o,h_o,f_h,pulse,bp,nadi,ur,cvs,udar,netra,givwa,shudha,ahar,mal,mutra,nidra) values('".$row["Sno"]."','".$row["yealry_number"]."','".$CopddD_New."','".$row['Daily']."','".$row['Monthly']."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$adress_def[$key2]."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd2."','".$row1['ipd_no']."','".$row['Dischargedate']."','".$date_new1."','".$a[$key]."','".$occupation[$key1]."','".$c_o."','".$h_o."','".$f_o."','".$Pulse[$Pulse1]."','".$bp[$bp1]."','".$nadi[$nadi1]."','".$ur."','".$cvs."','".$udar."','".$netra[$netra1]."','".$givwa[$givwa1]."','".$sudha[$sudha1]."','".$ahar[$ahar1]."','".$mal[$mal1]."','".$mutra[$mutra1]."','".$nidra[$nidra1]."')";
                      $mysqli->query($query1);
                     // echo $query1;
			          $query2 = "update items set flag=1 where Sno=".$row["Sno"];
                      $mysqli->query($query2);
                     }
                      
                      //MASTER GARBHINI INSERT INTO PATIENT
            $month=date('m');
           
            $year = '%'.$this->session->userdata['acyear'].'%';
            $year1=$this->session->userdata['acyear'];
            $d=cal_days_in_month(CAL_GREGORIAN,$month,$year1);
            $dd='%GARBHINI-SR%';
            $start_date=$year1.'-'.$month.'-01 00:00:00';
            //echo "<br>";
            $end_date=$year1.'-'.$month.'-'.$d.' 23:59:00'; 
           
             $auto_on_off = "SELECT count(*) as total FROM patient where create_date LIKE '$year' and dignosis LIKE '$dd' and create_date >='$start_date'and create_date <='$end_date'";
          
	         $auto_on_off1 = $mysqli->query($auto_on_off);
	         $auto_on_off2=$auto_on_off1->fetch_assoc();
             $auto_on_off3=$auto_on_off2['total'];
            
            $rand =rand(4,5);
           
            if($auto_on_off3 <= $rand){
              
                
               $G= "SELECT * FROM patient where create_date LIKE '$year' and dignosis LIKE '$dd' and create_date >='$start_date'and create_date <='$end_date' ORDER BY id DESC LIMIT 1";
               $G1 = $mysqli->query($G);
	           $G2=$G1->fetch_assoc();
               $G3= date('Y-m-d',strtotime($G2['create_date']));
               $today=date('Y-m-d');
               $datetime1 = date_create($G3); 
               $datetime2 = date_create($today); 
  
               $interval = date_diff($datetime1, $datetime2); 
               $interval1=$interval->format('%a'); 
               $rand1=rand(4,6);
               if($interval1 <= $rand1){
                  // echo "no";
                   
                         
               }else{
                   //echo "yes";
                    $last_id = "SELECT * FROM patient where create_date LIKE '$year' and  yearly_reg_no !='' ORDER BY id DESC LIMIT 1";
                    $last_id1 = $mysqli->query($last_id);
	                $last_id2=$last_id1->fetch_assoc();
	                     $patient_id=$last_id2['patient_id'] + 1;
                         $yearly_reg_no=$last_id2['yearly_reg_no'] + 1;
                         $year_no = $last_id2['yearly_no'] + 1;
                         $daily_reg_no = $last_id2['daily_reg_no'] + 1;
                        // $old_reg_no = $last_id2['old_reg_no'] + 1;
                        
                        $master_gar = "SELECT * FROM garbhini_navjat where status ='0'  ORDER BY id DESC LIMIT 1";
                        $master_gar1 = $mysqli->query($master_gar);
	                    $master_gar2=$master_gar1->fetch_assoc();
                        $master_id=$master_gar2['id'];
                         
                        $date_new1=$ADV_DAY1;
                         if($m == 1){ 
                             if($master_gar2['m_name']){
                      $query1 = "insert into patient(patient_id,yearly_reg_no,yearly_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,discharge_date,create_date,master_g_id,follow_up,wieght,occupation) values('".$patient_id."','".$yearly_reg_no."','".$year_no."','".$daily_reg_no."','','".$master_gar2['m_name']."','".$master_gar2['sex']."','".$master_gar2['age']."','".$adress_def[$key2]."','".$master_gar2['department_id']."','".$master_gar2['dignosis']."','".$master_gar2['ipd_opd']."','','','".$date_new1."','".$master_gar2['id']."','".$master_gar2['follow_up']."','".$a[$key]."','".$occupation[$key1]."')";
                      $mysqli->query($query1);
			          $query2 = "update garbhini_navjat set status=1 where id=".$master_id;
                      $mysqli->query($query2);
                             }
                         }          
               }

            } else {
                echo "No garghan limit over";
            }
                      //END GARBHINI
              
                     if(($single_record == $m) && ($total_admit_todays <= $admit_limit)){
                  
                  
                      if(($date_admit1 <= $date_admit) && ($date_admit2 >= $date_admit)) {
                            if(($row['VIBHAG'] == '35') || ($row['VIBHAG'] == '28')){
                          }
                          else{
                               echo "ADMITTTTTTTTA";
                          $gender1=$row['SEX'];
                          $depart_id1= $row['VIBHAG'];
                           if($depart_id1 == '28'){
                            $depart_id='34';
                        }else{
                             $depart_id= $row['VIBHAG'];
                        }
                        
                        
                         $bed = "SELECT * FROM beds WHERE gender ='$gender1' AND department_id ='$depart_id' AND status ='0' LIMIT  1";
                         $bed_no = $mysqli->query($bed);
	                     $bed_no1=$bed_no->fetch_assoc(); 
	                       if ($bed_no1) {
                            $admit_bed=$bed_no1['id'];
                            }else{
	                          $admit_bed ='';
	                        }
	                    
	                    //Admit only available diagnosis in ipd
	                    $nivan=$row['NIDAN']."I";
	                    $nivan1='%'.$nivan.'%';
	                    $admit_avai_diagnosis = "SELECT * FROM treatments WHERE dignosis like '$nivan1' AND ipd_opd ='ipd'";
                        $admit_avai_diagnosis1 = $mysqli->query($admit_avai_diagnosis);
	                    $admit_avai_diagnosis2=$admit_avai_diagnosis1->fetch_assoc(); 
	                    if($admit_avai_diagnosis2){ 
	                         $bed_status='1';
                      $query12 = "insert into patient_ipd(patient_id,yearly_no,yearly_reg_no,daily_reg_no,monthly_reg_no,firstname,sex,date_of_birth,address,department_id,dignosis,ipd_opd,ipd_no,bedNo,bed_status,discharge_date,create_date) values('".$row["Sno"]."','".$row["yealry_number"]."','".$CopddD_New."','".$row['Daily']."','".$row['Monthly']."','".$row["NAME"]."','".$row['SEX']."','".$row['AGE']."','".$row['Address']."','".$row['VIBHAG']."','".$row['NIDAN']."','".$ipd_opd."','".$row1['ipd_no']."','".$admit_bed."','".$bed_status."','".$row['Dischargedate']."','".$date_new1."')";
                      $mysqli->query($query12); 
                      echo $query12;
                      $query22 = "update patient_ipd set ipd_flag = 1 where patient_id=".$row["Sno"];
                      %