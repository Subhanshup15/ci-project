<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'laboratory_model'
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
		$data['labs'] = $this->laboratory_model->read();
		$data['content'] = $this->load->view('laboratory',$data,true);	
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
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => $this->input->post('date'),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					
					'bedno'   		   => $this->input->post('bedno'),
					'hbs'   		   => $this->input->post('hbs'),
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
					'color'       => $this->input->post('color'),
					'consistency'  => $this->input->post('consistency'),
					'mucous' 		   => $this->input->post('mucous'), 
					'pus_cell' => $this->input->post('pus_cell'),
					'rsc' 	   => $this->input->post('rsc'),
					'epitheliacells'      => $this->input->post('epitheliacells'),
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
					'vdrl'	=> $this->input->post('vdrl'),
					's_billirubin'		=> $this->input->post('s_billirubin'),
                    'sgot'		=> $this->input->post('sgot'),
                    'total_protin'		=> $this->input->post('total_protin'),
                    'aib'		=> $this->input->post('aib'),
                    'globulin'		=> $this->input->post('globulin'),
                    'alk_phosphatse'		=> $this->input->post('alk_phosphatse'),
                    
                    'rafactor'		=> $this->input->post('rafactor'),
                    
                    'widal_test'		=> $this->input->post('widal_test'),
                    'sparatyphi'		=> $this->input->post('sparatyphi'),
                    's_calcium'		=> $this->input->post('s_calcium'),

				]; 
			
		} else { // update patient
			$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => $this->input->post('date'),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'hbs'   		   => $this->input->post('hbs'),
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
					'color'       => $this->input->post('color'),
					'consistency'  => $this->input->post('consistency'),
					'mucous' 		   => $this->input->post('mucous'), 
					'pus_cell' => $this->input->post('pus_cell'),
					'rsc' 	   => $this->input->post('rsc'),
					'epitheliacells'      => $this->input->post('epitheliacells'),
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
					'vdrl'	=> $this->input->post('vdrl'),
					's_billirubin'		=> $this->input->post('s_billirubin'),
                    'sgot'		=> $this->input->post('sgot'),
                    'total_protin'		=> $this->input->post('total_protin'),
                    'aib'		=> $this->input->post('aib'),
                    'globulin'		=> $this->input->post('globulin'),
                    'rafactor'		=> $this->input->post('rafactor'),
                    
                    'widal_test'		=> $this->input->post('widal_test'),
                    'sparatyphi'		=> $this->input->post('sparatyphi'),
                    'alk_phosphatse'		=> $this->input->post('alk_phosphatse'),
                    's_calcium'		=> $this->input->post('s_calcium'),

			]; 
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->laboratory_model->create($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory' . $patient_id);
			} else {
				if ($this->laboratory_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('lab_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}
	
	public function create1()
	{
		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
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
					'color'       => $this->input->post('color'),
					'consistency'  => $this->input->post('consistency'),
					'mucous' 		   => $this->input->post('mucous'), 
					'pus_cell' => $this->input->post('pus_cell'),
					'rsc' 	   => $this->input->post('rsc'),
					'epitheliacells'      => $this->input->post('epitheliacells'),
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
			$data['lab'] = (object)$postData = [
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
					'color'       => $this->input->post('color'),
					'consistency'  => $this->input->post('consistency'),
					'mucous' 		   => $this->input->post('mucous'), 
					'pus_cell' => $this->input->post('pus_cell'),
					'rsc' 	   => $this->input->post('rsc'),
					'epitheliacells'      => $this->input->post('epitheliacells'),
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


				if ($this->laboratory_model->create($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory' . $patient_id);
			} else {
				if ($this->laboratory_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('lab_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}


	public function profile($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_id($id);
		$data['content'] = $this->load->view('lab_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function delete($id = null) 
	{ 
		if ($this->laboratory_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function edit($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_id($id);
		$data['content'] = $this->load->view('lab_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	//********************** */
	//Reports Urinexamination
	//********************* */
	public function urineexamination(){
		
		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	

		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
					'id'   		       => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'albumin'   		   => $this->input->post('sugar'),
					'sugar'   		   => $this->input->post('sugar'),
					'bilesalt' 			   => $this->input->post('bilesalt'),
					'bilepigment' 	   => $this->input->post('bilepigment'),
					'ketonebodies'       => $this->input->post('ketonebodies'),
					'pregtest'         => $this->input->post('pregtest'),
					'puscell'   => $this->input->post('puscell'),
					'rbc'               => $this->input->post('rbc'),
					'epithelialcells' 	           => $this->input->post('epithelialcells'),
					'crystals'              => $this->input->post('crystals'),
					'casts' 	           => $this->input->post('casts'),
					'volume'	=> $this->input->post('volume'),
					'colour'	=> $this->input->post('colour'),
					'specificgravity'	=> $this->input->post('specificgravity'),
					'appearance'	=> $this->input->post('appearance'),
					'deposit'	=> $this->input->post('deposit'),
					'occultblood'	=> $this->input->post('occultblood'),
					'granules'	=> $this->input->post('granules'),
					'amorohous'	=> $this->input->post('amorohous'),
					'other'      => $this->input->post('other'),
				];
				}else{
					
				$data['lab'] = (object)$postData = [
					'id'   		       => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'albumin'   		   => $this->input->post('sugar'),
					'sugar'   		   => $this->input->post('sugar'),
					'bilesalt' 			   => $this->input->post('bilesalt'),
					'bilepigment' 	   => $this->input->post('bilepigment'),
					'ketonebodies'       => $this->input->post('ketonebodies'),
					'pregtest'         => $this->input->post('pregtest'),
					'puscell'   => $this->input->post('puscell'),
					'rbc'               => $this->input->post('rbc'),
					'epithelialcells' 	           => $this->input->post('epithelialcells'),
					'crystals'              => $this->input->post('crystals'),
					'casts' 	           => $this->input->post('casts'),
					'volume'	=> $this->input->post('volume'),
					'colour'	=> $this->input->post('colour'),
					'specificgravity'	=> $this->input->post('specificgravity'),
					'appearance'	=> $this->input->post('appearance'),
					'deposit'	=> $this->input->post('deposit'),
					'occultblood'	=> $this->input->post('occultblood'),
					'granules'	=> $this->input->post('granules'),
					'amorohous'	=> $this->input->post('amorohous'),
					'other'      => $this->input->post('other'),
				];
		}

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {

				if ($this->laboratory_model->createurinexamination($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/listurineexamination' . $patient_id);
			} else {
				if ($this->laboratory_model->updateurinexamination($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory/listurineexamination'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('urine_examination',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}
	
	}

	//Testing

	public function profileurinexam($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idurinexamination($id);
		$data['content'] = $this->load->view('profileurinexam',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function deleteurinexamination($id = null) 
	{ 
		if ($this->laboratory_model->deleteurinexamination($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function editurinexam($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idurinexamination($id);
		$data['content'] = $this->load->view('urine_examination',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

//Haemogram reports
	public function haemogram(){

		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'hbs'   		   => $this->input->post('hbs'),
					'tlc'   => $this->input->post('tlc'),
					'dlc_neutor' => $this->input->post('dlc_neutor'),
					'monocytes' => $this->input->post('monocytes'),
					'sparatyphi' => $this->input->post('sparatyphi'),
					'eosinophils' => $this->input->post('eosinophils'),
					'rafactor' => $this->input->post('rafactor'),
					'platelet_count' => $this->input->post('platelet_count'),
					'mp'    => $this->input->post('mp'),
					'bt' 	   => $this->input->post('bt'),
					'esr' => $this->input->post('esr'),
					'ct' 	   => $this->input->post('ct'),
					'blood_group'   	   => $this->input->post('blood_group'),
				];
				}else{
					
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
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
				];
		}

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {

				if ($this->laboratory_model->createhaemogram($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/listhaemogram' . $patient_id);
			} else {
				if ($this->laboratory_model->updatehaemogram($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory/listhaemogram'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('haemogram',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}
	}


	public function profilehaemogram($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idhaemogram($id);
		$data['content'] = $this->load->view('profilehaemogram_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function deletehaemogram($id = null) 
	{ 
		if ($this->laboratory_model->deletehaemogram($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function edithaemogram($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idhaemogram($id);
		$data['content'] = $this->load->view('lab_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


//Biochemical reports
	public function biochemical(){

		
		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
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
				}else{
					
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
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

				if ($this->laboratory_model->createbiochemical($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/listbiochemical' . $patient_id);
			} else {
				if ($this->laboratory_model->updatebiochemical($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory/listbiochemical'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('biochemical2',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}
	}


	public function profilebiochemical($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idbiochemical($id);
		$data['content'] = $this->load->view('profilebiochemical_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function deletebiochemical($id = null) 
	{ 
		if ($this->laboratory_model->deletebiochemical($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function editbiochemical($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idbiochemical($id);
		$data['content'] = $this->load->view('biochemical2',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	//Seological
	public function seological(){

		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
        
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'hbs'       => $this->input->post('hbs'),
					'hiv'  => $this->input->post('hiv'),
					'vdrl' 		   => $this->input->post('vdrl'), 
					'widal_test' => $this->input->post('widal_test'),
					'sparatyphi' 	   => $this->input->post('sparatyphi'),
					'mxtest'      => $this->input->post('mxtest'),
					'sputum'     => $this->input->post('sputum'),
					'rafactor'  => $this->input->post('rafactor')
				];
				}else{
					
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'hbs'       => $this->input->post('hbs'),
					'hiv'  => $this->input->post('hiv'),
					'vdrl' 		   => $this->input->post('vdrl'), 
					'widal_test' => $this->input->post('widal_test'),
					'sparatyphi' 	   => $this->input->post('sparatyphi'),
					'mxtest'      => $this->input->post('mxtest'),
					'sputum'     => $this->input->post('sputum'),
					'rafactor'  => $this->input->post('rafactor')
				];
		}

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->laboratory_model->createseological($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/listseological' . $patient_id);
			} else {
				if ($this->laboratory_model->updateseological($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory/seological');
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('seological',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}

	}
	
	public function seological1(){

		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
		       //echo "test";
		       //exit;
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					
					'sputum'     => $this->input->post('sputum'),
					
				];
				}else{
					
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					
					'sputum'     => $this->input->post('sputum'),
					
				];
		}
        //echo count($data['lab']);
        //print_r($data['lab']);
        //exit;
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {

                 // echo "test";
		         // exit;
				if ($this->laboratory_model->createseological1($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/listseological1' . $id);
			} else {
			      //echo "test";
			      //exit;
				if ($this->laboratory_model->updateseological1($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				//echo "test";
			     // exit;
				redirect('laboratory/listseological1');
			}

		} else {
		     //echo "test";
		     //exit;
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('seological1',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}

	}

	public function profileseological($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idseological($id);
		$data['content'] = $this->load->view('profileseological_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function profileseological1($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idseological1($id);
		$data['content'] = $this->load->view('profileseological_profile1',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function deleteseological($id = null) 
	{ 
		if ($this->laboratory_model->deleteseological($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function editseological($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idseological($id);
		$data['content'] = $this->load->view('seological',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function editseological1($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idseological1($id);
		$data['content'] = $this->load->view('seological1',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}



//Stool Report	
	public function stool(){

		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'color'       => $this->input->post('color'),
					'consistency'  => $this->input->post('consistency'),
					'mucous' 		   => $this->input->post('mucous'), 
					'pus_cell' => $this->input->post('pus_cell'),
					'rsc' 	   => $this->input->post('rsc'),
					'epitheliacells'      => $this->input->post('epitheliacells'),
					
				];
				}else{
					
				$data['lab'] = (object)$postData = [
				'id'   		   => $this->input->post('id'),
				'name'   		   => $this->input->post('name'),
				'age'   		   => $this->input->post('age'),
				'sex'   		   => $this->input->post('sex'),
				'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
				'unitno'   		   => $this->input->post('unitno'),
				'ward'   		   => $this->input->post('ward'),
				'bedno'   		   => $this->input->post('bedno'),
				'color'       => $this->input->post('color'),
				'consistency'  => $this->input->post('consistency'),
				'mucous' 		   => $this->input->post('mucous'), 
				'pus_cell' => $this->input->post('pus_cell'),
				'rsc' 	   => $this->input->post('rsc'),
				'epitheliacells'      => $this->input->post('epitheliacells'),
				];
		}

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->laboratory_model->createstool($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/liststool' . $patient_id);
			} else {
				if ($this->laboratory_model->updatestool($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory/liststool'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('stool',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}

	}


	public function profilestool($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idstool($id);
		$data['content'] = $this->load->view('profilestool_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function deletestool($id = null) 
	{ 
		if ($this->laboratory_model->deletestool($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function editstool($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idstool($id);
		$data['content'] = $this->load->view('stool',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}



	//SEMEN Report	
	public function semen(){

		$data['title'] = display('add_patient');
        $id = $this->input->post('id');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('name'),'required|max_length[50]');	
		
		#-------------------------------#
		if ($this->input->post('id') == null) { //create a patien
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'opd_no'       => $this->input->post('opd_no'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'volume'       => $this->input->post('volume'),
					'colour'  => $this->input->post('colour'),
					'reaction' 		   => $this->input->post('reaction'), 
					'liqification' => $this->input->post('liqification'),
					'total_sperm_count' 	   => $this->input->post('total_sperm_count'),
					'active_sperm'      => $this->input->post('active_sperm'),
					'sluggidh_sperms'  => $this->input->post('sluggidh_sperms'),
					'dead_sperms' 		   => $this->input->post('dead_sperms'), 
					'pus_cells' => $this->input->post('pus_cells'),
					'rbcs' 	   => $this->input->post('rbcs'),
					'morphology'      => $this->input->post('morphology'),
					
				];
				}else{
					
				$data['lab'] = (object)$postData = [
					'id'   		   => $this->input->post('id'),
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
					'date'   		   => date('Y-m-d', strtotime(($this->input->post('date') != null)? $this->input->post('date'): date('Y-m-d'))),
					'unitno'   		   => $this->input->post('unitno'),
					'ward'   		   => $this->input->post('ward'),
					'bedno'   		   => $this->input->post('bedno'),
					'volume'       => $this->input->post('volume'),
					'colour'  => $this->input->post('colour'),
					'reaction' 		   => $this->input->post('reaction'), 
					'liqification' => $this->input->post('liqification'),
					'total_sperm_count' 	   => $this->input->post('total_sperm_count'),
					'active_sperm'      => $this->input->post('active_sperm'),
					'sluggidh_sperms'  => $this->input->post('sluggidh_sperms'),
					'dead_sperms' 		   => $this->input->post('dead_sperms'), 
					'pus_cells' => $this->input->post('pus_cells'),
					'rbcs' 	   => $this->input->post('rbcs'),
					'morphology'      => $this->input->post('morphology'),
				];
		}

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->laboratory_model->createsemen($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('laboratory/listsemen' . $patient_id);
			} else {
				if ($this->laboratory_model->updatesemen($postData)) {
					#set success message
					//$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('laboratory/listsemen'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('semen',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		}

	}


	public function profilesemen($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->laboratory_model->read_by_idsemen($id);
		$data['content'] = $this->load->view('profilesemen_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function deletesemen($id = null) 
	{ 
		if ($this->laboratory_model->deletesemen($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function editsemen($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['lab'] = $this->laboratory_model->read_by_idsemen($id);
		$data['content'] = $this->load->view('semen',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}



	//Report list
	public function listurineexamination(){
		
		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readurinexamination();
		$data['content'] = $this->load->view('listurineexamination',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

	public function listhaemogram(){

		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readhaemogram();
		$data['content'] = $this->load->view('listhaemogram',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}


	public function listbiochemical(){

		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readbiochemical();
		$data['content'] = $this->load->view('listbiochemical',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	
	public function listseological(){

		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readseological();
		$data['content'] = $this->load->view('listseological',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function listseological1(){
       // echo "test";
       // exit(0);
		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readseological1();
		$data['content'] = $this->load->view('listseological1',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	
	public function liststool(){

		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readstool();
		$data['content'] = $this->load->view('liststool',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}

	
	public function listsemen(){

		$data['title'] = display('lab_list');
		$data['labs'] = $this->laboratory_model->readsemen();
		$data['content'] = $this->load->view('listsemen',$data,true);
		$this->load->view('layout/main_wrapper',$data);


	}


	public function listurineexaminationdate(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));

		
		$data['title'] = display('lab_list');
		$data['labs'] = $this->db->select("*")
		->from('urinexamination2')
		->where('created_date >=', $start_date)
		->where('created_date <=', $end_date)
		->get()
		->result();

		$data['content'] = $this->load->view('listurineexamination',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}

	public function lithaemogramdate(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));


		$data['title'] = display('lab_list');
		
		$data['labs'] = $this->db->select("*")
		->from('haemogram')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->get()
		->result();


		$data['content'] = $this->load->view('listhaemogram',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}


	public function listbiochemicaldate(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));


		$data['title'] = display('lab_list');
		
		$data['labs'] = $this->db->select("*")
		->from('biochemicaltest2')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->get()
		->result();


		$data['content'] = $this->load->view('listbiochemical',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	
	public function listseologicaldate(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));


		$data['title'] = display('lab_list');
		
		
		$data['labs'] = $this->db->select("*")
		->from('seological')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->get()
		->result();



		$data['content'] = $this->load->view('listseological',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	
	public function listseological_1date(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));


		$data['title'] = display('lab_list');
		
		
		$data['labs'] = $this->db->select("*")
		->from('sputum')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->get()
		->result();



		$data['content'] = $this->load->view('listseological1',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}

	
	public function liststooldate(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));


		$data['title'] = display('lab_list');
		
		
		$data['labs'] = $this->db->select("*")
		->from('stool')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->get()
		->result();


		$data['content'] = $this->load->view('liststool',$data,true);
		$this->load->view('layout/main_wrapper',$data);

	}

	
	public function listsemendate(){

		$start_date1 = $this->input->get('start_date', TRUE);
		$end_date1   = $this->input->get('end_date', TRUE);


		$start_date = date('Y-m-d',strtotime($start_date1));
		$end_date   = date('Y-m-d',strtotime($end_date1));


		$data['title'] = display('lab_list');
		
		$data['labs'] = $this->db->select("*")
		->from('semen')
		->where('create_date >=', $start_date)
		->where('create_date <=', $end_date)
		->get()
		->result();


		$data['content'] = $this->load->view('listsemen',$data,true);
		$this->load->view('layout/main_wrapper',$data);


	}

}
