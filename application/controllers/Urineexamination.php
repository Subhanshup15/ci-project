<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urineexamination extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'urineexamination_model'
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
		$data['title'] = display('urineexamination');
		$data['urineexaminations'] = $this->urineexamination_model->read();
		$data['content'] = $this->load->view('urineexamination',$data,true);	
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
				$data['urineexamination'] = (object)$postData = [
                    'id'   		   => $this->input->post('id'),
                    'opd_no'       => $this->input->post('opd_no'), 
					'name'   		   => $this->input->post('name'),
					'age'   		   => $this->input->post('age'),
					'sex'   		   => $this->input->post('sex'),
                    'date'   		   => $this->input->post('date'),
                    'doctor'   		   => $this->input->post('doctor'),
					'colour'   		   => $this->input->post('colour'),
					'appearance'   		   => $this->input->post('appearance'),
					'deposit'   		   => $this->input->post('deposit'),
					'reaction'   		   => $this->input->post('reaction'),
					'specificgravity'   => $this->input->post('specificgravity'),
					'albunium' => $this->input->post('albunium'),
					'sugar' => $this->input->post('sugar'),
					'ketone' => $this->input->post('ketone'),
					'bilesalts' => $this->input->post('bilesalts'),
					'bilepigmetics' => $this->input->post('bilepigmetics'),
					'puscells'    => $this->input->post('puscells'),
					'epithelial' 	   => $this->input->post('epithelial'),
					'casts' 	   => $this->input->post('casts'),
					'crystals' 	   => $this->input->post('crystals'),
					'bacteria'   	   => $this->input->post('bacteria'),
					'create_date'       => $this->input->post('create_date'),

				]; 
			
		} else { // update patient
			$data['urineexamination'] = (object)$postData = [
                'id'   		   => $this->input->post('id'),
                'opd_no'       => $this->input->post('opd_no'),
                'name'   		   => $this->input->post('name'),
                'age'   		   => $this->input->post('age'),
                'sex'   		   => $this->input->post('sex'),
                'date'   		   => $this->input->post('date'),
                'doctor'   		   => $this->input->post('doctor'),
                'colour'   		   => $this->input->post('colour'),
                'appearance'   	   => $this->input->post('appearance'),
                'deposit'   	   => $this->input->post('deposit'),
                'reaction'   	   => $this->input->post('reaction'),
                'specificgravity'   => $this->input->post('specificgravity'),
                'albunium' => $this->input->post('albunium'),
                'sugar' => $this->input->post('sugar'),
                'ketone' => $this->input->post('ketone'),
                'bilesalts' => $this->input->post('bilesalts'),
                'bilepigmetics' => $this->input->post('bilepigmetics'),
                'puscells'    => $this->input->post('puscells'),
                'epithelial' 	   => $this->input->post('epithelial'),
                'casts' 	   => $this->input->post('casts'),
                'crystals' 	   => $this->input->post('crystals'),
                'bacteria'   	   => $this->input->post('bacteria'),
                'create_date'       => $this->input->post('create_date'),
			]; 
		}
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {


				if ($this->urineexamination_model->create($postData)) {						
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('urineexamination' . $patient_id);
			} else {
				if ($this->urineexamination_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('urineexamination'.$postData['id']);
			}

		} else {
			$data['department_list'] = $this->department_model->department_list(); 
			$data['content'] = $this->load->view('urineexamination_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}


	public function profile($id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->urineexamination_model->read_by_id($id);
		$data['content'] = $this->load->view('urineexamination_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	
	public function delete($id = null) 
	{ 
		if ($this->urineexamination_model->delete($id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('urineexamination');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function edit($id = null) 
	{ 
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['urineexamination'] = $this->urineexamination_model->read_by_id($id);
		$data['content'] = $this->load->view('urineexamination_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
}
