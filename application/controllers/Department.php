<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'department_model'
		));
		
// 		if ($this->session->userdata('isLogIn') == false 
// 			|| $this->session->userdata('user_role') != 1 
// 		) 
// 		redirect('login'); 

        if ($this->session->userdata('isLogIn') == false)
        redirect('login'); 

	}
 	public function set_time()
	{    
		$data['title'] = "Set OPD/IPD Time";
	    $data['auto'] = $this->department_model->set_auto();
		$data['department'] = $this->department_model->set_time();
		$data['content'] = $this->load->view('set_time',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 
	
		
	public function index()
	{
		$data['title'] = display('department_list');
		$data['departments'] = $this->department_model->read();
		$data['content'] = $this->load->view('department',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	} 

    	public function data_limit(){
		$data['title'] = display('data_Limit');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'data_limit')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/data_limit');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('data_limit');
			  $data['content'] = $this->load->view('data_limit',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
		public function Admit_limit(){
		$data['title'] = display('Admit Patient limit');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'admit')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/Admit_limit');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('admit');
			  $data['content'] = $this->load->view('Admit_limit',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
	  public function Discharge_limit(){
		$data['title'] = display('Discharge Patient Limit');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'discharge')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/Discharge_limit');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('discharge');
			  $data['content'] = $this->load->view('Discharge_limit',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
	public function deprt_kaya(){
		$data['title'] = display('Department - Kayachikitsa');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_kaya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_kaya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_kaya');
			  $data['content'] = $this->load->view('deprt_kaya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
			public function deprt_panch(){
		$data['title'] = display('Department - Panchkarma');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_panch')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_panch');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_panch');
			  $data['content'] = $this->load->view('deprt_panch',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
		public function deprt_bal(){
		$data['title'] = display('Department - Balroga');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_bal')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_bal');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_bal');
			  $data['content'] = $this->load->view('deprt_bal',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
		
			public function deprt_shalya(){
		$data['title'] = display('Department - Shalyatantra');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_shalya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_shalya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_shalya');
			  $data['content'] = $this->load->view('deprt_shalya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
		
			public function deprt_shalakya(){
		$data['title'] = display('Department - Shalakyatantra');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_shalakya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_shalakya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_shalakya');
			  $data['content'] = $this->load->view('deprt_shalakya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
			public function deprt_stri(){
		$data['title'] = display('Department - Striroga');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_stri')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_stri');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_stri');
			  $data['content'] = $this->load->view('deprt_stri',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
			public function deprt_swasth(){
		$data['title'] = display('Department - Swasthrakshnam');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_swasth')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_swasth');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_swasth');
			  $data['content'] = $this->load->view('deprt_swasth',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
			public function deprt_aatya(){
		$data['title'] = display('Department - Aatyaika');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_aatya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_aatya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_aatya');
			  $data['content'] = $this->load->view('deprt_aatya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	



	public function add_holiday(){
	    
		$data['title'] = display('Holiday');
	          
			  $data['patients'] = $this->department_model->read_by_holiday();
			  $data['content'] = $this->load->view('add_holiday',$data,true);
	          $this->load->view('layout/main_wrapper',$data);
	       

		} 
		
		public function save_holiday(){
		$data['title'] = display('Holiday');
		 
	    $holiday_day =date('Y-m-d',strtotime($this->input->post('create_date',true)));
		$data['holiday'] = (object)$postData = [
		
			'holiday_date' 		  => $holiday_day,
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	   if ($this->department_model->save_holiday($postData)) {
					#set success message
					$this->session->set_flashdata('message','Save Holiday Successfully');
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/add_holiday');
			
		

		} 	



	public function deprt_kaya_ipd(){
		$data['title'] = display('Department - Kayachikitsa');
		$gender=$this->uri->segment(3);
		
		if($gender=='m'){
		    $gender1="m";
		}else{
		     $gender1="f";
		}
		$updte_gender=$this->input->post('description');
		
		if(!empty($updte_gender) && ($updte_gender =='f')) { 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit_f' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
		} else{
		    
		    	$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit_m' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
		}

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit_ipd($postData,'deprt_kaya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_kaya',$da);
			}
			else {
			    
			    $data['gender'] =$gender1;
			   $data['department'] = $this->department_model->read_by_data_ipd('deprt_kaya',$gender1);
			  $data['content'] = $this->load->view('deprt_kaya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
			public function deprt_panch_ipd(){
		$data['title'] = display('Department - Panchkarma');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_panch')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_panch');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_panch');
			  $data['content'] = $this->load->view('deprt_panch',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 
		
		
		public function data_limit_dept_ipd(){
		$data['title'] = display('Department Data Limit For IPD');
		 
		
	   
			  $data['department'] = $this->department_model->read_by_dept_ipd();
			  
			  $data['content'] = $this->load->view('data_limit_dept_ipd',$data,true);
	          $this->load->view('layout/main_wrapper',$data);
	      

		} 
		
		
		public function data_limit_dept_ipd_update(){
	
		 $dept_id=$_POST["dept_id"];
         $data_limit_f = $_POST["data_limit_f"];
         $data_limit_m = $_POST["data_limit_m"];
        // print_r($dept_id);
         
         for($i=0;$i<count($dept_id);$i++){
	      echo $dept_id[$i]."<br>";
         
         	 $data['department'] = (object)$postData = [
			'id' 	  => $dept_id[$i],
			'data_limit_f' 		  => $data_limit_f[$i],
			'data_limit_m' => $data_limit_m[$i],
			'status'      => '1'
		     ]; 
		
	        $this->department_model->data_limit_dept_ipd_update($postData);
             }
		
			
		    $this->session->set_flashdata('message', display('update_successfully'));
				
		    redirect('department/data_limit_dept_ipd');
			

		} 
		
    	public function save_opd_ipd_time(){
	
		 $id=$_POST["id"];
         $start_time = $_POST["start_time"];
         $end_time = $_POST["end_time"];
        // print_r($id);
        // exit;
         for($i=0;$i<count($id);$i++){
	      echo $id[$i]."<br>";
         
         	 $data['department'] = (object)$postData = [
			'id' 	  => $id[$i],
			'start_time' 		  => $start_time[$i],
			'end_time' => $end_time[$i],
			'status'      => '1'
		     ]; 
		
	        $this->department_model->update_opd_ipd_time($postData);
             }
		
			
		    $this->session->set_flashdata('message', display('update_successfully'));
				
		    redirect('department/set_time');
			

		} 
		
		
			public function save_auto(){
	
		 
         $auto = $_POST["auto"];
        
         	 $data['department'] = (object)$postData = [
			'id' 	  => '1',
			'status' => $auto
			
		     ]; 
		
	        $this->department_model->update_auto($postData);
           
		
			
		    $this->session->set_flashdata('message', display('update_successfully'));
				
		    redirect('department/set_time');
			

		} 
		public function data_limit_dept_opd(){
		        
		       $data['title'] = display('Department Data Limit For OPD');
		       $data['department'] = $this->department_model->read_by_dept_opd();
			  
			   $data['content'] = $this->load->view('data_limit_dept_opd',$data,true);
	           $this->load->view('layout/main_wrapper',$data);
	      

		} 
		
	   public function data_limit_dept_opd_update(){
		
		 $dept_id=$_POST["dept_id"];
         $data_limit_f = $_POST["data_limit"];
         
         for($i=0;$i<count($dept_id);$i++){
	      echo $dept_id[$i]."<br>";
         
         	 $data['department'] = (object)$postData = [
			'id' 	  => $dept_id[$i],
			'data_limit' 		  => $data_limit_f[$i],
			'status'      => '1'
		     ]; 
		
	        $this->department_model->data_limit_dept_opd_update($postData);
             }
		
			
		    $this->session->set_flashdata('message', display('update_successfully'));
				
		    redirect('department/data_limit_dept_opd');
			

		} 
		
		
		public function deprt_bal_ipd(){
		$data['title'] = display('Department - Balroga');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_bal')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_bal');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_bal');
			  $data['content'] = $this->load->view('deprt_bal',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
		
			public function deprt_shalya_ipd(){
		$data['title'] = display('Department - Shalyatantra');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_shalya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_shalya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_shalya');
			  $data['content'] = $this->load->view('deprt_shalya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
		
			public function deprt_shalakya_ipd(){
		$data['title'] = display('Department - Shalakyatantra');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_shalakya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_shalakya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_shalakya');
			  $data['content'] = $this->load->view('deprt_shalakya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
			public function deprt_stri_ipd(){
		$data['title'] = display('Department - Striroga');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_stri')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_stri');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_stri');
			  $data['content'] = $this->load->view('deprt_stri',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
		
			public function deprt_swasth_ipd(){
		$data['title'] = display('Department - Swasthrakshnam');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_swasth')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_swasth');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_swasth');
			  $data['content'] = $this->load->view('deprt_swasth',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
			public function deprt_aatya_ipd(){
		$data['title'] = display('Department - Aatyaika');
		 
		//$this->form_validation->set_rules('data_limit', display('data_limit') ,'required');
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'deprt_aatya')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/deprt_aatya');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('deprt_aatya');
			  $data['content'] = $this->load->view('deprt_aatya',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	

	public function occupancy_limit(){
		$data['title'] = display('Occupancy Limit');
		 
		
		$data['department'] = (object)$postData = [
			'id' 	  => $this->input->post('id',true),
			'data_limit' 		  => $this->input->post('data_limit',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		
	

			#if empty $dprt_id then insert data
			
				if(!empty($postData['id'])) {
				if ($this->department_model->update_limit($postData,'occupancy_limit')) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
					redirect('department/occupancy_limit');
			}
			else {
			   $data['department'] = $this->department_model->read_by_data('occupancy_limit');
			  $data['content'] = $this->load->view('occupancy_limit',$data,true);
	         $this->load->view('layout/main_wrapper',$data);
	       }

		} 	
 	public function create()
	{
		$data['title'] = display('add_department');
		#-------------------------------#
		$this->form_validation->set_rules('name', display('department_name') ,'required|max_length[100]');
		$this->form_validation->set_rules('description', display('description'),'trim');
		$this->form_validation->set_rules('status', display('status') ,'required');
		#-------------------------------#
		$data['department'] = (object)$postData = [
			'dprt_id' 	  => $this->input->post('dprt_id',true),
			'name' 		  => $this->input->post('name',true),
			'description' => $this->input->post('description',true),
			'status'      => $this->input->post('status',true)
		]; 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $dprt_id then insert data
			if (empty($postData['dprt_id'])) {
				if ($this->department_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('department/create');
			} else {
				if ($this->department_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
				redirect('department/edit/'.$postData['dprt_id']);
			}

		} else {
			$data['content'] = $this->load->view('department_form',$data,true);
			$this->load->view('layout/main_wrapper',$data);
		} 
	}

	public function edit($dprt_id = null) 
	{
		$data['title'] = display('department_edit');
		#-------------------------------#
		$data['department'] = $this->department_model->read_by_id($dprt_id);
		$data['content'] = $this->load->view('department_form',$data,true);
		$this->load->view('layout/main_wrapper',$data);
	}
 

	public function delete($dprt_id = null) 
	{
		if ($this->department_model->delete($dprt_id)) {
			#set success message
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect('department');
	}
  
}
