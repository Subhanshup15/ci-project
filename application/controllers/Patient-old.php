<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_rrr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		$this->load->model(array(
			'patient_model',
			'doctor_model',
			'document_model',
			'department_model',
			'dignosis_model'
		));

		$this->load->library('excel');

		if ($this->session->userdata('isLogIn') == false
			|| $this->session->userdata('user_role') != 1) 
			redirect('login');
	}
 
	public function index()
	{ 
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read();
		$data['content'] = $this->load->view('patient',$data,true);	
		$this->load->view('layout/main_wrapper',$data);
	} 

    public function email_check($email, $id)
    { 
        $emailExists = $this->db->select('email')
            ->where('email',$email) 
            ->where_not_in('id',$id) 
            ->get('patient')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
            return false;
        } else {
            return true;
        }
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
	
			$acyear = $this->session->userdata('acyear');
	
			$q = $this->db->select('yearly_reg_no, yearly_no, monthly_reg_no, daily_reg_no, old_reg_no, create_date')
			->from('patient')
			//->where('create_date LIKE', $acyear)
			->order_by("id desc")
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
				$yearly_no = 1;
				$monthly_reg_no = 1;
	
			}else{
			//	$yearly_no = $yearly_no1 + 1;
				$yearly_no = $yearly_no1 + 1;
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
						'yearly_no' => $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'ipd_no' => $this->input->post('ipd_no'),
						'old_reg_no' => NULL,
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
						'id_digno_sub'      => $this->input->post('id_digno_sub'),
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
						//'yearly_reg_no' =>  $this->input->post('yearly_reg_no'),
						'yearly_no' =>  $yearly_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'old_reg_no' => $this->input->post('old_reg_no'),
						'ipd_no' => $this->input->post('ipd_no'),
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
						'id_digno_sub'      => $this->input->post('id_digno_sub'),
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
					//'yearly_reg_no' => $this->input->post('yearly_reg_no'),
					//	'yearly_no' => $this->input->post('yearly_no'),
					//	'monthly_reg_no' => $this->input->post('monthly_reg_no'),
					//	'daily_reg_no' => $this->input->post('daily_reg_no'),
					//	'old_reg_no' => $this->input->post('old_reg_no'),
					'ipd_no' => $this->input->post('ipd_no'),
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
					'id_digno_sub'      => $this->input->post('id_digno_sub'),
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
			if (empty($postData['id'])) {
				if ($this->patient_model->create($postData)) {			
					

					
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect('patient/create',$data,true);
			} else {
				if ($this->patient_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect('patient/edit/'.$postData['id']);
			}

		} else {
			$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list(); 
			$data['department_list'] = $this->department_model->department_list();
			$data['content'] = $this->load->view('patient_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}


	public function profile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['content'] = $this->load->view('patient_profile',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}


	public function ipdprofile($patient_id = null)
	{ 
		$data['title'] =  display('patient_information');
		#-------------------------------#
		$data['profile'] = $this->patient_model->read_by_id($patient_id);
		$data['documents'] = $this->document_model->read_by_patient($patient_id);
		$data['doctor'] = $this->doctor_model->read_by_id($data['profile']->doctor_id);
		$data['content'] = $this->load->view('patientipd_profile2',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}



	public function edit($patient_id = null) 
	{ 
		//print_r('hi');
		//die();
		$data['title'] = display('patient_edit');
		#-------------------------------#
		$data['patient'] = $this->patient_model->read_by_id($patient_id);
		$data['dignosis_list'] = $this->dignosis_model->dignosis_sub_list(); 
		$data['department_list'] = $this->department_model->department_list(); 
		$data['content'] = $this->load->view('patient_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function getpatientbydepartment($department_id = '', $section = '')
	{

		$department_id_decode = rawurldecode($department_id);
		$data['title'] = display('patient_list');
		$data['patients'] = $this->patient_model->read_by_dept_id($department_id_decode, $section);
		$data['content'] = $this->load->view('patient',$data,true);
		
		$this->load->view('layout/main_wrapper',$data);
	}


	//Get data by section
	public function getrecordnysection($section = '')
	{
		$data['title'] = display('patient_list');

		$data['date'] = (object)$getData = array(  	
			'start_date' => date('Y-m-d', strtotime(($this->input->post('start_date',true) != null)? $this->input->post('start_date',true): date('Y-m-d'))),
			'end_date' => date('Y-m-d', strtotime(($this->input->post('end_date',true) != null)? $this->input->post('end_date',true): date('Y-m-d'))), 
		);

		$data['patients'] = $this->patient_model->read_by_section($section);
		$data['content'] = $this->load->view('patient',$data,true);		
		$this->load->view('layout/main_wrapper',$data);
	}


	public function delete($patient_id = null) 
	{ 
		if ($this->patient_model->delete($patient_id)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
			redirect('patientList/opd');
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		
	}


	public function pdfdownload(){
		//PDF Download 
		if(isset($_POST['btn_excel_download'])){
			$arr_user_ids = $this->input->post('checkbox');
			$delimiter = ",";
			$newline = "\r\n";
			$this->load->dbutil();
			$this->load->helper('file');
			$this->load->helper('download');
			$filename = 'Patient' . date('YmdHis').".csv";
			
			$this->db->select('*');
			$this->db->from('patient');
			
			$user_account = $this->session->userdata('user_account');
			}
			$result = $this->db->get();
			$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
			force_download($filename, $data);
		}
	



    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
	*/
	
	public function randStrGen($mode = null, $len = null){
		$result = "";
/*
		$currentdate = date('d');
		$currentmonth = date('m');
		$currentYear = date('y');
		print_r($currentdate);
		print_r($currentmonth);
		print_r($currentYear);
		die();
	*/

        if($mode == 1):
            $chars = "0123456789";
        elseif($mode == 2):
            $chars = "0123456789";
        elseif($mode == 3):
            $chars = "0123456789";
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

    public function randStrGenforday(){
		$result = "";

		$currentdate = date('d/m/y');
		print_r($currentdate);
		die();

        if($mode == 1):
            $chars = "0123456789";
        elseif($mode == 2):
            $chars = "0123456789";
        elseif($mode == 3):
            $chars = "0123456789";
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
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */


	public function document()
	{ 
		$data['title'] = display('document_list');
		$data['documents'] = $this->document_model->read();
		$data['content'] = $this->load->view('document',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 


    public function document_form()
    {  
        $data['title'] = display('add_document'); 
        /*----------VALIDATION RULES----------*/
        $this->form_validation->set_rules('patient_id', display('patient_id') ,'required|max_length[30]');
        $this->form_validation->set_rules('doctor_name', display('doctor_id'),'max_length[11]');
        $this->form_validation->set_rules('description', display('description'),'trim');
        $this->form_validation->set_rules('hidden_attach_file', display('attach_file'),'required|max_length[255]');
        /*-------------STORE DATA------------*/
        $urole = $this->session->userdata('user_role');
        $data['document'] = (object)$postData = array( 
            'patient_id'  => $this->input->post('patient_id'),
            'doctor_id'   => $this->input->post('doctor_id'),
            'description' => $this->input->post('description'),
            'hidden_attach_file' => $this->input->post('hidden_attach_file'),
            'date'        => date('Y-m-d'),
            'upload_by'   => (($urole==10)?0:$this->session->userdata('user_id'))
        );  

        /*-----------CREATE A NEW RECORD-----------*/
        if ($this->form_validation->run() === true) { 
 
            if ($this->document_model->create($postData)) {
                #set success message
                $this->session->set_flashdata('message', display('save_successfully'));
            } else {
                #set exception message
                $this->session->set_flashdata('exception',display('please_try_again'));
            }
            redirect('patient/document_form');
        } else {
            $data['doctor_list'] = $this->doctor_model->doctor_list(); 
            $data['content'] = $this->load->view('document_form',$data,true);
            $this->load->view('layout/main_wrapper',$data);
        }  
    } 


    public function do_upload()
    {
        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');  
        ini_set('post_max_size', '200M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);

        if (($_SERVER['REQUEST_METHOD']) == "POST") { 
            $filename = $_FILES['attach_file']['name'];
            $filename = strstr($filename, '.', true);
            $email    = $this->session->userdata('email');
            $filename = strstr($email, '@', true)."_".$filename;
            $filename = strtolower($filename);
            /*-----------------------------*/

            $config['upload_path']   = FCPATH .'./assets/attachments/';
            // $config['allowed_types'] = 'csv|pdf|ai|xls|ppt|pptx|gz|gzip|tar|zip|rar|mp3|wav|bmp|gif|jpg|jpeg|jpe|png|txt|text|log|rtx|rtf|xsl|mpeg|mpg|mov|avi|doc|docx|dot|dotx|xlsx|xl|word|mp4|mpa|flv|webm|7zip|wma|svg';
            $config['allowed_types'] = '*';
            $config['max_size']      = 0;
            $config['max_width']     = 0;
            $config['max_height']    = 0;
            $config['file_ext_tolower'] = true; 
            $config['file_name']     =  $filename;
            $config['overwrite']     = false;

            $this->load->library('upload', $config);

            $name = 'attach_file';
            if ( ! $this->upload->do_upload($name) ) {
                $data['exception'] = $this->upload->display_errors();
                $data['status'] = false;
                echo json_encode($data);
            } else {
                $upload =  $this->upload->data();
                $data['message'] = display('upload_successfully');
                $data['filepath'] = './assets/attachments/'.$upload['file_name'];
                $data['status'] = true;
                echo json_encode($data);
            }
        }  
    } 


    public function document_delete($id = null)
    {
    	if ($this->document_model->delete($id)) {

	    	$file = $this->input->get('file');
	    	if (file_exists($file)) {
	    		@unlink($file);
	    	}
    		$this->session->set_flashdata('message', display('save_successfully'));

    	} else {
    		$this->session->set_flashdata('exception', display('please_try_again'));
    	}

    	redirect($_SERVER['HTTP_REFERER']);
	}
	

	public function doctor_by_department()
    {
        $department_id = $this->input->post('department_id');

        if (!empty($department_id)) {
            $query = $this->db->select('user_id,firstname,lastname')
                ->from('user')
                ->where('department_id',$department_id)
                ->where('user_role',2)
                ->where('status',1)
                ->get();

            $option = "<option value=\"\">".display('select_option')."</option>"; 
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $doctor) {
                    $option .= "<option value=\"$doctor->user_id\">$doctor->firstname $doctor->lastname</option>";
                } 
                $data['message'] = $option;
                $data['status'] = true;
            } else {
                $data['message'] = display('no_doctor_available');
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invalid_department');
            $data['status'] = null;
        }

        echo json_encode($data);
    }

	public function import()
	{
		$configUpload['upload_path'] = FCPATH.'/'; //Upload Excel
		$configUpload['allowed_types'] = 'xls|xlsx|csv';
		$configUpload['max_size'] = '500000000000';
		$this->load->library('upload', $configUpload);
		$this->upload->do_upload('userfile');  //	
		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
		$file_name = $upload_data['file_name']; //uploded file name
		$extension=$upload_data['file_ext'];    // uploded file extension


		//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		//Set to read only
		$objReader->setReadDataOnly(true); 		  
		//Load excel file
		$objPHPExcel=$objReader->load(FCPATH.$file_name);		 
		$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);

		//loop from first data untill last data
		for($i=2;$i<=$totalrows;$i++)
		{

			$patient_id	 = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
			$yearly_no = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
			$daily_reg_no = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
			$monthly_reg_no = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
			$yearly_reg_no = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
			$old_reg_no = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
			$date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(6, $i)->getValue()));
			$firstname = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
			$sex = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
			$date_of_birth = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
			$address = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
			$department_id = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
			$degis_id = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
			$ipd_opd = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
			$ipd_no = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
			$discharge_date = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(15, $i)->getValue()));

			$data['patient'] = (object)$postData = [
						'patient_id'   => $patient_id,
						'yearly_no'	=> $yearly_no,	
						'yearly_reg_no' => $yearly_reg_no,
						'monthly_reg_no' => $monthly_reg_no,
						'daily_reg_no' => $daily_reg_no,
						'old_reg_no' => $old_reg_no,
						'create_date' => $date,
						'firstname'    => $firstname,						
						'sex' 		   => $sex,
						'date_of_birth' => $date_of_birth,
						'address' 	   => $address,
						'department_id'  => $department_id,
						'degis_id'      => $degis_id,
						'ipd_opd' 	   => $ipd_opd,	
						'ipd_no'	=> $ipd_no,
						'discharge_date'  => $discharge_date
			];			

			$this->patient_model->create($postData);			
		}
		unlink('/'.$file_name); //File Deleted After uploading in database .			 
        redirect(base_url() . "patient");

		
	}


	public function check_patient($mode = null)
    	{
		$year = '%'.$this->session->userdata['acyear'].'%';
        	$old_reg_no = $this->input->post('old_reg_no');			
		
        if (!empty($old_reg_no)) {
            $query = $this->db->select('*')
                ->from('patient')
                ->where('yearly_reg_no', $old_reg_no)
				->where('create_date Like',$year)
				->where('status',1)
                ->get();
				//->result()
				//print_r(get());	

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $data['patient'] = $result;
                $data['status'] = true;
            } else {
                $data['message'] = "Invalid yearly number";
                $data['status'] = false;
            }
        } else {
            $data['message'] = display('invlid_input');
            $data['status'] = null;
        }

        //return data
        if ($mode === true) {
            return json_encode($data);
        } else {
            echo json_encode($data);
        }

	}


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
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}else{
			$this->session->set_flashdata("There is no data available");
			$data['content'] = $this->load->view('patient',$data,true);	
			$this->load->view('layout/main_wrapper',$data);
		}
		
	}	
	


	public function dischargedate($discharge_date, $yearly_reg_no ){


		$year = '%'.$this->session->userdata['acyear'].'%';
		$section = 'ipd';

		$q = $this->db->select('*')
		->from('patient')
		->where('yearly_reg_no', $yearly_reg_no)
		->where('ipd_opd', $section)
		->or_where('old_reg_no', $yearly_reg_no)->get()->result();

		$registration1 = $q[0]->old_reg_no;
		$registration2 = $q[0]->yearly_reg_no;
        
        $discharge_date = urldecode($discharge_date);
		//Check registration value
		if($registration2 != null){

			
			
			$data = array( 
				'discharge_date'	=>  date("Y-m-d H:i:s", strtotime($discharge_date)),		
			);
			

			$this->db->where('yearly_reg_no', $registration2);
			$this->db->where('ipd_opd', $section);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);


			// die();

			print_r($registration2);

		}else{

			//$registration = $registration1;			
			$data = array( 
				'discharge_date'	=>   date("Y-m-d H:i:s",strtotime($discharge_date)),		
			);	
            //print_r($data);die;
			$this->db->where('old_reg_no', $registration1);
			$this->db->where('ipd_opd', $section);
			$this->db->where('create_date LIKE', $year);
			$this->db->update('patient', $data);

			// die();

			print_r($registration1);
		
		}		

	}

	public function admitpatient(){


		$year = '%'.$this->session->userdata['acyear'].'%';
		$section = 'ipd';
		$date = "";

		$data['patients1'] = $this->db->select('*')
		->from('patient')
		->join('department','department.dprt_id = patient.department_id')
		->where('ipd_opd', $section)
		->where('discharge_date IS NULL')
		->where('create_date LIKE', $year)->get()->result();

		
		$data['patients2'] = $this->db->select('*')
		->from('patient')
		->join('department','department.dprt_id = patient.department_id')
		->where('ipd_opd', $section)
		->where('create_date LIKE', $year)
		->where('discharge_date', $date)->get()->result();

		$data['patients'] = array_merge($data['patients1'], $data['patients2']);

		//print_r($data);

		//$data['patients'] = $this->patient_model->read();
		$data['department_list'] = $this->department_model->department_list(); 
		$data['content'] = $this->load->view('patient',$data,true);	
		$this->load->view('layout/main_wrapper',$data);

	}

}
