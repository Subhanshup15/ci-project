<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentPatient extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'department_model',
            'patient_model',
		));
		
// 		if ($this->session->userdata('isLogIn') == false 
// 			|| $this->session->userdata('user_role') != 1 
// 		) 
// 		redirect('login'); 

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 

	}
 
	public function index()
	{
        $data['title'] = display('patient_list');
		// $data['patients'] = $this->patient_model->read();
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id, $section);
		$this->load->view('layout/main_wrapper',$data);
    } 
}
?>