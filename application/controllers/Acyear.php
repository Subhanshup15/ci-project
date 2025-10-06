<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acyear extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'patient_model',
            'doctor_model',
            'document_model',
            'department_model',
            'acyear_model'
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
        $data['title'] = display('Acadmic Year');
        $data['acyears'] = $this->acyear_model->read();
        $data['content'] = $this->load->view('acyear', $data, true);
        $this->load->view('layout/main_wrapper', $data);
    }

    public function create()
    {
        $data['title'] = 'Add Acadmic Year';
        $id = null;

        $this->form_validation->set_rules('year', 'year', 'required|max_length[50]');



        if ($this->input->post('id') == null) {
            $data['acyear'] = (object)$postData = [
                'year' => $this->input->post('year')
            ];
        }
        if ($this->form_validation->run() === true) {

            if ($this->acyear_model->create($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
                redirect('acyear');
            } else {
                #set exception message
                $this->session->set_flashdata('exception', display('please_try_again'));
            }
        } else {
            $data['content'] = $this->load->view('acyear_form', $data, true);
            $this->load->view('layout/main_wrapper', $data);
        }
    }


    public function delete($patient_id = null)
    {
        if ($this->acyear_model->delete($patient_id)) {
            #set success message
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception', display('please_try_again'));
        }
        redirect('acyear');
    }
}
