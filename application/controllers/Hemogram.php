<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hemogram extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'hemogram_model'
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
		$data['title'] = display('hemogram');
		$data['labs'] = $this->hemogram_model->read();
		$data['content'] = $this->load->view('hemogram',$data,true);	
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
				$data['hemogram'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => $this->input->post('date'),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'hb'   		   => $this->input->post('hb'),
					'tlc'   => $this->input->post('tlc'),
					'dlc_neutor' => $this->input->post('dlc_neutor'),
					'dlc_lymphocytes' => $this->input->post('dlc_lymphocytes'),
					'monocytes' => $this->input->post('monocytes'),
					'eosinophils' => $this->input->post('eosinophils'),
					'esr' => $this->input->post('esr'),
					'platelet_count'    => $this->input->post('platelet_count'),
					'mp' 	   => $this->input->post('mp'),
					'bt' 	   => $this->input->post('bt'),
					'ct' 	   => $this->input->post('ct'),
					'blood_group'   	   => $this->input->post('blood_group'),
					'hbs'       => $this->input->post('hbs'),
					'hiv'  => $this->input->post('hiv'),
					'vdrl' 		   => $this->input->post('vdrl'), 
					'widal_test' => $this->input->post('widal_test'),
					'sparatyphi' 	   => $this->input->post('sparatyphi'),
					'rafactor'      => $this->input->post('rafactor'),
					'mxtest'     => $this->input->post('mxtest'),
					'sputum'  => $this->input->post('sputum'),
					'samyalse'   => $this->input->post('samyalse'),
					'bsugarf'       => $this->input->post('bsugarf'),
					'blood_sugar_pp' 	   => $this->input->post('blood_sugar_pp'),
					'blood_urea'  => $this->input->post('blood_urea',true), 
					's_creatinine'      => $this->input->post('s_creatinine',true),
					's_uricacid'   => $this->input->post('s_uricacid'),
					's_na' => $this->input->post('s_na'),
					's_k'      => $this->input->post('s_k'),
					'total_cholestrol'      => $this->input->post('total_cholestrol'),
					's_tg'			=> $this->input->post('s_tg'),
					'h_dl'		=> $this->input->post('h_dl'),
					'ldl'	=> $this->input->post('ldl'),
					'vldl'	=> $this->input->post('vldl'),
					's_billirubin'		=> $this->input->post('s_billirubin'),
                    'sgot'		=> $this->input->post('sgot'),
                    'total_protin'		=> $this->input->post('total_protin'),
                    'aib'		=> $this->input->post('aib'),
                    'globulin'		=> $this->input->post('globulin'),
                    'alk_phosphatse'		=> $this->input->post('alk_phosphatse'),
                    's_calcium'		=> $this->input->post('s_calcium'),

				]; 
			
		} else { // update patient
			$data['hemogram'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => $this->input->post('date'),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'hb'   		   => $this->input->post('hb'),
					'tlc'   => $this->input->post('tlc'),
					'dlc_neutor' => $this->input->post('dlc_neutor'),
					'dlc_lymphocytes' => $this->input->post('dlc_lymphocytes'),
					'monocytes' => $this->input->post('monocytes'),
					'eosinophils' => $this->input->post('eosinophils'),
					'esr' => $this->input->post('esr'),
					'platelet_count'    => $this->input->post('platelet_count'),
					'mp' 	   => $this->input->post('mp'),
					'bt' 	   => $this->input->post('bt'),
					'ct' 	   => $this->input->post('ct'),
					'blood_group'   	   => $this->input->post('blood_group'),
					'hbs'       => $this->input->post('hbs'),
					'hiv'  => $this->input->post('hiv'),
					'vdrl' 		   => $this->input->post('vdrl'), 
					'widal_test' => $this->input->post('widal_test'),
					'sparatyphi' 	   => $this->input->post('sparatyphi'),
					'rafactor'      => $this->input->post('rafactor'),
					'mxtest'     => $this->input->post('mxtest'),
					'sputum'  => $this->input->post('sputum'),
					'samyalse'   => $this->input->post('samyalse'),
					'bsugarf'       => $this->input->post('bsugarf'),
					'blood_sugar_pp' 	   => $this->input->post('blood_sugar_pp'),
					'blood_urea'  => $this->input->post('blood_urea',true), 
					's_creatinine'      => $this->input->post('s_creatinine',true),
					's_uricacid'   => $this->input->post('s_uricacid'),
					's_na' => $this->input->post('s_na'),
					's_k'      => $this->input->post('s_k'),
					'total_cholestrol'      => $this->input->post('total_cholestrol'),
					's_tg'			=> $this->input->post('s_tg'),
					'h_dl'		=> $this->input->post('h_dl'),
					'ldl'	=> $this->input->post('ldl'),
					'vldl'	=> $this->input->post('vldl'),
					's_billirubin'		=> $this->input->post('s_billirubin'),
                    'sgot'		=> $this->input->post('sgot'),
                    'total_protin'		=> $this->input->post('total_protin'),
                    'aib'		=> $this->input->post('aib'),
                    'globulin'		=> $this->input->post('globulin'),
                    'alk_phosphatse'		=> $this->input->post('alk_phosphatse'),
                    's_calcium'		=> $this->input->post('s_calcium'),

			]; 
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->hemogram_model->create($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('hemogram' . $patient_id);
			} else {
				if ($this->hemogram_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('hemogram'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('hemogram_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}


	public function profile($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->hemogram_model->read_by_id($id);
		$data['content'] = $this->load->view('hemogram_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function delete($id = null) 
	{ 
		if ($this->hemogram_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('hemogram');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function edit($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['hemogram'] = $this->hemogram_model->read_by_id($id);
		$data['content'] = $this->load->view('hemogram_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
}
