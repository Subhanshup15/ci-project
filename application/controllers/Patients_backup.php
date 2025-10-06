<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'patient_model',
			'doctor_model',
			'document_model',
			'department_model',
			'dignosis_model',
			'bed_manager/bed_model'
		));
	     
	     $this->load->helper('url');
		 $this->load->library("pagination");

		$this->load->library('excel');

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 1) 
			redirect('login');
	}
 
	public function index()
	{ 

		$section = 'opd';

		$year = '%'.$this->session->userdata['acyear'].'%';

		$data['title'] = "Patient OPD List";
		$data['patients'] = $this->patient_model->read();

		$data['content'] = $this->load->view('patient',$data,true);	
		$this->load->view('layout/main_wrapper',$data);
	} 

    public function email_check($email, $id)
    { 
        $emailExists = $this->db->select('email')
            ->where('email',$email) 
            ->where_not_in('id',$id) 
            ->get('patient')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
            return false;
        } else {
            return true;
        }
    }
    
    public function discharge_patient_by_id()
	{
	     $id = $this->input->get('discharge_id');
	     "<br>";
	     $discharge_date1 = $this->input->get('discharge_date');
	     $discharge_date=date('Y-m-d', strtotime($discharge_date1));
	     $bedno = $this->input->get('bedno');
	    	$data['patient'] = (object)$postData = [
					'id'   		   => $id,
					'discharge_date' => $discharge_date,
					'bed_status'		=> 0
				]; 
	    
	       $data['patient1'] = (object)$postData1 = [
					'id'   		   => $bedno,
					'status'		=> 0
				]; 
	    if ($postData) {
				$this->patient_model->update_dis($postData);
				$this->patient_model->update_beds($postData1);
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patients/ipdprofile/'.$id);
	    
	}
	
	/*public function discharge_patient_by_id()
	{
	     $id = $this->input->get('discharge_id');
	     "<br>";
	     $discharge_date1 = $this->input->get('discharge_date');
	     $discharge_date=date('Y-m-d', strtotime($discharge_date1));
	     $bedno = $this->input->get('bedno');
	    	$data['patient'] = (object)$postData = [
					'id'   		   => $id,
					'discharge_date' => $discharge_date,
					'bed_status'		=> 0
				]; 
	    
	       $data['patient1'] = (object)$postData1 = [
					'id'   		   => $bedno,
					'status'		=> 0
				]; 
	    if ($postData) {
				$this->patient_model->update_dis($postData);
				$this->patient_model->update_beds($postData1);
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patients/ipdprofile/'.$id);
	    
	}*/
    
    public function despensing($section)
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);
         $date_c=date('Y-m-d',strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
      $data['check_data'] = $this->patient_model->read_by_check_data($section,$date_c);

	//	echo count($data['patients'] );exit;
		$section = $section;
        
        
		$year = '%'.$this->session->userdata['acyear'].'%';

       if($section == 'ipd'){
		
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
	    $data['gobs'] = 'gobs';

		$data['content'] = $this->load->view('patient_despensing',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
	}
	else{
	    	

		
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='opd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		

		$data['content'] = $this->load->view('patient_despensing',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}
	}
	
	public function patient_despensing_by_date()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
      
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date2);
       $date2=date_create($end_date2);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

	

        if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
	//	->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		->get()

		->result();
            
      
		$data['department_by_section'] ='opd';  
         }
         else
         {

        $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', 'ipd')
		->or_where('discharge_date', $start_date)

		->where('ipd_opd', 'ipd')

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date)

		->where('discharge_date LIKE', '%0000-00-00%')

	    ->where('ipd_opd', 'ipd')

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
          $data['department_by_section'] ='ipd';         
         }
	
	
		if($data == null){
			$data['content'] = $this->load->view('patient_despensing',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient_despensing',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
		
	}	
	
    public function patient_by_date_occupancy1111()
	{ 
       echo error_reporting(0);
       ini_set('memory_limit','-1');
		$year = '%'.$this->session->userdata['acyear'].'%';
	    $login_year = $this->session->userdata['acyear'];
	    $next_year=$login_year + 1;

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
      //$array_push=array('2019-02-15');
       
       $period = new DatePeriod(
     new DateTime($login_year.'-01-01'),
     new DateInterval('P1D'),
     new DateTime($next_year.'-01-01')
);
$array_push=array();
foreach ($period as $key => $value) {
    
     $value->format('Y-m-d');  
   /* echo "<br>";*/
    array_push($array_push, $value->format('Y-m-d'));
}
      //array_push($array_push,'2019-12-31');
     // echo '2019-12-31';
     // echo "<br>";
     // echo "<br>";
      
      $jan1=0; $feb1=0; $march1=0;$april1=0;$may1=0;$june1=0;$jully1=0;$aguest1=0;$sebt1=0;$octo1=0;$nove1=0;$desm1=0; $tot_sum=0; $tot_sum1=0;
      
      $k1=0;$k2=0;$k3=0;$k4=0;$k5=0;$k6=0;$k7=0;$k8=0;$k9=0;$k10=0;$k11=0;$k12=0;
      
      $pn1=0;$p2=0;$p3=0;$p4=0;$p5=0;$p6=0;$p7=0;$p8=0;$p9=0;$p10=0;$p11=0;$p12=0;
      
      $sl1=0;$sl2=0;$sl3=0;$sl4=0;$sl5=0;$sl6=0;$sl7=0;$sl8=0;$sl9=0;$sl10=0;$sl11=0;$sl12=0;
      
      $sk1=0;$sk2=0;$sk3=0;$sk4=0;$sk5=0;$sk6=0;$sk7=0;$sk8=0;$sk9=0;$sk10=0;$sk11=0;$sk12=0;
      
      $st1=0;$st2=0;$st3=0;$st4=0; $st5=0;$st6=0;$st7=0;$st8=0;$st9=0;$st10=0;$st11=0;$st12=0;
      
      $b1=0;$b2=0;$b3=0;$b4=0;$b5=0;$b6=0;$b7=0;$b8=0;$b9=0;$b10=0;$b11=0;$b12=0;
      
      
      
      for($i=0;$i<count($array_push);$i++){
      
		$start_date2 = date('Y-m-d',strtotime($array_push[$i]));

		$end_date2   = date('Y-m-d',strtotime($array_push[$i]));

		$section = 'ipd';

         $start_date= $start_date2." 00:00:00";
		 $start_date_f= $start_date2." 23:59:00";
         $end_date= $end_date2." 23:59:00";
      // $start_date=$start_date1." 00:00:00";
      // $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		//echo $section;
         $month=date('m',strtotime($end_date));
        
        
         $patients1 = $this->db->select("COUNT(*) as Total,department.dprt_id as name")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)
        ->group_by('department.dprt_id')
		->where('create_date <=', $end_date)
	   

		->where('ipd_opd', $section)
	//	->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
   //	print_r($patients1);
        $patients12=0; $p1=0;
       
      for($n=0;$n<count($patients1);$n++){
      //echo $patients1[$n]->Total;
    //  echo "<br>";

 
 
	      

		//Array 2
		$patients2 = $this->db->select("COUNT(*) as Total,department.dprt_id as name")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
	   
		->where('create_date <=', $end_date)
	     ->group_by('department.dprt_id')

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', $section)

		->get()

		->result();

         if($patients2[$n]){
            $pp1 += $patients2[$n]->Total;
         }else{
             $pp1=0;
         }
         //echo $end_date; echo "  ";
        
    	$patients12 += $patients1[$n]->Total + $pp1;
    
        //echo $patients1[$n]->name;
        if($patients1[$n]->name==34)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $k +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $k1 +=$patients1[$n]->Total + $ss;} else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $k2 +=$patients1[$n]->Total + $ss;}
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $k3 +=$patients1[$n]->Total + $ss;} else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss;  $k4 +=$patients1[$n]->Total + $ss;}
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $k5 +=$patients1[$n]->Total + $ss;}else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $k6 +=$patients1[$n]->Total + $ss;}
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $k7 +=$patients1[$n]->Total + $ss;} else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $k8 +=$patients1[$n]->Total + $ss;}
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $k9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss;  $k10 +=$patients1[$n]->Total + $ss;}
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $k11 +=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $k12 +=$patients1[$n]->Total + $ss;}
        }
        
        if($patients1[$n]->name==33)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $p +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $pn1 +=$patients1[$n]->Total + $ss; } else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $p2 +=$patients1[$n]->Total + $ss; }
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $p3 +=$patients1[$n]->Total + $ss;} else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $p4 +=$patients1[$n]->Total + $ss; }
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $p5 +=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $p6 +=$patients1[$n]->Total + $ss; }
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $p7 +=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $p8 +=$patients1[$n]->Total + $ss; }
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $p9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $p10 +=$patients1[$n]->Total + $ss; }
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $p11 +=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $p12 +=$patients1[$n]->Total + $ss; }
        }
        if($patients1[$n]->name==32)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
            $b +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $b1 +=$patients1[$n]->Total + $ss; } else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $b2 +=$patients1[$n]->Total + $ss; }
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $b3 +=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $b4 +=$patients1[$n]->Total + $ss; }
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $b5 +=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $b6 +=$patients1[$n]->Total + $ss; }
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $b7 +=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $b8 +=$patients1[$n]->Total + $ss; }
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $b9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $b10 +=$patients1[$n]->Total + $ss; }
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $b11 +=$patients1[$n]->Total + $ss;  }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $b12 +=$patients1[$n]->Total + $ss;  }
        }
        if($patients1[$n]->name==31)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $sl +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $sl1 +=$patients1[$n]->Total + $ss;} else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $sl2 +=$patients1[$n]->Total + $ss;}
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $sl3 +=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $sl4 +=$patients1[$n]->Total + $ss;}
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $sl5 +=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $sl6 +=$patients1[$n]->Total + $ss;}
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $sl7 +=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $sl8 +=$patients1[$n]->Total + $ss;}
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $sl9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $sl10 +=$patients1[$n]->Total + $ss;}
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $sl11 +=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $sl12 +=$patients1[$n]->Total + $ss;}
        }
        if($patients1[$n]->name==30)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $sk +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $sk1+=$patients1[$n]->Total + $ss; } else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $sk2+=$patients1[$n]->Total + $ss;}
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $sk3+=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $sk4+=$patients1[$n]->Total + $ss;}
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $sk5+=$patients1[$n]->Total + $ss;}else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $sk6+=$patients1[$n]->Total + $ss;}
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $sk7+=$patients1[$n]->Total + $ss;} else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $sk8+=$patients1[$n]->Total + $ss;}
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $sk9+=$patients1[$n]->Total + $ss;} else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $sk10+=$patients1[$n]->Total + $ss;}
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $sk11+=$patients1[$n]->Total + $ss;}else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $sk12+=$patients1[$n]->Total + $ss;}
        }
        if($patients1[$n]->name==29)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $st +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $st1+=$patients1[$n]->Total + $ss;} else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $st2+=$patients1[$n]->Total + $ss; }
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $st3+=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $st4+=$patients1[$n]->Total + $ss; }
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $st5+=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $st6+=$patients1[$n]->Total + $ss; }
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $st7+=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $st8+=$patients1[$n]->Total + $ss; }
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $st9+=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss;  $st10+=$patients1[$n]->Total + $ss; }
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $st11+=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $st12+=$patients1[$n]->Total + $ss; }
        }
        
    
	}
		//echo $end_date;	echo " ";	echo $patients12;	echo " ";
	//	echo $k;echo " ";echo $p;	echo " "; echo $b;echo " ";echo $sl;echo " ";	echo $sk;echo " ";echo $st;
	    
      }
     /* echo "<br>";
     echo $k1;echo " ";	echo $k2;  echo " ";	echo $k3;echo " ";	echo $k4; echo " ";	echo $k5;echo " ";	echo $k6;  echo " ";	echo $k7;echo " ";	echo $k8; 
     echo " ";	echo $k9;echo " ";	echo $k10;  echo " ";	echo $k11;echo " ";	echo $k12;*/
     $b1;
     
       $data['jan'] =array('0',$st1,$sk1,$sl1,$b1,$pn1,$k1,'0');
       $data['feb'] =array('0',$st2,$sk2,$sl2,$b2,$p2,$k2,'0');
       $data['march'] =array('0',$st3,$sk3,$sl3,$b3,$p3,$k3,'0');
       $data['april'] =array('0',$st4,$sk4,$sl4,$b4,$p4,$k4,'0');
       $data['may']=array('0',$st5,$sk5,$sl5,$b5,$p5,$k5,'0');
       
       $data['june'] =array('0',$st6,$sk6,$sl6,$b6,$p6,$k6,'0');
       $data['jully'] =array('0',$st7,$sk7,$sl7,$b7,$p7,$k7,'0');
       $data['aguest'] =array('0',$st8,$sk8,$sl8,$b8,$p8,$k8,'0');
       $data['sebt'] =array('0',$st9,$sk9,$sl9,$b9,$p9,$k9,'0');
       $data['octo'] =array('0',$st10,$sk10,$sl10,$b10,$p10,$k10,'0');
       $data['nove'] =array('0',$st11,$sk11,$sl11,$b11,$p11,$k11,'0');
       $data['desm'] =array('0',$st12,$sk12,$sl12,$b12,$p12,$k12,'0');
       
     
     
     
     
     
   
	/*echo  $jan1; echo " ";	echo  $feb1; echo " ";	echo " ";	echo $march1; echo " ";	echo  $april1;echo " ";	echo $may1;echo " ";	echo $june1;
	echo " ";	echo $jully1; echo " ";	echo  $aguest1; echo " ";	echo $sebt1; echo " ";	echo  $octo1; echo " ";	echo $nove1; echo " "; echo $desm1;*/


	
 
		
            
        $data['department']=$this->patient_model->get_all_dept();
      
		$data['datefrom'] = '2018';
		$data['dateto'] = '2018';
       
        $data['month_bed'] = 'month_bed';
    
      
       
		$data['content'] = $this->load->view('patient_month_report',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
		
		
	}
	
	public function create()
	{    //echo "dsdsd";
	//exit;
            //echo error_reporting(0); 
			$data['title'] = display('add_patient');
			$id = $this->input->post('id');
			
			$status_ipd_opd= $this->input->post('ipd_opd');
			
			#-------------------------------#
			$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');		
			//$this->form_validation->set_rules('blood_group', display('blood_group'),'m');
			$this->form_validation->set_rules('sex', display('sex'),'required');
			$this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'required|max_length[10]');
			$this->form_validation->set_rules('create_date', display('create_date'),'required|max_length[20]');
			//$this->form_validation->set_rules('assign_date', display('assign_date'),'required|max_length[10]');
			$this->form_validation->set_rules('department_id', display('department_name'),'required|max_length[255]');
			$this->form_validation->set_rules('address', display('address'),'required|max_length[255]');
			$this->form_validation->set_rules('status', display('status'),'required');
			if($id != null && $status_ipd_opd == 'ipd'){
			    $this->form_validation->set_rules('doctor_id', display('doctor_name'),'required|max_length[255]');
			}
			elseif($status_ipd_opd == 'ipd'){
    			$this->form_validation->set_rules('bedNo', display('bedNo'),'required');
    			$this->form_validation->set_rules('doctor_id', display('doctor_name'),'required|max_length[255]');
			}
			
			#-------------------------------#
			//picture upload
			$picture = $this->fileupload->do_upload(
				'assets/images/patient/',
				'picture'
			);
	
	
			//Registration numbr create
	
			$acyear = $this->session->userdata('acyear');
	        
	        if($status_ipd_opd=='opd'){
    			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
    			->from('patient')
    			->where('yearly_reg_no != ', '')
    	        ->where('year(create_date)', $acyear)
    			->order_by("id desc")
    			->limit(1)->get()->result_array();
			} 
	        else {
    	         $q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
        			->from('patient_ipd')
        			//->where('create_date LIKE', $acyear)
        			->order_by("id desc")
        			->limit(1)->get()->result_array();  
	        }
	        
	        //print_r($status_ipd_opd);
	        //print_r($q);
	        //print_r($this->db->last_query());
	        //die();
	        
			$timezone = "Asia/Kolkata";
			 date_default_timezone_set($timezone);
	
			/*$patient_id = $q[0]['patient_id'];
			$yearly_reg_no1 = $q[0]['yearly_reg_no'];
			if($yearly_reg_no1){
		    $yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
			}
			else{
			  $yearly_reg_no2 = 1;  
			}
			$yearly_no1 = $q[0]['yearly_no'];
			
			$monthly_reg_no1 = $q[0]['monthly_reg_no'];
			$daily_reg_no1 = $q[0]['daily_reg_no'];
			$old_reg_no1 = $q[0]['old_reg_no'];
			$create_date1 = $q[0]['create_date'];
	
			$currentYear = date("Y");
			$currentmonth = date("m");
			$currentday = date("d/m/Y");
	
			$oldyear = date("Y", strtotime($q[0]['create_date']));
			$oldmonth = date("d", strtotime($q[0]['create_date']));
			$oldday = date("d/m/Y", strtotime($q[0]['create_date']));*/
			
			$patient_id = 0; 
			$yearly_reg_no1 = 0; 
			$yearly_no1 = 0; 
			$monthly_reg_no1 = 0; 
    		$daily_reg_no1 = 0;
    		$old_reg_no1 = 0;
    		$create_date1 = 0;
    
    		$currentYear = 0;
    		$currentmonth = 0;
    		$currentday = 0;
    
    		$oldyear = 0;
    		$oldmonth = 0;
    		$oldday = 0;
			if($q != null){
			    $patient_id = $q[0]['patient_id'];
			    $yearly_reg_no1 = $q[0]['yearly_reg_no'];
                $yearly_no1 = $q[0]['yearly_no'];
			
        		$monthly_reg_no1 = $q[0]['monthly_reg_no'];
        		$daily_reg_no1 = $q[0]['daily_reg_no'];
        		$old_reg_no1 = $q[0]['old_reg_no'];
        		$create_date1 = $q[0]['create_date'];
        
        		$currentYear = date("Y");
        		$currentmonth = date("m");
        		$currentday = date("d/m/Y");
        
        		$oldyear = date("Y", strtotime($q[0]['create_date']));
        		$oldmonth = date("d", strtotime($q[0]['create_date']));
        		$oldday = date("d/m/Y", strtotime($q[0]['create_date']));
			}
			
			if($yearly_reg_no1 != 0){
		    $yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
			}
			else{
			  $yearly_reg_no2 = 1;  
			}
			//print_r($yearly_reg_no2);
			//die();
			
			//print_r($currentYear);
			//print_r('===>');
			//print_r($oldyear);

			//Yearly Number
			$monthly_reg_no = 0; 
			if($currentYear > $oldyear){
			//	$yearly_no = 1;
				$yearly_no = 1;
				$yearly_reg_no1=1;
				$patient_id = 1;
				$monthly_reg_no = 1;
	     
			}else{
			//	$yearly_no = $yearly_no1 + 1;
				$yearly_no = $yearly_no1 + 1;
				$yearly_reg_no1=$yearly_reg_no1 + 1;
				$patient_id =$patient_id + 1;
				//Monthly Number
				if($currentmonth > $oldmonth){			
					$monthly_reg_no = 1;
					
				}else{			
					$monthly_reg_no = (int)$monthly_reg_no1 + 1;
				}
			}
			//print_r('===>');
			//print_r($yearly_no);

			//Daily Number
			$daily_reg_no = '';
			if($currentday == $oldday){
				$daily_reg_no = (int)$daily_reg_no1 + 1;			
			}else{
				$daily_reg_no = 1;		
			}
			//print_r($daily_reg_no);

			// if picture is uploaded then resize the picture
			if ($picture !== false && $picture != null) {
				$this->fileupload->do_resize(
					$picture, 
					200,
					150
				);
			}
	
			//if picture is not uploaded
			if ($picture === false) {
				$this->session->set_flashdata('exception', display('invalid_picture'));
			}
			
			$sex =$this->input->post('sex');
			if($sex == 'Male'){
			   //$sex1 ='Male';
			   $sex ='M';
			 	
			}  
			elseif($sex == 'Female'){
			     //$sex1 ='Female';
			     $sex ='F';
			}
			#-------------------------------#
			if ($this->input->post('id') == null) { 
				if($this->input->post('old_reg_no') == null || $this->input->post('old_reg_no') == ''){
				    
					$data['patient'] = (object)$postData = [
						'id'   		   => $this->input->post('id'),
					    'patient_id'   => $patient_id,
						'yearly_reg_no' => $this->input->post('yearly_reg_no'),
						'yearly_no' => $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'ipd_no' => $this->input->post('ipd_no'),
					    'firstname'    => strtoupper($this->input->post('firstname')),
						'lastname' 	   => $this->input->post('lastname'),
						'email' 	   => $this->input->post('email'),
						'password' 	   => md5($this->input->post('password')),
						'phone'   	   => $this->input->post('phone'),
						'mobile'       => $this->input->post('mobile'),
						'blood_group'  => $this->input->post('blood_group'),
						'sex' 		   => $sex, 
						'date_of_birth' => $this->input->post('date_of_birth'),
						'address' 	   => $this->input->post('address'),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'affliate'     => null,
						'create_date'  => date('Y-m-d', strtotime(($this->input->post('create_date') != null)? $this->input->post('create_date'): date('Y-m-d'))),
						'created_by'   => $this->session->userdata('user_id'),
						'status'       => $this->input->post('status'),
						'ipd_opd' 	   => $this->input->post('ipd_opd'),
						'department_id'  => $this->input->post('department_id',true), 
						'doctor_id'      => $this->input->post('doctor_id',true),
						'assign_date'   => $this->input->post('assign_date'),
						'discharge_date' => ($this->input->post('discharge_date') != '')? $this->input->post('discharge_date') : '0000-00-00',
						'dignosis'      => strtoupper($this->input->post('dignosis')),
						'wardType'      => $this->input->post('wardType'),
						'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
						'income'		=> $this->input->post('income'),
						'occupation'	=> $this->input->post('occupation'),
						'wieght'	=>    $this->input->post('weight'),
						'anesthesia'	=> $this->input->post('anesthesia'),
						'religion'		=> $this->input->post('religion'),
						'result'		=> $this->input->post('result')
	
					]; 
				}
				else
				{
				    if($this->input->post('status1')=='old' && $this->input->post('ipd_opd')=='opd'){
				        $y_new_reg = null;
				        $y_old_reg = $this->input->post('old_reg_no');
				        $patient_id = $this->input->post('old_reg_no');
                        $yearly_no = $this->input->post('old_reg_no');
				    }
				    elseif($this->input->post('ipd_opd')=='ipd'){
				        $y_new_reg = $this->input->post('old_reg_no');
				    }
				    else{
				        $y_new_reg = $yearly_reg_no1;
				        $y_old_reg = $this->input->post('old_reg_no');
				    }
				   	$data['patient'] = (object)$postData = [
						'id'   		   => $this->input->post('id'),
						'patient_id'   => $patient_id,
						'yearly_reg_no' =>  $y_new_reg,
						'yearly_no' =>  $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'old_reg_no' => ($this->input->post('ipd_opd')!='ipd')? $y_old_reg : null,
						'ipd_no' => $this->input->post('ipd_no'),
						'firstname'    => $this->input->post('firstname'),
						'lastname' 	   => $this->input->post('lastname'),
						'email' 	   => $this->input->post('email'),
						'password' 	   => md5($this->input->post('password')),
						'phone'   	   => $this->input->post('phone'),
						'mobile'       => $this->input->post('mobile'),
						'blood_group'  => $this->input->post('blood_group'),
						'sex' 		   => $sex, 
						'date_of_birth' => $this->input->post('date_of_birth'),
						'address' 	   => $this->input->post('address'),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'affliate'     => null,
						'create_date'  => date('Y-m-d', strtotime(($this->input->post('create_date') != null)? $this->input->post('create_date'): date('Y-m-d'))),
						'created_by'   => $this->session->userdata('user_id'),
						'status'       => $this->input->post('status'),
						'ipd_opd' 	   => $this->input->post('ipd_opd'),
						'department_id'  => $this->input->post('department_id',true), 
						'doctor_id'      => $this->input->post('doctor_id',true),
						'assign_date'   => $this->input->post('assign_date'),
						'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
						'dignosis'      => $this->input->post('dignosis'),
						'wardType'      => $this->input->post('wardType'),
						'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
						'income'		=> $this->input->post('income'),
						'occupation'	=> $this->input->post('occupation'),
					    'wieght'	=>    $this->input->post('weight'),
						'anesthesia'	=> $this->input->post('anesthesia'),
						'religion'		=> $this->input->post('religion'),
						'result'		=> $this->input->post('result')
					]; 
				}
			} else { 
    			if($this->input->post('update_old_reg_no')!='' && $this->input->post('ipd_opd')=='opd')
    			{
    			    $data['patient'] = (object)$postData = [
    					'id'   		   => $this->input->post('id'),
    					'patient_id'   => $this->input->post('update_old_reg_no'),
    					'yearly_reg_no' => ($this->input->post('yearly_reg_no'))?$this->input->post('yearly_reg_no'):NULL,
    					'yearly_no' => $this->input->post('update_old_reg_no'),
    					'old_reg_no' => $this->input->post('update_old_reg_no'),
    					'firstname'    => strtoupper($this->input->post('firstname')),
    			        'blood_group'  => $this->input->post('blood_group'),
    					'sex' 		   => $sex, 
    					'date_of_birth' => $this->input->post('date_of_birth'),
    					'address' 	   => $this->input->post('address'),
    				    'affliate'     => null, 
    					'created_by'   => $this->session->userdata('user_id'),
    					'status'       => $this->input->post('status'),
    					'ipd_opd' 	   => $this->input->post('ipd_opd'),
    					'department_id'  => $this->input->post('department_id',true), 
    					'doctor_id'      => $this->input->post('doctor_id',true),
    					'assign_date'   => $this->input->post('assign_date'),
    					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
    					'dignosis'      => strtoupper($this->input->post('dignosis')),
    					'wardType'      => $this->input->post('wardType'),
    					'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
    					'income'		=> $this->input->post('income'),
    					'occupation'	=> $this->input->post('occupation'),
    					'wieght'	=>    $this->input->post('weight'),
    					'anesthesia'	=> $this->input->post('anesthesia'),
    					'religion'		=> $this->input->post('religion'),
    					'result'		=> $this->input->post('result')
    				]; 
    			}
    			else
    			{
    				$data['patient'] = (object)$postData = [
    					'id'   		   => $this->input->post('id'),
    					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
    					'old_reg_no' => $this->input->post('update_old_reg_no'),
    					'firstname'    => strtoupper($this->input->post('firstname')),
        				    'blood_group'  => $this->input->post('blood_group'),
    					'sex' 		   => $sex, 
    					'date_of_birth' => $this->input->post('date_of_birth'),
    					'address' 	   => $this->input->post('address'),
    					'affliate'     => null, 
    					'created_by'   => $this->session->userdata('user_id'),
    					'status'       => $this->input->post('status'),
    					'ipd_opd' 	   => $this->input->post('ipd_opd'),
    					'department_id'  => $this->input->post('department_id',true), 
    					'doctor_id'      => $this->input->post('doctor_id',true),
    					'assign_date'   => $this->input->post('assign_date'),
    					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
    					'dignosis'      => strtoupper($this->input->post('dignosis')),
    					'wardType'      => $this->input->post('wardType'),
    					'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
    					'income'		=> $this->input->post('income'),
    					'occupation'	=> $this->input->post('occupation'),
    					'wieght'	=>    $this->input->post('weight'),
    					'anesthesia'	=> $this->input->post('anesthesia'),
    					'religion'		=> $this->input->post('religion'),
    					'result'		=> $this->input->post('result')
    				]; 
    			}
			}
		#-------------------------------#
		
		if ($this->form_validation->run() === true) {
			#if empty $id then insert data
			if ($this->input->post('id') == null) {
			    $ipd_opd_sec=$this->input->post('ipd_opd');
			    if($ipd_opd_sec=='opd'){
			    $last_id=$this->patient_model->create($postData);
			    }else{
			         $last_id=$this->patient_model->create_ipd($postData);
			    }

				if ($last_id) {		
				    $id = $this->input->post('bedNo');
				    $status = 1;
					$this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
                 $name=strtoupper($this->input->post('firstname'));
                 $diagnosis= strtoupper($this->input->post('dignosis'));
                 $year_reg_id=$this->input->post('yearly_reg_no');
                 if($year_reg_id){
                     $year_reg_id=$this->input->post('yearly_reg_no');
                 }else{
                     $year_reg_id=$this->input->post('old_reg_no');
                 }
			redirect('patients/create',$data,true);
			} else {
			    
				if ($this->patient_model->update($postData)) {
				    $id = $this->input->post('bedNo');
				    $oldBedNo = $this->input->post('update_bed_no');
				    $status = 1;
				    if($id == null || $id == ''){
				        $id = $oldBedNo;
				    }
                    $this->bed_model->updateOldBedSelection($oldBedNo);
				    $this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patients/create','refresh');
			}

		} else {
		     $data['serial_no'] ='1'; 
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list(); 
			$data['department_list'] = $this->department_model->department_list();
		    $data['address_list'] = $this->department_model->address_list();
		    
		    $data['beds'] = $this->bed_model->read();
		    
			$data['content'] = $this->load->view('patient_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}
	
	public function create_1()
	{    //echo "dsdsd";exit;
	        echo error_reporting(0); 
			$data['title'] = display('add_patient');
			$id = $this->input->post('id');
			#-------------------------------#
			$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');		
			//$this->form_validation->set_rules('blood_group', display('blood_group'),'m');
			$this->form_validation->set_rules('sex', display('sex'),'required');
			$this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'required|max_length[10]');
			$this->form_validation->set_rules('address', display('address'),'required|max_length[255]');
			$this->form_validation->set_rules('status', display('status'),'required');
			#-------------------------------#
			//picture upload
			$picture = $this->fileupload->do_upload(
				'assets/images/patient/',
				'picture'
			);
	
	
			//Registration numbr create
	
			$acyear = $this->session->userdata('acyear');
	        $status_ipd_opd= $this->input->post('ipd_opd');
	        if($status_ipd_opd=='opd'){
			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
			->from('patient')
			//->where('create_date LIKE', $acyear)
			->order_by("id desc")
			->limit(1)->get()->result_array();
			
	        } 
	        else {
	         $q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
			->from('patient_ipd')
			//->where('create_date LIKE', $acyear)
			->order_by("id desc")
			->limit(1)->get()->result_array();   
	            
	        }
	
			$timezone = "Asia/Kolkata";
			 date_default_timezone_set($timezone);
	
			$patient_id = $q[0]['patient_id'];
			$yearly_reg_no1 = $q[0]['yearly_reg_no'];
			if($yearly_reg_no1){
		    $yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
			}
			else{
			  $yearly_reg_no2 = 1;  
			}
			$yearly_no1 = $q[0]['yearly_no'];
			$monthly_reg_no1 = $q[0]['monthly_reg_no'];
			$daily_reg_no1 = $q[0]['daily_reg_no'];
			$old_reg_no1 = $q[0]['old_reg_no'];
			$create_date1 = $q[0]['create_date'];
	
			$currentYear = date("Y");
			$currentmonth = date("m");
			$currentday = date("d/m/Y");
	
			$oldyear = date("Y", strtotime($q[0]['create_date']));
			$oldmonth = date("d", strtotime($q[0]['create_date']));
			$oldday = date("d/m/Y", strtotime($q[0]['create_date']));

			//Yearly Number
			if($currentYear > $oldyear){
			//	$yearly_no = 1;
				$yearly_no = 1;
				$yearly_reg_no1=1;
				$patient_id = 1;
				$monthly_reg_no = 1;
	     
			}else{
			//	$yearly_no = $yearly_no1 + 1;
				$yearly_no = $yearly_no1 + 1;
				$yearly_reg_no1=$yearly_reg_no1 + 1;
				$patient_id =$patient_id + 1;
				//Monthly Number
				if($currentmonth > $oldmonth){			
					$monthly_reg_no = 1;
					
				}else{			
					$monthly_reg_no = $monthly_reg_no1 + 1;
					
				}
			}

			//Daily Number		
			if($currentday == $oldday){
				$daily_reg_no = $daily_reg_no1 + 1;			
			}else{
				$daily_reg_no = 1;		
				
			}

			// if picture is uploaded then resize the picture
			if ($picture !== false && $picture != null) {
				$this->fileupload->do_resize(
					$picture, 
					200,
					150
				);
			}
	
			//if picture is not uploaded
			if ($picture === false) {
				$this->session->set_flashdata('exception', display('invalid_picture'));
			}
			
			$sex =$this->input->post('sex');
			if($sex == 'पुरुष'){
			   $sex1 ='M';
			 	
			}  
			elseif($sex == 'स्त्री'){
			     $sex1 ='F';
			  
			}
			elseif($sex == 'Boy'){
			     $sex1 ='M';
			      
			}
				 elseif($sex == 'Girl'){
			     $sex1 ='F';
			     
			} else {
			    $sex1 ='other';
			}
			 
			#-------------------------------#
			if ($this->input->post('id') == null) { //create a patient
				if($this->input->post('old_reg_no') == null){
					$data['patient'] = (object)$postData = [
						'id'   		   => $this->input->post('id'),
						/*'patient_id'   => $this->randStrGen(2,7),*/
						'patient_id'   => $patient_id,
						'yearly_reg_no' => $yearly_reg_no2,
						'yearly_no' => $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'ipd_no' => $this->input->post('ipd_no'),
					//	'old_reg_no' => $this->input->post('old_reg_no'),
						'firstname'    => strtoupper($this->input->post('firstname')),
						'lastname' 	   => $this->input->post('lastname'),
						'email' 	   => $this->input->post('email'),
						'password' 	   => md5($this->input->post('password')),
						'phone'   	   => $this->input->post('phone'),
						'mobile'       => $this->input->post('mobile'),
						'blood_group'  => $this->input->post('blood_group'),
						'sex' 		   => $sex1, 
						'date_of_birth' => $this->input->post('date_of_birth'),
						'address' 	   => $this->input->post('address'),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'affliate'     => null,
						'create_date'  => date('Y-m-d', strtotime(($this->input->post('create_date') != null)? $this->input->post('create_date'): date('Y-m-d'))),
						'created_by'   => $this->session->userdata('user_id'),
						'status'       => $this->input->post('status'),
						'ipd_opd' 	   => $this->input->post('ipd_opd'),
						'department_id'  => $this->input->post('department_id',true), 
						'doctor_id'      => $this->input->post('doctor_id',true),
						'assign_date'   => $this->input->post('assign_date'),
						'discharge_date' => $this->input->post('discharge_date'),
						'dignosis'      => strtoupper($this->input->post('dignosis')),
						'wardType'      => $this->input->post('wardType'),
						'bedNo'			=> $this->input->post('bedNo'),
						'income'		=> $this->input->post('income'),
						'occupation'	=> $this->input->post('occupation'),
						'wieght'	=>    $this->input->post('wieght'),
						'anesthesia'	=> $this->input->post('anesthesia'),
						'religion'		=> $this->input->post('religion'),
						'result'		=> $this->input->post('result')
	
					]; 
				}
				else
				{
					$data['patient'] = (object)$postData = [
						'id'   		   => $this->input->post('id'),
						 /*'patient_id'   => $this->randStrGen(2,7),*/
						'patient_id'   => $patient_id,
						//'yearly_reg_no' =>  $this->input->post('yearly_reg_no'),
						'yearly_no' =>  $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'old_reg_no' => $this->input->post('old_reg_no'),
						'ipd_no' => $this->input->post('ipd_no'),
						'firstname'    => $this->input->post('firstname'),
						'lastname' 	   => $this->input->post('lastname'),
						'email' 	   => $this->input->post('email'),
						'password' 	   => md5($this->input->post('password')),
						'phone'   	   => $this->input->post('phone'),
						'mobile'       => $this->input->post('mobile'),
						'blood_group'  => $this->input->post('blood_group'),
						'sex' 		   => $sex1, 
						//'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth') != null)? $this->input->post('date_of_birth'): date('Y-m-d'))),
						'date_of_birth' => $this->input->post('date_of_birth'),
						'address' 	   => $this->input->post('address'),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'affliate'     => null,
						'create_date'  => date('Y-m-d', strtotime(($this->input->post('create_date') != null)? $this->input->post('create_date'): date('Y-m-d'))),
						'created_by'   => $this->session->userdata('user_id'),
						'status'       => $this->input->post('status'),
						'ipd_opd' 	   => $this->input->post('ipd_opd'),
						'department_id'  => $this->input->post('department_id',true), 
						'doctor_id'      => $this->input->post('doctor_id',true),
						'assign_date'   => $this->input->post('assign_date'),
						'discharge_date' => $this->input->post('discharge_date'),
						'dignosis'      => $this->input->post('dignosis'),
						'wardType'      => $this->input->post('wardType'),
						'bedNo'			=> $this->input->post('bedNo'),
						'income'		=> $this->input->post('income'),
						'occupation'	=> $this->input->post('occupation'),
					    'wieght'	=>    $this->input->post('wieght'),
						'anesthesia'	=> $this->input->post('anesthesia'),
						'religion'		=> $this->input->post('religion'),
						'result'		=> $this->input->post('result')
					]; 
				}
			} else { // update patient
			
				$data['patient'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
						//'yearly_no' => $this->input->post('yearly_no'),
						//'monthly_reg_no' => $this->input->post('monthly_reg_no'),
					//	'daily_reg_no' => $this->input->post('daily_reg_no'),
						'old_reg_no' => $this->input->post('old_reg_no'),
					//	'ipd_no' => $this->input->post('ipd_no'),
					'firstname'    => strtoupper($this->input->post('firstname')),
				//	'lastname' 	   => $this->input->post('lastname'),
				//	'email' 	   => $this->input->post('email'),
				//	'password' 	   => md5($this->input->post('password')),
				//	'phone'   	   => $this->input->post('phone'),
				//	'mobile'       => $this->input->post('mobile'),
					'blood_group'  => $this->input->post('blood_group'),
					'sex' 		   => $sex1,
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' 	   => $this->input->post('address'),
				//	'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
					'affliate'     => null, 
					'created_by'   => $this->session->userdata('user_id'),
					'status'       => $this->input->post('status'),
					'ipd_opd' 	   => $this->input->post('ipd_opd'),
					'department_id'  => $this->input->post('department_id',true), 
					'doctor_id'      => $this->input->post('doctor_id',true),
					'assign_date'   => $this->input->post('assign_date'),
					'discharge_date' => $this->input->post('discharge_date'),
					'dignosis'      => strtoupper($this->input->post('dignosis')),
					'wardType'      => $this->input->post('wardType'),
					'bedNo'			=> $this->input->post('bedNo'),
					'income'		=> $this->input->post('income'),
					'occupation'	=> $this->input->post('occupation'),
					'wieght'	=>    $this->input->post('wieght'),
					'anesthesia'	=> $this->input->post('anesthesia'),
					'religion'		=> $this->input->post('religion'),
					'result'		=> $this->input->post('result')
				]; 
			}
	    //print_r($postData); exit;
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if ($this->input->post('id') == null) {
			    $ipd_opd_sec=$this->input->post('ipd_opd');
			    if($ipd_opd_sec=='opd'){
			    $last_id=$this->patient_model->create($postData);
			    }else{
			         $last_id=$this->patient_model->create_ipd($postData);
			    }
				if ($last_id) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
                 $name=strtoupper($this->input->post('firstname'));
                 $diagnosis= strtoupper($this->input->post('dignosis'));
                 $year_reg_id=$this->input->post('yearly_reg_no');
                 if($year_reg_id){
                     $year_reg_id=$this->input->post('yearly_reg_no');
                 }else{
                     $year_reg_id=$this->input->post('old_reg_no');
                 }
                 
                 redirect('patients/patient_check/'.$last_id.'/'.$status_ipd_opd);
                //redirect('patients/treatment/'.$last_id.'/'.$status_ipd_opd.'/'.$diagnosis);
			//	redirect('patients/create',$data,true);
			} else {
			    
				if ($this->patient_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patients/edit/'.$postData['id']);
			}

		} else {
		     $data['serial_no'] ='1'; 
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list(); 
			$data['department_list'] = $this->department_model->department_list();
		    $data['address_list'] = $this->department_model->address_list();
			$data['content'] = $this->load->view('patient_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}
	
	public function create_2orignal()
	{    //echo "dsdsd";
	//exit;
            //echo error_reporting(0); 
			$data['title'] = display('add_patient');
			$id = $this->input->post('id');
			
			$status_ipd_opd= $this->input->post('ipd_opd');
			
			#-------------------------------#
			$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');		
			//$this->form_validation->set_rules('blood_group', display('blood_group'),'m');
			$this->form_validation->set_rules('sex', display('sex'),'required');
			$this->form_validation->set_rules('date_of_birth', display('date_of_birth'),'required|max_length[10]');
			$this->form_validation->set_rules('create_date', display('create_date'),'required|max_length[20]');
			//$this->form_validation->set_rules('assign_date', display('assign_date'),'required|max_length[10]');
			$this->form_validation->set_rules('department_id', display('department_name'),'required|max_length[255]');
			$this->form_validation->set_rules('address', display('address'),'required|max_length[255]');
			$this->form_validation->set_rules('status', display('status'),'required');
			if($id != null ){
			    $this->form_validation->set_rules('doctor_id', display('doctor_name'),'required|max_length[255]');
			}
			elseif($status_ipd_opd == 'ipd'){
    			$this->form_validation->set_rules('bedNo', display('bedNo'),'required');
    			$this->form_validation->set_rules('doctor_id', display('doctor_name'),'required|max_length[255]');
			}
			
			#-------------------------------#
			//picture upload
			$picture = $this->fileupload->do_upload(
				'assets/images/patient/',
				'picture'
			);
	
	
			//Registration numbr create
	
			$acyear = $this->session->userdata('acyear');
	        
	        if($status_ipd_opd=='opd'){
    			$q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
    			->from('patient')
    			//->where('yearly_reg_no != ', '')
    			//->where('create_date LIKE', $acyear)
    			->order_by("id desc")
    			->limit(1)->get()->result_array();
			} 
	        else {
    	         $q = $this->db->select('patient_id,yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
        			->from('patient_ipd')
        			//->where('create_date LIKE', $acyear)
        			->order_by("id desc")
        			->limit(1)->get()->result_array();  
	        }
	        
	        //print_r($status_ipd_opd);
	        //print_r($q);
	        //print_r($this->db->last_query());
	        //die();
	        
			$timezone = "Asia/Kolkata";
			 date_default_timezone_set($timezone);
	
			/*$patient_id = $q[0]['patient_id'];
			$yearly_reg_no1 = $q[0]['yearly_reg_no'];
			if($yearly_reg_no1){
		    $yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
			}
			else{
			  $yearly_reg_no2 = 1;  
			}
			$yearly_no1 = $q[0]['yearly_no'];
			
			$monthly_reg_no1 = $q[0]['monthly_reg_no'];
			$daily_reg_no1 = $q[0]['daily_reg_no'];
			$old_reg_no1 = $q[0]['old_reg_no'];
			$create_date1 = $q[0]['create_date'];
	
			$currentYear = date("Y");
			$currentmonth = date("m");
			$currentday = date("d/m/Y");
	
			$oldyear = date("Y", strtotime($q[0]['create_date']));
			$oldmonth = date("d", strtotime($q[0]['create_date']));
			$oldday = date("d/m/Y", strtotime($q[0]['create_date']));*/
			
			$patient_id = 0; 
			$yearly_reg_no1 = 0; 
			$yearly_no1 = 0; 
			$monthly_reg_no1 = 0; 
    		$daily_reg_no1 = 0;
    		$old_reg_no1 = 0;
    		$create_date1 = 0;
    
    		$currentYear = 0;
    		$currentmonth = 0;
    		$currentday = 0;
    
    		$oldyear = 0;
    		$oldmonth = 0;
    		$oldday = 0;
			if($q != null){
			    $patient_id = $q[0]['patient_id'];
			    $yearly_reg_no1 = $q[0]['yearly_reg_no'];
                $yearly_no1 = $q[0]['yearly_no'];
			
        		$monthly_reg_no1 = $q[0]['monthly_reg_no'];
        		$daily_reg_no1 = $q[0]['daily_reg_no'];
        		$old_reg_no1 = $q[0]['old_reg_no'];
        		$create_date1 = $q[0]['create_date'];
        
        		$currentYear = date("Y");
        		$currentmonth = date("m");
        		$currentday = date("d/m/Y");
        
        		$oldyear = date("Y", strtotime($q[0]['create_date']));
        		$oldmonth = date("d", strtotime($q[0]['create_date']));
        		$oldday = date("d/m/Y", strtotime($q[0]['create_date']));
			}
			
			if($yearly_reg_no1 != 0){
		    $yearly_reg_no2 = $q[0]['yearly_reg_no'] + 1;
			}
			else{
			  $yearly_reg_no2 = 1;  
			}
			//print_r($yearly_reg_no2);
			//die();
			
			//print_r($currentYear);
			//print_r('===>');
			//print_r($oldyear);

			//Yearly Number
			$monthly_reg_no = 0; 
			if($currentYear > $oldyear){
			//	$yearly_no = 1;
				$yearly_no = 1;
				$yearly_reg_no1=1;
				$patient_id = 1;
				$monthly_reg_no = 1;
	     
			}else{
			//	$yearly_no = $yearly_no1 + 1;
				$yearly_no = $yearly_no1 + 1;
				$yearly_reg_no1=$yearly_reg_no1 + 1;
				$patient_id =$patient_id + 1;
				//Monthly Number
				if($currentmonth > $oldmonth){			
					$monthly_reg_no = 1;
					
				}else{			
					$monthly_reg_no = (int)$monthly_reg_no1 + 1;
				}
			}
			//print_r('===>');
			//print_r($yearly_no);

			//Daily Number
			$daily_reg_no = '';
			if($currentday == $oldday){
				$daily_reg_no = (int)$daily_reg_no1 + 1;			
			}else{
				$daily_reg_no = 1;		
			}
			//print_r($daily_reg_no);

			// if picture is uploaded then resize the picture
			if ($picture !== false && $picture != null) {
				$this->fileupload->do_resize(
					$picture, 
					200,
					150
				);
			}
	
			//if picture is not uploaded
			if ($picture === false) {
				$this->session->set_flashdata('exception', display('invalid_picture'));
			}
			
			$sex =$this->input->post('sex');
			if($sex == 'Male'){
			   //$sex1 ='Male';
			   $sex ='M';
			 	
			}  
			elseif($sex == 'Female'){
			     //$sex1 ='Female';
			     $sex ='F';
			}
			
// 			print_r($this->input->post('id'));
// 			die();
//             print_r('====>');
// 			print_r($this->input->post('yearly_reg_no'));
//  			die();
			 
			#-------------------------------#
			if ($this->input->post('id') == null) { //create a patient
// 			print_r('********');
// 			print_r($this->input->post('old_reg_no'));
//print_r($yearly_reg_no2);
//print_r($this->input->post('bedNo'));
			//die();
			//print_r($yearly_no);
				if($this->input->post('old_reg_no') == null || $this->input->post('old_reg_no') == ''){
				    
					$data['patient'] = (object)$postData = [
						'id'   		   => $this->input->post('id'),
						/*'patient_id'   => $this->randStrGen(2,7),*/
						'patient_id'   => $patient_id,
						//'yearly_reg_no' => $yearly_reg_no2,
						'yearly_reg_no' => $this->input->post('yearly_reg_no'),
						'yearly_no' => $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'ipd_no' => $this->input->post('ipd_no'),
					    //'old_reg_no' => $this->input->post('old_reg_no'),
						'firstname'    => strtoupper($this->input->post('firstname')),
						'lastname' 	   => $this->input->post('lastname'),
						'email' 	   => $this->input->post('email'),
						'password' 	   => md5($this->input->post('password')),
						'phone'   	   => $this->input->post('phone'),
						'mobile'       => $this->input->post('mobile'),
						'blood_group'  => $this->input->post('blood_group'),
						//'sex' 		   => $sex1,
						'sex' 		   => $sex, 
						'date_of_birth' => $this->input->post('date_of_birth'),
						'address' 	   => $this->input->post('address'),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'affliate'     => null,
						'create_date'  => date('Y-m-d', strtotime(($this->input->post('create_date') != null)? $this->input->post('create_date'): date('Y-m-d'))),
						'created_by'   => $this->session->userdata('user_id'),
						'status'       => $this->input->post('status'),
						'ipd_opd' 	   => $this->input->post('ipd_opd'),
						'department_id'  => $this->input->post('department_id',true), 
						'doctor_id'      => $this->input->post('doctor_id',true),
						'assign_date'   => $this->input->post('assign_date'),
						'discharge_date' => ($this->input->post('discharge_date') != '')? $this->input->post('discharge_date') : '0000-00-00',
						'dignosis'      => strtoupper($this->input->post('dignosis')),
						'wardType'      => $this->input->post('wardType'),
						'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
						'income'		=> $this->input->post('income'),
						'occupation'	=> $this->input->post('occupation'),
						'wieght'	=>    $this->input->post('weight'),
						'anesthesia'	=> $this->input->post('anesthesia'),
						'religion'		=> $this->input->post('religion'),
						'result'		=> $this->input->post('result')
	
					]; 
				}
				else
				{
				    // print_r($this->input->post('status1'));
				    // print_r($this->input->post('ipd_opd'));
				    // die();
				    if($this->input->post('status1')=='old' && $this->input->post('ipd_opd')=='opd'){
				        $y_new_reg = null;
				        $y_old_reg = $this->input->post('old_reg_no');
				    }
				    elseif($this->input->post('ipd_opd')=='ipd'){
				        $y_new_reg = $this->input->post('old_reg_no');
				    }
				    else{
				        $y_new_reg = $yearly_reg_no1;
				        $y_old_reg = $this->input->post('old_reg_no');
				    }
				    //print_r("12     ");
				    //print_r($yearly_no);
				    // print_r($yearly_reg_no2);
					$data['patient'] = (object)$postData = [
						'id'   		   => $this->input->post('id'),
						 /*'patient_id'   => $this->randStrGen(2,7),*/
						'patient_id'   => $patient_id,
						//'yearly_reg_no' =>  $this->input->post('yearly_reg_no'),//working
						'yearly_reg_no' =>  $y_new_reg,
						//'yearly_reg_no' =>  $yearly_reg_no1,
						'yearly_no' =>  $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						//'old_reg_no' => $this->input->post('old_reg_no'),//working
						'old_reg_no' => ($this->input->post('ipd_opd')!='ipd')? $y_old_reg : null,
						'ipd_no' => $this->input->post('ipd_no'),
						'firstname'    => $this->input->post('firstname'),
						'lastname' 	   => $this->input->post('lastname'),
						'email' 	   => $this->input->post('email'),
						'password' 	   => md5($this->input->post('password')),
						'phone'   	   => $this->input->post('phone'),
						'mobile'       => $this->input->post('mobile'),
						'blood_group'  => $this->input->post('blood_group'),
						//'sex' 		   => $sex1, 
						'sex' 		   => $sex, 
						//'date_of_birth' => date('Y-m-d', strtotime(($this->input->post('date_of_birth') != null)? $this->input->post('date_of_birth'): date('Y-m-d'))),
						'date_of_birth' => $this->input->post('date_of_birth'),
						'address' 	   => $this->input->post('address'),
						'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
						'affliate'     => null,
						'create_date'  => date('Y-m-d', strtotime(($this->input->post('create_date') != null)? $this->input->post('create_date'): date('Y-m-d'))),
						'created_by'   => $this->session->userdata('user_id'),
						'status'       => $this->input->post('status'),
						'ipd_opd' 	   => $this->input->post('ipd_opd'),
						'department_id'  => $this->input->post('department_id',true), 
						'doctor_id'      => $this->input->post('doctor_id',true),
						'assign_date'   => $this->input->post('assign_date'),
						'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
						'dignosis'      => $this->input->post('dignosis'),
						'wardType'      => $this->input->post('wardType'),
						'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
						'income'		=> $this->input->post('income'),
						'occupation'	=> $this->input->post('occupation'),
					    'wieght'	=>    $this->input->post('weight'),
						'anesthesia'	=> $this->input->post('anesthesia'),
						'religion'		=> $this->input->post('religion'),
						'result'		=> $this->input->post('result')
					]; 
				}
			} else { // update patient
			//print_r($status_ipd_opd);
			//die();
				$data['patient'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
						//'yearly_no' => $this->input->post('yearly_no'),
						//'monthly_reg_no' => $this->input->post('monthly_reg_no'),
					//	'daily_reg_no' => $this->input->post('daily_reg_no'),
						'old_reg_no' => $this->input->post('update_old_reg_no'),
					//	'ipd_no' => $this->input->post('ipd_no'),
					'firstname'    => strtoupper($this->input->post('firstname')),
				//	'lastname' 	   => $this->input->post('lastname'),
				//	'email' 	   => $this->input->post('email'),
				//	'password' 	   => md5($this->input->post('password')),
				//	'phone'   	   => $this->input->post('phone'),
				//	'mobile'       => $this->input->post('mobile'),
					'blood_group'  => $this->input->post('blood_group'),
					//'sex' 		   => $sex1,
					'sex' 		   => $sex, 
					'date_of_birth' => $this->input->post('date_of_birth'),
					'address' 	   => $this->input->post('address'),
				//	'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
					'affliate'     => null, 
					'created_by'   => $this->session->userdata('user_id'),
					'status'       => $this->input->post('status'),
					'ipd_opd' 	   => $this->input->post('ipd_opd'),
					'department_id'  => $this->input->post('department_id',true), 
					'doctor_id'      => $this->input->post('doctor_id',true),
					'assign_date'   => $this->input->post('assign_date'),
					'discharge_date' => ($this->input->post('discharge_date') != '') ? $this->input->post('discharge_date') : '0000-00-00',
					'dignosis'      => strtoupper($this->input->post('dignosis')),
					'wardType'      => $this->input->post('wardType'),
					'bedNo'			=> ($this->input->post('bedNo') != '') ? $this->input->post('bedNo') : $this->input->post('update_bed_no'),
					'income'		=> $this->input->post('income'),
					'occupation'	=> $this->input->post('occupation'),
					'wieght'	=>    $this->input->post('weight'),
					'anesthesia'	=> $this->input->post('anesthesia'),
					'religion'		=> $this->input->post('religion'),
					'result'		=> $this->input->post('result')
				]; 
			}
	   // print_r($postData); 
	   // exit;
		#-------------------------------#
		
		if ($this->form_validation->run() === true) {
//print_r("iddddd  ");
//print_r($this->input->post('id'));
			#if empty $id then insert data
			if ($this->input->post('id') == null) {
			    $ipd_opd_sec=$this->input->post('ipd_opd');
			    if($ipd_opd_sec=='opd'){
			    $last_id=$this->patient_model->create($postData);
			    }else{
			         $last_id=$this->patient_model->create_ipd($postData);
			    }
			    //print_r("laaast  ");
//print_r($last_id);

				if ($last_id) {		
				    $id = $this->input->post('bedNo');
				    $status = 1;
					$this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
                 $name=strtoupper($this->input->post('firstname'));
                 $diagnosis= strtoupper($this->input->post('dignosis'));
                 $year_reg_id=$this->input->post('yearly_reg_no');
                 if($year_reg_id){
                     $year_reg_id=$this->input->post('yearly_reg_no');
                 }else{
                     $year_reg_id=$this->input->post('old_reg_no');
                 }
                 
                 //redirect('patients/create','refresh');
                 
                 //redirect('patients/patient_check/'.$last_id.'/'.$status_ipd_opd);
                //redirect('patients/treatment/'.$last_id.'/'.$status_ipd_opd.'/'.$diagnosis);
			redirect('patients/create',$data,true);
			} else {
			    
				if ($this->patient_model->update($postData)) {
				    $id = $this->input->post('bedNo');
				    $oldBedNo = $this->input->post('update_bed_no');
				    $status = 1;
				    if($id == null || $id == ''){
				        $id = $oldBedNo;
				    }
                    $this->bed_model->updateOldBedSelection($oldBedNo);
				    $this->bed_model->updateBedSelection($id, $status);
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				//redirect('patients/edit/'.$postData['id']);
				redirect('patients/create','refresh');
			}

		} else {
		     $data['serial_no'] ='1'; 
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list(); 
			$data['department_list'] = $this->department_model->department_list();
		    $data['address_list'] = $this->department_model->address_list();
		    
		    $data['beds'] = $this->bed_model->read();
		    
			$data['content'] = $this->load->view('patient_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}
	
	public function  treatment_save()
	{
	            $section= $this->input->post('ipd_opd');
	      		$data['patient'] = (object)$postData = [
	      		         'dignosis' => $this->input->post('dignosis'),
	      		         'patient_id_auto' => $this->input->post('patient_id'),
	      		         'panch_adv_flag' => $this->input->post('panch_adv_flag'),
						 'department_id' => $this->input->post('department_id'),
						 'ipd_opd' => $this->input->post('ipd_opd'),
						 'RX1' => $this->input->post('RX1'),
						 'RX2' => $this->input->post('RX2'),
						 'RX3' => $this->input->post('RX3'),
					     'SNEHAN'    => $this->input->post('SNEHAN'),
					     'SWEDAN' 	   => $this->input->post('SWEDAN'),
					     'VAMAN' 	   => $this->input->post('VAMAN'),
					     'VIRECHAN'    => $this->input->post('VIRECHAN'),
					     'BASTI'    => $this->input->post('BASTI'),
					     
					     'NASYA' 	   => $this->input->post('NASYA'),
					     'RAKTAMOKSHAN' 	   => $this->input->post('RAKTAMOKSHAN'),
					     'SHIRODHARA_SHIROBASTI'    => $this->input->post('SHIRODHARA_SHIROBASTI'),
					     'OTHER'    => $this->input->post('OTHER'),
					      
					     'SWA1' 	   => $this->input->post('SWA1'),
					     'SWA2'   	   => $this->input->post('SWA2'),
					     
					     'HEMATOLOGICAL'       => $this->input->post('HEMATOLOGICAL'),
					     'SEROLOGYCAL' 	   => $this->input->post('SEROLOGYCAL'),
					     'BIOCHEMICAL' 	   => $this->input->post('BIOCHEMICAL'),
					     'MICROBIOLOGICAL' 	   =>$this->input->post('MICROBIOLOGICAL'),
					     
					     'X_RAY'   	   => $this->input->post('X_RAY'),
					     'ECG'       => $this->input->post('ECG'),
					];
					
					$id=$this->input->post('patient_id');
						$data['patient'] = (object)$postData1 = [
	      		         'id' => $this->input->post('patient_id'),
	      		         'manual_status' => '1'
	      		         ];
				 $this->patient_model->update_manual_treatment($postData1,$section);
			   if ($this->patient_model->create_manual_treatment($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
                if($section=='ipd'){
 				redirect('patients/ipdprofile/'.$id);
                } else{
                    redirect('patients/profile/'.$id);
                }      
	  }
	  
	public function case_paper_print($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);
         $date_c=date('Y-m-d',strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
      $data['check_data'] = $this->patient_model->read_by_check_data($section,$date_c);

	//	echo count($data['patients'] );exit;
		$section = $section;
        
        
		$year = '%'.$this->session->userdata['acyear'].'%';

       if($section == 'ipd'){
	
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
	    $data['gobs'] = 'gobs';

		$data['content'] = $this->load->view('case_paper_print',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
	}
	else{
	    
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='opd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		

		$data['content'] = $this->load->view('case_paper_print',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}
	}
	  
	public function case_paper_print_date()
	{ 
	    
	    

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
		

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
      // $start_date=$start_date1." 00:00:00";
      // $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date2);
       $date2=date_create($end_date2);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		//echo $section;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		
	    ->where('yearly_reg_no !=','')

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
        // echo count($data['patients']); exit;

	/*	$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', ' patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
	    ->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();*/
			$data['department_by_section'] ='opd';  
         }
         else
         {
             	/*$data['patients'] = $this->db->select("*")

		->from('patient_ipd')
		
    	->join('department','department.dprt_id = patient_ipd.department_id')

	    ->where('ipd_opd', $section)
	
	//	->where('create_date >=', $start_date)
         ->where('discharge_date LIKE', '%0000-00-00%')
         //->where("(discharge_date LIKE '%0000-00-00%' OR discharge_date LIKE '$end_date1')",NULL, FALSE)
         ->or_where('discharge_date LIKE', $end_date1)
         ->where('create_date <=', $end_date1)

		//->where('create_date LIKE', $year)

		->get()

		->result();*/

      /*$data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', $section)
		->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date_f)

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', $section)

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
      */
      
      	$data['patients'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id =  patient_ipd.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
      
      
	/*	$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
	    // ->where('create_date >=', $start_date)
	    //->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('create_date >=', $start_date)
		//->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();*/
            
            	$data['department_by_section'] ='ipd';         
         }
		
		
	
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
		     if($section=='opd'){
		         	$data['content'] = $this->load->view('case_paper_print_opd',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		     }
		     else{
		         	$data['content'] = $this->load->view('case_paper_print_ipd',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		     }
		
		}else{
			
		if($section=='opd'){
		    
		    
	
		         	$data['content'] = $this->load->view('case_paper_print_opd',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
	
		     }
		     else{
		         	$data['content'] = $this->load->view('case_paper_print_ipd',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		     }
		}
		
		
	}	
	
	public function  checked_data()
	{
	            $section= $this->input->get('section');
	            $check=  $this->input->get('check');
	            $date= $this->input->get('start_date1');
	            $c_date=date('Y-m-d',strtotime($date));
	            $c_date1= '%'.$c_date.'%';
	         
	         $section1='%'.$section.'%';
	         
	         if($section=='opd'){
	           $dd = $this->db->select('*')
			   ->from('check_data')
			   ->where('c_date LIKE', $c_date1)
			  ->where('section LIKE', $section1)
			  ->get()->result_array();
			  
			  	$data['patient'] = (object)$postData = [
	      		         'section' => $this->input->post('dignosis'),
	      		         'c_date' => $c_date
						 
					];
					
			   if($dd[0]['c_date']){
			        	$data['patient'] = (object)$postData = [
	      		         'section' => $section,
	      		         'check_date' => $check,
	      		         'c_date' => $c_date,
	      		         'id' => $dd[0]['id']
						 
					];
			        if ($this->patient_model->check_data_update($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			   }else{
			     	$data['patient'] = (object)$postData = [
	      		         'section' => $section,
	      		         'check_date' => $check,
	      		         'c_date' => $c_date
						 
					];
					
				
					 if ($this->patient_model->check_data_create($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			   }
			  
	      	
                if($section=='ipd'){
 				redirect('patientList/'.$section);
                } else{
                    redirect('patientList/'.$section);
                }    
	         }
	         else{
	             $dd = $this->db->select('*')
			   ->from('check_data')
			   ->where('c_date LIKE', $c_date1)
			   ->where('section LIKE', $section1)
			  ->get()->result_array();
			  
			  	$data['patient'] = (object)$postData = [
	      		         'section' => $this->input->post('dignosis'),
	      		         'c_date' => $c_date
						 
					];
					
			   if($dd[0]['c_date']){
			        	$data['patient'] = (object)$postData = [
	      		         'section' => $section,
	      		         'check_date' => $check,
	      		         'c_date' => $c_date,
	      		         'id' => $dd[0]['id']
						 
					];
			        if ($this->patient_model->check_data_update($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			   }else{
			     	$data['patient'] = (object)$postData = [
	      		         'section' => $section,
	      		         'check_date' => $check,
	      		         'c_date' => $c_date
						 
					];
					
				
					 if ($this->patient_model->check_data_create($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
			   }
			  
	      	
                if($section=='ipd'){
 				redirect('patientList/'.$section);
                } else{
                    redirect('patientList/'.$section);
                }     
	         }
	  }
	  
	public function  treatment_check_up()
	{
	            $id=$this->input->post('id');
	            $section= $this->input->post('section');
	            $dignosis= $this->input->post('dignosis');
	             $round= $this->input->post('round');
	         $check_round=  $this->patient_model->check_round($section,$id,$round); 
	      	
	      	  if($section == 'opd'){
	      		$data['patient'] = (object)$postData = [
	      		         'id' => $id,
	      		         //'dignosis' => $this->input->post('dignosis'),
	      		         'nadi' => $this->input->post('nadi'),
						 'pulse' => $this->input->post('pulse'),
						// 'ipd_opd' => $this->input->post('ipd_opd'),
						 'shudha' => $this->input->post('shudha'),
						 'mal' => $this->input->post('mal'),
						 'nidra' => $this->input->post('nidra'),
						  'c_o' => $this->input->post('c_o'),
					     'f_h'    => strtoupper($this->input->post('f_h')),
					     'h_o' 	   => strtoupper($this->input->post('h_o')),
					     'bp' 	   => $this->input->post('bp'),
					     'ur'    => $this->input->post('ur'),
					     'udar'    => $this->input->post('udar'),
					     'cvs'    => $this->input->post('cvs'),
					     'givwa'    => $this->input->post('givwa'),
					     
					     'ahar' 	   => $this->input->post('ahar'),
					     'mutra' 	   => $this->input->post('mutra')
					     
					];
	      	  }
	      	  else {
	      	      	if($check_round==0)	{
	      	      	$data['patient'] = (object)$postData = [
	      		        // 'id' => $id,
	      		         //'dignosis' => $this->input->post('dignosis'),
	      		         
	      		         'patient_id_auto' => $this->input->post('id'),
	      		         'nadi' => $this->input->post('nadi'),
						 'pulse' => $this->input->post('pulse'),
						 'ipd_opd' => $this->input->post('ipd_opd'),
						 'shudha' => $this->input->post('shudha'),
						 'mal' => $this->input->post('mal'),
						 'netra' => $this->input->post('netra'),
						  'sym_name' => $this->input->post('c_o'),
					     'f_o'    => strtoupper($this->input->post('f_h')),
					     'h_o' 	   => strtoupper($this->input->post('h_o')),
					     'bp' 	   => $this->input->post('bp'),
					     'RS'    => $this->input->post('RS'),
					     'ra'    => $this->input->post('udar'),
					     'cvs'    => $this->input->post('cvs'),
					     'givwa'    => $this->input->post('givwa'),
					     
					     'ahar' 	   => $this->input->post('ahar'),
					     'mutra' 	   => $this->input->post('mutra'),
					     
					     'RX1' => $this->input->post('RX1'),
					     'RX2' => $this->input->post('RX2'),
					     'RX3' => $this->input->post('RX3'),
					     'RX4' => $this->input->post('RX4'),
					     'RX5' => $this->input->post('RX5'),
					     'tapman' => $this->input->post('tapman'),
					     'rounds' => $this->input->post('round')
					];
	      	  } else{
	      	      
	      	      $data['patient'] = (object)$postData = [
	      		         'id' => $id,
	      		         //'dignosis' => $this->input->post('dignosis'),
	      		         
	      		         'patient_id_auto' => $this->input->post('id'),
	      		         'nadi' => $this->input->post('nadi'),
						 'pulse' => $this->input->post('pulse'),
						 'ipd_opd' => $this->input->post('ipd_opd'),
						 'shudha' => $this->input->post('shudha'),
						 'mal' => $this->input->post('mal'),
						 'netra' => $this->input->post('netra'),
						  'sym_name' => $this->input->post('c_o'),
					     'f_o'    => strtoupper($this->input->post('f_h')),
					     'h_o' 	   => strtoupper($this->input->post('h_o')),
					     'bp' 	   => $this->input->post('bp'),
					     'RS'    => $this->input->post('RS'),
					     'ra'    => $this->input->post('udar'),
					     'cvs'    => $this->input->post('cvs'),
					     'givwa'    => $this->input->post('givwa'),
					     
					     'ahar' 	   => $this->input->post('ahar'),
					     'mutra' 	   => $this->input->post('mutra'),
					     
					     'RX1' => $this->input->post('RX1'),
					     'RX2' => $this->input->post('RX2'),
					     'RX3' => $this->input->post('RX3'),
					     'RX4' => $this->input->post('RX4'),
					     'RX5' => $this->input->post('RX5'),
					     'tapman' => $this->input->post('tapman'),
					     'rounds' => $this->input->post('round')
					];
	      	  }
	      	  }
				
				if($check_round==0)	{
				    
				     if ($this->patient_model->insert_manual_check_up($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
               
                // redirect('patients/treatment/'.$id.'/'.$section.'/'.$dignosis);
                 if($section == 'opd'){
                     	redirect('patients/profile/'.$id);
                 }
                 else{
                    redirect('patients/ipdprofile/'.$id);
                 }
				    
				}
				else{
				
			   if ($this->patient_model->update_manual_check_up_forround($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
               
                // redirect('patients/treatment/'.$id.'/'.$section.'/'.$dignosis);
                 if($section == 'opd'){
                     	redirect('patients/profile/'.$id);
                 }
                 else{
                    redirect('patients/ipdprofile/'.$id);
                 }
 		     
				}
	  }
	  
	public function  treatment_check_up_lib()
	{
	            $id=$this->input->post('id');
	            $section= $this->input->post('section');
	            $dignosis= $this->input->post('dignosis');
	             
	        
	      	
	      	  if($section == 'opd'){
	      		$data['patient'] = (object)$postData = [
	      		         'id' => $id,
	      		         //'dignosis' => $this->input->post('dignosis'),
	      		         'nadi' => $this->input->post('nadi'),
						 'pulse' => $this->input->post('pulse'),
						// 'ipd_opd' => $this->input->post('ipd_opd'),
						 'shudha' => $this->input->post('shudha'),
						 'mal' => $this->input->post('mal'),
						 'nidra' => $this->input->post('nidra'),
						  'c_o' => $this->input->post('c_o'),
					     'f_h'    => strtoupper($this->input->post('f_h')),
					     'h_o' 	   => strtoupper($this->input->post('h_o')),
					     'bp' 	   => $this->input->post('bp'),
					     'ur'    => $this->input->post('ur'),
					     'udar'    => $this->input->post('udar'),
					     'cvs'    => $this->input->post('cvs'),
					     'givwa'    => $this->input->post('givwa'),
					     
					     'ahar' 	   => $this->input->post('ahar'),
					     'mutra' 	   => $this->input->post('mutra')
					     
					];
	      	  }
	      	  else {
	      	      
	      	      
	      	      $data['patient'] = (object)$postData = [
	      		         'id' => $id,
	      		         //'dignosis' => $this->input->post('dignosis'),
	      		         
	      		         
	      		         'Hb' => $this->input->post('Hb'),
						 'TLC' => $this->input->post('TLC'),
						 'DLC_Neutro' => $this->input->post('DLC_Neutro'),
						 'Lymphocytes' => $this->input->post('Lymphocytes'),
						 'Monocytes' => $this->input->post('Monocytes'),
						 'Eosinophils' => $this->input->post('Eosinophils'),
						  'ESR' => $this->input->post('ESR'),
					     'Platelet_Count'    => strtoupper($this->input->post('Platelet_Count')),
					     'B_Sugar' 	   => strtoupper($this->input->post('B_Sugar')),
					     'Blood_Sugar' 	   => $this->input->post('Blood_Sugar'),
					     'Blood_Urea'    => $this->input->post('Blood_Urea'),
					     'S_Creatinine'    => $this->input->post('S_Creatinine'),
					     'S_Uric_Acid'    => $this->input->post('S_Uric_Acid'),
					     'SNat'    => $this->input->post('SNat'),
					     
					     'SK' 	   => $this->input->post('SK'),
					     'Total_Cholestrol'=> $this->input->post('Total_Cholestrol'),
					     
					     'STg' => $this->input->post('STg'),
					     'LDL' => $this->input->post('LDL'),
					     'VLDL' => $this->input->post('VLDL'),
					     'BillirubinT' => $this->input->post('BillirubinT'),
					     'BillirubinI' => $this->input->post('BillirubinI')
					     
					];
	      	  
	      	  }
				
				
				
			   if ($this->patient_model->update_manual_check_up_lib($postData,$section)) {			
					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
               
                // redirect('patients/treatment/'.$id.'/'.$section.'/'.$dignosis);
                 if($section == 'opd'){
                     	redirect('patients/patient_check_LABORATORY/'.$id.'/'.$section);
                 }
                 else{
                   	redirect('patients/patient_check_LABORATORY/'.$id.'/'.$section);
                 }
 		     
				
	  }
	  
	public function  medicine_save()
	{
     $type=$this->input->post('medicine_type');
     $name=$this->input->post('medicine_name');
     $dignosis=$this->input->post('dignosis');
     $patient_id=$this->input->post('patient_id');
     $ipd_opd=$this->input->post('ipd_opd');
    
    
    if($type=='RX1'){
   	$data['patient'] = (object)$postData = ['RX1' => $name,'ipd_opd'=>$ipd_opd];
    }
    else if($type=='RX2'){
      	$data['patient'] = (object)$postData = ['RX2' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='RX3'){
      	$data['patient'] = (object)$postData = ['RX3' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='SNEHAN'){
      	$data['patient'] = (object)$postData = ['SNEHAN' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
     else if($type=='SWEDAN'){
      	$data['patient'] = (object)$postData = ['SWEDAN' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
     else if($type=='VAMAN'){
      	$data['patient'] = (object)$postData = ['VAMAN' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='VIRECHAN'){
      	$data['patient'] = (object)$postData = ['VIRECHAN' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='BASTI'){
      	$data['patient'] = (object)$postData = ['BASTI' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='NASYA'){
      	$data['patient'] = (object)$postData = ['NASYA' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='RAKTAMOKSHAN'){
      	$data['patient'] = (object)$postData = ['RAKTAMOKSHAN' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='SHIRODHARA_SHIROBASTI'){
      	$data['patient'] = (object)$postData = ['SHIRODHARA_SHIROBASTI' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
     else if($type=='OTHER'){
      	$data['patient'] = (object)$postData = ['OTHER' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='SWA1'){
      	$data['patient'] = (object)$postData = ['SWA1' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='SWA2'){
      	$data['patient'] = (object)$postData = ['SWA2' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='HEMATOLOGICAL'){
      	$data['patient'] = (object)$postData = ['HEMATOLOGICAL' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
     else if($type=='SEROLOGYCAL'){
      	$data['patient'] = (object)$postData = ['SEROLOGYCAL' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
     else if($type=='BIOCHEMICAL'){
      	$data['patient'] = (object)$postData = ['BIOCHEMICAL' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='MICROBIOLOGICAL'){
      	$data['patient'] = (object)$postData = ['MICROBIOLOGICAL' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else if($type=='X_RAY'){
      	$data['patient'] = (object)$postData = ['X_RAY' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    else {
      	$data['patient'] = (object)$postData = ['ECG' => $name,'ipd_opd'=>$ipd_opd];  
        
    }
    	if ($this->patient_model->create_medicine($postData)) {			
					

					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('patients/treatment/'.$patient_id.'/'.$ipd_opd.'/'.$dignosis);
     
   }

	public function profile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patient_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function ipd_profile_change($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('ipd_profile_change',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function profile_anc($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patient_profile_anc',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function profile_bill($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('profile_bill',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

    public function ipdprofile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id_ipd($patient_id);
		
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patientipd_profile2',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function ipdprofile_bill($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id_ipd($patient_id);
		
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('profile_bill_ipd',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function treatment($patient_id = null,$section=null,$dignosis = null)
	{ 
	    
	    if($section=='ipd'){
		$data['title'] =  display('patient_Treatment');
	    $dignosis1 = str_replace("%20"," ",$dignosis); 
		$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id,$section);
		$data['dignosis_list'] = $this->department_model->dignosis_list();
	//	$data['treatment_list'] = $this->department_model->treatment_list();	
		$data['department_list'] = $this->department_model->department_list();
		$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1,$section);
		//	$data['treatment_list_rx11'] = $this->department_model->treatment_list_rx11($dignosis1,$section);
		$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1,$section);
		//	$data['treatment_list_rx22'] = $this->department_model->treatment_list_rx22($dignosis1,$section);
		$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1,$section);
		$data['treatment_list_rx4'] = $this->department_model->treatment_list_rx4($dignosis1,$section);
		$data['treatment_list_rx5'] = $this->department_model->treatment_list_rx5($dignosis1,$section);
		//	$data['treatment_list_rx33'] = $this->department_model->treatment_list_rx33($dignosis1,$section);
		$data['treatment_list_pk1'] = $this->department_model->treatment_list_pk1($dignosis1,$section);
		$data['treatment_list_pk2'] = $this->department_model->treatment_list_pk2($dignosis1,$section);
		$data['treatment_list_karma'] = $this->department_model->treatment_list_karma($dignosis1,$section);
		$data['treatment_list_swa1'] = $this->department_model->treatment_list_swa1($dignosis1,$section);
		$data['treatment_list_swa2'] = $this->department_model->treatment_list_swa2($dignosis1,$section);
		
		$data['treatment_list_patho'] = $this->department_model->treatment_list_patho($dignosis1,$section);
		$data['treatment_list_patho2'] = $this->department_model->treatment_list_patho2($dignosis1,$section);
		$data['treatment_list_patho3'] = $this->department_model->treatment_list_patho3($dignosis1,$section);
		
		$data['treatment_list_OTHER'] = $this->department_model->treatment_list_OTHER($dignosis1,$section);
		$data['treatment_list_swa11'] = $this->department_model->treatment_list_swa11($dignosis1,$section);
		$data['treatment_list_swa12'] = $this->department_model->treatment_list_swa12($dignosis1,$section);
		$data['treatment_list_SEROLOGYCAL'] = $this->department_model->treatment_list_SEROLOGYCAL($dignosis1,$section);
		$data['treatment_list_MICROBIOLOGICAL'] = $this->department_model->treatment_list_MICROBIOLOGICAL($dignosis1,$section);
		$data['treatment_list_HEMATOLOGICAL'] = $this->department_model->treatment_list_HEMATOLOGICAL($dignosis1,$section);
		$data['treatment_list_BIOCHEMICAL'] = $this->department_model->treatment_list_BIOCHEMICAL($dignosis1,$section);
		
		$data['treatment_list_x_ray'] = $this->department_model->treatment_list_x_ray($dignosis1,$section);
		$data['treatment_list_ecg'] = $this->department_model->treatment_list_ecg($dignosis1,$section);
		$data['treatment_list_usg'] = $this->department_model->treatment_list_usg($dignosis1,$section);
	
	   // print_r($data['digno_sub_list']); exit;
		//$data['treatment_power'] = $this->department_model->treatment_power_list();
		$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
		$data['content'] = $this->load->view('patientipd_treatment',$data,true);
		$this->load->view('layout/main_wrapper',$data);
		
	    } else{
	        	$data['title'] =  display('patient_Treatment');
	    $dignosis1 = str_replace("%20"," ",$dignosis); 
	$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id,$section);
		$data['dignosis_list'] = $this->department_model->dignosis_list();
	//	$data['treatment_list'] = $this->department_model->treatment_list();	
		$data['department_list'] = $this->department_model->department_list();
		$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1,$section);
		//	$data['treatment_list_rx11'] = $this->department_model->treatment_list_rx11($dignosis1,$section);
		$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1,$section);
		//	$data['treatment_list_rx22'] = $this->department_model->treatment_list_rx22($dignosis1,$section);
		$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1,$section);
		//	$data['treatment_list_rx33'] = $this->department_model->treatment_list_rx33($dignosis1,$section);
		$data['treatment_list_pk1'] = $this->department_model->treatment_list_pk1($dignosis1,$section);
		$data['treatment_list_pk2'] = $this->department_model->treatment_list_pk2($dignosis1,$section);
		$data['treatment_list_karma'] = $this->department_model->treatment_list_karma($dignosis1,$section);
		$data['treatment_list_swa1'] = $this->department_model->treatment_list_swa1($dignosis1,$section);
		$data['treatment_list_swa2'] = $this->department_model->treatment_list_swa2($dignosis1,$section);
		
		$data['treatment_list_patho'] = $this->department_model->treatment_list_patho($dignosis1,$section);
		$data['treatment_list_patho2'] = $this->department_model->treatment_list_patho2($dignosis1,$section);
		$data['treatment_list_patho3'] = $this->department_model->treatment_list_patho3($dignosis1,$section);
		
		$data['treatment_list_OTHER'] = $this->department_model->treatment_list_OTHER($dignosis1,$section);
		$data['treatment_list_swa11'] = $this->department_model->treatment_list_swa11($dignosis1,$section);
		$data['treatment_list_swa12'] = $this->department_model->treatment_list_swa12($dignosis1,$section);
		$data['treatment_list_SEROLOGYCAL'] = $this->department_model->treatment_list_SEROLOGYCAL($dignosis1,$section);
		$data['treatment_list_MICROBIOLOGICAL'] = $this->department_model->treatment_list_MICROBIOLOGICAL($dignosis1,$section);
		$data['treatment_list_HEMATOLOGICAL'] = $this->department_model->treatment_list_HEMATOLOGICAL($dignosis1,$section);
		$data['treatment_list_BIOCHEMICAL'] = $this->department_model->treatment_list_BIOCHEMICAL($dignosis1,$section);
		
		$data['treatment_list_x_ray'] = $this->department_model->treatment_list_x_ray($dignosis1,$section);
		$data['treatment_list_ecg'] = $this->department_model->treatment_list_ecg($dignosis1,$section);
	
	   // print_r($data['digno_sub_list']); exit;
		//$data['treatment_power'] = $this->department_model->treatment_power_list();
		$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
		$data['content'] = $this->load->view('patientipd_treatment',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	    }
	}

    public function patient_check($patient_id = null,$section=null)
	{ 
	    
	    if($section=='ipd'){
		$data['title'] =  display('patient_check_up');
	    $dignosis1 = 'text'; 
		$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id,$section);
		$data['dignosis_list'] = $this->department_model->dignosis_list();
	//	$data['treatment_list'] = $this->department_model->treatment_list();	
		$data['department_list'] = $this->department_model->department_list();
		$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1,$section);
		//	$data['treatment_list_rx11'] = $this->department_model->treatment_list_rx11($dignosis1,$section);
		$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1,$section);
		//	$data['treatment_list_rx22'] = $this->department_model->treatment_list_rx22($dignosis1,$section);
		$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1,$section);
		$data['treatment_list_rx4'] = $this->department_model->treatment_list_rx4($dignosis1,$section);
		$data['treatment_list_rx5'] = $this->department_model->treatment_list_rx5($dignosis1,$section);
		//	$data['treatment_list_rx33'] = $this->department_model->treatment_list_rx33($dignosis1,$section);
	/*	$data['treatment_list_pk1'] = $this->department_model->treatment_list_pk1($dignosis1,$section);
		$data['treatment_list_pk2'] = $this->department_model->treatment_list_pk2($dignosis1,$section);
		$data['treatment_list_karma'] = $this->department_model->treatment_list_karma($dignosis1,$section);
		$data['treatment_list_swa1'] = $this->department_model->treatment_list_swa1($dignosis1,$section);
		$data['treatment_list_swa2'] = $this->department_model->treatment_list_swa2($dignosis1,$section);
		
		$data['treatment_list_patho'] = $this->department_model->treatment_list_patho($dignosis1,$section);
		$data['treatment_list_patho2'] = $this->department_model->treatment_list_patho2($dignosis1,$section);
		$data['treatment_list_patho3'] = $this->department_model->treatment_list_patho3($dignosis1,$section);
		
		$data['treatment_list_OTHER'] = $this->department_model->treatment_list_OTHER($dignosis1,$section);
		$data['treatment_list_swa11'] = $this->department_model->treatment_list_swa11($dignosis1,$section);
		$data['treatment_list_swa12'] = $this->department_model->treatment_list_swa12($dignosis1,$section);
		$data['treatment_list_SEROLOGYCAL'] = $this->department_model->treatment_list_SEROLOGYCAL($dignosis1,$section);
		$data['treatment_list_MICROBIOLOGICAL'] = $this->department_model->treatment_list_MICROBIOLOGICAL($dignosis1,$section);
		$data['treatment_list_HEMATOLOGICAL'] = $this->department_model->treatment_list_HEMATOLOGICAL($dignosis1,$section);
		$data['treatment_list_BIOCHEMICAL'] = $this->department_model->treatment_list_BIOCHEMICAL($dignosis1,$section);
		
		$data['treatment_list_x_ray'] = $this->department_model->treatment_list_x_ray($dignosis1,$section);
		$data['treatment_list_ecg'] = $this->department_model->treatment_list_ecg($dignosis1,$section);*/
	
	   // print_r($data['digno_sub_list']); exit;
		//$data['treatment_power'] = $this->department_model->treatment_power_list();
		$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
		$data['content'] = $this->load->view('patient_check_ipd',$data,true);
		$this->load->view('layout/main_wrapper',$data);
		
	    } else{
	        	$data['title'] =  display('patient_check_up');
	   // $dignosis1 = str_replace("%20"," ",$dignosis); 
		$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id,$section);
	/*	$data['dignosis_list'] = $this->department_model->dignosis_list();
	//	$data['treatment_list'] = $this->department_model->treatment_list();	
		$data['department_list'] = $this->department_model->department_list();
		$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1,$section);
		//	$data['treatment_list_rx11'] = $this->department_model->treatment_list_rx11($dignosis1,$section);
		$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1,$section);
		//	$data['treatment_list_rx22'] = $this->department_model->treatment_list_rx22($dignosis1,$section);
		$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1,$section);
		//	$data['treatment_list_rx33'] = $this->department_model->treatment_list_rx33($dignosis1,$section);
		$data['treatment_list_pk1'] = $this->department_model->treatment_list_pk1($dignosis1,$section);
		$data['treatment_list_pk2'] = $this->department_model->treatment_list_pk2($dignosis1,$section);
		$data['treatment_list_karma'] = $this->department_model->treatment_list_karma($dignosis1,$section);
		$data['treatment_list_swa1'] = $this->department_model->treatment_list_swa1($dignosis1,$section);
		$data['treatment_list_swa2'] = $this->department_model->treatment_list_swa2($dignosis1,$section);
		
		$data['treatment_list_patho'] = $this->department_model->treatment_list_patho($dignosis1,$section);
		$data['treatment_list_patho2'] = $this->department_model->treatment_list_patho2($dignosis1,$section);
		$data['treatment_list_patho3'] = $this->department_model->treatment_list_patho3($dignosis1,$section);
		
		$data['treatment_list_x_ray'] = $this->department_model->treatment_list_x_ray($dignosis1,$section);
		$data['treatment_list_ecg'] = $this->department_model->treatment_list_ecg($dignosis1,$section);*/
	
	   // print_r($data['digno_sub_list']); exit;
		//$data['treatment_power'] = $this->department_model->treatment_power_list();
		$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
		$data['content'] = $this->load->view('patient_check',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	    }
	}

    public function patient_check_LABORATORY($patient_id = null,$section=null)
	{ 
	    
	    if($section=='ipd'){
		$data['title'] =  display('patient_check_up');
	    $dignosis1 = 'text'; 
		$data['patient'] = $this->patient_model->read_by_id_treatment($patient_id,$section);
		$data['dignosis_list'] = $this->department_model->dignosis_list();
	//	$data['treatment_list'] = $this->department_model->treatment_list();	
		$data['department_list'] = $this->department_model->department_list();
		$data['treatment_list_rx1'] = $this->department_model->treatment_list_rx1($dignosis1,$section);
		//	$data['treatment_list_rx11'] = $this->department_model->treatment_list_rx11($dignosis1,$section);
		$data['treatment_list_rx2'] = $this->department_model->treatment_list_rx2($dignosis1,$section);
		//	$data['treatment_list_rx22'] = $this->department_model->treatment_list_rx22($dignosis1,$section);
		$data['treatment_list_rx3'] = $this->department_model->treatment_list_rx3($dignosis1,$section);
		$data['treatment_list_rx4'] = $this->department_model->treatment_list_rx4($dignosis1,$section);
		$data['treatment_list_rx5'] = $this->department_model->treatment_list_rx5($dignosis1,$section);
		//	$data['treatment_list_rx33'] = $this->department_model->treatment_list_rx33($dignosis1,$section);
	
	
	   // print_r($data['digno_sub_list']); exit;
		//$data['treatment_power'] = $this->department_model->treatment_power_list();
		$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
		$data['content'] = $this->load->view('patient_check_LABORATORY',$data,true);
		$this->load->view('layout/main_wrapper',$data);
		
	    } else{
	        	$data['title'] =  display('patient_check_up');
	   // $dignosis1 = str_replace("%20"," ",$dignosis); 
	
	
	   // print_r($data['digno_sub_list']); exit;
		//$data['treatment_power'] = $this->department_model->treatment_power_list();
		$data['documents'] = $this->document_model->read_by_id_treatment($patient_id);
		$data['content'] = $this->load->view('patient_check_LABORATORY',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	    }
	}
	
	/*public function edit($patient_id = null) 
	{ 
		//print_r('hi');
		//die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id($patient_id);
		$data['department_list'] = $this->department_model->department_list(); 
		
		$data['address_list'] =$this->department_model->address_list(); 
		$data['content'] = $this->load->view('patient_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 
 	public function edit_ipd($patient_id = null) 
	{ 
		//print_r('hi');
		//die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id_ipd($patient_id);
		$data['department_list'] = $this->department_model->department_list(); 
		$data['content'] = $this->load->view('patient_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}*/
	
	public function edit($patient_id = null) 
	{ 
	   //	print_r($patient_id);
	   //die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id($patient_id);
		$data['department_list'] = $this->department_model->department_list(); 
      // print_r($data['patient']->firstname);
     //	die();
		$data['address_list'] =$this->department_model->address_list(); 
		$data['content'] = $this->load->view('patient_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 
 	public function edit_ipd($patient_id = null) 
	{ 
		//print_r('hi');
		//die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id_ipd($patient_id);
		$data['department_list'] = $this->department_model->department_list(); 
		$data['address_list'] =$this->department_model->address_list();
		$data['content'] = $this->load->view('patient_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	/*public function getpatientbydepartment($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
        $data['department_by'] = 'dpt';
        $data['department_id'] = $department_id_decode;
         $data['getpatientbydepartment_date'] = 'D';
       
	 if($section =='opd'){
		$data['content'] = $this->load->view('patient_departmental',$data,true);
       }else{
          	$data['content'] = $this->load->view('patient',$data,true); 
       }
		
		$this->load->view('layout/main_wrapper',$data);
	}*/
 
    public function getpatientbydepartment($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		/*$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();*/
		 $data['department_by_section'] = 'opd';
      }
      else{
          
         /* $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();*/
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
        $data['department_by'] = 'dpt';
        $data['department_id'] = $department_id_decode;
         $data['getpatientbydepartment_date'] = 'D';
       
		$data['content'] = $this->load->view('patient',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientbydepartment_admit_register($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
        
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
        $data['department_by'] = 'dpt';
        $data['department_id'] = $department_id_decode;
         $data['getpatientbydepartment_date'] = 'D';
       
		$data['content'] = $this->load->view('patient_amit_register',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

    public function pharma_date_month($pharma = '', $section = '',$segment)
	{
	   
	   // echo $section;exit;
	 

    	$start_date1 = $this->input->get('start_date');

		$end_date1   = $this->input->get('end_date', TRUE);


	     $start_date2 = date('Y-m-d',strtotime($start_date1));
        $end_date2   = date('Y-m-d',strtotime($end_date1));
        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
        $end_date_close= $end_date2." 00:00:00";
        
		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_month($section,$start_date,$end_date);
	
        $data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section,$start_date,$end_date);
        
        $data['pharma_req'] = $this->patient_model->pharma_req($section,$start_date,$end_date);
        
        $data['pharma_close'] = $this->patient_model->pharma_close($section,$end_date_close,$end_date);
		$section = $section;
		
		$data['fisrt_hide'] =1;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
     
     
		$data['datefrom'] = $start_date2;
		$data['dateto'] =$end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['start'] = '1';
        
        $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        
        
        

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        
       $data['patients'] = $this->patient_model->read_by_phrama($section,$config["per_page"], $page);
       
		$data['content'] = $this->load->view('pharma_Month',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function pharma_date_year($pharma = '', $section = '',$segment)
	{
	   
	   // echo $section;exit;
	 

    	$start_date1 = $this->input->get('start_date');

		$end_date1   = $this->input->get('end_date', TRUE);


	     $start_date2 = date('Y-m-d',strtotime($start_date1));
        $end_date2   = date('Y-m-d',strtotime($end_date1));
        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
        $end_date_close= $end_date2." 00:00:00";
        
		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_year($section,$start_date,$end_date);
	
        $data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section,$start_date,$end_date);
        
        $data['pharma_req'] = $this->patient_model->pharma_req($section,$start_date,$end_date);
        
        $data['pharma_close'] = $this->patient_model->pharma_close($section,$end_date_close,$end_date);
		$section = $section;
		
		$data['fisrt_hide'] =1;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
     
     
		$data['datefrom'] = $start_date2;
		$data['dateto'] =$end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['start'] = '1';
        
        $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        
        
        

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        
       $data['patients'] = $this->patient_model->read_by_phrama($section,$config["per_page"], $page);
       
		$data['content'] = $this->load->view('pharma_year',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function pharma_date($pharma = '', $section = '',$segment)
	{
	    
	 
	  $ses_year=$this->session->userdata['acyear'];
      $year = '%'.$this->session->userdata['acyear'].'%';

    	$start_date1 = $this->input->get('start_date');

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));
        $start_date2_M_D = date('-m-d',strtotime($start_date1));
        $start_date2_M_D_Y=$ses_year.$start_date2_M_D;
        
		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

       $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		
		$pre_date=date('Y-m-d', strtotime("-1 days", strtotime($start_date2_M_D_Y)));
		
	    $w_day11= date('D',strtotime($pre_date));
	   
			
	    $holiday_pre=$this->db->select("*")

			->from('holiday')
            ->where('holiday_date',$pre_date)
		//	->where('status',1)
            
			->get()

			->row();		
			
	   
	   
	   if($start_date2_M_D_Y=='2018-10-01'){
	       $date_for_pharma=$start_date2_M_D_Y;
	       $fisrt_date='2018-10-01';
	   } else if($holiday_pre){
	        $pre_date=date('Y-m-d', strtotime("-2 days", strtotime($start_date2_M_D_Y)));
	        $w_day= date('D',strtotime($pre_date));
	         if($w_day !='Sun'){
	            $date_for_pharma=$pre_date;
	         }
	   }else if($w_day11 !='Sun'){
	        $date_for_pharma=$pre_date;
	      }
	      
	      else {
	          
	          $date_for_pharma=$pre_date;
	          
	          
	          
	          
	      }
	     
	   $date_for_pharma;
	   
	   $data['pharmaaa'] = $this->patient_model->read_by_phrama_list1_daily($pharma,$date_for_pharma,$section);
	    if((!empty($data['pharmaaa'])) && (empty($fisrt_date))){
	    $data['pharma'] = $this->patient_model->read_by_phrama_list1_daily($pharma,$date_for_pharma,$section);
	    } else   {  
	     if(empty($data['pharma'])){   
	    $data['pharma'] = $this->patient_model->read_by_phrama_list1($pharma);
	     }  
	   } 
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
	   
	    $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section,$start_date,$end_date);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
       // $data['patients'] = $this->patient_model->read_by_phrama_date($section,$start_date,$end_date,$config["per_page"], $page);
       // $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
          $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
       
       // $data['patients'] = array_merge( $data['patients_opd'], $data['patients_ipd']);
       
       
        //$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
        $data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
        
        //$data['patients_summary'] = array_merge( $data['patients_summary_opd'], $data['patients_summary_ipd']);
        
       
		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['department_by_section'] = 'opd';
        
        $data['ipd'] = $section;
       
		$data['content'] = $this->load->view('pharma',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
    
	public function pharma_date_Despensing($pharma = '', $section = '',$segment,$start_date,$end_date)
	{
	    
	 
	  $ses_year=$this->session->userdata['acyear'];
      $year = '%'.$this->session->userdata['acyear'].'%';
      
       $start_date11= $this->input->get('start_date');

		$end_date11   = $this->input->get('end_date', TRUE);
		
       if($start_date11){
          $start_date = date('Y-m-d',strtotime($start_date11));
           $start_date_n=date('Y-m-d',strtotime($start_date11));
       }
       else if($start_date){
           $start_date = date('Y-m-d',strtotime($start_date));
           $start_date_n=date('Y-m-d',strtotime($start_date));
       }
       else{
           $start_date=date('Y-m-d');
           $start_date_n=date('Y-m-d');
       }
       
        if($end_date11){
          $end_date = date('Y-m-d',strtotime($end_date11)); 
          $end_date_n=date('Y-m-d',strtotime($end_date11));
       }
       else 
       if($end_date){
            $end_date = date('Y-m-d',strtotime($end_date));
            $end_date_n=date('Y-m-d',strtotime($end_date));
       }else{
            $end_date=date('Y-m-d');
            $end_date_n=date('Y-m-d');
       }

    	$start_date1 =$start_date ;

		$end_date1   =$end_date;


		$start_date2 = date('Y-m-d',strtotime($start_date1));
        $start_date2_M_D = date('-m-d',strtotime($start_date1));
        $start_date2_M_D_Y=$ses_year.$start_date2_M_D;
        
		$end_date2   = date('Y-m-d',strtotime($end_date1));

	   $section = $this->input->get('section', TRUE);
	   if(empty($section)){
	       $section=$this->uri->segment(4);
	   }

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		
		$pre_date=date('Y-m-d', strtotime("-1 days", strtotime($start_date2_M_D_Y)));
		
	    $w_day11= date('D',strtotime($pre_date));
	   
			
	    $holiday_pre=$this->db->select("*")

			->from('holiday')
            ->where('holiday_date',$pre_date)
		//	->where('status',1)
            
			->get()

			->row();		
			
	   
	   
	   if($start_date2_M_D_Y=='2018-10-01'){
	       $date_for_pharma=$start_date2_M_D_Y;
	       $fisrt_date='2018-10-01';
	   } else if($holiday_pre){
	        $pre_date=date('Y-m-d', strtotime("-2 days", strtotime($start_date2_M_D_Y)));
	        $w_day= date('D',strtotime($pre_date));
	         if($w_day !='Sun'){
	            $date_for_pharma=$pre_date;
	         }
	   }else if($w_day11 !='Sun'){
	        $date_for_pharma=$pre_date;
	      }
	      
	      else {
	          
	          $date_for_pharma=$pre_date;
	          
	          
	          
	          
	      }
	     
	   $date_for_pharma;
	   
	   $data['pharmaaa'] = $this->patient_model->read_by_phrama_list1_daily($pharma,$date_for_pharma,$section);
	    if((!empty($data['pharmaaa'])) && (empty($fisrt_date))){
	    $data['pharma'] = $this->patient_model->read_by_phrama_list1_daily($pharma,$date_for_pharma,$section);
	    } else   {  
	     if(empty($data['pharma'])){   
	    $data['pharma'] = $this->patient_model->read_by_phrama_list1($pharma);
	     }  
	   } 
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
	   
	    $config = array();
        $config["base_url"] = base_url() . "patients/pharma_date_Despensing/".$pharma.'/'.$section.'/0/'.$start_date_n.'/'.$end_date_n;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section,$start_date,$end_date);
        $config["per_page"] = 35;
        $config["uri_segment"] = 5;

        $this->pagination->initialize($config);

         $page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;

        $data["links"] = $this->pagination->create_links();
        $data['patients'] = $this->patient_model->read_by_phrama_date_summary_despencing($section,$start_date_n,$end_date_n,$config["per_page"], $page);
        // print_r($data['patients']); 
      //  $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
        //  $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
       
       // $data['patients'] = array_merge( $data['patients_opd'], $data['patients_ipd']);
       
       
        //$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
        $data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
        
        //$data['patients_summary'] = array_merge( $data['patients_summary_opd'], $data['patients_summary_ipd']);
        
       
		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['department_by_section'] = 'opd';
        
        $data['ipd'] = $section;
       
		$data['content'] = $this->load->view('pharma_Despensing',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

	public function pharma_date_ipd($pharma = '', $section = '',$segment)
	{
	  $ses_year=$this->session->userdata['acyear'];
      $year = '%'.$this->session->userdata['acyear'].'%';

    	$start_date1 = $this->input->get('start_date');

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));
        $start_date2_M_D = date('-m-d',strtotime($start_date1));
        $start_date2_M_D_Y=$ses_year.$start_date2_M_D;
        
		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

       $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		
		$pre_date=date('Y-m-d', strtotime("-1 days", strtotime($start_date2_M_D_Y)));
		
	    $w_day11= date('D',strtotime($pre_date));
	   
			
	    $holiday_pre=$this->db->select("*")

			->from('holiday')
            ->where('holiday_date',$pre_date)
		//	->where('status',1)
            
			->get()

			->row();		
			
	   
	   
	   if($start_date2_M_D_Y=='2018-10-01'){
	       $date_for_pharma=$start_date2_M_D_Y;
	       $fisrt_date='2018-10-01';
	   } else if($holiday_pre){
	        $pre_date=date('Y-m-d', strtotime("-2 days", strtotime($start_date2_M_D_Y)));
	        $w_day= date('D',strtotime($pre_date));
	         if($w_day !='Sun'){
	            $date_for_pharma=$pre_date;
	         }
	   }else if($w_day11 !='Sun'){
	        $date_for_pharma=$pre_date;
	      }
	      
	      else {
	          
	          $date_for_pharma=$pre_date;
	          
	          
	          
	          
	      }
	     
	   $date_for_pharma;
	   
	   $data['pharmaaa'] = $this->patient_model->read_by_phrama_list1_daily($pharma,$date_for_pharma,$section);
	    if((!empty($data['pharmaaa'])) && (empty($fisrt_date))){
	    $data['pharma'] = $this->patient_model->read_by_phrama_list1_daily($pharma,$date_for_pharma,$section);
	    } else   {  
	     if(empty($data['pharma'])){   
	    $data['pharma'] = $this->patient_model->read_by_phrama_list1_ipd($pharma);
	     }  
	   } 
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
	   
	    $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section,$start_date,$end_date);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
       // $data['patients'] = $this->patient_model->read_by_phrama_date($section,$start_date,$end_date,$config["per_page"], $page);
       // $data['patients'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
          $data['patients'] = $this->patient_model->read_by_phrama_date_summary('ipd',$start_date,$end_date);
       
       // $data['patients'] = array_merge( $data['patients_opd'], $data['patients_ipd']);
       
       
        //$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('opd',$start_date,$end_date);
        $data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary('ipd',$start_date,$end_date);
        
        //$data['patients_summary'] = array_merge( $data['patients_summary_opd'], $data['patients_summary_ipd']);
        
       
		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['department_by_section'] = 'ipd';
        
        $data['ipd'] = $section;
       
		$data['content'] = $this->load->view('pharma_ipd',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

    public function Ksharsutra()
    {
      	$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
       
		$end_date1   = $this->input->get('end_date', TRUE);
        if(empty($end_date1)){
            $start_date1=$this->session->userdata['acyear'].'-01-01';
            $end_date1=$this->session->userdata['acyear'].'-01-01';
        } 

		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = 'ipd';

         $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
    	$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		$date1=date_create($start_date2);
        $date2=date_create($end_date2);
        $diff=date_diff($date1,$date2);
        $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='0';
        }
        
        
		
	

		//Array 2
		$data['patients'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('dignosis LIKE', '%BHAGANDAR%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)

		->get()

		->result();

	
    //	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
      
		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
	    // ->where('create_date >=', $start_date)
	    //->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('create_date >=', $start_date)
		//->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();
            
     	$data['department_by_section'] ='ipd';    
     	
     		if($data == null){
			$data['content'] = $this->load->view('Ksharsutra',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		  }else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('Ksharsutra',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}

		
  }
	
	public function ot()
	{
      	$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
       
		$end_date1   = $this->input->get('end_date', TRUE);
        if(empty($end_date1)){
            $start_date1=$this->session->userdata['acyear'].'-01-01';
            $end_date1=$this->session->userdata['acyear'].'-01-01';
        } 

		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = 'ipd';

         $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
    	$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		$date1=date_create($start_date2);
        $date2=date_create($end_date2);
        $diff=date_diff($date1,$date2);
        $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='0';
        }
        
        
		
	

		//Array 2
		$data['patients'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('dignosis LIKE', '%BHAGANDAR%') 
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)
		->or_where('dignosis LIKE', '%ARSHA%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)
		->or_where('dignosis LIKE', '%PARIKARTIKA%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)
		->or_where('dignosis LIKE', '%MUTRAVRUDDHI%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)
		->or_where('dignosis LIKE', '%VIDRADHI%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)
		->or_where('dignosis LIKE', '%MEDOJ GRANTHI%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)
		->or_where('dignosis LIKE', '%CHALAZION%')
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->where('ipd_opd', $section)

		->get()

		->result();

	
    //	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
      
	

	
            
     	$data['department_by_section'] ='ipd';    
     	
     		if($data == null){
			$data['content'] = $this->load->view('OT',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		  }else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('OT',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}

		
  }
	
	public function getpatientby_garbhini($section)
	{

	
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dignosis_garbhini($section);
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');
        //$data['patients'] =array_merge($data['patients1'],$data['patients2']);
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
        $data['department_by'] = 'dpt';
     //   $data['department_id'] = $department_id_decode;
       if($section=='opd'){
           
           $data['content'] = $this->load->view('patient_anc',$data,true);
       }else{
          $data['content'] = $this->load->view('patient_garbhini',$data,true); 
       }
		
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function PHYSIOTHERAPY($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);
         $date_c=date('Y-m-d',strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
      $data['check_data'] = $this->patient_model->read_by_check_data($section,$date_c);

	//	echo count($data['patients'] );exit;
		$section = $section;
        
        
		$year = '%'.$this->session->userdata['acyear'].'%';

       if($section == 'ipd'){
		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
	//	->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 5 days"));
	    $data['gobs'] = 'gobs';

		$data['content'] = $this->load->view('patient',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
	}
	else{
	    	$data['gendercount'] = $this->db->select('department.name,  patient.sex, COUNT( patient.sex) as Gender, COUNT( patient.yearly_reg_no) as New, COUNT( patient.old_reg_no) as old')
		->from('patient')
		->join('department', ' patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name,  patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='opd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 5 days"));
		

		$data['content'] = $this->load->view('PHYSIOTHERAPY',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}
	}
	
	public function patient_by_date_p()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

         $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
      // $start_date=$start_date1." 00:00:00";
      // $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
      $date1=date_create($start_date2);
       $date2=date_create($end_date2);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='0';
        }

		//echo $section;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
        // echo count($data['patients']); exit;

		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', ' patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
	    ->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();
			$data['department_by_section'] ='opd';  
         }
         else
         {
             

      $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', 'ipd')
		->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date_f)

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', 'ipd')

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);

      
      
		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
	    // ->where('create_date >=', $start_date)
	    //->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('create_date >=', $start_date)
		//->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();
            
            	$data['department_by_section'] ='ipd';         
         }
		
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('PHYSIOTHERAPY',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('PHYSIOTHERAPY',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
		
	}	
	
	public function pharma($pharma = '', $section = '')
	{

	    $start_date2 = date('Y-m-d',strtotime('2019-01-12'));
        $end_date2   = date('Y-m-d',strtotime('2019-01-12'));
        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary($section,$start_date,$end_date);
        $data['pharma'] = $this->patient_model->read_by_phrama_list($pharma);
		$section = $section;
		
		$data['fisrt_hide'] =1;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
     
     
		$data['datefrom'] = $start_date2;
		$data['dateto'] =$start_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['start'] = '1';
        
        $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count1($section,$start_date,$end_date);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        
        
        

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        
      // $data['patients'] = $this->patient_model->read_by_phrama_date($section,$start_date,$end_date,$config["per_page"], $page);
       
		$data['content'] = $this->load->view('pharma',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function pharma_Month($pharma = '', $section = '')
	{

	    $start_date2 = date('2020-01-01');
        $end_date2   = date('2020-01-31');
        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        $end_date_close= $end_date2." 00:00:00";
        
		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_month($section,$start_date,$end_date);
	
        $data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section,$start_date,$end_date);
        
        $data['pharma_req'] = $this->patient_model->pharma_req($section,$start_date,$end_date);
        $data['pharma_close'] = $this->patient_model->pharma_close($section,$end_date_close,$end_date);
       // print_r($data['pharma_req']);
		$section = $section;
		
		$data['fisrt_hide'] =1;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
     
     
		$data['datefrom'] = $start_date2;
		$data['dateto'] =$end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['start'] = '1';
        
        $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        
        
        

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        
       $data['patients'] = $this->patient_model->read_by_phrama($section,$config["per_page"], $page);
       
		$data['content'] = $this->load->view('pharma_Month',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function pharma_year($pharma = '', $section = '')
	{

	    $start_date2 = date('2020-01-01');
        $end_date2   = date('2020-01-31');
        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        $end_date_close= $end_date2." 00:00:00";
        
		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients__date'] = $this->patient_model->read_by_phrama_date_summary_year($section,$start_date,$end_date);
	
        $data['pharma'] = $this->patient_model->read_by_phrama_date_summary_month_name($section,$start_date,$end_date);
        
        $data['pharma_req'] = $this->patient_model->pharma_req($section,$start_date,$end_date);
        $data['pharma_close'] = $this->patient_model->pharma_close($section,$end_date_close,$end_date);
       // print_r($data['pharma_req']);
		$section = $section;
		
		$data['fisrt_hide'] =1;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
     
     
		$data['datefrom'] = $start_date2;
		$data['dateto'] =$end_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['start'] = '1';
        
        $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        
        
        

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        
       $data['patients'] = $this->patient_model->read_by_phrama($section,$config["per_page"], $page);
       
		$data['content'] = $this->load->view('pharma_year',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function pharma_ipd($pharma = '', $section = '')
	{

	    $start_date2 = date('Y-m-d');
        $end_date2   = date('Y-m-d');
        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
		$data['title'] = display('patient_Pharma');
		$data['patients'] = $this->patient_model->read_by_phrama($section);
		$data['patients_summary'] = $this->patient_model->read_by_phrama_date_summary($section,$start_date,$end_date);
        $data['pharma'] = $this->patient_model->read_by_phrama_list($pharma);
		$section = $section;
		
		$data['fisrt_hide'] =1;

		$year = '%'.$this->session->userdata['acyear'].'%';

      
	   $data['department_by_section'] = $section;
     
     
		$data['datefrom'] = $start_date2;
		$data['dateto'] =$start_date2;
        $data['department_by'] = 'dpt';
        $data['pharmas'] = $pharma;
        $data['start'] = '1';
        
        $config = array();
        $config["base_url"] = base_url() . "patients/pharma/".$pharma.'/'.$section;
        $config["total_rows"] = $this->patient_model->read_by_phrama_get_count($section);
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        
        
        

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data["links"] = $this->pagination->create_links();
        
       $data['patients'] = $this->patient_model->read_by_phrama($section,$config["per_page"], $page);
       
		$data['content'] = $this->load->view('pharma_ipd',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getMukh_dant_data_sky($department_id = '', $section = '')
	{
	    
	    $year = $this->session->userdata['acyear'];
	    $department_id_decode = rawurldecode($department_id);
	    $start_date1 = date('Y-m',strtotime('01-01-'.$year));
	    $end_date1   = date('Y-m',strtotime('31-12-'.$year));

        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
        
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($department_id_decode, $section,$start_date,$end_date);
		$data['section'] = $section;

		$data['content'] = $this->load->view('netra_dant_month_report_sky',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

	public function getpatientbydepartment_sky($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
	    $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 5 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 5 days"));
        $data['department_by'] = 'dpt';
        $data['department_id'] = $department_id_decode;
       
		$data['content'] = $this->load->view('patient_sky',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

    public function getpatientbydepartment_karma($section = '')
	{

		//$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_karma($section);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
	$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
        $data['department_by'] = 'dpt';
        $data['department_id'] = '';
        //$data['swat_id'] = '28';
		$data['content'] = $this->load->view('patient_karma',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_investigation($section ='')
	{

	
		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_dept_investi($section='opd');
		$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');

       $data['patients'] =array_merge($data['patients1'],$data['patients2']);
        		//print_r($data['patients'] ); exit;
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
	   $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
        $data['department_by'] = 'dpt';
     //   $data['department_id'] = $department_id_decode;
       
		$data['content'] = $this->load->view('patient_investi',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_garbhini11($section ='')
	{

	
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dignosis_garbhini($section='opd');
		//$data['patients2'] = $this->patient_model->read_by_dept_investi($section='ipd');
        //$data['patients'] =array_merge($data['patients1'],$data['patients2']);
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
        $data['department_by'] = 'dpt';
     //   $data['department_id'] = $department_id_decode;
       
		$data['content'] = $this->load->view('patient_garbhini',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
    public function getpatientbydepartment_gob()
	{
        $section='ipd';
		//$department_id_decode = rawurldecode($department_id);
		$start_date1 = date('Y-m-d');

		$end_date1   = date('Y-m-d');

        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		 $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_gob($section,$start_date,$end_date);

		$year = '%'.$this->session->userdata['acyear'].'%';

          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      
	
        $data['department_by'] = 'dpt';
        $data['department_id'] = '';
        $data['flag'] = '1';
        $data['gob'] = 'gob';
		$data['content'] = $this->load->view('patient',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	} 
	
    public function getpatientbydepartment_gob_dept($id='',$section='')
	{
        $section='ipd';
		$department_id_decode = rawurldecode($id);
		$start_date1 = date('Y-m-d');

		$end_date1   = date('Y-m-d');

        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
	    $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_gob_dept($id,$section,$start_date,$end_date);

		$year = '%'.$this->session->userdata['acyear'].'%';

          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      
	
        $data['department_by'] = 'dpt';
        $data['department_id'] = '';
        $data['dept_id'] = $id;
        $data['flag'] = '1';
        $data['gob'] = 'gob';
		$data['content'] = $this->load->view('patient',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

    public function getpatientbydepartment_gob_date()
	{
       // $section='ipd';
		//$department_id_decode = rawurldecode($department_id);
	
		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    $id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);


        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['title'] = display('patient_list');
		$year = '%'.$this->session->userdata['acyear'].'%';
		if($id){
		
          $data['patients'] = $this->patient_model->read_by_gob_dept_date($id,$section,$start_date,$end_date);
           $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '%0000-00-00%')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
			$data['dept_id'] = $id;
		}else{
		$data['patients'] = $this->patient_model->read_by_dept_id_gob($section,$start_date,$end_date);
		    	 
     	}
         
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

       
	
        $data['department_by'] = 'dpt';
         $data['department_by_section']= 'ipd';
        $data['flag'] = '1';
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		 $data['gob'] = 'gob';

		$data['content'] = $this->load->view('patient',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getrecordnysection($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);
         $date_c=date('Y-m-d',strtotime("+ 5 days"));
		$data['patients'] = $this->patient_model->read_by_section($section);
      $data['check_data'] = $this->patient_model->read_by_check_data($section,$date_c);

	//	echo count($data['patients'] );exit;
		$section = $section;
        
        
		$year = '%'.$this->session->userdata['acyear'].'%';

       if($section == 'ipd'){
		$data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
	//	->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
	    $data['gobs'] = 'gobs';

		$data['content'] = $this->load->view('patient',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
	}
	else{
	    	$data['gendercount'] = $this->db->select('department.name,  patient.sex, COUNT( patient.sex) as Gender, COUNT( patient.yearly_reg_no) as New, COUNT( patient.old_reg_no) as old')
		->from('patient')
		->join('department', ' patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name,  patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='opd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		

		$data['content'] = $this->load->view('patient',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}
	}
    
    public function getbedlist($section = '')
	{
		$data['title'] = 'Assigned Bed List';

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);

		$data['patients'] = $this->patient_model->read_by_bed($section);

	//	echo count($data['patients'] );exit;
		$section = $section;
        
        
		$year = '%'.$this->session->userdata['acyear'].'%';

       
		

		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		
        
		$data['content'] = $this->load->view('assign_bed_list',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	

	}

    public function getbedlist_date($section = '')
	{
		$data['title'] = 'Assigned Bed List';

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);

       $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);


       $start_date=$start_date1." 00:00:00";
       $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		$data['patients'] = $this->patient_model->read_by_bed_date($section,$start_date,$end_date);

	//	echo count($data['patients'] );exit;
		$section = $section;
        
        
		$year = '%'.$this->session->userdata['acyear'].'%';

       
		

		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
		

		$data['content'] = $this->load->view('assign_bed_list',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	

	}
	
	public function delete($patient_id = null) 
	{ 
		if ($this->patient_model->delete($patient_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}

    public function delete_ipd($patient_id = null) 
	{ 
		if ($this->patient_model->delete_ipd($patient_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}

	public function pdfdownload()
	{
		//PDF Download 
		if(isset($_POST['btn_excel_download'])){
			$arr_user_ids = $this->input->post('checkbox');
			$delimiter = ",";
			$newline = "\r\n";
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			$filename = 'Patient' . date('YmdHis').".csv";
			
			$this->db->select('*');
			$this->db->from('patient');
			
			$user_account = $this->session->userdata('user_account');
			}
			$result = $this->db->get();
			$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
			force_download($filename, $data);
		}
	
    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
	*/
	
	public function randStrGen($mode = null, $len = null)
	{
		$result = "";
/*
		$currentdate = date('d');
		$currentmonth = date('m');
		$currentYear = date('y');
		print_r($currentdate);
		print_r($currentmonth);
		print_r($currentYear);
		die();
	*/

        if($mode == 1):
            $chars = "0123456789";
        elseif($mode == 2):
            $chars = "0123456789";
        elseif($mode == 3):
            $chars = "0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }

    public function randStrGenforday()
    {
		$result = "";

		$currentdate = date('d/m/y');
		print_r($currentdate);
		die();

        if($mode == 1):
            $chars = "0123456789";
        elseif($mode == 2):
            $chars = "0123456789";
        elseif($mode == 3):
            $chars = "0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }
    
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */

    public function document()
	{ 
		$data['title'] = display('document_list');
		$data['documents'] = $this->document_model->read();
		$data['content'] = $this->load->view('document',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

    public function document_form()
    {  
        $data['title'] = display('add_document'); 
        /*----------VALIDATION RULES----------*/
        $this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[30]');
        $this->form_validation->set_rules('doctor_name', display('doctor_id'),'max_length[11]');
        $this->form_validation->set_rules('description', display('description'),'trim');
        $this->form_validation->set_rules('hidden_attach_file', display('attach_file'),'required|max_length[255]');
        /*-------------STORE DATA------------*/
        $urole = $this->session->userdata('user_role');
        $data['document'] = (object)$postData = array( 
            'patient_id'  => $this->input->post('patient_id'),
            'doctor_id'   => $this->input->post('doctor_id'),
            'description' => $this->input->post('description'),
            'hidden_attach_file' => $this->input->post('hidden_attach_file'),
            'date'        => date('Y-m-d'),
            'upload_by'   => (($urole==10)?0:$this->session->userdata('user_id'))
        );  

        /*-----------CREATE A NEW RECORD-----------*/
        if ($this->form_validation->run() === true) { 
 
            if ($this->document_model->create($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('patient/document_form');
        } else {
            $data['doctor_list'] = $this->doctor_model->doctor_list(); 
            $data['content'] = $this->load->view('document_form',$data,true);
            $this->load->view('layout/main_wrapper',$data);
        }  
    } 

    public function do_upload()
    {
        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');  
        ini_set('post_max_size', '200M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        if (($_SERVER['REQUEST_METHOD']) == "POST") { 
            $filename = $_FILES['attach_file']['name'];
            $filename = strstr($filename, '.', true);
            $email    = $this->session->userdata('email');
            $filename = strstr($email, '@', true)."_".$filename;
            $filename = strtolower($filename);
            /*-----------------------------*/

            $config['upload_path']   = FCPATH .'./assets/attachments/';
            // $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
            $config['allowed_types'] = '*';
            $config['max_size']      = 0;
            $config['max_width']     = 0;
            $config['max_height']    = 0;
            $config['file_ext_tolower'] = true; 
            $config['file_name']     =  $filename;
            $config['overwrite']     = false;

            $this->load->library('upload', $config);

            $name = 'attach_file';
            if ( ! $this->upload->do_upload($name) ) {
                $data['exception'] = $this->upload->display_errors();
                $data['status'] = false;
                echo json_encode($data);
            } else {
                $upload =  $this->upload->data();
                $data['message'] = display('upload_successfully');
                $data['filepath'] = './assets/attachments/'.$upload['file_name'];
                $data['status'] = true;
                echo json_encode($data);
            }
        }  
    } 

    public function document_delete($id = null)
    {
    	if ($this->document_model->delete($id)) {

	    	$file = $this->input->get('file');
	    	if (file_exists($file)) {
	    		@unlink($file);
	    	}
    		$this->session->set_flashdata('message', display('save_successfully'));

    	} else {
    		$this->session->set_flashdata('exception', display('please_try_again'));
    	}

    	redirect($_SERVER['HTTP_REFERER']);
	}
	
    public function doctor_by_department()
    {
        $department_id = $this->input->post('department_id');

        if (!empty($department_id)) {
            $query = $this->db->select('user_id,firstname,lastname')
                ->from('user')
                ->where('department_id',$department_id)
                ->where('user_role',2)
                ->where('status',1)
                ->get();

            $option = "<option value=\"\">".display('select_option')."</option>"; 
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $doctor) {
                    $option .= "<option value=\"$doctor->user_id\">$doctor->firstname $doctor->lastname</option>";
                } 
                $data['message'] = $option;
                $data['status'] = true;
            } else {
                $data['message'] = display('no_doctor_available');
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invalid_department');
            $data['status'] = null;
        }

        echo json_encode($data);
    }

	public function import111111()
	{
		$configUpload['upload_path'] = FCPATH.'/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension=$upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true); 		  
		//Load excel file
		$objPHPExcel=$objReader->load(FCPATH.$file_name);		 
		$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for($i=2;$i<=$totalrows;$i++)
		{

			$dia	 = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$deprt = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			
			$RX1 = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$RX2 = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$RX3 = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			
			$SNEHAN = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue();
			$SWEDAN = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
		    $VAMAN = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$VIRECHAN = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			
			$BASTI = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$NASYA = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$RAKTAMOKSHAN = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$SHIRODHARA_SHIROBASTI = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$OTHER = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
		    $skya = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue();
		    	$skarma = $objWorksheet->getCellByColumnAndRow(16, $i)->getValue();
		    	$vkarma = $objWorksheet->getCellByColumnAndRow(17, $i)->getValue();
		        $KARMA = $objWorksheet->getCellByColumnAndRow(18, $i)->getValue();
		    	$PK1 = $objWorksheet->getCellByColumnAndRow(19, $i)->getValue();
		        $PK2 = $objWorksheet->getCellByColumnAndRow(20, $i)->getValue();
		    	$SWA1 = $objWorksheet->getCellByColumnAndRow(21, $i)->getValue();
		        $SWA2 = $objWorksheet->getCellByColumnAndRow(22, $i)->getValue();
		        $HEMATOLOGICAL = $objWorksheet->getCellByColumnAndRow(23, $i)->getValue();
		        $SEROLOGYCAL = $objWorksheet->getCellByColumnAndRow(24, $i)->getValue();
		        $BIOCHEMICAL = $objWorksheet->getCellByColumnAndRow(25, $i)->getValue();
		        $MICROBIOLOGICAL = $objWorksheet->getCellByColumnAndRow(26, $i)->getValue();
		        
		        $PATHO = $objWorksheet->getCellByColumnAndRow(27, $i)->getValue();
		        $PATHO2 = $objWorksheet->getCellByColumnAndRow(28, $i)->getValue();
		        $PATHO3 = $objWorksheet->getCellByColumnAndRow(29, $i)->getValue();
		        
		        $X_RAY = $objWorksheet->getCellByColumnAndRow(30, $i)->getValue();
		        $ECG = $objWorksheet->getCellByColumnAndRow(31, $i)->getValue();
		        $USG = $objWorksheet->getCellByColumnAndRow(32, $i)->getValue();
		        $naration = $objWorksheet->getCellByColumnAndRow(33, $i)->getValue();
		        
		         $symptoms = $objWorksheet->getCellByColumnAndRow(34, $i)->getValue();
		        $sym1 = $objWorksheet->getCellByColumnAndRow(35, $i)->getValue();
		        $sym2 = $objWorksheet->getCellByColumnAndRow(36, $i)->getValue();
		        $sym3 = $objWorksheet->getCellByColumnAndRow(37, $i)->getValue();
		            
		    //	$ipd_no9 = $objWorksheet->getCellByColumnAndRow(19, $i)->getValue();		
		//	$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
		//	$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			
		//	$date1=date('Y-m-d');
/*if($date1==$discharge_date){
	
	$discharge_date="0000-00-00";
}else{
	
	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
}*/


			$data['patient'] = (object)$postData = [
					    'dignosis'   => $dia,
						'department_id'	=> $deprt,	
						'ipd_opd' => $ipd_opd,
					    'RX1' => $RX1,
				     	'RX2' => $RX2,
						'RX3' => $RX3,
					
					    
						'SNEHAN' => $SNEHAN,					
						'SWEDAN'  => $SWEDAN,
						'VAMAN' => $VAMAN,
						'VIRECHAN' 	   => $VIRECHAN,
						'BASTI'  => $BASTI,
						'NASYA'      => $NASYA,
						
						'RAKTAMOKSHAN' 	   => $RAKTAMOKSHAN,
						
						'SHIRODHARA_SHIROBASTI'	=> $SHIRODHARA_SHIROBASTI,
						'OTHER'  => $OTHER,
						'skya'      => $skya,
						'skarma' 	   => $skarma,	
						'vkarma'	=> $vkarma,
						'KARMA'  => $KARMA,
						'PK1'  => $PK1,
					    'PK2'  => $PK2,
						'SWA1' => $SWA1,
						'SWA2' => $SWA2,	
						'HEMATOLOGICAL'	=> $HEMATOLOGICAL,
						'SEROLOGYCAL'	=> $SEROLOGYCAL,
						'BIOCHEMICAL'	=> $BIOCHEMICAL,
						'MICROBIOLOGICAL'	=> $MICROBIOLOGICAL,
						'PATHO'	=> $PATHO,
					    'PATHO2'	=> $PATHO2,
					    'PATHO3'	=> $PATHO3,
					    
					    'X_RAY'	=> $X_RAY,
					    'ECG'	=> $ECG,
					    'USG'	=> $USG,
					    'naration'	=> $naration,
					    
					     'symptoms'	=> $symptoms,
					    'sym1'	=> $sym1,
					    'sym2'	=> $sym1,
					    'sym3'	=> $sym1
					    
						
					
			];			

			$this->patient_model->create($postData);			
		}
		unlink('/'.$file_name); //File Deleted After uploading in database .			 
        redirect(base_url() . "patient");

		
	}
	
	public function import1()
	{
	    $dbHost = "localhost";
        $dbDatabase = "srpayurved_db";
        $dbPasswrod = "gJXdRod3AOlyp4c9";
        $dbUser = "srpayurved_db";
        $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
	    
		$configUpload['upload_path'] = FCPATH.'/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension=$upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true); 		  
		//Load excel file
		$objPHPExcel=$objReader->load(FCPATH.$file_name);		 
		$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		
		  $adress_def=array();
             $address = "SELECT * FROM address";
             $address1 = $mysqli->query($address);
	         while($address2=$address1->fetch_assoc()){
	        // $auto_on_off2['description']."<br>";
	           array_push($adress_def,$address2['name']);
	         }
		for($i=2;$i<=$totalrows;$i++)
		{

			$patient_id	 = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
		    $yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
	
			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
		   $ipd_no1 = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(16, $i)->getValue()));
			
	     $date1=date('Y-m-d');
            if($date1==$discharge_date){
	
	        $discharge_date='0000-00-00';
            }else{
	
         	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
            }
            
            $date1=date('Y-m-d');
            if($date1==$ipd_no1){
	
	        $ipd_no1=NULL;
            }else{
	
         	$ipd_no1=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(16, $i)->getValue()));
            }
		
		
		if(($sex=='M') && ($department_id !=32)){
                  
	              $occupation= array('Farmer','Office','Business','Driver','Labor','Jobless','Teacher','other');
	              $a=array(41,49,44,48,50,55,61,51,63,56,67);
              	
	         }
	         else if(($sex=='F') && ($department_id !=32)){
	              $occupation= array('Farmer','Office','Business','Driver','Labor','Jobless','Teacher','other');
	              $a=array(41,49,44,48,50,55,61,51,63,56,67);
	         }
	         else{
	              $occupation= array('Student');
	              $a=array(16, 18, 20, 22,14,11,13);
                  $key = array_rand($a);
	         }
	         
	         $c_o=$degis_id;
			 $h_o='NAD';
	         $f_o='NAD';
	         $bp=array('130/80','124/86','138/88','149/90','110/70','150/84','148/72','128/60','140/90');
	         $nadi=array('मंडूकगति', 'सर्पगती' , 'हंसगति','अविशेष');   
             $Pulse =array(76,78,88,90,68,72,82,66,74,92,64);
             $ur= 'अविशेष';
             $cvs ='S1S2 N';
             $udar='soft';
             $netra=array('आविल','अच्छ','इष्टपित')  ;
             $givwa=array('साम','निराम');
             $sudha=array('तीक्षाग','मंदाग  ','समाग्नी ','विषमाग्नी');  
            
             $ahar=array('प्रभत ','अल्प ','मध्यम');
             $mal=array('साम ','निराम ','कठीण ','दुर्गंधीयुक्त ','अविशेष');
             $mutra=array('पीत','आविल','दुर्गंधीयुक्त','अविशेष');
             $nidra=array('अविशेष','प्रभुत','अल्प');   
             
              $key = array_rand($a); 
	          $a[$key];
	          $key1 =array_rand($occupation);
	          $occupation[$key1];
	          $key2=array_rand($adress_def);
	          $adress_def[$key2];
	          
	          //$c_o1=array_rand($c_o);
	         // $c_o[$c_o1];
	          
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
			
		//	$date1=date('Y-m-d');
/*if($date1==$discharge_date){
	
	$discharge_date="0000-00-00";
}else{
	
	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
}*/


			$data['patient'] = (object)$postData = [
					    'patient_id'   => $patient_id,
						'yealry_number'	=> $yearly_no,	
						'CopddD_New' => $yearly_reg_no,
						'Daily' => $daily_reg_no,
						'Monthly' => $monthly_reg_no,
						'Copdd_Old' => $old_reg_no,
						//'Date' => $date,
						'NAME'    => $firstname,
					    
										
						'SEX' 		   => $sex,
						'AGE' => $date_of_birth,
						'Address' 	   => $address,
						'VIBHAG'  => $department_id,
						'NIDAN'      => $degis_id,
						'ipd_opd' 	   => $ipd_opd,
						'ipd_no'	=> $ipd_no,
						'discharge_date'  => $discharge_date,
						
						
						
						'occupation' =>  $occupation[$key1],
						'wieght' => $a[$key],
						'c_o'    => $degis_id,						
						'h_o' 		   => $h_o,
						'f_h' => $f_o,
						'nadi' 	   =>  $nadi[$nadi1],
						'pulse'  =>    $Pulse[$Pulse1],
						'shudha'      => $sudha[$sudha1],
						'mal' 	   => $mal[$mal1],	
						'nidra'	=>  $nidra[$nidra1],
						'bp'  => $bp[$bp1],
						
						'ur' => $ur,
						'givwa'    => $givwa[$givwa1],						
						'ahar' 		   =>  $ahar[$ahar1],
						'mutra' =>  $mutra[$mutra1],
						'udar' 	   => $udar,
						'cvs'  => $cvs,
						'netra'      => $netra[$netra1],
						'fol_up_date' => $ipd_no1 
					
						
			];			

			$this->patient_model->create($postData);			
		}
		unlink('/'.$file_name); //File Deleted After uploading in database .			 
        redirect(base_url() . "patient");

		
	}

	public function import()
	{
	    ini_set('max_execution_time', '600');
		$configUpload['upload_path'] = FCPATH.'/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension=$upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true); 		  
		//Load excel file
		$objPHPExcel=$objReader->load(FCPATH.$file_name);		 
		$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for($i=2;$i<=$totalrows;$i++)
		{

			$patient_id	 = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			
			$date1=date('Y-m-d');
if($date1==$discharge_date){
	
	$discharge_date="0000-00-00";
}else{
	
	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
}


			$data['patient'] = (object)$postData = [
						'Sno'   => $patient_id,
						'yealry_number'	=> $yearly_no,	
						'CopddD_New' => $yearly_reg_no,
						'Monthly' => $monthly_reg_no,
						'Daily' => $daily_reg_no,
						'Copdd_Old' => $old_reg_no,
						'Date' => $date,
						'NAME'    => $firstname,						
						'SEX' 		   => $sex,
						'AGE' => $date_of_birth,
						'Address' 	   => $address,
						'VIBHAG'  => $department_id,
						'NIDAN'      => $degis_id,
						'ipd_opd' 	   => $ipd_opd,	
						'ipd_no'	=> $ipd_no,
						'Dischargedate'  => $discharge_date
			];			

			$this->patient_model->create11($postData);			
		}
		unlink('/'.$file_name); //File Deleted After uploading in database .			 
        redirect(base_url() . "patient");

		
	}

	public function import_ipd()
	{
		$configUpload['upload_path'] = FCPATH.'/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension=$upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true); 		  
		//Load excel file
		$objPHPExcel=$objReader->load(FCPATH.$file_name);		 
		$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for($i=2;$i<=$totalrows;$i++)
		{

			$patient_id	 = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
		    //$discharge_date = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue();
			$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
			
			$date1=date('Y-m-d');
if($date1==$discharge_date){
	
	$discharge_date="0000-00-00";
}else{
	
	$discharge_date=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));
}
      /* if($discharge_date){
           $discharge_date1=$discharge_date;
       }else{
           $discharge_date1="0000-00-00";
       }
*/
			$data['patient'] = (object)$postData = [
						'patient_id'   => $patient_id,
						'yearly_no'	=> $yearly_no,	
						'yearly_reg_no' => $yearly_reg_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'old_reg_no' => $old_reg_no,
						'create_date' => $date,
						'firstname'    => $firstname,						
						'sex' 		   => $sex,
						'date_of_birth' => $date_of_birth,
						'address' 	   => $address,
						'department_id'  => $department_id,
						'dignosis'      => $degis_id,
						'ipd_opd' 	   => $ipd_opd,	
						'ipd_no'	=> $ipd_no,
						'discharge_date'  => $discharge_date
			];			

			$this->patient_model->create_ipd($postData);			
		}
		unlink('/'.$file_name); //File Deleted After uploading in database .			 
        redirect(base_url() . "patient");

		
	}

    /*public function check_patient($mode = null)
    {
		$year = '%'.$this->session->userdata['acyear'].'%';
        	$old_reg_no = $this->input->post('old_reg_no');	
        	$old_reg_no_like = '%'.$this->input->post('old_reg_no').'%';	
		
        if (!empty($old_reg_no)) {
            $query = $this->db->select('*')
                ->from('patient')
                ->where('yearly_reg_no', $old_reg_no)
                ->or_where('firstname Like', $old_reg_no_like)
				->where('create_date Like',$year)
				->where('status',1)
                ->get();
				// ->result();
				//print_r(get());	
                 $result = $query->row();
                  $result->status;
            if ($result->status ==1) {
                //$data['patient1'] = $result->status;
                $data['patient'] = $result;
                $data['status'] = true;
            } else {
                $data['message'] = "Invalid yearly number";
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invlid_input');
            $data['status'] = null;
        }

        //return data
        if ($mode === true) {
            return json_encode($data);
        } else {
            echo json_encode($data);
        }

	}*/
    
    public function check_patient($mode = null)
    {
		//$year = '%'.$this->session->userdata['acyear'].'%';
        	$old_reg_no = $this->input->post('old_reg_no');	
        	$acyear = $this->input->post('acyear');
        	$old_reg_no_like = '%'.$this->input->post('old_reg_no').'%';	
		
        if (!empty($old_reg_no)) {
            $query = $this->db->select('*')
                ->from('patient')
                ->where('year(create_date)', $acyear)
                ->where('yearly_reg_no', $old_reg_no)
                ->or_where('firstname Like', $old_reg_no_like)
				->where('status',1)
                ->get();
				// ->result();
				//print_r(get());	
                 $result = $query->row();
                  $result->status;
               
            if ($result->status ==1) {
                //$data['patient1'] = $result->status;
                $data['patient'] = $result;
                $data['status'] = true;
                
            } else {
                $data['message'] = "Invalid yearly number";
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invlid_input');
            $data['status'] = null;
        }

        //return data
        if ($mode === true) {
            return json_encode($data);
        } else {
            echo json_encode($data);
        }

	}
	
	public function createPagePatientsData()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));
		
		//print_r($start_date2);
		//exit;

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
      
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date2);
       $date2=date_create($end_date2);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

	

        if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		->get()

		->result();
            
      
		$data['department_by_section'] ='opd';  
         }
         else
         {

        $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', 'ipd')
		->or_where('discharge_date', $start_date)

		->where('ipd_opd', 'ipd')

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date)

		->where('discharge_date LIKE', '%0000-00-00%')

	    ->where('ipd_opd', 'ipd')

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
    	//$data['patients'] = $data['patients2'];
      
          $data['department_by_section'] ='ipd';         
         }
	//	print_r($data['patients']);exit;
	
	    /* $data['ipdcountdater'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		 ->where('yearly_reg_no !=', '')
		 ->where('patient.sex', 'M')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
	     ->where('create_date >=', $start_date)
        
		->where('create_date <=', $end_date)
		->group_by('patient.department_id')
		->get()
		->result();
		
		$dept=$this->db->select("*")
                               ->from('department')
                               ->order_by('dprt_id','desc')
                               ->get()
                               ->result_array();
		$i=0;
		foreach( $data['ipdcountdater']  as $date){
		    if($dept[$i]['id']==$date->department_id){
		         echo $date->Total.'\n';
		    }else{
		    echo '0\n';
		    }
		    $i++;
		}

        echo count($data['ipdcountdater']);exit;*/
	        $data['serial_no'] ='1'; 
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list(); 
			$data['department_list'] = $this->department_model->department_list();
		    $data['address_list'] = $this->department_model->address_list();
		    
		    $data['beds'] = $this->bed_model->read();
		    
// 			$data['content'] = $this->load->view('patient_form',$data,true);
// 			$this->load->view('layout/main_wrapper',$data);
			
		if($data == null){
			$data['content'] = $this->load->view('patient_form',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient_form',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
		
	}
	
    public function patient_by_date()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
      
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date2);
       $date2=date_create($end_date2);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

	

        if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		->get()

		->result();
            
      
		$data['department_by_section'] ='opd';  
         }
         else
         {

        $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', 'ipd')
		->or_where('discharge_date', $start_date)

		->where('ipd_opd', 'ipd')

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date)

		->where('discharge_date LIKE', '%0000-00-00%')

	    ->where('ipd_opd', 'ipd')

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
          $data['department_by_section'] ='ipd';         
         }
	//	print_r($data['patients']);exit;
	
	    /* $data['ipdcountdater'] = $this->db->select('department.name,patient.department_id, patient.create_date as Date, COUNT(*) as Total, COUNT(patient.old_reg_no) as Patientoldcount, COUNT(patient.yearly_reg_no) as Patientnewcount, COUNT(patient.create_date) as datecount')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		 ->where('yearly_reg_no !=', '')
		 ->where('patient.sex', 'M')
		->where('patient.ipd_opd', $section)
		->where('create_date LIKE', $year)
	     ->where('create_date >=', $start_date)
        
		->where('create_date <=', $end_date)
		->group_by('patient.department_id')
		->get()
		->result();
		
		$dept=$this->db->select("*")
                               ->from('department')
                               ->order_by('dprt_id','desc')
                               ->get()
                               ->result_array();
		$i=0;
		foreach( $data['ipdcountdater']  as $date){
		    if($dept[$i]['id']==$date->department_id){
		         echo $date->Total.'\n';
		    }else{
		    echo '0\n';
		    }
		    $i++;
		}

        echo count($data['ipdcountdater']);exit;*/
	
		if($data == null){
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
		
	}	
	
	public function patient_by_date_occupancy()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

         $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
      // $start_date=$start_date1." 00:00:00";
      // $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		//echo $section;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
        // echo count($data['patients']); exit;

		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', ' patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
	    ->group_by('department.name, patient.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT( patient.sex) as totalGender, COUNT( patient.yearly_reg_no) as totalNew, COUNT( patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();
			$data['department_by_section'] ='opd';  
         }
         else
         {
             

          $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)
       
		->where('create_date <=', $end_date)
	   

		 ->where('ipd_opd', 'ipd')
	   
   
		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
	   
		->where('create_date <=', $end_date)
	

		->where('discharge_date LIKE', '%0000-00-00%')

	    ->where('ipd_opd', 'ipd')

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
      
		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
	    // ->where('create_date >=', $start_date)
	    //->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('create_date >=', $start_date)
		//->where('discharge_date LIKE', '0000-00-00')
        // ->or_where('discharge_date LIKE',$end_date1)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();
            
            	$data['department_by_section'] ='ipd';         
         }
		
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
		
	}	
	
	public function bed_occupancy()
	{
//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);

      
		$start_date2 = date('Y-m-d');

		$end_date2   = date('Y-m-d');

		//$section = $this->input->get('section', TRUE);

       

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
	   $data['gendercount'] = $this->db->select('department_id, sum(m_n) as MN, sum(m_o) as MO, sum(f_n) as FN, sum(f_o) as FO, sum(t_t) as TT')
	      ->from('bed_occupancy')
		//->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
	     ->where('ipd_opd', 'ipd')
	    ->group_by('department_id')
	    ->order_by("department_id", "DESC")

		->get()
		->result();
		
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		//print_r($data['gendercount']);
			$data['content'] = $this->load->view('patient_bed',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
	}
	
	public function panchkarma_ipd()
	{
//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);

      
		$start_date2 = date('Y-m-d');

		$end_date2   = date('Y-m-d');

		//$section = $this->input->get('section', TRUE);

       

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
	   $data['gendercount'] = $this->db->select('name, sum(number) as total')
	      ->from('panch_ipd')
		//->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
	    ->where('ipd_opd', 'ipd')
	    ->group_by('name')
	    //->order_by("department_id", "DESC")

		->get()
		->result();
		
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		//print_r($data['gendercount']);
			$data['content'] = $this->load->view('panchkarma_ipd',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
	}
	
	public function panchkarma_ipd_date()
	{
//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);

      
		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		//$section = $this->input->get('section', TRUE);

       

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
	   $data['gendercount'] = $this->db->select('name, sum(number) as total')
	      ->from('panch_ipd')
		//->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
	    ->where('ipd_opd', 'ipd')
	    ->group_by('order_name')
	    //->order_by("department_id", "DESC")

		->get()
		->result();
		
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		//print_r($data['gendercount']);
			$data['content'] = $this->load->view('panchkarma_ipd',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
	}
	
	public function bed_occupancy_date()
	{
//SELECT sum(m_n) FROM `bed_occupancy` WHERE create_date >='2020-01-01 00:00:00' and create_date <='2020-01-01' GROUP BY department_id ORDER BY department_id DESC
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);

      
		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		//$section = $this->input->get('section', TRUE);

       

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        
	   $data['gendercount'] = $this->db->select('department_id, sum(m_n) as MN, sum(m_o) as MO, sum(f_n) as FN, sum(f_o) as FO, sum(t_t) as TT')
	      ->from('bed_occupancy')
		//->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
        ->where('ipd_opd', 'ipd')
	    ->group_by('department_id')
	    ->order_by("department_id", "DESC")

		->get()
		->result();
		
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		
		//print_r($data['gendercount']);
			$data['content'] = $this->load->view('patient_bed',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
	}
	
	public function patient_by_date_occupancy11111()
	{ 
       echo error_reporting(0);
       ini_set('memory_limit','-1');
		$year = '%'.$this->session->userdata['acyear'].'%';
	    $login_year = $this->session->userdata['acyear'];
	    $next_year=$login_year + 1;

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
      //$array_push=array('2019-02-15');
       
       $period = new DatePeriod(
     new DateTime($login_year.'-01-01'),
     new DateInterval('P1D'),
     new DateTime($next_year.'-01-01')
);
$array_push=array();
foreach ($period as $key => $value) {
    
     $value->format('Y-m-d');  
   /* echo "<br>";*/
    array_push($array_push, $value->format('Y-m-d'));
}
      //array_push($array_push,'2019-12-31');
     // echo '2019-12-31';
     // echo "<br>";
     // echo "<br>";
      
      $jan1=0; $feb1=0; $march1=0;$april1=0;$may1=0;$june1=0;$jully1=0;$aguest1=0;$sebt1=0;$octo1=0;$nove1=0;$desm1=0; $tot_sum=0; $tot_sum1=0;
      
      $k1=0;$k2=0;$k3=0;$k4=0;$k5=0;$k6=0;$k7=0;$k8=0;$k9=0;$k10=0;$k11=0;$k12=0;
      
      $pn1=0;$p2=0;$p3=0;$p4=0;$p5=0;$p6=0;$p7=0;$p8=0;$p9=0;$p10=0;$p11=0;$p12=0;
      
      $sl1=0;$sl2=0;$sl3=0;$sl4=0;$sl5=0;$sl6=0;$sl7=0;$sl8=0;$sl9=0;$sl10=0;$sl11=0;$sl12=0;
      
      $sk1=0;$sk2=0;$sk3=0;$sk4=0;$sk5=0;$sk6=0;$sk7=0;$sk8=0;$sk9=0;$sk10=0;$sk11=0;$sk12=0;
      
      $st1=0;$st2=0;$st3=0;$st4=0; $st5=0;$st6=0;$st7=0;$st8=0;$st9=0;$st10=0;$st11=0;$st12=0;
      
      $b1=0;$b2=0;$b3=0;$b4=0;$b5=0;$b6=0;$b7=0;$b8=0;$b9=0;$b10=0;$b11=0;$b12=0;
      
      
      
      for($i=0;$i<count($array_push);$i++){
      
		$start_date2 = date('Y-m-d',strtotime($array_push[$i]));

		$end_date2   = date('Y-m-d',strtotime($array_push[$i]));

		$section = 'ipd';

         $start_date= $start_date2." 00:00:00";
		 $start_date_f= $start_date2." 23:59:00";
         $end_date= $end_date2." 23:59:00";
      // $start_date=$start_date1." 00:00:00";
      // $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		//echo $section;
         $month=date('m',strtotime($end_date));
        
        
         $patients1 = $this->db->select("create_date as datee,COUNT(*) as Total,department.dprt_id as name")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)
        ->group_by('department.dprt_id')
		->where('create_date <=', $end_date)
	   

		->where('ipd_opd', $section)
	//	->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
   //	print_r($patients1);
        $patients12=0; $p1=0;
       
      for($n=0;$n<count($patients1);$n++){
      //echo $patients1[$n]->Total;
    //  echo "<br>";

 
 
	      

		//Array 2
		$patients2 = $this->db->select("COUNT(*) as Total,department.dprt_id as name")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')
	   
		->where('create_date <=', $end_date)
	     ->group_by('department.dprt_id')

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', 'ipd')

		->get()

		->result();

         if($patients2[$n]){
            $pp1 += $patients2[$n]->Total;
         }else{
             $pp1=0;
         }
         //echo $end_date; echo "  ";
        
    	$patients12 += $patients1[$n]->Total + $pp1;
    
        //echo $patients1[$n]->name;
        if($patients1[$n]->name==34)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $k +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $k1 +=$patients1[$n]->Total + $ss;} else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $k2 +=$patients1[$n]->Total + $ss;}
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $k3 +=$patients1[$n]->Total + $ss;} else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss;  $k4 +=$patients1[$n]->Total + $ss;}
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $k5 +=$patients1[$n]->Total + $ss;}else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $k6 +=$patients1[$n]->Total + $ss;}
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $k7 +=$patients1[$n]->Total + $ss;} else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $k8 +=$patients1[$n]->Total + $ss;}
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $k9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss;  $k10 +=$patients1[$n]->Total + $ss;}
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $k11 +=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $k12 +=$patients1[$n]->Total + $ss;}
        }
        
        if($patients1[$n]->name==33)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $p +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $pn1 +=$patients1[$n]->Total + $ss; } else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $p2 +=$patients1[$n]->Total + $ss; }
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $p3 +=$patients1[$n]->Total + $ss;} else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $p4 +=$patients1[$n]->Total + $ss; }
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $p5 +=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $p6 +=$patients1[$n]->Total + $ss; }
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $p7 +=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $p8 +=$patients1[$n]->Total + $ss; }
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $p9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $p10 +=$patients1[$n]->Total + $ss; }
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $p11 +=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $p12 +=$patients1[$n]->Total + $ss; }
        }
        if($patients1[$n]->name==32)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
            $b +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $b1 +=$patients1[$n]->Total + $ss; } else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $b2 +=$patients1[$n]->Total + $ss; }
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $b3 +=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $b4 +=$patients1[$n]->Total + $ss; }
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $b5 +=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $b6 +=$patients1[$n]->Total + $ss; }
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $b7 +=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $b8 +=$patients1[$n]->Total + $ss; }
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $b9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $b10 +=$patients1[$n]->Total + $ss; }
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $b11 +=$patients1[$n]->Total + $ss;  }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $b12 +=$patients1[$n]->Total + $ss;  }
        }
        if($patients1[$n]->name==31)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $sl +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $sl1 +=$patients1[$n]->Total + $ss;} else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $sl2 +=$patients1[$n]->Total + $ss;}
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $sl3 +=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $sl4 +=$patients1[$n]->Total + $ss;}
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $sl5 +=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $sl6 +=$patients1[$n]->Total + $ss;}
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $sl7 +=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $sl8 +=$patients1[$n]->Total + $ss;}
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $sl9 +=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $sl10 +=$patients1[$n]->Total + $ss;}
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $sl11 +=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $sl12 +=$patients1[$n]->Total + $ss;}
        }
        if($patients1[$n]->name==30)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $sk +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $sk1+=$patients1[$n]->Total + $ss; } else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $sk2+=$patients1[$n]->Total + $ss;}
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $sk3+=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $sk4+=$patients1[$n]->Total + $ss;}
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $sk5+=$patients1[$n]->Total + $ss;}else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $sk6+=$patients1[$n]->Total + $ss;}
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $sk7+=$patients1[$n]->Total + $ss;} else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $sk8+=$patients1[$n]->Total + $ss;}
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $sk9+=$patients1[$n]->Total + $ss;} else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss; $sk10+=$patients1[$n]->Total + $ss;}
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $sk11+=$patients1[$n]->Total + $ss;}else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $sk12+=$patients1[$n]->Total + $ss;}
        }
        if($patients1[$n]->name==29)
        {   if($patients2[$n]){
            $ss=$patients2[$n]->Total;
        }else{
            $ss=0;
        }
             $st +=$patients1[$n]->Total + $ss;
             if($month=='01'){  $jan1 +=$patients1[$n]->Total + $ss; $st1+=$patients1[$n]->Total + $ss;} else if($month=='02'){  $feb1 +=$patients1[$n]->Total + $ss; $st2+=$patients1[$n]->Total + $ss; }
             else if($month=='03'){  $march1 +=$patients1[$n]->Total + $ss; $st3+=$patients1[$n]->Total + $ss; } else if($month=='04'){  $april1 +=$patients1[$n]->Total + $ss; $st4+=$patients1[$n]->Total + $ss; }
             else if($month=='05'){  $may1 +=$patients1[$n]->Total + $ss; $st5+=$patients1[$n]->Total + $ss; }else if($month=='06'){  $june1 +=$patients1[$n]->Total + $ss; $st6+=$patients1[$n]->Total + $ss; }
              if($month=='07'){  $jully1 +=$patients1[$n]->Total + $ss; $st7+=$patients1[$n]->Total + $ss; } else if($month=='08'){  $aguest1 +=$patients1[$n]->Total + $ss; $st8+=$patients1[$n]->Total + $ss; }
             else if($month=='09'){  $sebt1 +=$patients1[$n]->Total + $ss; $st9+=$patients1[$n]->Total + $ss; } else if($month=='10'){  $octo1 +=$patients1[$n]->Total + $ss;  $st10+=$patients1[$n]->Total + $ss; }
             else if($month=='11'){  $nove1 +=$patients1[$n]->Total + $ss; $st11+=$patients1[$n]->Total + $ss; }else if($month=='12'){  $desm1 +=$patients1[$n]->Total + $ss; $st12+=$patients1[$n]->Total + $ss; }
        }
        
    
	}
		//echo $end_date;	echo " ";	echo $patients12;	echo " ";
	//	echo $k;echo " ";echo $p;	echo " "; echo $b;echo " ";echo $sl;echo " ";	echo $sk;echo " ";echo $st;
	    
      }
     /* echo "<br>";
     echo $k1;echo " ";	echo $k2;  echo " ";	echo $k3;echo " ";	echo $k4; echo " ";	echo $k5;echo " ";	echo $k6;  echo " ";	echo $k7;echo " ";	echo $k8; 
     echo " ";	echo $k9;echo " ";	echo $k10;  echo " ";	echo $k11;echo " ";	echo $k12;*/
     $b1;
     
       $data['jan'] =array('0',$st1,$sk1,$sl1,$b1,$pn1,$k1,'0');
       $data['feb'] =array('0',$st2,$sk2,$sl2,$b2,$p2,$k2,'0');
       $data['march'] =array('0',$st3,$sk3,$sl3,$b3,$p3,$k3,'0');
       $data['april'] =array('0',$st4,$sk4,$sl4,$b4,$p4,$k4,'0');
       $data['may']=array('0',$st5,$sk5,$sl5,$b5,$p5,$k5,'0');
       
       $data['june'] =array('0',$st6,$sk6,$sl6,$b6,$p6,$k6,'0');
       $data['jully'] =array('0',$st7,$sk7,$sl7,$b7,$p7,$k7,'0');
       $data['aguest'] =array('0',$st8,$sk8,$sl8,$b8,$p8,$k8,'0');
       $data['sebt'] =array('0',$st9,$sk9,$sl9,$b9,$p9,$k9,'0');
       $data['octo'] =array('0',$st10,$sk10,$sl10,$b10,$p10,$k10,'0');
       $data['nove'] =array('0',$st11,$sk11,$sl11,$b11,$p11,$k11,'0');
       $data['desm'] =array('0',$st12,$sk12,$sl12,$b12,$p12,$k12,'0');
       
     
     
     
     
     
   
	/*echo  $jan1; echo " ";	echo  $feb1; echo " ";	echo " ";	echo $march1; echo " ";	echo  $april1;echo " ";	echo $may1;echo " ";	echo $june1;
	echo " ";	echo $jully1; echo " ";	echo  $aguest1; echo " ";	echo $sebt1; echo " ";	echo  $octo1; echo " ";	echo $nove1; echo " "; echo $desm1;*/


	
 
		
            
        $data['department']=$this->patient_model->get_all_dept();
      
		$data['datefrom'] = '2018';
		$data['dateto'] = '2018';
       
        $data['month_bed'] = 'month_bed';
    
      
       
		$data['content'] = $this->load->view('patient_month_report',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
		
		
	}	
	
	public function getpatientbydepartment_karma_date()
	{
      

        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	   // $id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

	    $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
       
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date_karma($section,$start_date,$end_date);
	    //print_rdata['patients']); exit;
	   $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){

		 $data['department_by_section'] = 'opd';
      }
      else{
        
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        $data['department_id'] = '';
       
		$data['content'] = $this->load->view('patient_karma',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_investigation_date()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    //$id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
        $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		
		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section='opd',$start_date,$end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->group_by('department.name, patient.sex')
		->get()
		->result();
		

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
	   // ->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('patient_investi',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_investigation_date_ecg()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    //$id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
        $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='0';
        }

		
		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section='opd',$start_date,$end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->group_by('department.name, patient.sex')
		->get()
		->result();
		

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
	   // ->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		//->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('patient_investi_ecg',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_investigation_date_xay()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    //$id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
        $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='0';
        }

		
		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section='opd',$start_date,$end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
	
		

	
		 $data['department_by_section'] = 'opd';
      }
      else{
          
         

	
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('patient_investi_xray',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_investigation_ceg()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
	    
	    $start_date1 = date('Y-m-d',strtotime($start_date1));
     	$end_date1   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='0';
        }

		
		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section='opd',$start_date,$end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('patient_investi_ecg',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function Geriatric()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
	    
	    if($start_date1){
	    
	    $start_date1 = date('Y-m-d',strtotime($start_date1));
     	$end_date1   = date('Y-m-d',strtotime($end_date1));
	    }else{
	        $start_date1 = date('Y-m-d');
     	    $end_date1   = date('Y-m-d');
	        
	    }
		$section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section='opdd',$start_date,$end_date);


		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('Geriatric',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function Skin()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
	    
	    if($start_date1){
	    
	    $start_date1 = date('Y-m-d',strtotime($start_date1));
     	$end_date1   = date('Y-m-d',strtotime($end_date1));
	    }else{
	        $start_date1 = date('Y-m-d');
     	    $end_date1   = date('Y-m-d');
	        
	    }
		$section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section='opdd',$start_date,$end_date);


		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('Skin',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function National()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
	    
	    if($start_date1){
	    
	    $start_date1 = date('Y-m-d',strtotime($start_date1));
     	$end_date1   = date('Y-m-d',strtotime($end_date1));
	    }else{
	        $start_date1 = date('Y-m-d');
     	    $end_date1   = date('Y-m-d');
	        
	    }
		$section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section='opdd',$start_date,$end_date);


		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('National',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function Manas()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
	    
	    if($start_date1){
	    
	    $start_date1 = date('Y-m-d',strtotime($start_date1));
     	$end_date1   = date('Y-m-d',strtotime($end_date1));
	    }else{
	        $start_date1 = date('Y-m-d');
     	    $end_date1   = date('Y-m-d');
	        
	    }
		$section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_investi_date($section='opdd',$start_date,$end_date);


		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('Manas',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_investigation_xray()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
	    
	    $start_date1 = date('Y-m-d',strtotime($start_date1));
     	$end_date1   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
       $date1=date_create($start_date1);
       $date2=date_create($end_date1);
       $diff=date_diff($date1,$date2);
       $diff=$diff->format("%a");
        if($diff==0){
		 $data['summery_report']='0';
        }else{
         $data['summery_report']='1';
        }

		
		$data['title'] = display('patient_list');
		$data['patients1'] = $this->patient_model->read_by_investi_date($section='opd',$start_date,$end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		$data['patients'] =array_merge($data['patients1'],$data['patients2']);

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        //$data['department_id'] = $id;
       
		$data['content'] = $this->load->view('patient_investi_xray',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientbydepartment_date()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    $id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section,$start_date,$end_date);
		
		

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->group_by('department.name, patient.sex')
		->get()
		->result();
		

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
	    ->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        $data['department_id'] = $id;
        $data['getpatientbydepartment_date'] = 'D';
       
		$data['content'] = $this->load->view('patient',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

    public function getpatientbydepartment_admit_register_date()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    $id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_admit_register_date($id, $section,$start_date,$end_date);
		
		

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
	
		 $data['department_by_section'] = 'opd';
      }
      else{
          
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        $data['department_id'] = $id;
        $data['getpatientbydepartment_date'] = 'D';
       
		$data['content'] = $this->load->view('patient_amit_register',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

    public function getpatientbydepartment_date_sky()
	{


        $year = '%'.$this->session->userdata['acyear'].'%';

		 $start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
	    $id   = $this->input->get('dept_id', TRUE);
	  

		$start_date1 = date('Y-m-d',strtotime($start_date1));

		$end_date1   = date('Y-m-d',strtotime($end_date1));

		 $section = $this->input->get('section', TRUE);

       
        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id_date($id, $section,$start_date,$end_date);
		
		

		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';

      if($section =='opd'){
		$data['gendercount'] = $this->db->select('department.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->group_by('department.name, patient.sex')
		->get()
		->result();
		

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		->where('create_date LIKE', $year)
	    ->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'opd';
      }
      else{
          
          $data['gendercount'] = $this->db->select('department.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	    //->where('create_date >=', $end_date)

	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      }
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
        $data['department_by'] = 'dpt';
        $data['department_id'] = $id;
       
		$data['content'] = $this->load->view('patient_sky',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

	public function dischargedate($discharge_date, $yearly_reg_no )
	{

		$year = '%'.$this->session->userdata['acyear'].'%';
		$section = 'ipd';

		$q = $this->db->select('*')
		->from('patient')
		->where('yearly_reg_no', $yearly_reg_no)
		->where('ipd_opd', $section)
		->or_where('old_reg_no', $yearly_reg_no)->get()->result();

		$registration1 = $q[0]->old_reg_no;
		$registration2 = $q[0]->yearly_reg_no;

		//Check registration value
		if($registration2 != null){

			
			$data = array( 
				'discharge_date'	=>  $discharge_date,		
			);	

			$this->db->where('yearly_reg_no', $registration2);
			$this->db->where('ipd_opd', $section);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);

			print_r($registration2);

		}else{

			//$registration = $registration1;			
			$data = array( 
				'discharge_date'	=>  $discharge_date,		
			);	

			$this->db->where('old_reg_no', $registration1);
			$this->db->where('ipd_opd', $section);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);

			print_r($registration1);
		
		}		

	}

	// public function admitpatient(){

	// 	$year = '%'.$this->session->userdata['acyear'].'%';
	// 	$section = 'ipd';
	// 	$date = "";

	// 	$data['patients1'] = $this->db->select('*')
	// 	->from('patient')
	// 	->join('department','department.dprt_id = patient.department_id')
	// 	->where('ipd_opd', $section)
	// 	->where('discharge_date IS NULL')
	// 	->where('create_date LIKE', $year)->get()->result();

		
	// 	$data['patients2'] = $this->db->select('*')
	// 	->from('patient')
	// 	->join('department','department.dprt_id = patient.department_id')
	// 	->where('ipd_opd', $section)
	// 	->where('create_date LIKE', $year)
	// 	->where('discharge_date', $date)->get()->result();

	// 	$data['patients'] = array_merge($data['patients1'], $data['patients2']);

	// 	//print_r($data);

	// 	//$data['patients'] = $this->patient_model->read();
	// 	$data['department_list'] = $this->department_model->department_list(); 
	// 	$data['content'] = $this->load->view('patient',$data,true);	
	// 	$this->load->view('layout/main_wrapper',$data);

	// }

    public function admitpatient()
    {

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

	   $end_date1   = $this->input->get('end_date', TRUE);

		$date = "";
		$start=date('Y-m-d',strtotime("+ 5 days"));
		$end=date('Y-m-d',strtotime("+ 5 days"));

		$start_date = date('Y-m-d',strtotime($start_date1))." 00:00:00";

		$end_date   = date('Y-m-d',strtotime($end_date1))." 23:59:00";

		$section = $this->input->get('section', TRUE);

		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));

		$data['patients'] = $this->db->select('*')
		->from('patient_ipd')
		->join('department','department.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		//->where('discharge_date IS NULL')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)->get()->result();

	//	print_r($data['patients']); exit;
		// $data['patients2'] = $this->db->select('*')
		// ->from('patient')
		// ->join('department','department.dprt_id = patient.department_id')
		// ->where('ipd_opd', $section)
		// ->where('create_date >=', $start_date)
		// ->where('create_date <=', $end_date)
		// ->where('create_date LIKE', $year)->get()->result();

		// $data['patients'] = array_merge($data['patients1'], $data['patients2']);

		//print_r($data);

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();

		//$data['patients'] = $this->patient_model->read();
		$data['department_list'] = $this->department_model->department_list(); 
		$data['content'] = $this->load->view('admitpatient',$data,true);	
		$this->load->view('layout/main_wrapper',$data);


	}

	// Admit Patient Date Filter

	public function admitpatientdate()
	{

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

	   $end_date1   = $this->input->get('end_date', TRUE);

		$date = "";
		$start=date('Y-m-d',strtotime($start_date1));
		$end=date('Y-m-d',strtotime($end_date1));

		$start_date = date('Y-m-d',strtotime($start_date1))." 00:00:00";

		$end_date   = date('Y-m-d',strtotime($end_date1))." 23:59:00";

		$section = $this->input->get('section', TRUE);

		$data['datefrom'] = $start;
		$data['dateto'] = $end;

		$data['patients'] = $this->db->select('*')
		->from('patient_ipd')
		->join('department','department.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		//->where('discharge_date IS NULL')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)->get()->result();

	//	print_r($data['patients']); exit;
		// $data['patients2'] = $this->db->select('*')
		// ->from('patient')
		// ->join('department','department.dprt_id = patient.department_id')
		// ->where('ipd_opd', $section)
		// ->where('create_date >=', $start_date)
		// ->where('create_date <=', $end_date)
		// ->where('create_date LIKE', $year)->get()->result();

		// $data['patients'] = array_merge($data['patients1'], $data['patients2']);

		//print_r($data);

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();

		//$data['patients'] = $this->patient_model->read();
		$data['department_list'] = $this->department_model->department_list(); 
		$data['content'] = $this->load->view('admitpatient',$data,true);	
		$this->load->view('layout/main_wrapper',$data);

	}

    //Discharge Patient Date 
	public function patientdischargedate()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
  
    	
		
		$start_date = date('Y-m-d',strtotime("+ 5 days"));

		$end_date   = date('Y-m-d',strtotime("+ 5 days"));
		
		$start_date12 = $start_date." 00:00:00";

		$end_date12   = $end_date." 23:59:00";

		//$section = $this->input->get('section', TRUE);

        $section ='ipd';
	    $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));


		//echo $section;

		$data['patients'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('ipd_opd', $section)
	
		->where('discharge_date >=', $start_date12)

		->where('discharge_date <=', $end_date12)

	   //->where('create_date LIKE', $year)

		->get()

		->result();

     // print_r($data['patients']); exit;
		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('create_date LIKE', $year)
		->where('discharge_date >=', $start_date)
		->where('discharge_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('discharge_date >=', $start_date)
		->where('discharge_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();

		
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('patientdischargedate',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientdischargedate',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}

	public function patientdischargebydate()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);
  
    	
		
		$start_date = date('Y-m-d',strtotime($start_date1));

		$end_date   = date('Y-m-d',strtotime($end_date1));
		
		$start_date12 = $start_date;

		$end_date12   = $end_date;

		//$section = $this->input->get('section', TRUE);

        $section ='ipd';
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;


		//echo $section;

		$data['patients'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('ipd_opd', $section)
	
		->where('discharge_date >=', $start_date12)

		->where('discharge_date <=', $end_date12)

	   //->where('create_date LIKE', $year)

		->get()

		->result();

     
	
		if($data == null){
			$data['content'] = $this->load->view('patientdischargedate',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientdischargedate',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}

	//Occupancy Patient Date 
	public function patientoccupancy()
	{ 
	    
	    
    	//$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1   = $this->input->get('end_date', TRUE);
        $end_date   = date('Y-m-d',strtotime($end_date1));
		$year = '%'.$this->session->userdata['acyear'].'%';
		$section = 'ipd';

	   $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));


		//echo $section;
        if($end_date1){
		$data['patients'] = $this->db->select("*")
		->from('patient_ipd')
		->where('create_date <=', $end_date)
		->join('department','department.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
	//	->where('discharge_date LIKE', '0000-00-00')
		//->where('discharge_date IS NULL',  null)
	//	->where('create_date LIKE', $year)
		->get()
		->result();

	    // print_r($data['patients']);   exit;
       

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->where('create_date <=', $end_date)
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('discharge_date LIKE', '0000-00-00')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date <=', $end_date)
		->where('discharge_date LIKE', '0000-00-00')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
        } else{
           
        $data['patients'] = $this->db->select("*")
		->from('patient_ipd')		
		->join('department','department.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		
    //	->where('discharge_date is NULL', NULL, TRUE)
		->where('discharge_date LIKE', '0000-00-00')
		//->where('create_date LIKE', $year)
		->get()
		->result();


		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('discharge_date LIKE', '0000-00-00')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('discharge_date LIKE', '0000-00-00')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->get()
		->result();
        }
		
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}

	public function patientoccupancybydate11()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));
		
	    $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";

		$section = $this->input->get('section', TRUE);


		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

		$null = NULL;

		//echo $section;

		$data['patients1'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id = patient.department_id')

	//	->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '%0000-00-00%')
	//	->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient')
		
		->join('department','department.dprt_id = patient.department_id')

	    //->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		//->where('discharge_date =', NULL)
		->where('discharge_date LIKE', '0000-00-00')

		->where('ipd_opd', $section)

		->get()

		->result();


		$data['patients'] = array_merge($data['patients1'], $data['patients2']);


		//Count Array 

		$data['gendercount'] = $this->db->select('department.name,patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department', 'patient.department_id = department.dprt_id')
	
		// ->where('discharge_date >=', $start_date)
	    //	->where('discharge_date =', NULL)
	//	->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
		->where('discharge_date LIKE', '0000-00-00')
		->where('ipd_opd', $section)
		->where('create_date LIKE', $year)
		->group_by('department.name, patient.sex')
		->get()
		->result();

		// $data['gendercount2'] = $this->db->select('department.name,patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		// ->from('patient')
		// ->join('department', 'patient.department_id = department.dprt_id')
		// ->where('ipd_opd', $section)
		// ->where('discharge_date >=', $start_date)
		// ->where('create_date <=', $start_date)
		// // ->or_where('discharge_date =', NULL)
		// ->where('create_date LIKE', $year)
		// ->group_by('department.name, patient.sex')
		// ->get()
		// ->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient.sex) as totalGender, COUNT(patient.yearly_reg_no) as totalNew, COUNT(patient.old_reg_no) as totalold')
		->from('patient')
		
		//->where('discharge_date =', NULL)
	//	->where('create_date >=', $start_date)
        ->where('create_date <=', $end_date)
		->where('discharge_date LIKE', '0000-00-00')
		->where('ipd_opd', $section)
		// ->or_where('discharge_date =', NULL)
		->where('create_date LIKE', $year)
		->get()
		->result();

		// print_r($data['patients']);
		// die();
		
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	
	public function patientoccupancybydate()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));
		
		$start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";

		$section = $this->input->get('section', TRUE);


		$data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;

		$null = NULL;

		//echo $section;

		$data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', $section)
	//	->or_where('discharge_date', $start_date)

	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date_f)

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', $section)

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);


		//Count Array 

		$data['gendercount'] = $this->db->select('department.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department', 'patient_ipd.department_id = department.dprt_id')
		->where('ipd_opd', $section)
		// ->where('discharge_date >=', $start_date)
		->where('discharge_date =', '0000-00-00')
		->where('create_date <=', $start_date)
		// ->or_where('discharge_date =', NULL)
		->where('create_date LIKE', $year)
		->group_by('department.name, patient_ipd.sex')
		->get()
		->result();

		// $data['gendercount2'] = $this->db->select('department.name,patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		// ->from('patient')
		// ->join('department', 'patient.department_id = department.dprt_id')
		// ->where('ipd_opd', $section)
		// ->where('discharge_date >=', $start_date)
		// ->where('create_date <=', $start_date)
		// // ->or_where('discharge_date =', NULL)
		// ->where('create_date LIKE', $year)
		// ->group_by('department.name, patient.sex')
		// ->get()
		// ->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('ipd_opd', $section)
		->where('discharge_date =', '0000-00-00')
		->where('create_date <=', $start_date)
		// ->or_where('discharge_date =', NULL)
		->where('create_date LIKE', $year)
		->get()
		->result();

		// print_r($data['patients']);
		// die();
		
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patientoccupancy',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	
	public function getpatientby_month($section = '')
	{
       echo error_reporting(0);
	    ini_set('memory_limit', '-1');
	   
		$data['title'] = display('Monthly Report');
		$year = '%'.$this->session->userdata['acyear'].'%';
	    $patients = $this->patient_model->read_by_dept_month($section,$year);
		$department = $this->patient_model->get_all_dept();
        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
        $sw_28_jan=0; $sw_28_feb=0; $sw_28_march=0;$sw_28_april=0; $sw_28_may=0; $sw_28_june=0; $sw_28_jully=0;$sw_28_aguest=0; $sw_28_sebt=0; $sw_28_octo=0; $sw_28_nove=0;$sw_28_desm=0;
        $str_28_jan=0; $str_28_feb=0; $str_28_march=0;$str_28_april=0; $str_28_may=0; $str_28_june=0; $str_28_jully=0;$str_28_aguest=0; $str_28_sebt=0; $str_28_octo=0; $str_28_nove=0;$str_28_desm=0;
        $sky_28_jan=0; $sky_28_feb=0; $sky_28_march=0;$sky_28_april=0; $sky_28_may=0; $sky_28_june=0; $sky_28_jully=0;$sky_28_aguest=0; $sky_28_sebt=0; $sky_28_octo=0; $sky_28_nove=0;$sky_28_desm=0;
        $sly_28_jan=0; $sly_28_feb=0; $sly_28_march=0;$sly_28_april=0; $sly_28_may=0; $sly_28_june=0; $sly_28_jully=0;$sly_28_aguest=0; $sly_28_sebt=0; $sly_28_octo=0; $sly_28_nove=0;$sly_28_desm=0;
        
        $bal_28_jan=0; $bal_28_feb=0; $bal_28_march=0;$bal_28_april=0; $bal_28_may=0; $bal_28_june=0; $bal_28_jully=0;$bal_28_aguest=0; $bal_28_sebt=0; $bal_28_octo=0; $bal_28_nove=0;$bal_28_desm=0;
        $pan_28_jan=0; $pan_28_feb=0; $pan_28_march=0;$pan_28_april=0; $pan_28_may=0; $pan_28_june=0; $pan_28_jully=0;$pan_28_aguest=0; $pan_28_sebt=0; $pan_28_octo=0; $pan_28_nove=0;$pan_28_desm=0;
        $kay_28_jan=0; $kay_28_feb=0; $kay_28_march=0;$kay_28_april=0; $kay_28_may=0; $kay_28_june=0; $kay_28_jully=0;$kay_28_aguest=0; $kay_28_sebt=0; $kay_28_octo=0; $kay_28_nove=0;$kay_28_desm=0;
        $aty_28_jan=0; $aty_28_feb=0; $aty_28_march=0;$aty_28_april=0; $aty_28_may=0; $aty_28_june=0; $aty_28_jully=0;$aty_28_aguest=0; $aty_28_sebt=0; $aty_28_octo=0; $aty_28_nove=0;$aty_28_desm=0;
       for($i=0;$i<count($patients);$i++){
          
           
           $month_no=date('m',strtotime($patients[$i]->create_date));
          
          if($patients[$i]->department_id=='28'){
             if($month_no =='01'){
                $sw_28_jan++;
             }
             elseif($month_no =='02'){
                $sw_28_feb++;
             }
             elseif($month_no =='03'){
                $sw_28_march++;
             }
             elseif($month_no =='04'){
                $sw_28_april++;
             }
             elseif($month_no =='05'){
                $sw_28_may++;
             }
             elseif($month_no =='06'){
                $sw_28_june++;
             }
             
             elseif($month_no =='07'){
                $sw_28_jully++;
             }elseif($month_no =='08'){
                $sw_28_aguest++;
             }
             elseif($month_no =='09'){
                $sw_28_sebt++;
             }
             elseif($month_no =='10'){
                $sw_28_octo++;
             }
             elseif($month_no =='11'){
                $sw_28_nove++;
             }else{
                  $sw_28_desm++;
             }
              
          } elseif($patients[$i]->department_id=='29'){
              if($month_no =='01'){
                $str_28_jan++;
             }
             elseif($month_no =='02'){
                $str_28_feb++;
             }
             elseif($month_no =='03'){
                $str_28_march++;
             }
             elseif($month_no =='04'){
                $str_28_april++;
             }
             elseif($month_no =='05'){
                $str_28_may++;
             }
             elseif($month_no =='06'){
                $str_28_june++;
             }
             
             elseif($month_no =='07'){
                $str_28_jully++;
             }elseif($month_no =='08'){
                $str_28_aguest++;
             }
             elseif($month_no =='09'){
                $str_28_sebt++;
             }
             elseif($month_no =='10'){
                $str_28_octo++;
             }
             elseif($month_no =='11'){
                $str_28_nove++;
             }else{
                  $str_28_desm++;
             }
              
          }
          elseif($patients[$i]->department_id=='30'){
              if($month_no =='01'){
                $sky_28_jan++;
             }
             elseif($month_no =='02'){
                $sky_28_feb++;
             }
             elseif($month_no =='03'){
                $sky_28_march++;
             }
             elseif($month_no =='04'){
                $sky_28_april++;
             }
             elseif($month_no =='05'){
                $sky_28_may++;
             }
             elseif($month_no =='06'){
                $sky_28_june++;
             }
             
             elseif($month_no =='07'){
                $sky_28_jully++;
                
             }elseif($month_no =='08'){
                $sky_28_aguest++;
             }
             elseif($month_no =='09'){
                $sky_28_sebt++;
             }
             elseif($month_no =='10'){
                $sky_28_octo++;
             }
             elseif($month_no =='11'){
                $sky_28_nove++;
             }else{
                  $sky_28_desm++;
             }
          } elseif($patients[$i]->department_id=='31'){
              
             if($month_no =='01'){
                $sly_28_jan++;
             }
             elseif($month_no =='02'){
                $sly_28_feb++;
             }
             elseif($month_no =='03'){
                $sly_28_march++;
             }
             elseif($month_no =='04'){
                $sly_28_april++;
             }
             elseif($month_no =='05'){
                $sly_28_may++;
             }
             elseif($month_no =='06'){
                $sly_28_june++;
             }
             
             elseif($month_no =='07'){
                $sly_28_jully++;
                
             }elseif($month_no =='08'){
                $sly_28_aguest++;
             }
             elseif($month_no =='09'){
                $sly_28_sebt++;
             }
             elseif($month_no =='10'){
                $sly_28_octo++;
             }
             elseif($month_no =='11'){
                $sly_28_nove++;
             }else{
                  $sly_28_desm++;
             }
          }
          elseif($patients[$i]->department_id=='32'){
             if($month_no =='01'){
                $bal_28_jan++;
             }
             elseif($month_no =='02'){
                $bal_28_feb++;
             }
             elseif($month_no =='03'){
                $bal_28_march++;
             }
             elseif($month_no =='04'){
                $bal_28_april++;
             }
             elseif($month_no =='05'){
                $bal_28_may++;
             }
             elseif($month_no =='06'){
                $bal_28_june++;
             }
             
             elseif($month_no =='07'){
                $bal_28_jully++;
                
             }elseif($month_no =='08'){
                $bal_28_aguest++;
             }
             elseif($month_no =='09'){
                $bal_28_sebt++;
             }
             elseif($month_no =='10'){
                $bal_28_octo++;
             }
             elseif($month_no =='11'){
                $bal_28_nove++;
             }else{
                  $bal_28_desm++;
             }
          } elseif($patients[$i]->department_id=='33'){
             if($month_no =='01'){
                $pan_28_jan++;
             }
             elseif($month_no =='02'){
                $pan_28_feb++;
             }
             elseif($month_no =='03'){
                $pan_28_march++;
             }
             elseif($month_no =='04'){
                $pan_28_april++;
             }
             elseif($month_no =='05'){
                $pan_28_may++;
             }
             elseif($month_no =='06'){
                $pan_28_june++;
             }
             
             elseif($month_no =='07'){
                $pan_28_jully++;
                
             }elseif($month_no =='08'){
                $pan_28_aguest++;
             }
             elseif($month_no =='09'){
                $pan_28_sebt++;
             }
             elseif($month_no =='10'){
                $pan_28_octo++;
             }
             elseif($month_no =='11'){
                $pan_28_nove++;
             }else{
                  $pan_28_desm++;
             }
              
          }
           elseif($patients[$i]->department_id=='34'){
           if($month_no =='01'){
                $kay_28_jan++;
             }
             elseif($month_no =='02'){
                $kay_28_feb++;
             }
             elseif($month_no =='03'){
                $kay_28_march++;
             }
             elseif($month_no =='04'){
                $kay_28_april++;
             }
             elseif($month_no =='05'){
                $kay_28_may++;
             }
             elseif($month_no =='06'){
                $kay_28_june++;
             }
             
             elseif($month_no =='07'){
                $kay_28_jully++;
                
             }elseif($month_no =='08'){
                $kay_28_aguest++;
             }
             elseif($month_no =='09'){
                $kay_28_sebt++;
             }
             elseif($month_no =='10'){
                $kay_28_octo++;
             }
             elseif($month_no =='11'){
                $kay_28_nove++;
             }else{
                  $kay_28_desm++;
             } 
          } elseif($patients[$i]->department_id=='35'){
              if($month_no =='01'){
                $aty_28_jan++;
             }
             elseif($month_no =='02'){
                $aty_28_feb++;
             }
             elseif($month_no =='03'){
                $aty_28_march++;
             }
             elseif($month_no =='04'){
                $aty_28_april++;
             }
             elseif($month_no =='05'){
                $aty_28_may++;
             }
             elseif($month_no =='06'){
                $aty_28_june++;
             }
             
             elseif($month_no =='07'){
                $aty_28_jully++;
                
             }elseif($month_no =='08'){
                $aty_28_aguest++;
             }
             elseif($month_no =='09'){
                $aty_28_sebt++;
             }
             elseif($month_no =='10'){
                $aty_28_octo++;
             }
             elseif($month_no =='11'){
                $aty_28_nove++;
             }else{
                  $aty_28_desm++;
             } 
              
          } elseif($patients[$i]->department_id==''){
              
              
          }
         
           
           
       }
       $data['SW'] =array($sw_28_jan,$sw_28_feb,$sw_28_march,$sw_28_april,$sw_28_may,$sw_28_june,$sw_28_jully,$sw_28_aguest,$sw_28_sebt,$sw_28_octo,$sw_28_nove,$sw_28_desm);
       $data['STR'] =array($str_28_jan,$str_28_feb,$str_28_march,$str_28_april,$str_28_may,$str_28_june,$str_28_jully,$str_28_aguest,$str_28_sebt,$str_28_octo,$str_28_nove,$str_28_desm);
       $data['SKY'] =array($sky_28_jan,$sky_28_feb,$sky_28_march,$sky_28_april,$sky_28_may,$sky_28_june,$sky_28_jully,$sky_28_aguest,$sky_28_sebt,$sky_28_octo,$sky_28_nove,$sky_28_desm);
       $data['SLY'] =array($sly_28_jan,$sly_28_feb,$sly_28_march,$sly_28_april,$sly_28_may,$sly_28_june,$sly_28_jully,$sly_28_aguest,$sly_28_sebt,$sly_28_octo,$sly_28_nove,$sly_28_desm);
       $data['BAL'] =array($bal_28_jan,$bal_28_feb,$bal_28_march,$bal_28_april,$bal_28_may,$bal_28_june,$bal_28_jully,$bal_28_aguest,$bal_28_sebt,$bal_28_octo,$bal_28_nove,$bal_28_desm);
       $data['PAN'] =array($pan_28_jan,$pan_28_feb,$pan_28_march,$pan_28_april,$pan_28_may,$pan_28_june,$pan_28_jully,$pan_28_aguest,$pan_28_sebt,$pan_28_octo,$pan_28_nove,$pan_28_desm);
       $data['KAY'] =array($kay_28_jan,$kay_28_feb,$kay_28_march,$kay_28_april,$kay_28_may,$kay_28_june,$kay_28_jully,$kay_28_aguest,$kay_28_sebt,$kay_28_octo,$kay_28_nove,$kay_28_desm);
       $data['ATY'] =array($aty_28_jan,$aty_28_feb,$aty_28_march,$aty_28_april,$aty_28_may,$aty_28_june,$aty_28_jully,$aty_28_aguest,$aty_28_sebt,$aty_28_octo,$aty_28_nove,$aty_28_desm);
       
       $data['jan'] =array($sw_28_jan,$str_28_jan,$sky_28_jan,$sly_28_jan,$bal_28_jan,$pan_28_jan,$kay_28_jan,$aty_28_jan);
       $data['feb'] =array($sw_28_feb,$str_28_feb,$sky_28_feb,$sly_28_feb,$bal_28_feb,$pan_28_feb,$kay_28_feb,$aty_28_feb);
       
       $data['march'] =array($sw_28_march,$str_28_march,$sky_28_march,$sly_28_march,$bal_28_march,$pan_28_march,$kay_28_march,$aty_28_march);
       $data['april'] =array($sw_28_april,$str_28_april,$sky_28_april,$sly_28_april,$bal_28_april,$pan_28_april,$kay_28_april,$aty_28_april);
       $data['may']=array($sw_28_may,$str_28_may,$sky_28_may,$sly_28_may,$bal_28_may,$pan_28_may,$kay_28_may,$aty_28_may);
       
       $data['june'] =array($sw_28_june,$str_28_june,$sky_28_june,$sly_28_june,$bal_28_june,$pan_28_june,$kay_28_june,$aty_28_june);
       $data['jully'] =array($sw_28_jully,$str_28_jully,$sky_28_jully,$sly_28_jully,$bal_28_jully,$pan_28_jully,$kay_28_jully,$aty_28_jully);
       $data['aguest'] =array($sw_28_aguest,$str_28_aguest,$sky_28_aguest,$sly_28_aguest,$bal_28_aguest,$pan_28_aguest,$kay_28_aguest,$aty_28_aguest);
       $data['sebt'] =array($sw_28_sebt,$str_28_sebt,$sky_28_sebt,$sly_28_sebt,$bal_28_sebt,$pan_28_sebt,$kay_28_sebt,$aty_28_sebt);
       
       $data['octo'] =array($sw_28_octo,$str_28_octo,$sky_28_octo,$sly_28_octo,$bal_28_octo,$pan_28_octo,$kay_28_octo,$aty_28_octo);
       $data['nove'] =array($sw_28_nove,$str_28_nove,$sky_28_nove,$sly_28_nove,$bal_28_nove,$pan_28_nove,$kay_28_nove,$aty_28_nove);
       $data['desm'] =array($sw_28_desm,$str_28_desm,$sky_28_desm,$sly_28_desm,$bal_28_desm,$pan_28_desm,$kay_28_desm,$aty_28_desm);
       $data['department']=$this->patient_model->get_all_dept();
      
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
        $data['section'] = $section;
     //   $data['department_id'] = $department_id_decode;
       
		$data['content'] = $this->load->view('patient_month_report',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function getpatientby_month_date()
	{
       echo error_reporting(0);
	    $section= $this->input->post('section');
	    $year_no= $this->input->post('year_no');
	    $year = '%'.$year_no.'%';
		$data['title'] = display('Monthly Report');
	    $patients = $this->patient_model->read_by_dept_month($section,$year);
		$department = $this->patient_model->get_all_dept();
        print_r($patients); exit;
		//$year = '%'.$year_no.'%';
		
        $sw_28_jan=0; $sw_28_feb=0; $sw_28_march=0;$sw_28_april=0; $sw_28_may=0; $sw_28_june=0; $sw_28_jully=0;$sw_28_aguest=0; $sw_28_sebt=0; $sw_28_octo=0; $sw_28_nove=0;$sw_28_desm=0;
        $str_28_jan=0; $str_28_feb=0; $str_28_march=0;$str_28_april=0; $str_28_may=0; $str_28_june=0; $str_28_jully=0;$str_28_aguest=0; $str_28_sebt=0; $str_28_octo=0; $str_28_nove=0;$str_28_desm=0;
        $sky_28_jan=0; $sky_28_feb=0; $sky_28_march=0;$sky_28_april=0; $sky_28_may=0; $sky_28_june=0; $sky_28_jully=0;$sky_28_aguest=0; $sky_28_sebt=0; $sky_28_octo=0; $sky_28_nove=0;$sky_28_desm=0;
        $sly_28_jan=0; $sly_28_feb=0; $sly_28_march=0;$sly_28_april=0; $sly_28_may=0; $sly_28_june=0; $sly_28_jully=0;$sly_28_aguest=0; $sly_28_sebt=0; $sly_28_octo=0; $sly_28_nove=0;$sly_28_desm=0;
        
        $bal_28_jan=0; $bal_28_feb=0; $bal_28_march=0;$bal_28_april=0; $bal_28_may=0; $bal_28_june=0; $bal_28_jully=0;$bal_28_aguest=0; $bal_28_sebt=0; $bal_28_octo=0; $bal_28_nove=0;$bal_28_desm=0;
        $pan_28_jan=0; $pan_28_feb=0; $pan_28_march=0;$pan_28_april=0; $pan_28_may=0; $pan_28_june=0; $pan_28_jully=0;$pan_28_aguest=0; $pan_28_sebt=0; $pan_28_octo=0; $pan_28_nove=0;$pan_28_desm=0;
        $kay_28_jan=0; $kay_28_feb=0; $kay_28_march=0;$kay_28_april=0; $kay_28_may=0; $kay_28_june=0; $kay_28_jully=0;$kay_28_aguest=0; $kay_28_sebt=0; $kay_28_octo=0; $kay_28_nove=0;$kay_28_desm=0;
        $aty_28_jan=0; $aty_28_feb=0; $aty_28_march=0;$aty_28_april=0; $aty_28_may=0; $aty_28_june=0; $aty_28_jully=0;$aty_28_aguest=0; $aty_28_sebt=0; $aty_28_octo=0; $aty_28_nove=0;$aty_28_desm=0;
       for($i=0;$i<count($patients);$i++){
          
           
           $month_no=date('m',strtotime($patients[$i]->create_date));
          
          if($patients[$i]->department_id=='28'){
             if($month_no =='01'){
                $sw_28_jan++;
             }
             elseif($month_no =='02'){
                $sw_28_feb++;
             }
             elseif($month_no =='03'){
                $sw_28_march++;
             }
             elseif($month_no =='04'){
                $sw_28_april++;
             }
             elseif($month_no =='05'){
                $sw_28_may++;
             }
             elseif($month_no =='06'){
                $sw_28_june++;
             }
             
             elseif($month_no =='07'){
                $sw_28_jully++;
             }elseif($month_no =='08'){
                $sw_28_aguest++;
             }
             elseif($month_no =='09'){
                $sw_28_sebt++;
             }
             elseif($month_no =='10'){
                $sw_28_octo++;
             }
             elseif($month_no =='11'){
                $sw_28_nove++;
             }else{
                  $sw_28_desm++;
             }
              
          } elseif($patients[$i]->department_id=='29'){
              if($month_no =='01'){
                $str_28_jan++;
             }
             elseif($month_no =='02'){
                $str_28_feb++;
             }
             elseif($month_no =='03'){
                $str_28_march++;
             }
             elseif($month_no =='04'){
                $str_28_april++;
             }
             elseif($month_no =='05'){
                $str_28_may++;
             }
             elseif($month_no =='06'){
                $str_28_june++;
             }
             
             elseif($month_no =='07'){
                $str_28_jully++;
             }elseif($month_no =='08'){
                $str_28_aguest++;
             }
             elseif($month_no =='09'){
                $str_28_sebt++;
             }
             elseif($month_no =='10'){
                $str_28_octo++;
             }
             elseif($month_no =='11'){
                $str_28_nove++;
             }else{
                  $str_28_desm++;
             }
              
          }
          elseif($patients[$i]->department_id=='30'){
              if($month_no =='01'){
                $sky_28_jan++;
             }
             elseif($month_no =='02'){
                $sky_28_feb++;
             }
             elseif($month_no =='03'){
                $sky_28_march++;
             }
             elseif($month_no =='04'){
                $sky_28_april++;
             }
             elseif($month_no =='05'){
                $sky_28_may++;
             }
             elseif($month_no =='06'){
                $sky_28_june++;
             }
             
             elseif($month_no =='07'){
                $sky_28_jully++;
                
             }elseif($month_no =='08'){
                $sky_28_aguest++;
             }
             elseif($month_no =='09'){
                $sky_28_sebt++;
             }
             elseif($month_no =='10'){
                $sky_28_octo++;
             }
             elseif($month_no =='11'){
                $sky_28_nove++;
             }else{
                  $sky_28_desm++;
             }
          } elseif($patients[$i]->department_id=='31'){
              
             if($month_no =='01'){
                $sly_28_jan++;
             }
             elseif($month_no =='02'){
                $sly_28_feb++;
             }
             elseif($month_no =='03'){
                $sly_28_march++;
             }
             elseif($month_no =='04'){
                $sly_28_april++;
             }
             elseif($month_no =='05'){
                $sly_28_may++;
             }
             elseif($month_no =='06'){
                $sly_28_june++;
             }
             
             elseif($month_no =='07'){
                $sly_28_jully++;
                
             }elseif($month_no =='08'){
                $sly_28_aguest++;
             }
             elseif($month_no =='09'){
                $sly_28_sebt++;
             }
             elseif($month_no =='10'){
                $sly_28_octo++;
             }
             elseif($month_no =='11'){
                $sly_28_nove++;
             }else{
                  $sly_28_desm++;
             }
          }
          elseif($patients[$i]->department_id=='32'){
             if($month_no =='01'){
                $bal_28_jan++;
             }
             elseif($month_no =='02'){
                $bal_28_feb++;
             }
             elseif($month_no =='03'){
                $bal_28_march++;
             }
             elseif($month_no =='04'){
                $bal_28_april++;
             }
             elseif($month_no =='05'){
                $bal_28_may++;
             }
             elseif($month_no =='06'){
                $bal_28_june++;
             }
             
             elseif($month_no =='07'){
                $bal_28_jully++;
                
             }elseif($month_no =='08'){
                $bal_28_aguest++;
             }
             elseif($month_no =='09'){
                $bal_28_sebt++;
             }
             elseif($month_no =='10'){
                $bal_28_octo++;
             }
             elseif($month_no =='11'){
                $bal_28_nove++;
             }else{
                  $bal_28_desm++;
             }
          } elseif($patients[$i]->department_id=='33'){
             if($month_no =='01'){
                $pan_28_jan++;
             }
             elseif($month_no =='02'){
                $pan_28_feb++;
             }
             elseif($month_no =='03'){
                $pan_28_march++;
             }
             elseif($month_no =='04'){
                $pan_28_april++;
             }
             elseif($month_no =='05'){
                $pan_28_may++;
             }
             elseif($month_no =='06'){
                $pan_28_june++;
             }
             
             elseif($month_no =='07'){
                $pan_28_jully++;
                
             }elseif($month_no =='08'){
                $pan_28_aguest++;
             }
             elseif($month_no =='09'){
                $pan_28_sebt++;
             }
             elseif($month_no =='10'){
                $pan_28_octo++;
             }
             elseif($month_no =='11'){
                $pan_28_nove++;
             }else{
                  $pan_28_desm++;
             }
              
          }
           elseif($patients[$i]->department_id=='34'){
           if($month_no =='01'){
                $kay_28_jan++;
             }
             elseif($month_no =='02'){
                $kay_28_feb++;
             }
             elseif($month_no =='03'){
                $kay_28_march++;
             }
             elseif($month_no =='04'){
                $kay_28_april++;
             }
             elseif($month_no =='05'){
                $kay_28_may++;
             }
             elseif($month_no =='06'){
                $kay_28_june++;
             }
             
             elseif($month_no =='07'){
                $kay_28_jully++;
                
             }elseif($month_no =='08'){
                $kay_28_aguest++;
             }
             elseif($month_no =='09'){
                $kay_28_sebt++;
             }
             elseif($month_no =='10'){
                $kay_28_octo++;
             }
             elseif($month_no =='11'){
                $kay_28_nove++;
             }else{
                  $kay_28_desm++;
             } 
          } elseif($patients[$i]->department_id=='35'){
              if($month_no =='01'){
                $aty_28_jan++;
             }
             elseif($month_no =='02'){
                $aty_28_feb++;
             }
             elseif($month_no =='03'){
                $aty_28_march++;
             }
             elseif($month_no =='04'){
                $aty_28_april++;
             }
             elseif($month_no =='05'){
                $aty_28_may++;
             }
             elseif($month_no =='06'){
                $aty_28_june++;
             }
             
             elseif($month_no =='07'){
                $aty_28_jully++;
                
             }elseif($month_no =='08'){
                $aty_28_aguest++;
             }
             elseif($month_no =='09'){
                $aty_28_sebt++;
             }
             elseif($month_no =='10'){
                $aty_28_octo++;
             }
             elseif($month_no =='11'){
                $aty_28_nove++;
             }else{
                  $aty_28_desm++;
             } 
              
          } elseif($patients[$i]->department_id==''){
              
              
          }
         
           
           
       }
       
       $data['jan'] =array($sw_28_jan,$str_28_jan,$sky_28_jan,$sly_28_jan,$bal_28_jan,$pan_28_jan,$kay_28_jan,$aty_28_jan);
       $data['feb'] =array($sw_28_feb,$str_28_feb,$sky_28_feb,$sly_28_feb,$bal_28_feb,$pan_28_feb,$kay_28_feb,$aty_28_feb);
       $data['march'] =array($sw_28_march,$str_28_march,$sky_28_march,$sly_28_march,$bal_28_march,$pan_28_march,$kay_28_march,$aty_28_march);
       $data['april'] =array($sw_28_april,$str_28_april,$sky_28_april,$sly_28_april,$bal_28_april,$pan_28_april,$kay_28_april,$aty_28_april);
       $data['may']=array($sw_28_may,$str_28_may,$sky_28_may,$sly_28_may,$bal_28_may,$pan_28_may,$kay_28_may,$aty_28_may);
       
       $data['june'] =array($sw_28_june,$str_28_june,$sky_28_june,$sly_28_june,$bal_28_june,$pan_28_june,$kay_28_june,$aty_28_june);
       $data['jully'] =array($sw_28_jully,$str_28_jully,$sky_28_jully,$sly_28_jully,$bal_28_jully,$pan_28_jully,$kay_28_jully,$aty_28_jully);
       $data['aguest'] =array($sw_28_aguest,$str_28_aguest,$sky_28_aguest,$sly_28_aguest,$bal_28_aguest,$pan_28_aguest,$kay_28_aguest,$aty_28_aguest);
       $data['sebt'] =array($sw_28_sebt,$str_28_sebt,$sky_28_sebt,$sly_28_sebt,$bal_28_sebt,$pan_28_sebt,$kay_28_sebt,$aty_28_sebt);
       
       $data['octo'] =array($sw_28_octo,$str_28_octo,$sky_28_octo,$sly_28_octo,$bal_28_octo,$pan_28_octo,$kay_28_octo,$aty_28_octo);
       $data['nove'] =array($sw_28_nove,$str_28_nove,$sky_28_nove,$sly_28_nove,$bal_28_nove,$pan_28_nove,$kay_28_nove,$aty_28_nove);
       $data['desm'] =array($sw_28_desm,$str_28_desm,$sky_28_desm,$sly_28_desm,$bal_28_desm,$pan_28_desm,$kay_28_desm,$aty_28_desm);
       $data['department']=$this->patient_model->get_all_dept();
      
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
        $data['section'] = $section;
     //   $data['department_id'] = $department_id_decode;
       
		$data['content'] = $this->load->view('patient_month_report',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
    public function getpatientby_month_bed($section = '')
	{
       echo error_reporting(0);
	
		$data['title'] = display('Monthly Report');
		$year = '%'.$this->session->userdata['acyear'].'%';
	    $patients = $this->patient_model->read_by_dept_month($section,$year);
		$department = $this->patient_model->get_all_dept();
        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
        $sw_28_jan=0; $sw_28_feb=0; $sw_28_march=0;$sw_28_april=0; $sw_28_may=0; $sw_28_june=0; $sw_28_jully=0;$sw_28_aguest=0; $sw_28_sebt=0; $sw_28_octo=0; $sw_28_nove=0;$sw_28_desm=0;
        $str_28_jan=0; $str_28_feb=0; $str_28_march=0;$str_28_april=0; $str_28_may=0; $str_28_june=0; $str_28_jully=0;$str_28_aguest=0; $str_28_sebt=0; $str_28_octo=0; $str_28_nove=0;$str_28_desm=0;
        $sky_28_jan=0; $sky_28_feb=0; $sky_28_march=0;$sky_28_april=0; $sky_28_may=0; $sky_28_june=0; $sky_28_jully=0;$sky_28_aguest=0; $sky_28_sebt=0; $sky_28_octo=0; $sky_28_nove=0;$sky_28_desm=0;
        $sly_28_jan=0; $sly_28_feb=0; $sly_28_march=0;$sly_28_april=0; $sly_28_may=0; $sly_28_june=0; $sly_28_jully=0;$sly_28_aguest=0; $sly_28_sebt=0; $sly_28_octo=0; $sly_28_nove=0;$sly_28_desm=0;
        
        $bal_28_jan=0; $bal_28_feb=0; $bal_28_march=0;$bal_28_april=0; $bal_28_may=0; $bal_28_june=0; $bal_28_jully=0;$bal_28_aguest=0; $bal_28_sebt=0; $bal_28_octo=0; $bal_28_nove=0;$bal_28_desm=0;
        $pan_28_jan=0; $pan_28_feb=0; $pan_28_march=0;$pan_28_april=0; $pan_28_may=0; $pan_28_june=0; $pan_28_jully=0;$pan_28_aguest=0; $pan_28_sebt=0; $pan_28_octo=0; $pan_28_nove=0;$pan_28_desm=0;
        $kay_28_jan=0; $kay_28_feb=0; $kay_28_march=0;$kay_28_april=0; $kay_28_may=0; $kay_28_june=0; $kay_28_jully=0;$kay_28_aguest=0; $kay_28_sebt=0; $kay_28_octo=0; $kay_28_nove=0;$kay_28_desm=0;
        $aty_28_jan=0; $aty_28_feb=0; $aty_28_march=0;$aty_28_april=0; $aty_28_may=0; $aty_28_june=0; $aty_28_jully=0;$aty_28_aguest=0; $aty_28_sebt=0; $aty_28_octo=0; $aty_28_nove=0;$aty_28_desm=0;
       for($i=0;$i<count($patients);$i++){
            
           $month_no=date('m',strtotime($patients[$i]->create_date));
          
          if($patients[$i]->department_id=='28'){
             if($month_no =='01'){
             
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_jan+=$interval->format('%a') ;
                //$sw_28_jan++;
             }
             elseif($month_no =='02'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_feb+=$interval->format('%a') ;
              //$sw_28_feb++;
             }
             elseif($month_no =='03'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_march+=$interval->format('%a') ;
                //$sw_28_march++;
             }
             elseif($month_no =='04'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_april+=$interval->format('%a') ;
               // $sw_28_april++;
             }
             elseif($month_no =='05'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_may+=$interval->format('%a') ;
                //$sw_28_may++;
             }
             elseif($month_no =='06'){
            
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_june+=$interval->format('%a') ;
                //$sw_28_june++;
             }
             
             elseif($month_no =='07'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
             if($patients[$i]->discharge_date =='0000-00-00'){}
             else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_jully+=$interval->format('%a') ;
                //$sw_28_jully++;
             }
             elseif($month_no =='08'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_aguest+=$interval->format('%a') ;
              //$sw_28_aguest++;
             }
             elseif($month_no =='09'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_sebt+=$interval->format('%a') ;
                //$sw_28_sebt++;
             }
             elseif($month_no =='10'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_octo+=$interval->format('%a') ;
               // $sw_28_octo++;
             }
             elseif($month_no =='11'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_nove+=$interval->format('%a') ;
              //$sw_28_nove++;
             }else{
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sw_28_desm+=$interval->format('%a') ;
                  //$sw_28_desm++;
             }
              
          } elseif($patients[$i]->department_id=='29'){
              if($month_no =='01'){
            
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
             $str_28_jan+=$interval->format('%a') ;
               // $str_28_jan++;
             }
             elseif($month_no =='02'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_feb+=$interval->format('%a') ;
                //$str_28_feb++;
             }
             elseif($month_no =='03'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_march+=$interval->format('%a') ;
                //$str_28_march++;
             }
             elseif($month_no =='04'){
                
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_april+=$interval->format('%a') ;
                //$str_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_may+=$interval->format('%a') ;
                //$str_28_may++;
             }
             elseif($month_no =='06'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_june+=$interval->format('%a') ;
                //$str_28_june++;
             }
             
             elseif($month_no =='07'){
                
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_jully+=$interval->format('%a') ;
                //$str_28_jully++;
             }
             elseif($month_no =='08'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_aguest+=$interval->format('%a') ;
               // $str_28_aguest++;
             }
             elseif($month_no =='09'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_sebt+=$interval->format('%a') ;
               // $str_28_sebt++;
             }
             elseif($month_no =='10'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_octo+=$interval->format('%a') ;
                //$str_28_octo++;
             }
             elseif($month_no =='11'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_nove+=$interval->format('%a') ;
                //$str_28_nove++;
             }else{
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $str_28_desm+=$interval->format('%a') ;
                 // $str_28_desm++;
             }
              
          }
          elseif($patients[$i]->department_id=='30'){
              if($month_no =='01'){
                  
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_jan+=$interval->format('%a') ;
                //$sky_28_jan++;
             }
             elseif($month_no =='02'){
                
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_feb+=$interval->format('%a') ;
                //$sky_28_feb++;
             }
             elseif($month_no =='03'){
                
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_march+=$interval->format('%a') ;
                //$sky_28_march++;
             }
             elseif($month_no =='04'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_april+=$interval->format('%a') ;
                //$sky_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_may+=$interval->format('%a') ;
                //$sky_28_may++;
             }
             elseif($month_no =='06'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_june+=$interval->format('%a') ;
                //$sky_28_june++;
             }
             
             elseif($month_no =='07'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_jully+=$interval->format('%a') ;
               // $sky_28_jully++;
                
             }elseif($month_no =='08'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_aguest+=$interval->format('%a') ;
                //$sky_28_aguest++;
             }
             elseif($month_no =='09'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_sebt+=$interval->format('%a') ;
                //$sky_28_sebt++;
             }
             elseif($month_no =='10'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_octo+=$interval->format('%a') ;
                //$sky_28_octo++;
             }
             elseif($month_no =='11'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_nove+=$interval->format('%a') ;
                //$sky_28_nove++;
             }else{
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sky_28_desm+=$interval->format('%a') ;
                  //$sky_28_desm++;
             }
          } elseif($patients[$i]->department_id=='31'){
              
             if($month_no =='01'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_jan+=$interval->format('%a') ;
                //$sly_28_jan++;
             }
             elseif($month_no =='02'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_feb+=$interval->format('%a') ;
                //$sly_28_feb++;
             }
             elseif($month_no =='03'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_march+=$interval->format('%a') ;
                //$sly_28_march++;
             }
             elseif($month_no =='04'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_april+=$interval->format('%a') ;
                //$sly_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_may+=$interval->format('%a') ;
               // $sly_28_may++;
             }
             elseif($month_no =='06'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_june+=$interval->format('%a') ;
                //$sly_28_june++;
             }
             
             elseif($month_no =='07'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_jully+=$interval->format('%a') ;
               // $sly_28_jully++;
                
             }elseif($month_no =='08'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_aguest+=$interval->format('%a') ;
                //$sly_28_aguest++;
             }
             elseif($month_no =='09'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_sebt+=$interval->format('%a') ;
                //$sly_28_sebt++;
             }
             elseif($month_no =='10'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_octo+=$interval->format('%a') ;
                //$sly_28_octo++;
             }
             elseif($month_no =='11'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_nove+=$interval->format('%a') ;
                //$sly_28_nove++;
             }else{
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $sly_28_desm+=$interval->format('%a') ;
                  //$sly_28_desm++;
             }
          }
          elseif($patients[$i]->department_id=='32'){
             if($month_no =='01'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_jan+=$interval->format('%a') ;
                //$bal_28_jan++;
             }
             elseif($month_no =='02'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_feb+=$interval->format('%a') ;
               // $bal_28_feb++;
             }
             elseif($month_no =='03'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_march+=$interval->format('%a') ;
                //$bal_28_march++;
             }
             elseif($month_no =='04'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_april+=$interval->format('%a') ;
                //$bal_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_may+=$interval->format('%a') ;
                //$bal_28_may++;
             }
             elseif($month_no =='06'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_june+=$interval->format('%a') ;
                //$bal_28_june++;
             }
             
             elseif($month_no =='07'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_jully+=$interval->format('%a') ;
               // $bal_28_jully++;
                
             }elseif($month_no =='08'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_aguest+=$interval->format('%a') ;
                //$bal_28_aguest++;
             }
             elseif($month_no =='09'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_sebt+=$interval->format('%a') ;
                //$bal_28_sebt++;
             }
             elseif($month_no =='10'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_octo+=$interval->format('%a') ;
                //$bal_28_octo++;
             }
             elseif($month_no =='11'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_nove+=$interval->format('%a') ;
               // $bal_28_nove++;
             }else{
                 
                $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $bal_28_desm+=$interval->format('%a') ;
                 //$bal_28_desm++;
             }
          } elseif($patients[$i]->department_id=='33'){
             if($month_no =='01'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_jan+=$interval->format('%a') ;
               // $pan_28_jan++;
             }
             elseif($month_no =='02'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_feb+=$interval->format('%a') ;
                //$pan_28_feb++;
             }
             elseif($month_no =='03'){
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_march+=$interval->format('%a') ;
                //$pan_28_march++;
             }
             elseif($month_no =='04'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_april+=$interval->format('%a') ;
               // $pan_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_may+=$interval->format('%a') ;
                //$pan_28_may++;
             }
             elseif($month_no =='06'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_june+=$interval->format('%a') ;
                //$pan_28_june++;
             }
             
             elseif($month_no =='07'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_jully+=$interval->format('%a') ;
                //$pan_28_jully++;
                
             }elseif($month_no =='08'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_aguest+=$interval->format('%a') ;
                //$pan_28_aguest++;
             }
             elseif($month_no =='09'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_sebt+=$interval->format('%a') ;
                //$pan_28_sebt++;
             }
             elseif($month_no =='10'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_octo+=$interval->format('%a') ;
               // $pan_28_octo++;
             }
             elseif($month_no =='11'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_nove+=$interval->format('%a') ;
               // $pan_28_nove++;
             }else{
                 
                $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $pan_28_desm+=$interval->format('%a') ;
                  //$pan_28_desm++;
             }
              
          }
           elseif($patients[$i]->department_id=='34'){
           if($month_no =='01'){
               
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_jan+=$interval->format('%a') ;
               // $kay_28_jan++;
             }
             elseif($month_no =='02'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_feb+=$interval->format('%a') ;
               // $kay_28_feb++;
             }
             elseif($month_no =='03'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_march+=$interval->format('%a') ;
               // $kay_28_march++;
             }
             elseif($month_no =='04'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_april+=$interval->format('%a') ;
                //$kay_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_may+=$interval->format('%a') ;
               // $kay_28_may++;
             }
             elseif($month_no =='06'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_june+=$interval->format('%a') ;
                //$kay_28_june++;
             }
             
             elseif($month_no =='07'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_jully+=$interval->format('%a') ;
               // $kay_28_jully++;
                
             }elseif($month_no =='08'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_aguest+=$interval->format('%a') ;
                //$kay_28_aguest++;
             }
             elseif($month_no =='09'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_sebt+=$interval->format('%a') ;
               // $kay_28_sebt++;
             }
             elseif($month_no =='10'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_octo+=$interval->format('%a') ;
               // $kay_28_octo++;
             }
             elseif($month_no =='11'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
             }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_nove+=$interval->format('%a') ;
                //$kay_28_nove++;
             }else{
                 
             $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $kay_28_desm+=$interval->format('%a') ;
                 // $kay_28_desm++;
             } 
          } elseif($patients[$i]->department_id=='35'){
              if($month_no =='01'){
                  
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_jan+=$interval->format('%a') ;
               // $aty_28_jan++;
             }
             elseif($month_no =='02'){
                 
                $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_feb+=$interval->format('%a') ;
                //$aty_28_feb++;
             }
             elseif($month_no =='03'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_march+=$interval->format('%a') ;
                //$aty_28_march++;
             }
             elseif($month_no =='04'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_april=$interval->format('%a') ;
                $aty_28_april++;
             }
             elseif($month_no =='05'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_may+=$interval->format('%a') ;
               // $aty_28_may++;
             }
             elseif($month_no =='06'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_june+=$interval->format('%a') ;
               // $aty_28_june++;
             }
             
             elseif($month_no =='07'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_jully+=$interval->format('%a') ;
                //$aty_28_jully++;
                
             }elseif($month_no =='08'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_aguest+=$interval->format('%a') ;
                //$aty_28_aguest++;
             }
             elseif($month_no =='09'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_sebt+=$interval->format('%a') ;
                //$aty_28_sebt++;
             }
             elseif($month_no =='10'){
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_octo+=$interval->format('%a') ;
                //$aty_28_octo++;
             }
             elseif($month_no =='11'){
                 
               $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_octo+=$interval->format('%a') ;
               // $aty_28_desm++;
             }else{
                 
              $date1= date('Y-m-d',strtotime($patients[$i]->create_date));
              if($patients[$i]->discharge_date =='0000-00-00'){}
              else{
               $date2=date('Y-m-d',strtotime($patients[$i]->discharge_date));
               }
              $datetime1 = date_create($date1); 
              $datetime2 = date_create($date2); 
  
              $interval = date_diff($datetime1, $datetime2); 
              $aty_28_octo+=$interval->format('%a') ;
                 // $aty_28_desm++;
             } 
              
          } elseif($patients[$i]->department_id==''){
              
              
          }
         
           
           
       }
       
       $data['jan'] =array($sw_28_jan,$str_28_jan,$sky_28_jan,$sly_28_jan,$bal_28_jan,$pan_28_jan,$kay_28_jan,$aty_28_jan);
       $data['feb'] =array($sw_28_feb,$str_28_feb,$sky_28_feb,$sly_28_feb,$bal_28_feb,$pan_28_feb,$kay_28_feb,$aty_28_feb);
       $data['march'] =array($sw_28_march,$str_28_march,$sky_28_march,$sly_28_march,$bal_28_march,$pan_28_march,$kay_28_march,$aty_28_march);
       $data['april'] =array($sw_28_april,$str_28_april,$sky_28_april,$sly_28_april,$bal_28_april,$pan_28_april,$kay_28_april,$aty_28_april);
       $data['may']=array($sw_28_may,$str_28_may,$sky_28_may,$sly_28_may,$bal_28_may,$pan_28_may,$kay_28_may,$aty_28_may);
       
       $data['june'] =array($sw_28_june,$str_28_june,$sky_28_june,$sly_28_june,$bal_28_june,$pan_28_june,$kay_28_june,$aty_28_june);
       $data['jully'] =array($sw_28_jully,$str_28_jully,$sky_28_jully,$sly_28_jully,$bal_28_jully,$pan_28_jully,$kay_28_jully,$aty_28_jully);
       $data['aguest'] =array($sw_28_aguest,$str_28_aguest,$sky_28_aguest,$sly_28_aguest,$bal_28_aguest,$pan_28_aguest,$kay_28_aguest,$aty_28_aguest);
       $data['sebt'] =array($sw_28_sebt,$str_28_sebt,$sky_28_sebt,$sly_28_sebt,$bal_28_sebt,$pan_28_sebt,$kay_28_sebt,$aty_28_sebt);
       
       $data['octo'] =array($sw_28_octo,$str_28_octo,$sky_28_octo,$sly_28_octo,$bal_28_octo,$pan_28_octo,$kay_28_octo,$aty_28_octo);
       $data['nove'] =array($sw_28_nove,$str_28_nove,$sky_28_nove,$sly_28_nove,$bal_28_nove,$pan_28_nove,$kay_28_nove,$aty_28_nove);
       $data['desm'] =array($sw_28_desm,$str_28_desm,$sky_28_desm,$sly_28_desm,$bal_28_desm,$pan_28_desm,$kay_28_desm,$aty_28_desm);
       $data['department']=$this->patient_model->get_all_dept();
      
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
        //$data['section'] = $section;
          $data['month_bed'] = 'month_bed';
     //   $data['department_id'] = $department_id_decode;
       
		$data['content'] = $this->load->view('patient_month_report',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}
	
	function excel_all_customer_admit()
	{
		  
	    $year = '%'.$this->session->userdata['acyear'].'%';
        $start_date2=$_GET['date1'];
		$end_date2=$_GET['date2'];
		$section = $_GET['section'];

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
     
      

		

     
		$data['patients'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id =  patient_ipd.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
       
     //	print_r($data['patients']);exit;
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data['patients']){
		   
			$data['content'] = $this->load->view('excel_all_customer_exce',$data,true);	
		//	$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	
	function excel_all_customer()
	{
		  
	    $year = '%'.$this->session->userdata['acyear'].'%';
        $start_date2=$_GET['date1'];
		$end_date2=$_GET['date2'];
		$section = $_GET['section'];

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
     
      
     

		

        if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
	//	->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
       }
      else
       {
           

         $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', $section)
		->or_where('discharge_date', $start_date)

   	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date_f)

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', $section)

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
       }
		//print_r($data['patients']);exit;
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data['patients']){
		   
			$data['content'] = $this->load->view('excel_all_customer_exce',$data,true);	
		//	$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	
	function excel_all_customer_damii()
	{
		  
	    /*$year = '%'.$this->session->userdata['acyear'].'%';
        $start_date2=$_GET['date1'];
		$end_date2=$_GET['date2'];
		$section = $_GET['section'];

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
     */
        $year = '%'.$this->session->userdata['acyear'].'%';
        $start_date2='2020-01-11';
		$end_date2='2020-01-11';
		$section ='opd';
     
          $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
     

		

        if($section=='opd'){
		$data['patients'] = $this->db->select("*")

		->from('patient')
		
	//	->join('department','department.dprt_id =  patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)
		
	//	->order_by("id", "DESC")

		->get()

		->result();
            
       }
      else
       {
           

         $data['patients1'] = $this->db->select("*")

		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('discharge_date >=', $start_date_f)

		->where('create_date <=', $start_date_f)

		->where('ipd_opd', $section)
		->or_where('discharge_date', $start_date)

   	//	->where('create_date LIKE', $year)

		->get()

		->result();
		
	

		//Array 2
		$data['patients2'] = $this->db->select("*")
		
		->from('patient_ipd')
		
		->join('department','department.dprt_id = patient_ipd.department_id')

		->where('create_date <=', $start_date_f)

		->where('discharge_date LIKE', '%0000-00-00%')

		->where('ipd_opd', $section)

		->get()

		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
       }
		//print_r($data['patients']);exit;
		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data['patients']){
		   
			$data['content'] = $this->load->view('excel_all_customer_exce',$data,true);	
		//	$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	
	function excel_all_customer_invistigation()
	{
		  
	    $year = '%'.$this->session->userdata['acyear'].'%';
        $start_date2=$_GET['date1'];
		$end_date2=$_GET['date2'];
		$section = $_GET['section'];

        $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
     
         
        $data['patients1'] = $this->patient_model->read_by_investi_date($section='opd',$start_date,$end_date);
		$data['patients2'] = $this->patient_model->read_by_investi_date($section='ipd',$start_date,$end_date);
		$data['patients'] =array_merge($data['patients1'],$data['patients2']);
	
		 //$data['department_by_section'] = 'opd';
            
      
	    $data['datefrom'] = $start_date2;
		$data['dateto'] = $end_date2;
        $data['department_by'] = 'dpt';
		if($data['patients']){
		   
			$data['content'] = $this->load->view('excel_all_customer_invistigation',$data,true);	
		//	$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	
	public function getDistinctTreatment(){
	    $dept_id = $this->input->post('department_id');
	    $this->db->select('dISTINCT(dignosis)');
	    if($dept_id){
	        $this->db->where('department_id', $dept_id);
	    }
	    $result = $this->db->get('treatments1')->result();
	    echo json_encode($result);
	}

}
