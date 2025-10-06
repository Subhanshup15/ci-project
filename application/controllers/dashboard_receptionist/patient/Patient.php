<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dashboard_receptionist/patient/patient_model',
			'dashboard_receptionist/doctor/doctor_model',
			//'dashboard_receptionist/patient/document_model',
			//'dashboard_receptionist/patient/department_model' 
		));
 
// 		if ($this->session->userdata('isLogIn') == false
// 			|| $this->session->userdata('user_role') != 7) 
// 			redirect('login'); 

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 
		
	}
 
	public function index()
	{  
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read();
		$data['content'] = $this->load->view('dashboard_receptionist/patient/patient',$data,true);
		$this->load->view('dashboard_receptionist/main_wrapper',$data);
	}

	public function create()
	{
		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('firstname', display('first_name'),'required|max_length[50]');		
		$this->form_validation->set_rules('blood_group', display('blood_group'),'max_length[10]');
		$this->form_validation->set_rules('sex', display('sex'),'required|max_length[10]');
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


		$q = $this->db->select('yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
		->from('patient')
		->order_by("yearly_no desc")
		->limit(1)->get()->result_array();

		$timezone = "Asia/Kolkata";
 		date_default_timezone_set($timezone);

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
 
 
	 
		 //Yearly Number
		 if($currentYear > $oldyear){
		 //	$yearly_no = 1;
			 $yearly_reg_no = 1;
			 $monthly_reg_no = 1;
 
		 }else{
		 //	$yearly_no = $yearly_no1 + 1;
			 $yearly_reg_no = $yearly_reg_no1 + 1;
			 //Monthly Number
			 if($currentmonth > $oldmonth){			
				 $monthly_reg_no = 1;
				 
			 }else{			
				 $monthly_reg_no = $monthly_reg_no1 + 1;
				 
			 }
		 }
 
		 
 
 
 
		 //Daily Number		
		 if($currentday == $oldday){
			 $daily_reg_no = $daily_reg_no1+1;			
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
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patient
			if($this->input->post('old_reg_no') == null){
				$data['patient'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'patient_id'   => $this->randStrGen(2,7),
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					'yearly_no' => $this->input->post('yearly_no'),
					'monthly_reg_no' => $this->input->post('monthly_reg_no'),
					'daily_reg_no' => $this->input->post('daily_reg_no'),
					'old_reg_no' => $this->input->post('old_reg_no'),
					'firstname'    => $this->input->post('firstname'),
					'lastname' 	   => $this->input->post('lastname'),
					'email' 	   => $this->input->post('email'),
					'password' 	   => md5($this->input->post('password')),
					'phone'   	   => $this->input->post('phone'),
					'mobile'       => $this->input->post('mobile'),
					'blood_group'  => $this->input->post('blood_group'),
					'sex' 		   => $this->input->post('sex'), 
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
					'anesthesia'	=> $this->input->post('anesthesia'),
					'religion'		=> $this->input->post('religion'),
					'result'		=> $this->input->post('result')

				]; 
			}
			else
			{
				$data['patient'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'patient_id'   => $this->randStrGen(2,7),
					'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					'yearly_no' => $this->input->post('yearly_no'),
					'monthly_reg_no' => $this->input->post('monthly_reg_no'),
					'daily_reg_no' => $this->input->post('daily_reg_no'),
					'old_reg_no' => $this->input->post('old_reg_no'),
					'firstname'    => $this->input->post('firstname'),
					'lastname' 	   => $this->input->post('lastname'),
					'email' 	   => $this->input->post('email'),
					'password' 	   => md5($this->input->post('password')),
					'phone'   	   => $this->input->post('phone'),
					'mobile'       => $this->input->post('mobile'),
					'blood_group'  => $this->input->post('blood_group'),
					'sex' 		   => $this->input->post('sex'), 
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
					'anesthesia'	=> $this->input->post('anesthesia'),
					'religion'		=> $this->input->post('religion'),
					'result'		=> $this->input->post('result')
				]; 
			}
		} else { // update patient
			$data['patient'] = (object)$postData = [
				'id'   		   => $this->input->post('id'),
				'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					'yearly_no' => $this->input->post('yearly_no'),
					'monthly_reg_no' => $this->input->post('monthly_reg_no'),
					'daily_reg_no' => $this->input->post('daily_reg_no'),
					'old_reg_no' => $this->input->post('old_reg_no'),
				'firstname'    => $this->input->post('firstname'),
				'lastname' 	   => $this->input->post('lastname'),
				'email' 	   => $this->input->post('email'),
				'password' 	   => md5($this->input->post('password')),
				'phone'   	   => $this->input->post('phone'),
				'mobile'       => $this->input->post('mobile'),
				'blood_group'  => $this->input->post('blood_group'),
				'sex' 		   => $this->input->post('sex'),
				'date_of_birth' => $this->input->post('date_of_birth'),
				'address' 	   => $this->input->post('address'),
				'picture'      => (!empty($picture)?$picture:$this->input->post('old_picture')),
				'affliate'     => null, 
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
				'anesthesia'	=> $this->input->post('anesthesia'),
				'religion'		=> $this->input->post('religion'),
				'result'		=> $this->input->post('result')
			]; 
		}
	#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if ($this->patient_model->create($postData)) {
				$patient_id = $this->db->insert_id();
				#set success message
				$this->session->set_flashdata('message', display('save_successfully'));
			} else {
				#set exception message
				$this->session->set_flashdata('exception', display('please_try_again'));
			}

			redirect('dashboard_receptionist/patient/patient/profile/' . $patient_id);
		

		} else {
			$data['department_list'] = $this->department_model->department_list();
			$data['content'] = $this->load->view('dashboard_receptionist/patient/patient_form',$data,true);
			$this->load->view('dashboard_receptionist/main_wrapper',$data);
		} 



	}


	public function profile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['content'] = $this->load->view('dashboard_receptionist/patient/patient_profile',$data,true);
		$this->load->view('dashboard_receptionist/main_wrapper',$data);
	}


    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randStrGen($mode = null, $len = null){
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
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
	
	public function getpatientbydepartment($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);
		$data['content'] = $this->load->view('dashboard_receptionist/patient/patient',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}


	//Get data by section
	public function getrecordnysection($section = '')
	{
	
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['content'] = $this->load->view('dashboard_receptionist/patient/patient',$data,true);	
			
		$this->load->view('dashboard_receptionist/main_wrapper',$data);
	}
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
	*/
	
	public function patient_by_date()
	{ 
		$year = '%'.$this->session->userdata['acyear'].'%';

		$start_date1 = $this->input->get('start_date', TRUE);

		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));

		$end_date   = date('Y-m-d',strtotime($end_date1));

		$section = $this->input->get('section', TRUE);

		//echo $section;

		$data['patients'] = $this->db->select("*")

		->from('patient')
		
		->join('department','department.dprt_id = patient.department_id')

		->where('ipd_opd', $section)
	
		->where('create_date >=', $start_date)

		->where('create_date <=', $end_date)

		->where('create_date LIKE', $year)

		->get()

		->result();

		//print_r($data);
		//die();


		//$data['patients'] = $this->patient_model->read_by_section_date($getData);
		if($data == null){
			$data['content'] = $this->load->view('dashboard_receptionist/patient/patient',$data,true);	
			$this->load->view('dashboard_receptionist/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('dashboard_receptionist/patient/patient',$data,true);	
			$this->load->view('dashboard_receptionist/main_wrapper',$data);
		}
		
	}	
	

	public function dischargedate($discharge_date, $yearly_no ){

		$year = '%'.$this->session->userdata['acyear'].'%';

		$q = $this->db->select('*')
		->from('patient')
		->where('yearly_no', $yearly_no)->get()->row();


		if($q){
			echo '0';

			$data = array( 
				'discharge_date'	=>  $discharge_date,		
				
			);
			$this->db->where('yearly_no', $yearly_no);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);

		}else{
			echo '1';
		}
	}

}
