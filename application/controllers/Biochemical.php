<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biochemical extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'biochemical_model'
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
		$data['biochemicals'] = $this->biochemical_model->read();
		$data['content'] = $this->load->view('biochemical', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function create()
	{
		$data['title'] = display('add_patient');
		$id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'), 'required|max_length[50]');

		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
			$data['biochemical'] = (object)$postData = [
				'id'   		   => $this->input->post('id'),
				'opd_no'       => $this->input->post('opd_no'),
				'name'   		   => $this->input->post('name'),
				'age'   		   => $this->input->post('age'),
				'sex'   		   => $this->input->post('sex'),
				'date'   		   => $this->input->post('date'),
				'doctor'   		   => $this->input->post('doctor'),
				'bs_random'   		   => $this->input->post('bs_random'),
				'bs_fasting'   		   => $this->input->post('bs_fasting'),
				'bs_bb'   		   => $this->input->post('bs_bb'),
				'blood_urea'   => $this->input->post('blood_urea'),
				'srcretinity' => $this->input->post('srcretinity'),
				'srbillirubin' => $this->input->post('srbillirubin'),
				'sgot' => $this->input->post('sgot'),
				'sgot2' => $this->input->post('sgot2'),
				'sralkalinephosphare' => $this->input->post('sralkalinephosphare'),
				'srcholesterol'    => $this->input->post('srcholesterol'),
				'srtriglyserides' 	   => $this->input->post('srtriglyserides'),
				'sruricscidlevel' 	   => $this->input->post('sruricscidlevel'),
				'srprotienlevel' 	   => $this->input->post('srprotienlevel'),
				'sralbuminlevel'   	   => $this->input->post('sralbuminlevel'),
				'srcaciumlevel'       => $this->input->post('srcaciumlevel'),
				'ckmb'  => $this->input->post('ckmb'),
				'srche' 		   => $this->input->post('srche')
			];
		} else { // update patient
			$data['biochemical'] = (object)$postData = [
				'id'   		   => $this->input->post('id'),
				'opd_no'       => $this->input->post('opd_no'),
				'name'   		   => $this->input->post('name'),
				'age'   		   => $this->input->post('age'),
				'sex'   		   => $this->input->post('sex'),
				'date'   		   => $this->input->post('date'),
				'doctor'   		   => $this->input->post('doctor'),
				'bs_random'   		   => $this->input->post('bs_random'),
				'bs_fasting'   		   => $this->input->post('bs_fasting'),
				'bs_bb'   		   => $this->input->post('bs_bb'),
				'blood_urea'   => $this->input->post('blood_urea'),
				'srcretinity' => $this->input->post('srcretinity'),
				'srbillirubin' => $this->input->post('srbillirubin'),
				'sgot' => $this->input->post('sgot'),
				'sgot2' => $this->input->post('sgot2'),
				'sralkalinephosphare' => $this->input->post('sralkalinephosphare'),
				'srcholesterol'    => $this->input->post('srcholesterol'),
				'srtriglyserides' 	   => $this->input->post('srtriglyserides'),
				'sruricscidlevel' 	   => $this->input->post('sruricscidlevel'),
				'srprotienlevel' 	   => $this->input->post('srprotienlevel'),
				'sralbuminlevel'   	   => $this->input->post('sralbuminlevel'),
				'srcaciumlevel'       => $this->input->post('srcaciumlevel'),
				'ckmb'  => $this->input->post('ckmb'),
				'srche' 		   => $this->input->post('srche')

			];
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->biochemical_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('biochemical' . $patient_id);
			} else {
				if ($this->biochemical_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('biochemical' . $postData['id']);
			}
		} else {
			$data['department_list'] = $this->department_model->department_list();
			$data['content'] = $this->load->view('biochemical_form', $data, true);
			$this->load->view('layout/main_wrapper', $data);
		}
	}


	public function profile($id = null)
	{
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->biochemical_model->read_by_id($id);
		$data['content'] = $this->load->view('biochemical_profile', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}



	public function delete($id = null)
	{
		if ($this->biochemical_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
			redirect('biochemical');
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
	}


	public function edit($id = null)
	{
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['biochemical'] = $this->biochemical_model->read_by_id($id);
		$data['content'] = $this->load->view('biochemical_form', $data, true);
		$this->load->view('layout/main_wrapper', $data);
	}
}
