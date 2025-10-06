<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Account extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

		

		$this->load->model(array(

			'account_manager/account_model'

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

		$data['title'] = display('account_list');

		#-------------------------------#

		$data['accounts'] = $this->account_model->read();

		$data['content'] = $this->load->view('account_manager/account',$data,true);

		$this->load->view('layout/main_wrapper',$data);

	} 



 	public function create()

	{ 

		$data['title'] = display('add_account');

		#-------------------------------#

		$this->form_validation->set_rules('name', display('account_name') ,'required|max_length[100]');

		$this->form_validation->set_rules('type', display('type') ,'required|max_length[20]');

		$this->form_validation->set_rules('description', display('description'),'trim');

		$this->form_validation->set_rules('status', display('status') ,'required');

		#-------------------------------#

		$data['account'] = (object)$postData = [

			'id' 	      => $this->input->post('id',true),

			'name' 		  => $this->input->post('name',true),

			'type' 		  => $this->input->post('type',true),

			'description' => $this->input->post('description',true),

			'date' 		  => date('Y-m-d'),

			'status'      => $this->input->post('status',true)

		]; 

		#-------------------------------#

		if ($this->form_validation->run() === true) {



			#if empty $id then insert data

			if (empty($postData['id'])) {

				if ($this->account_model->create($postData)) {

					#set success message

					$this->session->set_flashdata('message', display('save_successfully'));

				} else {

					#set exception message

					$this->session->set_flashdata('exception',display('please_try_again'));

				}

				redirect('account_manager/account/create');

			} else {

				if ($this->account_model->update($postData)) {

					#set success message

					$this->session->set_flashdata('message', display('update_successfully'));

				} else {

					#set exception message

					$this->session->set_flashdata('exception',display('please_try_again'));

				}

				redirect('account_manager/account/edit/'.$postData['id']);

			}



		} else {

			$data['content'] = $this->load->view('account_manager/account_form',$data,true);

			$this->load->view('layout/main_wrapper',$data);

		} 

	}



	public function edit($id = null) 

	{

		$data['title'] = display('account_edit');

		#-------------------------------#

		$data['account'] = $this->account_model->read_by_id($id);

		$data['content'] = $this->load->view('account_manager/account_form',$data,true);

		$this->load->view('layout/main_wrapper',$data);

	}

 



	public function delete($id = null) 

	{

		if ($this->account_model->delete($id)) {

			#set success message

			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {

			#set exception message

			$this->session->set_flashdata('exception', display('please_try_again'));

		}

		redirect('account_manager/account');

	}

 
	
	public function medical_rate_master(){
	    $data['title'] = "Medical Rate Master Form";
	    
	    if($this->input->post('create_date') != '' || $this->input->post('create_date') != NULL){
            
            $data['medicalRate'] = (object)$postData = [
                    'create_date' => date('Y-m-d', strtotime($this->input->post('create_date'))),
                    'opd_charge' => $this->input->post('opd_charge'),
                    'opd_medicine_charge' => $this->input->post('opd_medicine_charge'),
                    'ipd_bed_charge' => $this->input->post('ipd_bed_charge'),
                    'ipd_medicine_charge' => $this->input->post('ipd_medicine_charge'),
                    'nursing_charge' => $this->input->post('nursing_charge'),
                    'operative_charge_1' => $this->input->post('operative_charge_1'),
                    'assistant_surgeon_charge' => $this->input->post('assistant_surgeon_charge'),
                    'anesthetic_charge' => $this->input->post('anesthetic_charge'),
                    'iv_charge_wi_medicine' => $this->input->post('iv_charge_wi_medicine'),
                    'minor_ot_charge' => $this->input->post('minor_ot_charge'),
                    'major_ot_charge' => $this->input->post('major_ot_charge'),
                    'blood_trans_charge' => $this->input->post('blood_trans_charge'),
                    'dressing_charge' => $this->input->post('dressing_charge'),
                    'documentation_charge' => $this->input->post('documentation_charge'),
                    'bmw_charge' => $this->input->post('bmw_charge'),
                    'sthanik_snehan_swedan' => $this->input->post('sthanik_snehan_swedan'),
                    'sarwang_snehan_swedan' => $this->input->post('sarwang_snehan_swedan'),
                    'shirodhara' => $this->input->post('shirodhara'),
                    'nasya' => $this->input->post('nasya'),
                    'virachan_wi_snehan_swedan' => $this->input->post('virachan_wi_snehan_swedan'),
                    'virachan_wo_snehan_swedan' => $this->input->post('virachan_wo_snehan_swedan'),
                    'janubasti' => $this->input->post('janubasti'),
                    'manya_prushtha_kati_basti' => $this->input->post('manya_prushtha_kati_basti'),
                    'hrudaydhara_hrudaybasti' => $this->input->post('hrudaydhara_hrudaybasti'),
                    'netratarpan' => $this->input->post('netratarpan'),
                    'raktamokshan_siraved' => $this->input->post('raktamokshan_siraved'),
                    'raktamokshan_jalokavachan' => $this->input->post('raktamokshan_jalokavachan'),
                    'vaman' => $this->input->post('vaman'),
                    'shirobasti' => $this->input->post('shirobasti'),
                    'yonidhvan' => $this->input->post('yonidhvan'),
                    'udavartan' => $this->input->post('udavartan'),
                    'urine_routine' => $this->input->post('urine_routine'),
                    'pregnancy_test' => $this->input->post('pregnancy_test'),
                    'cbc' => $this->input->post('cbc'),
                    'mp_card' => $this->input->post('mp_card'),
                    'blood_group' => $this->input->post('blood_group'),
                    'bt_ct_test' => $this->input->post('bt_ct_test'),
                    'bsl_r' => $this->input->post('bsl_r'),
                    'bsl_f_pp' => $this->input->post('bsl_f_pp'),
                    'blood_urea' => $this->input->post('blood_urea'),
                    'sr_creatinine' => $this->input->post('sr_creatinine'),
                    'cholesetrol' => $this->input->post('cholesetrol'),
                    'sr_uric_acid' => $this->input->post('sr_uric_acid'),
                    'protein' => $this->input->post('protein'),
                    'albumine' => $this->input->post('albumine'),
                    'sr_sgpt' => $this->input->post('sr_sgpt'),
                    'sr_sgot' => $this->input->post('sr_sgot'),
                    'alk_phosphate' => $this->input->post('alk_phosphate'),
                    'acid_phosphate' => $this->input->post('acid_phosphate'),
                    'triglyseride' => $this->input->post('triglyseride'),
                    'sr_calcium' => $this->input->post('sr_calcium'),
                    'phosphate' => $this->input->post('phosphate'),
                    'lipid_profile' => $this->input->post('lipid_profile'),
                    'sr_bilirubin' => $this->input->post('sr_bilirubin'),
                    'widal_test' => $this->input->post('widal_test'),
                    'vdrl_test' => $this->input->post('vdrl_test'),
                    'ra_test' => $this->input->post('ra_test'),
                    'crp_test' => $this->input->post('crp_test'),
                    'hbsag_test' => $this->input->post('hbsag_test'),
                    'hiv_test' => $this->input->post('hiv_test'),
                    'prothrombin_time_esr' => $this->input->post('prothrombin_time_esr'),
                    't3_t4_tsh' => $this->input->post('t3_t4_tsh'),
                    'prolactin' => $this->input->post('prolactin'),
                    'lft_test' => $this->input->post('lft_test'),
                    'rft_test' => $this->input->post('rft_test'),
                    'x_ray_test' => $this->input->post('x_ray_test'),
                    'ecg_test' => $this->input->post('ecg_test'),
                    'usg_test' => $this->input->post('usg_test')
                ];
            $tableName = 'bill_master';
            $create_date = $this->input->post('create_date');
            if($this->input->post('updateFlag')=='0'){
                if ($this->account_model->create_bill_master($tableName,$postData)) {
    					$this->session->set_flashdata('message', display('save_successfully'));
    			} else {
    				$this->session->set_flashdata('exception',display('please_try_again'));
    			}
            }elseif($this->input->post('updateFlag')=='1'){
                if ($this->account_model->update_bill_master($tableName,$postData)) {
    					$this->session->set_flashdata('message', display('update_successfully'));
    			} else {
    				$this->session->set_flashdata('exception',display('please_try_again'));
    			}
            }
			redirect('account_manager/account/medical_rate_master');
	    }
	    
	    $data['content'] = $this->load->view('account_manager/medical_rate_master_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
	public function getBillMasterDataDateWise(){
	    $tableName = 'bill_master';
	    $create_date = date('Y-m-d', strtotime($this->input->post('create_date')));
	    $result = $this->account_model->getBillMasterDataDateWise($tableName,$create_date);
	    echo json_encode($result);
	}
  

}


