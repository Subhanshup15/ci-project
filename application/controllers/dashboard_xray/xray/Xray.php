<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xray extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
            'xray_model',
            'department_model' 
		));

		$this->load->library('excel');

// 		if ($this->session->userdata('isLogIn') == false
// 			|| $this->session->userdata('user_role') != 1) 
// 			redirect('login');

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 
	}
 
	public function index()
	{ 
		$data['title'] = display('lab_list');
		$data['xrays'] = $this->xray_model->read();
		$data['content'] = $this->load->view('xray',$data,true);	
		$this->load->view('layout/main_wrapper',$data);
	} 



	public function create()
	{
		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['xray'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'reg_no'   		   => $this->input->post('reg_no'),
					'opd_no'   		   => $this->input->post('opd_no'),
					'ipd_no'   		   => $this->input->post('ipd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'department_id'   		   => $this->input->post('department_id'),
					'xray_chesast'   		   => $this->input->post('xray_chesast'),
					'xray_kub'   		   => $this->input->post('xray_kub'),
					'other'   => $this->input->post('other'),
					'create_date'   => $this->input->post('create_date')
					
				]; 
			
		} else { // update patient
			$data['xray'] = (object)$postData = [
                'id'   		   => $this->input->post('id'),
                'reg_no'   		   => $this->input->post('reg_no'),
                'opd_no'   		   => $this->input->post('opd_no'),
                'ipd_no'   		   => $this->input->post('ipd_no'),
                'name'   		   => $this->input->post('name'),
                'age'   		   => $this->input->post('age'),
                'department_id'   		   => $this->input->post('department_id'),
                'xray_chesast'   		   => $this->input->post('xray_chesast'),
                'xray_kub'   		   => $this->input->post('xray_kub'),
				'other'   => $this->input->post('other'),
				'create_date' => $this->input->post('create_date')

			]; 
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->xray_model->create($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('xray' . $patient_id);
			} else {
				if ($this->xray_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('xray'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list();
			$data['content'] = $this->load->view('xray_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}


	public function profile($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->xray_model->read_by_id($id);
		$data['content'] = $this->load->view('xray_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	public function edit($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['xray'] = $this->xray_model->read_by_id($id);
		$data['content'] = $this->load->view('xray_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	
	public function delete($id = null) 
	{ 
		if ($this->xray_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('xray');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}
}
