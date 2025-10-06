<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dignosis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'dignosis_model'
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
		$data['title'] = "Dignosis List";
		$data['dignosis'] = $this->dignosis_model->readdignosis();
		$data['content'] = $this->load->view('dignosis',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 


    //Dignosis Start
 	public function createdignosis()
	{
		$data['title'] = display('add_department');
		#-------------------------------#
		$this->form_validation->set_rules('name', "Dignosis name" ,'required|max_length[100]');
		#-------------------------------#
		$data['dignosis'] = (object)$postData = [
			'id_digno' 	  => $this->input->post('id_digno',true),
			'name' 		  => $this->input->post('name',true),
            'description' => $this->input->post('description',true),
            'status'      => $this->input->post('status', true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id_digno then insert data
			if (empty($postData['id_digno'])) {
				if ($this->dignosis_model->createdignosis($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dignosis/createdignosis');
			} else {
				if ($this->dignosis_model->updatedignosis($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('dignosis/edit_dignosis/'.$postData['id_digno']);
			}

		} else {
			$data['content'] = $this->load->view('dignosis_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
    }


    
	public function edit_dignosis($id_digno = null) 
	{
		$data['title'] = "Edit Dignosis";
		#-------------------------------#
		$data['dignosis'] = $this->dignosis_model->read_by_id_dignosis($id_digno);
		$data['content'] = $this->load->view('dignosis_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete_dignosis($id_digno = null) 
	{
		if ($this->dignosis_model->deletedignosis($id_digno)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dignosis');
	}
    

    //Dignosis Sub Category
 	public function create_sub_dignosis()
     {
         $data['title'] = "Add Sub Category";
         #-------------------------------#
         $this->form_validation->set_rules('name', "Dignosis name" ,'required|max_length[100]');
         #-------------------------------#
         $data['dignosis'] = (object)$postData = [
             'id_digno_sub' 	  => $this->input->post('id_digno_sub',true),
             'name' 		  => $this->input->post('name',true),
             'description' => $this->input->post('description',true),
             'id_digno' => $this->input->post('id_digno',true),
             'status'      => $this->input->post('status', true)
         ]; 
         #-------------------------------#
         if ($this->form_validation->run() === true) {
 
             #if empty $id_digno then insert data
             if (empty($postData['id_digno_sub'])) {
                 if ($this->dignosis_model->createsubcat($postData)) {
                     #set success message
                     $this->session->set_flashdata('message', display('save_successfully'));
                 } else {
                     #set exception message
                     $this->session->set_flashdata('exception',display('please_try_again'));
                 }
                 redirect('dignosis/create_sub_dignosis');
             } else {
                 if ($this->dignosis_model->updatesubcat($postData)) {
                     #set success message
                     $this->session->set_flashdata('message', display('update_successfully'));
                 } else {
                     #set exception message
                     $this->session->set_flashdata('exception',display('please_try_again'));
                 }
                 redirect('dignosis/edit_dignosis/'.$postData['id_digno_sub']);
             }
 
         } else {
            $data['dignosis_list'] = $this->dignosis_model->dignosis_list();
             $data['content'] = $this->load->view('dignosis_sub_form',$data,true);
             $this->load->view('layout/main_wrapper',$data);
         } 
     }

    //Dignosis Sub Category List
    public function list_sub_cat(){
        $data['title'] = "Dignosis Category List";
		$data['dignosis'] = $this->dignosis_model->readsubcat();
		$data['content'] = $this->load->view('dignosis_sub_cat',$data,true);
		$this->load->view('layout/main_wrapper',$data);
    }

    
	public function edit_sub_dignosis($id_digno_sub = null) 
	{
		$data['title'] = "Edit Dignosis";
		#-------------------------------#
		$data['dignosis'] = $this->dignosis_model->read_by_id_subcat($id_digno_sub);
		$data['content'] = $this->load->view('dignosis_sub_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete_sub_dignosis($id_digno_sub = null) 
	{
		if ($this->dignosis_model->deletesubcat($id_digno_sub)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dignosis/list_sub_cat');
	}

     //Add Treatment 
 	public function create_treatment()
     {
         $data['title'] = "Add Treatment";
         #-------------------------------#
         $this->form_validation->set_rules('name', "Treatment name" ,'required|max_length[100]');
         #-------------------------------#
         $data['dignosis'] = (object)$postData = [
             'id_treatment' 	  => $this->input->post('id_treatment',true),
             'name' 		  => $this->input->post('name',true),
             'description' => $this->input->post('description',true),
             'id_digno_sub' => $this->input->post('id_digno_sub',true),
             'status'      => $this->input->post('status', true)
         ]; 
         #-------------------------------#
         if ($this->form_validation->run() === true) {
 
             #if empty $id_digno then insert data
             if (empty($postData['id_treatment'])) {
                 if ($this->dignosis_model->createtreatment($postData)) {
                     #set success message
                     $this->session->set_flashdata('message', display('save_successfully'));
                 } else {
                     #set exception message
                     $this->session->set_flashdata('exception',display('please_try_again'));
                 }
                 redirect('dignosis/create_treatment');
             } else {
                 if ($this->dignosis_model->update_treatment($postData)) {
                     #set success message
                     $this->session->set_flashdata('message', display('update_successfully'));
                 } else {
                     #set exception message
                     $this->session->set_flashdata('exception',display('please_try_again'));
                 }
                 redirect('dignosis/edit_treatment/'.$postData['id_treatment']);
             }
 
         } else {
            $data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list();
             $data['content'] = $this->load->view('treatment_form',$data,true);
             $this->load->view('layout/main_wrapper',$data);
         } 
     }


     public function list_treatment(){
        $data['title'] = "Treatment List";
		$data['dignosis'] = $this->dignosis_model->readtreatment();
		$data['content'] = $this->load->view('list_treatment',$data,true);
		$this->load->view('layout/main_wrapper',$data);
    } 

	public function edit_treatment($id_treatment = null) 
	{
		$data['title'] = "Edit Treatment";
		#-------------------------------#
		$data['dignosis'] = $this->dignosis_model->read_by_id_treatment($id_treatment);
		$data['content'] = $this->load->view('treatment_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete_treatment($id_treatment = null) 
	{
		if ($this->dignosis_model->delete_treatment($id_treatment)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('dignosis/list_treatment');
	}
  
}
