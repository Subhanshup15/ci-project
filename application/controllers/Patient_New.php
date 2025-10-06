<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_New extends CI_Controller {
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

// 		if ($this->session->userdata('isLogIn') == false
// 			|| $this->session->userdata('user_role') != 1) 
// 			redirect('login');

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 
	}



///////////new central opd /////////////
 public function central_opd()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('end_date', TRUE);
        $end_date1 = $start_date1;
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $data['section'] = $section;
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
		->join('department_new','department_new.dprt_id =  patient.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
		->get()
		->result();
            
		$data['department_by_section'] ='opd';  
         }
        $data['section'] = 'opd';
        if($data == null){
			$data['content'] = $this->load->view('central_opd_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('central_opd_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
	}




     public function central_ipd()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
        $end_date1 = $start_date1;
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $data['section'] = $section;
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

	

        if($section=='ipd')
         {
        $data['patients1'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('discharge_date >=', $start_date_f)
		->where('create_date <=', $start_date_f)
		->where('ipd_opd', 'ipd')
		->or_where('discharge_date', $start_date)
		->where('ipd_opd', 'ipd')
		->get()
		->result();
           
		$data['patients2'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('create_date <=', $start_date)
		->where('discharge_date LIKE', '%0000-00-00%')
	    ->where('ipd_opd', 'ipd')
		->get()
		->result();

	
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
          $data['department_by_section'] ='ipd';
           $data['section'] = 'ipd';         
         }
        if($data == null){
			$data['content'] = $this->load->view('central_ipd_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('central_ipd_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}	
	}


//////////////////////month///////////////////////
public function getpatientby_month_2025($section = '')
	{
       //echo error_reporting(0);
        error_reporting(0);
	    ini_set('memory_limit', '-1');
	   
		$data['title'] = display('Monthly Report');
		$year = '%'.$this->session->userdata['acyear'].'%';
	    $patients = $this->patient_model->read_by_dept_month($section,$year);
		$department = $this->patient_model->get_all_dept();
        
		$year = '%'.$this->session->userdata['acyear'].'%';
		
        $vi_28_jan=0; $vi_28_feb=0; $vi_28_march=0;$vi_28_april=0; $vi_28_may=0; $vi_28_june=0; $vi_28_jully=0;$vi_28_aguest=0; $vi_28_sebt=0; $vi_28_octo=0; $vi_28_nove=0;$vi_28_desm=0;
        $sw_28_jan=0; $sw_28_feb=0; $sw_28_march=0;$sw_28_april=0; $sw_28_may=0; $sw_28_june=0; $sw_28_jully=0;$sw_28_aguest=0; $sw_28_sebt=0; $sw_28_octo=0; $sw_28_nove=0;$sw_28_desm=0;
        $str_28_jan=0; $str_28_feb=0; $str_28_march=0;$str_28_april=0; $str_28_may=0; $str_28_june=0; $str_28_jully=0;$str_28_aguest=0; $str_28_sebt=0; $str_28_octo=0; $str_28_nove=0;$str_28_desm=0;
        $sky_28_jan=0; $sky_28_feb=0; $sky_28_march=0;$sky_28_april=0; $sky_28_may=0; $sky_28_june=0; $sky_28_jully=0;$sky_28_aguest=0; $sky_28_sebt=0; $sky_28_octo=0; $sky_28_nove=0;$sky_28_desm=0;
        $sly_28_jan=0; $sly_28_feb=0; $sly_28_march=0;$sly_28_april=0; $sly_28_may=0; $sly_28_june=0; $sly_28_jully=0;$sly_28_aguest=0; $sly_28_sebt=0; $sly_28_octo=0; $sly_28_nove=0;$sly_28_desm=0;
        
        $bal_28_jan=0; $bal_28_feb=0; $bal_28_march=0;$bal_28_april=0; $bal_28_may=0; $bal_28_june=0; $bal_28_jully=0;$bal_28_aguest=0; $bal_28_sebt=0; $bal_28_octo=0; $bal_28_nove=0;$bal_28_desm=0;
        $pan_28_jan=0; $pan_28_feb=0; $pan_28_march=0;$pan_28_april=0; $pan_28_may=0; $pan_28_june=0; $pan_28_jully=0;$pan_28_aguest=0; $pan_28_sebt=0; $pan_28_octo=0; $pan_28_nove=0;$pan_28_desm=0;
        $kay_28_jan=0; $kay_28_feb=0; $kay_28_march=0;$kay_28_april=0; $kay_28_may=0; $kay_28_june=0; $kay_28_jully=0;$kay_28_aguest=0; $kay_28_sebt=0; $kay_28_octo=0; $kay_28_nove=0;$kay_28_desm=0;
        $aty_28_jan=0; $aty_28_feb=0; $aty_28_march=0;$aty_28_april=0; $aty_28_may=0; $aty_28_june=0; $aty_28_jully=0;$aty_28_aguest=0; $aty_28_sebt=0; $aty_28_octo=0; $aty_28_nove=0;$aty_28_desm=0;
       $skym_28_jan=0; $skym_28_feb=0; $skym_28_march=0;$skym_28_april=0; $skym_28_may=0; $skym_28_june=0; $skym_28_jully=0;$skym_28_aguest=0; $skym_28_sebt=0; $skym_28_octo=0; $skym_28_nove=0;$skym_28_desm=0;

     
       for($i=0;$i<count($patients);$i++){
          
           
           $month_no=date('m',strtotime($patients[$i]->create_date));

        $departments = [
    '27' => 'vi_28',
    '28' => 'sw_28',
    '29' => 'str_28',
    '30' => 'sky_28',
    '31' => 'sly_28',
    '32' => 'bal_28',
    '33' => 'pan_28',
    '34' => 'kay_28',
    '35' => 'aty_28',
    '36' => 'skym_28'
];

$months = [
    '01' => 'jan',
    '02' => 'feb',
    '03' => 'march',
    '04' => 'april',
    '05' => 'may',
    '06' => 'june',
    '07' => 'jully',
    '08' => 'aguest',
    '09' => 'sebt',
    '10' => 'octo',
    '11' => 'nove',
    '12' => 'desm'
];

if (array_key_exists($patients[$i]->department_id, $departments)) {
    $departmentPrefix = $departments[$patients[$i]->department_id]; 
    
    if (array_key_exists($month_no, $months)) {
        $month = $months[$month_no]; 
        $variableName = $departmentPrefix . '_' . $month;  
        $$variableName++;  
    }
}

           
           
       }
      $months = ['jan', 'feb', 'march', 'april', 'may', 'june', 'jully', 'aguest', 'sebt', 'octo', 'nove', 'desm'];
$companies = ['VI', 'SW', 'STR', 'SKY', 'SLY', 'BAL', 'PAN', 'KAY', 'ATY', 'SKYM'];

foreach ($companies as $company) {
    $data[$company] = array_map(function($month) use ($company) {
        return ${$company . '_28_' . $month}; // Dynamically reference the variables
    }, $months);
}


      
        if($section == 'opd'){
         $months = ['jan', 'feb', 'march', 'april', 'may', 'june', 'jully', 'aguest', 'sebt', 'octo', 'nove', 'desm'];
$variables = ['vi', 'sw', 'str', 'sky', 'sly', 'bal', 'pan', 'kay', 'aty', 'skym'];

foreach ($months as $month) {
    foreach ($variables as $var) {
        $data[$month][] = ${$var . '_28_' . $month}; // Dynamically access variables
    }
}


           $data['department']=$this->patient_model->get_all_dept_2025();
        }else{
           $data['jan'] =array($vi_28_jan,$str_28_jan,$sky_28_jan,$sly_28_jan,$bal_28_jan,$pan_28_jan,$kay_28_jan,$skym_28_jan);
           $data['feb'] =array($vi_28_feb,$str_28_feb,$sky_28_feb,$sly_28_feb,$bal_28_feb,$pan_28_feb,$kay_28_feb,$skym_28_feb);
           
           $data['march'] =array($vi_28_march,$str_28_march,$sky_28_march,$sly_28_march,$bal_28_march,$pan_28_march,$kay_28_march,$skym_28_march);
           $data['april'] =array($vi_28_april,$str_28_april,$sky_28_april,$sly_28_april,$bal_28_april,$pan_28_april,$kay_28_april,$skym_28_april);
           $data['may']=array($vi_28_may,$str_28_may,$sky_28_may,$sly_28_may,$bal_28_may,$pan_28_may,$kay_28_may,$skym_28_may);
           
           $data['june'] =array($vi_28_june,$str_28_june,$sky_28_june,$sly_28_june,$bal_28_june,$pan_28_june,$kay_28_june,$skym_28_june);
           $data['jully'] =array($vi_28_jully,$str_28_jully,$sky_28_jully,$sly_28_jully,$bal_28_jully,$pan_28_jully,$kay_28_jully,$skym_28_jully);
           $data['aguest'] =array($vi_28_aguest,$str_28_aguest,$sky_28_aguest,$sly_28_aguest,$bal_28_aguest,$pan_28_aguest,$kay_28_aguest,$skym_28_aguest);
           $data['sebt'] =array($vi_28_sebt,$str_28_sebt,$sky_28_sebt,$sly_28_sebt,$bal_28_sebt,$pan_28_sebt,$kay_28_sebt,$skym_28_sebt);
           
           $data['octo'] =array($vi_28_octo,$str_28_octo,$sky_28_octo,$sly_28_octo,$bal_28_octo,$pan_28_octo,$kay_28_octo,$skym_28_octo);
           $data['nove'] =array($vi_28_nove,$str_28_nove,$sky_28_nove,$sly_28_nove,$bal_28_nove,$pan_28_nove,$kay_28_nove,$skym_28_nove);
           $data['desm'] =array($vi_28_desm,$str_28_desm,$sky_28_desm,$sly_28_desm,$bal_28_desm,$pan_28_desm,$kay_28_desm,$skym_28_desm);
           $data['department']=$this->db->where('dprt_id != ','28')->where('dprt_id !=', '35')->get('department_new')->result();
           
        }
		$data['datefrom'] = '2019';
		$data['dateto'] = '2019';
        $data['section'] = $section;
       
		$data['content'] = $this->load->view('patient_month_report_2025',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

//////////////////////admit/////////////////////////
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
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)->get()->result();

		$data['gendercount'] = $this->db->select('department_new.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department_new.name, patient_ipd.sex')
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

		$data['department_list'] = $this->department_model->department_list_new(); 
		$data['content'] = $this->load->view('admitpatient_new',$data,true);	
		$this->load->view('layout/main_wrapper',$data);
	}


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
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)->get()->result();


		$data['gendercount'] = $this->db->select('department_new.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department_new.name, patient_ipd.sex')
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

		$data['department_list'] = $this->department_model->department_list(); 
		$data['content'] = $this->load->view('admitpatient_new',$data,true);	
		$this->load->view('layout/main_wrapper',$data);

	}

/////////////////////Discharge/////////////////
public function discharge_patient()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date = date('Y-m-d',strtotime("+ 5 days"));
		$end_date   = date('Y-m-d',strtotime("+ 5 days"));
		$start_date12 = $start_date." 00:00:00";
		$end_date12   = $end_date." 23:59:00";

        $section ='ipd';
	    $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));

		$data['patients'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		->where('discharge_date >=', $start_date12)
		->where('discharge_date <=', $end_date12)
		->get()
		->result();

		$data['gendercount'] = $this->db->select('department_new.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('discharge_date >=', $start_date)
		->where('discharge_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department_new.name, patient_ipd.sex')
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

				if($data == null){
			$data['content'] = $this->load->view('discharge_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('discharge_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}
	public function discharge_patient_date()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));
		$start_date12 = $start_date;
		$end_date12   = $end_date;
        $section ='ipd';
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['patients'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
		->where('discharge_date >=', $start_date12)
		->where('discharge_date <=', $end_date12)
		->get()
		->result();
		if($data == null){
			$data['content'] = $this->load->view('discharge_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('discharge_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}


///////////////occapancy//////////////
 public function bed_occupancy_new()
	{
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('start_date', TRUE);
		$section   = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d',strtotime($start_date1));
		$end_date1   = date('Y-m-d',strtotime($end_date1));

        $start_date=$start_date1." 00:00:00";
        $end_date=$start_date;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

        $data['department'] = $this->db->select('*')->from('department_new')->where('dprt_id !=','35')->where('dprt_id !=','28')->get()->result();
		
		
		
		// $data['patients'] = $patient;
		$data['content'] = $this->load->view('bed_occupancy_new',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}





public function patient_summery($section='')
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		//$end_date1   = $this->input->get('end_date', TRUE);
        $end_date1 = $start_date1;
        //$data['section'] = $section;
        
		$start_date2 = date('Y-m-d',strtotime($start_date1));

		$end_date2   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);
        $data['section'] = $section;
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
            ->join('department_new','department_new.dprt_id =  patient.department_id')
            ->where('ipd_opd', $section)
            ->where('create_date >=', $start_date)
            ->where('create_date <=', $end_date)
            ->where('create_date LIKE', $year)
            ->get()
            ->result();
            $data['department_by_section'] ='opd';  
        }
         
	
		if($data == null){
			$data['content'] = $this->load->view('summery_of_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('summery_of_patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
		
	}


	public function midnight()
	{
	    
	    $year = '%'.$this->session->userdata['acyear'].'%';
	    $start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
        $data['section'] = $section;
        $start_date= $start_date2;
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
      
        $date1=date_create($start_date2);
        $date2=date_create($end_date2);
        $diff=date_diff($date1,$date2);
        $diff=$diff->format("%a");
         if($diff==0)
        {
		    $data['summery_report']='0';
        }
        else
        {
            $data['summery_report']='1';
        }
        
        if($section=='opd')
        {
            $data['patients'] = $this->db->select("*")
            ->from('patient')
            ->join('department_new','department_new.dprt_id =  patient.department_id')
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
		    ->join('department_new','department_new.dprt_id = patient_ipd.department_id')
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
    		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
    		->where('create_date <=', $start_date)
    		->where('discharge_date LIKE', '%0000-00-00%')
    	    ->where('ipd_opd', 'ipd')
    		->get()
    		->result();

    	    $data['patients'] = array_merge($data['patients1'], $data['patients2']);
      
            $data['department_by_section'] ='ipd'; 
            
         }
         
        if($data == null)
        {
			$data['content'] = $this->load->view('midnight_reg',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		else
		{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('midnight_reg',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
         
	    
	}



///////////////diet//////////////////////

 public function diet_sheet()
	{
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('start_date', TRUE);
		$section   = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d',strtotime($start_date1));
		$end_date1   = date('Y-m-d',strtotime($end_date1));

        $start_date=$start_date1." 00:00:00";
        $end_date=$start_date;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;
		
		$patient = $this->db->select('*')->from('patient_ipd')
        ->where('create_date <=',$start_date)
        ->group_start()
        ->where('discharge_date >=', $start_date)
        ->or_where('discharge_date LIKE', '%0000-00-00%')
        ->group_end()
		->where ('ipd_opd', $section)
        ->get()
		->result();
		
		$data['patients'] = $patient;
		$data['content'] = $this->load->view('diet_sheet_25',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}



    public function diet_sheet_new()
	{
	    $year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('start_date', TRUE);
		$section   = $this->input->get('section', TRUE);
		$start_date1 = date('Y-m-d',strtotime($start_date1));
		$end_date1   = date('Y-m-d',strtotime($end_date1));

        $start_date=$start_date1." 00:00:00";
        $end_date=$start_date;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['section'] = $section;

        $data['department'] = $this->db->select('*')->from('department_new')->where('dprt_id !=','35')->where('dprt_id !=','28')->get()->result();
		
		
		
		// $data['patients'] = $patient;
		$data['content'] = $this->load->view('diet_sheet_new_25',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}


/////////////////////Gob/////////////////
  public function gob_ipd_2025()
	{
        $section='ipd';
		$start_date1 = date('Y-m-d');		
		$end_date1 = $start_date1;

        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		 $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->gob_2025($section,$start_date,$end_date);

		$year = '%'.$this->session->userdata['acyear'].'%';
        $section = $section;
        $data['section'] = $section;
          
          $data['gendercount'] = $this->db->select('department_new.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
	    ->where('create_date <=', $end_date)
		->group_by('department_new.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	 	->where('create_date <=', $end_date)
		->get()
		->result();
		 $data['department_by_section'] = 'ipd';
      
	
        $data['department_by'] = 'dpt';
        $data['department_id'] = '';
        $data['flag'] = '1';
        $data['gob'] = 'gob';
		$data['content'] = $this->load->view('god_ipd_2025',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

  public function gob_ipd_2025_date()
	{
      
		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1 = $start_date1;
	    $id   = $this->input->get('dept_id', TRUE);
	  
        $start_date1 = date('Y-m-d',strtotime($start_date1));
        $end_date1   = date('Y-m-d',strtotime($end_date1));
        $section = $this->input->get('section', TRUE);
        $data['section'] = $section;

        $start_date=$start_date1." 00:00:00";
        $end_date=$end_date1." 23:59:00";
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;
		$data['title'] = display('patient_list');
		$year = '%'.$this->session->userdata['acyear'].'%';
		if($id){
		
        $data['patients'] = $this->patient_model->gob_dept_date_2025($id,$section,$start_date,$end_date);
        $data['gendercount'] = $this->db->select('department_new.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
        ->from('patient_ipd')
        ->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
        ->where('create_date LIKE', $year)
        ->where('department_id', $id)
        ->where('ipd_opd', $section)
        ->where('discharge_date LIKE', '%0000-00-00%')
        ->where('create_date <=', $end_date)
        ->group_by('department_new.name, patient_ipd.sex')
        ->get()
        ->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
	 	->where('create_date <=', $end_date)
		->get()
		->result();
			$data['dept_id'] = $id;
		}else{
		$data['patients'] = $this->patient_model->gob_2025($section,$start_date,$end_date);
		    	 
     	}
         
		$section = $section;
		$year = '%'.$this->session->userdata['acyear'].'%';
        $data['department_by'] = 'dpt';
         $data['department_by_section']= 'ipd';
        $data['flag'] = '1';
		$data['datefrom'] = $start_date1;
		$data['dateto'] = $end_date1;
		 $data['gob'] = 'gob';

		$data['content'] = $this->load->view('god_ipd_2025',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}
	
//////////////////gob department//////////////////////////////////////////
public function gob_dept_2025($id='',$section='')
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
        $section = $section;
        $data['section'] = $section;
          
          $data['gendercount'] = $this->db->select('department_new.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
	    ->where('discharge_date LIKE', '%0000-00-00%')
     //	->where('create_date >=', $end_date)

	    ->where('create_date <=', $end_date)
		->group_by('department_new.name, patient_ipd.sex')
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
		$data['content'] = $this->load->view('god_ipd_2025',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}


////////////////D-OPD//////////////////

public function dopd($department_id = '', $section = '')
	{
		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->d_opd_dept_id($department_id_decode, $section);
         $data['section'] = $section;
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
		$data['content'] = $this->load->view('d_opd',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


public function dopd_date()
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
        $data['dept_id'] = $id;

		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->gob_dept_date_2025($id, $section,$start_date,$end_date);
		$section = $section;

		$year = '%'.$this->session->userdata['acyear'].'%';
        if($section =='opd'){
		$data['gendercount'] = $this->db->select('department_new.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department_new', 'patient.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->group_by('department_new.name, patient.sex')
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
          
          $data['gendercount'] = $this->db->select('department_new.name, patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
			->where('discharge_date LIKE', '0000-00-00')
	    ->where('create_date <=', $end_date)
		->group_by('department_new.name, patient_ipd.sex')
		->get()
		->result();
		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
		->where('department_id', $id)
		->where('ipd_opd', $section)
		->where('discharge_date LIKE', '0000-00-00')
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
       $data['section'] = $section;
		$data['content'] = $this->load->view('d_opd',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

    public function d_opd_sky($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);
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
       
		$data['content'] = $this->load->view('d_opd_sky1',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

////////////////////admit_ipd_//////////////////////
public function getpatientbydepartment_admit_register($department_id = '', $section = '')
      {

                    $department_id_decode = rawurldecode($department_id);
                    $data['title'] = display('patient_list');
                    $data['patients'] = $this->patient_model->read_by_dept_id_2025($department_id_decode, $section);
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
                    $data['content'] = $this->load->view('amit_register_ipd',$data,true);
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
        $data['dept_id'] = $id;

		
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->admit_register_ipd_date($id, $section,$start_date,$end_date);

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
		$data['content'] = $this->load->view('amit_register_ipd',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}



   public function netra_mukh_report($department = null)
     {
        if(empty($department))
        {
            $department = $this->input->get('department_id');
        }
        else
        {
            $department = $department;
        }

        if(empty($this->input->get('start_date')))
        {
            $start_date = date("Y-m-d");
        }
        else
        {
            $start_date = date('Y-m-d',strtotime($this->input->get('start_date')));
        }

        if(empty($this->input->get('end_date')))
        {
            $end_date = date("Y-m-d");
        }
        else
        {
            $end_date = date('Y-m-d',strtotime($this->input->get('end_date')));
        }

       

        $data['department_id'] = $department;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['patients'] = $this->db->select('*')
        ->from('patient')
        ->where('ipd_opd','opd')
        ->where('create_date >=',$start_date)
        ->where('create_date <=',$end_date)
        ->where('department_id',$department)
        ->get()
        ->result();
		

        $data['content'] = $this->load->view('netra_mukh_2025',$data,true);
		$this->load->view('layout/main_wrapper',$data);

    } 


	public function netra_mukh_report_ipd($department = null,$section = null)
     {
        if(empty($department))
        {
            $department = $this->input->get('department_id');
        }
        else
        {
            $department = $department;
        }

		 if(empty($section))
        {
            $section = $this->input->get('section');
        }
        else
        {
            $section = $section;
        }

        if(empty($this->input->get('start_date')))
        {
            $start_date = date("Y-m-d");
        }
        else
        {
            $start_date = date('Y-m-d',strtotime($this->input->get('start_date')));
        }

        if(empty($this->input->get('end_date')))
        {
            $end_date = date("Y-m-d");
        }
        else
        {
            $end_date = date('Y-m-d',strtotime($this->input->get('end_date')));
        }

       

        $data['department_id'] = $department;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
		 $data['section'] = $section;
        $data['patients'] = $this->db->select('*')
        ->from('patient')
        ->where('ipd_opd','Ipd')
        ->where('create_date >=',$start_date)
        ->where('create_date <=',$end_date)
        ->where('department_id',$department)
        ->get()
        ->result();
		

        $data['content'] = $this->load->view('netra_mukh_ipd_2025',$data,true);
		$this->load->view('layout/main_wrapper',$data);

    } 




public function patientoccupancy()
	{ 
	    
	    
    	$start_date1 = $this->input->get('start_date', TRUE);
        //$end_date1   = $this->input->get('end_date', TRUE);
        $end_date1 = $start_date1;
        $end_date   = date('Y-m-d',strtotime($end_date1));
		$year = '%'.$this->session->userdata['acyear'].'%';
		$section = 'ipd';
        $data['section'] = $section;
	   $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));


		//echo $section;
        if($end_date1){
		$data['patients'] = $this->db->select("*")
		->from('patient_ipd')
		->where('create_date <=', $end_date)
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('ipd_opd', $section)
            //	->where('discharge_date LIKE', '0000-00-00')
            //->where('discharge_date IS NULL',  null)
            //	->where('create_date LIKE', $year)
            ->get()
            ->result();

            // print_r($data['patients']);   exit;


            $data['gendercount'] = $this->db->select('department_new.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
            ->from('patient_ipd')
            ->where('create_date <=', $end_date)
            ->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
            ->where('discharge_date LIKE', '0000-00-00')
            ->where('create_date LIKE', $year)
            ->where('ipd_opd', $section)
            ->group_by('department_new.name, patient_ipd.sex')
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
            ->join('department_new','department_new.dprt_id = patient_ipd.department_id')
            ->where('ipd_opd', $section)

            //	->where('discharge_date is NULL', NULL, TRUE)
            ->where('discharge_date LIKE', '0000-00-00')
            //->where('create_date LIKE', $year)
            ->get()
            ->result();


            $data['gendercount'] = $this->db->select('department_new.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
            ->from('patient_ipd')
            ->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
            ->where('discharge_date LIKE', '0000-00-00')
            ->where('create_date LIKE', $year)
            ->where('ipd_opd', $section)
            ->group_by('department_new.name, patient_ipd.sex')
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
            $data['content'] = $this->load->view('new_occpancy_2025',$data,true);	
            $this->load->view('layout/main_wrapper',$data);
            }else{
            $this->session->set_flashdata("There is no data available");
            $data['content'] = $this->load->view('new_occpancy_2025',$data,true);	
            $this->load->view('layout/main_wrapper',$data);
            }

	}

public function patient_by_date_occupancy()
	{ 

		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
         $end_date1 = $start_date1;
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
         $start_date= $start_date2." 00:00:00";
		$start_date_f= $start_date2." 23:59:00";
        $end_date= $end_date2." 23:59:00";
        $data['section'] = $section;
		$data['datefrom'] = $start_date;
		$data['dateto'] = $end_date;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")
		->from('patient')
		->join('department_new','department_new.dprt_id =  patient.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('create_date LIKE', $year)
		->get()
		->result();

		$data['gendercount'] = $this->db->select('department_new.name, patient.sex, COUNT(patient.sex) as Gender, COUNT(patient.yearly_reg_no) as New, COUNT(patient.old_reg_no) as old')
		->from('patient')
		->join('department_new', ' patient.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
	    ->group_by('department_new.name, patient.sex')
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
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('discharge_date >=', $start_date_f)
		->where('create_date <=', $end_date)
		 ->where('ipd_opd', 'ipd')
		->get()
		->result();
		//Array 2
		$data['patients2'] = $this->db->select("*")
		->from('patient_ipd')
		->join('department_new','department_new.dprt_id = patient_ipd.department_id')
		->where('create_date <=', $end_date)
		->where('discharge_date LIKE', '%0000-00-00%')
	    ->where('ipd_opd', 'ipd')
		->get()
		->result();
    	$data['patients'] = array_merge($data['patients1'], $data['patients2']);
		$data['gendercount'] = $this->db->select('department_new.name,patient_ipd.sex, COUNT(patient_ipd.sex) as Gender, COUNT(patient_ipd.yearly_reg_no) as New, COUNT(patient_ipd.old_reg_no) as old')
		->from('patient_ipd')
		->join('department_new', 'patient_ipd.department_id = department_new.dprt_id')
		->where('create_date LIKE', $year)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->group_by('department_new.name, patient_ipd.sex')
		->get()
		->result();

		$data['gendercounttotal'] = $this->db->select('COUNT(patient_ipd.sex) as totalGender, COUNT(patient_ipd.yearly_reg_no) as totalNew, COUNT(patient_ipd.old_reg_no) as totalold')
		->from('patient_ipd')
		->where('create_date LIKE', $year)
        ->where("(discharge_date LIKE '0000-00-00')",NULL, FALSE)
		->where('create_date <=', $end_date)
		->where('ipd_opd', $section)
		->get()
		->result();
            
            	$data['department_by_section'] ='ipd';         
         }

		if($data == null){
			$data['content'] = $this->load->view('new_occpancy_2025',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('new_occpancy_2025',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
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
                $data['section'] = $section;
                // $end_date= $start_date;
                
                $year = '%'.$this->session->userdata['acyear'].'%';

            if($section == 'ipd'){
            
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
	
		$data['content'] = $this->load->view('case_paper_print_2025',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
        }
        else{
            
            date_default_timezone_set('Asia/kolkata');
            $data['department_by_section']='opd';
          

            $data['content'] = $this->load->view('case_paper_print_2025',$data,true);		
            $this->load->view('layout/main_wrapper',$data);
        }
	}
    public function case_paper_print_date()
	{ 
	    
		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);		
		$end_date1 = $start_date1;

		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		 $data['section'] = $section;

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
         $data['summery_report']='1';
        }

		//echo $section;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")
		->from('patient')
		->join('department_new','department_new.dprt_id =  patient.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
	    // ->where('yearly_reg_no !=','')
		->where('create_date LIKE', $year)
		->get()
        ->result();
                    $data['department_by_section'] ='opd';  
                }
                else
                {
                       
                $data['patients'] = $this->db->select("*")
                ->from('patient_ipd')
                ->join('department_new','department_new.dprt_id =  patient_ipd.department_id')
                ->where('ipd_opd', $section)
                ->where('create_date >=', $start_date)
                ->where('create_date <=', $end_date)
                ->where('create_date LIKE', $year)
                ->get()
                ->result();
                        $data['department_by_section'] ='ipd';         
                }
                
                                if($data == null){
                    if($section=='opd'){
                            $data['content'] = $this->load->view('case_paper_print_opd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                
                }else{
                    
                if($section=='opd'){
                    
                    
            
                            $data['content'] = $this->load->view('case_paper_print_opd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
            
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                }
                
		
	}	


    public function case_paper_print_opd_blank($section = '')
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
                $data['section'] = $section;
                // $end_date= $start_date;
                
                $year = '%'.$this->session->userdata['acyear'].'%';

            if($section == 'ipd'){
            
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
		$data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
		$data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
	    $data['gobs'] = 'gobs';

		$data['content'] = $this->load->view('case_paper_print_blank_2025',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
        }
        else{
            
            date_default_timezone_set('Asia/kolkata');
            $data['department_by_section']='opd';
            $data['datefrom'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
            $data['dateto'] = $ADV_DAY=date('Y-m-d',strtotime("+ 0 days"));
            

            $data['content'] = $this->load->view('case_paper_print_blank_2025',$data,true);		
            $this->load->view('layout/main_wrapper',$data);
        }
	}


       	public function case_paper_print_date_blank()
	{ 
	    
	    

		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);
		//$end_date1   = $this->input->get('end_date', TRUE);
		$end_date1 = $start_date1;
		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		 $data['section'] = $section;

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
         $data['summery_report']='1';
        }

		//echo $section;

                    if($section=='opd'){
                    $data['patients'] = $this->db->select("*")
                    ->from('patient')
                    ->join('department_new','department_new.dprt_id =  patient.department_id')
                    ->where('ipd_opd', $section)
                    ->where('create_date >=', $start_date)
                    ->where('create_date <=', $end_date)
                    ->where('yearly_reg_no !=','')
                    ->where('create_date LIKE', $year)
                    ->get()
                    ->result();

                    $data['department_by_section'] ='opd';  
                    }
                    else
                    {

                    $data['patients'] = $this->db->select("*")
                    ->from('patient_ipd')
                    ->join('department_new','department_new.dprt_id =  patient_ipd.department_id')
                    ->where('ipd_opd', $section)
                    ->where('create_date >=', $start_date)
                    ->where('create_date <=', $end_date)
                    ->where('create_date LIKE', $year)
                    ->get()
                    ->result();
                    $data['department_by_section'] ='ipd';         
                }
                
                
                if($data == null){
                    if($section=='opd'){
                            $data['content'] = $this->load->view('case_paper_print_opd_blank',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_blank',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                }else{  
                if($section=='opd'){
                            $data['content'] = $this->load->view('case_paper_print_opd_blank',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
            
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_blank',$data,true);	
                            $this->load->view('layout/main_wrapper',$data);
                    }
                }

	}	

















    public function case_paper_print_2025($section = '')
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
                $data['section'] = $section;
                // $end_date= $start_date;
                
                $year = '%'.$this->session->userdata['acyear'].'%';

            if($section == 'ipd'){
            
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
	
		$data['content'] = $this->load->view('case_paper_print_2025_n',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
        }
        else{
            
            date_default_timezone_set('Asia/kolkata');
            $data['department_by_section']='opd';
          

            $data['content'] = $this->load->view('case_paper_print_2025_n',$data,true);		
            $this->load->view('layout/main_wrapper',$data);
        }
	}
    public function case_paper_print_date_2025()
	{ 
	    
		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);		
		$end_date1 = $start_date1;

		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		 $data['section'] = $section;

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
         $data['summery_report']='1';
        }

		//echo $section;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")
		->from('patient')
		->join('department_new','department_new.dprt_id =  patient.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
	    ->where('yearly_reg_no !=','')
		->where('create_date LIKE', $year)
		->get()
        ->result();
                    $data['department_by_section'] ='opd';  
                }
                else
                {
                       
                $data['patients'] = $this->db->select("*")
                ->from('patient_ipd')
                ->join('department_new','department_new.dprt_id =  patient_ipd.department_id')
                ->where('ipd_opd', $section)
                ->where('create_date >=', $start_date)
                ->where('create_date <=', $end_date)
                ->where('create_date LIKE', $year)
                ->get()
                ->result();
                        $data['department_by_section'] ='ipd';         
                }
                
                                if($data == null){
                    if($section=='opd'){
                            $data['content'] = $this->load->view('case_paper_print_opd_2025_n',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                
                }else{
                    
                if($section=='opd'){
                    
                    
            
                            $data['content'] = $this->load->view('case_paper_print_opd_2025_n',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
            
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                }
                
		
	}	
	  





      	public function case_paper_print_all_blank($section = '')
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
                $data['section'] = $section;
                // $end_date= $start_date;
                
                $year = '%'.$this->session->userdata['acyear'].'%';

            if($section == 'ipd'){
            
		date_default_timezone_set('Asia/kolkata');
        $data['department_by_section']='ipd';
	
		$data['content'] = $this->load->view('case_paper_print_2025_black',$data,true);		
		$this->load->view('layout/main_wrapper',$data); 
        }
        else{
            
            date_default_timezone_set('Asia/kolkata');
            $data['department_by_section']='opd';
          

            $data['content'] = $this->load->view('case_paper_print_2025_black',$data,true);		
            $this->load->view('layout/main_wrapper',$data);
        }
	}
    public function case_paper_print_date_all_blanck()
	{ 
	    
		$year = '%'.$this->session->userdata['acyear'].'%';
		$start_date1 = $this->input->get('start_date', TRUE);		
		$end_date1 = $start_date1;

		$start_date2 = date('Y-m-d',strtotime($start_date1));
		$end_date2   = date('Y-m-d',strtotime($end_date1));
		$section = $this->input->get('section', TRUE);
		 $data['section'] = $section;

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
         $data['summery_report']='1';
        }

		//echo $section;

         if($section=='opd'){
		$data['patients'] = $this->db->select("*")
		->from('patient')
		->join('department_new','department_new.dprt_id =  patient.department_id')
		->where('ipd_opd', $section)
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
	    // ->where('yearly_reg_no !=','')
		->where('create_date LIKE', $year)
		->get()
        ->result();
                    $data['department_by_section'] ='opd';  
                }
                else
                {
                       
                $data['patients'] = $this->db->select("*")
                ->from('patient_ipd')
                ->join('department_new','department_new.dprt_id =  patient_ipd.department_id')
                ->where('ipd_opd', $section)
                ->where('create_date >=', $start_date)
                ->where('create_date <=', $end_date)
                ->where('create_date LIKE', $year)
                ->get()
                ->result();
                        $data['department_by_section'] ='ipd';         
                }
                
                                if($data == null){
                    if($section=='opd'){
                            $data['content'] = $this->load->view('case_paper_print_opd_2025_black',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                
                }else{
                    
                if($section=='opd'){
                    
                    
            
                            $data['content'] = $this->load->view('case_paper_print_opd_2025_black',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
            
                    }
                    else{
                            $data['content'] = $this->load->view('case_paper_print_ipd_2025',$data,true);	
                    $this->load->view('layout/main_wrapper',$data);
                    }
                }
                
		
	}	
}